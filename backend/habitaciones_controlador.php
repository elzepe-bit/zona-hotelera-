<?php
include "../bd/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'guardar_habitacion') {
    $numero = $conn->real_escape_string($_POST['numero']);
    $tipo   = $conn->real_escape_string($_POST['tipo']);
    $precio = $conn->real_escape_string($_POST['precio']);

    // --- PROCESAR IMAGEN ---
    $foto = $_FILES['foto'];
    $nombre_original = $foto['name'];
    $ext = pathinfo($nombre_original, PATHINFO_EXTENSION);
    
    // Nombre único: hab_1643123456.jpg
    $nuevo_nombre = "hab_" . time() . "." . $ext;
    $ruta_servidor = "../zona-hotelera/img/habitaciones/" . $nuevo_nombre; // Donde se guarda el archivo
    $ruta_db = "img/habitaciones/" . $nuevo_nombre;       // La URL para la base de datos

    // Mover archivo al servidor
    if (move_uploaded_file($foto['tmp_name'], $ruta_servidor)) {
        
        $sql = "INSERT INTO habitaciones (numero, tipo, precio, foto_url) 
                VALUES ('$numero', '$tipo', '$precio', '$ruta_db')";
        
        if ($conn->query($sql)) {
            echo "ok";
        } else {
            echo "Error en BD: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen al servidor.";
    }
    exit;
    }

    // --- ACCIÓN DE ELIMINAR ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'eliminar_habitacion') {
    $id = $conn->real_escape_string($_POST['id']);

    // 1. Obtener la ruta de la foto para borrarla del disco
    $consulta = $conn->query("SELECT foto_url FROM habitaciones WHERE id = '$id'");
    if ($fila = $consulta->fetch_assoc()) {
        $ruta_fisica = "../zona-hotelera/" . $fila['foto_url'];
        
        // Borrar archivo si existe
        if (file_exists($ruta_fisica)) {
            unlink($ruta_fisica);
        }

        // 2. Borrar registro de la base de datos
        $sql = "DELETE FROM habitaciones WHERE id = '$id'";
        echo ($conn->query($sql)) ? "ok" : "Error al eliminar registro";
    }
    exit;
}
?>