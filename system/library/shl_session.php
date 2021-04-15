<?php
class shl_session
{
	function __construct()
	{
		if (session_id() == '')
		{
			session_start();
		}
	}

	public static function set($name, $value = '')
	{
		if (is_array($name))
		{
			foreach ($name as $key => $value)
			{
				$_SESSION[$key] = $value;
			}
		}
		else 
		{
			$_SESSION[$name] = $value;
		}
	}

	public static function get($name)
	{
		if (is_array($name))
		{
			$result = array();
			foreach ($name as $row)
			{
				$result[$row] = (isset($_SESSION[$row])) ? $_SESSION[$row] : "" ;
			}
			return $result;
		}
		else 
		{
			return (isset($_SESSION[$name])) ? $_SESSION[$name] : "" ;
		}
	}

	public static function all()
	{
		$result = array();
		$result = $_SESSION;
		return $result;
	}

	public static function exist($name)
	{
		if (isset($_SESSION[$name]))
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}

	public static function is_empty($name)
	{
		$tmp_name = self::get($name);
		if (empty($tmp_name))
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}

	public static function not_exist_or_empty($name)
	{
		if (!self::exist($name) || empty($_SESSION[$name]))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public static function set_empty($name)
	{
		if (is_array($name))
		{
			foreach ($name as $row)
			{
				if (self::exist($row))
				{
					self::set($row,"");
				}
			}
		}
		else 
		{
			if (self::exist($name))
			{
				self::set($name,"");
			}
		}
	}

	public static function remove($name)
	{
		if (is_array($name))
		{
			foreach ($name as $row)
			{
				unset($_SESSION[$row]);
			}
		}
		else 
		{
			unset($_SESSION[$name]);
		}
	}

	public static function destroy()
	{
		session_destroy();
	}
}
?>