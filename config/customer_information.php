<?php
$config['industry_type']  		= $db->getconfig('industry_type');
$config['address_type']  		= $db->getconfig('address_type');
$config['billing_format']  		= $db->getconfig('billing_format');
$config['tax_type']  			= $db->getconfig('tax_type');
$config['preferred_supplier']  	= $db->getconfig('preferred_supplier');
$config['customer_type']  		= $db->getconfig('customer_type');
$config['assistant_executive_1']  		= $db->getconfig('assistant_executive_1');
$config['assistant_executive_2']  		= $db->getconfig('assistant_executive_2');

$config['domestic_sea']  		= $db->getconfig('domestic_sea');
$config['domestic_air']  		= $db->getconfig('domestic_air');
$config['domestic_trucking']  	= $db->getconfig('domestic_trucking');

$config['international_sea']  		= $db->getconfig('international_sea');
$config['international_air']  		= $db->getconfig('international_air');
$config['international_trucking']  	= $db->getconfig('international_trucking');

$config['customer_status']  = ['1'=>'Active', '2'=>'Inactive'];
$config['create_customer'][] = [
								
								['type' 			=> 'normal',
								'label'				=> 'Customer Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'customer_code',
								'id'				=> 'create_customer_code',
								],
								
								['type' 			=> 'select',
								'label'				=> 'Customer Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'customer_type',
								'id'				=> 'create_customer_type',
								'options'			=> array_merge([''=>'Select Customer Type'],$config['customer_type'])
								],

								['type' 			=> 'input',
								'label'				=> 'Customer Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_customer_name',
								'col'				=> 'customer_name',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'date',
								'label'				=> 'Company Anniversary',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_company_anniversary',
								'col'				=> 'company_anniversary',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'input',
								'label'				=> 'Telephone No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_telephone_no',
								'col'				=> 'tel_no',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Fax No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_fax_no',
								'col'				=> 'fax_no',
								'form_class'		=> 'form-control'],

								['type' 			=> 'select',
								'label'				=> 'Industry Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_industry_type',
								'col'				=> 'industry_type',
								'options'			=> array_merge([''=>'Select Industry Type'],$config['industry_type']),						
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_address',
								'col'				=> 'address',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Tin No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_tin_no',
								'col'				=> 'tin_no',
								'form_class'		=> 'form-control'],

							];


$config['create_customer'][] = [
								
								['type' 			=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'city',
								'id'				=> 'create_city',
								],
								
								['type' 			=> 'select',
								'label'				=> 'Assistant Executive 1',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'id'				=> 'create_assistant_executive_1',
								'col'				=> 'assistant_executive_1',
								'options'			=> array_merge([''=>'Select Assistant Executive 1'],$config['assistant_executive_1']),								
								],

								['type' 			=> 'select',
								'label'				=> 'Assistant Executive 2',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'id'				=> 'create_assistant_executive_2',
								'options'			=> array_merge([''=>'Select Assistant Executive 2'],$config['assistant_executive_2']),								
								'col'				=> 'assistant_executive_2',
								],


								['type' 			=> 'input',
								'label'				=> 'Area 1',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area_1',
								'col'				=> 'area_1',
								'form_class'		=> 'form-control',
								'placeholder'		=> '',
								],

								['type' 			=> 'input',
								'label'				=> 'Area 2',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area_2',
								'col'				=> 'area_2',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder'		=> 'Optional',
								],

								['type' 			=> 'input',
								'label'				=> 'Area 3',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area_3',
								'col'				=> 'area_3',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder'		=> 'Optional',
								],

								['type' 			=> 'input',
								'label'				=> 'Area 4',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area_4',
								'col'				=> 'area_4',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder'		=> 'Optional',
								],

								['type' 			=> 'input',
								'label'				=> 'Area 5',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area_5',
								'col'				=> 'area_5',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder'		=> 'Optional',
								],

								['type' 			=> 'input',
								'label'				=> 'Region',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_region',
								'col'				=> 'region',
								'form_class'		=> 'form-control',
								]
						
							];

