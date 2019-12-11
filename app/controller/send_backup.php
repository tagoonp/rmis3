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
        ],
        'data' => [
            'key_1' => 'Value 1',
            'key_2' => 'Value 2',
        ]
        // ,
        // 'android' => [
        //     'ttl' => '3600s',
        //     'priority' => 'normal',
        //     'notification' => [
        //         'title' => '$GOOG up 1.43% on the day',
        //         'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
        //         'icon' => 'stock_ticker_update',
        //         'color' => '#f45342',
        //     ],
        // ],
        // 'apns' => [
        //     'headers' => [
        //         'apns-priority' => '10',
        //     ],
        //     'payload' => [
        //         'aps' => [
        //             'alert' => [
        //                 'title' => '$GOOG up 1.43% on the day',
        //                 'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
        //             ],
        //             'badge' => 42,
        //         ],
        //     ],
        // ],
        // 'webpush' => [
        //     'notification' => [
        //         'title' => '$GOOG up 1.43% on the day',
        //         'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
        //         'icon' => 'https://my-server/icon.png',
        //     ],
        // ],
    ]);

die();


define('SERVER_API_KEY', 'AIzaSyDNdnS-uflwEB6F3RVRETaiuyi_MMretm0');





$token[] = $token_id;
$header = [
  'Authorization: Key=' . SERVER_API_KEY,
  'Content-Type: Application/json'
];
$msg = [
  'title'   => $title,
  'body'    => $message,
  "click_action" => "SHOW_DETAILS"
];
$payload = [
  'registration_ids'  => $token,
  'data'              => $msg,
  'priority'          => 'high'
];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
  // CURLOPT_URL => "https://fcm.googleapis.com/v1/projects/messanging-fbf79/messages:sen",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_HTTPHEADER => $header
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  $err_message = "cURL Error #:" . $err;
  echo $err_message;

  $strSQL = "INSERT INTO fcm_log (fl_status, fl_desc, fl_token, fl_datetime) VALUES
          ('fail', '$err_message', '$token', '$sys_datetime')";
  mysqli_query($conn, $strSQL);

} else {
  $response_message = "Success : ".$response;
  echo $response_message;
  echo $token_id;
  echo $title;
  echo $message;

  $strSQL = "INSERT INTO fcm_log (fl_status, fl_desc, fl_token, fl_datetime) VALUES ('success', '$response_message', '$token', '$sys_datetime')";
  mysqli_query($conn, $strSQL);
}

?>
