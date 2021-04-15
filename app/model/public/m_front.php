<?php
class m_front extends shl_model
{
	

	static function get_halamanstatis()
	{

		return shl_db::table("halamanstatis")
						->get();
	}

	static function get_lowongan($date)
	{

		return shl_db::table("lowongan")
						->where("tgl_tutup",">=", $date)
						->get();
	}



}
?>