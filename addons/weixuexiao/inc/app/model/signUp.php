<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/13
 * Time: 15:54
 */
include_once 'Basic.php';
class signUp extends Basic{

    public function submit($data){
        $school_id = $data['school_id'];
        if(empty($school_id)){
            return array('status'=>10003,'msg'=>'请选择学校');
        }
        $user = $this->get_app_info();
        $school = pdo_fetch("SELECT signset,is_picarr,picarrset,textarrset,is_textarr,is_sign FROM " . tablename('wx_school_index') . " where id = '{$school_id}'");
        $signSet = unserialize($school['signset']);//报名设置
        $picSet = unserialize($school['picarrset']);//上传图片设置
        $textSet = unserialize($school['textarrset']);//自定义字段设置

        if(empty($data['name']) || !checkRegular($data['name'],'CHINESE_NAME')){//验证用户名是否符合规则
            return array('status'=>10004,'msg'=>'请输入正确的中国姓名');
        }
        if(empty($data['mobile']) || !checkRegular($data['mobile'],'CHINA_PHONE')){//验证手机号是否符合规则
            return array('status'=>10005,'msg'=>'请输入手机号码');
        }
        //年级默认必填
        if(empty($data['grade'])){
            return array('status'=>10006,'msg'=>'请选择年级');
        }
        //性别默认必填
        if(!in_array($data['sex'],array(1,2))){
            return array('status'=>10007,'msg'=>'请选择性别');
        }
        //班级可以在后台设置，如果设置则必填
        if($signSet['is_bj'] == 1 && empty($data['class'])){
            return array('status'=>10007,'msg'=>'请选择班级');
        }
        //头像可以在后台设置，如果设置则必填
        if($signSet['is_head'] == 1 && empty($data['thumb'])){
            return array('status'=>10009,'msg'=>'请上传头像');
        }
        //生日可以在后台设置，如果设置则必填
        if($signSet['is_bir'] == 1 && empty($data['birthday'])){
            return array('status'=>10010,'msg'=>'请选择生日');
        }
        //身份证号可以在后台设置，如果设置则必填
        if($signSet['is_idcard'] == 1 && empty($data['idCard'])){
            return array('status'=>10011,'msg'=>'请选择生日');
        }
        //绑定身份可以在后台设置，如果设置则必填  2:母亲，3：父亲，4：本人，5：家长
        if($signSet['is_bd'] == 1 && empty($data['relation'])){
            return array('status'=>10012,'msg'=>'请选择关系');
        }
        //短信验证可以在后台设置，如果设置则必填
        if($signSet['is_sms'] == 1){
            if(empty($data['code'])){
                return array('status'=>10013,'msg'=>'请输入短信验证码');
            }else{
                $code_result = check_mobile_code($data['mobile'],$data['code']);
                if($code_result['status'] != 10013) {
                    return array('status'=>$code_result['status'],'msg'=>$code_result['msg']);
                }
            }
        }
        //根据学生必填的几个选项，搜索该学生是否是学生身份
        $checkStudent = pdo_fetch("SELECT id FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' And s_name = '{$data['name']}' And mobile = '{$data['mobile']}' And xq_id = '{$data['grade']}'");
        if(!empty($checkStudent)){
            json_encodeBack(array('status'=>10014,'msg'=>'该学生已经录入学校系统了'));
        }
        //根据学生必填的几个选项，判断该学生是否已经提交过报名申请
        $checkSignUp = pdo_fetch("SELECT id FROM " . tablename('wx_school_signup') . " WHERE schoolid = '{$school_id}' And name = '{$data['name']}' And mobile = '{$data['mobile']}' And sex = '{$data['sex']}' And nj_id = '{$data['grade']}' ");
        if(!empty($checkSignUp)){
            json_encodeBack(array('status'=>10015,'msg'=>'该学生已经提交过报名'));
        }
        //后台是否需要上传图片
        if($school['is_picarr'] == 1){
            if($picSet['is_picarr1'] == 1 && $picSet['is_picarr1_must'] == 1 && empty($data['pic1'])){
                return array('status'=>10016,'msg'=>'请上传'.$picSet['picarr1_name'].'图片');
            }
            if($picSet['is_picarr2'] == 1 && $picSet['is_picarr2_must'] == 1 && empty($data['pic2'])){
                return array('status'=>10016,'msg'=>'请上传'.$picSet['picarr2_name'].'图片');
            }
            if($picSet['is_picarr3'] == 1 && $picSet['is_picarr3_must'] == 1 && empty($data['pic3'])){
                return array('status'=>10016,'msg'=>'请上传'.$picSet['picarr3_name'].'图片');
            }
            if($picSet['is_picarr4'] == 1 && $picSet['is_picarr4_must'] == 1 && empty($data['pic4'])){
                return array('status'=>10016,'msg'=>'请上传'.$picSet['picarr4_name'].'图片');
            }
            if($picSet['is_picarr5'] == 1 && $picSet['is_picarr5_must'] == 1 && empty($data['pic5'])){
                return array('status'=>10016,'msg'=>'请上传'.$picSet['picarr5_name'].'图片');
            }
        }
        //后台是否设置了自定义字段
        if($school['is_textarr'] == 1){
            if($textSet['is_textarr1'] == 1 ){
                if(empty($data['text1']) && $textSet['is_textarr1_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr1_name']);
                }
                if(utf8_strlen($data['text1']) > $textSet['textarr1_length'] && $textSet['textarr1_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr1_name'].'的长度不能超过'.$textSet['textarr1_length']);
                }
            }
            if($textSet['is_textarr2'] == 1 ){
                if(empty($data['text2']) && $textSet['is_textarr2_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr2_name']);
                }
                if(utf8_strlen($data['text2']) > $textSet['textarr2_length']  && $textSet['textarr2_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr2_name'].'的长度不能超过'.$textSet['textarr2_length']);
                }
            }
            if($textSet['is_textarr3'] == 1 ){
                if(empty($data['text3']) && $textSet['is_textarr3_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr3_name']);
                }
                if(utf8_strlen($data['text3']) > $textSet['textarr3_length'] && $textSet['textarr3_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr3_name'].'的长度不能超过'.$textSet['textarr3_length']);
                }
            }
            if($textSet['is_textarr4'] == 1 ){
                if(empty($data['text4']) && $textSet['is_textarr4_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr4_name']);
                }
                if(utf8_strlen($data['text4']) > $textSet['textarr4_length'] && $textSet['textarr4_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr4_name'].'的长度不能超过'.$textSet['textarr4_length']);
                }
            }
            if($textSet['is_textarr5'] == 1 ){
                if(empty($data['text5']) && $textSet['is_textarr5_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr5_name']);
                }
                if(utf8_strlen($data['text5']) > $textSet['textarr5_length'] && $textSet['textarr5_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr5_name'].'的长度不能超过'.$textSet['textarr5_length']);
                }
            }
            if($textSet['is_textarr6'] == 1){
                if(empty($data['text6']) && $textSet['is_textarr6_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr6_name']);
                }
                if(utf8_strlen($data['text6']) > $textSet['textarr6_length'] && $textSet['textarr6_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr6_name'].'的长度不能超过'.$textSet['textarr6_length']);
                }
            }
            if($textSet['is_textarr7'] == 1){
                if(empty($data['text7']) && $textSet['is_textarr7_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr7_name']);
                }
                if(utf8_strlen($data['text7']) > $textSet['textarr7_length'] && $textSet['textarr7_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr7_name'].'的长度不能超过'.$textSet['textarr7_length']);
                }
            }
            if($textSet['is_textarr8'] == 1){
                if(empty($data['text8']) && $textSet['is_textarr8_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr8_name']);
                }
                if(utf8_strlen($data['text8']) > $textSet['textarr8_length'] && $textSet['textarr8_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr8_name'].'的长度不能超过'.$textSet['textarr8_length']);
                }
            }
            if($textSet['is_textarr9'] == 1){
                if(empty($data['text9']) && $textSet['is_textarr9_must'] == 1){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr9_name']);
                }
                if(utf8_strlen($data['text9']) > $textSet['textarr9_length'] && $textSet['textarr9_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr9_name'].'的长度不能超过'.$textSet['textarr9_length']);
                }
            }
            if($textSet['is_textarr10'] == 1 && $textSet['is_textarr10_must'] == 1){
                if(empty($data['text10'])){
                    return array('status'=>10017,'msg'=>'请输入'.$textSet['textarr10_name']);
                }
                if(utf8_strlen($data['text10']) > $textSet['textarr10_length'] && $textSet['textarr10_length'] != 0){
                    return array('status'=>10018,'msg'=>$textSet['textarr10_name'].'的长度不能超过'.$textSet['textarr10_length']);
                }
            }
        }
        $cost = pdo_fetchcolumn("SELECT cost FROM " . tablename('wx_school_classify') . " WHERE sid = '{$data['class']}' ");
        $randStr = str_shuffle('1234567890');
        $rand    = substr($randStr, 0, 6);
        $temp = array(
            'weid'=>1,
            'schoolid' =>$school_id,
            'name' => trim($data['name']),
            'icon' => $data['thumb'],
            'sex' => $data['sex'],
            'mobile' => trim($data['mobile']),
            'nj_id' => $data['grade'],
            'bj_id' => $data['class'],
            'idcard' => $data['idCard'],
            'numberid' => trim($data['number']),
            'birthday' => strtotime($data['birthday']),
            'type' => 2,//用户通过app提交，1：微信
            'user_id' =>$user['id'],
            'createtime' => time(),
            'cost' => $cost,
            'pard' => trim($data['relation']),
            'status' => 1,
            'code'=>$rand,//随机验证码
            'picarr1' => $data['pic1'],
            'picarr2' => $data['pic2'],
            'picarr3' => $data['pic3'],
            'picarr4' => $data['pic4'],
            'picarr5' => $data['pic5'],
            'textarr1'=> $data['text1'],
            'textarr2'=> $data['text2'],
            'textarr3'=> $data['text3'],
            'textarr4'=> $data['text4'],
            'textarr5'=> $data['text5'],
            'textarr6'=> $data['text6'],
            'textarr7'=> $data['text7'],
            'textarr8'=> $data['text8'],
            'textarr9'=> $data['text9'],
            'textarr10'=> $data['text10'],
        );
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $result = pdo_insert('wx_school_signup', $temp);
        $result1 = $result2 = true;//结果初始化
        $signUp_id = pdo_insertid();
        if (!empty($cost)){
            $temp1 = array(
                'schoolid' => $school_id,
                'type' => 4,
                'status' => 1,
                'cose' =>$cost,
                'orderid' => time(),
                'signid' => $signUp_id,
                'payweid' => $signSet['payweid'],
                'createtime' => time(),
            );
            $result1 = pdo_insert('wx_school_order', $temp1);
            $order_id = pdo_insertid();
            $result2 = pdo_update('wx_school_signup', array('orderid' => $order_id), array('id' =>$signUp_id));
        }
        $this->editSignUpInfoNoticeStudent($signUp_id);
        if($result1 && $result2 && $result){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10010,'msg'=>'提交失败!!!');
        }
    }
    /**
     * 老师修改报名信息
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function editSignUpInfo($data){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        if(empty($teacher_id)){
            return array('status'=>10002,'msg'=>'非法请求！');
        }
        if(!$this->getRole($teacher_id,2000703,$school_id,2)){
            return array('status'=>10008,'msg'=>'您没有权限修改报名信息！');
        }
        $checkStudent = pdo_fetch("SELECT id FROM " . tablename('wx_school_students') . " WHERE schoolid = '{$school_id}' And s_name = '{$data['name']}' And mobile = '{$data['mobile']}' And xq_id = '{$data['grade']}' ");
        if (!empty($checkStudent)){
            return array('status'=>10009,'msg'=>'该生已录入学校,无需重复审核！');
        }
        //报名该班级需要支付的金额
        $cost = pdo_fetchcolumn("SELECT cost FROM " . tablename('wx_school_classify') . " WHERE sid = '{$data['class']}'");
        $updateData = array(
            'weid' => 1,
            'schoolid' =>$school_id,
            'name' => trim($data['name']),
            'numberid' => $data['number'],
            'sex' => $data['sex'],
            'mobile' => $data['mobile'],
            'nj_id' => $data['grade'],
            'bj_id' => $data['class'],
            'idcard' => $data['idcard'],
            'pard' => $data['pard'],
            'birthday' => strtotime($data['birthday']),
            'cost' => $cost,
            'picarr1' => $data['pic1'],
            'picarr2' => $data['pic2'],
            'picarr3' => $data['pic3'],
            'picarr4' => $data['pic4'],
            'picarr5' => $data['pic5'],
            'textarr1'=>$data['text1'],
            'textarr2'=>$data['text2'],
            'textarr3'=>$data['text3'],
            'textarr4'=>$data['text4'],
            'textarr5'=>$data['text5'],
            'textarr6'=>$data['text6'],
            'textarr7'=>$data['text7'],
            'textarr8'=>$data['text8'],
            'textarr9'=>$data['text9'],
            'textarr10'=>$data['text10'],
        );
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $result = pdo_update('wx_school_signup', $updateData, array('id' => $data['id']));
        $result1 = $result2 = true;//结果初始化
        if (!empty($cost)){
            $order_id = pdo_fetchcolumn("SELECT orderid FROM " . tablename('wx_school_signup') . " WHERE id = '{$data['id']}'");
            $order = pdo_fetch("SELECT id FROM " . tablename('wx_school_order') . " WHERE id = '{$order_id}'");
            if (empty($order)) {
                $orderData = array(
                    'weid' =>  1,
                    'schoolid' =>$school_id,
                    'type' => 4,
                    'status' => 1,
                    'cose' => $cost,
                    'orderid' => time(),
                    'signid' => $data['id'],
                    'createtime' => time(),
                );
                $result1 = pdo_insert('wx_school_order', $orderData);
                $order_id = pdo_insertid();
                $result2 = pdo_update('wx_school_signup', array('orderid' => $order_id), array('id' =>$data['id']));
            }else{
                $orderData = array(
                    'cose' => $cost,
                );
                $result1 = pdo_update('wx_school_order', $orderData,array('id' =>$order_id));
            }
        }
        $this->editSignUpInfoNoticeStudent($data['id']);
        if($result1 && $result2 && $result){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10010,'msg'=>'修改失败!!!');
        }
    }

    /**
     * 老师同意学生的报名申请
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function agree($id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        if(!$this->getRole($teacher_id,2000702,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限处理报名信息！');
        }
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        //报名信息
        $signUpInfo= pdo_fetch("SELECT * FROM " . tablename('wx_school_signup') . " WHERE id = '{$id}'");
        if($signUpInfo['status'] == 2){
            return array('status'=>10005,'msg'=>'该学生信息已经录入信息库了！');
        }
        $school_id = $signUpInfo['schoolid'];//学校的id
        $school = pdo_fetch("SELECT signset,is_stuewcode,spic FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
        $signSet = iunserializer($school['signset']);
        $rand = $signUpInfo['code'];
        $temp = array(
            'weid' => 1,
            'schoolid' => $school_id,
            'icon' => $signUpInfo['icon'],
            's_name' => $signUpInfo['name'],
            'sex' => $signUpInfo['sex'],
            'numberid' => $signUpInfo['numberid'],
            'mobile' => $signUpInfo['mobile'],
            'xq_id' => $signUpInfo['nj_id'],
            'bj_id' => $signUpInfo['bj_id'],
            'note' => $signUpInfo['idcard'],
            'code' => $rand,
            'birthdate' => $signUpInfo['birthday'],
            'seffectivetime' => time(),
            'createdate' => time()
        );
        $result1 = pdo_insert('wx_school_students', $temp);
        $student_id = pdo_insertid();
        $QRCodeId = 0;
        if($school['is_stuewcode'] == 1){
            appLoad()->model('common');
            $common_model = new common();
            $QRCodeId = $common_model->GenerateStudentQRCode($student_id);
        }
        if($signSet['is_bd'] == 1 && !empty($signUpInfo['pard'])){
            $temp2 = array(
                'sid' => $student_id,
                'weid' => 1,
                'schoolid' => $school_id,
                'pard' => $signUpInfo['pard'],
                'userid'=>$signUpInfo['user_id'],
                'type'=>2,
                'realname'=>'',
                'mobile'=>$signUpInfo['mobile'],
                'createtime'=>time()
            );
            pdo_insert('wx_school_user', $temp2);
        }
        $temp1 = array(
            'sid' => $student_id,
            'status' => 2,
            'passtime' => time()
        );
        $temps = array(
            'keyid'    => $student_id,
            'qrcode_id'=> $QRCodeId,
        );
        $result = pdo_update('wx_school_students', $temps, array('id' =>$student_id));
        $result2 = pdo_update('wx_school_signup', $temp1, array('id' =>$id));
        if($result1 && $result2 && $result){
            $this->SignUpResultNoticeStudent($id);
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10004,'msg'=>'操作失败!!!');
        }
    }
    /**
     * 老师拒绝学生的报名申请
     * @param $id 报名的id
     * @return array
     * @throws ReflectionException
     */
    public function refuse($id){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id

        if(!$this->getRole($teacher_id,2000702,$school_id,2)){
            return array('status'=>10003,'msg'=>'您没有权限处理报名信息！');
        }
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $updateData = array(
            'status' => 3,
            'passtime' => time()
        );
        $result = pdo_update('wx_school_signup', $updateData, array('id' =>$id));
        if($result){
            $this->SignUpResultNoticeStudent($id);
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10004,'msg'=>'操作失败!!!');
        }
    }

    /**
     * 老师修改报名信息通知客户（学生）
     * @param $id
     */
    public function editSignUpInfoNoticeStudent($id){
        //报名信息
        $signUpInfo= pdo_fetch("SELECT * FROM " . tablename('wx_school_signup') . " WHERE id = '{$id}'");
        $school_id = $signUpInfo['schoolid'];//学校的id
        //获取是否开通学校通知
        $message_config = getConfig('message','editSignUpInfoNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['bjqshjg'] == 1){
            $name = $signUpInfo['name'];//学生姓名
            $title = $name.'您收到一条报名审核通知';
            $time = date('Y-m-d H:i:s');
            $cost = $signUpInfo['cost'];//支付金额
            if(!empty($cost)){
                $orderStatus = pdo_fetchcolumn("SELECT status FROM " . tablename('wx_school_order') . " where id = '{$signUpInfo['orderid']}' ");
                if($orderStatus == 1){
                    $status = "未付费";
                }elseif($orderStatus == 2){
                    $status = "已付费";
                }else{
                    $status = "已退费";
                }
            }else{
                $status = "审核中";
            }
            $data = array(
                'name'=>$name,
                'status'=>$status,
                'time'=>$time
            );
            $this->set_message($title,$data,'',array('id'=>$id),$signUpInfo['user_id'],'editSignUpInfoNoticeStudent');
        }
    }

    /**
     * 审核结果通知学生
     * @param $id
     */
    public function SignUpResultNoticeStudent($id){
        //报名信息
        $signUpInfo= pdo_fetch("SELECT * FROM " . tablename('wx_school_signup') . " WHERE id = '{$id}'");
        $school_id = $signUpInfo['schoolid'];//学校的id
        //获取是否开通学校通知
        $sms_config = getConfig('sms','SignUpResultNoticeStudent');
        //获取是否开通学校通知
        $message_config = getConfig('message','SignUpResultNoticeStudent');
        //查看该学校是否开通学校通知发送短信业务
        $school = pdo_fetch("SELECT sms_set,sms_rest_times FROM ".tablename('wx_school_index')." WHERE id = '{$school_id}' ");
        $school_sms_set = unserialize($school['sms_set']);
        if($message_config['on'] == 1 || $school_sms_set['bjqshjg'] == 1){

            $name = $signUpInfo['name'];//学生姓名
            $title = $name.'您收到一条报名审核通知';
            $status = $signUpInfo['status'];
            $rand = $signUpInfo['code'];
            $mobile = $signUpInfo['mobile'];//预留电话
            if ($status == 2){
                $type = "已通过";
                $body = "您可以通过以下信息绑定学生:\n学生姓名:{$name}\n学号:{$signUpInfo['numberid']}\n手机号码:{$signUpInfo['mobile']}\n绑定码:{$rand}\n千万不要将本信息告诉给陌生人 ";
            }else if($status == 3){
                $type = "未通过";
                $body = "点击本条消息查看详情 ";
            }
            $time = date('Y-m-d H:i:s');
            $data = array(
                'name'=>$name,
                'status'=>$type,
                'content'=>$body,
                'time'=>$time
            );
            $this->set_message($title,$data,'',array('id'=>$id),$signUpInfo['user_id'],'SignUpResultNoticeStudent');
            if(!empty($sms_config['name']) && !empty($sms_config['code']) && $school_sms_set['bjqshjg'] == 1 && $school['sms_rest_times'] > 0){
                if($mobile){
                    $content = array(
                        'name' => $name,
                        'title'=>'报名申请审核',
                        'status'=>$type,
                        'time' => date('m月d日 H:i', TIMESTAMP),
                    );
                    appLoad()->func('sms');
                    sms_send($mobile, $content, $sms_config['name'], $sms_config['code'], 'bjqshjg', 0, $school_id);
                }
            }
        }
    }

}