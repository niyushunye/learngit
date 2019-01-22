<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_month_task_assessment extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //根据警员编号查询警员当前的考核任务
    public function select_assessment_task($accounts,$type,$num)
    {   
        $this->db->select('veh_task.id,ywlx,hphm,hpzl,DMSM1');
        //$this->db->select('veh_task.id,hphm,hpzl,ywlx,bmmc,bmdm,czr,jybh,month,cltp,dateline,task_name,DMSM1');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->join('frm_code','DMZ = hpzl');
        $this->db->where('ywlx',$type);
        $this->db->where('jybh',$accounts);
        $this->db->where('is_complete=0');
        $this->db->from('veh_task');
        $this->db->limit(10,($num-1)*10);
        $res = $this->db->get();
        return $res->result_array();
    }

    public function is_complete($id){
        $this->db->update('veh_task',array('is_complete'=>1),array('id'=>$id));
    }

    //警员处理任务后的反馈信息插入数据库(隐患歼灭战、当月应检车辆)
    public function insert_select_assessment_task($data)
    {
        
        $this->db->insert('veh_task_write',$data);
    }

    //获取图片
    public function get_car_pic($id){

        $re = $this->db->select('cltp')->from('veh_task')->where('id',$id)->get()->row_array();

        return $re;
    }
    
    
    /*
    //五类车
    public function insert_five_assessment_task($data)
    {
        if(!empty($data))
        {
            $res = $this->db->insert('veh_task',$data);
            return $res;
        }
    }*/

}