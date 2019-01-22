<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_vehicle_access extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_vehicle_access');

        //获取文件根目录路径 
        define('ROOT_PATHS', $this->config->item('root_path')); 
    }

    /**
         * @api {post} /a_vehicle_access/get_vehicle_type/ 1车辆号牌种类
         * @apiVersion 0.1.0
         * @apiName get_vehicle_type
         * @apiGroup a_vehicle_access
         * @apiDescription 获取车辆号牌种类
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
        
    public function get_vehicle_type()
    {
        $data = $this->m_vehicle_access->get_vehicle_type_model();

        if($data){
            resjson(103,'获取车辆号牌种类成功',$data);
        }else{
            resjson(102,'获取车辆号牌种类失败');
        }
    }


    /**
         * @api {post} /a_vehicle_access/car_inbound/ 2车辆信息入库
         * @apiVersion 0.1.0
         * @apiName car_inbound
         * @apiGroup a_vehicle_access
         * @apiParam {string} hphm   车牌号码
         * @apiParam {string} hpzl   号牌种类
         * @apiParam {string} dsr    当事人
         * @apiParam {string} sfzmhm 身份证号码
         * @apiParam {int} czsj   处置时间
         * @apiParam {string} czjg   处置结果
         * @apiParam {string} tccmc  停车场名称
         * @apiParam {string} tccdz  停车场地址
         * @apiParam {int} imagenum   图片数量
         * @apiParam {file} image_ 图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)
         * @apiParam {string} jybh    警员编号
         * @apiParam {string} czr     处置民警
         * @apiParam {string} bmdm    部门代码
         * @apiParam {string} bmmc    部门名称
         * @apiDescription 获取车辆信息入库
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
    public function car_inbound(){

        //唯一随机编号
        $xh = $this->getGuid();
        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //当事人
        $dsr = $this->input->get_post('dsr');
        //身份证号码
        $sfzmhm = $this->input->get_post('sfzmhm');
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

        /*=========================================================================================================*/
        if(empty($hphm) || empty($hpzl) || empty($sfzmhm) || empty($imagenum) || empty($jybh) || empty($bmdm) || empty($bmmc) || empty($czr)){
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

                  $fileName = "assets/uploads/inbound_car_image/".$filename;

                  $pic.= $fileName."+";
                  //获取临时文件
                  $tmpfile = $_FILES['image_'.$i]['tmp_name']; 
                  //目标存储文件路径
                  $filename_path = ROOT_PATHS."assets/uploads/inbound_car_image/";
                  //上传文件到指定路劲
                  move_uploaded_file($tmpfile, $filename_path.$filename);    
            }
                       
        }

        if($pic != '' ){
          $pic = substr($pic, 0,-1);
        }

        $data = array(
                'xh' => $xh,
                'hphm' => $hphm,
                'hpzl' => $hpzl,
                'dsr' => $dsr,
                'sfzmhm' => $sfzmhm,
                'czsj' => $czsj,
                'czjg' => $czjg,
                'tccmc' => $tccmc,
                'tccdz' => $tccdz,
                'pic' => $pic,
                'jybh' => $jybh,
                'czr'  => $czr,
                'bmdm' => $bmdm,
                'bmmc' => $bmmc,
                'dateline' => time(),
            );

        $this->m_vehicle_access->car_inbound_model($data);

        resjson(103,'入库成功');

    }


    /**
         * @api {post} /a_vehicle_access/car_outbound_check/ 3出库信息查询
         * @apiVersion 0.1.0
         * @apiName car_outbound_check
         * @apiGroup a_vehicle_access
         * @apiParam {string} hphm    车牌号码
         * @apiParam {string} hpzl    号牌种类
         * @apiParam {string} sfzmhm  身份证号
         * @apiParam {int} start_time 起始时间
         * @apiParam {int} end_time   结束时间
         * @apiParam {number} num          分页传递的参数,例1代表第一页，2代表第二页
         * @apiDescription 出库信息查询
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
    public function car_outbound_check(){
        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //身份证号码
        $sfzmhm = $this->input->get_post('sfzmhm');
        //起始时间
        $start_time = $this->input->get_post('start_time');
        //结束时间
        $end_time = $this->input->get_post('end_time');
        //获取页码值
        $num = $this->input->get_post("num");

        if(empty($num)){
            resjson(100,'参数不完整');
        }

        $arr = $this->m_vehicle_access->car_outbound_check($hphm,$hpzl,$sfzmhm,$start_time,$end_time,$num);

        if($arr){
            foreach ($arr as  &$value) {
                //获取号码种类
                $data = $this->m_vehicle_access->get_vehicle_type_model();
                foreach ($data as  $val) {
                    if($value['hpzl'] == $val['DMZ']){
                        $value['hpbh'] = $value['hpzl'];
                        $value['hpzl'] = $val['DMSM1'];

                    }
                }
            }

            resjson(103,'查询成功',$arr);
        }else{
            resjson(102,'无出库信息');
        }

    }
    
    /**
         * @api {post} /a_vehicle_access/car_outbound/ 4车辆信息出库
         * @apiVersion 0.1.0
         * @apiName car_outbound
         * @apiGroup a_vehicle_access
         * @apiParam {string} xh      车辆入库的序号
         * @apiParam {string} hphm    车牌号码
         * @apiParam {string} hpzl    号牌种类
         * @apiParam {string} dsr    当事人
         * @apiParam {string} sfzmhm 身份证号码
         * @apiParam {int} czsj   处置时间
         * @apiParam {string} czjg   处置结果
         * @apiParam {string} tccmc  停车场名称
         * @apiParam {string} tccdz  停车场地址
         * @apiParam {int} imagenum   图片数量
         * @apiParam {file} image_ 图片files名（image_后拼接图片下标,比如总共两张图片，分别为image_1、image_2)
         * @apiParam {string} jybh    警员编号
         * @apiParam {string} czr     处置民警
         * @apiParam {string} bmdm    部门代码
         * @apiParam {string} bmmc    部门名称
         * @apiDescription 车辆信息出库
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
        
    public function car_outbound(){
        //唯一随机编号
        $xh = $this->input->get_post('xh');
        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //当事人
        $dsr = $this->input->get_post('dsr');
        //身份证号码
        $sfzmhm = $this->input->get_post('sfzmhm');
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

//        /*=========================================================================================================*/
//        /*if(empty($xh) || empty($hphm) || empty($hpzl) || empty($sfzmhm) || empty($imagenum) || empty($jybh) || empty($bmdm) || empty($bmmc) || empty($czr)){
//            resjson(100,'参数不完整');
//        }*/


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

                  $fileName = "assets/uploads/outbound_car_image/".$filename;

                  $pic.= $fileName."+";
                  //获取临时文件
                  $tmpfile = $_FILES['image_'.$i]['tmp_name']; 
                  //目标存储文件路径
                  $filename_path = ROOT_PATHS."assets/uploads/outbound_car_image/";
                  //上传文件到指定路劲
                  move_uploaded_file($tmpfile, $filename_path.$filename);    
            }
                       
        }


        if($pic != '' ){
          $pic = substr($pic, 0,-1);
        }

        $data = array(
                'xh' => $xh,
                'hphm' => $hphm,
                'hpzl' => $hpzl,
                'dsr' => $dsr,
                'sfzmhm' => $sfzmhm,
                'czsj' => $czsj,
                'czjg' => $czjg,
                'tccmc' => $tccmc,
                'tccdz' => $tccdz,
                'pic' => $pic,
                'jybh' => $jybh,
                'czr'  => $czr,
                'bmdm' => $bmdm,
                'bmmc' => $bmmc,
                'dateline' => time(),

            );

        $this->m_vehicle_access->car_outbound_model($data);
        $this->m_vehicle_access->update_is_out($xh);

        resjson(103,'出库成功');

    }


    /**
         * @api {post} /a_vehicle_access/car_outbound_along/ 5信息直接出库
         * @apiVersion 0.1.0
         * @apiName car_outbound_along
         * @apiGroup a_vehicle_access
         * @apiParam {string} hphm    车牌号码
         * @apiParam {string} hpzl    号牌种类
         * @apiParam {string} dsr     当事人
         * @apiParam {string} sfzmhm  身份证号码
         * @apiParam {int} czsj       处置时间
         * @apiParam {string} ckyy    出库原因
         * @apiParam {int} sfqzck     是否强制出库,0代表否,1代表是
         * @apiParam {string} jybh    警员编号
         * @apiParam {string} czr     处置民警
         * @apiParam {string} bmdm    部门代码
         * @apiParam {string} bmmc    部门名称
         * @apiDescription 信息直接出库
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
    public function car_outbound_along(){
        //唯一随机编号
        $xh = $this->getGuid();
        //车牌号码
        $hphm = $this->input->get_post('hphm');
        //号牌种类
        $hpzl = $this->input->get_post('hpzl');
        //当事人
        $dsr = $this->input->get_post('dsr');
        //身份证号码
        $sfzmhm = $this->input->get_post('sfzmhm');
        //处置时间
        $czsj = $this->input->get_post('czsj');
        //出库原因
        $ckyy = $this->input->get_post('ckyy');
        //是否强制出库
        $sfqzck = $this->input->get_post('sfqzck');
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

        if(empty($hphm) && empty($hpzl) && empty($dsr) && empty($sfzmhm) && empty($czsj) && empty($ckyy) && empty($sfqzck)){
            resjson(100,'参数不完整');
        }
        //图片的路径
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

                $fileName = "assets/uploads/outbound_car_image/".$filename;

                $pic.= $fileName."+";
                //获取临时文件
                $tmpfile = $_FILES['image_'.$i]['tmp_name'];
                //目标存储文件路径
                $filename_path = ROOT_PATHS."assets/uploads/outbound_car_image/";
                //上传文件到指定路劲
                move_uploaded_file($tmpfile, $filename_path.$filename);
            }

        }


        if($pic != '' ){
            $pic = substr($pic, 0,-1);
        }

        $data = array(
                'xh' => $xh,
                'hphm' => $hphm,
                'hpzl' => $hpzl,
                'dsr' => $dsr,
                'sfzmhm' => $sfzmhm,
                'czsj' => $czsj,
                'ckyy' => $ckyy,
                'sfqzck' => $sfqzck,
                'pic' => $pic,
                'jybh' => $jybh,
                'czr'  => $czr,
                'bmdm' => $bmdm,
                'bmmc' => $bmmc,
                'dateline' => time(),
            );

        $this->m_vehicle_access->car_outbound_model($data);

        resjson(103,'出库成功');

    }


    //生成不重复的序号
    public  function getGuid()
    {
        $uuid = time().mt_rand(100000,999999).mt_rand(100000,999999);
        return $uuid;
    }
}