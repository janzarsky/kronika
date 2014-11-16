<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "events";
$route['404_override'] = '';

$route['logout'] = "login/logout";

$route['admin'] = "archive";

$route['add'] = "edit/edit";

$route['edit/(:num)'] = "edit/edit/$1";
$route['media/(:num)'] = "media/media/$1";

$route['d/(:num)'] = "events/by_id/$1";
$route['detail/(:any)'] = "events/by_url/$1";

$route['((19|20|21)[0-9][0-9])'] = "events/by_date/$1/0/0";
$route['((19|20|21)[0-9][0-9])/([1-9]|0[1-9]|1[0-2])'] = "events/by_date/$1/$3/0";
$route['((19|20|21)[0-9][0-9])/([1-9]|0[1-9]|1[0-2])/([1-9]|0[1-9]|[1-2][0-9]|3[0-1])'] = "events/by_date/$1/$3/$4";


/* End of file routes.php */
/* Location: ./application/config/routes.php */