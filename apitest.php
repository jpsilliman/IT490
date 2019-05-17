#!/usr/bin/php
<?php
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

echo $url;
echo "\n\n";
$hits=array();

$data = file_get_contents($url);
$json = json_decode($data, true);
foreach($json['hits'] as $hit){	
  $label= $hit['recipe']['label'];
  $recipeURL = $hit['recipe']['shareAs'];
  $hits[$label]=$recipeURL;
}
return $hits;

}
$testdata=array();
$testdata['query']='fish';
$testdata['preferences']=['high-protein','alcohol-free','sugar-conscious','tree-nut-free','peanut-free'];

$returned=apiRequest($testdata);
foreach($returned as $label=>$shareAs){
  echo $label.': '.$shareAs."\n";
}

?>

