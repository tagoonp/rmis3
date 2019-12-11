<?php
session_start();

include "../lib/connect.class.php";
$db = new database();
$db->connect();

if((isset($_GET['id_rs'])) && (isset($_GET['status'])) && (isset($_GET['sid'])) && (isset($_GET['username']))){

  $strSQL = sprintf("SELECT * FROM submit_feedback WHERE id_rs = '%s' AND sid = '%s' AND id_reviewer in ( SELECT id_reviewer FROM reviewer WHERE username = '%s')",
            mysql_real_escape_string($_GET['id_rs']),
            mysql_real_escape_string($_GET['sid']),
            mysql_real_escape_string($_GET['username'])
          );
  $result_check_priviledge = $db->select($strSQL,false,true);

  if($result_check_priviledge){ //มีสิทธิ์เข้า Review

    if($result_check_priviledge[0]['status_review'] != 0){
      //เคยผ่านการ review แล้ว
      $_SESSION['id'] = $result_check_priviledge[0]['id_reviewer'];
      session_write_close();
      $db->disconnect();
      ?>
      <script type="text/javascript">
        // ไม่มีสิทธิ์เข้า Review โครงการนี้
        window.location = 'already_review.php?id_rs=<?php echo $_GET['id_rs'];?>';
      </script>
      <?php
      die();
    }else{
      if($_GET['status']=='cannot_comment'){

        $_SESSION['id'] = $result_check_priviledge[0]['id_reviewer'];
        session_write_close();
        $db->disconnect();
        ?>
        <script type="text/javascript">
          window.location = 'cannot_review.php?id_rs=<?php echo $_GET['id_rs'];?>&sid=<?php echo $_GET['sid']; ?>';
        </script>
        <?php
        die();

      }else if($_GET['status']=='comment'){

        $_SESSION['id'] = $result_check_priviledge[0]['id_reviewer'];
        session_write_close();
        $db->disconnect();
        ?>
        <script type="text/javascript">
          window.location = 'start_review.php?id_rs=<?php echo $_GET['id_rs'];?>';
        </script>
        <?php
        die();

      }else if($_GET['status']=='comment_by_hard_copy'){

        $db->disconnect();
        ?>
        <script type="text/javascript">
          window.location = '../request_hard_review.php?id_rs=<?php echo $_GET['id_rs'];?>&id_reviewer=<?php echo $result_check_priviledge[0]['id_reviewer']; ?>';
        </script>
        <?php
        die();

      }else{
        $db->disconnect();
        ?>
        <script type="text/javascript">
          window.location = '../error-404.html';
        </script>
        <?php
        die();
      }
    }

  }else{
    $db->disconnect();
    ?>
    <script type="text/javascript">
      // ไม่มีสิทธิ์เข้า Review โครงการนี้
      window.location = '../error-reviewer-401.html';
    </script>
    <?php
    die();
  }

}else{
  $db->disconnect();
  ?>
  <script type="text/javascript">
    window.location = '../error-404.html';
  </script>
  <?php
  die();
}
?>
