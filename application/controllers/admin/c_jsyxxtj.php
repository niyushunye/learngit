<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_jsyxxtj extends CI_Controller{
    //危险道路统计
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_driver');
        $this -> load -> model('admin/M_xingzheng');
        $this->load->library('pagination');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    public function index(){

        $data['tj'] = $this -> m_driver -> xzqh_count();

        $this -> load -> view('public/header');
        $this -> load -> view('driver/V_index_tj',$data);
    }

}