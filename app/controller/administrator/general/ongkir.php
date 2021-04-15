<?php
class ongkir extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_ongkir");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_ongkir::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['ongkir'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/ongkir", self::$data);
	}

	function search()
    {
        self::index(m_ongkir::search(input_get("s")));
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
        if (m_ongkir::delete(url_segment(5)))
        {
            redirect("administrator/general/ongkir");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("kabupaten", "required", "Form");
        

        if (shl_form::is_valid())
        {
            $data = $_POST;

            if (($aksi == 'tambah') ? m_ongkir::insert($data) : m_ongkir::update($data, url_segment(5)) )
            {
                redirect("administrator/general/ongkir");
            }
            
        }

        self::$data['ongkir'] = ($aksi == "perbaiki") ? m_ongkir::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/ongkir", self::$data);
    }


}
?>