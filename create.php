<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php 
$filename = basename(__FILE__, '.php'); 
include("header.php");
?>

<body>
<?php

if ($_POST["name"] == "username" && $_POST["pw"] == "password" || $_SESSION["login"] == 1) {
  $_SESSION["login"] = 1;
  if($_POST["name"]) {

  
  $_SESSION["name"] = $_POST["name"];
  }

  echo "<div id='loggedin'>Logged in as: {$_SESSION["name"]} </div>";
} else {
  header("Location: https://asd.flox.xyz/");
  die();
}
?>

<a id="logout" href="logout.php">Log Out</a>
<form name="form" action="video.php" method="post">
<div class="input">
  <?php
    $rawJson = file_get_contents("link.json");
    $json = json_decode($rawJson,true);

    if($json["link"]) {
          echo "<input type='hidden' name='link' id='link' value='{$json["link"]}''>
              <input id='join' type='submit' name='Join' value='Join'>
              <a id='stop' href='stop.php'>Stop</a>";

      } else {
          echo '<label>Video:</label>
                <input type="text" name="link" id="link" value="">
                <input id="create" value="Create room" type="submit">';
      }

  ?>  
</div>
</form>

</body>
</html>