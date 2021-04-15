
<?php
ob_start();
?>
            <!-- Page Content -->
            <main class="page-main">
                <div class="container">
                    <!-- Page Title -->
                    <div class="page-title">
                        <div class="title center">
                            <h1>PANDUAN BELANJA ONLINE</h1>
                        </div>
                        <div class="text-wrapper">
                            <p class="text-center">Tata Cara Belanja Online Dapat di Lihat Pada Informasi di Bawah Ini</p>
                        </div>
                    </div>
                    <!-- /Page Title -->
                    <!-- Two columns -->
                    <div class="row">
                        <!-- Center column -->
                        <div class="col-md-12">
                            <div class="blog-post">

                                <div class="blog-content">
                                    <h3 class="blog-title">Alur Proses Belanja Online</h2>
                                    <div class="blog-meta">
                                        <div class="pull-left">
                                            <span>GAPOKTAN Gading Rejo</span>

                                        </div>

                                    </div>
                                    <div class="blog-text">
                                 <div class="box-body">
  <img src="<?=base_url();?>/resources/panduan.png" style="width:100%">
                                        <p>
                                            KETERANGAN <br><br>
                                            1. Melakukan registrasi untuk membuat akun belanja online. <br>
                                            2. Melakan login pada menu login dengan email  dan password yang sudah terdaftar.<br>
                                            3. Memilih produk yang ingin di beli dan masukan ke dalam keranjang belanja (CART).<br>
                                            4. Menginputkan alamat pengiriman sesuai dengan yang diinginkan.<br>
                                            5. Melakukan checkout pada menu cart setelah  memastikan sudah membeli semua kebutuhan anda.<br>
                                            6. Memilih Rekening Pembayaran (Metode Pembayaran).<br>
                                            7. Bukti Transfer Diupload untuk memudahkan proses Transaksi.<br>
                                            7. Menunggu barang dikirimkan. <br><br>

                                            Untuk Informasi Lebih Lanjut Silahkan Hubungi Customer Service GAPOKTAN Gading Rejo (0811725401).


                                        </p>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- /Center column -->

                    </div>
                    <!-- /Two columns -->
                </div>
            </main>
            <!-- /Page Content -->
<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>