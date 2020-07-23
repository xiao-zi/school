<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/7
 * Time: 11:36
 */
/**
 * 学生的报名列表
 */
$school_id = intval($_POST['school_id']);
$school_id = 41;
appLoad()->model('signUp');
$model = new signUp();
$user = $model->get_app_info();
/**学校信息**/
$school = pdo_fetch("SELECT id,title,style1,headcolor FROM " . tablename($this->table_index) . " where id = '{$school_id}'");
if(empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_signup) . " where user_id = '{$user['id']}' And schoolid = '{$school_id}' ORDER BY createtime DESC");
$data = array();
foreach($list as $key => $row){
    $data[$key]['id'] = $row['id'];
    $data[$key]['name'] = $row['name'];
    $data[$key]['mobile'] = $row['mobile'];
    $data[$key]['sex'] = $row['sex'];
    $data[$key]['status'] = $row['status'];
    $data[$key]['number'] = $row['numberid'];
    $data[$key]['idCard'] = $row['idcard'];
    $data[$key]['birthday'] = date('Y-m-d H:i:s',$row['birthday']);
    if($row['sid']){
        $data[$key]['code'] = pdo_fetchcolumn("SELECT code FROM " . tablename($this->table_students) . " where id = '{$row['sid']}'");
        $data[$key]['pass_at'] = date('Y-m-d H:i:s',$row['passtime']);
    }
    $data[$key]['grade'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$row['nj_id']}' ");
    $data[$key]['class'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$row['bj_id']}' ");
    $data[$key]['cost'] = pdo_fetchcolumn("SELECT cost FROM " . tablename($this->table_classify) . " where sid = '{$row['bj_id']}' ");
    $data[$key]['orderStatus'] = pdo_fetchcolumn("SELECT status FROM " . tablename($this->table_order) . " where id = '{$row['orderid']}' ");
    $data[$key]['create_at'] = date('Y-m-d H:i:s',$row['createtime']);
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$data));