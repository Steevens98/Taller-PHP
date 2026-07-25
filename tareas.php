<<?php

session_start();

if (!isset($_SESSION["cedula"])) {
    header("Location: ingreso.php");
    exit;
}

require "tarea.php";

$usuario = $_SESSION["cedula"];

if (isset($_POST["agregar"])) {
    guardarTarea($usuario, $_POST["texto"]);
    header("Location: tareas.php");
    exit;
}

if (isset($_POST["completar"])) {
    completarTarea($usuario, $_POST["id"]);
    header("Location: tareas.php");
    exit;
}

if (isset($_POST["eliminar"])) {
    eliminarTarea($usuario, $_POST["id"]);
    header("Location: tareas.php");
    exit;
}

list($pendientes, $completadas) = listarTareas($usuario);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<h1>Gestor de Tareas</h1>

<p>Usuario: <?= htmlspecialchars($_SESSION["cedula"]) ?></p>

<form method="POST">

    <input
        type="text"
        name="texto"
        required
    >

    <input
        type="submit"
        name="agregar"
        value="Agregar"
    >

</form>

<hr>

<h2>Pendientes</h2>

<?php foreach ($pendientes as $tarea) { ?>

<p>

<?= htmlspecialchars($tarea[1]) ?>

<form method="POST" style="display:inline;">

    <input
        type="hidden"
        name="id"
        value="<?= $tarea[0] ?>">

    <input
        type="submit"
        name="completar"
        value="Completar">

    <input
        type="submit"
        name="eliminar"
        value="Eliminar">

</form>

</p>

<?php } ?>

<hr>

<h2>Completadas</h2>

<?php foreach ($completadas as $tarea) { ?>

<p>

<?= htmlspecialchars($tarea[1]) ?>

<form method="POST" style="display:inline;">

    <input
        type="hidden"
        name="id"
        value="<?= $tarea[0] ?>">

    <input
        type="submit"
        name="eliminar"
        value="Eliminar">

</form>

</p>

<?php } ?>

<hr>

<p>
    <a href="logout.php">Cerrar sesión</a>
</p>

</body>
</html>