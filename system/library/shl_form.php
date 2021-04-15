<?php
class shl_form
{
    static $strrule;
    static $msgrequired;
    static $msgmaxlength;
    static $msgminlength;
    static $msgemail;
    static $msgurl;
    static $msgnumeric;
    static $msgalphabetic;
    static $msgalphanumeric;
    static $msgboolean;
    static $msgfilerequired;
    static $msgfileallowedtype;
    static $OpenErrorTag;
    static $EndErrorTag;
    static $dropdown_month;
    static $dropdown_day;

    function __construct()
    {
        include "../config/config.php";
        $config = $config['shl_framework']['form'];
        if (empty(self::$msgrequired))
        {
            self::$msgrequired = $config['required'];
            self::$msgmaxlength = $config['maxlength'];
            self::$msgminlength = $config['minlength'];
            self::$msgnumeric = $config['numeric'];
            self::$msgalphabetic = $config['alphabetic'];
            self::$msgalphanumeric = $config['alphanumeric'];
            self::$msgemail = $config['email'];
            self::$msgurl = $config['url'];
            self::$msgboolean = $config['boolean'];

            self::$msgfilerequired = $config['filerequired'];
            self::$msgfileallowedtype = $config['fileallowedtype'];

            self::$dropdown_month = $config['dropdown_month'];
            self::$dropdown_day = $config['dropdown_day'];

            self::$OpenErrorTag = $config['openerrortag'];
            self::$EndErrorTag = $config['enderrortag'];
        }
    }
    
    // form 
    public static function create($action = '',$method = '',$name = '',$config = '')
    {
        if (!empty($config))
        {
            foreach ($config as $key => $value)
            {
                $conf .= $key."='".$value."' ";
            }
        }

        $form_create = "<form action='".$action."' method='".$method."' name='".$name."' ".$conf.">\n";
        return $form_create;
    }

    public static function create_multipart($action = '',$method = '',$name = '',$config = '')
    {
        if (!empty($config))
        {
            foreach ($config as $key => $value)
            {
                $conf .= $key."='".$value."' ";
            }
        }

        $form_create = "<form action='".$action."' method='".$method."' name='".$name."' ".$conf." enctype='multipart/form-data'>\n";
        return $form_create;
    }
    
    public static function end()
    {
        return "</form>\n";
    }
    // end form
    
    // input form
    public static function input($name = '',$config = '',$type = 'text')
    {
        if (is_array($config))
        {
            $atribut = "";

            $keys = array_keys($config);
            $is_assoc = array_keys($keys) !== $keys;

            if ($is_assoc)
            {  
                foreach ($config as $key => $value)
                {
                    $atribut .= $key."='".$value."' ";
                }
            }
            else 
            {
                foreach ($config as $key)
                {
                    $atribut .= $key." ";
                }
            }    


            if (empty($config['type']))
            {
                return "<input ".$atribut." type='".$type."' name='".$name."'>\n";
            }        

            return "<input ".$atribut." name='".$name."'>\n";
        }
        else 
        {
            if ($type = '')
            {
                $type = 'text';
            }
            else 
            {
                $type = $type;
            }
            return "<input type='".$type."' name='".$name."'>\n";
        }
    }
    
    public static function password($name = '',$config = array())
    {
       return $this->input($name,$config,"password");   
    }

    public static function date($name = '',$config = array())
    {
        return $this->input($name,$config,"date");
    }
    
    public static function time($name = '',$config = array())
    {
        return $this->input($name,$config,"time");
    }
    
    public static function mail($name = '',$config = array())
    {
        return $this->input($name,$config,"email");
    }

    public static function number($name = '',$config = array())
    {
        return $this->input($name,$config,"number");
    }

    public static function file($name = '',$config = array())
    {
        return $this->input($name,$config,"file");
    }

    public static function radio($name = '',$config = array(), $value = '', $checked = FALSE)
    {
        if (is_array($config))
        {
            foreach ($config as $key => $val)
            {
                $conf .= $key."='".$val."' ";
            }
        }
        if ($checked == TRUE)
        {
            $ck = "Checked";
        }
        else 
        {
            $ck = "";
        }
        $radio = "<input type='radio' ".$conf." name='".$name."' value ='".$value."' ".$ck.">";

        return $radio;
    }

    public static function option($name = '',$config = array(),$option,$selected = '')
    {
        if (is_array($config))
        {
            foreach ($config as $key => $value)
            {
                $atribut .= $key."='".$value."' ";
            }            
        }
        else 
        {
            $atribut = '';
        }
        
        $select = "<select ".$atribut." name='".$name."'>";
        
        foreach ($option as $key => $value)
        {
            if ($key == $selected || $value == $selected)
            {
                $opt .= "<option value='".$key."' selected>".$value."</option>"; 
            }
            else 
            {
                $opt .= "<option value='".$key."'>".$value."</option>";
            }
        }
        
        $select = $select."\n".$opt."\n</select>\n";
        return $select;
    }
    
