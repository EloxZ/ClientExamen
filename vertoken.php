<?php 
session_start();

if (isset($_SESSION['token'])) {
    
    $tokenJson = json_decode($_SESSION['token']);
    //var_dump($tokenJson);
    $msg = 'Authorization: Bearer '.$tokenJson->accessToken;
    echo $msg;

    $ch = curl_init('https://examenserver.herokuapp.com/oauth/auth');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, $msg);
    $data = curl_exec($ch);
    echo $data;
    curl_close ($ch);
}

?>