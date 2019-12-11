<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../lib/connect.class.php";
$db = new database();
$db->connect();

if((isset($_GET['id_rs'])) && (isset($_GET['status'])) && (isset($_GET['sid'])) && (isset($_GET['username']))){
  $strSQL = sprintf("SELECT * FROM reviewer WHERE username = '%s' AND SID = '%s' ",
            mysql_real_escape_string($_GET['username']),
            mysql_real_escape_string($_GET['sid'])
          );
  $result_check_priviledge = $db->select($strSQL,false,true);

  if($result_check_priviledge){ //มีสิทธิ์เข้า Review

    $_SESSION['id'] = $result_check_priviledge[0]['id_reviewer'];
    session_write_close();
    $db->disconnect();

    if($_GET['status']=='cannot_comment'){
      ?>
      <script type="text/javascript">
        window.location = 'cannot_review.php?id_rs=<?php echo $_GET['id_rs'];?>';
      </script>
      <?php
      die();
    }else if($_GET['status']=='comment'){
      ?>
      <script type="text/javascript">
        window.location = 'acknowledge_review.php?id_rs=<?php echo $_GET['id_rs'];?>';
      </script>
      <?php
      die();
    }else if($_GET['status']=='comment_by_hard_copy'){
      ?>
      <script type="text/javascript">
        window.location = 'request_hard_review.php?id_rs=<?php echo $_GET['id_rs'];?>&id_reviewer=<?php echo $result_check_priviledge[0]['id_reviewer']; ?>';
      </script>
      <?php
      die();
    }
  }else{
    $db->disconnect();
    ?>
    <script type="text/javascript">
      alert('Session denine!');
      window.location = '../error-404.html';
    </script>
    <?php
    die();
  }
}else{
  $db->disconnect();
  ?>
  <script type="text/javascript">
  alert('Session denine!');
    window.location = '../error-404.html';
  </script>
  <?php
  die();
}
?>
