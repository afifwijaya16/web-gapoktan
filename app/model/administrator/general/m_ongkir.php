<?php
class m_ongkir extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("ongkir");
	}

	static function get_data()
	{
		return self::$table;
	}

	static function get_detail($id)
	{
		return shl_db::table("ongkir")
					 ->select("*")
					 ->where("id_ongkir", $id)->single();
	}


	static function insert($data)
	{
		return shl_db::table("ongkir")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("ongkir")
			 ->where("id_ongkir", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("ongkir")
			 ->where("id_ongkir", $id)
		     ->delete();
	}
}
?>