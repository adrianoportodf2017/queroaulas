<!DOCTYPE html>
<html lang="en">
<base href="<?php echo base_url(); ?>">
<?php
$settings = $this->frontend_model->getSettings();
$title = explode(' ', $settings->title);
$site_name = $this->db->get('website_settings')->row()->title;

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../../favicon.ico" />
    <title><?php echo $site_name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
    <!-- Font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- jQuery Plugins -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/magnific-popup/magnific-popup.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('common/assets/bootstrap-timepicker/compiled/timepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--external css-->
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url(); ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/css/rs-style.css'); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/rs-plugin/css/settings.css'); ?>" media="screen">
    <!-- CSS Stylesheet -->
    <link href="<?php echo site_url('front/site_assets/css/style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo site_url('front/site_assets/css/responsive.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.css'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>app-assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>app-assets/slick/slick-theme.css">
</head>


<body class="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
                Psicomob
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?php echo base_url(); ?>/frontend">
                                            <i class="fa fa-chart-pie opacity-6 text me-1"></i>
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="<?php echo base_url(); ?>frontend/search">
                                            <i class="fa fa-user opacity-6 text me-1"></i>
                                            Psicologos
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="<?php echo base_url(); ?>">
                                            <i class="fas fa-user-circle opacity-6 text me-1"></i>
                                            Acessar Sua Conta
                                        </a>
                                    </li>

                                </ul>
                                <ul class="navbar-nav d-lg-block d-none">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>frontend/search" class="btn btn-sm mb-0 me-1 btn-dark">Agendar consulta</a>
                                    </li>
                                </ul>
                            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <div class="page-header position-relative" style="background-image: url('https://demos.creative-tim.com/argon-dashboard-pro/assets/img/pricing-header-bg.jpg');
background-size: cover;">
            <span class="mask bg-gradient-primary opacity-6"></span>
            <div class="container pb-lg-9 pb-10 pt-7 postion-relative z-index-2">
                <div class="row mt-4">
                    <div class="col-md-6 mx-auto text-center">
                        <h3 class="text-white">Encontre seu especialista</h3>
                        <p class="text-white"> Converse com um profissional sem sair de casa
