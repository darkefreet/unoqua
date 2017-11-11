<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	function all(){
		include "config.php";
		$conn = connect_database();
	    $sql = "SELECT * FROM `karyawan`";
	    $results = mysqli_query($conn, $sql);
	    shutdown($conn);
	    $arr = [];
	    foreach ($results as $row) {
	    	array_push($arr,json_encode($row));
	    }
	    echo json_encode($arr);
	}

	function get($id){
		include "config.php";
		$conn = connect_database();
	    $sql = "SELECT * FROM `karyawan` WHERE `NIK` = $id LIMIT 1";
	    $results = mysqli_query($conn, $sql);
	    shutdown($conn);
	    $arr = [];
	    foreach ($results as $row) {
	    	array_push($arr,json_encode($row));
	    }
	    echo json_encode($arr);
	}


	$function = $_GET['f'];
	switch ($function) {
		case 'all':
			all();
			break;
		case 'get':
			get($_GET['id']);
			break;
		default:
			break;
	}
?>