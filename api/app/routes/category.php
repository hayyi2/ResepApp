<?php 

$app->group('/category', function () use ($app){

	$app->kategori = $app->db->kategori();
	
	$this->get('[/]', function ($request, $response, $args) use ($app){
		$app->kategori->view('kategori_view');
		return $response->withJson($app->kategori->gets(), 200);
	})->setName('gets-category');

	$this->get('/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		$app->kategori->view('kategori_view');
		if ($data = $app->kategori->get($args['id'])) {
			return $response->withJson($data, 200);
		}
		
		return $response->withJson("Kategori tidak ditemukan.", 404);
	})->setName('get-category');

});