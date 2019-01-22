<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_xzqh extends CI_Controller
{

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //加载全局方法
        $this->load->library('My_global_class');

        $this->load->model('API/api_1_1_0/m_xzqh');

        define('ROOT_PATHS', $this->config->item('root_path'));
    }

    //查出行政区划信息
    public function select_xzqh(){

        $id = $this -> input -> get('id',TRUE);

        if($id){
            $info = $this -> m_xzqh -> select_xx($id);
            if($info){
                $data = $this -> m_xzqh -> select_0($info['dept_number']);
                $data['xj'] = array();
                $data1 = $this -> m_xzqh -> select_ej($data['number']);  //查询下级行政区划
                foreach ($data1 as $k => $v){
                    $v['xxj'] = array();
                    $data2 = $this -> m_xzqh -> select_ej($v['number']);
                    foreach ($data2 as $k => $v1){
                        array_push($v['xxj'],$v1);
                    }
                    array_push($data['xj'],$v);
                }
                if($data){
                    resjson(101,'获取行政规划数据成功',$data);
                }else{
                    resjson(102,'获取行政规划数据失败');
                }
            }else{
                resjson(105,'对不起你没有权限');
            }
        }else{
            resjson(104,'账户异常');
        }


    }

    //危险道路统计
    public function danger_road(){
        $xzqh = $this -> input -> get_post('xzqh');   //行政区划
        $pcsj = $this -> input -> get_post('pcsj');   //排查时间
        $is_danger = $this -> input -> get_post('is_danger');   //是否隐患1:是 2：否
        $lxdh = $this -> input -> get_post('lxdh');   //联系电话
        $dlmc = $this -> input -> get_post('dlmc');   //辖区道路名称

        $yhld = $this -> input -> get_post('yhld');   //隐患路段
        $sgdfld = $this -> input -> get_post('sgdfld');   //事故多发路段
        $yhxz = $this -> input -> get_post('yhxz');   //隐患现状
        $cjsj = time();   //采集时间
        $gxsj = $this -> input -> get_post('gxsj');   //更新时间
        $jybh = $this -> input -> get_post('jybh');   //警员编号

        //判断警员编号是否合法
        $jybh_hf = $this -> m_xzqh -> select_xx($jybh);
        if($jybh_hf){
            $data['xzqh'] = $xzqh;       //行政区划
            $data['pcsj'] = $pcsj;      //排查时间
            $data['is_danger'] = $is_danger;        //是否隐患1：是2：否
            $data['lxdh'] = $lxdh;          //联系电话
            $data['dlmc'] = $dlmc;         //辖区道路名称
            $data['yhld'] = $yhld;          //隐患路段
            $data['sgdfld'] = $sgdfld;           //事故多发路段
            $data['yhxz'] = $yhxz;           //隐患现状
            $data['cjsj'] = $cjsj;          //采集时间
            $data['gxsj'] = $gxsj;          //更新时间
            $data['jybh'] = $jybh;       //警员编号

            $res = $this -> m_xzqh -> add_danger_road($data);

            if($res){
                resjson(101,'添加成功');
            }else{
                resjson(102,'添加失败');
            }
        }else{
            resjson(100,'警员不合法');
        }
    }

    //驾驶员信息
    public function driver(){

        $xzqh = $this -> input -> get_post('xzqh');   //行政区划编码
        $dabh = $this -> input -> get_post('dabh');   //档案编号
        $sfzh = $this -> input -> get_post('sfzh');   //身份证号
        $xm = $this -> input -> get_post('xm');   //姓名
        $xb = $this -> input -> get_post('xb');   //性别1：男2：女
        $sjhm = $this -> input -> get_post('sjhm');   //手机号码
        $njjsy = $this -> input -> get_post('njjsy');   //农机驾驶员1：是2：否
        $lxdh = $this -> input -> get_post('lxdh');   //联系电话
        $gzdw = $this -> input -> get_post('gzdw');   //工作单位
        $cyzgzh = $this -> input -> get_post('cyzgzh');   //从业资格证号
        $fzrq = $this -> input -> get_post('fzrq');   //发证日期
        $gqrq = $this -> input -> get_post('gqrq');   //过期日期
        $jsz = $this -> input -> get_post('jsz');   //驾驶证

        $zjcx = $this -> input -> get_post('zjcx');   //准假车型
        $jzqx = $this -> input -> get_post('jzqx');   //驾证期限6年期，10年期，终生，其他
        $yxqs = $this -> input -> get_post('yxqs');   //有效期始
        $yxqz = $this -> input -> get_post('yxqz');   //有效期止
        $cclzrq = $this -> input -> get_post('cclzrq');   //次领证日期
        $xysyrq = $this -> input -> get_post('xysyrq');   //下一审验日期
        $ljjf = $this -> input -> get_post('ljjf');   //累计积分
        $bzsm = $this -> input -> get_post('bzsm');   //备注说明

        $hjd = $this -> input -> get_post('hjd');   //户籍地
        $cqgzd = $this -> input -> get_post('cqgzd');   //长期工作地
        $zsdz = $this -> input -> get_post('zsdz');   //住所地址
        $yzbm = $this -> input -> get_post('yzbm');   //邮政编码
        $tjsj = $this -> input -> get_post('tjsj');   //统计时间
        $cjsj = time();   //采集时间
        $jybh = $this -> input -> get_post('jybh');   //警员编号

        //判断警员编号是否合法
        $jybh_hf = $this -> m_xzqh -> select_xx($jybh);

        if($jybh_hf){

            $data['xzqh'] = $xzqh;       //行政区划
            $data['dabh'] = $dabh;       //档案编号
            $data['sfzh'] = $sfzh;       //身份证号
            $data['xm'] = $xm;          //姓名
            $data['xb'] = $xb;          //性别1：男 2：女
            $data['sjhm'] = $sjhm;        //手机号码
            $data['njjsy'] = $njjsy;        //机农驾驶员1：是2：否
            $data['lxdh'] = $lxdh;         //联系电话
            $data['gzdw'] = $gzdw;          //工作单位
            $data['cyzgzh'] = $cyzgzh;           //从业资格证号
            $data['fzrq'] = $fzrq;           //发证日期
            $data['gqrq'] = $gqrq;            //过期日期
            $data['jsz'] = $jsz;           //驾驶证
            $data['hjd'] = $hjd;                //户籍地
            $data['cqgzd'] = $cqgzd;            //长期工作地
            $data['zsdz'] = $zsdz;             //住所地址
            $data['yzbm'] = $yzbm;               //邮政编码
            $data['tjsj'] = $tjsj;             //统计时间
            $data['cjsj'] = $cjsj;             //采集时间
            $data['jybh'] = $jybh;               //警员编号
            $data['bzsm'] = $bzsm;              //备注说明

            $data['zjcx'] = $zjcx;         //准驾车型
            $data['jzqx'] = $jzqx;           //假证年限6年期 10年期 终生 其他
            $data['yxqs'] = $yxqs;           //有效期始
            $data['yxqz'] = $yxqz;          //有效期止
            $data['cclzrq'] = $cclzrq;          //次领证日期
            $data['xysyrq'] = $xysyrq;            //下一审检日期
            $data['ljjf'] = $ljjf;             //累计积分

            $res = $this -> m_xzqh -> add_driver($data);
            if($res){
                resjson(100,'添加成功');
            }else{
                resjson(102,'添加失败');
            }
        }else{
            resjson(100,'警员不合法');
        }
    }

    //无牌机动车
    public function non_vehicle(){
        $xzqh = $this -> input -> get_post('xzqh');  //行政区划
        $hphm = $this -> input -> get_post('hphm');  //号牌号码
        $cjh = $this -> input -> get_post('cjh');  //车架号
        $cltz = $this -> input -> get_post('cltz');  //车辆特征
        $cllb = $this -> input -> get_post('cllb');  //车辆类别
        $syxz = $this -> input -> get_post('syxz');  //使用性质
        $ppxh = $this -> input -> get_post('ppxh');  //品牌型号
        $gmsj = $this -> input -> get_post('gmsj');  //购买时间
        $hjd = $this -> input -> get_post('hjd');  //户籍地1：本地2：外地
        $clsyr = $this -> input -> get_post('clsyr');  //车辆所有人
        $sjhm = $this -> input -> get_post('sjhm');  //手机号码
        $sfzh = $this -> input -> get_post('sfzh');  //身份证号
        $lxzz = $this -> input -> get_post('lxzz');  //联系住址
        $yzbm = $this -> input -> get_post('yzbm');  //邮政编码
        $mdsj = $this -> input -> get_post('mdsj');  //摸底时间
        $hpzl = $this -> input -> get_post('hpzl');   //好牌种类
        $cjsj = time();  //采集时间
        $jybh = $this -> input -> get_post('jybh');  //警员编号

        //判断警员是否合法
        $jyzh_hf = $this -> m_xzqh -> select_xx($jybh);

        if($jyzh_hf){
            $data['xzqh'] = $xzqh;       //行政区划
            $data['hphm'] = $hphm;          //号牌号码
            $data['cjh'] = $cjh;         //车架号
            $data['cltz'] = $cltz;            //车辆特征
            $data['cllb'] = $cllb;        //车辆类别
            $data['syxz'] = $syxz;         //使用性质
            $data['ppxh'] = $ppxh;         //品牌型号
            $data['gmsj'] = $gmsj;         //购买时间
            $data['hjd'] = $hjd;            //户籍地1：本地2：外地
            $data['clsyr'] = $clsyr;           //车辆所有人
            $data['sjhm'] = $sjhm;          //手机号码
            $data['sfzh'] = $sfzh;           //身份证号
            $data['lxzz'] = $lxzz;         //联系住址
            $data['yzbm'] = $yzbm;        //邮政编码
            $data['mdsj'] = $mdsj;           //摸底时间
            $data['cjsj'] = $cjsj;             //采集时间
            $data['jybh'] = $jybh;               //警员编号
            $data['hpzl'] = $hpzl;
            $res = $this -> m_xzqh -> add_non_vehicle($data);

            if($res){
                resjson(101,'添加成功');
            }else{
                resjson(102,'添加失败');
            }
        }else{
            resjson(100,'警员编号不合法');
        }
    }

    //机动车
    public function vehicle(){

        $xzqh = $this->input->get_post('xzqh');   //行政区划编码

        $hpzl = $this -> input -> get_post('hpzl');  //号牌种类

        $hphm = $this -> input -> get_post('hphm');   //号牌号码

        $cllb = $this -> input -> get_post('cllb');   //车辆类别

        $syxz = $this -> input -> get_post('syxz');   //使用性质

        $jsxscl = $this -> input -> get_post('jsxscl');    //接送学生车辆1：是 2：否

        $ppxh = $this -> input ->get_post('ppxh');    //品牌型号

        $ccdjrq = $this -> input -> get_post('ccdjrq'); //初次登记日期

        $hjd = $this -> input -> get_post('hjd');   //户籍地 1：本地  2：外地

        $cqszd = $this -> input -> get_post('cqszd'); //长期所在地1：本地 2：外地

        $jyyxqz = $this -> input -> get_post('jyyxqz');  //检验有效期止

        $qzbfqz = $this -> input -> get_post('qzbfqz');   //强制报废期止

        $sfkycl = $this -> input -> get_post('sfkycl');  //是否客运车辆 1：是 2：否

            $zws = $this -> input -> get_post('zws');   //座位数

            $gshjy = $this -> input -> get_post('gshjy');  //是否公司化运营 1：是 2：否

            $gsm = $this -> input -> get_post('gsm');  //公司名

            $azgpsjk = $this -> input -> get_post('azgpsjk');   //安装GPS监控1：是 2：否

            $gpsjkdw = $this -> input -> get_post('gpsjkdw');    //GPS监控单位

            $pzaqd =  $this -> input -> get_post('pzaqd');  //配置安全带 1:是 2：否

            $azfhl = $this -> input -> get_post('azfhl');   //安装防护栏 1:是 2：否

            $lmkd = $this -> input -> get_post('lmkd');   //路面宽3.5米路基宽4.5米 1：是 2：否

        $dllc = $this -> input -> get_post('dllc');   //道路里程

        $tjdl = $this -> input -> get_post('tjdl');   //途径道路

        $yyzhm = $this -> input -> get_post('yyzhm');   //运营证号码

        $yyzfzrq = $this -> input -> get_post('yyzfzrq');   //运营证发证日期

        $yyzgqrq = $this -> input -> get_post('yyzgqrq');   //运营证过期日期

        $clsyr = $this -> input -> get_post('clsyr');   //车辆所有人

        $sjhm = $this -> input -> get_post('sjhm'); //手机号码

        $sfzh = $this -> input -> get_post('sfzh');   //身份证号

        $lxzz = $this -> input -> get_post('lxzz');   //联系住址

        $yzbm = $this -> input -> get_post('yzbm');   //邮政编码

        $mdsj = $this -> input -> get_post('mdsj');  //摸底时间

        $cjsj = time();   //采集时间

        $jybh = $this -> input -> get_post('jybh');    //警员编号

        //判断警员编号是否合法
        $jybhhf = $this -> m_xzqh -> select_xx($jybh);   //判断警员编号是否合法

        if($jybhhf){
            $data['xzqh'] = $xzqh;   // 行政区划
            $data['hpzl'] = $hpzl;    //好牌种类
            $data['hphm'] = $hphm;    //号牌号码
            $data['cllb'] = $cllb;    //车辆类别
            $data['syxz'] = $syxz;     //使用性质
            $data['jsxscl'] = $jsxscl;  //接送学生车辆1：是2：否
            $data['ppxh'] = $ppxh;    //品牌型号
            $data['ccdjrq'] = $ccdjrq; //初次登记日期
            $data['hjd'] = $hjd;    //户籍地1:本地2：外地
            $data['cqszd'] = $cqszd;   //长期所在地1：本地2：外地
            $data['jyyxqz'] = $jyyxqz;  //检验有效期止
            $data['qzbfqz'] = $qzbfqz;  //强制报废期止
            $data['sfkycl'] = $sfkycl;   //是否客运车辆
            $data['dllc'] = $dllc;       // 道路里程
            $data['tjdl'] = $tjdl;       //途径道路
            $data['yyzhm'] = $yyzhm;    // 运营证号码
            $data['yyzfzrq'] = $yyzfzrq;  //运营证发证日期
            $data['yyzgqrq'] = $yyzgqrq;  //运营证过期日期
            $data['clsyr'] = $clsyr;   //车辆所有人
            $data['sjhm'] = $sjhm;   //手机号码
            $data['sfzh'] = $sfzh;   //身份证号
            $data['lxzz'] = $lxzz;     // 联系住址
            $data['yzbm'] = $yzbm;   //邮政编码
            $data['mdsj'] = $mdsj;   //摸底时间
            $data['cjsj'] = $cjsj;    //采集时间
            $data['jybh'] = $jybh;   // 警员编号

            $data['zws'] = $zws;   //座位数
            $data['gshjy'] = $gshjy;    //公司化经营1：是2：否
            $data['gsm'] = $gsm;    //公司名
            $data['azgpsjk'] = $azgpsjk;        //安装GPS监控1：是2：否
            $data['gpsjkdw'] = $gpsjkdw;          //GPS监控单位
            $data['pzaqd'] = $pzaqd;             //配置安全带1：是2：否
            $data['azfhl'] = $azfhl;            //安装防护栏1：是2：否
            $data['lmkd'] = $lmkd;            //路面宽3.5米 路面基宽4.5米1：是2：否

            $res = $this -> m_xzqh -> add_vehicle($data);
            if($res){
                resjson(101,'添加成功');
            }else{
                resjson(102,'添加失败');
            }
        }else{
            resjson(100,'人员不合法');
        }
    }
}
