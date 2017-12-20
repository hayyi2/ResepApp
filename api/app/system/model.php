<?php 

class Model
{
	private $pdo; 			// variabel koneksi database dengan pdo
	private $table; 		// variabel nama tabel
	private $temp_tabel = false; // variabel nama tabel yang disimpan ketika menggunakan abel view
	private $id; 			// variabel primary key tabel atau tabel view
	private $temp_id = false; // variabel nama data primary key yang disimpan ketika menggunakna id()
	private $query = array(	// variabel query dalam bentuk array yang digunakan untuk dasar pembuatan query
		'select'	=> '*',		// array('colom', ...) | 'colom, ...'
		'where'		=> array(), // array(array('kind' => 'and|or', 'kind' =>'rule'), ...)
		'limit'		=> false,	// array(number => number, start => start)
		'order'		=> false,	// array('colomn' => 'asd|desc', ...)
		'join'		=> array(),	// array(array('table' => 'column'|array('left|right|false')), ...)
	);

	private $bind_param = array(); // variabel bind yang digunakan untuk parameter query

	private $no = 1; // variabel pembeda antar index bind param

	# persiapan model

	/**
	* construct digunakan untuk membuat konesi ke database dan tabel
	* 
	* parameter
	* $pdo adalah parameter koneksi database dengan pdo 
	* $table adalah parameter untuk mengenalkan nama tabel yang akan diolah
	* $id adalah parameter untuk mengenalkan primary key pada tabel
	*/
	function __construct($pdo, $table, $id)
	{
		$this->pdo      = $pdo;
		$this->table    = $table;
		$this->id       = $id;
	}

	/**
	* set_table digunakan merubah nama tabel
	* 
	* parameter
	* $table adalah parameter nama tabel baru yang digunakan
	*/
	public function set_table($table)
	{
		$this->table = $table;
		return $this;
	}

