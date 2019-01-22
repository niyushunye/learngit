<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_user_login extends CI_Controller
{
     
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');   

        $this->load->model('API/api_1_1_0/m_user_login');
    }


    /**
         * @api {post} /a_user_login/verify_login/ 警员登录
         * @apiVersion 0.1.0
         * @apiName verify_login
         * @apiGroup a_user_login
         * @apiParam {int} accounts    警员编号
         * @apiParam {string} password    警员密码
         * @apiDescription 警员登录
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
    public function verify_login()
    {  
        $accounts = $this->input->get_post('accounts');
        $password = $this->input->get_post('password');

        if(empty($accounts) || empty($password)){
            resjson(100,'参数不完整');
        }

        $pas = md5($accounts.$password);

        //get data
        $res = $this->m_user_login->verify_login_model($accounts,$pas);

        if($res){
            resjson(103,'登录成功',$res);
        }else{
            resjson(102,'登录失败');
        }
    }
}