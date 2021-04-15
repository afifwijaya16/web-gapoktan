<?php
class galery extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_galery");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_galery::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['galery'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/galery", self::$data);
	}

	function search()
    {
        self::index(m_galery::search(input_get("s")));
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
        if (m_galery::delete(url_segment(5)))
        {
            redirect("administrator/general/galery");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("judul", "required", "Judul galery")
        		->rule("isi_galery","required", "Isi galery");
        
        shl_upload::input_name("gambar")
        		  ->path("../resources/public/images/");

        if (shl_form::is_valid())
        {
            $data = $_POST;
            $data['id_users'] = shl_session::get("id_users");

            $data['tgl_posting'] = $data['tgl_posting']." ".$data['tgl_posting2'];
            unset($data['tgl_posting2']);

            if (!empty($_FILES['gambar']) && shl_upload::upload())
            {
            	$data['gambar'] = shl_upload::file_name();
            	
            	if ($aksi == 'perbaiki')
            	{
            		$gambar = m_galery::get_detail(url_segment(5));
            		$gambar = $gambar['gambar'];
            		unlink("../resources/public/images/".$gambar);
            	}
            }

            if (($aksi == 'tambah') ? m_galery::insert($data) : m_galery::update($data, url_segment(5)) )
            {
                redirect("administrator/general/galery");
            }
            
        }

        self::$data['galery'] = ($aksi == "perbaiki") ? m_galery::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/galery", self::$data);
    }


}
?>