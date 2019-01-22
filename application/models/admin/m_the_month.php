<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_the_month extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(id) total');
        $this->db->from('the_month_money');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有信息
    public function select_all_info($pagenum,$offect)
    {
        $this->db->select('id,mtime,jnzd,jbzd,xlzd,ztzd,yhzd,dhzd,tbzd,hszd,zdzd,dateline');
        $this->db->limit($pagenum,$offect);
        $this->db->from('the_month_money');
        $res = $this->db->get();
        return $res->result_array();
    }
    //新增
    public function save_model($data)
    {
        if(!empty($data))
        {
            $res =  $this->db->insert('the_month_money',$data);
            return $res;
        }
    }
    //查询单条记录的详细信息
    public function select_single_info($id)
    {
        $this->db->select('id,mtime,jnzd,jbzd,xlzd,ztzd,yhzd,dhzd,tbzd,hszd,zdzd,dateline');
        $this->db->where('id',$id);
        $this->db->from('the_month_money');
        $res = $this->db->get();
        return $res->result_array();
    }
    //编辑
    public function update_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('the_month_money',$data);
            return $res;
        }
    }
    //删除
    public function delete_model($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('the_month_money');
        return $res;
    }
}