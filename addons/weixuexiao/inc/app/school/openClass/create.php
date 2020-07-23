<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/9
 * Time: 13:55
 */
/**
 * 公开课的添加评论页面
 */
$id = $_GET['id'];//公开课的id

appLoad()->model('openClass');
$model = new openClass();
$user = $model->get_user_info();
$user_id = $user['id'];
$school_id = $user['school_id'];//学校的id
//学校信息
$school = pdo_fetch("SELECT logo,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");

$class = pdo_fetch("SELECT id,name,tid,bzid FROM " . tablename($this->table_gongkaike) . " where id ='{$id}'");
if(!empty($id)){
    json_encodeBack(array('status'=>10004,'msg'=>'请选择公开课！'));
}
$check_comment = pdo_fetch("SELECT id FROM " . tablename($this->table_gkkpj) . " where gkkid = '{$id}' And userid = '{$user_id}'");
if(!empty($check_comment)){
    json_encodeBack(array('status'=>10003,'msg'=>'您之前已经评论过了！'));
}

$class['id'] = $class['id'];//公开课的id
$class['title'] = $class['name'];//公开课的标题
$teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$class['tid']}'");//讲课老师
$class['teacher'] = $teacher['tname'];
$class['teacher_thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);

$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_gkkpjk) . " where  bzid = '{$class['bzid']}' ORDER BY ssort ASC");
$data = array();
foreach ($list as $key=>$value){
    $data[$key]['id'] = $value['id'];
    $data[$key]['title'] = $value['title'];
    $data[$key]['content'][1] = array(
        'level'=>1,
        'title'=>$value['icon1title'],
        'icon'=>tomedia($value['icon1'])
    );
    $data[$key]['content'][2] = array(
        'level'=>2,
        'title'=>$value['icon2title'],
        'icon'=>tomedia($value['icon2'])
    );
    $data[$key]['content'][3] = array(
        'level'=>3,
        'title'=>$value['icon3title'],
        'icon'=>tomedia($value['icon3'])
    );
    $data[$key]['content'][4] = array(
        'level'=>4,
        'title'=>$value['icon4title'],
        'icon'=>tomedia($value['icon4'])
    );
    $data[$key]['content'][5] = array(
        'level'=>5,
        'title'=>$value['icon5title'],
        'icon'=>tomedia($value['icon5'])
    );
}
$result = array(
    'class'=>$class,
    'list'=>$data
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));