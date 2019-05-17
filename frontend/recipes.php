<?php
include('functions.php');
session_set_cookie_params(0,'/bud/','192.168.3.22');
session_start();
gatekeeper();
?>
<head>
<title>
Recipes
</title>
<style>
#queryitems{
 display:block;
 background-color:#e5e5e5;
 padding:4px;
 width:22em;
 height:10em;
 border-radius: 10px;
}
td:{padding:3px;}
</style>
</head>
<body>
<h2>Recipes</h2>
<form action='get_recipes.php' method='get'>
<div id='queryitems'>
<p>What would you like recipes for?</p><br>
<input type='text' name='food'><br>
<p font-size=small>The recipes you get will be based on the dietary profile you built.</p>
</div>
<br><br>
<input type='submit' value='Continue'>
</form>
<br>
<a href='home.php'>Return to home page</a>

