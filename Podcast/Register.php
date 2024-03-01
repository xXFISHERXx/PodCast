<?php
// Incluir el archivo de conexión a la base de datos
require_once 'Conexion.php'; 

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $contraseña = $_POST['contraseña'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, contraseña, celular) VALUES (?, ?, ?, ?, ?)";

    // Preparar la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros a la sentencia preparada
        $stmt->bind_param("sssss", $nombre, $apellido, $correo, $contraseña, $celular);

        // Intentar ejecutar la sentencia preparada
        if ($stmt->execute()) {
            echo "<script> alert('Usuario Creado Correctamente'); </script>";
            echo "<script> window.location.href='Login.html'; </script>";
        } else {
            $mensaje = "Error al insertar los datos: " . $stmt->error;
            echo "<script> alert('$mensaje'); </script>";
            echo "<script> window.location.href='Login.html'; </script>";
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
