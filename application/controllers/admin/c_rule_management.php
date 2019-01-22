<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//警员登录APP调用接口
class c_rule_management extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_rule_management');
    }
    //主页显示
    public function index()
    {
        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_rule_management/index/';
        //查询总条数
        $arr = $this->m_rule_management->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_rule_management->select_all_info($config['per_page'],$offect);
        $this->load->view('public/header');
        $this->load->view('rule_management/Index',$data);
    }
    //添加新版本
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('rule_management/v_add');
    }
    //保存
    public function save()
    {
        if(isset($_POST['title']))
        {
            $data['id'] = 0;
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['dateline'] = time();
            $res = $this->m_rule_management->save_model($data);
            if($res)
            {
                echo '1';
            }else
            {
                echo '0';
            }
        }
    }
    //编辑
    public function edit($id)
    {
        //根据ID查询详细信息
        $data['data'] = $this->m_rule_management->select_single_info($id);
        $this->load->view('public/header');
        $this->load->view('rule_management/v_edit',$data);
    }
    //编辑(处理)
    public function edit_pro()
    {
        if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $res = $this->m_rule_management->update_model($id,$data);
            if($res)
            {
                echo '1';
            }else
            {
                echo '0';
            }
        }
    }
    //删除
    public function delete()
    {
        $id = $this->input->post('id');
        $res = $this->m_rule_management->delete_model($id);
        if($res)
        {
            echo '1';
        }else
        {
            echo '0';
        }
    }
}