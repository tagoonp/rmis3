<?php

include "../lib/connect.class.php";
$db = new database();
$db->connect();

if (!empty($_FILES)) {

    // $sess = session_id();

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = '../tmp_file/';  //4
    $filename = 'file-progress-'.$_POST['txtProgressIDs'].'-'.date('Y-m-d-H-i-s').$_FILES['file']['name'];
    $targetFile =  $targetPath. $filename;  //5
    move_uploaded_file($tempFile,$targetFile); //6


    $strSQL = "INSERT INTO temp_file_progress_add (tf_name,	tf_progress, tf_session_id, tf_date) VALUES ('".$filename."', '".$_POST['txtProgressIDs']."','".$_POST['txtSessionID']."', '".date('Y-m-d')."') ";
    $result_update = $db->insert($strSQL, false, true);

    echo "Y";
}

$db->disconnect();
?>
