<?php
  require_once("includes/memcache.php");
  $memcache = new RR_Memcache();
  $callKey = $_REQUEST['callKey'];

  $memcache->set($callKey,"stop");
  echo '<?xml version="1.0" encoding="UTF-8"?>'
?>
<Response>
  <Hangup />
</Response>
