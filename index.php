<?php 
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<?php 
$filename = basename(__FILE__, '.php'); 
include("header.php");
?>
<body>
<?php
  
  if($_SESSION["login"]) {
    echo '<a id="logout" href="logout.php">Log Out</a>';
  }
  ?>

<form name="form" action="create.php" method="post">
  <div class="input">
  <label>Name:</label>
  <input type="text" name="name" id="name" value="">
  <label>PW:</label>
  <input type="text" name="pw" id="pw" value="">
  <input type="submit" value="Login">
  </div>
</form>

</body>
</html>