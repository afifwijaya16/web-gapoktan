<?php
class m_komentar extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("komentar");
	}

	static function get_data()
	{
		return self::$table
					->join("produk","produk.id_produk","komentar.id_produk")
					->join("pelanggan","pelanggan.id_pelanggan","komentar.id_pelanggan")
					->where("komentar.id_balasan",0)
					->order_by("tgl_komentar", DESC);
	}

	static function get_detail($id)
	{
		return shl_db::table("komentar")
					 ->select("*")
					 ->where("id_komentar", $id)->single();
	}


	static function insert($data)
	{
		return shl_db::table("komentar")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("komentar")
			 ->where("id_komentar", $id)
		     ->update($data);
	}

	static function delete($id)
	{
		return shl_db::table("komentar")
			 ->where("id_komentar", $id)
		     ->delete();
	}
}
?>