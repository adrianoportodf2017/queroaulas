<div class="main-content">
        <div class="container py-4">
                <div class="row">
                        <div class="col-lg-12 mb-2 align-self-center">
                                <div class="card card-profile">
                                        <div class="card-body">
                                                <h6 class="text-dark"><b>Data: </b><b class="text-bold-700"> <?= mb_strtoupper(utf8_encode(strftime('%a, %d de %B de %Y', strtotime($date)))); ?> às <?= $hour; ?>h</b></h6>
                                                <h6 class="text-dark"><b>Horário de Brasília</b></h6>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">


                        <?php


                        //  var_dump($this->ion_auth->logged_in());die;
                        if (!$this->ion_auth->logged_in()) { ?>
                                <div class="col-md-6">
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
                                </div>

                        <?php } else {
                                var_dump($this->session->userdata) ?>

                        <?php } ?>
                        <div class="col-md-6">
                                <div class="card card-profile">
                                        <div class="card-body">
                                                <aside class="profile-nav ">
                                                        <div class="user-heading round">
                                                                <div class="row">
                                                                        <div class="col-4">
                                                                                <?php if (!empty($teacher->img_url) && file_exists($teacher->img_url)) { ?>
                                                                                        <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                                                                <div class="m-b-25"> <img src="<?= $teacher->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                                                        </a>
                                                                                <?php } else {
                                                                                ?>
                                                                                        <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                                                                <div class="m-b-25"> <img src="<?= base_url() ?>uploads/semfoto.gif" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                                                        </a><?php } ?>
                                                                        </div>
                                                                        <div class="col-8" style="text-align: left;">
                                                                                <h5><?php echo $teacher->name ?> </b></h5>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <br>
                                                                                <br><b>R$ <?php echo number_format($teacher->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b>
                                                                                <p>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="card-block">
                                                                <p style="margin: 30px;  margin: 0;  text-align: justify; font-size: small;"><?= mb_substr($teacher->profile, 0, 300, 'UTF-8'); ?>
                                                </aside>
                                                <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>" class="btn btn-outline-info  d-none d-lg-block w-100" style="margin: 2px">Quero Saber Mais <i class="fa fa-heart-o"></i></a>
                                                <b>
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
                                                <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>" class="btn btn-outline-info  d-block d-lg-none" style="margin: 2px">Quero Saber Mais <i class="fa fa-heart-o"></i></a>

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