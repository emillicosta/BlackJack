<?php
$fp = fopen("usuarios.txt", "a+");
 
$escreve = fwrite($fp, "Nome:". $_POST["nome"]." Login:". $_POST["login"]." Senha:". $_POST["senha"].";\n");
 
fclose($fp); 
session_start();

		$_SESSION['nome'] = $_POST["nome"];
		header('Location: index.php');
?>