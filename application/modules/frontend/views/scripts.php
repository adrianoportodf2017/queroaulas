<script src="<?= base_url() ?>assets/payment/js/vendor.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/payment/js/sweetalert.min.js"></script><!--   Core JS Files   -->
<script src="<?php echo site_url('front/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>

<!-- Bootstrap core JavaScript  -->
<script src="<?php echo site_url('front/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
<!-- JS Main File -->
<script src="<?php echo site_url('front/site_assets/js/main.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.0.min.js"></script>
<!--footer end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>common/js/moment.min.js"></script>
<!--
<script src="<?php echo base_url(); ?>common/js/jquery.nicescroll.js" type="text/javascript"></script>
-->
<script src="<?php echo base_url(); ?>common/js/respond.min.js"></script>
<!--script for this page only-->
<!--script da agenda slide-->
<script src="<?php echo base_url('app-assets/slick/slick.js') ?>" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>



<script type="text/javascript">
    $(document).on('ready', function() {

        $(".center").slick({
            dots: false,
            infinite: false,
            centerMode: false,
            slidesToShow: 3,
            slidesToScroll: 2
        });

        $(".lazy").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".listhours").slick({
            dots: false,
            infinite: false,
            centerMode: false,
            slidesToShow: 3,
            slidesToScroll: 2
        });
    });


    function verificarHoras(dados) {
        var $opts = {
            dots: false,
            infinite: false,
            centerMode: false,
            slidesToShow: 3,
            slidesToScroll: 2
        }
        dados = dados.split(",")
        var start = dados['0'];
        var id = dados['1'];
        var agenda = 'listhours' + id;


        // $(".listhours").slideUp();
        $("#" + id + "").slideUp();
        $(".listhours").slideUp();
        $(".listhours").slick('unslick');




        $.ajax({
            url: "<?php echo base_url(); ?>frontend/list_hour_teacher",
            type: "POST",
            data: {
                start: start,
                id: id
            },
            success: function(data) {
                if (data == "error") {

                    $("#msg" + id + "").html('Nenhum Horário Disponível!');
                    // $(".listhours").slick($opts);
                    //  $(".listhours").slideDown();
                    //   $("#"+id+"").slideDown();




                } else {
                    // $('.listhours').html = data;
                    $("#" + id + "").slideDown();
                    $("#msg" + id + "").html('');
                    $("#msg" + id + "").html('Horário Disponível!');
                    $("#" + id + "").html(data);
                    // document.getElementById(" "+id+" ").innerHTML = data;
                    $(".listhours").slick($opts);




                }
            }
        })
    }
</script>



<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>



<script type="text/javascript">
    $(document).ready(function() {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }
        var windowSize = window.innerWidth;
        if (windowSize < 768) {
            $('#sidebar').removeAttr('style');
        }
    });

    function onElementHeightChange(elm, callback) {
        var lastHeight = elm.clientHeight,
            newHeight;
        (function run() {
            newHeight = elm.clientHeight;
            if (lastHeight != newHeight)
                callback();
            lastHeight = newHeight;
            if (elm.onElementHeightChangeTimer)
                clearTimeout(elm.onElementHeightChangeTimer);
            elm.onElementHeightChangeTimer = setTimeout(run, 200);
        })();
    }




    onElementHeightChange(document.body, function() {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }

        var windowSize = $(window).width();
        if (windowSize < 768) {
            $('#sidebar').removeAttr('style');
        }
    });







    $(window).resize(function() {

        if (width == GetWidth()) {
            return;
        }

        width = GetWidth();

        if (width < 600) {
            $('#sidebar').hide();
        } else {
            $('#sidebar').show();
        }

    });
</script>
<script>
    $(document).ready(function() {
        //   $('#')
    });
</script>


