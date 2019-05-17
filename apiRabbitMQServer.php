#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function recipeRequestQ($request)
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
	  $recipeURL = $hit['recipe']['uri'];
	  $hits[$label]=$recipeURL;
	}

	return $hits;
}

function recipeRequestR($request)
{
        ini_set("allow_url_fopen",1);
        $recipe=$request['uri'];
        $recipe=urlencode($recipe);

        $url = "https://api.edamam.com/search?r=$recipe&app_id=305dd810&app_key=7a97bdc6180d36473b4b33cccecaa9a0";
        $data = file_get_contents($url);
        if($data==null or $data==''){
          return 'No matches';
        }

        $json = json_decode($data, true);
	$info=array();
	
	$info['title']= $json[0]['label'];
	$info['calories']=$json[0]['calories'];
	$info['dietLabels'] = $json[0]['dietLabels'];
	$info['healthLabels']=$json[0]['healthLabels'];
	$info['ingredients']=$json[0]['ingredientLines'];
	$info['link']=$json[0]['shareAs'];
        return $info;
}

function youtubeRequest($request){
/**
 * Sample PHP code for youtube.search.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/guides/code_samples#php
 */

	if (!file_exists(__DIR__.'/vendor/autoload.php')) {
	  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
	}	
	require_once __DIR__ . '/vendor/autoload.php';

	$client = new Google_Client();
	$client->setApplicationName('API code samples');
	$client->setDeveloperKey('AIzaSyCw_YfGzEYHxGmi6xdcrcBicVJpuckmZPs');

	// Define service object for making API requests.
	$service = new Google_Service_YouTube($client);

	$queryParams = [
	    'maxResults' => 1,
	    'order' => 'relevance',
	    'q' => $request['searchterm'],
	    'type' => 'video',
	    'videoEmbeddable' => 'true'
	];
	
	$oir=array();
	$response = $service->search->listSearch('snippet', $queryParams);
	$oir['id']=$response['items'][0]['id']['videoId'];
	$oir['title']=$response['items'][0]['snippet']['title'];
	return $oir;
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
    case "recipe_q":
	$message=recipeRequestQ($request);
        break;
    case "recipe_r":
	$message=recipeRequestR($request);
	break;
    case "youtube":
	$message=youtubeRequest($request);
	break;
  }
  return array("returnCode" => '0', 'message'=>$message);
}

$server = new rabbitMQServer("apiRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();


?>

