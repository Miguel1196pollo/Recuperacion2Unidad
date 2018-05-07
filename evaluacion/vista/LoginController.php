<?php

  //valida el acceso a la aplicacion de un usuario


session_start();

$separador = DIRECTORY_SEPARATOR;
$rutaReal = realpath(dirname(__FILE__) . $separador . '..') . $separador;

include_once ("{$rutaReal}dao{$separador}UsuarioDao.php");
include_once ("{$rutaReal}modelo{$separador}UsuarioModelo.php");

if (!isset($_POST['login']) && empty($_POST['login'])) {
    die("Sin respuesta del servidor");
} else {
    $usuarioDao = new UsuarioDao();

    //Indica la respuesta de la ejecucion del metodo
    $jsonRes = array();

    //Se compone el JSON
    $json = json_decode($_POST['login']);

    //Solo trae un dato y se extrae
    $dato = $json[0];

    /**
     * Datos que vienen en el JSON
     */
    $nombreUsuario = $dato->usuario;
    $password = hash("sha256", $dato->password);

    //Se verifica la existencia del usuario
    $usuario = $usuarioDao->readNombreUsuario($nombreUsuario);

    if (is_null($usuario)) {
        //Se retorna el resultado
        $jsonRes['estado'] = 'error';
    } else {
        //Verifica coincidencias de contraseñas
        if ($password != $usuario->getPassword()) {
            //Se retorna el resultados
            $jsonRes['estado'] = 'error';
        } else {
            //Se inicia la sesion al coincidir las contraseñas
            $_SESSION['sesion'] = $usuario->getEmail();
            $jsonRes['estado'] = 'ok';
        }
    }
    echo json_encode($jsonRes);
    exit();
}
?>