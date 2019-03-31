<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/seq/','192.168.3.41');
session_start();

$client=new rabbitMQClient('testRabbitMQ.ini','testServer');

$register=array();
$register['type']='register';
$register['email']=$_POST['email'];
$register['first']=$_POST['first'];
$register['last']=$_POST['last'];
$register['user']=$_POST['user'];
$register['pass']=$_POST['pass'];

$response=$client->send_request($register);
$message=$response["message"];

if($message=="User Created!"){
  $_SESSION['logged']=true;
  $_SESSION['user']=$_POST['user'];
  redirect('User successfully registered. Redirecting to build dietary profile.' ,'buildprofile.html',3);
}
elseif($message=="Duplicate"){
  redirect("Email already in use. Please use a different email or try logging in using that email.",'register.html', 3);
}
$client->close();
?>
