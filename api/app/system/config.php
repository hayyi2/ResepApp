<?php

class Config
{
	public $database = array(
		'host'		=> 'localhost',
		'user'		=> 'root',
		'pass'		=> '',
		'dbname'	=> 'resep_app_db',
	);

	public $public_route = array(
		'gets-category',
		'get-category',
		'get-user',
		'login',
		'register',
		'gets-resep',
		'get-resep',
		'gets-resep-category',
		'gets-user-category',
	);
}

$app->config = new Config();