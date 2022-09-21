
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
<div class="card">
<div class="card-body">
            <header class="panel-heading">
                <i class="fa fa-user"></i>   <?php echo lang('Client'); ?> <?php echo lang('database'); ?>
            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">
                    <div class=" no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                            
                            </div>
                        </a>
                        <button class="btn green export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>


                        <?php
                        if ($this->ion_auth->in_group(array('Teacher'))) {
                            $teacher_ion_id = $this->ion_auth->get_user_id();
                            $teacher_id = $this->teacher_model->getTeacherByIonUserId($teacher_ion_id)->id;
                            //  echo $teacher_id; die();
                        }
                        ?>




                        <?php
                        foreach ($clients as $client) {
                            $client_teachers = explode(',', $client->teacher);
                            if (in_array($teacher_id, $client_teachers)) {
                                ?>
                                <tr class="">
                                    <td> <?php echo $client->id; ?></td>
                                    <td> <?php echo $client->name; ?></td>
                                    <td><?php echo $client->phone; ?></td>


                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                        <td> <?php echo $settings->currency; ?>
                                            <?php
                                            $query = $this->db->get_where('payment', array('client' => $client->id))->result();
                                            $deposits = $this->db->get_where('client_deposit', array('client' => $client->id))->result();
                                            $balance = array();
                                            $deposit_balance = array();
                                            foreach ($query as $gross) {
                                                $balance[] = $gross->gross_total;
                                            }
                                            $balance = array_sum($balance);


                                            foreach ($deposits as $deposit) {
                                                $deposit_balance[] = $deposit->deposited_amount;
                                            }
                                            $deposit_balance = array_sum($deposit_balance);



                                            $bill_balance = $balance;

                                            echo $due_balance = $bill_balance - $deposit_balance;

                                            $due_balance = NULL;
                                            ?>
                                        </td>
                                    <?php } ?>

                                    <td class="no-print">
                                        <a class="btn green" title="<?php echo lang('history'); ?>" href="client/clientHistory?id=<?php echo $client->id; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                   </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add client Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('register_new_client'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="client/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">     
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('teacher'); echo ' - '.$teacher->id; ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <input type="hidden" name="teacher" value="<?php echo $teacher->id; ?>"> 
                                                      </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($client->sex)) {
                                if ($client->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($client->sex)) {
                                if ($client->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($client->sex)) {
                                if ($client->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="">      
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($client->bloodgroup)) {
                                    if ($group->group == $client->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($client->client_id)) {
                        echo $client->client_id;
                    }
                    ?>'>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add client Modal-->







<!-- Edit client Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_client'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editclientForm" action="client/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">     
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('teacher'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <select class="form-control m-bot15 js-example-basic-multiple teacher" multiple="" name="teacher[]" value=''>  
                                        <option value=""> </option> 
                                        <?php foreach ($teachers as $teacher) { ?>
                                            <option value="<?php echo $teacher->id; ?>"><?php echo $teacher->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($client->sex)) {
                                if ($client->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($client->sex)) {
                                if ($client->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($client->sex)) {
                                if ($client->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                        if (!empty($client->birthdate)) {
                            echo $client->birthdate;
                        }
                        ?>" placeholder="">      
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($client->bloodgroup)) {
                                    if ($group->group == $client->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit client Modal-->


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                            $(document).ready(function () {
                                                $(".editbutton").click(function (e) {
                                                    e.preventDefault(e);
                                                    // Get the record's ID via attribute  
                                                    var iid = $(this).attr('data-id');
                                                    $('#editclientForm').trigger("reset");
                                                    $('#myModal2').modal('show');
                                                    $.ajax({
                                                        url: 'client/editclientByJason?id=' + iid,
                                                        method: 'GET',
                                                        data: '',
                                                        dataType: 'json',
                                                    }).success(function (response) {
                                                        // Populate the form fields with the data returned from server

                                                        $('#editclientForm').find('[name="id"]').val(response.client.id).end()
                                                        $('#editclientForm').find('[name="name"]').val(response.client.name).end()
                                                        $('#editclientForm').find('[name="password"]').val(response.client.password).end()
                                                        $('#editclientForm').find('[name="email"]').val(response.client.email).end()
                                                        $('#editclientForm').find('[name="address"]').val(response.client.address).end()
                                                        $('#editclientForm').find('[name="phone"]').val(response.client.phone).end()
                                                        $('#editclientForm').find('[name="sex"]').val(response.client.sex).end()
                                                        $('#editclientForm').find('[name="birthdate"]').val(response.client.birthdate).end()
                                                        $('#editclientForm').find('[name="bloodgroup"]').val(response.client.bloodgroup).end()
                                                        $('#editclientForm').find('[name="p_id"]').val(response.client.client_id).end()

                                                        $('.js-example-basic-multiple.teacher').val(response.appointment.teacher).trigger('change');
                                                    });
                                                });
                                            });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

