<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_module_roleinfo extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
         // $this->load->database('default', TRUE);
    }

    public function  get_module_roleinfo($roleid){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT * FROM `module_roleinfo` WHERE `roleid` = '{$roleid}'");
        return $result->result_array();
    }

    public function  get_moduleid_by_roleid($roleid){
      $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT `moduleid` FROM `module_roleinfo` WHERE `roleid` = '{$roleid}'");
        return $result->result_array();
    }

    public  function  add_module_roleinfo($member){
      $db_mysql = $this->load->database('default',TRUE);
         $db_mysql->query("INSERT INTO module_roleinfo(moduleid,roleid,pc_onoff,mobile_onoff,dateline)
                           VALUES $member");
    }


    public  function  update_module_roleinfo($member){
      $db_mysql = $this->load->database('default',TRUE);
        $db_mysql->query("UPDATE module_roleinfo mr
                          SET mr.`roleid` = '{$member['roleid']}', mr.`pc_onoff` = '{$member['pc_onoff']}',
                              mr.`mobile_onoff`= '{$member['mobile_onoff']}', mr.`dateline` = '{$member['dateline']}'
                          WHERE mr.`moduleid`= {$member['moduleid']}");
    }

    public  function  delete_module_roleinfo($roleid){
      $db_mysql = $this->load->database('default',TRUE);
        $db_mysql->query("DELETE FROM module_roleinfo WHERE roleid = $roleid ;");
    }

}