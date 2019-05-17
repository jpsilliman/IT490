<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('functions.php');

session_set_cookie_params(0,'/bud/','192.168.3.22');
session_start();
gatekeeper();
?>
<style>
#fooditems{
 background-color:#87cefa;
 padding:4px;
 width:24em;
 height:12em;
 border-radius:10px;
}
#stock{
 display:inline-block;
 background-color:#e5e5e5;
}
td.pantry{padding-left:5px;padding-right:5px;}
td.input{padding:3px;}
</style>

<?php
$client=new rabbitMQClient('testRabbitMQ.ini','testServer');

$pantry['type']='viewPantry';
$pantry['user']=$_SESSION['user'];
$response=$client->send_request($pantry);
$contents=$response['message'];
echo "<b>See your pantry contents below</b><br><br>";
echo "<div id='stock'><table>";
echo "<tr>";
echo "<td class='pantry'><b>Food</b></td>";
echo "<td class='pantry'><b>Amount</b></td>";
echo "</tr>";
for($i=0; $i<count($contents); $i++){
  echo "<tr>";
  echo "<td class='pantry'>".$contents[$i][0]."</td>";
  echo "<td class='pantry'>".$contents[$i][1]." ".$contents[$i][2]."</td>";
  echo "</tr>";
}
echo "</table></div>";
echo "<br><br><br>";

echo "<div id='fooditems'><b>Add to pantry</b>";
echo "<form method='post' action='update_pantry.php'>";
echo "<table>";
echo "<tr>";
echo "<td class='input'>Food Item:</td>";
echo "<td class='input'><input type='text' name='food'></td>";
echo "</tr><tr>";
echo "<td class='input'>Number:</td>";
echo "<td class='input'><input type='number' name='number'></td>";
echo "</tr><tr>";
echo "<td class='input'>Unit (ex: oz, lbs):</td>";
echo "<td class='input'><input type='text' name='unit'></td>";
echo "</tr></table><br>";
echo "<input type='submit' value='Add to pantry'>";
echo "</form></div>";

echo "<br><br><a href='home.php'>Return to home page</a>";
$client->close();
?>
