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
$route['default_controller'] = 'main';

$route['login']='common/user_login';
$route['admin/login']='common/admin_login';
$route['signup']='common/user_signup';
$route['user']='user/dashboard';

$route['activate/(:any)']='common/AccountActivation/$1';
$route['postad']='main/adpost';
$route['analytics/verify/(:any)']='analytics/index/$1';
$route['adlisting/(:any)']='main/ad_listing/$1';
$route['checkout/(:any)/(:any)']='main/checkout/$1/$2';
$route['auction/(:any)/(:any)']='main/single_auction/$1/$2';
$route['classified/(:any)/(:any)']='main/single_offers/$1/$2';
$route['user_profile/(:any)']='user/user_profile/$1';
$route['user/edit_listings/(:any)/(:any)']='user/edit_listings/$1/$2';
$route['user/create_listings']='user/create_listings';
$route['user/create_listings/(:any)']='user/create__listings/$1';
$route['user/create_listings/(:any)/(:any)']='user/create__listings/$1/$2';
$route['search/(:any)']='main/search/$1';

$route['page/(:any)']='main/view_page/$1';
$route['blog_post/(:any)']='main/view_blog/$1';
$route['blog']='main/blog';
$route['markascompleted']='main/markAsCompletedAuto';
$route['contact']='main/contact';
$route['auctions']='main/auctions';
$route['offers']='main/offers';
$route['pricing']='main/pricing';
$route['domains']='main/domains';
$route['websites']='main/websites';
$route['user_profile/(:any)']='user/user_profile/$1';

$route['forgotpassword']='common/reset_password';
$route['reset/(:any)']='common/password_reset_request/$1';
$route['resetPassword/(:any)']='common/reset_password_complete/$1';

/*Language*/
$route['language/(:any)'] = 'LanguageSwitcher/switchLang/$1';

$route['404_override'] = 'common/pageNotFound';
$route['translate_uri_dashes'] = FALSE;
