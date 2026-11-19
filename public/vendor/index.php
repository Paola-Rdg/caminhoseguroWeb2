<?php

declare(strict_types=1);

session_start();

spl_autoload_register(function (string $class) {
    $mapa = [
        'App\\' => __DIR__ . '/../app/',
        'Config\\' => __DIR__ . '/../config/',
    ];

    foreach ($mapa as $prefixo => $diretorio) {
        if (strncmp($prefixo, $class, strlen($prefixo)) === 0) {
            $relativo = str_replace('\\', '/', substr($class, strlen($prefixo)));
            $arquivo = $diretorio . $relativo . '.php';
            $arquivoMinusculo = $diretorio . strtolower($relativo) . '.php';

            if (file_exists($arquivo)) {
                require_once $arquivo;
                return;
            }
            if (file_exists($arquivoMinusculo)) {
                require_once $arquivoMinusculo;
                return;
            }
        }
    }
});

$url = $_GET['url'] ?? '';
if ($url === '') {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = '/caminhoseguroWeb2';
    if (strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base));
    }
    if (strpos($uri, '/public') === 0) {
        $uri = substr($uri, strlen('/public'));
    }
    $url = trim($uri, '/');
}

$partes = $url !== '' ? explode('/', $url) : [];

$controllerNome = !empty($partes[0]) ? ucfirst($partes[0]) . 'Controller' : 'HomeController';
$metodo = !empty($partes[1]) ? $partes[1] : 'index';
$parametros = array_slice($partes, 2);

$classeController = "App\\Controllers\\$controllerNome";

if (class_exists($classeController)) {
    $controller = new $classeController();
    if (method_exists($controller, $metodo)) {
        call_user_func_array([$controller, $metodo], $parametros);
        exit;
    }
}

http_response_code(404);
require_once __DIR__ . '/../app/Views/404.php';
