<style>
        :root {
                --bd-purple: #4c0bce;
                --bd-violet: #712cf9;
                --bd-accent: #ffe484;
                --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
                --bd-accent-rgb: 255, 228, 132;
                --bd-pink-rgb: 214, 51, 132;
                --bd-teal-rgb: 32, 201, 151;
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
                                                       <?php  if ($this->ion_auth->logged_in()) {?>
                                                        <form method="post" action="frontend/appoiment">
                                                         <input type="text" class="form-control form-control-lg" aria-label="" name="id" value="<?= $id ?>">
                                                         <input type="text" class="form-control form-control-lg" aria-label="" name="date" value="<?= $date ?>">
                                                          <input type="text" class="form-control form-control-lg" aria-label="" name="hour" value="<?= $hour ?>">
                                                          <button class="btn button" onclick="finalizarPedido()">Confirmar pedido de Aula</button>

                                                       </form>
                                                          <?php }?>
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
                                                        <div class="card card-profile">
                                                                <div class="card-body">
                                                                        <div class="card card-plain">
                                                                                <div class="card-body">
                                                                                        <?php if ($message) { ?><div id="infoMessage" class="alert alert-light"><?= $message ?></div><?php } ?>
                                                                                        <form method="post" action="auth/loginClient">
                                                                                                <input type="hidden" class="form-control form-control-lg" aria-label="" name="id" value="<?= $id ?>">
                                                                                                <input type="hidden" class="form-control form-control-lg" aria-label="" name="date" value="<?= $date ?>">
                                                                                                <input type="hidden" class="form-control form-control-lg" aria-label="" name="hour" value="<?= $hour ?>">

                                                                                                <div class="mb-3">
                                                                                                        <input type="email" class="form-control form-control-lg" aria-label="Email" name="identity" placeholder="Email" autofocus>
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Senha">
                                                                                                </div>
                                                                                                <div class="form-check form-switch">
                                                                                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                                                                                        <label class="form-check-label" for="rememberMe">Lembrar-me</label>
                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Acessar</button>
                                                                                                </div>
                                                                                        </form>
                                                                                </div>
                                                                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                                                                        <p><a data-toggle="modal" href="#myModal"> Esqueci minha senha</a></p>
                                                                                </div>
                                                                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                                                                        <p><a data-toggle="modal" href="#myCadastro"> Cadastrar</a></p>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

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
                                                <?php $translate = array(
                                                       
                                                        1 => "Seg ",
                                                        2 => "Ter ",
                                                        3 => "Qua ",
                                                        4 => "Qui ",
                                                        5 => "Sex ",
                                                        6 => "Sáb ",
                                                        7 => "Dom ",
                                                );
                                                ?>
                                                <h3>Escolher outra data</h3>
                                                </b>
                                                <div class="center slider">
                                                        <div>
                                                                <button id="" onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round button-week" value="teste"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+1 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                                                echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+2 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+3 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+4 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+5 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+6 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+7 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                                        </div>
                                                        <div>
                                                                <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+8 day', strtotime(date('D-m-y'))))]; echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
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


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form method="post" action="auth/forgot_password">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Forgot Password ?</h4>
                                </div>

                                <div class="modal-body">
                                        <p>Enter your e-mail address below to reset your password.</p>
                                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                                </div>
                                <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                        <input class="btn detailsbutton" type="submit" name="submit" value="submit">
                                </div>
                        </form>
                </div>
        </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myCadastro" class="modal fade">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="card">
                                <div class="card-body">
                                        <form method="post" id="myform" action="<?php echo site_url('frontend/salvarClient/'); ?>" name="myform" onSubmit="return false">
                                                <div class="row">
                                                        <input type="hidden" class="form-control form-control-lg" aria-label="" name="id" value="<?= $id ?>">
                                                        <input type="hidden" class="form-control form-control-lg" aria-label="" name="date" value="<?= $date ?>">
                                                        <input type="hidden" class="form-control form-control-lg" aria-label="" name="hour" value="<?= $hour ?>">
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
                                                        <button class="btn btn-outline-primary btn-block mt-0" id="btn_bt_loader" onclick="validateClient()">Finalizar</button>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>
</div>