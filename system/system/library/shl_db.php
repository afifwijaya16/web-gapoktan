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


	static $debugsqlquery;
	static $debugparameter = array();

	static $server;
	static $username;
	static $password;
	static $database;
	static $port;

	static $dbh;

	function __construct()
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

			self::$dbh = new PDO("mysql:host=".self::$server."; port=".self::$port."; dbname=".self::$database.";",self::$username,self::$password);
			self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
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

	static function begin_transaction()
	{
		if (empty(self::$dbh))
		{
			new self;
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
		self::$objtable = $table;
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
		if (empty($column))
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
			$group = substr(trim(self::$objwhere), - 1);
			if ($group == "(")
			{
				self::$objwhere = " ".substr(trim(self::$objwhere), 0, -1);
				self::$objwhere .= " and ( ";
			}
			else
			{
				self::$objwhere .= " and ";
			}
		}
		
		self::$objwhere .= $column." ".$operator." ?";
		
		

		return new self;
	}

	static function or_where($column = '', $operator = '', $param = '')
	{
		if (empty($operator) || empty($param))
		{
			if (empty(self::$objwhere))
			{
				self::$objwhere = " where ";	
			}
			else 
			{
				self::$objwhere .= " and ";
			}

		}

		if (empty($param))
		{
			$param = $operator;
			$operator = '=';
		}

		self::$parameter = array_merge(self::$parameter, array($param));

		$group = substr(trim(self::$objwhere), - 1);
		if ($group == "(")
		{
			self::$objwhere = " ".substr(trim(self::$objwhere), 0, -1);
			self::$objwhere .= " or ( ".$column." ".$operator." ?";
		}
		else
		{
			self::$objwhere .= " or ".$column." ".$operator." ?";
		}

		

		return new self;
	}

	static function between($operator,$column,$range = '')
	{
		if (empty($range))
		{
			$range = $column;
			$column = $operator;
			$operator = " and ";
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
			self::$objwhere .= " ".$operator." ";
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
			$operator = " and ";
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
			self::$objwhere .= " ".$operator." ";
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
			$operator = " and ";
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
			self::$objwhere .= " ".$operator." ";
		}

		if (is_array($range))
		{
			$temp_range = $range;
			$range = '';
			for ($i = 0; $i < count($temp_range); $i++)
			{
				if (($i + 1) == count($temp_range))
				{
					$range .= "?";
				}
				else 
				{
					$range .= "?, ";
				}
			}
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
			$operator = " and ";
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
			self::$objwhere .= " ".$operator." ";
		}

		if (is_array($range))
		{
			$temp_range = $range;
			$range = '';
			for ($i = 0; $i < count($temp_range); $i++)
			{
				if (($i + 1) == count($temp_range))
				{
					$range .= "?";
				}
				else 
				{
					$range .= "?, ";
				}
			}
		}

		self::$objwhere .= " ".$column." not in (".$range.")";

		return new self;
	}

	static function group_start($tag = '')
	{
		if (empty($tag))
		{
			self::$objwhere .= " ( ";
		}
		else
		{
			self::$objwhere .= " ".$tag." ";
		}
		return new self;
	}

	static function group_end($tag = '')
	{
		if (empty($tag))
		{
			self::$objwhere .= " ) ";
		}
		else
		{
			self::$objwhere .= " ".$tag." ";
		}
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

	static function paging()
	{
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
			
			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);
			$result =  $stmt->fetchAll();

			if ($reset == TRUE)
			{
				self::reset();
			}
			return $result;	
		}
		catch (PDOException $e)
		{
			$err['errorheading'] = "SQL Syntak Error ".$i;
			$err['errordescription'] = "<p>Error Message = ".$e->getMessage()."</p>". 
									"<p>Error Code = ".strval($e->getCode())."</p>".
									"<p>Raw SQL = ".self::debug(self::$sqlquery,self::$parameter)."</p>".
									"<p>Filename = ".$e->getFile()."</p>".
									"<p>Line Number = ".strval($e->getLine())."</p>";
			shl_loader::error("database",$err);	

			throw new Exception($e->getMessage());
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
			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);
			$result = $stmt->fetch();

			if ($reset == TRUE)
			{
				self::reset();
			}
			return $result;	
		}
		catch (PDOException $e)
		{
			$err['errorheading'] = "SQL Syntak Error ".$i;
			$err['errordescription'] = "<p>Error Message = ".$e->getMessage()."</p>". 
									"<p>Error Code = ".strval($e->getCode())."</p>".
									"<p>Raw SQL = ".self::debug(self::$sqlquery,self::$parameter)."</p>".
									"<p>Filename = ".$e->getFile()."</p>".
									"<p>Line Number = ".strval($e->getLine())."</p>";
			shl_loader::error("database",$err);	

			throw new Exception($e->getMessage());
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
			$err['errorheading'] = "SQL Syntak Error ".$i;
			$err['errordescription'] = "<p>Error Message = ".$e->getMessage()."</p>". 
									"<p>Error Code = ".strval($e->getCode())."</p>".
									"<p>Raw SQL = ".self::debug(self::$sqlquery,self::$parameter)."</p>".
									"<p>Filename = ".$e->getFile()."</p>".
									"<p>Line Number = ".strval($e->getLine())."</p>";
			shl_loader::error("database",$err);	

			throw new Exception($e->getMessage());
		}

				
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
			self::$sqlquery = $sql;
			$stmt = self::$dbh->prepare(self::$sqlquery);
			$stmt->execute(self::$parameter);
			self::reset();
			return TRUE;
		}
		catch (PDOException $e)
		{
			$err['errorheading'] = "SQL Syntak Error ".$i;
			$err['errordescription'] = "<p>Error Message = ".$e->getMessage()."</p>". 
									"<p>Error Code = ".strval($e->getCode())."</p>".
									"<p>Raw SQL = ".self::debug(self::$sqlquery,self::$parameter)."</p>".
									"<p>Filename = ".$e->getFile()."</p>".
									"<p>Line Number = ".strval($e->getLine())."</p>";

			shl_loader::error("database",$err);
			self::reset();

			throw new Exception($e->getMessage());
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