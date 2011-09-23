<?php
  require_once("includes/memcache.php");
  $memcache = new RR_Memcache();
  $callKey = $_REQUEST['callKey'];

  $aResponse = array("move"=>$memcache->get($callKey));
  echo json_encode($aResponse);
?>
