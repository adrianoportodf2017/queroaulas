<style>

</style>

<div class="row">



    <div class="col-1"></div>
    <div class="col-lg-8 ml-2">
        <div class="search-bar SearchForm_inputsContainer" style="-webkit-box-shadow: 9px 7px 5px rgba(50, 50, 50, 0.77);
		-moz-box-shadow:    9px 7px 5px rgba(50, 50, 50, 0.77);
		box-shadow:         9px 7px 5px rgba(50, 50, 50, 0.77); min-height: 45px; ">
            <form method="post" action="" data-type="search" class="search-box-v3-2 js-search-form hello">
                <div class="SearchForm_inputs">
                    <div class="Grid Grid-guttersSmall Grid-guttersVertical Search_box_clear flex-that">
                        <div class="Grid_cell Grid_cell-1-3 Grid_cell-1-1@mobile SearchForm_subjectContainer Search_box_clear">
                            <div class="autocomplete">
                            <input type="text" id="myAutocomplete" placeholder="<?php if($this->input->post('categorias')){ echo $this->input->post('categorias');} else {echo 'Qual matéria?';}?>" name="categorias" class="form-control" class="SearchForm_input Search_box_input autocomplete-input js-search-form-subject border-0"/>

                             
                        </div>
                    </div>
                    <div class="Grid_cell Grid_cell-1-3 Grid_cell-1-1@mobile SearchForm_locationInputContainer Search_box_clear">
                        <input name="termos" id="termos" value="<?php if ($this->input->post('termos') != '') {
                                                                    echo $this->input->post('termos');
                                                                } else { ?><?php } ?>" type="text" placeholder="<?php if ($this->input->post('termos') != '') {
                                                                                                                                                                                                echo 'Oque você deseja estudar?...';
                                                                                                                                                                                            } else { ?>Oque você deseja estudar?...<?php } ?>" class="SearchForm_input Search_box_input js-search-form-gmap-autocomplete pac-target-input">
                    </div>
                    <div class="Grid_cell Grid_cell-1-6 Grid_cell-1-1@mobile Search_box_div_button"><button type="submit" class="button SearchForm_submit button-topHide">Procurar</button>

                    </div>
                </div>
        </div><input type="hidden" name="search_all" value="">
        <input type="hidden" name="search_all" value="">
        </form>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row m-1 p-1">
        <div class="col-1"></div>
        <div class="col-xl-10" style="margin: 0px;">


            <?php
            if ($teachers) {
                foreach ($teachers as $teacher) { ?>

                    <div class="card">
                        <div class="card-body ">
                            <div class="row " style="text-align: center;">
                                <div class="col-md-7">
                                    <aside class="profile-nav ">
                                        <div class="user-heading round">
                                            <div class="row">
                                                <div class="col-4">
                                                    <?php if (!empty($teacher->img_url) && file_exists($teacher->img_url)) { ?>
                                                        <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                            <div class="m-b-25"> <img src="<?= $teacher->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                        </a>
                                                    <?php } else {
                                                    ?>
                                                        <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                            <div class="m-b-25"> <img src="<?= base_url() ?>uploads/semfoto.gif" class="img-radius" alt="User-Profile-Image" style="max-width: 150px; width: 100%; border-radius: 50%;"> </div>
                                                        </a><?php } ?>
                                                </div>
                                                <div class="col-8" style="text-align: left;">
                                                    <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>">
                                                        <h5><?php echo $teacher->name ?> </b></h5>
                                                    </a>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <br>
                                                    <br><b>R$ <?php echo number_format($teacher->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b>
                                                    <p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <p style="margin: 30px;  margin: 0;  text-align: justify; font-size: small;"><?= mb_substr($teacher->profile, 0, 300, 'UTF-8'); ?>
                                    </aside>
                                    <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>" class="btn button m-2 ">Quero Saber Mais <i class="fa fa-heart-o"></i></a>
                                </div>
                                <div class="col-md-5">
                                    <?php $translate = array(

                                        1 => "Seg ",
                                        2 => "Ter ",
                                        3 => "Qua ",
                                        4 => "Qui ",
                                        5 => "Sex ",
                                        6 => "Sáb ",
                                        7 => "Dom ",
                                    );
                                    ?>
                                    <h3>Escolher uma Data: </h3>
                                    </b>
                                    <div class="center slider">
                                        <div>
                                            <button id="" onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round button-week" value="teste"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+1 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+2 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+3 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+4 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+5 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+6 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+7 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))) . ',' . $teacher->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo $translate[strftime('%u', strtotime('+8 day', strtotime(date('D-m-y'))))];
                                                                                                                                                                                                                                        echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                    </div>
                                    <div class="listhours slider" id="<?= $teacher->id ?>" name="listhours">

                                    </div>
                                    <div id="msg<?= $teacher->id ?>">
                                    </div>
                                    <a href="<?= site_url() . 'frontend/profile/' . $teacher->id; ?>" class="btn btn-outline-info  d-block d-lg-none" style="margin: 2px">Quero Saber Mais <i class="fa fa-heart-o"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                <?php }
            } else { ?>
                <div class="card">
                    <div class="card-body ">
                        <div class="row " style=" margin: 0;   text-align: center;">
                            <div class="col-md-7">
                                <h1>Nenhum resultado encontrado!</h1>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                </div>
        </div>
    </div>
</div>
<div class="container">
        <div id="parent" class="form-group">
            <label for="myAutocomplete">Bootstrap 4 Autocomplete</label>
        </div>
        <div id="output"></div>
    </div>

    <!-- Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script>
    (function ($) {
    var defaults = {
        treshold: 1,
        maximumItems: 5,
        highlightTyped: true,
        highlightClass: 'text-primary'
    };
    function createItem(lookup, item, opts) {
        var label;
        if (opts.highlightTyped) {
            var idx = item.label.toLowerCase().indexOf(lookup.toLowerCase());
            label = item.label.substring(0, idx)
                + '<span class="' + expandClassArray(opts.highlightClass) + '">' + item.label.substring(idx, idx + lookup.length) + '</span>'
                + item.label.substring(idx + lookup.length, item.label.length);
        }
        else {
            label = item.label;
        }
        return '<button type="button" class="dropdown-item" data-value="' + item.value + '"><span style="color: black">' + label + '</span></button>';
    }
    function expandClassArray(classes) {
        if (typeof classes == "string") {
            return classes;
        }
        if (classes.length == 0) {
            return '';
        }
        var ret = '';
        for (var _i = 0, classes_1 = classes; _i < classes_1.length; _i++) {
            var clas = classes_1[_i];
            ret += clas + ' ';
        }
        return ret.substring(0, ret.length - 1);
    }
    function createItems(field, opts) {
        var lookup = field.val();
        if (lookup.length < opts.treshold) {
            field.dropdown('hide');
            return 0;
        }
        var items = field.next();
        items.html('');
        var count = 0;
        var keys = Object.keys(opts.source);
        for (var i = 0; i < keys.length; i++) {
            var key = keys[i];
            var object = opts.source[key];
            var item = {
                label: opts.label ? object[opts.label] : key,
                value: opts.value ? object[opts.value] : object
            };
            if (item.label.toLowerCase().indexOf(lookup.toLowerCase()) >= 0) {
                items.append(createItem(lookup, item, opts));
                if (opts.maximumItems > 0 && ++count >= opts.maximumItems) {
                    break;
                }
            }
        }
        // option action
        field.next().find('.dropdown-item').click(function () {
            field.val($(this).text());
            if (opts.onSelectItem) {
                opts.onSelectItem({
                    value: $(this).data('value'),
                    label: $(this).text()
                }, field[0]);
            }
        });
        return items.children().length;
    }
    $.fn.autocomplete = function (options) {
        // merge options with default
        var opts = {};
        $.extend(opts, defaults, options);
        var _field = $(this);
        // clear previously set autocomplete
        _field.parent().removeClass('dropdown');
        _field.removeAttr('data-toggle');
        _field.removeClass('dropdown-toggle');
        _field.parent().find('.dropdown-menu').remove();
        _field.dropdown('dispose');
        // attach dropdown
        _field.parent().addClass('dropdown');
        _field.attr('data-toggle', 'dropdown');
        _field.addClass('dropdown-toggle');
        var dropdown = $('<div class="dropdown-menu" ></div>');
        // attach dropdown class
        if (opts.dropdownClass)
            dropdown.addClass(opts.dropdownClass);
        _field.after(dropdown);
        _field.dropdown(opts.dropdownOptions);
        this.off('click.autocomplete').click('click.autocomplete', function (e) {
            if (createItems(_field, opts) == 0) {
                // prevent show empty
                e.stopPropagation();
                _field.dropdown('hide');
            }
            ;
        });
        // show options
        this.off('keyup.autocomplete').keyup('keyup.autocomplete', function () {
            if (createItems(_field, opts) > 0) {
                _field.dropdown('show');
            }
            else {
                // sets up positioning
                _field.click();
            }
        });
        return this;
    };
}(jQuery));
</script>

    <script>
    var src = {


<?php $categorys = $this->category_model->getCategory();
                                    foreach ($categorys as $category) { ?>
                                        <?php
                                    $subCategorys =  $this->category_model->getSubCategory($category->id);
                                        foreach ($subCategorys as $subCategory) {  ?>
                                     "<?= $subCategory->name ?>" :    "<?= $category->name ?>",                                       
                                     <?php } ?>

                                           <?php } ?>
                                        }
        

        function onSelectItem(item, element) {
            $('#output').html(
                'Element <b>' + $(element).attr('id') + '</b> was selected<br/>' +
                '<b>Value:</b> ' + item.value + ' - <b>Label:</b> ' + item.label
            );
        }

        $('#myAutocomplete').autocomplete({
            source: src,
            onSelectItem: onSelectItem,
            highlightClass: 'text-danger'
        });
    </script>
</section>