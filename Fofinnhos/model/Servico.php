<?php

class Servico{

	private $cod_serv;
	private $cod_pet;
	private $cod_fun;
	private $nome;
	private $descricao;
	private $data;
	private $hora;
	private $duracao;
	private $valor;

	public function setCod_serv($cod_serv)
	{
		$this->cod_serv=$cod_serv;
	}

	public function getCod_serv()
	{
		return $this->cod_serv;
	}

	public function setCod_pet($cod_pet)
	{
		$this->cod_pet=$cod_pet;
	}

	public function getCod_pet()
	{
		return $this->cod_pet;
	}

	public function setCod_fun($cod_fun)
	{
		$this->cod_fun=$cod_fun;
	}

	public function getCod_fun()
	{
		return $this->cod_fun;
	}

	public function setNome($nome)
	{
		$this->nome=$nome;
	}

	public function getNome()
	{
		return $this->nome;
	}


    public function getDescricao()
    {
        return $this->descricao;
    }

    
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    
    public function getDuracao()
    {
        return $this->duracao;
    }

    
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function verificaHorario($inicio,$duracao,$hora)
    {
    	$inicio=new DateTime($inicio);
    	//vou explodir a duração literalmente
    	$explodir=explode(":", $duracao);
    	//duracao agora está dividido em [0] hora  [1]minutos [2]segundos
    	$duracao=new DateInterval('PT'.$explodir[0].'H'.
    		$explodir[1].'M'.$explodir[2].'S');
    	//PT Período de Tempo  H horas M minutos S segundos
    	$fim=clone $inicio;//vou clonar o início no fim porque
    	$fim->add($duracao);//ao usar add ele sobrescreve o valor inicial
    	$hora=new DateTime($hora);
    	if($hora>=$inicio&&$hora<=$fim){
    		return true;
    	}else{
    		return false;
    	}
    }
}

?>