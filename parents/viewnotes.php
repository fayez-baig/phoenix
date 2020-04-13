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
             $course       = $data['course'];
            
        }
    }
    catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            // $action = "";
        }

 try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Make a sql query
            $sql= "SELECT * FROM notes WHERE category='$course' ORDER BY id DESC ";

            //Prepare sql query
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            if($stmt->execute())
        {
            $output = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            // $action = "";
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

  <title>Phoenix Tutorials || Dashboard | View Notes</title>

  <!-- Bootstrap core CSS -->

  
  <link href="../academy_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="../academy_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../academy_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../academy_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../academy_admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../academy_admin/build/css/custom.min.css" rel="stylesheet">


  <link href="../academy_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../academy_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <style type="text/css">
            .img-thumbs
        {
          width: 50px;
          height: 50px;
        }
  </style>

  <script src="../academy_admin/js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

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
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>
                    Notes
                    <small>
                    </small>
                </h3>
            </div>

            
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Download <small>Notes</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <p class="text-muted font-13 m-b-30">
                  </p>
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Category</th>
                        <th>Topic Name</th>
                        <th>Image File</th>
                        <th>Description</th>
                        <th>Date of Upload</th>
                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>
                    <?php
                          $countt = 1;
                          
                          foreach ($output as $row) {
                          echo' <tr>
                                  <td><div class="check-text">'.$countt.'</div></td>
                                  <td>'.$row['category'].'</td>
                                  <td>'.$row['topic'].'</td>
                                  <td> <img class="img-thumbs" src="../resources/courses/'.$row['image_file'].'"></td>
                                  <td>'.$row['description'].'</td>
                                  <td>'.$row['upload_date'].'</td>
                                  <td><a href="../resources/notes/'.$row['pdf_file'].'"" target="_new" ">Download</a></td>

                                </tr>';
                                $countt++;
                    }
                      ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

    
          
                </div>
              </div>
              <!-- footer content -->
             <?php include_once('footer.php'); ?>
              <!-- /footer content -->

            </div>
            <!-- /page content -->
          </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
        </div>

       
        <!-- Datatables-->
        <script src="../academy_admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../academy_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.js"></script>
        <script src="../academy_admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../academy_admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../academy_admin/vendors/jszip/dist/jszip.min.js"></script>
        <script src="../academy_admin/vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="../academy_admin/vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="../academy_admin/../academy_admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../academy_admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
       
        <script src="../academy_admin/build/js/custom.js"></script> 


        <!-- pace -->
        <script src="../academy_admin/js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [ ],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>
        
</body>

</html>
