<?php
class users extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/users/m_users");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_users::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['users'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/users/users", self::$data);
	}

	function search()
    {
        self::index(m_users::search(input_get("s")));
    }

    function tambah()
    {
        self::simpan("tambah");
    }

    function perbaiki()
    {
        self::simpan("perbaiki");
    }

    function hapus()
    {
        if (m_users::delete(url_segment(5)))
        {
            redirect("administrator/users/users");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("name", "required", "Form");
        

        if (shl_form::is_valid())
        {
            $data = $_POST;
            
            if (($aksi == 'tambah') ? m_users::insert($data) : m_users::update($data, url_segment(5)) )
            {
                redirect("administrator/users/users");
            }
            
        }

        self::$data['users'] = ($aksi == "perbaiki") ? m_users::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/users/users", self::$data);
    }


}
?>