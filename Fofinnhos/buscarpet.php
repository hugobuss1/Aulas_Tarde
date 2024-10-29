<?php require_once 'cabecalho.php';?>
<form action="buscarpet.php" method="GET">
	<h1>Buscar</h1>
	<p><input type="search" name="busca"></p>
	<p>Tipo:
		<input type="radio" name="tipo" value="nome">Nome
		<input type="radio" name="tipo" value="peso">Peso
		<input type="radio" name="tipo" value="data_nasci">Nascimento
    </p>
    <p>Ou</p>
    <p><input type="radio" name="tipo" value="pelagem">Cor:
       <input type="color" name="pelagem">
   </p>
   <p><input type="submit" name="botao" value="Buscar"></p>
</form>
<?php
if (isset($_GET['botao'])) {
	require_once 'model/Pet.php';
	require_once 'persistence/PetPA.php';
	require_once 'persistence/ClientePA.php';
	$pet=new Pet();
	$petpa=new PetPA();
	$clientepa= new ClientePA();
	if(isset($_GET['tipo'])&& $_GET['tipo']=="pelagem"){
		$consulta=$petpa->buscar($_GET['tipo'],$_GET['pelagem']);
	
	}else if(isset($_GET['tipo'])&& $_GET['busca']){
		$consulta=$petpa->buscar($_GET['tipo'],$_GET['busca']);
	 }else {
	 	$consulta=$petpa->buscar("geral",$_GET['busca']);
	 }
	 if (!$consulta) {
	 	echo "<h2>Nenhum pet correspondente!</h2>";
	 }else{
	 	echo "<table>";
	 	echo "<tr>";
	 	echo "<th>Código</th>";
	 	echo "<th>Cliente</th>";
	 	echo "<th>Nome</th>";
	 	echo "<th>Pelagem</th>";
	 	echo "<th>Peso</th>";
	 	echo "<th>Nascimento</th>";
	 	echo "<th>Foto</th>";
	 	echo "<th>Alterar</th>";
	 	echo "<th>excluir</th>";
	 	echo "</tr>";

	 	while ($linha=$consulta->fetch_assoc()) {
	 		$pet->setCod_pet($linha['cod_pet']);
	 		$pet->setCod_cli($linha['cod_cli']);
	 		$pet->setNome($linha['nome']);
	 		$pet->setPelagem($linha['pelagem']);
	 		$pet->setPeso($linha['peso']);
	 		$pet->setData_nasci($linha['data_nasci']);
	 		$pet->setFoto($linha['foto']);

	 		echo "<tr>";
	 		echo "<td>".$pet->getCod_pet()."</td>";
	 		echo "<td>".
	 		$clientepa->converteCodNome(
	 			$pet->getCod_cli())."</td>";
	 		echo "<td>".$pet->getNome()."</td>";
	 		echo "<td bgcolor='".$pet->getPelagem()."'>&nbsp;</td>";
	 		echo "<td>".$pet->getPeso()."kg</td>";
	 		$datafor=new DateTime(
	 			$pet->getData_nasci());
	 		echo"<td>".$datafor->format('d/m/Y')."</td>";
	 		echo "<td><img src='data:image/jpg;base64,". base64_encode($pet->getFoto())."'></td>";
	 		echo "<td><a href='alterarpet.php?elemento=".
	 		   $pet->getCod_pet()."'>Sim</a>";
	 		echo "<td><a href='excluirpet.php?elemento=".
	 		   $pet->getCod_pet()."'>Sim</a>";
	 		   
	 		   
	 		   

	 		echo "</tr>";
	 	}
	 	echo"</table>";


	 }
  }

?>
</body>
</html>