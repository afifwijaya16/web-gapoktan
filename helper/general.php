<?php
if (!function_exists("url_detail"))
{
	function url_detail($tgl,$judul_seo)
	{
		$tanggal = explode(' ', $tgl)[0];
     	return str_replace("-", "/", $tanggal)."/".$judul_seo;
	}
}
if (!function_exists("rupiah"))
{
	function rupiah($harga)
	{
		return "Rp ".number_format($harga,0,',','.');
	}
}

if (!function_exists("generate_sitemap"))
{
	//generate_sitemap($data,"../sitemap.xml",array("weekly","1.0"));
	function generate_sitemap($data,$file,$config = '')
	{
		$result = '<?xml version="1.0" encoding="UTF-8"?>
					<urlset
      					xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      					xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      					xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            			http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $changefreq = (empty($config[0])) ? "weekly" : $config[0];
        $priority = (empty($config[1])) ? "1.0" : $config[1];

		for($j=0; $j < count($data); $j++)
		{
			$result .='<url>';
			$result .='<loc>'.$data[$j][0].'</loc>';
			$result .='<changefreq>'.$changefreq.'</changefreq>';
			$result .='<priority>'.$priority.'</priority>';
			$result .='</url>';
		}

		$result .= '</urlset>';
		
		file_put_contents($file, $result);
	}

}
?>