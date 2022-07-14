</main>


<!---------------- End Testimonials Slider Area ---------------->

<!---------------- Start Footer Area ---------------->
<div id="footer" class="text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <img src="<?php echo $settings->logo; ?>" class="img-fluid">

            </div>
            <div class="col-md-3 mb-3">
                <h6 class="my-2"><?php echo lang('about_us'); ?></h6>
                <p class="footer-description">
                    <?php echo $settings->description; ?>
                </p>
            </div>
            <div class="col-md-3 mb-3">
                <div class="social-media text-center">
                    <h6 class="my-2"><?php echo lang('STAY_CONNECTED'); ?></h6>
                    <div class="social-icon">

                        <?php if (!empty($settings->facebook_id)) { ?>
                            <a href="<?php echo $settings->facebook_id; ?>">
                                <div class=""><i class="fa fa-facebook"></i></div>
                            </a> <?php } ?>
                        <?php if (!empty($settings->google_id)) { ?>
                            <a href="<?php echo $settings->google_id; ?>">
                                <div><i class="fa fa-google-plus"></i></div>
                            </a> <?php } ?>
                        <?php if (!empty($settings->twitter_id)) { ?>
                            <a href="<?php echo $settings->twitter_id; ?>">
                                <div><i class="fa fa-twitter"></i></div>
                            </a> <?php } ?>
                        <?php if (!empty($settings->youtube_id)) { ?>
                            <a href="<?php echo $settings->youtube_id; ?>">
                                <div><i class="fa fa-youtube"></i></div>
                            </a> <?php } ?>

                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <h6 class="my-2"><?php echo lang('CONTACT_INFO'); ?></h6>
                <address>
                    <strong><?php echo lang('address'); ?>: <?php echo $settings->address; ?></strong><br />
                    <strong><?php echo lang('phone'); ?>: <?php echo $settings->phone; ?></strong><br />
                    <strong><?php echo lang('email'); ?>: <?php echo $settings->email; ?></strong>
                </address>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                    document.write(new Date().getFullYear())
                </script>,
                Desenvolvido <i class="fa fa-heart"></i>por
                <a href="https://www.agenciatecnet.com.br" class="font-weight-bold" target="_blank">Agência Tec Net</a>

            </div>
        </div>

    </div>

</div>
</div>
</div>
</body>
</html>