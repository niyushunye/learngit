<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_danger_load  extends MY_Model
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
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> get('bas_danger_road') -> result_array();
        return count($res);
    }


    public function select_vehicle($orgnumss,$curpage,$num){
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> limit($num,$curpage) -> get('bas_danger_road') -> result_array();

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
        $res = $this -> db -> where('id',$id) -> get('bas_danger_road') -> row_array();
        $res['lrmj'] = $this -> jymc_name($res['jybh']);
        $res['xzqh_name'] = $this -> xzqh_name($res['xzqh']);
        return $res;
    }

    //删除数据
    public function select_delete($id){
        $data = $this -> db -> where('id',$id) -> delete('bas_danger_road');
        return $data;
    }

    //修改数据
    public function select_edit($id,$data){
        $res = $this ->db -> where('id',$id) -> update('bas_danger_road',$data);
        return $res;
    }


    //危险道路数量统计
    public function xzqh_count(){

        //查询出行政区划名称上级编码 及自己本身编码
        $data = $this -> db -> select('name,parent_number,number') -> where('parent_number','0') -> or_where('parent_number',XINGZQH) -> get('bas_xzqh') -> result_array();

        foreach ($data as $k => $v){                           //循环上面的查出的结果 为其添加乡镇村数量和危险道路数量
            $data[$k]['count'] = $this -> select_count($v['number']);    //调用下面的select_count方法给其传递行政区划编码
            $data[$k]['wxdl_count'] = $this -> select_wxdl_xount($v['number']);    //调用下面的select_wxdl_xount方法给传递行政区划编码
        }

        $data[$k+1] =array();

        $data[$k+1]['name'] = '总数';
        $data[$k+1]['count'] = count($this -> db -> get('bas_xzqh') -> result_array());
        $data[$k+1]['wxdl_count'] = count($this -> db -> get('bas_danger_road') -> result_array());

        return $data;    //输出查询结果
    }

    //乡镇数量
    public function select_count($number){   //接受传递的参数行政区划编码
        $data = $this -> db -> where('parent_number',$number) -> get('bas_xzqh') -> result_array();    //查询出他的下级
        if($number == XINGZQH){
            $res = count($data) + 1;
        }else{
            $res = count($data);
        }
        return $res;   //输出计算出的结果
    }

    //危险道路数量
    public function select_wxdl_xount($number){
        $this->db->select('number');
        if ($number == XINGZQH) {         //判断传递的行政区划是否等于XINGZQH  如果等于查询全部行政区划编码
            $this->db->where('number', XINGZQH);
        } else {                                //如果不等于XINGZQH 那就只查自己本身及下级的行政区划编码
            $this->db->where('parent_number', $number);
            $this->db->or_where('number', $number);
        }
        $data = $this->db->get('bas_xzqh')->result_array();        //查询结果

//        $data = $this -> db -> select('number') -> where('parent_number',$number) -> or_where('number',$number) -> get('bas_xzqh') -> result_array();

        foreach ($data as $k => $v){               //循环查询结果使其成为一维数组
            foreach ($v as $k1 => $v1){
                $data1[] = $v1;
            }
        }
        $data_count = $this -> db -> where_in('xzqh',$data1) -> get('bas_danger_road') -> result_array();  //已循环出的一维数组为条件去查询
        $count = count($data_count);           //计算查询的结果
        return $count;         //输出查询的结果
    }

    //带条件查询
    public function where_select_suosou($dlmc,$xzqh1){
        $xzqh = $this -> orgnums($xzqh1);
        foreach ($xzqh as $k => $v){
            foreach ($v as $k1 => $v1){
                $data[] = $v1;
            }
        }
        $data1 = $this -> db -> where_in('xzqh',$data) -> like('dlmc', $dlmc, 'both') -> get('bas_danger_road') -> result_array();
        foreach ($data1 as $key => $value){
            $data1[$key]['xzqh_name'] = $this -> xzqh_name($value['xzqh']);     //行政区化名称
            $data1[$key]['jymc'] = $this -> jymc_name($value['jybh']);       //警员名称
        }
        return $data1;
    }

    //带条件的查询总数
    public function where_select_count($dlmc,$xzqh1){
       $count = $this -> where_select_suosou($dlmc,$xzqh1);
        return count($count);
    }
}