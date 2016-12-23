<?php
error_reporting("E_ALL");
error_reporting( E_ERROR );
ini_set( 'display_errors' , 'On' );

require_once('db_connect.php');


class Cusinfo extends Database{
	
	
	public function getPages(){
		$mysqli = $this->getConnection();
		$query = "SELECT * FROM `homepage` ORDER BY `sel_id` ASC";
		$result = $mysqli->query($query);
		$data_array=array();
		$cnt = 0;
			while ($row=$result->fetch_assoc()) {

				$data_array[$cnt]['SelName'] = $row['sel_name'];
				$data_array[$cnt]['Selpage'] = $row['wpage'];

				$cnt++;
			}

			return $data_array;

	}
}



$info = new Cusinfo();

echo json_encode($info->getPages());


?>