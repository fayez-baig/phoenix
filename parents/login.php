<?php

session_start();
if (isset($_SESSION['parent'])) {
  header("location:index.php");        
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

    <title> Phoenix Tutorials || Parent Dashboard</title>

    <!-- Bootstrap -->
    <link href="../academy_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../academy_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../academy_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../academy_admin/vendors/animate.css/animate.min.css" rel="stylesheet">

     <!-- PNotify -->
    <link href="../academy_admin/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../academy_admin/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../academy_admin/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="../academy_admin/build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .dark-danger .alert{
        background-color: rgba(156, 5, 5, 0.86);
        border-color: rgba(132, 6, 6, 0.88);
      }

      .dark-success .alert{
        background-color: rgba(4, 105, 10, 0.86);
        border-color: rgba(4, 99, 22, 0.88);
      }
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="loginForm" action="source/login.php" method="POST">
              <h1>Parent Login</h1>
              <div>
                <!--<input type="text" class="form-control" placeholder="Useremail" name="username" required="" />-->
                <select class="form-control"  name="username" required="" />
                	<option value="" >Select Course</option> 
                  <option value="Secondary">Secondary</option> 
                	<option value="Higher Secondary">Higher Secondary</option> 
                	<option value="Diploma">Diploma</option>
                </select>
              </div>
              <br>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Parent" name="parent" value="Parent" disabled />
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" value="Log in" name="login">
                <!--<a class="reset_pass" href="forgotPassword.php">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i> Phoenix Tutorials</h1>
                  <p>©2016 - <?php echo date("Y"); ?> All Rights Reserved. Phoenix Tutorials</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          
        </div>
      </div>
    </div>


    <!-- jQuery -->
    <script src="../academy_admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Jquery ajax form -->
    <script type="text/javascript" src="../academy_admin/js/jquery.form.js"></script>
    <!-- PNotify -->
    <script src="../academy_admin/vendors/pnotify/dist/pnotify.js"></script>
    <script src="../academy_admin/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../academy_admin/vendors/pnotify/dist/pnotify.nonblock.js"></script>

     <!-- Form submit -->
    <script type="text/javascript">
      // prepare the form when the DOM is ready 
      $(document).ready(function() {

          var options = { 
              //target:        '#output1',   // target element(s) to be updated with server response 
              beforeSubmit:  showRequest,  // pre-submit callback 
              success:       showResponse  // post-submit callback 
       
              // other available options: 
              //url:       url         // override for form's 'action' attribute 
              //type:      type        // 'get' or 'post', override for form's 'method' attribute 
              //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
              //\clearForm: true        // clear all form fields after successful submit 
              //resetForm: true        // reset the form after successful submit 
       
              // $.ajax options can be used here too, for example: 
              //timeout:   3000 
          }; 
       
          // bind form using 'ajaxForm' 
          $('#loginForm').ajaxForm(options); 

      }); 
      
      var notice = null;
      // pre-submit callback 
      function showRequest(formData, jqForm, options) { 

        
            notice = new PNotify({
            text: "Please Wait",
            type: 'info',
            icon: 'fa fa-spinner fa-spin',
            hide: false,
            buttons: {
                closer: false,
                sticker: false
            },
             opacity: .75,
            // shadow: false,
            addclass: 'dark',
            styling: 'bootstrap3',
            width: "170px"
        });

        notice.update({
            title: false
        });
      } 
       
      // post-submit callback 
      function showResponse(responseText, statusText, xhr, $form)  { 

            var vtitle = "Failed!";
            var vtype = "info";
            var vicon = 'fa fa-close';
            var classTemp = "dark-danger";

            if(responseText.indexOf("Success") != -1)
            {
              classTemp = "success";
              vtitle = "Success";
              vtype = "success";
              vicon = "'fa fa-check";
            }

            var options = {
                text: responseText,
                title : vtitle,
                type : vtype,
                hide : true,
                buttons : {
                    closer: true,
                    sticker: true
                },
                addclass : classTemp,
                icon : vicon,
                opacity : 1,
                shadow : true,
                width : PNotify.prototype.options.width,
            };
        
            notice.update(options);

            if(classTemp == "success")
            {
                //redirect
                setTimeout(function(){
                    window.location.replace("index.php");
                }, 1500);
            }
      } 
    </script>
    <!-- /form submit -->


  </body>
</html>
