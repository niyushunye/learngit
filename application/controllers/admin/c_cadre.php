<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_cadre extends CI_Controller{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/m_cadre');
        $this -> load -> model('admin/M_xingzheng');
        $this->load->library('pagination');

        if(session_login()){
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

    //显示左侧行政区划
    public function index(){
        //获取行政区划名称
        $data['quhua'] = $this->M_xingzheng->get_qhname();

        //print_r($data['quhua']);die();
        $data['glbm'] = $this->M_xingzheng->get_spuer();
        //print_r($data['glbm']);
        // exit();
        $arr = array(
            'id' => $data['quhua'][0]['number'],
            'pId' => 0,
            'name' => $data['quhua'][0]['name'],
//                'isParent' => true
            //点击时指向读取功能
            'url' => base_url().'admin/c_cadre/filelist/'.$data['quhua'][0]['number'],
            'target' => "iframe1",
            "open" =>"true"
        );
        $data['result'][] = $arr;

        foreach($data['glbm'] as $value)
        {
            $orgnum = $value['number'];
            $data['zbm'] = $this->M_xingzheng->get_super1($orgnum);
            foreach($data['zbm'] as $value1){
                $arr1 = array(
                    'id' => $value1['number'],
                    'pId' => $value['number'],
                    'name' => $value1['name'],
//                    'isParent' => true
                    //点击时指向读取功能
                    'url' => base_url().'admin/c_cadre/filelist/'.$value1['number'],
                    'target' => "iframe1"
                );
                $data['result'][] = $arr1;
            }
        }
        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum;
            $this->filelist(XINGZQH);
        }else{
            $this->load->view("cadre/V_index",$data);
        }
//        print_r($data);exit();
    }

    //显示右侧责任干部
    public function filelist($orgnum){

        $db_mysql = $this->load->database('default',TRUE);
        $data['orgnum'] = $orgnum;
        $data['rybh'] = "";
        $data['type'] = "0";

//        echo $orgnum;
        //第一次程序运行时候，orgnum为对应的部门代码；第二次运行，orgnum输出为页码。
        if($orgnum > 1000){
            $sql_getOrgname = $db_mysql->query("SELECT * FROM `bas_xzqh` WHERE `number` = '{$orgnum}'");
            $data['orgname'] = $sql_getOrgname->result_array();
            $orgnum = $data['orgname'][0]['number'];

            $curpage = CURPAGE;
            $num = BIG_NUM;
            $config['uri_segment'] = 3;

        } else{
            $orgnum = $this->uri->segment(5);
            $curpage = $this->uri->segment(4,0);
            $num = BIG_NUM;
            $config['uri_segment'] = 4;
            $config['first_url'] =  base_url() . '/admin/c_cadre/filelist/0/'."/"."$orgnum";
        }

        $result = $db_mysql->query("SELECT * FROM bas_assist 
                                    -- LEFT JOIN orginfo ON orginfo.orgnum = memberinfo.orgnum  
                                    WHERE  bas_assist.dept_number = '{$orgnum}'
                                    ORDER BY bas_assist.id DESC
                                    LIMIT $curpage, $num");
        $data['memberinfo'] = $result->result_array();

        $result = $db_mysql->query("SELECT * FROM bas_assist WHERE dept_number = '$orgnum'");
        $data['total'] = $result->num_rows();



        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_cadre/filelist/';
        $config['suffix'] = "/"."$orgnum" ;                                                      //给链接地址加后缀  http://localhost/ci/控制器/方法名/参数

        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);

        // print_r($data);exit;
        $this->load->view('public/header');
        $this->load->view("cadre/V_index_ganbu",$data);
    }

    //添加责任干部
    public function add(){
        $number = $this -> input -> get('number',TRUE);
        $qh = $this -> m_cadre -> row_qh($number);
        $this->load->view('public/header');
        $this -> load -> view('cadre/V_index_add.php',$qh);
    }
    public function up_img(){

        $month = date('Ym',time());
        //define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
        $dir = "uploads/".$month."/";
        $arr = array(
            'code' => 0,
            'msg'=> '',
            'data' =>array(
                'src' => $dir . $_FILES["file"]["name"]
            ),
        );

        $file_info = $_FILES['file'];
        $file_error = $file_info['error'];
        if(!is_dir($dir))//判断目录是否存在
        {
            mkdir ($dir,0777,true);//如果目录不存在则创建目录
        };

        if($file_error == 0){
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$dir. $_FILES["file"]["name"])){
                $arr['msg'] ="上传成功";
            }else{
                $arr['msg'] = "上传失败";
            }
        }else{
            switch($file_error){
                case 1:
                    $arr['msg'] ='上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                    break;
                case 2:
                    $arr['msg'] ='超过了表单max_file_size限制的大小';
                    break;
                case 3:
                    $arr['msg'] ='文件部分被上传';
                    break;
                case 4:
                    $arr['msg'] ='没有选择上传文件';
                    break;
                case 6:
                    $arr['msg'] ='没有找到临时文件';
                    break;
                case 7:
                case 8:
                    $arr['msg'] = '系统错误';
                    break;
            }
        }
        echo json_encode($arr);

    }

    //添加到数据库
    public function ins(){
        $rybh = $data['rybh'] = $_POST['rybh'];   //人员编号
        $data['dept_name'] = $this -> input -> post('dept_name',TRUE);          //行政区划名称
        $data['dept_number'] = $this -> input -> post('dept_number',TRUE);      //行政区化编码
        $data['name'] = $this -> input -> post('name',TRUE);                    //安全责任干部名称
        $data['position'] = $this -> input -> post('zhuwu',TRUE);            //职务
        $data['position_desc'] = $this -> input -> post('position_desc',TRUE);  //职务描述
        $data['sex'] = $this -> input -> post('sex',TRUE);                      //性别
        $data['phone_number'] = $this -> input -> post('phone_number',TRUE);    //手机号码
        $data['photo'] = $this -> input -> post('shangchuan',TRUE);                  //安全责任干部照片
        $data['address'] = $this -> input -> post('address',TRUE);              //联系地址
        $data['memo'] = $this -> input -> post('memo',TRUE);                    //备注
        $data['entry_time'] = $this -> input -> post('entry_time',TRUE);        //入职时间
        $data['create_time'] = time();                                           //创建时间

        $res1 = $this ->m_cadre -> select_chongfu($rybh);     //判断人员编号是否重复

        if($res1){
            echo 3;
        }else{
            $res = $this -> m_cadre -> add($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    //修改安全责任干部
    public function edit(){
        $id = $this -> input -> get('id',TRUE);
        $data = $this ->m_cadre -> select_y($id);   //根据id查询当前的安全责任干部
        $this -> load -> view('public/header');
        $this -> load -> view('cadre/V_index_edit',$data);
    }

    //修改更新数据
    public function upload(){

        $id = $this -> input -> post('id',TRUE);   //id
        $rybh = $data['rybh'] = $_POST['rybh'];   //人员编号     //人员编号
        $data['name'] = $this -> input -> post('name',TRUE);                    //安全责任干部名称
        $data['position'] = $this -> input -> post('zhuwu',TRUE);            //职务
        $data['position_desc'] = $this -> input -> post('position_desc',TRUE);  //职务描述
        $data['sex'] = $this -> input -> post('sex',TRUE);                      //性别
        $data['phone_number'] = $this -> input -> post('phone_number',TRUE);    //手机号码
        $data['photo'] = $this -> input -> post('shangchuan',TRUE);                  //安全责任干部照片
        $data['address'] = $this -> input -> post('address',TRUE);              //联系地址
        $data['memo'] = $this -> input -> post('memo',TRUE);                    //备注
        $data['entry_time'] = $this -> input -> post('entry_time',TRUE);        //入职时间
        $res1 = $this ->m_cadre -> select_chongfu($rybh);     //判断人员编号是否重复

        if($res1){
            echo 3;   //输入的人员编号有无
        }else{
            $res = $this -> m_cadre -> upload_up($id,$data);
            if($res){
                echo 1; //修改成功返回1
            }else{
                echo 2; //修改失败返回2
            }
        }
    }

    //删除
    public function delete(){
        $id = $this -> input -> post('id',TRUE);
        $res = $this -> m_cadre -> delete($id);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //判断包村民警的人员编号是否合法
    public function rybh(){
        $rybh = $this -> input -> post('rybh',TRUE);

        $res = $this -> m_cadre -> rybh($rybh);
        if($res){
            $res1 = $this ->m_cadre -> select_chongfu($rybh);   //判断人员编号是否重复
            if($res1){
                echo 3;   //人员编号重复请重新输入
            }else{
                echo 1;   //人员编号合法
            }
        }else{
            echo 2;  //人员编号不合法
        }
    }


    //带条件查询
    public function suosou(){
        $position = $this -> input -> post('type',TRUE);
        $rybh = $this -> input -> post('rybh',TRUE);
        $data['memberinfo'] = $this -> m_cadre -> where_select_sousuo($position,$rybh);
        $data['total'] = $this -> m_cadre -> where_select_count($position,$rybh);
        $data['rybh'] = $rybh;
        $data['type'] = $position;
        $this->load->view('public/header');
        $this->load->view("cadre/V_index_ganbu",$data);
    }


}