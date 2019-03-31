<?php
include('functions.php');

session_set_cookie_params(0, '/seq/','192.168.3.41');
session_start();

gatekeeper();

$_SESSION=array();
session_destroy();
setcookie('PHPSESSID','',time()-3600, '/','',0,0);

echo 'Logout successful. Thank you!<br><br><br>';
redirect('Returning to login form.','login.html',3);
?>
