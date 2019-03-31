<?php
include('functions.php');
session_set_cookie_params(0,'/seq/','192.168.3.41');
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
<script> function appear(){
  ptr1 = document.getElementById('choice')
  ptr2 = document.getElementById('queryitems')
  if(ptr1.value=="rate")
    ptr2.style.display = 'none'
  else if(ptr1.value=="get")
    ptr2.style.display = 'block'
}
</script>
</head>
<body>
<h2>Recipes</h2>
<br>
<p>Select what you would like to do:</p>
<form action='do_recipes.php' method='post'>
<select name='choice' onchange='appear()' id='choice'>
<option value='get'>Get recipes</option>
<option value='rate'>Rate recipes</option>
</select>
<br><br>
<div id='queryitems'>
<p>What would you like recipes for?</p><br>
<input type='text' name='food'><br>
<p font-size=small>The recipes you get will be based on your dietary profile.</p>
</div>
<br><br>
<input type='submit' value='Continue'>
</form>
<br>
<a href='home.php'>Return to home page</a>

