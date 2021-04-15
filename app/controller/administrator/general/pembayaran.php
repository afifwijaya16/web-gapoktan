<?php
class pembayaran extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_pembayaran");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_pembayaran::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['pembayaran'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/pembayaran", self::$data);
	}

	function search()
    {
        self::index(m_pembayaran::search(input_get("s")));
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
        if (m_pembayaran::delete(url_segment(5)))
        {
            redirect("administrator/general/pembayaran");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("status_pembayaran", "required", "Form");
        
        if (shl_form::is_valid())
        {
            $data = $_POST;


             if (($aksi == 'tambah') ? m_pembayaran::insert($data) : m_pembayaran::update($data, url_segment(5)) )
            {
                redirect("administrator/general/pembayaran");
            }
            
        }

        self::$data['pembayaran'] = ($aksi == "perbaiki") ? m_pembayaran::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/pembayaran", self::$data);
    }


}
?>