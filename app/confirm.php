<?php
/** @author Luis Miguel */
include_once "utils.php";
include_once "db/model.php";
if (!isset($_GET["data"])) {
  header("Location: index.php");
}

$email = filter_var(desencriptar($_GET["data"]), FILTER_VALIDATE_EMAIL);
if (!$email) {
  header("Location: error.php");
}

$res = verificado($email);

if ($res) {
  header("Location: index.php");
}

$res = actualizarUsuario("verificado", '1', "email", $email);

if (!$res) {
  header("Location: error.php");
}

header("Location: index.php");
