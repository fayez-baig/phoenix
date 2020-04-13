<?php
 include_once('academy_admin/source/config.php');
    $output = [];
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Make a sql query
        $sql = "SELECT * FROM gallery";

        //Prepare sql query
        $stmt = $conn->prepare($sql);
            
        if($stmt->execute())
        {
            $output = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Phoenix Tutorials | Primary Secondary Diploma." />
<meta name="keywords" content="Phoenix Tutorials, Gallery, eventphoto, course, education, education, elearning, learning, primary, secondary, diploma, English, Maths, Physics, PCMB, PCB, PCM" />
<meta name="author" content="Ajay Gaikar" />

<!-- Page Title -->
<title>Phoenix Tutorials || Gallery</title>

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

<style type="text/css">
  .fb_iframe_widget > span{
  max-height:348px !important;
}
iframe{
  max-height: 348px !important;
}
._10b4{
  max-height: 225px !important;
}
#u_0_3{
   max-height: 225px !important;
}
._li{
   max-height: 225px !important;
}
</style>
<!-- external javascripts -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="js/jquery-plugin-collection.js"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="">
<div id="wrapper" class="clearfix">
  <!-- preloader -->
  <div id="preloader">
    <div id="spinner">
      <img alt="" src="images/preloaders/5.gif">
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
  </div>
  
  <!-- Header -->
  
  <?php  
    include_once('header.php');
  ?>
  
  <!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white text-center">Gallery</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="index.php">Home</a></li>
                <li ><a href="javascript:void(0)">Events</a></li>
                <li class="active text-gray-silver">Gallery</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Gallery Grid 3 -->
    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Portfolio Filter -->
              <div class="portfolio-filter font-alt align-center mb-6 0">
                <a href="#" class="active" data-filter="*">All</a>
                <a href="#Secondary" class="" data-filter=".Secondary">Secondary</a>
                <a href="#H-Sigher-Secondary" class="" data-filter=".Higher-Secondary">Higher Secondary</a>
                <a href="#Diploma" class="" data-filter=".Diploma">Diploma</a>
                <!-- <a href="#event" class="" data-filter=".event">Event</a> -->
              </div>
              <!-- End Portfolio Filter -->

              <!-- Portfolio Gallery Grid -->
              
               <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">
                <!-- Portfolio Item Start -->
                <?php
               foreach ($output as $row) {
               echo '<div class="gallery-item '.$row['category'].'">
                  <div class="thumb" style=" height:250px !important;">
                    <img class="img-fullwidth img-thumbnail" src="academy_admin/images/gallery/'.$row['image_file'].'" alt="project" style="height:250px !important; ">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">'.$row['image_title'].'</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="academy_admin/images/gallery/'.$row['image_file'].'" data-lightbox-gallery="gallery" title="'.$row['image_title'].'" style="top:0px"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                &nbsp;
               ';

                    }

                   ?>  
                    <!-- Portfolio Item End -->
              </div> 
              <!-- End Portfolio Gallery Grid -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- end main-content -->
  
  <!-- Footer -->
  <?php include_once('footer.php'); ?>

</body>
</html>