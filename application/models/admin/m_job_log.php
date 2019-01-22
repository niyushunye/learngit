<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class m_job_log extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询总数
    public function select_numbers_model(){
        $res = $this -> db -> get('work_log') -> result_array();
        return count($res);
    }
    public function select_numbers_model1($jwry){
        $res = $this -> db -> where('accounts',$jwry) -> get('work_log') -> result_array();
        return count($res);
    }

    public function select_task_assessmentinfo($page,$offect){
        $data = $this -> db -> order_by('id','DESC') -> limit($page,$offect) -> get('work_log') -> result_array();
        return $data;
    }

    public function select_task_assessmentinfo1($page,$offect,$jwry){
        $data = $this -> db -> where('accounts',$jwry) -> order_by('id','DESC') -> limit($page,$offect) -> get('work_log') -> result_array();
        return $data;
    }


    //添加数据
    public function add_log($data){
        $res = $this -> db -> insert('work_log',$data);
        return $res;
    }


    //查询单条信息
    public function select_row($id){
        $data = $this -> db -> where('id',$id) -> get('work_log') -> row_array();
        $img = $data['work_pic'];
        $data['img'] = array_filter(explode('+',$img));
        return $data;
    }

    //更新修改
    public function edit_save($id,$data){
        $res = $this -> db -> where('id',$id) -> update('work_log',$data);
        return $res;
    }

    //删除数据
    public function jog_delete($id){
        $res = $this -> db -> where('id',$id) -> delete('work_log');
        return $res;
    }

}
