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
            <h4>Form Gaji Karyawan</h4>
            <span>Cari berdasarkan nama : </span>
            <input type="text" ng-model="selected" uib-typeahead="karyawan as karyawan.nama for karyawan in karyawan | filter:$viewValue | limitTo:8" class="form-control" required>
            <hr>
            <form action="pdf/print.php" method="post" target="_blank">
                <pre ng-model="selected.nama" ng-change="calculate()">Nama: {{selected.nama | json}}</pre><input type="hidden" name="nama" value="{{selected.nama}}">
                <pre>Jabatan : {{selected.jabatan | json}}</pre><input type="hidden" name="jabatan" value="{{selected.jabatan}}">
                <input type="hidden" name="NIK" value="{{selected.NIK}}">
                <div class="col-xs-12 row">
                    <div class="col-xs-12 row">
                        <pre>Periode : <input type="text" name="periode" required/></pre>
                    </div>
                    <div class="col-xs-6 row">
                        <pre>Gaji : <input type="text" name="gaji" ng-model="selected.gaji" ng-change="calculate()" ng-currency required/></pre>
                    </div>
                    <div class="col-xs-6">
                        <pre>Asuransi : <input type="text" name="asuransi" ng-model="selected.asuransi" ng-change="calculate()" ng-currency required/></pre>
                    </div>
                    <div class="col-xs-6 row">
                        <pre>Tunjangan : <input type="text" name="tunjangan" ng-model="selected.tunjangan" ng-change="calculate()" ng-currency required/></pre>
                    </div>
                    <div class="col-xs-6">
                        <pre>Bonus : <input type="text" name="bonus" ng-model="selected.bonus" ng-change="calculate()" ng-currency required/></pre>
                    </div>
                    <div class="col-xs-6 row">
                        <pre>Pph21 : <input type="text" name="pph21" ng-model="selected.pph21" ng-change="calculate()" ng-currency required/></pre>
                    </div>
                    <div class="col-xs-6">
                        <div class="btn btn-success pull-right" ng-click="calculate()" style="margin-top: 20px;">
                            Calculate Total
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 row">
                    <hr>
                </div>
                <div class="col-xs-12 row">
                    <pre>Total A : {{totalA | currency}}</pre><input type="hidden" name="totalA" value="{{totalA | currency}}">
                    <pre>Total B : {{totalB | currency}}</pre><input type="hidden" name="totalB" value="{{totalB | currency}}">
                    <pre>Penerimaan Bersih : {{totalAll | currency}}</pre><input type="hidden" name="totalAll" value="{{totalAll | currency}}">
                    
                </div>
                <div class="col-xs-12 row">
                    <hr>
                </div>
                <div class="col-xs-12 row">
                    <div class="col-xs-12 row">
                        <span>Disetujui Oleh : </span>
                    </div>
                    <div class="col-xs-6 row">
                        <pre>Nama : <input type="text" name="penyetuju" value="Lusia Herliny" required/></pre>
                    </div>
                    <div class="col-xs-6">
                        <pre>Jabatan : <input type="text" name="jabatan_penyetuju" value="Direktur" required/></pre>
                    </div>
                    <div class="col-xs-6 row">
                        <pre>Kota : <input type="text" name="kota" value="Ruteng" required/></pre>
                    </div>
                    <div class="col-xs-6">
                        <pre>Tanggal : <input type="text" name="tanggal" value="{{now}}" required/></pre>
                    </div>
                </div>
                <div class="col-xs-12 row">
                    <hr>
                </div>
                <div class="col-xs-12 row">
                    <input class="btn btn-primary pull-right" ng-click="calculate()" type="submit"></button>
                </div>
            </form>
        </div>
    </body>
    <script>
        var app = angular.module('myApp', ['ui.bootstrap','ng-currency','ngLocale']);
        app.controller('karyawanCtrl', ['$scope','$http','$locale', function($scope, $http,$locale) {
            $scope.selected = undefined;
            $scope.totalA = 0;
            $scope.totalB = 0;
            $scope.totalAll = 0;
            var date = new Date();
            var datetime = $locale.DATETIME_FORMATS; //get date and time formats 
            var months = datetime.MONTH; //access localized months
            $scope.now = date.getDate() + " " +  months[date.getMonth()] + " " + date.getFullYear();     
            
            $scope.calculate = function(){
                if($scope.selected != undefined){
                    $scope.totalA = Number($scope.selected.gaji) + Number($scope.selected.tunjangan) + Number($scope.selected.bonus);
                    $scope.totalB = Number($scope.selected.asuransi) + Number($scope.selected.pph21);
                    $scope.totalAll= Number($scope.totalA) - Number($scope.totalB);
                }
            }

            $http.get("controller/karyawan.php?f=all")
            .then(function (response) {
                $scope.karyawan = [];
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