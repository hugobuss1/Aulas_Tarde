<?php
require_once 'cabecalho.php';

?>
<form action="cadastrarfuncionario.php" method="POST">
	<h1>Cadastro de funcionario</h1>
	<p>Nome:<input type="text" name="nome" size="40" maxlength="40" pattern="[a-zA-Z\sçÇãÃéÉóÓ]{2,40}" required><a>
	<p>Cpf:<input type="number" name="cpf" min="1" required></p>
	<p>endereço:<input type="text" name="endereco" size="50" maxlength="50" pattern="[a-zA-Z0-9\sçÇãÃéÉóÓ]{3,50}" required></p>
	<p>Bairro:<input type="text" name="bairro" size="20" maxlength="20" pattern="[a-zA-Z\sçÇãÃéÉóÓ]{3,20}" required></p>
	<p>Cidade<input type="text"name="cidade" size="30" maxlength="30"pattern="[a-zA-Z\sçÇãÃéÉóÓ]{3,30}" required></p>
	<p>Estado:<select name="estado">
	<option value="AC">AC</option>
	<option value="AL">AL</option>
	<option value="AP">AP</option>
	<option value="AM">AM</option>
	<option value="BA">BA</option>
	<option value="CE">CE</option>
	<option value="DF">DF</option>
	<option value="ES">ES</option>
	<option value="GO">GO</option>
	<option value="MA">MA</option>
	<option value="AC">MT</option>
	<option value="AC">MS</option>
	<option value="AC">MG</option>
	<option value="AC">PA</option>
	<option value="AC">PB</option>
	<option value="AC">PR</option>
	<option value="AC">PE</option>
	<option value="AC">PI</option>
    <option value="RJ">RJ</option>
	<option value="RN">RN</option>
	<option value="RS">RS</option>
	<option value="RO">RO</option>
	<option value="SC">SC</option>
	<option value="SP">SP</option>
	<option value="SE">SE</option>
	<option value="TO">TO</option>
   </select>
   <p>
   	Telefone:
   	<input type="text" name="telefone" size="14" maxlength="14" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}" placeholder="(42)999-9999" required></p>
   	<p>Usuario:<input type="text" name="usuario"
		size="25" maxlength="25"
		pattern="[a-zA-Z@_-0-9] {4,25}"
		placeholder="usuario"
		title="minimo 4,maximo 5 caracteres
		letras maiúsculas,minusculas,numeros,
		@,_,-permitidos" required></p>
		<p>Senha:<input type="password" name="senha" size="10"
			maxlength="10" placeholder="senha" pattern="[a-zA-Z0-9@_-]{4,10}" required></p>
			<p><input type="submit" name="botao" value="Cadastrar"></p>
	
</form>
<?php
if (isset($_POST['botao'])) {
	require_once 'model/Funcionario.php';
	require_once 'persistence/FuncionarioPA.php';
	$funcionario=new Funcionario();
	$funcionariopa=new FuncionarioPA();
	$funcionario->setNome($_POST['nome']);
	$funcionario->setCpf($_POST['cpf']);
	$funcionario->setEndereco($_POST['endereco']);
	$funcionario->setBairro($_POST['bairro']);
	$funcionario->setCidade($_POST['cidade']);
	$funcionario->setEstado($_POST['estado']);
	$funcionario->setTelefone($_POST['telefone']);
	$funcionario->setUsuario($_POST['usuario']);
	$funcionario->setSenha($_POST['senha']);
	if ($funcionariopa->verificarUsuario($funcionario->getUsuario())) {
		echo "<h2>Favor digitar outro usuario!</h2>";
	}else{
		$funcionario->setCod_fun(
			$funcionariopa->retornaUltimo()+1);
	if ($funcionariopa->Cadastrar($funcionario)) {
    echo "<h2>Funcionario cadastrado com sucesso!</h2>";
	}else{
		echo "<h2>Erro na tentativa de cadastro!
		Tente novamente!</h2>";
	     }

     }

  }
