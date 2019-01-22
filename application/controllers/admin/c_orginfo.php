<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_orginfo extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_orginfo');
        $this->load->model('admin/m_memberinfo');
        $this->load->model('admin/m_oper_log');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    //显示文件列表
    public function index()
    {
        //所属部门代码orgnum
        $orgnum = $_SESSION['orgnum'];
//        $orgnum = '610301020000';

        //获取组织机构名称
        $data['orgname'] = $this->m_orginfo->get_orgname($orgnum);

        $data['glbm'] = $this->m_orginfo->get_spuer($orgnum);
//        print_r($data['glbm']);
//        exit();
        $arr = array(
            'id' => $orgnum,
            'pId' => 0,
            'name' => $data['orgname'][0]['orgname'],
//                'isParent' => true
            //点击时指向读取功能
            'url' => base_url().'admin/c_orginfo/filelist/'.$orgnum,
            'target' => "iframe1",
            "open" =>"true"
        );
        $data['result'][] = $arr;

        foreach($data['glbm'] as $value)
        {
            $orgnum = $value['orgnum'];
            $data['zbm'] = $this->m_orginfo->get_super1($orgnum);
//            print_r($data);
            foreach($data['zbm'] as $value1){
                $arr1 = array(
                    'id' => $value1['orgnum'],
                    'pId' => $value['orgnum'],
                    'name' => $value1['orgname'],
//                    'isParent' => true
                    //点击时指向读取功能
                    'url' => base_url().'admin/c_orginfo/filelist/'.$value1['orgnum'],
                    'target' => "iframe1"
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
            $this->load->view("orginfo/Index",$data);
        }
//        print_r($data);exit();
    }


    public function getsuper($orgnum)
    {
        $data['orgname'] = $this->m_orginfo->get_orgname($orgnum);;

        $data['glbm'] = $data['glbm'] = $this->m_orginfo->get_spuer($orgnum);
        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum.'<br>';
            $this->filelist($orgnum);
        }
        $this->load->view("orginfo/Index",$data);
    }


    //调用读取文件程序
    public function filelist($orgnum)
    {

        $data['orginfo'] = $this->m_orginfo->get_orginfo($orgnum);

        //第一次程序运行时候，orgnum为对应的部门代码；第二次运行，orgnum输出为页码。
        if($orgnum > 1000){

            $data['orgname'] = $this->m_orginfo->get_orgname($orgnum);
            if($data['orgname'][0]['orgnum'] == ''){
                $orgnum = array();
            }else{
                $orgnum = $data['orgname'][0]['orgnum'];
            }

            $curpage = CURPAGE;
            $num = BIG_NUM;
            $config['uri_segment'] = 3;

        } else{
            $orgnum = $this->uri->segment(5);
            $curpage = $this->uri->segment(4,0);
            $num = BIG_NUM;
            $config['uri_segment'] = 4;
            $config['first_url'] =  base_url() . '/admin/c_orginfo/filelist/0/'."/"."$orgnum";

        }


        $data['orginfo'] = $this->m_orginfo->get_orgname_paging($orgnum,$curpage,$num);
        $data['orgnum'] = $data['orginfo']['0']['orgnum'];
        $data['total'] = $this->m_orginfo->get_orgname_total($orgnum);


        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_orginfo/filelist/';
        $config['suffix'] = "/"."$orgnum" ;                                                      //给链接地址加后缀  http://localhost/ci/控制器/方法名/参数

        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);
        $data['shortname'] = $data['orginfo']['0']['shortname'];
        $this->load->view('public/header');
        $this->load->view("orginfo/V_orginfo_filelist",$data);
    }





    //新增模块 准备
    public function orginfo_add($orgnum){
        // echo $orgnum;exit;
        $data['orgname_add'] = $this->m_orginfo->get_orgname($orgnum);
        $data['XZQH'] = $this->db->query("SELECT dmz,dmsm1 FROM frm_code WHERE xtlb = '00' AND dmlb = '0050' AND zt = '1' AND dmz LIKE '".XZQH."%'")->result_array();

//       print_r($data['orgname_add'][0]['superiornum']);
//        exit();

        //如果点的是支队，则认为是要添加大队，只需要显示前4位就好
        //如果点的是大队，则认为是要添加中队，需要显示前8位
        if($data['orgname_add'][0]['orgnum'] == '610800000000'){
            $orgnum4 = substr("{$data['orgname_add'][0]['orgnum']}", 0,4);
            $data['orgnum'] = $orgnum4;
        }else{
            $orgnum8 = substr("{$data['orgname_add'][0]['orgnum']}", 0,8);
            $data['orgnum'] = $orgnum8;
        }
        $this->load->view('public/header');
        $this->load->view('orginfo/V_orginfo_add',$data);
    }



    public  function orginfo_save(){
        $data['orgname'] = $this->input->post('orgname',TRUE);
        $data['orgnum'] = $this->input->post('orgnum',TRUE);
        $data['shortname'] = $this->input->post('shortname',TRUE);
        $data['superiorname'] = $this->input->post('superiorname',TRUE);
        $data['superiornum'] = $this->input->post('superiornum', TRUE);
        $data['stampname'] = $this->input->post('stampname',TRUE);
        $data['appeal'] = $this->input->post('appeal',TRUE);
        $data['review'] = $this->input->post('review',TRUE);
        $data['phone'] = $this->input->post('phone',TRUE);
        $data['remark'] = $this->input->post('remark',TRUE);
        $data['dateline'] = time();
        $XZQH = $this->input->post('XZQH',TRUE);
        if(!empty($XZQH)){
            foreach($XZQH as $value)
            {
                $value_xzqh .= ','.$value;
            }
            $data['manage_XZQH'] = null;
        }

        /*$orginfo = array(
            'orgname' => "{$data['orgname']}",
            'orgnum' => "{$data['orgnum']}",
            'shortname' => "{$data['shortname']}",
            'superiorname' => "{$data['superiorname']}",
            'superiornum' => "{$data['superiornum']}",
            'stampname' => "{$data['stampname']}",
            'appeal' => "{$data['appeal']}",
            'review' => "{$data['review']}",
            'phone' => "{$data['phone']}",
            'remark' => "{$data['remark']}"
        );*/
        // $orginfo = "('{$data['orgname']}','{$data['orgnum']}','{$data['shortname']}',
        //         '{$data['superiorname']}','{$data['superiornum']}','{$data['stampname']}',
        //         '{$data['appeal']}','{$data['review']}','{$data['phone']}','{$data['remark']}' )";
      

        $this->m_orginfo->add_orginfo($data);
        
        $oper['type'] = 1;
        $oper['module']= '组织机构管理';
        $oper['ziduan'] = '组织机构编码';
        $oper['field'] = $data['orgnum'];
        oper_log_($oper);

        redirect('admin/c_orginfo/');

    }


    //显示所有的大队
    public function get_orginfo_dadui(){
        $data['orginfo_dadui'] = $this->m_orginfo->orginfo_shortname();
        $json = json_encode($data['orginfo_dadui'], JSON_UNESCAPED_UNICODE);
        echo $json;
    }




    public function  orginfo_edit($orgnum){

        $data['orginfo'] = $this->m_orginfo->get_orgname($orgnum);
        foreach($data['orginfo'] as $value)
        {
            $data['manage_XZQH'] = explode(',',$value['manage_XZQH']);
        }
        // exit;
        // print_r($data);exit;
        $data['XZQH'] = $this->db->query("SELECT dmz,dmsm1 FROM frm_code WHERE xtlb = '00' AND dmlb = '0050' AND zt = '1' AND dmz LIKE '".XZQH."%'")->result_array();
        $this->load->view('public/header');
        $this->load->view('orginfo/V_orginfo_edit',$data);
    }




    public function  orginfo_update(){
        $data['orgid'] = $this->input->post('orgid',TRUE);
        $data['orgname'] = $this->input->post('orgname',TRUE);
        $data['orgnum'] = $this->input->post('orgnum',TRUE);
        $data['shortname'] = $this->input->post('shortname',TRUE);
        $result = $this->input->post('parentid',TRUE);
        $data['superiornum'] = substr($result,0,12);
        $data['superiorname'] = substr($result,15);
        $data['stampname'] = $this->input->post('stampname',TRUE);
        $data['appeal'] = $this->input->post('appeal',TRUE);
        $data['review'] = $this->input->post('review',TRUE);
        $data['phone'] = $this->input->post('phone',TRUE);
        $data['remark'] = $this->input->post('remark',TRUE);
        $XZQH = $this->input->post('XZQH',TRUE);
        if(!empty($XZQH)){
            foreach($XZQH as $value)
            {
                $value_xzqh .= ','.$value;
            }
            $data['manage_XZQH'] = substr($value_xzqh, 1);
        }else{
            $data['manage_XZQH'] = null;
        }

//        $db_mysql->where('orgid',$data['orgid']);
//        $db_mysql->update('orginfo',$data);
        $this->db->where('orgid',$data['orgid']);
        $res = $this->db->update('orginfo',$data);

        $oper['type'] = 2;
        $oper['module']= '组织机构管理';
        $oper['ziduan'] = '组织机构编码';
        $oper['field'] = $data['orgnum'];
        oper_log_($oper);

        redirect('admin/c_orginfo/');
    }


    public function fangqi($orgnum){
        $this->filelist($orgnum);
    }




    public  function  delete(){
        $orgid = $this->input->post('orgid',TRUE);

        /**
         * 利用页面session获取的值到数据库进行密码验证，
         * 确认无误进行删除操作
         */
//         $accounts = $_SESSION['accounts'];
//         $result_password = $this->m_memberinfo->get_memberinfo_accounts($accounts);
// //        print_r($result_password);
// //        exit();
//         //将sql执行完得到的数组进行转化为字符串
//         $result_password = implode($result_password);

//         $input_password = $this->input->post('password',TRUE);
//         $input_password1 = md5($accounts.$input_password);

//         if($result_password == $input_password1) {
            //删除所对应的sql（如果密码用户名验证通过，则执行删除)

            $data['orgnum'] = $this->m_orginfo->get_orginfo_orgid_orgnum($orgid);
        
            $oper['type'] = 3;
            $oper['module']= '组织机构管理';
            $oper['ziduan'] = 'id';
            $oper['field'] = $orgid;
            oper_log_($oper);

            $this->m_orginfo->delete_orginfo($orgid);
        // }


        redirect('admin/c_orginfo/index');
    }


}
