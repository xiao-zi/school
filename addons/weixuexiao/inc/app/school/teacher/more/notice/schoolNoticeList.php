<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/29
 * Time: 17:42
 */
/**
 * 校园通知列表页
 */
$page = intval($_GET['page'])?intval($_GET['page']):1;//页数


appLoad()->model('notice');
$notice_model = new notice();
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $notice_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,fz_id FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,tpic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");

if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

if(!$teacher_model->getRole($teacher_id,2000201,$school_id,2)){
    json_encodeBack(array('status'=>10003,'msg'=>'您无权查看本页面！'));
}

//通过权限 判断老师查看校园通知的权限
if (!$teacher_model->getRole($teacher_id,2000202,$school_id,2)){
    $condition = " And type = 2 AND ( groupid = 1 Or groupid = 2 Or groupid = 6 Or groupid = 7 Or usertype = 'school' Or usertype = 'alltea' Or usertype = 'staff_jsfz' Or usertype = 'staff' Or tid = '{$teacher_id}') ";
}else{
    $condition = " And type = 2 ";
}

$num = 5;
$limitStr = ($page-1)*$num .' , ' . $num;
$notice = pdo_fetchall("SELECT id,bj_id,title,tname,createtime,type,tid,content,usertype,userdatas FROM " . tablename($this->table_notice) . " where schoolid = '{$school_id}' $condition ORDER BY createtime DESC LIMIT $limitStr ");
if(empty($notice)){
    json_encodeBack(array('status'=>10005,'msg'=>'我也是有底线的！'));
}
$data = array();
foreach($notice as $key =>$value){
    if($value['usertype'] == 'staff'){//指定老师个人
        $userdatas = explode(';',$value['userdatas']);
        if(!in_array($teacher['id'],$userdatas) && !$teacher_model->getRole($teacher_id,2000202,$school_id,2)){
            unset($data[$key]);
        }
    }
    if($value['usertype'] == 'staff_jsfz'){//指定老师组
        $userdatas = explode(';',$value['userdatas']);
        if(!in_array($teacher['fz_id'],$userdatas) && !$teacher_model->getRole($teacher_id,2000202,$school_id,2)){
            unset($leave[$key]);
        }
    }
    //发布老师的信息
    $teach = pdo_fetch("SELECT status,thumb,tname FROM " . tablename($this->table_teachers) . " where id = '{$value['tid']}' ");
    $data[$key]['teacher_name'] = $teach['tname'];
    $data[$key]['teacher_thumb'] = empty($teach['thumb']) ? tomedia($school['tpic']) :tomedia($teach['thumb']);
    $data[$key]['teacher_identity'] = $teacher_model->get_role($teach['status']);

    $is_read = $teacher_model->check_read($user_id,$value['id']); //true：已读 false：未读
    if($is_read){
        $data[$key]['is_read'] = '已读';
    }else{
        $data[$key]['is_read'] = '未读';
    }
    switch ($value['usertype']){
        case 'school':
            $type = '学校全体人员';
            break;//学校全体人员
        case 'alltea':
            $type = '全体老师';
            break;//全体老师
        case 'allstu':
            $type = '全体学生';
            break;//全体学生
        case 'send_class':
            $type = '指定班级';
            break;//指定班级
        case 'student':
            $type = '指定学生';
            break;//指定学生
        case 'staff_jsfz':
            $type = '指定老师组';
            break;//指定老师组
        default :
            $type = '指定老师';
            break;//指定老师
    }
    $data[$key]['subject'] = $type;
    if($value['type'] ==1){
        $data[$key]['type'] = "班级通知";
    }else{
        $data[$key]['type'] = "校园通知";
    }
    $data[$key]['content'] = htmlspecialchars($value['content']);
    $data[$key]['time'] = date('Y-m-d H:i', $value['createtime']);
}
if(empty($data)){
    json_encodeBack(array('status'=>10005,'msg'=>'我也是有底线的！'));
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));