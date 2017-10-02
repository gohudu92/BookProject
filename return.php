<?php
	include "config/config.php";

	$monid = mysqli_real_escape_string($conn, $_GET['id']);

	$req_pre = mysqli_prepare($conn, "DELETE FROM `users_books` WHERE `id_book` = ? AND `id_user` = ?" );
	mysqli_stmt_bind_param($req_pre, "ii",$monid, $_SESSION['id']);
	mysqli_stmt_execute($req_pre);





	
	
	header('Location: /my_books.php');
?>