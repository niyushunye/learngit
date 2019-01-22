<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_control_task extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_control_task');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

        //date_default_timezone_set('Asia/Shanghai');
    }
    //主页显示
    public function index()
    {
        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_control_task/index/';
        //查询总条数
        $arr = $this->m_control_task->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_control_task->select_allinfo($config['per_page'],$offect);

        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('control_task/Index',$data);
    }
    //添加
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('control_task/v_add');
    }
    //保存
    public function save()
    {
        if(isset($_POST['taskname']))
        {
            $data['id'] = 0;
            $data['number'] = $this->input->post("tasknumber");
            $data['name'] = $this->input->post("taskname");
            $data['score'] = $this -> input -> post('score',TRUE);
            $data['dateline'] = time();

            $res = $this->m_control_task->save_model($data);

            if($res)
            {
                echo '1';
            }else
                {
                    echo '0';
                }
         }
    }
    //编辑(打开编辑页面)
    public function edit($id)
    {
        //根据ID查询详细信息
        $data['data'] = $this->m_control_task->select_singleinfo($id);
        //var_dump($data['data']); exit;

        $this->load->view('public/header');
        $this->load->view('control_task/v_edit',$data);
    }
    //编辑处理
    public function edit_pro()
    {
        if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $data['number'] = $this->input->post("tasknumber");
            $data['name'] = $this->input->post("taskname");
            $data['score'] = $this ->input -> post('score',TRUE);

            $res = $this->m_control_task->update_model($id,$data);
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
        if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $res = $this->m_control_task->delete_model($id);
            if($res)
            {
                echo '1';
            }else
                {
                    echo '0';
                }
        }
    }
}