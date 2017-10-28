<?php 

class user{

	private $id;
	private $name;
	private $password;

	public function __construct(){
	}

	public function set_id( $id ){
		$this->id = $id;
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

	public function set_password( $password ){

		$exp_password = "/^[a-zA-Z|0-9]{8,}(?!.*[\!\"\#\$\%\&\(\)\=\'\¿\¡\<\>\´\+\{\}\-\_\.\,\~\^\`\*\¨\:\;])/";

		if( preg_match($exp_password, $password) )
			$this->password = $password;
		else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Contraseña: Min. 8 caracteres alfanuméricos.";
			echo json_encode($response);
			exit;
		}
	}

	public function get_password(){ 
		return $this->password; 
	}

	public function register_user( $mysqli ){

		$response = new stdClass();
		$response->error = TRUE;

		if( $this->the_user_is_registered($mysqli) ){
			$response->info = "El usuario ya esta registrado.";
			echo json_encode($response);
			exit;
		}
		else
			if( $mysqli->query("INSERT INTO user (name, password) VALUES  ('".$this->name."','".$this->password."')" ) ){
				$this->init_user($mysqli);
			}
			else{
				$response->info = "Lo sentimos! Intente mas tarde";
				echo json_encode($response);
				exit;
			}
	}

	public function init_user( $mysqli ){

		$result = $mysqli->query("SELECT id FROM user WHERE name = '".$this->name."' AND password = '".$this->password."' ");

		if( $result->num_rows > 0 ){
			$user = $result->fetch_assoc();
			$this->id = $user['id'];
		}else{
			$response = new stdClass();
			$response->error = TRUE;
			$response->info = "Usuario o contraseña incorrectos.";
			echo json_encode($response);
			exit;
		}
	}

	public function the_user_is_registered( $mysqli ){

		$result = $mysqli->query("SELECT id FROM user WHERE name = '".$this->name."' ");
		
		return $result->num_rows;
	}

}
?>