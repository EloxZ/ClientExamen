<?php

if (!isset($_SESSION['token'])) {
    try {
        $post = [
            'grant_type'   => 'password',
            'username' => 'pedroetb',
            'password' => 'password'
        ];
        
        $headers = [
            'Authorization: Basic YXBwbGljYXRpb246c2VjcmV0',
            'Content-Type: application/x-www-form-urlencoded'
        ];

        $ch = curl_init('https://www.examenserver.herokuapp.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $token = curl_exec($ch);

        $_SESSION['token'] = $token;
        var_dump($token);
        curl_close ($ch);

    } catch (Exception $e) {

        // Failed to get the access token
        echo $e->getMessage();
    }
}

?>