<?php
header("Access-Control-Allow-Origin: *");

require "../lib/connect.class.php";

$db = new database();
$db->connect();

if(!isset($_POST['user'])){
  die();
}

$return = '';

$strSQL = sprintf(
          "UPDATE
            log_activity
          SET
            log_view = '1'
          WHERE
            log_by = '%s'
          ", mysql_real_escape_string($_POST['user']));
$result = $db->update($strSQL);


die();
