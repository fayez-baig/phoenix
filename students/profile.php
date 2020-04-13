<?php 

  include_once('login_check.php');
    include_once('source/config.php');
     $user = $_SESSION['user'];

        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT * FROM register_online WHERE email= '$user'";

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
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Phoenix Tutorials || Dashboard</title>

    <!-- Bootstrap -->
    <link href="../academy_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../academy_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <link href="../academy_admin/css/file_upload.css" rel="stylesheet">

     <!-- PNotify -->
    <link href="../academy_admin/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../academy_admin/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../academy_admin/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <style type="text/css">
        /*to hide the default file upload button*/
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

       /* select option[value='']{
            color : #eee;
        }*/
        /*dont fix the hieght*/
        .stepContainer
        {
            height: auto !important;
        }
    </style>

    <!-- Custom Theme Style -->
    <link href="../academy_admin/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  menu_fixed">
          <div class="left_col scroll-view">
            <?php include_once('sidebar.php'); ?>
          </div>
        </div>

        <?php include_once('header.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
        <?php
          $countt = 0;
          // $not_set = 'not set';
          foreach ($output as $row) {
          	$path= "students/images/student/";
            echo '
            

                    <div class="col-sm-offset-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2> '.$row['name'].' <small></small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                         
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-4">
                          
                        </div>
                        <div class="col-sm-12">
                          <div class="weather-text">
                            <img src="../'.$path.''.$row['image'].'" class="img-thumbnail" width="300px"height="200px">
                          </div>
                        </div>
                      </div>
                      
                      <div class="clearfix"></div>


                      <div class="row weather-days">
                        <div class="col-sm-12">
                          <div class="daily-weather">
                          <br>
                            <p>Class : '.$row['course'].'
                            <small class="nav navbar-right panel_toolbox">
                            <a href="profile_add.php?reg_id='.$row['reg_id'].'" >Cheange Profile</a>
                            </small>
                            </p>

                          </div>
                          <blockquote class="theme-colored pt-20 pb-20">
                            <p class="mb-15"><i class="fa fa-user"> </i> &nbsp; Name : '.$row['name'].' </p>
                            <p class="mb-15"><i class="fa fa-envelope"> </i> &nbsp; Email : '.$row['email'].'</p>
                            <p class="mb-15"><i class="fa fa-phone"> </i> &nbsp; Phone : '.$row['phone'].'</p>
                          </blockquote>
                        </div>
                      <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                        
                ';
        $countt++;
      }
      ?>
      </div>
            </div>
        <!-- /page content -->

        <?php include_once('footer.php'); ?>
      </div>
    </div>

    <!-- jQuery -->
    <script src="../academy_admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../academy_admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../academy_admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../academy_admin/vendors/nprogress/nprogress.js"></script>

    <script type="text/javascript" src="../academy_admin/js/jquery.custom-file-input.js"></script>

    <!-- Jquery ajax form -->
    <script type="text/javascript" src="../academy_admin/js/jquery.form.js"></script>
    <!-- PNotify -->
    <script src="../academy_admin/vendors/pnotify/dist/pnotify.js"></script>
    <script src="../academy_admin/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../academy_admin/vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../academy_admin/build/js/custom.js"></script>
  </body>
</html>
