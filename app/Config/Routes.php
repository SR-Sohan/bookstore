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



// Auth Routes
$routes->get("login","Admin\AuthController::index");
$routes->post("login","Admin\AuthController::index");
$routes->get("register","Admin\AuthController::register");
$routes->post("register","Admin\AuthController::register");
$routes->get('logout', 'Admin\AuthController::logout');

// Client Pannel Routes
$routes->group("/",static function($routes){
    
    $routes->get("","Home::index");


    // Categories Routes
    $routes->get("categories","Client\CategoriesController::index");
    $routes->get("categories/get","Client\CategoriesController::getCategories");

    // Publishers Routes
    $routes->get("publishers","Client\PublishersController::index");
    $routes->get("publishers/get","Client\PublishersController::getPublishers");

    // Authors Routes
    $routes->get("authors","Client\WrittersController::index");
    $routes->get("authors/get","Client\WrittersController::getAuthors");

    //Profile Routes
    $routes->get("profile","Client\ProfileController::index");
    $routes->get("profile/districts","Client\ProfileController::selectDistricts");
    $routes->get("profile/subcategories","Client\ProfileController::selectSubCategories");
    $routes->get("profile/books/get","Client\ProfileController::booksGet");
    $routes->post("profile/books/create","Client\ProfileController::booksCreates");
    $routes->post("profile/books/delete","Client\ProfileController::booksDelete");
});

// Admin Pannel Routes
$routes->group('admin',['filter' => 'admin'], static function ($routes) {
    $routes->get('', 'Admin\DashboardController::index');

    // Categories Routes
    $routes->get('categories', 'Admin\CategoriesController::index');
    $routes->get("categories/data",'Admin\CategoriesController::getCategories');
    $routes->post("categories/create",'Admin\CategoriesController::createCategories');
    $routes->post("categories/delete",'Admin\CategoriesController::deleteCategories');
    $routes->get("categories/search",'Admin\CategoriesController::searchCategories');    
    $routes->post("categories/autocomplete",'Admin\CategoriesController::autoComplete');

    // Subcategories Routes
    $routes->get('subcategories', 'Admin\SubCategoriesController::index');
    $routes->get("subcategories/data",'Admin\SubCategoriesController::getSubCategories');
    $routes->post("subcategories/create",'Admin\SubCategoriesController::createSubCategories');
    $routes->post("subcategories/delete",'Admin\SubCategoriesController::deleteSubCategories');
    $routes->post("subcategories/autocomplete",'Admin\SubCategoriesController::autoComplete');
    $routes->get("subcategories/search",'Admin\SubCategoriesController::searchSubCategories');
    $routes->get("subcategories/filter",'Admin\SubCategoriesController::filterSubCategories');

    // Writers Routes
    $routes->get('writers', 'Admin\WriterController::index');
    $routes->post('writers/create', 'Admin\WriterController::createWriter');
    $routes->get('writers/get', 'Admin\WriterController::getWriter');
    $routes->post('writers/delete', 'Admin\WriterController::deleteWriter');
    $routes->get('writers/search', 'Admin\WriterController::searchWriter');
    $routes->get('writers/filter', 'Admin\WriterController::filterWriter');
    $routes->post('writers/autocomplete', 'Admin\WriterController::completeWriter');

    //Publisher Routes
    $routes->get('publishers', 'Admin\PublisherController::index');
    $routes->get('publishers/get', 'Admin\PublisherController::getPublishers');
    $routes->post('publishers/create', 'Admin\PublisherController::createPublishers');
    $routes->post('publishers/delete', 'Admin\PublisherController::deletePublishers');
    $routes->post('publishers/autocomplete', 'Admin\PublisherController::autocompletePublishers');
    $routes->get('publishers/search', 'Admin\PublisherController::searchPublishers');




});



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
