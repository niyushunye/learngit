<?php 

$config['full_tag_open'] = '<ul class="pagination">';  
$config['full_tag_close'] = '</ul>'; 
$config['first_link'] = '首页';
$config['last_link'] = '尾页'; 
$config['prev_link'] = '上页';  
$config['next_link'] = '下页';  
$config['prev_tag_open'] = '<li style = "background-color:white;width : auto">';  
$config['prev_tag_close'] = '</li>';  
$config['next_tag_open'] = '<li style = "background-color:white;width : auto">';  
$config['next_tag_close'] = '</li>'; 
$config['first_tag_open'] = '<li style = "background-color:white;width : auto">';  
$config['first_tag_close'] = '</li>';  
$config['last_tag_open'] = '<li style = "background-color:white;width : auto">';  
$config['last_tag_close'] = '</li>';   
$config['num_tag_open'] = '<li style = "background-color:white;width : auto">';  
$config['num_tag_close'] = '</li>';  
// $config['cur_tag_open'] = '<input type="text" id = "page" style = "width: 32px;height: 34px;text-align: center;" value ="';  
// $config['cur_tag_close'] = '">';  
$config['cur_tag_open'] = '<li class="active" style = "background-color : #09c"><a href="#">';  
$config['cur_tag_close'] = '</a></li>'; 

$config['num_links'] = 2;
// $config['curpage'] = "";
// echo $config['curpage'];
//URL显示当前页数
$config['use_page_numbers'] = false;

//在默认分段后面添加查询字符串
$config['reuse_query_string'] = true;

//开启查询字符串
$config['page_query_string'] = false;


?>