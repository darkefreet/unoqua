<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['NIK'])&&isset($_POST['nama'])&&isset($_POST['gaji'])&&isset($_POST['tunjangan'])&&isset($_POST['bonus'])&&isset($_POST['pph21'])&&isset($_POST['asuransi'])){
		include "controller/config.php";
		$conn = connect_database();
		$sql = "INSERT INTO karyawan (NIK, nama, jabatan, gaji) VALUES ('$_POST[NIK]', '$_POST[nama]', '$_POST[jabatan]' , $_POST[gaji])";
		if (mysqli_query($conn,$sql) === TRUE) {
			$conn->close();
			header("Location: manage.php");
			exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
			$conn->close();
		}
	}
}

?>