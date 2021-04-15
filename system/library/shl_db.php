<?php
class shl_db
{
	static $objselect = "*";
	static $objjoin;
	static $objwhere;
	static $objorder;
	static $objgroup;
	static $objtable;
	static $objlimit;

	static $sqlquery;
	static $directquery;
	static $parameter = array();

	static $last_insert_id = "";

	static $debugsqlquery;
	static $debugparameter = array();

	static $server;
	static $username;
	static $password;
	static $database;
	static $port;

	static $dbh;

	static $fetch_mode;
	static $fetch_mode_config;

	static function open_connection()
	{
		global $db;
		$db = (isset($db['shl_framework'])) ? $db['shl_framework'] : "";
		if (empty(self::$server))
		{
			self::$server = $db['server'];
			self::$username = $db['username'];
			self::$password = $db['password'];
			self::$database = $db['database'];
			self::$port = $db['port'];
			self::$fetch_mode_config = $db['fetch_mode'];
		}

		$options = [PDO::ATTR_PERSISTENT => true];
		self::$dbh = new PDO("mysql:host=".self::$server."; port=".self::$port."; dbname=".self::$database.";",self::$username,self::$password, $options);
		self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	static function reset()
	{
		self::$debugsqlquery = self::$sqlquery;
		self::$debugparameter = self::$parameter;
		self::$objselect = "*";
		self::$objjoin = "";
		self::$objwhere = "";
		self::$objorder = "";
		self::$objgroup = "";
		self::$objtable = "";
		self::$sqlquery = "";
		self::$objlimit = "";
		self::$sqlquery = "";
		self::$directquery = "";
		self::$parameter = array();
	}

	static function show_error($e)
	{
		$debug = debug_backtrace();

		$filename = $debug[2]['file'];
		$classname = (isset($debug[3]['class'])) ? $debug[3]['class'] : "";
		$functionname = (isset($debug[3]['function'])) ? $debug[3]['function'] : "";
		$line = $debug[2]['line'];
		
		$func = ""; $source = "";
		if (class_exists($classname))
		{
			$func = new ReflectionMethod($classname, $functionname);
			$source = file($filename);
			$source = "<pre>".implode("", array_slice($source, $line - 3,5))."</pre>";
		}
		
			
		$err['errorheading'] = "SQL Syntak Error ";
		$err['errordescription'] = "<p>Error Message = ".$e->getMessage()."</p>". 
									"<p>Error Code = ".strval($e->getCode())."</p>".
									"<p>Raw SQL = ".self::debug(self::$sqlquery,self::$parameter)."</p>".
									"<p>Filename = ".$filename."</p>".
									"<p>Line Number = ".$line."</p>".
									"<p>Source Code = ".$source."</p>";

		shl_loader::error("database",$err);	
	}

	/**
	 * Set fetch mode PDO::FETCH_ASSOC, PDO::FETCH_BOTH, PDO::FETCH_OBJ
	 * @param PDOStatement $mode 
	 * @return shl_db
	 */
	static function fetch_mode($mode)
	{
		self::$fetch_mode = $mode;
		return new self;
	}

	// ============================================= Transaction ============================================ //

	static function begin_transaction()
	{


		if (empty(self::$dbh))
		{
			self::open_connection();
		}
		self::$dbh->beginTransaction();
	}

	static function commit()
	{
		
		self::$dbh->commit();
	}

	static function rollback()
	{
		self::$dbh->rollBack();
	}



	// ============================================= SELECT TABLE & OTHERS ============================================ //

	static function select($column = '')
	{
		if (is_array($column))
		{
			$column = implode(",",$column);
		}

		self::$objselect = " ".$column;
		return new self;
	}

	static function table($table = '')
	{
		self::$objtable = $table." ";
		return new self;
	}

	static function distinct()
	{
		self::$objselect = "distinct ".self::$objselect;
		return new self;
	}

	static function debug($sql = '', $parameter = array())
	{
		self::$debugsqlquery = (empty($sql)) ? self::$debugsqlquery : $sql;
		self::$debugparameter = (empty($parameter)) ? self::$debugparameter : $parameter;

		$params = "";

		$stmt = preg_replace_callback(
			'/[?]/', 
			function ($k) use ($params)
			{
				static $i = 0;
				return sprintf("'%s'", self::$debugparameter[$i++]);
			}
			, self::$debugsqlquery);
		return $stmt;
	}
	
	// ============================================= END SELECT TABLE & OTHERS ============================================ //
	





	// ============================================= JOIN TABLE ============================================ //

	static function join($childtable, $parentcolumn = '',$operator = '',$childcolumn = '')
	{
		if (empty($parentcolumn))
		{
			sefl::$objjoin = " join ".$childtable;
		}
		else 
		{
			if (empty($childcolumn))
			{
				$childcolumn = $operator;
				$operator = '=';
			}

			self::$objjoin .= " join ".$childtable." on ".$parentcolumn." ".$operator." ".$childcolumn;
		}

		return new self;
	}

	static function left_join($childtable, $parentcolumn = '',$operator = '',$childcolumn = '')
	{
		if (empty($parentcolumn))
		{
			sefl::$objjoin = " left join".$childtable;
		}
		else 
		{
			if (empty($childcolumn))
			{
				$childcolumn = $operator;
				$operator = '=';
			}

			self::$objjoin .= " left join ".$childtable." on ".$parentcolumn." ".$operator." ".$childcolumn;
		}

		return new self;
	}

	static function right_join($childtable, $parentcolumn = '',$operator = '',$childcolumn = '')
	{
		if (empty($parentcolumn))
		{
			sefl::$objjoin = " right join".$childtable;
		}
		else 
		{
			if (empty($childcolumn))
			{
				$childcolumn = $operator;
				$operator = '=';
			}

			self::$objjoin .= " right join ".$childtable." on ".$parentcolumn." ".$operator." ".$childcolumn;
		}

		return new self;
	}

	// ============================================= END JOIN TABLE ============================================ //






	// ============================================= WHERE ============================================ //

	static function where($column = '', $operator = '', $param = '')
	{
		if (is_callable($column))
		{
			if (empty(self::$objwhere))
			{
				self::$objwhere = " where ( ";	
			}
			else 
			{
				self::$objwhere .= " and ( ";
			}
			call_user_func($column);
			self::$objwhere .= ") ";
		}
		else
		{
			if (empty($param))
			{
				$param = $operator;
				$operator = '=';
			}

			self::$parameter = array_merge(self::$parameter, array($param));

			if (empty(self::$objwhere))
			{
				self::$objwhere = " where ";	
			}
			else 
			{
				$group = substr(trim(self::$objwhere), - 1);
				if ($group == "(")
				{
					self::$objwhere = " ".substr(trim(self::$objwhere), 0, -1);
					self::$objwhere .= " ( ";
				}
				else
				{
					self::$objwhere .= " and ";
				}
			}
		
			self::$objwhere .= $column." ".$operator." ?";
		
		}
		return new self;
	}

	static function or_where($column = '', $operator = '', $param = '')
	{
		if (is_callable($column))
		{
			if (empty(self::$objwhere))
			{
				self::$objwhere = " where ( ";	
			}
			else 
			{
				self::$objwhere .= " or ( ";
			}
			call_user_func($column);
			self::$objwhere .= ") ";
		}
		else
		{
			if (empty($operator) && empty($operator))
			{
				self::$objwhere = $column;
				return new self;
			}

			if (empty($param))
			{
				$param = $operator;
				$operator = '=';
			}

			self::$parameter = array_merge(self::$parameter, array($param));

			if (empty(self::$objwhere))
			{
				self::$objwhere = " where ";	
			}
			else 
			{
				self::$objwhere .= " or ";
			}
		
			self::$objwhere .= $column." ".$operator." ? ";
		
		}
		return new self;
	}

	static function between($column,$range = '')
	{
		if (empty($range))
		{
			$range = $column;
			$column = $operator;
			//$operator = " and ";
		}

		if (!is_array($range))
		{
			$range = explode(",",$range);
		}
		self::$parameter = array_merge(self::$parameter, $range);

		if (empty(self::$objwhere))
		{
			self::$objwhere = " where ";	
		}
		else 
		{
			//self::$objwhere .= " ".$operator." ";
		}

		self::$objwhere .= " ".$column." between ? and ?";
				
		return new self;
	}

	static function not_between($operator,$column,$range = '')
	{
		if (empty($range))
		{
			$range = $column;
			$column = $operator;
			//$operator = " and ";
		}

		if (!is_array($range))
		{
			$range = explode(",",$range);
		}
		self::$parameter = array_merge(self::$parameter, $range);

		if (empty(self::$objwhere))
		{
			self::$objwhere = " where ";	
		}
		else 
		{
			//self::$objwhere .= " ".$operator." ";
		}

		self::$objwhere .= " ".$column." not between ? and ?";
				
		return new self;
	}

	static function where_in($operator,$column,$range = '')
	{
		if (empty($range))
		{
			$range = $column;
			$column = $operator;
			//$operator = " and ";
		}

		if (!is_array($range))
		{
			$range = explode(",",$range);
		}
		self::$parameter = array_merge(self::$parameter, $range);

		if (empty(self::$objwhere))
		{
			self::$objwhere = " where ";	
		}
		else 
		{
			//self::$objwhere .= " ".$operator." ";
		}

		if (is_array($range))
		{
			// change elements array with ?
			$range = array_map(function() {return "?"; }, $range);
			$range = implode(",",$range);
		}

		self::$objwhere .= " ".$column." in (".$range.")";
		
		return new self;
	}

	static function where_not_in($operator,$column,$range = '')
	{
		
		if (empty($range))
		{
			$range = $column;
			$column = $operator;
			//$operator = " and ";
		}
		

		if (!is_array($range))
		{
			$range = explode(",",$range);
		}
		self::$parameter = array_merge(self::$parameter, $range);

		if (empty(self::$objwhere))
		{
			self::$objwhere = " where ";	
		}
		else 
		{
			//self::$objwhere .= " ".$operator." ";
		}

		if (is_array($range))
		{
			// change elements array with ?
			$range = array_map(function() {return "?"; }, $range);
			$range = implode(",",$range);
		}

		self::$objwhere .= " ".$column." not in (".$range.")";

		return new self;
	}

	static function where_raw($where)
	{
		self::$objwhere .= $where;
		return new self;
	}

	// ============================================= END WHERE ============================================ //






	// ============================================= GROUP ORDER & LIMIT ============================================ //

	static function order_by($column,$sort = 'asc')
	{
		if (is_array($column))
		{
			$column = implode(',',$column);
		}
	
		if (empty(self::$objorder))
		{
			self::$objorder = " order by ".$column." ".$sort;
		}
		else 
		{
			self::$objorder .= ", ".$column." ".$sort;
		}
		return new self;
	}

	static function group_by($column)
	{
		if (is_array($column))
		{
			$column = implode(',',$column);
		}
	
		if (empty(self::$objgroup))
		{
			self::$objgroup = " group by ".$column;
		}
		else 
		{
			self::$objgroup .= ", ".$column;
		}

		return new self;
	}

	static function limit($objlimit,$offset)
	{
		self::$objlimit = " limit ".$objlimit.",".$offset;
		return new self;
	}
	// ============================================= END GROUP ORDER & LIMIT ============================================ //






	// ============================================= GET DATA ============================================ //

	static function get($reset = TRUE)
	{
		if (empty(self::$directquery))
		{
			self::$sqlquery = "select ".self::$objselect." from ".self::$objtable.self::$objjoin.self::$objwhere.self::$objorder.self::$objgroup.self::$objlimit;
		}
		else 
		{
			self::$sqlquery = (empty(self::$objlimit)) ? self::$directquery : explode("limit",self::$directquery)[0].self::$objlimit;	
		}
	

		$result = '';
		try 
		{
			if (empty(self::$dbh))
			{
				self::open_connection();
			}
			
			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);
			$result =  $stmt->fetchAll((empty(self::$fetch_mode)) ? self::$fetch_mode_config : self::$fetch_mode);

			
			self::$last_insert_id = (empty(self::$dbh->lastInsertId()) ? "" : self::$dbh->last_insert_id());
			
			if ($reset == TRUE)
			{
				self::reset();
			}
			return $result;	
		}
		catch (PDOException $e)
		{
			self::show_error($e);
			throw new Exception($e->getMessage());
		}
		finally 
		{
			//self::$dbh = null;
		}

		
	}

