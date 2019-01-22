<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_xzqh extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询父级编码为0的信息
    public function select_0($info){
        $res = $this -> db -> where('number',$info) -> get('bas_xzqh') -> row_array();
        return $res;
    }

    //查询二三级行政区划
    public function select_ej($number){
        $res = $this -> db -> where('parent_number',$number) -> get('bas_xzqh') -> result_array();
        return $res;
    }


    //查出个人信息
    public function select_xx($id){
        $res = $this -> db -> where('rybh',$id) ->get('bas_assist') -> row_array();
        return $res;
    }


    //添加机动车
    public function add_vehicle($data){
        $res = $this -> db -> insert('bas_vehicle',$data);
        return $res;
    }

    //危险道路统计添加
    public function add_danger_road($data){
        $res = $this -> db -> insert('bas_danger_road',$data);
        return $res;
    }

    //驾驶员信息
    public function add_driver($data){
        $res = $this -> db -> insert('bas_driver',$data);
        return $res;
    }

    //无牌激动车
    public function add_non_vehicle($data){
        $res = $this -> db -> insert('bas_non_vehicle',$data);
        return $res;
    }


}