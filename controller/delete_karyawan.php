<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['NIK'])){
		include "config.php";
		$conn = connect_database();
		$sql = "DELETE FROM karyawan WHERE NIK = '$_POST[NIK]'";
		if (mysqli_query($conn,$sql) === TRUE) {
			$conn->close();
			header("Location: ../manage.php");
			exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
			$conn->close();
		}
	}
}

?>