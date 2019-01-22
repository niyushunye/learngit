<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_task_assignment extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询当前大队下的所有中队
    public function select_orgnum_model($spid)
    {
        $this->db->select('orgnum,orgname');
        $this->db->where('superiornum',$spid);
        $this->db->where('shortname',"");
        //$this->db->where_not_in('orgnum',$data);
        $this->db->from('orginfo');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询当前系统的号码种类
    public function select_frm_class()
    {
        $this->db->select('DMZ,DMSM1') -> where('XTLB','00') -> where('DMLB','1007');
        $this->db->from('frm_code');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有任务
    public function search_all_task()
    {
        $this->db->select('id,task_name'); 
        $this->db->from("task");
        $this -> db -> where('type','1');
        $res = $this->db->get();
        return $res->result_array();
    }
    //新增
    public function task_save_model($data) 
    {
        if(!empty($data))
        {
          $res = $this->db->insert('veh_task',$data);
          return $res;
        }
    }
    //查询当前已被分配任务的部门代码
    public function select_assign_orgnum($taskid)
    {
        $this->db->select('task_assign_orgnum');
        $this->db->where('taskid',$taskid);
        $this->db->from('task_assign');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有任务分配
    public function select_all_task($pagenum,$offect)
    {
        $this->db->select('veh_task.id,hphm,hpzl,ywlx,bmdm,bmmc,cltp,task_name');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->limit($pagenum,$offect);
        $this->db->order_by('dateline','DESC');
        $this->db->from('veh_task');
        $res= $this->db->get();
        return $res->result_array();
    }
    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(id) total');
        $this->db->from('veh_task');
        $res= $this->db->get();
        return $res->result_array();
    }
    //查询单条记录的详细信息
    public function select_single_task($id)
    {
        $this->db->select('veh_task.id,hphm,hpzl,ywlx,bmdm,bmmc,cltp,DMSM1,task_name');
        $this->db->join('frm_code','hpzl = frm_code.DMZ');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->where('veh_task.id',$id);
        $this->db->from('veh_task');
        $res= $this->db->get();
        return $res->result_array();
    }
    //修改
    public function task_update_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('veh_task',$data);
            return $res;
        }
    }
    //删除
    public function delete_model($tid) 
    {
        $this->db->where('id',$tid);
        $res =  $this->db->delete('veh_task');
        return $res;
    }

    //条件检索
    public function select_search_conditions($hphm,$hpzl,$ywlx,$bmdm){


        if($hphm){
            $this->db->like('hphm', $hphm, 'both');
        }

        if($hpzl){
            $this->db->where("hpzl=$hpzl");
        }

        if($ywlx){
            $this->db->where("ywlx=$ywlx");
        }

        if($bmdm){
            $this->db->where("bmdm=$bmdm");
        }

        $this->db->select('veh_task.id,hphm,hpzl,ywlx,bmdm,bmmc,cltp,task_name');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->order_by('dateline','DESC');
        $this->db->from('veh_task');
        $res= $this->db->get();
        return $res->result_array();

        return $res;
    }

    //批量导入添加
    public function select_result_array($data){
        $res = $this -> db -> insert('veh_task',$data);
        return $res;
    }



}
