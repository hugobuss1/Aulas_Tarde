<?php require_once 'model/Funcionario.php';
$funcionario=new Funcionario();
$funcionario->logoff();
header("Location:index.php");
?>