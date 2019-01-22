<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_announcement extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //添加公告通知
    public function add_row($data){
        $res =  $this -> db -> insert('notice',$data);
        return $res;
    }

    //查询总条数
    public function select_numbers_model(){
        $res = $this -> db -> get('notice') -> result_array();
        return count($res);
    }

    //查询数据
    public function select_task_assessmentinfo($page,$offect){
        $res = $this -> db -> order_by('id','DESC') -> limit($page,$offect) -> get('notice') -> result_array();
        return $res;
    }

    //查看公告通知信息
    public function view_row($id){
        $res = $this-> db -> where('id',$id) -> get('notice') ->row_array();
        return $res;
    }

    //更次修改编辑
    public function edit_upldate($id,$data){
        $res = $this -> db -> where('id',$id) -> update('notice',$data);
        return $res;
    }

    //删除
    public function delete($id){
        $res = $this -> db -> where('id',$id) -> delete('notice');
        return $res;
    }

}