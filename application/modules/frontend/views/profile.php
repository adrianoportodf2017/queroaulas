<!DOCTYPE html>
<html lang="en">
    <base href="<?php echo base_url(); ?>">
    <?php
    $settings = $this->frontend_model->getSettings();
    $title = explode(' ', $settings->title);
    $site_name = $this->db->get('website_settings')->row()->title;
    ?>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../../../../favicon.ico" />
        <title><?php echo $site_name; ?></title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
        <!-- Font-awesome -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

        <!-- jQuery Plugins -->
        <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/magnific-popup/magnific-popup.css'); ?>" />
        <link rel="stylesheet" href="<?php echo site_url('common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('common/assets/bootstrap-timepicker/compiled/timepicker.css'); ?>">
        <!--<link rel="stylesheet" href="<?php echo site_url('front/css/style.css'); ?>">-->
        <link rel="stylesheet" href="<?php echo site_url('front/css/responsive.css'); ?>">

        <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/css/rs-style.css'); ?>" media="screen">
        <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/rs-plugin/css/settings.css'); ?>" media="screen">
        <!-- CSS Stylesheet -->
        <link href="<?php echo site_url('front/site_assets/css/style.css'); ?>" rel="stylesheet" />
        <link href="<?php echo site_url('front/site_assets/css/responsive.css') ?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.css'); ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
    </head>
    <style>
        .topbar-texts, .footer-description {
            font-family: "Roboto", sans-serif !important;
            font-size: 15px !important;
        }


    </style>
    <body onload="myFunction()">
        <div id="loading"></div>

        <!---------------- Start Main Navbar ---------------->
        <div id="header_menu_top" class="bg-dark text-white pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="topbar-texts"><?php echo $settings->address; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="topbar-texts float-right ml-3">
                            <i class="fa fa-phone" aria-hidden="true"></i> &nbsp;
                            <span><?php echo $settings->phone; ?></span>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo site_url('auth/login') ?>" class="float-right"><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp; <span>Sign In</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="header">
            <div class="navbar-wrap">
                <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">
                        <a class="navbar-brand" href="frontend#">
                            <?php
                            if (!empty($settings->logo)) {
                                if (file_exists($settings->logo)) {
                                    echo '<img width="200" src=' . $settings->logo . '>';
                                } else {
                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                }
                            } else {
                                echo $title[0] . '<span> ' . $title[1] . '</span>';
                            }
                            ?>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item ml-3">
                                    <a class="nav-link" href="frontend#"><?php echo lang('home'); ?></a>
                                </li>
                                <li class="nav-item ml-3">
                                    <a class="nav-link" href="frontend#why_choose_us"><?php echo lang('book_an_appointment'); ?></a>
                                </li>
                                <li class="nav-item ml-3">
                                    <a class="nav-link" href="frontend#featured_services"><?php echo lang('services'); ?></a>
                                </li>
                                <li class="nav-item ml-3">
                                    <a class="nav-link" href="frontend#doctor"><?php echo lang('doctors'); ?></a>
                                </li>
                                <li class="nav-item ml-3">
                                    <a class="nav-link" href="frontend#portfolio"><?php echo lang('portfolio'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

       
        </div>



        <section class="breadcrumbs-custom bg-image context-dark breadcrumbs-creative" style="background-image: url(images/background-breadcrumbs-01-1920x345.jpg);" data-preset='{"title":"Breadcrumbs","category":"header","reload":false,"id":"breadcrumbs"}'>
        <div class="container">
          <h2 class="breadcrumbs-custom-title">Team Member Profile</h2>
          <ul class="breadcrumbs-custom-path">
            <li><a href="index.html">Home</a></li>
            <li><a>Pages</a></li>
            <li class="active">Team Member Profile</li>
          </ul>
        </div>
      </section>
      <!-- team member section-->
      <section class="section-lg section bg-default">
        <div class="container">
          <div class="row justify-content-sm-center">
            <div class="col-sm-10 col-lg-4">
              <!-- Member block type 5-->
              <div class="member-block-type-5 inset-lg-right-20"><img class="img-responsive center-block" src="images/user-scott-riley-320x320.jpg" width="320" height="320" alt=""/>
                <div class="member-block-body"><a class="btn-ellipse btn-primary btn" href="make-an-appointment.html">make an appointment</a>
                  <address class="contact-info offset-top-20 offset-sm-top-24">
                    <ul class="list-unstyled p">
                      <li><span class="icon icon-xxxs text-middle text-primary mdi mdi-phone"></span><a class="text-middle d-inline-block text-gray-darker" href="tel:1-800-1234-567">1-800-1234-567</a></li>
                      <li><span class="icon icon-xxxs text-middle text-primary mdi mdi-email-open"></span><a class="text-middle d-inline-block" href="mailto:mail@demolink.org">mail@demolink.org</a></li>
                    </ul>
                  </address>
                  <div class="offset-top-24">
                    <ul class="list-inline list-inline-xs">
                      <li><a class="icon icon-xxs icon-circle icon-gray-light fa-facebook" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-circle icon-gray-light fa-twitter" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-circle icon-gray-light fa-google-plus" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-circle icon-gray-light fa-rss" href="#"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="offset-top-34 text-md-left inset-lg-right-20">
                <h6 class="text-left">certificates</h6>
                <hr class="text-subline">
                <div class="row justify-content-sm-center justify-content-md-start offset-top-24 row-certificates" data-lightgallery="group">
                  <div class="col-sm-8 col-md-4"><a class="thumbnail-classic" data-lightgallery="item" data-size="700x970" href="images/certifications/certificate-01-700x970.jpg">
                      <figure><img width="100" height="138" src="images/certifications/certificate-01-100x138.jpg" alt=""/>
                      </figure></a>
                  </div>
                  <div class="col-sm-8 col-md-4 offset-top-20 offset-sm-top-0"><a class="thumbnail-classic" data-lightgallery="item" data-size="700x970" href="images/certifications/certificate-01-700x970.jpg">
                      <figure><img width="100" height="138" src="images/certifications/certificate-01-100x138.jpg" alt=""/>
                      </figure></a>
                  </div>
                  <div class="col-sm-8 col-md-4 offset-top-20 offset-sm-top-0"><a class="thumbnail-classic" data-lightgallery="item" data-size="700x970" href="images/certifications/certificate-01-700x970.jpg">
                      <figure><img width="100" height="138" src="images/certifications/certificate-01-100x138.jpg" alt=""/>
                      </figure></a>
                  </div>
                  <div class="col-sm-8 col-md-4 offset-top-20"><a class="thumbnail-classic" data-lightgallery="item" data-size="700x970" href="images/certifications/certificate-01-700x970.jpg">
                      <figure><img width="100" height="138" src="images/certifications/certificate-01-100x138.jpg" alt=""/>
                      </figure></a>
                  </div>
                  <div class="col-sm-8 col-md-4 offset-top-20"><a class="thumbnail-classic" data-lightgallery="item" data-size="700x970" href="images/certifications/certificate-01-700x970.jpg">
                      <figure><img width="100" height="138" src="images/certifications/certificate-01-100x138.jpg" alt=""/>
                      </figure></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-10 col-lg-8 text-lg-left offset-top-60 offset-md-top-0">
              <div class="row">
                <div class="col-md-5">
                  <div>Position</div>
                  <h5 class="font-weight-bold">CMO, Pathologist</h5>
                </div>
                <div class="col-md-7 offset-top-41 offset-sm-top-0">
                  <div>Education</div>
                  <h5 class="font-weight-bold">Perelman School of Medicine at the University of Pennsylvania (1987)</h5>
                </div>
              </div>
              <div class="offset-top-66 text-left">
                <h6>the heart of medical center</h6>
                <hr class="text-subline">
                <p>Nullam non odio vitae velit volutpat vulputate tempor eu sapien. Phasellus porttitor diam in tellus semper, ut elementum arcu eleifend. Nullam in posuere orci, ac congue augue. Sed varius massa et tortor fermentum, a dapibus ligula varius. Duis nec elementum ante, non imperdiet libero. Sed nec ornare justo, quis vehicula mauris. Nam ornare dui vitae ex congue interdum. Donec luctus dignissim est at ultricies. Sed ullamcorper posuere leo vitae suscipit. Suspendisse ac sem at nulla pellentesque rutrum a vel diam. Morbi pretium interdum lorem nec faucibus.</p>
                <p>Aenean ac ex nunc. Phasellus tincidunt tempus enim. Sed elementum volutpat libero at pellentesque. Vestibulum interdum, dolor eget tristique dignissim, augue diam viverra ex, non malesuada ipsum mauris volutpat nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam efficitur accumsan condimentum.</p>
              </div>
              <div class="offset-top-66">
                <h6 class="text-left">skills</h6>
                <hr class="text-subline">
                <div class="offset-top-30">
                  <!-- Linear progress bar-->
                  <div class="progress-linear">
                    <div class="progress-header">
                      <h6 class="text-gray-dark pull-left">Dedication</h6>
                      <h6 class="text-primary offset-top-0 pull-right progress-value progress-linear-counter">50</h6>
                    </div>
                    <div class="progress-bar-linear-wrap progress-linear-body">
                      <div class="progress-linear-bar progress-bar-linear bg-accent"></div>
                    </div>
                  </div>
                  <div class="offset-top-60">
                    <!-- Linear progress bar-->
                    <div class="progress-linear">
                      <div class="progress-header">
                        <h6 class="text-gray-dark pull-left">problem Solving</h6>
                        <h6 class="text-primary offset-top-0 pull-right progress-value progress-linear-counter">20</h6>
                      </div>
                      <div class="progress-bar-linear-wrap progress-linear-body">
                        <div class="progress-linear-bar progress-bar-linear bg-accent"></div>
                      </div>
                    </div>
                  </div>
                  <div class="offset-top-60">
                    <!-- Linear progress bar-->
                    <div class="progress-linear">
                      <div class="progress-header">
                        <h6 class="text-gray-dark pull-left">professionalism</h6>
                        <h6 class="text-primary offset-top-0 pull-right progress-value progress-linear-counter">87</h6>
                      </div>
                      <div class="progress-bar-linear-wrap progress-linear-body">
                        <div class="progress-linear-bar progress-bar-linear bg-accent"></div>
                      </div>
                    </div>
                  </div>
                  <div class="offset-top-60">
                    <!-- Linear progress bar-->
                    <div class="progress-linear">
                      <div class="progress-header">
                        <h6 class="text-gray-dark pull-left">Decision-making</h6>
                        <h6 class="text-primary offset-top-0 pull-right progress-value progress-linear-counter">37</h6>
                      </div>
                      <div class="progress-bar-linear-wrap progress-linear-body">
                        <div class="progress-linear-bar progress-bar-linear bg-accent"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Dr. Scott Riley’s blog posts-->
      <section class="section-lg section bg-default-liac">
        <div class="container">
          <h3>Scott Riley’s Blog Posts</h3>
          <div class="row justify-content-sm-center row-40">
            <div class="col-sm-10 col-md-8 col-lg-4">
              <!-- Post Modern-->
              <article class="post post-modern post-modern-classic">
                <!-- Post media-->
                <div class="post-media"><a class="link-image" href="single-post.html"><img class="img-responsive img-cover" width="370" height="250" src="images/post-13-370x250.jpg" alt=""/></a>
                </div>
                <!-- Post content-->
                <div class="post-content text-left">
                  <!-- Post Title-->
                  <div class="post-title offset-top-8">
                    <h5 class="font-weight-bold"><a href="single-post.html">Reasons to Visit a Breast Specialist</a></h5>
                  </div>
                  <ul class="list-inline list-inline-dashed">
                    <li>June 21, 2021 at 8:12pm</li>
                    <li><a class="text-primary text-primary" href="single-post.html">News</a></li>
                  </ul>
                  <!-- Post Body-->
                  <div class="post-body">
                    <div class="offset-top-14">
                      <p>There are a lot of women that are unaware of the numerous risks associated with their health and eventually ignore the importance of visiting...</p>
                    </div>
                  </div>
                  <div class="tags group group-sm">
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-4">
              <!-- Post Modern-->
              <article class="post post-modern post-modern-classic">
                <!-- Post media-->
                <div class="post-media"><a class="link-image" href="single-post.html"><img class="img-responsive img-cover" width="370" height="250" src="images/post-14-370x250.jpg" alt=""/></a>
                </div>
                <!-- Post content-->
                <div class="post-content text-left">
                  <!-- Post Title-->
                  <div class="post-title offset-top-8">
                    <h5 class="font-weight-bold"><a href="single-post.html">Picking the Right Diagnostic Services for Efficient Results</a></h5>
                  </div>
                  <ul class="list-inline list-inline-dashed">
                    <li>June 21, 2021 at 8:12pm</li>
                    <li><a class="text-primary text-primary" href="single-post.html">News</a></li>
                  </ul>
                  <!-- Post Body-->
                  <div class="post-body">
                    <div class="offset-top-14">
                      <p>There have been a lot of cases in which people were not provided with accurate reports that eventually affected their medical treatment. There is always...</p>
                    </div>
                  </div>
                  <div class="tags group group-sm">
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-4">
              <!-- Post Modern-->
              <article class="post post-modern post-modern-classic">
                <!-- Post media-->
                <div class="post-media"><a class="link-image" href="single-post.html"><img class="img-responsive img-cover" width="370" height="250" src="images/post-15-370x250.jpg" alt=""/></a>
                </div>
                <!-- Post content-->
                <div class="post-content text-left">
                  <!-- Post Title-->
                  <div class="post-title offset-top-8">
                    <h5 class="font-weight-bold"><a href="single-post.html">Preparing for an ECG in 8 Easy Steps: Tips From Our Diagnosticians</a></h5>
                  </div>
                  <ul class="list-inline list-inline-dashed">
                    <li>June 21, 2021 at 8:12pm</li>
                    <li><a class="text-primary text-primary" href="single-post.html">News</a></li>
                  </ul>
                  <!-- Post Body-->
                  <div class="post-body">
                    <div class="offset-top-14">
                      <p>An ECG stands for an "electrocardiogram," which is a test that measures and records the electrical activity of the heart. It is used by doctors to obtain...</p>
                    </div>
                  </div>
                  <div class="tags group group-sm">
                  </div>
                </div>
              </article>
            </div>
          </div><a class="btn btn-ellipse btn-primary offset-top-41 offset-md-top-60" href="blog-masonry.html">view all blog posts</a>
        </div>
      </section>

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
                                    <a href="<?php echo $settings->facebook_id; ?>"><div class=""><i class="fa fa-facebook"></i></div></a> <?php } ?>
                                <?php if (!empty($settings->google_id)) { ?>
                                    <a href="<?php echo $settings->google_id; ?>"><div><i class="fa fa-google-plus"></i></div></a> <?php } ?>
                                <?php if (!empty($settings->twitter_id)) { ?>
                                    <a href="<?php echo $settings->twitter_id; ?>"><div><i class="fa fa-twitter"></i></div></a> <?php } ?>
                                <?php if (!empty($settings->youtube_id)) { ?>
                                    <a href="<?php echo $settings->youtube_id; ?>"><div><i class="fa fa-youtube"></i></div></a> <?php } ?>

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
        <!---------------- End Footer Area ---------------->

        <!-- Bootstrap core JavaScript  -->
        <script src="<?php echo site_url('front/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('front/site_assets/vendor/jquery/popper.min.js'); ?>"></script>
        <script src="<?php echo site_url('front/site_assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
        <script src="<?php echo site_url('front/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <!-- JS Main File -->
        <script src="<?php echo site_url('front/site_assets/js/main.js'); ?>"></script>
        <script src="<?php echo site_url('common/toastr/toastr.js'); ?>"></script>
        <!-- <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.js'); ?>" />-->
       <!--<script src="front/js/jquery.js"></script>-->
        <script src="front/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo site_url('front/js/wow/wow.min.js'); ?>"></script>
        <script src="front/js/smoothscroll/jquery.smoothscroll.min.js"></script>
        <script src="<?php echo site_url('front/js/script.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>
        <script src="<?php echo site_url('front/assets/fancybox/source/jquery.fancybox.pack.js'); ?>"></script>

                    <!--<script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>
                    <script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>
      
