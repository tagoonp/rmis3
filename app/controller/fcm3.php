<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\Notification;

$token = 'fWTnSuZN8aA:APA91bEzQTzzt6kCMUBsiFe4TXwAP0QZmK1c960shRDPXK3zN5gFyQEXyGHcDgZy_zE0O1Kb3_tE5HzmQQxCNRsxmoVsEKlO88JVP20uOe10Pa7iHJ_AFzfchrq8dxso-4zfuY63F9RG';

// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/rmisnotify-9e2d7900d4c2.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    // The following line is optional if the project id in your credentials file
    // is identical to the subdomain of your Firebase project. If you need it,
    // make sure to replace the URL with the URL of your project.
    ->withDatabaseUri('https://rmisnotify.firebaseio.com')
    ->create();


$firebase
    ->getMessaging()
    ->send([
        'topic' => 'my-topic',
        'token' => $token,
        'notification' => [
            'title' => 'Notification title',
            'body' => 'Notification body',
        ],
        'data' => [
            'key_1' => 'Value 1',
            'key_2' => 'Value 2',
        ],
        'android' => [
            'ttl' => '3600s',
            'priority' => 'normal',
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                'icon' => 'stock_ticker_update',
                'color' => '#f45342',
            ],
        ],
        'apns' => [
            'headers' => [
                'apns-priority' => '10',
            ],
            'payload' => [
                'aps' => [
                    'alert' => [
                        'title' => '$GOOG up 1.43% on the day',
                        'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                    ],
                    'badge' => 42,
                ],
            ],
        ],
        'webpush' => [
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                'icon' => 'https://my-server/icon.png',
            ],
        ],
    ]);

    die();



// $database = $firebase->getDatabase();

define('SERVER_API_KEY', 'AIzaSyDNdnS-uflwEB6F3RVRETaiuyi_MMretm0');
$token = ['fWTnSuZN8aA:APA91bEzQTzzt6kCMUBsiFe4TXwAP0QZmK1c960shRDPXK3zN5gFyQEXyGHcDgZy_zE0O1Kb3_tE5HzmQQxCNRsxmoVsEKlO88JVP20uOe10Pa7iHJ_AFzfchrq8dxso-4zfuY63F9RG'];
$header = [
  'Authorization: Key=' . SERVER_API_KEY,
  'Content-Type: Application/json'
];
$msg = [
  'title'   => 'Testing notification',
  'body'    => 'Hello world',
  'icon'    => '',
  'image'   => '',
  "badge"   => '1'
];
$payload = [
  'registration_ids'  => $token,
  'data'              => $msg,
  'priority' => 'HIGH'
];
$curl = curl_init();

curl_setopt_array($curl, array(
  // CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
  CURLOPT_URL => "https://fcm.googleapis.com/v1/projects/rmisnotify/messages:send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_HTTPHEADER => $header
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo var_dump($response);
}

?>
