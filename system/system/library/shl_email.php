<?php
class shl_email
{
    static $mimeversion;
    static $contenttype;
    static $charset;
    static $subject;
    static $from;
    static $cc;
    static $bcc;
    static $to;
    static $message;
    static $wordwrap;
    
    function __construct()
    {
        include "../config/config.php";
        $config = $config['shl_framework']['email'];
        if (empty(self::$mimeversion))
        {
            self::$mimeversion = $config['mimeversion'];
            self::$contenttype = $config['contenttype'];
            self::$charset = $config['charset'];
            self::$wordwrap = $config['wordwrap'];
        }
    }

    static function mime_version($value = '')
    {
        if (empty($value))
        {
            return self::$mimeversion;
        }
        else 
        {
            self::$mimeversion = $value;
            return new self;
        }
    }

    static function content_type($value = '')
    {
        if (empty($value))
        {
            return self::$contenttype;
        }
        else 
        {
            self::$contenttype = $value;
            return new self;
        }
    }

    static function charset($value = '')
    {
        if (empty($value))
        {
            return self::$charset;
        }
        else 
        {
            self::$charset = $value;
            return new self;
        }
    }

    static function word_wrap($value = '')
    {
        if (empty($value))
        {
            return self::$wordwrap;
        }
        else 
        {
            self::$wordwrap = $value;
            return new self;
        }
    }
    
    static function from($email = '',$name = '')
    {
        $strfrom = $name." <".$email.">";
        self::$from = $strfrom;
        return new self;
    }
    
    static function bcc($email = '',$name = '')
    {
        $strbcc = $name." <".$email.">";
        self::$bcc = $strbcc;
        return new self;
    }
    
    static function cc ($email = '',$name = '')
    {
        $strcc = $name." <".$email.">";
        self::$cc = $strcc;
        return new self;
    }

    static function to ($value)
    {
        self::$to = $value;
        return new self;
    }

    static function subject($value)
    {
        self::$subject = $value;
        return new self;
    }

    static function message($value)
    {
        self::$message = $value;
        return new self;
    }
    
    static function send()
    {
        try
        {
            $headers = "MIME-Version: ".self::$mimeversion."\r\n";
            $headers .= "Content-type:".self::$contenttype.";charset=".self::$charset."\r\n";
            $headers .= "From: ".self::$from."\r\n";
            $headers .= "Cc: ".self::$cc."\r\n";
            $headers .= "Bcc: ".self::$bcc."\r\n";
            $headers .= "X-Mailer: PHP/".phpversion();
        
            if (self::$wordwrap == TRUE)
            {
                self::$message = wordwrap(self::$message,70,"\r\n");
            }
        
            mail(self::$to,self::$subject,self::$message,$headers);
        }
        catch (exception $ex)
        {
            print_r("Error = ".$ex->getMessage);
        }
    }
}
?>