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
//Establece el título de la página 
    $page_title = "Agendar una cita en Barber Shop";
    include_once 'template/header.php';

    if ($_SESSION['sesion'] == 'admin') {
        ?>
        <div class="right-button-margin ">
            <a href='list_cliente.php' class='btn btn-primary'>Consultar</a>
        </div>
        <?php
    }
    ?>
    <!-- Aquí va el contenido a mostrar en la página  -->
    <!--Código del formulario HTML-->
    <form action='#' method='POST'>
        <table class='table table-hover'>
            <tr>
                <td>A nombre de:</td>
                <td><input type='text' name='nombreCliente' id='nombres' readonly="true" class="form-control" value="<?php echo $_SESSION['sesion']; ?>"></td>
            </tr>
            <tr>
                <td>Numero Telefono</td>
                <td><input type='text' name='numeroTelefono' id='numeroTelefono' class="form-control" required placeholder="Eje: 428-100-1900"></td>
            </tr>

            <tr>
                <td>Fecha Cita</td>
                <td><input type='date' name='fechaCita' id='fechaCita' class="form-control" required></td>
            </tr>

            <tr>
                <td>Hora Cita</td>
                <td><input type='time' name='horaCita' id='horaCita' class="form-control" required placeholder="Eje: 18:00"></td>
            </tr>

            <tr>
                <td>Servicio </td>
                <td><select id="Servicio" name="Servicio" required>
                        <option value="" id="tipo">Selecciona un servicio</option>
                        <option value="Corte Sencillo">Corte sencillo</option>
                        <option value="Corte con navaja">Corte con navaja</option>
                        <option value="Afeitación">Afeitación</option>
                        <option value="Delineado de cejas">Delineado de cejas</option>                     
                    </select>                     
                </td>
            </tr> 
            <tr>
                <td>Total</td>
                <td><input type='text' name='Total' id='Total' readonly="true" class="form-control"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><button type='submit' name='enviar' id='enviar' class="btn btn-primary">Guardar registro</button></td>
            </tr>


        </table>
    </form>




    <?php
    include_once 'template/footer.php';

    //Vía método POST
    if ($_POST) {
        $slash = DIRECTORY_SEPARATOR;
        $base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
        include_once ("{$base_dir}modelo{$slash}ClienteModelo.php");
        include_once ("{$base_dir}dao{$slash}ClienteDao.php");

        $cliente = new ClienteModelo();

        $cliente->setFechaCita($_POST['fechaCita']);
        $cliente->setHoraCita($_POST['horaCita']);
        $cliente->setNombreCliente($_POST['nombreCliente']);
        $cliente->setNumeroTelefono($_POST['numeroTelefono']);
        $cliente->setServicio($_POST['Servicio']);
        $cliente->setTotal($_POST['Total']);

        $clienteDao = new ClienteDao();

        if ($clienteDao->insertarCliente($cliente)) {
            echo "<div class='alert alert-success'>Cita agregada exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>No es posible agregar los datos.</div>";
        }
    }
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#Total").val(0);
        
        $("#Servicio").on('change', function () {
            var servicio = $("#Servicio").val();

            var costo = 0;

            switch (servicio) {
                case 'Corte Sencillo':
                    costo = 60.49;
                    break;
                case 'Corte con navaja':
                    costo = 120.35;
                    break;
                case 'Afeitación':
                    costo = 105.69;
                    break;
                case 'a':
                    break;
                case 'Delineado de cejas':
                    costo = 95.69;
                    break;
                default:
                    costo = 0;
            }

            $("#Total").val(costo);
        });
    });
</script>
