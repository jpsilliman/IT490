#!/usr/bin/php
<?php
//all code written by Kyle Middleton
#require_once $_SERVER['DOCUMENT_ROOT'].'/rabbitFiles/head.php';
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function loggingFunction($timestamp,$message)
{
    $timestamp= date('Y-m-d H:i:s');
    file_put_contents('localLog.log', "[".$timestamp."]".$message.PHP_EOL,FILE_APPEND);
    $client = new rabbitMQClient("testRabbitMQ.ini","logServer");
    $request = array();
    $request['type']= "error";
    $request['message']= $message;
    $request['date']= $timestamp;
    $client->send_request($request);
}

function set()
{
echo "a";
$host="192.168.3.33";
$usernames="tester";
$passwords="pass";
$db_name="IT490DB";
$tbl_name="logins";
global $conn;
$conn= mysqli_connect("$host","$usernames","$passwords","$db_name") or die(mysqli_connect_error());
if ($conn->connect_error) {
            //$timestamp= time();
        //echo "Connection Error: ".PHP_EOL;
        //$message= 'Login Connection Error, '.$conn->connect_errno.': ' . $conn->connect_error;
        //loggingFunction($timestamp, $message);
	set2();
       // die('Connection Error: , '.$conn->connect_errno.': ' . $conn->connect_error);

}
return $conn;
}
function set2()
{
echo "a";
$host="192.168.3.32";
$usernames="tester";
$passwords="pass";
$db_name="IT490DB";
$tbl_name="logins";
//global $conn;
$conn= mysqli_connect("$host","$usernames","$passwords","$db_name") or die(mysqli_connect_error);
if ($conn->connect_error) {
            $timestamp= time();
        echo "Connection Error: ".PHP_EOL;
        $message= 'Login Connection Error, '.$conn->connect_errno.': ' . $conn->connect_error;
        loggingFunction($timestamp, $message);
        die('Connection Error: , '.$conn->connect_errno.': ' . $conn->connect_error);
return "failed";
}
return $conn;
}



function loginCheck($username,$password)
{
$conns=set();
//echo "b2";
$myusername=$username;
//echo "b3";
$mypassword=$password;
echo "c";
//$myusername= stripslashes($myusername);
//$mypassword= stripslashes($mypassword);
$myusername= mysqli_real_escape_string($conns,$username);
echo "d";
$mypassword= mysqli_real_escape_string($conns,$password);
echo "d1 username:";
echo $myusername;
echo "Password:";
echo $mypassword;
//echo($_POST['pass'])
$sql="SELECT UserName,Password FROM logins  WHERE  UserName='$myusername' and Password='$mypassword'";
echo "d2";
$result= mysqli_query($conns,$sql);
echo "d3";
$count= mysqli_num_rows($result);
echo "e";
echo $count;
//echo "rules suck i dont like to work";
if($count==1){
                return "Login successful";
        }
        else{
                return "Login failed";
        }
}

function createUser($firstName,$lastName,$email,$userName,$password)
{
$conns=set();
$FirstName=mysqli_real_escape_string($conns,$firstName);
//echo "b3";
$LastName= mysqli_real_escape_string($conns,$lastName);
//echo "b4";
$Email= mysqli_real_escape_string($conns,$email);
//echo "b5";
$User= mysqli_real_escape_string($conns,$userName);
//echo "b6";
$Pass= mysqli_real_escape_string($conns,$password);
//echo "b7";
$dupe="SELECT Email FROM  logins Where Email='$Email'";
if($result=mysqli_query($conns,$dupe)){
$r=mysqli_fetch_array($result);
$result = $r['Email'];
echo "$result";
if($result==$Email)
{
return "Duplicate";
}
}
$sql= "INSERT INTO logins(firstName, LastName, Email, UserName, Password) VALUES ('$FirstName' ,'$LastName' ,'$Email' ,'$User', '$Pass')";
$sql2="INSERT INTO Preferences(UserName) VALUES('$User')";
$sql3="INSERT INTO Lists(UserName) Values('$User')";
echo "d2";

if (!mysqli_query($conns,$sql)) {
  
}
if (!mysqli_query($conns,$sql2)) {
  return (mysqli_error($conns));
}
if (!mysqli_query($conns,$sql3)) {
  return (mysqli_error($conns));
}


return "User Created!";
//echo "d3";
//echo "e";
}

