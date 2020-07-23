<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/14
 * Time: 16:27
 */
/**
 * 学生的周计划列表
 */


appLoad()->model('weekly');
$model = new weekly();
$user = $model->get_user_info('student');
$user_id = $user['id'];//绑定表的id
$student_id = $user['student_id'];//学生的id
$school_id = $user['school_id'];//学校的id
//学生信息
$class_id = pdo_fetchcolumn("SELECT bj_id FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
$class_name = pdo_fetchcolumn("select sname from ".tablename('wx_school_classify')." where sid = '{$class_id}'");
$list = pdo_fetchall("SELECT id,start,end,is_on,planuid,type FROM " . tablename($this->table_zjh) . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' and is_on = 2 ORDER BY createtime,is_on,end DESC");
$data = array();
foreach($list as $key => $value){
    $data[$key]['id'] = $value['id'];
    //判断是不是当前时间段的周计划
    if($value['start'] <= TIMESTAMP && $value['end'] >= TIMESTAMP){
        $data[$key]['status'] = 1;
    }else{
        $data[$key]['status'] = 2;
    }
    //周计划的类型 1:图片,2:文档
    if($value['type'] == 1){
        $data[$key]['type'] = 'image';
    }else{
        $data[$key]['type'] = 'word';
    }
    $data[$key]['time'] = date('Y年m月d日',$value['start']).'-'.date('m月d日',$value['end']);
    $data[$key]['is_on'] = $value['is_on'];//2:显示中,1:编辑中
    $data[$key]['planuid'] = $value['planuid'];
}
$result = array(
    'classId'=>$class_id,//班级的id
    'title'=>$class_name,//标题
    'list'=>$data,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));


