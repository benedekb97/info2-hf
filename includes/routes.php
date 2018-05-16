<?php

namespace Auto;

Router::get('', 'index.php', 'index');
Router::get('#login', 'index.php', 'index.login');

Router::get('cars', 'cars.php', 'cars');
Router::post('cars', 'cars.php', 'cars.search');
Router::get('mechanics', 'mechanics.php', 'mechanics');
Router::get('profile', 'profile.php', 'profile');
Router::get('services', 'services.php', 'services');

Router::get('user/{user}/fixes', 'user/fixes.php', 'user.fixes');
Router::get('user/{user}/cars', 'user/cars.php', 'user.cars');
Router::post('user/{user}/cars/add', 'user/add_car.php', 'user.cars.add');
Router::post('user/{user}/cars/delete/{car}', 'user/delete_car.php', 'user.cars.delete');
Router::post('user/{user}/service/delete/{service}', 'user/delete_service.php', 'user.services.delete');
Router::post('user/{user}/servce/new', 'user/add_service.php', 'user.service.add');

Router::post('login', 'redirect/login.php', 'login');
Router::get('logout', 'redirect/logout.php', 'logout');

Router::get('admin/services', 'admin/services/index.php', 'admin.services');
Router::post('admin/services/new', 'admin/services/new.php', 'admin.services.new');
Router::post('admin/services/modify/{service}', 'admin/services/modify.php', 'admin.services.modify');
Router::post('admin/services/delete/{service}', 'admin/services/delete.php', 'admin.services.delete');

Router::get('admin/cars', 'admin/cars/index.php', 'admin.cars');
Router::post('admin/cars/new', 'admin/cars/new.php', 'admin.cars.new');
Router::post('admin/cars/delete/{car}', 'admin/cars/delete.php', 'admin.cars.delete');
Router::post('admin/cars/modify/{car}', 'admin/cars/modify.php', 'admin.cars.modify');