<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/14
 * Time: 16:27
 */
/**
 * 老师的周计划列表
 */
$class_id = $_GET['class_id'];//班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1

appLoad()->model('weekly');
$model = new weekly();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//2000901:学生的周计划 2000911:老师的周计划
$role1 = $model->getRole($teacher_id,2000901,$school_id,2);//学生的周计划
$role2 = $model->getRole($teacher_id,2000911,$school_id,2);//老师的周计划
if(!$role1 && !$role2){
    json_encodeBack(array('status'=>10004,'msg'=>'您无权查看本页面'));
}
//如果有权限查看学生的周计划，则获取该老师担任班主任的班级
$classList = array();
if($role1){
    //找到担任班主任身份的班级
    $classLists = pdo_fetchall("SELECT sid as id,concat(sname,'周计划') as name FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' ORDER BY sid ASC, ssort DESC ");
    $classList = array_merge($classList,$classLists);
}
if($role2){
    $classList = array_merge($classList,array(array('id'=>-1,'name'=>'教师周计划')));
}
//如果没有$class_id,则在教师拥有权限的列表中,取第一组数据
if(empty($class_id)){
    $class_id = $classList[0]['id'];
}
$list = pdo_fetchall("SELECT id,start,end,is_on,planuid,type FROM " . tablename($this->table_zjh) . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' ORDER BY createtime,is_on,end DESC");
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
    'title'=>getArrayValue($classList,$class_id,'id')['name'],//标题
    'classList'=>$classList,//班级列表
    'list'=>$data,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));


