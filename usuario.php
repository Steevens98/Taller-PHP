<?php

function guardar($datos)
{
    $linea =
        $datos["cedula"] . "," .
        $datos["nombre"] . "," .
        $datos["estado_civil"] . "," .
        $datos["correo"] . "," .
        $datos["clave_hash"] . PHP_EOL;

    file_put_contents("usuarios.csv", $linea, FILE_APPEND);
}

function validar($cedula)
{
    if (!file_exists("usuarios.csv")) {
        return false;
    }

    $archivo = file("usuarios.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($archivo as $linea) {

        $datos = explode(",", $linea);

        if (trim($datos[0]) == trim($cedula)) {
            return true;
        }
    }

    return false;
}

function autenticar($cedula, $contrasena)
{
    if (!file_exists("usuarios.csv")) {
        return false;
    }

    $archivo = file("usuarios.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($archivo as $linea) {

        $datos = explode(",", $linea);

        if (
            trim($datos[0]) == trim($cedula) &&
            password_verify($contrasena, trim($datos[4]))
        ) {
            return true;
        }
    }

    return false;
}

?>