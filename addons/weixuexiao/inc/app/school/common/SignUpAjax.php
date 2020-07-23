<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/13
 * Time: 14:20
 */
/**
 * 报名的ajax请求
 */
$op = $_GET['op'];
$array = array (
    'submit',//视频播放
    'editSignUpInfo',//修改报名信息
    'refuse',//拒绝
    'agree',//同意

);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('signUp');
$model = new signUp();

if($operation == 'submit'){
    $data = $_POST;
//    $data = array(
//        'school_id'=>41,
//        'thumb'=>'school/img/20200601/202006011591003572.jpg',//学生头像
//        'name'=>'李的三',//姓名
//        'number'=>'64511132',//学号
//        'mobile'=>13720538810,//预留手机号
//        'sex'=>1,//1:男2：女
//        'birthday'=>'2020-07-14',//生日
//        'grade'=>6,//年级
//        'class'=>19,//班级
//        'idCard'=>54544646,//身份证号
//        'code'=>'453612',//短信验证码
//        'relation'=>3,//提交人和学生的关系，2：母亲3：父亲4：本人5：家人
//        'pic1'=>'school/img/20200601/202006011591003572.jpg',
//        'pic2'=>'school/img/20200601/202006011591003572.jpg',
//        'pic3'=>'school/img/20200601/202006011591003572.jpg',
//        'pic4'=>'school/img/20200601/202006011591003572.jpg',
//        'pic5'=>'school/img/20200601/202006011591003572.jpg',
//        'text1'=>'测试',
//        'text2'=>'测试',
//        'text3'=>'测试',
//        'text4'=>'测试',
//        'text5'=>'测试',
//        'text6'=>'测试',
//        'text7'=>'测试',
//        'text8'=>'测试',
//        'text9'=>'测试',
//        'text10'=>'测试',
//    );
    $result = $model->submit($data);
    json_encodeBack($result);
}

if($operation == 'editSignUpInfo'){
    $data = $_POST;
//    $data = array(
//        'id'=>2,
//        'thumb'=>'school/img/20200601/202006011591003572.jpg',//学生头像
//        'name'=>'李四儿',//姓名
//        'number'=>'64511132',//学号
//        'mobile'=>13720538810,//预留手机号
//        'sex'=>1,//1:男2：女
//        'birthday'=>'1995-03-26',//生日
//        'grade'=>6,//年级
//        'class'=>19,//班级
//        'idcard'=>54544646,//身份证号
//        'relation'=>3,//提交人和学生的关系，2：母亲3：父亲4：本人5：家人
//        'pic1'=>'school/img/20200601/202006011591003572.jpg',
//        'pic2'=>'school/img/20200601/202006011591003572.jpg',
//        'pic3'=>'school/img/20200601/202006011591003572.jpg',
//        'pic4'=>'school/img/20200601/202006011591003572.jpg',
//        'pic5'=>'school/img/20200601/202006011591003572.jpg',
//        'text1'=>'测试',
//        'text2'=>'测试',
//        'text3'=>'测试',
//        'text4'=>'测试',
//        'text5'=>'测试',
//        'text6'=>'测试',
//        'text7'=>'测试',
//        'text8'=>'测试',
//        'text9'=>'测试',
//        'text10'=>'测试',
//    );
    if(empty($data['id'])){
        json_encodeBack(array('status'=>10005,'msg'=>'请选择报名信息'));
    }
    if(empty($data['name']) || !checkRegular($data['name'],'CHINESE_NAME')){//验证用户名是否符合规则
        json_encodeBack(array('status'=>10003,'msg'=>'请输入正确的中国姓名'));
    }
    if(empty($data['mobile']) || !checkRegular($data['mobile'],'CHINA_PHONE')){//验证手机号是否符合规则
        json_encodeBack(array('status'=>10004,'msg'=>'请输入手机号码'));
    }
    if(empty($data['grade'])){
        json_encodeBack(array('status'=>10005,'msg'=>'请选择年级'));
    }
    if(empty($data['class'])){
        json_encodeBack(array('status'=>10006,'msg'=>'请选择班级'));
    }
    if(!in_array($data['sex'],array(1,2))){
        json_encodeBack(array('status'=>10007,'msg'=>'请选择性别'));
    }
    $result = $model->editSignUpInfo($data);
    json_encodeBack($result);
}
//拒绝学生的报名
if($operation == 'refuse'){
    $id = $_POST['id'];//报名表的id
//    $id = 2;
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'请选择报名信息'));
    }
    $result = $model->refuse($id);
    json_encodeBack($result);
}
//同意学生的报名
if($operation == 'agree'){
    $id = $_POST['id'];//报名表的id
    $id = 2;
    if(empty($id)){
        json_encodeBack(array('status'=>10002,'msg'=>'请选择报名信息'));
    }
    $result = $model->agree($id);
    json_encodeBack($result);
}