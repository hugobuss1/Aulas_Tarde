<?php
require_once 'cabecalho.php';
if (isset($_GET['cod_cli'])&&isset(
	$_GET['cod_pet'])) {
	require_once 'persistence/FuncionarioPA.php';
	$funcionariopa=new FuncionarioPA();
	$consulta=$funcionariopa->listarNomes();
	if (!$consulta) {
		echo "<h2>Nenhum Funcionário
		cadastrado! Cadastre-os primeiro!</h2>";
	}else{
?>
<form action="cadastrarservico3.php" method="POST">
	<h1>Cadastrar Serviço</h1>
	<p>Funcionário:
		<select name="cod_fun">
<?php 
	while($linha=$consulta->fetch_assoc()){
		echo "<option value='".$linha['cod_fun'].
		"'>".$linha['nome']."</option>";
	}
?>
		</select>
	</p>
	<p>Data:<input type="date" name="data"
		min="<?= date('Y-m-d') ?>" required></p>
	<input type="hidden" name="cod_cli"
	value="<?= $_GET['cod_cli']?> ">
	<input type="hidden" name="cod_pet"
	value="<?= $_GET['cod_pet']?> ">
	<p><input type="submit" name="botao"
		value="Escolher"></p>
</form>
<?php
	}
}
if (isset($_POST['botao'])) {
	require_once 'persistence/FuncionarioPA.php';
	$funcionariopa=new FuncionarioPA();
	require_once 'model/Servico.php';
	require_once 'persistence/ServicoPA.php';
	$servico=new Servico();
	$servicopa=new ServicoPA();
	$consulta=$servicopa->listarServicosFunc(
		$_POST['cod_fun'],$_POST['data']);
	if($consulta){
	while($linha=$consulta->fetch_assoc()){//farei antes
		$horarios_agendados[]=$linha;//guardo as linhas em $horarios_agendados
	}
	}
		?>
		<form action="cadastrarservico3.php" method="POST">
		<h1>Cadastrar Serviço</h1>
		<p>Horário disponível do
			<?= $funcionariopa->converteCodNome($_POST['cod_fun'])?></p>
	<?php
	for($h=8;$h<=17;$h++){
		for($m=0;$m<60;$m+=30){
			if($h>=8&&$h<=11){
				if($h!=11){
					$horario=str_pad($h,2,'0',STR_PAD_LEFT).":".
					str_pad($m,2,'0',STR_PAD_LEFT).":00";
					 $conflito = false;
					 if($consulta){
					 foreach ($horarios_agendados as $agendado) {
        				if ($servico->verificaHorario($agendado['hora'], $agendado['duracao'], $horario)) {
            				$conflito = true;
            				break; // Se encontrou um conflito, não precisa continuar verificando
        				}
    				}
    				}
				    if (!$conflito) {
        			// Se não há conflito, exibe o horário
        			echo "<p><input type='radio' name='hora' value='$horario'>$horario</p>";
    				}	
				}else{
				    if($m<=30){
				      	$horario=str_pad($h,2,'0',STR_PAD_LEFT).":".
					str_pad($m,2,'0',STR_PAD_LEFT).":00";
					 $conflito = false;
					 if($consulta){
					 foreach ($horarios_agendados as $agendado) {
        				if ($servico->verificaHorario($agendado['hora'], $agendado['duracao'], $horario)) {
            				$conflito = true;
            				break; // Se encontrou um conflito, não precisa continuar verificando
        				}
    				}
    				}
				    if (!$conflito) {
        			// Se não há conflito, exibe o horário
        			echo "<p><input type='radio' name='hora' value='$horario'>$horario</p>";
    				}	
					}
				}
					
			}else if($h>=13&&$h<=17){
				if($h!=17){
					$horario=str_pad($h,2,'0',STR_PAD_LEFT).":".
					str_pad($m,2,'0',STR_PAD_LEFT).":00";
					 $conflito = false;
					 if($consulta){
					 foreach ($horarios_agendados as $agendado) {
        				if ($servico->verificaHorario($agendado['hora'], $agendado['duracao'], $horario)) {
            				$conflito = true;
            				break; // Se encontrou um conflito, não precisa continuar verificando
        				}
    				}
    				}
				    if (!$conflito) {
        			// Se não há conflito, exibe o horário
        			echo "<p><input type='radio' name='hora' value='$horario'>$horario</p>";
    				}	
				}else{
				    if($m<=30){
				    	$horario=str_pad($h,2,'0',STR_PAD_LEFT).":".
					str_pad($m,2,'0',STR_PAD_LEFT).":00";
					 $conflito = false;
					 if($consulta){
					 foreach ($horarios_agendados as $agendado) {
        				if ($servico->verificaHorario($agendado['hora'], $agendado['duracao'], $horario)) {
            				$conflito = true;
            				break; // Se encontrou um conflito, não precisa continuar verificando
        				}
    				}
    			}
				    if (!$conflito) {
        			// Se não há conflito, exibe o horário
        			echo "<p><input type='radio' name='hora' value='$horario'>$horario</p>";
    				}		
					}
				}
			}//fim else horas
		}//fim laço minutos 
	}//fim laço hora
?>
<input type="hidden" name="cod_pet" value="
<?= $_POST['cod_pet'] ?>">
<input type="hidden" name="cod_fun" value="
<?= $_POST['cod_fun'] ?>">
<input type="hidden" name="data" value="
<?= $_POST['data'] ?>">
<p>Nome do Serviço:
	<input type="text" name="nome"
	size="20" maxlength="20"
	required></p>
<p>Descrição:</p>
<p><textarea name="descricao" cols="50" 
	rows="3" required></textarea></p>
<p>Duração:<input type="time" name="duracao"
	min="00:30:00" required></p>
<p>Valor RS:
	<input type="number" name="valor"
	min="0.00" step="0.01" required></p>
<p><input type="submit" name="botao2"
	value="Cadastrar"></p>
</form>
<?php	
}//fim post botao

if (isset($_POST['botao2'])) {
	require_once 'model/Servico.php';
	require_once 'persistence/ServicoPA.php';
	$servico=new Servico();
	$servicopa=new ServicoPA();
	$servico->setCod_serv(
		$servicopa->retornaUltimo()+1);
	$servico->setCod_fun($_POST['cod_fun']);
	$servico->setCod_pet($_POST['cod_pet']);
	$servico->setNome($_POST['nome']);
	$servico->setDescricao($_POST['descricao']);
	$servico->setData($_POST['data']);
	$servico->setHora($_POST['hora']);
	$servico->setDuracao($_POST['duracao']);
	$servico->setValor($_POST['valor']);
	if ($servicopa->cadastrar($servico)) {
		echo "<h2>Serviço cadastrado com sucesso!</h2>";
	}else{
		echo "<h2>Erro na tentativa de cadastro!</h2>";
	}
}

?>
</body>
</html>