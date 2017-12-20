<?php

class Helper
{
	protected $app;
	protected $container;

	function __construct($app)
	{
		$this->app = $app;
		$this->container = $this->app->getContainer();
	}

	function datetime($format = 'Y-m-d H:i:s')
	{
		return date($format);
	}

	public function show_status($status)
	{
		$data_status = array(
			400 => 'Bad Request',
			401 => 'Unauthorized',
			404 => 'Not Found',
			405 => 'Not allowed',
		);
        return $this->container['response']->withJson($data_status[$status], $status);
	}

	function valid_input( $data, $roles )
	{
		foreach ($roles as $input_name => $role) {
			// role harus ada
			if (in_array("requered", $role) && 
					(!isset($data[$input_name]) || 
						isset($data[$input_name]) && $data[$input_name] == null)){
				return false;
			}

			// role harus ada isinya
			if (in_array("allow_null", $role) && 
					!isset($data[$input_name])){
				return false;
			}

			// role tidak boleh berisi kosong boleh gak ada
			if (in_array("not_allow_null", $role) && 
					isset($data[$input_name]) && 
					$data[$input_name] == null){
				return false;
			}

			// role email
			// role panjang isi
		}
		return true;
	}

	function array_input_filter( $data, $allowed )
	{
		foreach ($data as $key => $value)
			if( !in_array($key, $allowed) )
				unset($data[$key]);

		return $data;
	}
}

$app->helper = new Helper($app);
