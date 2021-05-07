<?php
session_start();
session_unset();
session_destroy();
?>
<script>
  window.location.assign('../index.php');
</script>