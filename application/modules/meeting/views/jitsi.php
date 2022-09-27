<div class="container-fluid py-4" style="margin-top: 50px;">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Minhas Sessões</h6>
                </div>
                <div class="card-body" style="min-height: 800px;">


        <?php
        $appointment_details = $this->appointment_model->getAppointmentById($appointmentid);
        $teacher_details = $this->teacher_model->getteacherById($appointment_details->teacher);
        $teacher_name = $teacher_details->name;
        $client_details = $this->client_model->getclientById($appointment_details->client);
        $client_name = $client_details->name;
        $client_phone = $client_details->phone;
        $client_id = $appointment_details->client;

        $display_name = $this->ion_auth->user()->row()->username;
        $email = $this->ion_auth->user()->row()->email;
        ?>


                <div class="tab-content"  id="meeting">
                    <input type="hidden" name="appointmentid" id="appointmentid"value="<?php echo $appointmentid; ?>">
                    <input type="hidden" name="username" id="username"value="<?php echo $display_name; ?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                </div>

         
        </section>

        <section class="col-md-4">
            <header class="panel-heading">
                <?php echo lang('appointment'); ?> <?php echo lang('details'); ?> 
            </header>

            <div class="">
                <div class="tab-content"  id="">
                    <aside class="profile-nav">
                        <section class="">


                            <ul class="nav nav-pills nav-stacked">
                              <!--  <li class="active"> <?php echo lang('teacher'); ?> <?php echo lang('name'); ?><span class="label pull-right r-activity"><?php echo $teacher_name; ?></span></li> -->
                                <li>  <?php echo lang('teacher'); ?> <?php echo lang('name'); ?> <span class="label pull-right r-activity"><?php echo $teacher_name; ?></span></li>
                                <li>  <?php echo lang('client'); ?> <?php echo lang('name'); ?> <span class="label pull-right r-activity"><?php echo $client_name; ?></span></li>
                                <li>  <?php echo lang('client_id'); ?><span class="label pull-right r-activity"><?php echo $client_id; ?></span></li>
                                <li>  <?php echo lang('appointment'); ?> <?php echo lang('date'); ?> <span class="label pull-right r-activity"><?php echo date('jS F, Y', $appointment_details->date); ?></span></li>
                                <li>  <?php echo lang('appointment'); ?> <?php echo lang('slot'); ?><span class="label pull-right r-activity"><?php echo $appointment_details->time_slot; ?></span></li>
                            </ul>

                        </section>
                    </aside>
                </div>
            </div>
            </div>
            </div>
      




<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"
></script>


<script src="https://meet.jit.si/external_api.js"></script>
<script>
    $(document).ready(function () {
        //  console.log($('#email').val());
        const domain = "meet.jit.si";
        document.getElementById('meeting');
        const options = {
            roomName: "<?php echo $appointment_details->room_id; ?>",
            height: 800,
            parentNode: document.querySelector("#meeting"),
            userInfo: {
                email: $('#email').val(),
                displayName: $('#username').val()
            },
            configOverwrite: { startWithAudioMuted: true,
                SHOW_CHROME_EXTENSION_BANNER: false,
            
            },

            enableClosePage: true,           
            SHOW_PROMOTIONAL_CLOSE_PAGE: true,
            ALWAYS_TRUST_MODE_ENABLED: true,
           
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    });
</script> 