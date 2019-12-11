<?php
include "controller/config.class.php";
// $strSQL = "SELECT * FROM useraccount WHERE 1";
// if($query = mysqli_query($conn, $strSQL)){
//   while($row = mysqli_fetch_array($query)){
//     $sid = generateRandomString();
//     $strSQL = "UPDATE pm_team SET SID = '$sid' WHERE id = '".$row['id']."'";
//     $query2 = mysqli_query($conn, $strSQL);
//   }
// }

// $strSQL = "SELECT * FROM research WHERE 1";
// if($query = mysqli_query($conn, $strSQL)){
//   while($row = mysqli_fetch_array($query)){
//     $sid = generateRandomString();
//     $strSQL = "UPDATE research SET session_id = '$sid' WHERE id_rs = '".$row['id_rs']."'";
//     $query2 = mysqli_query($conn, $strSQL);
//   }
// }

// $strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm WHERE 1";
// if($query = mysqli_query($conn, $strSQL)){
//   echo "Found";
//   while($row = mysqli_fetch_array($query)){
//     $strSQL = "UPDATE pm_team SET co_user_id = '".$row['id']."', co_sess_id = '".$row['session_id']."' WHERE co_rs_id = '".$row['id_rs']."'";
//     $query2 = mysqli_query($conn, $strSQL);
//   }
// }

$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm WHERE 1";
if($query = mysqli_query($conn, $strSQL)){
  echo "Found";
  while($row = mysqli_fetch_array($query)){
    $strSQL = "UPDATE file_research_attached SET f_session_id = '".$row['session_id']."', f_user_id = '".$row['id']."' WHERE f_rs_id = '".$row['id_rs']."'";
    $query2 = mysqli_query($conn, $strSQL);
  }
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
