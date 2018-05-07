<?php
/**
 * Description of delete_cliente
 *
 * @author pollo
 */
session_start();
if (!isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver las citas del dia-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
} else {
///Valida el parametro GET en la URL
    if (!isset($_GET['id']) || $_GET['id'] == 0) {
        die('Error con el ID');
    } else {
        include_once "../dao/ClienteDao.php";
        include_once "../modelo/ClienteModelo.php";

        //Obtiene el id del cliente a modificar.
        $id = $_GET['id'];

        //Instancia hacia ClienteDao y se busca el cliente por su ID
        $cliente = new ClienteDao();

        //Establece el titulo de la pagina
        $page_title = "Cita Eliminada";
        include_once "template/header.php";

        if ($cliente->deleteCliente($id)) {
            echo "<div class='alert alert-success'>Cita eliminada exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>No es posible eliminar la cita.</div>";
        }
        echo '<div class = "right-button-margin ">
            <a href = "../" class = "btn btn-primary">Continuar</a>
        </div>';
        
        include_once "template/footer.php";
    }
}
?>

