<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/3
 * Time: 16:28
 */
/**
 * 学生的请假列表页
 */

$page = intval($_GET['page'])?intval($_GET['page']):1;//默认获取第一页数据

appLoad()->model('student');
$student_model = new student();
//检查用户是否登陆
$user = $student_model->get_user_info('student');

$user_id = $user['id'];//绑定表的信息
$school_id = $user['school_id'];//学校的id
$student_id = $user['student_id'];//学生的id

$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon FROM " . tablename('wx_school_students') . " where  id= '{$student_id}'");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$num = 10;
$limitStr = ($page-1)*2 .','. $num;
//请假列表
$list = pdo_fetchall("SELECT * FROM " . tablename('wx_school_leave') . " where schoolid = '{$school_id}' AND sid = '{$student_id}' And tid = 0 And isliuyan = 0 ORDER BY createtime DESC limit $limitStr");
//班主任
$class = pdo_fetch("SELECT tid FROM " . tablename('wx_school_classify') . " where sid = '{$student['bj_id']}' And type = 'theclass' ");
$result = array();
foreach($list as $key => $value){
    $user = pdo_fetch("SELECT pard FROM " . tablename('wx_school_user') . " where (uid = '{$value['uid']}' And openid = '{$value['openid']}' or userid = '{$value['user_id']}') And sid = '{$value['sid']}'");
    switch ($user['pard']){
        case 2:$result[$key]['relation'] = '母亲';break;
        case 3:$result[$key]['relation'] = '父亲';break;
        case 4:$result[$key]['relation'] = '本人';break;
        case 5:$result[$key]['relation'] = '家人';break;
    }
    //查看是否有审核老师,没有的话找班主任
    if(!$value['cltid']){
        $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$class['tid']}' AND schoolid = '{$school_id}' ");
        $result[$key]['teacher_name'] = $teacher['tname'];
        $result[$key]['teacher_thumb'] = $teacher['thumb']?tomedia($teacher['thumb']):tomedia($school['tpic']);
    }else{
        $teacher = pdo_fetch("SELECT tname,thumb FROM " . tablename('wx_school_teachers') . " where id = '{$value['cltid']}' AND schoolid = '{$school_id}' ");
        $result[$key]['teacher_name'] = $teacher['tname'];
        $result[$key]['teacher_thumb'] = $teacher['thumb']?tomedia($teacher['thumb']):tomedia($school['tpic']);
    }
    $result[$key]['audit_time'] = date('Y-m-d H:i:s',$value['cltime']);//审核时间
    $result[$key]['create'] = date('Y-m-d H:i:s',$value['createtime']);//申请始时间
    $result[$key]['start'] = $value['startime']?$value['startime']:date('Y-m-d H:i:s',$value['startime1']);//请假开始时间
    $result[$key]['end'] = $value['startime']?$value['startime']:date('Y-m-d H:i:s',$value['endtime1']);//请假结束世家
    $result[$key]['type'] = $value['type'];//请假类型
    $result[$key]['content'] = $value['conet'];//请假内容
    $result[$key]['reply'] = $value['reconet'];//请假回复
    $result[$key]['status'] = $value['status'];//请假状态 0：待批，1：批准，2：拒绝
}
$data = array(
    'title'=>$school['title'],
    'school_id'=>$school_id,
    'student'=>array(
        'id'=>$student_id,
        'name'=>$student['s_name'],
        'thumb'=>$student['icon']?tomedia($student['icon']):tomedia($school['spic']),
    ),
    'data'=>$result,
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));