<?php 
session_start();

if (isset($_SESSION['token'])) {
    var_dump($_SESSION['token']);
    $tokenArray = (array) $_SESSION['token'];

    $ch = curl_init('https://examenserver.herokuapp.com/oauth/auth');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 'Authorization: Bearer '.$tokenArray['accessToken']);
    $data = curl_exec($ch);
    echo $data;
    curl_close ($ch);
}

?>