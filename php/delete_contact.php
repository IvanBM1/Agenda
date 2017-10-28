<?php 
	
	require('contact.php');
	require('config.php');

	$contact = new contact();
	$response = new stdClass();

	$contact->set_id( $_POST['id'] );

	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );

	if( $mysqli->connect_errno ){
		$response->error = TRUE;
		$response->info = "Intente mas tarde.";
		echo json_encode($response);
		exit;
	}

	$contact->delete_contact( $mysqli );

	$response->error = FALSE;
	$response->info = "ok";

	echo json_encode($response);
?>