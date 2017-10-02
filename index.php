<?php //index.php
  require_once 'header_no_log_msg.php';

  echo "<br><span class='main'>Welcome to $appname,";

  if ($loggedin) echo " $user, you are logged in.</span>";
  else           echo ' please sign up and/or log in to join in.</span>';
?>

    </span><br><br>
  </body>
</html>
