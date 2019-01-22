<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_task_assessment extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(id) total');
        $this->db->from('veh_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询所有考核信息
    public function select_task_assessmentinfo($ys,$offect)
    {
        $this->db->select('veh_task_write.id,hphm,hpzl,ywlx,sfch,sfzmhm,dsr,wfcyy,bmdm,czjg,sfyx,bmmc,czr,jybh,czsj,task_name,DMSM1');
        $this->db->join('task','task.id=ywlx');
        $this->db->join('frm_code','DMZ = hpzl');
        $this -> db -> limit($ys,$offect);
        $this->db->from('veh_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
    //添加
    public function save_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('veh_task_write',$data);
           return $res;
        }
    }
    //查询单条记录
    public function select_task_assessmentsingle($id)
    {
        $this->db->select('veh_task_write.id,hphm,hpzl,ywlx,sfch,sfzmhm,dsr,wfcyy,bmdm,czjg,sfyx,pic,bmmc,czr,jybh,czsj,task_name,DMSM1');
        $this->db->where('veh_task_write.id',$id);
        $this->db->join('frm_code','DMZ=hpzl');
        $this->db->join('task','task.id=ywlx');
        $this->db->from('veh_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
    //修改
    public function update_model($id,$data)
    {
        $this->db->where('id',$id);
        $res = $this->db->update('veh_task_write',$data);
        return $res;
    }
    //删除
    public function delete_model($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('veh_task_write');
        return $res;
    }

    public function select_task_devide(){
        return $this->db->select('id,task_name')->get('task')->result_array();
    }

    //查询当前系统下的所有部门
    public function select_orgnum_model(){
        return $this -> db -> select('orgname,orgnum') -> get('orginfo') -> result_array();
    }

    //查询带条件的 总数
    public function select_numbers_model_where($bmmc,$hphm,$hpzl,$sfzm,$czmj,$startTime,$endTime,$yelx){
        if($startTime){
            $this->db->where("czsj >= $startTime");  //时间
        }

        if($endTime){
            $this->db->where("czsj <= $endTime");    //时间
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }

        if($hphm){
            $this->db->like('hphm', $hphm, 'both');   //车牌号码
        }

        if($czmj){
            $this->db->like('czr', $czmj, 'both');   //处置民警
        }

        if($hpzl){
            $this->db->where("hpzl=$hpzl");        //号牌种类
        }

        if($sfzm){
            $this->db->like('sfzmhm', $sfzm, 'both');    //身份证号码
        }

        if($bmmc){
            $this->db->where("bmdm=$bmmc");            //部门代码
        }

        if($yelx){
            $this -> db -> where("ywlx=$yelx");
        }
        $this->db->select('veh_task_write.id,hphm,hpzl,ywlx,sfch,sfzmhm,dsr,wfcyy,bmdm,czjg,sfyx,bmmc,czr,jybh,czsj,task_name,DMSM1');
        $this->db->join('task','task.id=ywlx');
        $this->db->join('frm_code','DMZ = hpzl');
        $this->db->from('veh_task_write');
        $res = $this->db->get();
        return $res->num_rows();
    }

    //带条件查询
    public function select_task_assessmentinfo_where($bmmc,$hphm,$hpzl,$sfzm,$czmj,$startTime,$endTime,$yelx){
        if($startTime){
            $this->db->where("czsj >= $startTime");  //时间
        }

        if($endTime){
            $this->db->where("czsj <= $endTime");    //时间
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= czsj <= $endTime'");
        }

        if($hphm){
            $this->db->like('hphm', $hphm, 'both');   //车牌号码
        }

        if($czmj){
            $this->db->like('czr', $czmj, 'both');   //处置民警
        }

        if($hpzl){
            $this->db->where("hpzl=$hpzl");        //号牌种类
        }

        if($sfzm){
            $this->db->like('sfzmhm', $sfzm, 'both');    //身份证号码
        }

        if($bmmc){
            $this->db->where("bmdm=$bmmc");            //部门代码
        }

        if($yelx){
            $this -> db -> where("ywlx=$yelx");
        }
        $this->db->select('veh_task_write.id,hphm,hpzl,ywlx,sfch,sfzmhm,dsr,wfcyy,bmdm,czjg,sfyx,bmmc,czr,jybh,czsj,task_name,DMSM1');
        $this->db->join('task','task.id=ywlx');
        $this->db->join('frm_code','DMZ = hpzl');
        $this->db->from('veh_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }




}