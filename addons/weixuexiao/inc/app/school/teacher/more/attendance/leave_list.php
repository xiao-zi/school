<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/15
 * Time: 15:10
 */
/**
 * 教员的请假列表
 */
//$_POST = array(
//    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
//);
$token = trim($_POST['token']);//验证用户身份
$school_id = $_GET['school_id'];//学校的id
if(empty($token)){
    json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
}
$tokenResult = decryptToken($token);
if($tokenResult['status'] != 10001){
    json_encodeBack(array('status'=>100002,'msg'=>'非法请求！'));
}
$user_id = $tokenResult['data']['user']['id'];
$school = pdo_fetch("SELECT id,title,tpic,headcolor FROM " . tablename($this->table_index) . " where id= '{$school_id}'");
if(empty($school)){
    json_encodeBack(array('status'=>100003,'msg'=>'非法请求！！'));
}
$user = pdo_fetch("SELECT id,tid,userinfo FROM " . tablename($this->table_user) . " where schoolid = '{$school_id}' And userid = '{$user_id}' And sid = 0");
if(empty($user)){
    json_encodeBack(array('status'=>100004,'msg'=>'请回到绑定页面，绑定教师身份','data'=>array('school_id'=>$school_id)));
}
//用户老师信息
$user_teacher = pdo_fetch("SELECT id,tname,mobile,thumb,status FROM " . tablename($this->table_teachers) . " where id = '{$user['tid']}' AND schoolid = '{$school_id}' ");
//请假列表
$leave_list = pdo_fetchall("SELECT id,more_less,ksnum,startime1,endtime1,type,tktype,conet,reconet,status,createtime,cltid,cltime FROM " . tablename($this->table_leave) . " where schoolid = '{$school_id}' And tid = '{$user['tid']}' And sid = 0 And isliuyan = 0 ORDER BY createtime DESC");
$teacher_config = getAppConfig('config');
//老师请假必填项的选择
$type = $teacher_config['TEACHER_LEAVE_REQUIRE'];

foreach ($leave_list as $key=>$value){
    //审核老师信息 判断是不是后台进行审核
    if($value['cltid'] == 0){//后台人员审核
        $checker = array(
            'id'=>$school['id'],
            'tname'=>$school['title'],//老师名称
            'thumb'=>$school['tpic'],//老师头像
        );
    }else{//老师审核
        $checker = pdo_fetch("SELECT id,tname,mobile,thumb FROM " . tablename($this->table_teachers) . " where id=:tid AND schoolid=:schoolid", array(':tid'=>$value['cltid'],':schoolid' => $school_id));
    }
    if($type == 1){
        if($leave['endtime1'] - $leave['startime1'] + 1 > 86400 ){//判断请假时间是否大于一天
            $more = 2;
            $numStr = ($leave['endtime1'] - $leave['startime1'] + 1)/86400 .'天';
        }else{
            $more = 1;
            $numStr = '半天';
        }
        $list[$key+1] = array(
            'checker'=>array(
                'id'=>$checker['id'],
                'name'=>$checker['tname'],//老师名称
                'head_img'=>$checker['thumb']?tomedia($checker['thumb']):tomedia($school['tpic']),//老师头像
            ),
            'leave'=>array(
                'id'=>$value['id'],
                'type'=>$value['type'],//请假类型
                'start'=>date('Y-m-d H:i:s',$value['startime1']),//开始时间
                'end'=>date('Y-m-d H:i:s',$value['endtime1']),//结束时间
                'content'=>$value['conet'],//请假理由
                'more'=>$more,//请假是否大于一天 1：小于一天，2：大于一天
                'numStr'=>$numStr,
                'remark'=>$value['reconet'],//审批意见
                'status'=>$value['status'],//请假状态，0：未处理，1：已同意，2：已拒绝
                'handle_time'=>date('Y-m-d H:i:s',$value['cltime']),//处理时间
                'create_time'=>date('Y-m-d H:i:s',$value['createtime'])
            )
        );
    }else{
        if($value['more_less'] == 2){
            $numStr = ($value['endtime1'] - $value['startime1'] + 1)/86400 . '天';
        }else{
            $numStr = $value['ksnum'].'节';
        }
        $list[$key+1] = array(
            'checker'=>array(
                'id'=>$checker['id'],
                'name'=>$checker['tname'],//老师名称
                'head_img'=>$checker['thumb']?tomedia($checker['thumb']):tomedia($school['tpic']),//老师头像
            ),
            'leave'=>array(
                'id'=>$value['id'],
                'type'=>$value['type'],//请假类型
                'start'=>date('Y-m-d H:i:s',$value['startime1']),//开始时间
                'end'=>date('Y-m-d H:i:s',$value['endtime1']),//结束时间
                'content'=>$value['conet'],//请假理由
                'more'=>$value['more_less'],//请假是否大于一天 1：小于一天，2：大于一天
                'numStr'=>$numStr,
                'remark'=>$value['reconet'],//审批意见
                'transfer'=>array(0=>'无课',1=>'自主调课',2=>'教务处调课')[$value['tktype']],
                'status'=>$value['status'],//请假状态，0：未处理，1：已同意，2：已拒绝
                'handle_time'=>date('Y-m-d H:i:s',$value['cltime']),//处理时间
                'create_time'=>date('Y-m-d H:i:s',$value['createtime'])
            )
        );
    }
}
$result = array(
    'school'=>array(
        'id'=>$school_id,
        'title'=>$school['title']
    ),
    'teacher'=>array(
        'id'=>$user_teacher['id'],
        'name'=>$user_teacher['tname'],
    ),
    'type'=>$type,
    'list'=>$list
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));