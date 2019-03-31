<?php
include('functions.php');
session_set_cookie_params(0, '/seq/','192.168.3.41');
session_start();
gatekeeper();
?>
<head>
<title>
Home
</title>
<style>
td{
  padding-left:12px;
  padding-right:12px;
}
.button{
  border-bottom:1px  solid #777777;
  border-left:1px solid #000000;
  border-right:1px solid #333333;
  border-top:1px solid #000000;
  color: #000000;
  display: block;
  height: 2.5em;
  padding: 1 1em;
  padding-top: 1em;
  width: 4em;
  text-decoration: none;
  background-color:lightgray;
}
</style>
</head>
<body>
<h2>Home Page</h2>
<br>
<h4>Welcome! Which would you like to view?</h4><br><br>
<table>
<tr>
<td><a href='recipes.php' class='button'>Recipes</a></td>
<td><a href='pantry.php' class='button'>Pantry</a></td>
</tr>
</table>
<br><br><br><br><br>
<a href='logout.php'>Logout</a>
</body>
