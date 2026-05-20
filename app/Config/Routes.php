<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login/(:any)', 'Auth::login/$1');
$routes->post('login', 'Auth::validar');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::guardar');
$routes->get('admin', 'Home::admin');
$routes->get('comprador', 'Home::comprador');
$routes->get('vendedor', 'Home::vendedor');
$routes->get('ubicaciones', 'Ubicaciones::index');
$routes->post('ubicaciones/guardar', 'Ubicaciones::guardar');
$routes->get('productos', 'Productos::index');
$routes->post('productos/guardar', 'Productos::guardar');
$routes->get('tienda', 'Tienda::index');
$routes->post('carrito/agregar', 'Carrito::agregar');
$routes->get('carrito', 'Carrito::ver');
$routes->get('carrito/eliminar/(:num)', 'Carrito::eliminar/$1');
$routes->get('carrito/vaciar', 'Carrito::vaciar');
$routes->get('ordenes', 'Orden::index');
$routes->post('orden/guardar', 'Orden::guardar');
$routes->get('orden/cambiar/(:num)/(:any)', 'Orden::cambiarEstado/$1/$2');
$routes->get('admin/usuarios', 'Admin::usuarios');
$routes->get('admin/eliminar/(:num)', 'Admin::eliminar/$1');
$routes->get('admin/productos', 'Admin::productos');
$routes->get('admin/producto/eliminar/(:num)', 'Admin::eliminarProducto/$1');
$routes->get('perfil', 'Usuarios::editar');
$routes->post('perfil/actualizar', 'Usuarios::actualizar');
$routes->post('orden/detalle/actualizar/(:num)', 'Orden::actualizarDetalle/$1');