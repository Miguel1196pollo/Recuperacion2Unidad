<?php
session_start();
if (!isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver las citas del dia-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
} else {

    include_once "../dao/ClienteDao.php";
    include_once "../modelo/ClienteModelo.php";

//Valida el parametro GET en la URL
    if (!isset($_GET['id']) || $_GET['id'] == 0) {
        die('Error con el ID');
    } else {
        //Obtiene el id del cliente a modificar.
        $id = $_GET['id'];

        //Instancia hacia ClienteDao y se busca el cliente por su ID
        $cliente = new ClienteDao();

        $clienteM = $cliente->readId($id);

        if (is_null($clienteM)) {
            $page_title = "Cliente NULL";
            die('El cliente fue alterado en otro proceso');
        } else {
            //Establece el titulo de la pagina
            $page_title = "Actualizar cita";
            include_once "template/header.php";
            ?>
            <!--Script que ayuda a mandar un alerta si queremos enviar el formulario -->
            <script language="JavaScript">
                function pregunta() {
                    if (confirm('¿Estas seguro de editar los datos?')) {
                        document.form.submit()
                    }
                }
            </script> 

            <!-- Boton paraa consultar citas -->
            <div class="right-button-margin ">
                <a href='list_cliente.php' class='btn btn-primary'>Consultar</a>
            </div>

            <form action='' method='POST'>
                <table class='table table-hover'>
                    <tr>
                        <td>Nombre Cliente</td>
                        <td><input type='text' name='nombreCliente' value="<?php echo $clienteM->getNombreCliente(); ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Número Telefono</td>
                        <td><input type='text' name='numeroTelefono' value="<?php echo $clienteM->getNumeroTelefono(); ?>" class="form-control"></td>
                    </tr>

                    <tr>
                        <td>Fecha Cita</td>
                        <td><input type='text' name='fechaCita' value="<?php echo $clienteM->getFechaCita(); ?>" class="form-control"></td>
                    </tr>

                    <tr>
                        <td>Hora Cita</td>
                        <td><input type='text' name='horaCita' value="<?php echo $clienteM->getHoraCita(); ?>" class="form-control"></td>
                    </tr>

                    <tr>
                        <td>Servicio</td>
                        <td><input type='text' name='Servicio' value="<?php echo $clienteM->getServicio(); ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><input type='text' name='Total' value="<?php echo $clienteM->getTotal(); ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><button type='submit' name='enviar' id='enviar' class="btn btn-primary" onclick=" return pregunta()">Modificar Cita</button></td>
                    </tr>
                </table>
            </form>
            <?php
            //Vía método POST
            // Forma a modificar el registro de la cita
            if ($_POST) {
                //Se inicializa un nuevo cliente
                $clienteMA = new ClienteModelo();

                $clienteMA->setFechaCita($_POST['fechaCita']);
                $clienteMA->setHoraCita($_POST['horaCita']);
                $clienteMA->setIdCliente($id);
                $clienteMA->setNombreCliente($_POST['nombreCliente']);
                $clienteMA->setNumeroTelefono($_POST['numeroTelefono']);
                $clienteMA->setServicio($_POST['Servicio']);
                $clienteMA->setTotal($_POST['Total']);

                if ($cliente->updateCliente($clienteMA)) {
                    echo "<div class='alert alert-success'>Cita modificada exitosamente.</div>";
                } else {
                    echo "<div class='alert alert-danger'>No es posible modificar la cita.</div>";
                }
            }

            include_once "template/footer.php";
        }
    }
}
?>

