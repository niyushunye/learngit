<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_xingzhengqh extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin/M_xingzheng');

        if (session_login()) {
            //判断session是否存在，如果存在，继续执行程序；如果不存在，跳回登录界面
            redirect('c_login/overdue');
        }

    }

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
            'url' => base_url().'admin/c_xingzhengqh/filelist/'.$data['quhua'][0]['number'],
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
                    'url' => base_url().'admin/c_xingzhengqh/filelist/'.$value1['number'],
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
            $this->load->view("xingzhengqh/V_index",$data);
        }
//        print_r($data);exit();
    }

    public function filelist($orgnum){
//        $data['orginfo'] = $this->M_xingzheng->get_orginfo($orgnum);

        //print_r($data['orginfo']);die();
        //第一次程序运行时候，orgnum为对应的部门代码；第二次运行，orgnum输出为页码。
        if($orgnum > 1000){

            $data['orgname'] = $this->M_xingzheng->get_orgname($orgnum);

            if($data['orgname'][0]['number'] == ''){
                $orgnum = array();
            }else{
                $orgnum = $data['orgname'][0]['number'];
            }
            $curpage = CURPAGE;
            $num = BIG_NUM;
            $config['uri_segment'] = 3;

        } else{
            $orgnum = $this->uri->segment(5);
            $curpage = $this->uri->segment(4,0);
            $num = BIG_NUM;
            $config['uri_segment'] = 4;
            $config['first_url'] =  base_url() . '/admin/c_xingzhengqh/filelist/0/'."/"."$orgnum";

        }


        $data['orginfo'] = $this->M_xingzheng->get_orgname_paging1($orgnum,$curpage,$num);
        $data['orgnum'] = $data['orginfo']['0']['number'];
        $data['total'] = $this->M_xingzheng->get_orgname_total($orgnum);


        $config['per_page'] = $num;
        $config['base_url'] = base_url().'/admin/c_xingzhengqh/filelist/';
        $config['suffix'] = "/"."$orgnum" ;                                                      //给链接地址加后缀  http://localhost/ci/控制器/方法名/参数

        $config['total_rows'] = $data['total'];
        $this->pagination->initialize($config);
        $data['shortname'] = $data['orginfo']['0']['type'];
        //print_r($data['orginfo']);die();
        $this->load->view('public/header');
        $this->load->view("xingzhengqh/V_xingzheng_filelist",$data);
    }

    //添加行政区划页面
    public function add(){
        $id = $this -> input -> get('id',TRUE);
        $sj = $this -> M_xingzheng -> xiangzheng_sj($id);
        $this->load->view('public/header');
        $this -> load ->view('xingzhengqh/V_xingzhengqh_add',$sj);
    }

    //添加行政区划
    public function add_save(){
        $data['name'] = $this -> input -> post('name',TRUE);   //行政区划名称
        $data['parent_name'] = $this -> input -> post('parent_name',TRUE);    //上级名称
        $data['type'] = $this -> input -> post('type',TRUE);        //行政区域类型
        $data['status'] = $this -> input -> post('status',TRUE);     //行政区域状态
        $data['number'] = $this -> input -> post('number',TRUE);    //行政区域编码
        $data['memo'] = $this -> input -> post('memo',TRUE);      //行政区域备注
        $data['parent_number'] = $this -> input -> post('parent_number',TRUE);    //上级编码
        $data['create_author'] = $_SESSION['realname'];                                     //创建人
        $data['create_time '] = time();          //创建时间

        //print_r($data);die();

        $info = $this -> M_xingzheng -> select_row($data['number']);

        if($info){
            echo 3;  //编码有重复
        }else{
            $res = $this -> M_xingzheng -> add($data);
            if($res){
                echo 1;   //添加成功
            }else{
                echo 2; //添加失败
            }
        }
    }

    //编辑
    public function edit(){

        $id = $this -> input -> get('id',TRUE);
        $qh = $this -> M_xingzheng -> select_dg($id);
        $this->load->view('public/header');
        $this -> load -> view('xingzhengqh/V_index_edit',$qh);
    }

    //修改更新
    public function upload(){
        $id = $this -> input -> post('id',TRUE);   //行政区域的id
        $number1 = $this -> input -> post('number1',TRUE);
        $data1['dept_name'] = $data['name'] = $this -> input -> post('name',TRUE);   //名称
        $data['status'] = $this -> input -> post('status',TRUE);   //状态
        $data['memo'] = $this -> input -> post('memo',TRUE);   //备注
        $data['change_time'] = time();
        $data4['xzqh'] = $data3['parent_number'] = $data['number'] = $number = $this -> input -> post('number',TRUE);

        $info = $this -> M_xingzheng -> select_gb($number1);   //查询此行政区划下面有无安全责任干部

        $xj = $this -> M_xingzheng -> select_xj($number1);   //查询该行政区划编码下有无下级编码  有的话更新

//        $wxdl = $this -> M_xingzheng -> select_wxdl($number1);   //查询危险道路表中有无此编码

        if($xj){
            $this -> M_xingzheng -> upload_number($number1,$data3);   //更新下级编码
        }
//        if($wxdl){
//            $this -> M_xingzheng -> upload_wxdl($number1,$data4);    //更新危险路段
//        }
        if($info){
             $this -> M_xingzheng -> upload_gb($number,$data1);        //同步更新安全责任干部的行政区划名称
        }
        $res = $this -> M_xingzheng -> upload($id,$data);

        if($res){
            echo 1;  //修改成功
        }else{
            echo 2;   //修改失败
        }
    }

    //删除
    public function delete(){
        $id = $this -> input -> post('id',TRUE);
        $qh = $this -> M_xingzheng -> select_dg($id);    //查询被删除的行政区化信息详情
        $xj = $this -> M_xingzheng -> select_xj($qh['number']);   //查询被删除的行政区划有无下级

        $aq = $this -> M_xingzheng -> select_aq($qh['number']);    //查询被删除的行政区划下有无安全责任干部

        if($aq){
            echo 4;   //此行政区划下有安全责任干部  您不能删除
        }else{
            if($xj){
                echo 3;  //对不起，该行政区化下有下级行政区划 您不能删除
            }else{
                $res = $this -> M_xingzheng -> delect($id);
                if($res){
                    echo 1; //删除成功
                }else{
                    echo 2;  //删除失败
                }
            }
        }
    }

}