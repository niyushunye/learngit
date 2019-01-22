<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_update_password extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public  function select_accounts_model($accounts,$password)
    {
        $this->db->select('accounts');
        $this->db->where('accounts',$accounts);
        $this->db->where('password',$password);
        $this->db->from('memberinfo');
        $res = $this->db->get();
        return $res->row_array();
    }
    //更新密码
    public function modify_password_model($accounts,$data)
    {
        $this->db->where('accounts',$accounts);
        $res = $this->db->update('memberinfo',$data);
        return $res;
    }

    
}


