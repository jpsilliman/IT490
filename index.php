<?php
/**
 * Created by PhpStorm.
 * User: johnp
 * Date: 3/23/2019
 * Time: 3:48 PM
 */
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    if (isset($_POST['login']))
    {
        require 'scripts'
    }
}