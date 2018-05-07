<?php
session_start();
if (isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver las citas del dia-->
    <script type="text/javascript">
        window.location.href = "vista/list_cliente.php";
    </script>
    <?php
} else {
    ?>
    <html lang="en" ng-app="">
        <head>
            <title>Barber Shop Citas</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        </head>
        <body ng-controller="loginController">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="./">Barber Shop *Texas*</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="vista/galeria.html">Galeria de cortes</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Información<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Promociones</a></li>
                                <li><a href="vista/acerca_de.php">Acerca de</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" ng-click="registro()"><span class="glyphicon glyphicon-user"></span>Registrarse</a></li>
                        <li><a href="#"  ng-click="login()"> <span class="glyphicon glyphicon-log-in"></span>Iniciar Sesión</a></li>
                    </ul>
                </div>
            </nav>

            <!--Implementación del carrusel -->
            <div id="contenedor" >
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="active item"><img  src="media/img/barber.png" alt="banner1" /></div>
                        <div class="item"><img src="media/img/descarga1.jpg" alt="banner2" /></div>
                        <div class="item"><img  src="media/img/descarga2.jpg" alt="banner3" /></div>
                        <div class="item"><img  src="media/img/descarga3.jpg" alt="banner4" /></div>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
            </div>

            <div id="modallogin" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button ng-click="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 style="text-align: center;" class="modal-title">Inciar Sesión</h3>
                        </div>

                        <div class="modal-body">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <label>Usuario:</label><br>
                                        </div>
                                        <div class="col-md-7">
                                            <input ng-model="aDato.usuario" type="text" id="usuario" class="form-control border-input" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">            
                                            <label>Password</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input ng-model="aDato.password" type="password" id="password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <input type="submit" class="btn btn-lg btn-success btn-block" ng-click="loginEntrar()" id="loginEntrar" value="Entrar">
                        </div>
                    </div>
                </div>
            </div>

            <div  id="modalregistro" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button ng-click="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 style="text-align: center;" class="modal-title">Registrate</h3>
                        </div>

                        <div class="modal-body">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <label>Indica tu nombre de usuario:</label><br>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" ng-model="aDato.nombreUsuario" id="nombreUsuario" class="form-control border-input">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">            
                                            <label>Indica tu Correo Electrónico</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input ng-model="aDato.correo" id="correo" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <label>Vuelve a ingresar tu correo</label><br>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" ng-model="aDato.correoR" id="correoR" class="form-control border-input">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <label>Asigne su contraseña</label><br>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="password" ng-model="aDato.password1" id="password1" class="form-control border-input">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <label>Vuelve a ingresar su contraseña</label><br>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="password" ng-model="aDato.passwordR" id="passwordR" class="form-control border-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <input type="submit" class="btn btn-lg btn-success btn-block" ng-click="registrar()" id="registro" value="Terminar">
                        </div>
                    </div>
                </div>
            </div>

            <!--SCRIPS a utiliza-->
            <script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.32/angular.min.js"></script>
            <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="media/js/index.js" type="text/javascript"></script>
        </body>
    </html>
    <?php
}
?>
