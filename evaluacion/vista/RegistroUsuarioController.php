<?php
session_start();

if (isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver las citas del dia-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
} else {
    if (!isset($_POST['registro']) && empty($_POST['registro'])) {
        die("Sin respuesta del servidor");
    } else {
        $separador = DIRECTORY_SEPARATOR;
        $rutaReal = realpath(dirname(__FILE__) . $separador . '..') . $separador;

        include_once ("{$rutaReal}dao{$separador}UsuarioDao.php");
        include_once ("{$rutaReal}modelo{$separador}UsuarioModelo.php");

        $usuarioDao = new UsuarioDao();

        $usuarioM = new UsuarioModelo();

        //Indica la respuesta de la ejecucion del metodo
        $jsonRes = array();

        //Se descompone el JSON
        $json = json_decode($_POST['registro']);

        //Solo trae un dato y se extrae
        $dato = $json[0];

        /**
         * Datos que vienen en el JSON
         */
        $usuarioM->setEmail($dato->nombreUsuario);
        $usuarioM->setPassword(hash("sha256", $dato->password));

        //Enviar Correo
        $correo = $dato->correo;

        $usuarioDao->insertarUsuario($usuarioM);

        $jsonRes["estado"] = 'ok';

        echo json_encode($jsonRes);

        exit();
    }
}
    