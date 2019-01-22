<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_legal_work extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/m_legal_work');
        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    //主页显示
    public function index()
    {

        $ins = $this -> input -> get('score_month',TRUE);    //接受参数
        //分页配置
        $config['uri_segment'] = 4;
        $offect =$this->uri->segment(4);
        // var_dump($offect);
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'/admin/c_legal_work/index/';
        //查询总条数
        $arr = $this->m_legal_work->select_numbers_model($ins);
        $data['total'] = $arr;
        $config['total_rows'] = $data['total'];
        $data['data'] = $this->m_legal_work->select_all_info($config['per_page'],$offect,$ins);
        $this->pagination->initialize($config);
        $data['ins'] = $ins;
        $this->load->view('public/header');
        $this->load->view('legal_work/Index',$data);
    }


    //验证扣分分值是否符合要求
    public function validation(){
        $date['unit_num'] = trim($this->input->post('score_company'),' ');     //扣分单位代码值
        $date['project'] = trim($this->input->post('score_month'),' ');   //扣分项目
        $date['score'] = trim($this->input->post('score'),' ');    //扣分分值

        $res = $this -> m_legal_work -> validation_score($date['unit_num'],$date['project']);   //查询出数据库这一扣分项目的现有分值 扣除的分值不能大于这个值

        if($res[$date['project']] > $date['score']){     //如果扣得分值小于数据库里查出来的分值  就没有问题
            $arr['guo'] = 1;
            echo json_encode($arr); //ok没问题
        }else{                                  //如果扣得分值大于数据库查出来的分值   就不让扣分
            $arr['zhi'] = $res[$date['project']];
            $arr['guo'] = 2;   //有问题
            echo json_encode($arr);
        }
    }
    
    //新增
    public function add()
    {
        $this->load->view('public/header');
        $this->load->view('legal_work/v_legal_add');
    }

    
    //保存
    public function score_save()
    {
        $date['unit'] = trim($this->input->post('unit'),' ');     //扣分单位
        $date['unit_num'] = trim($this->input->post('score_company'),' ');     //扣分单位代码值
        $date['project'] = trim($this->input->post('score_month'),' ');   //扣分项目
        $date['score'] = trim($this->input->post('score'),' ');    //扣分分值
        $date['why'] = trim($this->input->post('why'),' ');   //扣分原因
        $date['ins'] = trim($this -> input -> post('ins'));        //月份
        $date['time'] = time();
        $date['type'] = 1;    //1代表扣分
        $date['classification'] = 3;  //1：代表法制工作月考核评分
        $res = $this -> m_legal_work -> add_points($date);  //把扣分的记录新增到数据库

        //扣分记录新增到数据库 之后执扣分方法  在数据库减去这一项的扣除的分值
        $info = $this -> m_legal_work -> points_upload($date['unit_num'],$date['score'],$date['project']);

        if($res && $info){    //如果新增扣分记录和扣分方法都执行成功   就返回1
            echo 1;   //ok 没问题
        }else{              //如果两个都没有执行成功  或者 其中有一个没有执行成功   就返回 2
            echo 2;   //不对  有问题
        }
    }

   //删除
    public function delete()           //删除方法
    {
        $id = $this->input->post('did');    //接受页面传递的id

        $res = $this->m_legal_work->select_edit_publicize($id);  //在数据库中查询有无这条记录

        if($res){

            $this->m_legal_work->delete_publicize($id);
            if($res['ins'] == date('Y-m')){
                if($res['type'] == 1){
                    $this -> m_legal_work -> points_upload1($res['unit_num'],$res['score'],$res['project']);
                }else{
                    $this -> m_legal_work -> points_upload($res['unit_num'],$res['score'],$res['project']);
                }
            }
            echo 1;   //删除成功
        }else{
            echo 0;  //删除失败
        }
    }


    //加分项目
    public function points(){
        $this->load->view('public/header');
        $this -> load -> view('legal_work/v_points');
    }

    //验证加分分值是否符合要求
    public function validation_points(){
        $date['unit_num'] = trim($this->input->post('score_company'),' ');     //扣分单位代码值
        $date['project'] = 'score_7';   //扣分项目
        $date['score'] = trim($this->input->post('score'),' ');    //扣分分值

        //查询出数据库的加分项
        $res = $this -> m_legal_work -> validation_score($date['unit_num'],$date['project']);

        $arr = $res['score_7'] + $date['score'];
        if($arr <= 10){

            $arr1['guo'] = 1;
            echo json_encode($arr1);  //OK没问题
        }else{
            $arr1['guo'] = 2;
            $arr1['zhi'] = 10 - $res['score_7'];
            echo json_encode($arr1);  //不对 有问题
        }
    }

    //执行加分
    public function points_save(){
        $date['unit'] = trim($this->input->post('unit'),' ');     //扣分单位
        $date['unit_num'] = trim($this->input->post('score_company'),' ');     //扣分单位代码值
        $date['project'] = 'score_7';
        $date['score'] = trim($this->input->post('score'),' ');    //扣分分值
        $date['why'] = trim($this->input->post('why'),' ');   //扣分原因
        $date['ins'] = trim($this -> input -> post('ins'));        //月份
        $date['time'] = time();
        $date['type'] = 2;    //2代表加分
        $date['classification'] = 3;  //1：代表宣传工作月考核评分
        $res = $this -> m_legal_work -> add_points($date);  //扣分记录

        $info = $this -> m_legal_work -> points_upload1($date['unit_num'],$date['score'],$date['project']);

        if($res && $info){
            echo 1;   //ok 没问题
        }else{
            echo 2;   //不对  有问题
        }
    }


}