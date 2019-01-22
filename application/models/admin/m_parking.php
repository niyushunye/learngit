<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_parking extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
         $this->load->database();
    }

    //添加
    public function parking_add($data){
        $res = $this -> db -> insert('task',$data);
        return $res;
    }

    //查询总条数
    public function select_parking_num(){
        $res = $this -> db -> where('type',2) -> where('parking_dizhi !=','') -> where('parking_fj !=',0) -> get('task') -> num_rows();
        return $res;
    }

    //查询显示结果
    public function select_parking($num,$offect){

        $res = $this -> db -> where('type',2) -> where('parking_dizhi !=','') -> where('parking_fj !=',0) -> limit($num,$offect) -> get('task') -> result_array();

        foreach ($res as $k => $v){
            $res[$k]['mc'] = $this -> mingcheng($v['parking_fj']);
        }

        return $res;
    }



    public function mingcheng($id){
        return  $this -> db -> select('task_name') -> where('id',$id) -> get('task') -> row_array();
    }





    //删除
    public function parking_delete($id){
        return $res = $this -> db -> where('id',$id) -> delete('task');
    }


    //编辑查询
    public function parking_edit($id){
        return $this -> db -> where('id',$id) -> get('task') -> row_array();
    }


    //编辑更新
    public function parking_add_update($id,$data){
        $res = $this -> db -> where('id',$id) -> update('task',$data);
        return $res;
    }

    //查询结果
    public function parking_select(){
        $res = $this -> db -> get('parking') -> result_array();
        return $res;
    }

    //查询停车名称
    public function select_mc(){
        $res = $this -> db -> where('type',2) -> where('parking_fj',0) -> get('task') -> result_array();
        return $res;
    }


    //添加停车场名称
    public function parking_add_mc($data){
        $res = $this -> db -> insert('task',$data);
        return $res;
    }

    //查询停车场地址
    public function parking_select_dizhi($id){
        $data = $this -> db -> where('parking_fj',$id) -> get('task') -> result_array();
        return $data;
    }


    //查询部门名称代码
    public function select_orginfo(){
        $res = $this -> db -> select('orgname,orgnum') -> get('orginfo') -> result_array();
        return $res;
    }

    //查询停车场名称
    public function parking_mc_select($id){
        return $this -> db -> where('id',$id) -> get('task') -> row_array();
    }

    //更新停车场名称
    public function parking_mc_upload($id,$data){
        $res = $this -> db -> where('id',$id) -> update('task',$data);
        return $res;
    }

    //防止名称相同
    public function select_mc_xt($data){
        $res = $this -> db -> where('task_name',$data) -> get('task') -> row_array();
        return $res;
    }

    //防止地址相同
    public function select_dz_cf($data){
        $res = $this -> db -> where('parking_dizhi',$data) -> get('task') -> row_array();
        return $res;
    }


}






































