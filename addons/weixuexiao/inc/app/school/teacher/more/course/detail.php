<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/19
 * Time: 15:12
 */
/**
 * 教师的课程详情
 */
$course_id = intval($_GET['id'])?intval($_GET['id']):0;//课程id not null
$is_own = intval($_GET['teacher_id'])?true:false;//老师的id 有的话查看指定老师的课堂信息，没有的话，查看自己的课堂信息
$owner = $_GET['type']?true:false;//是否只查看自己的课程 是否只查看自己的课程 身份：年级主任或者校长
$teacher_id = intval($_GET['teacher_id']);

appLoad()->model('course');
$model = new course();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$mine_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo,bjqstyle,Is_point,mallsetinfo,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$mine_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

//判断是不是指定了老师
if(!$is_own){
    $teacher_id = $mine_id;//老师的id
}

//获取课程信息
$course = pdo_fetch("SELECT id,tid,OldOrNew,start,end,isSign,maintid,xq_id,bj_id,km_id,name,adrr,ReNum,RePrice,signTime FROM " . tablename($this->table_tcourse) . " WHERE id = '{$course_id}' and schoolid ='{$school_id}' ");

if(empty($course)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！！'));
}
//获取学校的年级，班级，科目，教室等信息
$category = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$school_id}' ");
//把id作为键，返回新的数组
$category = set_array_key($category,'id');

