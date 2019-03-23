<?php
//echo "a";
$host="localhost";
$username="admi";
$password="Id24696mi.";
$db_name="Police";
$tbl_name="reports";
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
$mybadge=mysqli_real_escape_string($conn,$_POST['badge']);
//echo "b3";
//echo "$mybadge";
$caseID= mysqli_real_escape_string($conn,$_POST['case']);
//echo "b4";
$last= mysqli_real_escape_string($conn,$_POST['LN']);
//echo "b5";
$first= mysqli_real_escape_string($conn,$_POST['FN']);
//echo "b6";
$crimID= mysqli_real_escape_string($conn,$_POST['CID']);
$rtype= mysqli_real_escape_string($conn,$_POST['report']);
//echo "b7";
//$report=$_FILES['fileToUpload']['tem_name'];
  if(isset($_FILES['fileToUpload'])){
      $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size = $_FILES['fileToUpload']['size'];
      $file_tmp = $_FILES['fileToUpload']['tmp_name'];
      $file_type = $_FILES['fileToUpload']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
      if(move_uploaded_file($file_tmp,"reports" .'/'.$file_name)){
         //move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         //print_r($errors);
        echo "falure";
      }
   }
   $blob="/var/www/html/reports" .'/' .$file_name;

//echo "d";
//echo "d1";
$sql= "INSERT INTO Reports(badge, CaseID, Criminal_Last_Name, Criminal_First_Name, CriminalID, Type, reports) VALUES ('$mybadge' ,'$caseID' ,'$last' ,'$first', '$crimID','$rtype','$blob')";
//$sql="insert into reports (badge) values ('1124233')";
//echo "d2";

if (!mysqli_query($conn,$sql)) {
  die(mysqli_error($conn));
}
echo "1 record added";
//echo "d3";
//echo "e";
?>
