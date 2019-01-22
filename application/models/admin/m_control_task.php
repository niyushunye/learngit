<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_control_task extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(id) total');
        $this->db->from('con_task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有信息
    public function select_allinfo($per_page,$offect)
    {
        $this->db->select('id,number,name,score,,dateline');
        $this->db->limit($per_page,$offect);
        $this->db->from('con_task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //添加
    public function save_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('con_task',$data);
           return $res;
        }
    }
    //查询单条信息
    public function select_singleinfo($id)
    {
        $this->db->select('id,number,name,score');
        $this->db->where('id',$id);
        $this->db->from('con_task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //修改
    public function update_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('con_task',$data);
            return $res;
        }
    }
    //删除
    public function delete_model($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('con_task');
        return $res;
    }
}