<?php
require_once 'cabecalho.php';
require_once 'persistence/ClientePA.php';
$clientepa=new ClientePA();
$consulta=$clientepa->listarNomes();
if (!$consulta) {
	echo "<h2>Não há clientes cadastrados!
	Cadastre-os primeiro!</h2>";
}else{
	//cadastrarservico
?>
<form action="cadastrarservico2.php" method="POST">
	<h1>Cadastrar Serviço</h1>
	<p>Para qual cliente:
		<select name="cod_cli">
<?php 
	while($linha=$consulta->fetch_assoc()){
		echo "<option value='".$linha['cod_cli'].
		"'>".$linha['nome']."</option>";
	}
?>		
		</select></p>
	<p><input type="submit" name="botao"
		value="Escolher"></p>
</form>
<?php
}
?>
</body>
</html>