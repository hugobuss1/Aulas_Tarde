<?php

require_once 'Banco.php';

class FuncionarioPA{

	private $conexao;

	public function __construct()
	{
		$this->conexao=new Banco();
	}

	public function logar($funcionario)
	{
		$sql="select usuario,senha from funcionario";
		$consulta=$this->conexao->consultar($sql);
		if($consulta){
			while($linha=$consulta->fetch_assoc()){
				if($funcionario->getUsuario()==$linha['usuario']){
					if($funcionario->getSenha()==$linha['senha']){
						return true;
					}
				}
			}
			return false;
		}else{
			return false;
		}
	}

	public function cadastrar($funcionario)
	{
		$sql="insert into funcionario values(".
		$funcionario->getCod_fun().",'".
		$funcionario->getNome()."',".
		$funcionario->getCpf().",'".
		$funcionario->getEndereco()."','".
		$funcionario->getBairro()."','".
		$funcionario->getCidade()."','".
		$funcionario->getEstado()."','".
		$funcionario->getTelefone()."','".
		$funcionario->getEmail()."','".
		$funcionario->getUsuario()."','".
		$funcionario->getSenha()."')"; 
  		//var_dump($sql);
  		return $this->conexao->executar($sql);
	}

	public function retornaUltimo()
	{
		$sql="select max(cod_fun) as 'ultimo' 
		from funcionario";
		$consulta=$this->conexao->consultar($sql);
		if ($consulta) {
			$linha=$consulta->fetch_row();
			return $linha[0];
		}else{
			return 0;
		}
	}

	public function converte($campo,$valor)
	{
		$sql="select cod_fun from funcionario
		where $campo='$valor'";
		$consulta=$this->conexao->consultar($sql);
		$linha=$consulta->fetch_row();
		return $linha[0];
	}

	public function verificarUsuario($usuario)
	{
		$sql="select cod_fun from funcionario
		where usuario='$usuario'";
		$consulta=$this->conexao->consultar($sql);
		if ($consulta) {
			return true;
		}else{
			return false;
		}
	}

	public function listarNomes()
	{
		$sql="select cod_fun,nome from funcionario
		order by nome";
		return $this->conexao->consultar($sql);
	}

	public function converteCodNome($codigo)
	{
		$sql="select nome from funcionario 
		where cod_fun=$codigo";
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