</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-7 mx-auto text-center">
                        <div class="nav-wrapper mt-5 position-relative z-index-2">
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        </div>
    
         <!-- End Navbar -->
    </main>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-md-10" style="margin: 10px;">
            <div class="container pb-5 mb-sm-4 mt-n2 mt-md-n3 divPedido">
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error_message ?>
                    </div>
                <?php endif;

                //$profile_details = $this->crud_model->get_profile_by_id($profile_id)->row_array();
                if ($profile_details->status == 'test') {
                    $public_key = $profile_details->test_api_key;
                    $secret_key = $profile_details->encrypted_test_key;
                } else {
                    $public_key = $profile_details->public_api_key;
                    $secret_key = $profile_details->encrypted_public_key;
                }
                $parcelas = $this->payment_model->checkar_taxa_juros($public_key, $amount_to_pay / 100, $profile_details->free_installments, $profile_details->max_installments, $profile_details->interest_rate);
                ?>
                <form method="post" id="myform" action="<?php echo site_url('home/pagarme_payment/'); ?>" name="myform" onSubmit="return false">
                    <input type="hidden" name="user_id" value="<?= $user_details->id ?? null ?>">
                    <input type="hidden" name="amount" value="<?= $amount_to_pay * 100 ?>">
                    <input type="hidden" name="public_key" value="<?= $public_key ?>">
                    <input type="hidden" name="date" value="<?= $date ?>">
                    <input type="hidden" name="hour" value="<?= $hour ?>">
                    <input type="hidden" name="doctor" value="<?= $doctor->id ?>">
                    <input class="form-control required min" type="hidden" required id="password" name="password" placeholder="Senha" min="3" value="123456789">

                    <div class="row pt-4 mt-2">
                        <div class="col-xl-8 col-md-7" >
                            <h6 class="h6 px-4 py-3 bg-secondary mb-4">Dados do comprador</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">Nome *</label>
                                        <input class="form-control required w3-round" required name="first_name" value="<?= $user->first_name ?? null ?>" type="text" id="checkout-fn">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">Sobrenome *</label>
                                        <input class="form-control required" name="last_name" required type="text" value="<?= $user->last_name ?? null ?>" id="checkout-ln">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cpf">CPF ou CNPJ *</label>
                                        <input class="form-control cpf required" required name="cpf" type="text" value="<?= $user->cpf ?? null ?>" id="cpf">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-email">E-mail *</label>
                                        <input class="form-control required email" type="email" required name="email" value="<?= $user->email ?? null ?>" id="checkout-email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">Telefone/Celular</label>
                                        <input class="form-control phone_with_ddd " name="phone" type="text" value="<?= $user->phone ?? null ?>" id="checkout-phone">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-zip">CEP *</label>
                                        <input class="form-control cep required" name="postal_code" required type="text" value="<?= $patient->postal_code ?? null ?>" id="cep">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-country">País</label>
                                        <select class="form-control custom-select" readonly name="pais" id="checkout-country">
                                            <option value="<?= $patient->country ?? null ?>">Escolher país</option>
                                            <option value="BR" selected>Brasil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-city">Estado</label>
                                        <select class="form-control custom-select required" required id="estado" name="state">
                                            <option value="<?= $patient->state ?? null ?>"><?= $patient->state ?? 'Escolher estado' ?></option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                            <option value="EX">Estrangeiro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-zip">Cidade</label>
                                        <input class="form-control cidade required" required name="city" value="<?= $patient->city ?? null ?>" type="text" id="cidade">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-zip">Bairro</label>
                                        <input class="form-control bairro required" name="district" required value="<?= $patient->district  ?? null ?>" type="text" id="bairro">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-address-1">Endereço</label>
                                        <input class="form-control required" type="text" name="adress" required value="<?= $patient->adress ?? null ?>" id="endereco">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-address-1">Número *</label>
                                        <input class="form-control required" required type="text" value="<?= $patient->number  ?? null ?>" name="number" id="numero">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-address-2">Complemento</label>
                                        <input class="form-control " type="text" name="complement" value="<?= $patient->complement ?? null ?>" id="complemento">
                                    </div>
                                </div>
                            </div>
                        <h2 class="h6 px-4 py-3 bg-secondary mb-4">Escolher método de pagamento</h2>
                        <div class="accordion mb-4" id="payment-method" role="tablist" style=" margin: auto;   text-align: center;" >
                            <?php if ($profile_details->enable_card_cred == '1') : ?>
                                <div class="card" >
                                    <div class="card-header" role="tab">
                                        <h3 class="accordion-heading"><a class="collapsed" href="#card" data-toggle="collapse"><i class="mr-2"></i>Pague com Cartão de Crédito<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                                    </div>
                                    

                                    <div class="collapse show" id="card" data-parent="#payment-method" role="tabpanel">                                    
                                               
                                                    <div class="interactive-credit-card mb-4" style="">
                                                     <div class="card-wrapper">

                                                    </div>
                                                    <hr>
                                                                                              

                                                                <label class="sr-only" for="inlineFormInputGroup">Número do cartão</label>
                                                                <div class="input-group mb-2" style="">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                                                                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" type="text" name="number" placeholder="Número do cartão" required><br>
                                                                </div>

                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zm4.854-7.85a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" type="text" name="name" placeholder="Nome do Titular do Cartão" required>
                                                                </div>

                                                                <div class="form-row">

                                                                    <div class="col-4">
                                                                        <select name="expiryMes" class="form-control" required>
                                                                            <option value="" selected>MM</option>
                                                                            <option value="01">01</option>
                                                                            <option value="02">02</option>
                                                                            <option value="03">03</option>
                                                                            <option value="04">04</option>
                                                                            <option value="05">05</option>
                                                                            <option value="06">06</option>
                                                                            <option value="07">07</option>
                                                                            <option value="08">08</option>
                                                                            <option value="09">09</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input class="form-control" type="text" name="expiryAA" placeholder="AA" required maxlength="4">
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <div class="input-group mb-2">

                                                                            <input class="form-control" type="text" name="cvc" placeholder="CVV" required>

                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div style="display: none">
                                                                            <?php foreach ($parcelas->installments as $parcela) : ?>
                                                                                <span id="total-<?= $parcela->installment ?>" data-valor="<?= $parcela->amount ?>">R$ <?= number_format($parcela->amount, 2, ",", "."); ?></span>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                        <select name="parcelas" id="parcelas" class="form-control card">
                                                                            <?php foreach ($parcelas->installments as $parcela) : ?>
                                                                                <option value="<?= $parcela->installment ?>"><?= $parcela->installment ?>x - R$ <?= number_format($parcela->installment_amount, 2, ",", ".") ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>


                                                                    <div class="col-lg-4 mt-5 order-md-4 course_col hidden" id="btn_img_loader" style="text-align: center; display: none">
                                                                        <img src="<?php echo base_url('assets/img/load.gif'); ?>" alt="" height="50" width="50">
                                                                    </div>

                                                                    <div class="col-md-6" id="btn_loader">
                                                                        <button class="btn btn-outline-primary btn-block mt-0" id="btn_bt_loader" onclick="validateCheckout()">Finalizar Pagamento</button>
                                                                    </div>
                                                                </div>
                                                                
                                                      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> </div> 
                                       
                                    
                                 <?php
                                    endif;?>
                                   
                                   <?php
                        $valorAPagar = $amount_to_pay;
                        $formatado = number_format(($valorAPagar), '2');
                        $valor = str_replace('.', ',', $formatado);

                        $valorSemdesconto = $discounted + $amount_to_pay;
                        $valorSemdesconto = number_format(($valorSemdesconto), '2');
                        $valorSemdesconto = str_replace('.', ',', $valorSemdesconto);

                        $ValorDesconto = $discounted;
                        $ValorDesconto = number_format(($ValorDesconto), '2');
                        $ValorDesconto = str_replace('.', ',', $ValorDesconto);
                        ?>
                        <div class="col-md-4">
                            <div class="card" style=" margin-bottom: 30px; border: 1px solid #graytext; ">
                                <div class="card-body">
                                    <br>
                                    <div  style=" margin: auto;   text-align: center;">
                                    
                                    <div style="background-color: aliceblue ;" class="" align="center">

                                        <path data-v-4371cce6="" d="M21.284 5.3s3.65 16.194-10.176 20.243C-2.718 21.494.93 5.3.93 5.3L11.108.644 21.284 5.3zM10.605 18.67l6.42-6.378-1.764-1.751-4.656 4.626-3.124-3.104-1.763 1.751 4.887 4.856z" fill="#5AC857" fill-rule="evenodd" class="secure-purchase-badge__shield-path"></path></svg>
                                        <strong class="" style="color: black">Compra 100% Segura</strong>
                                    </div>

                                    <h2 class="h6 px-4 py-3 bg-secondary text-center">Detalhes do pedido</h2>

                                    <aside class="profile-nav " >
                                        <div class="user-heading round">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php if (!empty($doctor->img_url)) { ?>
                                                        <a href="#">
                                                            <div class="m-b-25"> <img src="<?= $doctor->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 200px; width: 150px; border-radius: 50%;"> </div>
                                                        </a>
                                                    <?php } ?>

                                                </div>
                                                <div class="col-12">
                                                    <h5><?php echo $doctor->name ?>
                                                        </b></h5>
                                                    <h6 class="text-dark"><b>CRP: | </b><b class="text-bold-700"> <?= $doctor->crp ?></b></h6>
                                                    <span class="text-dark">(10 Avaliações)<br>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <br>

                                                        <h6 class="text-dark"><b>Data: </b><b class="text-bold-700"> <?= mb_strtoupper(utf8_encode(strftime('%a, %d de %B de %Y', strtotime($date)))); ?> às <?= $hour; ?>h</b></h6>
                                                        <h6 class="text-dark"><b>Horário de Brasília</b></h6>
                                                    </div>

                                            </div>


                                    </aside>

                                    <div class="font-size-sm  pt-2 pb-3">
                                        <?php if (!empty($course_id)) : ?>
                                            <div class="d-flex justify-content-between mb-2"><span>Pedido:</span><span><strong><?= $course_title ?></strong></span></div>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-between mb-2"><span>Subtotal:</span><span>R$ <?= $valorSemdesconto ?></span></div>
                                        <div class="d-flex justify-content-between"><span>Desconto:</span><span><?= $ValorDesconto ?></span></div>
                                    </div>


                                </div>


                                <div class="h5 font-weight-semibold text-center py-3">R$ <?= $valor ?> (à vista)</div>
                                <div class="h6 text-center py-3">
                                    Ou em até <?php
                                                $parcela = end($parcelas->installments);
                                                echo current((array) ($parcela->installment));
                                                ?>x de R$ <?php echo number_format($parcela->installment_amount, 2, ",", "."); ?></div>
                                <div data-v-05505c32="" data-v-40cbcc06="" class="payment-methods-icons" style="padding: 5px 16.6667%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/MASTER_CARD.svg" alt="MASTER_CARD" style="flex-basis: 33.3333%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/VISA.svg" alt="VISA" style="flex-basis: 33.3333%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/AMEX.svg" alt="AMEX" style="flex-basis: 33.3333%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/ELO.svg" alt="ELO" style="flex-basis: 33.3333%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/HIPERCARD.svg" alt="HIPERCARD" style="flex-basis: 33.3333%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/HIPER.svg" alt="HIPER" style="flex-basis: 33.3333%;">
                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/DINERS.svg" alt="DINERS" style="flex-basis: 33.3333%;">
                                  
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->

                                </div>   </div>
                                <div align="center">
                                    <h2 class="h6 px-4 py-3 bg-secondary text-center">COMPRE COM SEGURANÇA</h2>

                                    <img data-v-05505c32="" src="<?= base_url() ?>assets/payment/brands/ssl-site-seguro.png" alt="ssl-site-seguro" width=35%">

                                </div>


                            </div>
                        </div>
                      
                    </div> 
                    <!-- Content-->
                    <!-- Content-->
                  
                </form>
        </div>
    </div>
    </div>
    </div>
    </div> </div>




    </section>


    <!---------------- End Testimonials Slider Area ---------------->

    <!---------------- Start Footer Area ---------------->
    <div id="footer" class="text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <img src="<?php echo $settings->logo; ?>" class="img-fluid">

                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="my-2"><?php echo lang('about_us'); ?></h6>
                    <p class="footer-description">
                        <?php echo $settings->description; ?>
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="social-media text-center">
                        <h6 class="my-2"><?php echo lang('STAY_CONNECTED'); ?></h6>
                        <div class="social-icon">

                            <?php if (!empty($settings->facebook_id)) { ?>
                                <a href="<?php echo $settings->facebook_id; ?>">
                                    <div class=""><i class="fa fa-facebook"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->google_id)) { ?>
                                <a href="<?php echo $settings->google_id; ?>">
                                    <div><i class="fa fa-google-plus"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->twitter_id)) { ?>
                                <a href="<?php echo $settings->twitter_id; ?>">
                                    <div><i class="fa fa-twitter"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->youtube_id)) { ?>
                                <a href="<?php echo $settings->youtube_id; ?>">
                                    <div><i class="fa fa-youtube"></i></div>
                                </a> <?php } ?>

                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="my-2"><?php echo lang('CONTACT_INFO'); ?></h6>
                    <address>
                        <strong><?php echo lang('address'); ?>: <?php echo $settings->address; ?></strong><br />
                        <strong><?php echo lang('phone'); ?>: <?php echo $settings->phone; ?></strong><br />
                        <strong><?php echo lang('email'); ?>: <?php echo $settings->email; ?></strong>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript  -->
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/popper.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- JS Main File -->
    <script src="<?php echo site_url('front/site_assets/js/main.js'); ?>"></script>
    <script src="<?php echo site_url('common/toastr/toastr.js'); ?>"></script>
    <!-- <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.js'); ?>" />-->
    <!--<script src="front/js/jquery.js"></script>-->
    <script src="front/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo site_url('front/js/wow/wow.min.js'); ?>"></script>
    <script src="front/js/smoothscroll/jquery.smoothscroll.min.js"></script>
    <script src="<?php echo site_url('front/js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>
    <script src="<?php echo site_url('front/assets/fancybox/source/jquery.fancybox.pack.js'); ?>"></script>

    <!--<script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>
                    <script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>
                    <script src="front/js/revulation-slide.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $('.icon-picker').iconpicker();
            });
        });
    </script>

    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {

            $(".center").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 2
            });

            $(".lazy").slick({
                lazyLoad: 'ondemand', // ondemand progressive anticipated
                infinite: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".listhours").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 2
            });
        });


        function verificarHoras(dados) {
            var $opts = {
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 2
            }
            dados = dados.split(",")
            var start = dados['0'];
            var id = dados['1'];
            var agenda = 'listhours' + id;


            // $(".listhours").slideUp();
            $("#" + id + "").slideUp();
            $(".listhours").slideUp();
            $(".listhours").slick('unslick');




            $.ajax({
                url: "<?php echo base_url(); ?>frontend/list_hour_doctor",
                type: "POST",
                data: {
                    start: start,
                    id: id
                },
                success: function(data) {
                    if (data == "error") {

                        $("#msg" + id + "").html('Nenhum Horário Disponível!');
                        // $(".listhours").slick($opts);
                        //  $(".listhours").slideDown();
                        //   $("#"+id+"").slideDown();




                    } else {
                        // $('.listhours').html = data;
                        $("#" + id + "").slideDown();
                        $("#msg" + id + "").html('');
                        $("#" + id + "").html(data);
                        // document.getElementById(" "+id+" ").innerHTML = data;
                        $(".listhours").slick($opts);




                    }
                }
            })
        }
    </script>


    <!-- Footer-->
    <footer class="page-footer bg-dark divPedido">

        <div class="py-3" style="background-color: #1a1a1a;">
        </div>
    </footer>
    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="<?= base_url() ?>assets/payment/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/card.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/theme.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/jquery.3.5.3.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/jquery.mask.js"></script>
    <!--<script src="<?= base_url() ?>assets/payment/js/busca_cep.js"></script>-->
    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <!--<script src="<?= base_url() ?>assets/payment/js/custom.js"></script>-->
    <script src="<?= base_url() ?>assets/payment/customizer/customizer.min.js"></script>
    <script src="<?= base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
    <script src="<?= base_url() ?>assets/payment/js/sweetalert.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.date').mask('00/00/0000');
            $('.time').mask('00:00:00');
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.phone_with_ddd').mask('00-0000-0000');
            $('.cel_with_ddd').mask('00-00000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            //$('.cpf').mask('000.000.000-00', {reverse: true});
            //$('.cnpj').mask('00.000.000/0000-00', {reverse: true}); 
            $('.money').mask('000.000.000.000.000,00', {
                reverse: true
            });
            $('.money2').mask("#.##0,00", {
                reverse: true
            });
            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/,
                        optional: true
                    }
                }
            });
            $('.ip_address').mask('099.099.099.099');
            $('.percent').mask('##0,00%', {
                reverse: true
            });
            $('.clear-if-not-match').mask("00/00/0000", {
                clearIfNotMatch: true
            });
            $('.placeholder').mask("00/00/0000", {
                placeholder: "__/__/____"
            });
            $('.fallback').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                }
            });
            $('.selectonfocus').mask("00/00/0000", {
                selectOnFocus: true
            });

            $("#parcelas").on('change', function() {
                var parcela = $(this).children('option:selected').val();
                var valor = $("#total-" + parcela).text();
                var amount = $("#total-" + parcela).data('valor');

                $('#valor').val(valor);
                $('#amount').val(amount);
            })

        });

        function toastError(message) {
            console.log(message);
            toastr.error(message);
        }

        function alertMessage(message, type) {
            swal(message, type);
        }

        function openModal(url) {

            var email = $("#dados").data('email');
            var cpf = $("#dados").data('cpf');

            swal.fire({
                title: "Lembrete",
                html: "<p><span style='color: #dd4444'>Caso este seja o seu primeiro acesso</span>, você deverá utilizar os seguintes dados para acessar o seu curso.</p>" +
                    "<p>Email: Seu e-mail</p>" +
                    "<p>Senha: Seu CPF (Somente números)</p>",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Sair.",
                confirmButtonColor: "#5c77fc",
                confirmButtonText: "Acessar!",
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            });
        }
        $("input[id*='cpf']").inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            //
        });
        $('#cpf').on('blur', function() {
            var cpf = $(this).val();
            cpf = cpf.replace(/[^\d]+/g, '');

            if (cpf.length <= 11) {
                if (!validarCPF(cpf)) {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                    swal("Ops! Encontramos um erro...", "O CPF informado não é válido! Por favor, corrija o CPF.", "warning");
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            } else {
                if (!validarCNPJ(cpf)) {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                    swal("Ops! Encontramos um erro...", "O CNPJ informado não é válido! Por favor, corrija o CNPJ.", "warning");
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');

                }
            }

        });

        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf == '')
                return false;
            // Elimina CPFs invalidos conhecidos
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999")
                return false;
            // Valida 1o digito
            add = 0;
            for (i = 0; i < 9; i++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(9)))
                return false;
            // Valida 2o digito
            add = 0;
            for (i = 0; i < 10; i++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;
        }

        function validarCNPJ(cnpj) {

            cnpj = cnpj.replace(/[^\d]+/g, '');

            if (cnpj == '')
                return false;

            if (cnpj.length != 14)
                return false;

            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999")
                return false;

            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0, tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;

            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;

            return true;

        }


        $(document).ready(function() {
            $("#msgjs").hide();
            $("#divPedido").show();
            $("#divRecibo").show();
        });

        function btnpgtoCard() {
            $("#enviar_pgto").trigger('click');
            $('#btn_img_loader').show();
            $('#btn_bt_loader').hide();

            setTimeout(function() {
                $('#btn_img_loader').hide();
                $('#btn_bt_loader').show();
            }, 8000);
        }

        function btnreload2() {
            $("#enviar_pgto").trigger('click');
            $('#btn_img_loader2').show();
            $('#btn_bt_loader2').hide();

            setTimeout(function() {
                $('#btn_img_loader2').hide();
                $('#btn_bt_loader2').show();
            }, 8000);
        }
        /* Config Vars */
        /* Nao alterar ValidateState */
        validateState = false;

        /* Required message */
        validateRequiredMsg = "Campo de preechimento obrigat&oacute;rio";
        /* E-mail message */
        validateMailMsg = "E-mail informsdsado &eacute; inv&aacute;lido";
        /* Numeric message */
        validateNumericMsg = "O valor deve ser num&eacute;rico";
        /* Min message */
        validateMinMsg = "A quantidade m&iacute;nima de caracters &eacute;: ";
        /* Max message */
        validateMaxMsg = "A quantidade m&aacute;xima de caracters &eacute;: ";
        /* Password message */
        validatePasswordMsg = "Senhas n&atilde;o conferem";

        function validateCheckout() {
            $('#myform :input').each(function() {
                /* required */
                if ($(this).hasClass('required') && $.trim($(this).val()) === "") {
                    $(this).addClass('is-invalid');
                    $(this).focus();
                    $('#msgjs').html(validateRequiredMsg);
                    $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                        $("#msgjs").slideUp(10000);
                    });
                    validateState = false;
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    validateState = true;
                }

                /* numeric value */
                if ($(this).hasClass('required') && $(this).hasClass('numeric')) {
                    var nan = new RegExp(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/);
                    if (!nan.test($.trim($(this).val()))) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateNumericMsg);
                        $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                            $("#msgjs").slideUp(500);
                        });
                        validateState = false;
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
                /* mail */
                if ($(this).hasClass('email')) {
                    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
                    if (!er.test($.trim($(this).val()))) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateMailMsg);
                        $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                            $("#msgjs").slideUp(500);
                        });
                        validateState = false;
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
                /* min value */
                if ($(this).attr('min') && $(this).hasClass('required')) {
                    if ($.trim($(this).val()).length < $(this).attr('min')) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateMinMsg + $(this).attr('min'));
                        validateState = false;
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
                /* max value */
                if ($(this).attr('max') && $(this).hasClass('required')) {
                    if ($.trim($(this).val()).length > $(this).attr('max')) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateMaxMsg + $(this).attr('max'));
                        validateState = false;
                        return false;
                    } else {
                        $('#msgjs').html('');
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
                if ($(this).hasClass('card') && $.trim($(this).val()) === "") {
                    $(this).addClass('is-invalid');
                    $(this).focus();
                    $('#msgjs').html(validateRequiredMsg);
                    $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                        $("#msgjs").slideUp(10000);
                    });
                    validateState = false;
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    validateState = true;
                }
            });
            if (validateState === true) {
                $('#btn_img_loader').show();
                $('#btn_bt_loader').hide();
                var formulario = document.getElementById('myform');
                var dados = new FormData(formulario);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('frontend/pagarme_payment/'); ?>?ajax=true",
                    data: dados,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    // async: false,
                    success: function(data) {
                        if (data.situacao === true) {
                            // Remove todos os css da classe
                            $(".divPedido").hide();
                            $('.divRecibo').html(data.html);
                            $(".divRecibo").fadeTo(2000, 500);
                        } else if (data.redirect === true) {
                            // Remove todos os css da classe
                            // $('#btn_bt_loader').hide();
                            // $(".divPedido").hide();
                            // $('.divRecibo').html(data.html);
                            // $(".divRecibo").fadeTo(2000, 500);
                            window.location.href = data.html;
                        } else {
                            swal("Erro", data.mensagem, "error");
                            $('#btn_bt_loader').show();
                            $('#btn_img_loader').hide();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal("Erro", "Error ao tentar realizar o pagamento: " + errorThrown + ' Por favor entre em contato com a nossa Equipe, para mais detalhes.', "error");
                        $('#btn_bt_loader').hide();
                        $('#btn_img_loader').show();
                    }
                });
            }
        }

        function validate_boleto() {
            $('#myform :input').each(function() {
                /* required */
                if ($(this).hasClass('required') && $.trim($(this).val()) === "") {
                    $(this).addClass('is-invalid');
                    $(this).focus();
                    $('#msgjs').html(validateRequiredMsg);
                    $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                        $("#msgjs").slideUp(10000);
                    });
                    validateState = false;
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    validateState = true;
                }
                /* numeric value */
                if ($(this).hasClass('required') && $(this).hasClass('numeric')) {
                    var nan = new RegExp(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/);
                    if (!nan.test($.trim($(this).val()))) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateNumericMsg);
                        $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                            $("#msgjs").slideUp(500);
                        });
                        validateState = false;
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
                /* mail */
                if ($(this).hasClass('email')) {
                    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
                    if (!er.test($.trim($(this).val()))) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateMailMsg);
                        $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                            $("#msgjs").slideUp(500);
                        });
                        validateState = false;
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }

                /* min value */
                if ($(this).attr('min') && $(this).hasClass('required')) {
                    if ($.trim($(this).val()).length < $(this).attr('min')) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateMinMsg + $(this).attr('min'));
                        validateState = false;
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
                /* max value */
                if ($(this).attr('max') && $(this).hasClass('required')) {
                    if ($.trim($(this).val()).length > $(this).attr('max')) {
                        $(this).addClass('invalid');
                        $(this).focus();
                        $('#msgjs').html(validateMaxMsg + $(this).attr('max'));
                        validateState = false;
                        return false;
                    } else {
                        $('#msgjs').html('');
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                        validateState = true;
                    }
                }
            })
            if (validateState == true) {

                $('#btn_img_loader2').show();
                $('#btn_img_loader_boleto').hide();
                var formulario = document.getElementById('myform');
                var dados = new FormData(formulario);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('home/pagarme_payment/'); ?>?ajax=true",
                    data: dados,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    //  async: false,
                    success: function(data) {
                        if (data.situacao == true) {
                            // Remove todos os css da classe
                            $(".divPedido").hide();
                            $('.divRecibo').html(data.html);
                            $(".divRecibo").fadeTo(2000, 500);
                        } else if (data.redirect == true) {
                            // Remove todos os css da classe
                            //$('#btn_bt_loader').hide();  
                            //$(".divPedido").hide();
                            //$('.divRecibo').html(data.html);
                            // $(".divRecibo").fadeTo(2000, 500);
                            window.location.href = data.html;
                        } else {
                            swal("Erro", data.mensagem, "error");
                            $('#btn_bt_loader').show();
                            $('#btn_img_loader2').hide();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal("Erro", "Erro causado por:" + errorThrown, "error");
                        $('#btn_bt_loader').show();
                        $('#btn_img_loader2').hide();
                    }
                });
            }
        }
    </script>

</body>

</html>