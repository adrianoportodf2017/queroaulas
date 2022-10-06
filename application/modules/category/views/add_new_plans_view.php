<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-10">
            <header class="panel-heading">
                <?php
                if (!empty($plans->id))
                    echo lang('edit_plans');
                else
                    echo lang('add_new_plan');
                ?>
            </header>
            <div class="panel col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="plans/addNewPlans" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('date');
                                    }
                                    if (!empty($plans->date)) {
                                        echo date('d-m-Y', $prescription->date);
                                    }
                                    ?>' placeholder="" readonly="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title"> <?php echo lang('title'); ?></label>
                                    <input type="text" class="form-control" name="title" id="title" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('title');
                                    }
                                    if (!empty($plans->title)) {
                                        echo $plans->title;
                                    }
                                    ?>' placeholder="">
                                </div> 
                                <div class="form-group col-md-4">
                                    <label for="price"> <?php echo lang('price'); ?></label>
                                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="price" id="price" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('price');
                                    }
                                    if (!empty($plans->price)) {
                                        echo $plans->price;
                                    }
                                    ?>' placeholder="">
                                </div>     
                                <div class="form-group col-md-4">
                                    <label for="discounted_price"> <?php echo lang('discounted_price'); ?></label>
                                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="discounted_price" id="discounted_price" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('discounted_price');
                                    }
                                    if (!empty($plans->discounted_price)) {
                                        echo $plans->discounted_price;
                                    }
                                    ?>' placeholder="">
                                </div>  
                                
                                <div class="form-group col-md-4">
                                    <label for="free_installments"> <?php echo lang('free_installments'); ?></label>
                                    <input type="number" min="1" max="12"  class="form-control" name="free_installments" id="free_installments" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('free_installments');
                                    }
                                    if (!empty($plans->free_installments)) {
                                        echo $plans->free_installments;
                                    }
                                    ?>' placeholder="">
                                </div> 

                                <div class="form-group col-md-4">
                                    <label for="max_installments"> <?php echo lang('max_installments'); ?></label>
                                    <input type="number" min="1" max="12"  class="form-control" name="max_installments" id="max_installments" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('max_installments');
                                    }
                                    if (!empty($plans->max_installments)) {
                                        echo $plans->max_installments;
                                    }
                                    ?>' placeholder="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="interest_rate"> <?php echo lang('interest_rate'); ?></label>
                                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="interest_rate" id="interest_rate" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('interest_rate');
                                    }
                                    if (!empty($plans->interest_rate)) {
                                        echo $plans->interest_rate;
                                    }
                                    ?>' placeholder="">
                                </div>       
                                <div class="form-group col-md-4">
                                <label for="enable_warranty"> <?php echo lang('enable_warranty'); ?></label>
                                            <select class="form-control m-bot15" name="enable_warranty" value=''>
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_warranty == set_value('enable_warranty')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_warranty)) {
                                                    if ($plans->enable_warranty == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_warranty == set_value('enable_warranty')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_warranty)) {
                                                    if ($plans->enable_warranty == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>  
                                        <div class="form-group col-md-4">
                                <label for="enable_card_cred"> <?php echo lang('enable_card_cred'); ?></label>
                                            <select class="form-control m-bot15" name="enable_card_cred" value=''>
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_card_cred == set_value('enable_card_cred')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_card_cred)) {
                                                    if ($plans->enable_card_cred == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_card_cred == set_value('enable_card_cred')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_card_cred)) {
                                                    if ($plans->enable_card_cred == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>                     
                               
                                        <div class="form-group col-md-4">
                                <label for="enable_billet"> <?php echo lang('enable_billet'); ?></label>
                                            <select class="form-control m-bot15" name="enable_billet" value=''>
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_billet == set_value('enable_billet')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enableenable_billet_card_cred)) {
                                                    if ($plans->enable_billet == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_billet == set_value('enable_billet')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_billet)) {
                                                    if ($plans->enable_billet == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>
                                       
                                        <div class="form-group col-md-4">
                                        <label for="enable_pix"> <?php echo lang('enable_pix'); ?></label>
                                            <select class="form-control m-bot15" name="enable_pix" value=''>
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_pix == set_value('enable_pix')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_pix)) {
                                                    if ($plans->enable_pix == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($plans->enable_pix == set_value('enable_pix')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($plans->enable_pix)) {
                                                    if ($plans->enable_pix == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>

                              <div class="form-group col-md-4">
                                    <label for="payment_gateway"> <?php echo lang('payment_gateway'); ?></label>
                                    <select class="form-control m-bot15" id="paymentgateway_id" name="paymentgateway_id" >
                                        <?php if (!empty($plans->paymentgateway_id)) { 
                                            $payment_gateway = $this->db->get_where('paymentgateway', array('id' => $plans->paymentgateway_id));
                                        ?>
                                            <option value="<?php echo $paymentgateway_id; ?>" selected="selected"><?php echo $payment_gateway->name; ?> - (<?php echo lang('id'); ?> : <?php echo $paymentgateway_id; ?>)</option>  
                                        <?php } ?>
                                        <?php
                                        if (!empty($setval)) { 
                                            $payment_gateway = $this->db->get_where('paymentgateway', array('id' => $plans->paymentgateway_id));
                                        ?>
                                            <option value="<?php echo $paymentgateway_id; ?>" selected="selected"><?php echo $payment_gateway->name; ?> - (<?php echo lang('id'); ?> : <?php echo $paymentgateway_id; ?>)</option>  
                                        <?php } ?>
                                        <?php foreach ($pgateways as $pgateway){?>
                                        <option value="<?php echo $pgateway->id; ?>"><?php echo $pgateway->name; ?> - (<?php echo lang('id'); ?> : <?php echo $pgateway->id; ?>)</option>  
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                            <label for="exampleInputEmail1">Imagem</label>
                                            <input type="file" name="img_url">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label"><?php echo lang('description'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor1" name="description" value="" rows="50" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('description');
                                        }
                                        if (!empty($plans->description)) {
                                            echo $plans->description;
                                        }
                                        ?></textarea>
                                </div>
                                  <input type="hidden" name="admin" value='admin'>

                                <input type="hidden" name="id" value='<?php
                                if (!empty($plans->id)) {
                                    echo $plans->d;
                                }
                                ?>'>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </div>

                            <div class="col-md-5">

                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<style>

    form{
        border: 0px;
    }

    .med_selected{
        background: #fff;
        padding: 10px 0px;
        margin: 5px;
    }


    .select2-container--bgform .select2-selection--multiple .select2-selection__choice {
        clear: both !important;
    }

    label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: 500;
        font-weight: bold;
    }

    .medicine_block{
        background: #f1f2f7;
        padding: 50px !important;
    }
    
    form input{
        text-align: left;
    }
    
    .medi_div{
        float: left !important;
    }


</style>


<script src="common/js/codearistos.min.js"></script>







<script type="text/javascript">
    $(document).ready(function () {
        //   $(".medicine").html("");
        var selected = $('#my_select1_disabled').find('option:selected');
        var unselected = $('#my_select1_disabled').find('option:not(:selected)');
        selected.attr('data-selected', '1');
        $.each(unselected, function (index, value1) {
            if ($(this).attr('data-selected') == '1') {
                var value = $(this).val();
                var res = value.split("*");
                // var unit_price = res[1];
                var id = res[0];
                $('#med_selected_section-' + id).remove();
                // $('#removediv' + $(this).val() + '').remove();
                //this option was selected before

            }
        });

        /* $("select").on("select2:unselect", function (e) {
         var value = e.params.val();
         
         var res = value.split("*");
         // var unit_price = res[1];
         var id = res[0];
         $('#med_selected_section-' + id).remove();
         });
         */


        var count = 0;
        $.each($('select.medicinee option:selected'), function () {
            var value = $(this).val();
            var res = value.split("*");
            // var unit_price = res[1];
            var id = res[0];
            // var id = $(this).data('id');
            var med_id = res[0];
            var med_name = res[1];
            var dosage = $(this).data('dosage');
            var frequency = $(this).data('frequency');
            var days = $(this).data('days');
            var instruction = $(this).data('instruction');
            if ($('#med_id-' + id).length)
            {

            } else {

                $(".medicine").append('<section id="med_selected_section-' + med_id + '" class="med_selected row">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
 <input type="hidden" id="med_id-' + id + '" class = "medi_div" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "' + dosage + '" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' + count + '" name = "frequency[]" value = "' + frequency + '" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "days[]" value = "' + days + '" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n\<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "instruction[]" value = "' + instruction + '" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>');
            }
        });
    }
    );


</script> 





<script type="text/javascript">
    $(document).ready(function () {
        $('.medicinee').change(function () {
            //   $(".medicine").html("");
            var count = 0;


            var selected = $('#my_select1_disabled').find('option:selected');
            var unselected = $('#my_select1_disabled').find('option:not(:selected)');
            selected.attr('data-selected', '1');
            $.each(unselected, function (index, value1) {
                if ($(this).attr('data-selected') == '1') {
                    var value = $(this).val();
                    var res = value.split("*");
                    // var unit_price = res[1];
                    var id = res[0];
                    $('#med_selected_section-' + id).remove();
                    // $('#removediv' + $(this).val() + '').remove();
                    //this option was selected before

                }
            });

            $.each($('select.medicinee option:selected'), function () {
                var value = $(this).val();
                var res = value.split("*");
                // var unit_price = res[1];
                var id = res[0];
                // var id = $(this).data('id');
                var med_id = res[0];
                var med_name = res[1];


                if ($('#med_id-' + id).length)
                {

                } else {


                    $(".medicine").append('<section class="med_selected row" id="med_selected_section-' + med_id + '">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
 <input type="hidden" class = "medi_div" id="med_id-' + id + '" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' + count + '" name = "frequency[]" value = "" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "days[]" value = "" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n\<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "instruction[]" value = "" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>');
                }
            });
        });
    });


</script> 
<script>
    $(document).ready(function () {

        $("#paymentgateway_isd").select2({
            placeholder: '<?php echo lang('select_payment_gateway'); ?>',
            allowClear: true,
            ajax: {
                url: 'pgateway/getPgatewaytInfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        $("#doctorchoose").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorinfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        $("#doctorchoose1").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorInfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });



    });
</script>

<script>
    $(document).ready(function () {
        // $(".flashmessage").delay(3000).fadeOut(100);
        // $("#my_select10").select2();
        $('#my_select1').select2({
            multiple: true,
            placeholder: '<?php echo lang('medicine'); ?>',
            allowClear: true,
            closeOnSelect: true,
            ajax: {
                url: 'medicine/getMedicinenamelist',
                dataType: 'json',
                type: "post",
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data,
                        newTag: true,
                        pagination: {
                            more: (params.page * 1) < data.total_count
                        }
                    };
                },
                cache: true
            },
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#my_select1_disabled").select2({
            placeholder: '<?php echo lang('medicine'); ?>',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'medicine/getMedicineListForSelect2',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
    });</script>