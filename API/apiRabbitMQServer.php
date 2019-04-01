#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function apiRequest($request)
{
	ini_set("allow_url_fopen",1);
	$query=$request['query'];
	$query=urlencode($query);
	$preferences=$request['preferences'];
	$diet_parameters=['balanced','high-fiber','high-protein','low-carb','low-fat','low-sodium'];
	$diet='none';
	$health_parameters='';

	for($i=0; $i<count($preferences); $i++){
		if(in_array($preferences[$i], $diet_parameters)){
			$diet=$preferences[$i];
		}
		else{
			$health_parameters.='health='.$preferences[$i].'&';
		}

	}



$url = "https://api.edamam.com/search?q=$query&app_id=305dd810&app_key=7a97bdc6180d36473b4b33cccecaa9a0&";

if($diet!='none'){
	$url.='diet=';
	$url.=$diet;
	$url.='&';
}
if($health_parameters!=''){
	$url.=$health_parameters;
}
$url=substr($url,0,-1);
$data = file_get_contents($url);
if($data==null or $data==''){
  return 'No matches';
}

$json = json_decode($data, true);
$hits=array();

foreach($json['hits'] as $hit){
  $label= $hit['recipe']['label'];
  $recipeURL = $hit['recipe']['shareAs'];
  $hits[$label]=$recipeURL;
}

return $hits;
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  echo '\n' . 'End Message';
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "getRecipe":
	$message=apiRequest($request);

  }
  return array("returnCode" => '0', 'message'=>$message);
}

$server = new rabbitMQServer("apiRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();


?>

