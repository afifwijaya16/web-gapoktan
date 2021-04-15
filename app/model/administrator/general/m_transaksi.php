<?php
class m_transaksi extends shl_model
{
	static $table;

	function __construct()
	{
		self::$table = shl_db::table("transaksi");
	}

	static function get_data()
	{
		return self::$table->join("ongkir","ongkir.id_ongkir","transaksi.id_ongkir")->join("pelanggan","pelanggan.id_pelanggan","transaksi.id_pelanggan")->order_by("transaksi.tgl_transaksi", desc);
	}

	static function get_detail($id)
	{
		return shl_db::table("transaksi")
					 ->select("*")
					 ->where("id_transaksi", $id)->single();
	}

	static function insert($data)
	{
		return shl_db::table("transaksi")
				     ->insert($data);		
	}

	static function update($data,$id)
	{
		return shl_db::table("transaksi")
			 ->where("id_transaksi", $id)
		     ->update($data);
	}

	static function update_stok($data_stok,$id)
	{
		return shl_db::table("produk")
			 ->where("id_produk", $id)
		     ->update($data_stok);
	}

	static function delete($id)
	{
		return shl_db::table("transaksi")
			 ->where("id_transaksi", $id)
		     ->delete();
	}

	static function insert_keranjang($data)
	{
		return shl_db::table("keranjang")
				     ->insert($data);		
	}

	static function delete_keranjang($id)
	{
		return shl_db::table("keranjang")
			 ->where("id_keranjang", $id)
		     ->delete();
	}

	static function update_transaksi($data,$id)
	{
		return shl_db::table("transaksi")
			 ->where("id_transaksi", $id)
		     ->update($data);
	}


}
?>