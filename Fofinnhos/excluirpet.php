<?php
require_once 'cabecalho.php';
require_once 'persistence/PetPA.php';
if (isset($_GET['elemento'])) {
	$petpa=new PetPA();
	$consulta=$petpa->retornavalores($_GET['elemento']);
	$linha=$consulta->fetch_row();
	?>
	<form action="excluirpet.php" method="POST">
		<h1>excluir</h1>
		<p>Tem certeza 	que deseja excluir o</p>
		<p><?= $linha [2] ?></p>
		<input type="hidden" name="cod_pet" value="<?=$linha[0] ?>">
		<p><input type="submit" name="botao" value="Sim"></p>
		

	</form>

	<?php
}
if (isset($_POST['botao'])) {
   $petpa=new PetPA();
   if ($petpa->excluir($_POST['cod_pet'])) {
 echo "<h2>Pet excluido com sucesso!</h2>";
   }else{
   	echo "<h2>Erro na tentativa de excluir!</h2>";
   }
}
