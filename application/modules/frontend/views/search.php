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

                                <select id="categorias" type="text" placeholder="Qual matéria?" name="categorias" class="SearchForm_input Search_box_input autocomplete-input js-search-form-subject border-0">
                                    <option class="border-0" value="<?php if ($this->input->post('categorias') != '') {
                                                                        echo $this->input->post('categorias');
                                                                    } else { ?><?php } ?>" selected><?php if ($this->input->post('categorias') != '') {
                                                                                                                                                                                            echo $this->input->post('categorias');
                                                                                                                                                                                        } else { ?>Matérias...<?php } ?></option>
                                    <?php $categorys = $this->category_model->getCategory();
                                    foreach ($categorys as $category) { ?>
                                        <?php
                                        echo '<b>' . $category->name . '</b>';
                                        $subCategorys =  $this->category_model->getSubCategory($category->id);
                                        foreach ($subCategorys as $subCategory) {  ?>
                                            <option value="<?= $subCategory->name ?>"> <?= '<b>' . $category->name . '</b>: ' . $subCategory->name ?> </option>
                                        <?php } ?>
                            </div>
                        <?php } ?>
                        </select>
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
                                    <h3></h3>
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

</section>