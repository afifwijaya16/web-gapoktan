<?php
class m_pelanggan extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("pelanggan");
	}

	static function get_data()
	{
		return self::$table;
	}

	static function get_detail($id)
	{
		return shl_db::table("pelanggan")
					 ->select("*")
					 ->where("id_pelanggan", $id)->single();
	}


	static function insert($data)
	{
		return shl_db::table("pelanggan")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("pelanggan")
			 ->where("id_pelanggan", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("pelanggan")
			 ->where("id_pelanggan", $id)
		     ->delete();
	}
}
?>