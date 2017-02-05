<?php

class Inbound{

	public function __construct(){
		$this->db = $GLOBALS['db'];

	}

	public function billoflading(){
		$sql = "select LPAD(`bill_no`, 8, '0') as lading_number, 
				(select `customer_name` from customer_information where id=a.client_id) as customer_name 
				from bill_of_lading a where bill_no!=0 and bill_no not in (select bill_of_lading from inbound_list where status=1)";

		$select = $this->db->select($sql);
		jdie($select);
	}

	public function getInbound($page=1){
		$limit = 5;
		$start = ($page - 1) * $limit; //first item to display on this page
		$additional = "limit $start, $limit";

		$searchdata = (!empty($_POST['searchdata'])) ? json_decode($_POST['searchdata'], TRUE) : [];
		
	 	$searchdata['ex_date'] = (!empty($searchdata['ex_date'])) ? date('Y-m-d', strtotime($searchdata['ex_date'])) :'';
	    $searchdata['en_date'] = (!empty($searchdata['en_date'])) ? date('Y-m-d', strtotime($searchdata['en_date'])) :'';
	    $searchdata['pu_date'] = (!empty($searchdata['pu_date'])) ? date('Y-m-d', strtotime($searchdata['pu_date'])) :'';

	

	$this->db->where_search(['status'=>1]);
	$where = $this->db->where_search($searchdata);
	
		$sql = "select id,
			(select `customer_name` from customer_information where id IN (select client_id from bill_of_lading where bill_no=a.bill_of_lading)) as customer_name, 
			LPAD(`bill_of_lading`, 8, '0') as bill_of_lading, 
			delivery_receipt, 
			pallet_code, 
			quantity, 
			description, 
			IF(`storage_type`=1,'Ambiant Storage','Cool Storage') as storage_type,
			inventory_type, 
			DATE_FORMAT(`ex_date`,'%y-%m-%d') as ex_date,
			DATE_FORMAT(`en_date`,'%y-%m-%d') as en_date,
			DATE_FORMAT(`pu_date`,'%y-%m-%d') as pu_date
			from inbound_list a $where $additional";

		$data = $this->db->select($sql);

		$datatotal = $this->db->select_one("select count(id) as total from inbound_list a where status=1 limit 1" )['total'];
		$data['pagination'] = $this->pagination($page, $datatotal, $limit);
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

	public function save(){

		$data = json_decode($_POST['d'], TRUE);
		$data['bill_of_lading'] = (int) $data['bill_of_lading'];
		$data['ex_date'] = date('Y-m-d', strtotime($data['ex_date']));
		$data['en_date'] = date('Y-m-d', strtotime($data['en_date']));
		$data['pu_date'] = date('Y-m-d', strtotime($data['pu_date']));


		$return['status'] = 100;
		if($this->db->insert("inbound_list",$data)){
			$return['status'] = 200;
		}
		jdie($return);


	}

	public function delete($inboundid=''){
		$inboundid = explode('-', $inboundid);
		$id = $inboundid[1];
		$data['status'] = 100;
		if($this->db->CheckResult("delete from inbound_list where id=$id" )){
			$data['status'] = 200;
		}
		jdie($data);
	}

	public function edit($inboundid=''){
		$inboundid = explode('-', $inboundid);
		$id = $inboundid[1];
		$data = $this->db->select_one("select * from inbound_list a where status=1 and id=$id limit 1" );
		jdie($data);
	}


	public function pagination($page=1, $total=0, $limit=5){

			//PAGINATION//
			$counter = 1;
			$adjacents = 1;
			$targetpage = $_SERVER['PHP_SELF']; //your file name

			/* Setup page vars for display. */
			    if ($page == 0) $page = 1; //if no page var is given, default to 1.
			    $prev = $page - 1; //previous page is current page - 1
			    $next = $page + 1; //next page is current page + 1
			    $lastpage = ceil($total/$limit); //lastpage.
			    $lpm1 = $lastpage - 1; //last page minus 1

			/* CREATE THE PAGINATION */

			$pagination = "";
			if($lastpage > 1)
			{ 
			    $pagination .= "<ul class='pagination'>";
			    if ($page > $counter+1) {
			        $pagination.= "<li><span class='pagenumber' data-page='$prev'>&laquo;</span></li>"; 
			    }

			    if ($lastpage < 7 + ($adjacents * 2)) 
			    { 
			        for ($counter = 1; $counter <= $lastpage; $counter++)
			        {
			            if ($counter == $page)
			                $pagination.= "<li class='active'><span>$counter</span></li>";
			            else
			                $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</span></li>"; 
			        }
			    }
			    elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
			    {
			        //close to beginning; only hide later pages
			        if($page < 1 + ($adjacents * 2)) 
			        {
			            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
			            {
			                if ($counter == $page)
			                    $pagination.= "<li class='active'><span>$counter</span></li>";
			                else
			                    $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</span></li>"; 
			            }
			            $pagination.= "<li><span>...</span></li>";
			            $pagination.= "<li><span class='pagenumber' data-page='$1pm1'>$lpm1</span></li>";
			            $pagination.= "<li><span class='pagenumber' data-page='$lastpage'>$lastpage</span></li>"; 
			        }
			        //in middle; hide some front and some back
			        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			        {
			            $pagination.= "<li><span class='pagenumber' data-page='1'>1</span></li>";//here
			            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
			            {
			                if ($counter == $page)
			                    $pagination.= "<li class='active'><span>$counter</span></li>";
			                else
			                    $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</span></li>"; 
			            }
			            $pagination.= "<li><span>...</span></li>";
			            $pagination.= "<li><span class='pagenumber'  data-page='$1pm1'>$lpm1</span></li>";
			            $pagination.= "<li><span class='pagenumber'  data-page='$lastpage'>$lastpage</span></li>"; 
			        }
			        //close to end; only hide early pages
			        else
			        {
			            $pagination.= "<li class='pagenumber' data-page='1'><span>1</span></li>";
			            $pagination.= "<li class='pagenumber' data-page='2'><span>2</span></li>";
			            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; 
			            $counter++)
			            {
			                if ($counter == $page)
			                    $pagination.= "<li class='active'><span>$counter</span></li>";
			                else
			                    $pagination.= "<li><span class='pagenumber' data-page='$counter'>$counter</spa></li>"; 
			            }
			        }
			    }

			    //next button
			    if ($page < $counter - 1) 
			        $pagination.= "<li><span class='pagenumber' data-page='$next'>&raquo;</span></li>";
			    else
			        $pagination.= "";
			    $pagination.= "</ul>\n"; 
			}

			return $pagination;


	}

	
}



	
		// $sql = "select a.id,
		// 	(select `customer_name` from customer_information where id=b.client_id) as customer_name, 
		// 	LPAD(a.`bill_of_lading`, 8, '0') as bill_of_lading, 
		// 	LPAD(a.`delivery_receipt`, 8, '0') as delivery_receipt, 
		// 	LPAD(a.`pallet_code`, 8, '0') as pallet_code, 
		// 	a.quantity, 
		// 	a.description, 
		// 	IF(a.`storage_type`=1,'Ambiant Storage','Cool Storage') as storage_type,
		// 	a.inventory_type, 
		// 	DATE_FORMAT(a.`ex_date`,'%y-%m-%d') as ex_date,
		// 	DATE_FORMAT(a.`en_date`,'%y-%m-%d') as en_date,
		// 	DATE_FORMAT(a.`pu_date`,'%y-%m-%d') as pu_date
		// 	from inbound_list a, bill_of_lading b $where $additional";


?>