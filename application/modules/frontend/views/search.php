
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-xl-8" style="margin: 10px;">
                <?php

                foreach ($doctors as $doctor) { ?>

                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body ">
                            <div class="row " style=" margin: auto;   text-align: center;">
                                <div class="col-md-5 ">
                                    <aside class="profile-nav ">
                                        <div class="user-heading round">
                                            <div class="row">
                                                <div class="col-5">
                                                    <?php if (!empty($doctor->img_url)) { ?>
                                                        <a href="#">
                                                            <div class="m-b-25"> <img src="<?= $doctor->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 200px; width: 150px; border-radius: 50%;"> </div>
                                                        </a>
                                                    <?php } ?>
                                                    <br><b>R$ <?php echo number_format($doctor->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b>
                                                    <p>


                                                </div>
                                                <div class="col-6">
                                                    <h5><?php echo $doctor->name ?>
                                                        </b></h5>
                                                    <h6 class="text-dark"><b>CRP: | </b><b class="text-bold-700"> <?= $doctor->crp ?></b></h6>
                                                    <span>(10 Avaliações)<br>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <br>
                                                        8 Sessões realizadas

                                                </div>

                                            </div>
                                            <div class="card-block">

                                                <?php
                                                $specialties = explode(",", $doctor->specialties);
                                                foreach ($specialties as $specialtie) {
                                                    echo '<button class="btn btn-outline-secondary" style="margin: 2px"> ' . $specialtie . '</button>';
                                                }

                                                ?>
                                                <p style="margin: 30px;  margin: auto;  text-align: justify;"><?= mb_substr($doctor->profile, 0, 300, 'UTF-8'); ?>

                                    </aside>

                                </div>

                                <div class="col-md-7">

                                    <b>
                                        <h3>Selecione uma data</h3>
                                    </b>
                                    <div class="center slider">
                                        <div>
                                            <button id="" onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round button-week" value="teste"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                    </div>
                                    <b>
                                        <h3>Horários disponíveis:</h3>
                                    </b>
                                    <div class="listhours slider" id="<?= $doctor->id ?>" name="listhours">

                                    </div>
                                    <div id="msg<?= $doctor->id ?>">


                                    </div>
                                    <button style="max-width: 250px;" class="btn btn btn-outline-success round buttonhours"> Agendar uma Consulta Online</button>

                                </div>
                                <button style="max-width: 250px; margin: 30px;  text-align: center;" class="btn btn btn-outline-primary round buttonhours"> Ver Perfil</button>

                            </div>


                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>


    </section>

