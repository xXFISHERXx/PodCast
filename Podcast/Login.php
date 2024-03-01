<?php
// Incluir el archivo de conexión a la base de datos
require_once 'Conexion.php'; 

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; 

    // Preparar la consulta SQL para buscar el usuario
    $sql = "SELECT id, nombre, contraseña FROM usuarios WHERE correo = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $correo);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $usuario = $result->fetch_assoc();

                //Imprimir las claves del array
                #print_r($usuario);
                
                //Validar contraseña
                if ($contrasena == $usuario['contraseña']) {
                    // Iniciar una nueva sesión o regenerar la sesión existente
                    session_start();
                    // Guardar datos de usuario en variables de sesión
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    
                    $mensaje = "Login exitoso. Bienvenido, " . $usuario['nombre'] . "!";
                    echo "<script> alert('$mensaje'); </script>";
                    echo "<script> window.location.href='Index.html'; </script>";

                } else {
                    echo "<script> alert('Contraseña incorrecta'); </script>";
                    echo "<script> window.location.href='Login.html'; </script>";
                }
            } else {
                echo "<script> alert('No se encontró el usuario'); </script>";
                echo "<script> window.location.href='Login.html'; </script>";
            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
    
    $conn->close();
} else {
    // Si el formulario no se envió, redirigir al usuario al formulario de login
    header("Location: Iniciar_Sesion.html");
    exit();
}
?>
