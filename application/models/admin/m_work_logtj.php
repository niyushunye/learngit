<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class m_work_logtj extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //查询所有部门
    public function select_orginfo(){
        $data = $this -> db -> select('orgname,orgnum') -> get('orginfo') -> result_array();
        return $data;
    }


    public function select_type($type,$time,$mjbm,$bmdm){
        $data = array();
        if($time == ''){
            $time =  date('Y-m');
        }
        $time_str = explode('-',$time);
        $num = cal_days_in_month(CAL_GREGORIAN,$time_str[1],$time_str[0]);

        if($bmdm != '0'){
            $jybh = $this -> db -> select('accounts,realname') -> where('orgnum',$bmdm) -> get('memberinfo') -> result_array();
        }else if($mjbm != ''){
            $jybh = $this -> db -> select('accounts,realname')  -> where('accounts',$mjbm) -> get('memberinfo') -> result_array();
        }else if($bmdm == '0' && $mjbm == ''){
            $jybh = $this -> db -> select('accounts,realname')  -> get('memberinfo') -> result_array();
        }

        foreach ($jybh as $k => $v) {
            $data[$k]['name'] = $v['realname'];
            for ($i = 1; $i <= $num; $i++) {
                if ($i >= 10) {
                    $b = $i;
                } else {
                    $b = '0'.$i;
                }
                $this->db->select('attendance')->where('log_type', $type) -> where('accounts',$v['accounts']);
                $type1 = $this->db->like('log_time', $time . '-' . $b, 'after')->get('work_log')->row_array();
                if($type1['attendance'] == '0'){
                    $data[$k]['kaoqin'][][$i] = '正常上班';
                }else if($type1['attendance'] == '1'){
                    $data[$k]['kaoqin'][][$i] = '事假';
                }else if($type1['attendance'] == '2'){
                    $data[$k]['kaoqin'][][$i] = '病假';
                }else if($type1['attendance'] == '3'){
                    $data[$k]['kaoqin'][][$i] = '旷工';
                }else if($type1['attendance'] == '4'){
                    $data[$k]['kaoqin'][][$i] = '休假';
                }else if($type1['attendance'] == '5'){
                    $data[$k]['kaoqin'][][$i] = '迟到';
                }else if($type1['attendance'] == '6'){
                    $data[$k]['kaoqin'][][$i] = '早退';
                }else if($type1['attendance'] == ''){
                    $data[$k]['kaoqin'][][$i] = '未考勤';
                }
            }
            $attendance = array('0','5');
            $count = count($this -> db -> where_in('attendance',$attendance) ->where('log_type', $type) -> where('accounts',$v['accounts'])-> like('log_time', $time, 'after')->get('work_log') -> result_array());
            $data[$k]['chuqin'] = $count;
            $data[$k]['weiqin'] = $num - $count;
        }
        return $data;
    }



















}