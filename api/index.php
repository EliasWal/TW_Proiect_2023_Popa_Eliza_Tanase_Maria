<?php
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

if (($pos = strpos($requestUri, '?')) !== false) {
    $requestUri = substr($requestUri, 0, $pos);
}

$basePath = '/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/';
$requestUri = str_replace($basePath, '', $requestUri);

$requestParts = explode('/', trim($requestUri, '/'));

$resource = isset($requestParts[0]) ? $requestParts[0] : '';
$id = isset($requestParts[1]) ? $requestParts[1] : '';
$controllerName = ucfirst($resource) . 'Controller';
$controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName;

    switch ($requestMethod) {
        case 'GET':
            if($id)
            $controller->get($id);
            else $controller->getAll();
            break;
        case 'POST':
            $controller->post();
            break;
        case 'PUT':
            $controller->put($id);
            break;
        case 'DELETE':
            $controller->delete($id);
            break;
        default:
            http_response_code(405);
            break;
    }
} else {
    http_response_code(404); 
}
?>
