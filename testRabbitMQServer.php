#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('logincheck.php');
function doLogin($username,$password)
{
return loginCheck($username,$password);
}
function createUsers($firstName,$lastName,$email,$userName,$password)
{
return createUser($firstName,$lastName,$email,$userName,$password);
}
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
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
    case "createUsers":
	return createUsers($request['firstName'],$request['lastName'],$request['email'],$request['userName'],$request['password']);
    case "getPreference":
	return getPreference($request['username']);
    case "setPreference":
	return setpreferences($request['$array']);
    case "getList":
	return getList($request['username']);
    case "setList":
	return setList($request['username'],$request['List']);
    case "getLikes":
	return getLikes($request['url']);
    case "setLikes":
	return setLikes($request['url'],$request['List']);
}

  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("tjInfo.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>










//km


