<?php
session_start();
if (!isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver las citas del dia-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
} elseif ($_SESSION['sesion'] != 'admin') {
    ?>
    <!--Solo el Administrador puede ver las citas del dia-->
    <script type="text/javascript">
        window.location.href = "crear_cliente.php";
    </script>
    <?php
} else {
    include_once "../dao/ClienteDao.php";

    //Instancia hacia ClienteDao
    $cliente = new ClienteDao();

    // Establece cabecera
    $page_title = "Listado de Citas";
    include_once "template/header.php";
    ?>
    <br>
    <table class='table table-hover' id='tabla1'>
        <thead>
            <tr>
                <td>Id Cliente</td>
                <th>Nombre Cliente</td>
                <td>Número de telefono</td>
                <td>Fecha Cita</td>
                <td>Hora Cita</td>
                <td>Servicio</td>
                <td>Total</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?Php
            echo $cliente->gridHtml(); // Se comentan parametros [hpastortest] -- $num_registro, $reg_por_pagina
            ?>
        </tbody>
    </table>
    <?Php
}
// Establece el footer
include_once "template/footer.php";
?>
