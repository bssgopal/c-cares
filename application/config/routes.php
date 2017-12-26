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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'User/signin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*cusotm routings*/
$route['Fertilizers'] = 'Fertilizers/purchase';
$route['Seeds'] = 'Fertilizers/stockreport';
$route['Seeds/stockreport'] = 'Fertilizers/stockreport';
$route['Seeds/purchase'] = 'Fertilizers/purchase';
$route['Seeds/purchase/(:any)'] = 'Fertilizers/purchase/$1';
$route['Seeds/payments'] = 'Fertilizers/payments';
$route['Seeds/payments/(:any)'] = 'Fertilizers/payments/$1';
$route['Seeds/sale_retail'] = 'Fertilizers/sale_retail';
$route['Seeds/sale_retail/(:any)'] = 'Fertilizers/sale_retail/$1';
$route['Seeds/whole_sale'] = 'Fertilizers/whole_sale';
$route['Seeds/whole_sale/(:any)'] = 'Fertilizers/whole_sale/$1';
$route['Seeds/view_whole_bill/(:any)'] = 'Fertilizers/view_whole_bill/$1';

$route['Pesticides'] = 'Fertilizers/stockreport';
$route['Pesticides/stockreport'] = 'Fertilizers/stockreport';
$route['Pesticides/purchase'] = 'Fertilizers/purchase';
$route['Pesticides/purchase/(:any)'] = 'Fertilizers/purchase/$1';
$route['Pesticides/payments'] = 'Fertilizers/payments';
$route['Pesticides/payments/(:any)'] = 'Fertilizers/payments/$1';
$route['Pesticides/sale_retail'] = 'Fertilizers/pesticides_sale_retail';
$route['Pesticides/sale_retail/(:any)'] = 'Fertilizers/pesticides_sale_retail/$1';
$route['Pesticides/whole_sale'] = 'Fertilizers/pesticides_whole_sale';
$route['Pesticides/whole_sale/(:any)'] = 'Fertilizers/pesticides_whole_sale/$1';

$route['Cement'] = 'Fertilizers/stockreport';
$route['Cement/stockreport'] = 'Fertilizers/stockreport';
$route['Cement/purchase'] = 'Fertilizers/purchase';
$route['Cement/purchase/(:any)'] = 'Fertilizers/purchase/$1';
$route['Cement/payments'] = 'Fertilizers/payments';
$route['Cement/payments/(:any)'] = 'Fertilizers/payments/$1';
$route['Cement/sale_retail'] = 'Fertilizers/sale_retail';
$route['Cement/sale_retail/(:any)'] = 'Fertilizers/sale_retail/$1';
$route['Cement/whole_sale'] = 'Fertilizers/whole_sale';
$route['Cement/whole_sale/(:any)'] = 'Fertilizers/whole_sale/$1';
$route['Cement/view_whole_bill/(:any)'] = 'Fertilizers/view_whole_bill/$1';

/*Reports*/
$route['Seeds/purchase_report'] = 'Fertilizers/purchase_report';
$route['Seeds/payments_report'] = 'Fertilizers/payments_report';
$route['Seeds/saleretails_report'] = 'Fertilizers/saleretails_report';
$route['Seeds/wholesale_report'] = 'Fertilizers/wholesale_report';
$route['Seeds/view_bill/(:any)'] = 'Fertilizers/view_bill/$1';

$route['Cement/purchase_report'] = 'Fertilizers/purchase_report';
$route['Cement/payments_report'] = 'Fertilizers/payments_report';
$route['Cement/saleretails_report'] = 'Fertilizers/saleretails_report';
$route['Cement/wholesale_report'] = 'Fertilizers/wholesale_report';
$route['Cement/view_bill/(:any)'] = 'Fertilizers/view_bill/$1';


$route['Pesticides/purchase_report'] = 'Fertilizers/purchase_report';
$route['Pesticides/payments_report'] = 'Fertilizers/payments_report';
$route['Pesticides/saleretails_report'] = 'Fertilizers/saleretails_report';
$route['Pesticides/view_bill/(:any)'] = 'Fertilizers/pesticides_view_bill/$1';
$route['Pesticides/wholesale_report'] = 'Fertilizers/wholesale_report';
$route['Pesticides/view_whole_bill/(:any)'] = 'Fertilizers/pesticides_view_wholesale_bill/$1';
