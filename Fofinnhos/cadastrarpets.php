<?php require_once 'cabecalho.php';
require_once 'persistence/ClientePA.php';
$clientepa=new ClientePA();
if (!$clientepa->listarNomes()) {
 echo"<h2>Favor cadastrar clientes primeiro!</h2>";
}else{
	require_once 'model/Tempo.php';
	$tempo=new Tempo();
?>
<form action="cadastrarpets.php" method="POST" enctype="multipart/form-data">
	<h1>Cadastro de Pets</h1>
	<p>Nome:<input type="text" name="nome"
		size="30" maxlength="30" pattern="[a-zA-Z0-9\sçÇãÃéÉôÔ]{1,30}" required></p>
		<?php
		$consulta=$clientepa->listarNomes();
		echo"<p>Cliente:<select name='cod_cli'>";
			while($linha=$consulta->fetch_assoc()){
				echo"<option value='".$linha['cod_cli'].
				"'>".$linha['nome']."</option\>";
		}
        echo "</select></p>";
?>
<p>Pelagem:<input type="color" name="pelagem" required></p>
<p>Peso:<input type="number" name="peso" step="0.01" min="0.0" max="80.0" required></p>
<p>Nascimento:<input type="date" name="data_nasci" 
min="<?=$tempo->minpet()?>"
max="<?=$tempo->maxpet()?>"
required></p>
<p>Foto:<input type="file" name="foto" required></p>
<p><input type="submit" name="botao" value="cadastrar"></p>

</form>
<?php
}
if (isset($_POST['botao'])) {
	require_once 'model/Pet.php';
	require_once 'persistence/PetPA.php';
	$pet=new Pet();
	$petpa=new PetPA();
	$pet->setFoto($_FILES['foto']['tmp_name']);
	if (!$pet->verificaTamanho($pet->getFoto())) {
		echo "<h2>Imagem muito grande! Tente outra!</h2>";
    
	}else{
		$pet->criaImagem($pet->getFoto());
		$pet->setCod_cli($_POST['cod_cli']);
		$pet->setNome($_POST['nome']);
		$pet->setPelagem($_POST['pelagem']);
		$pet->setPeso($_POST['peso']);
		$pet->setData_nasci($_POST['data_nasci']);
		$pet->setCod_pet(
			$petpa->retornaUltimo()+1);
		if ($petpa->cadastrar($pet)) {
		echo "<h2>Pet cadastrado com sucesso!</h2>";
		}else{
			echo "<h2>Erro na tentativa de cadastro!Tente novamente!</h2>";
		}


	  }

 }



?>




</body>
</html>