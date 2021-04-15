<?php
class shl_view
{
	private static $body;

	static function layout($layout,$content = '')
	{
		$layoutname = explode("/",$layout);
		$layoutname = $layoutname[count($layoutname) -1];
		self::$body = [$layoutname => $content];
		shl_loader::view($layout);
	}

	static function render_body($mastername)
	{
		print_r(self::$body[$mastername]);
	}

	static function resources($path)
	{
		return base_url()."/resources/".$path;
	}
}
?>