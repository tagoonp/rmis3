<?php
	session_start();
	require("../lib/connect.class.php");
	$db = new database();
	$db->connect();

	$sql = "SELECT * FROM temp_file_summary_review WHERE tf_session_id = '".session_id()."'";
	$result = $db->select($sql,false,true);


	if($result){
		?>
		<div class="row" style="padding: 4px 0px;">
			<div class="col-sm-12">
				<div class="card-block" style="font-size: 0.8em; padding-left: 0px; padding-right: 0px;">
				<?php
				foreach ($result as $value) {
					?>
					<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="delete_tempfile_response('<?php print $value['tf_id'];?>')">&times;</button>
							<p><?php echo $value['tf_name']; ?></p>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
		<?php

	}
	$db->disconnect();
	die();
?>
