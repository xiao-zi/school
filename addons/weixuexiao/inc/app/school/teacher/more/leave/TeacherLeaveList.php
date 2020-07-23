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
//请假列表
$leave_list = pdo_fetchall("SELECT id,more_less,ksnum,startime1,endtime1,type,tktype,conet,reconet,status,createtime,cltid,cltime,classid FROM " . tablename($this->table_leave) . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And sid = 0 And isliuyan = 0 ORDER BY createtime DESC");
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
        $checker = pdo_fetch("SELECT id,tname,mobile,thumb FROM " . tablename($this->table_teachers) . " where id='{$value['cltid']}' AND schoolid='{$school_id}'");
    }
    if($type == 1){
        if($value['endtime1'] - $value['startime1'] + 1 >= 86399 ){//判断请假时间是否大于一天
            $more = 2;
            $numStr = floor(($value['endtime1'] - $value['startime1'] + 1)/86400 ).'天';
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
        $course = pdo_fetch("SELECT id,bj_id as class_id,km_id as course_id FROM ".tablename('wx_school_user_class')." WHERE id = {$value['classid']}");
        if(!empty($course['class_id'])){
            $class_info = pdo_fetch("SELECT sname,parentid,is_over FROM ".tablename('wx_school_classify')." WHERE sid = '{$course['class_id']}' ");
            $grade_name = pdo_fetchcolumn("SELECT sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$class_info['parentid']}' ");
            $course['grade_name'] = $grade_name;
            $course['class_name'] = $class_info['sname'];
            $course['is_over'] = $class_info['is_over'];
        }
        if(!empty($course['course_id'])){
            $course['course_name'] = pdo_fetchcolumn("SELECT sname FROM ".tablename('wx_school_classify')." WHERE sid = '{$course['course_id']}' ");
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
                'course'=>$course,
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
        'id'=>$teacher['id'],
        'name'=>$teacher['name'],
    ),
    'type'=>$type,
    'list'=>$list
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));