<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_announcement extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //api查询数据 公告通知
    public function select_result(){
        $data = time() - 2505600;
        $res = $this -> db -> where('createTime >',$data) -> order_by('id','DESC') -> get('notice') -> result_array();
        foreach ($res as $k => $v){
            $res[$k]['url'] = 'api/api_1_1_0/a_announcement/row_view/'.$v['id'];
        }
        return $res;
    }

    //公告通知详情页
    public function view_row($id){
        $res = $this-> db -> where('id',$id) -> get('notice') ->row_array();
        return $res;
    }

    //考核任务通知
    public function issued_select(){
        $data = time() - 2505600;
        $res = $this-> db -> select('title,receive_account,work_type,create_time,id') -> where('create_Time >',$data) -> order_by('id','DESC') -> get('special_task') -> result_array();
        foreach ($res as $k => $v){
            $res[$k]['url'] = 'api/api_1_1_0/a_announcement/issued_view/'.$v['id'];
        }
        return $res;
    }

    //考核任务详情
    public function issued_row($id){
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

    //查看考核任务日志api
    public function work_log_select($accounts){

        $data1 = time() - 2505600;
        $data = $this -> db -> where('accounts',$accounts) -> where('create_time >',$data1) -> get('work_log') -> result_array();
        foreach ($data as $k =>$v){
            $data[$k]['url'] = 'api/api_1_1_0/a_announcement/work_log_view/'.$v['id'];
        }
        return $data;
    }

    //详情页面
    public function work_log_row($id){
        $data = $this -> db -> where('id',$id) -> get('work_log') -> row_array();
        $img = $data['work_pic'];
        $data['img'] = array_filter(explode('+',$img));
        return $data;
    }

    //考核任务日志提交api
    public function add_work_log($data){
        $res = $this -> db -> insert('work_log',$data);
        return $res;
    }

}