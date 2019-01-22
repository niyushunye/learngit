<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|---------------------------------------------------------------------------------------
| [交警执法平台后台管理系统] (C)2006 Created by PhpStorm 2016.1版本
|---------------------------------------------------------------------------------------
| 文件描述(c_alarm_feedback.php):   客户端版本
|---------------------------------------------------------------------------------------
| 详情:
|
|
|
|---------------------------------------------------------------------------------------
| 作者:   Andyzu
| 邮箱:   andyzu@qingter.com
| 时间:   16/7/26 上午8:52
|
*/


class C_member_telephone extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();
        //echo base_url(); 和 跳转 需要这个
        $this->load->helper('url');
        //增加分页类
        $this->load->library('pagination');
        //$this->load->model();
    }



    //显示文件列表
    public function index()
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式610301010000
        $db_mysql = $this->load->database('default',TRUE);
        //所属部门代码orgnum
        $orgnum = $_SESSION['orgnum'];
        $orgnum = '610300000000';

        //获取组织机构名称
        $sql_getOrgname = $db_mysql->query("SELECT * FROM `orginfo` WHERE `orgnum` = '{$orgnum}'");
        $data['orgname'] = $sql_getOrgname->result_array();


        //看看这个组织机构代码下还有没有下属部门，有就读取
        $sql_getSuper = $db_mysql->query("SELECT * FROM `orginfo` WHERE `superiornum` = '{$orgnum}' ORDER BY `orgnum` DESC ");
        $data['glbm'] = $sql_getSuper->result_array();

        foreach($data['glbm'] as $value)
        {
            $arr = array(
                'id' => $value['orgnum'],
                'pId' => 0,
                'name' => $value['orgname'],
//                'isParent' => true
            //点击时指向读取功能
               'url' => base_url().'admin/c_directional/filelist/'.$value['orgnum'],
                'target' => "iframe0"
            );
            $data['result'][] = $arr;

        }
        foreach($data['glbm'] as $value)
        {
            $sql_getSuper = $db_mysql->query("SELECT * FROM `orginfo` WHERE `superiornum` = '{$value['orgnum']}' ORDER BY `orgnum` DESC ");
            $data['zbm'] = $sql_getSuper->result_array();
//            print_r($data);
            foreach($data['zbm'] as $value1){
                $arr1 = array(
                    'id' => $value1['orgnum'],
                    'pId' => $value['orgnum'],
                    'name' => $value1['orgname'],
//                    'isParent' => true
                    //点击时指向读取功能
                    'url' => base_url().'admin/c_directional/getsuper/'.$value1['orgnum'],
                    'target' => "iframe0"
                );
                $data['result'][] = $arr1;
            }
        }

//        print_r(json_encode($data['result'],JSON_UNESCAPED_UNICODE));exit();
//        exit();

        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum;exit();
            $this->filelist($orgnum);
        }else{
            $this->load->view("admin/v_directional",$data);
        }
//        print_r($data);exit();
    }



    public function getsuper($orgnum)
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式610301010000
        $db_mysql = $this->load->database('default',TRUE);

        $sql_getOrgname = $db_mysql->query("SELECT * FROM `orginfo` WHERE `orgnum` = '{$orgnum}'");
        $data['orgname'] = $sql_getOrgname->result_array();

        $sql_getSuper = $db_mysql->query("SELECT * FROM `orginfo` WHERE `superiornum` = '{$orgnum}' ORDER BY `orgnum` DESC ");
        $data['glbm'] = $sql_getSuper->result_array();
        //如果没有下属部门则读取文件夹
        if(empty($data['glbm'])){
//            echo '没有下属了';
//            echo $orgnum;
            $this->filelist($orgnum);
        }
        $this->load->view("admin/v_directional",$data);
    }


    //调用读取文件程序
    public function filelist($orgnum)
    {
        //加载database.php里的default方式来连接数据库,这里的default是mysql连接方式610301010000
        $db_mysql = $this->load->database('default',TRUE);

        $sql_getOrgname = $db_mysql->query("SELECT * FROM `orginfo` WHERE `orgnum` = '{$orgnum}'");
        $data['orgname'] = $sql_getOrgname->result_array();

        $dir = "D:/xampp/htdocs/ci/assets/app_upload/".$orgnum;

        $data['dirs'] = $this->my_scandir($dir);
//        print_r($data);exit();

        $this->load->view("admin/v_directional_filelist",$data);
    }



    //获取文件列表
    public function my_scandir($dir)
    {
        $files = array();
        if(is_dir($dir))
        {
            if($handle = opendir($dir))
            {
                while(($file = readdir($handle)) !== false)
                {
                    if($file != "." && $file != "..")
                    {
                        if(is_dir($dir."/".$file))
                        {
                            $files[$file] = $this->my_scandir($dir."/".$file);
                        }
                        else
                        {
                            $files[] = $dir."/".$file;
                        }
                    }
                }
                closedir($handle);
                return $files;
            }
        }
    }



    //删除提示
    public function delete_print($orgnum,$filename)
    {
        $data['orgnum'] = $orgnum;
        $data['filename'] = $filename;
        $this->load->view("admin/v_directional_print_delete",$data);
    }



    //开始删除
    public function delete_directional()
    {
        $orgnum =$this->input->post('orgnum');
        $filename = $this->input->post('filename');
//        echo $filename;exit();
//        echo $orgnum."<br>".$filename;exit();
//        $file = base_url()."assets/app_upload/".$orgnum."/".$filename;
        $file = "D:/xampp/htdocs/ci/assets/app_upload/".$orgnum."/".$filename;
//        echo $file;exit();
        if(!unlink($file))
        {
            $data['delete_result'] = "删除失败！！";
            $data['orgnum'] = $orgnum;
            $this->load->view("admin/v_directional_print_delete_result",$data);
        }else
        {
            $data['delete_result'] = "删除成功！！";
            $data['orgnum'] = $orgnum;
            $this->load->view("admin/v_directional_print_delete_result",$data);

        }

    }



    //print 1、全选删除
    public function print_select_delete($orgnum,$filee){

        $data['select_delete_orgnum'] = $orgnum;
        $data['select_delete_filee'] = $filee;

        $this->load->view('admin/v_directional_SelectDelete_print', $data);
    }



    //print 2、开始删除
    public function finish_print_selectDelete()
    {
        $select_delete_orgnum = $this->input->post('select_delete_orgnum', TRUE);
        $select_delete_filee = $this->input->post('select_delete_filee', TRUE);

        $select_delete_filee = explode(":::",$select_delete_filee);
        foreach ((array)$select_delete_filee as $value)
        {
//            echo "D:/xampp/htdocs/ci/assets/app_upload/".$select_delete_orgnum."/".$value."<br>";
            $file = "D:/xampp/htdocs/ci/assets/app_upload/".$select_delete_orgnum."/".$value;
            unlink($file);
//            $db_mysql->delete('questioninfo', array('id' => $value));
//            $file = "D:/xampp/htdocs/ci/assets/app_upload/".$orgnum;
        }
//        exit();
//        redirect(base_url().'admin/c_questioninfo/');
        redirect(base_url().'admin/c_directional/getsuper/'.$select_delete_orgnum);
    }



    //返回查询页面
    public function gofirst()
    {
        $orgnum = $this->input->post("orgnum");
        redirect(base_url().'admin/c_directional/getsuper/'.$orgnum);
    }
}

/* End of file c_alarm_feedback.php */
/* Location: .${FILE_PATH} */