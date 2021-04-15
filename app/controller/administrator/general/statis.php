<?php
class statis extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_statis");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_statis::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['statis'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/statis", self::$data);
	}

	function search()
    {
        self::index(m_statis::search(input_get("s")));
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
        if (m_statis::delete(url_segment(5)))
        {
            redirect("administrator/general/statis");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("judul", "required", "Judul halaman")
        		->rule("isi_halaman","required", "Isi halaman");
        
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
            		$gambar = m_statis::get_detail(url_segment(5));
            		$gambar = $gambar['gambar'];
            		unlink("../resources/public/images/".$gambar);
            	}
            }

            if (($aksi == 'tambah') ? m_statis::insert($data) : m_statis::update($data, url_segment(5)) )
            {
                redirect("administrator/general/statis");
            }
            
        }

        self::$data['statis'] = ($aksi == "perbaiki") ? m_statis::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/statis", self::$data);
    }


}
?>