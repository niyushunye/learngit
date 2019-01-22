<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_moduleinfo extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //加载分页类
        $this->load->library('pagination');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    public function index($curpage = CURPAGE,$num = BIG_NUM)
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        $data['roleinfo'] = $this->get_rolename();


        $sql = "SELECT moduleinfo.moduleid, moduleinfo.modtitle, moduleinfo.modname,moduleinfo.modurl,
                        moduleinfo.parentid, moduleinfo.classify,
                        moduleinfo.dateline
                FROM moduleinfo

                ORDER BY moduleinfo.moduleid DESC
                LIMIT $curpage, $num";
        $result = $db_mysql->query($sql);
        $data['moduleinfo'] = $result->result_array();

        foreach($data['moduleinfo'] as &$value)
        {
            //print_r($value);
            //当moduleid等于parentid时，查出对应的modtitle
            $sql = "SELECT modtitle
                     FROM moduleinfo
                     WHERE moduleid = $value[parentid]";
            $result = $db_mysql->query($sql);
            $parentid = $result->row_array();

            $value['parentid_title'] = $parentid['modtitle'];
        }
        //print_r($data['moduleinfo']);
        /**
         * 分页配置
         * 1、每页显示几行数据
         * 2、分页路径
         * 3、获取数据总条数
         * 4、执行分页操作
         */
        $result = $db_mysql->get('moduleinfo');
        $data['total'] = $result->num_rows();

        $config['uri_segment'] = 4;
        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_moduleinfo/index/';
        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);

        $this->load->view('public/header');
        $this->load->view('moduleinfo/Index',$data);

    }

    public function  get_rolename(){
        $db_mysql = $this->load->database('default',TRUE);

        $result = $db_mysql->get('roleinfo');

        return $result->result_array();
    }

    public  function  get_parent(){
        $db_mysql = $this->load->database('default',TRUE);


        $db_mysql->select('moduleid,modtitle');
        $db_mysql->where('parentid',0);
        $result = $db_mysql->get('moduleinfo');

        return $result->result_array();
    }

    //跳转至添加页面
    public function  add(){
        $db_mysql = $this->load->database('default',TRUE);

        $data['roleinfo_add'] = $this->get_rolename();

        $data['moduleinfo'] = $this->get_parent();
        //万一模块名重复了？ in_array()
        $sql_get_modtitle = $db_mysql->query("SELECT modtitle FROM moduleinfo");
        $data['modtitle'] = $sql_get_modtitle->result_array();


        $this->load->view('public/header');
        $this->load->view('moduleinfo/V_moduleinfo_add',$data);
    }

    //对添加的信息进行提交
    public function save(){
        $db_mysql = $this->load->database('default',TRUE);


        $data['modtitle'] = $this->input->post('modtitle',TRUE);                                                 //从页面获取数据rolename
        $data['modname'] = $this->input->post('modname',TRUE);
        //从页面获取数据remark
        $data['modurl'] = $this->input->post('modurl',TRUE);
        $data['parentid'] = $this->input->post('parentid',TRUE);
        $data['classify'] = $this->input->post('classify',TRUE);
        $data['dateline'] = time();                                                                              //获得时间戳

        $db_mysql->insert('moduleinfo',$data);                                                                     //在数据库进行添加操作

        $oper['type'] = 1;
        $oper['module']= '模块管理';
        $oper['ziduan'] = '模块中文名称';
        $oper['field'] = $data['modtitle'];
        oper_log_($oper);

        redirect('admin/c_frame_admin');
    }


    public  function  delete(){
        $db_mysql = $this->load->database('default',TRUE);

        $moduleid = $this->input->post('moduleid',TRUE);
        /**
         * 利用页面session获取的值到数据库进行密码验证，
         * 确认无误进行删除操作
         */
        // $accounts = $_SESSION['accounts'];
        // $result = $db_mysql->query("SELECT memberinfo.password FROM memberinfo WHERE memberinfo.accounts = $accounts");
        // $result_password = $result->row_array();
        // //将sql执行完得到的数组进行转化为字符串
        // $result_password = implode($result_password);

        // $input_password = $this->input->post('password',TRUE);
        // $input_password1 = md5($accounts.$input_password);

        // if($result_password == $input_password1) {

            //查询出id对应的字段
            $result = $db_mysql->query("SELECT moduleinfo.`modtitle`
                                        FROM moduleinfo
                                        WHERE moduleinfo.`moduleid` = '$moduleid';");
            $data['modtitle'] = $result->result_array();
           $oper['type'] = 3;
            $oper['module']= '模块管理';
            $oper['ziduan'] = 'id';
            $oper['field'] = $moduleid;
            oper_log_($oper);
            //删除所对应的sql（如果密码用户名验证通过，则执行删除)
            $result = $db_mysql->delete('moduleinfo', array('moduleid' => $moduleid));
            //模块对应权限表同时删除
            $db_mysql->delete('module_roleinfo', array('moduleid' => $moduleid));
    }



    //通过ID获取所对应行的信息
    public function  edit($moduleid){
        $db_mysql = $this->load->database('default',TRUE);

        //加载权限名称和父类名称
        $data['roleinfo'] = $this->get_rolename();

        //获取所有parentid的数值
        $sql = $db_mysql->query("SELECT  moduleinfo.parentid
                                 FROM  moduleinfo
                                 WHERE  moduleinfo.moduleid = $moduleid");
        $data['get_parentid'] = $sql->row_array();
        $data['get_parentid_modtitle'] = $this->get_parent();



        //查询当前moduleid 对应行的值
        $sql = ("SELECT moduleinfo.moduleid, moduleinfo.modtitle, moduleinfo.modname,moduleinfo.modurl,
                        moduleinfo.parentid, moduleinfo.classify, moduleinfo.dateline
                 FROM  moduleinfo
                 WHERE  moduleinfo.moduleid = $moduleid
                 ORDER BY  moduleinfo.dateline DESC ");
        $result = $db_mysql->query($sql);
        $data['moduleinfo'] = $result->result_array();

        $sql_get_module_roleinfo = $db_mysql->query("SELECT * FROM module_roleinfo WHERE moduleid = '{$moduleid}'");
        $data['module_roleinfo'] = $sql_get_module_roleinfo->result_array();

        foreach($data['module_roleinfo'] as $value)
        {
            $data['roleids'][] = $value['roleid'];
        }


        //找出parentid所对应的父权限名称
        foreach($data['moduleinfo'] as &$value)
        {
            //print_r($value);
            //当moduleid等于parentid时，查出对应的modtitle
            $sql = "SELECT moduleid, modtitle
                     FROM moduleinfo
                    WHERE moduleid = $value[parentid]";
            $result = $db_mysql->query($sql);
            $parentid = $result->row_array();

            $value['parentid'] = $parentid['modtitle'];

        }
//        print_r($data);exit();
        $this->load->view('public/header');
        $this->load->view('moduleinfo/V_moduleinfo_edit',$data);

    }


    //对修改的信息进行确认
    public function  update(){
        $db_mysql = $this->load->database('default',TRUE);

        /**
         * 从页面获取数据，
         * 利用sql对其进行操作
         * 之后，再去加载index()，获取全部数据（分页）
         */

        $check_parentid = $this->input->post('parentid',TRUE);
        // echo $check_parentid;exit;
        if( $check_parentid == "" ){
            $data['moduleid'] = $this->input->post('moduleid',TRUE);
            $data['modtitle'] = $this->input->post('modtitle',TRUE);
            $data['modname'] = $this->input->post('modname',TRUE);
            $data['classify'] = $this->input->post('classify',TRUE);
            $data['dateline'] = time();

            $db_mysql->where('moduleid',$data['moduleid']);
            $db_mysql->update('moduleinfo',$data);
        }else{
            $data['moduleid'] = $this->input->post('moduleid',TRUE);
            $data['modtitle'] = $this->input->post('modtitle',TRUE);
            $data['modname'] = $this->input->post('modname',TRUE);
            $data['modurl'] = $this->input->post('modurl',TRUE);
            $data['parentid']  = $this->input->post('parentid',TRUE);
            $data['classify'] = $this->input->post('classify',TRUE);
            $data['dateline'] = time();

            // print_r($data);exit;
            $db_mysql->where('moduleid',$data['moduleid']);
            $db_mysql->update('moduleinfo',$data);
        }
            $oper['type'] = 2;
            $oper['module']= '模块管理';
            $oper['ziduan'] = '模块中文名称';
            $oper['field'] = $data['modtitle'];
            oper_log_($oper);

    redirect('admin/c_frame_admin');
    }
}