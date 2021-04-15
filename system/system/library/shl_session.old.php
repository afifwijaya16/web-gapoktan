<?php
class shl_session
{
    function __construct()
    {
        session_start();
    }
    
    public function set_session($param, $value = '')
    {
        if (is_array($param))
        {
            foreach ($param as $key=>$val)
            {
                $_SESSION[$key] = $val;
            }
        }
        else 
        {
            $_SESSION[$param] = $value; 
        }
    }
    
    public function get_session($param)
    {
        if (is_array($param))
        {
            foreach ($param as $key)
            {
                $arr[$key] = $_SESSION[$key];
            }
            return $arr;
        }
        else 
        {
            return $_SESSION[$param];
        }
    }
    
    public function remove_session($param)
    {
        if (is_array($param))
        {
            foreach ($param as $key)
            {
                session_unset($key);
            }
        }
        else 
        {
            session_unset($param);
        }
    }
    
    public function destroy()
    {
        session_destroy();    
    }
}
?>