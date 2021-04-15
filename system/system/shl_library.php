<?php
class shl_library
{
	public $db;
	public $library;

	function __construct()
	{

	}

	function load_library($library)
    {
        if (file_exists("../system/library/".$library.".php"))
        {
            $filepath = "../system/library/".$library.".php";   
        }
        else 
        {
            $filepath = "../library/".$library.".php";
        }
        require_once($filepath);
        
        $this->$library = new $library();
    }

    public function base_url()
    {
        include "../config/config.php";

        return $config['shl_framework']['base_url'];
    }

    public function redirect($controller)
    {   
        header ("location: ".$this->base_url()."/".$controller);
    }
}
?>