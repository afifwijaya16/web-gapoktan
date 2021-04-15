<?php
class transaksi extends shl_controller
{
	function __construct()
	{
		shl_loader::model("administrator/general/m_transaksi");
	}

	function index($datasource = "")
	{
		if (empty($datasource))
		{
			$datasource = m_transaksi::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['transaksi'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
	}

	function search()
    {
        self::index(m_transaksi::search(input_get("s")));
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
        if (m_transaksi::delete(url_segment(5)))
        {
            redirect("administrator/general/transaksi");
        }
    }

    function simpan($aksi = '')
    {
        shl_form::rule("status_transaksi", "required", "Form");
        
        if (shl_form::is_valid())
        {
            $data = $_POST;


            if ($data['status_transaksi'] == 'On Progress') {

            $keranjang = shl_db::table("keranjang")->where("id_transaksi", url_segment(5))->get();
            foreach ($keranjang as $row) {

                $cek_produk=shl_db::table("produk")->where("id_produk", $row['id_produk'])->single();
                $total_stok = $cek_produk['stok'] - $row['jumlah_pesanan'];


                $data_stok['stok'] = $total_stok;
                m_transaksi::update_stok($data_stok, $row['id_produk']);

            }

            };

            if (($aksi == 'tambah') ? m_transaksi::insert($data) : m_transaksi::update($data, url_segment(5)) )
            {
                redirect("administrator/general/transaksi");
            }

            
        }

        self::$data['transaksi'] = ($aksi == "perbaiki") ? m_transaksi::get_detail(url_segment(5)) : "";
        self::$data['act'] = $aksi;
        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }

    // function laporan()
    // {
    //     self::$data['act'] = 'laporan';
    //     shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    // }

    function laporan_pendapatan()
    {
        self::$data['act'] = 'laporan_pendapatan';
        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }

    function laporan_stok()
    {
        self::$data['act'] = 'laporan_stok';
        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }

    function laporan_pembeli()
    {
        self::$data['act'] = 'laporan_pembeli';
        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }


    function grafik()
    {
        self::$data['act'] = 'grafik';
        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }



    function pelanggan()
    {

        shl_form::rule("id_pelanggan", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;

            if (m_transaksi::insert($data))
            {
                redirect("administrator/general/transaksi/keranjang/".$_POST['id_pelanggan']);
            }
            
        }        
        self::$data['act'] = 'pelanggan';
        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }

    function keranjang()
    {   

        if($_GET['eks'] == 'tambah') {

        shl_form::rule("jumlah_pesanan", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;

            $data['id_pelanggan'] = url_segment(5);

            if (m_transaksi::insert_keranjang($data))
            {
                redirect("administrator/general/transaksi/keranjang/".url_segment(5));
            }
            
        }    


        } else if(!empty(url_segment(6))) {

        if (m_transaksi::delete_keranjang(url_segment(6)))
        {
            redirect("administrator/general/transaksi/keranjang/".url_segment(5));
        }   


        } else if(!empty($_GET[ts])) {



        shl_form::rule("id_ongkir", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;

            $data['id_pelanggan'] = url_segment(5);

            if (m_transaksi::update_transaksi($data,$_GET['ts']))
            {
                redirect("administrator/general/transaksi/");
            }
            
        }    



        }


        self::$data['act'] = 'keranjang';

        shl_loader::view("administrator/ultimo/general/transaksi", self::$data);
    }



}
?>