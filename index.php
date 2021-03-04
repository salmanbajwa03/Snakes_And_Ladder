<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Snakes and Ladders</title>
      <link rel="stylesheet" href="./assets/css/stylesheet.css">
  </head>
  <body>
    <div class ='container bg'>
        <div class="start">
			<img class="gameHeaderName" src="./assets/images/photo3.png" alt="SnakesAndLadderImage">
			
			<div class="startarea">
				<div class="box"><span id="player1"></span></div>
				<div class="box"><span id="player2"></span></div>
				<a id="startgame" href="//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>game.php">Start Game</a>
			</div>
        </div>
    </div>
  </body>
</html>
