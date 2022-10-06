<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class plans extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('plans_model');
        $this->load->model('pgateway/pgateway_model');
        //$this->load->model('donor/donor_model');
        //$this->load->model('doctor/doctor_model');
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['settings'] = $this->settings_model->getSettings();
        $data['plans'] = $this->plans_model->getPlans();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('plans', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addPlansView() {

        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

        $data = array();
        $data['pgateways'] = $this->pgateway_model->getPaymentGateway();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_plans_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewPlans() {

        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }
        if($_FILES['img_url']['name']){
        $file_name = $_FILES['img_url']['name'];
        $file_name_pieces = explode('_', $file_name);
        $new_file_name = '';
        $count = 1;
        foreach ($file_name_pieces as $piece) {
            if ($count !== 1) {
                $piece = ucfirst($piece);
            }

            $new_file_name .= $piece;
            $count++;
        }
        $config = array(
            'file_name' => $new_file_name,
            'upload_path' => "./uploads/plans",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => False,
            'max_size' => "10000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "10000",
            'max_width' => "10000"
        );

        $this->load->library('Upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('img_url')) {
            $path = $this->upload->data();
            $img_url = "uploads/plans/" . $path['file_name'];
            $data = array();
            $data = array(
                'title'  => $this->input->post('title'),
                'description'  =>  $this->input->post('description'),
                'img_url'  =>   $img_url,
                'price'  =>  $this->input->post('price'),
                'free_installments'  =>  $this->input->post('free_installments'),
                'max_installments'  =>  $this->input->post('max_installments'),
                'interest_rate'  =>  $this->input->post('interest_rate'),
                'enable_card_cred'  =>  $this->input->post('enable_card_cred'),
                'enable_billet'  =>  $this->input->post('enable_billet'),
                'discounted_price'  =>  $this->input->post('discounted_price'),
                'date_added'  =>  $date,
                'enable_warranty'  =>  $this->input->post('enable_warranty'),
                'enable_coupons'  =>  $this->input->post('enable_coupons'),
                'paymentgateway_id'  =>  $this->input->post('paymentgateway_id'),
                'cod'  =>  $this->input->post('cod')
            );
        }} else {           
            $data = array(
                'title'  => $this->input->post('title'),
                'description'  =>  $this->input->post('description'),
                'price'  =>  $this->input->post('price'),
                'discounted_price'  =>  $this->input->post('discounted_price'),                
                'free_installments'  =>  $this->input->post('free_installments'),
                'max_installments'  =>  $this->input->post('max_installments'),
                'interest_rate'  =>  $this->input->post('interest_rate'),
                'enable_card_cred'  =>  $this->input->post('enable_card_cred'),
                'enable_billet'  =>  $this->input->post('enable_billet'),
                'date_added'  =>  $date,
                'enable_warranty'  =>  $this->input->post('enable_warranty'),
                'enable_coupons'  =>  $this->input->post('enable_coupons'),
                'paymentgateway_id'  =>  $this->input->post('paymentgateway_id'),
                'cod'  =>  $this->input->post('cod')
            );
        }     
            if (empty($id)) {
                $this->plans_model->insertPlans($data);
                $this->session->set_flashdata('feedback', lang('added'));
                redirect('plans');
            } else {
                $this->plans_model->updatePlans($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                redirect('plans');
            }
         }
    

    function delete() {
        $id = $this->input->get('id');
        $this->plans_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('plans');
    }

    function getPlansJson() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['plans'] = $this->plans_model->getPlanBysearch($search, $order, $dir);
            } else {
                $data['plans'] = $this->plans_model->getPlanWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['plans'] = $this->plans_model->getPlansByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['plans'] = $this->plans_model->getPlansByLimit($limit, $start, $order, $dir);
            }
        }

       // var_dump($data['plans']);


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['plans'] as $plan) {
           // $i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a title="' . lang('view') . ' ' . lang('plan') . '" class="btn btn-info btn-xs btn_width" href="plan/viewplan?id=' . $plan->id . '"><i class="fa fa-eye"> ' . lang('view') . ' ' . lang('plan') . ' </i></a>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="plan/editplan?id=' . $plan->id . '" data-id="' . $plan->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('plan') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="plans/delete?id=' . $plan->id . '&admin=' . $plan->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="plans/viewPlansPrint?id=' . $plan->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            $info[] = array(
                $plan->id,
                date('d-m-Y', $plan->date_added),     
                $plan->title,       
                $plan->description,    
                $plan->price, 
                $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2
            );
            $i = $i + 1;
        }
        if ($data['plans']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }







}


/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
