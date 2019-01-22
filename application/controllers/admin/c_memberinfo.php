<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_memberinfo extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //加载分页类
        $this->load->library('pagination');
        $this->load->model('admin/m_memberinfo');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }



 //显示文件列表
    public function index()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式610301010000
        $db_mysql = $this->load->database('default',TRUE);


        //所属部门代码orgnum
        $orgnum = $_SESSION['orgnum'];
//        $orgnum = '610301020000';

        //获取组织机构名称
        $sql_getOrgname = $db_mysql->query("SELECT * FROM `orginfo` WHERE `orgnum` = '{$orgnum}'");
        $data['orgname'] = $sql_getOrgname->result_array();


        //看看这个组织机构代码下还有没有下属部门，有就读取
//        if($orgnum = '610300000000'){
        $sql_getSuper = $db_mysql->query("SELECT * FROM `orginfo` WHERE `superiornum` = '{$orgnum}'OR `orgnum` = '{$orgnum}' ORDER BY `orgnum` DESC ");
        $data['glbm'] = $sql_getSuper->result_array();

        $arr = array(
            'id' => $orgnum,
            'pId' => 0,
            'name' => $data['orgname'][0]['orgname'],
//                'isParent' => true
            //点击时指向读取功能
            'url' => base_url().'admin/c_memberinfo/filelist/'.$orgnum,
            'target' => "iframe",
            "open" =>"true"
        );
        $data['result'][] = $arr;

        foreach($data['glbm'] as $value)
        {
            $sql_getSuper = $db_mysql->query("SELECT * FROM `orginfo` WHERE `superiornum` = '{$value['orgnum']}' ORDER BY `orgnum` DESC ");
            $data['zbm'] = $sql_getSuper->result_array();
//            print_r($data);
            foreach($data['zbm'] as $value1){
                $arr1 = array(
                    'id' => $value1['orgnum'],
                    'pId' => $value['orgnum'],
                    'name' => $value1['orgname'],
//                    'isParent' => true
                    //点击时指向读取功能
                    'url' => base_url().'admin/c_memberinfo/filelist/'.$value1['orgnum'],
                    'target' => "iframe"
                );
                $data['result'][] = $arr1;
            }
        }


        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum;
            $this->filelist($orgnum);
        }else{
            $this->load->view("memberinfo/index",$data);
        }
        //print_r($data);exit();
    }



    public function checkaccounts(){
        $db_mysql = $this->load->database('default',TRUE);
        $accounts = $this->input->post("accounts",TRUE);
        $result = $db_mysql->query("SELECT * FROM memberinfo WHERE accounts = '$accounts' ");
        $data['accounts'] = $result->result_array();
        if(!empty($data['accounts'])){
            echo '警员编号已经存在！！';exit();
        }
    }

    public function getsuper($orgnum)
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式610301010000
        $db_mysql = $this->load->database('default',TRUE);

        $sql_getOrgname = $db_mysql->query("SELECT * FROM `orginfo` WHERE `orgnum` = '{$orgnum}'");
        $data['orgname'] = $sql_getOrgname->result_array();

        $sql_getSuper = $db_mysql->query("SELECT * FROM `orginfo` WHERE `superiornum` = '{$orgnum}' ORDER BY `orgnum` DESC ");
        $data['glbm'] = $sql_getSuper->result_array();
        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum.'<br>';
            $this->filelist($orgnum);
        }
        $this->load->view("admin/v_memberinfo",$data);
    }




    //调用读取文件程序
    public function filelist($orgnum)
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式610301010000
        $db_mysql = $this->load->database('default',TRUE);
        $data['orgnum'] = $orgnum;
        $data['accounts'] = "";
        $data['realname'] = "";

