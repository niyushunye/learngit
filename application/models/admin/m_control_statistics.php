<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_control_statistics extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询每个部门当月各类违法的总数
    public function select_total_data($orgnum,$rwlx,$month_first,$month_end)
    {
        /*if(strlen($rwlx)>4)
        {
            $arr = explode('-',$rwlx);
        }else{
            $arr = array(
                0=> $rwlx
            );
        }*/

        if(strpos($rwlx,'-'))
        {
            $arr = explode('-',$rwlx);
        }else{
            $arr = array(
                0=> $rwlx
            );
        }


        $this->db->select('count(id) total');
        $this->db->where('bmdm',$orgnum);
        $this->db->where_in('rwlx',$arr);
        $this->db->where("'$month_first <= czsj <= $month_end'");
        //$this->db->like('czsj','-'.date('m'),'bofore');
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询每个部门当月各类违法的完成数
    public function select_already_data($orgnum,$rwlx,$month_first,$month_end)
    {
        /*if(strlen($rwlx)>4)
        {
            $arr = explode('-',$rwlx);
        }else
        {
            $arr = array(
                0=> $rwlx
            );
        }*/

        if(strpos($rwlx,'-'))
        {
            $arr = explode('-',$rwlx);
        }else{
            $arr = array(
                0=> $rwlx
            );
        }
        
        $this->db->select('count(id) total');
        $this->db->where('bmdm',$orgnum);
        $this->db->where_in('rwlx',$arr);
        $this->db->where("'$month_first <= czsj <= $month_end'");
        //$this->db->like('czsj','-'.date('m'),'bofore');
        $this->db->where('sfyx','1');
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
}