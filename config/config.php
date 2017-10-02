<?php
$conn = mysqli_connect("localhost", "root", "", "test");
	if(!$conn){
		die("Connection failed: ". mysqli_connect_error());
	}
	session_start();

	$url = $_SERVER['REQUEST_URI'];
	$string = explode('/', $url);
	$current_page = $string[1];
	
	?>