function getPreference($userName)
{
$conns=set();
$User= mysqli_real_escape_string($conns,$userName);
$sql= "SELECT * FROM `Preferences` WHERE Username='$User'";
$result= mysqli_query($conns,$sql);
$count=mysqli_num_rows($result);
if($count=="0")
{
return("user not found");
}
while($row=mysqli_fetch_assoc($result))
{
echo $row['Balanced'];
if($row["Balanced"]=="1")
{
//echo $row["Balanced"];
$array[]="balanced";
}
if($row["High-Fiber"]=="1")
{
$array[]="high-fiber";
}
if($row["High-Protein"]=="1")
{
echo $row["High-Protein"];
$array[]="high-protein";
}
if($row["Low-Carb"]=="1")
{
$array[]="low-carb";
}
if($row["Low-Fat"]=="1")
{
$array[]="low-fat";
}
if($row["Low-Sodium"]=="1")
{
$array[]="low-sodium";
}
if($row["Alcohol-free"]=="1")
{
$array[]="alcohol-free";
}
if($row["Celery-free"]=="1")
{
$array[]="celery-free";
}
if($row["Crustacean-free"]=="1")
{
$array[]="crustacean-free";
}
if($row["Dairy"]=="1")
{
$array[]="dairy-free";
}
if($row["Eggs"]=="1")
{
$array[]="egg-free";
}
if($row["Fish"]=="1")
{
$array[]="fish-free";
}
if($row["Gluten"]=="1")
{
$array[]="gluten-free";
}
if($row["Kidney-friendly"]=="1")
{
$array[]="kidney-friendly";
}
if($row["Kosher"]=="1")
{
$array[]="kosher";
}
if($row["Low-potassium"]=="1")
{
$array[]="low-potassium";
}
if($row["Lupine-free"]=="1")
{
$array[]="lupine-free";
}
if($row["Mustard-free"]=="1")
{
$array[]="mustard-free";
}
if($row["No-oil-added"]=="1")
{
$array[]="No-oil-added";
}
if($row["No-sugar"]=="1")
{
$array[]="low-sugar";
}
if($row["Paleo"]=="1")
{
$array[]="paleo";
}
if($row["Peanuts"]=="1")
{
$array[]="peanut-free";
}
if($row["Pescatarian"]=="1")
{
$array[]="pescatarian";
}
if($row["Pork-free"]=="1")
{
$array[]="pork-free";
}
if($row["Red-meat-free"]=="1")
{
$array[]="red-meat-free";
}
if($row["Sesame-free"]=="1")
{
$array[]="sesame-free";
}
if($row["Shellfish"]=="1")
{
$array[]="shellfish-free";
}
if($row["Soy"]=="1")
{
$array[]="soy-free";
}
if($row["Sugar-conscious"]=="1")
{
$array[]="sugar-conscious";
}
if($row["Tree Nuts"]=="1")
{
$array[]="tree-nut-free";
}
if($row["Vegan"]=="1")
{
$array[]="vegan";
}
if($row["Vegetarian"]=="1")
{
$array[]="vegetarian";
}
if($row["Wheat-free"]=="1")
{
$array[]="wheat-free";
}
}
return $array;
}

