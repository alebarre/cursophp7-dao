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
			$this->setData($result[0]);
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
			$this->setData($result[0]);
		}else{
			throw new Exception("Error login ou senha invalidos", 1);
		}
	}

	//Popula atributos do objeto com os dados que vieram do array.
	public function setData($data){
		$this->setIdUsuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));
	}

	//Controi o objeto com os dados de login e senha, se vierem.
	public function __construct($login = "", $password = ""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			":LOGIN"		=> 	$this->getDeslogin(),
			":SENHA"		=> 	$this->getDessenha()
		));

		if (count($results) > 0){
			$this->setData($results[0]);
		}
	}

	public function update($login, $password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			"LOGIN"		=>	$this->getDeslogin(),
			"PASSWORD"	=>	$this->getDessenha(),
			"ID"		=>	$this->getIdUsuario()
		));
	}

	//Formata a saida de dados para Json Encode
	public function __toString(){
		return json_encode(array(
			"idusuario" 	=> $this->getIdUsuario(),
			"deslogin" 		=> $this->getDeslogin(),
			"dessenha" 		=> $this->getDessenha(),
			"dtcadastro" 	=> $this->getDtCadastro()
		));
	}


}//Class Usuario

 ?>