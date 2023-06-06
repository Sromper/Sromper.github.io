<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');

require '../conexion.php';
$conn = conexion();


$nombre = $_REQUEST['nombre'];
$descripcion = $_REQUEST['descripcion'];
$consejos = $_REQUEST['consejos'];
$tiempo_preparacion = $_REQUEST['tiempo_preparacion'];
$dificultad = $_REQUEST['dificultad'];
$id_usuario = $_REQUEST['id_usuario'];
$id_pais = $_REQUEST['id_pais'];
$id_categoria = $_REQUEST['id_categoria'];
$publicada = $_REQUEST['publicada'];


$nombreOriginal = $_FILES['imagen']['name'];

 $nombreImagen = uniqid() . '_' . $nombreOriginal;  // Nombre único para la imagen
/* Ruta carpeta servidor */
 $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . "/Backend/img/";
 
/* Moverla a la carpeta */
 move_uploaded_file($_FILES['imagen']['tmp_name'], $carpetaDestino . $nombreImagen);

 try {



    $consulta = $conn->prepare(
        "INSERT INTO recetas (nombre, imagen, descripcion, consejos, tiempo_preparacion, dificultad, id_usuario, id_pais, id_categoria, publicada)
VALUES (:nombre, :imagen, :descripcion, :consejos, :tiempo_preparacion, :dificultad, :id_usuario, :id_pais, :id_categoria, :publicada)"
    );

    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':imagen', $nombreImagen);
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->bindParam(':consejos', $consejos);
    $consulta->bindParam(':tiempo_preparacion', $tiempo_preparacion);
    $consulta->bindParam(':dificultad', $dificultad);
    $consulta->bindParam(':id_usuario', $id_usuario);
    $consulta->bindParam(':id_pais', $id_pais);
    $consulta->bindParam(':id_categoria', $id_categoria);
    $consulta->bindParam(':publicada', $publicada);

    $exito = $consulta->execute();

    if ($exito) {
        $consulta = $conn->prepare("SELECT id FROM recetas WHERE nombre=:nombre");
        $consulta->bindParam(':nombre', $nombre);
        $consulta->execute();
        $exito = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if ($exito) {
            $respuesta = array(
                'exito' => true,
                'mensaje' => 'Receta agregado exitosamente',
                'id' => $exito
            );
        }
    }
} catch (\Throwable $th) {
    $respuesta = array(
        'exito' => false,
        'mensaje' => 'Error al agregar el Receta. Inténtalo de nuevo más tarde.'
    );
    echo $th;
}
echo json_encode($respuesta);
 