<?php 

session_start();

include './includes/header.php';

$origen = $_GET['origen'];
$destino = $_GET['destino'];
$fecha = strtotime($_GET['fecha']);
$hora = strtotime($_GET['hora']);

$res = file_get_contents("https://blablacariw.herokuapp.com/travels/search?origen=" . $origen . "&destino=" . $destino);
$data = json_decode($res);
var_dump($data);
$viajes = array([]);

foreach ($data->viajes as $viaje){
    if ($fecha === $viaje->fecha_salida && $hora > $viaje->hora_salida){
        echo $viaje->lugar_salida;
    }
}
?>