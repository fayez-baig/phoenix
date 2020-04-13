<?php 
    
    include_once('login_check.php');

include_once('academy_admin/../source/config.php');

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
        $sql2 = "SELECT * FROM gallery ORDER BY updated DESC Limit 5";

        //Prepare sql query
        $stmt2 = $conn->prepare($sql2);
            
        if($stmt2->execute())
        {
            $output2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql = "SELECT * FROM teachers ";

            //Prepare sql query
            $stmt = $conn->prepare($sql);
            
            // $stmt->bindParam(':about_id', $_GET['id']);

            $stmt->execute();

            if($stmt->execute())
        {
            $outputtech = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="../academy_admin/../images/favicon.png" rel="shortcut icon" type="image/png">


    <title>Phoenix Tutorial || Dashboard</title>

    <!-- Bootstrap -->
    <link href="../academy_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../academy_admin/css/animate.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="../academy_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../academy_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../academy_admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../academy_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../academy_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../academy_admin/build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .btn-aj{
            position: fixed;
            bottom: 0px;
            top: 89%;
            right: 3px;
            border-radius: 65%;
            background: rgba(247, 46, 239, 0.38);
           box-shadow: 2px 2px 32px #337ab7;
        }
        .mybtn{
            border-radius: 50% 1px;
            font-size: 3em;
            height: 96px;
            position: fixed;
            bottom: 26px;
            right: 0px;
            background: rgba(51, 122, 183, 0.35);
        }
        .img-thumbs
        {
          width: 50px;
          height: 50px;
        }
        .dataTables_filter {
            width: auto !important;
        }

        .img-thumbs
        {
          width: 50px;
          height: 50px;
        }

        table tbody tr td{
          vertical-align: middle !important;
          text-transform: capitalize;
        }

        .check-text
        {
          position: relative;
          /*left: -10px;*/
          z-index: 1;
          pointer-events: none;
          /*top: 20px;*/
          text-align: center;
        }

        .bottom-bar
        {
          position: fixed;
          bottom: 0;
          left: 0;
          right: 0;
          background-color: rgba(0,0,0,0.7);
          padding: 5px;
          display: none;
        }

        .pagination>.active>a
        {
          z-index: 0 !important;
        }
        @media only screen and (min-width:768px){ 
          .notification{
          position: relative !important;
          /* top: -160px; */
          bottom: 437px !important;
          left: 41% !important;
        }
      }
      @media only screen and (min-width:768px){ 
          .notification{
          position: relative !important;
          /* top: -160px; */
          bottom: 437px !important;
          left: 41% !important;
        }
      }
     @media only screen and (max-width:375px){ 
          .notification{
          position: relative !important;
          /* top: -160px; */
          bottom:563px !important;
          left: 24% !important;
        }
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  ">
          <div class="left_col scroll-view">
            <?php include_once('sidebar.php'); ?>
          </div>
        </div>

        <?php include_once('header.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
                <div class="x_panel">
                 <marquee><h2>WELCOME <?=$name ?> TO PHOENIX TUTORIALS </h2></marquee>
                  <div class="x_title">
                   
                    
                    <div class="clearfix"></div>
                  </div>



            

      <div class="x_panel">
                  <div class="x_title">
                    <h2>Gallery Images</small></h2>
                    <ul class="nav navbar-left" style="    margin-left: 30%;">
                    </ul>
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
                  <div class="x_content table-responsive">
                    <p class="text-muted font-13 m-b-30">

                    </p>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action table-responsive">
                      <thead class="table-responsive">
                        <tr>
                          <th></th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Upload Date</th>
                        </tr>
                      </thead>


                      <tbody class="responsive">
                        <?php
                          $countt = 1;
                          $not_set = 'not set';
                          foreach ($output2 as $row2) {

                            $date = new DateTime();
                            $date->setTimestamp($row2['updated']);

                            if(trim($row2['image_title']) === '')
                                 { $title = "not set"; }
                            else { $title = $row2['image_title']; }

                            if(trim($row2['image_description']) === '')
                                 { $description = "not set"; }
                            else { $description = $row2['image_description']; }

                            echo '<tr>
                                    <td><div class="check-text">'.$countt.'</div></td>
                                    <td><img class="img-thumbs" src="../academy_admin/images/gallery/'.$row2['image_file'].'"></td>
                                    <td>'.$title.'</td>
                                    <td>'.$description .'</td>
                                    <td>'.$date->format('Y-m-d H:i').'</td>
                                  </tr>
                                  ';
                            $countt++;
                          }

                         ?>                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="" role="">
                <div class="x_panel">
              <div class="x_title">
                    <h2>Teachers</small></h2>
                    <ul class="nav navbar-right">
                    </ul>
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
        <?php
          $countt = 0;
          // $not_set = 'not set';
          foreach ($outputtech as $row) {
          	$path= "academy_admin/images/teachers/";
            echo '
            

                    <div class="col-md-4 col-sm-6 col-xs-12">
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
                          <div class="weather-icon">
                            <img scr="../academy_admin/../images/teachers/'.$row['image'].'">

                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="weather-text">
                            <img src="../'.$path.''.$row['image'].'" class="img-responsive" width="300px"height="200px">
                          </div>
                        </div>
                      </div>
                      
                      <div class="clearfix"></div>


                      <div class="row weather-days">
                        <div class="col-sm-12">
                          <div class="daily-weather">
                          <br>
                            <p>Designation : '.$row['designation'].'</p>
                          </div>
                          <blockquote class="theme-colored pt-20 pb-20">
                            <p class="mb-15"><i class="fa fa-facebook"> </i> &nbsp; <a href="'.$row['facebook'].'" target="_new">Facebook</a> </p>
                            <p class="mb-15"><i class="fa fa-twitter"> </i> &nbsp; <a href="'.$row['twitter'].'" target="_new">Twitter</a> </p>
                            <p class="mb-15"><i class="fa fa-instagram"> </i> &nbsp; <a href="'.$row['instagram'].'" target="_new">Instagram</a> </p>
                            <p class="mb-15"><i class="fa fa-whatsapp"> </i> &nbsp; WhatsApp : '.$row['whatsapp'].' </p>
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
    <script src="../academy_admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../academy_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../academy_admin/build/js/custom.min.js"></script>
    
  </body>
</html>
