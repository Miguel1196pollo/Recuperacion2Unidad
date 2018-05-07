//Cotroller de ANGULAR
function loginController($scope) {
    $scope.aDato = new Array();

    $('.myCarousel').carousel();

    $scope.login = function () {
        $("#modallogin").modal();
    }

    $scope.registro = function () {
        $("#modalregistro").modal();
    }

    $("#loginEntrar").submit(function () {
        iniciarSesion($scope);
    });

    $scope.loginEntrar = function () {
        iniciarSesion($scope);
    }

    $("#registrar").submit(function () {
        iniciarSesion($scope);
    });

    $scope.registrar = function () {
        registroUsuario($scope);
    }

    $scope.limpiar = function () {
        limpiar($scope);
    }
}

function iniciarSesion($scope) {
    if ($scope.aDato.usuario == null || $scope.aDato.usuario == '') {
        alert("Nombre de usuario vacío");
        return;
    }

    if ($scope.aDato.password == null || $scope.aDato.password == '') {
        alert("Password vacío");
        return;
    }

    $scope.aDato.push({'usuario': $scope.aDato.usuario, 'password': $scope.aDato.password});

    var dataString = JSON.stringify($scope.aDato);

    $.ajax({
        url: "vista/LoginController.php",
        data: {'login': dataString},
        type: 'POST',
        success: function (respuesta) {
            var json = JSON.parse(respuesta);
            var estado = json.estado;

            if (estado == 'ok') {
                window.setTimeout("window.location.href = 'vista/list_cliente.php'", 500);
            } else {
                limpiar($scope);
                alert("Usuario o contraseña incorrectos");
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function registroUsuario($scope) {
    if ($scope.aDato.nombreUsuario == null || $scope.aDato.nombreUsuario == '') {
        alert("Nombre de usuario vacío");
        return;
    }

    if ($scope.aDato.correo == null || $scope.aDato.correo == '') {
        alert("Correo vacío");
        return;
    }

    if ($scope.aDato.correoR == null || $scope.aDato.correoR == '') {
        alert("Correo vacío");
        return;
    }

    if ($scope.aDato.password1 == null || $scope.aDato.password1 == '') {
        alert("Contraseña vacía");
        return;
    }

    if ($scope.aDato.correo != $scope.aDato.correoR) {
        alert("Los correos no coinciden");
        return;
    }

    if ($scope.aDato.password1 != $scope.aDato.passwordR) {
        alert("Los correos no coinciden");
        return;
    }

    $scope.aDato.push({'nombreUsuario': $scope.aDato.nombreUsuario, 'correo': $scope.aDato.correo,
        'password': $scope.aDato.password1});

    var dataString = JSON.stringify($scope.aDato);

    $.ajax({
        url: "vista/RegistroUsuarioController.php",
        data: {'registro': dataString},
        type: 'POST',
        success: function (respuesta) {
            var json = JSON.parse(respuesta);
            var estado = json.estado;

            if (estado == 'ok') {
                $("#modalregistro").modal('hide');
                limpiar($scope);
                $("#modallogin").modal();
            } else {
                limpiar($scope);
                alert("No se pudo realizar el registro");
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function limpiar($scope) {
    $scope.aDato = new Array();
    $("#usuario").val("");
    $("#password").val("");
    $("#nombreUsuario").val("");
    $("#correo").val("");
    $("#correoR").val("");
    $("#password1").val("");
    $("#passwordR").val("");
}

