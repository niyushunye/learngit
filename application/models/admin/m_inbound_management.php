<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_inbound_management extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(xh) as total,hpzl');
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有信息
    public function select_all_inbound($pagenum = '',$offect = '')
    {
        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,tccdz,pic,czjg,tccmc,bmdm,bmmc,czr,jybh,sfyj,dateline');
        if($pagenum){
            $this->db->limit($pagenum,$offect);
        }
        $this->db->order_by('dateline','DESC');
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }
    //根据ID查询单条信息
    public function select_single_inbound($xh)
    {
        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,tccdz,pic,czjg,tccmc,bmdm,bmmc,czr,jybh,sfyj,dateline');
        $this->db->where('xh',$xh);
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }
    //添加
    public function save_model($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('parking_record_in',$data);
           return $res;
        }
    }
    //修改
    public function update_model($data,$xh)
    {
        if(!empty($data))
        {
            $this->db->where('xh',$xh);
            $res = $this->db->update('parking_record_in',$data);
            return $res;
        }
    }
    //删除
    public function delete_inbound($xh)
    {
        $this->db->where('xh',$xh);
        $res = $this->db->delete('parking_record_in');
        return $res;
    }


    //通过条件查询总数据
    public function select_search_data($startTime,$endTime,$hphm,$czr,$hpzl,$sfzmhm,$bmdm){

        if($startTime){
            $this->db->where("dateline >= $startTime");
        }

        if($endTime){
            $this->db->where("dateline <= $endTime");
        }

        if($startTime && $endTime){
            $this->db->where("'$startTime <= dateline <= $endTime'");
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

        if($sfzmhm){
            $this->db->like('sfzmhm', $sfzmhm, 'both');;
        }

        if($bmdm){
            $this->db->where("bmdm=$bmdm");
        }

        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,tccdz,pic,czjg,tccmc,bmdm,bmmc,czr,jybh,sfyj,dateline');
        $this->db->order_by('dateline','DESC');
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }









    //查询出所有的车辆入库时间
    public function select_rksj_model()
    {
        $this->db->select('xh,czsj');
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
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


}