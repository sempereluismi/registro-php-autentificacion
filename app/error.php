<?php
/** @author Luis Miguel */

$msg = !isset($_SESSION["msg"]) ? "Ha ocurrido un error inesperado" : $_SESSION["msg"];
unset($_SESSION["msg"]);

/**
 * inserción de la vista de error
 */
$error_template = parse_ini_file(__DIR__ . "/config/templates.ini")["error"];
include_once __DIR__ . "/templates/$error_template";
