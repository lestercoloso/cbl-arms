<?php
$config['type_of_shipment']  = $db->getconfig('type_of_shipment');
$config['storage_type'] 	 = $db->getconfig('storage_type');
$config['subinventory_type'] = $db->getconfig('sub_inventory_type');
$config['pullouttype'] 		 = $db->getconfig('pullout_shipment');
$config['unit_of_measurement']  = $db->getconfig('unit_of_measurement');

$config['inbound_status'] = [1=>'For Posting', 2=>'Posted', 3=>'Acknowledged by CBL', 4=>'Received by CBL', 5=>'Cancelled'];
$config['cbl_status'] = [1=>'New Booking', 2=>'Acknowledged', 3=>'Received', 4=>'Cancelled'];


$config['pullout'] = [ 
								['type' 			=> 'select',
								'label'				=> 'Pull-out Shipment',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pullout_select',
								'col'				=> 'pullout_type',
								'form_class'		=> 'form-control',
								'options' 			=> array_merge([''=>'Please Select'],$config['pullouttype'])
								],

								['type' 			=> 'number',
								'label'				=> 'Quantity',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pullout_quantity',
								'col'				=> 'qty',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Input Quantity'],

								['type' 		=> 'input',
								'label'				=> 'Location Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pullout_location',
								'col'				=> 'location',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Input Location name']

					]; 

$config['add_shipment'][] = [
								0 => ['type' 		=> 'select',
								'label'				=> 'Bill of Lading',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'addnew_billoflading',
								'col'				=> 'bill_of_lading',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Input Bill of lading'],
								
								1=>['type' 			=> 'normal',
								'label'				=> 'Customer Name',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'shipment_customer_name',
								'col'				=> 'customer_name'
								],

								2 => ['type' 		=> 'input',
								'label'				=> 'Delivery Receipt',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'delivery_receipt_shipment',
								'col'				=> 'delivery_receipt',
								'form_class'		=> 'form-control not_mandatory',
								// 'placeholder' 		=> 'Input Delivery receipt'
								],

								3 => ['type' 		=> 'number',
								'label'				=> 'Invoice number',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								// 'placeholder' 		=> 'Input Invoice number'
								],

								4 => ['type' 		=> 'number',
								'label'				=> 'Pallet Code',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pallet_code_shipment',
								'col'				=> 'pallet_code',
								'form_class'		=> 'form-control',
								// 'placeholder' 		=> 'Auto-generated'
								],

								5 => ['type' 		=> 'normal',
								'label'				=> 'Quantity',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Input number']
							];

	$config['add_shipment'][] = [
								
								0 => ['type' 		=> 'input',
								'label'				=> 'Description',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'description_shipment',
								'col'				=> 'description',
								'form_class'		=> 'form-control'],

								1 => ['type' 		=> 'select',
								'label'				=> 'Type of Shipment',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'typeofshipment',
								'col'				=> 'type_of_shipment',
								'form_class'		=> 'form-control',
								'options' 			=> array_merge([''=>'Please Select'], $config['type_of_shipment'])
								],
							
								2 => ['type' 		=> 'select',
								'label'				=> 'Storage',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'addshipment_storage',
								'col'				=> 'storage',
								'form_class'		=> 'form-control',
								'options' 			=> ['rack'=>'Rack', 'bay'=>'Bay']
								],

								3 => ['type' 		=> 'select',
								'label'				=> 'Rack Code',
								'parent_class' 		=> 'form-group col-sm-12 addshipment_rack addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'rack_code',
								'col'				=> 'code',
								'form_class'		=> 'form-control',
								'placeholder'		=> 'Input rack code'
								],

								4 => ['type' 		=> 'select',
								'label'				=> 'Bay Code',
								'parent_class' 		=> 'form-group addshipment_bay col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'bay_code',
								'col'				=> 'code',
								'form_class'		=> 'form-control',
								'placeholder'		=> 'Input bay code'
								],

								5 => ['type' 		=> 'select',
								'label'				=> 'Rack Level',
								'parent_class' 		=> 'form-group addshipment_rack col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'rack_level',
								'col'				=> 'rack_level',
								'form_class'		=> 'form-control'
								],		

								6 => ['type' 		=> 'select',
								'label'				=> 'Storage type',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'storage_type_shipment',
								'col'				=> 'storage_type',
								'form_class'		=> 'form-control',
								'options' 			=> array_merge([''=>'Please Select'], $config['storage_type'])
								],	
							];

		$config['add_shipment'][] = [
								['type' 		=> 'select',
								'label'				=> 'Sub-Inv Location type',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'subinventorylocation_type',
								'col'				=> 'inventory_type',
								'form_class'		=> 'form-control',
								'options' 			=> array_merge([''=>'Please Select'], $config['subinventory_type'])
								],

								['type' 		=> 'input',
								'label'				=> 'Location',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'location_shipment',
								'col'				=> 'location',
								'form_class'		=> 'form-control'],

								['type' 		=> 'date',
								'label'				=> 'Expiration Date',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'ex_date',
								'col'				=> 'ex_date',
								'form_class'		=> 'form-control'],

								 ['type' 		=> 'date',
								'label'				=> 'Entry Date',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'en_date',
								'col'				=> 'en_date',
								'form_class'		=> 'form-control'],

								['type' 		=> 'date',
								'label'				=> 'Pickup Date',
								'parent_class' 		=> 'form-group col-sm-12 addship',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pu_date',
								'col'				=> 'pu_date',
								'form_class'		=> 'form-control not_mandatory'],
							];		



	$config['inventory'][] = [
								['type' 		=> 'normal',
								'label'				=> 'Inbound Ref No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_inbound_no',
								'col'				=> 'inbound_no',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Estimated Date/<br>Time of Arrival',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_estimated_arrival',
								'col'				=> 'estimated_arrival',
								'form_class'		=> 'form-control'],
							];		

$config['inventory'][] = [
								['type' 		=> 'normal',
								'label'				=> 'Request Date',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_request_date',
								'col'				=> 'request_date',
								'form_class'		=> 'form-control'
								],
								['type' 		=> 'normal',
								'label'				=> 'Booked by',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_booked_by',
								'col'				=> 'booked_by',
								'form_class'		=> 'form-control'
								]
							];	

	$config['outbound_inventory'][] = [
								['type' 		=> 'normal',
								'label'				=> 'Outbound Ref No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_outbound_no',
								'col'				=> 'outbound_no',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Estimated Date/<br>Time of Arrival',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_estimated_arrival',
								'col'				=> 'estimated_arrival',
								'form_class'		=> 'form-control'],
							];		

$config['outbound_inventory'][] = [
								['type' 		=> 'input',
								'label'				=> 'Shipped to',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_shipped_to',
								'col'				=> 'shipped_to',
								'form_class'		=> 'form-control'
								],
								['type' 		=> 'normal',
								'label'				=> 'Request Date',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_request_date',
								'col'				=> 'request_date',
								'form_class'		=> 'form-control'
								],
								['type' 		=> 'normal',
								'label'				=> 'Booked by',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'inventory_booked_by',
								'col'				=> 'booked_by',
								'form_class'		=> 'form-control'
								]
							];	


?>