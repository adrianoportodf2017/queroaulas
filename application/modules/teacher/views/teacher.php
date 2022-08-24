<div class="col-md-12">
    <br> <br> <br>
    <div class="card">
        <div class="card-body">

            <header class="panel-heading">
                <?php echo lang('teachers'); ?>

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
                    <h4 class="modal-title"> <?php echo lang('add_new_teacher'); ?></h4>
                </div>
                <div class="modal-body row">
                    <form role="form" action="teacher/addNew" class="clearfix" method="post" enctype="multipart/form-data">
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
                    <h4 class="modal-title"> <?php echo lang('edit_Teacher'); ?></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="editTeacherForm" class="clearfix" action="teacher/addNew" method="post" enctype="multipart/form-data">
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
                            <label for="exampleInputEmail1"><?php echo lang('recipient_teacher'); ?></label>
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
                    <h4 class="modal-title"> <?php echo lang('teacher'); ?> <?php echo lang('info'); ?></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="editTeacherForm" class="clearfix" action="teacher/addNew" method="post" enctype="multipart/form-data">

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
                $('#editTeacherForm').trigger("reset");
                $.ajax({
                    url: 'teacher/editTeacherByJason?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function(response) {
                    // Populate the form fields with the data returned from server
                    $('#editTeacherForm').find('[name="id"]').val(response.teacher.id).end()
                    $('#editTeacherForm').find('[name="name"]').val(response.teacher.name).end()
                    $('#editTeacherForm').find('[name="password"]').val(response.teacher.password).end()
                    $('#editTeacherForm').find('[name="email"]').val(response.teacher.email).end()
                    $('#editTeacherForm').find('[name="address"]').val(response.teacher.address).end()
                    $('#editTeacherForm').find('[name="phone"]').val(response.teacher.phone).end()
                    $('#editTeacherForm').find('[name="profile"]').val(response.teacher.profile).end()
                    $('#editTeacherForm').find('[name="cpf"]').val(response.teacher.cpf).end()
                    $('#editTeacherForm').find('[name="cellphone"]').val(response.teacher.cellphone).end()
                    $('#editTeacherForm').find('[name="postal_code"]').val(response.teacher.postal_code).end()
                    $('#editTeacherForm').find('[name="country"]').val(response.teacher.country).end()
                    $('#editTeacherForm').find('[name="state"]').val(response.teacher.state).end()
                    $('#editTeacherForm').find('[name="city"]').val(response.teacher.city).end()
                    $('#editTeacherForm').find('[name="district"]').val(response.teacher.district).end()
                    $('#editTeacherForm').find('[name="address"]').val(response.teacher.address).end()
                    $('#editTeacherForm').find('[name="complement"]').val(response.teacher.complement).end()
                    $('#editTeacherForm').find('[name="number"]').val(response.teacher.number).end()
                    $('#editTeacherForm').find('[name="date_of_birth"]').val(response.teacher.date_of_birth).end()
                    $('#editTeacherForm').find('[name="biography"]').val(response.teacher.biography).end()
                    $('#editTeacherForm').find('[name="crp"]').val(response.teacher.crp).end()
                    $('#editTeacherForm').find('[name="specialties"]').val(response.teacher.specialties).end()
                    $('#editTeacherForm').find('[name="facebook"]').val(response.teacher.facebook).end()
                    $('#editTeacherForm').find('[name="instagram"]').val(response.teacher.instagram).end()
                    $('#editTeacherForm').find('[name="linkedin"]').val(response.teacher.linkedin).end()
                    $('#editTeacherForm').find('[name="recipient_id"]').val(response.teacher.recipient_id).end()
                    $('#editTeacherForm').find('[name="amount_to_pay"]').val(response.teacher.amount_to_pay).end()
                    $('#editTeacherForm').find('[name="status"]').val(response.teacher.status).end()


                    if (typeof response.teacher.img_url !== 'undefined' && response.teacher.img_url != '') {
                        $("#img").attr("src", response.teacher.img_url);
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
                    url: 'teacher/editTeacherByJason?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function(response) {
                    // Populate the form fields with the data returned from server
                    $('#editTeacherForm').find('[name="id"]').val(response.teacher.id).end()
                    $('.nameClass').append(response.teacher.name).end()
                    $('.emailClass').append(response.teacher.email).end()
                    $('.addressClass').append(response.teacher.address).end()
                    $('.phoneClass').append(response.teacher.phone).end()
                    $('.profileClass').append(response.teacher.profile).end()
                    $('.cpfClass').append(response.teacher.cpf).end()
                    $('.cellphoneClass').append(response.teacher.cellphone).end()
                    $('.postal_codeClass').append(response.teacher.postal_code).end()
                    $('.countryClass').append(response.teacher.country).end()
                    $('.stateClass').append(response.teacher.state).end()
                    $('.cityClass').append(response.teacher.city).end()
                    $('.districtClass').append(response.teacher.district).end()
                    $('.addressClass').append(response.teacher.address).end()
                    $('.complementClass').append(response.teacher.complement).end()
                    $('.numberClass').append(response.teacher.number).end()
                    $('.date_of_birthClass').append(response.teacher.date_of_birth).end()
                    $('.biographyClass').append(response.teacher.biography).end()
                    $('.crpClass').append(response.teacher.crp).end()
                    $('.specialtiesClass').append(response.teacher.specialties).end()
                    $('.facebookClass').append(response.teacher.facebook).end()
                    $('.instagramClass').append(response.teacher.instagram).end()
                    $('.linkedinClass').append(response.teacher.linkedin).end()
                    $('.recipient_idClass').append(response.teacher.recipient_id).end()
                    $('.amount_to_payClass').append(response.teacher.amount_to_pay).end()
                    $('.statusClass').append(response.teacher.status).end()


                    if (typeof response.teacher.img_url !== 'undefined' && response.teacher.img_url != '') {
                        $("#img1").attr("src", response.teacher.img_url);
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
                    url: "teacher/getTeacher",
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