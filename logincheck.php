//all code written by Kyle Middleton
#!/isr/bin/php
<?php
echo "a";
$host="localhost";
$usernames="Admin";
$passwords="password";
$db_name="IT490DB";
$tbl_name="logins";
$conn= mysqli_connect("$host","$usernames","$passwords","$db_name") or die(mysqli_connect_error());
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function loginCheck($username,$password)
{
//echo "b2";
$myusername=$username;
//echo "b3";
$mypassword=$password;
echo "c";
//$myusername= stripslashes($myusername);
//$mypassword= stripslashes($mypassword);
$myusername= mysqli_real_escape_string($conn,$username);
echo "d";
$mypassword= mysqli_real_escape_string($conn,$password);
echo "d1 username:";
echo $myusername;
echo "Password:";
echo $mypassword;
//echo($_POST['pass'])
$sql="SELECT UserName,Password FROM logins  WHERE  UserName='$myusername' and Password='$mypassword'";
echo "d2";
$result= mysqli_query($conn,$sql);
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
$FirstName=mysqli_real_escape_string($conn,$firstName);
//echo "b3";
$LastName= mysqli_real_escape_string($conn,$lastName);
//echo "b4";
$Email= mysqli_real_escape_string($conn,$email);
//echo "b5";
$User= mysqli_real_escape_string($conn,$userName);
//echo "b6";
$Pass= mysqli_real_escape_string($conn,$password);
//echo "b7";
$dupe="SELECT Email FROM  logins Where Email='$Email'";
if($result=mysqli_query($conn,$dupe)){
echo "$result";
//$cout=mysqli_num_rows($result);
if($result==$Email)
{
exit("dupelicate Email found");

}
}
$sql= "INSERT INTO logins(firstName, LastName, Email, UserName, Password) VALUES ('$FirstName' ,'$LastName' ,'$Email' ,'$User', '$Pass')";
$sql2="INSERT INTO Preferences(UserName) VALUES('$User')";
$sql3="INSERT INTO Lists(UserName) Values('$User')";
echo "d2";

if (!mysqli_query($conn,$sql)) {
  die(mysqli_error($conn));
}
if (!mysqli_query($conn,$sql2)) {
  die(mysqli_error($conn));
}
if (!mysqli_query($conn,$sql3)) {
  die(mysqli_error($conn));
}


return "User Created!";
//echo "d3";
//echo "e";
}
function getPreference($userName)
{
$User= mysqli_real_escape_string($conn,$userName);
$sql= "SELECT * FROM `Preferences` WHERE Username='$User'";
$result= mysqli_query($conn,$sql);
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

$Balanced=$array['$Balanced'];
$High_Fiber=$array['High-Fiber'];
$High_Protein=$array['High-Protein'];
$Low_Carb=$array['Low-Carb'];
$Low_Fat=$array['Low-Fat'];
$Low_Sodium=$array['Low-Sodium'];
$Alcohol_free=$array['Alcohol-free'];
$Celery_free=$array['Celery-free'];
$Cristacean_free=$array['Crustacean-free'];
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
$Sugar_concious=$array['Sugar-conscious'];
$Tree=$array['Tree Nuts'];
$Vegan=$array['Vegan'];
$Vegetarian=$array['Vegetarian'];
$Wheat_free=$array['Wheat-free'];

$sql="UPDATE 'Preferences' SET 
'Balanced'='$Balanced',
'High-Fiber'='$High_Fiber',
'High-Protein'='$High_Protein',
'Low-Carb'='$Low_Carb',
'Low-Fat'='$Low_Fat',
'Low-Sodium'='$Low-Sodium',
'Alcohol-free'='$Alcohol-free',
'Celery-free'='$Celery_free',
'Cristacean-free'='$Crustacean_free',
'Dairy'='$Dairy',
'Eggs'='$Eggs',
'Fish'='$Fish',
'Gluten'='$Gluten',
'Kidney-friendly'='$Kidney_friendly',
'Kosher'='$Kosher',
'Low-potassium'='$Low_potassium',
'Lupine-free'='$Lupine_free',
'Mustard-free'='$Mustard_free',
'No-oil-added'='$No_oil_added',
'No-sugar'='$No_sugar',
'Paleo'='$Paleo',
'Peanuts'='$Peanuts',
'Pescatarian'='$Pescatarian',
'Pork-free'='$Pork_free',
'Red-meat-free'='$Red_meat_free',
'Sesame-free'='$Sesame_free',
'Shellfish'='$Shellfish',
'Soy'='$Soy',
'Sugar-concious'='$Sugar_conscious',
'Tree Nuts'='$Tree',
'Vegan'='$Vegan',
'Vegetarian'='$Vegetarian',
'Wheat-free'='$Wheat_free'"
;

if (!mysqli_query($conn,$sql)) {
  die(mysqli_error($conn));
}
return "preferences added";
}
function getList($User)
{
$sql="SELECT List FROM 'Lists' WHERE 'UserName'='$User'";
$result=mysqli_query($conn,$sql);
$ret=mysqli_fetch_assoc($result);
return $ret;
}
function setList($User,$List)
{
$sql="UPDATE 'Lists' SET 'List'='$List' WHERE 'UserName'='$User'";
if (!mysqli_query($conn,$sql)) {
  die(mysqli_error($conn));
}
return "list added";
}
function getLikes($URL)
{
$sql="SELECT 'Likes' FROM 'Likes' WHERE 'URL'='$URL'";
$result=mysqli_query($conn,$sql);
$j=mysqli_fetch_assoc($result);
return $j;
}
function setLikes($URL,$Json)
{
$sql="SELECT 'URL' FROM 'Likes' WHERE 'URL'='$URL'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);
if($count=="0")
{
$Sql="INSERT INTO 'LIKES' VALUES( '$URL','$Json'";
if (!mysqli_query($conn,$sql)) 
{
  die(mysqli_error($conn));
}
return "done";
}
else
{
$sql="UPDATE 'LIKES' SET 'Likes'='$Json' WHERE 'URL'='$URL'"; 
if (!mysqli_query($conn,$sql))
 {
  die(mysqli_error($conn));
}
return "completed";
}
}


