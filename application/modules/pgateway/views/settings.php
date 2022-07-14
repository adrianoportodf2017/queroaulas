<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-8 row">
            <section class="col-md-10 row">
                <header class="panel-heading">
                    <?php
                    if (!empty($settings->name)) {
                        echo $settings->name;
                    }
                    ?> <?php echo lang('settings'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="pgateway/addNewSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('payment_gateway'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                    if (!empty($settings->name)) {
                                        echo $settings->name;
                                    }
                                    ?>' placeholder="" readonly>   
                                </div>
                                <?php if ($settings->name == "Pay U Money") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?> </label>
                                        <input type="text" class="form-control" name="merchant_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->merchant_key)) {
                                            echo $settings->merchant_key;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('salt'); ?> </label>
                                        <input type="text" class="form-control" name="salt" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->salt)) {
                                            echo $settings->salt;
                                        }
                                        ?>'>
                                    </div
                                <?php } ?>

                                <?php if ($settings->name == "Pagarme") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('enable'); ?> </label>
                                        <div class="">
                                        <select class="form-control" name="active" id="active">
                                            <option value="0" <?=($settings->active == '0')?'selected':''?> ><?php echo lang('disable'); ?></option>
                                            <option value="1" <?=($settings->active == '1')?'selected':''?> ><?php echo lang('enable'); ?></option>
                                        </select>
                                        </div>                                      
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('public_api_key'); ?> </label>
                                        <input type="text" class="form-control" name="public_api_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->public_api_key)) {
                                            echo $settings->public_api_key;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('encrypted_public_key'); ?> </label>
                                        <input type="text" class="form-control" name="encrypted_public_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->encrypted_public_key)) {
                                            echo $settings->encrypted_public_key;
                                        }
                                        ?>" placeholder="">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('test_api_key'); ?> </label>
                                        <input type="text" class="form-control" name="test_api_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->test_api_key)) {
                                            echo $settings->test_api_key;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('encrypted_test_key'); ?> </label>
                                        <input type="text" class="form-control" name="encrypted_test_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->encrypted_test_key)) {
                                            echo $settings->encrypted_test_key;
                                        }
                                        ?>" placeholder="">
                                    </div>   
                                    <h5>Configuração forma de pagamento</h5>
                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="free_installments"><?php echo lang('free_installments'); ?></label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="free_installments" id="free_installments" value="<?php
                                        if (!empty($settings->free_installments)) {
                                            echo $settings->free_installments;
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="max_installments"><?php echo lang('max_installments'); ?></label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="max_installments" id="max_installments"  value="<?php
                                        if (!empty($settings->max_installments)) {
                                            echo $settings->max_installments;
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="interest_rate"><?php echo lang('interest_rate'); ?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="interest_rate" id="interest_rate" value="<?php
                                        if (!empty($settings->interest_rate)) {
                                            echo $settings->interest_rate;
                                        }
                                        ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                                                       <div class="col-md-8">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="enable_card_cred" id="enable_card_cred" value="1" <?php if ($settings->enable_card_cred == 1) echo 'checked'; ?>>
                                            <label class="custom-control-label" for="enable_card_cred"><?php echo lang('enable_card_cred'); ?></label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-10">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="enable_slip" id="enable_slip" value="1" <?php if ($settings->enable_slip == 1) echo 'checked'; ?>>
                                            <label class="custom-control-label" for="enable_slip"><?php echo lang('enable_slip'); ?></label>
                                        </div>
                                    </div> </div>  
                                    <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="percentage_doctor"><?php echo lang('percentage_doctor'); ?></label>
                                    <div class="col-md-10">
                                            <input type="text" class="form-control" name="percentage_doctor" id="percentage_doctor" value="<?php
                                        if (!empty($settings->percentage_doctor)) {
                                            echo $settings->percentage_doctor;  }
                                        ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label"  for="percentage"><?php echo lang('percentage'); ?></label>
                                    <div class="col-md-10">
                                            <input type="text" class="form-control" name="percentage" id="percentage" value="<?php
                                        if (!empty($settings->percentage)) {
                                            echo $settings->percentage;  }
                                        ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label"  for="recipient_id"><?php echo lang('recipient_id'); ?></label>
                                    <div class="col-md-10">
                                    <input type="text" class="form-control" name="recipient_id" id="recipient_id" value="<?php
                                        if (!empty($settings->recipient_id)) {
                                            echo $settings->recipient_id;  }
                                        ?>" >
                                        </div>
                                    </div>
                                  
                                
                                
                                </div> 
                                    <hr>                             
                           
                                <?php } ?>
                                <?php if ($settings->name == "Authorize.Net") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('apiloginid'); ?> </label>
                                        <input type="text" class="form-control" name="apiloginid" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->apiloginid)) {
                                            echo $settings->apiloginid;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('transactionkey'); ?> </label>
                                        <input type="text" class="form-control" name="transactionkey" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->transactionkey)) {
                                            echo $settings->transactionkey;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <!--   <div class="form-group">
                                           <label for="exampleInputEmail1"> <?php echo lang('key'); ?> </label>
                                           <input type="text" class="form-control" name="apikey" id="exampleInputEmail1" value="<?php
                                    if (!empty($settings->apikey)) {
                                        echo $settings->apikey;
                                    }
                                    ?>" placeholder="">
                                       </div> -->
                                <?php } ?>
                                <?php if ($settings->name == "Paytm") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?> </label>
                                        <input type="text" class="form-control" name="merchant_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->merchant_key)) {
                                            echo $settings->merchant_key;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_mid'); ?> </label>
                                        <input type="text" class="form-control" name="merchant_mid" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->merchant_mid)) {
                                            echo $settings->merchant_mid;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_website'); ?> </label>
                                        <input type="text" class="form-control" name="merchant_website" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->merchant_website)) {
                                            echo $settings->merchant_website;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == "Paystack") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?> </label>
                                        <input type="text" class="form-control" name="secret" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->secret)) {
                                            echo $settings->secret;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('public_key'); ?> </label>
                                        <input type="text" class="form-control" name="public_key" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->public_key)) {
                                            echo $settings->public_key;
                                        }
                                        ?>'>
                                    </div
                                <?php } ?>
                                <?php if ($settings->name == "PayPal") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('api_username'); ?> </label>
                                        <input type="text" class="form-control" name="APIUsername" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->APIUsername)) {
                                            echo $settings->APIUsername;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_password'); ?> </label>
                                        <input type="text" class="form-control" name="APIPassword" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->APIPassword)) {
                                            echo $settings->APIPassword;
                                        }
                                        ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_signature'); ?> </label>
                                        <input type="text" class="form-control" name="APISignature" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->APISignature)) {
                                            echo $settings->APISignature;
                                        }
                                        ?>'>
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == "2Checkout") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('merchantcode'); ?> </label>
                                        <input type="text" class="form-control" name="merchantcode" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->merchantcode)) {
                                            echo $settings->merchantcode;
                                        }
                                        ?>'>
                                    </div
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('privatekey'); ?> </label>
                                        <input type="text" class="form-control" name="privatekey" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->privatekey)) {
                                            echo $settings->privatekey;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('publishablekey'); ?> </label>
                                        <input type="text" class="form-control" name="publishablekey" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->publishablekey)) {
                                            echo $settings->publishablekey;
                                        }
                                        ?>" placeholder="">
                                    </div>

                                <?php } ?>
                                <?php if ($settings->name == "SSLCOMMERZ") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('store_id'); ?> </label>
                                        <input type="text" class="form-control" name="store_id" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->store_id)) {
                                            echo $settings->store_id;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('store_password'); ?> </label>
                                        <input type="text" class="form-control" name="store_password" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->store_password)) {
                                            echo $settings->store_password;
                                        }
                                        ?>'>
                                    </div>

                                <?php } ?>
                                <?php if ($settings->name == "Stripe") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?></label>
                                        <input type="text" class="form-control" name="secret" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->secret)) {
                                            echo $settings->secret;
                                        }
                                        ?>' placeholder="" <?php
                                               if (!$this->ion_auth->in_group('admin')) {
                                                   echo 'disabled';
                                               }
                                               ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('publishkey'); ?></label>
                                        <input type="text" class="form-control" name="publish" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->publish)) {
                                            echo $settings->publish;
                                        }
                                        ?>'>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                    <select class="form-control m-bot15" name="status" value=''>
                                        <option value="live" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'live') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('live'); ?> </option>
                                        <option value="test" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'test') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('test'); ?></option>
                                    </select>
                                </div>
                                    <?php if ($settings->name == "2Checkout") { ?>
                                    
                                    <ul>
                                        <li>
                                            <code>   Available only Live mood .</code>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                    <?php if ($settings->name == "SSLCOMMERZ") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('ipnsettings'); ?></label>
                                        <input type="text" class="form-control" name="" id="exampleInputEmail1" value=' <?php echo base_url(); ?>sslcommerzpayment/success' readonly="">                                 

                                    </div>
                                    <code>
                                        <?php echo "Copy  Ipn_settings to your merchant sslcommerz account. Follow steps below:" ?>
                                        <br><br>
                                        <ul>
                                            <li>>>Login at https://merchant.sslcommerz.com/ (LIVE) and <br>     https://sandbox.sslcommerz.com/manage/(TEST)</li>
                                            <li>>>Click on Menu My Stores > IPN Settings</li>
                                            <li>>>Tick mark Enable HTTP Listener, input above URL in the Box and save settings.</li>
                                        </ul>



                                    </code>
                                <?php } ?>
                                <input type="hidden" name="id" value='<?php
                                if (!empty($settings->id)) {
                                    echo $settings->id;
                                }
                                ?>'>
                                <div class="form-group clearfix">
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

<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>