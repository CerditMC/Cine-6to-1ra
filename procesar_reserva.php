<?php
$conexion = new mysqli("localhost", "root", "", "cine");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$id_funcion = $_POST['funcion'];
$id_asiento = $_POST['asiento'];

// Verificar si el usuario ya existe
$consulta_usuario = $conexion->query("SELECT id FROM usuarios WHERE email='$email'");
if ($consulta_usuario->num_rows > 0) {
    $usuario = $consulta_usuario->fetch_assoc();
    $id_usuario = $usuario['id'];
} else {
    // Insertar nuevo usuario
    $conexion->query("INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')");
    $id_usuario = $conexion->insert_id;
}

// Verificar si el asiento ya está reservado
$consulta_reserva = $conexion->query("SELECT id FROM reservas WHERE id_asiento='$id_asiento'");
if ($consulta_reserva->num_rows > 0) {
    echo "<script>alert('El asiento ya está reservado. Elige otro.'); window.history.back();</script>";
} else {
    // Insertar la reserva
    $conexion->query("INSERT INTO reservas (id_usuario, id_funcion, id_asiento) 
                      VALUES ('$id_usuario', '$id_funcion', '$id_asiento')");
    echo "<script>alert('Reserva realizada con éxito!'); window.location='index.php';</script>";
}

// Cerrar conexión
$conexion->close();
?>
