<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
/** For Production ONLY */
$routes->set404Override(); // comment this and uncomment the routes below
// $routes->set404Override(function () {
// 	$data['title'] = 'Not Found';
// 	return view('auth/404', $data);
// });
/** */
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AuthController::login');
$routes->post('/auth', 'AuthController::auth');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'HomeController::index', ['filter' => 'authfilter']);
$routes->get('/404', 'AuthController::notfound');
$routes->get('/403', 'AuthController::blocked');
$routes->addRedirect('/home', '/404');
$routes->addRedirect('/homecontroller', '/404');
$routes->addRedirect('/homecontroller/(:any)', '/404');
/** Roles */
$routes->get('/roles', 'RoleController::index', ['filter' => 'authfilter']);
$routes->get('/roles/create', 'RoleController::create', ['filter' => 'authfilter']);
$routes->post('/roles/save', 'RoleController::save', ['filter' => 'authfilter']);
$routes->get('/roles/detail/(:num)', 'RoleController::detail/$1', ['filter' => 'authfilter']);
$routes->get('/roles/edit/(:num)', 'RoleController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/roles/update/(:num)', 'RoleController::update/$1', ['filter' => 'authfilter']);
$routes->delete('/roles/delete/(:num)', 'RoleController::delete/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/rolecontroller', '/404');
$routes->addRedirect('/rolecontroller/(:any)', '/404');
/** Tools > Menu */
$routes->get('/tools/menu', 'MenuController::index', ['filter' => 'authfilter']);
$routes->get('/tools/menu/create', 'MenuController::create', ['filter' => 'authfilter']);
$routes->post('/tools/menu/save', 'MenuController::save', ['filter' => 'authfilter']);
$routes->get('/tools/menu/edit/(:num)', 'MenuController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/tools/menu/update/(:num)', 'MenuController::update/$1', ['filter' => 'authfilter']);
$routes->delete('/tools/menu/delete/(:num)', 'MenuController::delete/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/menucontroller', '/404');
$routes->addRedirect('/menucontroller/(:any)', '/404');
/** Tools > Submenu */
$routes->get('/tools/submenu', 'SubmenuController::index', ['filter' => 'authfilter']);
$routes->get('/tools/submenu/create', 'SubmenuController::create', ['filter' => 'authfilter']);
$routes->post('/tools/submenu/save', 'SubmenuController::save', ['filter' => 'authfilter']);
$routes->get('/tools/submenu/edit/(:num)', 'SubmenuController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/tools/submenu/update/(:num)', 'SubmenuController::update/$1', ['filter' => 'authfilter']);
$routes->delete('/tools/submenu/delete/(:num)', 'SubmenuController::delete/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/submenucontroller', '/404');
$routes->addRedirect('/submenucontroller/(:any)', '/404');
/** Tools > Access */
$routes->get('/tools/access', 'MenuAccessController::index', ['filter' => 'authfilter']);
$routes->get('/tools/access/edit/(:num)', 'MenuAccessController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/tools/access/update/(:num)', 'MenuAccessController::update/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/menuacesscontroller', '/404');
$routes->addRedirect('/menuacesscontroller/(:any)', '/404');
/** Users */
$routes->get('/users', 'UserController::index', ['filter' => 'authfilter']);
$routes->get('/users/create', 'UserController::create', ['filter' => 'authfilter']);
$routes->post('/users/save', 'UserController::save', ['filter' => 'authfilter']);
$routes->get('/users/detail/(:num)', 'UserController::detail/$1', ['filter' => 'authfilter']);
$routes->get('/users/edit/(:num)', 'UserController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/users/update/(:num)', 'UserController::update/$1');
$routes->delete('/users/delete/(:num)', 'UserController::delete/$1', ['filter' => 'authfilter']);
$routes->get('/users/reset/(:num)', 'UserController::reset/$1', ['filter' => 'authfilter']);
$routes->patch('/users/changepass/(:num)', 'UserController::changepass/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/usercontroller', '/404');
$routes->addRedirect('/usercontroller/(:any)', '/404');
/** User's Profile */
$routes->get('/profile/(:num)', 'ProfileController::show/$1', ['filter' => 'checksession']);
$routes->get('/profile/edit/(:num)', 'ProfileController::edit/$1', ['filter' => 'checksession']);
$routes->put('/profile/update/(:num)', 'ProfileController::update/$1', ['filter' => 'checksession']);
$routes->get('/profile/changepass/(:num)', 'ProfileController::editpass/$1', ['filter' => 'checksession']);
$routes->patch('/profile/changepass/(:num)', 'ProfileController::changepass/$1', ['filter' => 'checksession']);
$routes->addRedirect('/profilecontroller', '/404');
$routes->addRedirect('/profilecontroller/(:any)', '/404');
/** Transactions > Transaksi Masuk */
$routes->get('/transactions/transaksi-masuk', 'TransactionInController::index', ['filter' => 'authfilter']);
$routes->get('/transactions/transaksi-masuk/create', 'TransactionInController::create', ['filter' => 'authfilter']);
$routes->post('/transactions/transaksi-masuk/save', 'TransactionInController::save', ['filter' => 'authfilter']);
$routes->get('/transactions/transaksi-masuk/edit/(:num)', 'TransactionInController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/transactions/transaksi-masuk/update/(:num)', 'TransactionInController::update/$1', ['filter' => 'authfilter']);
$routes->get('/transactions/transaksi-masuk/detail/(:num)', 'TransactionInController::detail/$1', ['filter' => 'authfilter']);
$routes->delete('/transactions/transaksi-masuk/delete/(:num)', 'TransactionInController::delete/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/transactionincontroller', '/404');
$routes->addRedirect('/transactionincontroller/(:any)', '/404');
/** Transactions > Transaksi Pengambilan */
$routes->get('/transactions/transaksi-pengambilan', 'TransactionOutController::index', ['filter' => 'authfilter']);
$routes->get('/transactions/transaksi-pengambilan/create', 'TransactionOutController::create', ['filter' => 'authfilter']);
$routes->post('/transactions/transaksi-pengambilan/save', 'TransactionOutController::save', ['filter' => 'authfilter']);
$routes->delete('/transactions/transaksi-pengambilan/delete/(:num)', 'TransactionOutController::delete/$1', ['filter' => 'authfilter']);
$routes->get('/transactions/invoice/generate-pdf/(:num)', 'PDFController::invoicePDF/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/transactionoutcontroller', '/404');
$routes->addRedirect('/transactionoutcontroller/(:any)', '/404');
/** Cash flow > Pemasukan */
$routes->get('/cash-flow/pemasukan', 'CashflowInController::index', ['filter' => 'authfilter']);
$routes->addRedirect('/cashflowincontroller', '/404');
$routes->addRedirect('/cashflowincontroller/(:any)', '/404');
/** Cash flow > Pengeluaran*/
$routes->get('/cash-flow/pengeluaran', 'CashflowOutController::index', ['filter' => 'authfilter']);
$routes->get('/cash-flow/pengeluaran/create', 'CashflowOutController::create', ['filter' => 'authfilter']);
$routes->post('/cash-flow/pengeluaran/save', 'CashflowOutController::save', ['filter' => 'authfilter']);
$routes->get('/cash-flow/pengeluaran/edit/(:num)', 'CashflowOutController::edit/$1', ['filter' => 'authfilter']);
$routes->put('/cash-flow/pengeluaran/update/(:num)', 'CashflowOutController::update/$1', ['filter' => 'authfilter']);
$routes->delete('/cash-flow/pengeluaran/delete/(:num)', 'CashflowOutController::delete/$1', ['filter' => 'authfilter']);
$routes->addRedirect('/cashflowoutcontroller', '/404');
$routes->addRedirect('/cashflowoutcontroller/(:any)', '/404');
/** Report > Transaksi Masuk */
$routes->get('/reports/transaksi-masuk', 'ReportController::indexTransaksiMasuk', ['filter' => 'authfilter']);
$routes->get('/reports/transaksi-masuk/generate-pdf/(:segment)/(:segment)', 'PDFController::transaksiMasukPDF/$1/$2', ['filter' => 'authfilter']);
$routes->get('/reports/transaksi-pengambilan', 'ReportController::indexTransaksiPengambilan', ['filter' => 'authfilter']);
$routes->get('/reports/transaksi-pengambilan/generate-pdf/(:segment)/(:segment)', 'PDFController::transaksiPengambilanPDF/$1/$2', ['filter' => 'authfilter']);
$routes->get('/reports/pemasukan', 'ReportController::indexPemasukan', ['filter' => 'authfilter']);
$routes->get('/reports/pemasukan/generate-pdf/(:segment)/(:segment)', 'PDFController::pemasukanPDF/$1/$2', ['filter' => 'authfilter']);
$routes->get('/reports/pengeluaran', 'ReportController::indexPengeluaran', ['filter' => 'authfilter']);
$routes->get('/reports/pengeluaran/generate-pdf/(:segment)/(:segment)', 'PDFController::pengeluaranPDF/$1/$2', ['filter' => 'authfilter']);
$routes->addRedirect('/reportcontroller/(:any)', '/404');
/** Prevent access controller in url */
$routes->addRedirect('/authcontroller/(:any)', '/404');
$routes->addRedirect('/menuaccesscontroller/(:any)', '/404');
$routes->addRedirect('/pdfcontroller/(:any)', '/404');
/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
