#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//include('logincheck.php');
include('safe_functions2.php');
//function doLogin($username,$password)
//{
//return loginCheck($username,$password);
//}
//function createUsers($firstName,$lastName,$email,$userName,$password)
//{
//return createUser($firstName,$lastName,$email,$userName,$password);
//}
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
        $message= loginCheck($request['username'],$request['password']);
	echo $message;
	break;
   // case "validate_session":
   //    $message=doValidate($request['sessionId']);
    case "register":
	$message=createUser($request['first'],$request['last'],$request['email'],$request['user'],$request['pass']);
	echo $message;
	break;
    case "getPreference":
	$message= getPreference($request['user']);
	break;
    case "setPreferences":
	$message=setPreferences($request);
	break;
    case "getList":
	$message=getList($request['username']);
	break;
    case "setList":
	$message=setList($request['username'],$request['List']);
	break;
    case "getLikes":
	$message=getLikes($request['url']);
	break;
    case "setLikes":
	$message=setLikes($request['url'],$request['List']);
	break;
    case "viewPantry":
	$message=getPantry($request['user']);
	break;
    case "addItem":
	$message=setPantry($request);
	break;
   case "setUserPref":
	$message=setLikes($request['user'],$request['url'],$request['pref']);
	break;
   case "getUserPref":
	$message=getUserPref($request['user'], $request['url']);
	break;
   case "recipeScore":
	$message=getLikes($request['url']);
	break;
}

  echo "i made it to the end";
  return array("returnCode" => '0', 'message'=>$message);
}

$server = new rabbitMQServer("tjInfo.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
