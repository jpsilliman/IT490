<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/seq/','192.168.3.41');
session_start();

$client=new rabbitMQClient('testRabbitMQ.ini','testServer');
$choice=$_POST['choice'];
echo $choice;
$pantry=array();

if($choice=='view'){
  $pantry['type']='viewPantry'
  $pantry['user']=$_SESSION['user'];
  $response=$client->send_request($pantry);
  $contents=$response['message'];
  var_dump($contents);
  echo "<a href='pantry.php'>Return to pantry navigation</a>"
}
elseif($choice=='add'){
  $pantry['type']='addItem';
  $pantry['user']=$_SESSION['user'];
  $pantry['food']=$_POST['food'];
  $pantry['number']=$_POST['number'];
  $pantry['unit']=$_POST['unit'];
  $response=$client->send_request($pantry);
  if($response['message']=='pantry added'){
    redirect('Pantry successfully updated.', 'pantry.php',3);
  }
}
$client->close();
?>
