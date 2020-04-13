<?php 


  include_once('login_check.php');


 ?>

<div class="navbar nav_title" style="border: 0;">
  <a href="index.php" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Phoenix Tutorial</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<!-- <div class="profile">
  <div class="profile_pic">
    <img src="images/img.jpg" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Welcome,</span>
    <h2>John Doe</h2>
  </div>
</div> -->
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>Parent Dashboard</h3>
      <ul class="nav side-menu">
        <!-- <li><a href="index.php"><i class="fa fa-home"></i> Home </a></li> -->
        
        <li><a><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="profile.php">View </a></li>
            <!--<li><a href="candidate_add.php">Update candidate</a></li>-->
          </ul>
        </li>

        <li><a><i class="fa fa-rss-square"></i> Attendance <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="attendances.php">View</a></li>
          </ul>
        </li>

        <li><a><i class="fa fa-rss-square"></i> Teachers <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="teachers.php">List All</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-calendar"></i> Events <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="view_event.php">List All </a></li>
          </ul>
        </li>

        <li><a><i class="fa fa-thumbs-o-up"></i>Student Feedback <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="student.php">List All</a></li>
          </ul>
        </li>

        <li><a><i class="fa fa-image"></i> Gallery <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="gallery.php">List All</a></li>
          </ul>
        </li>
        <!-- <li><a><i class="fa fa-tasks"></i> Event Calender <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="viewcalender.php">List All</a></li>
            <li><a href="calender.php">Add New</a></li>
          </ul>
        </li> -->
        <li><a><i class="fa fa-tasks"></i> Course Notes <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="viewnotes.php">List All</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-tasks"></i> Fees <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="fees.php">View</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- <div class="menu_section">
      <h3>Live On</h3>
     
    </div> -->

  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a id="fullScreen" href="#1" data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" href="source/logout.php" data-placement="top" title="Logout">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->

  <script type="text/javascript" src="..js/screenfull.js"></script>
  <script type="text/javascript">
    const elem = document.getElementsByTagName('body')[0];

    document.getElementById('fullScreen').addEventListener('click', () => {
        if (screenfull.enabled) {
            screenfull.toggle();
        }
    });
  </script>