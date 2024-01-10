<?php

use CodeIgniter\Router\RouteCollection;
// use Config\Filters;

/**
 * @var RouteCollection $routes
 */


//auth
// $routes->get('/login', 'UserController::index');
// $routes->post('/login/proccess', 'UserController::auth');
// // $routes->get('/register', 'UserController::register');
// $routes->post('/register/proccess', 'UserController::createUser');
// $routes->add('/register', 'Auth::register');
$routes->get('/register', 'AuthController::showRegisterForm');
$routes->post('/register', 'AuthController::register');
$routes->get('login', 'LoginController::showLoginForm');
$routes->post('login', 'LoginController::login');

$routes->group('', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('logout', 'LoginController::logout'); // Tambahkan rute untuk logout
    //dashboard
    $routes->get('/', 'DashboardController::index');
    $routes->get('/dashboard', 'DashboardController::index');
    //tambah dashboard
    // $routes->get('/dashboard-add/add/', 'DashboardController::add');
    $routes->post('/dashboard-add/save/(:alpha)', 'DashboardController::save/$1');
    //update dashboard
    // $routes->get('/dashboard-update/edit/(:num)/(:alpha)/', 'DashboardController::edit/$1/$2');
    $routes->post('/dashboard-update/update/(:num)/(:alpha)/', 'DashboardController::update/$1/$2');
    $routes->post('/dashboard-update/update/batch', 'DashboardController::updateBatchVisi');
    $routes->post('/dashboard-update/update/batch_misi', 'DashboardController::updateBatchMisi');
    //delete dashboard
    $routes->get('/dashboard-delete/(:num)','DashboardController::delete/$1');
    
    //Anggota
    $routes->get('/anggota', 'AnggotaController::index');
    $routes->get('/anggota-detail/(:num)', 'AnggotaController::detail/$1');
    //tambah anggota
    $routes->get('/anggota-add/', 'AnggotaController::add');
    $routes->post('/anggota-add/save/', 'AnggotaController::save');
    //update anggota
    $routes->get('/anggota-update/edit/(:num)', 'AnggotaController::edit/$1');
    $routes->post('/anggota-update/update/(:num)', 'AnggotaController::update/$1');
    //delete anggota
    $routes->get('/anggota-delete/(:num)','AnggotaController::delete/$1');
    $routes->post('/anggota-password/update/(:num)','AnggotaController::updatepassword/$1');
    
    //jadwal
    $routes->get('/jadwal', 'JadwalController::index');
    //tambah jadwal
    $routes->post('/jadwal-add/save/', 'JadwalController::save');
    //update jadwal
    $routes->post('/jadwal-update/update/(:num)', 'JadwalController::update/$1');
    //delete jadwal
    $routes->get('/jadwal-delete/(:num)','JadwalController::delete/$1');
    $routes->get('/jadwal-done/(:num)', 'JadwalController::doneKegiatan/$1');

    
    //kegiatan
    $routes->get('/kegiatan', 'KegiatanController::index');
    $routes->post('/kegiatan-add/save', 'KegiatanController::save');
    $routes->get('/kegiatan-update/view/(:num)/', 'KegiatanController::updateKegiatanview/$1');
    $routes->post('/kegiatan-update/(:num)', 'KegiatanController::update/$1');
    $routes->post('/kegiatan-update/add-image/(:num)', 'KegiatanController::addnewimage/$1');
    $routes->get('/kegiatan-delete/(:num)', 'KegiatanController::delete/$1');
    $routes->post('/kegiatan-update/gambar/(:num)','KegiatanController::updateGambarById/$1');
    $routes->get('/kegiatan-delete/gambar/(:num)', 'KegiatanController::deleteGambarById/$1');


    //laporan
    $routes->get('/laporan','LaporanController::index');
    $routes->get('/laporan/xls','LaporanController::createXls');

});    




