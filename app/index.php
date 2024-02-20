<?php
/** @author Luis Miguel */

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["userName"])) {
  $_SESSION["msg"] = "No has iniciado sesión";
  header("location: login.php");
  exit;
}

include_once __DIR__ . "/utils.php";
include_once __DIR__ . "/db/model.php";

$verificado = verificado($_SESSION["userName"]);
if (!$verificado) {
  $plantilla = file_get_contents("./templates/mail_template.html");
  $campo = userOrEmail($_SESSION["userName"]);

  $_SESSION["userName"] = $campo === "user" ? buscarUsuario(["email"], $campo, $_SESSION["userName"]) : $_SESSION["userName"];
  $camposPlantilla = [
    "{email}" => $_SESSION["userName"],
    "{url}" => "http://" . $_SERVER["HTTP_HOST"] . "/confirm.php?data=" . encriptar($_SESSION["userName"])
  ];

  $sendEmail = enviarMail("confirmacion de cuenta", $plantilla, $_SESSION["userName"], $camposPlantilla);
  if (!$sendEmail) {
    setErrorMsg("Error al enviar el correo", "error.php");
  }
}

/**
 * Ahora insertamos la vista de la página index, como es la plantilla debe de estar al final del archivo ya que si hay redirecciones y antes de una redireción no se puede mostrar nada por pantalla.
 * El nombre de la plantilla se obtiene del archivo de configuración templates.ini ya que si se cambia el nombre de la plantilla no se tiene que modificar el código.
 */
$index_template = parse_ini_file(__DIR__ . "/config/templates.ini")["index"];
include_once __DIR__ . "/templates/$index_template";
