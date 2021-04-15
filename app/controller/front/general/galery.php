<?php class galery extends shl_controller {
	function __construct() {
		shl_loader::model("administrator/general/m_galery");
	}

	function index() {

		if (empty($datasource))
		{
			$datasource = m_galery::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['galery'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("front/exception/general/galery", self::$data);
	}

} ?>