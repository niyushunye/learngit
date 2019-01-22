<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_task_devide extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询出当前中队下的所有警员
    public function select_member_info($orgnum)
    {
        $this->db->select('accounts,realname');
        $this->db->where('orgnum',$orgnum);
        $this->db->from('memberinfo');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询当前系统的任务下发
    public function select_task_devide($orgnum)
    {
        $this->db->select('ywlx,task_name');
        $this->db->join('task','task.id = ywlx');
        $this->db->where('bmdm',$orgnum);
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    //提交保存
    public function devide_save_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('task_devide',$data);
           return $res;
        }
    }

    //添加成功后，任务审核表新增一条数据
    public function  add_veh_task_write($datas)
    {
        if(!empty($datas))
        {
           $res = $this->db->insert('veh_task_write',$datas);
           return $res;
        }
    }

    public function save_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('veh_task',$data);
            return $res;
        }
    }

    //查询所有分配
    public function select_devide_info($pagenum='' ,$offect='' )
    {   


        //$this->db->select('veh_task.id,hphm,hpzl,ywlx,bmmc,bmdm,czr,jybh,month,cltp,dateline,task_name,DMSM1');
        $this->db->select('veh_task.id,hphm,hpzl,ywlx,bmmc,bmdm,czr,jybh,month,dateline1,task_name');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->where('czr !=',null);

        if($pagenum){
            $this->db->limit($pagenum,$offect);
        }

        
        $this->db->order_by('dateline1','DESC');
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();

    }

    //查询单条信息
    public function select_single_devide($id)
    {
        //$this->db->select('veh_task.id,hphm,hpzl,ywlx,bmmc,bmdm,czr,jybh,month,cltp,dateline,task_name');
        $this->db->select('veh_task.id,hphm,hpzl,ywlx,bmmc,bmdm,czr,jybh,month,dateline1,task_name');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->where('veh_task.id',$id);
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询分配过当前任务的警员(当前月)
    public function select_devide_member($ywlx)
    {
        $this->db->select('jybh');
        $this->db->where('ywlx',$ywlx);
        $this->db->where('month',date('m'));
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(id) total');
        $this->db->where('czr !=',null);
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    //通过条件查询总数据
    public function select_search_data($startTime,$endTime,$hphm,$czr,$hpzl,$ywlx,$bmdm){

        if($startTime){
            $this->db->where("dateline1 >= $startTime");
        }

        if($endTime){
            $this->db->where("dateline1 <= $endTime");
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= dateline1 <= $endTime'");
        }

        if($hphm){
            $this->db->like('hphm', $hphm, 'both');
        }

        if($czr){
            $this->db->like('czr', $czr, 'both');
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

        $this->db->select('veh_task.id,hphm,hpzl,ywlx,bmmc,bmdm,czr,jybh,month,dateline1,task_name');
        $this->db->join('task','task.id = veh_task.ywlx');
        $this->db->where('czr !=',null);
        $this->db->order_by('dateline1','DESC');
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    /*//通过条件查询获取的数据
    public function select_search_conditions($startTime,$endTime,$hphm,$czr,$hpzl,$ywlx,$bmdm){
        if($startTime){
            $this->db->where("dateline1 >= $startTime");
        }

        if($endTime){
            $this->db->where("dateline1 <= $endTime");
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= dateline1 <= $endTime'");
        }

        if($hphm){
            $this->db->like('hphm', $hphm, 'both');
        }

        if($czr){
            $this->db->like('czr', $czr, 'both');
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

        




    }
*/








    //查询所有任务下发(未分配的)
    public function select_all_assign()
    {
        $this->db->select('id,hphm');
        $this->db->where('czr',null);
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询所有任务下发(已分配的)
    public function select_all_assign1()
    {
        $this->db->select('id,hphm');
        $this->db->where('czr !=',null);
        $this->db->from('veh_task');
        $res = $this->db->get();
        return $res->result_array();
    }

    //删除
    public function delete_model($did)
    {
        $this->db->where('id',$did);
        $data['czr'] = NULL;
        $data['jybh'] = NULL;
        $data['dateline1'] = NULL;
        $res = $this->db->update('veh_task',$data);
        return $res;
    }
    //修改
    public function update_model($data,$id)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('veh_task',$data);
            return $res;
        }
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

    //查询所有任务
    public function search_all_task()
    {
        $this->db->select('id,task_name'); 
        $this->db->from("task");
        $this -> db -> where('type','1');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询当前系统的号码种类
    public function select_frm_class()
    {
        $this->db->select('DMZ,DMSM1')-> where('XTLB','00') -> where('DMLB','1007');
        $this->db->from('frm_code');
        $res = $this->db->get();
        return $res->result_array();
    }

}