<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_wpjtctj extends CI_Controller{
    //危险道路统计
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_non_vehicle');
        $this -> load -> model('admin/M_xingzheng');
        $this->load->library('pagination');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    //无牌机动车统计结果页面
    public function index(){
        $data['tj'] = $this -> m_non_vehicle -> select_tj();     //查询统计结果

        //print_r($data['tj']);die();
        $this -> load -> view('public/header');
        $this -> load -> view('non_vehicle/V_index_tj',$data);
    }

}