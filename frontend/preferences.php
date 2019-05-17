<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/bud/','192.168.3.22');
session_start();
gatekeeper();

$dbclient=new rabbitMQClient('testRabbitMQ.ini','testServer');
$sendpref=array();
$sendpref['type']='setUserPref';
$sendpref['user']=$_SESSION['user'];
$sendpref['url']=$_SESSION['recipe_uri'];
$sendpref['pref']=$_POST['pref'];
$dbclient->publish($sendpref);
#$response_pref=$dbclient->send_request($sendpref);
#$response_pref['message'] is an arbitrary string

$wantscore=array();
$wantscore['type']='recipeScore';
$wantscore['url']=$_SESSION['recipe_uri'];
$dbclient->publish($wantscore);
#$response_sc=$dbclient->send_request($wantscore);
$scores=$response_sc['message'];
#$scores contains likes, dislikes, total
echo $scores['total'];
$dbclient->close();
?>
