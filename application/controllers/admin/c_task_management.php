<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class c_task_management extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_task_management');
        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }
    //主页显示
    public function index()
    {
        //查询所有任务
        $data['data'] = $this->m_task_management->select_all_task();
        $this->load->view('public/header');
        $this->load->view('task_management/Index',$data);
    }
    //添加
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('task_management/v_add');
    }
    //保存
    public function  save()
    {
        if(isset($_POST['taskname']))
        {
            $data['id'] = 0;
            $data['task_name']= $this->input->post('taskname');
            $data['type'] = 1;
            $data['add_member'] = $_SESSION['accounts'];
            $data['add_time'] = time();
            $res = $this->m_task_management->add_model($data);
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
        $data['data'] = $this->m_task_management->select_task_model($id);
        $this->load->view('public/header');
        $this->load->view('task_management/v_edit',$data);
    }
    //编辑(处理)
    public function edit_pro()
    {
        if(isset($_POST['taskname']))
        {
            $id = $this->input->post('id');
            $data['task_name'] = $this->input->post('taskname');
            $res = $this->m_task_management->update_task($data,$id);
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
            $res = $this->m_task_management->delete_task($id);
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