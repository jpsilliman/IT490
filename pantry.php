<?php
include('functions.php');
session_set_cookie_params(0,'/seq/','192.168.3.41');
session_start();
gatekeeper();
?>
<head>
<title>
Pantry
</title>
<style>
#fooditems{display:none;
 background-color:#e5e5e5;
 padding:4px;
 width:24em;
 height:7em;
 border-radius: 10px;
}
td:{padding:3px;}
</style>
<script> function appear(){
  ptr1 = document.getElementById('choice')
  ptr2 = document.getElementById('fooditems')
  if(ptr1.value=="view")
    ptr2.style.display = 'none'
  else if(ptr1.value=="add")
    ptr2.style.display = 'block'
}
</script>
</head>
<body>
<h2>Pantry</h2>
<br>
<p>Select what you would like to do:</p>
<form action='do_pantry.php' method='post'>
<select name='choice' onchange='appear()' id='choice'>
<option value='view'>View pantry</option>
<option value='add'>Add item</option>
</select>
<br><br>
<div id='fooditems'>
<table>
<tr>
<td>Food Item:</td>
<td><input type='text' name='food'></td>
</tr>
<tr>
<td>Number:</td>
<td><input type='number' name='number'></td>
</tr>
<tr>
<td>Unit (ex: oz, lb):</td>
<td><input type='text' name='unit'></td>
</tr>
</table>
</div>
<br><br>
<input type='submit' value='Continue'>
</form>
<br>
<a href='home.php'>Return to home page</a>
