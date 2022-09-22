<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
                <div class="tab-content">         
                   <div id="all" class="tab-pane active">
                        <div class="">
                            <div class="panel-body">
                                <div class="adv-table editable-table ">

                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample5" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th> <?php echo lang('id'); ?></th>
                                                <th> <?php echo lang('client'); ?></th>      
                                                <th> <?php echo lang('client'); ?></th>    
                                                <th> <?php echo lang('client'); ?></th>                                           
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



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
          </section>
          <div class="modal fade" tabindex="-1" role="dialog" id="cmodal">
            <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
                <div class="modal-content">
                  <div class="card">
                    <!--
                    <div class="modal-header">
                        <h5 class="modal-title">Paciente História</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    -->
                    </div>
                    <div class="card">
                    <div class="card-body">
                    <div id='client_history'>
                        <div class="col-md-12">
                    
                        </div> 
                        </div> 
                    </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".editbutton", function () {
            // e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            var id = $(this).attr('data-id');

            $('#editAppointmentForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'appointment/editAppointmentByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var de = response.appointment.date * 1000;
                var d = new Date(de);
                var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                // Populate the form fields with the data returned from server
                $('#editAppointmentForm').find('[name="id"]').val(response.appointment.id).end()
                $('#editAppointmentForm').find('[name="client"]').val(response.appointment.client).end()
                $('#editAppointmentForm').find('[name="teacher"]').val(response.appointment.teacher).end()
                $('#editAppointmentForm').find('[name="date"]').val(da).end()
                $('#editAppointmentForm').find('[name="status"]').val(response.appointment.status).end()
                $('#editAppointmentForm').find('[name="remarks"]').val(response.appointment.remarks).end()

                //$('.js-example-basic-single.teacher').val(response.appointment.teacher).trigger('change');
                // $('.js-example-basic-single.client').val(response.appointment.client).trigger('change');
                var option = new Option(response.client.name + '-' + response.client.id, response.client.id, true, true);
                $('#editAppointmentForm').find('[name="client"]').append(option).trigger('change');
                var option1 = new Option(response.teacher.name + '-' + response.teacher.id, response.teacher.id, true, true);
                $('#editAppointmentForm').find('[name="teacher"]').append(option1).trigger('change');



                var date = $('#date1').val();
                var teacherr = $('#ateachers1').val();
                var appointment_id = $('#appointment_id').val();
                // $('#default').trigger("reset");
                $.ajax({
                    url: 'schedule/getAvailableSlotByteacherByDateByAppointmentIdByJason?date=' + date + '&teacher=' + teacherr + '&appointment_id=' + appointment_id,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function (response) {
                    $('#aslots1').find('option').remove();
                    var slots = response.aslots;
                    $.each(slots, function (key, value) {
                        $('#aslots1').append($('<option>').text(value).val(value)).end();
                    });

                    $("#aslots1").val(response.current_value)
                            .find("option[value=" + response.current_value + "]").attr('selected', true);
                    //  $('#aslots1 option[value=' + response.current_value + ']').attr("selected", "selected");
                    //   $("#default-step-1 .button-next").trigger("click");
                    if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                        $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                    }
                    // Populate the form fields with the data returned from server
                    //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
                });
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".history", function () {

            //e.preventDefault(e);
            // Get the record's ID via attribute   
            var iid = $(this).attr('data-id');
            //var id = $(this).attr('data-id');
            console.log(iid);
            $('#editAppointmentForm').trigger("reset");
            $.ajax({
                url: 'client/getclientHistoryByjason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                $('#client_history').html("");
                $('#client_history').append(response.view);

            });
            $('#cmodal').modal('show');
        });
    });
</script>



<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == 'add_new') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script>










