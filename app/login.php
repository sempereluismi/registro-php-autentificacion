<?php
/** @author Luis Miguel */

require_once "utils.php";
require_once  "db/model.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION["msg"])) {
  $msg = $_SESSION["msg"];
  unset($_SESSION["msg"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["Login"])) {
    if (!empty($_POST["user"] && !empty($_POST["password"]))) {

      $campo = userOrEmail($_POST["user"]);
      $res = buscarUsuario(["nombre"], $campo, $_POST["user"]);
      if (!$res) {
        setErrorMsg("El usuario no existe", "login.php");
      }


      $res = buscarUsuario(["nombre, password, rolId"], $campo, $_POST["user"]);
      if (password_verify($_POST["password"], $res["password"])) {
        $_SESSION["userName"] = $_POST["user"];
        $_SESSION["userDB"] = busacarRol($res["rolId"]);
        header("Location: /");
      } else {
        setErrorMsg("usuario o contraseña incorrecto", "login.php");
      }
    } else {
      setErrorMsg("No estan todos los campos obligatorios cubiertos", "login.php");
    }
  }

  if (isset($_POST["Register"])) {
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $user = filter_var($_POST["user"], FILTER_VALIDATE_EMAIL);
    if (!empty($_POST["user"]) && !$user && $email && !empty($_POST["password"]) && !empty($_POST["rpassword"]) && $_POST["password"] === $_POST["rpassword"]) {
      if (buscarUsuario(["nombre"], "nombre", $_POST["user"]) === false && buscarUsuario(["nombre"], "email", $email) === false) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $user = ucfirst(mb_strtolower($_POST["user"]));
        $res = crearUsuario($user, $email, $password);
        if (!$res) {
          setErrorMsg("Error al crear el usuario", "login.php");
        }

        $_SESSION["userName"] = $_POST["email"];
        $_SESSION["userDB"] = "standard";
        header("Location: index.php");
      } else {
        setErrorMsg("El nombre de usuario o el correo ya esta registrado", "login.php");
      }
    } else {
      setErrorMsg("No estan todos los campos obligatorios cubiertos o el usuario no tiene un formato válido", "login.php");
    }
  }
}

/**
 * inserción de la vista de login
 */
$login_template = parse_ini_file(__DIR__ . "/config/templates.ini")["login"];
include_once __DIR__ . "/templates/$login_template";
