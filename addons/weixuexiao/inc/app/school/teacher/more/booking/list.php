<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/7
 * Time: 16:33
 */
/**
 * 教师端口的预约列表
 */
$page = intval($_GET['page'])?intval($_GET['page']):1;

appLoad()->model('booking');
$model = new booking();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
$school = pdo_fetch("SELECT title FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
//查看权限,如果没有相对于的权限,只能查看指定该老师的预约
$condition = "";
if(!$model->getRole($teacher_id,2001301,$school_id,2) && $teacherStatus != 2){
    $condition = "And tid = '{$teacher_id}'";
}
$num = 5;
$limitStr = ($page-1)*$num .' , ' . $num;
$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_courseorder) . " where schoolid = '{$school_id}' $condition And type=0 ORDER BY createtime DESC LIMIT $limitStr");
$data = array();
foreach ($list as $key=>$value){
    $data[$key]['id'] = $value['id'];
    if(!empty($value['kcid'])){
        $data[$key]['course'] = pdo_fetchcolumn("SELECT name FROM " . tablename($this->table_tcourse) . " where id = '{$value['kcid']}'");
    }else{
        $data[$key]['course'] = "未指定课程";
    }
    if(pdo_fetch("SELECT id FROM " . tablename($this->table_cyybeizhu_teacher) . " where cyyid = '{$value['id']}' ")){
        $data[$key]['type'] = 1; //已跟进
    }else{
        $data[$key]['type'] = 0; //尚未跟进
    }
    $data[$key]['name'] = $value['name'];
    $data[$key]['tel'] = $value['tel'];
    $data[$key]['content'] = $value['beizhu'];
    $data[$key]['create_at'] = date('Y-m-d H:i:s',$value['createtime']);
}
$result = array(
    'school_id'=>$school_id,
    'title'=>$school['title'],
    'teacher_id'=>$teacher_id,
    'list'=>$data,//发布权限
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));