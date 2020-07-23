<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/12
 * Time: 17:12
 */
/**
 * 学生课程的详情
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

$course_id = $_GET['course_id'];//课程的id
$course = pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " where id = '{$course_id}' ");
//教室地址
$address = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['adrr']}'")['sname'];
//年级
$grade = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['xq_id']}'")['sname'];
//班级
$class = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['bj_id']}'")['sname'];
//科目
$subject = pdo_fetch("SELECT sname,sid FROM " . tablename($this->table_classify) . " WHERE sid = '{$course['km_id']}'")['sname'];
//获取授课老师数组
$teacher_array = explode(',',$course['tid']);//授课老师
$teacher_array = array_unique($teacher_array);//去重
$teacher_result = array();
foreach ($teacher_array as $key=>$value){
    $teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$value}'");
    $teacher_result[$key]['id'] = $teacher['id'];
    $teacher_result[$key]['name'] = $teacher['tname'];
    $teacher_result[$key]['thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) : tomedia($teacher['thumb']);
}

//主讲老师
if(!empty($course['maintid'])){//有主讲老师直接获取主讲老师的信息
    $speaker_teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$course['maintid']}'");
}else{//没有主讲老师则获取授课老师中第一位老师的信息
    $speaker_teacher =  pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " WHERE id = '{$teacher_array[0]}'");
}
$speaker['id'] = $speaker_teacher['id'];
$speaker['name'] = $speaker_teacher['tname'];
$speaker['thumb'] = empty($speaker_teacher['thumb']) ? tomedia($school['tpic']) : tomedia($speaker_teacher['thumb']);
//获取课程的总课时,签到课时和购买课时
$info = $course_model->get_student_course_timetable($course_id,$student_id);
$info['AllNum'] = $course['AllNum'];//总共多少课时
if($course['kc_type'] == 1){//线上课程
    if($course['allow_menu'] == 1){//启用章节
        $menu_number= pdo_fetchall("SELECT id,name FROM " . tablename('wx_school_kc_menu') . " WHERE schoolid = '{$school_id}' And kcid = '{$course_id}' ");
    }else{
        $menu_number = array(array('name' => '课程排课'));
    }
    $read = 0;//已读
    $number = 1;//多少节
    $menu_nub = 0;//多少章
    foreach($menu_number as $k => $item){
        $condition = " ";
        if($course['allow_menu'] == 1){//启用章节
            $condition = " And menu_id = '{$item['id']}' ";
        }
       // content_type:0富文本1直播2视频3语音4纯图5文档
        $menu_number[$k]['list'] = pdo_fetchall("SELECT id,name FROM " . tablename('wx_school_kcbiao') . " WHERE schoolid = '{$school_id}' And kcid = '{$course_id}' $condition ORDER BY ssort DESC ");
        foreach($menu_number[$k]['list'] as $key => $row){
            $menu_number[$k]['list'][$key]['read'] = false;
            $is_sign = pdo_fetch("SELECT id FROM " . tablename('wx_school_kcsign') . " WHERE ksid = '{$row['id']}' And sid = '{$student_id}'");
            if(!empty($is_sign)){
                $menu_number[$k]['list'][$key]['read'] = true;
                $read++;
            }
            $menu_number[$k]['list'][$key]['number'] = $number;
            $number ++;
        }
        $menu_nub++;
    }
    $info['read'] = $read;//已读多少节
    $info['number'] = $number-1;//总共多少节
    $info['menu_nub'] = $menu_nub;//多少章
    $info['speed'] = $read/($number-1)*100;//进度百分比
    $info['list'] = $menu_number;
}else{//线下课程
    //今天的时间戳段
    $start = mktime(0,0,0,date("m"),date("d"),date("Y"));
    $end= $start + 86399;

    if($course['OldOrNew'] == 0){
        $condition1 = " kcid = '{$course['id']}' AND schoolid = '{$school_id}' AND date > '{$start}' AND date < '{$end}'";
        $condition2 = " kcid = '{$course['id']}' AND schoolid = '{$school_id}' And sid = '{$student_id}' And status= 2 AND createtime > '{$start}' AND createtime < '{$end}'";
        //获取今天的课表有多少课时
        $today = pdo_fetchcolumn('SELECT sum(costnum) FROM ' . tablename('wx_school_kcbiao') . " WHERE $condition1 ");
        $info['today'] = $today;//今天有多少节课时
        $info['has_timetable'] = false;
        if($today){
            $info['has_timetable'] = true;//今天是否有课程
        }
        $hasSign = pdo_fetch('SELECT id FROM ' . tablename('wx_school_kcsign') . " WHERE $condition2");
        $info['hasSign'] = !empty($hasSign)?1:0;//今天该学生是否已经签到
        //获取学生的课程签到记录
        $info['sign_info'] = $course_model->get_course_sign_info($course_id,$student_id,$course['OldOrNew']);
    }else{
        $condition2 = " kcid = '{$course['id']}' AND schoolid = '{$school_id}' And sid = '{$student_id}' And status= 2 AND createtime > '{$start}' AND createtime < '{$end}'";
        $hasSign = pdo_fetch('SELECT id FROM ' . tablename('wx_school_kcsign') . " WHERE $condition2");
        $info['hasSign'] = !empty($hasSign)?1:0;//今天该学生是否已经签到
        //获取学生的课程签到记录
        $info['sign_info'] = $course_model->get_course_sign_info($course_id,$student_id,$course['OldOrNew']);
    }
}
$result = array(
    'id'=>$course_id,//课程的id
    'title'=>$course['name'],
    'address'=>$address,//上课地点
    'grade'=>$grade,//年纪
    'class'=>$class,//班级
    'subject'=>$subject,//科目
    'speaker'=>$speaker,//主讲老师
    'teacher'=>$teacher_result,//授课老师
    'allow_pl'=>$course['allow_pl'],//是否允许评论
    'course_date'=>date('Y/m/d',$course['start']).'-'.date('Y/m/d',$course['end']),//课程的时间
    'OldOrNew'=>$course['OldOrNew'],//0:固定课程,1:自由课程
    'info'=>$info,
);
dump($result);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));