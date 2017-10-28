<?php 

	require('user.php');
	require('config.php');

	$user = new user();

	$user->set_name(  $_POST['name'] );
	$user->set_password( $_POST['password'] );

	$response = new stdClass();
	$response->error = TRUE;

	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );
	
	if( $mysqli->connect_errno ){
		$response->info = "Lo sentimos! Intente mas tarde";
		echo json_encode($response);
		exit;
	}

	$user->register_user( $mysqli );

	session_start();
	$_SESSION['id'] = $user->get_id();
	$_SESSION['name'] = $user->get_name();

	$response->error = FALSE;
	$response->info = "ok";	

	echo json_encode($response);
?>