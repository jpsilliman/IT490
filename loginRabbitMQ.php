<?php
/**
 * Created by PhpStorm.
 * User: johnp
 * Date: 3/24/2019
 * Time: 3:59 PM
 */

require_once ('path.inc');
require_once ('get_host_info.inc');
require_once ('rabbitMQLib.inc');

function login($username, $password)
{
    $loginRequest = array();
    $loginRequest['type'] = 'login';
    $loginRequest['username'] = $username;
    $loginRequest['password'] = $password;

    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
    $response = $client->send_request($loginRequest);

    return $response;
}

function register($username, $email, $fname, $lname, $password)
{
    $registerRequest = array();
    $registerRequest['type'] = 'register';
    $registerRequest['username'] = $username;
    $registerRequest['email'] = $email;
    $registerRequest['firstName'] = $fname;
    $registerRequest['lastName'] = $lname;
    $registerRequest['password'] = $password;

    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
    $response = $client->send_request($registerRequest);

    return $response;
}

?>