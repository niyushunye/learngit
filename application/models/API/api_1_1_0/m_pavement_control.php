<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_pavement_control extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询任务类型
    public function select_task_class_model()
    {
        $this->db->select('number,name');
        $this->db->from('con_task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //手机端提交的路面防控信息提交至数据库
    public function insert_pavement_control_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('vio_task_write',$data);
           return $res;
        }
    }
}