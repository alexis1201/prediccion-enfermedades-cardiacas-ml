<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('heart-disease', 'Home::index');
$routes->post('heart-disease/predict', 'Home::predict');
