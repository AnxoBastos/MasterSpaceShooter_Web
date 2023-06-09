<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
session_start();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Score::indexWeb');

$routes->get('user', 'Score::userAccountWeb');
$routes->post('username', 'Auth::updateUsernameWeb');
$routes->post('password', 'Auth::updatePasswordWeb');
$routes->post('delete', 'Auth::deleteUserWeb');

$routes->get('access', 'Auth::accessAccountWeb');
$routes->get('logout', 'Auth::logoutWeb');
$routes->post('login', 'Auth::loginWeb');
$routes->post('register', 'Auth::registerWeb');

$routes->get('download', 'Auth::download');

$routes->post('auth/login', 'Auth::login');
$routes->get('top', 'Score::top');

$routes->get('scores', 'Score::scores');
$routes->get('scores/date', 'Score::scoresByDate');
$routes->get('scores/score/(:any)', 'Score::scoresUsername/$1');
$routes->get('scores/date/(:any)', 'Score::scoresUsernameByDate/$1');

$routes->post('score/store', 'Score::store');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
