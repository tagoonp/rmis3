<?php
session_start();

include "../lib/connect.class.php";
$db = new database();
$db->connect();

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = '../tmp_file/';  //4
    $filename = 'file-summary-review-'.date('Y-m-d-H-i-s').$_FILES['file']['name'];
    $targetFile =  $targetPath. $filename;  //5
    move_uploaded_file($tempFile,$targetFile); //6

    $strSQL = "INSERT INTO temp_file_summary_review (tf_name,	tf_session_id, tf_date, tf_id_reviewer, tf_id_rs) VALUES ('".$filename."', '".session_id()."', '".date('Y-m-d')."', '".$_SESSION['id']."', '".$_POST['rs_p']."') ";
    $result_update = $db->insert($strSQL, false, true);
}

$db->disconnect();
?>
