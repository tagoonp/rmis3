<?php
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
  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
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
