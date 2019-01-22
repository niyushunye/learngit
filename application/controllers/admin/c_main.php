<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_main extends CI_Controller {

    //官方给的写法,构造函数
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        //因为需要在页面上显示 echo base_url(); 所以需要加上这个
        $this->load->helper('url');
        $this->load->view('admin/v_main.php');
        //show_404();
    }

}

/* End of file c_main.php */
/* Location: ./application/controllers/c_main.php */