<?php

class Warehouse{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getStorage(){


		$datas = $this->db->select('select LPAD(`code`, 10, \'0\') as code, id, no_rack_level, rack_length, rack_level_height, rack_width, style from rack_storage where status=1' );
		$return['rack'] = $datas['data'];

		$datas = $this->db->select('select LPAD(`code`, 10, \'0\') as code, bay_length, bay_width, id, style from bay_storage where status=1' );
		$return['bay'] = $datas['data'];

		jdie($return);
	}

	public function getcode($type){
		$select = $this->db->select_one('select max(code) as newcode from '.$type.'_storage limit 1' );
		$newcode = !empty($select['newcode']) ? $select['newcode'] : 0;
		jdie(str_pad($newcode+1,10,"0",STR_PAD_LEFT));
	}

	public function saveStorage($t){
		$data = json_decode($_POST['d'], TRUE);

		$return['status'] = 100;
		if($this->db->insert($t."_storage",$data)){
			$return['status'] = 200;
		}

		$datas = $this->db->select('select * from '.$t.'_storage where status=1' );
		$return['data'] = $datas['data'];
		jdie($return);

	}
	public function saveOrder(){
		$data = json_decode($_POST['d'], TRUE);
		// pdie($data);
		$return['status'] = 100;

		foreach($data as $key=>$d){
			$key = explode('-', $key);
			if($this->db->update($key[0].'_storage', ['style'=>$d], 'id='.$key[1])){
				$return['status'] = 200;
			}
		}


		jdie($return);

	}

	public function getBoxes($code='', $type='', $level=''){
		$sql = "select b.weight, b.length, b.width, b.height, a.rack_level, (select (a.quantity-sum(qty)) from outbound_list where inbound_id=a.id) as qty from inbound_list a, booking b where a.bill_of_lading=b.booking_no and a.code=$code and a.storage='$type'";
		$data = $this->db->select($sql);
		$new_data = [];
		foreach($data['data'] as $d){
			// $d['qty'] = 1;
			for ($x = 1; $x <= $d['qty']; $x++) {
				$new_data['level'][$d['rack_level']][] = ['length' => $d['length'], 'width' => $d['width'], 'height' => $d['height'] ];	
			} 

		}
		jdie($new_data);
	}

	public function deleteStorage($del=''){
		$del = explode('-', $del);
		$data['status'] = $this->db->delete($del[0].'_storage','id='.$del[1] );
		jdie($data);
	}




}

?>