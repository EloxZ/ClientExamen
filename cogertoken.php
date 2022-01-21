<?php
session_start();

if (!isset($_SESSION['token'])) {
    try {
        $post = 'grant_type=password&username=pedroetb&password=password';
        
        $headers = array (
            'Authorization: Basic YXBwbGljYXRpb246c2VjcmV0',
            'Content-Type: application/x-www-form-urlencoded'
        );

        $ch = curl_init('https://examenserver.herokuapp.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $token = curl_exec($ch);

        $_SESSION['token'] = json_encode($token);
        var_dump($token);
        echo curl_error($ch);
        curl_close ($ch);

    } catch (Exception $e) {

        // Failed to get the access token
        echo 'Es un error '.$e->getMessage();
    }
}

?>