<?php
 include_once('academy_admin/source/config.php');
// $post_title=$_POST['post_title'];
$post_title= '';

$output = [];
// $action = "source/package_form.php";

        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT * FROM post ";

            //Prepare sql query
            $stmt = $conn->prepare($sql);
            
            // $stmt->bindParam(':about_id', $_GET['id']);

            $stmt->execute();

            if($stmt->execute())
        {
            $output = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            $action = "";
        }

?>

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
<title>Niamah | Blogs</title>

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

<!-- CSS | Theme Color -->
<link href="css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">
<style type="text/css">
  .mytxt{
    white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
  }
</style>
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
<div id="wrapper" class="clearfix">
  <!-- preloader -->
  <div id="preloader">
    <div id="spinner">
      <img alt="" src="images/preloaders/5.gif">
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
  </div>
  
  <!-- Header -->
  <?php include_once('header.php'); ?>

  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-8" data-bg-img="images/bg/bg6.jpg">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3 class="font-28 text-white">Blogs</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="#">Re</a></li> -->
                <li class="active text-white">Resources </li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-0">
        <div class="row multi-row-clearfix">
          
          <?php 
            foreach ($output as $row1) {
                echo '<div id="blog-posts-wrapper" class="blog-posts">
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    <article class="post clearfix maxwidth600 mb-30">
                      <div class="entry-header">
                        <div class="post-thumb thumb"> <img src="academy_admin/images/blogs/'.$row1['post_image'].'" alt="'.$row1['post_title'].'" class="img-responsive img-fullwidth"> </div>
                      </div>
                      <div class="entry-content border-1px p-20">
                        <h5 class="entry-title mt-0 pt-0"><a href="single_page_blog.php?id='.$row1['id'].'">'.$row1['post_title'].'</a></h5>
                        <ul class="list-inline entry-date font-12 mt-5">
                          <li class="pr-0"><a class="text-theme-colored" href="#">Admin |</a></li>
                          <li class="pl-0"><span class="text-theme-colored">'.$row1['post_date'].'</span></li>
                        </ul>
                        <p class="text-left mb-20 mt-15 font-13 mytxt" >'.$row1['post_description'].'</p>
                        <blockquote class="theme-colored pt-20 pb-20">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                          <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                        <a class="btn btn-dark btn-theme-colored btn-xs btn-flat mt-0" href="single_page_blog.php?id='.$row1['id'].'">Read more</a>
                        <p class="pull-right">
                          <span class=" glyphicon glyphicon-thumbs-up counter">'.$row1['like_num'].'</span>&nbsp;&nbsp;&nbsp;
                          <span class=" glyphicon glyphicon-thumbs-down counter">'.$row1['dislike_num'].'</span>
                        </p>
                        <div class="clearfix"></div>
                      </div>
                    </article>
                  </div>
                </div> 
           
          <!-- Infinity Loadmore Button -->
          <div id="load-next-posts" class="p-15 pt-0 pb-0 hidden" >
            <a href="#" class="btn btn-default btn-lg btn-block">Load more...</a>
          </div>';
        
              }

          ?>

          <!-- Infinity Loadmore Script -->
          

        </div>
      </div>
    </section>
    <script>
            $(window).load(function(){
              $('#load-next-posts a').appear();
              $(document.body).on('appear', '#load-next-posts a', function() {
                var $infinityload_container = $('#blog-posts-wrapper');
                $infinityload_container.infinitescroll({
                  //debug         : true,
                  loading: {
                    finishedMsg: '<i class="fa fa-check"></i>',
                    msgText: '<i class="fa fa-spinner fa-spin"></i>',
                    img: "images/preloaders/1.gif",
                    speed: 'normal'
                  },
                  state: {
                    isDone: false
                  },
                  nextSelector: "#load-next-posts a",
                  navSelector: "#load-next-posts",
                  itemSelector  : "#blog-posts-wrapper > .col-sm-6",
                  //behavior: 'twitter'
                },
                function( newElements ) {
                  $infinityload_container.find('#infscr-loading').remove();
                });
              });
            });
          </script>
  </div>
  <!-- end main-content -->

  <!-- Footer -->
  <?php include_once('footer.php'); ?>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<!-- <script src="js/custom.js"></script> -->

</body>

<!-- Mirrored from kodesolution.com/demo/wxyz/w/learnpress/v2.0/demo/blog-extra-infinity-scroll-lazyload.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 08:09:53 GMT -->
</html>