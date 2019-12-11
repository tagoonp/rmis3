<?php
include "config.class.php";

if(!isset($_POST['txtIdRS'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtIdReviewer'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtIdCodaAPCU'])){
  mysqli_close($conn);
  die();
}
// You need to add server side validation and better error handling here
$data = array();

$id_rs = mysqli_real_escape_string($conn, $_POST['txtIdRS']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['txtIdReviewer']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['txtIdCodaAPCU']);

if(isset($_GET['files']))
{
    $error = false;
    $files = array();

    $path = "../tmp_file/".$id_apdu;
    if(!is_dir($path)){
      mkdir($path);
    }

    $uploaddir = $path."/";

    foreach($_FILES as $file){

        $tempFile = $file['tmp_name'];
        $filename = $id_apdu.'-rep-assesment-'.date('H-i-s').'-'.basename($file['name']);
        $fullpart = $uploaddir.$filename;

        // if(move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name'])))
        if(move_uploaded_file($file['tmp_name'], $uploaddir.$filename))
        {
            $files[] = $uploaddir.$file['name'];

            $strSQL = "INSERT INTO research_file_assesment_reply (rfa_filename, rfa_filefullpart, rfa_id_rs, rfa_id_reviewer, rfa_datetime)
                        VALUES ('$filename', '$fullpart', '$id_rs', '$id_reviewer','".date('Y-m-d H:i:s')."')";
            $query = mysqli_query($conn, $strSQL);

            $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by) VALUES ('Reviewer upload file',  '$filename', '".date('Y-m-d H:i:s')."', '$id_rs','Reviewer : $id_reviewer')";
            mysqli_query($conn, $strSQL);

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
