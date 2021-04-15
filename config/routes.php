<?php
$route['shl_framework']['default_controller'] = "front/home";

// HOME
$route['shl_framework']['/home'] = 'front/home';

// HALAMAN STATIS
$route['shl_framework']['/page/(.*)'] = 'front/general/statis/detail';
$route['shl_framework']['/info/'] = 'front/general/statis/';





?>