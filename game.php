<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Snakes and Ladders</title>
      <link rel="stylesheet" href="./assets/css/stylesheet.css">
  </head>
  <body>
    <div class ='container bg'>
		<div class="game">
    <div class="menu">
        <button id="saveGame">Save</button>
        <button id="resetGame">Reset</button>
        <section class="p1">
          <span class="player1"></span>
          <span class="name">Player 1</span>
          <span class="score">Score: 0</span>
          <span class="status">Playing</span>
        </section>

        <span class="move">
            <button id="player1dice">Player 1</button>
            <button id="player2dice" disabled>Player 2</button>
        </span>

        <section class="dice-container">
          <div id="dice" class="show-front">
            <figure class="front"></figure>
            <figure class="back"></figure>
            <figure class="right"></figure>
            <figure class="left"></figure>
            <figure class="top"></figure>
            <figure class="bottom"></figure>
          </div>
        </section>

        <section class="p2">
          <span class="player2"></span>
          <span class="name">Player 2</span>
          <span class="score">Score: 0</span>
          <span class="status">Playing</span>
        </section>
    </div>
    <div id="gameboard">
      <div class="snakes">
        <span id="snake1"></span>
        <span id="snake2"></span>
        <span id="snake3"></span>
        <span id="snake4"></span>
        <span id="snake5"></span>
      </div>
      <div class="ladders">
        <span id="ladder1"></span>
        <span id="ladder2"></span>
        <span id="ladder3"></span>
        <span id="ladder4"></span>
        <span id="ladder5"></span>
      </div>
      <?php
      $boxCount = 0;
      $boxDirection = "right";
      for($i=100; $i>=1; $i--):
        
        $boxColors = array("yellow", "red", "dark", "blue", "green");
        $boxColor = array_rand($boxColors, 1);
        if($boxCount == 0):
          ?><div class="row <?php echo $boxDirection; ?>"><?php
        endif;
        ?><div class="box <?php echo $boxColors[$boxColor]; ?>" id="box-<?php echo $i; ?>"><span class="number"><?php echo $i; ?></span></div><?php
        if($boxCount == 9):
          ?></div><?php
        endif;
        $boxCount++;
        if($boxCount == 10) $boxCount = 0;
        if($i == 91 || $i == 71 || $i == 51|| $i == 31|| $i == 11):
          $boxDirection = "left";
        else:
          $boxDirection = "right";
        endif;
      endfor;
      
      ?>
    </div>  
    </div>
    </div>
    <form id="gameData">
      <input type="hidden" name="p1" id="p1" value="">
      <input type="hidden" name="p2" id="p2" value="">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/script.js" charset="utf-8"></script>
    <!-- Audio has a delay in Safari :( -->
    <audio preload="auto">
      <source src="./assets/audio/dice-sound.mp3"></source>
    </audio>
  </body>
</html>
