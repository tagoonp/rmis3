<?php
include "controller/config.class.php";
// $strSQL = "SELECT * FROM useraccount WHERE 1";
// if($query = mysqli_query($conn, $strSQL)){
//   while($row = mysqli_fetch_array($query)){
//
//       $strSQL = "SELECT * FROM reviewer WHERE email = '".$row['email']."'";
//       if($query2 = mysqli_query($conn, $strSQL)){
//         $nr = mysqli_num_rows($query2);
//         if($nr > 0){
//
//             $strSQL = "UPDATE useraccount SET reviewer_role = '1', usertype = 'reviewer' WHERE id = '".$row['id']."'";
//             mysqli_query($conn, $strSQL);
//
//             $strSQL = "UPDATE reviewer SET update_flag = '1' WHERE email = '".$row['email']."'";
//             mysqli_query($conn, $strSQL);
//
//             echo "Updated email ".$row['email'];
//
//         }
//       }
//   }
// }

$strSQL = "SELECT * FROM reviewer WHERE update_flag = '0'";
if($query = mysqli_query($conn, $strSQL)){
  while($row = mysqli_fetch_array($query)){
    $strSQL = "SELECT * FROM useraccount WHERE email = '".$row['email']."'";
    if($query2 = mysqli_query($conn, $strSQL)){
      $nr = mysqli_num_rows($query2);
      if($nr > 0){

        $datac = mysqli_fetch_assoc($query2);

        $strSQL = "UPDATE useraccount SET reviewer_role = '1' WHERE email = '".$row['email']."'";
        mysqli_query($conn, $strSQL);

        $strSQL = "UPDATE reviewer SET update_flag = 1 WHERE email = '".$data['email']."'";
        mysqli_query($conn, $strSQL);

        echo "Insert " . $data['email']. " - " . $datac['id_pm'] . " success <br>";

      }else{
        $data = mysqli_fetch_assoc($query);
        $strSQL = "SELECT * FROM personnel WHERE name = '".$data['name']."' AND surname = '".$data['surname']."'";
        $query3 = mysqli_query($conn, $strSQL);
        $id_pm = null;
        $d = null;
        if($query3){
          $nr2 = mysqli_num_rows($query3);
          if($nr > 0){
            $data2 = mysqli_fetch_assoc($query3);
            $id_pm = $data2['id_per'];
            $d = $data2['dept'];
          }
        }

        $strSQL = "SELECT MAX(id) id FROM useraccount WHERE 1";
        $query_id = mysqli_query($conn, $strSQL);
        $dat = mysqli_fetch_assoc($query_id);
        $uid = intval($dat['id']) + 1;

        if($id_pm == null){
          $id_pm = 'PI_0'.$uid;
        }

        $id_dept = 32;
        if($d == 'ภ.ศัลยศาสตร์'){
          $id_dept = 10;
        }else if($d == 'ภ.กายภาพบำบัด'){
          $id_dept = 30;
        }else if($d == 'ภ.กุมารเวชศาสตร์'){
          $id_dept = 1;
        }else if($d == 'ภ.จักษุวิทยา'){
          $id_dept = 2;
        }else if($d == 'ภ.จิตเวชศาสตร์'){
          $id_dept = 3;
        }else if($d == 'ภ.ชีวเวชศาสตร์'){
          $id_dept = 4;
        }else if($d == 'ภ.พยาธิวิทยา'){
          $id_dept = 5;
        }else if($d == 'ภ.รังสีวิทยา'){
          $id_dept = 7;
        }else if($d == 'ภ.วิสัญญีวิทยา'){
          $id_dept = 8;
        }else if($d == 'ภ.ศัลยศาสตร์ออร์โธปิดิกส์'){
          $id_dept = 11;
        }else if($d == 'ภ.สูติศาสตร์และนรีเวชวิทยา'){
          $id_dept = 12;
        }else if($d == 'ภ.อายุรศาสตร์'){
          $id_dept = 14;
        }else if($d == 'ภ.เวชศาสตร์ชุมชน'){
          $id_dept = 9;
        }else if($d == 'ภ.โสต ศอ นาสิกวิทยา'){
          $id_dept = 13;
        }

        $strSQL = "INSERT INTO useraccount (id_pm, username, password, email, usertype, active_status, allow_status, reg_datetime, reviewer_role)
                  VALUES ('$id_pm', '".$data['email']."', '".base64_encode($data['password'])."', '".$data['email']."', 'reviewer', '1', '1', '".date('Y-m-d H:i:s')."', '1')
                  ";
        if($query4 = mysqli_query($conn, $strSQL)){

          $strSQL = "UPDATE reviewer SET update_flag = 1 WHERE email = '".$data['email']."'";
          mysqli_query($conn, $strSQL);

          echo "Insert " . $data['email']. " - " . $id_pm . " success <br>";

          $strSQL = "INSERT INTO userinfo (id_prefix, fname, lname, id_dept, id_personnel, user_id)
                    VALUES ('58', '".$data['name']."', '".$data['surname']."', '$id_dept', '1', '$uid')";
          $query5 = mysqli_query($conn, $strSQL);

        }

      }
    }else{

        $data = mysqli_fetch_assoc($query);
        $strSQL = "SELECT * FROM personnel WHERE name = '".$data['name']."' AND surname = '".$data['surname']."'";
        $query3 = mysqli_query($conn, $strSQL);
        $id_pm = null;
        $d = null;
        if($query3){
          $nr2 = mysqli_num_rows($query3);
          if($nr > 0){
            $data2 = mysqli_fetch_assoc($query3);
            $id_pm = $data2['id_per'];
            $d = $data2['dept'];
          }
        }

        $strSQL = "SELECT MAX(id) id FROM useraccount WHERE 1";
        $query_id = mysqli_query($conn, $strSQL);
        $dat = mysqli_fetch_assoc($query_id);
        $uid = intval($dat['id']) + 1;

        if($id_pm == null){
          $id_pm = 'PI_0'.$uid;
        }

        $id_dept = 32;
        if($d == 'ภ.ศัลยศาสตร์'){
          $id_dept = 10;
        }else if($d == 'ภ.กายภาพบำบัด'){
          $id_dept = 30;
        }else if($d == 'ภ.กุมารเวชศาสตร์'){
          $id_dept = 1;
        }else if($d == 'ภ.จักษุวิทยา'){
          $id_dept = 2;
        }else if($d == 'ภ.จิตเวชศาสตร์'){
          $id_dept = 3;
        }else if($d == 'ภ.ชีวเวชศาสตร์'){
          $id_dept = 4;
        }else if($d == 'ภ.พยาธิวิทยา'){
          $id_dept = 5;
        }else if($d == 'ภ.รังสีวิทยา'){
          $id_dept = 7;
        }else if($d == 'ภ.วิสัญญีวิทยา'){
          $id_dept = 8;
        }else if($d == 'ภ.ศัลยศาสตร์ออร์โธปิดิกส์'){
          $id_dept = 11;
        }else if($d == 'ภ.สูติศาสตร์และนรีเวชวิทยา'){
          $id_dept = 12;
        }else if($d == 'ภ.อายุรศาสตร์'){
          $id_dept = 14;
        }else if($d == 'ภ.เวชศาสตร์ชุมชน'){
          $id_dept = 9;
        }else if($d == 'ภ.โสต ศอ นาสิกวิทยา'){
          $id_dept = 13;
        }

        $strSQL = "INSERT INTO useraccount (id_pm, username, password, email, usertype, active_status, allow_status, reg_datetime, reviewer_role)
                  VALUES ('$id_pm', '".$data['email']."', '".base64_encode($data['password'])."', '".$data['email']."', 'reviewer', '1', '1', '".date('Y-m-d H:i:s')."', '1')
                  ";
        if($query4 = mysqli_query($conn, $strSQL)){

          $strSQL = "UPDATE reviewer SET update_flag = 1 WHERE email = '".$data['email']."'";
          mysqli_query($conn, $strSQL);

          echo "Insert " . $data['email']. " - " . $id_pm . " success <br>";

          $strSQL = "INSERT INTO userinfo (id_prefix, fname, lname, id_dept, id_personnel, user_id)
                    VALUES ('58', '".$data['name']."', '".$data['surname']."', '$id_dept', '1', '$uid')";
          $query5 = mysqli_query($conn, $strSQL);

        }
    }
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
