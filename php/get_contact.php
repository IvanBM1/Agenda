<?php 

	require('contact.php');
	require('config.php');

	$contact = new contact();

	$response = new stdClass();
	$response->error = TRUE;
	$response->info = "ok";	

	$contact->set_id( $_POST['id'] );

	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );
	if( $mysqli->connect_errno ){
		$response->info = "Intente mas tarde";
		echo json_encode($response);
		exit;
	}else{

		$result = $contact->get_contact( $mysqli );
		if( $result ){
			$values = $result->fetch_assoc();

			$response->error 			= FALSE;
			$response->id 				= $values['id'];
			$response->name 			= $values['name'];
			$response->telephone_local  = $values['telephone_local'];
			$response->telephone_mobile = $values['telephone_mobile'];
			$response->email 			= $values['email'];
			$response->address 			= $values['address'];
			$response->id_user 			= $values['id_user'];

			echo json_encode($response);
		}else{
			$response->info = "El contacto ya no se encuentra disponible.";
			echo json_encode($response);
		}
	}

?>