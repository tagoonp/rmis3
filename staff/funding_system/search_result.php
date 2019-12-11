<?php

include "./config.class.php";
include "./connect.class.php";
include "./function.class.php";

$rec = null;
if((!isset($_GET['key'])) || ($_GET['key'] == '')){
  header('Location: ./');
  die();
}

$rec = mysqli_real_escape_string($conn, $_GET['key']);
$result_research_status = false;

$strSQL = "SELECT * FROM research a LEFT JOIN type_status_research b ON a.id_status_research = b.id_status_research WHERE a.code_apdu LIKE '$rec%' AND a.id_status_research = '18'";
$result_research = mysqli_query($conn, $strSQL);
if(($result_research) && (mysqli_num_rows($result_research) > 0)){
  $result_research_status = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>RMIS : ระบบทุนวิจัย</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="./node_modules/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="./node_modules/preload.js/dist/css/preload.css">
  <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="./assets/admin_template/css/style.css">
  <link rel="stylesheet" href="./assets/admin_template/css/components.css">
  <link rel="stylesheet" href="./assets/core/css/master-style.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto" id="searchProjectform" onsubmit="return false;">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" id="txtSearch" type="search" value="<?php echo $rec; ?>" placeholder="ค้นหาด้วยรหัส REC" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#NISA</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  NISA Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle dn"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Alfa Zulkarnain</b>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle dn"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to NISA template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <span class="currentUserFullname">Loading ...</span></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="features-profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-changepassword" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Change password
              </a>
              <div class="dropdown-divider"></div>
              <a href="Javascript:authen.signout()" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <?php include "componants/menu.php";   ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><i class="fas fa-search mr-2" style="font-size: 1em;"></i> ผลการค้นหาโครงการ</h1>
          </div>

          <div class="section-body">
            <div class="card p-0">
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped- pb-0 mb-0">
                    <thead class="bg-primary">
                      <tr>
                        <th class=" text-white" style="width: 50px;">#</th>
                        <th class=" text-white" style="width: 150px;">REC</th>
                        <th class=" text-white">ชื่อโครงการ</th>
                        <th class=" text-white" style="width: 180px;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      if($result_research_status){
                        $c = 1;
                        while($row = mysqli_fetch_array($result_research)){
                          $btn = '<button class="btn btn-warning bsdn btn-sm" onclick="window.location=\'project_manage?id='.$row['id_rs'].'\'"><i class="fas fa-pencil-alt"></i></button>'
                          ?>
                          <tr>
                            <td style="vertical-align: top; padding-top: 10px; padding-bottom: 10px;"><?php echo $c; ?></td>
                            <td style="vertical-align: top; padding-top: 10px; padding-bottom: 10px;">
                              <?php echo $row['code_apdu']; ?>
                            </td>
                            <td style="vertical-align: top; padding-top: 10px; padding-bottom: 10px;">
                              <?php
                              if($row['title_th'] == '-'){
                                echo $row['title_en'];
                              }else{
                                echo $row['title_th']." (".$row['title_en'].")";
                              }
                              ?>
                              <div class="fs09 pt-1">
                                สถานะโครงการ : <span class="text-danger"><?php echo $row['status_name']; ?></span>
                              </div>
                            </td>
                            <td style="vertical-align: top; padding-top: 10px; padding-bottom: 10px;" class="text-right">
                              <?php echo $btn; ?>
                            </td>
                          </tr>
                          <?php
                          $c++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="4" class="text-center bg-white">ไม่พบโครงการที่ต้องการ</td>
                        </tr>
                        <?php
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="./node_modules/jquery/dist/jquery.js" ></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="./node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="./node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="./node_modules/preload.js/dist/js/preload.js"></script>

  <script src="./node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="./node_modules/moment/min/moment.min.js"></script>
  <script src="./assets/admin_template/js/stisla.js"></script>
  <script src="./assets/admin_template/js/scripts.js"></script>

  <script src="../../v4/config.js"></script>
  <!-- <script src="../../v3/main.js"></script>
  <script src="../../v4/staff.js"></script> -->

  <script type="text/javascript">
    $(document).ready(function(){
      preload.hide()
    })

    $(function(){
      $('#searchProjectform').submit(function(){
        if($('#txtSearch').val() == ''){
          swal("คำเตืิอน!", "กรุณากรอกรหัส REC สำหรับการค้นหา", "error")
          return ;
        }

        var param = {
          search_id: $('#txtSearch').val(),
          uid: current_user
        }

        preload.show()

        var jxhr = $.post(ws_url + 'controller/funding/get_research_info.php', param, function(){},'json')
                    .always(function(snap){
                      console.log(snap);
                      if((snap.length > 0) && (snap != '')){
                        window.location = './search_result?key=' + $('#txtSearch').val()
                      }else{
                        preload.hide();
                        swal("ขออภัย", "ไม่พบโครงการวิจัยที่ท่านต้องการ", "error")
                      }
                    })

      })
    })
  </script>
</body>
</html>
