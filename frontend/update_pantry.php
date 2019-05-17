<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/bud/','192.168.3.22');
session_start();
gatekeeper();

$client=new rabbitMQClient('testRabbitMQ.ini','testServer');
$pantry=array();
$pantry['type']='addItem';
$pantry['user']=$_SESSION['user'];
$pantry['food']=$_POST['food'];
$pantry['number']=$_POST['number'];
$pantry['unit']=$_POST['unit'];
$response=$client->send_request($pantry);
if($response['message']=='pantry added'){
  redirect('Pantry successfully updated.', 'pantry.php',1);
}
$client->close();
?>
