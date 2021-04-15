<?php
class pelanggan extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_pelanggan");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_pelanggan::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['pelanggan'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/pelanggan", self::$data);
	}

	function search()
    {
        self::index(m_pelanggan::search(input_get("s")));
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
        if (m_pelanggan::delete(url_segment(5)))
        {
            redirect("administrator/general/pelanggan");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("nama", "required", "Form");
        

        if (shl_form::is_valid())
        {
            $data = $_POST;

            if (($aksi == 'tambah') ? m_pelanggan::insert($data) : m_pelanggan::update($data, url_segment(5)) )
            {
                redirect("administrator/general/pelanggan");
            }
            
        }

        self::$data['pelanggan'] = ($aksi == "perbaiki") ? m_pelanggan::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/pelanggan", self::$data);
    }




}
?>