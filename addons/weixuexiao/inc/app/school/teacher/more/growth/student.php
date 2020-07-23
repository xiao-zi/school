<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/17
 * Time: 9:30
 */
/**
 * 成长手册的学生列表
 */
$id = $_GET['id'];//成长手册的id

appLoad()->model('growth');
$model = new growth();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
$thumb = pdo_fetchcolumn("select spic from " .tablename('wx_school_index') ." where id = '{$school_id}' ");
if(empty($id)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
//创建成长手册权限
if(!$model->getRole($teacher_id,2000801,$school_id,2)){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权管理成长手册'));
}

$data = pdo_fetch("select * from " .tablename('wx_school_shouce')." where id = '{$id}'");

$class_id = $data['bj_id'];//班级的id

$comment_id = $data['setid'];//评论规则的id
$students = pdo_fetchall("select id,s_name as name,icon as thumb from " .tablename('wx_school_students')." where bj_id = '{$class_id}' order by id asc");
foreach ($students as $key=>$value){
    $students[$key]['thumb'] = empty($value['thumb']) ? tomedia($thumb):tomedia($value['thumb']);
    //1文字2表现评价3点赞
    //来自老师的点评
    $word = pdo_fetchcolumn("SELECT id FROM " . tablename ('wx_school_scforxs') . " where schoolid = '{$school_id}' And scid = '{$id}' And sid = '{$value['id']}' And type = 1 and fromto = 1  ");
    $show = pdo_fetchcolumn("SELECT id FROM " . tablename ('wx_school_scforxs') . " where schoolid = '{$school_id}' And scid = '{$id}' And sid = '{$value['id']}' And type = 2 and fromto = 1  ");
    //评论状态 1:没有评论,2:评论尚未完成,3:已评论
    if($comment_id){//评论规则id存在,则需要老师对其学生的文字和评论规则都打分,否则评论为完成
        $students[$key]['status'] = ($word && $show) ? 3:(($word || $show) ? 2:1);
    }else{
        $students[$key]['status'] = $word ? 3:1;
    }
}
$result = array(
    'id'=>$data['id'],
    'title'=>$data['title'],
    'type'=>$comment_id?1:2,//是不是选择了评论规则,1:是,2:否
    'student'=>$students,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));