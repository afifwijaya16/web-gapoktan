<?php
// Load Component
foreach (glob("../config/*.php") as $fileconfig)
{	
	require_once($fileconfig);
}

// set error reporting
$error =  $config['shl_framework']['error_reporting'];
error_reporting($error);

date_default_timezone_set($config['shl_framework']['timezone']);

$system_arr = array("shl_controller","shl_model","shl_library","shl_loader","shl_view", "shl_vendor", "shl_rest");
foreach ($system_arr as $arr)
{	
	require_once($arr.".php");
}

$helper_arr = array("shl_input","shl_url");
foreach ($helper_arr as $arr)
{
	require_once("./helper/".$arr.".php");
}
// End Load Component

// Auto Load
foreach ($autoload['shl_framework']['library'] as $row)
{
	shl_loader::library($row);

}

foreach ($autoload['shl_framework']['model'] as $row)
{
	shl_loader::model($row);
}

foreach ($autoload['shl_framework']['helper'] as $row)
{
	shl_loader::helper($row);
}
// End Auto Load

// load controller berdasarkan url
$segment = url_segment(1);
if (empty($segment))
{
	// load controller default
	$exp_controller = explode("/",$route['shl_framework']['default_controller']);
	

	if (count($exp_controller) > 1)
	{
		$controller = "../app/controller/";
		for ($i = 0; $i <= count($exp_controller) - 1;$i++)
		{	
			if (file_exists($controller.$exp_controller[$i].".php"))
			{	
				$functionname = "";
				include $controller.$exp_controller[$i].".php";
				
				$classname = $exp_controller[$i];
				if (isset($exp_controller[$i+1]))
				{
					$function = (substr($exp_controller[$i+1],0,1) == "?") ? "" : $exp_controller[$i+1];
				}
				$route = new $classname();
				$route->run($functionname);
				return;
			}
			else 
			{
				$controller = $controller.$exp_controller[$i]."/";

			}
		}		
	}
	else 
	{
		include "../app/controller/".$route['shl_framework']['default_controller'].".php";
		$route = new $route['shl_framework']['default_controller']();
		$route->run();
		return;
	}
}
else 
{
	$cururl = current_url();
	$cururl = explode("?",str_replace($config['shl_framework']['base_url'],'', $cururl))[0];

	foreach ($route['shl_framework'] as $rule => $action)
	{

		if ($rule != 'default_controller')
		{
			if (preg_match('~^'.$rule.'$~i',$cururl,$params))
			{
								// mengganti parameter
				for ($j = 1; $j <= 4; $j++)
				{
					if (isset($params[$j]))
					{
						$action = str_replace("$".$j, $params[$j], $action);	
					}
									
				}

				$controller = "../app/controller/";
				// memanggil class
				$act = explode("/",$action);

				for ($i = 0; $i < count($act); $i++)
				{
					if (file_exists($controller.$act[$i].".php"))
					{
						$controllername = $act[$i];
						//$function = $act[$i + 1];
						$function = (substr($act[$i + 1],0,1) == "?")? "" : $act[$i + 1];
						include  $controller.$controllername.".php";
						$route = new $controllername($function);
						$route->run($function);
						return;
					}
					else 
					{
						$controller = $controller.$act[$i]."/";
					}
				}
			}
		}
	}

	$controller = "../app/controller/";
	for ($i=1; $i <= url_count(); $i++)
	{
		if (file_exists($controller.url_segment($i).".php"))
		{
			$controllername = url_segment($i);
			$function = url_segment($i + 1);
			$function = (substr(url_segment($i + 1),0,1) == "?")? "" : url_segment($i + 1);
			include $controller.url_segment($i).".php";
			$route = new $controllername();
			$route->run($function);
			return;
		}	
		else 
		{
			$controller = $controller.url_segment($i)."/";
		}
		if ($i == url_count() -1)
		{
			echo "controller tidak ditemukan";
			//header ("location: ".$GLOBALS['base_url']);
		}
	}
}

?>