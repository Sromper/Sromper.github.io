
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');

require 'conexion.php';
$conn = conexion();

$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$nombre_usuario = $_REQUEST['nombre_usuario'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];


$consulta = $conn->prepare("SELECT id FROM usuarios WHERE correo = :correo");

$consulta->bindParam(':correo', $correo);
$consulta->execute();
$usuarioExiste = $consulta->rowCount();

if ($usuarioExiste == 0) {

    $consulta = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, nombre_usuario, correo, pass, fecha_registro) VALUES (:nombre, :apellidos, :nombre_usuario, :correo, :pass, NOW())");

    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->bindParam(':nombre_usuario', $nombre_usuario);
    $consulta->bindParam(':correo', $correo);
    $consulta->bindParam(':pass', $pass);

    $resultado = $consulta->execute();
    if ($resultado) {
        // Registro exitoso
        $respuesta = array(
            'exito' => true,
            'mensaje' => 'Registro exitoso'
        );
    } else {
        // Registro fallido
        $respuesta = array(
            'exito' => false,
            'mensaje' => 'Registro fallido. Inténtalo de nuevo más tarde.'
        );
    }

    // Devolver la respuesta como un JSON
    echo json_encode($respuesta);
}
