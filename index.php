<?php
require_once 'vendor/autoload.php';

use Controller\IndexController;

// Parse the URI to determine the requested route
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Routing logic
if ($uri === '/php-pdo-namespaces/' || $uri === '/php-pdo-namespaces/index.php') {
    $controller = new IndexController();
    $controller->index();
} else {
    http_response_code(404);
    echo "404 - Page not found";
}
