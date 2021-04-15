<?php
class shl_pagination
{
    private static $numberofpages;
    private static $numberofrows;
    private static $resultperpage;
    private static $page;
    private static $tagopen;
    private static $tagclose;
    private static $strnextpage;
    private static $strprevpage;
    private static $strfirstpage;
    private static $strlastpage;
    private static $usepagenumber;
    private static $fulltagopen;
    private static $fulltagclose;
    private static $activetagopen;
    private static $activetagclose;


    // ============================================= GETTER & SETTER PROPERTY ============================================ //

    public static function number_of_pages($value = '')
    {
        if (empty($value))
        {
            return self::$numberofpages;
        }
        else 
        {
            self::$numberofpages = $value;
            return new self;
        }
    }

    public static function number_of_rows($value = '')
    {
        if (empty($value))
        {
            return self::$numberofrows;
        }
        else 
        {
            self::$numberofrows = $value;
            return new self;
        }
    }

    public static function result_per_page($value = '')
    {
        if (empty($value))
        {
            return self::$resultperpage;
        }
        else 
        {
            self::$resultperpage = $value;
            return new self;
        }
    }

    public static function page($value = '')
    {
        if (empty($value))
        {
            return self::$page;
        }
        else 
        {
            self::$page = (int) $value;
            return new self;
        }
    }

    public static function open_tag($value = '')
    {
        if (empty($value))
        {
            return self::$tagopen;
        }
        else 
        {
            self::$tagopen = $value;
            return new self;
        }
    }

    public static function end_tag($value = '')
    {
        if (empty($value))
        {
            return self::$tagclose;
        }
        else 
        {
            self::$tagclose = $value;
            return new self;
        }
    }

    public static function str_next_page($value = '')
    {
        if (empty($value))
        {
            return self::$strnextpage;
        }
        else 
        {
            self::$strnextpage = $value;
            return new self;
        }
    }

    public static function str_prev_page($value = '')
    {
        if (empty($value))
        {
            return self::$strprevpage;
        }
        else 
        {
            self::$strprevpage = $value;
            return new self;
        }
    }

    public static function str_first_page($value = '')
    {
        if (empty($value))
        {
            return self::$strfirstpage;
        }
        else 
        {
            self::$strfirstpage = $value;
            return new self;
        }
    }

    public static function str_last_page($value = '')
    {
        if (empty($value))
        {
            return self::$strlastpage;
        }
        else 
        {
            self::$strlastpage = $value;
            return new self;
        }
    }

    public static function use_page_number($value = '')
    {
        if (empty($value))
        {
            return self::$usepagenumber;
        }
        else 
        {
            self::$usepagenumber = $value;
            return new self;
        }
    }

    public static function full_tag_open($value = '')
    {
        if (empty($value))
        {
            return self::$fulltagopen;
        }
        else 
        {
            self::$fulltagopen = $value;
            return new self;
        }
    }

    public static function full_tag_close($value = '')
    {
        if (empty($value))
        {
            return self::$fulltagclose;
        }
        else 
        {
            self::$fulltagclose = $value;
            return new self;
        }
    }

    public static function active_tag_open($value = '')
    {
        if (empty($value))
        {
            return self::$activetagopen;
        }
        else 
        {
            self::$activetagopen = $value;
            return new self;
        }
    }

    public static function active_tag_close($value = '')
    {
        if (empty($value))
        {
            return self::$activetagclose;
        }
        else 
        {
            self::$activetagclose = $value;
            return new self;
        }
    }

    // ============================================= END GETTER & SETTER PROPERTY ============================================ //

 


