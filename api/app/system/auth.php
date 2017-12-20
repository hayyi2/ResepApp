<?php

$app->add(function ($request, $response, $next) use ($app) {
	$route = $request->getAttribute('route');
	if ($route) {
		$route_name = $route->getName();

		if (in_array($route_name, $app->config->public_route)) {
			return $next($request, $response);
		}else{
			if ($request->hasHeader('userid') && $request->hasHeader('token')) {
				$user_id 	= $request->getHeader('userid');
				$user_id 	= end($user_id);
				$token 		= $request->getHeader('token');
				$token 		= end($token);

				$app->user = $app->db->user();
				$app->user->where('user_id', $user_id)->where('token', $token);

				if ($user_data = $app->user->select('user_id, nama, username, foto, tanggal')->get()) {
					$request = $request->withAttribute('user_data', $user_data);
					return $next($request, $response);
				}
			}

			return $app->helper->show_status(405);
		}
	}

	return $app->helper->show_status(404);
});

$app->post('/login[/]', function ($request, $response, $args) use ($app){
	if ($post = $request->getParams()) {
		$roles = array(
			'username' => array('requered', ),
			'password' => array('requered', ),
		);

		if (!$app->helper->valid_input($post, $roles)) 
			return $app->helper->show_status(400);

		$app->user = $app->db->user();
		$app->user->where('username', $post['username']);

		if ($user_data = $app->user->get()) {
			if ($user_data['password'] == sha1($post['password'])) {

				$app->user->update(array(
					'token' => sha1(rand(1, 10000000000)),
				));

				$return = $app->user->select('user_id as userid, token')->get();
				return $response->withJson($return, 200);
			}else{
				return $response->withJson("Password salah.", 406);
			}
		}else{
			return $response->withJson("Username salah.", 406);
		}
	}
	return $app->helper->show_status(404);
})->setName('login');

$app->post('/logout[/]', function ($request, $response, $args) use ($app){
	// $user_data = $request->getAttribute('user_data');

	// $app->user = $app->db->user();
	// $app->user->where('user_id', $user_data['user_id']);

	// $app->user->update(array(
	// 	'token' => "",
	// ));

	// return $response->withJson("Sukses logout", 200);
})->setName('logout');
