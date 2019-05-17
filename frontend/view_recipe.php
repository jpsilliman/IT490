<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0, '/bud/', '192.168.3.22');
session_start();
gatekeeper();

$query=$_GET['query'];
$uri=urldecode($_GET['recipe']);
$_SESSION['recipe_uri']=$uri;

$apiclient=new rabbitMQClient('apiRabbitMQ.ini','testServer');
$dbclient=new rabbitMQClient('testRabbitMQ.ini','testServer');

$request_r=array();
$request_r['type']='recipe_r';
$request_r['uri']=$uri;
$response_r=$apiclient->send_request($request_r);
$recipeinfo=$response_r['message'];
#$recipeinfo contains title, diet labels, health labels, ingredients
echo '<title>'.$recipeinfo['title'].'</title>';
echo '<style>.pref{};</style>';

#AJAX function
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>';
echo '<script type="text/javascript">';
echo '$(document).ready(function(){';
echo '$(".pref").click(function(){';
echo 'var pref = $("input[name=\'preference\']:checked").val();';
echo '$.ajax({';
echo 'type: "POST", url: "preferences.php", data: {"pref":pref},';
echo 'success: function(result){';
echo 'var score="";';
echo 'if(result<0){score+="-";}';
echo 'else if(result>0){score+="+";}';
echo 'score+=result;';
echo '$(#"score").html(score);';
echo '}});});});';
echo '</script>';

$request_up=array();
$request_up['type']='getUserPref';
$request_up['user']=$_SESSION['user'];
$request_up['url']=$uri;
$dbclient->publish($request_up);
//$response_up=$dbclient->send_request($request_up);
$userpref=$response_up['message'];
echo "<body><h2>".$recipeinfo['title']."</h2>";
echo "<table><tr>";
echo "<td><input type='radio' name='preference' class='pref' value='like'";
if($userpref=='like'){
  echo " checked";
}
echo "><label>Like</label></td>";
echo "<td><input type='radio' name='preference' class='pref' value='dislike'";
if($userpref=='dislike'){
  echo " checked";
}
echo ">Dislike</td>";
$request_rsc=array();
$request_rsc['type']='recipeScore';
$request_rsc['url']=$uri;
$dbclient->send_request($request_rsc);
//$response_rsc=$dbclient->send_request($request_rsc);
$scores=$response_rsc['message'];
echo "<td><div id='score'>".$scores['total']."</div><td>";
echo "</tr></table>";
echo "<a href='".$recipeinfo['link']."' target='_blank'>Recipe link</a>";
echo "<p>Calories: ".intval($recipeinfo['calories'])."</p>";
echo "<p>Diet styles: ";
$diet='';
foreach($recipeinfo['dietLabels'] as $dlbl){
    $diet.=$dlbl;
    $diet.=', ';
}
$diet=substr($diet, 0, -2);
echo $diet."</p>";
echo "<p>Health needs: ";
$health='';
foreach($recipeinfo['healthLabels'] as $hlbl){
    $health.=$hlbl;
    $health.=', ';
}
$health=substr($health, 0, -2);
echo $health."</p>";

$request_p=array();
$request_p['type']='viewPantry';
$request_p['user']=$_SESSION['user'];
$dbclient->publish($request_p);
//$response_p=$dbclient->send_request($request_p);
$contents_p=$response['message'];
echo "<p>Ingredients:</p>";
echo "<ul>";
foreach($recipeinfo['ingredients'] as $ingred){
    echo "<li>".$ingred;
    foreach($contents_p as $pantryitem){
        if(strpos(strtolower($ingred), strtolower($pantryitem)) !== false){
	    echo " (you have this ingredient!)";
	    break;
	}
    }
    echo "</li>";
}
echo "</ul><br>";

$baseembed='https://www.youtube.com/embed/';
echo "<table>";
echo "<tr>";
$request_yt=array();
$request_yt['type']='youtube';
$request_yt['searchterm']=$recipeinfo['title'];
$apiclient->publish($request_yt);
//$response_yt=$apiclient->send_request($request_yt);
$recipevideo=$response_yt['message'];
#$recipevideo contains id and title
echo '<td><iframe width="560" height="315" src="'.$baseembed.$recipevideo['id'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>';
echo '<td>'.$recipevideo['title'].'</td>';
echo '</tr>';

echo '<tr>';
$request_yq=array();
$request_yq['type']='youtube';
$request_yq['searchterm']=$query.' cooking';
//$apiclient->publish($request_yq);
$response_yq=$apiclient->send_request($request_yq);
$queryvideo=$response_yq['message'];
#$queryvideo contains id and title
echo '<td><iframe width="560" height="315" src="'.$baseembed.$queryvideo['id'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>';
echo '<td>'.$queryvideo['title'].'</td>';
echo '</tr>';
echo '</table><br><br>';
echo '<a href="../phpBB3" target="_blank">Join the conversation!</a>';
echo '<br><a href="get_recipes.php?food='.$query.'">Back to recipes</a>';
echo '</body></html>';
?>
