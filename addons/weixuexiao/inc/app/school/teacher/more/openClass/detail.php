<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/9
 * Time: 11:26
 */
/**
 * 公开课详情
 */
$id = $_GET['id'];//公开课的id

appLoad()->model('teacher');
$model = new teacher();
$user = $model->get_user_info('teacher');

$school_id = $user['school_id'];//学校的id
$teacher_id = $user['teacher_id'];//老师的id
//学校信息
$school = pdo_fetch("SELECT logo,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");

$list = pdo_fetch("SELECT * FROM " . tablename($this->table_gongkaike) . " where id ='{$id}'");
$result = array();
$result['id'] = $list['id'];//公开课的id
$result['title'] = $list['name'];//公开课的标题
$teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$list['tid']}'");//讲课老师
$result['teacher'] = $teacher['tname'];
$result['teacher_thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
//创建老师
if($list['createtid'] == 0){
    $result['founder'] = '管理员';
}else{
    $result['founder'] = pdo_fetchcolumn("SELECT tname FROM " . tablename('wx_school_teachers') . " where id = '{$list['createtid']}'");
}
//年级
$result['grade'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$list['xq_id']}'");
//班级
$result['class'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$list['bj_id']}'");
//科目
$course = pdo_fetch("SELECT sname,icon FROM " . tablename($this->table_classify) . " where sid = '{$list['km_id']}'");
$result['course'] = $course['sname'];
$result['course_thumb'] = empty($course['icon'])?tomedia($school['logo']):tomedia($course['icon']);
$result['address'] = $list['addr'];//上课地址
$result['start'] = date('Y-m-d H:i',$list['starttime']);//开始时间
$result['end'] = date('Y-m-d H:i',$list['endtime']);//开始时间
if($list['starttime'] > time()){
    $result['type'] = 1;//尚未开始
}elseif($list['starttime'] <= time() && $list['endtime'] >= time()){
    $result['type'] = 2;//进行中
}elseif($list['endtime'] < time()){
    $result['type'] = 3;//已经结束
}
$result['outline'] = $list['dagang'];//大纲
$result['is_comment'] = $list['is_pj'] == 0?true:false;//是否评价 true:是,false:否
$result['is_own'] = ($teacher_id == $list['tid'])?true:false;//该老师是否是主讲老师 true:是,false:否
//检查是否有人评论过
$check_comment = pdo_fetch("SELECT id FROM " . tablename($this->table_gkkpj) . " where gkkid = '{$id}'");
$result['is_has_comment'] = (!empty($check_comment))?true:false;
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));