<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//行政区划安全责任干部网格化信息

class C_xzqhzrxz extends CI_Controller
{
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/M_xingzheng');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }
    //展示页面
    public function index(){
        $data['data'] = $this -> M_xingzheng -> select_area();  //调用m层方法
        $this -> load -> view('public/header');
        $this -> load -> view('xingzhengqh/V_xzqhzrxz',$data);  //在页面上展示
    }
}