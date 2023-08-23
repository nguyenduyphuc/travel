<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->get('/', 'Home::index');

$con=mysqli_connect('localhost','root','');

mysqli_select_db($con,'travel') or die ("Koneksi DB gagal");

$query=mysqli_query($con,"select * from slugs");

while($row=mysqli_fetch_array($query))
{
    // if($row['filter'])
    // {
    //     $routes->get($row['slug'],$row['target'],['filter'=>$row['filter']]);
    // }
    // else
    // {
        $routes->get($row['slug'],$row['target']);
    // }
}

// Route CRUD Produk
$routes->group('admin/produk', static function ($routes) 
{
    $routes->get('', 'ProdukController');
    $routes->get('create', 'ProdukController::create');
    $routes->post('', 'ProdukController::store');
    $routes->get('edit/(:num)', 'ProdukController::edit/$1');
    $routes->put('(:num)', 'ProdukController::update/$1');
    $routes->delete('(:num)', 'ProdukController::destroy/$1');
});

// Route CRUD Kategori
$routes->group('admin/kategori', static function ($routes) 
{
    $routes->get('', 'KategoriController');
    $routes->get('create', 'KategoriController::create');
    $routes->post('', 'KategoriController::store');
    $routes->get('edit/(:num)', 'KategoriController::edit/$1');
    $routes->put('(:num)', 'KategoriController::update/$1');
    $routes->delete('(:num)', 'KategoriController::destroy/$1');
});

// Route CRUD Foto Produk
$routes->group('admin/foto-produk', static function ($routes) 
{
    $routes->get('', 'FotoProdukController');
    $routes->get('create', 'FotoProdukController::create');
    $routes->post('', 'FotoProdukController::store');
    $routes->get('edit/(:num)', 'FotoProdukController::edit/$1');
    $routes->put('(:num)', 'FotoProdukController::update/$1');
    $routes->delete('(:num)', 'FotoProdukController::destroy/$1');
});

// Route CRUD Galeri
$routes->group('admin/galeri', static function ($routes) 
{
    $routes->get('', 'GaleriController');
    $routes->get('create', 'GaleriController::create');
    $routes->post('', 'GaleriController::store');
    $routes->get('edit/(:num)', 'GaleriController::edit/$1');
    $routes->put('(:num)', 'GaleriController::update/$1');
    $routes->delete('(:num)', 'GaleriController::destroy/$1');
});

// Route CRUD Slug
$routes->group('admin/slug', static function ($routes) 
{
    $routes->get('', 'SlugController');
    $routes->get('create', 'SlugController::create');
    $routes->post('', 'SlugController::store');
    $routes->get('edit/(:num)', 'SlugController::edit/$1');
    $routes->put('(:num)', 'SlugController::update/$1');
    $routes->delete('(:num)', 'SlugController::destroy/$1');
});

// Route CRUD Produk Termasuk
$routes->group('admin/termasuk', static function ($routes) 
{
    $routes->get('', 'ProdukTermasukController');
    $routes->get('create', 'ProdukTermasukController::create');
    $routes->post('', 'ProdukTermasukController::store');
    $routes->get('edit/(:num)', 'ProdukTermasukController::edit/$1');
    $routes->put('(:num)', 'ProdukTermasukController::update/$1');
    $routes->delete('(:num)', 'ProdukTermasukController::destroy/$1');
});

// Route CRUD Produk Tak Termasuk
$routes->group('admin/tak-termasuk', static function ($routes) 
{
    $routes->get('', 'ProdukTakTermasukController');
    $routes->get('create', 'ProdukTakTermasukController::create');
    $routes->post('', 'ProdukTakTermasukController::store');
    $routes->get('edit/(:num)', 'ProdukTakTermasukController::edit/$1');
    $routes->put('(:num)', 'ProdukTakTermasukController::update/$1');
    $routes->delete('(:num)', 'ProdukTakTermasukController::destroy/$1');
});

// Route CRUD Ketentuan
$routes->group('admin/ketentuan', static function ($routes) 
{
    $routes->get('', 'KetentuanController');
    $routes->get('create', 'KetentuanController::create');
    $routes->post('', 'KetentuanController::store');
    $routes->get('edit/(:num)', 'KetentuanController::edit/$1');
    $routes->put('(:num)', 'KetentuanController::update/$1');
    $routes->delete('(:num)', 'KetentuanController::destroy/$1');
});

$routes->post('send-message','Home::sendMessage');

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
