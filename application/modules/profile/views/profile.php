<!--sidebar end-->
<!--main content start-->

<div class="container-fluid py-4">
        <!-- page start-->
        <div class="row">
        <div class="col-md-8">
            <div class="card">
            <div class="card-body">
        <div class="row">
         
    
            <section class="panel">
                <header class="panel-heading">
                    <?php echo lang('manage_profile'); ?>
                </header>
                <div class="panel-body">
             
                   

                            <?php echo validation_errors(); ?>
                            <form role="form" action="profile/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="adv-table editable-table ">
                        <div class="clearfix">
                        <div class="col-md-6 form-group">                            
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                <input  class="form-control"  type="file" name="img_url">
                            </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                    if (!empty($profile->username)) {
                                        echo $profile->username;
                                    }
                                    ?>' placeholder="">
                                </div>
                                
                                <div class=" col-md-6 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('change_password'); ?></label>
                                    <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                    if (!empty($profile->email)) {
                                        echo $profile->email;
                                    }
                                    ?>' placeholder="">
                                </div>
                                <div class=" col-md-6 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('crp'); ?></label>
                                    <input type="text" class="form-control" name="crp" id="crp" value='<?php
                                    if (!empty($doctor->crp)) {
                                        echo $doctor->crp;
                                    }
                                    ?>' placeholder="<?php
                                    if (!empty($doctor->crp)) {
                                        echo $doctor->crp;
                                    }
                                    ?>">
                                 
                                </div>
                                <div class=" col-md-6 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                    <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                    if (!empty($doctor->phone)) {
                                        echo $doctor->phone;
                                    }
                                    ?>'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('amount_to_pay'); ?></label>
                                    <input type="number" class="form-control" name="amount_to_pay" id="amount_to_pay" value='<?php
                                    if (!empty($doctor->amount_to_pay)) {
                                        echo $doctor->amount_to_pay;
                                    }
                                    ?>'>
                                </div>
                               
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('date_of_birth'); ?></label>
                                    <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value='<?php
                                    if (!empty($doctor->date_of_birth)) {
                                        echo $doctor->date_of_birth;
                                    }
                                    ?>'>
                                </div>
                               
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('instagram'); ?></label>
                                    <input type="text" class="form-control" name="instagram" id="instagram" value='<?php
                                    if (!empty($doctor->instagram)) {
                                        echo $doctor->instagram;
                                    }
                                    ?>'>
                                </div>
                                
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('facebook'); ?></label>
                                    <input type="text" class="form-control" name="facebook" id="facebook" value='<?php
                                    if (!empty($doctor->facebook)) {
                                        echo $doctor->facebook;
                                    }
                                    ?>'>
                                </div>
                              
                                <div class=" col-md-12 ">
                                    <label for="exampleInputEmail1"><?php echo lang('specialties'); ?>, Por favor separe às especialidades por virgulas</label>
                                    <textarea style="min-height: 80px;"  class="form-control" name="specialties" id="specialties" rows="10" ><?php
                                    if (!empty($doctor->specialties)) {
                                        echo $doctor->specialties;
                                    }
                                    ?></textarea>
                                </div>
                               
                                <div class=" col-md-12 ">
                                    <label for="exampleInputEmail1"><?php echo lang('biography'); ?></label>
                                    <textarea style="min-height: 80px;"  class="form-control" name="biography" id="biography" rows="10" ><?php
                                    if (!empty($doctor->biography)) {
                                        echo $doctor->biography;
                                    }
                                    ?></textarea>
                                </div>
                                </div></div></div>
                                <div class="adv-table editable-table ">
                        <div class="clearfix">

                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                    <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                    if (!empty($doctor->address)) {
                                        echo $doctor->address;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('postal_code'); ?></label>
                                    <input type="text" class="form-control" name="postal_code" id="address" value='<?php
                                    if (!empty($doctor->postal_code)) {
                                        echo $doctor->postal_code;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('country'); ?></label>
                                    <input type="text" class="form-control" name="country" id="country" value='<?php
                                    if (!empty($doctor->postal_code)) {
                                        echo $doctor->postal_code;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('state'); ?></label>
                                    <input type="text" class="form-control" name="state" id="state" value='<?php
                                    if (!empty($doctor->state)) {
                                        echo $doctor->state;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('city'); ?></label>
                                    <input type="text" class="form-control" name="city" id="city" value='<?php
                                    if (!empty($doctor->state)) {
                                        echo $doctor->state;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('district'); ?></label>
                                    <input type="text" class="form-control" name="district" id="district" value='<?php
                                    if (!empty($doctor->district)) {
                                        echo $doctor->district;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('complement'); ?></label>
                                    <input type="text" class="form-control" name="complement" id="complement" value='<?php
                                    if (!empty($doctor->complement)) {
                                        echo $doctor->complement;
                                    }
                                    ?>'>
                                </div>
                                <div class=" col-md-4 form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('number'); ?></label>
                                    <input type="text" class="form-control" name="number" id="number" value='<?php
                                    if (!empty($doctor->number)) {
                                        echo $doctor->number;
                                    }
                                    ?>'>
                                </div>

                               
                               
                                <input type="hidden" name="id" value='<?php
                                if (!empty($profile->id)) {
                                    echo $profile->id;
                                }
                                ?>'>
                                </div>
                                <div class="col-md-4 form-group">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
