<?php
date_default_timezone_set('America/Sao_Paulo'); 
$array = file("usuarios.txt");
foreach($array as $linha){
	list ($cabeca, $corpo) = split (' Login:', $linha);
	list ($inicio, $nome) = split ('Nome:', $cabeca);
	list ($login, $senha) = split (' Senha:', $corpo);
	list ($senha, $resto) = split (';', $senha);
	if($login == $_POST["login"] && $senha == $_POST["senha"]){
		echo "foi";
		$array = null;
		session_start();

		$_SESSION['nome'] = $nome;
		header('Location: index.php');
	}
}
?>
