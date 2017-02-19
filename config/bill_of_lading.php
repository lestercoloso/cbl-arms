<?php
$config['charges']  = ['DHL'=>'DHL', 'FEDEX'=>'FEDEX', 'LBC'=>'LBC', 'AIR21'=>'AIR21'];
$config['packaging_type']['document'] 	= ['Small'=>'Small', 'Large'=>'Large'];
$config['packaging_type']['parcel'] 	= ['Own'=>'Own', 'Others'=>'Others'];
$config['packaging_type']['crafting'] 	= ['Skeletal'=>'Skeletal', 'Close'=>'Close'];
$config['status'] = ['1'=>'Reviewed', '2'=>'Approved'];
$config['mode_of_shipment']  = $db->getconfig('mode_of_shipping');
$config['services']  = $db->getconfig('services');
$config['delivery_instruction']  = $db->getconfig('delivery_instruction');
$config['commodity_class']  = $db->getconfig('commodity_class');
$config['mode_of_payment']  = $db->getconfig('mode_of_payment');
// $config['subinventory_type'] = [''=>'Please Select', '1'=>'test1', '2'=>'test2'];

$config['add_shipment']['Shipper Information'] = [
								
								0=>['type' 			=> 'normal',
								'label'				=> 'Shipper Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'shipper_name',
								'id'				=> 'create_shipper_name',
								],
								1=>['type' 			=> 'normal',
								'label'				=> 'Company',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'comapany',
								'id'				=> 'create_company',
								],

								2 => ['type' 		=> 'normal',
								'label'				=> 'Contact No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_no',
								'col'				=> 'contact_no',
								'form_class'		=> 'form-control',
								'placeholder' 		=> ''
								],

								3 => ['type' 		=> 'normal',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_email',
								'col'				=> 'email',
								'form_class'		=> 'form-control',
								],

								4 => ['type' 		=> 'input',
								'label'				=> 'TIN No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_tin_no',
								'col'				=> 'tin_no',
								'form_class'		=> 'form-control'
								],

								5 => ['type' 		=> 'normal',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_department',
								'col'				=> 'department',
								'form_class'		=> 'form-control'],

								6 => ['type' 		=> 'input',
								'label'				=> 'Business Style',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_business_style',
								'col'				=> 'business_style',
								'form_class'		=> 'form-control'],

								7 => ['type' 		=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_address',
								'col'				=> 'address',
								'form_class'		=> 'form-control'],

								9 => ['type' 		=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_city',
								'col'				=> 'city',
								'form_class'		=> 'form-control'],

								10 => ['type' 		=> 'normal',
								'label'				=> 'Area',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area',
								'col'				=> 'area',
								'form_class'		=> 'form-control'],

							];



$config['add_shipment']['Package Content (Complete Description)'] = [
								
								0=>['type' 			=> 'input',
								'label'				=> 'Total Packages',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'total_package',
								'id'				=> 'create_total_package',
								],
								1=>['type' 			=> 'input',
								'label'				=> 'Destination Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'destination_type',
								'id'				=> 'create_destination_type',
								],

								2 => ['type' 		=> 'input',
								'label'				=> 'Country/Zone',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_country_zone',
								'col'				=> 'country_zone',
								'form_class'		=> 'form-control',
								],

								3 => ['type' 		=> 'input',
								'label'				=> 'Province/Zone',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_province_zone',
								'col'				=> 'province_zone',
								'form_class'		=> 'form-control',
								],

								4 => ['type' 		=> 'number',
								'label'				=> 'Dimension',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_dimension',
								'col'				=> 'dimension',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],

								5 => ['type' 		=> 'number',
								'label'				=> 'Actual Weight',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_actual_weight',
								'col'				=> 'actual_weight',
								'extra'				=> 'kg.',
								'form_class'		=> 'form-control',
								],

								6 => ['type' 		=> 'input',
								'label'				=> 'Total Declared Value',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_total_declared_value',
								'col'				=> 'total_declared_value',
								'form_class'		=> 'form-control',
								],

								7 => ['type' 		=> 'input',
								'label'				=> 'TDV % Applied',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_tdv_applied',
								'col'				=> 'tdv_applied',
								'form_class'		=> 'form-control',
								],

								8 => ['type' 		=> '',
								'label'				=> 'Packaging Type',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								],

								9=>['type' 			=> 'radio',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'label'				=> 'Document',								
								'subparent_class' 	=> 'col-sm-8  no-wrap',
								'form_class'		=> 'form-control',
								'id'				=> 'create_packing_type_document',
								'col'				=> 'packing_type_document',
								'options'			=> $config['packaging_type']['document']
								],

								10=>['type' 		=> 'radio',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'label'				=> 'Parcel',								
								'subparent_class' 	=> 'col-sm-8  no-wrap',
								'form_class'		=> 'form-control',
								'id'				=> 'create_packing_type_parcel',
								'col'				=> 'packing_type_parcel',
								'options'			=> $config['packaging_type']['parcel']
								],

								11=>['type' 		=> 'radio',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'label'				=> 'Crafting',								
								'subparent_class' 	=> 'col-sm-8  no-wrap',
								'form_class'		=> 'form-control',
								'id'				=> 'create_packing_type_crafting',
								'col'				=> 'packing_type_crafting',
								'options'			=> $config['packaging_type']['crafting']
								]
							];

