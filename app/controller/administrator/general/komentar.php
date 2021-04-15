<?php
class komentar extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_komentar");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_komentar::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['komentar'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/komentar", self::$data);
	}

	function search()
    {
        self::index(m_komentar::search(input_get("s")));
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
        if (m_komentar::delete(url_segment(5)))
        {
            redirect("administrator/general/komentar");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("status_komentar", "required", "Form");
        

        if (shl_form::is_valid())
        {
            $data = $_POST;

            if (($aksi == 'tambah') ? m_komentar::insert($data) : m_komentar::update($data, url_segment(5)) )
            {
                redirect("administrator/general/komentar");
            }
            
        }

        self::$data['komentar'] = ($aksi == "perbaiki") ? m_komentar::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/komentar", self::$data);
    }


}
?>