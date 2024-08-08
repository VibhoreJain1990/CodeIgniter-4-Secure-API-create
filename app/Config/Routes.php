<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('user_register','Auth::register');

$routes->post('user_login','Auth::login');
$routes->options('user_login','Auth::login');

$routes->get('/', 'Home::index');
$routes->get('client', 'Client::index',['filter' => 'auth']);//vj added the filter to all other routes. 
$routes->post('client', 'Client::store',['filter' => 'auth']);
$routes->get('client/(:num)', 'Client::show/$1',['filter' => 'auth']);
$routes->post('client/(:num)', 'Client::update/$1',['filter' => 'auth']);
$routes->delete('client/(:num)', 'Client::destroy/$1',['filter' => 'auth']);

//Lets not using auth filter , just a get api to get some data from todos table. 
//and get it testing using post mann as soon as possible..
//ofcourse i will create the table using migrations. 
$routes->get('get_todos','Todos::index',['filter' => 'auth']);//now its a secure route, 
$routes->options('get_todos','Todos::index',['filter' => 'auth']);
//only the authenticated user can view this resource, i mean the person with jwt token(after login). 

$routes->post('create_todo', 'Todos::create');//soon you will be awake by me 
$routes->options('create_todo', 'Todos::create');//to using options to save ourself from preflight errors. 

//$routes->get('show_todo/(:num)', 'Todos::show/$1');

$routes->put('update_todo/(:num)', 'Todos::update/$1');
$routes->options('update_todo/(:num)', 'Todos::update/$1');

$routes->delete('delete_todo/(:num)', 'Todos::delete/$1');
$routes->options('delete_todo/(:num)', 'Todos::delete/$1');


