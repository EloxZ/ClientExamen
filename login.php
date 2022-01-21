<?php
session_start();
if (!isset($_SESSION['login'])) {
    
} else {
    header('Location: /index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Vendaval - Login</title>
</head>

<body>
    <div class="login-box">
        <div class="login-card">
            <p class="login-text">Inicio de sesión</p>
                <div class="login-botones">
                    <button onclick="window.location.href='./servicios/google/login.php'" class="button red-button">Google</a>
                </div>
        </div>
    </div>
</body>