<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/6
 * Time: 11:23
 */

/**
 * 添加新学生信息
 * @token 验证用户信息 string post notnull
 * @schoolid 学校的id int post notnull
 * @name 学生的名字 string post notnull
 * @phone 联系方式 char post notnull
 * @sex 性别 int post notnull 1:男 2：女
 * @part 关系 int post notnull 2:母亲 3：父亲 4：本人 5：家长
 * @course 课程id int post notnull
 * @bj 班级信息id int post notnull
 * @nj 年级信息id int post notnull
 */

$token = $_POST['token'];
if(empty($token)){
    $result = array('status'=>'10102','msg'=>getAppConfig('status',10102));
}else{
    $tokenResult = decryptToken($token);
    if($tokenResult['status'] == '10001'){
        if(empty($_POST['schoolid'])){
            $result = array('status'=>'10102','msg'=>getAppConfig('status',10102));
        }else{
            $schoolid = $_POST['schoolid'];//学校的id
            $name = $_POST['name'];//学生名字
            $phone = $_POST['phone'];//手机号
            $sex = $_POST['sex'];//性别
            $part = $_POST['part'];//关系
            $course_id = $_POST['course'];//课程id
            $bj = $_POST['bj'];//班级id
            $nj = $_POST['nj'];//年级id
            $checkStudent = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " WHERE schoolid = {$schoolid} And s_name like '{$sname}%' And mobile={$mobile} And sex = {$sex} ");
            if(!empty($checkStudent)){
                $result = array('status'=>'10007','msg'=>getAppConfig('status',10007));
            }else{
                //检查该信息是否添加到报名名单中
                $checkAddStudent = pdo_fetch("SELECT id,sname FROM " . tablename($this->table_tempstudent) . " WHERE schoolid = {$schoolid} And sname like '{$sname}' And mobile={$mobile} And sex = {$sex} ");
                if(!empty($checkAddStudent)){
                    //检查是否存在该信息的订单
                    $hasOrder = pdo_fetch("SELECT id FROM " . tablename($this->table_order) . " WHERE weid = {$weid} And schoolid = {$schoolid} And tempsid = '{$checknewstu1['id']}' And kcid={$course_id} And status = 1 ");
                    if(!empty($hasOrder)){
                        $data = array(
                            'is_order'=>true,
                            'order_id'=>$hasOrder['id'],
                            'tempstudent_id'=>$checkAddStudent['id']
                        );
                        $result = array('status'=>'10008','msg'=>getAppConfig('status',10008),'data'=>$data);
                    }
                }else{
                    $school = pdo_fetch("SELECT * FROM " . tablename($this->table_index) . " WHERE :id = id", array(':id' => $schoolid));
                    $course = pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " WHERE :id = id", array(':id' => $course_id));
                    //统计在订单中有多少人报名了该课程
                    $yb = pdo_fetchcolumn("select count(*) FROM ".tablename($this->table_order)." WHERE kcid = '".$course_id."' And (status = 2 or type = 2) ");
                    $rest = $course['minge'] - $yb;
                    //判断报名人数是否充足
                    if ($rest < 1){
                        $result = array('status'=>'10009','msg'=>getAppConfig('status',10009));
                    }else{
                        if (time() >= $course['end']) {
                            $result = array('status'=>'10010','msg'=>getAppConfig('status',10010));
                        }else{
                            $temp_data = array(
                                'schoolid' => $schoolid,
                                'sname' =>$name,
                                'mobile'=> $phone,
                                'sex' => $sex,
                                'addr' => $addr,
                                'nj_id' =>$nj,
                                'bj_id' => $bj,
                                'pard' => $part,
                                'type' =>2,//默认为1，指的是微信公众号，2：app
                                'userid'=>$tokenResult['data']['id']
                            );
                            pdo_insert($this->table_tempstudent,$temp_data);
                            $tempstuid = pdo_insertid();
                            $temp = array(
                                'schoolid' => $schoolid,
                                'tempsid' => $tempstuid,
                                'type' => 1,
                                'status' => 1,
                                'kcid' => $course_id,
                                'uid' => $uid,
                                'cose' => $course['cose'],
                                'payweid' => $course['payweid'],
                                'orderid' => $tempstuid,
                                'createtime' => time(),
                                'ksnum'=>$course['FirstNum']
                            );
                            if(!empty($shareuserid)){
                                $temp['shareuserid'] = $shareuserid;
                            }
                            pdo_insert($this->table_order, $temp);
                            $order_id = pdo_insertid();
                            $result = array('status'=>'10011','msg'=>getAppConfig('status',10011),'data'=>array('order_id'=>$order_id));
                        }
                    }

                }
            }
        }
    }else{
        $result = array('status'=>$tokenResult['status'],'msg'=>getAppConfig('status',$tokenResult['status']));
    }
}
json_encodeBack($result);