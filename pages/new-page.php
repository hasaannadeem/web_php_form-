<?php
session_start();

include ("../includes/header.php");
?>
  <h2>Data from PHP Session</h2>
  
  <?php
  if(isset($_SESSION['userinfo'])):
	echo "<pre>";print_r($_SESSION['userinfo']);echo "</pre>";
  else:
    echo "nothing found";  
  endif;
?>
  
</div>

</body>
</html>