<!-- js placed at the end of the document so the pages load faster -->
<script src="common/js/jquery.js"></script>

<script src="common/js/bootstrap.min.js"></script>
<script src="common/js/jquery.scrollTo.min.js"></script>

<script src="common/js/moment.min.js"></script>

<!--
<script src="common/js/jquery.nicescroll.js" type="text/javascript"></script>
-->

<script type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
<script src="common/js/respond.min.js" ></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>


<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="common/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="common/js/advanced-form-components.js"></script>
<script src="common/js/jquery.cookie.js"></script>
<!--common script for all pages--> 
<script src="common/js/common-scripts.js"></script>
<script src="common/js/lightbox.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
<!--script for this page only-->
<script src="common/js/editable-table.js"></script>
<script src="common/assets/fullcalendar/fullcalendar.js"></script>

<script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!--script da agenda slide-->
 <script src="<?php echo base_url('app-assets/slick/slick.js') ?>" type="text/javascript" charset="utf-8"></script>

<?php
$language = $this->db->get('settings')->row()->language;

if ($language == 'english') {
    $lang = 'en';
    $langdate = 'en-CA';
} elseif ($language == 'spanish') {
    $lang = 'es';
    $langdate = 'es';
} elseif ($language == 'french') {
    $lang = 'fr';
    $langdate = 'fr';
} elseif ($language == 'portuguese') {
    $lang = 'pt';
    $langdate = 'pt';
} elseif ($language == 'arabic') {
    $lang = 'ar';
    $langdate = 'ar';
} elseif ($language == 'italian') {
    $lang = 'it';
    $langdate = 'it';
} elseif ($language == 'zh_cn') {
    $lang = 'zh-cn';
    $langdate = 'zh-CN';
} elseif ($language == 'japanese') {
    $lang = 'ja';
    $langdate = 'ja';
} elseif ($language == 'russian') {
    $lang = 'ru';
    $langdate = 'ru';
} elseif ($language == 'turkish') {
    $lang = 'tr';
    $langdate = 'tr';
} elseif ($language == 'indonesian') {
    $lang = 'id';
    $langdate = 'id';
}
?>



