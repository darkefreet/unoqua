<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['NIK'])&&isset($_POST['nama'])&&isset($_POST['jabatan'])&&isset($_POST['gaji'])){
		include "config.php";
		$conn = connect_database();
		$sql = "UPDATE karyawan SET nama = '$_POST[nama]', jabatan = '$_POST[jabatan]', gaji = '$_POST[gaji]' WHERE NIK = '$_POST[NIK]'";
		if (mysqli_query($conn,$sql) === TRUE) {
			$conn->close();
			header("Location: ../manage.php");
			exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
			$conn->close();
		}
	}
	echo "Error";
}

?>