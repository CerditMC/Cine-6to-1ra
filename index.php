<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Asientos - Cine</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { width: 50%; margin: auto; }
        select, input { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: green; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Reserva tu Asiento</h2>
    <form action="procesar_reserva.php" method="POST">
        <input type="text" name="nombre" placeholder="Tu Nombre" required>
        <input type="email" name="email" placeholder="Tu Email" required>

        <label>Selecciona una Película:</label>
        <select name="pelicula" required>
            <?php
            $conexion = new mysqli("localhost", "root", "", "cine");
            $peliculas = $conexion->query("SELECT * FROM peliculas");
            while ($fila = $peliculas->fetch_assoc()) {
                echo "<option value='" . $fila['ID_PELICULA'] . "'>" . $fila['TITULO'] . "</option>";
            }
            ?>
        </select>

        <label>Selecciona una Sala:</label>
        <select name="sala" required>
            <?php
            $salas = $conexion->query("SELECT * FROM salas");
            while ($fila = $salas->fetch_assoc()) {
                echo "<option value='" . $fila['ID_SALA'] . "'>" . $fila['NOMBRE_SALA'] . "</option>";
            }
            ?>
        </select>

        <label>Selecciona una Función:</label>
        <select name="funcion" required>
            <?php
            $funciones = $conexion->query("SELECT * FROM funciones");
            while ($fila = $funciones->fetch_assoc()) {
                echo "<option value='" . $fila['ID_FUNCION'] . "'>" . $fila['FECHA'] . "</option>";
            }
            ?>
        </select>

        <label>Selecciona un Asiento:</label>
        <select name="asiento" required>
            <?php
            $asientos = $conexion->query("SELECT * FROM asientos");
            while ($fila = $asientos->fetch_assoc()) {
                echo "<option value='" . $fila['ID_ASIENTO'] . "'>FILA " . $fila['FILA'] . " - ASIENTO " . $fila['NUMERO'] . "</option>";
            }
            ?>
        </select>

        <button type="submit">Reservar</button>
    </form>

</body>
</html>
