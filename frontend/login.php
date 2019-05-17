<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0,'/bud/','192.168.3.22');
session_start();

$client=new rabbitMQClient('testRabbitMQ.ini','testServer');

$login=array();
$login['type']='login';
$login['username']=$_POST['user'];
$login['password']=$_POST['pass'];

$response=$client->send_request($login);
$message=$response["message"];

if($message=="Login failed"){
  redirect("Invalid credentials. Please try again.","login.html", 3);
}
elseif($message=="Login successful"){
  $_SESSION['logged']=true;
  $_SESSION['user']=$_POST['user'];
  redirect("Login successful. Redirecting to home page.","home.php",3);
}
$client->close();
?>
