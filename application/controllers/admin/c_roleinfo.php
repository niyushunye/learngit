<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_roleinfo extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //加载分页类
        $this->load->library('pagination');
        $this->load->model('admin/M_roleinfo');
        $this->load->model('admin/M_oper_log');
        $this->load->model('admin/M_memberinfo');
        $this->load->model('admin/M_module_roleinfo');
        $this->load->model('admin/M_moduleinfo');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    public function index($curpage = CURPAGE,$num = BIG_NUM)
    {
        $data['total'] = $this->M_roleinfo->get_roleinfo_total();

        $data['roleinfo'] = $this->M_roleinfo->get_roleinfo($curpage, $num);

        /**
         * 分页配置
         * 1、每页显示几行数据
         * 2、分页路径
         * 3、获取数据总条数
         * 4、执行分页操作
         */
        $config['per_page'] = $num;                                                                            //每页数据条数
        $config['base_url'] = base_url().'/admin/c_roleinfo/index/';
        $config['total_rows'] = $data['total'];                                                             //数据总行数
        $this->pagination->initialize($config);                                                             //执行分页操作
        $this->load->view('public/header');
        $this->load->view('roleinfo/Index',$data);                                                    //显示页面

    }


        //跳转至添加页面
    public function  add(){
        //判断权限，如果有权限，则操作；否则，返回一个不能进行操作的视图。
        // $result = $this->role_judge();
        // if($result == 0){
            //添加模块的树
            $data['moduleinfo'] = $this->M_moduleinfo->modtitle_moduleid_parentid();
            // print_r($data['moduleinfo']);exit;
            foreach($data['moduleinfo'] as $value){
                $arr1 = array(
                    'id' => $value['moduleid'],
                    'pId' => $value['parentid'],
                    'name' => $value['modtitle'],
                );
                $data['result'][] = $arr1;
            }
            // print_r($data['result']);exit;
            $this->load->view('public/header');
            $this->load->view('roleinfo/V_roleinfo_add', $data);
        // }else{
        //     $this->load->view('public/header');
        //     $this->load->view('roleinfo/V_role_back');
        // }

    }




        //对添加的信息进行提交
    public function save(){
        $db_mysql = $this->load->database('default',TRUE);

        $data['moduleids'] = $this->input->post("moduleids", TRUE);

        $data['rolefield'] = $this->input->post('rolefield',TRUE);                                               //从页面获取数据rolefield
        $data['rolename'] = $this->input->post('rolename',TRUE);                                                 //从页面获取数据rolename
        $data['remark'] = $this->input->post('remark',TRUE);                                                     //从页面获取数据remark
        $data['dateline'] = time();                                                                              //获得时间戳
        // print_r($data);exit;

        $roleinfo = "('{$data['rolefield']}','{$data['rolename']}','{$data['remark']}','{$data['dateline']}')";

        $this->M_roleinfo->add_roleinfo($roleinfo);

        $oper['type'] = 1;
        $oper['module']= '权限管理';
        $oper['ziduan'] = '权限中文名称';
        $oper['field'] = $data['rolename'];
        oper_log_($oper);


        //新增、修改、删除模块时，都需要同步到module_roleinfo表中（关系表）roleid,moduleid,pc_onoff,mobile_onoff
        $data['roleinfo'] = $this->M_roleinfo->get_roleinfo_roleid_by_rolename($data['rolename']);
        // print_r($data['roleinfo']);exit;

        //roleid
        $member['roleid'] = $data['roleinfo']['roleid'];

        //moduleid
        $member['moduleid'] = substr($data['moduleids'], 1);
        $member['moduleid'] = explode(',',$member['moduleid']);
        // print_r($member['moduleid']);exit;
        
        //dateline
        $member['dateline'] = time();

        $db_mysql->where('roleid',$member['roleid']);
        $db_mysql->delete('module_roleinfo');
        foreach($member['moduleid'] as $value){
            $data['moduleinfo'] = $this->M_moduleinfo->get_module_by_moduleid($value);
            $classify = $data['moduleinfo']['classify'];
            if($classify == 1){
                $member['pc_onoff'] = 1;
                $member['mobile_onoff'] = 0;
            }elseif($classify == 2){
                $member['pc_onoff'] = 0;
                $member['mobile_onoff'] = 1;
            }
            $member['moduleid'] = $value;

            $db_mysql->insert('module_roleinfo',$member);
        }

        $this->index();
    }

    public function check_rolename(){
        $data['rolename'] = $this->input->post("rolename",TRUE);
        $data['roleid'] = $this->input->post("roleid",TRUE);
        $num = $this->M_roleinfo->get_roleinfo_num_by_rolename($data);
        echo $num;exit;
    }


    /**
     * 权限判断：
     * （主要针对于模块管理、权限管理
     * 模块管理：如果登录的用户是管理员或者大队管理员，则可以对模块中数据进行删除操作。
     * 权限管理：如果登录的用户是管理员或者大队管理员，则可以对权限中数据进行删除操作。）
     *
     *
     * 如果是权限ID为1、2时，则能进行权限的相关操作，否则，提示没有相关权限
     * 1、首先获取session中的值
     * 2、根据session中的值对权限ID进行判断
     * 3、如果符合，则进行操作；否则，提示没有权限
     *
     */
    // public function role_judge(){
    //     // $db_mysql = $this->load->database('default',TRUE);
    //    // $accouts = $_SESSION['accounts'];
    //     $result = $db_mysql->query("SELECT memberinfo.roleid FROM memberinfo WHERE accounts = $accouts");
    //     $result = $result->row_array();                                                                             //执行sql操作
    //     $result = intval($result);                                                                                  //把数组中的整型进行转化
    //     $result = $_SESSION['roleid'];

    //     if($result != 1 && $result != 2){

    //         $result = 1;
    //     }else{
    //         $result = 0;
    //     }
    //     return $result;
    // }



    public  function  delete(){
        //权限判断
        // $result = $this->role_judge();
        // if($result == 0){
            $roleid = $this->input->post('roleid',TRUE);
        // /**
        //  * 利用页面session获取的值到数据库进行密码验证，
        //  * 确认无误进行删除操作
        //  */
        // $accounts = $_SESSION['accounts'];
        // $result_password = $this->M_memberinfo->get_memberinfo_accounts($accounts);
        // //将sql执行完得到的数组进行转化为字符串
        // $result_password = implode($result_password);

        // $input_password = $this->input->post('password',TRUE);
        // $input_password1 = md5($accounts.$input_password);

        // if($result_password == $input_password1){
            //删除所对应的sql（如果密码用户名验证通过，则执行删除)
            $data['rolename'] = $this->M_roleinfo->get_roleinfo_roleid_rolename($roleid);

            $oper['type'] = 1;
            $oper['module']= '权限管理';
            $oper['ziduan'] = 'id';
            $oper['field'] =  $roleid;
            oper_log_($oper);

            $this->M_roleinfo->delete_roleinfo($roleid);
            $this->M_module_roleinfo->delete_module_roleinfo($roleid);
        // }
            // $this->index();
            return "删除成功";
        // }else{
        //     // $this->load->view('admin/v_role_back');
        //     return "无权限进行该操作";
        // }
    }



    //通过ID获取所对应行的信息
    public function  edit($roleid){
        //判断权限，如果有权限，则操作；否则，返回一个不能进行操作的视图。
        // $result = $this->role_judge();
        // if($result == 0){
            //添加模块的树
            $data['moduleinfo'] = $this->M_moduleinfo->modtitle_moduleid_parentid();
            $data['roleinfo'] = $this->M_roleinfo->get_roleinfo_by_roleid($roleid);

            $data['module_roleinfo'] = $this->M_module_roleinfo->get_moduleid_by_roleid($roleid);
            // print_r($data['roleinfo']);exit;
            $moduleids = array();
            foreach ($data['module_roleinfo'] as $key => $value) {
                $moduleids[] = $value['moduleid'];
            }
            // print_r($moduleids);exit;

            foreach($data['moduleinfo'] as $value){
                if(in_array($value['moduleid'], $moduleids)){
                    $arr1 = array(
                        'id' => $value['moduleid'],
                        'pId' => $value['parentid'],
                        'name' => $value['modtitle'],
                        'checked' => 'true'
                    );
                    $data['result'][] = $arr1;
                }else{
                    $arr1 = array(
                        'id' => $value['moduleid'],
                        'pId' => $value['parentid'],
                        'name' => $value['modtitle'],
                        'checked' => 'false'
                    );
                    $data['result'][] = $arr1;
                }                
            }
            // print_r($data);exit;
            $this->load->view('public/header');
            $this->load->view('roleinfo/V_roleinfo_edit', $data);
        // }else{
        //     $this->load->view('public/header');
        //     $this->load->view('roleinfo/V_role_back');
        // }

    }


        //对修改的信息进行确认
    public function  update(){
        $db_mysql = $this->load->database('default',TRUE);

        $data['moduleids'] = $this->input->post("moduleids", TRUE);

        $data['roleid'] = $this->input->post('roleid',TRUE);
        $data['rolefield'] = $this->input->post('rolefield',TRUE);                                               //从页面获取数据rolefield
        $data['rolename'] = $this->input->post('rolename',TRUE);                                                 //从页面获取数据rolename
        $data['remark'] = $this->input->post('remark',TRUE);                                                     //从页面获取数据remark
        $data['dateline'] = time();                                                                              //获得时间戳
        // print_r($data);exit;

        $roleinfo = array(
            'roleid' => $data['roleid'],
            'rolefield' => $data['rolefield'],
            'rolename' => $data['rolename'],
            'remark' => $data['remark'],
            'dateline' => $data['dateline']
        );

        $this->M_roleinfo->update_roleinfo($roleinfo);

        $oper['type'] = 2;
        $oper['module']= '权限管理';
        $oper['ziduan'] = '权限中文名称';
        $oper['field'] = $data['rolename'];
        oper_log_($oper);

        //新增、修改、删除模块时，都需要同步到module_roleinfo表中（关系表）roleid,moduleid,pc_onoff,mobile_onoff

        //roleid
        $member['roleid'] = $data['roleid'];
        //dateline
        $member['dateline'] = time();

        //先删除
        $db_mysql->where('roleid',$member['roleid']);
        $db_mysql->delete('module_roleinfo');
        //再添加

        //moduleid
        if($data['moduleids'] != ""){
            $member['moduleid'] = substr($data['moduleids'], 1);
            $member['moduleid'] = explode(',',$member['moduleid']);
            //添加
            foreach($member['moduleid'] as $value){
                $data['moduleinfo'] = $this->M_moduleinfo->get_module_by_moduleid($value);
                $classify = $data['moduleinfo']['classify'];
                if($classify == 1){
                    $member['pc_onoff'] = 1;
                    $member['mobile_onoff'] = 0;
                }elseif($classify == 2){
                    $member['pc_onoff'] = 0;
                    $member['mobile_onoff'] = 1;
                }
                $member['moduleid'] = $value;

                $db_mysql->insert('module_roleinfo',$member);
            }
        }

        redirect("admin/C_frame_admin");

    }





}