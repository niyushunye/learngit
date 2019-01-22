<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_parking extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_parking');

        //获取文件根目录路径
        define('ROOT_PATHS', $this->config->item('root_path'));
    }

    public function interfacs(){
        header("charset=utf-8");
        $data = $this -> m_parking -> interfacs();
        $a = array();
        foreach ($data as $v){
            $v['zl'] = $a;
            $data1 = $this -> m_parking -> interfacs_zj($v['id']);

            foreach ($data1 as $key =>  $value){
                array_push($v['zl'],$value);
            }
            $data2[] = $v;
        }
         resjson(203,'请求成功',$data2);
    }
}
