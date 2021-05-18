<?php 

Class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function	getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		$this->idusuario = $value;
	}

	public function	getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function	getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function	getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($value){
		$this->dtcadastro = $value;
	}


	//Carrega um usuario da tabela 'usuario' pelo ID
	public function loadById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID" => $id
		));
		if (count($result)>0){
			$row = $result[0];
			$this->setIdUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}else{
			echo "erro...";
		}
	}

	//Retorna uma lista de usuarios
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	//Retorna um usuario pelo login.
	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			":SEARCH"	=>	"%".$login."%"
		));
	}

	//Obter dados de usuaio AUTENTICADO
	public function login($login, $password){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"	=>	$login,
			":PASSWORD"	=>	$password
		));

		if (count($result)>0){
			$row = $result[0];
			$this->setIdUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}else{
			throw new Exception("Error login ou senha invalidos", 1);
			
		}
	}

	//Formata a saida de dados para Json Encode
	public function __toString(){
		return json_encode(array(
			"idusuario" => $this->getIdUsuario(),
			"deslogin" => $this->getDeslogin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtCadastro()
		));
	}


}//Class Usuario

 ?>