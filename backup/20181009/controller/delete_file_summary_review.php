<?php
session_start();

include "../lib/connect.class.php";
$db = new database();
$db->connect();

if (isset($_POST['file_id'])) {

    $strSQL = "DELETE FROM temp_file_summary_review
              WHERE tf_id = '".$_POST['file_id']."'  ";
    $result = $db->delete($strSQL);

}

$db->disconnect();
die();
?>
