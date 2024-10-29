<?php
require_once 'cabecalho.php';
if (isset($_COOKIE['funcionario'])) {
?>
<section class="topo">
 <div id="logo">
 	<img src="img/fofinnhos.jpg">
 </div>
 <div id="menu">
 	<ul class="nav">
 <?php if ($_COOKIE['funcionario']==1){?>
 <li>Funcionário
 	<ol>
 		<li><a href="cadastrarfuncionario.php" target="janela"> Cadastrar</a></li>
 		</ol>
 		</li>
 	<?php } ?>
          <li>CLiente
          	<ol>
          		<li><a href="cadastrarcliente.php" target="janela">Cadastrar</a></li>
          	</ol>
      </li>
      <li>Pet
      	<ol>
      		<li><a href="cadastrarpets.php" target="janela">Cadastrar</a></li>
      		<li><a href="listarPet.php" target="janela">Listar</a></li>
            <li><a href="buscarpet.php" target="janela">Buscar</a></li>
      	</ol>
      </li>
      	<li>Serviço
      	<ol>
      	<li><a href="cadastrarservico.php" target="janela">Cadastrar</a></li>
      	<li><a href="listarservico.php" target="janela">Listar</a></li>
      	<li><a href="buscarservico.php" target="janela">Buscar</a></li>
      </ol>
  </li>
  <li>Competição
  	<ol>
  	<li><a href="cadastrarcompeticao.php" target="janela">Cadastrar</a></li>
  	<li><a href="inscreverpet.php" target="janela">Inscrever</a></li>
  	<li><a href="listarcompeticao" target="janela">Listar</a></li>
  </ol>
</li>
   <li>Sair
     <ol>
         <li><a href="logoff.php">Logoff</a>
      </ol>
    </li>
   </ul>
  </div>
 </section>
 <section class="conteudo">
 	<iframe src="home.php" class="janela" name="janela"></iframe>
   </section>
<section class="rodape">
   <p> Petshop Fofinnhos &reg;</p>
   <p> &#9742; (42) 3025-0404</p>
</section>


<?php
}else{
	echo "<h2>Você não está logado!</h2>";
	echo "<a href='index.php'>Login </a>";
    
}
?>

</body>
</html>
