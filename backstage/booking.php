<?php

class Booking{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function getbookingno($type){
		$select = $this->db->select_one('select max(booking_no) as newnumber from booking where status=1 limit 1' );
		$newnumber = !empty($select['newnumber']) ? $select['newnumber'] : 0;
		jdie(str_pad($newnumber+1,10,"0",STR_PAD_LEFT));
	}

	public function getvehicle(){
		$select = $this->db->select('select `type` from `vehicle`' );
		jdie($select);	
	}
	public function getbookingdetails($id=''){

		$sql = "select id, 
			LPAD(`booking_no`, 10, '0') as booking_no,
			customer_id,
			customer_name,
			contact_person,
			department,
			contact_id,
			address,
			area,
			mode_of_shipping,
			vehicle_type,
			driver,
			driver_id,
			plate_no,
			booking_status,
			time_called,
			special_instruction,
			date_ready,
			document,
			weight,
			length,
			width,
			height,
			transaction_type,
			contact,
			vehicle,
			created_date
		 from `booking` where id=$id";
		$select = $this->db->select_one($sql);
		$select['booking_date'] =get_date($select['date_ready']);
		$select['date_ready'] = date('m/d/Y h:i A', strtotime($select['date_ready']));
		$select['time_called'] = date('h:i A', strtotime($select['time_called']));
		
		$sql2 = "select * from inventory where booking_id=$id";
		$select['inventory'] = json_encode($this->db->select($sql2)['data']);
		jdie($select);	
	}
	public function getcontacts($costumer_id=''){
		$select['area'] = $this->db->select_one('select area_1, area_2, area_3, area_4, area_5  from customer_information where id='.$costumer_id  );
		$select['contact'] = $this->db->select('select id, department, concat(`last_name`, \', \', `first_name`,\' \', `middle_initial`) as name from customer_contact where customer_id='.$costumer_id  )['data'];
		jdie($select);
	}

	public function update($id){
		$data = $_POST['d'];
		$data['date_ready'] = date('Y-m-d G:i:s', strtotime($data['date_ready']));
		$data['time_called'] = date('G:i:s', strtotime($data['time_called']));
		$data['contact'] = json_encode($this->db->select_one('select * from customer_contact where id='.$data['contact_id'].' limit 1' ));
		$data['vehicle'] = json_encode($_POST['v']);


		if($this->db->update("booking",$data, "id=$id")){
			$return['status'] = 200;
			$this->db->delete("inventory", "booking_id=$id");
			foreach($_POST['i'] as $i){
				$i['booking_id'] = $id;
				$this->db->insert("inventory",$i);
			}
		}
		jdie($return);
	}

	public function delete($id){

		if($this->db->delete("booking", "id=$id")){
			$return['status'] = 200;
		}
		jdie($return);
	}

	public function save(){
		$data = $_POST['d'];
		$data['date_ready'] = date('Y-m-d G:i:s', strtotime($data['date_ready']));
		$data['time_called'] = date('G:i:s', strtotime($data['time_called']));
		$data['contact'] = json_encode($this->db->select_one('select * from customer_contact where id='.$data['contact_id'].' limit 1' ));
		$data['vehicle'] = json_encode($_POST['v']);

		if($this->db->insert("booking",$data)){
			$created_id = $this->db->insert_id();
			foreach($_POST['i'] as $i){
				$i['booking_id'] = $created_id;
				$this->db->insert("inventory",$i);
			}

			$return['status'] = 200;
		}
		jdie($return);
	}

	public function bookinglist($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";		
		
		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		if(!empty($searchdata)){

			$this->db->where_like(['LPAD(`booking_no`, 10, \'0\')'=>$searchdata['booking_no']]);
			$this->db->where_like(['contact_person'=>$searchdata['contact_person']]);
			$this->db->where_like(['customer_name'=>$searchdata['customer_name']]);
			$this->db->where_search(['mode_of_shipping'=>$searchdata['mode_of_shipping']]);
			$this->db->where_search(['booking_status'=>$searchdata['booking_status']]);

			$datefrom = !empty($searchdata['date_from']) ? date('Y-m-d', strtotime($searchdata['date_from'])).' 00:00:00' : '';
			$dateto = !empty($searchdata['date_to']) ? date('Y-m-d', strtotime($searchdata['date_to'])).' 00:00:00' : '';

			$this->db->where_search(['created_date>'=>$datefrom]);
			$this->db->where_search(['created_date<'=>$dateto]);

		}
		
		$where = $this->db->where_search(['status'=>1]);

		$sql = "select id, LPAD(`booking_no`, 10, '0') as booking_no, customer_name, DATE_FORMAT(`created_date`,'%m/%d/%Y') as booking_date, area, mode_of_shipping, contact_person, booking_status from  booking $where $additional";
		$data = $this->db->select($sql);
		$datatotal = $this->db->select_one("select count(id) as total from booking $where limit 1" )['total'];
		$data['pagination'] = $this->db->pagination($page, $datatotal, $limit);
		jdie($data);




	}





	
}






?>