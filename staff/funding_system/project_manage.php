<?php

include "./config.class.php";
include "./connect.class.php";
include "./function.class.php";

$rec = null;
if((!isset($_GET['id'])) || ($_GET['id'] == '')){
  header('Location: ./');
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_GET['id']);
$result_research_status = false;

$strSQL = "SELECT * FROM research a LEFT JOIN type_status_research b ON a.id_status_research = b.id_status_research
           LEFT JOIN useraccount c ON a.id_pm = c.id_pm
           LEFT JOIN userinfo d ON c.id = d.user_id
           WHERE
           a.id_rs = '".$id_rs."'
           AND a.id_status_research = '18'";
$result_research = mysqli_query($conn, $strSQL);
$research_data = null;
if(($result_research) && (mysqli_num_rows($result_research) > 0)){
  $result_research_status = true;
  $research_data = mysqli_fetch_assoc($result_research);
}

$final_budget_status = '0';
$fund_reciver_status = '0';

if($result_research_status){
  if(($research_data['final_budget'] == '0') || ($research_data['final_budget'] == '') || ($research_data['final_budget'] == NULL)){

  }else{
    $final_budget_status = '1';
  }


  $strSQL = "SELECT * FROM funding_person WHERE fp_id_rs = '$id_rs' AND fp_status = '1'";
  $result_fund_person = mysqli_query($conn, $strSQL);
  $result_fund_person_data = null;
  if(($result_fund_person) && (mysqli_num_rows($result_fund_person) > 0)){
    $fund_reciver_status = '1';
    $result_fund_person_data = mysqli_fetch_assoc($result_fund_person);
  }
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
            <h1><i class="fas fa-pencil-alt mr-2" style="font-size: 1em;"></i> จัดการข้อมูลทุน</h1>
            <input type="hidden" id="txtIdrs" value="<?php echo $id_rs;?>">
          </div>

          <div class="section-body">
            <?php //print_r($research_data); ?>
            <h6 class="text-dark"><span class='text-danger'>ส่วนที่ 1 : </span>ข้อมูลเบื้องต้นโครงการ</h6>
            <div class="card mb-1">
              <div class="card-body p-0">
                <table class="table table-sm table-striped- table-bordered pb-0 mb-0">
                  <tbody>
                    <tr>
                      <td  class="text-dark" style="width: 25% !important;"><strong>REC.</strong> </td>
                      <td class="text-primary" colspan="3"><?php echo $research_data['code_apdu']; ?></td>
                    </tr>
                    <tr>
                      <td class="text-dark"><strong>ชื่อโครงการ (ไทย)</strong></td>
                      <td colspan="3"><?php echo $research_data['title_th']; ?></td>
                    </tr>
                    <tr>
                      <td class="text-dark"><strong>ชื่อโครงการ (English)</strong></td>
                      <td colspan="3"><?php echo $research_data['title_en']; ?></td>
                    </tr>
                    <tr>
                      <td class="text-dark"><strong>หัวหน้าโครงการ</strong></td>
                      <td colspan="3">
                        <?php echo $research_data['fname']." ".$research_data['lname']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-dark"><strong>ผู้รับทุน</strong></td>
                      <td colspan="3"><a href="Javascript:showModal('modal_person')" class="mr-2"><i class="fas fa-pencil-alt"></i></a><?php if($fund_reciver_status == '1'){ echo $result_fund_person_data['fp_fullname'];}else{echo "ไม่มีข้อมูลผู้รับทุน";} ?></td>
                    </tr>
                    <tr>
                      <td class="text-dark"><strong>จำนวนเงินทุนที่ขอ</strong></td>
                      <td><?php echo number_format($research_data['budget'])." บาท"; ?></td>
                      <td style="width: 15% !important;" class="text-dark"><strong>ทุนที่ได้รับจริง</strong></td>
                      <td><a href="Javascript:showModal('modal_final_bidget')" class="mr-2"><i class="fas fa-pencil-alt"></i></a><?php echo number_format($research_data['final_budget'])." บาท"; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="pb-4 pt-2">
              <button type="button" class="btn btn-primary btn-sm bsdn pr-3 pl-3">ดูไฟล์ข้อมูลโครงการ</button>
              <button type="button" class="btn btn-primary btn-sm bsdn pr-3 pl-3">ดูข้อมูลทุนวิจัยที่ขอ</button>
              <button type="button" class="btn btn-primary btn-sm bsdn pr-3 pl-3">ดูใบรับรอง</button>
            </div>

            <h6 class="text-dark"><span class='text-danger'>ส่วนที่ 2 : </span>ข้อมูลทุน (กรณีขอทุนคณะแพทยศาสตร์)</h6>

            <?php
            // echo $final_budget_status;
            // echo $fund_reciver_status;
            if(($final_budget_status != '0') && ($fund_reciver_status != '0')){
              ?>
              <div class="pb-2">
                <button type="button" class="btn btn-danger btn-sm bsdn pr-3 pl-3" onclick="showModal('modal_stagement')"><i class="fas fa-plus mr-2"></i> เพิ่มข้อมูลทุน</button>
                <button type="button" class="btn btn-danger btn-sm bsdn pr-3 pl-3"><i class="fas fa-print mr-2"></i> พิมพ์ข้อมูลการรับทุนของโครงการ</button>
              </div>
              <div class="card p-0">
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table   table-striped- pb-0 mb-0">
                      <thead class="bg-primary">
                        <tr>
                          <th class=" text-white" style="width: 50px;">#</th>
                          <th class=" text-white">รายการ</th>
                          <th class=" text-white">จำนวนเงิน</th>
                          <th class=" text-white" style="width: 180px;"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>จำนวนเงินทุนที่ขอ</td>
                          <td><?php echo number_format($research_data['budget']); ?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>จำนวนเงินทุนที่ได้รับจริง</td>
                          <td><?php echo number_format($research_data['final_budget']); ?></td>
                          <td></td>
                        </tr>
                        <?php
                        $c = 3;
                        $strSQL = "SELECT * FROM funding_stagement WHERE fs_id_rs = '$id_rs' ORDER BY fs_udatetime";
                        $resultStagement = mysqli_query($conn, $strSQL);
                        if(($resultStagement) && (mysqli_num_rows($resultStagement) > 0)){
                            while($rowStagement = mysqli_fetch_array($resultStagement)){
                              ?>
                              <tr>
                                <td><?php echo $c;?></td>
                                <td><?php echo $rowStagement['fs_desc_1'];?></td>
                                <td><?php echo number_format($rowStagement['fs_amount']); ?></td>
                                <td></td>
                              </tr>
                              <?php
                              $c++;
                            }
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php
            }else{
              ?>
              <div class="alert alert-danger">
              <i class="fas fa-exclamation-triangle"></i>  กรุณาเพิ่มข้อมูลผู้รับทุน และจำนวนทุนที่ได้รับจริงก่อน
              </div>
              <?php
            }
            ?>

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
  <script src="../../v3/main.js"></script>
  <script src="../../v4/staff.js"></script>

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
                      if((snap.length > 0) && (snap != '')){
                        window.location = './search_result?key=' + $('#txtSearch').val()
                      }else{
                        preload.hide();
                        swal("ขออภัย", "ไม่พบโครงการวิจัยที่ท่านต้องการ", "error")
                      }
                    })

      })

      $('#txtSearchperson').keyup(function(){
        $k = $('#txtSearchperson').val()

        if($k != ''){
          $('#person_list').html('<div class="text-center pt-5 pb-5"><i class="fas fa-spinner fa-spin" style="font-size: 2.5em;"></i></div>')
          var param = {
            sk: $k
          }
          var jxhr = $.post(ws_url + 'controller/funding/get_personal.php', param, function(){},'json')
                      .always(function(snap){
                        console.log(snap);
                        if((snap.length > 0) && (snap != '')){
                          $('#person_list').empty()
                          snap.forEach(i=>{
                            $fname = i.name + ' ' + i.surname;
                            $('#person_list').append('<div class="row">' +
                                                        '<div class="col-9 pt-1">' +
                                                          '<div class="text-primary"><span class="text-muted">[ ' + i.id_per + ' ]</span> ' + i.name + ' ' + i.surname + '</div>' +
                                                        '</div>' +
                                                        '<div class="col-3 text-right">' +
                                                          '<button class="btn btn-primary bsdn btn-sm btn-icon" onclick="setPersonFunding(\'' + i.id_per + '\', \'' + $fname + '\')"><i class="fas fa-check"></i></button>' +
                                                        '</div>' +
                                                        '<div class="col-12"><hr style="border-color: rgb(231, 231, 231);"></div>' +
                                                     '</div>')
                          })
                        }else{
                          $('#person_list').html('<div class="text-center">ไม่พบข้อมูล</div>')
                        }
                      })
        }else{
          $('#person_list').html('<div class="text-center">ไม่พบข้อมูล</div>')
        }

      })

      $('#txtFinalBudgetForm').submit(function(){
        if($('#txtFinal').val() == ''){
          $('#txtFinal').addClass('is-invalid')
          return ;
        }

        swal({    title: "ยืนยันดำเนินการ",
                text: "กรุณาตรวจสอบข้อมูลการกดปุ่มบันทึก!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "บันทึก",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: true
              },function(){
                preload.show()
                $('.btnCloseModal').trigger('click')
                var param = {
                  id_rs: $('#txtIdrs').val(),
                  uid: current_user,
                  new_final: $('#txtFinal').val()
                }
                var jxhr = $.post(ws_url + 'controller/funding/set_final_budget.php', param, function(){})
                            .always(function(resp){
                              console.log(resp);
                              if(resp == 'Y'){
                                setTimeout(function(){
                                  window.location.reload()
                                }, 1000)
                              }else{
                                setTimeout(function(){
                                  preload.hide()
                                  swal("เกิดข้อผิดพลาด!", "ไม่สามารถบันทึกข้อมูลผู้รับทุนได้!", "error")
                                }, 1000)
                              }
                            })
              });


      })
    })

    function setPersonFunding(id_per, name){
      swal({    title: "ยืนยันดำเนินการ",
              text: "กรุณาตรวจสอบข้อมูลการกดปุ่มบันทึก!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "บันทึก",
              cancelButtonText: "ยกเลิก",
              closeOnConfirm: true
            },function(){
              $('.btnCloseModal').trigger('click')
              preload.show()
              var param = {
                id: id_per,
                id_rs: $('#txtIdrs').val(),
                fname: name,
                uid: current_user
              }
              var jxhr = $.post(ws_url + 'controller/funding/set_funding_personal.php', param, function(){})
                          .always(function(resp){
                            if(resp == 'Y'){
                              window.location.reload()
                            }else{
                              setTimeout(function(){
                                preload.hide()
                                swal("เกิดข้อผิดพลาด!", "ไม่สามารถบันทึกข้อมูลผู้รับทุนได้!", "error")
                              }, 1000)
                            }
                          })
            });
    }
  </script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="modal_person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ค้นหาชื่อผู้รับทุน</h5>
        <button type="button" class="close btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" name="txtSearchperson" id="txtSearchperson" placeholder="ค้นหาด้วยชื่อหรือรหัสบุคลากร ...">
        </div>
        <div style="max-height: 500px; overflow: hidden; overflow-y: scroll;" class="p-3" id="person_list">
          <div class="text-center">
            ไม่พบข้อมูล
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_final_bidget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลจำนวนเงินทุนวิจัยที่ได้รับจริง</h5>
        <button type="button" class="close btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="txtFinalBudgetForm" onsubmit="return false;">
          <div class="form-group">
            <label for="">จำนวนเงินทุนวิจัยที่ได้รับจริง <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="txtFinal" id="txtFinal" placeholder="กรอกเฉพาะตัวเลขโดยไม่มีเครื่องหมายจุลภาค (,) ...">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block bsdn">บันทึก</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_stagement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่ม/แก้ไข ข้อมูลทุน</h5>
        <button type="button" class="close btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-12 col-sm-6">
            <label for="">ประเภทการกลุ่มการบันทึก <span class="text-danger">*</span> </label>
            <select class="form-control" name="">
              <option value="">การเบิกเงิน</option>
              <option value="">งบประมาณที่ขอเพิ่ม</option>
            </select>
          </div>

          <div class="form-group col-12 col-sm-6">
            <label for="">งวดที่ <span class="text-danger">*</span> </label>
            <input type="text" name="" value="" class="form-control">
          </div>

          <div class="form-group col-12 col-sm-6">
            <label for="">วันที่ <span class="text-danger">*</span> </label>
            <input type="text" name="" value="" class="form-control">
          </div>

          <div class="form-group col-12 col-sm-6">
            <label for="">จำนวนเงิน <span class="text-danger">*</span> </label>
            <input type="text" name="" value="" class="form-control">
          </div>

          <div class="form-group col-12">
            <label for="">งวดที่ <span class="text-danger">*</span> </label>
            <input type="text" name="" value="" class="form-control">
          </div>

          <div class="form-group col-12">
            <label for="">รายละเอียดอื่น/บันทึก/ข้อมูลเพิ่มเติม <span class="text-danger">*</span> </label>
            <input type="text" name="" value="" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-lg btn-block bsdn">บันทึก</button>
        </div>
      </div>
    </div>
  </div>
</div>
