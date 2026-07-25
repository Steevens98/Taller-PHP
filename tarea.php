<?php

function guardarTarea($usuario, $texto) {

    $archivo = "tareas_" . $usuario . ".csv";

    $id = 1;

    if (file_exists($archivo)) {
        $lineas = file($archivo);
        $id = count($lineas) + 1;
    }

    $linea = $id . "," . $texto . ",pendiente\n";

    file_put_contents($archivo, $linea, FILE_APPEND);
}

function listarTareas($usuario) {

    $archivo = "tareas_" . $usuario . ".csv";

    $pendientes = [];
    $completadas = [];

    if (!file_exists($archivo)) {
        return [$pendientes, $completadas];
    }

    $lineas = file($archivo);

    foreach ($lineas as $linea) {

        $datos = explode(",", trim($linea));

        if ($datos[2] == "pendiente") {
            $pendientes[] = $datos;
        } else {
            $completadas[] = $datos;
        }

    }

    return [$pendientes, $completadas];
}

function completarTarea($usuario, $id) {

    $archivo = "tareas_" . $usuario . ".csv";

    if (!file_exists($archivo)) return;

    $lineas = file($archivo);

    $nuevo = "";

    foreach ($lineas as $linea) {

        $datos = explode(",", trim($linea));

        if ($datos[0] == $id) {
            $datos[2] = "completada";
        }

        $nuevo .= implode(",", $datos) . "\n";
    }

    file_put_contents($archivo, $nuevo);
}

function eliminarTarea($usuario, $id) {

    $archivo = "tareas_" . $usuario . ".csv";

    if (!file_exists($archivo)) return;

    $lineas = file($archivo);

    $nuevo = "";

    foreach ($lineas as $linea) {

        $datos = explode(",", trim($linea));

        if ($datos[0] != $id) {
            $nuevo .= implode(",", $datos) . "\n";
        }

    }

    file_put_contents($archivo, $nuevo);
}

?>