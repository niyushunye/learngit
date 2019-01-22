<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_announcement extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');
        $this->load->model('API/api_1_1_0/m_announcement');

        //获取文件根目录路径
        define('ROOT_PATHS', $this->config->item('root_path'));
    }

    //公告通知api
    public function the_list(){
        $data = $this -> m_announcement -> select_result();
        if(!empty($data)){
            resjson(100,'获取成功',$data);
        }else{
            resjson(102,'获取失败');
        }
    }
    //公告通知详情页
    public function row_view($id){
        $res = $this -> m_announcement -> view_row($id);
        $this -> load -> view('public/header');
        $this -> load -> view('announcement/V_index_view',$res);
    }


    //考核任务下发api
    public function issued(){
        $data = $this -> m_announcement -> issued_select();
        if(!empty($data)){
            resjson(100,'获取成功',$data);
        }else{
            resjson(102,'获取失败');
        }
    }

    //考核信息详情
    public function issued_view($id){
        $res = $this -> m_announcement -> issued_row($id);
        $this -> load -> view('public/header');
        $this -> load -> view('issued/V_index_view_api',$res);
    }

    //考核任务日志  只能查看个人的
    public function work_log(){
        $accounts = $this -> input -> get_post('accounts');
        if(empty($accounts)){
            resjson(103,'参数不完整');
        }

        $data = $this -> m_announcement -> work_log_select($accounts);

        if($data){
            resjson(100,'获取成功',$data);
        }else{
            resjson(102,'暂无日志');
        }
    }

    //详情页面
    public function work_log_view($id){
        $res = $this -> m_announcement -> work_log_row($id);
        $this -> load -> view('public/header');
        $this -> load -> view('job_log/V_index_view_api',$res);
    }


    //考核任务日志提交接口
    public function work_log_add(){

        $work_completion = $this->input->get_post('work_completion');   //工作完成情况

        $work_fault = $this->input->get_post('work_fault');        //工作失误情况

        $learning_progress = $this->input->get_post('learning_progress');   //学习培训情况

        $attendance = $this->input->get_post('attendance');        //出勤情况

        $log_type = $this->input->get_post('log_type');   //日志类型

        $log_time = $this->input->get_post('log_time');   //工作日志时间

        $imagenum = $this->input->get_post('imagenum');    //图片数量

        $accounts = $this->input->get_post('accounts');        //添加民警编号

        $realname = $this->input->get_post('realname');   //添加民警姓名

        $orgingo = $this->input->get_post('orgingo');   //民警部门编码

        if(empty($log_type) || empty($log_time) || empty($accounts) || empty($realname) || empty($orgingo)){
            resjson(103,'参数不完整');
        }
        $pic = "" ;
        if (empty($imagenum)){
            $imagenum = 0;
        }
        for($i = 1; $i <= $imagenum; $i++){

            if($_FILES['image_'.$i]['error'] <= 0){
                //获取文件名称
                $filename = $_FILES['image_'.$i]['name'];
                //获取文件扩展名
                $ext = substr($filename,strrpos($filename,".")+1);
                //拼写图片前缀
                $presix = date("Ymds").mt_rand(10000,99999);
                //重新命名上传文件
                $filename = $presix.".".$ext;

                $fileName = "assets/uploads/investigation_car_image1/".$filename;

                $pic.= $fileName."+";
                //获取临时文件
                $tmpfile = $_FILES['image_'.$i]['tmp_name'];
                //目标存储文件路径
                $filename_path = ROOT_PATHS."assets/uploads/investigation_car_image1/";
                //上传文件到指定路劲
                move_uploaded_file($tmpfile, $filename_path.$filename);
            }

        }

        $data = array(
            'work_completion' => $work_completion,       //工作完成情况
            'work_fault' => $work_fault,                 //工作失误情况
            'learning_progress' => $learning_progress,   //学习情况
            'attendance' => $attendance,                 //出勤情况
            'log_type' => $log_type,                     //日志类型
            'log_time' => $log_time,                     //工作日志时间
            'accounts' => $accounts,                     //照片可写入三张
            'realname' => $realname,                     //警员编号
            'work_pic' => $pic,                          //警员姓名
            'create_time' => time(),                      //创建时间
            'orginfo' => $orgingo                        //部门代码
        );

        $res = $this -> m_announcement -> add_work_log($data);
        if($res){
            resjson(100,'提交成功');
        }else{
            resjson(102,'提交失败');
        }
    }

}















































