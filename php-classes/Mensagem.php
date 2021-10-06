<?php

class Mensagem
{
    private $idmensagem;
    private $desusuario_remetente;
    private $desusuario_destinatario;
    private $desmensagem;
    private $dtenviado;

    public function __construct($desusuario_remetente = "", $desusuario_destinatario = "", $desmensagem = ""){

		$this->setDesusuarioRemetente($desusuario_remetente);
		$this->setDesusuarioDestinatario($desusuario_destinatario);
		$this->setDesmensagem($desmensagem);

		// Verifica se existe HASH e SENHA, insere no banco de dados e seta os dados no usuario
		if ($desusuario_remetente != "" and $desusuario_destinatario != "") {
			$this->insert();
			$this->loadByDestinatario($desusuario_destinatario);
		}
	}

	private function setData($resultado, $mensagemDeErro){

		// Verificando se existe o ID do usuário no banco de dados
		if (isset($resultado)) {

			$row = $resultado[0];

			$this->setIdmensagem($row['idmensagem']);
			$this->setDesusuarioRemetente($row['desusuario_remetente']);
			$this->setDesusuarioDestinatario($row['desusuario_destinatario']);
			$this->setDesmensagem($row['desmensagem']);
			$this->setDtenviado(new DateTime($row['dtenviado']));

		} else {
			throw new Exception($mensagemDeErro, 1);
		}
	}

	private function insert() {

		$sql = new Sql();

		$sql->execQuery("INSERT INTO tb_mensagens (desusuario_remetente, desusuario_destinatario, desmensagem) VALUES (:REMETENTE, :DESTINATARIO, :MENSAGEM)", array(
            ":REMETENTE"=>$this->getDesusuarioRemetente(),
            ":DESTINATARIO"=>$this->getDesusuarioDestinatario(),
			":MENSAGEM"=>$this->getDesmensagem()
        ));

	}

	public static function search($hash_destinatario) {

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_mensagens WHERE desusuario_destinatario LIKE :SEARCH ORDER BY idmensagem", array(
			":SEARCH"=> "%" . $hash_destinatario . "%"
		));

		if (isset($resultado[0])){
			
			return $resultado;
		} else {
			throw new Exception("Não existe o usuario destinatario", 1);
		}

	}

	public function loadByDestinatario($desusuario_destinatario) {

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM tb_mensagens WHERE desusuario_destinatario = :DESTINATARIO", array(
			":DESTINATARIO"=>$desusuario_destinatario,
		));

		$this->setData($resultado, "Não foi possivel carregar a mensagem");
	}

	public function __toString() {

		$usuario = array(
			"idmensagem"=>$this->getIdmensagem(),
			"desusuario_remetente"=>$this->getDesusuarioRemetente(),
			"desusuario_destinatario"=>$this->getDesusuarioDestinatario(),
			"desmensagem"=>$this->getDesmensagem(),
			"dtenviado"=>$this->getDtenviado()->format("d/m/Y H:i:s"),
		);

		return json_encode($usuario);

	}

	public function delete(){

		$sql = new Sql();

		$sql->execQuery("DELETE FROM tb_mensagens WHERE desusuario_remetente = :HASH", array(
			"HASH"=>$this->getDesusuarioRemetente(),
		));

		$this->setIdmensagem(0);
		$this->setDesusuarioRemetente("");
		$this->setDesusuarioDestinatario("");
		$this->setDesmensagem("");
		$this->setDtenviado(new DateTime());
	}

    public function getIdmensagem()
    {
        return $this->idmensagem;
    }

    public function setIdmensagem($idmensagem)
    {
        $this->idmensagem = $idmensagem;
    }

    public function getDesusuarioRemetente()
    {
        return $this->desusuario_remetente;
    }

    public function setDesusuarioRemetente($desusuario_remetente)
    {
        $this->desusuario_remetente = $desusuario_remetente;
    }

    public function getDesusuarioDestinatario()
    {
        return $this->desusuario_destinatario;
    }

    public function setDesusuarioDestinatario($desusuario_destinatario)
    {
        $this->desusuario_destinatario = $desusuario_destinatario;
    }

    public function getDesmensagem()
    {
        return $this->desmensagem;
    }

    public function setDesmensagem($desmensagem)
    {
        $this->desmensagem = $desmensagem;
    }

    public function getDtenviado()
    {
        return $this->dtenviado;
    }

    public function setDtenviado($dtenviado)
    {
        $this->dtenviado = $dtenviado;
    }
}


?>