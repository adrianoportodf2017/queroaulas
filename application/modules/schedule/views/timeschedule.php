<!-- BEGIN: Main Menu-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
      

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
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="1-' . $seg . '" name="1-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="1-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="1-' . $seg . '" name="1-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="1-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>


                                            <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                                                <b style="margin-right: 15px;">TER </b>
                                                <hr>
                                                <?php
                                                foreach ($horas['2'] as $seg => $k) {
                                                    if ($k == '1') {
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="2-' . $seg . '" name="2-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="2-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="2-' . $seg . '" name="2-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="2-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>
                                            <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                                                <b style="margin-right: 15px;">QUA </b>
                                                <hr>
                                                <?php
                                                foreach ($horas['3'] as $seg => $k) {
                                                    if ($k == '1') {
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="3-' . $seg . '" name="3-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="3-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="3-' . $seg . '" name="3-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="3-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>
                                            <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                                                <b style="margin-right: 15px;">QUI </b>
                                                <hr>
                                                <?php
                                                foreach ($horas['4'] as $seg => $k) {
                                                    if ($k == '1') {
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="4-' . $seg . '" name="4-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="4-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="4-' . $seg . '" name="4-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="4-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>
                                            <div class="col-md-2" style="border: 1px solid black; border-radius: 5px">
                                                <b style="margin-right: 15px;">SEX </b>
                                                <hr>
                                                <?php
                                                foreach ($horas['5'] as $seg => $k) {
                                                    if ($k == '1') {
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="5-' . $seg . '" name="5-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="5-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="5-' . $seg . '" name="5-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="5-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>
                                            <div class="col-md-1" style="border: 1px solid black; border-radius: 5px">
                                                <b style="margin-right: 15px; ">SAB </b>
                                                <hr>
                                                <?php
                                                foreach ($horas['6'] as $seg => $k) {
                                                    if ($k == '1') {
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="6-' . $seg . '" name="6-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="6-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="6-' . $seg . '" name="6-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="6-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>
                                            <div class="col-md-1" style="border: 1px solid black; border-radius: 5px">
                                                <b style="margin-right: 15px;">DOM </b>
                                                <hr>
                                                <?php
                                                foreach ($horas['7'] as $seg => $k) {
                                                    if ($k == '1') {
                                                        echo   '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="7-' . $seg . '" name="7-' . $seg . '" value = "1" checked>
        <label  class="custom-control-label" for="7-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    } else {
                                                        echo     '
                                                        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="7-' . $seg . '" name="7-' . $seg . '" value = "1" >
        <label  class="custom-control-label" for="7-' . $seg . '">' . $seg . ' </label>        
       
        </div> <br>';
                                                    }
                                                } ?>
                                            </div>
                                                      </div>

                                        <div class="text-right">
                                            <button class="btn btn-success" type="submit" name="button"><?php echo lang('save'); ?></button>
                                        </div>
                                    </form>
                                </div>
                          
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
        });
    });


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