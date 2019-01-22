<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//路面防控管理民警个人排名

class m_management extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        set_time_limit(0);
    }

    //查询所有的民警姓名及编号
    public function select_police($czr,$bmmc,$startime,$endtime){
        if($czr){
            $this -> db -> where('accounts', $czr);
        }
        if($bmmc != 0){
            $this -> db -> where('orgnum',$bmmc);
        }

        $data = $this -> db -> select('realname,accounts') -> get('memberinfo') -> result_array();  //查出所有的民警姓名及编号
            foreach ($data as $k => $v){
                $data[$k]['combined'] = $this -> combined($v['accounts'],$startime,$endtime);          //纠违合计
                $data[$k]['enforcement'] = $this -> enforcement($v['accounts'],$startime,$endtime);          //非现场执法--纠违总数
                $data[$k]['stop_number'] = $this -> stop_number($v['accounts'],$startime,$endtime);          //非现场执法--违停数量
                $data[$k]['total_enforcement'] = $this -> total_enforcement($v['accounts'],$startime,$endtime);            //现场执法总量
                $data[$k]['measures'] = $this -> measures($v['accounts'],$startime,$endtime);          //强制措施
                $data[$k]['score'] = $this -> score_f($v['accounts'],$startime,$endtime);                //得分
            }
        return $data;
    }

    //纠违合计
    public function combined($accounts,$startTime,$endTime){
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }
        if($endTime ){
            $this->db->where("czsj <= $endTime");
        }
        if($startTime  && $endTime ){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }
        $data = $this -> db -> select('id') -> where('jybh',$accounts) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //非现场执法——纠违总数
    public function enforcement($accounts,$startTime,$endTime){
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }
        if($endTime ){
            $this->db->where("czsj <= $endTime");
        }
        if($startTime  && $endTime ){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }
        $data = $this -> db-> select('id') -> where('ywzl',1) -> where('jybh',$accounts) -> get('vio_task_write') -> result_array();
        return count($data);
    }
    //非现场执法——违停数量
    public function stop_number($accounts,$startTime,$endTime){
        $where = array(1039,10399);
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }
        if($endTime ){
            $this->db->where("czsj <= $endTime");
        }
        if($startTime  && $endTime ){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }
        $data = $this -> db -> select('id')-> where_in('rwlx',$where) -> where('ywzl',1) -> where('jybh',$accounts) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //现场执法--总量
    public function total_enforcement($accounts,$startTime,$endTime){
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }
        if($endTime ){
            $this->db->where("czsj <= $endTime");
        }
        if($startTime  && $endTime ){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }
        $data = $this -> db -> select('id')-> where('ywzl',2) -> where('jybh',$accounts) -> get('vio_task_write') -> result_array();
        return count($data);
    }


    //强制措施
    public function measures($accounts,$startTime,$endTime){
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }
        if($endTime ){
            $this->db->where("czsj <= $endTime");
        }
        if($startTime  && $endTime ){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }
        $data = $this -> db -> select('id')-> where('ywzl',3) -> where('jybh',$accounts) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //得分
    public function score_f($accounts,$startTime,$endTime){
        $data = $this -> db -> select('number,score') -> get('con_task') -> result_array();
        $data1 = '';
        foreach ($data as $k => $v){
            if($startTime){
                $this->db->where("czsj >= $startTime");
            }
            if($endTime ){
                $this->db->where("czsj <= $endTime");
            }
            if($startTime  && $endTime ){
                $this->db->where("'$startTime <= czsj <= $endTime'");
            }
            $res = $this -> db -> select('id')-> where('rwlx',$v['number']) -> where('jybh',$accounts) -> get('vio_task_write') -> result_array();

            $info = count($res);

            if($info != 0){
                $res1[$v['number']] = $info * $v['score'];

                $data1 = array_sum($res1);
            }
        }

        if($data1 == ''){
            return '0';
        }else{
            return $data1;
        }
    }
    //查询出部门的名称和部门代码值
    public function select_bmmc(){
        $data = $this -> db -> select('orgname,orgnum') -> get('orginfo') -> result_array();
        return $data;
    }


}
