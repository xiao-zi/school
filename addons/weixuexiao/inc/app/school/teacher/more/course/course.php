<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/18
 * Time: 13:39
 */
/**
 * 教师的课程列表
 */

$gradeId = intval($_GET['id'])?intval($_GET['id']):0;//年级id
$owner = $_GET['type']?true:false;//是否只查看自己的课程 身份：年级主任或者校长

appLoad()->model('course');
$model = new course();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo,bjqstyle,Is_point,mallsetinfo,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//找出没有毕业的班级
//$classList = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'theclass' and is_over!=2 ORDER BY CONVERT(sname USING gbk) ASC");
//$classArr = array_column($classList,'sid');
//array_unshift($classArr,0);
//$classStr = implode(',',$classArr);
//找出没有毕业的年级
$gradeList = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And type = 'semester' and is_over!=2 ORDER BY CONVERT(sname USING gbk) ASC");
$gradeArr = array_column($gradeList,'sid');
array_unshift($gradeArr,0);
$gradeStr = implode(',',$gradeArr);

if(!in_array($gradeId,$gradeArr)){
    json_encodeBack(array('status'=>10004,'msg'=>'该年级已毕业或者不存在！！'));
}
appLoad()->model('teacher');
$teacher_model = new teacher();
//是不是年级主任
$isGradeDirector = $teacher_model->is_grade_director($teacher_id);

if($owner){//只展示自己的课程
    if($gradeId != 0){ //指定年级
        //获取指定年级课程的列表
        $list = pdo_fetchall("SELECT id,name,km_id,adrr,thumb,OldOrNew,AllNum,start,end,is_remind_pj,maintid FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}'  And xq_id ='{$gradeId}' AND (tid like '{$teacher_id},%' OR tid like '%,{$teacher_id}' OR tid like '%,{$teacher_id},%' OR tid='{$teacher_id}') ORDER BY end DESC");
    }else{ //不指定年级
        //获取所有没有毕业年级课程的列表
        $list = pdo_fetchall("SELECT id,name,km_id,adrr,thumb,OldOrNew,AllNum,start,end,is_remind_pj,maintid FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}'  AND (tid like '{$teacher_id},%' OR tid like '%,{$teacher_id}' OR tid like '%,{$teacher_id},%' OR tid='{$teacher_id}') and FIND_IN_SET(xq_id,'{$gradeStr}')  ORDER BY end DESC");
    }
    $courseIdStr = array_column($list,'id');//课程的id字符串
    $total_sign =  pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->table_kcsign) . " WHERE schoolid = '{$school_id}' And tid = {$teacher_id} and sid = 0 And status= 2 and FIND_IN_SET(kcid,'{$courseIdStr}') ");
    $fixed_sign = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->table_kcsign) . " WHERE schoolid = '{$school_id}' And tid = {$teacher_id} and sid = 0 And status= 2 And type=0 and  FIND_IN_SET(kcid,'{$courseIdStr}')");
    $free_sign = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->table_kcsign) . " WHERE schoolid = '{$school_id}' And tid = {$teacher_id} and sid = 0 And status= 2 And type =1 and FIND_IN_SET(kcid,'{$courseIdStr}')" );
    $data = array(
        'total_sign'=>$total_sign,//总课时签到
        'fixed_sign'=>$fixed_sign,//固定课时签到
        'free_sign'=>$free_sign,//自由课时签到
        'owner'=>1,//是否只展示自己的授课信息，1 ：是，0 ： 不是
    );
}else{//展示所有的课程
    if($gradeId != 0){//指定年级
        if($teacher['status'] == 2){//若为校长
            //找出该学校的所有的班级和年级
            $list = pdo_fetchall("SELECT id,name,km_id,adrr,thumb,OldOrNew,AllNum,start,end,is_remind_pj,maintid FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}'  And xq_id ='{$gradeId}'  ORDER BY end  DESC");
        }elseif($isGradeDirector){//判断是不是年级主任
            $teacherGradeArr = array_column($isGradeDirector,'sid');//老师负责的年级的sid字符串
            $teacherGradeStr = implode(',',$teacherGradeArr);////老师负责的年级的sid字符串
            if(!in_array($gradeId,$teacherGradeArr)){
                json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看该年级的所有的授课信息！！'));
            }
            //找出该学校的所有的班级和年级
            $list = pdo_fetchall("SELECT id,name,km_id,adrr,thumb,OldOrNew,AllNum,start,end,is_remind_pj,maintid FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}'  And xq_id ='{$gradeId}'  ORDER BY end DESC, xq_id DESC");
        }else{
            json_encodeBack(array('status'=>10005,'msg'=>'您没有权限查看年级的所有的授课信息！！'));
        }
    }else{//不指定年级
        if($teacher['status'] == 2){//若为校长
            //找出该学校的所有的班级和年级
            $list = pdo_fetchall("SELECT id,name,km_id,adrr,thumb,OldOrNew,AllNum,start,end,is_remind_pj,maintid FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}' and FIND_IN_SET(xq_id,'{$gradeStr}')  ORDER BY end DESC, xq_id DESC");
        }elseif($isGradeDirector){//判断是不是年级主任
            $teacherGradeArr = array_column($isGradeDirector,'sid');//老师负责的年级的sid字符串
            $teacherGradeStr = implode(',',$teacherGradeArr);//老师负责的年级的sid字符串
            //找出该老师负责的所有的年级
            $list = pdo_fetchall("SELECT id,name,km_id,adrr,thumb,OldOrNew,AllNum,start,end,is_remind_pj,maintid FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}' and FIND_IN_SET(xq_id,'{$teacherGradeStr}')  ORDER BY end DESC, xq_id DESC");
        }else{
            json_encodeBack(array('status'=>10005,'msg'=>'您没有权限查看所有年级的授课信息！！'));
        }
    }
    $data = array(
        'owner'=>0,//是否只展示自己的授课信息，1 ：是，0 ： 不是
    );
}
if($teacher['status'] == 2){//若为校长
    $data['status'] = 2;
    //找出所有的年级信息
    $all_grade = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$school_id}' AND type='semester' and is_over != 2  ORDER BY  CONVERT(sname USING gbk) ASC");
}elseif($teacherGradeStr){//判断是不是年级主任
    $data['status'] = 1;
    $all_grade = $teacherGradeStr;
}else{
    $data['status'] = 0;
}
//教师的课程列表
if(!empty($all_grade)){
    $data['all_grade'] = $all_grade;
}

