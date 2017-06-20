<!DOCTYPE html>
<?php date_default_timezone_set('America/Sao_Paulo'); 
session_start();
if((!isset ($_SESSION['nome']) == true) )
{
	unset($_SESSION['nome']);
	unset($_SESSION['senha']);
	header('location:index.php');
	}

$nome = $_SESSION['nome'];
?>
<html lang="pt-BR">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="media/ico.ico" />
	<title> Nigga Jackson</title>
	<meta charset="utf-8">
</head>
<body>
	<header>
		<img class="logo" src ="media/logo.png">
		<nav id = "menu">
			<ul>
				<li><a href="jogo.php">Jogar</a></li>
				<li><a href="regras.php">Regras</a></li>
				
				<?if(!isset ($_SESSION['nome']) == true){?>
					<li><a href="cadastro.html">Cadastro</a></li>
					<li><a href="login.html">Login</a></li>
				<?}else{?>
					<li>olá, <?php echo $_SESSION['nome']; ?></li>
                <?}?>
			</ul>
		</nav>
	</header>
	<div class="corpo">
	<div>.</div>
		<p><img src="media/21.jpg" align="right" class="imagem"/>
		No mundo dos cassinos, o blackjack é considerado o mais excitante e popular jogo de mesa disponível.
		O principal elemento para esse apelo é o fato de que no blackjack os jogadores têm uma vantagem real
		sobre a casa e isso o torna uma opção atraente tanto para novatos quanto para profissionais. Por ser fácil
		de aprender e jogar, o blackjack tem tido crescimento de popularidade e mostrado capacidade de atrair
		jogadores em todo o planeta.</p>

		<p>Blackjack ou Vinte-e-um é um jogo de azar praticado com cartas em casinos e que pode ser jogado com 1 a 8
		baralhos de 52 cartas, em que o objetivo é ter mais pontos do que o adversário, mas sem ultrapassar os 21
		(caso em que se perde). O dealer só pode pedir até um máximo de 5 cartas ou até chegar ao número 17.</p>

		<p>Agora assista um vídeo que explica as regras do jogo:</p>

		<iframe width="720" height="420" src="https://www.youtube.com/embed/7ge_KXZh4vs">
		</iframe>
	</div>
	<footer> @Autores: Debora Fagner Wiil</footer>

</body>
</html>