<?php 

  include_once('login_check.php');
    include_once('source/config.php');
    $phone= $_SESSION['userP'];
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Make a sql query
        $sql = "SELECT * FROM register_online where phone = :phone";

        //Prepare sql query
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $name       = $data['name'];
             $id       = $data['reg_id'];
            
        }
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
        $action = "";
    }

$post_title= '';

$output = [];

        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT * FROM attendance WHERE s_id='$id' ";

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


        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT count(*) as total FROM attendance WHERE s_id='$id' AND (status='P' or status='p') ";

            //Prepare sql query
            $stmt = $conn->prepare($sql);

            if($stmt->execute())
        {
            $outputp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            $action = "";
        }


        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT count(*) as absent FROM attendance WHERE s_id='$id' AND (status='A' or status='a') ";

            //Prepare sql query
            $stmt = $conn->prepare($sql);

            if($stmt->execute())
        {
            $outputa = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            $action = "";
        }

        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT count(*) as holiday FROM attendance WHERE s_id='$id' AND (status='H' or status='h') ";

            //Prepare sql query
            $stmt = $conn->prepare($sql);

            if($stmt->execute())
        {
            $outputh = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="../academy_admin/vendors/nprogress/nprogress.css" rel="stylesheet">

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

    <?php
      date_default_timezone_set('UTC');
      ?>
      <script>
      var d = new Date(<?php echo time() * 1000 ?>);
      function digitalClock() {
        d.setTime(d.getTime() + 1000);
        var hrs = d.getHours();
        var mins = d.getMinutes();
        var secs = d.getSeconds();
        mins = (mins < 10 ? "0" : "") + mins;
        secs = (secs < 10 ? "0" : "") + secs;
        var apm = (hrs < 12) ? "am" : "pm";
        hrs = (hrs > 12) ? hrs - 12 : hrs;
        hrs = (hrs == 0) ? 12 : hrs;
        var ctime = hrs + ":" + mins + ":" + secs + " " + apm;
        document.getElementById("clock").firstChild.nodeValue = ctime;
      }
      window.onload = function() {
        digitalClock();
        setInterval('digitalClock()', 1000);
      }
      </script>


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
                    <h2>Attendances Details<small><?=$name?></small>&nbsp;&nbsp; <span><?=date("F d, Y ");?></span> &nbsp;&nbsp;
<div id="clock" class="pull-right"> </div></h2>
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
        
            

                    <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                     <h2> Present <small></small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row weather-days">
                        <div class="col-sm-12">
                          <div class="daily-weather">
                          <br>
                          </div><?php foreach ($outputp as $p ) {
                              echo '<p >Total : '.$p['total'].'</p>';
                          }
                            ?>
                        </div>
                      <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                     <h2> Absent </h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row weather-days">
                        <div class="col-sm-12">
                          <div class="daily-weather">
                          <br>
                          </div>
                            <?php foreach ($outputa as $a ) {
                              echo '<p >Total : '.$a['absent'].'</p>';
                          }
                            ?>
                          
                        </div>
                      <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                     <h2> Holiday </h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row weather-days">
                        <div class="col-sm-12">
                          <div class="daily-weather">
                          <br>
                          </div>
                          <?php foreach ($outputh as $h ) {
                              echo '<p >Total : '.$h['holiday'].'</p>';
                          }
                            ?>
                        </div>
                      <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                        
                
      </div>

      <div class="x_panel">
                  <div class="x_title">
                    <h2>Attendances<small><?=$name?></small>&nbsp;&nbsp; <span> <?=date("F d, Y ");?></span> </h2>
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
          foreach ($output as $row) {
            echo '
            

                    <div class="col-md-2 col-sm-2 col-xs-6">
                  <div class="x_panel">
                    <div class="x_title">
                     <h2><small> '.$row['created_at'].' </small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row weather-days">
                        <div class="col-sm-12">
                          <div class="daily-weather">
                          </div>
                            <center><input type="text" name="atd" value="'.$row['status'].'" size="1px" style="text-align:center" disabled ></center>
                          
                        </div>
                      <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                </div>
                        
                ';
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
