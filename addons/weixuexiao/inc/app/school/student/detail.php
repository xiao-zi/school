<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/2
 * Time: 9:01
 */
/**
 * 学生的详细个人信息
 */
$_POST = array(
    'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoyLCJ1c2VybmFtZSI6MTM3MjA1Mzg4MTEsInBob25lIjoxMzcyMDUzODgxMSwidGltZSI6MTU5MDU0MTIxM319.xrnrj-NhFxmdJyVVwnnPJ052OxnpOERkQMh0EzeX1YU',
    //'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7ImlkIjoiMSIsInVzZXJuYW1lIjoiMTM3MjA1Mzg4MTAiLCJwaG9uZSI6IjEzNzIwNTM4ODEwIiwidGltZSI6MTU4ODgzMzcwNX19.jghhZkaZ0ys9q_mpB5Fhr8vElZaDeyW5BDS0pM_oe6s',
);
$token = $_POST['token'];//验证用户身份

appLoad()->model('student');
$student_model = new student();
//检查用户是否登陆
$check_user = $student_model->Resolve_user_information($token);

if($check_user['status'] != 10001 || $check_user['msg'] != 'SUCCESS'){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//app用户的信息
$user = $check_user['data'];
$school_id = intval($_GET['school_id']);//学校的id
$user_id= intval($_GET['user_id']);//绑定表的id

$user_info = pdo_fetch("SELECT id,sid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
$school = pdo_fetch("SELECT title FROM " . tablename($this->table_index) . " where id = '{$user_info['schoolid']}' ");
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,qrcode_id,numberid,sex,mobile,area_addr,keyid,infocard FROM " . tablename($this->table_students) . " where  id= '{$user_info['sid']}'");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10004,'msg'=>'您尚未绑定学生身份，请到绑定页面，绑定学生身份！'));
}
$cardinfo = json_decode($student['infocard'],true);
//学生的监护人数组
if(empty($cardinfo['MainWatcharr'])){
    $guardian = array();
}else{
    $guardian = json_decode($cardinfo['MainWatcharr']);
}

$result = array(
    'title'=>$school['title'],//学校的标题
    'school_id'=>$user_info['schoolid'],//学校的id
    'student_id'=>$user_info['sid'],//学生的id
    'guardian'=>$guardian,//监护人数组
    'student'=>array(
        's_name'=>$student['s_name'],//学生的姓名
        'sex'=>$student['sex'],//性别 1：男 2：女
        'numberid'=>$student['numberid'],//学号
        'IDcard'=>$cardinfo['IDcard'],//身份证号
        'Nation'=>$cardinfo['Nation'],//民族
        'birthdate'=>date('Y-m-d',$student['birthdate']),//出生年月
        'seffectivetime'=>date('Y-m-d',$student['seffectivetime']),//入学日期
        'area_addr'=>$student['area_addr'],//家庭住址
        'NowAddress'=>$cardinfo['NowAddress'],
        'HomeChild'=>intval($cardinfo['HomeChild']),//留守儿童 1：是 0：否
        'SingleFamily'=>intval($cardinfo['SingleFamily']),//单亲家庭 1：是 0：否
        'IsKeep'=>intval($cardinfo['IsKeep']),//是否托管 1：是 0：否
        'DayOrWeek'=>intval($cardinfo['DayOrWeek']),//是否托管  0：不托管 1：午托 2：周周托
        'Fxueli'=>$cardinfo['Fxueli'],//父亲学历
        'Fwork'=>$cardinfo['Fwork'],//父亲的工作
        'Fhobby'=>$cardinfo['Fhobby'],//父亲的爱好
        'FWorkPlace'=>$cardinfo['FWorkPlace'],//父亲的工作地址
        'FID'=>intval(in_array(1,$guardian)),//用户判断父亲是否是监护人 如果在$guardian中是，否则不是
        'Mxueli'=>$cardinfo['Mxueli'],//母亲学历
        'Mwork'=>$cardinfo['Mwork'],//母亲的工作
        'Mhobby'=>$cardinfo['Mhobby'],//母亲的爱好
        'MWorkPlace'=>$cardinfo['MWorkPlace'],//母亲的工作地址
        'MID'=>intval(in_array(2,$guardian)),//用户判断母亲是否是监护人 是 0：否
        'GrandFxueli'=>$cardinfo['GrandFxueli'],//爷爷学历
        'GrandFwork'=>$cardinfo['GrandFwork'],//爷爷的工作
        'GrandFhobby'=>$cardinfo['GrandFhobby'],//爷爷的爱好
        'GrandFWorkPlace'=>$cardinfo['GrandFWorkPlace'],//爷爷的工作地址
        'GrandFID'=>intval(in_array(3,$guardian)),//用户判断爷爷是否是监护人 如果在$guardian中是，否则不是
        'GrandMxueli'=>$cardinfo['GrandMxueli'],//奶奶学历
        'GrandMwork'=>$cardinfo['GrandMwork'],//奶奶的工作
        'GrandMhobby'=>$cardinfo['GrandMhobby'],//奶奶的爱好
        'GrandMWorkPlace'=>$cardinfo['GrandMWorkPlace'],//奶奶的工作地址
        'GrandMID'=>intval(in_array(4,$guardian)),//用户判断奶奶是否是监护人 如果在$guardian中是，否则不是
        'WGrandFxueli'=>$cardinfo['WGrandFxueli'],//外公学历
        'WGrandFwork'=>$cardinfo['WGrandFwork'],//外公的工作
        'WGrandFhobby'=>$cardinfo['WGrandFhobby'],//外公的爱好
        'WGrandFWorkPlace'=>$cardinfo['WGrandFWorkPlace'],//外公的工作地址
        'WGrandFID'=>intval(in_array(5,$guardian)),//用户判断外公是否是监护人 如果在$guardian中是，否则不是
        'WGrandMxueli'=>$cardinfo['WGrandMxueli'],//外婆学历
        'WGrandMwork'=>$cardinfo['WGrandMwork'],//外婆的工作
        'WGrandMhobby'=>$cardinfo['WGrandMhobby'],//外婆的爱好
        'WGrandMWorkPlace'=>$cardinfo['WGrandMWorkPlace'],//外婆的工作地址
        'WGrandMID'=>intval(in_array(6,$guardian)),//用户判断外婆是否是监护人 如果在$guardian中是，否则不是
        'Otherxueli'=>$cardinfo['Otherxueli'],//其他人学历
        'Otherwork'=>$cardinfo['Otherwork'],//其他人的工作
        'Otherhobby'=>$cardinfo['Otherhobby'],//其他人的爱好
        'OtherWorkPlace'=>$cardinfo['OtherWorkPlace'],//其他人的工作地址
        'otherID'=>intval(in_array(7,$guardian)),//用户判断其他人是否是监护人 如果在$guardian中是，否则不是
        'Childhobby'=>$cardinfo['Childhobby'],//学生的爱好
        'ChildWord'=>$cardinfo['ChildWord'],//对学生的期望
        'SchoolWord'=>$cardinfo['Childhobby'],//对学校的期望
    ),
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));