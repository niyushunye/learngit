<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_non_vehicle  extends MY_Model
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
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> get('bas_non_vehicle') -> result_array();
        return count($res);
    }

    //查询数据
    public function select_vehicle($orgnumss,$curpage,$num){
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> limit($num,$curpage) -> get('bas_non_vehicle') -> result_array();

        foreach ($res as $k => $v){
            $res[$k]['syxz_name'] = $this -> syxz_name($v['syxz']);       //使用性质
            $res[$k]['hpzl_name111'] = $this -> hpzl_name($v['hpzl']);     //好牌种类名称
            $res[$k]['xzqh_name'] = $this -> xzqh_name($v['xzqh']);     //行政区化名称
            $res[$k]['cllb_name'] = $this -> cllb_name($v['cllb']);      //车辆类别
            $res[$k]['jymc'] = $this -> jymc_name($v['jybh']);       //警员名称
        }
        return $res;
    }

    //好牌种类
    public function hpzl_name($id){
        $res = $this -> db -> select('DMSM1') -> where('XTLB','00') -> where('DMLB','1007') -> where('DMZ',$id) -> get('frm_code') -> row_array();
        return $res;
    }

    //行政区化名称
    public function xzqh_name($id){
        $res = $this -> db -> select('name') -> where('number',$id) -> get('bas_xzqh') -> row_array();
        return $res;
    }

    //车辆类别
    public function cllb_name($id){
        $res = $this -> db -> select('DMSM1') -> where('XTLB','04') -> where('DMLB','0081') -> where('DMZ',$id) -> get('frm_code') -> row_array();
        return $res;
    }
    //使用性质
    public function syxz_name($i){
        $res = $this -> db -> select('DMSM1') -> where('XTLB','00') -> where('DMLB','1003') -> where('DMZ',$i) -> get('frm_code') -> row_array();
        return $res;
    }

    //警员名称
    public function jymc_name($id){
        $res = $this -> db -> select('name') -> where('rybh',$id) -> get('bas_assist') -> row_array();
        return $res;
    }


    //查看详情
    public function select_details($id){
        $res = $this -> db -> where('id',$id) -> get('bas_non_vehicle') -> row_array();
        $res['syxz_name'] = $this -> syxz_name($res['syxz']); //使用性质
        $res['hpzl_name111'] = $this -> hpzl_name($res['hpzl']); //好牌种类名称
        $res['xzqh_name'] = $this -> xzqh_name($res['xzqh']); //行政区化名称
        $res['cllb_name'] = $this -> cllb_name($res['cllb']); //车辆类别
        $res['jymc'] = $this -> jymc_name($res['jybh']); //警员名称
        return $res;
    }

    //删除数据
    public function delete_select($id){
        $res = $this -> db -> where('id',$id) -> delete('bas_non_vehicle');
        return $res;
    }

    //更新修改数据
    public function select_upload($id,$data){
        $res = $this -> db -> where('id',$id) -> update('bas_non_vehicle',$data);
        return $res;
    }

    //统计
    //查询车辆类型
//    public function select_clxx(){
//        $data = $this -> db -> select('DMSM1') -> where('XTLB','04') -> where('DMLB','0081') -> get('frm_code') -> result_array();
//        return $data;
//    }

    //查询统计结果
    public function select_tj(){
        $data = $this -> db -> select('name,parent_number,number,') -> where('parent_number','0') -> or_where('parent_number',XINGZQH) -> get('bas_xzqh') -> result_array();  //查询结果
        $data1 = array(                            //$data1为车辆类型代码
            1,2,3,4,5,6,7,8,9,10,11
        );
        foreach ($data as $k => $v){                   //循环查询结果为其添加乡镇数量和车辆类型结果
            $data[$k]['count'] = $this -> select_count($v['number']);    //乡镇数量
            foreach ($data1 as $k1 => $v2){
                $data3[$k1]['DMSM1'] = $this -> select_dmsm($v2,$v['number']);
            }
            $data[$k]['cllx'] = $data3;
            foreach ($data3 as $kk => $vv){
                foreach ($vv as $kkk => $vvv){
                    $data4[$kk] = $vvv;
                }
            }
            $data[$k]['zs'] =array_sum($data4);
        }
        $data[$k+1] = array();
        $data[$k+1]['name'] = '总数';
        $data[$k+1]['count'] = count($this -> db -> get('bas_xzqh') -> result_array());
        $data[$k+1]['cllx'] = array();
        foreach ($data1 as $k5 => $v6){
            $data[$k+1]['cllx'][]['DMSM1'] = count($this ->db -> where('cllb',$v6) -> get('bas_non_vehicle') -> result_array());
            $data5[] = count($this ->db -> where('cllb',$v6) -> get('bas_non_vehicle') -> result_array());
        }
        $data[$k+1]['zs'] = array_sum($data5);
        return $data;
    }


    //车辆类型查
    public function select_dmsm($dmz,$number){

        $this -> db -> select('number');
        if($number == XINGZQH){
            $this -> db -> where('number',$number);
        }else{
            $this -> db -> where('parent_number',$number);
            $this -> db -> or_where('number',$number);
        }
        $res = $this ->db -> get('bas_xzqh') -> result_array();
        foreach ($res as $k => $v){
            foreach ($v as $k1 => $v1){
                $data1[] = $v1;
            }
        }
        $data = $this ->db -> where('cllb',$dmz) -> where_in('xzqh',$data1) -> get('bas_non_vehicle') -> result_array();

        $res = count($data);
        return $res;
    }

    //乡镇数量
    public function select_count($number){
        $data = $this -> db -> where('parent_number',$number) -> get('bas_xzqh') -> result_array();
        if($number == XINGZQH){
            $res = count($data) + 1;
        }else{
            $res = count($data);
        }
        return $res;
    }

    //查询带条件的数据
    public function where_select_sousuo($clsyr,$sfzh,$xzqh){
        $data = $this -> orgnums($xzqh);

        foreach ($data as $k => $v ){
            foreach ($v as $k1 => $v2){
                $data1[$k] = $v2;
            }
        }
        $this -> db -> where_in('xzqh',$data1) -> like('clsyr',$clsyr,'both');
        if($sfzh != '' && $sfzh != '0'){
            $this -> db -> where('sfzh',$sfzh);
        }
        $res = $this -> db -> get('bas_non_vehicle') -> result_array();

        foreach ($res as $key => $value){
            $res[$key]['syxz_name'] = $this -> syxz_name($value['syxz']);       //使用性质
            $res[$key]['hpzl_name111'] = $this -> hpzl_name($value['hpzl']);     //好牌种类名称
            $res[$key]['xzqh_name'] = $this -> xzqh_name($value['xzqh']);     //行政区化名称
            $res[$key]['cllb_name'] = $this -> cllb_name($value['cllb']);      //车辆类别
            $res[$key]['jymc'] = $this -> jymc_name($value['jybh']);       //警员名称
        }

        return $res;
    }

    //带条件查询的总数
    public function where_select_count($clsyr,$sfzh,$xzqh){
        $data =  $this -> where_select_sousuo($clsyr,$sfzh,$xzqh);
        return count($data);
    }


}