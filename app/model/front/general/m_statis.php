<?php
class m_statis extends shl_model
{
	// Menampilkan informasi seperti profil, visi dan misi, dst
	static function get_detail($judul_seo)
	{
		return shl_db::table("halamanstatis")
					 ->select("halamanstatis.*")
					 ->where("judul_seo", $judul_seo)->single();
	}

	static function get_keranjang($id_pelanggan)
	{
		return shl_db::table("keranjang")
					 ->where("status", "Pending")
					 ->where("id_pelanggan", $id_pelanggan)->get();
	}
	static function cek_transaksi($id_pelanggan)
	{
		return shl_db::sql_query("SELECT COUNT(id_transaksi) as total_transaksi FROM transaksi WHERE id_pelanggan='$id_pelanggan'")->single();
	}

	static function get_data_transaksi($id_pelanggan)
	{
		return shl_db::table("transaksi")
					 ->where("status_transaksi", "Pending")
					 ->where("id_pelanggan", $id_pelanggan)
					 ->order_by("tgl_transaksi", desc)->single();
	}



	static function insert_pembayaran($data)
	{
		return shl_db::table("pembayaran")
				     ->insert($data);		
	}

	static function insert_komentar($data)
	{
		return shl_db::table("komentar")
				     ->insert($data);		
	}

	static function insert_pelanggan($data)
	{
		return shl_db::table("pelanggan")
				     ->insert($data);		
	}

	static function update_profil($data,$id)
	{
		return shl_db::table("pelanggan")
			 ->where("id_pelanggan", $id)
		     ->update($data);
	}


	static function insert_transaksi($data)
	{
		return shl_db::table("transaksi")
				     ->insert($data);		
	}

	static function checklogin($email,$password)
	{
		return shl_db::table("pelanggan")
					 ->where("email", $email)
					 ->where("password", $password)
					 ->where("verif", 1)
					 ->single();
	}	

	static function insert_order($data)
	{
		return shl_db::table("transaksi")
				     ->insert($data);		
	}
	static function insert_keranjang($data)
	{
		return shl_db::table("keranjang")
				     ->insert($data);		
	}

	static function update_keranjang($data,$id)
	{
		return shl_db::table("keranjang")
			 ->where("id_keranjang", $id)
		     ->update($data);
	}

	static function verifikasi($status,$id)
	{
		return shl_db::table("pelanggan")
			 ->where("id_pelanggan", $id)
		     ->update($status);
	}


	static function delete_keranjang($id)
	{
		return shl_db::table("keranjang")
			 ->where("id_keranjang", $id)
		     ->delete();
	}


}
?>