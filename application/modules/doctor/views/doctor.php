<div class="col-md-12">
    <br> <br> <br>
    <div class="card">
        <div class="card-body">

            <header class="panel-heading">
                <?php echo lang('doctors'); ?>

                <a data-toggle="modal" href="#myModal">
                    <div class="btn-group pull-right">
                        <button id="" class="btn green btn-xs">
                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                        </button>
                    </div>
                </a>

            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample" style="">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <style>
                                .img_url {
                                    height: 20px;
                                    width: 20px;
                                    background-size: contain;
                                    max-height: 20px;
                                    border-radius: 100px;
                                }
                            </style>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!--footer start-->






    <!-- Add Accountant Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"> <?php echo lang('add_new_doctor'); ?></h4>
                </div>
                <div class="modal-body row">
                    <form role="form" action="doctor/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('profile'); ?></label>
                            <input type="text" class="form-control" name="profile" id="exampleInputEmail1" value='' placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                            <select name="status" class="form-control">
                            <option value=''>Selecione uma opção</option>
                                <option value="active">Ativo</option>
                                <option value="desactive" selected>Desativado</option>
                            </select>
                            <input type="text" class="form-control" name="status" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group last col-md-6">
                            <label class="control-label">Image Upload</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="default" name="img_url" />
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Add Accountant Modal-->







    <!-- Edit Event Modal-->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"> <?php echo lang('edit_doctor'); ?></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('profile'); ?></label>
                            <input type="text" class="form-control" name="profile" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('cpf'); ?></label>
                            <input type="text" class="form-control" name="cpf" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('cellphone'); ?></label>
                            <input type="text" class="form-control" name="cellphone" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('postal_code'); ?></label>
                            <input type="text" class="form-control" name="postal_code" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('country'); ?></label>
                            <input type="text" class="form-control" name="country" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('state'); ?></label>
                            <input type="text" class="form-control" name="state" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('city'); ?></label>
                            <input type="text" class="form-control" name="city" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('district'); ?></label>
                            <input type="text" class="form-control" name="district" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('complement'); ?></label>
                            <input type="text" class="form-control" name="complement" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('number'); ?></label>
                            <input type="text" class="form-control" name="number" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('date_of_birth'); ?></label>
                            <input type="text" class="form-control" name="date_of_birth" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('biography'); ?></label>
                            <input type="text" class="form-control" name="biography" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('crp'); ?></label>
                            <input type="text" class="form-control" name="crp" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('specialties'); ?></label>
                            <input type="text" class="form-control" name="specialties" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('facebook'); ?></label>
                            <input type="text" class="form-control" name="facebook" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('instagram'); ?></label>
                            <input type="text" class="form-control" name="instagram" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('linkedin'); ?></label>
                            <input type="text" class="form-control" name="linkedin" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('recipient_doctor'); ?></label>
                            <input type="text" class="form-control" name="recipient_id" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('amount_to_pay'); ?></label>
                            <input type="text" class="form-control" name="amount_to_pay" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                        <input type="text" disabled class="form-control" name="status" id="exampleInputEmail1" value='' placeholder="">
                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                            <select name="status" class="form-control">
                            <option value=''>Selecione uma opção</option>
                                <option value="active">Ativo</option>
                                <option value="desactive" >Desativado</option>
                            </select>
                        </div>
                        <div class="form-group last col-md-6">
                            <label class="control-label">Image Upload</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="default" name="img_url" />
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <input type="hidden" name="id" value=''>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Edit Event Modal-->



    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"> <?php echo lang('doctor'); ?> <?php echo lang('info'); ?></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">

                        <div class="form-group last col-md-6">
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img1" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                            <div class="nameClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                            <div class="emailClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                            <div class="addressClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                            <div class="phoneClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('profile'); ?></label>
                            <div class="profileClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('cpf'); ?></label>
                            <div class="cpfClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('cellphone'); ?></label>
                            <div class="cellphoneClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('postal_code'); ?></label>
                            <div class="postal_codeClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('country'); ?></label>
                            <div class="countryClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('state'); ?></label>
                            <div class="stateClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('city'); ?></label>
                            <div class="cityClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('district'); ?></label>
                            <div class="districtClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('complement'); ?></label>
                            <div class="complementClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('number'); ?></label>
                            <div class="numberClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('date_of_birth'); ?></label>
                            <div class="date_of_birthClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('biography'); ?></label>
                            <div class="biographyClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('crp'); ?></label>
                            <div class="crpClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('specialties'); ?></label>
                            <div class="specialtiesClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('facebook'); ?></label>
                            <div class="facebookClass"></div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('instagram'); ?></label>
                            <div class="instagramClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('linkedin'); ?></label>
                            <div class="linkedinClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('recipient_id'); ?></label>
                            <div class="recipient_idClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('amount_to_pay'); ?></label>
                            <div class="amount_to_payClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                            <div class="statusClass"></div>
                        </div>


                    </form>

                </div>
            </div><!-- /.modal-content -->
            <!-- /.modal-dialog -->

        </div>
    </div>



    <script src="common/js/codearistos.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".table").on("click", ".editbutton", function() {
                // EDITAR DOCTOR
                var iid = $(this).attr('data-id');
                $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
                $('#editDoctorForm').trigger("reset");
                $.ajax({
                    url: 'doctor/editDoctorByJason?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function(response) {
                    // Populate the form fields with the data returned from server
                    $('#editDoctorForm').find('[name="id"]').val(response.doctor.id).end()
                    $('#editDoctorForm').find('[name="name"]').val(response.doctor.name).end()
                    $('#editDoctorForm').find('[name="password"]').val(response.doctor.password).end()
                    $('#editDoctorForm').find('[name="email"]').val(response.doctor.email).end()
                    $('#editDoctorForm').find('[name="address"]').val(response.doctor.address).end()
                    $('#editDoctorForm').find('[name="phone"]').val(response.doctor.phone).end()
                    $('#editDoctorForm').find('[name="profile"]').val(response.doctor.profile).end()
                    $('#editDoctorForm').find('[name="cpf"]').val(response.doctor.cpf).end()
                    $('#editDoctorForm').find('[name="cellphone"]').val(response.doctor.cellphone).end()
                    $('#editDoctorForm').find('[name="postal_code"]').val(response.doctor.postal_code).end()
                    $('#editDoctorForm').find('[name="country"]').val(response.doctor.country).end()
                    $('#editDoctorForm').find('[name="state"]').val(response.doctor.state).end()
                    $('#editDoctorForm').find('[name="city"]').val(response.doctor.city).end()
                    $('#editDoctorForm').find('[name="district"]').val(response.doctor.district).end()
                    $('#editDoctorForm').find('[name="address"]').val(response.doctor.address).end()
                    $('#editDoctorForm').find('[name="complement"]').val(response.doctor.complement).end()
                    $('#editDoctorForm').find('[name="number"]').val(response.doctor.number).end()
                    $('#editDoctorForm').find('[name="date_of_birth"]').val(response.doctor.date_of_birth).end()
                    $('#editDoctorForm').find('[name="biography"]').val(response.doctor.biography).end()
                    $('#editDoctorForm').find('[name="crp"]').val(response.doctor.crp).end()
                    $('#editDoctorForm').find('[name="specialties"]').val(response.doctor.specialties).end()
                    $('#editDoctorForm').find('[name="facebook"]').val(response.doctor.facebook).end()
                    $('#editDoctorForm').find('[name="instagram"]').val(response.doctor.instagram).end()
                    $('#editDoctorForm').find('[name="linkedin"]').val(response.doctor.linkedin).end()
                    $('#editDoctorForm').find('[name="recipient_id"]').val(response.doctor.recipient_id).end()
                    $('#editDoctorForm').find('[name="amount_to_pay"]').val(response.doctor.amount_to_pay).end()
                    $('#editDoctorForm').find('[name="status"]').val(response.doctor.status).end()


                    if (typeof response.doctor.img_url !== 'undefined' && response.doctor.img_url != '') {
                        $("#img").attr("src", response.doctor.img_url);
                    }


                    $('#myModal2').modal('show');

                });
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".table").on("click", ".inffo", function() {
                // VISUALIZAR DOCTOR 
                var iid = $(this).attr('data-id');

                $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
                $('.nameClass').html("").end()
                $('.emailClass').html("").end()
                $('.addressClass').html("").end()
                $('.phoneClass').html("").end()
                $('.profileClass').html("").end()
                $('.cpfClass').html("").end()
                $('.cellphoneClass').html("").end()
                $('.postal_codeClass').html("").end()
                $('.countryClass').html("").end()
                $('.stateClass').html("").end()
                $('.cityClass').html("").end()
                $('.districtClass').html("").end()
                $('.addressClass').html("").end()
                $('.complementClass').html("").end()
                $('.numberClass').html("").end()
                $('.date_of_birthClass').html("").end()
                $('.biographyClass').html("").end()
                $('.crpClass').html("").end()
                $('.specialtiesClass').html("").end()
                $('.facebookClass').html("").end()
                $('.instagramClass').html("").end()
                $('.linkedinClass').html("").end()
                $('.recipient_idClass').html("").end()
                $('.amount_to_payClass').html("").end()
                $('.statusClass').html("").end()
                $.ajax({
                    url: 'doctor/editDoctorByJason?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function(response) {
                    // Populate the form fields with the data returned from server
                    $('#editDoctorForm').find('[name="id"]').val(response.doctor.id).end()
                    $('.nameClass').append(response.doctor.name).end()
                    $('.emailClass').append(response.doctor.email).end()
                    $('.addressClass').append(response.doctor.address).end()
                    $('.phoneClass').append(response.doctor.phone).end()
                    $('.profileClass').append(response.doctor.profile).end()
                    $('.cpfClass').append(response.doctor.cpf).end()
                    $('.cellphoneClass').append(response.doctor.cellphone).end()
                    $('.postal_codeClass').append(response.doctor.postal_code).end()
                    $('.countryClass').append(response.doctor.country).end()
                    $('.stateClass').append(response.doctor.state).end()
                    $('.cityClass').append(response.doctor.city).end()
                    $('.districtClass').append(response.doctor.district).end()
                    $('.addressClass').append(response.doctor.address).end()
                    $('.complementClass').append(response.doctor.complement).end()
                    $('.numberClass').append(response.doctor.number).end()
                    $('.date_of_birthClass').append(response.doctor.date_of_birth).end()
                    $('.biographyClass').append(response.doctor.biography).end()
                    $('.crpClass').append(response.doctor.crp).end()
                    $('.specialtiesClass').append(response.doctor.specialties).end()
                    $('.facebookClass').append(response.doctor.facebook).end()
                    $('.instagramClass').append(response.doctor.instagram).end()
                    $('.linkedinClass').append(response.doctor.linkedin).end()
                    $('.recipient_idClass').append(response.doctor.recipient_id).end()
                    $('.amount_to_payClass').append(response.doctor.amount_to_pay).end()
                    $('.statusClass').append(response.doctor.status).end()


                    if (typeof response.doctor.img_url !== 'undefined' && response.doctor.img_url != '') {
                        $("#img1").attr("src", response.doctor.img_url);
                    }

                    $('#infoModal').modal('show');

                });
            });
        });
    </script>





    <script>
        $(document).ready(function() {
            var table = $('#editable-sample').DataTable({
                responsive: true,

                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": {
                    url: "doctor/getDoctor",
                    type: 'POST',
                },
                scroller: {
                    loadingIndicator: true
                },

                dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],
                        }
                    },
                ],
                aLengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                iDisplayLength: 100,
                "order": [
                    [0, "desc"]
                ],

                "language": {
                    "lengthMenu": "_MENU_",
                    search: "_INPUT_",
                    "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                }
            });
            table.buttons().container().appendTo('.custom_buttons');
        });
    </script>




    <script>
        $(document).ready(function() {
            $(".flashmessage").delay(3000).fadeOut(100);
        });
    </script>