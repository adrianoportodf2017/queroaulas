<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model {
    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    // VALIDATE STRIPE PAYMENT
    public function stripe_payment($token_id = "", $user_id = "", $amount_paid = "", $stripe_secret_key = "") {
        $user_details = $this->user_model->get_all_user($user_id)->row_array();

        require_once(APPPATH . 'libraries/Stripe/init.php');
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        $customer = \Stripe\Customer::create(array(
                    'email' => $user_details['email'], // client email id
                    'card' => $token_id
        ));
        $charge = \Stripe\Charge::create(['customer' => $customer->id, 'amount' => $amount_paid * 100, 'currency' => get_settings('stripe_currency'), 'receipt_email' => $user_details['email']]);
        if ($charge->status == 'succeeded') {
            return true;
        } else {
            $this->session->set_flashdata('error_message', get_phrase('an_error_occurred_during_payment'));
            redirect('home', 'refresh');
        }
    }
    // VALIDATE PAYPAL PAYMENT AFTER PAYING
    public function paypal_payment($paymentID = "", $paymentToken = "", $payerID = "", $paypalClientID = "", $paypalSecret = "") {
        $paypal_keys = get_settings('paypal');
        $paypal_data = json_decode($paypal_keys);

        $paypalEnv = $paypal_data[0]->mode; // Or 'production'
        if ($paypal_data[0]->mode == 'sandbox') {
            $paypalURL = 'https://api.sandbox.paypal.com/v1/';
        } else {
            $paypalURL = 'https://api.paypal.com/v1/';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paypalURL . 'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID . ":" . $paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);
        if (empty($response)) {
            return false;
        } else {
            $jsonData = json_decode($response);
            $curl = curl_init($paypalURL . 'payments/payment/' . $paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            // Transaction data
            $result = json_decode($response);
            // CHECK IF THE PAYMENT STATE IS APPROVED OR NOT
            if ($result && $result->state == 'approved') {
                return true;
            } else {
                return false;
            }
        }
    }
    // VALIDATE PAGAR.ME PAYMENT
    public function pagarme_payment($post = "", $public_key = "", $payment_method = "credit_card", $doctor) {
    
        require_once(APPPATH . '../vendor/autoload.php');
        $paytm = $this->db->get_where('paymentgateway', array('name =' => 'pagarme'))->row();
        $pagarme = new PagarMe\Client($post['public_key']);
        $telefones = []; 
        if (!empty($post['phone'])) {
            array_push($telefones, '+55' . $this->soNumero($post['phone']));
        }
                    
        $itens = [];
        $counter = 0;
        $parcelas = $this->payment_model->checkar_taxa_juros($post['public_key'], $post['amount'], $free_installments = NULL , $max_installments  = NULL , $insterest_rate = NULL );
        $page_data['amount_to_pay'] = $post['amount'] / 100;
                  $split['0'] = [
                'percentage' => $paytm->percentage_doctor,
                'recipient_id' => $doctor->recipient_id,
                'charge_processing_fee' => true,
                'liable' => true
            ];
            $split['1'] = [
                'percentage' => $paytm->percentage,
                'recipient_id' => $paytm->recipient_id,
                'charge_processing_fee' => true,
                'liable' => true
            ];
           
        
        if($post['parcelas'] > 1 || $post['parcelas'] > '1') {
            foreach ($parcelas->installments as $parcela):
                if ($parcela->installment == $post['parcelas']) {
                    $amount = $parcela->installment_amount;
                    $amount = preg_replace("/[^0-9]/", "", $amount);
                    $amount = $amount * $post['parcelas'];
                    //$amount = substr($amount,0, -2);
                    $amount = (int) $amount / 100;
                    //$amount = (int)$amount / 100;
                };
            endforeach;
        }else{

            $amount = $page_data['amount_to_pay'] * 100;
            $amount = preg_replace("/[^0-9]/", "", $amount);
        }

        if(!isset($post['first_name']) || $post['first_name'] == " " || $post['first_name'] == "" || $post['first_name'] == null) {
            $user_details['first_name'] = $post['first_name'];
            $user_details['last_name'] = $post['last_name'];
        }
        if($payment_method == 'boleto') {

            $amount = $page_data['amount_to_pay'] * 100;
            $amount = preg_replace("/[^0-9]/", "", $amount);
        }
        $itens[] = [
            'id' => $doctor->id,
            'title' => 'Agendamento de Consulta '.$doctor->name,
            'unit_price' => (int) $amount,
            'quantity' => 1,
            'tangible' => false
        ];
        if (strlen($this->soNumero($post['cpf'])) > 11) {
            $type = 'corporation';
            $type2 = 'cnpj';
        } else {
            $type = 'individual';
            $type2 = 'cpf';
        }
        $data = [
            'amount' => (int) $amount,
            'payment_method' => $payment_method,
            'customer' => [
                'external_id' => $doctor->id,
                'name' => $post['first_name'] . " " . $post['last_name'],
                'email' => $post['email'],
                'type' => $type,
                'country' => 'br',
                'documents' => [
                    [
                        'type' => $type2,
                        'number' => $this->soNumero($post['cpf'])
                    ]
                ],
                'phone_numbers' => $telefones
            ],
            'billing' => [
                'name' => $post['first_name'] . " " . $post['last_name'],
                'address' => [
                    'country' => 'br',
                    'street' => $post['adress'],
                    'street_number' => $post['number'],
                    'state' => $post['state'],
                    'city' => $post['city'],
                    'neighborhood' => $post['district'],
                    'zipcode' => $this->soNumero($post['postal_code'])
                ]
            ],
            'items' => $itens,
            'split_rules' => $split,
            'metadata' => json_encode(['itens' => $itens]),
        ];
        if($payment_method == 'boleto') {
            $data['postback_url'] = "https://portal.ladiesboss.com.br/academy/home/pagarme_postback";
            $data['capture'] = true;
            $data['async'] = false;
        }else {
            try {
                $expiryMM = $post['expiryMes'] ?? null;
                $yearExpiry = substr($post['expiryAA'], -2);
                $ex = $expiryMM . $yearExpiry;
                $ex = str_replace(' ', '', $ex);
                $card = $pagarme->cards()->create([
                    'holder_name' => $post['name'],
                    'number' => $post['number'],
                    'expiration_date' => $ex,
                    'cvv' => $post['cvc']
                ]);

                $data['installments'] = $post['parcelas'];
                $data['card_id'] = $card->id;
                $data['async'] = false;
            } catch (\PagarMe\Exceptions\PagarMeException $e) {
                if ($e->getType() == "invalid_parameter") {
                    return [
                        'status' => false,
                        'message' => "Encontramos um erro no campo: " . $e->getParameterName() . "\nO campo está vazio ou o formato é inválido."
                    ];
                }
            }
        }
        try{
            $transaction = $pagarme->transactions()->create($data);
            if($transaction->status == 'paid') {
                return ['status' => 'paid'];
            }elseif ($transaction->status == 'waiting_payment') {
                $trancasao_id = $transaction->id;
                $this->session->set_userdata('transaction', $transaction);
                return ['status' => 'waiting_payment',
                    'amount' => $amount];
            }elseif ($transaction->status == 'processing') {
                return ['status' => false,
                    'message' => 'Transação está em processo de AUTORIZAÇÃO, entre em contato com a nossa equipe para verificar se o pagamento foi aprovado.'
                ];
            }elseif ($transaction->status == 'authorized') {
                return ['status' => false,
                    'message' => 'Transação foi autorizada. Cliente possui saldo na conta e este valor foi reservado para futura, que deve acontecer em até 5 dias. Caso não seja capturada, a autorização é cancelada automaticamente pelo banco emissor'
                ];
            }elseif ($transaction->status == 'refunded') {
                return ['status' => false,
                    'message' => 'Transação estornada completamente.'
                ];
            }elseif ($transaction->status == 'pending_refund') {
                return ['status' => false,
                    'message' => 'Transação do tipo Boleto e que está aguardando confirmação do estorno solicitado.'
                ];
            }elseif ($transaction->status == 'refused') {
                return ['status' => false,
                    'erro' => 'Error Cartao de Credito ..  Motivo: Tansação RECUSADA, verifique os dados do cartão e tente novamente',
                    'message' => 'Tansação RECUSADA, não autorizada  ,Ocorreu um erro durante o pagamento verifique os dados do cartão e tente novamente'
                ];
            }elseif ($transaction->status == 'chargedback') {
                return ['status' => false,
                    'message' => 'Transação sofreu chargeback, entre em contato com a nossa equipe para maiores esclarecimentos.'
                ];
            }elseif ($transaction->status == 'analyzing') {
                return ['status' => false,
                    'message' => 'Transação encaminhada para a análise manual feita por um especialista em prevenção a fraude; Entre em contato com a nossa equipe para verificar se o pagamento foi aprovado. '
                ];
            }elseif ($transaction->status == 'pending_review') {
                return ['status' => false,
                    'message' => 'Transação pendente de revisão manual por parte do lojista. Uma transação ficará com esse status por até 48 horas corridas.'
                ];
            }else {
                return ['status' => false,
                    'message' => 'Ocorreu um erro durante o pagamento. Por favor entre em contato com a nossa equipe'
                ];
            }
        } catch(\PagarMe\Exceptions\PagarMeException $e) {

            if(strpos($e->getMessage(), 'phone_numbers') !== false) {

                return [
                    'status' => false,
                    'message' => 'Ocorreu um erro durante o pagamento. Verifique os dados e tente novamente, Verifique Numero de Telefone',
                    'erro' => 'Numero de Telefone inválido'
                ];
            }elseif (strpos($e->getMessage(), 'Invalid CPF') !== false) {

                return [
                    'status' => false,
                    'message' => 'Ocorreu um erro durante o pagamento. Verifique os dados e tente novamente, Verifique Numero de CPF',
                    'erro' => 'Numero de CPF inválido'
                ];
            }elseif (strpos($e->getMessage(), 'Invalid CNPJ') !== false) {

                return [
                    'status' => false,
                    'message' => 'Ocorreu um erro durante o pagamento. Verifique os dados e tente novamente, Verifique Numero de CNPJ',
                    'erro' => 'Numero de CNPJ inválido'
                ];
            }elseif (strpos($e->getMessage(), 'zipcode') !== false) {

                return [
                    'status' => false,
                    'message' => 'Ocorreu um erro durante o pagamento. Verifique os dados e tente novamente, Verifique Numero de CEP deve ter 8 dígitos para endereços brasileiros',
                    'erro' => 'Numero de CEP inválido'
                ];
            }else {
                return [
                    'status' => false,
                    'message' => 'Ocorreu um erro durante o pagamento. Verifique os dados e tente novamente' . $e->getMessage(),
                    'erro' => $e->getMessage()
                ];
            }
        }
    }
    // VALIDATE PAGAR.ME link PAYMENT
  
    public function checkar_taxa_juros($publicKey, $amount , $free_installments , $max_installments , $insterest_rate) {
        
            require_once(APPPATH . '../vendor/autoload.php');
            $pagarme = new PagarMe\Client($publicKey);
            $calculateInstallments = $pagarme->transactions()->calculateInstallments([
                'amount' => ($amount * 100),
                'free_installments' => '1',
                'max_installments' => '3',
                'interest_rate' => '2'
            ]);
            return $calculateInstallments;
        }
    
    public function checkar_taxa_juros_link($publicKey, $amount, $link_id) {
        if($link_id != null) {
            $link = $this->crud_model->get_link_by_id($link_id)->row_array();
            if($link['interest_rate'] == null) {
                $link['interest_rate'] = '0';
            }
            require_once(APPPATH . '../vendor/autoload.php');
            $pagarme = new PagarMe\Client($publicKey);
            $calculateInstallments = $pagarme->transactions()->calculateInstallments([
                'amount' => ($amount * 100),
                'free_installments' => $link['free_installments'],
                'max_installments' => $link['max_installments'],
                'interest_rate' => $link['interest_rate']
            ]);
            return $calculateInstallments;
        }
    }
    public function checkar_taxa_juros_charge($publicKey, $amount, $charge_id) {
        if ($charge_id != null) {
            $charge = $this->crud_model->get_charge_by_id($charge_id)->row_array();
            $charge['interest_rate'] = '0';
            require_once(APPPATH . '../vendor/autoload.php');
            $pagarme = new PagarMe\Client($publicKey);
            $amount = str_replace(',', '.', $amount);
            $calculateInstallments = $pagarme->transactions()->calculateInstallments([
                'amount' => ($amount * 100),
                'free_installments' => 1,
                'max_installments' => 1,
                'interest_rate' => '0'
            ]);
            return $calculateInstallments;
        }
    }
    public function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }    
}
