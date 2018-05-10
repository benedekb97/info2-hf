<?php

namespace Auto;

Router::get('', 'index.php', 'index');
Router::get('#login', 'index.php', 'index.login');

Router::get('cars', 'cars.php', 'cars');
Router::get('mechanics', 'mechanics.php', 'mechanics');
Router::get('profile', 'profile.php', 'profile');
Router::get('services', 'services.php', 'services');

Router::get('user/{user}/fixes', 'user/fixes.php', 'user.fixes');
Router::get('user/{user}/cars', 'user/cars.php', 'user.cars');
Router::post('user/{user}/cars/add', 'user/add_car.php', 'user.cars.add');
Router::post('user/{user}/cars/delete/{car}', 'user/delete_car.php', 'user.cars.delete');

Router::post('login', 'redirect/login.php', 'login');
Router::get('logout', 'redirect/logout.php', 'logout');