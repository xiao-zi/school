<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/15
 * Time: 17:44
 */
appLoad()->model('common');
$common_model = new common();
$user = $common_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];
$student_id = $user['student_id'];

$page = intval($_GET['page'])?intval($_GET['page']):1;

//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,xq_id FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$school = pdo_fetch("SELECT title,spic,tpic,logo FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
$num = 5;
$limitStr = ($page-1)*$num .',' .$num;
$list = pdo_fetchall("SELECT id,beizhu,huifu,createtime,totid FROM " .tablename($this->table_courseorder) . " where schoolid = '{$school_id}'  And type=1  AND fromuserid = '{$user_id}' ORDER BY createtime DESC LIMIT $limitStr");
if(empty($list)){
    json_encodeBack(array('status'=>10003,'msg'=>'对不起,我也是有底线的'));
}
$data = array();
foreach($list as $key =>$value){

    $data[$key]['id'] = $value['id'];
    $data[$key]['type'] = 1;//留言的类型 1:给校长留言,2:给老师留言
    $data[$key]['leaving'] = $value['beizhu'];//留言
    $data[$key]['reply'] = $value['huifu'];//回复
    $data[$key]['date'] = date('Y-m-d H-i-s',$value['createtime']);//留言时间
    if(!empty($value['totid'])){
        $teacher = pdo_fetch("SELECT id,tname,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$value['totid']}'");
        $data[$key]['type'] = 2;//留言的类型 1:给校长留言,2:给老师留言
        $data[$key]['teacher_name'] = $teacher['tname'];
        $data[$key]['thumb'] = empty($teacher['thumb']) ? tomedia($school['tpic']) : tomedia($teacher['thumb']);
    }
}
$result = array(
    'user'=>array(
        'student_name'=>$student['s_name'],
        'relation'=>$user['relation'],//关系
        'realname'=>$user['realname'],
        'mobile'=>$user['mobile']
    ),
    'data'=>$data
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));