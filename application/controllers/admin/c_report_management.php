<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class c_report_management extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }
    public function index()
    {
        $this->load->view('report_management/Index');
    }
}