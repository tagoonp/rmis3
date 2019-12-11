<?php

	require("../lib/connect.class.php");
	$db = new database();
	$db->connect();

	$sql = "DELETE FROM temp_file_progress_add WHERE tf_id = '".$_POST['tf_id']."'";
	$result = $db->delete($sql);

	echo "Y";
	$db->disconnect();
	die();
	
?>
