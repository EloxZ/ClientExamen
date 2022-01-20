<?php
    session_start();
    $res = file_get_contents("https://blablacariw.herokuapp.com/");
    $dataUsers = json_decode($res);
    $resViajes = file_get_contents("https://blablacariw.herokuapp.com/listaviajes");
    $dataViajes = json_decode($resViajes);

if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}
error_reporting(E_ERROR | E_PARSE);

if (isset($_SESSION['usuario'])) {
    $email = $_SESSION['usuario']->email;

    // Compruebo si el email existe en la BD
    $data = file_get_contents("https://blablacariw.herokuapp.com/findUserByEmail/" . $email);
    $user = json_decode($data);

    $resViajes = file_get_contents("http://blablacariw.herokuapp.com/listaviajes");
    $dataViajes = json_decode($resViajes);

    // Si existe -> me traigo su información y lo guardo
    if (!empty($user->data->usuarios)) {
        unset($_SESSION['google_login']);
        unset($user->data->usuarios[0]->password);
        $_SESSION['usuario'] = $user->data->usuarios[0];
    } else {
        // Si no existe -> lo inserto en la BD e inicializo sus valores
        //header('Location: /funciones/nuevo_usuario.php');
    }
    error_reporting(E_ERROR | E_PARSE);
}

include 'includes/header.php';

?>

<div class="container">
    <div class="search">
        <form action="lista_viajes.php" method="GET">
            <input type="text" name="origen" placeholder="Origen" required>
            <input type="text" name="destino" placeholder="Destino" required>
            <input type="date" name="fecha" required>
            <input type="time" name="hora" required>
            <input type="submit" value="Buscar">
        </form>
    </div>
</div>

<?php

    include 'includes/buscador_incidencias.php';
    
    include "includes/api_tiempo.php";

    include 'includes/buscador_incidencias.php';

    include 'includes/mapa.php';

    if ($_SESSION['usuario']->admin != null){
        include 'includes/usuarios.php';
    }

    include 'includes/viajes.php';

    include 'includes/footer.php';

?>