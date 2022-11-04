<!DOCTYPE html>
<html lang="en">
<base href="<?php echo base_url(); ?>">
<?php
$settings = $this->db->get('settings')->row();
$title = explode(' ', $settings->title);
$site_name = $this->db->get('settings')->row()->title;
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
header('Content-Type: text/html; charset=utf-8');


?>

<head>
<meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../../favicon.ico" />
    <title><?php echo $site_name; ?></title>

    <!-- Bootstrap Core CSS -->
    <!-- Font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!--external css-->
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url(); ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- CSS Files -->
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>app-assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>app-assets/slick/slick-theme.css">
    <link id="pagestyle" href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
    <link id="pagestyle" href="<?php echo base_url(); ?>assets/css/search.css?v=2.0.2" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />



</head>



<!-- BEGIN: Main Menu-->
<style>
    :root {
        --color-background: #F0F0F7;
        --color-primary-lighter: #9871F5;
        --color-primary-light: #916BEA;
        --color-primary: #6842C2;
        --color-primary-dark: #774DD6;
        --color-primary-darker: #6842C2;
        --color-secondary: #04D361;
        --color-secondary-dark: #04BF58;
        --color-title-in-primary: #FFFFFF;
        --color-text-in-primary: #D4C2FF;
        --color-text-title: #32264D;
        --color-text-complement: #9C98A6;
        --color-text-base: #6A6180;
        --color-line-in-white: #E6E6F0;
        --color-input-background: #F8F8FC;
        --color-button-text: #FFFFFF;
        --color-box-base: #FFFFFF;
        --color-box-footer: #FAFAFC;
        --color-small-info: #C1BCCC;

        /* Tamanho da Fonte PadrÃ£o: 16px - 100% - 1rem */

    }



    body {
        background: var(--color-primary);
    }

    #container {
        width: 90vw;
        max-width: 100%;
    }



    .hero-image {
        width: 100%;
    }

    .buttons-container {
        display: flex;
        justify-content: center;
        margin: 3.2rem 0;
    }

    .buttons-container a {
        width: 55%;
        height: 90px;
        border-radius: 0.8rem;
        margin-right: 1.6rem;
        font: 400 0.9rem roboto;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        text-align: center;
        color: var(--color-button-text);
    }

    .buttons-container img {
        margin-right: 0.6rem;
    }

    .buttons-container a img {
        width: 2rem;
    }

    .buttons-container a.study {
        background: var(--color-primary-lighter);
    }

    .buttons-container a.give-classes {
        background: var(--color-secondary);
    }

    .total-connections {
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .total-connections img {
        margin: 0.8rem;
        width: 30px;
    }



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

       .button-week {
        position: relative;
        margin-bottom: 2px;
        margin-left: 10px;
        background-color: #405cf5;


        text-align: center;
        font-weight: bold;
        font-size: 1.1rem;
        color: white;
        height: 65px;
        width: 90%;

    }

    .button {
        background-color: #712cf9;
        color: white;
        font-weight: bold;
        font-size: 20px;

    }

    .button:hover {
        background-color: #4c0bce;
        color: white;
    }

/* CSS */
 .buttonhours{
  appearance: button;
  backface-visibility: hidden;
  background-color: #405cf5;
  border-radius: 6px;
  border-width: 0;
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset,rgba(50, 50, 93, .1) 0 2px 5px 0,rgba(0, 0, 0, .07) 0 1px 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
  font-size: 100%;
  height: 44px;
  line-height: 1.15;
  margin: 12px 0 0;
  outline: none;
  overflow: hidden;
  padding: 0 25px;
  position: relative;
  text-align: center;
  text-transform: none;
  transform: translateZ(0);
  transition: all .2s,box-shadow .08s ease-in;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 95%;
}

 .buttonhours:disabled {
  cursor: default;
}

 .buttonhours:focus {
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
}

</style>



<body class="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="<?php echo base_url(); ?>/frontend"">
            <img src=" <?php echo $settings->logo; ?>" width="150px">
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

                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="<?php echo base_url(); ?>frontend/search">

                            Professores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="<?php echo base_url('auth'); ?>">

                            Acessar Sua Conta
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="<?php echo base_url('frontend/querodaraulas'); ?>">

                            Quero dar Aulas
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="page-header position-relative" style="background: var(--color-primary);">
        <div class="container pb-lg-3 pb-5 pt-7 postion-relative z-index-2">
            <div class="row mt-4">
                <div class="col-md-6 mx-auto text-center">
                    <br>
                    <h3 class="text-white"> Sua plataforma de estudos online
                    </h3>
                </div>
            </div>
        </div>
    </div>