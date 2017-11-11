<html>
    <head>
        <script src="js/angular.js"></script>
        <script src="js/angular-animate.js"></script>
        <script src="js/angular-sanitize.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/locale-id.js"></script>
        <script src="js/currency.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body ng-app="myApp" ng-controller="karyawanCtrl" style="padding-bottom: 60px;">
        <nav class="navbar navbar-default">
            <a class="navbar-brand" href=".">Home</a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./manage.php">Manage</a></li>
                </ul>
            </div>
        </nav>


        <div class="container fluid">
            <h4>List Karyawan</h4>
            <div class="col-xs-12" ng-repeat="kar in karyawan" style="background-color: rgba(86,61,124,.15); margin-bottom:5px; padding:5px;">
                <div class="col-xs-3">
                    {{kar.NIK}}
                </div>
                <div class="col-xs-3">
                    {{kar.nama}}
                </div>
                <div class="col-xs-2">
                    {{kar.jabatan}}
                </div>
                <div class="col-xs-2">
                    <a href="#" class=" btn btn-warning a-btn-slide-text">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span><strong>Edit</strong></span>            
                    </a>
                </div>
                <div class="col-xs-2">
                    <a href="#" class=" btn btn-danger a-btn-slide-text">
                       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span><strong>Delete</strong></span>            
                    </a>
                </div>
            </div>

            <a href="#" class="btn btn-primary a-btn-slide-text pull-right">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><strong>Add</strong></span>            
            </a>
        </div>
    </body>
    <script>
        var app = angular.module('myApp', ['ui.bootstrap','ng-currency','ngLocale']);
        app.controller('karyawanCtrl', ['$scope','$http','$locale', function($scope, $http,$locale) {
            $scope.karyawan = [];
            $http.get("controller/karyawan.php?f=all")
            .then(function (response) {
                for(var i in response.data){
                    var kar = JSON.parse(response.data[i]);
                    kar.gaji= kar.gaji==null?0:Number(kar.gaji);
                    kar.tunjangan= kar.tunjangan==null?0:Number(kar.tunjangan);
                    kar.bonus= kar.bonus==null?0:Number(kar.bonus);
                    kar.pph21= kar.pph21==null?0:Number(kar.pph21);
                    kar.asuransi= kar.asuransi==null?0:Number(kar.asuransi);
                    $scope.karyawan.push(kar);
                }
                console.log($scope.karyawan);
            });

        }]);
    </script>
</html>