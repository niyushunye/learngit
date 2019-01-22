<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/*
|---------------------------------------------------------------------------------------
| [西马 后台管理系统] (C)2017 Created by Sublime 2016.1版本
|---------------------------------------------------------------------------------------
| 文件描述(my_global_class.php):   
|---------------------------------------------------------------------------------------
| 详情: 
| 这里是自定义的全局使用的方法
|  http://codeigniter.org.cn/user_guide/general/creating_libraries.html
|
|
|---------------------------------------------------------------------------------------
| 作者:   fantao
| 邮箱:   fantao@qingter.com
| 时间:   18/9/10 下午6:59
| 文件版本号:  0.0.1 beta
|
*/

class My_global_class { 

    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI = & get_instance(); 

        //加载CI的 session 类
        //$this->CI->load->library('session');
        //加载自定义的配置文件, true为了防止冲突
        //$this->CI->config->load('project_config/config', TRUE);
        //加载url
        $this->CI->load->helper('url');
        //加载公共的方法
        $this->CI->load->helper('public_helper');
        //加载数据库
        //$this->CI->load->database();
        //设置时区
        //date_default_timezone_set("Asia/Chongqing");

        //onload CI driver
        //$this->CI->load->driver('cache');
    }

}






/* End of file my_global_class.php */
/* Location: .${FILE_PATH} */
