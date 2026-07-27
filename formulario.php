<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<div class="contenedor">
    <h1>Formulario de Registro</h1>

    <form action="bienvenido.php" method="POST">

        <label>Cédula:</label><br>
        <input
            type="text"
            name="cedula"
            maxlength="10"
            minlength="10"
            pattern="[0-9]{10}"
            title="La cédula debe contener exactamente 10 dígitos."
            required><br><br>

        <label>Nombre:</label><br>
        <input
            type="text"
            name="nombre"
            maxlength="30"
            required><br><br>

        <label>Estado Civil:</label><br>
        <select name="estado_civil" required>
            <option value="soltero">Soltero</option>
            <option value="casado">Casado</option>
            <option value="union_libre">Unión libre</option>
            <option value="viudo">Viudo</option>
        </select><br><br>

        <label>Correo:</label><br>
        <input
            type="email"
            name="correo"
            required><br><br>

        <label>Clave:</label><br>
        <input
            type="password"
            name="clave"
            minlength="6"
            required><br><br>

        <div class="botones">
            <input type="submit" value="Registrar">
            <input type="reset" value="Resetear">
        </div>

    </form>
</div>
</body>

</html>