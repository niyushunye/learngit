<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_rule extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_rule');

        //获取文件根目录路径
        define('ROOT_PATHS', $this->config->item('root_path'));
    }

    public function rule(){
        $data = $this -> m_rule -> select_rule();

        resjson(203,'请求成功',$data);

    }

}