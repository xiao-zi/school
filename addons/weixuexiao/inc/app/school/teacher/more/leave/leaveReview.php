<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/14
 * Time: 17:16
 */
/**
 *教员请假审核页面
 */
$leave_id = $_GET['id'];//请假的id

appLoad()->model('leave');
$leave_model = new leave();
$user = $leave_model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

$user_info = pdo_fetch("SELECT id FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT id,tpic,spic,title FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,thumb,mobile,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])?tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定教师身份，请到绑定页面，绑定教师身份！'));
}
$leave = pdo_fetch("SELECT id,tid,type,startime1,endtime1,conet,status,cltime,cltid,ksnum,more_less,tktype,reconet FROM " . tablename($this->table_leave) . " where id = '{$leave_id}'");
if(empty($leave)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！！'));
}
$review = 0; //审核权利 0：没有，1：有
//判断该用户是否是申请老师或者审核老师的身份
if(!in_array($teacher_id,array($leave['tid'],$leave['cltid']))){
    //判断该用户是否拥有审核权利
    if($leave_model->getRole($teacher_id,2001002,$school_id,2) || $teacher['status'] ==2){
        $review = 1;
    }else{
        json_encodeBack(array('status'=>10005,'msg'=>'您没有权利查看该请假信息！！'));
    }
}elseif($teacher_id == $leave['cltid']){
    $review = 1;
}
//申请老师信息
$applicant = pdo_fetch("SELECT id,tname as name,thumb FROM " . tablename($this->table_teachers) . " where id = '{$leave['tid']}' ");

//审核老师信息 判断是不是后台进行审核
if($leave['cltid'] == 0){//后台人员审核
    $checker = array(
        'id'=>$school['id'],
        'name'=>$school['title'],//老师名称
        'thumb'=>$school['tpic'],//老师头像
    );
}else{//老师审核
    $checker = pdo_fetch("SELECT id,tname,mobile,thumb FROM " . tablename($this->table_teachers) . " where id = '{$leave['cltid']}' AND schoolid = '{$school_id}'");
}
$teacher_config = getAppConfig('config');
//老师请假必填项的选择
$type = $teacher_config['TEACHER_LEAVE_REQUIRE'];
if($type == 1){
    if($leave['endtime1'] - $leave['startime1'] + 1 > 86400 ){//判断请假时间是否大于一天
        $more = 2;
        $numStr = ($leave['endtime1'] - $leave['startime1'] + 1)/86400 .'天';
    }else{
        $more = 1;
        $numStr = '半天';
    }
    $result = array(
        'title'=>$school['title'],//页面标题
        'type'=>$type,//请假类型
        'review'=>$review,//审核权限 0：没有，1：有
        'review_type'=>$leave['cltid'] ? 1:0,//判断是不是后台进行审核 1：老师审核，0：后台审核
        'teacher'=>array(//申请老师
            'id'=>$applicant['id'],
            'name'=>$applicant['name'],//老师名称
            'head_img'=>$applicant['thumb']?tomedia($applicant['thumb']):tomedia($school['tpic']),//老师头像
        ),
        'checker'=>array(
            'id'=>$checker['id'],
            'name'=>$checker['tname'],//老师名称
            'head_img'=>$checker['thumb']?tomedia($checker['thumb']):tomedia($school['tpic']),//老师头像
        ),
        'leave'=>array(
            'type'=>$leave['type'],//请假类型
            'time'=>date('m-d H:i',$leave['startime1']).'至'.date('m-d H:i',$leave['endtime1']),//请假时间
            'content'=>$leave['conet'],//请假理由
            'more'=>$more,//请假是否大于一天 1：小于一天，2：大于一天
            'numStr'=>$numStr,
            'remark'=>$leave['reconet'],//审批意见
            'status'=>$leave['status'],//请假状态，0：未处理，1：已同意，2：已拒绝
            'handle_time'=>$leave['cltime'] ? date('m-d H:m',$leave['cltime']):'尚未处理',//处理时间
        )
    );
}elseif ($type == 2){
    if($leave['more_less'] == 2){
        $numStr = ($leave['endtime1'] - $leave['startime1'] + 1)/86400 . '天';
    }else{
        $numStr = $leave['ksnum'].'节';
    }
    $result = array(
        'title'=>$school['title'],//页面标题
        'type'=>$type,//请假类型
        'review'=>$review,//审核权限 0：没有，1：有
        'review_type'=>$leave['cltid'] ? 1:0,//判断是不是后台进行审核 1：老师审核，0：后台审核
        'teacher'=>array(
            'id'=>$applicant['id'],
            'name'=>$applicant['name'],//老师名称
            'head_img'=>$applicant['thumb']?tomedia($applicant['thumb']):tomedia($school['tpic']),//老师头像
        ),
        'checker'=>array(
            'id'=>$checker['id'],
            'name'=>$checker['tname'],//老师名称
            'head_img'=>$checker['thumb']?tomedia($checker['thumb']):tomedia($school['tpic']),//老师头像
        ),
        'leave'=>array(
            'type'=>$leave['type'],//请假类型
            'time'=>date('m-d H:i',$leave['startime1']).'至'.date('m-d H:i',$leave['endtime1']),//请假时间
            'content'=>$leave['conet'],//请假理由
            'more'=>$leave['more_less'],//请假是否大于一天 1：小于一天，2：大于一天
            'numStr'=>$numStr,
            'remark'=>$leave['reconet'],//审批意见
            'transfer'=>array(0=>'无课',1=>'自主调课',2=>'教务处调课')[$leave['tktype']],
            'status'=>$leave['status'],//请假状态，0：未处理，1：已同意，2：已拒绝
            'handle_time'=>$leave['cltime'] ? date('m-d H:m',$leave['cltime']):'尚未处理',//处理时间
        )
    );
}

json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));