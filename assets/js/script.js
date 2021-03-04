$(function(){

    var p1Score = 0;
    var p1Active = "0";
    var p2Score = 0;
    var p2Active = "0";
    var playerTurn = '1';

    function randomizeNumber() {
        //Randimizes a number between 1 and 6
        var random = Math.floor((Math.random() * 6) + 1);
        return random;
    }

    function rollDice(side) {
        //Removes old class and adds the new
        var dice = $('#dice');
        var currentClass = dice.attr('class');
        var newClass = 'show-' + side;
        
        dice.removeClass();
        dice.addClass(newClass);
        
        if (currentClass == newClass) {
            dice.addClass('show-same');
        }
            
    }
    
    function soundEffect() {
        var audio = $("audio")[0];
        audio.pause();
        audio.currentTime = 0;
        audio.play();
    }
    
    $('button#player1dice, button#player2dice').on('click ', function() {
        
        //Function triggered on dice dragstop
        var number = randomizeNumber();

        if (number == 1) { rollDice('front'); }
        else if (number == 2) { rollDice('top'); }
        else if (number == 3) { rollDice('left'); }
        else if (number == 4) { rollDice('right'); }
        else if (number == 5) { rollDice('bottom'); }
        else if (number == 6) { rollDice('back'); }
        console.log("dice: "+number);
        soundEffect();

        //change turn
        if(playerTurn == '1'){
            console.log("playerTurn: "+playerTurn);
            $('button#player1dice').attr('disabled', 'disabled');
            $('button#player2dice').removeAttr('disabled');

            //check player turn and status player
            if(p1Active == "1"){

                console.log("p1Active: "+p1Active);

                p1Score = p1Score + number;
                console.log("p1Score: "+p1Score);

                p1Score = checkSnakeLadder(p1Score);
                udpatePlayer('1', p1Score);

            }else if(p1Active == "0"){
                if(number == 6 || number == 1){
                    $("#box-1").append('<span id="player1"></span>');
                    p1Score = 1;
                    p1Active = "1";
                }
            }
            
            playerTurn = '2';

        }else if(playerTurn == '2'){
            console.log("playerTurn: "+playerTurn);
            $('button#player2dice').attr('disabled', 'disabled');
            $('button#player1dice').removeAttr('disabled');

            //check player turn and status player
            if(p2Active == "1"){

                console.log("p2Active: "+p2Active);

                p2Score = p2Score + number;
                console.log("p2Score: "+p2Score);

                p2Score = checkSnakeLadder(p2Score);
                udpatePlayer('2', p2Score);

            }else if(p2Active == "0"){
                if(number == 6 || number == 1){
                    $("#box-1").append('<span id="player2"></span>');
                    p2Score = 1;
                    p2Active = "1";
                }
            }
            
            playerTurn = '1';
        }
        number = 0;
        
    });

    $('button#resetGame').on('click ', function() {
        console.log("reset clicked");
        location.reload(); 
    });

    $('button#saveGame').on('click ', function() {
        console.log("saved clicked");

        $("form#gameData input#p1").val(p1Score);
        $("form#gameData input#p2").val(p2Score);
        var values = $("form#gameData").serialize();

        var ajaxRequest;
        ajaxRequest= $.ajax({
                url: "savegame.php",
                type: "post",
                data: values
            });
        ajaxRequest.done(function (response, textStatus, jqXHR){
            console.log(response);

        });
        ajaxRequest.fail(function (){
            console.log("error");
        });

    });

    

    function udpatePlayer(player, score){

        $(".game .menu section.p"+ player +" span.score").html('Score: '+ score);
        $(".game .menu section.dice-container .move").html('Player ' + player);
        
        $("#gameboard .box #player"+player).remove();
        $("#gameboard #box-"+score).append('<span id="player'+player+'"></span>');

        if(score >= 100){
            $(".game .menu section.p"+ player +" span.status").html('Won');
            $("#gameboard").css('opacity', "0.5");
        }
        
    }

    function checkSnakeLadder(score){

        var laddersArrStart = [9,16,40,57,72];
        var laddersArrEnd = [32,46,41,78,93];
        var snakesArrStart = [39,45,73,85,98];
        var snakesArrEnd = [19,7,49,37,42];

        for(var i=0; i<laddersArrStart.length; i++){
            if(score == laddersArrStart[i]){
                score = laddersArrEnd[i];
                console.log('ladder found');
            }
        }

        for(var i=0; i<snakesArrStart.length; i++){
            if(score == snakesArrStart[i]){
                score = snakesArrEnd[i];
                console.log('snake found');
            }
        }

        return score;
        
    }
});