<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_driver  extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询下级行政编码
    public function orgnums($orgnum)
    {
        $this->db->select('number');
        if ($orgnum == XINGZQH) {

        } else {
            $this->db->where('parent_number', $orgnum);
            $this->db->or_where('number', $orgnum);
        }
        $res = $this->db->get('bas_xzqh')->result_array();
        return $res;

    }


    //查询总数
    public function select_vehicle_count($orgnumss){
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> get('bas_driver') -> result_array();
        return count($res);
    }


    public function select_vehicle($orgnumss,$curpage,$num){
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> limit($num,$curpage) -> get('bas_driver') -> result_array();

        foreach ($res as $k => $v){

            $res[$k]['xzqh_name'] = $this -> xzqh_name($v['xzqh']);     //行政区化名称
            $res[$k]['jymc'] = $this -> jymc_name($v['jybh']);       //警员名称
        }
        return $res;
    }
    //行政区划
    public function xzqh_name($id){
        $res = $this -> db -> select('name') -> where('number',$id) -> get('bas_xzqh') -> row_array();
        return $res;
    }
    //警员名称
    public function jymc_name($id){
        $res = $this -> db -> select('name') -> where('rybh',$id) -> get('bas_assist') -> row_array();
        return $res;
    }

    //查看详情
    public function select_details($id){
        $data = $this -> db -> where('id',$id) -> get('bas_driver') -> row_array();
        $data['xzqh_name'] = $this -> xzqh_name($data['xzqh']);  //行政区划
        $data['jymc'] = $this -> jymc_name($data['jybh']);   //警员名称
        return $data;
    }


    //删除数据
    public function select_delete($id){
        $res = $this -> db -> where('id',$id) -> delete('bas_driver');
        return $res;
    }


    //更新修改数据
    public function select_up($id,$data){
        $res = $this -> db -> where('id',$id) -> update('bas_driver',$data);
        return $res;
    }


    //驾驶人数量统计
    public function xzqh_count(){
        //查询一级二级的行政区划名称 上级行政区划编码  以及自己本身的行政区划编码
        $data = $this -> db -> select('name,parent_number,number') -> where('parent_number','0') -> or_where('parent_number',XINGZQH) -> get('bas_xzqh') -> result_array();

        foreach ($data as $k => $v){         //循环上述查询的结果
            $data[$k]['count'] = $this -> select_count($v['number']);    //调用下面的select_count方法为其传递行政区划编码 使其查询出乡镇村数量
            $data[$k]['wxdl_count'] = $this -> select_wxdl_xount($v['number']);    //调用下面的select_wxdl_xount方法为其传递行政区划编码参数  使其查询出每个乡镇村驾驶人数量
        }
        $data[$k+1] =array();

        $data[$k+1]['name'] = '总数';
        $data[$k+1]['count'] = count($this -> db -> get('bas_xzqh') -> result_array());
        $data[$k+1]['wxdl_count'] = count($this -> db -> get('bas_driver') -> result_array());
        return $data;     //输出结果
    }

    //查询出乡镇村的数量
    public function select_count($number){  //接受传递的行政区划参数
        $data = $this -> db -> where('parent_number',$number) -> get('bas_xzqh') -> result_array();    //以行政区划为参数查询出它的下级
        if($number == XINGZQH){
            $res = count($data) + 1;
        }else{
            $res = count($data);
        }
        return $res;   //输出计算出的结果
    }

    //驾驶人数量统计
    public function select_wxdl_xount($number){     //接受传递的行政区划编码参数
        $this->db->select('number');
        if ($number == XINGZQH) {   //如果传递 的行政区划编码等于XINGZQH  就查询出全部的刑侦区划编码
            $this->db->where('number', XINGZQH);
        } else {                      //如果不等于XINGZQH 就查询出自己以及自己下级的行政区划编码
            $this->db->where('parent_number', $number);
            $this->db->or_where('number', $number);
        }
        $data = $this->db->get('bas_xzqh')->result_array();     //得到一个二维数组的形式的结果

//        $data = $this -> db -> select('number') -> where('parent_number',$number) -> or_where('number',$number) -> get('bas_xzqh') -> result_array();

        foreach ($data as $k => $v){           //循环上面查询的结果  让它成为一维数组
            foreach ($v as $k1 => $v1){
                $data1[] = $v1;
            }
        }
        $data_count = $this -> db -> where_in('xzqh',$data1) -> get('bas_driver') -> result_array();   //以上面循环出来的一维数组为条件查询出每个乡镇的驾驶员数量
        $count = count($data_count);   //计算出每个乡真下的驾驶员数量
        return $count;    //输出计算出的结果
    }

    //带条件得查询
    public function where_select_suosou($sfzh,$xm,$xzqh){
        $data = $this -> orgnums($xzqh);

        foreach ($data as $k1 => $v1){
            foreach ($v1 as $key => $value){
                $data1[$k1] = $value;
            }
        }
        $this -> db -> where_in('xzqh',$data1) -> like('xm',$xm,'both');
        if($sfzh != '' && $sfzh != '0'){
            $this -> db -> where('sfzh',$sfzh);
        }
        $res =  $this -> db -> get('bas_driver') -> result_array();

        foreach ($res as $k2 => $v3){
            $res[$k2]['xzqh_name'] = $this -> xzqh_name($v3['xzqh']);     //行政区化名称
            $res[$k2]['jymc'] = $this -> jymc_name($v3['jybh']);       //警员名称
        }
        return $res;
    }

    //获取条件查询总数
    public function where_select_count($sfzh,$xm,$xzqh){
        $data = $this -> where_select_suosou($sfzh,$xm,$xzqh);
        return count($data);
    }































}