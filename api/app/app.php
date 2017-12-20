<?php

date_default_timezone_set("Asia/Jakarta");

use Slim\Http\UploadedFile;

$app = new \Slim\App(["settings" => [
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => true
	]
]);

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
});

$app->add(function($request, $response, $next) {
    $route = $request->getAttribute("route");

    $methods = [];

    if (!empty($route)) {
        $pattern = $route->getPattern();

        foreach ($this->router->getRoutes() as $route) {
            if ($pattern === $route->getPattern()) {
                $methods = array_merge_recursive($methods, $route->getMethods());
            }
        }
    } else {
        $methods[] = $request->getMethod();
    }

    $response = $next($request, $response);

    return $response->withHeader("Access-Control-Allow-Methods", implode(",", $methods));
});

$container = $app->getContainer();
$container['upload_directory'] = './uploads';

$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container['response']->withJson('Not Found', 404);
    };
};

$container['notAllowedHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container['response']->withJson('Not allowed', 405);
    };
};

function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $filename = 'resep'. date('YmdHis') . '.' .$extension;

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

require __DIR__ . '/system/config.php';
require __DIR__ . '/system/connect.php';
require __DIR__ . '/system/model.php';

$config_db = $app->config->database;
$app->db = new Connect($config_db['host'], $config_db['user'], $config_db['pass'], $config_db['dbname']);

require __DIR__ . '/system/helper.php';
require __DIR__ . '/system/auth.php';

foreach (glob(__DIR__ . '/routes/*.php') as $file_name) {
    include $file_name;
}

$app->run();
