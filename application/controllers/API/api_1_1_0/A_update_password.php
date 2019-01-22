<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_update_password extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_update_password');
    }

     /**
         * @api {post} /a_update_password/get_password/ 1获取警员密码
         * @apiVersion 0.1.0
         * @apiName get_password
         * @apiGroup a_update_password
         * @apiParam {int} accounts     警员编号
         * @apiParam {string} password  警员密码
         * @apiDescription 修改警员密码
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
    public function get_password()
    {   

        $accounts = $this->input->get_post('accounts');
        $password = $this->input->get_post('password');

        if(empty($accounts) || empty($password)){
            resjson('100','参数不完整');
        }

        $pas = md5($accounts.$password);

        //验证数据合法性
        //先根据警员编号和密码验证之前的密码 是否正确
        $res = $this->m_update_password->select_accounts_model($accounts,$pas);

        if($res){
            resjson(103,'原密码正确');
        }else{
            resjson(102,'原密码错误');
        }

    }

    /**
         * @api {post} /a_update_password/modify_password/ 2修改警员密码
         * @apiVersion 0.1.0
         * @apiName modify_password
         * @apiGroup a_update_password
         * @apiParam {int} accounts         警员编号
         * @apiParam {string} repassword    修改密码
         * @apiDescription 修改警员密码
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
        
        public function modify_password(){

            $accounts = $this->input->get_post('accounts');
            $password = $this->input->get_post('repassword');

            if(empty($accounts) || empty($password)){
                resjson('100','参数不完整');
            }

            //验证警员编号是否存在
            $data = array(
                    'select' => 'accounts',
                    'table'  => 'memberinfo',
                    'where'  => 'accounts='.$accounts,
                );

            $res = $this->CM_model->getOne($data);

            if($res){

                $pas = md5($accounts.$password);

                $data = array(
                        'password' => $pas,
                    );

                $this->m_update_password->modify_password_model($accounts,$data);

                resjson('103','密码修改成功');

            }else{
                resjson('101','警员不存在');
            }

        }


}