<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_pavement_control extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_pavement_control');

        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }
    

    /**
         * @api {post} /a_pavement_control/select_task_class/ 1任务类型列表
         * @apiVersion 0.1.0
         * @apiName select_task_class
         * @apiGroup a_pavement_control
         * @apiDescription 获取任务类型列表
         * @apiSuccess {number}   code                  返回码
         * @apiSuccess {string}   message               返回信息
         * @apiSuccess {json}     result                正确的结果
         * @apiErrorExample Response (example):
         *     返回示例
         *     {
         *       "code": "100"
         *       "message": "未知错误"
         *       "result": "json"
         *     }
         */
        
    public function select_task_class()
    {
        $data = $this->m_pavement_control->select_task_class_model();

        if($data){
            resjson(103,'获取任务类型成功',$data);
        }else{
            resjson(102,'获取任务类型失败');
        }
    }


    /**
         * @api {post} /a_pavement_control/submit_pavement_control/ 2路面防控任务反馈
         * @apiVersion 0.1.0
         * @apiName submit_pavement_control
         * @apiGroup a_pavement_control
         * @apiParam {string} hphm    号牌号码
         * @apiParam {string} hpzl    号牌种类
         * @apiParam {string} rwlx    任务类型(违法代码)
         * @apiParam {string} ywzl    业务种类,1代表非现场,2代表简易程序,3代表强制措施
         * @apiParam {string} bh      任务类型对应的编号
         * @apiParam {string} czsj    处置时间
         * @apiParam {string} czjg    处置结果
         * @apiParam {int} imagenum   图片数量
         * @apiParam {file} image_ 图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)
         * @apiParam {string} jybh    警员编号
         * @apiParam {string} czr     处置民警
         * @apiParam {string} bmdm    部门代码
         * @apiParam {string} bmmc    部门名称
         * @apiDescription 路面防控任务反馈
         * @apiSuccess {number}   code                  返回码
         * @apiSuccess {string}   message               返回信息
         * @apiSuccess {json}     result                正确的结果
         * @apiErrorExample Response (example):
         *     返回示例
         *     {
         *       "code": "100"
         *       "message": "未知错误"
         *       "result": "json"
         *     }
         */
    public function submit_pavement_control(){
        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //任务类型(违法代码)
        $rwlx = $this->input->get_post('rwlx');
        //业务种类
        $ywzl = $this->input->get_post('ywzl');
        //编号
        $bh = $this->input->get_post('bh');
        //处置时间
        $czsj = $this->input->get_post('czsj');
        //处置结果
        $czjg = $this->input->get_post('czjg');
        //停车场名称
        $tccmc = $this->input->get_post('tccmc');
        //停车场地址
        $tccdz = $this->input->get_post('tccdz');
        //图片数量
        $imagenum = $this->input->get_post('imagenum');
        //警员编号
        $jybh = $this->input->get_post('jybh');
        //处置民警
        $czr = $this->input->get_post('czr');
        //部门代码
        $bmdm = $this->input->get_post('bmdm');
        //部门名称
        $bmmc = $this->input->get_post('bmmc');


        //$fxcbj= $this->input->post('fxcbj');            //是否非现场

        /*=========================================================================================================*/
        if(empty($hphm) || empty($hpzl) || empty($rwlx) || empty($ywzl) || empty($bh) || empty($bmdm) || empty($bmmc) || empty($czr)){
            resjson(100,'参数不完整');
        }

        //检查违法代码是否有效
        $rwlx_arrs = $this->m_pavement_control->select_task_class_model();
        $num = count($rwlx_arrs);
        $arr = array();
        for($i=0;$i<$num;$i++){
            array_push($arr, $rwlx_arrs[$i]['number']);
        }
        

        if(!in_array($rwlx, $arr)){
             resjson(100,'违法代码错误');
        }

        //图片的路劲
        $pic = "" ;
        if (empty($imagenum)){
            $imagenum = 0;
        }
        //处理上传的图片
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

        if($pic != '' ){
          $pic = substr($pic, 0,-1);
        }

        $data = array(
                'hphm' => $hphm,
                'hpzl' => $hpzl,
                'rwlx' => $rwlx,
                'ywzl' => $ywzl,
                'bh'   => $bh,
                'czsj' => $czsj,
                'czjg' => $czjg,
                'pic' => $pic,
                'jybh' => $jybh,
                'czr'  => $czr,
                'bmdm' => $bmdm,
                'bmmc' => $bmmc,
                'dateline' => time(),
            );

        $this->m_pavement_control->insert_pavement_control_model($data);

        resjson(103,'反馈成功');

    }

}