<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_publicize_work extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function isset_score_company($score_company,$score_month){
        $re = $this->db->select('score_company')
                   ->get_where('publicize_work',array('score_company'=>$score_company,'score_month'=>$score_month))
                   ->row_array();
        return $re;
    }

    public function insert_score_company($date){
        $this->db->insert('publicize_work',$date);
    }


    public function select_edit_publicize($id){
       return $this->db->get_where('points',array('id'=>$id))->row_array();
    }

    //编辑
    public function update_model($id,$data)
    {
        if(!empty($data))
        {
            $this->db->where('id',$id);
            $res = $this->db->update('publicize_work',$data);
            return $res;
        }
    }

    //删除
    public function delete_publicize($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('points');
        return $res;
    }
//  |---------------------------------------修改-----------------------------------------------|

    //添加扣分记录
    public function add_points($data){
        $res = $this -> db -> insert('points',$data);
        return $res;
    }

    //扣分方法
    //$unit_num 扣分单位   $score  扣分分值   $project  扣分项目
    public function points_upload($unit_num,$score,$project){
        $res = $this -> db -> select("$project") -> where('score_company',$unit_num) -> get('publicize_work') -> result_array();
        $data[$project] = $res[0][$project] - $score;
        $info = $this -> db -> where('score_company',$unit_num) -> update("publicize_work",$data);
        return $info;
     }

     //验证分值是否符合要求
    public function validation_score($unit_num,$project){
        $res = $this -> db -> select("$project") -> where('score_company',$unit_num) -> get('publicize_work') -> row_array();
        return $res;
    }

//查询总条数
    public function select_numbers_model($ins)
    {
        $this->db->from('points');
        if($ins){
            $this -> db -> where('ins',$ins);
        }
        $this -> db -> where('classification',1);
        $res = $this->db->get();
        return count($res->result_array());
    }
    //查询所有信息
    public function select_all_info($pagenum='',$offect='',$ins)
    {
        $this->db->select('*');

        if($ins){
            $this -> db -> where('ins',$ins);
        }
        if($pagenum){
            $this->db->limit($pagenum,$offect);
        }
        $this -> db -> where('classification',1);
        $this->db-> order_by('id','desc') ->from('points');
        $res = $this->db->get();
        return $res->result_array();
    }

    //修改月份
    public function edit_ins($data){
        $data = $this -> db -> update('publicize_work',$data);
        return $data;
    }

    //获取publicize_work表里的月份

    public function select_ins(){
        $data = $this -> db -> select('score_month') -> get('publicize_work') -> result_array();
        $data1 = array();
        foreach ($data as  $k => $v){
            foreach ($v as $k2 => $v2){
                $data1[] = $v2;
            }
        }
        return $data1;
    }

    //如果表里的月份和当前月份不相等 就更新表里的数据
    public function add_data($score){

        $data = array(610902015000,610902015100,610902015500,610902015700,610902010200,610902015400,610902015300,610902015600);
        foreach ($data as $k => $v){
            $score['score_company'] = $v;
            $res = $this -> db -> insert('publicize_work',$score);
        }
        return $res;
    }

    //加分方法
    public function points_upload1($unit_num,$score,$project){
        $res = $this -> db -> select("$project") -> where('score_company',$unit_num) -> get('publicize_work') -> result_array();
        $data[$project] = $res[0][$project] + $score;
        $info = $this -> db -> where('score_company',$unit_num) -> update("publicize_work",$data);
        return $info;
    }

}