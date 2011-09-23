<?php
  if(isset($_REQUEST['Digits'])){
    $callKey = $_REQUEST['Digits'];
  } else {
    $callKey = $_REQUEST['callKey'];
  }
echo '<?xml version="1.0" encoding="UTF-8"?>'
?>
<Response>
  <Gather action="/move.php?callKey=<?php echo $callKey; ?>" method="GET" numDigits="1" timeout="30">
    <Say>
      Which direction would you like to move?
    </Say>
  </Gather>
  <Say>You were too slow. A dragon ate you.</Say>
  <Redirect method="POST">
    /endgame.php?callKey=<?php echo $callKey; ?>
  </Redirect>
</Response>
