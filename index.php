<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('projects', 'DefaultController');
Routing::get('gotohotel', 'DefaultController');
Routing::get('gotoroom', 'DefaultController');
Routing::get('delhotel', 'HotelController');
Routing::post('login', 'SecurityController');
Routing::post('addhotel', 'HotelController');
Routing::post('register', 'SecurityController');

Routing::run($path);