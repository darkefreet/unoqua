<html>
    <head>

        <script src="js/jquery-min.js"></script>
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
            <h4>Tambah Karyawan</h4>
            <form action="controller/add_karyawan.php" method="post">
            <div class="col-xs-6 form-group">
                <label for="NIK">NIK</label>
                <input type="text" class="form-control" name="NIK" id="NIK" placeholder="NIK" required>
            </div>
            <div class="col-xs-6 form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" required>
            </div>
            <div class="col-xs-6 form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" required>
            </div>
            <div class="col-xs-6 form-group">
                <label for="gaji">Gaji Pokok</label>
                <input type="number" class="form-control" name="gaji" id="gaji" value=0 required>
            </div>
            <input type="hidden" name="bonus" value=0>
            <input type="hidden" name="tunjangan" value=0>
            <input type="hidden" name="pph21" value=0>
            <input type="hidden" name="asuransi" value=0>

            <button class="btn btn-primary a-btn-slide-text pull-right">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><strong>Add</strong></span>            
            </button>
            </form>
        </div>

        <div class="container fluid">
            <h4>List Karyawan</h4>
            <div class="col-xs-12" ng-repeat="kar in karyawan" style="background-color: rgba(86,61,124,.15); margin-bottom:5px; padding:5px;">
                <div class="col-xs-1">
                    {{kar.NIK}}
                </div>
                <div class="col-xs-2">
                    {{kar.nama}}
                </div>
                <div class="col-xs-2">
                    {{kar.jabatan}}
                </div>
                <div class="col-xs-2">
                    {{kar.gaji}}
                </div>
                <div class="col-xs-1">
                    <form action="edit.php" method="post">
                        <input type="hidden" name="NIK" value="{{kar.NIK}}">
                        <input type="hidden" name="nama" value="{{kar.nama}}">
                        <input type="hidden" name="jabatan" value="{{kar.jabatan}}">
                        <input type="hidden" name="gaji" value="{{kar.gaji}}">
                        <button class=" btn btn-warning a-btn-slide-text">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            <span><strong>Edit</strong></span>            
                        </button>
                    </form>
                </div>
                <div class="col-xs-4">
                    <form action="controller/delete_karyawan.php" method="post">
                    <input type="hidden" name="NIK" value="{{kar.NIK}}">
                    <div class="col-xs-6 row">
                        <a class="btn btn-large btn-danger a-btn-slide-text" ng-click="confirm(kar.NIK)">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            <span><strong>Delete</strong></span>    
                        </a>
                    </div>
                    <div class="col-xs-6 row" ng-show="kar.NIK == active" style="font-size: 9px;">
                        <button class="col-xs-6 btn btn-success">Confirm</button>
                        <a class="col-xs-6 btn btn-default" ng-click="cancel(kar.NIK)">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>

            
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
            $scope.active = '';
            $scope.confirm = function(id){
                $scope.active=id;
                console.log($scope.active);
            }
            $scope.cancel = function(id){
                $scope.active='';
                console.log($scope.active);
            }
        }]);
    </script>
</html>