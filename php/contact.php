<?php 
class contact{

	private $id;
	private $name;
	private $telephone_local = "";
	private $telephone_mobile = "";
	private $email = "";
	private $address = "";
	private $id_user;

	private $all_contacts;

	function __construct(){
	}

	public function set_id( $id ){
		
		$exp_id = "/^[0-9]{1,}(?!.*[a-zA-Z\.\,\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/";

		if( preg_match($exp_id, $id) )
			$this->id = $id;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Sesión: Vuelva a iniciar sesión.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_id(){
		return $this->id;
	}

	public function set_name( $name ){

		$exp_name = "/^[a-zA-Z\s]{4,}(?!.*[0-9])(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\_\.\,\~\^\`\*\¨\:\;])/";

		if( preg_match($exp_name, $name) )
			$this->name = $name;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Nombre: Min. 4 caracteres alfabéticos.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_name(){
		return $this->name;
	}

	public function set_telephone_local( $number ){

		if( $number == "" ) return;
		
		$exp_telephone = "/^[0-9]{7,}(?!.*[a-zA-Z\.\,\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/";
		
		if( preg_match($exp_telephone, $number) )
			$this->telephone_local = $number;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Teléfono: Min. 7 dígitos.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_telephone_local(){
		return $this->telephone_local;
	}

	public function set_telephone_mobile( $number ){

		if( $number == "" ) return;
		
		$exp_telephone = "/^[0-9]{7,}(?!.*[a-zA-Z\.\,\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/";
		
		if( preg_match($exp_telephone, $number) )
			$this->telephone_mobile = $number;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Teléfono: Min. 7 dígitos.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_telephone_mobile(){
		return $this->telephone_mobile;
	}

	public function set_email( $email ){

		if( $email == "" ) return;
		
		$exp_email = "/^[a-zA-Z|0-9|.|_-]+[@][a-zA-Z]{4,}[.][\w.]+(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/";

		if( preg_match($exp_email, $email) )
			$this->email = $email;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Correo: No valido!.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_email(){
		return $this->email;
	}

	public function set_address( $address ){

		if( $address == "" ) return;

		$exp_address = "/^[a-zA-Z0-9.,\-\s]{4,}(?!.*[\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\~\^\`\*\¨\:\;])/";

		if( preg_match($exp_address, $address) )
			$this->address = $address;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Dirección: Min. 4 caracteres alfanuméricos. Opcional(.,-).";
			echo json_encode($response);
			exit;
		}

	}

	public function get_address(){
		return $this->address;
	}

	public function set_id_user( $id_user ){

		$exp_id = "/^[0-9]{1,}(?!.*[a-zA-Z\.\,\_\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\~\^\`\*\¨\:\;])/";

		if( preg_match($exp_id, $id_user) )
			$this->id_user = $id_user;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Sesión: Vuelva a iniciar sesión.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_id_user(){
		return $this->id_user;
	}

	public function create_contact( $mysqli ){
		
		$query = "INSERT INTO contacts (name, telephone_local, telephone_mobile, email, address, id_user) VALUES ( '".$this->name."', '".$this->telephone_local."', '".$this->telephone_mobile."', '".$this->email."', '".$this->address."', '".$this->id_user."' )";
		$result = $mysqli->query( $query );
		
		if( !$result ){
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Lo sentimos! Intente mas tarde";
			echo json_encode($response);
			exit;
		}
	}

	public function update_contact( $mysqli ){
		$query = "UPDATE contacts SET 
				name = '".$this->name."', 
				telephone_local = '".$this->telephone_local."',
				telephone_mobile = '".$this->telephone_mobile."',
				email = '".$this->email."',
				address = '".$this->address."'
				WHERE id = '".$this->id."'
				AND id_user = '".$this->id_user."' ";

		$mysqli->query( $query );

		if( $mysqli->affected_rows < 1 ){
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Lo sentimos! Intente mas tarde";
			echo json_encode($response);
			exit;
		}
	}
	
	public function get_contact( $mysqli ){
		$result = $mysqli->query("SELECT * FROM contacts WHERE id = '".$this->id."' ") or die($mysqli->error);
		return  $result;
	}

	public function get_all_contacts( $mysqli ){
		$result = $mysqli->query("SELECT id, name FROM contacts WHERE id_user = '".$this->id_user."' ") or die($mysqli->error);
		return  $result;
	}

	public function delete_contact( $mysqli ){

		$mysqli->query("DELETE FROM contacts WHERE id = '".$this->id."' ");
		if( $mysqli->affected_rows < 1 ){
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Lo sentimos! Intente mas tarde";
			echo json_encode($response);
			exit;
		}
	}


}
?>