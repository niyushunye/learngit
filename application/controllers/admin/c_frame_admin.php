<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_frame_admin extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //因为需要在页面上显示 echo base_url(); 所以需要加上这个
        $this->load->helper('url');
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
        $this->load->model('admin/m_member_roleinfo');
        $this->load->model('admin/m_module_roleinfo');

    }


    public function index()
    {
        $db_mysql = $this->load->database('default',TRUE);

        //根据警员编号查权限ID
        $data['member_roleinfo'] = $this->m_member_roleinfo->get_roleid_by_accounts($_SESSION['accounts']);
        // print_r($data);exit;
        //$roleid = '1,2,3,4,5,6,7'
        @$roleid = $data['member_roleinfo']['roleid'];
        if($roleid == ""){
            // echo '请联系上级部门给你分配权限。';
            // sleep(1);
            redirect("C_login/logout");
            exit;
        }
        //根据权限ID查模块ID
        $roleids = explode(',',$roleid);
        // print_r($roleids);exit;
        foreach($roleids as $value)
        {
            $data['module_roleinfo'] = $this->m_module_roleinfo->get_module_roleinfo($value);
            if(!empty($data['module_roleinfo'])){
                foreach($data['module_roleinfo'] as $val)
                {
                    $data['moduleids'][] = $val['moduleid'];
                }
            }else{
                $data['moduleids'][] = "";
            }
            
        }
        // exit;
        // print_r($data['moduleids']);exit;
        //数组去重
        $data['moduleids'] = array_unique($data['moduleids']);
        // print_r($data['moduleids']);exit();

        $db_mysql->where_in('moduleid',$data['moduleids']);
        $sql_get_moduleinfo = $db_mysql->get('moduleinfo');
        $moduleinfo['module'] = $sql_get_moduleinfo->result_array();
        if (empty($moduleinfo['module'])) {
            // echo '请联系上级部门给你分配权限。';
            sleep(3);
            redirect("C_login/logout");
            exit;
        }
         //print_r($moduleinfo);exit;
        //print_r(count($moduleinfo['module']));die();
        $this->load->view('admin/v_frame_admin',$moduleinfo);
    }

    //警务通页面
    public function index1()
    {
		$this->load->view('admin/v_frame_admin.php');
    }



    //数据统计
    public function data_statistic(){
        // echo "数据统计";exit;
        $this->load->view('admin/V_data_statistic');
    }


    //系统管理
    public function system_management(){
        $this->load->view('admin/V_system_management');
    }



    public function logout()
    {
        session_destroy();
        $this->load->view('v_login.php');


    }

}

/* End of file c_main.php */
/* Location: ./application/controllers/c_main.php */