<div class="main-content">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-4 mb-2 align-self-center">
        <div class="card card-profile">
          <img src="<?= base_url() ?>uploads/fundoprofilee.jpg" alt="Image placeholder" class="card-img-top">
          <div class="row justify-content-center">
            <div class="col-4 col-lg-4 order-lg-2">
              <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                <?php if (!empty($teacher->img_url) && file_exists($teacher->img_url)) { ?>
                  <a href="#">
                    <div class="m-b-25"> <img src="<?= $teacher->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                  </a>
                <?php } else {
                ?>
                  <a href="#">
                    <div class="m-b-25"> <img src="<?= base_url() ?>uploads/semfoto.gif" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                  </a><?php } ?>
              </div>
            </div>
          </div>
          <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
            <div class="d-flex justify-content-center">
              <a href="<?= site_url() ?>frontend/profile/<?= $teacher->id ?>#agenda" class="btn btn-sm btn-info mb-0 ">Agendar uma Aula</a>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col">
                <div class="d-flex justify-content-center">
                  <div class="d-grid text-center">
                    <span class="text-lg font-weight-bolder">22</span>
                    <span class="text-sm opacity-8">Aulas</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-4">
              <h5>
                <?php echo $teacher->name ?><span class="font-weight-light"></span>
              </h5>
              <div class="h6 font-weight-300">
                <i class="ni location_pin mr-2"></i><?= $teacher->country ?>
              </div>
              <div class="h6 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i><b>R$ <?php echo number_format($teacher->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b>
              </div>
              (<i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>)
              <span class="text-lg font-weight-bolder">10</span>
              <span class="text-sm opacity-8">Avaliações</span>
              <div>
                <i class="ni education_hat mr-2"></i><?= $teacher->department ?>
              </div>
            </div>
          </div>
        </div>
      </div><br><br><br>

      <div class="col-md-8">
        <div class="card">
          <div class="card-header pb-0">
          </div>
          <div class="card-body">
            <p class="text-uppercase text-sm">Sobre o(a) professor(a)</p>
            <div class="row">
              <p style="margin: 30px;  margin: 0;   font-family: 'roboto'; text-align: justify; font-size:large; font-weight: 500;"><?= $teacher->biography; ?>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Currículo</p>
            <div class="row">
              <p style="margin: 30px;  margin: 0;   font-family: 'roboto'; text-align: justify; font-size:large; font-weight: 500;"><?= $teacher->profile; ?>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Especialidades</p>
            <div class="row">
              <div class="col-md-12">
                <?php
                $specialties = explode(",", $teacher->specialties);
                foreach ($specialties as $specialtie) {
                  echo '<button class="btn btn-outline-secondary" style="margin: 2px"> ' . $specialtie . '</button>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-1"></div>
    <div class="col-xl-10" style="margin: 0px;">
      <div class="card">
        <div class="card-body ">
          <div class="row " style=" margin: 0;   text-align: center;">
            <div class="col-md-2"> </div>
            <div class="col-md-8" id="agenda" name="agenda">
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
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+2 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
                <div>
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+3 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
                <div>
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+4 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
                <div>
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+5 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
                <div>
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+6 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
                <div>
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+7 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
                <div>
                  <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+8 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                            echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                </div>
              </div>

              <div class="listhours slider" id="<?= $teacher->id ?>" name="listhours">

              </div>
              <div id="msg<?= $teacher->id ?>">
              </div>
            </div>
            <div class="col-md-2"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
  $("nav a").click(function(event) {
    event.preventDefault();
    var dest = 0;
    if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
      dest = $(document).height() - $(window).height();
    } else {
      dest = $(this.hash).offset().top;
    }
    $('html,body').animate({
      scrollTop: dest
    }, 1000, 'swing');
  });
</script>