	static function single($reset = TRUE)
	{
		if (empty(self::$directquery))
		{
			self::$sqlquery = "select ".self::$objselect." from ".self::$objtable.self::$objjoin.self::$objwhere.self::$objorder.self::$objgroup.self::$objlimit;
		}
		else 
		{
			self::$sqlquery = self::$directquery;	
		}

		$result = '';
		try 
		{
			if (empty(self::$dbh))
			{
				self::open_connection();
			}
			

			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);
			$result = $stmt->fetch((empty(self::$fetch_mode)) ? self::$fetch_mode_config : self::$fetch_mode);

			if ($reset == TRUE)
			{
				self::reset();
			}
			return $result;	
		}
		catch (PDOException $e)
		{
			self::show_error($e);
			throw new Exception($e->getMessage());
		}
		finally 
		{
			//self::$dbh = null;
		}

			
	}

	static function count($reset = TRUE)
	{
		if (empty(self::$directquery))
		{
			self::$sqlquery = "select count(*) from ".self::$objtable.self::$objjoin.self::$objwhere.self::$objorder.self::$objgroup.self::$objlimit;
		}
		else 
		{
			self::$sqlquery = "select count(*) from ".explode("from",self::$directquery)[1];	
		}

		$result = '';
		try 
		{
			if (empty(self::$dbh))
			{
				self::open_connection();
			}
			

			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);
			$result = $stmt->fetch();

			if ($reset == TRUE)
			{
				self::reset();
			}
			return $result[0];

		}
		catch (PDOException $e)
		{
			self::show_error($e);
			throw new Exception($e->getMessage());
		}
		finally 
		{
			//self::$dbh = null;
		}

				
	}

	static function last_insert_id()
	{
		return self::$last_insert_id;
	}

	// ============================================= END GET DATA ============================================ //





	// =============================================== RAW SQL ============================================== //

	static function sql_query($query)
	{
		self::$directquery = $query;
		return new self;
	}

	static function sql_command($sql)
	{
		try 
		{
			if (empty(self::$dbh))
			{
				self::open_connection();
			}
			

			self::$sqlquery = $sql;
			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);

			self::$last_insert_id = (empty(self::$dbh->lastInsertId()) ? "" : self::$dbh->lastInsertId());

			self::reset();
			return TRUE;
		}
		catch (PDOException $e)
		{
			self::show_error($e);
			throw new Exception($e->getMessage());
		}
		finally 
		{
			//self::$dbh = null;
		}
	}



	// =============================================== END RAW SQL ============================================== //





	// =============================================== INSERT UPDATE DELETE ============================================== //

	static function insert($column)
	{
		$col = "";
		$value = "";
		$param = array();
		foreach ($column as $tblcolumn => $tblvalue)
		{
			$col .= $tblcolumn.",";
			$value .= "?,";
			$param[] = $tblvalue;
		}
		$col = substr_replace($col, "", -1);
		$value = substr_replace($value, "", -1);
		self::$parameter = $param;

		$sql = "insert into ".self::$objtable." (".$col.") values (".$value.")";
		return self::sql_command($sql);
	}

	static function update($column)
	{
		$col = "";
		$param = array();
		foreach ($column as $tblcolumn => $tblvalue)
		{
			$col .= $tblcolumn." = ?,";
			$param[] = $tblvalue;
		}	
		$col = substr_replace($col,'', -1);

		self::$parameter = array_merge($param,self::$parameter);

		$sql = "update ".self::$objtable." set ".$col." ".self::$objwhere;

		return self::sql_command($sql);
	}

	static function delete()
	{
		$sql = "delete from ".self::$objtable." ".self::$objwhere;
		return self::sql_command($sql);
	}

	static function truncate()
	{
		$sql = "truncate ".self::$objtable;
		return self::sql_command($sql);
	}

	// =============================================== END INSERT UPDATE DELETE ============================================== //






	// =============================================== INCREMENT & DECREMENT ============================================== //

	static function increment($column,$value = 1)
	{
		$sql = "update ".self::$objtable." set ".$column."=".$column." + ".$value." ".self::$objwhere;
		return self::sql_command($sql);
	}

	static function decrement($column,$value = 1)
	{
		$sql = "update ".self::$objtable." set ".$column."=".$column." - ".$value." ".self::$objwhere;
		return self::sql_command($sql);
	}

	// =============================================== INCREMENT & DECREMENT ============================================== //
}
?>