
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
        width: 100%;

    }
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('time_schedule'); ?> (<?php echo  $doctor->name; ?>)
                <div class="col-md-4 clearfix pull-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>

            <?php
            // $planos_details = $this->crud_model->get_planos_by_id($param3)->row_array();
            //  $section_details = $this->crud_model->get_section('section', $param2)->row_array();

            $horas = unserialize($doctor->hours_available);
            ?>
            <div class="container">
                <form action="<?php echo site_url('schedule/hours_settings'); ?>" method="post">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="<?= $doctor->id ?>">
                        <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px;"> SEG</b>
                            <hr>
                            <?php
                            foreach ($horas['1'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="1-' . $seg . '" name="1-' . $seg . '" value = "1" checked>        
       
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="1-' . $seg . '" name="1-' . $seg . '" value = "1" >        
          
            <br>';
                                }
                            } ?>
                        </div>


                        <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px;">TER </b>
                            <hr>
                            <?php
                            foreach ($horas['2'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="2-' . $seg . '" name="2-' . $seg . '" value = "1" checked>        
      
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="2-' . $seg . '" name="2-' . $seg . '" value = "1" >        
           
            <br>';
                                }
                            } ?>
                        </div>
                        <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px;">QUA </b>
                            <hr>
                            <?php
                            foreach ($horas['3'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="3-' . $seg . '" name="3-' . $seg . '" value = "' . $k . '" checked>        
      
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="3-' . $seg . '" name="3-' . $seg . '" value = "1" >        
          
            <br>';
                                }
                            } ?>
                        </div>
                        <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px;">QUI </b>
                            <hr>
                            <?php
                            foreach ($horas['4'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="4-' . $seg . '" name="4-' . $seg . '" value = "' . $k . '" checked>        
      
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="4-' . $seg . '" name="4-' . $seg . '" value = "1" >        
          
            <br>';
                                }
                            } ?>
                        </div>
                        <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px;">SEX </b>
                            <hr>
                            <?php
                            foreach ($horas['5'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="5-' . $seg . '" name="5-' . $seg . '" value = "' . $k . '" checked>        
      
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="6-' . $seg . '" name="5-' . $seg . '" value = "1" >        
           
            <br>';
                                }
                            } ?>
                        </div>
                        <div class="col-md-1" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px; ">SAB </b>
                            <hr>
                            <?php
                            foreach ($horas['6'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="7-' . $seg . '" name="6-' . $seg . '" value = "' . $k . '" checked>        
       
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="' . $seg . '" name="6-' . $seg . '" value = "1" >        
          
            <br>';
                                }
                            } ?>
                        </div>
                        <div class="col-md-1" style="border: 1px solid black; border-radius: 5px">
                            <b style="margin-right: 15px;">DOM </b>
                            <hr>
                            <?php
                            foreach ($horas['7'] as $seg => $k) {
                                if ($k == '1') {
                                    echo   '<label>' . $seg . ' </label>
        <input type="checkbox" id="' . $seg . '" name="7-' . $seg . '" value = "' . $k . '" checked>        
        
        <br>';
                                } else {
                                    echo   '<label>' . $seg . '</label>
            <input type="checkbox" id="' . $seg . '" name="7-' . $seg . '" value = "1" >        
           
            <br>';
                                }
                            } ?>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-success" type="submit" name="button"><?php echo lang('save'); ?></button>
                    </div>
                </form>
                  </div>
            <section class="panel">
                <div class="row">
                <div class="col-md-3">
                        <aside class="profile-nav">
                            <section class="">
                                <div class="img">
                                    <?php if (!empty($doctor->img_url)) { ?>
                                        <a href="#">
                                            <img src="<?php echo $doctor->img_url; ?>" alt="" width="80%">
                                        </a>
                                    <?php } ?>

                                </div>
                                <div class="user-heading round">
                                    <h1 class="card-title mb-1"><b>
                                            <h1><?php echo $doctor->name ?>
                                        </b></h1>
                                    <p> <?php echo $doctor->email; ?> </p>
                                    <?php //echo print_r($doctor);
                                    ?>
                                    <h6 class="text-light"><?php //var_dump($user_details);
                                                            echo $doctor->career; ?></h6>
                                    <h6 class="text-light"><b>CRP:<?php //var_dump($user_details);
                                                                    echo $doctor->crp . ' | </b><b class="text-bold-700">' . $doctor->city; ?> </b></h6>

                                    <span class="planos-badge best-seller"></span>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <span class="d-inline-block average-rating"></span>
                                    <p><span>(10 Avaliações)</span><br>
                                        <span class="enrolled-num">
                                            8 Sessões realizadas </span>

                                    <h6 class="text-bold-700">Especialidades:</h6>
                                    <p><?= $doctor->specialties ?></p>

                                    <h6 class="text-bold-700">R$150/ 50 MINUTOS:</h6>
                                    <p> <?php echo $doctor->biography      ?>
                                </div>                      
                        </aside>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">AGENDA</h4>
                            </div>
                            <div class="card-body">
                                <b>
                                    <h3>Selecione uma data</h3>
                                </b>
                                <div class="center slider">
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round button-week"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                    <div>
                                        <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))); ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                                    </div>
                                </div>
                                <b>
                                    <h3>Horários disponíveis:</h3>
                                </b>
                                <div class="listhours slider" id="listhours" name="listhours">

                                </div>
                                <button class="btn btn-success round buttonhours"> Agendar uma Consulta Online</button>

                            </div>
                        </div>
                      

                </div>
                </div>
                </div>
                </div>

                </script>
                </div>
            </section>
            </div>

        </section>
    </section>


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
            slidesToShow: 5,
            slidesToScroll: 1
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
            slidesToShow: 5,
            slidesToScroll: 2
        }); });
    

    function verificarHoras(dia) {
        var $opts = {
            dots: false,
            infinite: false,
            centerMode: false,
            slidesToShow: 5,
            slidesToScroll: 2
        }
       // $('.listhours').slick('unslick');
        $('.listhours').slick('unslick');


        var start = dia

        $.ajax({
            url: "<?php echo base_url(); ?>schedule/list_hour_doctor",
            type: "POST",
            data: {
                start: start
            },
            success: function(data) {

                document.getElementById("listhours").innerHTML = data;
                $('.listhours').slick($opts);


            }
        })
    }
</script>