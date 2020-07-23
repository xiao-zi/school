<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/22
 * Time: 13:51
 */
/**
 * 老师管理课程的学生签到页面
 */
$course_id = intval($_GET['id']);//课程的id
$parameter = intval($_GET['parameter']);//时间或者是课时的id

appLoad()->model('course');
$model = new course();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT id,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

//获取课程的信息
$course_info = pdo_fetch("SELECT name,OldOrNew FROM " . tablename($this->table_tcourse) . " where schoolid = '{$school_id}' AND id = '{$course_id}'");
if(empty($course_info)){
    json_encodeBack(array('status'=>100012,'msg'=>'非法请求！！'));
}
//获取购买该课程的学生
$student_id_list = pdo_fetchall("SELECT sid FROM " .tablename('wx_school_coursebuy') . " WHERE schoolid = '{$school_id}' AND  kcid='{$course_id}' and sid != 0 and is_change != 1 GROUP BY kcid,sid ORDER BY id DESC ");
$NotConfirm = array();//签到未确认
$HasSign = array();//已签到
$NotSign = array();//未签到
$HasQJ = array();//请假
$i_NC = 0;
$i_HS = 0;
$i_NS = 0;
$i_QJ = 0;
$is_detail = 0;
foreach($student_id_list as $key => $value){
    $student = pdo_fetch("SELECT id,s_name FROM " . tablename($this->table_students) . " WHERE id = :id ", array(':id' => $value['sid']));
    if($course_info['OldOrNew'] == 0){ //固定课程时 $parameter 就是课时的id
        //获取课时信息
        $class_hour = pdo_fetch("SELECT nub,isxiangqing FROM " . tablename($this->table_kcbiao) . " where schoolid='{$school_id}' And kcid='{$course_id}' AND id = '{$parameter}'");
        $title = "第{$class_hour['nub']}课 - {$course_info['name']}";
        if($class_hour['isxiangqing'] == 1){
            $is_detail = 1;
        }
        $check_sign = pdo_fetch("SELECT id,status,createtime FROM " . tablename($this->table_kcsign) . " WHERE schoolid='{$school_id}' and  kcid='{$course_id}' And ksid='{$parameter}' And sid='{$value['sid']}' ");
    }else{//自由课程时 $parameter 就是上课时间
        $start = strtotime(date('Ymd',$parameter));
        $end =$start + 86399;
        $title = date("m月d日",$parameter);
        $check_sign = pdo_fetch("SELECT id,status,createtime FROM " . tablename($this->table_kcsign) . " WHERE schoolid='{$school_id}' and  kcid='{$course_id}' And createtime>'{$start}' And createtime<'{$end}' And sid='{$value['sid']}' ");
    }
    if (!empty($check_sign)) {
        if ($check_sign['status'] == 1) {
            $NotConfirm[$i_NC]['sname']      = $student['s_name'];
            $NotConfirm[$i_NC]['createtime'] = $check_sign['createtime'];
            $NotConfirm[$i_NC]['id']         = $value['id'];
            $i_NC++;
        } elseif ($check_sign['status'] == 2) {
            $HasSign[$i_HS]['sname']      = $student['s_name'];
            $HasSign[$i_HS]['createtime'] = $check_sign['createtime'];
            $HasSign[$i_HS]['id']         = $value['id'];
            $i_HS++;
        }elseif ($check_sign['status'] == 3) {
            $HasQJ[$i_QJ]['sname']      = $student['s_name'];
            $HasQJ[$i_QJ]['createtime'] = $check_sign['createtime'];
            $HasQJ[$i_QJ]['id']         = $value['id'];
            $i_QJ++;
        }
    } else {
        $NotSign[$i_NS]['sname'] = $student['s_name'];
        $NotSign[$i_NS]['id'] = $value['sid'];
        $i_NS++;
    }
}
//计算签到率
$check_rate=round(count($HasSign)/count($student_id_list)*100, 2);
$result = array(
    'school'=>$school,//学校信息
    'course'=>$course_info,//课程信息
    'title'=>$title,//title
    'is_detail'=>$is_detail,//是否可以查看课时详情
    'check_rate'=>$check_rate,//签到率
    'not_confirm'=>$NotConfirm,//签到尚未确认
    'has_sign'=>$HasSign,//签到成功
    'has_leave'=>$HasQJ,//请假
    'not_sign'=>$NotSign,//没有签到的
);
dump($result);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
