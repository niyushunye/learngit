<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class c_publicize_work extends CI_Controller
{
    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_publicize_work');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }
    }

    //主页显示
    public function index()
    {
        //接受参数
        $ins = $this->input->get('score_month', TRUE);
        //分页配置
        $config['uri_segment'] = 4;
        $offect = $this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url() . '/admin/c_publicize_work/index/';
        //查询总条数
        $arr = $this->m_publicize_work->select_numbers_model($ins);
        $data['total'] = $arr;
        //var_dump($data);exit;
        $config['total_rows'] = $data['total'];

        $data['data'] = $this->m_publicize_work->select_all_info($config['per_page'], $offect, $ins);

        $this->pagination->initialize($config);
        $data['ins'] = $ins;
        //print_r($data);die();
        $this->load->view('public/header');
        $this->load->view('publicize_work/Index', $data);
    }

    //验证扣分分值是否符合要求
    public function validation()
    {
        $date['unit_num'] = trim($this->input->post('score_company'), ' ');     //扣分单位代码值
        $date['project'] = trim($this->input->post('score_month'), ' ');   //扣分项目
        $date['score'] = trim($this->input->post('score'), ' ');    //扣分分值

        $res = $this->m_publicize_work->validation_score($date['unit_num'], $date['project']);

        if ($res[$date['project']] > $date['score']) {
            $arr['guo'] = 1;
            echo json_encode($arr); //ok没问题
        } else {
            $arr['zhi'] = $res[$date['project']];
            $arr['guo'] = 2;   //有问题
            echo json_encode($arr);
        }
    }

    //新增
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('publicize_work/v_publicize_add');
    }

    //保存
    public function save()
    {
        $date['unit'] = trim($this->input->post('unit'), ' ');     //扣分单位
        $date['unit_num'] = trim($this->input->post('score_company'), ' ');     //扣分单位代码值
        $date['project'] = trim($this->input->post('score_month'), ' ');   //扣分项目
        $date['score'] = trim($this->input->post('score'), ' ');    //扣分分值
        $date['why'] = trim($this->input->post('why'), ' ');   //扣分原因
        $date['ins'] = trim($this->input->post('ins'));        //月份
        $date['time'] = time();
        $date['type'] = 1;    //1代表扣分
        $date['classification'] = 1;  //1：代表宣传工作月考核评分
        $res = $this->m_publicize_work->add_points($date);  //扣分记录

        $info = $this->m_publicize_work->points_upload($date['unit_num'], $date['score'], $date['project']);

        if ($res && $info) {
            echo 1;   //ok 没问题
        } else {
            echo 2;   //不对  有问题
        }
    }

    //编辑(打开的编辑页面)
    public function edit($xh)
    {

        $data = $this->m_publicize_work->select_edit_publicize($xh);

        $this->load->view('public/header');
        $this->load->view('publicize_work/v_publicize_edit', $data);
    }

    //编辑(处理)
    public function score_edit()
    {
        $id = $this->input->post('id');
        $date['score_1'] = trim($this->input->post('score_1'), ' ');
        $date['score_2'] = trim($this->input->post('score_2'), ' ');
        $date['score_3'] = trim($this->input->post('score_3'), ' ');
        $date['score_4'] = trim($this->input->post('score_4'), ' ');
        $date['score_5'] = trim($this->input->post('score_5'), ' ');
        $date['score_6'] = trim($this->input->post('score_6'), ' ');
        $date['score_7'] = trim($this->input->post('score_7'), ' ');
        $date['score_8'] = trim($this->input->post('score_8'), ' ');
        $date['score_9'] = trim($this->input->post('score_9'), ' ');
        $date['score_10'] = trim($this->input->post('score_10'), ' ');
        $date['score_11'] = trim($this->input->post('score_11'), ' ');
        $date['score_12'] = trim($this->input->post('score_12'), ' ');
        $date['score_company'] = $this->input->post('score_company');
        $date['score_month'] = $this->input->post('score_month');
        $date['dateline'] = time();
        $publicize_work_edit = $this->m_publicize_work->update_model($id, $date);

        if ($publicize_work_edit) {
            echo 1;
        } else {
            echo 0;
        }
    }

    //删除
    public function delete()
    {
        $id = $this->input->post('did');   //接受页面提交的艾迪

        $res = $this->m_publicize_work->select_edit_publicize($id);  //查询数据库有无此数据

        if ($res) {      //判断数据库里有无此数据
            $this->m_publicize_work->delete_publicize($id);     //删除此数据
            if ($res['ins'] == date('Y-m')) {             //判断删除这条数据的时间是否为当前时间
                if ($res['type'] == 1) {
                    $this->m_publicize_work->points_upload1($res['unit_num'], $res['score'], $res['project']);
                } else {
                    $this->m_publicize_work->points_upload($res['unit_num'], $res['score'], $res['project']);
                }
            }
            echo 1;   //删除成功
        } else {
            echo 0;  //删除失败
        }
    }

    //加分项目
    public function points()
    {
        $this->load->view('public/header');
        $this->load->view('publicize_work/v_points');
    }

    //验证加分分值是否符合要求
    public function validation_points()
    {
        $date['unit_num'] = trim($this->input->post('score_company'), ' ');     //扣分单位代码值
        $date['project'] = 'score_7';   //扣分项目
        $date['score'] = trim($this->input->post('score'), ' ');    //扣分分值

        //查询出数据库的加分项
        $res = $this->m_publicize_work->validation_score($date['unit_num'], $date['project']);
        $arr = $res['score_7'] + $date['score'];
        if ($arr <= 10) {
            $arr1['guo'] = 1;
            echo json_encode($arr1);  //OK没问题
        } else {
            $arr1['guo'] = 2;
            $arr1['zhi'] = 10 - $res['score_7'];
            echo json_encode($arr1);  //不对 有问题
        }
    }

    //执行加分方法
    public function points_save()
    {
        $date['unit'] = trim($this->input->post('unit'), ' ');     //扣分单位
        $date['unit_num'] = trim($this->input->post('score_company'), ' ');     //扣分单位代码值
        $date['project'] = 'score_7';
        $date['score'] = trim($this->input->post('score'), ' ');    //扣分分值
        $date['why'] = trim($this->input->post('why'), ' ');   //扣分原因
        $date['ins'] = trim($this->input->post('ins'));        //月份
        $date['time'] = time();
        $date['type'] = 2;    //2代表加分
        $date['classification'] = 1;  //1：代表宣传工作月考核评分
        $res = $this->m_publicize_work->add_points($date);  //扣分记录

        $info = $this->m_publicize_work->points_upload1($date['unit_num'], $date['score'], $date['project']);

        if ($res && $info) {
            echo 1;   //ok 没问题
        } else {
            echo 2;   //不对  有问题
        }
    }
}