<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/17
 * Time: 11:23
 */
/**
 * 老师 成长手册学生的点评
 */
$id = $_GET['id'];//成长手册的id
$student_id = $_GET['student_id'];//学生的id


appLoad()->model('growth');
$model = new growth();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//学校设置学生的默认图片
$thumb = pdo_fetchcolumn("select spic from " .tablename('wx_school_index') ." where id = '{$school_id}' ");

if(empty($id) || empty($student_id)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
//创建成长手册权限
if(!$model->getRole($teacher_id,2000801,$school_id,2)){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权管理成长手册'));
}

$data = pdo_fetch("select * from " .tablename('wx_school_shouce')." where id = '{$id}'");

$class_id = $data['bj_id'];//班级的id

$comment_id = $data['setid'];//评论规则的id
$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_scicon) . " where schoolid = '{$school_id}' And setid = '{$comment_id}' And type = 1  ORDER BY ssort ASC");
$student = pdo_fetch("select id,s_name as name,icon as thumb from " .tablename('wx_school_students')." where bj_id = '{$class_id}' and id = '{$student_id}'");
$student['thumb'] = empty($student['thumb']) ? tomedia($thumb):tomedia($student['thumb']);
//获取老师对学生的语言评论
$student['word'] = pdo_fetchcolumn("SELECT tword FROM " . tablename ('wx_school_scforxs') . " where schoolid = '{$school_id}' And scid = '{$id}' And sid = '{$student['id']}' And tid = '{$teacher_id}' And type = 1 and fromto = 1 ");
//获取老师对学生的评论规则的评论
$show = pdo_fetchall("SELECT iconsetid as iconId,iconlevel as level FROM " . tablename ('wx_school_scforxs') . " where schoolid = '{$school_id}' And scid = '{$id}' And sid = '{$student['id']}' And tid = '{$teacher_id}' And type = 2 and fromto = 1  ");
$iconArr = array();
foreach ($list as $key=>$value){
    $iconArr[$key]['id'] = $value['id'];
    $iconArr[$key]['title'] = $value['title'];
    $iconArr[$key]['icon'] = array(
        array(
            'level'=>1,
            'title'=>$value['icon1title'],
            'icon'=>tomedia($value['icon1'])
        ),
        array(
            'level'=>2,
            'title'=>$value['icon2title'],
            'icon'=>tomedia($value['icon2'])
        ),
        array(
            'level'=>3,
            'title'=>$value['icon3title'],
            'icon'=>tomedia($value['icon3'])
        ),
        array(
            'level'=>4,
            'title'=>$value['icon4title'],
            'icon'=>tomedia($value['icon4'])
        ),
        array(
            'level'=>5,
            'title'=>$value['icon5title'],
            'icon'=>tomedia($value['icon5'])
        ),
    );
}
if(!empty($show)){
    foreach ($show as $k=>$val){
        foreach ($iconArr as $ik=>$iv){
            if($val['iconId'] == $iv['id']){
                foreach ($iv['icon'] as $ik1 =>$iv1){
                    if($val['level'] == $iv1['level']){
                        $iconArr[$ik]['icon'][$ik1]['check'] = true;
                    }
                }
            }
        }
    }
}
$student['show'] = $iconArr;

$result = array(
    'id'=>$data['id'],
    'title'=>$data['title'],
    'type'=>$comment_id?1:2,//是不是选择了评论规则,1:是,2:否
    'student'=>$student,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));