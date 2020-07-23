<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/21
 * Time: 15:23
 */
/**
 * 发布动态的ajax操作
 */
$op = $_GET['op'];
$array = array (
    'get_notice_user',//获取消息通知的对象
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}
if($operation == 'get_notice_user'){
    $school_type = $_GET['school_type'];//学校类型 公立还是培训 有的话是培训学校，没有是公立学校
    $school_id = $_GET['school_id'];//学校的id
    $user_type = $_GET['type'];//获取的是那种数据
    if(empty($school_id) || empty($user_type)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    if($user_type != 1 && $user_type != 2 && $user_type != 3 && $user_type != 4){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    appLoad()->model('common');
    $common = new common();
    if($user_type == 1){//获取年级信息
        //获取全部信息
        $list = $common->get_all_class_info($school_id,0,$school_type);
    }
    if($user_type == 2){//获取学生信息
        //获取全部信息
        $list = array(
            'absorbed'=>$common->get_all_student_info($school_id,0,$school_type),//已分配的学生
            'unabsorbed'=>$common->get_unabsorbed_student($school_id,$school_type),//未分配的学生
        );
    }
    if($user_type == 3){//获取老师组信息
        //获取全部信息
        $list = $common->get_all_teacher_group($school_id,0);
    }
    if($user_type == 4){//获取学生信息
        //获取全部信息
        $list = array(
            'absorbed'=>$common->get_all_teacher_info($school_id,0),//已分配的老师
            'unabsorbed'=>$common->get_unabsorbed_teacher($school_id),//未分配的学生
        );
    }
    json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$list));
}