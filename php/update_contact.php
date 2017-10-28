<?php 
	
	require('contact.php');
	require('config.php');

	$contact = new contact();
	$response = new stdClass();

	$contact->set_id( $_POST['id'] );
	$contact->set_name( $_POST['name'] );
	$contact->set_id_user($_POST['id_user']);
	$contact->set_telephone_local( $_POST['telephone_local'] );
	$contact->set_telephone_mobile( $_POST['telephone_mobile'] );
	$contact->set_email($_POST['email']);
	$contact->set_address($_POST['address']);

	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );

	if( $mysqli->connect_errno ){
		$response->error = TRUE;
		$response->info = "Intente mas tarde";
		echo json_encode($response);
		exit;
	}

	$contact->update_contact($mysqli);

	$response->error = FALSE;
	$response->info = "ok";

	echo json_encode($response);
?>