<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class m_issued extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询总数
    public function select_numbers_model(){
        $res = $this -> db -> get('special_task') -> result_array();
        return count($res);
    }

    //显示数据
    public function select_task_assessmentinfo($page,$offect){
        $res = $this -> db -> order_by('id','DESC') -> limit($page,$offect) -> get('special_task') -> result_array();
        foreach ($res as $k => $v){
            $res[$k]['orgname'] = $this -> select_orgname($v['task_orginfo']);
        }
        return $res;
    }

    //查询部门名称
    public function select_orgname($orginfo){
        $res = $this -> db -> select('orgname') ->  where('orgnum',$orginfo) -> get('orginfo') -> row_array();
        return $res;
    }

    //查询所有部门
    public function select_orginfo(){
        $data = $this -> db -> select('orgname,orgnum') -> get('orginfo') -> result_array();
        foreach ($data as $k => $v){
            $data[$k]['jwry'] = $this -> select_jy($v['orgnum']);
        }
        return $data;
    }

    //查询部门下的警员
    public function select_jy($org){
        $data = $this -> db ->  select('realname,accounts,orgnum') -> where('orgnum',$org) -> get('memberinfo') -> result_array();
        return $data;
    }

    //添加考核任务
    public function add_save($data){
        $res = $this -> db -> insert('special_task',$data);
        return $res;
    }

    //查看单条考核任务
    public function select_row($id){
        $res = $this -> db -> where('id',$id) -> get('special_task') -> row_array();

        $data = explode(',',$res['receive_account']);
        $res['jwry'] = $this -> select_jwry($data);
        $res['orgname'] = $this -> select_orgname1($res['task_orginfo']);
        return $res;
    }

    //查看警员
    public function select_jwry($data){
        $res = $this -> db -> select('realname') -> where_in('accounts',$data) -> get('memberinfo') -> result_array();
        return $res;
    }

    //查看部门名称
    public function select_orgname1($org){
        $res = $this -> db -> select('orgname') -> where('orgnum',$org) -> get('orginfo') -> row_array();
        return $res;
    }

    //编辑修改
    public function select_update($id,$data){
        $res = $this -> db -> where('id',$id) -> update('special_task',$data);
        return $res;
    }

    //删除
    public function select_delete($id){
        $res = $this -> db -> where('id',$id) -> delete('special_task');
        return $res;
    }

    // 查出选中警员的部门
    public function select_orgnum($jwry){
        $res = $this -> db -> select('orgnum') -> where_in('accounts',$jwry) -> get('memberinfo') -> result_array();
        foreach ($res as $k => $v){
            $data[] = $v['orgnum'];
        }
        $data1 = array_unique($data);
        return $data1;
    }

}
