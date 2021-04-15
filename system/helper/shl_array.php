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

if (!function_exists('array_to_xml'))
{
	function array_to_xml($array, &$xml_user_info) 
	{
    	foreach($array as $key => $value) 
    	{
        	if(is_array($value)) 
        	{
            	if(!is_numeric($key))
            	{
                	$subnode = $xml_user_info->addChild("$key");
                	array_to_xml($value, $subnode);
            	}
            	else
            	{
                	$subnode = $xml_user_info->addChild("item$key");
                	array_to_xml($value, $subnode);
            	}
        	}
        	else 
        	{
            	$xml_user_info->addChild("$key",htmlspecialchars("$value"));
        	}
        }
    }	
}

	/*
	function array_to_xml($array, $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><xml></xml>"), $format_output = TRUE)
	{
		$xml =
		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				if (!is_numeric($key))
				{
					$subnode = $xml->addChild($key);
					array_to_xml($value, $subnode);
				}
				else
				{
					array_to_xml($value, $xml);
				}
			}
			else
			{
				$xml->addChild($key, $value);
			}
		}
		
		
		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = $format_output;

		$dom->loadXML($xml->asXML());
		$out = $dom->saveXML();
		
		return $xml;
		
	}
	*/
?>