<?php

$results = shell_exec('GET https://developer.edamam.com/');
$arrayCode = json_decode($results);
var_dump($arrayCode);
?>
