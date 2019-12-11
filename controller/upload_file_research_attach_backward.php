<?php
include "config.class.php";

if(!isset($_POST['txtIdRS'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtFileGroup'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtAppstatus'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtRssessionid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtOwnerID'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtStaff'])){
  mysqli_close($conn);
  die();
}






// You need to add server side validation and better error handling here
$data = array();

$id_rs = mysqli_real_escape_string($conn, $_POST['txtIdRS']);
$file_group = mysqli_real_escape_string($conn, $_POST['txtFileGroup']);
$app_status = mysqli_real_escape_string($conn, $_POST['txtAppstatus']);
$session_id = mysqli_real_escape_string($conn, $_POST['txtRssessionid']);
$uid = mysqli_real_escape_string($conn, $_POST['txtOwnerID']);
$staff_id = mysqli_real_escape_string($conn, $_POST['txtStaff']);



if(isset($_GET['files']))
{
    $error = false;
    $files = array();

    $path = "../tmp_file";
    if(!is_dir($path)){
      mkdir($path);
    }

    $uploaddir = $path."/";

    foreach($_FILES as $file){

        $tempFile = $file['tmp_name'];
        $filename = 'file-rs-'.date('Y-m-d-H-i-s').'-'.basename($file['name']);
        $fullpart = $uploaddir.$filename;

        // if(move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name'])))
        if(move_uploaded_file($file['tmp_name'], $uploaddir.$filename))
        {
            $files[] = $uploaddir.$file['name'];

            $strSQL = "INSERT INTO file_research_attached (f_name, f_group, f_session_id, f_date, f_user_id, f_rs_id, f_allow_delete, f_approval_status)
                        VALUES ('$filename', '$file_group', '$session_id', '".date('Y-m-d')."', '$uid', '$id_rs', '0', '$app_status')";
            $query = mysqli_query($conn, $strSQL);

            $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by) VALUES ('Staff upload file',  '$filename', '".date('Y-m-d H:i:s')."', '$id_rs', 'Staff : $staff_id')";
            mysqli_query($conn, $strSQL);

            echo "Y";

        }
        else
        {
            $error = true;
        }
    }

    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else
{
    $data = array('success' => 'Form was submitted', 'formData' => $_POST);
}

echo json_encode($data);
?>
