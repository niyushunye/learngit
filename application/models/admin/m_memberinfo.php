<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_memberinfo extends MY_Model {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
         // $this->load->database('default', TRUE);
    }


    //修改密码
    public function change_password($accounts, $password){
      $result = $this->db->set('password', $password)
                         ->where('accounts', $accounts)
                         ->update('memberinfo');
      // echo $this->db->last_query();
      return $result;
    }

    //根据传来的经原编号取出密码
    public function get_password($accounts){
      $result = $this->db->select('password')
                         ->from('memberinfo')
                         ->where('accounts', $accounts)
                         ->get()
                         ->row_array();

      return $result;

    }


    //大队或支队获取其所属成员
    public function get_orgnum_member($orgnum){
        // $db_mysql = $this->load->database('default',TRUE);
        $orgnum8 = substr($orgnum, 0, 8);
        $result = $this->db->like('orgnum', $orgnum8, 'after')->get('memberinfo')->result_array();
        return $result;
    }

    public function get_orgnum_member_realname_accounts($orgnum, $curpage, $num){
        // $db_mysql = $this->load->database('default',TRUE);
        $orgnum8 = substr($orgnum, 0, 8);
        $this->db->select("realname, accounts");
        $this->db->like('orgnum', $orgnum8, 'after');
        $this->db->from('memberinfo');
        
        $db = clone($this->db);
        $result['total'] = $this->db->get()->num_rows();

        //复制
        $this->db = $db;
         //limit 8,0  每页8条数据，从第0条开始。
        $this->db->limit($num, $curpage);
        $result['data'] = $this->db->get()->result_array();
        return $result;
    }


    public function get_memberinfo_accounts($accounts){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberinfo.password
                                    FROM memberinfo
                                    WHERE memberinfo.accounts = $accounts");
        return $result->row_array();
    }


    public  function  get_member_telephone($orgnum, $curpage, $num){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberinfo.`accounts`, memberinfo.`realname`,
                                              memberinfo.`mobile`, memberinfo.`duanhao`
                                         FROM memberinfo
                                         WHERE orgnum = '$orgnum'
                                         LIMIT $curpage, $num");
        return $result->result_array();
    }

    public  function  get_member_telephone_total($orgnum){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberinfo.`accounts`, memberinfo.`realname`,
                                              memberinfo.`mobile`, memberinfo.`duanhao`
                                         FROM memberinfo
                                         WHERE orgnum = '$orgnum'");
        return $result->num_rows();
    }


    public  function  get_member_telephone_id($id){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberinfo.`accounts`, memberinfo.`realname`,
                                            memberinfo.`orgnum`, memberinfo.`mobile`, memberinfo.`duanhao`
                                    FROM memberinfo
                                    WHERE accounts = '$id';");
        return $result->result_array();
    }


    public function get_member(){
      $db_mysql = $this->load->database('default',TRUE);
      $result = $db_mysql->query("SELECT accounts from memberinfo");
      return $result->result_array();
    }


    public  function  update_member_telephone($member_telephone){
      $db_mysql = $this->load->database('default',TRUE);
        $db_mysql->query("UPDATE memberinfo
                          SET memberinfo.mobile = '{$member_telephone['mobile']}',memberinfo.duanhao = '{$member_telephone['duanhao']}'
                          WHERE memberinfo.accounts = '{$member_telephone['accounts']}'");
    }


    public function  search_memberinfo_realname($realname){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberinfo.memberid, memberinfo.realname,
                                   memberinfo.accounts, memberinfo.orgnum,memberinfo.duanhao,
                                   memberinfo.mobile, memberinfo.idcard, memberinfo.status,
                                   memberinfo.dateline
                          FROM memberinfo
                          WHERE memberinfo.realname = '$realname'
                          ORDER BY memberinfo.dateline DESC");
        return $result->result_array();
    }


    public function  search_memberinfo_accounts($accounts){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberinfo.memberid, memberinfo.realname,
                                   memberinfo.accounts, memberinfo.orgnum,memberinfo.duanhao,
                                   memberinfo.mobile, memberinfo.idcard, memberinfo.status,
                                   memberinfo.dateline
                          FROM memberinfo
                          WHERE memberinfo.accounts = '$accounts'
                          ORDER BY memberinfo.dateline DESC");
        return $result->result_array();
    }


    public function  get_message_send_orgnum($zhongDui8){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberid,accounts, realname  FROM memberinfo WHERE orgnum LIKE '$zhongDui8%';");
        return $result->result_array();
    }


    public  function  get_message_send_orgnum_($daDui8){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT memberid,accounts, realname  FROM memberinfo WHERE orgnum LIKE '$daDui8%';");
        return $result->result_array();
    }

    public function delete_by_accounts($accounts)
    {
      $db_mysql = $this->load->database('default',TRUE);
      $result = $db_mysql->query("DELETE FROM `memberinfo` WHERE `accounts` = '$accounts'");
      return $result;
    }

    public function get_orgnum_by_accounts($accounts)
    {
      $db_mysql = $this->load->database('default',TRUE);
      $result = $db_mysql->query("SELECT `orgnum`,`realname` FROM `memberinfo` WHERE `accounts` = '$accounts'");
      return $result->row_array();
    }

    public function get_realname_by_accounts($accounts)
    {
      $db_mysql = $this->load->database('default',TRUE);
      $result = $db_mysql->query("SELECT `realname` FROM `memberinfo` WHERE `accounts` = '$accounts'");
      return $result->row_array();
    }

    public function get_accounts_by_orgnum($orgnum)
    {
      // $this->db->order_by("accounts","DESC");
      $this->db->select("realname, accounts, orgnum");
      $this->db->where("orgnum", $orgnum);
      $result = $this->db->get("memberinfo")->result_array();
      return $result;
    }

    
    public function get_director_by_orgnum($orgnum)
    {
      $this->db->order_by("accounts","DESC");
      $this->db->select("realname, accounts, orgnum");
      $this->db->where("orgnum", $orgnum);
      $this->db->where("isAuxiliaryPolice", "1");
      $result = $this->db->get("memberinfo")->result_array();
      return $result;
    }

    public function relieve_by_accounts($accounts)
    {
      $db_mysql = $this->load->database('default',TRUE);
      $result = $db_mysql->query("DELETE FROM `member_binding` WHERE `accounts` = '$accounts'");
      return $result;
    }
}