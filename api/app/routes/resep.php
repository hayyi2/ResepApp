<?php 

$app->group('/resep', function () use ($app){

	$app->resep = $app->db->resep();
	
	$this->get('[/]', function ($request, $response, $args) use ($app){
		$app->resep->view('resep_view');
		return $response->withJson($app->resep->gets(), 200);
	})->setName('gets-resep');

	$this->get('/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		$app->resep->view('resep_view');
		if ($data = $app->resep->get($args['id'])) {
			$data['bahan_data'] = explode("\n", $data['bahan']);
			$data['cara_membuat_data'] = explode("\n", $data['cara_membuat']);
			return $response->withJson($data, 200);
		}
		return $response->withJson('Resep tidak ditemukan.', 200);
	})->setName('get-resep');

	$this->get('/category/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		$app->kategori = $app->db->kategori();
		if ($app->kategori->get($args['id'])) {
			$data = $app->resep->view('resep_view')->where('kategori_id', $args['id'])->gets();
			return $response->withJson($data, 200);
		}
		return $response->withJson('Kategori tidak ditemukan.', 404);
	})->setName('gets-resep-category');

	$this->get('/user/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		$app->user = $app->db->user();
		if ($app->user->get($args['id'])) {
			$data = $app->resep->view('resep_view')->where('user_id', $args['id'])->gets();
			return $response->withJson($data, 200);
		}
		return $response->withJson('User tidak ditemukan.', 404);
	})->setName('gets-user-category');

	$this->post('[/]', function ($request, $response, $args) use ($app){
		if ($post = $request->getParams()) {
			$post['gambar'] = "";

			$roles = array(
				'nama_resep' 	=> array('requered', ),
				'deskripsi'		=> array('requered', ),
				'bahan'			=> array('requered', ),
				'cara_membuat'	=> array('requered', ),
				'kategori_id'	=> array('requered', ),
				'gambar'		=> array('allow_null', ),
			);

			$allowed = array_keys($roles);
			if (!$app->helper->valid_input($post, $roles)) 
				return $app->helper->show_status(400);

			$directory = $this->get('upload_directory');

			$uploadedFiles = $request->getUploadedFiles();

			if (isset($uploadedFiles['gambar'])) {
				$uploadedFile = $uploadedFiles['gambar'];
				if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
					$post['gambar'] = moveUploadedFile($directory, $uploadedFile);
				}
			}

			$data = $app->helper->array_input_filter($post, $allowed);

			$user_data = $request->getAttribute('user_data');
			
			$data['user_id'] = $user_data['user_id'];
			$data['tanggal'] = $app->helper->datetime();
			$insert_id = $app->resep->create($data);
			
			return $response->withJson($insert_id, 200);
		}
		
		return $app->helper->show_status(404);
	})->setName('create-resep');

	$this->put('/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		$user_data = $request->getAttribute('user_data');
		
		$resep = $app->resep->id($args['id'])->where('user_id', $user_data['user_id']);

		if ($resep->get() && $put = $request->getParams()) {
			$put['gambar'] = "";

			$roles = array(
				'nama_resep' 	=> array('requered', ),
				'deskripsi'		=> array('requered', ),
				'bahan'			=> array('requered', ),
				'cara_membuat'	=> array('requered', ),
				'kategori_id'	=> array('requered', ),
				'gambar'		=> array('allow_null', ),
			);

			$allowed = array_keys($roles);
			if (!$app->helper->valid_input($put, $roles)) 
				return $app->helper->show_status(400);

			$data = $app->helper->array_input_filter($put, $allowed);

			if (!$data) return $app->helper->show_status(400);

			$new_data = $app->resep->update($data);
			
			return $response->withJson($new_data, 200);
		}

		return $app->helper->show_status(404);
	})->setName('update-resep');

	$this->delete('/{id:[0-9]+}[/]', function ($request, $response, $args) use ($app){
		
		$user_data = $request->getAttribute('user_data');
		
		$resep = $app->resep->id($args['id'])->where('user_id', $user_data['user_id']);

		if ($resep = $resep->get()) {
			if ($resep['gambar'] != "") {
				unlink('uploads/'.$resep['gambar']);
			}
			$app->resep->delete();
			
			return $response->withJson($args['id'], 204);
		}

		return $app->helper->show_status(404);

	})->setName('delete-resep');

});