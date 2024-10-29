<?php

require_once 'Banco.php';

class ClientePA{

	private $conexao;

	public function __construct()
	{
		$this->conexao=new Banco();
	}

	public function cadastrar($cliente)
	{
		$sql="insert into cliente values(".
			$cliente->getCod_cli().",'".
			$cliente->getNome()."','".
			$cliente->getEndereco()."','".
			$cliente->getBairro()."','".
			$cliente->getCidade()."','".
			$cliente->getEstado()."',".
			$cliente->getCpf().",'".
			$cliente->getTelefone()."','".
			$cliente->getEmail()."','".
			$cliente->getData_nasci()."')";
			var_dump ($sql);
			return $this->conexao->executar($sql);

		}
		public function retornaUltimo()
		{
			$sql="select max(cod_cli) as 'ultimo' from cliente";
		 $consulta=$this->conexao->consultar($sql);
		 if($consulta){
		 	$linha=$consulta->fetch_row();
		 	return $linha[0];
		 }else{
		 	return 0;
		 }
	}
	public function validarCpf($cpf)
	{
		$sql="select cod_cli from cliente where cpf=$cpf";
		$consulta=$this->conexao->consultar($sql);
		if ($consulta) {
			return true;
		}else{
			return false;
		}
	}
	public function listarNomes()
	{
     $sql="select nome,cod_cli from cliente order by nome";
     return $this->conexao->consultar($sql);
	}
	public function converteCodNome($codigo)
	{
		$sql="select nome from cliente 
		where cod_cli=$codigo";
		$consulta=$this->conexao->consultar($sql);
		if ($consulta) {
			$linha=$consulta->fetch_row();
			return $linha[0];
		}else{
			return false;
		}
	}
}
?>
}
?>