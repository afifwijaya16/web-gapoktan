<?php
class m_galery extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("galery");
	}

	static function get_data()
	{
		return self::$table;
	}

	static function get_detail($id)
	{
		return shl_db::table("galery")
					 ->select("*")
					 ->where("id_galery", $id)->single();
	}


	static function insert($data)
	{
		return shl_db::table("galery")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("galery")
			 ->where("id_galery", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("galery")
			 ->where("id_galery", $id)
		     ->delete();
	}
}
?>