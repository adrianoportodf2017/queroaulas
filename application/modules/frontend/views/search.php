
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-xl-10" style="margin: 0px;">
                <?php

                foreach ($teachers as $teacher) { ?>

                    <div class="card">                        
                        <div class="card-body ">
                            <div class="row " style=" margin: 0;   text-align: center;">
                                <div class="col-md-7">
                                    <aside class="profile-nav ">
                                        <div class="user-heading round">
                                            <div class="row">
                                                <div class="col-4">
                                                    <?php if (!empty($teacher->img_url) && file_exists($teacher->img_url)) { ?>
                                                        <a href="#">
                                                            <div class="m-b-25"> <img src="<?= $teacher->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                        </a>
                                                    <?php }else {
                                                     ?>
                                                     <a href="#">
                                                            <div class="m-b-25"> <img src="<?= base_url()?>uploads/semfoto.gif" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                        </a><?php }?>
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
                                                <?php
                                                $specialties = explode(",", $teacher->specialties);
                                                foreach ($specialties as $specialtie) {
                                                    echo '<button class="btn btn-outline-secondary" style="margin: 2px"> ' . $specialtie . '</button>';
                                                }
                                                ?>
                                                <p style="margin: 30px;  margin: 0;  text-align: justify; font-size: small;"><?= mb_substr($teacher->profile, 0, 300, 'UTF-8'); ?>
                                    </aside>
                                    <a href="<?= site_url().'frontend/profile/'. $teacher->id; ?>" class="btn btn-outline-info" style="margin: 2px">Quero Saber Mais      <i class="fa fa-heart-o"></i></a>
                                </div>
                                <div class="col-md-5">
                                    <b>
                                        <h3>Selecione uma data</h3>
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
                                    <b>
                                        <h3>Horários disponíveis:</h3>
                                    </b>
                                    <div class="listhours slider" id="<?= $teacher->id ?>" name="listhours">

                                    </div>
                                    <div id="msg<?= $teacher->id ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                <?php } ?>

            </div>
        </div>
    </div>


    </section>

