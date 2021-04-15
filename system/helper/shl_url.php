<?php
if (!function_exists("url_segment"))
{
	function url_segment($num)
	{
		$local = ["127.0.0.1", "::1"];
		if (in_array($_SERVER['REMOTE_ADDR'],$local))
		{
			$num += 1;
		}

		$segments = $_SERVER['REQUEST_URI'];
		//$segments = str_replace(base_url()."/", "", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

		$segments = explode('/', $segments);

		
		if (!isset($segments[$num]))
		{
			return "";
		}

		$result = explode("?",$segments[$num])[0];
		
		return urldecode($result);
	}
}
if (!function_exists("url_count"))
{
	function url_count()
	{
		$segmentvalue = explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'));

		$list = array("127.0.0.1","::1");
		if (in_array($_SERVER['REMOTE_ADDR'],$list))
		{
			return count($segmentvalue);
		}
		else 
		{
			return count($segmentvalue) + 1;
		}
	}
}
if (!function_exists("current_url"))
{
	function current_url()
	{
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}   

if (!function_exists("base_url"))
{
	function base_url()
	{	
		global $config;
		return $config['shl_framework']['base_url'];
	}
}

if (!function_exists("redirect"))
{
	function redirect($url)
	{
		if (!filter_var($url, FILTER_VALIDATE_URL))
        {
        	$url = base_url()."/".$url;
        }
		header ("location: ".$url);
	}
}

if (!function_exists("get_domain_name"))
{
	function get_domain_name($Address) 
	{ 
		// tanpa .com .uk .dll
   		//$pattern = '/(?:https?:\/\/)?(?:www\.)?(.*)\.(?=[\w.]{3,4})/';
   		// dengan .com
   		$pattern = '/(?:https?:\/\/)?(?:www\.)?(.*)/';
		preg_match($pattern, $Address, $matched);
		return $matched[1];
	} 	
}

?>
