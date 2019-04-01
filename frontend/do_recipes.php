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
  $response=$dbclient->send_request($send);
  $preferences=$response['message'];
  
  $apiclient=new rabbitMQClient('apiRabbitMQ.ini','testServer');
  $request=array();
  $request['type']='getRecipe';
  $request['query']=$_POST['food'];
  $request['preferences']=$preferences;
  $response=$apiclient->send_request($request);
  $recipes=$response['message'];
  if(gettype($recipes)=='array'){
    echo "<b>See recipes below</b><br>";
    echo "<table>";
    foreach($recipes as $title=>$url){
       echo "<tr><td><a href=$url target='_blank'>$title</a></td></tr>";
    }
    echo "</table>";
    echo "<br><br><a href='recipes.php'>Return to recipes</a>";
  }
  elseif(gettype($recipes)=='string' and $recipes=='No matches'){
    redirect('No results found for your search that match your diet profile. Please try again. Your search was: '.$request['query'].'.','recipes.php',3);
  }
}
$dbclient->close();
$apiclient->close();
?>
