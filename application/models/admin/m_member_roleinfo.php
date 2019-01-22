<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_member_roleinfo extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
         // $this->load->database('default', TRUE);
    }

    public function  get_roleid_by_accounts($accounts){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT `roleid` FROM `member_roleinfo` WHERE `accounts` = '{$accounts}'");
        return $result->row_array();
    }

}