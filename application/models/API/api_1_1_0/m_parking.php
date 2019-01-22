<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_parking extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //api接口
    public function interfacs(){
        $res = $this -> db -> where('type',2) -> where('parking_fj',0) -> get('task') -> result_array();
        return $res;
    }
    public function interfacs_zj($id){
        $data = $this -> db -> where('parking_fj',$id) -> get('task') -> result_array();
        return $data;
    }
}