<script type="text/javascript">
    $(document).ready(function () {
        $("#ateachers").change(function () {
            // Get the record's ID via attribute  
            var iid = $('#date').val();
            var teacherr = $('#ateachers').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByteacherByDateByJason?date=' + iid + '&teacher=' + teacherr,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
            });
        });

    });

    $(document).ready(function () {
        var iid = $('#date').val();
        var teacherr = $('#ateachers').val();
        $('#aslots').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByteacherByDateByJason?date=' + iid + '&teacher=' + teacherr,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    });




    $(document).ready(function () {
        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        })
                //Listen for the change even on the input
                .change(dateChanged)
                .on('changeDate', dateChanged);
    });

    function dateChanged() {
        // Get the record's ID via attribute  
        var iid = $('#date').val();
        var teacherr = $('#ateachers').val();
        $('#aslots').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByteacherByDateByJason?date=' + iid + '&teacher=' + teacherr,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }


            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    }




</script>












<script type="text/javascript">
    $(document).ready(function () {
        $("#ateachers1").change(function () {
            // Get the record's ID via attribute 
            var id = $('#appointment_id').val();
            var date = $('#date1').val();
            var teacherr = $('#ateachers1').val();
            $('#aslots1').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByteacherByDateByAppointmentIdByJason?date=' + date + '&teacher=' + teacherr + '&appointment_id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots1').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
            });
        });
    });

    $(document).ready(function () {
        var id = $('#appointment_id').val();
        var date = $('#date1').val();
        var teacherr = $('#ateachers1').val();
        $('#aslots1').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByteacherByDateByAppointmentIdByJason?date=' + date + '&teacher=' + teacherr + '&appointment_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    });




    $(document).ready(function () {
        $('#date1').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        })
                //Listen for the change even on the input
                .change(dateChanged1)
                .on('changeDate', dateChanged1);
    });

    function dateChanged1() {
        // Get the record's ID via attribute  
        var id = $('#appointment_id').val();
        var iid = $('#date1').val();
        var teacherr = $('#ateachers1').val();
        $('#aslots1').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByteacherByDateByAppointmentIdByJason?date=' + iid + '&teacher=' + teacherr + '&appointment_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }


            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    }




</script>

<script>
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable
                    .tables({visible: true, api: true})
                    .columns.adjust()
                    .responsive.recalc();
        });
    });
</script>


<script>


    $(document).ready(function () {
        var table = $('#editable-sample5').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "appointment/getAppoinmentList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
                {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>
<script>


    $(document).ready(function () {
        var table = $('#editable-sample6').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "appointment/getRequestedAppointmentList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'print', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>

<script>


    $(document).ready(function () {
        var table = $('#editable-sample1').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "appointment/getPendingAppoinmentList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'print', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>
<script>


    $(document).ready(function () {
        var table = $('#editable-sample2').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "appointment/getConfirmedAppoinmentList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'print', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>

<script>


    $(document).ready(function () {
        var table = $('#editable-sample3').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "appointment/getTreatedAppoinmentList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'print', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>

<script>


    $(document).ready(function () {
        var table = $('#editable-sample4').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "appointment/getCancelledAppoinmentList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'excelHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'csvHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
                {extend: 'print', exportOptions: {columns: [0, 0, 1, 2, 3, 4, 5, 5], }},
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
<script>
    $(document).ready(function () {
        $("#pos_select").select2({
            placeholder: '<?php echo lang('select_client'); ?>',
            allowClear: true,
            ajax: {
                url: 'client/getclientinfoWithAddNewOption',
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
        $(".client").select2({
            placeholder: '<?php echo lang('select_client'); ?>',
            allowClear: true,
            ajax: {
                url: 'client/getclientinfo',
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
        $("#ateachers").select2({
            placeholder: '<?php echo lang('select_teacher'); ?>',
            allowClear: true,
            ajax: {
                url: 'teacher/getteacherInfo',
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
        $("#ateachers1").select2({
            placeholder: '<?php echo lang('select_teacher'); ?>',
            allowClear: true,
            ajax: {
                url: 'teacher/getteacherInfo',
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