<?php 
  session_start();

  require '/var/www/vendor/autoload.php';
  if($_SESSION["login"]) {
    $client = new WebSocket\Client("wss://flox.xyz/asd");
    $pass = json_encode(array('type' => 'pass', 'payload' => 'asd'));
    $client->text($pass);
    $msg = json_encode(array('type' => 'videoStream', 'payload' => array('action' => 'unregister')));
    $client->text($msg);
    $client->close();
    $json = json_encode(array('link' => ''));
    file_put_contents("link.json", $json);

  }
  header("Location: https://asd.flox.xyz/create.php");
?>