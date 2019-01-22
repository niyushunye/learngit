<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_version_management  extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(id) total');
        $this->db->from('version');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有版本信息
    public function select_all_info()
    {
        $this->db->select('id,version_name,version_description,version_url,dateline');
        $this->db->from('version');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询单条记录的详细信息
    public function select_single_info($id)
    {
        $this->db->select('id,version_name,version_description,version_url,dateline,update_code');
        $this->db->where('id',$id);
        $this->db->from('version');
        $res = $this->db->get();
        return $res->result_array();
    }
    //添加
    public function save_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('version',$data);
           return $res;
        }
    }
    //编辑
    public function update_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('version',$data);
            return $res;
        }
    }

    //编辑
    public function update($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('version',array('version_app'=>$data));
            return $res;
        }
    }
    //删除
    public function delete_model($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('version');
        return $res;
    }
}