<script>
    $(document).ready(function() {
        $('.date').mask('00/00/0000');
        $('.time').mask('00:00:00');
        $('.cep').mask('00000-000');
        $('.phone').mask('00-00000-0000');
        $("input[id*='cpf']").mask('000.000.000-00');
        $('.money').mask('000.000.000.000,00');

    });



    $('#cpf').on('blur', function() {
        var cpf = $(this).val();
        cpf = cpf.replace(/[^\d]+/g, '');

        if (cpf.length <= 11) {
            if (!validarCPF(cpf)) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                swal("Ops! Encontramos um erro...", "O CPF informado não é válido! Por favor, corrija o CPF.", "warning");
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        } else {
            if (!validarCNPJ(cpf)) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                swal("Ops! Encontramos um erro...", "O CNPJ informado não é válido! Por favor, corrija o CNPJ.", "warning");
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');

            }
        }

    });

    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '')
            return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }


    /* Config Vars */
    /* Nao alterar ValidateState */
    validateState = false;

    /* Required message */
    validateRequiredMsg = "Campo de preechimento obrigat&oacute;rio";
    /* E-mail message */
    validateMailMsg = "E-mail informsdsado &eacute; inv&aacute;lido";
    /* Numeric message */
    validateNumericMsg = "O valor deve ser num&eacute;rico";
    /* Min message */
    validateMinMsg = "A quantidade m&iacute;nima de caracters &eacute;: ";
    /* Max message */
    validateMaxMsg = "A quantidade m&aacute;xima de caracters &eacute;: ";
    /* Password message */
    validatePasswordMsg = "Senhas n&atilde;o conferem";

    function validate() {


        var senha = $('#password').val();
        var regex = /^(?=(?:.*?[A-Z]){3})(?=(?:.*?[0-9]){2})(?=(?:.*?[!@#$%*()_+^&}{:;?.]){1})(?!.*\s)[0-9a-zA-Z!@#$%;*(){}_+^&]*$/;

        if (senha.length < 8) {
            swal("A senha deve conter no minímo 8 digitos!");
            //document.formulario.senha.focus();
            validateState = false;
            return false;
        }
        validateState = true;


        $('#myform :input').each(function() {
            /* required */
            if ($(this).hasClass('required') && $.trim($(this).val()) === "") {
                $(this).addClass('is-invalid');
                $(this).focus();
                $('#msgjs').html(validateRequiredMsg);
                $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                    $("#msgjs").slideUp(10000);
                });
                validateState = false;
                return false;
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                validateState = true;
            }

            /* numeric value */
            if ($(this).hasClass('required') && $(this).hasClass('numeric')) {
                var nan = new RegExp(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/);
                if (!nan.test($.trim($(this).val()))) {
                    $(this).addClass('invalid');
                    $(this).focus();
                    $('#msgjs').html(validateNumericMsg);
                    $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                        $("#msgjs").slideUp(500);
                    });
                    validateState = false;
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    validateState = true;
                }
            }
            /* mail */
            if ($(this).hasClass('email')) {
                var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
                if (!er.test($.trim($(this).val()))) {
                    $(this).addClass('invalid');
                    $(this).focus();
                    $('#msgjs').html(validateMailMsg);
                    $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                        $("#msgjs").slideUp(500);
                    });
                    validateState = false;
                    return false;
                }
            }
            /* min value */
            if ($(this).attr('min')) {
                if ($.trim($(this).val()).length < $(this).attr('min')) {
                    $(this).addClass('invalid');
                    $(this).focus();
                    $('#msgjs').html(validateMinMsg);
                    $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                        $("#msgjs").slideUp(500);
                    });
                    validateState = false;
                    return false;
                }
            }
            /* max value */
            if ($(this).attr('max') && $(this).hasClass('required')) {
                if ($.trim($(this).val()).length > $(this).attr('max')) {
                    $(this).addClass('invalid');
                    $(this).focus();
                    $('#msgjs').html(validateMaxMsg + $(this).attr('max'));
                    validateState = false;
                    return false;
                } else {
                    $('#msgjs').html('');
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    validateState = true;
                }
            }
            if ($(this).hasClass('card') && $.trim($(this).val()) === "") {
                $(this).addClass('is-invalid');
                $(this).focus();
                $('#msgjs').html(validateRequiredMsg);
                $("#msgjs").fadeTo(2000, 500).slideUp(500, function() {
                    $("#msgjs").slideUp(10000);
                });
                validateState = false;
                return false;
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                validateState = true;
            }

        })

        if (validateState == true) {
            //alert('teste');
            // $('#btn_img_loader').show();
            // $('#btn_bt_loader').hide();
            var formulario = document.getElementById('myform');
            var dados = new FormData(formulario);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('frontend/salvarProfissional/'); ?>?ajax=true",
                data: dados,
                dataType: 'json',
                processData: false,
                contentType: false,
                // async: false,
                success: function(data) {
                    if (data.situacao === true) {
                        // Remove todos os css da classe
                        //  $(".divPedido").hide();
                        //  $('.divRecibo').html(data.html);
                        //   $(".divRecibo").fadeTo(2000, 500);
                    } else if (data.redirect === true) {
                        // Remove todos os css da classe
                        // $('#btn_bt_loader').hide();
                        // $(".divPedido").hide();
                        // $('.divRecibo').html(data.html);
                        // $(".divRecibo").fadeTo(2000, 500);
                        window.location.href = data.html;
                    } else {
                        swal("Erro", data.mensagem, "error");
                        //  $('#btn_bt_loader').show();
                        //  $('#btn_img_loader').hide();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Erro", "Error ao tentar realizar o cadastro: " + errorThrown + ' Por favor entre em contato com a nossa Equipe, para mais detalhes.', "error");
                    //  $('#btn_bt_loader').hide();
                    //  $('#btn_img_loader').show();
                }
            });
        }
    }
</script>