<?php
//echo "a";
$host="localhost";
$username="Admin";
$password="password";
$db_name="Login";
$tbl_name="logins";
//echo "b0";
$conn= mysqli_connect("$host","$username","$password","$db_name") or die(mysqli_connect_error());
//echo "b1";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//mysqli_select_db("$tbl_name") or die("can nont connect to database");

//echo "b2";
//$myusername=$_POST["usr"];
//echo "b3";
//$mypassword=$_POST["pwd"];
//echo "c";
//$myusername= stripslashes($myusername);
//$mypassword= stripslashes($mypassword);
$FirstName=mysqli_real_escape_string($conn,$_POST['FirstName']);
//echo "b3";
//echo "$mybadge";
$LastName= mysqli_real_escape_string($conn,$_POST['LastName']);
//echo "b4";
$Email= mysqli_real_escape_string($conn,$_POST['Email']);
//echo "b5";
$User= mysqli_real_escape_string($conn,$_POST['User']);
//echo "b6";
$Pass= mysqli_real_escape_string($conn,$_POST['Pass']);
//echo "b7";
$dupe="SELECT Email FROM  logins Where Email='$Email'";
if($result=mysqli_query($conn,$dupe)){
echo "$result";
if($result=$Email)
{
exit("dupelicate Email found");

}
}
$sql= "INSERT INTO logins(firstName, LastName, Email, UserName, Password) VALUES ('$FirstName' ,'$LastName' ,'$Email' ,'$User', '$Pass')";
//echo "d2";

if (!mysqli_query($conn,$sql)) {
  die(mysqli_error($conn));
}
echo "1 record added";
//echo "d3";
//echo "e";
?>
