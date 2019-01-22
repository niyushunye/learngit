<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_version extends CI_Controller
{
     
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');   

        $this->load->model('API/api_1_1_0/m_version');
    }


    /**
         * @api {post} /a_version/version/ 版本信息
         * @apiVersion 0.1.0
         * @apiName version
         * @apiGroup a_version
         * @apiDescription 版本信息
         * @apiSuccess {number}   code                  返回码
         * @apiSuccess {string}   message               返回信息
         * @apiSuccess {json}     result                正确的结果
         * @apiErrorExample Response (example):
         *     返回示例
         *     {
         *       "code": "100"
         *       "message": "未知错误"
         *       "result": "json"
         *     }
         */
    public function version()
    {  
        //获取版本信息
        $version_arr = $this->m_version->get_version();

        if($version_arr){
            $version_arr['version_app'] = base_url().$version_arr['version_app'];
            resjson(203,'获取版本信息成功',$version_arr);
        }else{
            resjson(202,'当前为最新版本');
        }
    }
}

