<?php

require_once '../../vendor/autoload.php';

session_start();

$clienteID = '574746681145-t8st72oje98d84ga085idtn0g94orkk8.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUrl = 'http://examenclient.herokuapp.com/servicios/google/login.php';

// Nuevo cliente request a Google
$client = new Google_Client();
$client->setClientId($clienteID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope('profile');
$client->addScope('email');

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth->userinfo->get();

    $original = array(
        "nombre" => $google_info->givenName,
        "apellido" => $google_info->familyName,
        "email" => $google_info->email
    );

    $usuario = new stdClass();

    foreach ($original as $key => $value){
        $usuario->$key = $value;
    }

    // Almaceno en la sesión el login
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $usuario;

    // Redirijo a index
    header('Location: /index.php');

}else{
    header('Location: ' . $client->createAuthUrl());
}