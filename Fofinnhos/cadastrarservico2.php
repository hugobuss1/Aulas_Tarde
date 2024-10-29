<?php
require_once 'cabecalho.php';
require_once 'persistence/PetPA.php';
$petpa=new PetPA();
$consulta=$petpa->retornarPetPorCliente(
	$_POST['cod_cli']);
if(!$consulta){
	echo "<h2>Este cliente não tem PETs 
	cadastrados!</h2>";
}else{
	require_once 'persistence/ClientePA.php';
	$clientepa=new ClientePA();
?>
	<h1>Cadastrar Serviço</h1>
	<p>De qual dos pets do 
		<?= $clientepa->converteCodNome(
			$_POST['cod_cli']) ?> ?</p>
	<table>
		<tr>
			<th>Nome</th>
			<th>Foto</th>
			<th>Escolher</th>
		</tr>
<?php
	while($linha=$consulta->fetch_assoc()){
		echo "<tr>";
		echo "<td>".$linha['nome']."</td>";
		echo "<td><img src='data:image/jpg;base64,".
		base64_encode($linha['foto']).
		"'></td>";
		echo "<td><a href='cadastrarservico3.php?
		cod_pet=".$linha['cod_pet']."&cod_cli=".
		$_POST['cod_cli']."'>Sim</a></td>";
		echo "</tr>";
	}
?>	
	</table>
<?php
}
?>
</body>
</html>