<?php

require_once 'Banco.php';

class PetPA{

	private $conexao;

	public function __construct()
	{
		$this->conexao=new Banco();
	}

	public function cadastrar($pet)
	{
		$sql="insert into pet values(".
		$pet->getCod_pet().",".
		$pet->getCod_cli().",'".
		$pet->getNome()."','".
		$pet->getPelagem()."',".
		$pet->getPeso().",'".
		$pet->getData_nasci()."','".
		$pet->getFoto()."')";
		//var_dump($sql);
		return $this->conexao->executar($sql);		
	}

	public function retornaUltimo()
	{
		$sql="select max(cod_pet) as 'ultimo'
		from pet";
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
		$sql="select * from pet 
		order by cod_pet
		limit $limite offset $offset";
		return $this->conexao->consultar($sql);
	}

	public function contar()
	{
		$sql="select count(*) as 'contagem' 
		from pet";
		$consulta=$this->conexao->consultar($sql);
		$linha=$consulta->fetch_row();
		return $linha[0];
	}

	public function buscar($tipo,$valor)
	{
		if($tipo=="nome"){
			$sql="select * from pet 
			where nome like '%$valor%'";
		}else if($tipo=="peso"){
			$sql="select * from pet 
			where peso=$valor";
		}else if($tipo=="data_nasci"){
			if(count(str_split($valor))>=9){
				$datafor=new DateTime(
					str_replace("/","-",$valor));
				$valor=$datafor->format('Y-m-d');
			}			
			$sql="select * from pet 
			where data_nasci like '%$valor%'";
		}else if($tipo=="pelagem"){
			$sql="select * from pet 
			where pelagem='$valor'";
		}else{
			$sql="select * from pet 
			where nome like '%$valor%' or 
			peso='$valor' or data_nasci like 
			'%$valor%' or pelagem='$valor'";
		}
		return $this->conexao->consultar($sql);
	}

	public function alterar($pet)
	{
		$sql="update pet set cod_cli=".
		$pet->getCod_cli().", nome='".
		$pet->getNome()."', pelagem='".
		$pet->getPelagem()."', peso=".
		$pet->getPeso().", data_nasci='".
		$pet->getData_nasci()."', foto='".
		$pet->getFoto()."' where cod_pet=".
		$pet->getCod_pet();
		//var_dump($sql);
		return $this->conexao->executar($sql);
	}

	public function listarNomes()
	{
		$sql="select cod_pet,nome from pet 
		order by nome";
		return $this->conexao->consultar($sql);
	}

	public function retornaValores($codigo)
	{
		$sql="select * from pet where
		cod_pet=$codigo";
		return $this->conexao->consultar($sql);
	}

	public function retornarPetPorCliente($cod_cli)
	{
		$sql="select cod_pet,nome,foto from pet 
		where cod_cli=$cod_cli";
		return $this->conexao->consultar($sql);
	}

	public function excluir($codigo)
	{
	$sql="delete from pet where cod_pet=$codigo";
	return $this->conexao->executar($sql);
	}
}

?>