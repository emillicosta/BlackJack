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
<link rel="stylesheet" type="text/css" href="css/style_jogo.css">
<title> Nigga Jackson</title>
<link rel="shortcut icon" href="media/ico.ico" />
<meta charset="utf-8">
<script type="text/javascript" src="js/Cards.js"></script>
<script type="text/javascript" src="js/DisplayedCard.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="http://math.hws.edu/eck/cs271/js-work/js/scriptaculous.js?load=effects"></script>

<script type="text/javascript">

var dealerCards = [];  // Arrays holding the DisplayCard objects used to show the cards
var playerCards = [];

dealerCards.count = 0;  // Number of cards actually in the dealer's hand
playerCards.count = 0;   // Number of cards actually in the player's hand

var deck = new Deck();

var gameInProgress = false;

var message;

var standButton, hitButton, newGameButton;  // objects representing the buttons, so I can enable/disable them

function setup() {
    for (var i = 1; i <= 5; i++) {
       dealerCards[i] = new DisplayedCard("dealer" + i);
       dealerCards[i].cardContainer.style.display = "none";
       playerCards[i] = new DisplayedCard("player" + i);
       playerCards[i].cardContainer.style.display = "none";
    }
    message = document.getElementById("message");
    standButton = document.getElementById("standButton");
    hitButton = document.getElementById("hitButton");
    newGameButton = document.getElementById("newGameButton");
    standButton.disabled = true;
    hitButton.disabled = true;
    newGameButton.disabled = false;
}


function dealCard(cards, runOnFinish, faceDown) {
    var crd = deck.nextCard();
    cards.count++;
    if (faceDown)
       cards[cards.count].setFaceDown();
    else
       cards[cards.count].setFaceUp();
    cards[cards.count].setCard(crd);
    new Effect.SlideDown(cards[cards.count].cardContainer, {
       duration: 0.5,
       queue: "end",
       afterFinish: runOnFinish
    });
}

function getTotal(hand) {
   var total = 0;
   var ace = false;
   for (var i = 1; i <= hand.count; i++) {
       total += Math.min(10, hand[i].card.value); 
       if (hand[i].card.value == 1)
          ace = true;
   }
   if (total + 10 <= 21 && ace)
      total += 10;
   return total;
}

function startGame() {
   if (!gameInProgress) {
      
      for (var i = 1; i <= 5; i++) {
          playerCards[i].cardContainer.style.display = "none";
          playerCards[i].setFaceDown();
          dealerCards[i].cardContainer.style.display = "none";
          dealerCards[i].setFaceDown();
      }
      message.innerHTML = "Distribuindo Cartas";
      deck.shuffle();
      dealerCards.count = 0;
      playerCards.count = 0;
      dealCard(playerCards);
      dealCard(dealerCards);
      dealCard(playerCards);
      dealCard(dealerCards, function() {
             standButton.disabled = false;
             hitButton.disabled = false;
             newGameButton.disabled = true;
             gameInProgress = true;
             var dealerTotal = getTotal(dealerCards);
             var playerTotal = getTotal(playerCards);
             if (dealerTotal == 21) {
                if (playerTotal == 21)
                    endGame(false, "Ambos têm Blackjack, mas o Dealer ganha");
                else
                    endGame(false, "O Dealer tem um Blackjack.");
             }
             else if (playerTotal == 21)
                endGame(true, "Você tem um Blackjack.");
             else
                message.innerHTML = "Você tem " + playerTotal +".  puxar ou parar?";
          }, true);
   }
}

function endGame(win, why) {
     
     message.innerHTML = (win ? "Parabéns! Você venceu.  " : "Você Perdeu.  ") + why;
     standButton.disabled = true;
     hitButton.disabled = true;
     newGameButton.disabled = true;
     gameInProgress = false;
     if (dealerCards[2].faceDown) {
       dealerCards[2].cardContainer.style.display = "none";
       dealerCards[2].setFaceUp();
       new Effect.SlideDown(dealerCards[2].cardContainer, { duration: 0.5, queue: "end" });
     }
     standButton.disabled = true;
                       hitButton.disabled = true;
                       newGameButton.disabled = false;
}


