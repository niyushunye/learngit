<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_moduleinfo extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
         $this->load->database('default', TRUE);
    }


    public function  get_moduleinfo($curpage, $num){
        $result = $this->db->query("SELECT moduleinfo.moduleid, moduleinfo.modtitle,
                                          moduleinfo.modname,moduleinfo.modurl,
                                          moduleinfo.parentid, moduleinfo.classify,
                                          moduleinfo.dateline
                                    FROM moduleinfo
                                    ORDER BY moduleinfo.moduleid DESC
                                    LIMIT $curpage, $num");
        return $result->result_array();
    }


    public  function  modtitle_moduleid_parentid(){
        $result = $this->db->query("SELECT modtitle, moduleid, parentid FROM moduleinfo");
        return $result->result_array();
    }


    public function get_moduleinfo_moduleid_modtitle($moduleid){
        $result = $this->db->query("SELECT modtitle FROM moduleinfo WHERE moduleid = $moduleid");
        return $result->result_array();
    }


    public function  get_moduleinfo_total(){
        $result = $this->db->query("SELECT moduleinfo.moduleid, moduleinfo.modtitle
                                    FROM moduleinfo");
        return $result->num_rows();
    }


    //在模块表中根据父模块id查询对应的模块中文名称
    public  function  get_moduleinfo_parentid($value){
        $result = $this->db->query("SELECT modtitle
                                    FROM moduleinfo
                                    WHERE moduleid = $value");
        return $result->row_array();
    }


    public  function  get_moduleinfo_parent(){
        $result = $this->db->query("SELECT modtitle, moduleid
                                    FROM moduleinfo
                                    WHERE parentid = 0;");
        return $result->result_array();
    }


    public  function  add_moduleinfo($moduleinfo){
        $this->db->query("INSERT INTO moduleinfo(modtitle, modname, modurl, parentid ,classify,dateline)
                          VALUES $moduleinfo");
    }


    public  function  get_moduleinfo_modtitle_all($modtitle){
        $result = $this->db->query("SELECT * FROM moduleinfo WHERE modtitle = '{$modtitle}'");
        return $result->result_array();
    }


    public  function  get_module_moduleid_all_($moduleid){
        $result = $this->db->query("SELECT * FROM moduleinfo WHERE modtitle = '{$moduleid}'");
        return $result->result_array();
    }


    public  function  get_module_moduleid($moduleid){
        $result = $this->db->query("SELECT  moduleinfo.parentid
                                    FROM  moduleinfo
                                    WHERE  moduleinfo.moduleid = $moduleid");
        return $result->row_array();
    }

    public  function  get_module_by_moduleid($moduleid){
        $result = $this->db->query("SELECT  *
                                    FROM  moduleinfo
                                    WHERE  moduleinfo.moduleid = $moduleid");
        return $result->row_array();
    }



    public  function  get_parentid($moduleid){
        $result = $this->db->query("SELECT  moduleinfo.parentid
                                     FROM  moduleinfo,roleinfo
                                     WHERE  moduleinfo.moduleid = $moduleid");
        return $result->row_array();
    }

    public  function  get_module_moduleid_all($moduleid){
        $result = $this->db->query("SELECT moduleinfo.moduleid, moduleinfo.modtitle, moduleinfo.modname,moduleinfo.modurl,
                                            moduleinfo.parentid, moduleinfo.classify, moduleinfo.dateline
                                    FROM  moduleinfo
                                    WHERE  moduleinfo.moduleid = $moduleid
                                    ORDER BY  moduleinfo.dateline DESC ");
        return $result->result_array();
    }

    //当parentid == "" 时候,不需要代入路径和parentid的值，因为是一级目录
    public  function  update_moduleinfo($moduleinfo){
        $this->db->query("UPDATE moduleinfo mo
                          SET mo.`modtitle` = '{$moduleinfo['modtitle']}', mo.`modname` = '{$moduleinfo['modname']}',
                              mo.`classify = '{$moduleinfo['classify']}', mo.`dateline` = '{$moduleinfo['dateline']}'
                          WHERE mo.`moduleid`= {$moduleinfo['moduleid']}");
    }

    //当parentid ！= "" 时候，因为是二级目录，所以需要代入路径和父id。
    public function  update_moduleinfo_($moduleinfo){
        $this->db->query("UPDATE moduleinfo mo
                          SET mo.`modtitle` = '{$moduleinfo['modtitle']}', mo.`modname` = '{$moduleinfo['modname']}',
                             mo.`modurl` = '{$moduleinfo['modurl']}',mo.`parentid`= '{$moduleinfo['parentid']}',
                             mo.`classify` = '{$moduleinfo['classify']}', mo.`dateline` = '{$moduleinfo['dateline']}'
                          WHERE mo.`moduleid`= {$moduleinfo['moduleid']}");
    }

    public function  delete_moduleinfo($moduleid){
        $this->db->query(" DELETE FROM moduleinfo WHERE moduleid = $moduleid;");
    }
}