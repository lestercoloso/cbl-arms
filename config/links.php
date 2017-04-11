

<?php


$config['links'] = [
					'User Administration' => ['link'=>'user_admin'],
					'Maintenance' => ['link'=>'',
						'options' => [
								'General Settings'=>'genSetting',
								'Driver Information'=>'driverProfile', 
								'Vehicle Information'=> 'vehicle',
								'Location Management'=> '',
								'Item Master File'=> 'item_master_file' 
								]
					],

					'Customer Information' => ['link'=>'customer_information'],
					'Booking' => ['link'=>'booking'],					
					'Bill of Lading' => ['link'=>'bill_of_lading'],					
					'Billing' => ['link'=>''],
					'Collection Call Out' => ['link'=>''],
					'Payment' => ['link'=>''],
					'Warehouse' => ['link'=>'warehouse',
						'options' => [
								'Warehouse'=>'warehouse',
								'Inbound'=>'inbound', 
								'Outbound'=> 'outbound'
								]
					],
					'Report' => ['link'=>''],
					];

$config['right_links']	= 	[
								'Inbound' 	=> ['link'=>'inbound'],
								'IRR' 		=> ['link'=>'irr'],
								'Put Away' 	=> ['link'=>'putaway'],
								'Outbound' 	=> ['link'=>'outbound'],
								'Pick List' => ['link'=>'picklist'],
								'Gate Pass' => ['link'=>'gatepass'],
						
							];			

$config['myaccount'] = 		[	
								['type' 			=> 'input',
								'label'				=> 'First Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'fname',
								'id'				=> 'myaccount_first_name',
								'value'				=> 'hello'
								],
								['type' 			=> 'input',
								'label'				=> 'Middle Initial',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'col'				=> 'mname',
								'id'				=> 'myaccount_middle_name',
								],
								['type' 			=> 'input',
								'label'				=> 'Last Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'lname',
								'id'				=> 'myaccount_last_name',
								],
								
								['type' 			=> 'input',
								'label'				=> 'Mobile Number',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'mobile',
								'id'				=> 'myaccount_mobile_no',
								],
								
								['type' 			=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'email',
								'id'				=> 'myaccount_email',
								]
					];

$config['mypassword'] = [	
								[
									'type' 				=> 'password',
									'label'				=> 'Current Password',
									'parent_class' 		=> 'form-group col-sm-12',
									'subparent_class' 	=> 'col-sm-8',
									'form_class'		=> 'form-control',
									'col'				=> 'password',
									'id'				=> 'myaccount_mypassword'
								],
								[
									'type' 				=> 'password',
									'label'				=> 'New <br>Password',
									'parent_class' 		=> 'form-group col-sm-12',
									'subparent_class' 	=> 'col-sm-8',
									'form_class'		=> 'form-control',
									'col'				=> 'npassword',
									'id'				=> 'myaccount_mypassword_np'
								],
								[
									'type' 				=> 'password',
									'label'				=> 'Confirm New Password',
									'parent_class' 		=> 'form-group col-sm-12',
									'subparent_class' 	=> 'col-sm-8',
									'form_class'		=> 'form-control',
									'col'				=> 'cnpassword',
									'id'				=> 'myaccount_mypassword_cnp'
								],
								
						];

?>