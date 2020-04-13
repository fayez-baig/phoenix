<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>


<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="LearnPress | Education & Courses HTML Template" />
<meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
<meta name="author" content="ThemeMascot" />

<!-- Page Title -->
<title>Phoenix Tutorials | Demo Lecture</title>

<!-- Favicon and Touch Icons -->
<link href="images/favicon.png" rel="shortcut icon" type="image/png">
<link href="images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link href="css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="css/preloader.css" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

<!-- Revolution Slider 5.x CSS settings -->
<link  href="js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="js/jquery-plugin-collection.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

   


</head>
<body class="">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=1619488948135186&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper" class="clearfix">
  <!-- preloader -->
  <div id="preloader">
    <div id="spinner">
      <img alt="" src="images/preloaders/5.gif">
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
  </div>

  <!-- Start main-content -->
  <div class="main-content"> 
    <!-- Section: home -->
    <section id="home" class="divider parallax layer-overlay " data-bg-img="images/bg/c2.jpg">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container pb-100">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                <div class="text-center mb-60"><a href="#" class=""><img alt="" src="images/logo.jpg" style="height: 89px;"></a></div>
                <div class="bg-lightest border-1px p-25">
                  <h4 class="text-theme-colored text-uppercase m-0">Make an Appointment <a href="index.php"><i class="fa fa-home text-theme-colored" style="margin-left: 41%; " aria-hidden="true">Home </i></a> </h4>
                  <div class="line-bottom mb-30"></div>
                  <form id="appointment_form" name="appointment_form" class="mt-30" method="post" action="demo_regi.php">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group mb-10">
                          <input name="reservation_name" class="form-control" type="text" required="" placeholder="Enter Name" aria-required="true">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group mb-10">
                          <input name="reservation_email" class="form-control required email" type="email" placeholder="Enter Email" aria-required="true">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group mb-10">
                          <input name="reservation_phone" class="form-control required" type="text" placeholder="Enter Phone" aria-required="true">
                        </div>
                      </div>
                      <div class="col-sm-12">
                    <div class="form-group mb-20">
                      <div class="styled-select">
                        <select id="person_select" name="reservation_course" class="form-control" required>
                          <option value="">- Select Your Course Type -</option>
                          <option value="Secondary">Secondary </option>
                          <option value="Higher Secondary">Higher Secondary</option>
                          <option value="Diploma">Diploma</option>
                          <!-- <option value="Family Pack">Chemical Engineering</option> -->
                        </select>
                      </div>
                     <span class="help-block" id="error"></span>           

                    </div>
                  </div>
                      <div class="col-sm-6">
                        <div class="form-group mb-10">
                          <input name="reservation_date" class="form-control required date-picker" type="text" placeholder="Appoinment Date" aria-required="true">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group mb-10">
                          <input name="reservationt_time" class="form-control required time-picker" type="text" placeholder="Appoinment Time" aria-required="true">
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-10">
                      <textarea name="reservation_message" class="form-control required"  placeholder="Enter Message" rows="5" aria-required="true"></textarea>
                    </div>
                    <div class="form-group mb-0 mt-20">
                      <input name="form_botcheck" class="form-control" type="hidden" value="">
                      <button type="submit" class="btn btn-dark btn-theme-colored" data-loading-text="Please wait...">Submit</button>
                    </div>
                  </form>
                  <!-- Appointment Form Validation-->
                  <script type="text/javascript">
                    $("#appointment_form").validate({
                      submitHandler: function(form) {
                        var form_btn = $(form).find('button[type="submit"]');
                        var form_result_div = '#form-result';
                        $(form_result_div).remove();
                        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                        var form_btn_old_msg = form_btn.html();
                        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                        $(form).ajaxSubmit({
                          dataType:  'json',
                          success: function(data) {
                            if( data.status == 'true' ) {
                              $(form).find('.form-control').val('');
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                            
                          }
                        });
                      }
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
<?php include_once('footer.php');  ?>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="js/custom.js"></script>

</body>

</html>