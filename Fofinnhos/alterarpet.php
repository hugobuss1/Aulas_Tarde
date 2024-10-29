<?php
require_once 'cabecalho.php';
require_once 'persistence/PetPA.php';
$petpa=new PetPA();
if (isset($_GET['elemento'])) {
	$consulta=$petpa->retornaValores($_GET['elemento']);
if (!$consulta) {
  echo "<h2>Nenhum Pet correspondente!</h2>";
 }else{
 	$linha=$consulta->fetch_row();
 	require_once 'model/pet.php';
 	require_once 'persistence/ClientePA.php';
 	$pet=new Pet();
 	$clientepa=new ClientePA();
    $pet->setCod_pet($linha[0]);
    $pet->setCod_cli($linha[1]);
    $pet->setNome($linha[2]);
    $pet->setPelagem($linha[3]);
    $pet->setPeso($linha[4]);
    $pet->setData_nasci($linha[5]);
    $pet->setFoto($linha[6]);
?>

<form action="alterarpet.php" method="POST" enctype="multipart/form-data">
<h1>Alterar</h1>
<p>Codigo:<?= $pet->getCod_pet() ?></p>
<input type="hidden" name="cod_pet" value="<?= $pet->getCod_pet()?>">
<p>Cliente:<select name="cod_cli">

<?php
$nomes=$clientepa->listarNomes();
  while ($lin=$nomes->fetch_assoc()){
if ($pet->getCod_cli()==$lin['cod_cli']) {
	
  echo "<option value='".
  $lin['cod_cli']."'selected>".
  $lin['nome']."</option>";

}else{
  echo "<option value='".
  $lin['cod_cli'].">".
  $lin['nome']."</option>";
}
}

?>
</select></p>
<p>Nome:<input type="text" name="nome" size="30" maxlength="30" pattern="[a-zA-Z\sçÇãÃéÉôÔ]{2,30}" value="<?= $pet->getNome() ?>"></p>
<p>Pelagem:<input type="color" name="pelagem" value="<?=$pet->getPelagem()?>"></p>
<p>Peso:<input type="number" name="peso" min="0.0" max="80.0" step="0.01" value="<?=+ $pet->getPeso()?>"></p>
<p>Nascimento:<input type="date" name="data_nasci" value="<?=$pet->getData_nasci() ?>"></p>
<p><img src="data:image/jpg;base64, 
  <?=base64_encode($pet->getFoto())?>"></p>
  <p>Atualizar:<input type="file" name="foto"></p>
  <p><input type="submit" name="botao" value="Atualizar"></p>
</form>
<?php
  }
 }
 if (isset($_POST['botao'])) {
   require_once 'model/Pet.php';
   $pet=new Pet();
   if ($_FILES['foto']['tmp_name']=="") {
   $consulta=$petpa->retornaValores($_POST['cod_pet']);
   $linha=$consulta->fetch_row();
   $pet->setFoto(addslashes($linha[6]));
  }else{
    if (!$pet->verificaTamanho(
      $_FILES['foto']['tmp_name'])) {
      echo "<h2>Imagem muito grande!
      A imagem deve ter no maximo 65kb!</h2>";
    }else{
      $pet->setFoto($_FILES['foto']['tmp_name']);
      $pet->criaImagem($pet->getFoto());
   }

  }
       $pet->setCod_pet($_POST['cod_pet']); 
       $pet->setCod_cli($_POST['cod_cli']); 
       $pet->setNome($_POST['nome']); 
       $pet->setPelagem($_POST['pelagem']); 
       $pet->setPeso($_POST['peso']); 
       $pet->setData_nasci($_POST['data_nasci']); 
       if ($petpa->alterar($pet)) {
         echo "<h2>Pet alterado com sucesso!</h2>";
       }else{
        echo "<h2>Erro na tentativa de alterar!</h2>";
       }
}



?>