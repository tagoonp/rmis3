<?php
class FCM {
    public function send_notification($token, $payload_notification, $payload_data) {
        $url = 'https://fcm.googleapis.com/v1/projects/myproject-b5ae1/messages:send';
        $fields = array(
            // 'registration_ids' => 'WTnSuZN8aA:APA91bEzQTzzt6kCMUBsiFe4TXwAP0QZmK1c960shRDPXK3zN5gFyQEXyGHcDgZy_zE0O1Kb3_tE5HzmQQxCNRsxmoVsEKlO88JVP20uOe10Pa7iHJ_AFzfchrq8dxso-4zfuY63F9RG',
            //'condition' => "'logined' in topics || 'news' in topics",
            // 'to' => '/topics/news',
            'priority' => 'normal',
            'notification' => $payload_notification,
            'data' => $payload_data
        );
        $headers = array(
            'Authorization: key=AIzaSyDNdnS-uflwEB6F3RVRETaiuyi_MMretm0',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporary
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        echo $result;
    }
}
?>
