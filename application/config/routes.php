<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['default_controller'] 			= 		'welcome';
$route['dashboard'] 					=		'welcome/dashboard';
$route['login'] 						= 		'welcome/login';
$route['logout']						=		'welcome/logout';
$route['forgot-password'] 				=		'welcome/forgot_password';



/* * *****************************************common Controller**************************** */

$route['ajax/checkfield'] = 'welcome/checkfield';
$route['ajax/active-deactive'] = 'welcome/active_deactive';

/* * *****************************************Page Controller**************************** */

$route['form-master'] = 'setup/form_master';
$route['form-master-json'] = 'setup/form_master_json';
$route['add-form-master'] = 'setup/add_form_master';
$route['view-form-master/(:num)'] = 'setup/view_form_master/$1';
$route['edit-form-master/(:num)'] = 'setup/edit_form_master/$1';
$route['approve-form-master-list/(:num)'] = 'setup/approve_form_master/$1';
$route['approve-form-master-json/(:num)'] = 'setup/approve_form_master_json/$1';
$route['view-form-master-history/(:num)'] = 'setup/view_form_master_history/$1';

$route['employee-role'] = 'setup/employee_role';
$route['employee-role-json'] = 'setup/employee_role_json';
$route['add-employee-role'] = 'setup/add_employee_role';
$route['view-employee-role/(:num)'] = 'setup/view_employee_role/$1';
$route['approve-employee-role/(:num)'] = 'setup/approve_employee_role/$1';
$route['approve-employee-role-json/(:num)'] = 'setup/approve_employee_role_json/$1';


$route['form-access'] = 'setup/form_access';
$route['form-access-json'] = 'setup/form_access_json';
$route['add-form-access'] = 'setup/add_form_access';
$route['view-form-access'] = 'setup/view_form_access';
$route['edit-form-access/(:num)'] = 'setup/edit_form_access/$1';
/*******************************************manage Controller*****************************/

$route['lock-screeen'] 								=		'manage/lock_screeen';

$route['profile']	 								=		'manage/profile';

