<?php

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
    <div class="contenedor">
        <h1>Gestor de Tareas</h1>
        <p><strong>Usuario:</strong> <?= htmlspecialchars($_SESSION["cedula"]) ?></p>

        <form method="POST">
            <div class="agregar-tarea">
                <input
                    type="text"
                    name="texto"
                    placeholder="Escriba una nueva tarea..."
                    required>

                <input
                    type="submit"
                    name="agregar"
                    value="Agregar">
            </div>
        </form>

        <hr>

        <h2>Pendientes</h2>
        <?php if (count($pendientes) == 0) { ?>
            <p>No existen tareas pendientes.</p>
        <?php } ?>
        <?php foreach ($pendientes as $tarea) { ?>
            <div class="item-tarea">
                <span>
                    <?= htmlspecialchars($tarea[1]) ?>
                </span>

                <form method="POST">
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
                        value="Eliminar"
                        class="btn-eliminar">
                </form>
            </div>
        <?php } ?>

        <hr>

        <h2>Completadas</h2>
        <?php if (count($completadas) == 0) { ?>
            <p>No existen tareas completadas.</p>
        <?php } ?>
        <?php foreach ($completadas as $tarea) { ?>
            <div class="item-tarea">
                <span>
                    <?= htmlspecialchars($tarea[1]) ?>
                </span>

                <form method="POST">
                    <input
                        type="hidden"
                        name="id"
                        value="<?= $tarea[0] ?>">

                    <input
                        type="submit"
                        name="eliminar"
                        value="Eliminar"
                        class="btn-eliminar">
                </form>
            </div>

        <?php } ?>

        <hr>

        <div class="botones">
            <form action="logout.php" method="POST">
                <input
                    type="submit"
                    value="Cerrar sesión">
            </form>
        </div>

</body>

</html>