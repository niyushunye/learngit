<?php 

//从静态文件中获取数据   部门信息

function orginfo(){
	$file = "orginfo.txt";
	$msg = file_get_contents($file);
	$results = unserialize($msg);
	return $results;
}

//判断session是否存在，如果存在继续操作；如果不存在，返回登录页
function session_login(){
	if($_SESSION['accounts'] == ""){
		return 1;
	}else{
		return 0;
	}
}

//操作日志添加
function oper_log_($oper){
	$CI =&get_instance();
	$CI->load->model('admin/m_oper_log');

	if($oper['type'] == 1){
            $oper['type'] = '新增';
        }elseif ($oper['type'] == 2) {
            $oper['type'] = '修改';
        }else {
            $oper['type'] = '删除';
        }
        $oper = array(
            'oper_accouts' => $_SESSION['accounts'],
            'oper_member' => $_SESSION['realname'],
            'oper_module' => $oper['module'],
            'oper_type' => $oper['type'],
            'oper_ziduan' => $oper['ziduan'],
            'oper_filed' => $oper['field'],   
            'dateline' => time()
            );

      $CI->m_oper_log->add_oper_log($oper);

}


//数据转json,数组返回值变json
function resjson($code,$message,$result=''){
  $data = array('code'=>$code,'message'=>$message,'result'=>$result);
  echo json_encode($data,JSON_UNESCAPED_UNICODE);
  exit();
}

