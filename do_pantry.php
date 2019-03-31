<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/seq/','192.168.3.41');
session_start();

$client=new rabbitMQClient('testRabbitMQ.ini','testServer');
$choice=$_POST['choice'];

if($choice=='view'){
  $pantry['type']='viewPantry';
  $pantry['user']=$_SESSION['user'];
  $response=$client->send_request($pantry);
  $contents=$response['message'];
  echo "<b>See your pantry contents below</b><br><br>";
  echo "<table>";
  echo "<tr>";
  echo "<td><b>Food</b></td>";
  echo "<td>&nbsp;</td>";
  echo "<td><b>Amount</b></td>";
  echo "</tr>";
  for($i=0; $i<count($contents); $i++){
    echo "<tr>";
    echo "<td>".$contents[$i][0]."</td>";
    echo "<td>&nbsp;</td>";
    echo "<td>".$contents[$i][1]." ".$contents[$i][2]."</td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "<br><br><a href='pantry.php'>Return to pantry</a>";
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
