<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_monthly_task_assessment extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_month_task_assessment');

        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }

    /**
         * @api {post} /a_monthly_task_assessment/view_task_assessment/ 1应检/隐患列表
         * @apiVersion 0.1.0
         * @apiName view_task_assessment
         * @apiGroup a_monthly_task_assessment
         * @apiParam {int} accounts  警员编号
         * @apiParam {int} type      类型,1代表隐患,2代表应检
         * @apiParam {number} num          分页传递的参数,例1代表第一页，2代表第二页
         * @apiDescription 应检/隐患列表
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
        
    public function view_task_assessment(){
        //获取警员编号
        $accounts = $this->input->get_post('accounts');
        //获取type类型值
        $type = $this->input->get_post('type');
         //获取页码值
        $num = $this->input->get_post("num");

        if(empty($accounts) || empty($type) || empty($num)){
            resjson(100,'参数不完整');
        }

        $data = $this->m_month_task_assessment->select_assessment_task($accounts,$type,$num);

        if($data){
            resjson(103,'获取成功',$data);
        }else{
            resjson(102,'暂无任务');
        }
  
    }

    /**
         * @api {post} /a_monthly_task_assessment/task_insert/ 2隐患,应检任务信息
         * @apiVersion 0.1.0
         * @apiName task_insert
         * @apiGroup a_monthly_task_assessment
         * @apiParam {int}  id         id值
         * @apiParam {string}  hphm    号牌号码
         * @apiParam {string}  hpzl    号牌种类
         * @apiParam {int}     ywlx    业务类型,1代表隐患,2代表应检,3代表五类
         * @apiParam {int}     sfch    是否查处,0代表否,1代表是
         * @apiParam {string}  wfcyy   未查处原因
         * @apiParam {string}  dsr     当事人
         * @apiParam {string}  sfzmhm  身份证名号码
         * @apiParam {int}     czsj     处置时间
         * @apiParam {string}  czjg     处置结果
         * @apiParam {int} imagenum   图片数量
         * @apiParam {file} image_ 图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)
         * @apiParam {string} jybh    警员编号
         * @apiParam {string} czr     处置民警
         * @apiParam {string} bmdm    部门代码
         * @apiParam {string} bmmc    部门名称
         * @apiDescription 获取任务信息
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
    public function task_insert(){

        //获取id
        $id = $this->input->get_post('id');

        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //业务类型
        $ywlx = $this->input->get_post('ywlx');
        //是否查处
        $sfch = $this->input->get_post('sfch');
        //未查处原因
        $wfcyy = $this->input->get_post('wfcyy');
        //当事人
        $dsr = $this->input->get_post('dsr');
        //身份证号码
        $sfzmhm = $this->input->get_post('sfzmhm');
        //处置时间
        $czsj = $this->input->get_post('czsj');
        //处置结果
        $czjg = $this->input->get_post('czjg');
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

        if(empty($hphm) || empty($hpzl) || empty($id)){
            resjson(100,'参数不完整');
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

                  $fileName = "assets/uploads/task_assessment_image/".$filename;

                  $pic.= $fileName."+";
                  //获取临时文件
                  $tmpfile = $_FILES['image_'.$i]['tmp_name']; 
                  //目标存储文件路径
                  $filename_path = ROOT_PATHS."assets/uploads/task_assessment_image/";
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
                'ywlx' => $ywlx,
                'sfch' => $sfch,
                'wfcyy' => $wfcyy,
                'dsr' => $dsr,
                'sfzmhm' => $sfzmhm,
                'czsj' => $czsj,
                'czjg' => $czjg,
                'pic' => $pic,
                'jybh' => $jybh,
                'czr'  => $czr,
                'bmdm' => $bmdm,
                'bmmc' => $bmmc,
            );


        $this->m_month_task_assessment->insert_select_assessment_task($data);

        $this->m_month_task_assessment->is_complete($id);


        resjson(103,'任务反馈成功');

    }

    /**
         * @api {post} /a_monthly_task_assessment/submit_five_types/ 3五类车检验任务
         * @apiVersion 0.1.0
         * @apiName submit_five_types
         * @apiGroup a_monthly_task_assessment
         * @apiParam {string}  hphm    号牌号码
         * @apiParam {string}  hpzl    号牌种类
         * @apiParam {int}     ywlx    业务类型
         * @apiParam {int}     sfch    是否查处,0代表否,1代表是
         * @apiParam {string}  wfcyy   未查处原因
         * @apiParam {string}  dsr     当事人
         * @apiParam {string}  sfzmhm  身份证名号码
         * @apiParam {int}     czsj     处置时间
         * @apiParam {string}  czjg     处置结果
         * @apiParam {int} imagenum   图片数量
         * @apiParam {file} image_ 图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)
         * @apiParam {string} jybh    警员编号
         * @apiParam {string} czr     处置民警
         * @apiParam {string} bmdm    部门代码
         * @apiParam {string} bmmc    部门名称
         * @apiDescription 获取任务信息
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
    public function submit_five_types(){
        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //业务类型
        $ywlx = $this->input->get_post('ywlx');
        //是否查处
        $sfch = $this->input->get_post('sfch');
        //未查处原因
        $wfcyy = $this->input->get_post('wfcyy');
        //当事人
        $dsr = $this->input->get_post('dsr');
        //身份证号码
        $sfzmhm = $this->input->get_post('sfzmhm');
        //处置时间
        $czsj = $this->input->get_post('czsj');
        //处置结果
        $czjg = $this->input->get_post('czjg');
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

        if(empty($hphm) || empty($hpzl)){
            resjson(100,'参数不完整');
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
                  $filename_path = ROOT_PATHS."assets/uploads/task_assessment_image/";
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
                'ywlx' => $ywlx,
                'sfch' => $sfch,
                'wfcyy' => $wfcyy,
                'dsr' => $dsr,
                'sfzmhm' => $sfzmhm,
                'czsj' => $czsj,
                'czjg' => $czjg,
                'pic' => $pic,
                'jybh' => $jybh,
                'czr'  => $czr,
                'bmdm' => $bmdm,
                'bmmc' => $bmmc,
            );

        $this->m_month_task_assessment->insert_select_assessment_task($data);

        resjson(103,'任务反馈成功');
    }   

    /**
         * @api {post} /a_monthly_task_assessment/get_car_pic/ 4获取车辆图片
         * @apiVersion 0.1.0
         * @apiName get_car_pic
         * @apiGroup a_monthly_task_assessment
         * @apiParam {int} id  应检/隐患列表id
         * @apiDescription 获取车辆图片
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
    public function get_car_pic(){
        //获取id
        $id = $this->input->get_post('id');

        $data = $this->m_month_task_assessment->get_car_pic($id);
        $pic = '';
        if($data){
            $pic_arr = explode('+', $data['cltp']);
            $num = count($pic_arr);
            for($i=0; $i < $num; $i++) { 
                $pic.= base_url().$pic_arr[$i].'+';
            }

            $pic = rtrim($pic,'+');

            $pic_arr = explode('+',$pic);
            

            resjson(103,'获取图片成功',$pic_arr);
        }else{
            resjson(102,'获取图片失败');
        }

    }


}