//        echo $orgnum;
        //第一次程序运行时候，orgnum为对应的部门代码；第二次运行，orgnum输出为页码。
        if($orgnum > 1000){
            $sql_getOrgname = $db_mysql->query("SELECT * FROM `orginfo` WHERE `orgnum` = '{$orgnum}'");
            $data['orgname'] = $sql_getOrgname->result_array();
            $orgnum = $data['orgname'][0]['orgnum'];

            $curpage = CURPAGE;
            $num = BIG_NUM;
            $config['uri_segment'] = 3;

        } else{
            $orgnum = $this->uri->segment(5);
            $curpage = $this->uri->segment(4,0);
            $num = BIG_NUM;
            $config['uri_segment'] = 4;
            $config['first_url'] =  base_url() . '/admin/c_memberinfo/filelist/0/'."/"."$orgnum";
        }


        $result = $db_mysql->query("SELECT memberinfo.*,member_binding.serial_number FROM memberinfo 
                                    -- LEFT JOIN orginfo ON orginfo.orgnum = memberinfo.orgnum 
                                    LEFT JOIN member_binding ON member_binding.accounts = memberinfo.accounts 
                                    WHERE  memberinfo.orgnum = '{$orgnum}'
                                    ORDER BY memberinfo.dateline DESC
                                    LIMIT $curpage, $num");
        $data['memberinfo'] = $result->result_array();

        $result = $db_mysql->query("SELECT * FROM memberinfo WHERE orgnum = '$orgnum'");
        $data['total'] = $result->num_rows();


        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_memberinfo/filelist/';
        $config['suffix'] = "/"."$orgnum" ;                                                      //给链接地址加后缀  http://localhost/ci/控制器/方法名/参数

        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);

        // print_r($data);exit;
        $this->load->view('public/header');
        $this->load->view("memberinfo/v_filelist",$data);
    }



    //获取所有的组织机构名称
    public function get_orgname(){
        $db_mysql = $this->load->database('default',TRUE);
        $result = $db_mysql->query("SELECT orgname, orgnum FROM orginfo WHERE shortname != ''");

        return  $result->result_array();
    }




    public function delete()
    {
        $accounts = $this->input->post("accounts", TRUE);
        if($accounts == ""){
            echo 0;
        }else{
            $result = $this->m_memberinfo->delete_by_accounts($accounts);
            echo $result;
        }
    }

    public function relieve()
    {
        $accounts = $this->input->post("accounts", TRUE);
        if($accounts == ""){
            echo 0;
        }else{
            $result = $this->m_memberinfo->relieve_by_accounts($accounts);
            echo $result;
        }
    }


//     public function  delete_memberinfo($orgnum){
//         $db_mysql = $this->load->database('default',TRUE);
//         $data['memberid'] = $this->input->post("memberid",TRUE);

//         $result = $db_mysql->query("SELECT memberinfo.`accounts`, memberinfo.`orgnum` FROM memberinfo
//                                     WHERE memberinfo.`memberid` ='{$data['memberid']}'");
//         $data['accounts'] = $result->result_array();

//             $oper['type'] = 3;
//             $oper['module']= '警员管理';
//             $oper['ziduan'] = 'id';
//             $oper['field'] =  $data['memberid'];
//             oper_log_($oper);

//         $db_mysql->delete('memberinfo', array('memberid' => $data['memberid']));

