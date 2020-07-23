<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/13
 * Time: 10:59
 */
appLoad()->model('teacher');
$model = new teacher();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
if(!$model->getRole($teacher_id,2000701,$school_id,2)){
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看报名列表！'));
}
$studentThumb = pdo_fetchcolumn("SELECT spic FROM " . tablename('wx_school_index') . " where  id= '{$school_id}'");
//查看老师信息
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//是不是年级主任
$gradeList = $model->is_grade_director($teacher_id);
//查看是不是班主任
$classList = $model->is_class_director($teacher_id);

if($teacherStatus != 2){//校长身份 拥有查看所有的报名列表
    $condition = " ON a.sid = b.nj_id where a.type = 'semester' AND b.schoolid = '{$school_id}' ORDER BY b.createtime DESC, b.status ASC ";
}elseif(!$gradeList){//年级主任身份,只能查看报名该年级的报名列表
    $condition = " ON a.sid = b.nj_id where a.tid = {$teacher_id} and a.type = 'semester' AND b.schoolid = '{$school_id}' ORDER BY b.createtime DESC, b.status ASC ";
}elseif($classList){
    $condition = " ON a.sid = b.bj_id where a.tid = {$teacher_id} and a.type = 'theclass' AND b.schoolid = '{$school_id}' ORDER BY b.createtime DESC, b.status ASC ";
}
$list = pdo_fetchall("SELECT b.* FROM " . tablename($this->table_classify) . " as a LEFT JOIN". tablename($this->table_signup). " as b  $condition ");
if(empty($list)){
    json_encodeBack(array('status'=>10004,'msg'=>'目前没有报名信息！'));
}
$data = array();
foreach ($list as $key=>$value){
    $data[$key]['id'] = $value['id'];
    $data[$key]['name'] = $value['name'];
    $data[$key]['status'] = $value['status'];//1:待审核,2:已通过,2:已拒绝
    switch ($value['status']){
        case 1:$data[$key]['type'] = '待审核';break;
        case 2:$data[$key]['type'] = '已通过';break;
        default :$data[$key]['type'] = '已拒绝';
    }
    //报名用户的图片
    $thumb = pdo_fetchcolumn("select thumb from ".tablename('app_school_user')." where id = '{$value['user_id']}'");
    $data[$key]['thumb'] = empty($thumb)?tomedia($studentThumb):tomedia($thumb);
    $data[$key]['grade'] = pdo_fetchcolumn("select sname from " .tablename('wx_school_classify') ." where sid = '{$value['nj_id']}'");
    $data[$key]['class'] = pdo_fetchcolumn("select sname from " .tablename('wx_school_classify') ." where sid = '{$value['bj_id']}'");
    $data[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);
}
//处理报名
$role1 = false;
if($model->getRole($teacher_id,2000702,$school_id,2)){
    $role1 = true;
}
//修改报名信息
$role2 = false;
if($model->getRole($teacher_id,2000703,$school_id,2)){
    $role2 = true;
}
$result = array(
    'role1'=>$role1,
    'role2'=>$role2,
    'list'=>$data
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));