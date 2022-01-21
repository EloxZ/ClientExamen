<?php 
session_start();

if (isset($_SESSION['token'])) {
    
    $tokenJson = json_decode($_SESSION['token']);
    //var_dump($tokenJson);
    echo $tokenJson->accessToken;

    $ch = curl_init('https://examenserver.herokuapp.com/oauth/auth');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 'Authorization: Bearer '.$tokenJson->accessToken);
    $data = curl_exec($ch);
    echo $data;
    curl_close ($ch);
}

?>