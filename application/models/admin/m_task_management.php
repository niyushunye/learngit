<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_task_management extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询所有任务
    public function select_all_task()
    {
        $this->db->select('id,task_name,add_member,add_time,realname');
        $this->db->join('memberinfo','add_member = accounts');
        $this -> db -> where('type',1);
        $this->db->from('task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //根据ID查询任务信息
    public function select_task_model($id)
    {
        $this->db->select('id,task_name,add_member,add_time,realname');
        $this->db->join('memberinfo','add_member = accounts');
        $this->db->where('id',$id);
        $this->db->from('task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //添加
     public function add_model($data)
     {
         if(!empty($data))
         {
           $res = $this->db->insert('task',$data);
           return $res;
         }

     }
     //修改
    public function update_task($data,$id)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('task',$data);
            return $res;
        }
    }
    //删除
    public function delete_task($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('task');
        return $res;
    }
}