<?php
$config['user_type']  = [ 
							99=>'System Administrator', 
							88=>'Manager',
							87=>'Supervisor',
							10=>'Regular User',
							];

$config['user_status']  = [ 
							1=>'Active', 
							0=>'Inactive'
							];


$config['user_form'][] = [
								
								['type' 			=> 'input',
								'label'				=> 'Login ID',
								'parent_class' 		=> 'form-group col-sm-12 user_account',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'username',
								'id'				=> 'create_username',
								],

								['type' 			=> 'input',
								'label'				=> 'First Name',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'fname',
								'id'				=> 'create_fname',
								],
								['type' 			=> 'input',
								'label'				=> 'Middle Name',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'col'				=> 'mname',
								'id'				=> 'create_mname',
								],
								['type' 			=> 'input',
								'label'				=> 'Last Name',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'lname',
								'id'				=> 'create_lname',
								],
								['type' 			=> 'input',
								'label'				=> 'Mobile Number',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'mobile',
								'id'				=> 'create_mobile',
								],
								['type' 			=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'email',
								'id'				=> 'create_booking_no',
								],
								

							];
$config['user_form'][] = [
								

								['type' 			=> 'select',
								'label'				=> 'User Type',
								'parent_class' 		=> 'form-group col-sm-12 user_account',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_user_type',
								'col'				=> 'user_type',
								'form_class'		=> 'form-control',
								'placeholder'		=> 'Select User Type',
								'options'			=> [''=>'Select User Type']+$config['user_type']
								],


								['type' 			=> 'input',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'dept',
								'id'				=> 'create_dept',
								],

								['type' 			=> 'input',
								'label'				=> 'Position',
								'parent_class' 		=> 'form-group col-sm-12 user_profiles',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'position',
								'id'				=> 'create_position',
								],

								['type' 			=> 'password',
								'label'				=> 'Password',
								'parent_class' 		=> 'form-group col-sm-12 user_account',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'password',
								'id'				=> 'create_password',
								],

								['type' 			=> 'password',
								'label'				=> 'Confirm Password',
								'parent_class' 		=> 'form-group col-sm-12 user_account',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'password',
								'id'				=> 'create_cpassword',
								],
								

							];