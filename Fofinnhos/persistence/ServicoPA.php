<?php

require_once 'Banco.php';

class ServicoPA{

	private $conexao;

	public function __construct()
	{
		$this->conexao=new Banco();
	}

	public function cadastrar($servico)
	{
		$sql="insert into servico values(".
		$servico->getCod_serv().",".
		$servico->getCod_pet().",".
		$servico->getCod_fun().",'".
		$servico->getNome()."','".
		$servico->getDescricao()."','".
		$servico->getData()."','".
		$servico->getHora()."','".
		$servico->getDuracao()."',".
		$servico->getValor().")";
 		//var_dump($sql);
 		return $this->conexao->executar($sql);
 	}

 	public function retornaUltimo()
	{
		$sql="select max(cod_serv) as 'ultimo'
		from servico";
		$consulta=$this->conexao->consultar($sql);
		if ($consulta) {
			$linha=$consulta->fetch_row();
			return $linha[0];
		}else{
			return 0;
		}
	}

	public function listar($limite,$offset)
	{
		$sql="select * from servico 
		order by cod_serv
		limit $limite offset $offset";
		return $this->conexao->consultar($sql);
	}

	public function contar()
	{
		$sql="select count(*) as 'contagem' 
		from servico";
		$consulta=$this->conexao->consultar($sql);
		$linha=$consulta->fetch_row();
		return $linha[0];
	}

	public function buscar($tipo,$valor)
	{
		if($tipo=="nome"){
			$sql="select * from servico 
			where nome like '%$valor%'";
		}else if ($tipo=="descricao") {
			$sql="select * from servico 
			where descricao like '%$valor%'";
		}else if ($tipo=="data") {
			if (count(str_split($valor))>=9) {
				$datafor=new DateTime(
					str_replace("/","-",$valor));
				$valor=$datafor->format('Y-m-d');
			}
			$sql="select * from servico 
			where data like '%$valor%'";
		}else if($tipo=="hora"){
			$sql="select * from servico
			where hora like '%$valor%'";
		}else if ($tipo=="duracao") {
			$sql="select * from servico 
			where duracao like '%$valor%'";
		}else if ($tipo=="valor") {
			$sql="select * from servico 
			where valor=$valor";
		}else{
			$sql="select * from servico where 
			nome like '%$valor%' or 
			descricao like '%$valor%' or 
			data like '%$valor%' or 
			hora like '%$valor%' or 
			duracao like '%$valor%' or 
			valor='$valor'";
		}
		return $this->conexao->consultar($sql);
	}

	public function excluir($codigo)
	{
		$sql="delete from servico
		where cod_serv=$codigo";
		return $this->conexao->executar($sql);
	}

	public function listarServicosFunc($funcionario,$data)
	{
		$sql="select hora,duracao from servico
		where data='$data' and cod_fun=$funcionario";
		return $this->conexao->consultar($sql);
	}
}
?>