<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['default_controller'] = 'site_rules';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

// /*
// | -------------------------------------------------------------------------
// | Sample REST API Routes
// | -------------------------------------------------------------------------
// */
// $route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
// $route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
$route['default_controller'] = 'site';
$route['404_override'] = 'site/notFound';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'site/index';
// $route['puskesmas'] = 'site/puskesmas';
// $route['rsk'] = 'site/rumahSakitKhusus';
// $route['rsu'] = 'site/rumahSakitUmum';
// $route['error404'] = 'site/notfoundid';
// $route['API'] = 'Rest_server';

// user API Routes
$route['api/user/register'] = 'api/users/register';
$route['api/user/login'] = 'api/users/login';
