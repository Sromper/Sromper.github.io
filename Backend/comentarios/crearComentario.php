<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();


$comentario = $_REQUEST['comentario'];
$id_usuario = $_REQUEST['id_usuario'];
$id_receta = $_REQUEST['id_receta'];

$consulta=$conn->prepare("INSERT INTO comentarios (comentario, fecha, id_usuario, id_receta) VALUES (:comentario, NOW(), :id_usuario, :id_receta)");

// Enlazar los parámetros
$consulta->bindParam(':comentario', $comentario);
$consulta->bindParam(':id_usuario', $id_usuario);
$consulta->bindParam(':id_receta', $id_receta);


$exito = $consulta->execute();

// Verificar si la inserción fue exitosa
if ($exito) {
    // Inserción exitosa
    $respuesta = array(
        'exito' => true,
        'mensaje' => 'Comentario insertado exitosamente'
    );
} else {
    // Inserción fallida
    $respuesta = array(
        'exito' => false,
        'mensaje' => 'Error al insertar el comentario. Inténtalo de nuevo más tarde.'
    );
}
echo json_encode($respuesta);
