<?php
include "controller/config.class.php";
$strSQL = "SELECT * FROM useraccount WHERE 1";
if($query = mysqli_query($conn, $strSQL)){
  while($row = mysqli_fetch_array($query)){
    $strSQL = "INSERT INTO pm (id_prefix, fname, lname, id_dept, id_personnel, person_other, dept, expertise, rs_interest, address, tel_mobile, tel_office, tel_fax, user_id)
              SELECT id_prefix, name, surname, id_dept, id_personnel, person_other, dept, expertise, rs_interest, address, tel_mobile, tel_office, tel_fax, ".$row['id']."
                    FROM pm_old WHERE email = '".$row['email']."'  LIMIT 1
              ";
    if($query2 = mysqli_query($conn, $strSQL)){

    }
  }
}
?>
