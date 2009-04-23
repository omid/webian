<?php

class libdb
{
	protected $_config;
	protected $_connection;
	protected $_result;

	/**
	 * Constructor
	 *
	 * @param array $config
	 */
	public function __construct($config)
	{
		$this->_connect($config);
	}

	protected function _connect($config, $persistent = false)
	{
		if(!is_resource($this->_connection))
		{
			$this->_config = $config;
			$sqlite_connect = $persistent? 'sqlite_popen': 'sqlite_open';
			$this->_connection = $sqlite_connect($config['db'], $config['mode'], $error);
		}

		return $this->_connection;

	}

	protected function _disconnect()
	{
		@sqlite_close($this->_connection);
		$this->_connection = null;
	}

	protected function escape_string($data, $binary=false)
	{
		$escape_string = $binary? 'sqlite_udf_encode_binary': 'sqlite-escape-string';
		return $escape_string($data);
	}

	protected function filter($var)
	{
		$quote = true;//means at default need to quote input vars
		
		switch (strtolower ($var[1])){
			case 'int':
			case 'integer':
				$var[0] = intval($var[0]);
				$quote = false;
				break;

			case 'real':
			case 'float':
				$var[0] = floatval($var[0]);
				$quote = false;
				break;

			case 'text':
			case 'char':
			case 'varchar':
				$var[0] = $this->escape_string($var[0]);
				break;

			case 'blob':
				$var[0] = $this->escape_string($var[0], true);
				break;

			default:
				break;
		}

		if($quote){
			$val = '"' . $var[0] . '"';
		}else{
			$val = $var[0];
		}

		return $val;
	}

	/**
	 * Excute a query
	 *
	 * @param unknown_type $query
	 * @param unknown_type $params
	 */
	public function query($query, $params, $fetch=false)
	{
		if(!is_resource($this->_connection)){
			return false;
		}

		//? or :var

		$offset = 0;
		$num = substr_count($query, '?');

		if($num > 0){
			/*
			$params = array(
			array($value, $type)
			....
			);
			*/
			// if number of sql's ?s are different from array cellule's number
			if (count($vars) != $num){
				//print('VARS NOT MATCHED...' . count($vars) . '!=' . $num .'<br /><br />');
				return false;
			}

			$query_arr = explode('?', $query);
			$query = '';

			// check and escape variables
			for ($i=0; $i<$num; $i++){
				$quote = true;//means at default need to quote input vars
				switch (strtolower ($vars[$i][1])){
					case 'int':
					case 'integer':
						$vars[$i][0] = intval($vars[$i][0]);
						$quote = false;
						break;

					case 'real':
					case 'float':
						$vars[$i][0] = floatval($vars[$i][0]);
						$quote = false;
						break;

					case 'text':
					case 'char':
					case 'varchar':
						$vars[$i][0] = $this->escape_string($vars[$i][0]);
						break;

					case 'blob':
						$vars[$i][0] = $this->escape_string($vars[$i][0], true);
						break;

					default:
						break;
				}

				// replace with first ? sign
				if($quote){
					$query .= $query_arr[$i] . '"' . $vars[$i][0] . '"';
				}else{
					$query .= $query_arr[$i] . $vars[$i][0];
				}
			}
			$query .= $query_arr[$i]; //Add last part of splited query to the end of the query
		}else{
			/*
			$params = array(
			$var => array($value, $type)
			....
			);
			*/
			$query = preg_replace('/:([^\s]+)/ie', "\$this->filter(\$params['\\1'])", $query);

		}


		if($this->result = sqlite_query($this->_connection, $query)){
			if($fetch){
				return $this->fetch_all();
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	public function free_result()
	{
		$this->result = null;
	}

	public function fetch($type=SQLITE_ASSOC)
	{
		if(!is_resource($this->result)){
			return false;
		}
		return sqlite_fetch($this->result, $type);
	}

	public function fetch_all($type=SQLITE_ASSOC)
	{
		if(!is_resource($this->result)){
			return false;
		}
		return sqlite_fetch_all($this->result, $type);
	}

	public function num_rows()
	{
		return @sqlite_num_rows($this->result);
	}

	/**
	 * Gets the last insert id
	 *
	 */
	public function last_insert_id()
	{
		return @sqlite_last_insert_rowid($this->_connection);
	}

	public function affected_rows()
	{
		return sqlite_changes($this->_connection);
	}

}