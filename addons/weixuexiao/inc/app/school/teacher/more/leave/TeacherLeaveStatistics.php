<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/3
 * Time: 15:16
 */
appLoad()->model('leave');
$leave_model = new leave();
$user = $leave_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//学校信息默认老师的头像
$thumb = pdo_fetchcolumn("SELECT tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
$teacherStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");

if(!$leave_model->getRole($teacher_id,2001001,$school_id,2) && $teacherStatus != 2){
    json_encodeBack(array('status'=>10003,'msg'=>'您无权查看本页面！'));
}

$start = $_GET['start'];//日期格式 2020-05-01
$end = $_GET['end'];//日期格式 2020-06-01
//如果传了开始时间和结束时间，则按照传来的数据查找，否则按照最近30天查找
if(empty($start) || empty($end)){
    $today = strtotime(date("Y-m-d",time()));
    $start_time = $today-86400*30;
    $end_time = $today+86400;
}else{
    $start_time = strtotime($start);
    $end_time = strtotime($end)+86400;
}
if($start_time >= $end_time){
    json_encodeBack(array('status'=>10004,'msg'=>'开始时间不能大于结束时间！'));
}
//获取在该时间段中请假的老师
$condition = " AND createtime >= '{$start_time}' AND createtime <= '{$end_time}'  ";
$teacherIdArr = pdo_fetchall("SELECT distinct tid as id FROM " . tablename($this->table_leave) . " WHERE  schoolid = '{$school_id}' and status = 1 And isliuyan = 0 and tid != 0  $condition ORDER BY createtime DESC, id DESC");
$data = array();
foreach ($teacherIdArr as $key=>$value){
   //老师信息
    $teacher = pdo_fetch("SELECT id,tname as name,thumb FROM " . tablename('wx_school_teachers') . " where  id= '{$value['id']}'");
    $teacher['thumb'] = empty($teacher['thumb'])?tomedia($thumb):tomedia($teacher['thumb']);
    $data[$key]['id'] = $teacher['id'];
    $data[$key]['name'] = $teacher['name'];
    $data[$key]['thumb'] = $teacher['thumb'];
    $num = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and tid= '{$value['id']}' $condition ");
    $data[$key]['num'] = $num;
    //汇总
    $all_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =2 and tid= '{$value['id']}' $condition ");
    $all_classes = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =1 and tid= '{$value['id']}' $condition ");
    $data[$key]['all'] = array('day'=>intval($all_day),'course'=>intval($all_classes));
    //病假
    $sick_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =2 and tid= '{$value['id']}' and type='病假' $condition ");
    $sick_classes = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =1 and tid= '{$value['id']}' and type='病假' $condition ");
    $data[$key]['sick'] = array('day'=>intval($sick_day),'class'=>intval($sick_classes));
    //事假
    $absence_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =2 and tid= '{$value['id']}' and type='事假' $condition ");
    $absence_classes = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =1 and tid= '{$value['id']}' and type='事假' $condition ");
    $data[$key]['absence'] = array('day'=>intval($absence_day),'class'=>intval($absence_classes));
    //公差
    $tolerance_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =2 and tid= '{$value['id']}' and type='公差' $condition ");
    $tolerance_classes = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =1 and tid= '{$value['id']}' and type='公差' $condition ");
    $data[$key]['tolerance'] = array('day'=>intval($tolerance_day),'class'=>intval($tolerance_classes));
    //其他
    $other_day = pdo_fetchcolumn("SELECT sum((endtime1 - startime1 + 1)/86400) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =2 and tid= '{$value['id']}' and type='其他' $condition ");
    $other_classes = pdo_fetchcolumn("SELECT sum(ksnum) FROM " . tablename($this->table_leave) . " WHERE status = 1 And isliuyan = 0 and more_less =1 and tid= '{$value['id']}' and type='其他' $condition ");
    $data[$key]['other'] = array('day'=>intval($other_day),'class'=>intval($other_classes));
}
$result = array(
    'start'=>date('Y-m-d',$start_time),//开始时间
    'end'=>date('Y-m-d',$end_time),//结束时间
    'count'=>count($data),
    'list'=>$data
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));

