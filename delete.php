<?php
	include "config/config.php";

	$monid = mysqli_real_escape_string($conn, $_GET['id']);
	if($_SESSION["id"] == 5){
		$req_pre = mysqli_prepare($conn, "DELETE FROM `livre` WHERE `id` = ? " );
		mysqli_stmt_bind_param($req_pre, "i",$monid);
		mysqli_stmt_execute($req_pre);
	}

	





	
	
	header('Location: /admin.php');
?>