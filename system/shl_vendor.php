<?php
class shl_vendor
{
	static function mpdf($mode = 'utf-8',$format = '', $default_font_size ='', $default_font = '', $margin_left = '15',
$margin_right = '15',
$margin_top = '16',
$margin_bottom = '16',
$margin_header = '9',
$margin_footer = '9',
$orientation = 'P')
	{
		require_once("./vendor/mpdf/mpdf.php");
		return new mPDF($mode, $format, $default_font, $default_font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);
	}

	static function mail()
	{
		require_once("./vendor/phpmailer/PHPMailerAutoload.php");
		return new PHPMailer();
	}
}
?>