<?php
class m_admin extends shl_model
{


	static function get_data_com_users($id)
	{
		return shl_db::table("com_users")
					 ->select("*")
					 ->where("id_com_users", $id)
					 ->single();
	}	

	static function get_data_com_identitas($url)
	{
		return shl_db::table("com_identitas")
					 ->select("*")
					 ->where("url", $url)
					 ->single();
	}		





}
?>