<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0,'/seq/','192.168.3.41');
session_start();

gatekeeper();

$client=new rabbitMQClient('testRabbitMQ.ini','testServer');

$profile=array();
$profile['type']='setPreferences';
$profile['user']=$_SESSION['user'];
$profile['Balanced']=(isset($_POST['balanced'])?1:0);
$profile['High-Fiber']=(isset($_POST['high-fiber'])?1:0);
$profile['High-Protein']=(isset($_POST['high-protein'])?1:0);
$profile['Low-Carb']=(isset($_POST['low-carb'])?1:0);
$profile['Low-Fat']=(isset($_POST['low-fat'])?1:0);
$profile['Low-Sodium']=(isset($_POST['low-sodium'])?1:0);
$profile['Alcohol-free']=(isset($_POST['alcohol-free'])?1:0);
$profile['Celery-free']=(isset($_POST['celery-free'])?1:0);
$profile['Crustacean-free']=(isset($_POST['crustacean-free'])?1:0);
$profile['Dairy']=(isset($_POST['dairy'])?1:0);
$profile['Eggs']=(isset($_POST['eggs'])?1:0);
$profile['Fish']=(isset($_POST['fish'])?1:0);
$profile['Gluten']=(isset($_POST['gluten'])?1:0);
$profile['Kidney-friendly']=(isset($_POST['kidney-friendly'])?1:0);
$profile['Kosher']=(isset($_POST['kosher'])?1:0);
$profile['Low-potassium']=(isset($_POST['low-potassium'])?1:0);
$profile['Lupine-free']=(isset($_POST['lupine-free'])?1:0);
$profile['Mustard-free']=(isset($_POST['mustard-free'])?1:0);
$profile['No-oil-added']=(isset($_POST['no-oil-added'])?1:0);
$profile['No-sugar']=(isset($_POST['no-sugar'])?1:0);
$profile['Paleo']=(isset($_POST['paleo'])?1:0);
$profile['Peanuts']=(isset($_POST['peanuts'])?1:0);
$profile['Pescatarian']=(isset($_POST['pescatarian'])?1:0);
$profile['Pork-free']=(isset($_POST['pork-free'])?1:0);
$profile['Red-meat-free']=(isset($_POST['red-meat-free'])?1:0);
$profile['Sesame-free']=(isset($_POST['sesame-free'])?1:0);
$profile['Shellfish']=(isset($_POST['shellfish'])?1:0);
$profile['Soy']=(isset($_POST['soy'])?1:0);
$profile['Sugar-conscious']=(isset($_POST['sugar-conscious'])?1:0);
$profile['Tree Nuts']=(isset($_POST['tree_nuts'])?1:0);
$profile['Vegan']=(isset($_POST['vegan'])?1:0);
$profile['Vegetarian']=(isset($_POST['vegetarian'])?1:0);
$profile['Wheat-free']=(isset($_POST['wheat-free'])?1:0);

$response=$client->send_request($profile);
$message=$response["message"];

if($message=='preferences added'){
  $_SESSION=array();
  session_destroy();
  setcookie('PHPSESSID','',time()-3600,'/','',0,0);
  redirect("Profile saved. Directing you to the login page.",'login.html',3);
}
$client->close();
?>