	/**
	* set_id digunakan merubah primary key pada tabel
	* 
	* parameter
	* $id adalah parameter primary key yang baru
	*/
	public function set_id($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	* view digunakan menggunakan view atau menonaktifkan view
	* 
	* parameter
	* [$table_view] adalah parameter nama view yang digunakan 
	* jika bernilai false maka akan kembali menggunakan tabel atau menonaktifkan view
	*/
	public function view($table_view = false)
	{
		if (!$table_view) {
			if ($this->temp_tabel !== false) {
				$this->table = $this->temp_tabel;
			}
		}else{
			if ($this->temp_tabel === false) {
				$this->temp_tabel = $this->table;
			}
			$this->table = $table_view;
		}
		return $this;
	}

	# persiapan pemangilan data

	/**
	* select mengenalkan kolom apasaja yang akan di select
	* 
	* parameter
	* $value adalah parameter nama colom yang akan di select bisa berbentuk array index angka atau string
	*/
	public function select($value)
	{
		if (is_array($value)) {
			$this->query['select'] = implode(', ', $value);
		}else{
			$this->query['select'] = $value;
		}

		return $this;
	}

	/**
	* where fungsi untuk menseleksi data atau menjalankan query where
	* fungsi ini adalah fungsi master untuk fungsi where lainnya
	* 
	* parameter
	* $args adalah parameter yang memiliki 2 bentuk 
	* array asosiasi : rules dari where
	* bentuk array adalah array('columnn' => 'bind'|array('bind', 'separator|separator_where', ['separator_where']), ...) separator_where optional
	* ketika menggunakan array maka parameter selain $separator_where tidak berguna 
	* string : jika dalam bentuk string maka $args adalah nama colom
	* [$bind] adalah variabel sarat dari colom 
	* [$separator] adalah variabel rule where (=, <, >, <=, >=) defaultnya adalah =
	* [$separator_where] adlah variabel yang menghubungkan rule satu dengan rule lainnya (and, or) defaultnya and
	*/
	public function where($args, $bind = false, $separator = "=", $separator_where = "and")
	{
		if (is_array($args)) {
			foreach ($args as $column => $data) {
				if (!is_array($data)) {
					$rule = $column . " = :" . $column . $this->no;
					$this->query['where'][] = array('kind' => $separator_where, 'rule' => $rule);
					$this->bind_param[$column . $this->no] = $data;
					$this->no++;
				}elseif (count($data) == 2) {
					if ($data[1] == "or" || $data[1] == "and") {
						$rule = $column . " = :" . $column . $this->no;
						$this->query['where'][] = array('kind' => $data[1], 'rule' => $rule);
						$this->bind_param[$column . $this->no] = $data[0];
						$this->no++;
					}else{
						$rule = $column . " ";
						if ($data[1] !== false) {
							$rule .=  " " . $data[1];
						}
						$rule .= " :" . $column . $this->no;
						$this->query['where'][] = array('kind' => 'and', 'rule' => $rule);
						$this->bind_param[$column . $this->no] = $data[0];
						$this->no++;
					}
				}else{
					$rule = $column . " " . $data[1] . " :" . $column . $this->no;
					$this->query['where'][] = array('kind' => $data[2], 'rule' => $rule);
					$this->bind_param[$column . $this->no] = $data[0];
					$this->no++;
				}
			}
		}else{
			$column = $args;
			$rule = $column;
			if ($separator !== false) {
				$rule .=  " " . $separator;
			}
			$rule .= " :" . $column . $this->no;
			$this->query['where'][] = array('kind' => $separator_where, 'rule' => $rule);
			$this->bind_param[$column . $this->no] = $bind;
			$this->no++;
		}
		return $this;
	}

	/**
	* and_where fungsi untuk menseleksi data dengan penghubung or
	* 
	* parameter
	* sama seperti fungsi where namun $separator_where adalah or
	* $args
	* [$bind]
	* [$separator]
	*/
	public function or_where($args, $bind = false, $separator = "=")
	{
		return $this->where($args, $bind, $separator, 'or');
	}

	/**
	* and_where fungsi untuk menseleksi data dimana primary keynya harus sesuai
	* 
	* parameter
	* $id adalah variabel priary key yang digunakan sebagai sarat
	*/
	public function id($id)
	{
		if (is_array($id)) {
			$this->where($id);
		}else{
			if ($this->temp_id !== false && isset($this->bind_param[$this->temp_id[0]])) {
				$this->bind_param[$this->temp_id[0]] = $id;
			}else{
				$this->where($this->id, $id);
				$bind_key = array_keys($this->bind_param);
				$where_key = array_keys($this->query['where']);
				$this->temp_id = array(end($bind_key), end($where_key));
			}

		}
		return $this;
	}

	/**
	* limit fungsi menjalankan query limit
	* 
	* parameter
	* $number adalah variabel jumlah data limit
	* $start adalah variabel mulai query
	*/
	public function limit($number, $start = 0)
	{
		$this->query['limit'] = array('number' => $number, 'start' => $start);
		return $this;
	}

	/**
	* limit fungsi menjalankan query order
	* 
	* parameter
	* $args memiliki 2 bentuk 
	* array : digunakan untuk order multi columnn
	* mormat array [columnn => asc|desc]
	* string : digunakan untuk order satu columnn
	* $order adalah jenis order (asc|desc)
	*/
	public function order($args, $order = "asc")
	{
		if (is_array($args)) {
			$this->query['order'] = array_merge($this->query['order'], $args);
		}else{
			$this->query['order'][$args] = $order;
		}
		return $this;
	}


	/**
	* join fungsi menjalankan query join
	* 
	* parameter
	* $args memiliki 2 bentuk 
	* array : digunakan untuk join multi
	* format array ['column' => ['rule' | ['rule', 'kind']]]
	* jika menggunakan format array maka parameter lain tidak digunakan
	* string : digunakan untuk nama tabel yang di join
	* $rule adalah sarat join
	* $kind adalah variabel jenis join (left|right|false) default = false
	*/
	public function join($args, $rule = false, $kind = false)
	{
		if (is_array($args)) {
			foreach ($args as $table => $rule) {
				if (is_array($rule)) {
					$this->query['join'][] = array($rule[1], $table, $rule[0]);
				}else{
					$this->query['join'][] = array($kind, $table, $rule);
				}
			}
		}else{
			$this->query['join'][] = array($kind, $args, $rule);
		}
		return $this;
	}

	/**
	* left_join fungsi untuk menjalankan query left join
	* 
	* parameter
	* sama seperti fungsi join namun $kind di inisialisai left
	*/
	public function left_join($args, $rule = false)
	{
		return $this->join($args, $rule, 'left');
	}

	/**
	* right_join fungsi untuk menjalankan query right join
	* 
	* parameter
	* sama seperti fungsi join namun $kind di inisialisai right
	*/
	public function right_join($args, $rule = false)
	{
		return $this->join($args, $rule, 'right');
	}

	/**
	* where_query adalah fungsi untuk mendapatkan query where
	*/
	public function where_query()
	{
		$query = "";
		if ($where = $this->query['where']) {
			$query_where = " where ";
			foreach ($where as $no => $where_item) {
				if ($no != 0) {
					$query_where .= " " . $where_item['kind'] . " ";
				}
				$query_where .= $where_item['rule'];
			}
			$query .= $query_where;
		}
		return $query;
	}

	/**
	* query adalah fungsi untuk mendapatkan query yang akan dijalankan untuk fungsi get dan gets
	*/
	public function query()
	{
		$query = "select " . $this->query['select'] . " from " . $this->table;

		if ($join = $this->query['join']) {
			$query_join = " ";
			foreach ($join as $index => $join_item) {
				if ($index != 0) {
					$query_join .= " ";
				}
				if ($join_item[0] !== false) {
					$query_join .= $join_item[0] . " ";
				}
				$query_join .= "join ";
				$query_join .= $join_item[1];
				$query_join .= " on ";
				$query_join .= $join_item[2];
			}
			$query .= $query_join;
		}

		$query .= $this->where_query();

		if ($order = $this->query['order']) {
			$query .= ' order by ';
			$no = 1;
			foreach ($order as $column => $order) {
				if ($no++ > 1) $query .= ", ";
				$query .= $column . " " . $order;
			}
		}

		if ($limit = $this->query['limit']) {
			$query .= " limit " . $limit['number'] . " offset ". $limit['start'];
		}

		return $query;
	}
	/**
	* bind adalah fungsi untuk mendapatkan data bind query
	*/
	public function bind()
	{
		return $this->bind_param;
	}

	# pemangilan data

	/**
	* gets adalah fungsi untuk mendapatkan medapatkan data
	*/
	public function gets()
	{
		$result = $this->pdo->prepare($this->query());
		$result->execute($this->bind_param);

		$result = $result->fetchAll();
		return (count($result)) ? $result : false;
	}

	/**
	* get adalah fungsi untuk mendapatkan medapatkan satu row data
	*/
	public function get($id = false)
	{
		if ($id !== false) {
			$this->id($id);
		}
		if ($result = $this->gets()) {
			return $result[0];
		}
		return false;
	}

	/**
	* row adalah fungsi untuk mendapatkan jumlah row data
	*/
	public function row()
	{
		return count($this->gets());
	}

	# reset query

	/**
	* reset adalah fungsi untuk mereset query array dan bind data
	* 
	* parameter
	* $index adalah parameter index query apa yang dihapus default mereset semua query
	*/
	public function reset($index = false)
	{
		$start = array(
			'select'		=> '*',
			'where'         => array(),
			'limit'         => false,
			'order'         => false,
			'join'          => array(),
		);

		if (!$index) {
			$this->query = $start;
			$this->bind_param = array();
		}else{
			if ($index == 'id') {
				unset($this->bind_param[$this->temp_id[0]]);
				unset($this->query['where'][$this->temp_id[1]]);
			}else{
				if ($index == 'where') {
					$this->bind_param = array();
				}
				$this->query[$index] = $start[$index];
			}
		}
		return $this;
	}

	# insert data

	/**
	* create adalah fungsi untuk input data
	* bisa melakukan insert multi dengan menggunakan array sequence dengan sarat kolom pada index pertama harus sama seterusnya
	* 
	* parameter
	* $args adalah parameter array data
	* terdapat 2 jenis 
	* array assosiative untuk inset satu data
	* format [colom => field, ...]
	* array sewuence untuk inset multi data
	* format [[colom => field, ...], ...]
	*/
	public function create( $args )
	{
		if ($this->temp_id === false && count($this->query['where']) > 1) {
			$this->reset('where');
		}

		$bind = array();
		$query = "insert into ".$this->table;
		if (array_keys($args) === range(0, count($args) - 1)){
			$query .= " (" . implode(", ", array_keys($args[0])) . ") ";
			$query .= " values ";
			foreach ($args as $index => $data) {
				if ($index != 0) {
					$query .= ", ";
				}
				$query .= " (";
				$no_column = 1;
				foreach ($data as $column => $field) {
					if ($no_column++ != 1) {
						$query .= ", ";
					}
					$query .= " :".$column.$index;
					$bind[$column.$index] = $field;
				}
				$query .= ") ";
			}
		}else{
			$query .= " (" . implode(", ", array_keys($args)) . ") ";
			$query .= " values ";
			$query .= " ( ";
			$no_column = 1;
			foreach ($args as $column => $field) {
				if ($no_column++ != 1) {
					$query .= ", ";
				}
				$query .= " :".$column;
				$bind[$column] = $field;
			}
			$query .= " ) ";
		}

		$result = $this->pdo->prepare($query);
		$result->execute($bind);

		return $this->get($this->pdo->lastInsertId());
	}

	/**
	* create_bulk adalah fungsi untuk input multi data
	* 
	* parameter
	* $args adalah parameter data yang di inset column data antara index 1 dan yang lain boleh berbeda
	* format [[colom => field, ...], ...]
	*/
	public function create_bulk( $args )
	{
		$insert_id = array();
		foreach ($args as $key => $value) {
			$insert_id[] = $this->create($value);
		}
		return $insert_id;
	}

	/**
	* update adalah fungsi untuk update data
	* 
	* parameter
	* $args adalah parameter data yang di update
	* format [[colom => field, ...], ...]
	*/
	public function update($args, $id = false )
	{
		$temp_where = false;
		if ($id !== false) {
			$temp_where['bind'] = $this->bind_param;
			$temp_where['where'] = $this->query['where'];
			$this->reset('where');
			$this->id($id);
		}
		$bind = $this->bind_param;
		$query = "update " . $this->table . " SET";

		$no_column = 1;
		foreach ($args as $column => $field) {
			if ($no_column++ != 1) {
				$query .= ", ";
			}
			$query .= " " . $column . " = :" . $column.'update';
			$bind[$column.'update'] = $field;
		}
		$query .= $this->where_query();

		$result = $this->pdo->prepare($query);
		$result->execute($bind);

		if ($id !== false) {
			$this->bind_param = $temp_where['bind'];
			$this->query['where'] = $temp_where['where'];
		}

		return $this->get();
	}

	/**
	* delete adalah fungsi untuk delete data
	*/
	public function delete($id = false)
	{
		$temp_where = false;
		if ($id !== false) {
			$temp_where['bind'] = $this->bind_param;
			$temp_where['where'] = $this->query['where'];
			$this->reset('where');
			$this->id($id);
		}
		$query = "delete from " . $this->table . $this->where_query();
		$result = $this->pdo->prepare($query);
		if ($bind_param = $this->bind_param) {
			$success = $result->execute($bind_param);
		}else{
			$success = $result->execute();
		}

		if ($id !== false) {
			$this->bind_param = $temp_where['bind'];
			$this->query['where'] = $temp_where['where'];
		}else{
			$this->reset('where');
		}
		return $success;
	}

}

