<?php

/** @author Luis Miguel */

declare(strict_types=1);
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/**
 * remplaza en un texto el array de campos que se le pasa
 */
function substituir(string $mensaje, array $campos): string
{
    // Reemplazamos los campos que queremos de la plantilla
    // $mensaje = str_replace('{email}', $user, $plantilla);
    foreach ($campos as $key => $campo) {
        $mensaje = str_replace($key, $campo, $mensaje);
    }
    return $mensaje;
}

/**
 * envia el mail en la plantilla es el cuerpo del correo si se quiere usar texto personalizado debes de usar el parametro $campos que tiene que tener la siguiente estructura.
 * [
 *  "campo a cambiar" => valor del campo que quieres cambiar,
 *  "{url}" => www.google.com
 * ]
 * este array busca en el parametro plantilla el valor {url} y lo sustituye por www.google.com tantas veces como {url} aparezca
 */
function enviarMail(string $asunto, string $plantilla, string $destinatario, array $campos = []): bool
{

    $config = parse_ini_file('./config/config.ini', true);

    try {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->IsSMTP();
        // cambiar a 0 para no ver mensajes de error
        $mail->SMTPDebug = 0;
        //	Establece la autentificación SMTP. Por defecto a False
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        //	Establece el servidor SMTP. Pueden ser varios separados por ;
        $mail->Host = $config['email']['HOST'];
        $mail->Port = $config['email']['PORT'];

        // Introducir usuario de correo completo
        $mail->Username = $config['email']['USERNAME'];
        // Introducir clave
        $mail->Password = $config['email']['PASSWORD'];
        $mail->SetFrom($config['email']['USERNAME'], 'Usuario que envía el correo');
        /*
     * Para especificar el asunto. Utilizamos la función mb_convert_encoding para que muestre
     * correctamente los acentos.
     */
        $mail->Subject = mb_convert_encoding($asunto, 'UTF-8');

        // Reemplazamos los campos que queremos de la plantilla
        // $mensaje = str_replace('{email}', $user, $plantilla);
        $mensaje = substituir($plantilla, $campos);

        $mail->MsgHTML($mensaje);
        /*
     * bool AddAttachment ( $path, $name, [$encoding = "base64"], [$type = "application/octet-stream"] )	
     * Añade un fichero adjunto al mensaje. Retorna false si el fichero no pudo ser encontrado.
     * $path, es la ruta del archivo puede ser relativa al script php (no a la clase PHPMailer) 
     * o una ruta absoluta. Se aconseja usar rutas relativas
     * $name, nombre del fichero
     * $encoding, tipo de codificación. Se aconseja dejar la predeterminada
     * $type, el valor por defecto funciona con cualquier clase de archivo. Se puede 
     * usar un tipo específico como por ejemplo image/jpeg
     */
        // $mail->addAttachment("foto_playa.jpeg");

        // destinatario
        $address = $destinatario;
        /*
     * AddAddress	void AddAddress ( $address, $name )	
     * Añade una dirección de destino del mensaje. El parámetro $name es opcional
     */
        $mail->AddAddress($address, "Destinatario correo");

        /*
     * bool Send ( )	
     * Envía el mensaje, devuelve false si ha habido algún problema. 
     * Consultando la propiedad ErrorInfo se puede saber cuál ha sido el problema
     */
        $resul = $mail->Send();

        return $resul;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * configura una variable de session y redirige a la pagina que se le pasa como parametro en la pagina muestras el mensaje como quieras
 */
function setErrorMsg(string $msg, string $page): void
{
    $_SESSION["msg"] = $msg;
    header("Location: $page");
}


/**
 * se le pasa una cadena de texto que deberia ser el usuario y te dice si es un email o el nombre del usuario creado
 */
function userOrEmail(string $user): string
{
    $campo = "nombre";
    if (filter_var($user, FILTER_VALIDATE_EMAIL) !== false) {
        $campo = "email";
    }
    return $campo;
}


/**
 * encripta de forma reversible el valor
 */
function encriptar(string $mensaje)
{
    return base64_encode(str_rot13($mensaje));
}

/**
 * desencripta el valor que se encripto utilizando la funcion encriptar
 */
function desencriptar(string $mensaje)
{
    return str_rot13(base64_decode($mensaje));
}
