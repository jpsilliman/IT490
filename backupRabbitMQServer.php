#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

include ('account.php');

function doLogin ($username, $password) {
    ( $db = mysqli_connect ( 'localhost', 'root', 'password', 'edamam' ) );
    
    if (mysqli_connect_errno())
    
    {
      echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }

    echo "Successfully connected to MySQL<br><br>";
    mysqli_select_db($db, 'edamam' );
    $s = "select * from users where username = '$username' and password = '$password'";
    //echo "The SQL statement is $s";
    ($t = mysqli_query ($db,$s)) or die(mysqli_error());
    $num = mysqli_num_rows($t);
    if ($num == 0){

        return false;
   
    }
    
    else
   
    {
      print "<br>Authorized";
      return true;
    }

}

function doRegister($username,$password,$email) {
    
	( $db = mysqli_connect ( 'localhost', 'root', 'password', 'readBuster' ) );
       
	if (mysqli_connect_errno())
    {
 	echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
	
	exit();
    }
    
	echo "Successfully connected to MySQL<br><br>";
 	mysqli_select_db($db, 'readBuster' );
	$s = "insert into users(email,username,password) values($username,$password,$email)";
       
      	//echo "The SQL statement is $s";
       
	($t = mysqli_query ($db,$s)) or die(mysqli_error());
    
	print "Registered";
    
	return true;

}
/*function doLogin($username, $password){
  return true;
}
*/




function apiRequest($request)
{
	$client = new rabbitMQClient("apiRabbitMQ.ini","apiServer");
	$apiRe = array();
	$apiRe['type'] = "apiReq";
	$apiRe['foodName'] = $request ['foodName'];

	$response = $cleint->send_request($apiRe);
	
return $response;

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
    case "login":
	return doLogin($request['username'],$request['password']);
    case "validate_session":
	return doValidate($request['sessionId']);
    case "getRecipe":
	return apiRequest($request);

  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

