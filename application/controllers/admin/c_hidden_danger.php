<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class c_hidden_danger extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_hidden_danger');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }
    //主页显示
    public function index()
    {
        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_hidden_danger/index/';
        //查询总条数
        $arr = $this->m_hidden_danger->select_numbers_model();
        $data['total'] = $arr[0]['total'];
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_hidden_danger->select_all_info( $config['per_page'],$offect);
        $this->pagination->initialize($config);
        $this->load->view('public/header');
        $this->load->view('hidden_danger/Index',$data);
    }
    //新增
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('hidden_danger/v_add');
    }
    //保存
    public function save()
    {
        if(isset($_POST['htime']))
        {
            $data['id'] = 0 ;
            $data['htime'] = $this->input->post("htime");
            $data['jnzd']  = $this->input->post("jnzd");
            $data['jbzd']  = $this->input->post("jbzd");
            $data['xlzd']  = $this->input->post('xlzd');
            $data['ztzd']  = $this->input->post('ztzd');
            $data['yhzd']  = $this->input->post('yhzd');
            $data['dhzd']  = $this->input->post('dhzd');
            $data['tbzd']  = $this->input->post('tbzd');
            $data['hszd']  = $this->input->post('hszd');
            $data['zdzd']  = $this->input->post('zdzd');
            $data['dateline'] = time();
            $res = $this->m_hidden_danger->save_model($data);
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
        $data['data'] = $this->m_hidden_danger->select_single_info($id);
        $this->load->view('public/header');
        $this->load->view('hidden_danger/v_edit',$data);
    }
    //编辑(处理)
    public function edit_pro()
    {
        if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
           // echo $id;exit;
            $data['htime'] = $this->input->post("htime");
            $data['jnzd']  = $this->input->post("jnzd");
            $data['jbzd']  = $this->input->post("jbzd");
            $data['xlzd']  = $this->input->post('xlzd');
            $data['ztzd']  = $this->input->post('ztzd');
            $data['yhzd']  = $this->input->post('yhzd');
            $data['dhzd']  = $this->input->post('dhzd');
            $data['tbzd']  = $this->input->post('tbzd');
            $data['hszd']  = $this->input->post('hszd');
            $data['zdzd']  = $this->input->post('zdzd');
            $res = $this->m_hidden_danger->update_model($id,$data);
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
            $res = $this->m_hidden_danger->delete_model($id);
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