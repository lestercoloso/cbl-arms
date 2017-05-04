<?php

class Warehouse{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getStorage(){


		$datas = $this->db->select('select LPAD(`code`, 10, \'0\') as code, id, no_rack_level, rack_length, rack_level_height, rack_width, style, block, no_rack_section, no_pallet_position, storage_type from rack_storage where status=1' );
		$return['rack'] = $datas['data'];

		$datas = $this->db->select('select LPAD(`code`, 10, \'0\') as code, bay_length, bay_width, id, style, block from bay_storage where status=1' );
		$return['bay'] = $datas['data'];

		jdie($return);
	}

	public function save(){

		$data = $_POST['d'];
		$data['storage'] = $_POST['t'];
		$_POST['p'] = !empty($_POST['p']) ? $_POST['p'] : [];
		if($this->db->insert("storage",$data)){
			$return['status'] = 200;
			$storage_id = $this->db->insert_id();
			$return['id'] = $storage_id;

			if($_POST['p']){
				$this->db->delete("pallet_position","storage_id=$storage_id");
				foreach ($_POST['p'] as $pval) {
					$pval['storage_id'] = $storage_id;
					$this->db->insert("pallet_position",$pval);
				}					
			}
		
		}
		jdie($return);
	}	

	public function getcode($type){
		$select = $this->db->select_one('select max(code) as newcode from storage where storage=\''.$type.'\' limit 1' );
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
		$data = $_POST['d'];
		$newdata = [];
		foreach ($data as $v) {
			$id = explode('-', $v['id']);
			$newdata[$id[0].'-'.$id[1]][$id[2]]['style'] = $v['style']; 
		}

		$return['status'] = 100;
		foreach($newdata as $key=>$d){
			$key = explode('-', $key);
			$style = json_encode($d);
			if($this->db->update('storage', ['style'=>$style], 'id='.$key[1])){
				$return['status'] = 200;
			}
		}


		jdie($return);

	}

	public function selectstorage($s, $st){

		$this->db->where_search(['location'=>$s]);
		$this->db->where_search(['storage_type'=>$st]);
		$where = $this->db->where_search(['status'=>1]);
		$sql = "select * from storage $where";
		$result = $this->db->select($sql);
		
		$this->db->whereclean();


		$this->db->where_search(['wh_storage'=>$s]);
		$where = $this->db->where_search(['storage_type'=>$st]);
		$sql2 = "select pallet_position_code, exp_date from inbound_shipment_list $where and inbound_id IN (select id from inbound_shipment where status=4)";
		$result2 = $this->db->select($sql2);
		$pallets = [];
		
		foreach ($result2['data'] as $value) {
			$pallets[strtoupper($value['pallet_position_code'])] = 'occupied';
		}
		$result['pallets'] = $pallets; 
		jdie($result);
	}

	public function getBoxes($code='', $type='', $level='', $wscale = 1, $scale = 1){
		$sql = "select b.weight, b.length, b.width, b.height, a.rack_level, (select COALESCE(a.quantity-sum(qty),a.quantity) from outbound_list where inbound_id=a.id) as qty from inbound_list a, booking b where a.bill_of_lading=b.booking_no and a.code=$code and a.storage='$type' and a.status=1";
		$data = $this->db->select($sql);
		$new_data = [];
		foreach($data['data'] as $d){
			for ($x = 1; $x <= $d['qty']; $x++) {
				$new_data['level'][$d['rack_level']][] = ['length' => (($d['length']*0.01)*$wscale)*$scale, 'width' => (($d['width']*0.01)*$wscale)*$scale, 'height' => (($d['height']*0.01)*$wscale)*$scale ];	
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