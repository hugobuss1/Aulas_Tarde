<?php

class Cliente{
	private $cod_cli;
	private $nome;
	private $endereco;
	private $bairro;
	private $cidade;
	private $cpf;
	private $telefone;
	private $email;
	private $data_nasci;


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
	public function setEndereco($endereco)
   {
   		$this->endereco=$endereco;
   }
   public function getEndereco()
 {
 	 return $this->endereco;
 }
 public function setBairro($bairro)
   {
   $this->bairro=$bairro;
   }
  
   public function getBairro()
 {
 	 return $this->bairro;
  }
   public function getCidade()
 {
 	 return $this->cidade;
 }
 public function setCidade($cidade)
   {
   $this->cidade=$cidade;
   }
 public function getEstado()
 {
   return $this->estado;
 }
 public function setEstado($estado)
   {
  $this->estado=$estado;
  }
 
   public function getCpf()
 {
 	return $this->cpf;
 }
 public function setCpf($cpf)
   {
   $this->cpf=$cpf;
 }
  public function getTelefone()
 {
 	return $this->telefone;
 }
 public function setTelefone($telefone)
 {
   $this->telefone=$telefone;
 }
  public function getEmail()
 {
 	return $this->email;
 }
 public function setEmail($email)
 {
   $this->email=$email;
 }
  public function getData_nasci()
 {
 	 return $this->data_nasci;
 }
 public function setData_nasci($data_nasci)
 {
  $this->data_nasci=$data_nasci;
  }
 }
 




?>