function dealersTurnAndEndGame() {
    message.innerHTML = "Distribuindo cartas...";
    dealerCards[2].cardContainer.style.display = "none";
    dealerCards[2].setFaceUp();
    var takeNextCardOrFinish = function() {
       new Effect.SlideDown(dealerCards[dealerCards.count].cardContainer, {
          duration: 0.5,
          queue: "end",
          afterFinish: function() {
              var dealerTotal = getTotal(dealerCards);
              if (dealerCards.count < 5 && dealerTotal <= 16) {
                  dealerCards.count++;
                  dealerCards[dealerCards.count].setCard(deck.nextCard());
		          dealerCards[dealerCards.count].setFaceUp();
                  takeNextCardOrFinish();
              }
              else if (dealerTotal > 21)
                 endGame(true, "O dealer passou de 21.");
              else if (dealerCards.count == 5)
                 endGame(false, "O dealer  tirou 5 cartas sem ter 21.");
              else {
                 var playerTotal = getTotal(playerCards);
                 if (playerTotal > dealerTotal)
                    endGame(true, "Você tem " + playerTotal + ". Dealer tem " + dealerTotal + ".");
                 else if (playerTotal < dealerTotal)
                    endGame(false, "Você tem " + playerTotal + ". Dealer tem " + dealerTotal + ".");
                 else
                    endGame(false, "Você e o dealer estão empatados " + playerTotal + ".");
              }
          }
       });
    };
    takeNextCardOrFinish();
}

function hit() {
   if (!gameInProgress)
      return;
   standButton.disabled = true;
   hitButton.disabled = true;
   dealCard(playerCards, function() {
      var playerTotal = getTotal(playerCards);
      if (playerTotal > 21)
         endGame(false, "VOCÊ PASSOU DE 21!");
      else if (playerCards.count == 5)
         endGame(true, "Você tirou 5 cartas sem ter 21.");
      else if (playerTotal == 21)
         dealersTurnAndEndGame();
      else {
         message.innerHTML = "Você tem " + playerTotal + ". puxar or parar?";
         hitButton.disabled = false;
         standButton.disabled = false;
      }
   });
}

function stand() {
   if (!gameInProgress)
      return;
   hitButton.disabled = true;
   standButton.disabled = true;
   dealersTurnAndEndGame();
}

onload=setup;

</script>
</head>
<body>
	<header>
		<!--img width= "100px"class="logo" src ="media/logo.png"-->
		<nav id = "menu">
			<ul>
				<li style="text-align:center;"><img width= "70px" class="logo" src ="media/logo.png"></li>
				<li><a href="index.php">Home</a></li>
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
    <div class="nome" style="top:100px;">Cartas do Dealer:</div>
    <div id="dealer1" class="cartas" style="left: 150px; top:30px;"></div>
    <div id="dealer2" class="cartas" style="left: 250px; top:30px;"></div>
    <div id="dealer3" class="cartas" style="left: 350px; top:30px;"></div>
    <div id="dealer4" class="cartas" style="left: 450px; top:30px;"></div>
    <div id="dealer5" class="cartas" style="left: 550px; top:30px;"></div>
	
    <div class="nome" style="top:355px;">Suas cartas:</div>
    <div id="player1" class="cartas" style="left: 150px; top:300px;"></div>
    <div id="player2" class="cartas" style="left: 250px; top:300px;"></div>
    <div id="player3" class="cartas" style="left: 350px; top:300px;"></div>
    <div id="player4" class="cartas" style="left: 450px; top:300px;"></div>
	<div id="player5" class="cartas" style="left: 550px; top:300px;"></div>
    
</div>
<button class="hit" id="hitButton" onclick="hit()" disabled>Puxar Carta</button>
<button class="stand" id="standButton" onclick="stand()" disabled>Parar</button>
<button class="game" id="newGameButton" onclick="startGame()">Nova Rodada</button>
<span class="message" id="message" >Click em "Nova Rodada" para começar.</span>

</body>
