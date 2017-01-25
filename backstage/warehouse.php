<?php

class Warehouse{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getStorage(){


		$datas = $this->db->select('select * from rack_storage where status=1' );
		$return['rack'] = $datas['data'];

		$datas = $this->db->select('select * from bay_storage where status=1' );
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

	public function deleteStorage($del=''){
		$del = explode('-', $del);
		$data['status'] = $this->db->delete($del[0].'_storage','id='.$del[1] );
		jdie($data);
	}

	public function getInbound(){


		$data = $this->db->select("select 
			(select `customer_name` from customer_information where id=a.client_id) as customer_name, 
			LPAD(`bill_of_lading`, 8, '0') as bill_of_lading, 
			LPAD(`delivery_receipt`, 8, '0') as delivery_receipt, 
			LPAD(`pallet_code`, 8, '0') as pallet_code, 
			quantity, 
			description, 
			storage_type, 
			inventory_type, 
			DATE_FORMAT(`ex_date`,'%y-%m-%d') as ex_date,
			DATE_FORMAT(`en_date`,'%y-%m-%d') as en_date,
			DATE_FORMAT(`pu_date`,'%y-%m-%d') as pu_date
			from inbound_list a where status=1" );
		jdie($data);

	}


}

?>