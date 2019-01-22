<?php
class CM_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    //查询
    public function get_list($sql){

        if (!isset($sql)) {
            echo '条件不完整';exit();
        }
        if (isset($sql['select'])) {
            $this->db->select($sql['select']);
        };
        
        //表名
        $this->db->from($sql['table']);
        //联查
        if (isset($sql['join'])) {
            for ($i=0; $i < sizeof($sql['join']); $i++) { 
                $this->db->join($sql['join'][$i]['joinname'],$sql['join'][$i]['join_c'],$sql['join'][$i]['join_type']);
            }
            
        }
        //where
        if (isset($sql['where'])) {
             $this->db->where($sql['where']);
        }
        //like
        if (isset($sql['like'])) {
             $this->db->like($sql['like'],$sql['like_type']);
        }
        //克隆语句（除过limit条件）
        $db = clone($this->db);

        $result['total']=$this->db->count_all_results();
        
        //赋值回去
        $this->db = $db;

        //limit
        if (isset($sql['limit_start'])) {
             $this->db->limit($sql['limit_end'],$sql['limit_start']);
        }
        
        //order_by
        // if (isset($sql['order_by'])) {
             $this->db->order_by('id', 'desc');
        // }

        $query=$this->db->get();
        $result['data']=$query->result_array();
        // echo $this->db->last_query();
        // echo $this->db->last_query();exit();
        //print_r($this->db->last_query());
        return $result;
     }

    //取一条
    public function getOne($sql){
        if (!isset($sql)) {
            echo '条件不完整';exit();
        }
        if (isset($sql['select'])) {
            $this->db->select($sql['select']);
        };
        //表名
        $this->db->from($sql['table']);
        //联查
        if (isset($sql['join'])) {
            for ($i=0; $i < sizeof($sql['join']); $i++) { 
                $this->db->join($sql['join'][$i]['joinname'],$sql['join'][$i]['join_c'],$sql['join'][$i]['join_type']);
            }
        }
        //where
        if (isset($sql['where'])) {
             $this->db->where($sql['where']);
        }
        $this->db->limit(1,0);
        $query=$this->db->get();
        return $query->row_array();
    }
 
    public function add($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

     public function update($table,$data,$where){
        
        $this->db->update($table,$data,$where);
        return $this->db->affected_rows();
    }
 
    public function delete($table,$where){
        $this->db->delete($table,$where);
        return $this->db->affected_rows();
    }
    public function not_true_delete($table,$data,$where){
        $this->db->update($table,$data,$where);
        return $this->db->affected_rows();
    }


    //当前id是否存在
    public function id_is_existe($value,$col,$table){
        return $this->db->get_where($table,array($col=>$value))->num_rows();
    }


}