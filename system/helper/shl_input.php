<?php
if (!function_exists("input_post"))
{
	function input_post($str)
	{
		return @$_POST[$str];
	}
}

if (!function_exists("input_get"))
{
	function input_get($str)
	{
		return @$_GET[$str];
	}
}

if (!function_exists("input_file"))
{
	function input_file($str)
	{
		return @$_FILES[$str];
	}
}
?>