<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Vendaval</title>
</head>

<body>
    <nav>
        <div class="container">
            <div class="contenido-header">
                <img src="./resources/logo.svg" alt="Imagen logo">
                <div class="d-flex justify-content-center py-3">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="../articulo/crear_articulo.php" class="nav-link">Publicar articulo</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['login'])) {
                            header('Location: ../login.php');
                        } else {
                        ?>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link">Cerrar sesión</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </div>