<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
  $callKey = rand(1000,9999);
  $rows = 20;
  $cols = 24;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="DESCRIPTION" content="" />    
    <title>Twilio Snake!</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
    <script>
      var pos = {};
      pos[0] = 0;
      pos[1] = 0;
      var pastMoves = [];
      pastMoves[0] = '0-0';

      function getMove(){
        $.ajax({
          type: "GET",
          url: "getmove.php",
          data: "callKey=<?php echo $callKey; ?>",
          dataType: "json",
          success: function(data) {
            doMove(data.move);
          }/*,
          complete: function(msg) { 
            setTimeout("getMove()","500");
          }*/
        });
      }

      function pauseGame(){
        // do some work here
      }

      function isValidMove(nextPos){
        // check for previous moves
        if($.inArray(nextPos[0]+'-'+nextPos[1],pastMoves)!=-1){
          return false;
        }

        // check for out of bounds
        if(nextPos[0] < 0 || nextPos[0] > <?php echo $rows; ?> || nextPos[1] < 0 || nextPos[1] > <?php echo $cols; ?>){
          return false;
        }

        return true;
      }

      function doMove(direction){
        switch(direction){
          case "up":
            pos[0] = pos[0]-1;    
            break;
          case "down":
            pos[0] = pos[0]+1;
            break;
          case "left":
            pos[1] = pos[1]-1;
            break;
          case "right":
            pos[1] = pos[1]+1;
            break;
          default:
            setTimeout("getMove()","500");
            return false;
            break;
        }
        if(!isValidMove(pos)){
          alert("you died");
          return false;
        }
        pastMoves[pastMoves.length] = pos[0]+'-'+pos[1];
        setTimeout("getMove()","500");

        $("#pos"+pos[0]+"-"+pos[1]).css("background-color","#FF0000");

        return true;
    }

    $(document).ready(function(){
      setTimeout("getMove()","1000"); /* kick off the short polling in 1 second */
      $("#pos0-0").css("background-color","#FF0000");
    });
    </script>

  </head>
  <body>
 <div id="water_bg"></div>
    <div id="wrapper">
      <img src="images/logo.png"  width="513" height="116" alt="Twilio Snake!" class="logo" />
      <div id="main_box">
        <h1>Call <span class="highlight">(718) 412-8151</span> and enter game code <span class="highlight"><?php echo $callKey; ?></span> to play!</h1>
        <div id="game_wrapper">
      <?php 
      for($r=0;$r < $rows;$r++) { 
        if($r!=0){
          echo "<br style='clear:both;'>";
        }
        for($c=0;$c < $cols;$c++) {
          echo "<div class='square' style='width:20px;height:20px;float:left;' id='pos".$r."-".$c."'></div>";
        }
      } 
      ?>  
        </div>
        <div id="sidebar">
          <p>Phone Keypad Controls</p>
          <img src="images/controls.png"  width="160" height="152" alt="" class="controls" />
          <p class="small">Pause = any other key</p>
        </div>
      </div>
      <br class="clear" />
    </div>
    <div id="footer_wrapper">
      <p>Created by <a href="http://rickyrobinett.com" target="_blank">Ricky Robinett</a></p>
    </div>
  </body>
</html>
