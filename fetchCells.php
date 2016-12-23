<?php

	
require_once('db_connect.php');
		


class fetchCell extends Database{


	public function getCell(){


			$mysqli = $this->getConnection(); 
			$sql = "SELECT * FROM homepage ORDER BY sel_id ASC";
			$result = $mysqli->query($sql);
			$data_array=array();
			$cnt = 0;
			while ($row=$result->fetch_assoc()) {
				/*$data_array[$cnt][$row['sel_id']] = $row['sel_name'];
				$data_array[$cnt][$row['sel_id']] = $row['sel_type'];*/

				$data_array[$cnt]['SelName'] = $row['sel_name'];
				$data_array[$cnt]['SelType'] = $row['sel_type'];
				$data_array[$cnt]['Selimg'] = $row['img_file'];

				$cnt++;
			}

			return $data_array;


	}




}


$cell = new fetchCell();

echo json_encode($cell->getCell());

			


			

?>