function setPreferences($array)
{
$conns=set();
$user=$array['user'];
$Balanced=$array['Balanced'];
$High_Fiber=$array['High-Fiber'];
$High_Protein=$array['High-Protein'];
$Low_Carb=$array['Low-Carb'];
$Low_Fat=$array['Low-Fat'];
$Low_Sodium=$array['Low-Sodium'];
$Alcohol_free=$array['Alcohol-free'];
$Celery_free=$array['Celery-free'];
$Crustacean_free=$array['Crustacean-free'];
$Dairy=$array['Dairy'];
$Eggs=$array['Eggs'];
$Fish=$array['Fish'];
$Gluten=$array['Gluten'];
$Kidney_friendly=$array['Kidney-friendly'];
$Kosher=$array['Kosher'];
$Low_potassium=$array['Low-potassium'];
$Lupine_free=$array['Lupine-free'];
$Mustard_free=$array['Mustard-free'];
$No_oil_added=$array['No-oil-added'];
$No_sugar=$array['No-sugar'];
$Paleo=$array['Paleo'];
$Peanuts=$array['Peanuts'];
$Pescatarian=$array['Pescatarian'];
$Pork_free=$array['Pork-free'];
$Red_meat_free=$array['Red-meat-free'];
$Sesame_free=$array['Sesame-free'];
$Shellfish=$array['Shellfish'];
$Soy=$array['Soy'];
$Sugar_conscious=$array['Sugar-conscious'];
$Tree=$array['Tree Nuts'];
$Vegan=$array['Vegan'];
$Vegetarian=$array['Vegetarian'];
$Wheat_free=$array['Wheat-free'];
$Vegan=$array['Vegan'];
$Vegetarian=$array['Vegetarian'];
$Wheat_free=$array['Wheat-free'];
echo "a";
//$sql="UPDATE 'Preferences' SET
//'Balanced'='$Balanced',
//'High-Fiber'='$High_Fiber',
//'High-Protein'='$High_Protein',
//'Low-Carb'='$Low_Carb',
//'Low-Fat'='$Low_Fat',
//'Low-Sodium'='$Low_Sodium',
//'Alcohol-free'='$Alcohol_free',
//'Celery-free'='$Celery_free',
//'Crustacean-free'='$Crustacean_free',
//'Dairy'='$Dairy',
//'Eggs'='$Eggs',
//'Fish'='$Fish',
//'Gluten'='$Gluten',
//'Kidney-friendly'='$Kidney_friendly',
//'Kosher'='$Kosher',
//'Low-potassium'='$Low_potassium',
//'Lupine-free'='$Lupine_free',
//'Mustard-free'='$Mustard_free',
//'No-oil-added'='$No_oil_added',
//'No-sugar'='$No_sugar',
//'Paleo'='$Paleo',
//'Peanuts'='$Peanuts',
//'Pescatarian'='$Pescatarian',
//'Pork-free'='$Pork_free',
//'Red-meat-free'='$Red_meat_free',
//'Sesame-free'='$Sesame_free',
//'Shellfish'='$Shellfish',
//'Soy'='$Soy',
//'Sugar-conscious'='$Sugar_conscious',
//'Tree Nuts'='$Tree',
//'Vegan'='$Vegan',
//'Vegetarian'='$Vegetarian',
//'Wheat-free'='$Wheat_free'
//WHERE 'UserName'='$user'";
$sql="UPDATE
    `Preferences`
SET
    `Balanced` = '$Balanced',
    `High-Fiber` = '$High_Fiber',
    `High-Protein` = '$High_Protein',
    `Low-Carb` = '$Low_Carb',
    `Low-Fat` = '$Low_Fat',
    `Low-Sodium` = '$Low_Sodium',
    `Alcohol-free` = '$Alcohol_free',
    `Celery-free` = '$Celery_free',
    `Crustacean-free` = '$Crustacean_free',
    `Dairy` = '$Dairy',
    `Eggs` = '$Eggs',
    `Fish` = '$Fish',
    `Gluten` ='$Gluten',
    `Kidney-friendly` = '$Kidney_friendly',
    `Kosher` = '$Kosher',
    `Low-potassium` = '$Low_potassium',
    `Lupine-free` = '$Lupine_free',
    `Mustard-free` = '$Mustard_free',
    `No-oil-added` = '$No_oil_added',
    `No-sugar` = '$No_sugar',
    `Paleo` = '$Paleo',
    `Peanuts` = '$Peanuts',
    `Pescatarian` = '$Pescatarian',
    `Pork-free` = '$Pork_free',
    `Red-meat-free` = '$Red_meat_free',
    `Sesame-free` = '$Sesame_free',
    `Shellfish` = '$Shellfish',
    `Soy` = '$Soy',
    `Sugar-conscious` = '$Sugar_conscious',
    `Tree Nuts` = '$Tree',
    `Vegan` = '$Vegan',
    `Vegetarian` = '$Vegetarian',
    `Wheat-free` = '$Wheat_free'
WHERE UserName='$user'";
echo "B";
if (!mysqli_query($conns,$sql)) {
 echo "i fail";
 echo mysqli_error($conns);
 return(mysqli_error($conns));
}
echo "i passed";
return "preferences added";
}
function getList($User)
{
$conns=set();
$sql="SELECT List FROM 'Lists' WHERE 'UserName'='$User'";
$result=mysqli_query($conns,$sql);
$ret=mysqli_fetch_assoc($result);
return $ret;
}

