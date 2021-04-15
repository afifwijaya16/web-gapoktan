<?php
if (!function_exists("is_assoc"))
{
	function is_assoc($arr = array())
	{
		$arr_keys = array_keys($arr);
		$range = range(0, count($arr) - 1);
		return $arr_keys !== $range;
	}
}
?>