<script src='common/assets/fullcalendar/locale/<?php echo $lang; ?>.js'></script>

<script type="text/javascript" src="common/assets/bootstrap-datepicker/locales/bootstrap-datepicker.<?php echo $langdate; ?>.min.js"></script>

<script src="common/assets/DataTables/DataTables-1.10.16/custom/js/datatable-responsive-cdn-version-2-2-5.js"></script>



<script>
    $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
        afterInit: function (ms) {
            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>

<script>
    $('#my_multi_select3').multiSelect()
</script>

<script>
    $('.default-date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '01-01-1900',
        clearBtn: true,
        language: '<?php echo $langdate; ?>'
    });


    $('#date').on('changeDate', function () {
        $('#date').datepicker('hide', {
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '01-01-1900',
            language: '<?php echo $langdate; ?>'
        });
    });

    $('#date1').on('changeDate', function () {
        $('#date1').datepicker('hide', {
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '01-01-1900',
            language: '<?php echo $langdate; ?>'
        });
    });


</script>


<script type="text/javascript">

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            lang: 'en',
            events: 'appointment/getAppointmentByJason',
            header:
                    {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay',
                    },
            /*    timeFormat: {// for event elements
             'month': 'h:mm TT A {h:mm TT}', // default
             'week': 'h:mm TT A {h:mm TT}', // default
             'day': 'h:mm TT A {h:mm TT}'  // default
             },
             
             */
            timeFormat: 'h(:mm) A',
            eventRender: function (event, element) {
                element.find('.fc-time').html(element.find('.fc-time').text());
                element.find('.fc-title').html(element.find('.fc-title').text());

            },
            eventClick: function (event) {
                $('#medical_history').html("");
                if (event.id) {
                    $.ajax({
                        url: 'patient/getMedicalHistoryByJason?id=' + event.id + '&from_where=calendar',
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).success(function (response) {
                        // Populate the form fields with the data returned from server
                        $('#medical_history').html("");
                        $('#medical_history').append(response.view);
                    });
                    //alert(event.id);

                }

                $('#cmodal').modal('show');
            },

            /*   eventMouseover: function (calEvent, domEvent) {
             var layer = "<div id='events-layer' class='fc-transparent' style='position:absolute; width:100%; height:100%; top:-1px; text-align:right; z-index:100'>Description</div>";
             $(this).append(layer);
             },
             
             eventMouseout: function (calEvent, domEvent) {
             $(this).append(layer);
             },
             
             */

            slotDuration: '00:5:00',
            businessHours: false,
            slotEventOverlap: false,
            editable: false,
            selectable: false,
            lazyFetching: true,
            minTime: "6:00:00",
            maxTime: "24:00:00",
            defaultView: 'month',
            allDayDefault: false,
            displayEventEnd: true,
            timezone: false,

        });
    });

</script>









<script>
    $(document).ready(function () {
        $('.timepicker-default').timepicker({defaultTime: 'value'});

    });
</script>

<script type="text/javascript" src="common/assets/select2/js/select2.min.js"></script>


<script type="text/javascript">

    $(document).ready(function () {
        $(".js-example-basic-single").select2();

        $(".js-example-basic-multiple").select2();
    });

</script>




<script type="text/javascript">

    $(document).ready(function () {
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
        var lastHeight = elm.clientHeight, newHeight;
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




    onElementHeightChange(document.body, function () {
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







    $(window).resize(function () {

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
    $(document).ready(function () {
        //   $('#')
    });
</script>



<script>
    CKEDITOR.replace("description",
            {
                height: 400
            });
</script>









</body>
</html>
