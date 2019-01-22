<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_roleinfo extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
         // $this->load->database('default', TRUE);
    }


    public function get_roleinfo($curpage, $num){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT roleinfo.roleid,roleinfo.rolefield,roleinfo.rolename,
                                          roleinfo.remark,roleinfo.dateline
                                    FROM  roleinfo
                                    ORDER BY roleinfo.dateline DESC
                                    LIMIT $curpage, $num ");
        return $result->result_array();
    }


    public  function get_roleinfo_all(){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT roleinfo.roleid,roleinfo.rolename
                                    FROM  roleinfo");
        return $result->result_array();
    }


    public function get_roleinfo_total(){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT roleinfo.roleid,roleinfo.rolefield,roleinfo.rolename,
                                          roleinfo.remark,roleinfo.dateline
                                    FROM  roleinfo");
        return $result->num_rows();
    }


    public  function  add_roleinfo($roleinfo){
        $db_mysql = $this->load->database('default',TRUE);
        $db_mysql->query("INSERT INTO roleinfo(roleinfo.`rolefield`, roleinfo.`rolename`,
                          roleinfo.`remark`, roleinfo.`dateline`) VALUES $roleinfo;");
    }


    public  function  get_roleinfo_roleid_rolename($roleid){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT roleinfo.`rolename`, roleinfo.`roleid`
                                    FROM roleinfo
                                    WHERE roleinfo.`roleid` = '$roleid'");
        return $result->result_array();
    }

    public  function  get_roleinfo_roleid_by_rolename($rolename){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT roleinfo.`rolename`, roleinfo.`roleid`
                                    FROM roleinfo
                                    WHERE roleinfo.`rolename` = '$rolename'");
        return $result->row_array();
    }

    public  function  get_roleinfo_num_by_rolename($data){
        $db_mysql = $this->load->database('default',TRUE);
        if(isset($data['roleid'])){
            $db_mysql->where("roleid !=",$data['roleid']);
        }
        if(isset($data['rolename'])){
            $db_mysql->where("rolename",$data['rolename']);
        }
        $result = $db_mysql->get('roleinfo');
        return $result->num_rows();
    }


    public  function  get_roleinfo_roleid_all($roleid){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT  roleinfo.`roleid`, roleinfo.`rolefield`,
                                    roleinfo.`rolename`, roleinfo.`remark`
                                    FROM roleinfo
                                    WHERE roleid = $roleid");
        return $result->row_array();
    }

    public  function  get_roleinfo_by_roleid($roleid){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT  roleinfo.`roleid`, roleinfo.`rolefield`,
                                    roleinfo.`rolename`, roleinfo.`remark`
                                    FROM roleinfo
                                    WHERE roleid = $roleid");
        return $result->result_array();
    }


    public  function delete_roleinfo($roleid){
        $db_mysql = $this->load->database('default',TRUE);
        $db_mysql->delete('roleinfo', array('roleid' => $roleid));
    }


    public function  update_roleinfo($roleinfo){
        $db_mysql = $this->load->database('default',TRUE);
        $db_mysql->where('roleid', $roleinfo['roleid']);
        $db_mysql->update('roleinfo', $roleinfo);
    }

}