$route['department'] 								=		'manage/department';
$route['add_department'] 							=		'manage/add_department';
$route['edit_department/([a-zA-Z0-9---_%])+'] 		=		'manage/edit_department/$1';
$route['view_department/([a-zA-Z0-9---_%])+'] 		=		'manage/view_department/$1';
$route['approve_department/([a-zA-Z0-9---_%])+'] 	=		'manage/approve_department/$1';
$route['approve_department/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_department/$1/$1';

$route['designation'] 								=		'manage/designation';
$route['add_designation'] 							=		'manage/add_designation';
$route['edit_designation/([a-zA-Z0-9---_%])+'] 		=		'manage/edit_designation/$1';
$route['view_designation/([a-zA-Z0-9---_%])+'] 		=		'manage/view_designation/$1';
$route['approve_designation/([a-zA-Z0-9---_%])+'] 	=		'manage/approve_designation/$1';
$route['approve_designation/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_designation/$1/$1';

$route['role'] 										=		'manage/role';
$route['add_role'] 									=		'manage/add_role';
$route['edit_role/([a-zA-Z0-9---_%])+'] 			=		'manage/edit_role/$1';
$route['view_role/([a-zA-Z0-9---_%])+'] 			=		'manage/view_role/$1';
$route['approve_role/([a-zA-Z0-9---_%])+'] 			=		'manage/approve_role/$1';
$route['approve_role/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_role/$1/$1';

$route['payment_mode'] 								=		'manage/payment_mode';
$route['add_payment_mode'] 							=		'manage/add_payment_mode';
$route['edit_payment_mode/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_payment_mode/$1';
$route['view_payment_mode/([a-zA-Z0-9---_%])+'] 	=		'manage/view_payment_mode/$1';
$route['approve_payment_mode/([a-zA-Z0-9---_%])+'] 	=		'manage/approve_payment_mode/$1';
$route['approve_payment_mode/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_payment_mode/$1/$1';

$route['payment_status'] 							=		'manage/payment_status';
$route['add_payment_status'] 						=		'manage/add_payment_status';
$route['edit_payment_status/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_payment_status/$1';
$route['view_payment_status/([a-zA-Z0-9---_%])+'] 	=		'manage/view_payment_status/$1';
$route['approve_payment_status/([a-zA-Z0-9---_%])+']=		'manage/approve_payment_status/$1';
$route['approve_payment_status/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_payment_status/$1/$1';

$route['employee_types'] 							=		'manage/employee_types';
$route['add_employee_types'] 						=		'manage/add_employee_types';
$route['edit_employee_types/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_employee_types/$1';
$route['view_employee_types/([a-zA-Z0-9---_%])+'] 	=		'manage/view_employee_types/$1';
$route['approve_employee_types/([a-zA-Z0-9---_%])+']=		'manage/approve_employee_types/$1';
$route['approve_employee_types/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_employee_types/$1/$1';

$route['contract-consignor'] 							=		'manage/contract_consignor';
$route['add-contract-consignor'] 						=		'manage/add_contract_consignor';
$route['edit-contract-consignor/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_contract_consignor/$1';
$route['view-contract-consignor/([a-zA-Z0-9---_%])+'] 	=		'manage/view_contract_consignor/$1';
$route['approve-contract-consignor/([a-zA-Z0-9---_%])+']=		'manage/approve_contract_consignor/$1';
$route['approve-contract-consignor/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_contract_consignor/$1/$1';


$route['consignor'] 							=		'manage/consignor';
$route['add-consignor'] 						=		'manage/add_consignor';
$route['edit-consignor/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_consignor/$1';
$route['view-consignor/([a-zA-Z0-9---_%])+'] 	=		'manage/view_consignor/$1';
$route['approve-consignor/([a-zA-Z0-9---_%])+']=		'manage/approve_consignor/$1';
$route['approve-consignor/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_consignor/$1/$1';


$route['employee'] 									=		'manage/employee';
$route['add_employee'] 								=		'manage/add_employee';
$route['edit_employee/([a-zA-Z0-9---_%])+'] 		=		'manage/edit_employee/$1';
$route['view_employee/([a-zA-Z0-9---_%])+'] 		=		'manage/view_employee/$1';
$route['approve_employee/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_employee/$1';
$route['approve_employee/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_employee/$1/$1';


$route['driver'] 									=		'manage/driver';
$route['add_driver'] 								=		'manage/add_driver';
$route['edit_driver/([a-zA-Z0-9---_%])+'] 			=		'manage/edit_driver/$1';
$route['view_driver/([a-zA-Z0-9---_%])+'] 			=		'manage/view_driver/$1';
$route['approve_driver/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_driver/$1';
$route['approve_driver/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_driver/$1/$1';

$route['vehicleowner'] 								=		'manage/vehicleowner';
$route['add_vehicleowner'] 							=		'manage/add_vehicleowner';
$route['edit_vehicleowner/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_vehicleowner/$1';
$route['view_vehicleowner/([a-zA-Z0-9---_%])+'] 	=		'manage/view_vehicleowner/$1';
$route['approve_vehicleowner/([a-zA-Z0-9---_%])+']	=		'manage/approve_vehicleowner/$1';
$route['approve_vehicleowner/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_vehicleowner/$1/$1';


$route['vehicleagent'] 								=		'manage/vehicleagent';
$route['add_vehicleagent'] 							=		'manage/add_vehicleagent';
$route['edit_vehicleagent/([a-zA-Z0-9---_%])+'] 	=		'manage/edit_vehicleagent/$1';
$route['view_vehicleagent/([a-zA-Z0-9---_%])+'] 	=		'manage/view_vehicleagent/$1';
$route['approve_vehicleagent/([a-zA-Z0-9---_%])+']	=		'manage/approve_vehicleagent/$1';
$route['approve_vehicleagent/([a-zA-Z0-9---_%])+/([a-zA-Z0-9---_%])+'] 		=		'manage/approve_vehicleagent/$1/$1';

/**************************************************/

$route['booking'] 									=		'operation/index';
$route['create-trip-sheet'] 						=		'operation/create_trip_sheet';
$route['delivery-closure'] 							=		'operation/delivery_closure';
$route['trip-payment-update'] 						=		'operation/trip_payment_update';

/*****/
