<?php
$config['block']  = ['A'=>'Block A', 'B'=>'Block B', 'C'=>'Block C'];
$config['storage_type_select']  = ['rack'=>'Rack', 'bay'=>'Bay'];
$config['rack_storage_type']  	= ['Drive-In'=>'Drive-In', 'Selective'=>'Selective'];
$config['storage_type'] 	 	= $db->getconfig('storage_type');
// $config['warehouse_location'] 	 = $db->getconfig('warehouse_location');
$config['rack_level'] 	 = $db->getconfig('rack_level');
$config['rack_type'] 	 = $db->getconfig('rack_type');
$config['pallet_position_type'] 	 = $db->getconfig('pallet_position_type');
$config['no_rack_level'] 	 	= [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6];


$sql = 'select id, code, location from location_management where status=1';
$result = $db->select($sql);
$config['warehouse_location_option'] = array();
foreach ($result['data'] as $key => $value) {
	$config['warehouse_location_option'][$value['id']] = $value['location'];	
}




$config['warehouse_links']	= 	[
									['link'=>'warehouse', 	'name' => 'Warehouse'],
									['link'=>'inbound', 	'name' => 'book inbound shipment'],
									['link'=>'irr', 		'name' => 'IRR'],
									['link'=>'putaway', 	'name' => 'Put Away'],
									['link'=>'outbound', 	'name' => 'book Outbound shipment'],
									['link'=>'picklist', 	'name' => 'Pick List'],
									['link'=>'gatepass', 	'name' => 'Gate Pass']
								];	





