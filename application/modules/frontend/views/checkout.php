<style>
        :root {
    --bd-purple: #4c0bce;
    --bd-violet: #712cf9;
    --bd-accent: #ffe484;
    --bd-violet-rgb: 112.520718,44.062154,249.437846;
    --bd-accent-rgb: 255,228,132;
    --bd-pink-rgb: 214,51,132;
    --bd-teal-rgb: 32,201,151;
    --docsearch-primary-color: var(--bd-violet);
    --docsearch-logo-color: var(--bd-violet);
}
:root {
    --base00: #fff;
    --base01: #f5f5f5;
    --base02: #c8c8fa;
    --base03: #565c64;
    --base04: #030303;
    --base05: #333;
    --base06: #fff;
    --base07: #9a6700;
    --base08: #bc4c00;
    --base09: #087990;
    --base0A: #795da3;
    --base0B: #183691;
    --base0C: #183691;
    --base0D: #795da3;
    --base0E: #a71d5d;
    --base0F: #333;
}
       
        </style>



<div class="main-content">
        <div class="container py-4">
                <div class="row">
                        <div class="col-lg-12 mb-2 align-self-center">
                                <div class="card card-profile">
                                        <div class="card-body">
                                                <div class="row">
                                                        <div class="col-7">
                                                                <h6 class="text-dark"><b>Data: </b><b class="text-bold-700"> <?= mb_strtoupper(utf8_encode(strftime('%a, %d de %B de %Y', strtotime($date)))); ?> às <?= $hour; ?>h</b></h6>
                                                                <h6 class="text-dark"><b>Horário de Brasília</b></h6>
                                                        </div>
                                                        <div class="col-5">
                                                                <button class="btn button">Confirmar pedido de Aula</button>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">

                        <div class="col-xl-6 mb-2">
                                <div class="card card-profile">
                                        <div class="card-body">
                                                <?php


                                                //  var_dump($this->ion_auth->logged_in());die;
                                                if (!$this->ion_auth->logged_in()) { ?>
                                                        <form method="post" id="myform" action="<?php echo site_url('frontend/salvar_cliente/'); ?>" name="myform" onSubmit="return false">
                                                                <div class="row">

                                                                        <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                        <input type="text" placeholder="Nome Completo" class="form-control required w3-round" required name="first_name" id="name" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                                <div class="form-group">

                                                                                        <input type="email" class="form-control required w3-round email" required id="email" name="email" placeholder="email">
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                        <input class="form-control required min" type="password" required id="password" name="password" placeholder="Senha" min="3">
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                                <div class="form-group has-success">
                                                                                        <input type="text" placeholder="Celular" id="phone" name="phone" class="form-control required w3-round phone" required />
                                                                                </div>
                                                                        </div>
                                                                        <div class="form-check">
                                                                                <label class="" for="customCheck1">Li e concordo com os Termos e Condições e Política de Privacidade</label>
                                                                                <input class="form-check-input required " require type="checkbox" value="1" id="fcustomCheck1" checked="" name="terms">
                                                                        </div>
                                                                        <button class="btn btn-outline-primary btn-block mt-0" id="btn_bt_loader" onclick="validate()">Finalizar</button>
                                                                </div>
                                                        </form>

                                                <?php } else {
                                                        //  var_dump($this->session->userdata->git) 
                                                ?>
                                                        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
                                                                <div class="card p-4">
                                                                        <div class=" image d-flex flex-column justify-content-center align-items-center">
                                                                               <img src="<?= base_url() ?>uploads/semfoto.gif" height="100" width="100" />
                                                                                <span class="name mt-3"><?php
                                                                                                                        // var_dump($this->session->userdata);

                                                                                                                        echo  $this->session->userdata['username'] ?></span>
                                                                                <span class="idd"><?= $this->session->userdata['email'] ?></span>
                                                                                <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                                                                </div>
                                                                                <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                                                                                </div>
                                                                                <div class=" d-flex mt-2"> <button class="btn1 btn-dark">Acessar Meu Painel</button> </div>
                                                                                <div class=" px-2 rounded mt-4 date "> <span class="join">
                                                                                                <?= date('d-m-Y') ?>
                                                                                        </span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>


                                                <?php } ?>
                                        </div>
                                </div>
                        </div>
                        <div class="col-xl-6 mb-2">
                                <div class="card card-profile">
                                        <div class="card-body">
                                                <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
                                                        <div class="card p-4">
                                                                <div class=" image d-flex flex-column justify-content-center align-items-center">
                                                                        <button class="btn btn-secondary"> <?php if (!empty($teacher->img_url) && file_exists($teacher->img_url)) { ?>
                                                                                        <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                                                                <div class="m-b-25"> <img src="<?= $teacher->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                                                        </a>
                                                                                <?php } else {
                                                                                ?>
                                                                                        <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                                                                <div class="m-b-25"> <img src="<?= base_url() ?>uploads/semfoto.gif" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                                                        </a><?php } ?>
                                                                        </button> <span class="name mt-3"><?php echo $teacher->name ?></span>

                                                                        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                                                                <span class="idd1"><b>R$ <?php echo number_format($teacher->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b></span> <span><i class="fa fa-copy"></i></span>
                                                                        </div>
                                                                        <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                                                                                <span class="number">1069 <span class="follow">Followers</span></span>
                                                                        </div>
                                                                        <div class=" d-flex mt-2"> <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>" style="color: white ;"><button class="btn1 btn-dark">Quero Saber Mais</a></a> </div>
                                                                        <div class="text mt-3"> <span style="margin: 30px;  margin: 0;  text-align: justify; font-size: small;">
                                                                                        <?= mb_substr($teacher->profile, 0, 300, 'UTF-8'); ?>
                                                                                </span>
                                                                        </div>
                                                                        <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span><i class="fa fa-twitter"></i></span>
                                                                                <span><i class="fa fa-facebook-f"></i></span> <span><i class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin"></i></span>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="card card-profile mt-1">
                                        <div class="card-body">

                                                <h3>Escolher outra data</h3>
                                                </b>
                                                <div class="center slider">
                                                        <div>
                                                                <button id="" onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round button-week" value="teste"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                </div>
                                                <div class="listhours slider" id="<?= $teacher->id ?>" name="listhours">

                                                </div>
                                                <div id="msg<?= $teacher->id ?>">
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>






        </div>
</div>
</div>
</div>