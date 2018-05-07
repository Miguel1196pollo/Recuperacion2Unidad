angular.module('postLogin', [])
    .controller('PostController', ['$scope', '$http', function($scope, $http) { 
            this.postForm = function() {
                var encodedString = '&email=' +
                    encodeURIComponent(this.inputData.username) +
                    '&password=' +
                    encodeURIComponent(this.inputData.password);
 
                $http({
                    method: 'POST',
                    url: 'login.php',
                    data: encodedString,
                    //headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                
                .success(function(data) {
                        //console.log(data);
                        if ( data.trim() === 'correct') {
                            window.location.href = 'crear_cliente.php';
                        } else {
                            $scope.errorMsg = "Usuario no registrado, verifique sus datos.";
                        }
                }) 
            }
    }]);
 