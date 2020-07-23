<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/20
 * Time: 17:42
 */
/**
 * 年级主任对其他教师的课程签到确认
 */
appLoad()->model('course');
$model = new course();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id

//当前老师的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT tpic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}

appLoad()->model('teacher');
$teacher_model = new teacher();
//获取该老师的所有管辖年级
$all_grade = $teacher_model->get_all_grade($teacher_id,$school_id);
//判断该老师是否有审核其他老师课程签到的权利
if(empty($all_grade)){
    json_encodeBack(array('status'=>10003,'msg'=>'非法请求！！'));
}
//拥有审核权利的年级数组
$grade_id_arr = array();
foreach($all_grade as $key => $value )
{
    $grade_id_arr[] = $value['sid'];
}
$type = 1;
if($type == 1){//根据课程来找签到记录
    //数组转字符串
    $grade_id_str = trim(implode(',',$grade_id_arr));
    //获取该老师在该学校拥有审核权利的课程
    $all_course = pdo_fetchall("select id,tid,OldOrNew,start,end,maintid,xq_id,bj_id,km_id,name,adrr,ReNum,RePrice,thumb from " .tablename($this->table_tcourse) . "where schoolid ='{$school_id}' and FIND_IN_SET(xq_id,'{$grade_id_str}')");
    if(empty($all_course)){
        json_encodeBack(array('status'=>10005,'msg'=>'对不起，您目前管辖的年级没有课程安排！'));
    }
    //获取学校的年级，班级，科目，教室等信息
    $category = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename($this->table_classify) . " WHERE schoolid = '{$school_id}' ");
    //把id作为键，返回新的数组
    $category = set_array_key($category,'id');
    $result = array();
    foreach ($all_course as $key_c=>$value_c){
        //课程名称
        $result[$key_c]['name'] = $value_c['name'];
        //开始时间
        $result[$key_c]['start'] = date('Y/m/d',$value_c['start']);
        //结束时间
        $result[$key_c]['end'] = date('Y/m/d',$value_c['end']);
        //课程图片
        $result[$key_c]['thumb'] = tomedia($value_c['thumb']);
        //起续课时数
        $result[$key_c]['num'] = $value_c['ReNum'];
        //续费价格/课时
        $result[$key_c]['price'] = $value_c['RePrice'];
        //年级
        if(!empty($value_c['xq_id'])){
            $result[$key_c]['grade'] = $category[$value_c['xq_id']]['name'];
        }
        //班级
        if(!empty($value_c['bj_id'])){
            $result[$key_c]['class'] = $category[$value_c['bj_id']]['name'];
        }
        //科目
        if(!empty($value_c['km_id'])){
            $result[$key_c]['subject'] = $category[$value_c['km_id']]['name'];
        }
        //授课教室
        if(!empty($value_c['adrr'])){
            $result[$key_c]['address'] = $category[$value_c['adrr']]['name'];
        }
        //主讲老师
        if($value_c['maintid'] != 0){
            $teacher = pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " where id = '{$value_c['maintid']}' AND schoolid = '{$school_id}' ");
        }else{
            $teacher = pdo_fetch("SELECT id,tname,thumb FROM " . tablename($this->table_teachers) . " where FIND_IN_SET(id,'{$value_c['tid']}') AND schoolid = '{$school_id}' ");
        }
        $result[$key_c]['teacher']['id'] = $teacher['id'];
        $result[$key_c]['teacher']['name'] = $teacher['tname'];
        unset($teacher['tname']);
        $result[$key_c]['teacher']['thumb'] = tomedia($teacher['thumb'])?tomedia($teacher['thumb']):tomedia($school['tpic']);//老师图像
        //查看授课老师列表
        $teaching = array();
        foreach(explode(',',$value_c['tid']) as $key_t => $value_t) {
            $teaching_teacher =  pdo_fetch("SELECT id,tname FROM " . tablename($this->table_teachers) . " WHERE schoolid = :schoolid And id = :id", array(':schoolid' => $school_id,':id' => $value_t));
            $teaching[] = $teaching_teacher;
        }
        $result[$key_c]['teaching']=$teaching;

        switch ($value_c['OldOrNew']){
            case 0:$result[$key_c]['type'] = '固定课程';break;
            case 1:$result[$key_c]['type'] = '自由课程';break;
        }
        $sign = array();
        //获取此课程的所有签到记录
        $all_sign = pdo_fetchall("select id,status,createtime,tid,ksid from " .tablename($this->table_kcsign) ." where schoolid = '{$school_id}' and sid = 0 and kcid = '{$value_c['id']}' ORDER BY createtime DESC ");
        foreach ($all_sign as $key_s=>$value_s){
            $sign[$key_s]['id'] = $value_s['id'];
            $sign[$key_s]['name'] = pdo_fetch("SELECT tname FROM " . tablename($this->table_teachers) . " where id = '{$value_s['tid']}' AND schoolid = '{$school_id}' ")['tname'];
            $sign[$key_s]['status'] = $value_s['status'];//1：未确认2：已确认
            if($value_c['OldOrNew'] == 0){
                $sign[$key_s]['nub'] = pdo_fetch("select nub FROM ".tablename($this->table_kcbiao)." WHERE id = '".$value_s['ksid']."'")['nub'];
            }
            $sign[$key_s]['createtime'] = date("Y-m-d H:i",$value_s['createtime']);

        }
        $result[$key_c]['sign'] = $sign;
    }
}else{//根据签到记录查找信息
    $result = array();
    //获取该学校所以老师的签到
    $all_sign =  pdo_fetchall("SELECT id,kcid,ksid,tid,createtime,status FROM " . tablename($this->table_kcsign) . " where schoolid = '{$school_id}' And sid=0 ORDER BY createtime DESC ");
    foreach( $all_sign as $key_s => $value_s ) {
        $course =  pdo_fetch("SELECT id,bj_id,xq_id,name,OldOrNew FROM " . tablename($this->table_tcourse) . " where schoolid = '{$school_id}' And id='{$value_s['kcid']}' ");
        if($kcinfo['OldOrNew'] ==0){
            $check_sign = pdo_fetch("SELECT id FROM " . tablename($this->table_kcsign) . " where schoolid = '{$schoolid}' And sid=0 And status=2 And ksid={$value_s['ksid']} ");
        }elseif($kcinfo['OldOrNew'] ==1){
            $start = strtotime(date("Ymd",$valuea['createtime']));
            $end =$timestart + 86399;
            $check_sign = pdo_fetch("SELECT id FROM " . tablename($this->table_kcsign) . " where schoolid = '{$schoolid}' And sid=0 And  status=2 And tid !={$value_s['tid']} And kcid={$value_s['kcid']} And createtime>{$start} And createtime<{$end} ");
        }
        if(in_array($course['xq_id'],$grade_id_arr)){
            $result[$key_s]['id'] = $value_s['id'];//签到id
            $result[$key_s]['teacher'] = pdo_fetch("SELECT tname FROM " . tablename($this->table_teachers) . " where id = '{$value_s['tid']}' AND schoolid = '{$school_id}' ")['tname'];
            $result[$key_s]['grade'] = pdo_fetch("select sname FROM ".tablename($this->table_classify)." WHERE sid = '{$course['xq_id']}'")['sname'];
            if(!empty($course['bj_id'])){
                $result[$key_s]['class'] = pdo_fetch("select sname FROM ".tablename($this->table_classify)." WHERE sid = '{$course['bj_id']}'")['sname'];
            }
            $result[$key_s]['OldOrNew'] = $course['OldOrNew'];//0:固定课程1：自由课程
            $result[$key_s]['name'] = $course['name'];//课程名称
            if($value_s['status'] ==2 ){
                $result[$key_s]['status'] = 2;//已签到
            }elseif($value_s['status'] ==1){
                if(!empty($checksign)){
                    $result[$key_s]['status'] = 1;//他人已签到
                }else{
                    $result[$key_s]['status'] = 0;//未确认
                }
            }
            if($course['OldOrNew'] == 0){
                $result[$key_s]['nub'] = pdo_fetch("select nub FROM ".tablename($this->table_kcbiao)." WHERE id = '".$value_s['ksid']."'")['nub'];
            }else{
                $result[$key_s]['nub'] = '自由课时';
            }
            $result[$key_s]['time'] = date("Y-m-d H:i",$value_s['createtime']);//签到时间
        }
    }
    json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));
}


