<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/9
 * Time: 10:33
 */
/**
 * 教师中心入口
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);
$token = $_POST['token'];//验证用户身份
$school_id = $_GET['school_id'];//学校的id
if(empty($token)){
    json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
}
$tokenResult = decryptToken($token);
if($tokenResult['status'] != 10001){
    json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
}
$user_id = $tokenResult['data']['user']['id'];
appLoad()->model('teacher');
appLoad()->model('common');
$teacher = new teacher();
$common = new common();
//获取该老师的所有学校列表
$all_school = $teacher->get_school($user_id);

//如果没有找到该用户的学校列表，则返回通知结果，让起跳转到绑定页面
if(empty($all_school)){
    json_encodeBack(array('status'=>'10004','msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
//如果没有传获取那个学校的教师中心，则在该教师的所有学校列表中随机获取一个学校展示
if(empty($school_id)){
    $school_id = $all_school[rand(0,count($all_school)-1)]['schoolid'];
}
//通过用户信息和学校信息获取老师信息
$teacher_user = pdo_fetch("select tid,is_allowmsg,userinfo from ". tablename($this->table_user)." where schoolid = {$school_id} and userid = {$user_id} and type = 2 And sid = 0 ");
$teacher_id = $teacher_user['tid'];

//查看该教师是否是第一次进入教师中心页面
$is_guide = $teacher->teacher_guide($user_id);
if($is_guide){
    //没进入过新手引导页面，则需要跳到新手引导页面
    $guide = $common->novice_guide($school_id,2);
    if($guide){
        //在返回数据之前，改变该教师的状态
        pdo_update($this->table_user, array('is_frist' => 2), array('id' => $teacher_id));
        json_encodeBack(array('status'=>'10005','msg'=>'您尚未使用引导图，是否需要使用引导图！','data'=>array('guide'=>$guide,'school_id'=>$school_id)));
    }
}

$teacherConfig = getAppConfig('teacher');
//获取老师的授课和班级信息
$course = array();
if($teacherConfig['COURSE'] == 1){
    //获取老师的授课信息
    $course['course'] = $teacher->get_course($teacher_id,$school_id,3);
}elseif($teacherConfig['COURSE'] == 2){
    //获取老师的班级信息
    $course['class'] = $common->get_course($school_id, $teacher_id, 'teacher');
}elseif($teacherConfig['COURSE'] == 3){
    $course['course'] = $teacher->get_course($teacher_id,$school_id,3);
    $course['class'] = $common->get_course($school_id, $teacher_id, 'teacher');
}
//获取学校信息
$school = pdo_fetch("SELECT id,title,tpic,is_star,is_wxsign,is_recordmac FROM " . tablename($this->table_index) . " where id = {$school_id} ORDER BY ssort DESC");
//获取教师的信息
$teacher_info = pdo_fetch("SELECT * FROM " . tablename($this->table_teachers) . " where id = {$teacher_id}");
//查看教师是否有没有完成的任务
$point_task = $teacher->check_point_task($teacher_info['tid'], $school_id) ? $teacher->check_point_task($teacher_info['tid'], $school_id) : 0;
//获取所有该教师在该学校的担当班主任的班级
$class_list = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And tid = '{$teacher_info['id']}'And type = 'theclass' ORDER BY sid ASC, ssort DESC");
//格式化userinfo
//$userinfo = iunserializer($teacher_user['userinfo']);

$tid_global = $teacher_id ? $teacher_id : 0;
//更多功能
//$icon_type = pdo_fetchall("SELECT title,id,ssort FROM ".tablename('wx_school_icontype')." WHERE schoolid = '{$school_id}' AND place = 13 ORDER BY ssort DESC");

//查出所有icon
$icon_list = pdo_fetchall("SELECT id,name,icon,do,typeid FROM " . tablename($this->table_icon) . " where schoolid = '{$school_id}' And place = 13 $condition ORDER by ssort ASC");

foreach($icon_list as $k => $v){

    $index = $v['typeid'];
    //我的公开课
    if ($v['do'] == 'gkklist') {
        $icon_type[$index]['hasdata'][] = $v;
    }
    //评价的公开课
    if ($v['do'] == 'gkkpjjl') {
        $icon_type[$index]['hasdata'][] = $v;
    }
    //留言
    if ($v['do'] == 'tlylist') {
        $icon_type[$index]['hasdata'][] = $v;
    }

    if ($v['do'] == 'noticelist') {
        if (IsHasQx($tid_global, 2000101, 2, $school_id)) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'smssage') {
        if ((IsHasQx($tid_global, 2000401, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }
    if ($mallsetinfo['isShow'] == 1) {
        if ($v['do'] == 'goodslist') {
            if ((IsHasQx($tid_global, 2001701, 2, $school_id))) {
                $icon_type[$index]['hasdata'][] = $v;
            }
        }
    }

    if ($v['do'] == 'todolist') {
        if ((IsHasQx($tid_global, 2001201, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'cyylist') {
        if ((IsHasQx($tid_global, 2001301, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tmycourse') {
        if ((IsHasQx($tid_global, 2001401, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tkcsignall') {
        if ((IsHasQx($tid_global, 2001501, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tyzxx') {
        if ((IsHasQx($tid_global, 2001801, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tmssage') {
        if ((IsHasQx($tid_global, 2001001, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'mnoticelist') {
        if ((IsHasQx($tid_global, 2000101, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'zuoyelist') {
        if ((IsHasQx($tid_global, 2000301, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'yjfx') {
        if ((IsHasQx($tid_global, 2001901, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'bjq') {
        $icon_type[$index]['hasdata'][] = $v;
    }

    if ($v['do'] == 'xclist') {
        if ((IsHasQx($tid_global, 2001601, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'stulist') {
        if ((IsHasQx($tid_global, 2000501, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'bmlist') {
        if ((IsHasQx($tid_global, 2000701, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'signlist') {
        if ((IsHasQx($tid_global, 2000601, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'jschecklog') {
        if ((IsHasQx($tid_global, 2001101, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tongxunlu') {
        $icon_type[$index]['hasdata'][] = $v;
    }

    if ($v['do'] == 'tzjhlist') {
        if ((IsHasQx($tid_global, 2000901, 2, $school_id)) || (IsHasQx($tid_global, 2000911, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'shoucelist') {
        if ((IsHasQx($tid_global, 2000801, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'schoolbus') {
        if ((IsHasQx($tid_global, 2003101, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    $tuiguang = check_app('tuiguang',$weid,$school_id);
    if ($v['do'] == 'trykclist') {
        if($tuiguang){
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tmyscore') {
        if ((IsHasQx($tid_global, 2002001, 2, $school_id)) && is_showpf() ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tscoreall') {
        if ((IsHasQx($tid_global, 2002101, 2, $school_id)) && is_showpf() ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tallcamera') {
        if (((IsHasQx($tid_global, 2002501, 2, $school_id)) && !$_W['schooltype'])) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tstuapinfo') {
        if ((IsHasQx($tid_global, 2002301, 2, $school_id)) && is_showap()) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tvisitors') {
        if(vis()){
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'assetslist' ) {
        if( assets() || CheckSchoolSet($school_id,'is_gw') ){
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'assetsshenqing') {
        if ((IsHasQx($tid_global, 2003001, 2, $school_id)) && assets() && CheckSchoolSet($school_id,'is_gw') ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'assetsfix') {
        if (assets() || CheckSchoolSet($school_id,'is_gw') ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'assetsfixlist') {
        if ((IsHasQx($tid_global, 2003002, 2, $school_id)) && assets() && CheckSchoolSet($school_id,'is_gw') ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'roomreserve') {
        if (assets() || CheckSchoolSet($school_id,'is_csyd') ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'roomreservelist') {
        if ((IsHasQx($tid_global, 2002901, 2, $school_id)) && assets() && CheckSchoolSet($school_id,'is_csyd') ) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tremind') {
        if(is_TestFz()){
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tqzkh') {
        if(is_TestFz()){
            if($teacher['status'] == 2){
                $icon_type[$index]['hasdata'][] = $v;

            }
        }
    }

    if ($v['do'] == 'tstuscore') {
        if ((IsHasQx($tid_global, 2002201, 2, $school_id)) && is_showpf()) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'chengjireview') {
        if ((IsHasQx($tid_global, 2002401, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tsencerecord') {
        if ((IsHasQx($tid_global, 2002601, 2, $school_id))) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'teatimetable') {
        if ((IsHasQx($tid_global, 2002701, 2, $school_id)) && is_showgkk()) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tbjscore') {
        if ((IsHasQx($tid_global, 2002801, 2, $school_id)) && is_showpf()) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tkpi') {
        if (is_TestFz()) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }

    if ($v['do'] == 'tgrade') {
        if (is_TestFz()) {
            $icon_type[$index]['hasdata'][] = $v;
        }
    }
}
dump($icon_type);
$data = array(
    'teacher'=>array(
        'title'=>$school['title'],//页面标题
        'head_img'=>$teacher_info['thumb']?tomedia($teacher_info['thumb']):tomedia($school['tpic']),//老师图像
        'name'=>$teacher_info['tname'],//老师名称
        'group'=>$teacher->get_role($teacher_info['status'], $teacher_info['fz_id']),//教师分组的名称
        'teacher_id'=>$teacher_info['id'],//教师的id
        'star'=>$teacher_info['star'],//几星评价
        'is_star'=>$school['is_star'],//是否开启教师星级 1：开启，0：关闭
        'personal_center'=>$teacherConfig['PERSONAL_CENTER'],//是否展示教师的个人中心连接
        'license_plate'=>$teacherConfig['LICENSE_PLATE'],//是否展示教师的车牌
        'plate_num'=>$teacher_info['plate_num'],//教师的车牌
        'is_sign'=>($school['is_wxsign'] ==1 || $school['is_recordmac'] ==1) ? 1:0,//是否启动考勤
        'point_task'=>$point_task,//该老师是不是有没有完成的任务
        'is_msg'=>$teacher_user['is_allowmsg'],//是否接收家长私聊信息和公开电话 1：接受，2：不接受
        'is_course'=>$teacherConfig['COURSE'],//是否展示教师的课程和授课班级 1：只展示授课，2：只展示班级，3：两者都展示
        'course'=>$course,//教师的授课和班级信息 course：授课信息，class：班级信息
        'school'=>$all_school,//所有学校列表
        'class_list'=>$class_list,//该老师在那些搬家担当班主任角色

    ),
);
dump($data);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$data));
