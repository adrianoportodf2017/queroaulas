<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Login - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
     <!-- Bootstrap core CSS -->
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <!--external css-->
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url(); ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body class="login-body">
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start">
                                        <h4 class="font-weight-bolder">Login</h4>
                                        <p class="mb-0">Entre com seu e-mail e sua senha</p><small>(Caso seja seu primeiro acesso a sua senha é o seu CPF)
                                    </div>
                                    <div class="card-body">
                                        <div id="infoMessage" class=""><?php echo $message; ?></div>
                                        <form method="post" action="auth/login">
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
                                </div>
                            </div>
                            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="
          background-size: cover;  background-position: center; /* Center the image */  background-repeat: no-repeat; /* Do not repeat the image */  background-size: cover; ">
                                             <img class="hero-image" src="<?php echo base_url() ?>uploads/cadastro.svg" alt="Plataforma de Estudos">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
        </main>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>common/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>common/js/bootstrap.min.js"></script>
        <!--   Core JS Files   -->
        <script src="<?php echo base_url(); ?>assets/js/core/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/core/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?php echo base_url(); ?>assets/js/argon-dashboard.min.js?v=2.0.2"></script>

</body>

</html>