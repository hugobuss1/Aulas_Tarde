<?php
require_once 'cabecalho.php';
require_once 'persistence/PetPA.php';
$petpa=new PetPA();
$total=$petpa->contar();
if($total<=0){
	echo "<h2>Nenhum Pet cadastrado!</h2>";
}else{

	if (isset($_GET['pagina'])) {
		$pagina=$_GET['pagina'];
	}else{
		$pagina=1;
	}

	$limite=1;
	$offset=($pagina-1)*$limite;
	$consulta=$petpa->listar($limite,$offset);
	require_once 'model/Pet.php';
	require_once 'persistence/ClientePA.php';
	$clientepa=new ClientePA();
	$pet=new Pet();

	echo "<table>";
	echo "<tr>";
	echo "<th>Código</th>";
	echo "<th>Cliente</th>";
	echo "<th>Nome</th>";
	echo "<th>Pelagem</th>";
	echo "<th>Peso</th>";
	echo "<th>Nascimento</th>";
	echo "<th>Foto</th>";
	echo "</tr>";

	while($linha=$consulta->fetch_assoc()){
		$pet->setCod_pet($linha['cod_pet']);
		$pet->setCod_cli($linha['cod_cli']);
		$pet->setNome($linha['nome']);
		$pet->setPelagem($linha['pelagem']);
		$pet->setPeso($linha['peso']);
		$pet->setData_nasci($linha['data_nasci']);
		$pet->setFoto($linha['foto']);

		echo "<tr>";
		echo "<td>".$pet->getCod_pet()."</td>";
		if(!$clientepa->converteCodNome(
			$pet->getCod_cli())){
			echo "<h2>Código de Cliente 
			inexistente!</h2>";
		}else{
			echo "<td>".$clientepa->converteCodNome(
			$pet->getCod_cli())."</td>";
		}
		echo "<td>".$pet->getNome()."</td>";
		echo "<td bgcolor='".$pet->getPelagem().
		"'>&nbsp;</td>";
		echo "<td>".$pet->getPeso()." Kg</td>";
		$datafor=new DateTime($pet->getData_nasci());
		echo "<td>".$datafor->format('d/m/Y')."</td>";
		echo "<td><img src='data:image/jpg;base64,".
		base64_encode($pet->getFoto())."'></td>";
		echo "</tr>";
	}
	echo "</table>";
    
    echo "<p class ='paginas'>";
    if ($pagina>1) {
    	$volta=$pagina-1;
    echo "<a href='listarPet.php?pagina=$volta'>&lt;&lt;</a>";
}
echo "$pagina";
$num_paginas=ceil($total/$limite);
if ($pagina<$num_paginas) {
	$volta=$pagina+1;
	echo "<a href='listarpet.php?pagina=$volta'>&gt;&gt;</a>";
}
   echo "</p>";
}

?>
</body>
</html>