<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/30
 * Time: 10:23
 */
/**
 * 学生预约试听
 * @school_id  学校id int post notnull
 * @name 学生名字 string post notnull
 * @phone 学生的联系方式 string post notnull
 * @remark 学生的备注信息 string post null
 * @type 预约的类型 int post notnull 1:预约学校，2:预约课程
 * @course 课程的id int post  null
 */
$schoolid = $_POST['schoolid'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$remark = $_POST['remark'];
$type = $_POST['type'];
$course = $_POST['course'];

//$schoolid = 41;
//$name = '张三';
//$phone = '13720538844';
//$remark = '预约学校';
//$type = 1;
//$course = $_POST['course'];
if($schoolid){
    $school = pdo_fetch("SELECT id,comtid FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $schoolid));
    if(empty($school)){
        $result = array('status'=>'10002','msg'=>getAppConfig('status',10002));
    }elseif(empty($name) || !checkRegular($name,'CHINESE_NAME')){//验证用户名是否符合规则
        $result = array('status'=>'10003','msg'=>getAppConfig('status',10003));
    }elseif(empty($phone) || !checkRegular($phone,'CHINA_PHONE')){//验证手机号是否符合规则
        $result = array('status'=>'10004','msg'=>getAppConfig('status',10004));
    }else{
        //根据今天的时间判断该用户是否今天已经提交过预约试听
        $start = strtotime(date("Ymd",time()));
        $end = $start + 24*60*60;
        $condition = "And createtime>$start And createtime < $end";
        $check_audition = pdo_fetch("SELECT id FROM " . tablename($this->table_courseorder) . " where schoolid = ".$schoolid."  And  name = '".$name."' And tel = ".$phone."  $condition ");
        if($check_audition){
            $result = array('status'=>'10005','msg'=>getAppConfig('status',10005));
        }else{
            if($type==1){
                $tid = $school['comtid'];//学校负责预约的老师
            }else{
                $courseInfo = pdo_fetch("SELECT yytid FROM " . tablename($this->table_tcourse) . " where schoolid = ".$schoolid."  And id = '{$course}' ");
                if(!empty($gradeInfo['yytid']) && $gradeInfo['yytid'] != 0  ){//yytid课程预约负责的老师id  tid 课程的授课老师id字符串以,隔开
                    $tid = $gradeInfo['yytid'];
                }else{
                    $tid = $school['comtid'];//学校负责预约的老师
                }
            }
            $data = array(
                'name'       => $name,//姓名
                'tel'        => $phone,//联系方式
                'beizhu'     => $remark,//备注
                'kcid'       => $course,//课程的id
                'weid'       =>1,
                'schoolid'   => $schoolid,//学校的id
                'tid'        => $tid,//预约负责的老师
                'createtime' => time()
            );
            pdo_insert($this->table_courseorder, $data);
            $insertid = pdo_insertid();
            appLoad()->model('booking');
            $model = new booking();
            $this->sendMobileYykctz($insertid);//预约课程通知
            $result = array('status'=>'10001','msg'=>getAppConfig('status',10001));
        }
    }
}else{
    $result = array('status'=>'10002','msg'=>getAppConfig('status',10002));
}
json_encodeBack($result);