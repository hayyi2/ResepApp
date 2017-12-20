<?php 

$app->post('/register[/]', function ($request, $response, $args) use ($app){
	$app->user = $app->db->user();

	if ($post = $request->getParams()) {
		$roles = array(
			'nama' 			=> array('requered', ),
			'username' 		=> array('requered', ),
			'password'		=> array('requered', ),
		);

		$allowed = array_keys($roles);
		if (!$app->helper->valid_input($post, $roles)) 
			return $app->helper->show_status(400);

		if ($app->user->where('username', $post['username'])->get()) 
			return $response->withJson('Username sudah digunakan.', 406);

		$post['password'] = sha1($post['password']);

		$data = $app->helper->array_input_filter($post, $allowed);

		$data['token'] = sha1(rand(1, 10000000000));
		$data['foto'] = "";
		$data['tanggal'] = $app->helper->datetime();

		$user_data = $app->user->create($data);

		$user_data = $app->user->select('user_id as userid, token')->get($user_data['user_id']);

		return $response->withJson($user_data, 200);
	}
	
	return $app->helper->show_status(404);
})->setName('register');

$app->get('/profile[/]', function ($request, $response, $args) use ($app){
	return $response->withJson($request->getAttribute('user_data'), 200);
})->setName('profile');

$app->group('/setting', function () use ($app){
	$app->user = $app->db->user();

	$this->post('/profile[/]', function ($request, $response, $args) use ($app){
		if ($post = $request->getParams()) {
			$roles = array(
				'nama' 			=> array('requered', ),
			);

			$allowed = array_keys($roles);
			if (!$app->helper->valid_input($post, $roles)) 
				return $app->helper->show_status(400);

			$data = $app->helper->array_input_filter($post, $allowed);

			$user_data = $request->getAttribute('user_data');
			$app->user->id($user_data['user_id'])->update($data);

			return $response->withJson($user_data, 204);
		}
		
		return $app->helper->show_status(404);
	})->setName('update-profile');

	$this->post('/password[/]', function ($request, $response, $args) use ($app){
		if ($post = $request->getParams()) {
			$roles = array(
				'password' 		=> array('requered', ),
				'last' 			=> array('requered', ),
			);

			$allowed = array_keys($roles);
			if (!$app->helper->valid_input($post, $roles)) 
				return $app->helper->show_status(400);

			$user_data = $request->getAttribute('user_data');
			$app->user->id($user_data['user_id'])->where('password', sha1($post['last']));

			if ($app->user->get()) {
				$app->user->update(array('password' => sha1($post['password'])));
				return $response->withJson("Success edit password.", 200);
			}else{
				return $response->withJson("Password lama salah.", 400);
			}
		}
		
		// return $app->helper->show_status(404);
	})->setName('update-password');
});

$app->group('/user', function () use ($app){
	$app->user = $app->db->user();

	$this->get('/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		$app->user->view('user_view');
		if ($data = $app->user->get($args['id'])) {
			return $response->withJson($data, 200);
		}
		
		return $response->withJson("User tidak ditemukan.", 404);
	})->setName('get-user');
});