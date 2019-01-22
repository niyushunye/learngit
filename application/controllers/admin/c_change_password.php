<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_change_password extends CI_Controller{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/M_memberinfo');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
        
    }
    

    public function index()
    {
        $this->load->view('public/header');
        $this->load->view('change_password/Index');
    }



    public function edit_password(){
        $accounts = $_SESSION['accounts'];
        $password = $this->input->post('old_password', TRUE);
        $old_password = md5($accounts.$password);
        $password = $this->M_memberinfo->get_password($accounts);

        if(!strcasecmp($old_password , $password['password'])){
            echo 1;exit;
        }else{
            echo 2;exit;
        }
        // echo $password['password'];exit;

    }


    public function edit_success(){
        $accounts = $_SESSION['accounts'];
        $new_password = $this->input->post('new_password', TRUE);
        $password = md5($accounts.$new_password);
        $change_result = $this->M_memberinfo->change_password($accounts, $password);
        if($change_result){
            redirect('admin/C_frame_admin');
        }else{
            echo 2;
            exit;
        }
    }   


    public function change()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        $old_password = $this->input->post('old_password', TRUE);
        $new_password = $this->input->post('new_password', TRUE);
        $re_new_password = $this->input->post('re_new_password', TRUE);




        $sql = "SELECT password FROM memberinfo WHERE accounts = '$_SESSION[accounts]'";

        $result = $db_mysql->query($sql);
        $result = $result->row_array();

        //print_r($result);


        if(!strcasecmp($result['password'],md5( $_SESSION['accounts'].$old_password )) )
        {
            if( $new_password === $re_new_password )
            {
                $md5_password = md5( $_SESSION['accounts'].$new_password );

                $sql = "UPDATE memberinfo SET password = '$md5_password' WHERE accounts = '$_SESSION[accounts]'";
                $db_mysql->query($sql);
                echo '恭喜您, 密码修改完成, 请牢记您的密码! ';
            }

        }else
        {
            $data['error_msg'] = '您输入的原始密码不正确!请重新输入!';
            $this->load->view('admin/v_change_password',$data);

        }

    }


    //因为更换了密码验证方式,是需要验证 md5(帐号+密码),所以需要更新 memberinfo 里的 password;
    //已经更新完毕,此方法暂时没有作用了
    public function huxiaohua()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        $result = $db_mysql->query("SELECT memberid, accounts, password FROM memberinfo");
        $result = $result->result_array();


        foreach ($result as $key => $value)
        {
            $result[$key]['new_password'] = md5($value['accounts'].'123456');
            $data = array('password' => $result[$key]['new_password']);
            $where = "memberid = $value[memberid]";
            $db_mysql->update('memberinfo', $data, $where);
        }

        var_dump($result);

    }














}









/* End of file c_change_password.php */
/* Location: .${FILE_PATH} */