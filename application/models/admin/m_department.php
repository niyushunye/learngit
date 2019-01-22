<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//路面防控管理部门排名

class m_department extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_org($startime,$endtime){
        $data = $this -> db -> select('orgname,orgnum') -> get('orginfo') -> result_array();
            foreach ($data as $k => $v){
                $data[$k]['combined'] =  $this -> combined($v['orgnum'],$startime,$endtime);   //纠违合计
                $data[$k]['enforcement'] = $this -> enforcement($v['orgnum'],$startime,$endtime); // 非现场执法-纠违总数
                $data[$k]['stop_number'] = $this -> stop_number($v['orgnum'],$startime,$endtime);    //非现场执法-违停数量
                $data[$k]['total_enforcement'] = $this -> total_enforcement($v['orgnum'],$startime,$endtime);  //现场执法-简易程序-总量
                $data[$k]['measures'] = $this -> measures($v['orgnum'],$startime,$endtime);         //强制措施—总量
                $data[$k]['score'] = $this -> score($v['orgnum'],$startime,$endtime);           //  得分
            }
        return $data;
    }

    //纠违合计
    public function combined($orgnum,$startime,$endtime){
        if($startime){
            $this->db->where("czsj >= $startime");
        }
        if($endtime ){
            $this->db->where("czsj <= $endtime");
        }
        if($startime  && $endtime ){
            $this->db->where("'$startime <= czsj <= $endtime'");
        }
        $data = $this -> db -> where('bmdm',$orgnum) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //非现场执法-纠违总数
    public function enforcement($orgnum,$startime,$endtime){
        if($startime){
            $this->db->where("czsj >= $startime");
        }
        if($endtime ){
            $this->db->where("czsj <= $endtime");
        }
        if($startime  && $endtime ){
            $this->db->where("'$startime <= czsj <= $endtime'");
        }
        $data = $this -> db -> where('bmdm',$orgnum) -> where('ywzl',1) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //非现场执法-违停数量
    public function stop_number($orgnum,$startime,$endtime){
        $where = array(1039,10399);
        if($startime){
            $this->db->where("czsj >= $startime");
        }
        if($endtime ){
            $this->db->where("czsj <= $endtime");
        }
        if($startime  && $endtime ){
            $this->db->where("'$startime <= czsj <= $endtime'");
        }
        $data = $this -> db -> where('bmdm',$orgnum) -> where('ywzl',1) -> where_in('rwlx',$where) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //现场执法-简易程序-总量
    public function total_enforcement($orgnum,$startime,$endtime){
        if($startime){
            $this->db->where("czsj >= $startime");
        }
        if($endtime ){
            $this->db->where("czsj <= $endtime");
        }
        if($startime  && $endtime ){
            $this->db->where("'$startime <= czsj <= $endtime'");
        }
        $data = $this -> db -> where('bmdm',$orgnum) -> where('ywzl',2) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //强制措施-总量
    public function measures($orgnum,$startime,$endtime){
        if($startime){
            $this->db->where("czsj >= $startime");
        }
        if($endtime ){
            $this->db->where("czsj <= $endtime");
        }
        if($startime  && $endtime ){
            $this->db->where("'$startime <= czsj <= $endtime'");
        }
        $data = $this -> db -> where('bmdm',$orgnum) -> where('ywzl',3) -> get('vio_task_write') -> result_array();
        return count($data);
    }

    //得分
    public function score($orgnum,$startime,$endtime){
        $data = $this -> db -> select('number,score') -> get('con_task') -> result_array();
        $data1 = '';
        foreach ($data as $k => $v){
            if($startime){
                $this->db->where("czsj >= $startime");
            }
            if($endtime ){
                $this->db->where("czsj <= $endtime");
            }
            if($startime  && $endtime ){
                $this->db->where("'$startime <= czsj <= $endtime'");
            }
            $res = $this -> db -> where('rwlx',$v['number']) -> where('bmdm',$orgnum) -> get('vio_task_write') -> result_array();

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




}
