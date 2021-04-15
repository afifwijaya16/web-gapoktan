<?php
class shl_loader
{
    static $viewvariable = array();

	static function library($library)
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

        if ($library == "shl_session")
        {
            sessioN_start();
        }

        //$library = new $library();
	}

	static function helper($helper)
	{
        if (file_exists("../system/helper/".$helper.".php"))
        {
            $filepath = "../system/helper/".$helper.".php";   
        }
        else 
        {
            $filepath = "../helper/".$helper.".php";
        }
        require_once($filepath);
	}

    static function view($view, $var = '')
    {
        if (!empty($var))
        {
            if (is_array($var) && is_array(self::$viewvariable))
            {
                self::$viewvariable = array_merge(self::$viewvariable,$var);
            }
        }

        @ob_start();
        if (is_array(self::$viewvariable))
        {
            extract(self::$viewvariable);
        }
        include "../app/view/".$view.".php";
        @ob_end_flush();
    }

    static function model($model)
    {
        require_once("../app/model/".$model.".php");
        $model = explode("/",$model);
        $model = $model[count($model) - 1];
        $model = new $model();
    }

    static function error($view, $var = '')
    {
        if (!empty($var))
        {
           if (is_array($var) && is_array(self::$viewvariable))
            {
                self::$viewvariable = array_merge(self::$viewvariable,$var);
            }
        }

        @ob_start();
        if (is_array(self::$viewvariable))
        {
            extract(self::$viewvariable);
        }
        include "./error/".$view.".php";
        @ob_end_flush();
    }
}
?>