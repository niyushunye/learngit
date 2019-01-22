<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class m_rule extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function select_rule(){
       return $this -> db -> get('rule') -> result_array();
    }
}