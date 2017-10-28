<?php 
	
	require('contact.php');
	require('config.php');

	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE ) or die("Error de conexion...");

	$contact = new contact();
	$contact->set_id_user( $_SESSION['id'] );
	$all_contacts = $contact->get_all_contacts( $mysqli );	

	while( $contact = $all_contacts->fetch_assoc() ){
		echo '<div class="input-group">';
		echo 	'<input type="button" class="btn_show form-control" style="cursor: pointer;" max="'.$contact['id'].'" value="'.$contact['name'].'" >';
		echo 	'<div class="input-group-btn">';
		echo 		'<button class="btn_edit btn btn-default"  style="cursor: pointer;" value="'.$contact['id'].'">editar</button>';
		echo 		'<button class="btn_delete btn btn-danger" style="cursor: pointer;" value="'.$contact['id'].'">borrar</button>';
		echo 	'</div>';
		echo '</div>';
		echo '<br>';
	}

?>