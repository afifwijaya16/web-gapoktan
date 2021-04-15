<?php
if (!function_exists("set_cookie"))
{
    function set_cookie($name = '',$value = '',$expire = '',$path = '',$domain = '',$security = '')
    {
        setcookie($name,$value,$expire,$path,$domain,$security);       
    }
}

if (!function_exists("get_cookie"))
{
    function get_cookie($name)
    {
        if (is_array($name))
        {
            foreach ($name as $n)
            {
                $arr[$n] = $_COOKIE[$n];
            }
            return $arr;
        }
        else 
        {
            return $_COOKIE[$name];
        }
    }
}

if (!function_exists("remove_cookie"))
{
    function remove_cookie($name = '',$domain = '',$path = '/', $prefix = '')
    {
        set_cookie($name,"",time() - 3600,$path,"",0);
    }
}
?>