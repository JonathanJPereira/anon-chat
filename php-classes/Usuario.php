<?php

class Usuario
{
    private $idusuario;
	private $deshash;
	private $dessenha;
	private $dtcadastro;

	public function __construct($deshash, $senha){

		$this->setdeshash($deshash);
		$this->setDessenha($senha);

		// Verifica se existe HASH e SENHA, insere no banco de dados e seta os dados no usuario
		if ($deshash != "" and $senha != "") {
			$this->insert();
			$this->login($deshash, $senha);
		} 
	}

	public function getIdusuario() {
		return $this->idusuario;
	}

	public function getDeshash() {
		return $this->deshash;
	}

	public function getDessenha() {
		return $this->dessenha;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function setIdusuario($idusuario) {
		$this->idusuario = $idusuario;
	}

	public function setDeshash($deshash) {
		$this->deshash = $deshash;
	}

	public function setDessenha($dessenha) {
		$this->dessenha = $dessenha;
	}

	public function setDtcadastro($dtcadastro) {
		$this->dtcadastro = $dtcadastro;
	}

	public function update($hash, $password){

		$this->setdeshash($hash);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->execQuery("UPDATE tb_usuarios SET deshash = :HASH, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			":HASH"=>$this->getDeshash(),
			":PASSWORD"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
		));
	}

	public static function getList() {

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios ORDER BY deshash");

		if(isset($resultado[0])){

			return $resultado;
		} else {

			throw new Exception("Não existe nenhum usuário na lista", 1);
			
		}

	}

	private function setData($resultado, $mensagemDeErro){

		// Verificando se existe o ID do usuário no banco de dados
		if (isset($resultado)) {

			$row = $resultado[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeshash($row['deshash']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		} else {
			throw new Exception($mensagemDeErro, 1);
		}
	}

	public function delete(){

		$sql = new Sql();

		$sql->execQuery("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			"ID"=>$this->getIdusuario(),
		));

		$this->setIdusuario(0);
		$this->setDeshash("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	private function insert() {

		$sql = new Sql();

		$sql->execQuery("INSERT INTO tb_usuarios (deshash, dessenha) VALUES (:HASH, :SENHA)", array(
            ":HASH"=>$this->getDeshash(),
            ":SENHA"=>$this->getDessenha()
        ));

	}

	public static function search($hash) {

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deshash LIKE :SEARCH ORDER BY deshash", array(
			":SEARCH"=> "%" . $hash . "%"
		));

		if (isset($resultado[0])){
			
			return $resultado;
		} else {
			throw new Exception("O usuário não existe", 1);
		}

	}

	public function login($hash, $senha) {

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deshash = :HASH AND dessenha = :SENHA", array(
			":HASH"=>$hash,
			":SENHA"=>$senha
		));

		$this->setData($resultado, "O usuário não existe ou senha errada");
		
	}


	public function loadById($id) {

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :id", array(
			":id"=>$id
		));

		$this->setData($resultado, "Não foi possivel carregar o usuário pelo ID");


	}

	public function __toString() {

		$usuario = array(
			"idusuario"=>$this->getIdusuario(),
			"deshash"=>$this->getdeshash(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s"),
		);

		return json_encode($usuario);

	}
}



?>