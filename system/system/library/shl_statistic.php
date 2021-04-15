<?php
class shl_statistic extends shl_library
{
    function __construct()
    {
        parent::__construct();
        $this->checktable();
    }
    
    public function get_statistic()
    {

        $result = array(
            "today" => $this->get_today(),
            "yesterday" => $this->get_yesterday(),
            "month" => $this->get_month(),
            "hits" => $this->get_today_hits(),
            "totalhits" => $this->get_total_hits(),
            "useronline" => $this->get_online_user()
            );
        
        
        return $result;
        
    }

    public function get_today()
    {
         // today
        $this->db->reset();
        $this->db->select("ip");
        $this->db->from("statistic");
        $this->db->where(array(
            array("tanggal","=",date("Y-m-d"))
            ));

        return $this->db->numrows();
    }

    public function get_yesterday()
    {
        $this->db->reset();
        $this->db->select("ip");
        $this->db->from("statistic");
        $this->db->where(array(
            array("tanggal","=",date("Y-m-d",strtotime("-1 day")))
            ));
        return $this->db->numrows();
    }

    public function get_month()
    {
         // this month
        $this->db->reset();
        $this->db->select("ip");
        $this->db->from("statistic");
        $this->db->where(array(
            array("month(tanggal)","=",date("m"))
            ));
        return $this->db->numrows();
    }
    
    public function get_today_hits()
    {
         // today hits
        $this->db->reset();
        $this->db->select("sum(hits) as hits");
        $this->db->from("statistic");
        $this->db->where(array(
            array("tanggal","=",date("Y-m-d"))
            ));
        return $this->db->get(TRUE)['hits'];
    }

    public function get_total_hits()
    {
        // total hits
        $this->db->reset();
        $this->db->select("sum(hits) as total");
        $this->db->from("statistic");
        return $this->db->get(TRUE)['total'];
    }

    public function get_online_user()
    {
          // online user
        $this->db->reset();
        $this->db->select("ip");
        $this->db->from("statistic");
        $this->db->where(array(
            array("online",">=",time() - 600)
            ));
        return $this->db->numrows();
    }

    public function checktable()
    {
        // check exist table
        if($this->db->is_table_exists("statistic"))
        {
            $this->addstat();
        }
        else 
        {
            $this->db->reset();
            $this->db->query("create table statistic (id int not null auto_increment primary key,ip varchar(18),tanggal date,hits int (11),online varchar(50))");
            $this->addstat();
        }
    }
    
    public function addstat()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu = time();
        
        $this->db->reset();
        $this->db->select("ip,hits");
        $this->db->from("statistic");
        $this->db->where(array(
            array('ip','=',$ip),
            array("tanggal","=",$tanggal)
            ));

        if ($this->db->numrows() == 0)
        {

            $arr = array(
                "ip" => $ip,
                "tanggal" => $tanggal,
                "hits" => "1",
                "online" => $waktu
                );
            $this->db->insert($arr,"statistic");
        }
        else 
        {
            $data = $this->db->get(TRUE);
            $arr = array(
                "hits" => $data['hits'] + 1,
                "online" => $waktu
                );
            $this->db->query("update statistic set hits = hits + 1, online = '".$waktu."' where ip='".$ip."' and tanggal = '".$tanggal."'");
            
        }
    }
}
?>