$result = array();
$start = mktime(0,0,0,date("m"),date("d"),date("Y"));
$end = $start + 86399;
foreach($list as $key => $row){
    $subject  = pdo_fetch("SELECT sname,icon FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$school_id}' And sid = '{$row['km_id']}'");
    $address = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$school_id}' And sid = '{$row['adrr']}'");
    $result[$key]['id'] = $row['id'];//0：固定课时 1：自由课程
    $result[$key]['name'] = $row['name'];//课程标题
    $result[$key]['thumb'] = empty($row['thumb'])?tomedia($subject['icon']): tomedia($row['thumb']);//课程图片
    $result[$key]['teacher'] = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where  id= '{$row['maintid']}'");//主讲老师
    $result[$key]['subject'] = $subject['sname'];//上课科目
    $result[$key]['address'] = $address['sname'];//上课地址
    $result[$key]['course_type'] = $row['OldOrNew'];//0：固定课时 1：自由课程is_remind_pj
    $result[$key]['remind_sign'] = $row['is_remind_pj'];//是否之前提醒过家长对此课程进行评价 0：没有 1：有
    if($row['OldOrNew'] == 0){
        if($owner){//只展示自己的课程
            //排课安排
            $today = pdo_fetchall('SELECT id FROM ' . tablename($this->table_kcbiao) . " WHERE kcid = '{$row['id']}' AND schoolid = '{$school_id}' And tid='{$teacher_id}' AND date > '{$start}' AND date < '{$end}' ");
            //统计今天需要上多少课时
            $result[$key]['restks'] = count($today);
            if($today){
                $result[$key]['today'] = 1;//查看该教师今天有课吗
            }else{
                $result[$key]['today'] = 0;//查看该教师今天有课吗
            }
        }else{
            $today = pdo_fetchall('SELECT id FROM ' . tablename($this->table_kcbiao) . " WHERE kcid = '{$row['id']}' AND schoolid = '{$school_id}' AND date > '{$start}' AND date < '{$end}' ");
            $result[$key]['restks'] = count($today);
        }
    }
    if($row['OldOrNew'] == 1){ //查询签到课时和剩余课时
        //查询老师已经签到的次数来判断已经上了多少堂课
        $sign = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->table_kcsign) . " WHERE kcid = '{$row['id']}' AND schoolid = '{$school_id}' And tid !=0 and sid = 0  And status= 2 ");
        $class = array(
            'total'=>$row['AllNum'],//总课时
            'sign'=>$sign,//已签到课时
            'residue'=>$row['AllNum'] - $sign,//剩余课时
        );
        $result[$key]['class']=$class;
    }

    if($owner){//只展示自己的课程
        $is_today_sign = pdo_fetch('SELECT id FROM ' . tablename($this->table_kcsign) . " WHERE kcid = '{$row['id']}' AND schoolid = '{$school_id}' And tid = '{$teacher_id}' And status = 2  AND createtime > '{$start}' AND createtime < '{$end}'");
        if($is_today_sign){
            $result[$key]['is_today_sign'] = 1;//判断老师今天是否签到
        }else{
            $result[$key]['is_today_sign'] = 0;//判断老师今天是否签到
        }
    }

    if($row['start'] > time()){
        $result[$key]['type'] = 1;//未开始
    }
    if($row['end'] < time()){
        $result[$key]['type'] = 2;//已结课
    }
    if($row['start'] < time() && time() < $row['end']){
        $result[$key]['type'] = 3;//授课中
    }
    //判断是否需要提醒学生家长对此课程进行评价  （授课时间结束，之前没有提醒过，学校开通评价）
    if($row['end'] < time() && $row['is_remind_pj'] == 0 && $school['is_star'] == 1){
        $result[$key]['remind'] = 1;
    }else{
        $result[$key]['remind'] = 0;
    }
}
$data['list'] = $result;
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$data));