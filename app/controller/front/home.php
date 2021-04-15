<?php
class home extends shl_controller
{
	function __construct()
	{
		shl_loader::model("front/m_home");
	}

	function index()
	{
	

		shl_loader::view("front/exception/home", self::$data);	
 	}



}
?>