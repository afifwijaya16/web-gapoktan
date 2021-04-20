<?php
class statis extends shl_controller
{
	function __construct()
	{
		shl_loader::model("front/general/m_statis");
	}

	function detail()
	{
		$judul_seo = url_segment(2);
		self::$data['statis'] = m_statis::get_detail($judul_seo);

		shl_loader::view("front/exception/general/statis", self::$data);
	}

	function tentangkami()
	{

		shl_loader::view("front/exception/general/tentangkami", self::$data);
	}

	function profil()
	{

		shl_loader::view("front/exception/general/profil", self::$data);
	}

	function edit_profil()
	{

        shl_form::rule("nama", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;
            $id = shl_session::get("id_pelanggan");

            if (m_statis::update_profil($data,$id))
            {
                 redirect("front/general/statis/profil");
            }
            
        }

		shl_loader::view("front/exception/general/edit_profil", self::$data);
	}

	function panduan()
	{

		shl_loader::view("front/exception/general/panduan", self::$data);
	}


	function produk()
	{

		shl_loader::view("front/exception/general/produk", self::$data);
	}
	

	function kategori()
	{

		if (empty($datasource))
		{
			$datasource = m_statis::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['statis'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("front/exception/general/produk", self::$data);
	}

	function promosi_produk()
	{

		if (empty($datasource))
		{
			$datasource = m_statis::get_data();
		}

		$page = input_get("page");
		$page = (empty($page)) ? "1" : $page;
		self::$data['statis'] = shl_pagination::page($page)
											 ->paginate($datasource);

		shl_loader::view("front/exception/general/promosi", self::$data);
	}


	function detail_produk()
	{
        shl_form::rule("komentar", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;

            $data['id_pelanggan'] = shl_session::get("id_pelanggan");
            $data['id_produk']  = url_segment(5);
            $data['status_komentar'] = 'Komentar';


            if (m_statis::insert_komentar($data))
            {
                self::$data['pesan'] = "Pesanan Kami Terima dan Kami akan segera menghubungi anda, Terimakasih";
            }
            
        }



		shl_loader::view("front/exception/general/detail_produk", self::$data);
	}


	function cari()
	{

		shl_loader::view("front/exception/general/cari", self::$data);
	}


	function registrasi()
	{

        shl_form::rule("nama", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;


            if (m_statis::insert_pelanggan($data))
            {
            	$last_pelanggan = shl_db::table("pelanggan")->order_by("tgl_daftar", DESC)->single();
            	$link = base_url()."/front/general/statis/login?mail=".$last_pelanggan['id_pelanggan'];
			 	$from = "cs@kjscctv.garudaku.co.id";    
    			$to = $last_pelanggan['email'];    
			    $subject = "Verifikasi Email KJS CCTV";    
			    $message = "Silahkan klik <a href='".$link."'> Verifikasi Email </a> untuk verifikasii Email dan Login, Terimakasih!";   
			    $headers = "From: cs@kjscctv.garudaku.co.id";    
			    mail($to,$subject,$message, $headers); 
                redirect("front/general/statis/registrasi?nt=1");
            }
            
        }


		shl_loader::view("front/exception/general/registrasi", self::$data);
	}


	function pembayaran()
	{

        shl_form::rule("metode_pembayaran", "required", "Form");

        shl_upload::input_name("bukti_transfer")
        		  ->path("../resources/public/images/");

        
        if (shl_form::is_valid())
        {
            $data = $_POST;
            $data['id_transaksi'] = $_GET['id'];
            $data['id_pelanggan'] = shl_session::get("id_pelanggan");

            if (!empty($_FILES['bukti_transfer']) && shl_upload::upload())
            {
            	$data['bukti_transfer'] = shl_upload::file_name();
            }



            if (m_statis::insert_pembayaran($data))
            {
            	redirect("front/general/statis/profil");
            	

            }
            
        }

		shl_loader::view("front/exception/general/pembayaran", self::$data);
	}

	function login()
	{


		if(!empty($_GET['mail'])) { 

			self::$data['pesan'] = "Verifikasi E-mail berhasil, Silahkan Login!";	

			$data_verifikasi['verif']=1;	
			m_statis::verifikasi($data_verifikasi,$_GET['mail']);
		
		} else {
		shl_form::rule("email", "required", "Username")
				->rule("password", "required", "Password");
		$data['pesan'] = "";

		if (shl_form::is_valid())
		{
			$data = m_statis::checklogin(input_post("email"), input_post("password"));
			if (!empty($data))
			{
				shl_session::set("id_pelanggan", $data['id_pelanggan']);
				shl_session::set("status", $data['status_pelanggan']);

				$transaksi = m_statis::cek_transaksi($data['id_pelanggan']);
				shl_session::set("total_transaksi", $transaksi['total_transaksi']);

				
				redirect("home");
			}
			else
			{
				self::$data['pesan'] = "(Username/password salah)";
			}
		}

		}


		shl_loader::view("front/exception/general/login", self::$data);
	}

	function logout()
	{
		shl_session::destroy();		

		redirect("home");
	}


	function cart()
	{

		if($_GET['p'] == 'tambah') {

			$data['id_produk']=$_GET['id'];
			$data['harga_beli']=$_GET['price'];			
			$data['id_pelanggan'] = shl_session::get("id_pelanggan");
			$data['status'] = 'Pending';
			$data['jumlah_pesanan'] = 1;


			m_statis::insert_keranjang($data);
			redirect("front/general/statis/cart");
		} else if ($_GET['p'] == 'edit') {

			$data['id_produk']=$_GET['id'];
			$data['id_pelanggan'] = shl_session::get("id_pelanggan");
			$data['jumlah_pesanan'] = $_GET['jumlah_pesanan'];

			m_statis::update_keranjang($data,$_GET['id_keranjang']);
			redirect("front/general/statis/cart");

		} else if($_GET['p'] == 'delete'){

			m_statis::delete_keranjang($_GET['id']);
			redirect("front/general/statis/cart");
		}
		

		shl_loader::view("front/exception/general/cart", self::$data);
	}

	function order()
	{

		shl_form::rule("alamat_pengiriman", "required", "Form");


        if (shl_form::is_valid())
        {
            $data = $_POST;
            $data['id_pelanggan'] = shl_session::get("id_pelanggan"); 


            if (m_statis::insert_order($data))
            {


            	$datatransaksi = m_statis::get_data_transaksi(shl_session::get("id_pelanggan"));
            	$datadetailtransaksi = m_statis::get_keranjang(shl_session::get("id_pelanggan"));
            	foreach ($datadetailtransaksi as $val) { 
            		$data_update['status'] = 'Done';
            		$data_update['id_transaksi'] = $datatransaksi['id_transaksi'];

            		m_statis::update_keranjang($data_update,$val['id_keranjang']);
            	}

                redirect("front/general/statis/order");
            }
            
        }

		shl_loader::view("front/exception/general/order", self::$data);
	}



}
?>