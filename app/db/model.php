<?php
/**
 * @author Luis Miguel
 */

declare(strict_types=1);
include_once "PDO.php";
include_once __DIR__ . "/../utils.php";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["userDB"])) {
  $_SESSION["userDB"] = "conexion";
}

/**
 * creamos un usuario en la base de datos el password debe de estar hasheado
 */
function crearUsuario(string $nombre, string $email, string $password): bool
{

  $sql = "INSERT INTO usuario (nombre, email, password) VALUES (?, ?, ?);";
  try {
    $dbInstance = DatabaseConnection::getInstance($_SESSION["userDB"]);
    $connection = $dbInstance->getConnection();

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $password);

    $stmt->execute();
    return true;
  } catch (Exception $e) {
    setErrorMsg("Error al crear el usuario", "error.php");
    return false;
  } finally {
    unset($stmt);
  }
}

/**
 * Busca un usuario y puedes elegir los campos select pasando como parametro en un array, y añadiendo un campo where
 */
function buscarUsuario(array $camposSelect, string $NombreCampoWhere, string $campoWhere): array | false
{
  $campos = implode(", ", $camposSelect);
  $sql = "SELECT $campos FROM usuario where $NombreCampoWhere = ?;";
  try {
    $dbInstance = DatabaseConnection::getInstance($_SESSION["userDB"]);
    $connection = $dbInstance->getConnection();

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $campoWhere);

    $stmt->execute();
    $res = $stmt->fetch();
    return $res;
  } catch (Exception $e) {
    setErrorMsg("Error al buscar el usuario", "error.php");
  } finally {
    unset($stmt);
  }
}

function busacarRol(string $rolid): string | false
{
  $sql = "SELECT rol FROM rol where id = ?;";
  try {
    $dbInstance = DatabaseConnection::getInstance($_SESSION["userDB"]);
    $connection = $dbInstance->getConnection();

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $rolid);

    $stmt->execute();
    $res = $stmt->fetch()[0];
    return $res;
  } catch (Exception $e) {
    setErrorMsg("Error en la base de datos", "error.php");
  } finally {
    unset($stmt);
  }
}

/**
 * hace un update de un campo de la tabla usuario el campo que pasas como parametro y el where tambien 
 */

function actualizarUsuario(string $campoSet, string $valorSet, string $campoWhere, string $valorWhere): bool
{
  $sql = "UPDATE usuario SET $campoSet = ? WHERE $campoWhere = ?;";
  try {
    $dbInstance = DatabaseConnection::getInstance($_SESSION["userDB"]);
    $connection = $dbInstance->getConnection();

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $valorSet);
    $stmt->bindParam(2, $valorWhere);
    $res = $stmt->execute();
    return $res;
  } catch (Exception $e) {
    setErrorMsg("Error al actualizar el usuario", "error.php");
    return false;
  } finally {
    unset($stmt);
  }
}


/**
 * comprueba en la tabla usuarios si el usuario que se le pasa por parametro tanto si es su nombre de usuario o email esta verificado
 */
function verificado(string $nombre): bool
{
  $campoWhere = userOrEmail($nombre);
  $sql = "SELECT verificado FROM usuario where $campoWhere = ?;";
  try {
    $dbInstance = DatabaseConnection::getInstance($_SESSION["userDB"]);
    $connection = $dbInstance->getConnection();

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $nombre);

    $stmt->execute();
    $verificado = $stmt->fetch()[0];
    return boolval($verificado);
  } catch (Exception $e) {
    setErrorMsg("Error al buscar el usuario", "error.php");
    return false;
  } finally {
    unset($stmt);
  }
}
