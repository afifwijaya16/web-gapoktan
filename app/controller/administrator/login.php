<?php
class login extends shl_controller
{
	function index()
	{
		shl_loader::model("administrator/m_login");


		shl_form::rule("email", "required", "Email")
				->rule("password", "required", "Password");
		$data['pesan'] = "";

		if (shl_form::is_valid())
		{
			$data = m_login::checklogin(input_post("email"), input_post("password"));
			if (!empty($data))
			{
				shl_session::set("id_users", $data['id_users']);
				
				shl_session::set("name", $data['name']);				
				shl_session::set("isAdmin", $data['isAdmin']);

				redirect("administrator/dashboard");
			}
			else
			{
				$data['pesan'] = "(Email/password salah)";
			}
		}


		shl_loader::view("administrator/ultimo/login",$data);
	}


	function logout()
	{
		shl_session::destroy();

		$url=$_GET['url'];
		redirect($url);
	}


}
?>