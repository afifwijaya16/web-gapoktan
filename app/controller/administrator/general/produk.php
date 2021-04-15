<?php
class produk extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_produk");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_produk::get_data(shl_session::get("id_users"));
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['produk'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/produk", self::$data);
	}

	function search()
    {
        self::index(m_produk::search(input_get("s")));
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
        if (m_produk::delete(url_segment(5)))
        {
            redirect("administrator/general/produk");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("nama_produk", "required", "Form");
        
        shl_upload::input_name("gambar_produk")
        		  ->path("../resources/public/images/");

        if (shl_form::is_valid())
        {
            $data = $_POST;
            $data['id_users'] = shl_session::get("id_users");

            if (!empty($_FILES['gambar_produk']) && shl_upload::upload())
            {
            	$data['gambar_produk'] = shl_upload::file_name();
            	
            	if ($aksi == 'perbaiki')
            	{
            		$gambar_produk = m_produk::get_detail(url_segment(5));
            		$gambar_produk = $gambar_produk['gambar_produk'];
            		unlink("../resources/public/images/".$gambar_produk);
            	}
            }

            if (($aksi == 'tambah') ? m_produk::insert($data) : m_produk::update($data, url_segment(5)) )
            {
                redirect("administrator/general/produk");
            }
            
        }

        self::$data['produk'] = ($aksi == "perbaiki") ? m_produk::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/produk", self::$data);
    }


}
?>