//         $db_mysql->delete('member_roleinfo', array('memberid' => $data['memberid']));
// //        redirect(base_url().'admin/c_memberinfo');
//         $this->filelist($orgnum);
//     }

    //编辑，但是只是从数据库读取需要的数据，并没有真正UPDATE
    public function edit($accounts)
    {
        // echo $accounts;exit();
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        $result = $db_mysql->query("SELECT *
                       FROM memberinfo
                       WHERE  memberinfo.accounts ='$accounts'");
        $data['memberinfo'] = $result->result_array();

        $result = $db_mysql->get('roleinfo');
        $data['roleinfo'] = $result->result_array();

        $sql_get_member_roleinfo = $db_mysql->query("SELECT * FROM member_roleinfo WHERE accounts = '{$accounts}'");
        $data['member_roleinfo'] = $sql_get_member_roleinfo->result_array();



        foreach($data['member_roleinfo'] as $value)
        {
            $data['roleids'] = explode(',',$value['roleid']);
        }

        $data['directors'] = $this->m_memberinfo->get_director_by_orgnum($data['memberinfo'][0]['orgnum']);
        $data['org_member'] = $this->m_memberinfo->get_orgnum_member($data['memberinfo'][0]['orgnum']);
        //print_r($data);
        $this->load->view('public/header');
        $this->load->view('memberinfo/v_memberinfo_edit.php',$data);
    }


    //编辑的UPDATE, 完成了编辑并UPDATE 到数据库里
    public function editover()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        //获取页面上的修改数据
        //这里做了个TRUE的过滤参数选项,如果没有这个用户输入的数据有可能包含HTML\JS 等代码
        $data = array();

        $data['memberid'] = $this->input->post('memberid', TRUE);
        $data['realname'] = $this->input->post('realname', TRUE);
        $data['accounts'] = $this->input->post('accounts', TRUE);
        $password = $this->input->post('password', TRUE);
        $sql_get_memberinfo_password = $db_mysql->query("SELECT password FROM memberinfo WHERE memberid = '{$data['memberid']}'");
        $result = $sql_get_memberinfo_password->result_array();

        if($password === $result[0]['password'])
        {
            
        }
        else
        {
            $data['password'] = md5($data['accounts'].$password);
        }


        $data['orgnum'] = $this->input->post('orgnum', TRUE);
        $data['mobile'] = $this->input->post('mobile', TRUE);
        $data['idcard'] = $this->input->post('idcard', TRUE);
        $data['alarmFeedbackMember'] = $this->input->post('alarmFeedbackMember', TRUE);

        $data['status'] = $this->input->post('status', TRUE);

        $is_director = $this->input->post('is_director', TRUE);
        if($is_director == 1){
            $data['isAuxiliaryPolice'] = 2;
            $data['director'] = $this->input->post('director', TRUE);
        }else{
            $data['isAuxiliaryPolice'] = 1;
        }

        $data['dateline'] = time();


        $db_mysql->where('memberid', $data['memberid']);
        $db_mysql->update('memberinfo', $data);

        $oper['type'] = 2;
            $oper['module']= '警员管理';
            $oper['ziduan'] = '警员编号';
            $oper['field'] =  $data['accounts'];
            oper_log_($oper);

//新增、修改、删除警员时，都需要同步到member_roleinfo表中（关系表）memberid,roleid,moduleid,pc_onoff,mobile_onoff
        $sql_get_memberinfo = $db_mysql->query("SELECT * FROM memberinfo WHERE memberid = '{$data['memberid']}'");
        $data['memberinfo'] = $sql_get_memberinfo->result_array();
//        print_r($data['memberinfo']);

        //memberid
        $member['memberid'] = $data['memberinfo'][0]['memberid'];
        $member['accounts'] = $data['memberinfo'][0]['accounts'];

        //roleid
        $all_groupCheckbox = $this->input->post('groupCheckbox', TRUE);
        $value_id = '';
        if(empty($all_groupCheckbox)){
            $member['roleid'] = "4";
        }else{
            foreach($all_groupCheckbox as $value)
            {
                $value_id .= ','.$value;
            }
            $member['roleid'] = substr($value_id, 1);

        }

        //dateline
        $member['dateline'] = time();
        $db_mysql->delete('member_roleinfo', array('accounts' => $member['accounts']));
        $db_mysql->insert('member_roleinfo',$member);
//        print_r($member);exit();
        // $sql_get_member_roleinfo = $db_mysql->query("SELECT * FROM member_roleinfo WHERE accounts = '{$member['accounts']}'");
        // $data['member_roleinfo'] = $sql_get_member_roleinfo->result_array();

        // if(empty($data['member_roleinfo'])){
        //     $db_mysql->insert('member_roleinfo',$member);
        // }else{
        //     $db_mysql->where('accounts',$member['accounts']);
        //     $db_mysql->update('member_roleinfo',$member);
        // }

//        redirect(base_url().'admin/c_memberinfo');
        $this->filelist($data['orgnum']);
    }



    public function  add($orgnum=null){
        $db_mysql = $this->load->database('default',TRUE);

        //获取页面上所需要显示的权限
        $sql = "SELECT roleid , rolename FROM roleinfo";
        $result = $db_mysql->query($sql);
        $data['roleinfo'] = $result->result_array();

        
        $data['orgnum'] = $orgnum;

        $data['directors'] = $this->m_memberinfo->get_director_by_orgnum($orgnum);
        $data['org_member'] = $this->m_memberinfo->get_orgnum_member($orgnum);
//        print_r($data);
        $this->load->view('public/header');
        $this->load->view('memberinfo/v_memberinfo_add',$data);

    }




    //新增数据到memberinfo表里
    public function add_save()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        //获取页面上的修改数据
        //这里做了个TRUE的过滤参数选项,如果没有这个用户输入的数据有可能包含HTML\JS 等代码
        //在使用$db_mysql->insert()方法时候,$data里元素的顺序,必须跟表字段的顺序一致,否则数据插入有问题
        $data['realname'] = $this->input->post('realname', TRUE);
        $data['accounts'] = $this->input->post('accounts', TRUE);
        $data['password'] = $this->input->post('re_password', TRUE);
        $data['orgnum'] = $this->input->post('orgnum', TRUE);
        $data['mobile'] = $this->input->post('mobile', TRUE);
        $data['idcard'] = $this->input->post('idcard', TRUE);
        $data['alarmFeedbackMember'] = $this->input->post('alarmFeedbackMember', TRUE);
        $data['status'] = 1;
        
        $is_director = $this->input->post('is_director', TRUE);
        if($is_director == 1){
            $data['isAuxiliaryPolice'] = 2;
            $data['director'] = $this->input->post('director', TRUE);
        }else{
            $data['isAuxiliaryPolice'] = 1;
        }

        $data['dateline'] = time();

        $data['password'] = md5($data['accounts'].$data['password']);
        $db_mysql->insert('memberinfo', $data);

            $oper['type'] = 1;
            $oper['module']= '警员管理';
            $oper['ziduan'] = '警员编号';
            $oper['field'] =  $data['accounts'];
            oper_log_($oper);


