<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/24
 * Time: 14:29
 */
/**
 * 班级通知列表
 */
//班级的id
$class_id = $_GET['class_id'];//查看那个班级的班级圈
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
$teacher = pdo_fetch("SELECT id FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//学校信息
$school = pdo_fetch("SELECT id,tpic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");

if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}

if(!$teacher_model->getRole($teacher_id,2000101,$school_id,2)){
    json_encodeBack(array('status'=>10003,'msg'=>'您无权查看本页面！'));
}
//获取老师的授课班级和管辖班级的并集
$allClass = $teacher_model->getAllClassInfo($teacher_id,$school_id);

$num = 5;
$limitStr = ($page-1)*$num .' , ' . $num;

//如果没有指定查看的班级,则在该老师负责的班级中随机抽一个班级
if(empty($class_id)){
    //随机在负责的班级中找中一个班级
    $class_id = $allClass[0]['sid'];
}
//获取学校类型
$type = $teacher_model->get_school_type($school_id);
if($type){
    $name = pdo_fetchcolumn("SELECT name FROM " . tablename($this->table_tcourse) . " where id = '{$class_id}' ");
    $condition = " AND kc_id = '{$class_id}' ";
}else{
    $name = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$class_id}' ");
    $condition = " AND bj_id = '{$class_id}' ";
}
$leave = pdo_fetchall("SELECT id,title,tid,createtime,content,ismobile,usertype FROM " . tablename($this->table_notice) . " where  schoolid = '{$school_id}' And type = 1 $condition ORDER BY createtime DESC LIMIT $limitStr");

if(empty($leave)){
    json_encodeBack(array('status'=>10005,'msg'=>'我也是有底线的！'));
}
$result = array();
foreach($leave as $key =>$row){
    $result[$key]['id'] = $row['id'];
    $result[$key]['title'] = $row['title'];
    $result[$key]['content'] = $row['content'];
    $result[$key]['ismobile'] = $row['ismobile'];//0手机1电脑
    if($row['usertype'] == 'send_class'){
        $result[$key]['object'] = '指定班级';
    }elseif($row['usertype'] == 'student'){
        $result[$key]['object'] = '指定学生';
    }else{
        $result[$key]['object'] = '';
    }
    $result[$key]['class'] = $name;
    //发布者老师的信息
    $publisher = pdo_fetch("SELECT status,thumb,tname FROM " . tablename($this->table_teachers) . " where id = '{$row['tid']}'");
    $result[$key]['name'] = $publisher['tname'];
    $result[$key]['thumb'] = empty($publisher['thumb']) ? tomedia($school['tpic'] ): tomedia($publisher['thumb']);
    $result[$key]['role'] = $teacher_model->get_teacher_title($publisher['status']);
    //已读人数
    $readNum = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_record)." WHERE  schoolid = '{$school_id}' And noticeid = '{$row['id']}' And readtime != 0 ");
    $result[$key]['readNum'] = $readNum;
    $result[$key]['time'] = date('Y-m-d H:i', $row['createtime']);
}

if(empty($result)){
    json_encodeBack(array('status'=>10005,'msg'=>'我也是有底线的！'));
}
$data = array(
    'title'=>$school['title'],
    'class_id'=>$class_id,
    'class_name'=>$name,
    'allClass'=>$allClass,
    'list'=>$result,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));