//获取老师信息 判断是不是获取主讲老师的信息
if(!$is_own && $course['maintid'] != 0){
    $teacher = pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " where id = '{$course['maintid']}' AND schoolid = '{$school_id}' ");
}else{
    $teacher = pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " where id = '{$teacher_id}' AND schoolid = '{$school_id}' ");
}
$teacher['name'] = $teacher['tname'];
unset($teacher['tname']);
$teacher['thumb'] = tomedia($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);//老师图像
//课程信息
$course_info = array();
//课程名称
$course_info['name'] = $course['name'];
//开始时间
$course_info['start'] = date('Y/m/d',$course['start']);
//结束时间
$course_info['end'] = date('Y/m/d',$course['end']);
//是否展示签到功能 在次课程开启签到功能并且查看自己的课程时才开启签到功能
$course_info['is_sign'] = $course['isSign'];
//起续课时数
$course_info['num'] = $course['ReNum'];
//续费价格/课时
$course_info['price'] = $course['RePrice'];
//提前多少秒可以签到
$course_info['sign_time'] = TIMESTAMP + $course['signTime']*60;
//年级
if(!empty($course['xq_id'])){
    $course_info['grade'] = $category[$course['xq_id']]['name'];
}
//班级
if(!empty($course['bj_id'])){
    $course_info['class'] = $category[$course['bj_id']]['name'];
}
//科目
if(!empty($course['km_id'])){
    $course_info['subject'] = $category[$course['km_id']]['name'];
}
//授课教室
if(!empty($course['adrr'])){
    $course_info['address'] = $category[$course['adrr']]['name'];
}
//查看授课老师列表
$teaching = array();
foreach(explode(',',$course['tid']) as $key_t => $value_t) {
    $teaching_teacher =  pdo_fetch("SELECT id,tname FROM " . tablename($this->table_teachers) . " WHERE schoolid = :schoolid And id = :id", array(':schoolid' => $school_id,':id' => $value_t));
    $teaching[] = $teaching_teacher;
}
$course_info['teacher']=$teaching;
//获取今天开始和结束的时间戳
$start = mktime(0,0,0,date("m"),date("d"),date("Y"));
$end = $start + 86399;
if($course['OldOrNew'] == 0){//固定课时
    //获取课程的上课安排
    $list = pdo_fetchall("SELECT id,isxiangqing,date,sd_id FROM " . tablename($this->table_kcbiao) . " WHERE schoolid ='{$school_id}' AND kcid = '{$course_id}' ORDER BY date ASC");
    foreach( $list as $key => $value ){
        //获取老师是否签到
        $check_sign = pdo_fetch("SELECT id FROM " . tablename($this->table_kcsign) . " WHERE schoolid='{$school_id}' AND  ksid = '{$value['id']}' AND kcid='{$course_id}' AND tid='{$teacher_id}' And status=2 ");
        //获取其他老师是否签到
        $check_other_sign = pdo_fetch("SELECT id FROM " . tablename($this->table_kcsign) . " WHERE schoolid='{$school_id}' AND  ksid = '{$value['id']}' AND kcid='{$course_id}' And tid!='{$teacher_id}' AND sid=0 And status=2 ");
        $list[$key]['check_sign'] = !empty($check_sign)?1:0;//是否签到
        $list[$key]['check_other_sign'] = !empty($check_other_sign)?1:0;//其他人是否签到
        $list[$key]['num'] = $key +1;//第几课时
        $list[$key]['nub'] = $category[$value['sd_id']]['name'];

    }
    //获取今天的此课程上课信息
    $today_course_class = pdo_fetchall("select id FROM ".tablename($this->table_kcbiao)." WHERE date>='{$start}' AND date<='{$end}' And kcid = '{$course_id}' ORDER BY date ASC");

    //获取今天的所有上课信息
    if(!$owner){
        $today_class =pdo_fetchall("select id,sd_id FROM ".tablename($this->table_kcbiao)." WHERE date>='{$start}' AND date<='{$end}' And kcid = '{$course_id}' and  tid='{$teacher_id}' ORDER BY date ASC");
    }else{
        $today_class =pdo_fetchall("select id,sd_id FROM ".tablename($this->table_kcbiao)." WHERE date>='{$start}' AND date<='{$end}' And kcid = '{$course_id}' ORDER BY date ASC ");
    }

    foreach($today_class as $key_ks => $value_ks ) {
        $sd = pdo_fetch("select sname FROM ".tablename($this->table_classify)." WHERE sid='{$value_ks['sd_id']}'");
        $today_class[$key_ks]['sdname'] = $sd['sname'];
    }
    //今天上课的签到情况
    if (!empty($today_course_class)){
        foreach($today_course_class as $to_key=>$to_value){
            //判断此课堂有没有其他老师签到
            $has_sign = pdo_fetch("select id FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND ksid = '{$to_value['id']}' AND tid!='{$teacher_id}' and sid=0 and status=2 ");
            //判断此课堂我有没有签到
            $mine_sign = pdo_fetch("select id,status FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND ksid = '{$to_value['id']}' AND tid='{$teacher_id}' ");
            $today_course_class[$to_key]['has_other_sign'] = !empty($has_sign)?1:0;
            $today_course_class[$to_key]['mine_sign'] = !empty($mine_sign)?1:0;
        }
    }
    $result = array(
        'is_own'=>$is_own?1:0,//是不是指定获取那个老师的信息 1：获取指定老师的信息，0：获取自己的信息
        'owner'=>!$owner?1:0,//获取一位老师的上课信息还是所有老师 1：一位，0：所有
        'teacher'=>$teacher,//老师基本信息
        'course'=>$course_info,//课程的基本信息
        'list'=>$list,//所有的上课老师签到信息
        'today_class'=>$today_class,//今天上课的时段信息
        'today_course_class'=>$today_course_class,//今天上课的签到信息
    );
    json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
}else{
    //获取今天的此课程上课信息
    $today_course_class = pdo_fetchall("select id FROM ".tablename($this->table_kcbiao)." WHERE date>='{$start}' AND date<='{$end}' And kcid = '{$course_id}' ORDER BY date ASC");
    //判断此课堂有没有其他老师签到
    $has_sign = pdo_fetch("select id FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND ksid = '{$to_value['id']}' AND tid!='{$teacher_id}' and sid=0 and status=2 ");
    //判断此课堂我有没有签到
    $mine_sign = pdo_fetch("select id,status FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND ksid = '{$to_value['id']}' AND tid='{$teacher_id}' ");
    if (!empty($today_course_class)){
        foreach($today_course_class as $to_key=>$to_value){
            //判断此课堂有没有其他老师签到
            $has_sign = pdo_fetch("select id FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND ksid = '{$to_value['id']}' AND tid!='{$teacher_id}' and sid=0 and status=2 ");
            //判断此课堂我有没有签到
            $mine_sign = pdo_fetch("select id,status FROM ".tablename($this->table_kcsign)." WHERE createtime>='{$start}' AND createtime<'{$end}' And kcid = '{$course_id}' AND ksid = '{$to_value['id']}' AND tid='{$teacher_id}' ");
            $today_course_class[$to_key]['has_other_sign'] = !empty($has_sign)?1:0;
            $today_course_class[$to_key]['mine_sign'] = !empty($mine_sign)?1:0;
        }
    }
    //获取所有的签到
    if(!$is_own){
        $sign_list =  pdo_fetchall("select id,createtime FROM ".tablename($this->table_kcsign)." WHERE schoolid='{$school_id}' And kcid = '{$course_id}' And sid=0 And status=2 ");
    }else{
        $sign_list =  pdo_fetchall("select id,createtime FROM ".tablename($this->table_kcsign)." WHERE schoolid='{$school_id}' And kcid = '{$course_id}' And tid={$teacher_id} And status=2 ");
    }
    foreach ($sign_list as $s_key=>$s_value){
        $sign_list[$s_key]['num']= $s_key+1;//签到次数
    }
    $result = array(
        'is_own'=>$is_own?1:0,//是不是指定获取那个老师的信息 1：获取指定老师的信息，0：获取自己的信息
        'owner'=>!$owner?1:0,//获取一位老师的上课信息还是所有老师 1：一位，0：所有
        'teacher'=>$teacher,//老师基本信息
        'sign_list'=>$sign_list,//课程的基本信息
        'today_course_class'=>$today_course_class,//今天上课的签到信息
    );
    json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
}
