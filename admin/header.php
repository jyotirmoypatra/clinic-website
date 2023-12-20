<?php
session_start();
$hostUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'];

if (!isset($_SESSION['username'])) {

  include_once 'autologin.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- base:css -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
    integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

  <link rel="stylesheet" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/images/logo.png" />
  <link rel="stylesheet" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/css/vertical-layout-light/style.css">

  


</head>

<body>
  <script>
    $(document).ready(function () {
      // Collapse/Expand for navigation items
      $('.nav-link[data-toggle="collapse"]').click(function (e) {
        e.preventDefault();

        var targetCollapseId = $(this).attr('href');
        var isCollapsed = $(targetCollapseId).hasClass('show');

        // Close other open menus
        $('.collapse.show').not(targetCollapseId).collapse('hide');

        // Expand or collapse the clicked menu
        if (!isCollapsed) {
          $(targetCollapseId).collapse('show');
        }
      });
    });
  </script>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/"><img
              src="<?php echo $hostUrl ?>/sanjiban-xray/admin/images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/"><img
              src="<?php echo $hostUrl ?>/sanjiban-xray/admin/images/logo.png" alt="logo" /></a>
         
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <i style="font-size: 30px;" class="fa fa-user-circle" aria-hidden="true"></i>
              <!-- <img src="<?php echo $hostUrl ?>/sanjiban-xray/admin/images/faces/face5.jpg" alt="profile"/> -->
              <span class="nav-profile-name">

                <?php

                if ($_SESSION['role'] == 1) {
                  echo $_SESSION['username'] . " (Admin)";
                } else {
                  echo $_SESSION['username'] . " (Receptionist)";
                }

                ?>

              </span>

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a href="<?php echo $hostUrl ?>/sanjiban-xray/admin/logout.php" class="dropdown-item">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-date dropdown">
            <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
              <h6 class="date mb-0">
                <?php echo "Today " . date("d-m-y"); ?>
              </h6>
              <i class="typcn typcn-calendar"></i>
            </a>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">



      <?php include("sidemenu.php"); ?>