<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_control_assessment extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询总条数
    public function select_numbers_model()  
    {
        $this->db->select('vio_task_write.id,rwlx,hpzl');
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有信息
    public function select_control_assessmentinfo($pagenum,$offset)
    {
        //$this->db->select('vio_task_write.id,hphm,hpzl,rwlx,jdsbh,fxcbj,pzbh,czsj,czjg,sfyx,tp1,tp2,tp3,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name,DMSM1');
        $this->db->select('vio_task_write.id,hphm,hpzl,rwlx,ywzl,bh,czsj,czjg,sfyx,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name');
        $this->db->join('con_task','number = rwlx');
        $this->db->order_by('vio_task_write.dateline','DESC');
        $this->db->limit($pagenum,$offset); 
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }

    //查询所有信息
    public function select_control_assessmentinfos()
    {
        $a = 00;
        $b = 1007;
        //$this->db->select('vio_task_write.id,hphm,hpzl,rwlx,jdsbh,fxcbj,pzbh,czsj,czjg,sfyx,tp1,tp2,tp3,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name,DMSM1');
        $this->db->select('vio_task_write.id,hphm,rwlx,ywzl,bh,czsj,czjg,sfyx,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name,DMSM1');
        $this->db->join('con_task','number = rwlx');
        $this->db->join('frm_code','DMZ = hpzl,',"XTLB= $a","DMLB = $b");
        $this->db->order_by('vio_task_write.dateline','DESC');
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }

    //条件检索条数
    public function select_search_num($startTime,$endTime,$hphm,$czr,$hpzl,$bmmc){

        if($startTime){
            $this->db->where("czsj >= $startTime");
        }

        if($endTime){
            $this->db->where("czsj <= $endTime");
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= czsj <= $endTime'");
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

        if($bmmc){
            $this->db->where("bmdm=$bmmc");
        }


        $this->db->select('count(id) as total');
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
     
    //条件检索
    /*public function select_search_condition($startTime,$endTime,$hphm,$czr,$hpzl,$bmmc,$pagenum,$offset){
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }

        if($endTime){
            $this->db->where("czsj <= $endTime");
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= czsj <= $endTime'");
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

        if($bmmc){
            $this->db->where("bmdm=$bmmc");
        }

        $this->db->select('vio_task_write.id,hphm,rwlx,ywzl,bh,czsj,czjg,sfyx,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name,DMSM1');
        $this->db->join('con_task','number = rwlx');
        $this->db->join('frm_code','DMZ = hpzl');
        $this->db->order_by('vio_task_write.dateline','DESC');
        $this->db->limit($pagenum,$offset);
        $this->db->from('vio_task_write');
        $res = $this->db->get()->result_array();

        return $res;
    }*/

    //条件检索
    public function select_search_conditions($startTime,$endTime,$hphm,$czr,$hpzl,$bmmc){
        if($startTime){
            $this->db->where("czsj >= $startTime");
        }

        if($endTime){
            $this->db->where("czsj <= $endTime");
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= czsj <= $endTime'");
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

        if($bmmc){
            $this->db->where("bmdm=$bmmc");
        }

        $this->db->select('vio_task_write.id,hphm,rwlx,ywzl,hpzl,bh,czsj,czjg,sfyx,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name');
        $this->db->join('con_task','number = rwlx');
        $this->db->order_by('vio_task_write.dateline','DESC');
        $this->db->from('vio_task_write');
        $res = $this->db->get()->result_array();

        return $res;
    }




    //查询所有任务
    public function select_con_task()
    {
        $this->db->select('id,number,name');
        $this->db->from('con_task');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有号牌种类
    public function select_all_hpzl()
    {
        $this->db->select('DMZ,DMSM1') -> where('XTLB','00') -> where('DMLB','1007');
        $this->db->from('frm_code');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询单条记录
    public function select_control_assessmentsingle($id)
    {
        //$this->db->select('vio_task_write.id,hphm,rwlx,ywzl,bh,czsj,czjg,sfyx,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name,DMSM1');
        $this->db->select('vio_task_write.id,hphm,hpzl,rwlx,ywzl,bh,czsj,czjg,sfyx,pic,bmdm,bmmc,czr,jybh,vio_task_write.dateline,name,DMSM1');
        $this->db->join('con_task','number = rwlx');
        $this->db->join('frm_code','DMZ = hpzl');
        $this->db->where('vio_task_write.id',$id);
        $this->db->from('vio_task_write');
        $res = $this->db->get();
        return $res->result_array();
    }
    //添加
    public function save_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('vio_task_write',$data);
           return $res;
        }
    }
    //修改
    public function  update_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('vio_task_write',$data);
            return $res;
        }
    }
    //删除
    public function delete_model($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('vio_task_write');
        return $res;
    }
}
