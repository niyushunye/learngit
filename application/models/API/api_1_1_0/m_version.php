<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_version extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //获取版本
    public function get_version()
    {
        $this->db->select('version_name,version_description,version_app,update_code');
        $this->db->order_by('id','DESC');
        $this->db->from('version');
        $res = $this->db->get();
        return $res->row_array();
    }
}


