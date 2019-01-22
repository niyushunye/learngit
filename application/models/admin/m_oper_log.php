<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_oper_log extends MY_Model {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
         // $this->load->database('default', TRUE);
    }

    // public function add($where){

    //     $this->db->insert('operation_log', $where);
    //     echo $this->db->last_query();
    //     return $this->db->affected_rows();

    // }



    public function get_oper_log($curpage, $num ){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT *
                                    FROM operation_log
                                    ORDER BY dateline DESC
                                    LIMIT $curpage, $num");
        return $result->result_array();
    }

    public  function  get_oper_log_total(){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT *
                                    FROM operation_log");
        return $result->num_rows();
    }



    public function add_oper_log($oper){

        $this->db->insert('operation_log', $oper);
        // echo $this->db->last_query();
        return $this->db->affected_rows();

    }


    public  function  search_oper_accounts($accounts){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT * FROM operation_log WHERE oper_accouts = '{$accounts}';");
        return $result->result_array();
    }

    public  function  search_oper_member($member){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT * FROM operation_log WHERE oper_member = '{$member}'");
        return $result->result_array();
    }
}