<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/8
 * Time: 9:20
 */
/**
 * 学生的作业列表
 */
$user_id= intval($_GET['user_id']);//绑定表的id
$page = intval($_GET['page'])?intval($_GET['page']):1;//默认获取第一页数据

appLoad()->model('student');
$student_model = new student();
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $student_model->get_user_info('student');
$user_id = $user['id'];//绑定表的id
$student_id = $user['student_id'];//学生的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_id = $student['bj_id'];//班级的id
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
//分页查询
$num = 10;
$limitStr = ($page-1)*$num .','. $num;

//获取该学生的所有报名的科目
$course_list = pdo_fetchall("SELECT distinct kcid FROM ".tablename($this->table_order)." where sid = '{$student_id}' And type = 1 And status = 2 ");

$course_str = implode(',',array_column($course_list,'kcid'));

if($student_model->get_school_type($school_id)){
    $condition = " schoolid = '{$school_id}' and type = '3' And FIND_IN_SET(kc_id,'{$course_str}') ";//如果是培训学校则课程作为班级
}else{
    $condition = " schoolid = '{$school_id}' and type = '3' And bj_id = '{$class_id}'";
}
$has_not_read = pdo_fetchcolumn("SELECT count(*) FROM ".tablename($this->table_record)." WHERE type = '3' And readtime < 1 And userid = '{$user_id}' ");
$list = pdo_fetchall("SELECT id,bj_id,kc_id,km_id,title,tname,createtime,type,tid,content,usertype,userdatas,groupid FROM " . tablename($this->table_notice) . " where $condition ORDER BY createtime DESC LIMIT $limitStr ");
$data = array();
foreach ($list as $key=>$value){
    if($value['usertype'] == 'student'){
        $datass = str_replace('&quot;','"',$value['userdatas']);
        $userdatas = json_decode($datass,true);
        if($schooltype){
            $stulist = explode(',',rtrim($userdatas[$value['kc_id']],','));
        }else{
            $stulist = explode(',',rtrim($userdatas[$bj_id],','));
        }
        if(!in_array($student['id'],$stulist)){
            unset($data[$key]);
        }
    }
    $data[$key]['id'] = $value['id'];
    $data[$key]['title'] = $value['title'];
    $teacher = pdo_fetch("SELECT status,thumb,tname FROM " . tablename($this->table_teachers) . " where id = '{$value['tid']}'");
    $data[$key]['teacher_name'] = $teacher['tname'];
    $data[$key]['teacher_thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) :tomedia($teacher['thumb']);
    $data[$key]['teacher_identity'] = $teacher_model->get_role($teacher['status']);
    $is_read = $student_model->check_read($user_id,$value['id']); //true：已读 false：未读
    if($is_read){
        $data[$key]['is_read'] = '已读';
    }else{
        $data[$key]['is_read'] = '未读';
    }
    //班级信息
    $class = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$value['bj_id']}'  ");
    if($value['kc_id']){
        $class = pdo_fetch("SELECT name as sname FROM " . tablename($this->table_tcourse) . " WHERE id = '{$value['kc_id']}' ");
    }
    $data[$key]['class'] = $class['sname'];
    //科目
    $course = pdo_fetch("SELECT sname,icon FROM " . tablename($this->table_classify) . " where sid = '{$value['km_id']}' ");
    $data[$key]['course'] = $course['sname'];
    $data[$key]['course_thumb'] = empty($course['icon']) ? tomedia($school['logo']) :tomedia($course['icon']);
    $data[$key]['content'] = htmlspecialchars($value['content']);
    $data[$key]['time'] = date('Y-m-d H:i', $value['createtime']);

}
if($data){
    $result = array('not_read'=>$has_not_read,'list'=>$data);
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
}else{
    json_encodeBack(array('status'=>10003,'msg'=>'我可是有底线的'));
}