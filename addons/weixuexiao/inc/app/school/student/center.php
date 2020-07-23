<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/26
 * Time: 17:19
 */
/**
 * 学生角色的个人中心
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU',
    //'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);
$token = $_POST['token'];//验证用户身份

appLoad()->model('student');
$student_model = new student();
//检查用户是否登陆
$check_user = $student_model->Resolve_user_information($token);

if($check_user['status'] != 10001 || $check_user['msg'] != 'SUCCESS'){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

//app用户的信息
$user = $check_user['data'];
$school_id = intval($_GET['school_id']);//学校的id
$user_id= intval($_GET['user_id']);//绑定表的id

$all_student = $student_model->get_all_student($user['id']);
if(empty($all_student)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
//获取有效的绑定表的id
 $check_binding_user = $student_model->get_binding_id($school_id,$user_id,$user);
if($check_binding_user['status'] != 10001 || $check_binding_user['msg'] != 'SUCCESS'){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$user_id = $check_binding_user['data'];
//绑定表的信息
$user_info = pdo_fetch("SELECT id,schoolid,sid,pard,realname,mobile,uid FROM " . tablename($this->table_user) . " where  id=:id ", array(':id' =>$user_id));
//学生的信息
$student = pdo_fetch("SELECT id,status,icon,sex,s_name,bj_id,xq_id,points FROM " . tablename($this->table_students) . " where  id=:id ", array(':id' => $user_info['sid'],));

if($student['status'] == 1){//未解锁的学生进入个人中心
    json_encodeBack(array('status'=>10003,'msg'=>'该学生尚未解锁，请到个人中心解锁！'));
}

$school_id = $user_info['schoolid'];
//查看该用户是否是第一次进入用户中心页面
$is_guide = $student_model->student_guide($user['id']);

if($is_guide){
    //没进入过新手引导页面，则需要跳到新手引导页面
    $guide = $student_model->novice_guide($school_id,1);
    if($guide){
        //在返回数据之前，改变该教师的状态
        pdo_update($this->table_user, array('is_frist' => 2), array('id' => $user_id));
        json_encodeBack(array('status'=>10004,'msg'=>'您尚未使用引导图，是否需要使用引导图！','data'=>array('guide'=>$guide,'school_id'=>$school_id)));
    }
}

//学生的班级信息
$class = pdo_fetch("SELECT sname,qun FROM " .tablename($this->table_classify) . " WHERE  :sid = sid ", array(':sid' => $student['bj_id']));
//学生的年级信息
$grade = pdo_fetch("SELECT sname,qun FROM " .tablename($this->table_classify) . " WHERE  :sid = sid ", array(':sid' => $student['xq_id']));
//获取学校信息
$school = pdo_fetch("SELECT title,spic,is_rest,shoucename,is_video,videoname,is_zjh,is_recordmac,gonggao,copyright,Is_point,is_chongzhi,is_shoufei,is_buzhu FROM " . tablename($this->table_index) . " where id='{$user_info['schoolid']}'");
$resttz = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_record)." WHERE sid = '{$user_info['sid']}' And (type = 1 Or type = 3) And readtime < 1 And userid = '{$user_info['id']}' ");
$restzy = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_record)." WHERE sid = '{$user_info['sid']}' And type = 2 And readtime = '0' And userid = '{$user_info['id']}' ");
//多少个未读留言
$restly = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_leave)." WHERE touserid = '{$user_info['id']}' And isliuyan = 2 And isread = 1 ");
$icons1 = pdo_fetchall("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = '{$school_id}' And place = 3 And status = 1 ORDER by id ASC");
$stutop = pdo_fetch("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = '{$school_id}' And place = 12 ");
foreach($icons1 as $key => $row){
    $icons1[$key]['salfcard'] = false;
    $icons1[$key]['ismassges'] = false;
    if(strpos($row['url'],'szuoyelist')){
        $icons1[$key]['ismassges'] = true;
        $icons1[$key]['shengyu'] = $restzy;
    }
    if(strpos($row['url'],'snoticelist')){
        $icons1[$key]['ismassges'] = true;
        $icons1[$key]['shengyu'] = $resttz;
    }
    if(strpos($row['url'],'slylist')){
        $icons1[$key]['ismassges'] = true;
        $icons1[$key]['shengyu'] = $restly;
    }
    if(strpos($row['url'],'salfcard')){
        $icons1[$key]['salfcard'] = true;
    }
}

$icons2 = pdo_fetchall("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = '{$school_id}' And place = 4 And status = 1 ORDER by id ASC");
foreach($icons2 as $key => $row){
    $icons2[$key]['salfcard'] = false;
    if(strpos($row['url'],'salfcard')){
        $icons2[$key]['salfcard'] = true;
    }
}
$icons3 = pdo_fetchall("SELECT * FROM " . tablename($this->table_icon) . " where schoolid = '{$school_id}' And place = 5 And status = 1  ORDER by id ASC");
foreach($icons3 as $key => $row){
    $icons3[$key]['salfcard'] = false;
    if(strpos($row['url'],'salfcard')){
        $icons3[$key]['salfcard'] = true;
    }
}
$student_model->check_pay($school_id, $student['id'], $user_id,$user_info['uid']);
$result = array(
    'school'=>array(
        'title'=>$school['title'],//学校标题
        'is_point'=>$school['Is_point'],//是否开启积分抵用
        'is_chongzhi'=>$school['is_chongzhi'],//是否启动充值
        'is_shoufei'=>$school['is_shoufei'],//学生钱包
        'gonggao'=>$school['gonggao'],//学校公告
        'copyright'=>$school['copyright'],//底部版权
        'is_rest'=>$school['is_rest'],//是否展示在校表现
        'shoucename'=>$school['shoucename'],//在线表现的标题
        'is_video'=>$school['is_video'],//是否展示我的视频
        'videoname'=>$school['videoname'],//我的视频的标题
        'is_zjh'=>$school['is_zjh'],//是否展示周计划
        'is_recordmac'=>$school['is_recordmac'],//是否展示考勤
    ),
    'all_student'=>$all_student,//绑定的所有学生身份
    'student'=>array(
        'id'=>$student['id'],//学生的id
        'name'=>$student['s_name'],//学生的名字
        'sex'=>$student['sex'],//性别
        'class_id'=>$student['bj_id'],//班级的id
        'grade_id'=>$student['xq_id'],//年级的id
        'icon'=>tomedia($student['icon'])?tomedia($student['icon']):tomedia($school['spic']),//学生的头像
        'relationship'=>getRelationship($user_info['pard']),//关系
        'points'=>$student['points'],//学生的积分
        'class'=>$class['sname'],//班级
        'qun'=>$class['qun'],//班级的QQ群
        'grade'=>$grade['sname'],//年级
        'unpaid'=>$student_model->check_unpaid($student['id']),//获取未缴费的数目
    ),
    'icon1'=>$icons1,
    'icon2'=>$icons2,
    'icon3'=>$icons3,
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
