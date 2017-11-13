<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
}
else{
    header("Location: ./manage.php");
}

?>

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
    <body style="padding-bottom: 60px;">
        <nav class="navbar navbar-default">
            <a class="navbar-brand" href=".">Home</a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="./manage.php">Manage</a></li>
                    <li class="active"><a href="./edit.php">Edit</a></li>
                </ul>
            </div>
        </nav>

        <div class="container fluid">
            <h4>Edit Karyawan</h4>
            <form action="controller/edit_karyawan.php" method="post">
            <input type="hidden" class="form-control" name="NIK" id="NIK" value="<?php echo $_POST['NIK']?>" required></input>
            <div class="col-xs-6 form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $_POST['nama']?>" required>
            </div>
            <div class="col-xs-6 form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $_POST['jabatan']?>" required>
            </div>
            <div class="col-xs-6 form-group">
                <label for="gaji">Gaji Pokok</label>
                <input type="number" class="form-control" name="gaji" id="gaji" value="<?php echo $_POST['gaji']?>" required>
            </div>
            <input type="hidden" name="bonus" value=0>
            <input type="hidden" name="tunjangan" value=0>
            <input type="hidden" name="pph21" value=0>
            <input type="hidden" name="asuransi" value=0>
            <div class="col-xs-12">
            <hr>
            </div>
            <button class="btn btn-warning a-btn-slide-text pull-right">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Edit</strong></span>            
            </button>
            </form>
        </div>
    </body>
</html>