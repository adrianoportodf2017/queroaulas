<div class="container-fluid py-4" style="margin-top: 50px;">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Meus Agendamentos</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7""><?php echo lang('Cliente'); ?></th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment) { ?>
                                    <tr class="">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php $teacher_details = $this->teacher_model->getteacherById($appointment->teacher);
                                                    ?>
                                                    <img src="<?= base_url() . $teacher_details->img_url ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"> <?php

                                                                                if (!empty($teacher_details)) {
                                                                                    $appointment_teacher = $teacher_details->name;
                                                                                } else {
                                                                                    $appointment_teacher = '';
                                                                                }
                                                                                echo $appointment_teacher;
                                                                                ?></h6>
                                                    <p class="text-xs text-secondary mb-0">50 Minutos</p>
                                                </div>
                                            </div>                                    
                                            <div class="d-flex px-2 py-1">                                                
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"> Nome: <?php
                                                                                    echo $client->name;
                                                                               ?></h6>
                                                                              Email: <?php
                                                                                    echo $client->email;
                                                                               ?><br>
                                                                              Telefone:  <?php
                                                                                    echo $client->phone;
                                                                               ?><br>
                                                </div>
                                            </div>
                                      
                                        <p class="text-xs font-weight-bold mb-0"> <?php echo date('d-m-Y', $appointment->date) . ' -' . $appointment->s_time; ?></p>
                        <p class="text-xs text-secondary mb-0">Horário de Brasília</p>
                                           <br> <b>
                                       <span class="badge badge-sm bg-gradient-success"><?php

                                            if ($appointment->status == 'Pending Confirmation') {
                                                $appointment_status = lang('pending_confirmation');
                                            } elseif ($appointment->status == 'Confirmed') {
                                                $appointment_status = lang('confirmed');
                                            } elseif ($appointment->status == 'Treated') {
                                                $appointment_status = lang('treated');
                                            } elseif ($appointment->status == 'Cancelled') {
                                                $appointment_status = lang('cancelled');
                                            } elseif ($appointment->status == 'Requested') {
                                                $appointment_status = lang('requested');
                                            }
                                            echo $appointment_status;
                                            ?></span>
                                           <a href="<?= base_url().'meeting/instantLive?id=' . $appointment->id?>"> <span class="badge badge-sm bg-gradient-primary">Acessar</span></td>
                                     </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>