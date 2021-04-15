<?php
class m_produk extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("produk");
	}

	static function get_data($id_users)
	{
		return self::$table->where("produk.id_users",$id_users)->order_by("produk.tgl_produk", desc);
	}

	static function get_detail($id)
	{
		return shl_db::table("produk")
					 ->select("*")
					 ->where("id_produk", $id)->single();
	}

	static function insert($data)
	{
		return shl_db::table("produk")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("produk")
			 ->where("id_produk", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("produk")
			 ->where("id_produk", $id)
		     ->delete();
	}
}
?>