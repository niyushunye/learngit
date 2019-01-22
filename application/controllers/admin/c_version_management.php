<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//警员登录APP调用接口
class c_version_management extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_version_management');

        date_default_timezone_set('Asia/Shanghai');
    }
    //主页显示
    public function index()
    {
        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_version_management/index/';
        //查询总条数
        $arr = $this->m_version_management->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_version_management->select_all_info($config['per_page'],$offect);
        $this->load->view('public/header');
        $this->load->view('version_management/Index',$data);
    }

    //添加新版本
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('version_management/v_add');
    }

    //文件上传
    public function upload(){
        //获取文件上传
        if($_FILES['version_app']['name']){
            //$file_size = $_FILES['version_app']['size'];              //文件大小(数组)
            $file_name = $_FILES['version_app']['name'];              //文件新名称
            $file_type = $_FILES['version_app']['type'];              //文件的类型
            //echo $file_type;
            $file_tmp_name = $_FILES['version_app']['tmp_name'];      //上传文件的临时路径
            //不允许上传的类型
            $allow_file_type = array('image/jpeg', 'image/jpg', 'image/png');

            if(in_array($file_type,$allow_file_type)){
                echo '1'; //不允许上传的文件类型
            }else{
                move_uploaded_file($file_tmp_name, './assets/uploads/version_app/'.$file_name);

                echo '/assets/uploads/version_app/'. $file_name;
            }

        }else{
            echo '0'; //没有上传文件
        }


    }


    //保存
    public function save()
    {

        $data['version_name'] = $this->input->post('version_name');
        $data['version_description'] = $this->input->post('version_description');
        //$data['version_url'] = $this->input->post('version_url');
        $data['version_app'] = $this->input->post('version_app');
        $data['dateline'] = time();
        $data['update_code'] = $this -> input -> post('update_code');


        $res = $this->m_version_management->save_model($data);
        if($res)
        {
            echo '1';     //添加成功
        }else
            {
                echo '0';   //添加失败
            }
    }
    //编辑
    public function edit($id)
    {
        //根据ID查询详细信息
        $data['data'] = $this->m_version_management->select_single_info($id);
        $this->load->view('public/header');
        $this->load->view('version_management/v_edit',$data);
    }
    //编辑(处理)
    public function edit_pro()
    {

            $id = $this->input->post('id');
            $data['version_name'] = $this->input->post('version_name');
            $data['version_description'] = $this->input->post('version_description');
            $data['update_code'] = $this -> input -> post('update_code');

            //$data['version_url'] = $this->input->post('version_url');

            $version_app = $this->input->post('version_app');

            if($version_app != '0' && $version_app != '1' ){
                $this->m_version_management->update($id,$version_app);
            }


            $res = $this->m_version_management->update_model($id,$data);
            if($res)
            {
                echo '1';
            }else
                {
                    echo '0';
                }

    }
    //删除
    public function delete()
    {
        $id = $this->input->post('id');
        $res = $this->m_version_management->delete_model($id);
        if($res)
        {
            echo '1';
        }else
            {
                echo '0';
            }
    }
}