<?php
echo "a";
$host="localhost";
$username="admi";
$password="Id24696mi.";
$db_name="police";
//if($_POST["report"]="police")
//{
//$tbl_name="reports"
//}
//else if($_POST["report"]="evidence")
//{
//$tbl_name="evidence"
//}
$tbl_name="reports";
echo "b0";
$conn= mysqli_connect("$host","$username","$password","$db_name") or die(mysqli_connect_error());
echo "b1";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//mysqli_select_db("$tbl_name") or die("can nont connect to database");

echo "b2";
//$myusername=$_POST["usr"];
//echo "b3";
//$mypassword=$_POST["pwd"];
//echo "c";
//$myusername= stripslashes($myusername);
//$mypassword= stripslashes($mypassword);
$mybadge=mysqli_real_escape_string($conn,$_POST['badge']);
echo "b3";
$caseID= mysqli_real_escape_string($conn,$_POST['case']);
echo "b4";
$last= mysqli_real_escape_string($conn,$_POST['LN']);
echo "b5"
$first= mysqli_real_escape_string($conn,$_POST['FN']);
echo "b6"
$crimID= mysqli_real_escape_string($conn,$_POST['CID']);
echo "b7"
//$report= $_POST['myfile']
echo "d";
echo "d1";
$sql="INSERT INTO '$tbl_name'( badge,CaseID,Criminal_Last_Name,Criminal_First_Name,CriminalID,reports) VALUES ('$mybadge','$caseID','$last,'$first','crimID')";
echo "d2";
$result= mysqli_query($conn,$sql);
echo "d3";

echo "e";
echo($count);
//echo "rules suck i dont like to work";
?>