$config['add_shipment']['Charges'] = [
								
								0=>['type' 			=> 'select',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'charges',
								'options'			=> array_merge([''=>'Select Charges'],$config['charges'])
								]

						];

$config['add_shipment']['Additional Changes'] = [
								
								['type' 			=> 'input',
								'label'				=> 'ODA(Outside Delivery Area)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_oda',
								'col'				=> 'oda',
								],
								
								['type' 			=> 'input',
								'label'				=> 'Special Handling',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_special_handling',
								'id'				=> 'special_handling',
								],

								['type' 		=> 'normal',
								'label'				=> 'Declared Value',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_declared_value',
								'col'				=> 'declared_value',
								'form_class'		=> 'form-control',
								'placeholder' 		=> ''
								],

								['type' 		=> 'input',
								'label'				=> 'Fumigation',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_fumigation',
								'col'				=> 'fumigation',
								'form_class'		=> 'form-control',
								],

								['type' 		=> 'input',
								'label'				=> 'Export Declaration Fee',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_export_declaration_fee',
								'col'				=> 'export_declaration_fee',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Address Correction Charge',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_address_correction_charge',
								'col'				=> 'address_correction_charge',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Residential Delivery',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_residential_delivery',
								'col'				=> 'residential_delivery',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Non Stackable Charge',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_non_stackable_charge',
								'col'				=> 'non_stackable_charge',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Crafting',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_crafting',
								'col'				=> 'crafting',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Label Cost',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_label_cost',
								'col'				=> 'label_cost',
								'form_class'		=> 'form-control'],
								
								['type' 		=> 'input',
								'label'				=> 'DG Charge',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_dg_charge',
								'col'				=> 'dg_charge',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Demmurage Fee',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_demmurage_fee',
								'col'				=> 'demmurage_fee',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Back Load',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_back_load',
								'col'				=> 'back_load',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Total',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_total',
								'col'				=> 'total',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> '12% VAT',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_vat',
								'col'				=> 'vat',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Total Amount Due',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_total_amount_due',
								'col'				=> 'total_amount_due',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Discount Percent',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_discount_percent',
								'col'				=> 'discount_percent',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Final Contract Price',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_final_contract_price',
								'col'				=> 'final_contract_price',
								'form_class'		=> 'form-control']

							
						];						

$config['add_shipment']['Recipient Information'] = [
								
								['type' 			=> 'input',
								'label'				=> 'Recipient Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_recipient_name',
								'col'				=> 'recipient_name',
								],
								['type' 			=> 'input',
								'label'				=> 'Recipient Company Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_recipient_company_name',
								'col'				=> 'recipient_company_name',
								],

								['type' 		=> 'input',
								'label'				=> 'Recipient Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_recipient_address',
								'col'				=> 'recipient_address',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder' 		=> ''
								],

								['type' 		=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_recipient_city',
								'col'				=> 'recipient_city',
								'form_class'		=> 'form-control not_mandatory',
								],

								['type' 		=> 'input',
								'label'				=> 'Phone No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_recipient_phone',
								'col'				=> 'recipient_phone',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_recipient_email',
								'col'				=> 'recipient_email',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_recipient_department',
								'col'				=> 'recipient_department',
								'form_class'		=> 'form-control']

							
						];		
$config['add_shipment'][' '] = [
								
								['type' 			=> 'select',
								'label'				=> 'Mode of Shipping',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_mode_of_shipping',
								'col'				=> 'mode_of_shipping',
								'options'			=> array_merge([''=>'Select Mode of Shipping'],$config['mode_of_shipment'])
								],
								['type' 			=> 'select',
								'label'				=> 'Services',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_services',
								'col'				=> 'services',
								'options'			=> array_merge([''=>'Select Services'],$config['services'])								
								],
								['type' 			=> 'select',
								'label'				=> 'Delivery Instruction',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_delivery_instruction',
								'col'				=> 'delivery_instruction',
								'options'			=> array_merge([''=>'Select Delivery Instruction'],$config['delivery_instruction'])									
								],
								['type' 			=> 'select',
								'label'				=> 'Commodity Class',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_commodity_class',
								'col'				=> 'commodity_class',
								'options'			=> array_merge([''=>'Select Commodity Class'],$config['commodity_class'])
								],
								['type' 			=> 'input',
								'label'				=> 'Document Attached',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_document_attached',
								'col'				=> 'document_attached'
								],
								['type' 			=> 'select',
								'label'				=> 'Mode of Payment',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_mode_of_payment',
								'col'				=> 'mode_of_payment',
								'options'			=> array_merge([''=>'Select Mode of payment'],$config['mode_of_payment'])
								],
				];										


?>