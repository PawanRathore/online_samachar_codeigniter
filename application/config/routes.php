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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';

$route['National'] = 'Welcome/newsList';
$route['International'] = 'Welcome/newsList';
$route['Madhya-Pradesh'] = 'Welcome/newsList';
$route['Ujjain'] = 'Welcome/newsList';
$route['Business'] = 'Welcome/newsList';
$route['Sports'] = 'Welcome/newsList';
$route['Other'] = 'Welcome/newsList';
$route['Interesting'] = 'Welcome/newsList';


$route['National/(:any)'] = 'Welcome/fullNews';
$route['International/(:any)'] = 'Welcome/fullNews';
$route['Madhya-Pradesh/(:any)'] = 'Welcome/fullNews';
$route['Ujjain/(:any)'] = 'Welcome/fullNews';
$route['Business/(:any)'] = 'Welcome/fullNews';
$route['Sports/(:any)'] = 'Welcome/fullNews';
$route['Other/(:any)'] = 'Welcome/fullNews';
$route['Interesting/(:any)'] = 'Welcome/fullNews';

// list page pagination url 
$route['National-News'] = 'Welcome/newsList';
$route['International-News'] = 'Welcome/newsList';
$route['Madhya-Pradesh-News'] = 'Welcome/newsList';
$route['Ujjain-News'] = 'Welcome/newsList';
$route['Business-News'] = 'Welcome/newsList';
$route['Sports-News'] = 'Welcome/newsList';
$route['Other-News'] = 'Welcome/newsList';
$route['Interesting-News'] = 'Welcome/newsList';

$route['National-News/(:any)'] = 'Welcome/newsList';
$route['International-News/(:any)'] = 'Welcome/newsList';
$route['Madhya-Pradesh-News/(:any)'] = 'Welcome/newsList';
$route['Ujjain-News/(:any)'] = 'Welcome/newsList';
$route['Business-News/(:any)'] = 'Welcome/newsList';
$route['Sports-News/(:any)'] = 'Welcome/newsList';
$route['Other-News/(:any)'] = 'Welcome/newsList';
$route['Interesting-News/(:any)'] = 'Welcome/newsList';
// list page pagination url End

$route['Subscribe'] = 'welcome/Subscribe';

/// admin
$route['admin-login'] = 'welcome/adminlogin';
$route['admin-login-post'] = 'welcome/adminLoginPost';

// calculator
$route['calculator'] = 'welcome/calculator';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
