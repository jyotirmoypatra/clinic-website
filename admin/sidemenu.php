<?php
                $hostUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'];
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $hostUrl ?>/sanjiban-xray/admin">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard</span>
              
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Reception/Billing</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
              
                <li class="nav-item"> <a class="nav-link" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/pages/addpatient.php">New Patient Entry/Add Test</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/pages/listpatientpage.php">Patient List/Search Patient</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/pages/testcategorypage.php">Test Category Entry</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/pages/testaddpage.php">Test Name Entry</a></li>
               
              </ul>
            </div>
          </li>
          <?php 
           if ($_SESSION['role'] ==1){ ?>
         
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="typcn typcn-film menu-icon"></i>
              <span class="menu-title">Administrator</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/pages/adduser.php">Add User</a></li>
              
                <li class="nav-item"><a class="nav-link" href="#">View Transections</a></li>
              </ul>
            </div>
          </li>
         <?php  } ?>
        
        </ul>
      </nav>