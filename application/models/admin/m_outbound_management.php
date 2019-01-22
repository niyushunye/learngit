<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_outbound_management extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询总条数
    public function select_numbers_model()
    {
        $this->db->select('count(xh) as total');
        $this->db->from('parking_record_out');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询所有出库信息
    public function select_all_outbound($pagenum = '',$offset = '')
    {
        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,ckyy,tccmc,tccdz,bmdm,bmmc,czr,jybh,sfqzck,dateline');

        $this->db->order_by('parking_record_out.dateline','DESC');

        if($pagenum){
            $this->db->limit($pagenum,$offset); 
        }

        $this->db->from('parking_record_out');
        $res = $this->db->get();
        return $res->result_array();
    }
    //查询单条记录的详细信息
    public function select_single_outbound($xh)
    {
        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,ckyy,tccmc,tccdz,pic,bmdm,bmmc,czr,jybh,sfqzck,dateline');
        $this->db->where('xh',$xh);
        $this->db->from('parking_record_out');
        $res = $this->db->get();
        return $res->result_array();
    }
    
    //查询入库序号
    public function select_inbound_hphm()
    {
        $this->db->select('hphm,xh');
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }
    //新增
    public function outbound_save($data)
    {
        if(!empty($data))
        {
           $res = $this->db->insert('parking_record_out',$data);
           return $res;
        }
    }
    //编辑
    public function update_model($xh,$data)
    {
        if(!empty($data))
        {
            $this->db->where('xh',$xh);
            $res = $this->db->update('parking_record_out',$data);
            return $res;
        }
    }
    //删除
    public function delete_outbound($xh)
    {
        $this->db->where('xh',$xh);
        $res = $this->db->delete('parking_record_out');
        return $res;
    }

    //查询
    public function search_model($data)
    {  

        if($data['hphm'] != "")
        {
            $this->db->like('hphm',$data['hphm'],'both');
        }
        if($data['hpzl'] != '0')
        {
             $this->db->where('hpzl',$data['hpzl']);
        }
        if($data['sfzmhm'] != "")
        {
             $this->db->like('sfzmhm',$data['sfzmhm'],'both');
        }

        if($data['start_time']){
            $this->db->where("dateline >= ",$data['start_time']);
        }

        if($data['end_time']){
            $this->db->where("dateline <= ",$data['end_time']);
        }

        if($data['start_time'] && $data['end_time']){
            $this->db->where($data['start_time'] .'<= czsj <= '.$data['end_time']);
        }


        //$this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,czjg,tccmc,tccdz,pic,bmdm,bmmc,czr,jybh,sfyj,dateline');
        $this->db->select('xh,hphm,hpzl,sfzmhm,dateline');
        $this->db->where('is_out = 0');
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function search_hphm_model($xh)
    {
        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,tccdz,tccmc,bmdm,bmmc');
        $this->db->where('xh',$xh);
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->row_array();
    }
    //检查车辆是否已经出过库
    public function search_outbound_hphm($xh)
    {
        $this->db->select('xh');
        $this->db->where('xh',$xh);
        $this->db->from('parking_record_out');
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

        $this->db->select('xh,hphm,hpzl,dsr,sfzmhm,czsj,ckyy,tccmc,tccdz,bmdm,bmmc,czr,jybh,sfqzck,dateline');
        $this->db->order_by('parking_record_out.dateline','DESC');
        $this->db->from('parking_record_out');
        $res = $this->db->get();
        return $res->result_array();
    }




}