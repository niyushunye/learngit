<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_cadre extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询行政区划
    public function row_qh($number){
        $res = $this -> db -> where('number',$number) -> get('bas_xzqh') -> row_array();
        return $res;
    }
    //添加安全责任干部
    public function add($data){
        $res = $this -> db -> insert('bas_assist',$data);
        return $res;
    }

    //根据id查询当前的安全责任干部
    public function select_y($id){
        $res = $this -> db -> where('id',$id) -> get('bas_assist') -> row_array();

        return $res;
    }

    //更新修改数据
    public function upload_up($id,$data){
        $res = $this -> db -> where('id',$id) -> update('bas_assist',$data);
        return $res;
    }

    //删除
    public function delete($id){
        $res = $this -> db -> where('id',$id) -> delete('bas_assist');
        return $res;
    }

    //判断人员编号是否合法
    public function rybh($rybh){
        $res = $this -> db -> where('accounts',$rybh) ->get('memberinfo') -> row_array();
        return $res;
    }

    //判断人员编号 是否重复
    public function select_chongfu($rybh){
        $res = $this ->db -> where('rybh',$rybh) -> get('bas_assist') -> row_array();
        return $res;
    }

    //条件查询
    public function where_select_sousuo($position,$rybh){

        if($rybh != '' && $rybh != 0){
            $this -> db -> where('rybh',$rybh);
        }
        if($position != 0){
            $this -> db -> where('position',$position);
        }
        $res = $this -> db -> get('bas_assist') -> result_array();
        return $res;
    }
    //添加查询总数
    public function where_select_count($position,$rybh){
        $data = $this -> where_select_sousuo($position,$rybh);
        return count($data);
    }

}