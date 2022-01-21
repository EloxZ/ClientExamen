<?php
    session_start();
    
    if (isset($_SESSION['server_msg'])) {
        echo $_SESSION['server_msg'];
        unset($_SESSION['server_msg']);
    }

    if (isset($_SESSION['login']) && isset($_SESSION['usuario'])) {
        $email = $_SESSION['usuario']->email;
    } else {
        header('Location: /login.php');
    }

    include 'includes/header.php';

    $articulosGet = file_get_contents("https://examenserver.herokuapp.com/articulos");
    $pujasGet = file_get_contents("https://examenserver.herokuapp.com/pujas");
    $articulos = json_decode($articulosGet);
    $pujas = json_decode($pujasGet);

    

?>

<section class="container">
    <h1>Articulos</h1>

    <table>
        <tr>
            <th>Descripcion</th>
            <th>Vendedor</th>
            <th>Última puja</th>
            <th>Foto</th>
        </tr>
            <?php 
                foreach ($articulos->data->articulos as $articulo){ ?>                
                    <tr>
                        <td><?php echo $articulo->descripcion; ?></td>
                        <td><?php echo $articulo->vendedor; ?></td>
                        <td><?php echo $articulo->precio; ?></td>
                        <td><?php echo $articulo->foto; ?></td>
                    </tr>
            <?php } ?>
    </table>
</section>