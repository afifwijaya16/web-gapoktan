<?php
class m_login extends shl_model
{
	static function checklogin($username, $password)
	{
		return shl_db::table("users")
					 ->where("email", $username)
					 ->where("password", $password)
					 ->single();
	}


}
?>