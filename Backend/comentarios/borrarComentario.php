<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$id_comentario = $_REQUEST['id_comentario'];

$consulta = $conn->prepare("DELETE FROM comentarios WHERE id_comentario = :id_comentario");

// Enlazar los parámetros
$consulta->bindParam(':id_comentario', $id_comentario);

$exito = $consulta->execute();

// Verificar si el borrado fue exitoso
if ($exito) {
    // Borrado exitoso
    $respuesta = array(
        'exito' => true,
        'mensaje' => 'Comentario eliminado exitosamente'
    );
} else {
    // Borrado fallido
    $respuesta = array(
        'exito' => false,
        'mensaje' => 'Error al eliminar el comentario. Inténtalo de nuevo más tarde.'
    );
}
echo json_encode($respuesta);
?>