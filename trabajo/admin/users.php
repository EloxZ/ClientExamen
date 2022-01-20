<?php
$dataUsers = file_get_contents("https://blablacariw.herokuapp.com/");
$users = json_decode($dataUsers)->data->usuarios;

include './includes/header.php';
?>

<section class="container">
    <h1>Usuarios</h1>

    <table>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellido</th>
        </tr>
            <?php 
                foreach ($users as $usuario){ ?>
                
                    <tr>
                        <td><?php if (!isset($usuario->foto))
                                    echo "<img src='https://acortar.link/mZkcJS' style='width:30px;height:30px;'?></td>";
                                    else
                                    echo "<img src='".$usuario->foto."' style='width:30px;height:30px;'?></td>";?>
                        <td><?php echo $usuario->nombre; ?></td>
                        <td><?php echo $usuario->apellido; ?></td>
                        <form action="../../usuario/delete.php" method="POST">
                            <input type="hidden" value="<?php echo $usuario->_id?>" name="id">
                            <th><input type="submit" value="Eliminar"></th>
                        </form>
                        <form action="usuario/edit.php" method="GET">
                            <input type="hidden" value="<?php echo $usuario->_id?>" name="id">
                            <th><input type="submit" value="Editar"></th>
                        </form>
                        <form action="crear_viaje.php" method="GET">
                            <input type="hidden" value="<?php echo $usuario->_id?>" name="id">
                            <th><input type="submit" value="Añadir viaje"></th>
                        </form>
                    </tr>
                
            <?php } ?>
    </table>
</section>
