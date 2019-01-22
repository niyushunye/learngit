<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_xingzheng  extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //添加
    public function add($data){
        $res = $this -> db -> insert('bas_xzqh',$data);
        return $res;
    }


    //查询是否重复
    public function select_row($number){
        $res = $this -> db -> where('number',$number) -> get('bas_xzqh') -> row_array();
        return $res;
    }

    //获取行政区划名称
    public function get_qhname(){
        $res = $this -> db -> where('parent_number','0') -> get('bas_xzqh') -> result_array();
        return $res;
    }

    //获取行政区划名称

    public function get_spuer(){
        $res = $this -> db -> select('name,number') -> from('bas_xzqh') -> where('number',XINGZQH) -> or_where('parent_number',XINGZQH) -> order_by('number','DESC') ->get() -> result_array();
        return $res;
    }

    //获取行政区划全部名称
//    public function get_spuer(){
//        $res = $this -> db -> select('name,number') -> from('bas_xzqh') -> where('number',XINGZQH) -> or_where('parent_number',XINGZQH);
//                $this -> db -> order_by('number','DESC') -> get() -> result_array();
//        $db_mysql = $this->load->database('default',TRUE);
//        $result = $db_mysql->query("SELECT name, number
//                                    FROM `bas_xzqh`
//                                    WHERE `number` = 610000
//                                    OR `parent_number` = 610000
//                                    ORDER BY `number` DESC");
//        return $res;
//    }

    public function get_super1($orgnum){
        $db_mysql = $this->load->database('default',TRUE);
        $_result = $db_mysql->query("SELECT name, number,parent_number
                                      FROM `bas_xzqh`
                                      WHERE `parent_number` = '{$orgnum}'
                                      ORDER BY `parent_number` DESC");
        return $_result->result_array();
    }

    public function get_orginfo($orgnum){
        $db_mysql = $this->load->database('default',TRUE);
        $_result = $db_mysql->query("SELECT name, number,type
                                    FROM `bas_xzqh`
                                    WHERE bas_xzqh.`parent_number` = '{$orgnum}'");
        return $_result->result_array();
    }

    //根据编码获取信息
    public function get_orgname($orgnum){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT *
                                    FROM `bas_xzqh`
                                    WHERE `number` = '{$orgnum}'");
        return $result->result_array();
    }

    public function get_orgname_paging1($orgnum, $curpage, $num){
        $res = $this -> db -> where('number',$orgnum) -> limit($curpage, $num) -> get('bas_xzqh') -> result_array();
        $res['0']['sj_name'] = $this -> sj_name($res['0']['parent_number']);
        return $res;
    }

    public function sj_name($number){
        $res = $this -> db -> select('name') -> where('number',$number) -> get('bas_xzqh') -> row_array();
        return $res;
    }

    public function get_orgname_paging($orgnum, $curpage, $num){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT *
                                    FROM `bas_xzqh`
                                    WHERE `number` = '{$orgnum}'
                                    LIMIT $curpage, $num");
        return $result->result_array();
    }

    public function get_orgname_total($orgnum){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT name, number
                                    FROM `bas_xzqh`
                                    WHERE `number` = '{$orgnum}'");
        return $result->num_rows();
    }


    //查询上级
    public function xiangzheng_sj($orgnum){
        $data = $this -> db -> where('number',$orgnum) -> get('bas_xzqh') -> row_array();
        return $data;
    }

    //根据id查询行政区划单挑信息
    public function select_dg($id){
        $data = $this ->db -> where('id',$id) -> get('bas_xzqh') -> row_array();

        return $data;
    }

    //修改更新行政区化
    public function upload($id,$data){
        $res = $this -> db -> where('id',$id) -> update('bas_xzqh',$data);
        return $res;
    }


    //删除时查询它有无下级
    public function select_xj($number){
        $res = $this -> db -> where('parent_number',$number) -> get('bas_xzqh') -> result_array();
        return $res;
    }

    //执行删除操作
    public function delect($id){
        $res = $this -> db -> where('id',$id) -> delete('bas_xzqh');
        return $res;
    }

    //查询安全责任干部如果有则同步更新
    public function select_gb($number){
        $res = $this -> db -> where('dept_number',$number) -> get('bas_assist') -> result_array();
        return $res;
    }

    //更新安全责任干部行政区划名称
    public function upload_gb($number,$data1){
        $res = $this -> db -> where('dept_number',$number) -> update('bas_assist',$data1);
        return $res;
    }

    //查询删除的行政区划下有无安全责任干部
    public function select_aq($number){
        $res = $this -> db -> where('dept_number',$number) -> get('bas_assist') -> result_array();
        return $res;
    }

    //同步更新行政区划的下级编码
    public function upload_number($number,$data3){
        $res = $this -> db -> where('parent_number',$number) -> update('bas_xzqh',$data3);
        return $res;
    }

    //查询危险道路表中有无此编码  有更新
    public function select_wxdl($number1){
        $res = $this -> db -> where('xzqh',$number1) -> get('bas_danger_road') -> result_array();
        return $res;
    }

    public function upload_wxdl($number,$data3){
        $res = $this -> db -> where('xzqh',$number)  -> update('bas_danger_road',$data3);
        return $res;
    }

// |-----------------------------------------------------------行政区划安全责任干部详情--------------------------------------------------------------|

    //查出行政区划
    public function select_area(){
        $res = $this -> db -> select('name,number') -> get('bas_xzqh') -> result_array();
        foreach ($res as $k => $v){
            $res[$k]['details'] = $this -> select_cadres($v['number']);
        }
        return $res;
    }

    //查出行政区划下的安全责任干部
    public function select_cadres($number){
        $res = $this -> db -> select('name,position,phone_number') -> where('dept_number',$number) -> get('bas_assist') -> result_array();
        return $res;
    }

}