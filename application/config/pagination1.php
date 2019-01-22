<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$config['uri_segment'] = 4;


	//页数围绕的标签
	$config['full_tag_open'] = '<div style = "background-color : #09c;width : auto">';
	$config['full_tag_close'] = '</div>';

	//第一页链接
	$config['first_link'] = '首页';

	//“第一页”链接的打开标签。
	//$config['first_tag_open'] = '<li>';
	$config['first_tag_open'] = '&nbsp;&nbsp;';

	//“第一页”链接的关闭标签。
	//$config['first_tag_close'] = '</li>';
	$config['first_tag_close'] = '&nbsp;&nbsp;';

	//你希望在分页的右边显示“最后一页”链接的名字。
	$config['last_link'] = '尾页';

	//“最后一页”链接的打开标签。
	//$config['last_tag_open'] = '<li>';
	$config['last_tag_open'] = '&nbsp;&nbsp;';

	//“最后一页”链接的关闭标签。
	//$config['last_tag_close'] = '</li>';
	$config['last_tag_close'] = '&nbsp;&nbsp;';

	//你希望在分页中显示“下一页”链接的名字。
	$config['next_link'] = '下一页';

	//“下一页”链接的打开标签。
	//$config['next_tag_open'] = '<li>';
	$config['next_tag_open'] = '&nbsp;&nbsp;';

	//“下一页”链接的关闭标签。
	//$config['next_tag_close'] = '</li>';
	$config['next_tag_close'] = '&nbsp;&nbsp;';

	//你希望在分页中显示“上一页”链接的名字。
	$config['prev_link'] = '上一页';

	//“上一页”链接的打开标签。
	//$config['prev_tag_open'] = '<li>';
	$config['prev_tag_open'] = '&nbsp;&nbsp;';

	//“上一页”链接的关闭标签。
	//$config['prev_tag_close'] = '</li>';
	$config['prev_tag_close'] = '&nbsp;&nbsp;';

	//“当前页”链接的打开标签。
	//$config['cur_tag_open'] = '<li class="current">';
	$config['cur_tag_open'] = '&nbsp;&nbsp;';

	//“当前页”链接的关闭标签。
	//$config['cur_tag_close'] = '</li>';
	$config['cur_tag_close'] = '&nbsp;&nbsp;';

	//“数字”链接的打开标签。
	//$config['num_tag_open'] = '<li>';
	$config['num_tag_open'] = '&nbsp;&nbsp;';

	//“数字”链接的关闭标签。
	//$config['num_tag_close'] = '</li>';
	$config['num_tag_close'] = '&nbsp;&nbsp;';

	//两边链接数
	$config['num_links'] = 3;

	//URL显示当前页数
	$config['use_page_numbers'] = false;

	//在默认分段后面添加查询字符串
	$config['reuse_query_string'] = true;

	//开启查询字符串
	$config['page_query_string'] = false;
