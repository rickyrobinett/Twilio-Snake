<?php
require_once("includes/memcache.php");
// do some quick setup
$memcache = new RR_Memcache();
$callKey = $_REQUEST['callKey'];

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<Response><Say>";

  switch($_REQUEST['Digits']){
    case 2:
      echo "up";
      $memcache->set($callKey,"up"); 
      break;
    case 4:
      echo "left";
      $memcache->set($callKey,"left");
      break;
    case 6:
      echo "right";
      $memcache->set($callKey,"right");
      break;
    case 8:
      echo "down";
      $memcache->set($callKey,"down");
      break;
    default:
      echo "pause";
      $memcache->set($callKey,"pause");
      break;
  }
  echo '</Say>'
?>
  <Redirect method="POST">
    /gather.php?callKey=<?php echo $callKey; ?>
  </Redirect>
</Response>
