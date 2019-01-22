<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| 交警执法平台后台管理系统 登录界面
|--------------------------------------------------------------------------
|
| 这个文件是负责判断登录的.
| 作者:andyzu
| 邮箱:andyzu@qingter.com
| 时间:2016-05-25
|
*/


class c_login extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index($prompt = "")
    {
        //因为需要在页面上显示 echo base_url(); 所以需要加上这个
        // echo $prompt;
        $data['prompt'] = "";
        if($prompt == ""){
            $data['prompt'] = "";
        }else{
            $data['prompt'] = $prompt;
        }
        
        $this->load->view('v_login.php', $data);
    }




    //这个方法在当用户输入错误信息时候的 alert\跳转 等没有完善,后续继续完善!!!!
    //这个方法主要是为了检测用户名密码是否正确,如果正确把相关需要的数据 session 化, 以备后续使用
    //此登陆还未判断权限,稍后完善!!!!
    public function login()
    {
        //因为需要 redirect() 跳转函数
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);
        //这里做了个TRUE的过滤参数选项,如果没有这个用户输入的数据有可能包含HTML\JS 等代码
        $accounts = $this->input->post('accounts', TRUE);
        $password = ($this->input->post('password', TRUE));
        //密码是 md5(帐号+密码)
        $password = md5($accounts.$password);

        $sql_get_memberinfo = $db_mysql->query("SELECT *
                                                FROM memberinfo
                                                WHERE accounts = '{$accounts}'
                                                AND status = 1");
        $results = $sql_get_memberinfo->result_array();

        if(!empty($results))
        {

            if($results[0]['status'] == 1)
            {

                if(!strcasecmp($password , $results[0]['password']))//strcasecmp 比较时候不区分大小写。
                {
                    $sql_get_member = $db_mysql->query("SELECT *
                                                FROM member_roleinfo
                                                WHERE accounts = '{$results[0]['accounts']}'
                                               ");
                    $results1 = $sql_get_member->result_array();

                    if(empty($results1)){
                        $prompt = "该警员编号下无权限，请联系管理员添加权限!";
                        $this->index($prompt);
                    }else{
                        //获取 该登陆警员 的 所在部门名称
                        $orginfo = $db_mysql->query("SELECT orgname FROM orginfo WHERE orgnum = '{$results[0]['orgnum']}'");
                        $orginfo = $orginfo->result_array();

                        $_SESSION['orgname'] = $orginfo[0]['orgname'];
                        $_SESSION['accounts'] = $results[0]['accounts'];
                        $_SESSION['realname'] = $results[0]['realname'];
                        $_SESSION['orgnum'] = $results[0]['orgnum'];
                        $_SESSION['roleid'] = $results1[0]['roleid'];
                        //进入主界面
                        redirect('admin/c_frame_admin');
                    }
                }else {
                    sleep(1);
                    $prompt = "密码错误!";
                    $this->index($prompt);
                }
            }else{
                sleep(1);
                $prompt = "账号状态异常!";
                $this->index($prompt);
            }
        }else{
            sleep(1);
            $prompt = "无此账号!";
            $this->index($prompt);
        }
    }

    public function logout()
    {
        session_destroy();
        // $this->load->view('v_login_session');
        redirect('C_login');
    }

    public function overdue()
    {
        $this->load->view('v_login_session');
    }

}

/* End of file c_main.php */
/* Location: ./application/controllers/c_main.php */