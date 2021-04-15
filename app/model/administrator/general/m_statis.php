<?php
class m_statis extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("statis");
	}

	static function get_data()
	{
		return self::$table;
	}

	static function get_detail($id)
	{
		return shl_db::table("statis")
					 ->select("*")
					 ->where("id_halaman", $id)->single();
	}


	static function insert($data)
	{
		return shl_db::table("statis")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("statis")
			 ->where("id_halaman", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("statis")
			 ->where("id_halaman", $id)
		     ->delete();
	}
}
?>