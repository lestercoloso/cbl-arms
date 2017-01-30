<?php

class Inbound{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function billoflading(){
		$select = $this->db->select_one('select max(bill_of_lading) as bill_of_lading from inbound_list limit 1' );
		$bill_of_lading = !empty($select['bill_of_lading']) ? $select['bill_of_lading'] : 0;
		jdie(str_pad($bill_of_lading+1,10,"0",STR_PAD_LEFT));
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

	public function getcode($type){
		$additional = '';
		if($type=='rack'){
			$additional = ", no_rack_level";
		}

		$select = $this->db->select("select LPAD(`code`, 10, '0') as code $additional from ".$type."_storage where status=1");
		jdie($select);
	}

	public function customer(){
		$select = $this->db->select("select id, customer_name from customer_information where status=1");
		jdie($select);
	}

	
}

?>