$config['create_customer'][] = [
								
								['type' 			=> 'select',
								'label'				=> 'Tax Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_tax_type',
								'col'				=> 'tax_type',
								'options'			=> array_merge([''=>'Select Tax Type'],$config['tax_type']),						
								'form_class'		=> 'form-control'],

								['type' 			=> 'input',
								'label'				=> 'Payment Terms',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_payment_terms',
								'col'				=> 'payment_terms',
								'form_class'		=> 'form-control'],


								['type' 			=> 'select',
								'label'				=> 'Preferred Supplier',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_preferred_supplier',
								'col'				=> 'preferred_supplier',
								'options'			=> array_merge([''=>'Select Preferred Supplier'],$config['preferred_supplier']),						
								'form_class'		=> 'form-control'],

								['type' 			=> 'input',
								'title'				=> 'Price List (Domestic Sea)',
								'label'				=> 'Price List (DS)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_pricelist_ds',
								'col'				=> 'pricelist_ds',
								'options'			=> array_merge([''=>'Select Price List (DS)'],$config['domestic_sea']),	
								'form_class'		=> 'form-control not_mandatory'],

								['type' 			=> 'input',
								'title'				=> 'Price List (Domestic Air)',
								'label'				=> 'Price List (DA)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_pricelist_da',
								'col'				=> 'pricelist_da',
								'options'			=> array_merge([''=>'Select Price List (DA)'],$config['domestic_air']),	
								'form_class'		=> 'form-control not_mandatory'],

								['type' 			=> 'input',
								'title'				=> 'Price List (Domestic Trucking)',
								'label'				=> 'Price List (DT)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_pricelist_dt',
								'col'				=> 'pricelist_dt',
								'options'			=> array_merge([''=>'Select Price List (DT)'],$config['domestic_trucking']),	
								'form_class'		=> 'form-control not_mandatory'],

								['type' 			=> 'input',
								'title'				=> 'Price List (International Sea)',
								'label'				=> 'Price List (IS)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_pricelist_is',
								'col'				=> 'pricelist_is',
								'options'			=> array_merge([''=>'Select Price List (IS)'],$config['international_sea']),
								'form_class'		=> 'form-control not_mandatory'],

								['type' 			=> 'input',
								'title'				=> 'Price List (International Air)',
								'label'				=> 'Price List (IA)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_pricelist_ia',
								'col'				=> 'pricelist_ia',
								'options'			=> array_merge([''=>'Select Price List (IA)'],$config['international_air']),	
								'form_class'		=> 'form-control not_mandatory'],

								['type' 			=> 'input',
								'title'				=> 'Price List (International Trucking)',
								'label'				=> 'Price List (IT)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_pricelist_it',
								'col'				=> 'pricelist_it',
								'options'			=> array_merge([''=>'Select Price List (IT)'],$config['international_trucking']),
								'form_class'		=> 'form-control not_mandatory'],

							];




$config['create_customer'][] = [
								
								['type' 			=> 'input',
								'label'				=> 'Follow Up Day',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'follow_up_day',
								'id'				=> 'create_follow_up_day',
								],
								['type' 			=> 'input',
								'label'				=> 'Collection Day',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'collection_day',
								'id'				=> 'create_collection_day',
								],
								['type' 			=> 'input',
								'label'				=> 'Billing Cycle',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'billing_cycle',
								'id'				=> 'create_billing_cycle',
								],
								['type' 			=> 'number',
								'label'				=> 'Credit Limit',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'credit_limit',
								'id'				=> 'create_credit_limit',
								],
								
								['type' 			=> 'select',
								'label'				=> 'Billing Format',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_billing_format',
								'col'				=> 'billing_format',
								'options'			=> array_merge([''=>'Select Billing Format'],$config['billing_format']),								
								],

								
								['type' 			=> 'normal',
								'label'				=> 'Status',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'id'				=> 'create_customer_status',
								],
						
								['type' 			=> 'normal',
								'label'				=> 'Outstanding Balance',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'id'				=> 'create_outstanding_balance',
								],

								['type' 			=> 'normal',
								'label'				=> 'Amount Due',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'id'				=> 'create_amount_due',
								],
						
							];



	$config['contact_person'] = [
								['type' 			=> 'input',
								'label'				=> 'First Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_first_name',
								'col'				=> 'first_name',
								],
								['type' 			=> 'input',
								'label'				=> 'Last Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_last_name',
								'col'				=> 'last_name',
								],
								['type' 			=> 'input',
								'label'				=> 'Middle Initial',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'id'				=> 'contact_middle_initial',
								'col'				=> 'middle_initial',
								],

								['type' 			=> 'date',
								'label'				=> 'Birth Date',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'contact_birth_date',
								'col'				=> 'birth_date',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'input',
								'label'				=> 'Contact Number',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_number_no',
								'col'				=> 'contact_no',
								],

								['type' 			=> 'input',
								'label'				=> 'Mobile Number',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_mobile_no',
								'col'				=> 'mobile_no',
								],

								['type' 			=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_email',
								'col'				=> 'email',
								],

								['type' 			=> 'input',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_department',
								'col'				=> 'department',
								],

								['type' 			=> 'input',
								'label'				=> 'Designation',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'contact_designation',
								'col'				=> 'designation',
								]

							];

		$config['address'] = [			
								['type' 			=> 'select',
								'label'				=> 'Address Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'address_address_type',
								'col'				=> 'address_type',
								'options'			=> array_merge([''=>'Select Address Type'],$config['address_type']),								
								],

								['type' 			=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'address_address',
								'col'				=> 'address',
								],

								['type' 			=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'address_city',
								'col'				=> 'city',
								],

								['type' 			=> 'input',
								'label'				=> 'Region',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'address_region',
								'col'				=> 'region',
								],

								['type' 			=> 'input',
								'label'				=> 'Area',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'address_area',
								'col'				=> 'area',
								]
							];



?>