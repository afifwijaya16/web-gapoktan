<?php
class shl_controller
{
    static $data;

    function run($var = '')
    {
        if (empty($var))
        {
            $this->index();
        }
        else 
        {
            $this->$var();  
        }
    }
}
?>