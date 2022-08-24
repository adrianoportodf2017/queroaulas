<div class="container-fluid py-4" style="margin-top: 50px;">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Minhas Sessões</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7""><?php echo lang('doctor'); ?></th>
                                                <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo lang('date'); ?></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo lang('status'); ?></th>
                                    <?php if (!$this->ion_auth->in_group('Patient')) { ?>
                                        <th class="text-secondary opacity-7"><?php echo lang('options'); ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment) { ?>
                                    <tr class="">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
                                                    ?>
                                                    <img src="<?= base_url() . $doctor_details->img_url ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"> <?php

                                                                                if (!empty($doctor_details)) {
                                                                                    $appointment_doctor = $doctor_details->name;
                                                                                } else {
                                                                                    $appointment_doctor = '';
                                                                                }
                                                                                echo $appointment_doctor;
                                                                                ?></h6>
                                                    <p class="text-xs text-secondary mb-0">50 Minutos</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <p class="text-xs font-weight-bold mb-0"> <?php echo date('d-m-Y', $appointment->date) . ' -' . $appointment->s_time; ?></p>
                        <p class="text-xs text-secondary mb-0">Horário de Brasília</p>
                                           <br> <b>
                                        </td>
                                      
                                        <td> <span class="badge badge-sm bg-gradient-success"><?php

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
                                        <?php if (!$this->ion_auth->in_group('Patient')) { ?>
                                            <td class="no-print">
                                                <button type="button" class="btn btn-info btn-xs btn_width editAppointmentButton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-edit"></i> </button>
                                                <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="appointment/delete?id=<?php echo $appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                            </td>
                                        <?php } ?>
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