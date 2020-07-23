<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/6
 * Time: 16:28
 */
/**
 * 教师任务详情
 */
$id = $_GET['id'];

appLoad()->model('task');
$task_model = new task();
$user = $task_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$thumb = pdo_fetchcolumn("SELECT tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");//默认老师头像
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");//老师状态


//任务信息
$task = pdo_fetch("SELECT * FROM " . tablename('wx_school_todo') . " where schoolid = '{$school_id}' and id = '{$id}'");
//权限控制
if(!$task_model->getRole($teacher_id,2001201,$school_id,2) && $teacherStatus != 2 && ($task['fsid'] == $teacher_id || $task['jsid'] == $teacher_id || $task['zjid'] == $teacher_id )){
    //这块限制了只能查看与自己有关的任务
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看此任务！'));
}

$publisher = pdo_fetch("SELECT id,tname as name,thumb,status FROM " . tablename('wx_school_teachers') . " where  id= '{$task['fsid']}'");
//发布者的信息
$data['publisher'] = array(
    'id'=>$publisher['id'],
    'name'=>$publisher['name'],
    'thumb'=>empty($publisher['thumb'])?tomedia($thumb):tomedia($publisher['thumb']),
    'status'=>$task_model->get_teacher_title($publisher['status']),
);
$recipient = pdo_fetch("SELECT id,tname as name,thumb,status FROM " . tablename('wx_school_teachers') . " where  id= '{$task['jsid']}'");
//接受者的信息
$data['recipient'] = array(
    'id'=>$recipient['id'],
    'name'=>$recipient['name'],
    'thumb'=>empty($recipient['thumb'])?tomedia($thumb):tomedia($recipient['thumb']),
    'status'=>$task_model->get_teacher_title($recipient['status']),
);
if (!empty($task['zjid'])){
    $deliver = pdo_fetch("SELECT id,tname as name,thumb,status FROM " . tablename('wx_school_teachers') . " where  id= '{$task['zjid']}'");
    //转交者的信息
    $data['deliver'] = array(
        'id'=>$deliver['id'],
        'name'=>$deliver['name'],
        'thumb'=>empty($deliver['thumb'])?tomedia($thumb):tomedia($deliver['thumb']),
        'status'=>$task_model->get_teacher_title($deliver['status']),
    );
}
$data['title'] = $task['todoname'];//任务标题
$data['content'] = $task['content'];//任务内容
//附件
$data['accessories'] = array(
    'image'=>unserialize($task['picurls']),
    'audio'=>array(
        'audio'=>$task['audio'],
        'time'=>$task['audiotime'],
    ),
    'video'=>array(
        'cover'=>$task['videoimg'],
        'video'=>$task['video']
    ),
);
//转交备注
$data['remark1'] = $task['zjbeizhu'];
//拒绝备注
$data['remark2'] = $task['jjbeizhu1'];
//转交拒绝备注
$data['remark3'] = $task['jjbeizhu2'];
/**
 * 状态
 * 0: 任务刚发布，处于待接收状态
 * 1：接受者拒绝该任务
 * 2：接受者接受该任务
 * 3：接受者完成该任务
 * 4：接受者把该任务交给转交者完成,但转交者并没有接受
 * 5：转交者拒绝此任务
 * 6：转交者完成此任务
 */
$data['status'] = $task['status'];
//创建时间
$data['create_at'] = date('Y-m-d H:i:s',$task['createtime']);

//发布权限
$role = false;
if($task_model->getRole($teacher_id,2001202,$school_id,2) || $teacherStatus == 2){
    //这块限制了只能查看与自己有关的任务
    $role = true;
}
$result = array(
    'school_id'=>$school_id,
    'title'=>$school['title'],
    'teacher_id'=>$teacher_id,
    'role'=>$role,//发布权限
    'data'=>$data,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));