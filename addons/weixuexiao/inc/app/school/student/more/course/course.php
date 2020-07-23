<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/11
 * Time: 10:09
 */
/**
 * 学生的在读课程
 */
appLoad()->model('course');
$course_model = new course();
$user = $course_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];//学校的id
$student_id = $user['student_id'];//学生的id
//绑定信息
$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,xq_id FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
//找出学生购买的课程
$list = pdo_fetchall("SELECT kcid,sid FROM " . tablename('wx_school_coursebuy') . " WHERE schoolid = '{$school_id}' And sid = '{$student_id}' and is_change != 1 group by kcid ");
$result = array();
$now_time = time();
$start = mktime(0,0,0,date("m"),date("d"),date("Y"));
$end= $start + 86399;
foreach ($list as $key=>$value){
    $course = pdo_fetch("SELECT id,km_id,adrr,maintid,is_try,name,thumb,OldOrNew,ReNum,end,allow_pl,kc_type,allow_menu,start,isSign FROM " . tablename('wx_school_tcourse') . " WHERE id = '{$value['kcid']}'");
    //如果课程信息为空,则跳出此次循环.进行下次循环
    if(empty($course)){
        continue;
    }
    //获取科目的信息
    $subject = pdo_fetch("SELECT sname,icon FROM " . tablename('wx_school_classify') . " WHERE sid = '{$course['km_id']}'");
    //获取上课地点
    $address = pdo_fetch("SELECT sname,icon FROM " . tablename('wx_school_classify') . " WHERE sid = '{$course['adrr']}'");
    //获取主讲老师信息
    $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " WHERE id = '{$course['maintid']}'");
    //获取该学生对此课程的评价
    $appraise = pdo_fetch("SELECT content FROM " . tablename('wx_school_kcpingjia') . " WHERE schoolid = '{$school_id}' and sid ='{$student_id}' And kcid = '{$value['kcid']}' and type=2 ");
    //获取学生上此课程的结束日期
    $overtime = pdo_fetch("SELECT overtime FROM " .tablename('wx_school_coursebuy'). " WHERE schoolid = '{$school_id}' and sid ='{$student_id}' And kcid = '{$value['kcid']}' ");
    $result[$key]['id']   = $course['id'];//课程标题
    $result[$key]['title']   = $course['name'];//课程标题
    $result[$key]['course_thumb'] = tomedia($course['thumb']);//课程图片
    $result[$key]['teacher_name'] = $teacher['tname'];//主讲老师名称
    $result[$key]['teacher_thumb'] = tomedia($teacher['thumb']);//主讲老师头像
    $result[$key]['subject_title'] = $subject['sname'];//科目标题
    $result[$key]['subject_thumb'] = tomedia($subject['icon']);//科目的图片
    $result[$key]['address'] = $address['sname'];//上课地址
    $result[$key]['allow_appraise']= $course['allow_pl'];//是否允许评价
    $result[$key]['isSign']= $course['isSign'];//是否允许签到
    $result[$key]['is_appraise'] = empty($appraise)?0:1;//是否进行评价过
    $result[$key]['appraise'] = $appraise['count'];//评价的内容
    $result[$key]['is_try'] = $course['is_try'];//是否是试听课 1:是
    $result[$key]['OldOrNew'] = $course['OldOrNew'];//课程类型 1:自由课程 0:固定课程
    $result[$key]['ReNum']  = $course['ReNum'];//最低限购课程的课时
    $result[$key]['end']    = $course['end'];//课程的结束时间
    $result[$key]['kc_type']  = $course['kc_type'];//1线上0线下
    if($course['kc_type'] == 1){
        if($course['allow_menu'] == 1){//启用章节
            $menu_number= pdo_fetchall("SELECT id FROM " . tablename('wx_school_kc_menu') . " WHERE schoolid = '{$school_id}' And kcid = '{$value['kcid']}' ");
            $result[$key]['menu_number'] = count($menu_number);
        }else{
            $result[$key]['menu_number'] = 1;
        }
        //获取课表安排
        $timetable = pdo_fetchall("SELECT id FROM " . tablename('wx_school_kcbiao') . " WHERE schoolid = '{$school_id}' And kcid = '{$value['kcid']}' ");
        $result[$key]['ksmuber']  = count($timetable);
        $result[$key]['hssnewks'] = false;
        foreach($timetable as $k => $r){
            $hasSign =  pdo_fetch("SELECT id FROM " . tablename('wx_school_kcsign') . " WHERE sid = '{$student_id}' And ksid='{$r['id']}' And status = 2 ");
            if(empty($hasSign)){
                $result[$key]['hasSign'] = !empty($hasSign)?1:0;//该学生是否已经签到
                break;
            }
        }
    }else{
        if($course['OldOrNew'] == 0){//固定课程
            $condition1 = " kcid = '{$course['id']}' AND schoolid = '{$school_id}' AND date > '{$start}' AND date < '{$end}'";
            $condition2 = " kcid = '{$course['id']}' AND schoolid = '{$school_id}' And sid = '{$student_id}' And status= 2 AND createtime > '{$start}' AND createtime < '{$end}'";
            //获取今天的课表有多少课时
            $today = pdo_fetchcolumn('SELECT sum(costnum) FROM ' . tablename('wx_school_kcbiao') . " WHERE $condition1 ");
            $result[$key]['today'] = $today;//今天有多少节课时
            if($today){
                $result[$key]['has_timetable'] = true;//今天是否有课程
            }
            //获取课时的
            $timetableInfo = $course_model->get_student_course_timetable($value['kcid'],$student_id);
            $result[$key]['buy']  = intval($timetableInfo['buy']);//总计购买课时
            $result[$key]['sign'] = intval($timetableInfo['sign']); //已签课时
            $result[$key]['rest'] = intval($timetableInfo['rest']);//剩余课时
            $hasSign = pdo_fetch('SELECT id FROM ' . tablename('wx_school_kcsign') . " WHERE $condition2");
            $result[$key]['hasSign'] = !empty($hasSign)?1:0;//今天该学生是否已经签到
        }elseif($course['OldOrNew'] == 1){//自由课程
            $condition2 = " kcid = '{$course['id']}' AND schoolid = '{$school_id}' And sid = '{$student_id}' And status= 2 AND createtime > '{$start}' AND createtime < '{$end}'";
            //获取课时的
            $timetableInfo = $course_model->get_student_course_timetable($value['kcid'],$student_id);
            $result[$key]['buy']  = intval($timetableInfo['buy']);//总计购买课时
            $result[$key]['sign'] = intval($timetableInfo['sign']); //已签课时
            $result[$key]['rest'] = intval($timetableInfo['rest']);//剩余课时
            $hasSign = pdo_fetch('SELECT id FROM ' . tablename('wx_school_kcsign') . " WHERE $condition2");
            $result[$key]['hasSign'] = !empty($hasSign)?1:0;//今天该学生是否已经签到
        }
        if($course['start'] > time()){
            $result[$key]['type'] = '未开始';//未开始
        }
        if($course['end'] < time()){
            $result[$key]['type'] = '已结课';//已结课
        }
        if($course['start'] < time() && time() < $course['end']){
            $result[$key]['type'] = '授课中';//授课中
        }
    }
    //是否提前提醒课程结束
    if($overtime['overtime'] != 0 ){//过期日期
        //判断过期多少天之前提醒
        $overtimeRemind = $overtime['overtime'] - $course['remindday']*86400;
        if(time() > $overtimeRemind && time() < $overtime['overtime'] ){
            $result[$key]['isOver'] = 'near';
        }elseif(time() >= $overtime['overtime'] ){
            $result[$key]['isOver'] = 'over';
        }
    }
    //获取学生此课程的上课状态
    $result[$key]['status'] = $course_model->get_student_course_status($school_id,$student_id,$value['kcid']);

}
if(!empty($result)){
    $result = array_key_sorts($result,'end','desc');
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));