//新增、修改、删除警员时，都需要同步到member_roleinfo表中（关系表）memberid,roleid,moduleid,pc_onoff,mobile_onoff
        $sql_get_memberinfo = $db_mysql->query("SELECT * FROM memberinfo WHERE accounts = '{$data['accounts']}'");
        $data['memberinfo'] = $sql_get_memberinfo->result_array();
//        print_r($data['memberinfo']);

        //memberid
        $member['memberid'] = $data['memberinfo'][0]['memberid'];
        $member['accounts'] = $data['memberinfo'][0]['accounts'];

        //roleid
        $all_groupCheckbox = $this->input->post('groupCheckbox', TRUE);
        $value_id = '';
        if(empty($all_groupCheckbox)){
            $member['roleid'] = "4";
        }else{
            foreach($all_groupCheckbox as $value)
            {
                $value_id .= ','.$value;
            }
            $member['roleid'] = substr($value_id, 1);

        }


        //dateline
        $member['dateline'] = time();
//        print_r($member);exit();
        $db_mysql->insert('member_roleinfo',$member);

//        redirect(base_url().'admin/c_memberinfo');
        $this->filelist($data['orgnum']);
    }

    //根据表单上的真实姓名 或 警员编号,来查询数据从memberinfo表里
    public function search()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        //获取页面上的修改数据
        //这里做了个TRUE的过滤参数选项,如果没有这个用户输入的数据有可能包含HTML\JS 等代码
        $data = array();

        $data['realname'] = $realname = $this->input->post('realname', TRUE);
        $data['accounts'] = $accounts = $this->input->post('accounts', TRUE);
        $data['orgnum']  = $orgnum= $this->input->post("orgnum", TRUE);
        // echo $realname."/".$accounts;

        if($realname)
        {
            $sql = "SELECT memberinfo.*,member_binding.serial_number FROM memberinfo 
                                    LEFT JOIN member_binding ON member_binding.accounts = memberinfo.accounts
									WHERE  memberinfo.realname like '%{$realname}%'
                                    -- AND  memberinfo.orgnum ='$orgnum'
                                    ORDER  BY memberinfo.dateline DESC
                                     ";
        }
        if($accounts)
        {
            $sql = "SELECT memberinfo.*,member_binding.serial_number FROM memberinfo 
                                    LEFT JOIN member_binding ON member_binding.accounts = memberinfo.accounts
									WHERE memberinfo.accounts = '$accounts'
                                    -- AND  memberinfo.orgnum ='$orgnum'
                                    ORDER  BY memberinfo.dateline DESC
                                    ";
        }



        $result = $db_mysql->query($sql);
        $data['memberinfo'] = $result->result_array();
        $data['total'] = $result->num_rows();

        $this->load->view('public/header');
        $this->load->view("memberinfo/v_filelist",$data);



    }





    //这个方法的最终目标是要从oracle数据库里把数据读取出后,并转换字段,然后插入到mysql数据库里
    //今天是5月31日,暂时要完成在mysql里的XE数据库读出数据,然后朝mysql的police数据库里插入数据
    //
    //这个是内部成员信息表,也就是警员信息表
    public function convert_memberinfo()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        //$from_db 从from_db库里读取数据  $to_db 插入到to_db数据库里
        $from_db = "xe";
        $to_db = "police";


        //首先读取数据
        $db_mysql->db_select($from_db);
        $result = $db_mysql->get('bas_police');  // Produces: SELECT * FROM bas_police
        $data = $result->result_array();

        //print_r($data);
        //JYBH警员编号,XM姓名,BMDM部门代码,XB性别,JLZT记录状态


        $db_mysql->db_select($to_db);
        foreach ($data as $k => $v)
        {
            //print_r($v);

            //在使用$db_mysql->insert()方法时候,$data里元素的顺序,必须跟表字段的顺序一致,否则数据插入有问题
            $memberinfo['realname'] = $v['xm'];
            $memberinfo['accounts'] = $v['jybh'];
            $memberinfo['sex'] = '';
            $memberinfo['password'] = md5('123456');
            $memberinfo['orgnum'] = $v['bmdm'];
            $memberinfo['mobile'] = '';
            $memberinfo['idcard'] = '';
            $memberinfo['roleid'] = '1';
            $memberinfo['status'] = $v['jlzt'];
            $memberinfo['dateline'] = '';

            print_r($memberinfo);
            $db_mysql->insert('memberinfo', $memberinfo);
        }
    }





    //这个是组织机构表
    //因为整个orginfo设计的思路核心表都是根据 ID 来关联的,
    //所以,这个同步功能只能用一次,否则每次部门ID 一变,所有的跟这个ID关联的表都会出问题;
    public function convert_org()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        //$from_db 从from_db库里读取数据  $to_db 插入到to_db数据库里,
        //这里是库名,不需要改
        $from_db = "xe";
        $to_db = "police";


        //首先读取数据
        $db_mysql->db_select($from_db);
        $result = $db_mysql->get('frm_department');  // Produces: SELECT * FROM frm_department
        $data = $result->result_array();

        //print_r($data);
        //GLBM管理部门,BMMC部门名称,BMQC部门全称,YZMC印章名称,LXDH联系电话,SJBM上级部门,JLZT记录状态

        $db_mysql->db_select($to_db);
        foreach ($data as $k => $v)
        {
            //print_r($v);

            //因为这个表存在这从属关系,所以必须的分几步完成数据的插入
            //第一步:先把数据不包含 sjbm 读取并插入到orginfo表里
            //在使用$db_mysql->insert()方法时候,$data里元素的顺序,必须跟表字段的顺序一致,否则数据插入有问题
            $orginfo['orgname'] = $v['bmmc'];
            $orginfo['orgnum'] = $v['glbm'];
            $orginfo['parentid'] = '';
            $orginfo['path'] = '';
            $orginfo['sjbm'] = $v['sjbm'];
            $orginfo['shortname'] = '';
            $orginfo['stampname'] = $v['yzmc'];
            $orginfo['appeal'] = '';
            $orginfo['review'] = '';
            $orginfo['phone'] = $v['lxdh'];
            $orginfo['remark'] = '';
            $orginfo['dateline'] = '';

            print_r($orginfo);
            $db_mysql->insert('orginfo', $orginfo);

        }

    }



    //convert_org_no_finish 这个方法作废,主要是想出更好的解决思路,但是暂保留,以后可以删除
    //这个是组织机构表
    //因为整个orginfo设计的思路核心表都是根据 ID 来关联的,
    //所以,这个同步功能只能用一次,否则每次部门ID 一变,所有的跟这个ID关联的表都会出问题;
    public function convert_org_no_finish()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);

        //$from_db 从from_db库里读取数据  $to_db 插入到to_db数据库里,
        //这里是库名,不需要改
        $from_db = "xe";
        $to_db = "police";


        //首先读取数据
        $db_mysql->db_select($from_db);
        $result = $db_mysql->get('frm_department');  // Produces: SELECT * FROM frm_department
        $data = $result->result_array();

        //print_r($data);
        //GLBM管理部门,BMMC部门名称,BMQC部门全称,YZMC印章名称,LXDH联系电话,SJBM上级部门,JLZT记录状态

        $db_mysql->db_select($to_db);
        foreach ($data as $k => $v)
        {
            //print_r($v);

            //因为这个表存在这从属关系,所以必须的分几步完成数据的插入
            //第一步:先把数据不包含 sjbm 读取并插入到orginfo表里
            //在使用$db_mysql->insert()方法时候,$data里元素的顺序,必须跟表字段的顺序一致,否则数据插入有问题
            $orginfo['orgname'] = $v['bmmc'];
            $orginfo['orgnum'] = $v['glbm'];
            $orginfo['parentid'] = '';
            $orginfo['path'] = '';
            $orginfo['shortname'] = '';
            $orginfo['stampname'] = $v['yzmc'];
            $orginfo['appeal'] = '';
            $orginfo['review'] = '';
            $orginfo['phone'] = $v['lxdh'];
            $orginfo['remark'] = '';
            $orginfo['dateline'] = '';

            print_r($orginfo);
            $db_mysql->insert('orginfo', $orginfo);

        }

        //第二步:首先把数据库表名换成 frm_department 表 即对应的 $from_db
        $db_mysql->db_select($from_db);

        //然后读出每条数据的 glbm 和 sjbm 上级部门编码;
        $db_mysql->select('glbm, sjbm');
        $result = $db_mysql->get('frm_department');     //结合着上面一条语句组合成:Executes: SELECT glbm, sjbm FROM frm_department
        $data_glbm_sjbm = $result->result_array();

        //然后再把数据库表名换成 orginfo 表, 即对应的 $to_db
        $db_mysql->db_select($to_db);

        //然后把之前读 glbm 和 sjbm 的数据拿出来做 foreach
        foreach ($data_glbm_sjbm as $k => $v)
        {
            //print_r($v);

            //然后去数据库里查对应的orgid
            $db_mysql->where('orgnum', $v['sjbm']);      // Produces: WHERE orgnum = '$v['sjbm']'
            $result = $db_mysql->get('orginfo');     //SELECT * FROM orginfo WHERE orgnum = '$v['sjbm']'

            foreach ($result as $k => $v)
            {
                //print_r($v);

                $v['orgid'];

                $db_mysql->where('orgnum', $v['sjbm']);      // Produces: WHERE orgnum = '$v['sjbm']'
                $result = $db_mysql->get('orginfo');     //SELECT * FROM orginfo WHERE orgnum = '$v['sjbm']'

                //下面的代码还没有整理思路,上面的是按照思路来完成的

            }


        }



        //然后再查出这个上级编码的 orgid
        $db_mysql->select('orgid');
        $result = $db_mysql->get('orginfo');     //结合着上面一条语句组合成:Executes: SELECT orgid FROM frm_department
        $data_orgid = $result->result_array();

        //然后插入当前数据条里




        $db_mysql->db_select($to_db);
        foreach ($data as $k => $v)
        {
            //print_r($v);

            //在使用$db_mysql->insert()方法时候,$data里元素的顺序,必须跟表字段的顺序一致,否则数据插入有问题

            $db_mysql->where('glbm', $v['glbm']);
            $result = $db_mysql->get('memberinfo');

            print_r($orginfo);
            $db_mysql->insert('orginfo', $orginfo);

        }
    }



    //因为从oracle拿来的数据,其实没有上下级关系,虽然目前有上级部门的编码,但是在前台页面上排序显示的时候不好显示
    //故,需要排序一次,当然,这个功能只可能用一回
    public function update_orginfo_path()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式
        $db_mysql = $this->load->database('default',TRUE);


        $result = $db_mysql->get('orginfo');  // Produces: SELECT * FROM orginfo
        $data = $result->result_array();


        foreach ($data as $k => $v)
        {
            //print_r($v);

            $orginfo['orgid'] = $v['orgid'];
            $orginfo['parentid'] = $v['parentid'];
            $orginfo['path'] = "0,$orginfo[parentid],$orginfo[orgid]";

            //echo $orginfo['path'];

            $data = array('path' => $orginfo['path']);

            $where = "orgid = $orginfo[orgid]";

            $str = $db_mysql->update_string('orginfo', $data, $where);

            echo $str;


        }



        //print_r($data);

        //$this->load->helper('url');
        //$this->load->view('admin/v_memberinfo.php',$data);


    }








}
