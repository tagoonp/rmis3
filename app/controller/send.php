<?php
include "config.class.php";
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\Notification;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/rmisnotify-9e2d7900d4c2.json');


if((!isset($_POST['token'])) || (!isset($_POST['title'])) || (!isset($_POST['message']))){
  mysqli_close($conn);
  die();
}


$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://rmisnotify.firebaseio.com')
    ->create();


$token_id = mysqli_real_escape_string($conn, $_POST['token']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

$firebase
    ->getMessaging()
    ->send([
        // 'topic' => 'my-topic',
        'token' => $token_id,
        'notification' => [
            'title' => $title,
            'body' => $message,
        ]
    ]);

$strSQL = "INSERT INTO fcm_log (fl_status, fl_desc, fl_token, fl_datetime) VALUES ('success', '', '$token_id', '$sys_datetime')";
mysqli_query($conn, $strSQL);

die();

?>
