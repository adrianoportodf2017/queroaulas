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
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <div class="row text-center">
                                        <div class="col-10 mx-auto">
                                            <h5 class="font-weight-normal">Selecione as Categorias que você da AULA</h5><br>
                                        </div>
                                    </div>
                                    <?php if ($this->session->flashdata('feedback')) { ?><div id="infoMessage" class="alert alert-warning"><?= $this->session->flashdata('feedback') ?></div><?php } ?>

                                    <form role="form" action="profile/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                                        <div class="multisteps-form__content">
                                            <div class="row mt-4">
                                                <?php $categorys = $this->category_model->getCategory();
                                                      $categoriasTeacher =   explode(',', $teacher->specialties);
                                                                           
                                                                            
                                                foreach ($categorys as $category) { ?>
                                                    <div class="col-lg-3">
                                                        <?php
                                                        echo '<b>' . $category->name . '</b>';
                                                        $subCategorys =  $this->category_model->getSubCategory($category->id);
                                                        foreach ($subCategorys as $subCategory) { 
                               
                                                            ?>
                                                      
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="<?= $subCategory->name ?>" id="fcustomCheck1" name="categoria[]" <?php 
                                                                 if(in_array($subCategory->name, $categoriasTeacher)){  echo "checked";}?>>
                                                                <label class="custom-control-label" for="customCheck1"><?= $subCategory->name ?></label>
                                                            </div><?php
                                                                } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                       
                              

                                <div class="adv-table editable-table ">
                                    <div class="clearfix">
                                        <div class="col-md-6 form-group">
                                            <div class="avatar avatar-xl position-relative">
                                                <?php if (!empty($teacher->img_url) && file_exists($teacher->img_url)) { ?>
                                                    <a href="#">
                                                        <img src="<?= base_url() . $teacher->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;">
                                                    </a>
                                                <?php } else {
                                                ?>
                                                    <a href="#">
                                                        <img src="<?= base_url() ?>uploads/semfoto.gif" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;">
                                                    </a><?php } ?>
                                            </div>
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input class="form-control" type="file" name="img_url">
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
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($teacher->phone)) {
                                                                                                                                    echo $teacher->phone;
                                                                                                                                }
                                                                                                                                ?>'>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('amount_to_pay'); ?></label>
                                            <input type="number" class="form-control" name="amount_to_pay" id="amount_to_pay" value='<?php
                                                                                                                                        if (!empty($teacher->amount_to_pay)) {
                                                                                                                                            echo $teacher->amount_to_pay;
                                                                                                                                        }
                                                                                                                                        ?>'>
                                        </div>

                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('date_of_birth'); ?></label>
                                            <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value='<?php
                                                                                                                                    if (!empty($teacher->date_of_birth)) {
                                                                                                                                        echo $teacher->date_of_birth;
                                                                                                                                    }
                                                                                                                                    ?>'>
                                        </div>

                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('instagram'); ?></label>
                                            <input type="text" class="form-control" name="instagram" id="instagram" value='<?php
                                                                                                                            if (!empty($teacher->instagram)) {
                                                                                                                                echo $teacher->instagram;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>

                                        <div class=" col-md-4 form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('facebook'); ?></label>
                                            <input type="text" class="form-control" name="facebook" id="facebook" value='<?php
                                                                                                                            if (!empty($teacher->facebook)) {
                                                                                                                                echo $teacher->facebook;
                                                                                                                            }
                                                                                                                            ?>'>
                                        </div>
                                        <div class=" col-md-12 form-group">
                                            <label for="exampleInputEmail1">Currículo</label>
                                            <textarea style="min-height: 80px;" class="form-control" name="profile" id="profile" rows="10"> <?php
                                                                                                                                            if (!empty($teacher->profile)) {
                                                                                                                                                echo $teacher->profile;
                                                                                                                                            }
                                                                                                                                            ?>
                                    </textarea>

                                        </div>
                                        <div class=" col-md-12 ">
                                            <label for="exampleInputEmail1"><?php echo lang('biography'); ?></label>
                                            <textarea style="min-height: 80px;" class="form-control" name="biography" id="biography" rows="10"><?php
                                                                                                                                                if (!empty($teacher->biography)) {
                                                                                                                                                    echo $teacher->biography;
                                                                                                                                                }
                                                                                                                                                ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adv-table editable-table ">
                                <div class="clearfix">

                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                                                                                                                if (!empty($teacher->address)) {
                                                                                                                                    echo $teacher->address;
                                                                                                                                }
                                                                                                                                ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('postal_code'); ?></label>
                                        <input type="text" class="form-control" name="postal_code" id="postal_code" value='<?php
                                                                                                                            if (!empty($teacher->postal_code)) {
                                                                                                                                echo $teacher->postal_code;
                                                                                                                            }
                                                                                                                            ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('country'); ?></label>
                                        <input type="text" class="form-control" name="country" id="country" value='<?php
                                                                                                                    if (!empty($teacher->country)) {
                                                                                                                        echo $teacher->country;
                                                                                                                    }
                                                                                                                    ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('state'); ?></label>
                                        <input type="text" class="form-control" name="state" id="state" value='<?php
                                                                                                                if (!empty($teacher->state)) {
                                                                                                                    echo $teacher->state;
                                                                                                                }
                                                                                                                ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('city'); ?></label>
                                        <input type="text" class="form-control" name="city" id="city" value='<?php
                                                                                                                if (!empty($teacher->state)) {
                                                                                                                    echo $teacher->state;
                                                                                                                }
                                                                                                                ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('district'); ?></label>
                                        <input type="text" class="form-control" name="district" id="district" value='<?php
                                                                                                                        if (!empty($teacher->district)) {
                                                                                                                            echo $teacher->district;
                                                                                                                        }
                                                                                                                        ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('complement'); ?></label>
                                        <input type="text" class="form-control" name="complement" id="complement" value='<?php
                                                                                                                            if (!empty($teacher->complement)) {
                                                                                                                                echo $teacher->complement;
                                                                                                                            }
                                                                                                                            ?>'>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('number'); ?></label>
                                        <input type="text" class="form-control" name="number" id="number" value='<?php
                                                                                                                    if (!empty($teacher->number)) {
                                                                                                                        echo $teacher->number;
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
                </div>  </div>
                </section>
            </div>
            <!-- page end-->
            </section>
            </section>
            <!--main content end-->
            <!--footer start-->

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $(".flashmessage").delay(3000).fadeOut(100);
                });
            </script>