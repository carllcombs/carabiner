<?php

// $router->get('/', function() {
//     return 'Hello World';
// });

// $router->get('/hello', function() {
//     return 'Hello from path';
// });

$router->any('/organisations', 'Controllers\Organisations');