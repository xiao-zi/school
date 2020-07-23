<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/13
 * Time: 10:59
 */
$id = $_GET['id'];//报名的id


appLoad()->model('signUp');
$model = new signUp();

$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
if(!$model->getRole($teacher_id,2000702,$school_id,2) && !$model->getRole($teacher_id,2000703,$school_id,2)){
    json_encodeBack(array('status'=>10003,'msg'=>'您没有权限查看本页面！'));
}
$school = pdo_fetch("SELECT picarrset,textarrset,spic,is_textarr,is_picarr FROM " . tablename('wx_school_index') . " where  id= '{$school_id}'");


$signUp = pdo_fetch("SELECT * FROM " . tablename($this->table_signup) . " where id = '{$id}'");
$grade = pdo_fetchcolumn("select sname from " .tablename('wx_school_classify') ." where sid = '{$signUp['nj_id']}'");
$classInfo = pdo_fetch("select sname,cost from " .tablename('wx_school_classify') ." where sid = '{$signUp['bj_id']}'");
$class = $classInfo['sname'];
//报名用户的图片
$thumb = pdo_fetchcolumn("select thumb from ".tablename('app_school_user')." where id = '{$signUp['user_id']}'");
$thumb = empty($thumb)?tomedia($school['spic']):tomedia($thumb);
$orderStatus = pdo_fetchcolumn("SELECT status FROM " . tablename($this->table_order) . " where id = '{$signUp['orderid']}'");

$classList = pdo_fetchall("SELECT sid as id,sname as name FROM " . tablename($this->table_classify) . " where parentid = '{$signUp['nj_id']}' And type = 'theclass' ORDER BY ssort ASC");
$picArr = $textArr = array();
if($school['is_picarr'] == 1){
    $picArrShow = unserialize($school['picarrset']);
    if($picArrShow['is_picarr1'] == 1){
        $picArr[] = array(
            'title'=>$picArrShow['picarr1_name'],
            'name'=>'pic1',
            'image'=>tomedia($signUp['picarr1']),
        );
    }
    if($picArrShow['is_picarr2'] == 1){
        $picArr[] = array(
            'title'=>$picArrShow['picarr2_name'],
            'name'=>'pic2',
            'image'=>tomedia($signUp['picarr2']),
        );
    }
    if($picArrShow['is_picarr3'] == 1){
        $picArr[] = array(
            'title'=>$picArrShow['picarr3_name'],
            'name'=>'pic3',
            'image'=>tomedia($signUp['picarr3']),
        );
    }
    if($picArrShow['is_picarr4'] == 1){
        $picArr[] = array(
            'title'=>$picArrShow['picarr4_name'],
            'name'=>'pic4',
            'image'=>tomedia($signUp['picarr4']),
        );
    }
    if($picArrShow['is_picarr5'] == 1){
        $picArr[] = array(
            'title'=>$picArrShow['picarr5_name'],
            'name'=>'pic5',
            'image'=>tomedia($signUp['picarr5']),
        );
    }
}
if($school['is_textarr'] == 1){
    $textArrShow = unserialize($school['textarrset']);
    if($textArrShow['is_textarr1'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr1_name'],
            'name'=>'text1',
            'content'=>$signUp['textarr1'],
        );
    }
    if($textArrShow['is_textarr2'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr2_name'],
            'name'=>'text2',
            'content'=>$signUp['textarr2'],
        );
    }
    if($textArrShow['is_textarr3'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr3_name'],
            'name'=>'text3',
            'content'=>$signUp['textarr3'],
        );
    }
    if($textArrShow['is_textarr4'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr4_name'],
            'name'=>'text4',
            'content'=>$signUp['textarr4'],
        );
    }
    if($textArrShow['is_textarr5'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr5_name'],
            'name'=>'text5',
            'content'=>$signUp['textarr5'],
        );
    }
    if($textArrShow['is_textarr6'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr6_name'],
            'name'=>'text6',
            'content'=>$signUp['textarr6'],
        );
    }
    if($textArrShow['is_textarr7'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr7_name'],
            'name'=>'text7',
            'content'=>$signUp['textarr7'],
        );
    }
    if($textArrShow['is_textarr8'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr8_name'],
            'name'=>'text8',
            'content'=>$signUp['textarr8'],
        );
    }
    if($textArrShow['is_textarr9'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr9_name'],
            'name'=>'text9',
            'content'=>$signUp['textarr9'],
        );
    }
    if($textArrShow['is_textarr10'] == 1){
        $textArr[] = array(
            'title'=>$textArrShow['textarr10_name'],
            'name'=>'text10',
            'content'=>$signUp['textarr10'],
        );
    }
}
$result = array(
    'id'=>$signUp['id'],
    'thumb'=>$thumb,//报名学生展示头像
    'name'=>$signUp['name'],//学生的姓名
    'status'=>$signUp['status'],//报名状态 1:待审核,2:已通过,2:已拒绝
    'number'=>$signUp['numberid'],//学号
    'mobile'=>$signUp['mobile'],//预留的手机号
    'sex'=>$signUp['sex'],//1:男 2：女
    'birthday'=>date('Y-m-d',$signUp['birthday']),//生日
    'relation'=>getRelationship($signUp['pard']),//关系
    'pard'=>$signUp['pard'],//提交人和学生的关系，2：母亲3：父亲4：本人5：家人
    'idcard'=>$signUp['idcard'],//身份证号
    'grade'=>$grade,//年级
    'class'=>$signUp['bj_id'],//班级
    'cost'=>$signUp['cost'],//报名需要支付的金额
    'orderStatus'=>$orderStatus,//支付的状态 1:未支付2:已支付3:已退费
    'classList'=>$classList,//可选班级
    'picArr'=>$picArr,//后台自定义图片数组 不一定有数据
    'textArr'=>$textArr,//后台自定义的字段
);
json_encodeBack(array('status'=>'10001','msg'=>'SUCCESS','data'=>$result));