    public static function textarea($name = '',$config = array(),$valuetextarea = '')
    {
        $strconfig = "";
        foreach ($config as $key => $value)
        {
            $strconfig.= $key."='".$value."'";
        }
        $textarea = "<textarea ".$strconfig." name='".$name."'>".$valuetextarea."</textarea>";
        return $textarea;
    }
    
    // end input form
    
    // button
    
    public static function submit($name = '',$config = array())
    {
        foreach ($config as $key => $value)
        {
            $atribut .= $key."='".$value."' ";
        }
        $submit = "<input type='submit' name='".$name."' ".$atribut."/>";
        return $submit;
    }
    public static function reset($name = '',$config = '')
    {
        foreach ($config as $key => $value)
        {
            $atribut .= $key."='".$value."'";
        }
        $submit = "<input type='reset' name='".$name."' ".$atribut."/>";
        return $submit;
    }
    
    // end button


    // ================================= FORM HELPER ============================================ //

    public static function dropdown($name, $shl_db, $selected, $attribute = '')
    {
        if (empty($attribute) or is_array($selected))
        {
            $attribute = $selected;
            $selected = "";
        }

        $attr = "";
        if (is_array($attribute))
        {
            foreach ($attribute as $key => $value) 
            {
                $attr .= $key."='".$value."'";
            }
        }
        else
        {
            $attr = $attribute;
        }
                

        $result = "<select name='".$name."'' ".$attr.">";

        if (is_array($shl_db))
        {
            $arr_keys = array_keys($shl_db);
            $range = range(0, count($shl_db) - 1);
            if ($arr_keys !== $range)
            {
                foreach ($shl_db as $key => $value)
                {
                    if ($key == $selected || $value == $selected)
                    {
                        $result .= "<option value='".$key."' selected='selected'>".$value."</option>";
                    }
                    else
                    {
                        $result .= "<option value='".$key."'>".$value."</option>";
                    }
                }
            }
            else
            {
                foreach ($shl_db as $row)
                {
                    if ($row == $selected)
                    {
                        $result .= "<option value='".$row."' selected='selected'>".$row."</option>"; 
                    }
                    else
                    {
                        $result .= "<option value='".$row."'>".$row."</option>"; 
                    }
                }
            }
            
        }
        else 
        {
            $data = $shl_db->get();
            $value = "0";
            $display = "0";
            if (isset($data[0]))
            {
                $display = (count($data[0]) > 2) ? "1" : "0";
            }

            $arr_key = array_keys($data);

            for ($i = 0; $i < count($data); $i++)
            {
                if ($data[$i][$value] == $selected || $data[$i][$display] == $selected)
                {
                    $result .= "<option value='".$data[$i][$value]."' selected='selected'>".$data[$i][$display]."</option>";
                }
                else
                {
                    $result .= "<option value='".$data[$i][$value]."'>".$data[$i][$display]."</option>";
                }
            }
        }


        $result .= "</select>";

        return $result;
    }

    public static function dropdown_range($name, $data = array(), $selected, $attribute)
    {
        $datasource = array();
        for ($i = $data[0]; $i <= $data[1]; $i++)
        {
            $datasource[] = $i;
        }

        return self::dropdown($name, $datasource, $selected, $attribute);
    }

    public static function dropdown_month($name, $selected, $attribute)
    {
        return self::dropdown($name, self::$dropdown_month, $selected, $attribute);
    }

    public static function dropdown_day($name, $selected, $attribute)
    {
        return self::dropdown($name, self::$dropdown_day, $selected, $attribute);
    }








    // ================================== FORM VALIDATTION ===================================== //

    private static function show_error($name)
    {
        $debug = debug_backtrace();
        $file = $debug[1]['file'];
        $classname = (isset($debug[2]['class'])) ? $debug[2]['class'] : "";
        $functionname = (isset($debug[2]['function'])) ? $debug[2]['function'] : "";
        $line = $debug[1]['line'];

        $func = new ReflectionMethod($classname, $functionname);
        $filename = $func->getFileName();
        $source = file($filename);
        $source = "<pre>".implode("", array_slice($source, $line - 3,5))."</pre>";
            
        $err['errorheading'] = "Form Validaton Error ";
        $err['errordescription'] = "<p>Message = <b>".$name." is null, please check your field input name</b></p>".
                                    "<p>Filename = ".$file."</p>".
                                    "<p>Line Number = ".$line."</p>".
                                    "<p>Source Code = ".$source."</p>";

        shl_loader::error("form",$err); 
    }

    public static function rule($name,$rule,$message = '')
    {
        if (empty($message))
        {
            $message = $name;
        }
        self::$strrule[$name] = array("rule"=>$rule,"message"=>$message);
        self::$strrule[$name]['strmessage'] = "";
        return new self;
    }
    
