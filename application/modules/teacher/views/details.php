<?php
$cont = '0';
$teste = '';

if (empty($teacher->img_url)) {
  $cont = $cont + 1;
}
if (empty($teacher->address)) {
  $cont = $cont + 1;
}
if (empty($teacher->amount_to_pay)) {
  $cont = $cont + 1;
}
if (empty($teacher->specialties)) {
  $cont = $cont + 1;
}
if (empty($teacher->profile)) {
  $cont = $cont + 1;
}

$porcentagem = intval(100 / 7) * $cont;
$porcentagem = (100 - $porcentagem);
echo $teste . '<br>';
echo $cont;

?>




<div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
  <div class="row text-center">
    <div class="col-10 mx-auto">
      <h5 class="font-weight-normal">What are you doing? (checkboxes)</h5>
      <p>Give us more details about you. What do you enjoy doing in your spare time?</p>
    </div>
  </div>
  <div class="multisteps-form__content">
    <div class="row mt-4">
      <div class="col-sm-3 ms-auto">
        <input type="checkbox" class="btn-check" id="btncheck1">
        <label class="btn btn-lg btn-outline-secondary border-2 px-6 py-5" for="btncheck1">
          <h6>Design</h6>
        </label>
      </div>
    </div>a4zw23c5xt 6
  </div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $porcentagem; ?>%" aria-valuenow="<?= $porcentagem; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div> Perfil <?= $porcentagem; ?> % Completado
                  <ul>
                    <li><a href="<?= base_url('profile'); ?>">Insira suas informações profissionais</a><i class="ni ni-bold-right"></i></li>
                    <li><a href="<?= base_url('schedule/timeSchedule'); ?>">Defina sua disponibilidade de Atendimento</a><i class="ni ni-bold-right"></i></li>
                  </ul>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="col-md-12">
        <br> <br> <br>
        <div class="card">
          <div class="card-body">

            <div id="calendar" class="tab-pane active">
              <div class="">
                <div class="panel-body">
                  <aside>
                    <section class="panel">
                      <div class="panel-body">
                        <div id="calendar" class="has-toolbar calendar_view"></div>
                      </div>
                    </section>
                  </aside>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="cmodal">
        <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
          <div class="modal-content">
            <div class="card">
              <!--
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo lang('patient') . ' ' . lang('history'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    -->
            </div>
            <div class="card">
              <div class="card-body">
                <div id='medical_history'>
                  <div class="col-md-12">

                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-12">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>