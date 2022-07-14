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
    <script src="<?= base_url() ?>assets/payment/js/jquery.3.5.3.min.js"></script>

</head>

<style>
    .topbar-texts,
    .footer-description {
        font-family: "Roboto", sans-serif !important;
        font-size: 15px !important;
    }

    body {
        background-color: #f9f9fa
    }

    .padding {
        padding: 3rem !important
    }

    .user-card-full {
        overflow: hidden
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px
    }

    .m-r-0 {
        margin-right: 0px
    }

    .m-l-0 {
        margin-left: 0px
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263)
    }

    .user-profile {
        padding: 20px 0
    }

    .card-block {
        padding: 1.25rem
    }

    .m-b-25 {
        margin-bottom: 25px
    }

    .img-radius {
        border-radius: 5px
    }

    h6 {
        font-size: 14px
    }

    .card .card-block p {
        line-height: 25px
    }

    @media only screen and (min-width: 1400px) {
        p {
            font-size: 14px
        }
    }

    .card-block {
        padding: 1.25rem
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .card .card-block p {
        line-height: 25px
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .text-muted {
        color: #919aa3 !important
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .f-w-600 {
        font-weight: 600
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .user-card-full .social-link li {
        display: inline-block
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out
    }
</style>

<!-- BEGIN: Main Menu-->
<style>
    .slider {

        width: 95%;
        margin: 30px auto;
        min-width: 100px;
    }

    .slick-slide {
        margin: 0px 0px;
    }

    .slick-slide img {
        width: 95%;
    }

    .slick-next,
    .slick-arrow {
        height: 50px;


    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }


    .slick-slide {
        transition: all ease-in-out .2s;

    }

    .slick-active {}

    .slick-current {}

    .box {

        min-width: 100px;
        height: 300px;


    }

    .scrolling-wrapper {


        display: flex;
        flex-wrap: nowrap;

    }



    .hours {
        width: 100%;
        height: 400px;
        border: 1px solid black;
    }

    .buttonhours {
        height: 50px;
        position: relative;
        margin: 5px;
        margin-left: 10px;
        width: 97%;
        border-style: 5px solid red;

    }

    .button-week {
        position: relative;
        margin-bottom: 2px;
        margin-left: 10px;

        text-align: center;
        font-weight: bold;
        font-size: 1.1rem;
        color: white;
        height: 65px;
        width: 90%;

    }
</style>



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
                                <ul class="navbar-nav d-lg-block d-none">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>frontend/sou_profissional" class="btn btn-sm mb-0 me-1 btn-dark">Eu quero ser Psicomob</a>
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