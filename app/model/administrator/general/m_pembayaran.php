<?php
class m_pembayaran extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("pembayaran");
	}

	static function get_data()
	{
		return self::$table;
	}

	static function get_detail($id)
	{
		return shl_db::table("pembayaran")
					 ->select("*")
					 ->where("id_pembayaran", $id)->single();
	}


	static function insert($data)
	{
		return shl_db::table("pembayaran")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("pembayaran")
			 ->where("id_pembayaran", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("pembayaran")
			 ->where("id_pembayaran", $id)
		     ->delete();
	}
}
?>