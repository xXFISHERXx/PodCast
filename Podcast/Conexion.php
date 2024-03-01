<?php
// Parámetros de conexión a la base de datos
$host = 'localhost'; // o la IP del servidor de bases de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña del usuario de la base de datos
$database = 'Podcast'; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

#echo "Conexión exitosa";
?>
