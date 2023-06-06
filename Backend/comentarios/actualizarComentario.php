<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

// Recibir datos de la solicitud
$id_comentario = $_REQUEST['id_comentario'];
$nuevo_comentario = $_REQUEST['nuevo_comentario'];

// Crear consulta SQL
$consulta = $conn->prepare("UPDATE comentarios SET comentario = :nuevo_comentario WHERE id = :id_comentario");

// Enlazar los parámetros
$consulta->bindParam(':nuevo_comentario', $nuevo_comentario);
$consulta->bindParam(':id_comentario', $id_comentario);

// Ejecutar la consulta
$exito = $consulta->execute();

// Verificar si la actualización fue exitosa
if ($exito) {
    // Actualización exitosa
    $respuesta = array(
        'exito' => true,
        'mensaje' => 'Comentario actualizado exitosamente'
    );
} else {
    // Actualización fallida
    $respuesta = array(
        'exito' => false,
        'mensaje' => 'Error al actualizar el comentario. Inténtalo de nuevo más tarde.'
    );
}

// Devolver respuesta al usuario en formato JSON
echo json_encode($respuesta);
?>