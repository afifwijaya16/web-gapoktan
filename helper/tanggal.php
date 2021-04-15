<?php
if (!function_exists("tgl_indo"))
{
	function tgl_indo($tanggal)
	{
		$tgl = date("N d n Y",strtotime($tanggal));
		
		$splittgl = explode(" ",$tgl);

		$arr_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");

		$hari = $arr_hari[$splittgl[0]];

		$tgl = $splittgl[1];

		$arr_bulan = array(1=>"Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		$bulan = $arr_bulan[$splittgl[2]];

		$tahun = $splittgl[3];

		return $hari.", ".$tgl." ".$bulan." ".$tahun."";
	}
}
?>