<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_user_login extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //验证警员登录
    public function verify_login_model($accounts,$password)
    {
        $this->db->select('memberid,realname,accounts,memberinfo.orgnum,mobile,idcard,orgname');
        $this->db->join('orginfo','memberinfo.orgnum=orginfo.orgnum');
        $this->db->where('accounts',$accounts);
        $this->db->where('password',$password);
        $this->db->from('memberinfo');
        $res = $this->db->get();
        return $res->row_array();
    }
}

