<html lang="en">
    <head>
        <title><?php echo $page_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../">Barber Shop *Texas*</a>
                </div>
                <ul class="nav navbar-nav">
                    <?php
                    if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == 'admin') {
                        ?>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a id="excelUsuario" href="#"><i class="fa fa-file-excel-o" style="font-size: 20px;"></i>     Generar Reporte Usuarios Registrados</a></li>
                                <li><a id="pdfUsuario" href="#"><i class="fa fa-file-pdf-o" style="font-size: 20px;"></i>     Generar Reporte Usuarios Registrados</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>

                    <li><a href="vista/galeria.html">Galeria de cortes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="LogoutController.php"> <span class="fa fa-lock" style="font-size: 20px"></span>      Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>
        <h3 class="jumbotron jumbotron-fluid"><?php echo $page_title; ?></h3>
        <br>


        <?php
        if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == 'admin') {
            include_once "../dao/UsuarioDao.php";
            $usuarioDao = new UsuarioDao();
            ?>
            <div id="divtabla">
                <table id='tablausuario'>
                    <thead>
                        <tr>
                            <td>Id Usuario</td>
                            <th>Nombre Usuario</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $usuarioDao->gridHtml(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Id Usuario</td>
                            <th>Nombre Usuario</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php
        }
        ?>

