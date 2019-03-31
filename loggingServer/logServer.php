#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doWriteLogs($request)
{	
	file_put_contents('logs.log', $request, FILE_APPEND);		
}	  

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  doWriteLogs($request);
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","logServer");
echo "LOGGING BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "LOGGING END".PHP.EOL;
exit();

?>