$config['warehouse_form'] = [ 
			
								['type' 			=> 'select',
								'label'				=> 'Warehouse Location',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_wh_location',
								'col'				=> 'warehouse_location',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select Warehouse Location']+$config['warehouse_location_option']
								],	

								['type' 			=> 'select',
								'label'				=> 'Storage type',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_storage_type',
								'col'				=> 'storage_type',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select Storage type']+$config['storage_type']
								],	

								['type' 			=> 'select',
								'label'				=> 'Block Code',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'rblock',
								'col'				=> 'block',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select Block']+$config['block']
								],	

								['type' 			=> 'checkbox',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'label'				=> ' ',								
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'not_mandatory',
								'id'				=> 'create-larwing',
								'col'				=> 'larwing',
								'options'			=> [''=>'Left and Right Wing']
								],															


								['type' 			=> 'select',
								'label'				=> 'Storage',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'stype',
								'form_class'		=> 'form-control',
								'options' 			=> $config['storage_type_select']
								],

								['type' 			=> 'normal',
								'label'				=> 'Rack Code',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'rackcode',
								'col'				=> 'code',
								'form_class'		=> 'form-control'],

								['type' 			=> 'select',
								'label'				=> 'Rack Type',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'rack_storage_type',
								'col'				=> 'storage_type',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select Rack type']+$config['rack_type']
								],	

								['type' 			=> 'select',
								'label'				=> 'No. of Rack level',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'noofracklevel',
								'col'				=> 'no_rack_level',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select No. of Rack level']+$config['rack_level']
								],	


								['type' 		=> 'number',
								'label'				=> 'No. of Rack section',
								'parent_class' 		=> 'form-group col-sm-12 rack',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'noracksection',
								'col'				=> 'no_rack_section',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Enter No. of Rack section']
					]; 	



$config['assign_pallet_position'] = [ 
			
								['type' 			=> 'select',
								'label'				=> 'Rack Section',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-rack_section',
								'col'				=> 'rack_section',
								'form_class'		=> 'form-control'
								],	
								['type' 			=> 'select',
								'label'				=> 'Rack Level',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-rack_level',
								'col'				=> 'rack_level',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select Rack Level']+$config['rack_level']
								],	

								['type' 		=> 'number',
								'label'				=> 'No. of Pallet Position',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-pallet_position',
								'col'				=> 'pallet_position',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Enter No. of Pallet position']
					]; 	

$config['assign_pallet_position_type'] = [ 
			
								['type' 			=> 'select',
								'label'				=> 'Rack Section',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-rack_section',
								'col'				=> 'rack_section',
								'form_class'		=> 'form-control'
								],	
								['type' 			=> 'select',
								'label'				=> 'Rack Level',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-rack_level',
								'col'				=> 'rack_level',
								'form_class'		=> 'form-control',
								'options' 			=> [''=>'Select Rack Level']+$config['rack_level']
								],	

								['type' 		=> 'input',
								'label'				=> ' Pallet Position',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-pallet_position',
								'col'				=> 'pallet_position',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Enter Pallet position'],

								['type' 		=> 'normal',
								'label'				=> 'Location Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-location_code',
								'col'				=> 'location_code',
								'form_class'		=> 'form-control',
								'placeholder' 		=> 'Auto Generated'],

								['type' 			=> 'checkbox',
								'label'				=> 'PALLET POSITION TYPE',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create-pallet_position_type',
								'col'				=> 'pallet_position_type',
								'form_class'		=> 'multiple',
								'options'			=> $config['pallet_position_type']
								],
					]; 	
					



				// <div class="form-group col-sm-12 rack" id="racklength_container">
				//     <label class="col-sm-4" for="racklength">Rack Length * </label>
				//     <div class="col-sm-8">
				//         <input name="racklength" type="number" col="rack_length" min="1" id="racklength" placeholder="Enter the rack length" class="form-control">
				//         <span id="racklength_error" class="text-danger"></span>
				//     </div>
				// </div>

				// <div class="form-group col-sm-12 rack" id="rackwidth_container">
				//     <label class="col-sm-4" for="rackwidth">Rack Width * </label>
				//     <div class="col-sm-8">
				//         <input name="rackwidth" type="number" col="rack_width" min="1"  id="rackwidth" placeholder="Enter the rack width" class="form-control">
				//         <span id="rackwidth_error" class="text-danger"></span>
				//     </div>
				// </div>
			

				// <div class="form-group col-sm-12 rack" id="racklevelheight_container">
				//     <label class="col-sm-4" for="textinput">Rack Height Level * </label>
				//     <div class="col-sm-8">
				//         <input name="racklevelheight" type="number"  min="1" col="rack_level_height"  id="racklevelheight" placeholder="Enter the rack height level" class="form-control">
				//         <span id="racklevelheight_error" class="text-danger"></span>
				//     </div>
				// </div>
				// <div class="form-group col-sm-12 rack" id="noracksection_container">
				//     <label class="col-sm-4" for="textinput">No. of Rack section * </label>
				//     <div class="col-sm-8">
				//         <input name="no_rack_section" type="number"  min="1" col="no_rack_section"  id="noracksection" placeholder="Enter No. of Rack section" class="form-control">
				//         <span id="noracksection_error" class="text-danger"></span>
				//     </div>
				// </div>
				// <div class="form-group col-sm-12 rack" id="nopalletposition_container">
				//     <label class="col-sm-4" for="textinput">No. of Pallet Position * </label>
				//     <div class="col-sm-8">
				//         <input name="no_pallet_position" type="number"  min="1" col="no_pallet_position"  id="nopalletposition" placeholder="Enter No. of Pallet position" class="form-control">
				//         <span id="nopalletposition_error" class="text-danger"></span>
				//     </div>
				// </div>



				// <div class="form-group col-sm-12 bay" id="baycode_container">
				//     <label class="col-sm-4" for="textinput">Bay Code * </label>
				//     <div class="col-sm-8">
				//         <input name="racklevelheight" col="code" type="text" id="baycode" disabled="disabled" class="form-control">
				//         <span id="baycode_error" class="text-danger"></span>
				//     </div>
				// </div>

				// <div class="form-group col-sm-12 bay" id="bblock_container">
				//   <label for="stype" class="col-sm-4">Block * </label>
				//   <div class="col-sm-8">
				// 	  <select class="form-control" id="bblock"  col="block">
				// 	    <option value="">Select Block</option>
				// 	    <option value="A">Block A</option>
				// 	    <option value="B">Block B</option>
				// 	    <option value="C">Block C</option>
				// 	  </select>
				//   </div>
				// </div>
				// <div class="form-group col-sm-12 bay" id="bay_length_container">
				//     <label class="col-sm-4" for="textinput">Bay Length * </label>
				//     <div class="col-sm-8">
				//         <input name="bay_length" type="number"  min="1" col="bay_length" id="bay_length" placeholder="Enter the bay length" class="form-control">
				//         <span id="bay_length_error" class="text-danger"></span>
				//     </div>
				// </div>

				// <div class="form-group col-sm-12 bay" id="bay_width_container">
				//     <label class="col-sm-4" for="textinput">Bay Width * </label>
				//     <div class="col-sm-8">
				//         <input name="bay_width" type="number"  min="1"  col="bay_width" id="bay_width" placeholder="Enter the bay width" class="form-control">
				//         <span id="bay_width_error" class="text-danger"></span>
				//     </div>
				// </div>												

?>