     function __construct()
    {
        include "../config/config.php";
        $config = $config['shl_framework']['pagination'];
        self::$numberofrows = (empty(self::$numberofrows) || self::$numberofrows == 0) ? "0" : self::$numberofrows;
        self::$numberofpages = (empty(self::$numberofpages) || self::$numberofpages == $config['numberofpages']) ? $config['numberofpages'] : self::$numberofpages;
        self::$resultperpage = (empty(self::$resultperpage) || self::$resultperpage == $config['resultperpage']) ? $config['resultperpage'] : self::$resultperpage;
        self::$page = (empty(self::$page) || self::$page <= 1) ? "1" : self::$page;
        self::$strnextpage = (empty(self::$strnextpage) || self::$strnextpage == $config['strnextpage']) ? $config['strnextpage'] : self::$strnextpage;
        self::$strprevpage = (empty(self::$strprevpage) || self::$strprevpage == $config['strprevpage']) ? $config['strprevpage'] : self::$strprevpage;
        self::$strfirstpage = (empty(self::$strfirstpage) || self::$strfirstpage == $config['strfirstpage']) ? $config['strfirstpage'] : self::$strfirstpage;
        self::$strlastpage = (empty(self::$strlastpage) || self::$strlastpage == $config['strlastpage']) ? $config['strlastpage'] : self::$strlastpage;
        self::$usepagenumber = (empty(self::$usepagenumber) || self::$usepagenumber == $config['usepagenumber']) ? $config['usepagenumber'] : self::$usepagenumber;
        self::$tagopen = (empty(self::$tagopen) || self::$tagopen == $config['tagopen']) ? $config['tagopen'] : self::$tagopen;
        self::$tagclose = (empty(self::$tagclose) || self::$tagclose == $config['tagclose']) ? $config['tagclose'] : self::$tagclose;
        self::$fulltagopen = (empty(self::$fulltagopen) || self::$fulltagopen == $config['fulltagopen']) ? $config['fulltagopen'] : self::$fulltagopen;
        self::$fulltagclose = (empty(self::$fulltagclose) || self::$fulltagclose == $config['fulltagclose']) ? $config['fulltagclose'] : self::$fulltagclose;
        self::$activetagopen = (empty(self::$activetagopen) || self::$activetagopen == $config['activetagopen']) ? $config['activetagopen'] : self::$activetagopen;
        self::$activetagclose = (empty(self::$activetagclose) || self::$activetagclose == $config['activetagclose']) ? $config['activetagclose'] : self::$activetagclose;
    }
 
    public static function paginate($shl_db)
    {   
        self::number_of_rows($shl_db::count(false)); 
        $data = $shl_db::limit((self::page() - 1) * self::result_per_page(),self::result_per_page())
                        ->get();
        return $data;
    }
    

    // ============================================= CREATE LINK FOR PAGINATION ============================================ //



    public static function create_link()
    {
        $TotalPages = ceil(self::number_of_rows() / self::result_per_page());
        
        $halfpages = floor(self::number_of_pages() / 2);
        $range = array("start" => 1, "end" => $TotalPages);
        $iseven = (self::number_of_pages() % 2 == 0);
        $atrangeEnd = $TotalPages - $halfpages;

        if ($iseven) $atrangeEnd++;
        
        if ($TotalPages > self::number_of_pages())
        {
            if (self::page() <= $halfpages)
            {
                $range['end'] = self::number_of_pages();
            }
            else if (self::page() >= $atrangeEnd)
            {
                $range['start'] = $TotalPages - self::number_of_pages() + 1;
            }
            else 
            {
                $range['start'] = self::page() - $halfpages;
                $range['end'] = self::page() + $halfpages;
                if ($iseven) $range['end']--;
            }
        }
        
        $link = self::full_tag_open();
        
        // prev link & first link
        $str_first_page = self::str_first_page();
        if (!empty($str_first_page))
        {
            if (self::page() > 1)
            {
                $link .= self::open_tag().'<a href="?page=1">'.self::str_first_page().'</a>'.self::end_tag();
            }
        }
        
        $str_prev_page = self::str_prev_page();
        if (!empty($str_prev_page))
        {
            if (self::page() > 1)
            {
                $link .= self::open_tag().'<a href="?page='.(self::page() - 1).'">'.self::str_prev_page().'</a>'.self::end_tag();
            }
        }
        
        if (self::use_page_number() == TRUE)
        {
            for ($i = $range['start']; $i <= $range['end']; $i++)
            {
                if ($i == self::page())
                {
                    $link .= self::active_tag_open().$i.self::active_tag_close();
                }
                else 
                {
                    $link.= self::open_tag().'<a href="?page='.$i.'">'.$i.'</a>'.self::end_tag();
                }
            }
        }

        $str_next_page = self::str_next_page();
        if (!empty($str_next_page))
        {
            if (self::page() < $TotalPages)
            {
                $link .= self::open_tag().'<a href="?page='.(self::page() + 1).'">'.self::str_next_page().'</a></li>'.self::end_tag();
            }
        }
        $str_last_page = self::str_last_page();
        if (!empty($str_last_page))
        {
            $link .= self::open_tag().'<a href="?page='.($TotalPages).'">'.self::str_last_page().'</a>'.self::end_tag();
        }
        return $link.self::full_tag_close();
    } 

    // ============================================= CREATE LINK FOR PAGINATION ============================================ //

}

?>