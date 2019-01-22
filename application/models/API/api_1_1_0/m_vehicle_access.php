<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_vehicle_access extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //获取车辆类型
    public function get_vehicle_type_model()
    {
        $this->db->select('DMZ,DMSM1');
        $this->db->from('frm_code');
        $res = $this->db->get();
        return $res->result_array();
    }


    //根据车牌号查询入库信息
    public function select_inbound_info($hphm)
    {
        $this->db->select('xh,hphm,hpzl,tccmc,tccdz,bmdm,bmmc');
        $this->db->where('hphm',$hphm);
        $this->db->from('parking_record_in');
        $res = $this->db->get();
        return $res->result_array();
    }

    //出库查询信息
    public function car_outbound_check($hphm,$hpzl,$sfzmhm,$start_time,$end_time,$num)
    {
        if($hphm){
            $this->db->where(array('hphm'=>$hphm));
        }

        if($hpzl){
            $this->db->where(array('hpzl'=>$hpzl));
        }

        if($sfzmhm){
            $this->db->where(array('sfzmhm'=>$sfzmhm));
        }

        if($start_time){
            $this->db->where("dateline >= $start_time");
        }

        if($end_time){
            $this->db->where("dateline <= $end_time");
        }

        if($start_time && $end_time){
            $this->db->where("'$start_time <= dateline <= $end_time'");
        }

        $re = $this->db->select('xh,hphm,hpzl,dateline')
                       ->where('is_out=0')
                       ->from('parking_record_in')
                       ->limit(10,($num-1)*10)
                       ->order_by("dateline","DESC")
                       ->get()
                       ->result_array();

        return $re;
    }


    //插入入库信息
    public function car_inbound_model($data)
    {
        if(!empty($data))
        {
            $res =  $this->db->insert('parking_record_in',$data);
            return $res;
        }
    }



    //插入出库信息
    public function car_outbound_model($data)
    {
        if(!empty($data))
        {
            $res = $this->db->insert('parking_record_out',$data);
            return $res;
        }

    }

    //初查询入库信息出口后，改变入库信息状态
    public function update_is_out($xh){
        $this->db->update('parking_record_in',array('is_out'=>1),array('xh'=>$xh));
    }
}
