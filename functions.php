<?php
function gatekeeper(){
  if(!isset($_SESSION['logged'])){
    redirect('Please login. Redirecting to login form.','login.html',3);
  }
}

function redirect($message, $url, $delay){
  echo "$message";
  header("refresh:$delay; url=$url");
  exit();
}
?>
