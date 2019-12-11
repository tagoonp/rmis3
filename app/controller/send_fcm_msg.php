<?php
include_once 'fcm.php';
/*
$token = array('TOKEN1', 'TOKEN2');
*/
$token = array();

$notification = array(
	'title' => 'Google I/O 2016',
	'body' => 'Firebase Cloud Messaging (Server)', // Required for iOS
	'sound' => 'default',
	'badge' => 1,
	'click_action' => 'OPEN_ACTIVITY_1'
);

$data = array(
	'picture_url' => 'http://opsbug.com/static/google-io.jpg'
);

$fcm = new FCM();
$fcm->send_notification($token, $notification, $data);
?>