    public static function error($name)
    {
        if (isset($_POST[$name]) || isset($_FILES[$name]))
        {
            if (!empty(self::$strrule[$name]['strmessage']))
            {
                $arr_key = array_keys(self::$strrule[$name]['strmessage']);
                return self::$OpenErrorTag.self::$strrule[$name]['strmessage'][$arr_key[0]].self::$EndErrorTag;
            }
            else 
            {
                return "";
            }
           
        }  
    }

    public static function error_list($name)
    {
        if (isset($_POST[$name]) || isset($_FILES[$name]))
        {
            if (!empty(self::$strrule[$name]['strmessage']))
            {
                $result = array();
                foreach (self::$strrule[$name]['strmessage'] as $row)
                {
                    array_push($result, self::$OpenErrorTag.$row.self::$EndErrorTag);
                }
                return $result;
            }
        }
        return array();
    }

    
    public static function is_valid()
    {
        $returnvalue = TRUE;
        
        foreach (self::$strrule as $key => $value)
        {
            if (isset($_POST[$key]) || isset($_FILES[$key]))
            {
                if (self::validate($key) == FALSE)
                {
                    $returnvalue = FALSE;
                }
            }
            else 
            {
                if (!empty($_POST))
                {
                    self::show_error($key);
                }
                $returnvalue = FALSE;
            }
        }
        
        return $returnvalue;
    }
    
    public static function validate($name)
    {
        $rules = explode(',',self::$strrule[$name]['rule']);
        foreach ($rules as $checkrule)
        {
            if (strpos($checkrule,'[') == TRUE)
            {
                $pattern = '/(.*)\[(.*)\]/';
                preg_match($pattern, $checkrule, $matches);
                self::$matches[1]($name,$matches[2]);
            }
            else 
            {
                self::$checkrule($name);
            }
        }

        if (empty(self::$strrule[$name]['strmessage']))
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }


    public static function required($name)
    {
        if (isset($_POST[$name]))
        {
            if (empty($_POST[$name]))
            {
                $msg = self::$msgrequired;
                $msg = str_replace("@name", self::$strrule[$name]['message'],$msg);
                self::$strrule[$name]['strmessage']["required"] = $msg;
                return FALSE;
            }
        }
        return TRUE;
    }

    public static function file_required($name)
    {
        if (isset($_FILES[$name]))
        {
            if (empty($_FILES[$name]['name']))
            {
                $msg = self::$msgfilerequired;
                $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
                self::$strrule[$name]['strmessage']["filerequired"] = $msg;
                return FALSE;
            }
        }
        return TRUE;
    }

    public static function file_allowedtype($name = '', $type = '')
    {
        if (isset($_FILES[$name]))
        {
            $imagetype = strtolower(pathinfo($_FILES[$name]['name'],PATHINFO_EXTENSION));
            $type = explode("|",$type);
        
            if (!in_array($imagetype, $type))
            {
                $msg = self::$msgfileallowedtype;
                $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
                $msg = str_replace("@type", implode(",",$type), $msg);
                self::$strrule[$name]['strmessage']["fileallowedtype"] = $msg;
                return FALSE;
            }
        }
        return TRUE;
    }
    
    public static function maxlength($name = '',$length = '')
    {
        if (strlen($_POST[$name]) > $length)
        { 
            $msg = self::$msgmaxlength;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            $msg = str_replace("@length",$length, $msg);
            self::$strrule[$name]['strmessage']["maxlength"] = $msg;
            return FALSE;
        }
        return TRUE;
    }
    
    public static function minlength($name = '',$length = '')
    {
        if (strlen($_POST[$name]) < $length)
        {
            $msg = self::$msgminlength;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            $msg = str_replace("@length", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["minlength"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    public static function email($name = '')
    {
        if (!filter_var($_POST[$name], FILTER_VALIDATE_EMAIL))
        {
            $msg = self::$msgemail;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["email"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    public static function url($name = '')
    {
        if (!filter_var($_POST[$name], FILTER_VALIDATE_URL))
        {
            $msg = self::$msgurl;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["url"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    public static function numeric($name = '')
    {
        if (preg_match('/[^0-9- ]/i', $_POST[$name]) || empty($_POST[$name]))
        {
            $msg = self::$msgnumeric;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["numeric"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    public static function alpha($name = '')
    {
        if (preg_match('/[^a-zA-Z- ]/i', $_POST[$name]))
        {
            $msg = self::$msgalphabetic;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["alpha"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    public static function alpha_numeric($name = '')
    {
        if (preg_match('/[^a-z0-9- ]/i', $_POST[$name]))
        {
            $msg = self::$msgalphanumeric;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["alphan_umeric"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    public static function boolean($name = '')
    {
        if (!in_array($_POST[$name], array("true","false","1","0")))
        {
            $msg = self::$msgboolean;
            $msg = str_replace("@name", self::$strrule[$name]['message'], $msg);
            self::$strrule[$name]['strmessage']["boolean"] = $msg;
            return FALSE;
        }
        return TRUE;
    }

    // ================================== END FORM VALIDATTION ===================================== //
}
?>