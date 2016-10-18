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



/*******************************************manage Controller*****************************/



$route['department'] 					=		'manage/department';
$route['add_department'] 				=		'manage/add_department';
$route['edit_department'] 				=		'manage/edit_department';

$route['designation'] 					=		'manage/designation';
$route['add_designation'] 				=		'manage/add_designation';
$route['edit_designation'] 				=		'manage/edit_designation';

$route['role'] 							=		'manage/role';
$route['add_role'] 						=		'manage/add_role';
$route['edit_role'] 					=		'manage/edit_role';

$route['payment_mode'] 					=		'manage/payment_mode';
$route['add_payment_mode'] 				=		'manage/add_payment_mode';
$route['edit_payment_mode'] 			=		'manage/edit_payment_mode';

$route['payment_status'] 				=		'manage/payment_status';
$route['add_payment_status'] 			=		'manage/add_payment_status';
$route['edit_payment_status'] 			=		'manage/edit_payment_status';

$route['employee_types'] 				=		'manage/employee_types';
$route['add_employee_types'] 			=		'manage/add_employee_types';
$route['edit_employee_types'] 			=		'manage/edit_employee_types';




