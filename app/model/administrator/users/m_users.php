<?php
class m_users extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("users");
	}

	static function get_data()
	{
		return self::$table->where("isAdmin", 0);
	}

	static function get_detail($id)
	{
		return shl_db::table("users")
					 ->select("*")
					 ->where("id_users", $id)->single();
	}

	static function search($param)
	{
		return self::$table
					->where("name", "like", "%".$param."%")
					->or_where("email", "like", "%".$param."%");
	}

	static function insert($data)
	{
		return shl_db::table("users")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("users")
			 ->where("id_users", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("users")
			 ->where("id_users", $id)
		     ->delete();
	}
}
?>