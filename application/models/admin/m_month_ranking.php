<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_month_ranking extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询出任务总数
   public function select_all_numbers($arr,$arr1)
   {
       if(!empty($arr))
       {
           foreach ($arr1 as $vs)
           {
               foreach ($arr as $v)
               {
                   $this->db->select('count(id) nums');
                   $this->db->where('bmdm',$v);
                   $this->db->where('month',date('m'));
                   if($vs == 1)  //隐患歼灭战
                   {
                       $this->db->where('ywlx','1');
                       $this->db->from('veh_task');
                       $res = $this->db->get();
                       $arrs['p'][] = $res->result_array();

                   }
                   if($vs == 2)  //当月应检车辆
                   {
                       $this->db->where('ywlx','2');
                       $this->db->from('veh_task');
                       $res = $this->db->get();
                       $arrs['r'][] = $res->result_array();
                   }
                   if($vs == 3) //五类车检验 
                   {
                       $this->db->where('ywlx','3');
                       $this->db->from('veh_task');
                       $res = $this->db->get();
                       $arrs['q'][] = $res->result_array();
                   }
               }
           }
           return $arrs;
       }
   }

   //查询出完成的任务总数
    public function select_accomplish_numbers($arr,$arr1,$month_first,$month_end)
    {
        if(!empty($arr))
        {
            //$this->db->select('count(id) anums');
            //$this->db->where('');
            foreach($arr1 as $vs)
            {
                foreach ($arr as $v)
                {
                    $this->db->select("count(id) anums");
                    $this->db->where('bmdm',$v);
                    $this->db->where('sfch','1');
                    $this->db->where('sfyx','1');
                    $this->db->where("'$month_first <= czsj <= $month_end'");
                    //$this->db->like('czsj','-'.date('m').'-','both');
                    if($vs == 1)
                    {
                        $this->db->where('ywlx','1');
                        $this->db->from('veh_task_write');
                        $res = $this->db->get();
                        $arrs['p'][] = $res->result_array();
                    }
                    if($vs == 2)
                    {
                        $this->db->where('ywlx','2');
                        $this->db->from('veh_task_write');
                        $res = $this->db->get();
                        $arrs['r'][] = $res->result_array();
                    }
                    if($vs == 3)
                    {
                        $this->db->where('ywlx','3');
                        $this->db->from('veh_task_write');
                        $res = $this->db->get();
                        $arrs['q'][] = $res->result_array();
                    }
                }
            }
            return $arrs;
        }
    }


    //查询隐患歼灭战拨款数
    public function select_hidden_danger()
    {
        $this->db->select('jnzd,jbzd,xlzd,ztzd,yhzd,dhzd,tbzd,hszd,zdzd');
        $this->db->like('htime','-'.date('m'),'before');
        $this->db->from('hidden_danger_money');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询当月应检车辆拨款数
    public function select_the_month()
    {
        $this->db->select('jnzd,jbzd,xlzd,ztzd,yhzd,dhzd,tbzd,hszd,zdzd');
        $this->db->like('mtime','-'.date('m'),'before');
        $this->db->from('the_month_money');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询五类车检验拨款数
    public function select_five_types()
    {
        $this->db->select('jnzd,jbzd,xlzd,ztzd,yhzd,dhzd,tbzd,hszd,zdzd');
        $this->db->like('ftime','-'.date('m'),'before');
        $this->db->from('five_types_money');
        $res = $this->db->get();
        return $res->result_array();
    }

}