function setList($User,$List)
{
$conns=set();
$sql="UPDATE 'Lists' SET 'List'='$List' WHERE 'UserName'='$User'";
if (!mysqli_query($conns,$sql)) {
  return(mysqli_error($conns));
}
return "list added";
}
/*
function getLikes($URL)
{
$conns=set();
$sql="SELECT 'Likes' FROM 'Likes' WHERE 'URL'='$URL'";
$result=mysqli_query($conns,$sql);
$j=mysqli_fetch_assoc($result);
return $j;
}


function setLikes($URL,$Json)
{
$conns=set();
$sql="INSERT 'URL','Likes' INTO 'Likes' VALUES('URL'='$URL','Likes'='$Json'";
$result=mysqli_query($conns,$sql);
$count=mysqli_num_rows($result);
if($count=="0")
{
$Sql="INSERT INTO 'LIKES' VALUES( '$URL','$Json'";
if (!mysqli_query($conns,$sql)) 
{
  return (mysqli_error($conns));
}
return "done";
}
else
{
$sql="UPDATE 'LIKES' SET 'Likes'='$Json' WHERE 'URL'='$URL'"; 
if (!mysqli_query($conns,$sql))
 {
  return(mysqli_error($conns));
}
return "completed";
}
}
*/

function getPantry($User)
{
$conns=set();
$sql="SELECT Item,Amount,Unit FROM Pantry WHERE UserName='$User'";
$result=mysqli_query($conns,$sql);
$results=mysqli_fetch_all($result);
return $results;
}

function setPantry($array)
{
$conns=set();
$UserName=$array['user'];
$Item=$array['food'];
$Amount=$array['number'];
$Unit=$array['unit'];

$sql="INSERT INTO Pantry(UserName,Item,Amount,Unit) VALUES('$UserName','$Item','$Amount','$Unit')";
if (!mysqli_query($conns,$sql))
 {
  echo "I failed";
  echo mysqli_error($conns);
  return(mysqli_error($conns));
}
echo "entry added ";
return "pantry added";
}

function setLikes($usr,$url,$pref)
{
$conns=set();
if($pref=="like")
{
$sql="INSERT INTO Likes(URI,UserName,Likes,Dislike) VALUES('$url','$usr',1,0)";
}
else
{
$sql="INSERT INTO Likes(URI,UserName,Likes,Dislike) VALUES('$url','$usr',0,1)";
}
if (!mysqli_query($conns,$sql))
{
  echo "I failed";
  echo mysqli_error($conns);
  return(mysqli_error($conns));
}
else
{
echo "decision added";
return "decision added";
}
}

function getLikes($url)
{
$conns=set();
$sql1="SELECT * FROM Likes WHERE Likes=1 && URI='$url'";
$sql2="SELECT * FROM Likes WHERE Dislike=1 && URI='$url'"; 
$likes=mysqli_num_rows(mysqli_query($conns,$sql1));
$dislikes=mysqli_num_rows(mysqli_query($conns,$sql2));
$total=$likes-$dislikes;
$numbers=array();
$numbers['likes']=$likes;
$numbers['dislikes']=$dislikes;
$numbers['total']=$total;
return $numbers;
}

function getUserPref($usr, $url)
{
$conns=set();
echo "A";
$sql="select * from Likes where UserName='$usr' && URI='$url'";
$sql2="SELECT Likes FROM  Likes WHERE UserName='$usr' && URI='$url'";
$sql3="SELECT DIslike FROM Likes Where UserName='$url' && URI ='$url'";
echo "B";
$r=mysqli_query($conns, $sql);
$s=mysqli_query($conns,$sql2);
$t=mysqli_query($conns,$sql3);
echo "C";
if(mysqli_num_rows($r)==0){
  return 'no rating';
}
else{
  if(mysqli_num_rows($s)==1){
  echo "like"; 
 return 'like';
  }
  else if(mysqli_num_rows($t)==1){
        echo "dislike";
	return 'dislike';
  }
  else{
	echo "and you failed";
    return "Look, I don't know how you got here, but we have a problem.";
  }
}
}

?>
