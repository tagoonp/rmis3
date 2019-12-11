<?php

	require("../lib/connect.class.php");
	$db = new database();
	$db->connect();

	$sql = "SELECT * FROM temp_file_progress_add WHERE tf_session_id = '".$_POST['session_id']."'";
	$result = $db->select($sql,false,true);

	$return = [];
	if($result){
		foreach($result as $row){
			$buffer = [];
			foreach ($row as $key => $value) {
				if(!is_int($key)){
					$buffer[$key] = $value;
				}
			}
			$return[] = $buffer;
		}
	}

	echo json_encode($return, JSON_UNESCAPED_UNICODE);
	$db->disconnect();
	die();
?>
