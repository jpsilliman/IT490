<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/seq/', '192.168.3.41');
session_start();
gatekeeper();

$choice=$_POST['choice'];
if($choice=='get'){
  $dbclient=new rabbitMQClient('testRabbitMQ.ini','testServer');
  $send=array();
  $send['type']='getPreference';
  $send['user']=$_SESSION['user'];
  echo 'array populated';
  $response=$dbclient->send_request($send);
  $preferences=$response['message'];
  $dbclient->close();
  var_dump($preferences);
  echo "<br><br><a href='recipes.php'>Return to recipes</a>";

/*
  $apiclient=new rabbitMQClient('apiRabbitMQ.ini','testServer');
  $request=array();
  $request['type']='getRecipe';
  $request['query']=$_POST['food'];
  $request['preferences']=$preferences;
  $recipe=$apiclient->send_request($request);
*/
}
?>
