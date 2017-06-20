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
	<title> Nigga Jackson</title>
	<link rel="shortcut icon" href="media/ico.ico" />
	<meta charset="utf-8">
</head>
<body>
	<header>
		<img class="logo" src ="media/logo.png">
		<nav id = "menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="jogo.php">Jogar</a></li>
				
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
		<p>
		Para começar, o blackjack é um jogo de cartas onde o jogador irá competir contra a casa, representada pelo croupier ou dealer. 
		O jogo envolve todos os jogadores que estão recebendo cartas que possuem um valor específico. </p>
		
		<p>Depois de receber duas cartas, o jogador tira cartas para se aproximar do valor 21 sem o ultrapassar. O objetivo do jogo é 
		ganhar ao croupier obtendo um total de pontos superior a ele ou vendo-o ultrapassar 21. Cada jogador joga contra o croupier, 
		que representa a banca, ou o casino, e não contra os outros jogadores.</p>

		<p><img src="media/blackjack-valor-das-cartas.jpg" align="right" class="imagem"/>
		Todas as cartas a partir de 2 até 10 têm valor baseado no número que aparece nelas. Dessa forma, quem possui um 5 de copas, 
		tem uma carta que vale 5. Quem possui um 9 de espadas, possui uma carta que vale 9. É importante notar que o naipe da carta 
		não tem qualquer efeito sobre seu valor. Um 4 de copas ou um 4 de ouros, ambos são avaliados em 4.</p>
		
		
		<p>Além dessas cartas, existem ainda os valetes, damas e reis, cada um deles com valor de 10. O ‘ás’ é a única carta que tem 
		dois valores. Ela pode ser contada como 11 ou como 1. Isso será determinado de acordo com a combinação de cartas que o jogador 
		tiver em mãos.</p>
		
		<p>Por exemplo, se para um jogador foi fornecido um ás e logo depois um 9, então ele provavelmente irá contar o ás como um 11, 
		dando a ele um total de 20 (11+9). No entanto, se a segunda carta fornecida for um 3, então, é possível escolher contar o ás 
		como um 1 e, dessa maneira, pedir uma carta adicional ao croupier.</p>
		
		<p>Para resumir de forma simples, o principal objetivo do jogo de blackjack é conseguir um ás e uma carta com valor de 10 
		produzindo uma pontuação de 21. Quando se joga blackjack, um baralho de cartas é o mínimo requerido, mas é possível a 
		utilização até de oito baralhos. É importante perceber que quanto menos cartas são usadas, maior é a vantagem para o jogador, 
		ao passo que mais baralhos significam maior vantagem para a casa. Curiosamente, nem todos os cassinos oferecem opções de 
		blackjack com um ou dois baralhos, enquanto muitas casas limitam o número de mesas de blackjack disponíveis.</p>
		
	</div>
	<footer> @Autores: Debora Fagner Wiil</footer>

</body>
</html>