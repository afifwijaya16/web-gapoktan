<?php
if (!function_exists("parse_html"))
{
	function parse_html($str)
	{
		return htmlentities($str);
	}
}
if (!function_exists("str_limit"))
{
	function str_limit($str,$limit,$end = '')
	{
		$result = $str;
		if (is_array($limit))
		{
			$result = substr($str,$limit[0],$limit[1]);
		} 
		else 
		{
			$result = substr($str,0,$limit);
		}

		return $result.$end;
	}
}

if (!function_exists("str_left"))
{
	function str_left($str,$num)
	{
		return substr($str, 0, $num);
	}
}

if (!function_exists("str_mid"))
{
	function str_mid($str,$num1,$num2)
	{
		return substr($str, $num1, $num2);
	}
}

if (!function_exists("str_right"))
{
	function str_right($str,$num)
	{
		return substr($str, strlen($str) - $num ,$num);
	}
}

if (!function_exists("starts_with"))
{
	function starts_with($haystack, $needle, $case = FALSE)
	{
		if ($case) 
		{
        	return (strcmp(substr($haystack, 0, strlen($needle)), $needle) === 0);
   		}

    	return (strcasecmp(substr($haystack, 0, strlen($needle)), $needle) === 0);

	}
}

if (!function_exists("ends_with"))
{
	function ends_with($haystack, $needle, $case = FALSE)
	{
		if ($case) 
		{
        	return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)), $needle) === 0);
    	}
    	return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)), $needle) === 0);
	}
}

if (!function_exists("str_contains"))
{
	function str_contains($haystack, $needle, $case = FALSE)
	{
		if ($case)
		{
			return strpos($haystack, $needle) !== FALSE;	
		}
		return stripos($haystack, $needle) !== FALSE;
	}
}

if (!function_exists("str_random"))
{
	function str_random($length,$type = 'default')
	{
		$characters = "";
		switch ($type) 
		{
			case 'alpha':
					$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;

			case 'alphaupper':
					$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;

			case 'alphalower':
					$characters = "abcdefghijklmnopqrstuvwxyz";
				break;

			case 'numeric':
					$characters = "0123456789";
				break;

			case "no_zero":
					$characters = "123456789";
				break;
			
			default:
					$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
		}

    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
	}	
}

if (!function_exists("str_increment"))
{
	function str_increment($string,$separator = "-", $num = 1)
	{
		$temp = substr($string, strrpos($string, $separator) + 1);
		if (is_numeric($temp))
		{
			$num = $temp + 1;
			$temp = str_replace($separator.$temp, "", $string);
			return $temp.$separator.$num;
		}
		else 
		{
			return $string.$separator.$num;
		}
	}
}

if (!function_exists("camelize"))
{
 	function camelize($string)
	{
        $result = preg_replace('/[^a-z0-9]+/i', ' ', $string);
        $result = trim($result);

        $result = ucwords($result);
        $result = str_replace(" ", "", $result);
        $result = lcfirst($result);
 
        return $result;
	}
}

if (!function_exists("decamellize"))
{
	function decamelize($string, $nostrip = array(""))
	{
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
  		$ret = $matches[0];
  		foreach ($ret as &$match) {
    		$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  		}
  		return implode('_', $ret);
	}
}


if (!function_exists("str_censor"))
{
	function str_censor($string, $cencored, $replacement)
	{
		$result = $string;
		if (is_array($cencored))
		{
			foreach ($cencored as $row)
			{
				$result = str_replace($row, $replacement, $result);
			}
		}
		else 
		{
			$result = str_replace($cencored, $replacement, $result);
		}
		
		return $result;
	}
}

if (!function_exists("str_highlight"))
{
	function str_highlight($string, $phrase, $tag)
	{
		$result = $string;
		if (!is_array($phrase))
		{
			$phrase = array($phrase);
		}

		foreach ($phrase as $row)
		{
			$result = str_replace($row, $tag[0].$row.$tag[1] , $result);
		}

		return $result;
	}
}
?>