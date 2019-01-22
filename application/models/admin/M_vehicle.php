<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class M_vehicle  extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询下级行政编码
    public function orgnums($orgnum){
         $this -> db -> select('number');
         if($orgnum == XINGZQH){

         }else{
             $this -> db -> where('parent_number',$orgnum);
             $this -> db -> or_where('number',$orgnum);
         }
         $res = $this ->db -> get('bas_xzqh') -> result_array();
         return $res;

    }

    //查询总数
    public function select_vehicle_count($orgnumss){
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> get('bas_vehicle') -> result_array();
        return count($res);
    }

    //查询数据
    public function select_vehicle($orgnumss,$curpage,$num){
        $res = $this -> db -> where_in('xzqh',$orgnumss) -> limit($num,$curpage) -> get('bas_vehicle') -> result_array();

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
        $data = $this -> db -> where('id',$id) -> get('bas_vehicle') -> row_array();
        $data['syxz_name'] = $this -> syxz_name($data['syxz']);         //使用性质
        $data['hpzl_name111'] = $this -> hpzl_name($data['hpzl']);     //好牌种类名称
        $data['xzqh_name'] = $this -> xzqh_name($data['xzqh']);     //行政区化名称
        $data['cllb_name'] = $this -> cllb_name($data['cllb']);      //车辆类别
        $data['jymc'] = $this -> jymc_name($data['jybh']);       //警员名称
        return $data;
    }

    //删除数据
    public function delete_select($id){
        $res = $this -> db -> where('id',$id) -> delete('bas_vehicle');
        return $res;
    }

    //更新编辑数据
    public function select_upload($id,$data){
        $res = $this -> db -> where('id',$id) -> update('bas_vehicle',$data);
        return $res;
    }


    //统计
    //查询车辆类型
//    public function select_clxx(){
//        $data = $this -> db -> select('DMSM2') -> where('XTLB','04') -> where('DMLB','0081') -> get('frm_code') -> result_array();
//        return $data;
//    }
    //查询统计结果
    public function select_tj(){
        $data = $this -> db -> select('name,parent_number,number,') -> where('parent_number','0') -> or_where('parent_number',XINGZQH) -> get('bas_xzqh') -> result_array();
        //$data1 = $this -> db -> select('DMSM1,DMZ') -> where('XTLB','04') -> where('DMLB','0081') -> get('frm_code') -> result_array();

        //车辆类型代码
        $data1 = array(
            1,2,3,4,5,6,7,8,9,10,11
        );
        //循环查询到的结果
        foreach ($data as $k => $v){
            $data[$k]['count'] = $this -> select_count($v['number']);    //为查询到的结果添加乡镇数量
            //循环车辆类型代码
            foreach ($data1 as $k1 => $v2){
                $data3[$k1]['DMSM1'] = $this -> select_dmsm($v2,$v['number']);   //根据车辆代码以及行政区划编码为条件查询出机动车的数量
            }
            $data[$k]['cllx'] = $data3;                            //使结果已数组的形式输出
            //循环机动车数量结果使其变成以为数组
            foreach ($data3 as $kk => $vv){
                foreach ($vv as $kkk => $vvv){
                    $data4[$kk] = $vvv;               //$data4是每个行政区划下的的车辆类型数量的一维数组
                }
            }
            $data[$k]['zs'] =array_sum($data4);        //使用$data4计算出每个乡镇下的机动车数量
        }
        $data[$k+1] = array();
        $data[$k+1]['name'] = '总数';
        $data[$k+1]['count'] = count($this -> db -> get('bas_xzqh') -> result_array());
        $data[$k+1]['cllx'] = array();
        foreach ($data1 as $k5 => $v6){
            $data[$k+1]['cllx'][]['DMSM1'] = count($this ->db -> where('cllb',$v6) -> get('bas_vehicle') -> result_array());
            $data5[] = count($this ->db -> where('cllb',$v6) -> get('bas_vehicle') -> result_array());
        }

        $data[$k+1]['zs'] = array_sum($data5);
        return $data;        //返回查询的总结果
    }
    //车辆类型查
    public function select_dmsm($dmz,$number){                //根据传过来的车辆类型代码以及行政区划编码查询出结果

        $this -> db -> select('number');
        if($number == XINGZQH){            //XINGZQH是自定义的常量   如果传过来的行政区划编码等于XINGZQH  查询出所有的行政区划编码
            $this -> db -> where('number',$number);
        }else{
            $this -> db -> where('parent_number',$number);        //如果传过来的不等于XINGZQH 那就查询出它自己本身以及他的下级
            $this -> db -> or_where('number',$number);
        }
        $res = $this ->db -> get('bas_xzqh') -> result_array();       //$res等于查询出的结果为二维数组
        foreach ($res as $k => $v){             //循环上面查询的结果  使它成为一维数组
            foreach ($v as $k1 => $v1){
                $data1[] = $v1;                 //$data1为循环出来的行政区划编码一维数组
            }
        }
        $data = $this ->db -> where('cllb',$dmz) -> where_in('xzqh',$data1) -> get('bas_vehicle') -> result_array();      //已传递的车辆类型代码和行政区划编码的一维数组为条件查询出机动车的数量

        $res = count($data);            //计算结果
        return $res;   //返回结果
    }
    //乡镇数量
    public function select_count($number){               //根据传过来的行政区划编码  查询出每个行政区划下一共有多少个下级及其自己本身
        $data = $this -> db -> where('parent_number',$number) -> get('bas_xzqh') -> result_array();
        if($number == XINGZQH){
            $res = count($data) + 1;
        }else{
            $res = count($data);
        }
        return $res;       //返回计算的结果
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
        $res = $this -> db -> get('bas_vehicle') -> result_array();

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