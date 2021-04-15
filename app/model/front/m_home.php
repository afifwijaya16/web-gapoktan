<?php
class m_home extends shl_model
{
	static function get_info_ktp()
	{
		return shl_db::table("halamanstatis")
					 ->select("*")
					 ->limit(0,5)
					 ->get();
	}

}
?>