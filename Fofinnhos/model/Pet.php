<?php

class PET{
	private $cod_pet;
	private $cod_cli;
	private $nome;
	private $pelagem;
	private $peso;
	private $data_nasci;
	private $foto;



	public function setCod_pet($cod_pet)
	{
		$this->cod_pet=$cod_pet;
	}
	public function getCod_pet()
	{
	    return $this->cod_pet;
	}
	public function setCod_cli($cod_cli)
	{
		$this->cod_cli=$cod_cli;
	}
	public function getCod_cli()
	{
	    return $this->cod_cli;
	}
	public function setNome($nome)
	{
		$this->nome=$nome;
	}
	public function getNome()
	{
	    return $this->nome;
	}
	public function setPelagem($pelagem)
	{
		$this->pelagem=$pelagem;
	}
	public function getPelagem()
	{
	    return $this->pelagem;
	}
	public function setPeso($peso)
	{
		$this->peso=$peso;
	}
	public function getPeso()
	{
	    return $this->peso;
	}
	public function setData_nasci($data_nasci)
	{
		$this->data_nasci=$data_nasci;
	}
	public function getData_nasci()
	{
	    return $this->data_nasci;
	}
	public function setFoto($foto)
	{
		$this->foto=$foto;
	}
	public function getFoto()
	{
	    return $this->foto;
	   
	}
   public function verificaTamanho($imagem)
   {
  if(filesize($imagem)>65536){
  	return false;
  }else{
  	return true;
    }
  }
  public function criaImagem($imagem)
  {
  	$this->foto=addslashes(
  		file_get_contents($imagem));
   }
 }
?>