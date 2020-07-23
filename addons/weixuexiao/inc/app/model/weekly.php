<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/14
 * Time: 16:41
 */
include_once 'Basic.php';
class weekly extends Basic{
    /**
     * 老师上传图片周计划
     * @param $class_id 班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
     * @param $planUid 周计划的字符串编码,用来识别周计划(作用类似id)
     * @param $image 图片文件
     * @return array
     * @throws ReflectionException
     */
    public function WeeklyUploadImage($class_id,$planUid,$image){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //学生的周计划
        if($class_id != -1){
            $role = $this->getRole($teacher_id,2000902,$school_id,2);//查看学生的周计划的权限
            if(!$role){
                return array('status'=>10005,'msg'=>'您无权编辑学生的周计划');
            }
        }else{//老师的周计划
            $role = $this->getRole($teacher_id,2000912,$school_id,2);//查看老师的周计划的权限
            if(!$role){
                return array('status'=>10005,'msg'=>'您无权编辑老师的周计划');
            }
        }
        appLoad()->model('upload');
        $upload = new upload();
        $upload->img_size = 10000;
        $upload->type = array("gif", "jpeg", "jpg", "png");
        $upload->address = 'school/img/';
        $uploadResult = $upload->uploadFile($image);
        IF(!$uploadResult['status']){
            return array('status'=>10004,'msg'=>'图片上传失败！');
        }
        $plan = pdo_fetch("SELECT * FROM " . tablename('wx_school_zjh') . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' And type = 1 And planuid = '{$planUid}' ");
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        if (empty($plan)) {
            $data = array(
                'weid' => 1,
                'schoolid' => $school_id,
                'bj_id' => $class_id,
                'type' => 1,
                'planuid' => $planUid,
                'picrul' => $uploadResult['msg'],
                'createtime' => time(),
                'tid' =>$teacher_id
            );
            $result = pdo_insert('wx_school_zjh', $data);
        }else{
            $result = pdo_update('wx_school_zjh', array('picrul' => $uploadResult['msg'],'createtime' => time()), array('planuid' => $planUid,'bj_id'=>$class_id,'type'=>1));
        }
        if($result){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10006,'msg'=>'编辑失败!!!');
        }
    }

    /**
     * 设置活动项
     * @param $class_id 班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
     * @param $planUid 周计划的字符串编码,用来识别周计划(作用类似id)
     * @param $activityItem 活动数组
     * @param int $start 开始时间 时间戳,默认没有
     * @param int $end 结束时间 时间戳,默认没有
     * @return array
     * @throws ReflectionException
     */
    public function setActivityItem($class_id,$planUid,$activityItem,$start = 0,$end = 0){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //学生的周计划
        if($class_id != -1){
            $role = $this->getRole($teacher_id,2000902,$school_id,2);//查看学生的周计划的权限
            if(!$role){
                return array('status'=>10005,'msg'=>'您无权编辑学生的周计划');
            }
        }else{//老师的周计划
            $role = $this->getRole($teacher_id,2000912,$school_id,2);//查看老师的周计划的权限
            if(!$role){
                return array('status'=>10005,'msg'=>'您无权编辑老师的周计划');
            }
        }
        $check = pdo_fetch("SELECT * FROM " . tablename('wx_school_zjh') . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' And type = 2 And planuid = '{$planUid}' ");
        $date = array(
            'weid' =>1,
            'schoolid' =>$school_id,
            'bj_id' =>$class_id,
            'start'=>$start,
            'end'=>$end,
            'type' => 2,
            'planuid' =>$planUid
        );
        if (empty($check)){
            pdo_insert('wx_school_zjh', $date);
        }else{
            pdo_update('wx_school_zjh', $date, array('planuid' =>$planUid,'schoolid'=>$school_id,'bj_id'=>$class_id));
        }
        foreach ($activityItem as $key => $value) {
            $item = pdo_fetch("SELECT id FROM " . tablename('wx_school_zjhset') . " where schoolid = '{$school_id}' And activetypeid = '{$value['ActiveTypeId']}' And type = '{$value['ActiveTypeIcon']}' And planuid = '{$planUid}' ");
            if (!empty($item)){
                pdo_update('wx_school_zjhset', array('activetypename' => $value['ActiveTypeName']), array('id' => $item['id']));
            }else{
                $ActiveTypeId = getRandString(8).'-'.getRandString(4).'-'.getRandString(4).'-'.getRandString(4).'-'.getRandString(12);
                $temp = array(
                    'weid' => 1,
                    'schoolid' =>$school_id,
                    'activetypeid' => !empty($value['ActiveTypeId']) ? $value['ActiveTypeId'] : $ActiveTypeId,
                    'activetypename' => $value['ActiveTypeName'],
                    'type' => $value['ActiveTypeIcon'],
                    'planuid' =>$planUid
                );
                pdo_insert('wx_school_zjhset', $temp);
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$this->getActivityItem($planUid,$class_id));
    }

    /**
     * 获取周计划的活动项
     * @param $planUid
     * @param $class_id  班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
     * @return array
     */
    public function getActivityItem($planUid,$class_id){
        $activityItem = pdo_fetchall("SELECT activetypename as ActiveTypeName,activetypeid as ActiveTypeId,type as ActiveTypeIcon FROM " . tablename('wx_school_zjhset') . " where planuid = '{$planUid}' order by id asc,ssort asc ");
        if(empty($activityItem)){
            if($class_id != -1){
                $result = array(
                    'AM'=>array(
                        Array(
                            'ActiveTypeName' => '晨间活动',
                            'ActiveTypeId' => 'morning_activity',
                            'ActiveTypeIcon' => 'AM',
                        ),
                        Array(
                            'ActiveTypeName' => '教学活动',
                            'ActiveTypeId' => 'teach_activity',
                            'ActiveTypeIcon' => 'AM',
                        ),
                    ),
                    'PM'=>ARRAY(
                        Array(
                            'ActiveTypeName' => '户外活动',
                            'ActiveTypeId' => 'out_activity',
                            'ActiveTypeIcon' => 'PM',
                        ),
                        Array(
                            'ActiveTypeName' => '游戏活动',
                            'ActiveTypeId' => 'game_activity',
                            'ActiveTypeIcon' => 'PM',
                        ),
                    ),
                );
            }else{
                $result = array(
                    'AM'=>array(
                        Array(
                            'ActiveTypeName' => '工作安排',
                            'ActiveTypeId' => 'morning_activity',
                            'ActiveTypeIcon' => 'AM',
                        ),
                        Array(
                            'ActiveTypeName' => '备注',
                            'ActiveTypeId' => 'teach_activity',
                            'ActiveTypeIcon' => 'AM',
                        ),
                    ),
                    'PM'=>ARRAY(
                        Array(
                            'ActiveTypeName' => '工作安排',
                            'ActiveTypeId' => 'out_activity',
                            'ActiveTypeIcon' => 'PM',
                        ),
                        Array(
                            'ActiveTypeName' => '备注',
                            'ActiveTypeId' => 'game_activity',
                            'ActiveTypeIcon' => 'PM',
                        ),
                    ),
                );
            }
        }ELSE{
            $result = array();
            foreach ($activityItem as $key=>$value){
                if($value['ActiveTypeIcon'] == 'AM'){
                    $result['AM'][] = $value;
                }
                if($value['ActiveTypeIcon'] == 'PM'){
                    $result['PM'][] = $value;
                }
            }
        }
        return $result;
    }

    /**
     * @param $class_id 班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
     * @param $planUid 周计划的字符串编码,用来识别周计划(作用类似id)
     * @param $week 星期几 1-5
     * @param $detailId 详情的字符串编码.用来识别活动项
     * @param $activityItem 活动详情
     * @param $ActiveTypeName 活动项名称
     * @param $ActivityId 设置项的字符串编码.用来识别活动项
     * @param $start
     * @param $end
     * @return array
     * @throws ReflectionException
     */
    public function setActivityItemDetail($class_id,$planUid,$week,$detailId,$activityItem,$ActiveTypeName,$ActivityId,$start,$end){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        //学生的周计划
        if($class_id != -1){
            $role = $this->getRole($teacher_id,2000902,$school_id,2);//查看学生的周计划的权限
            if(!$role){
                return array('status'=>10005,'msg'=>'您无权编辑学生的周计划');
            }
        }else{//老师的周计划
            $role = $this->getRole($teacher_id,2000912,$school_id,2);//查看老师的周计划的权限
            if(!$role){
                return array('status'=>10005,'msg'=>'您无权编辑老师的周计划');
            }
        }
        $check = pdo_fetch("SELECT * FROM " . tablename('wx_school_zjh') . " where schoolid = '{$school_id}' And bj_id = '{$class_id}' And type = 2 And planuid = '{$planUid}' ");
        $date = array(
            'weid' =>1,
            'schoolid' =>$school_id,
            'bj_id' =>$class_id,
            'start'=>$start,
            'end'=>$end,
            'type' => 2,
            'planuid' =>$planUid
        );
        if (empty($check)){
            pdo_insert('wx_school_zjh', $date);
        }else{
            pdo_update('wx_school_zjh', $date, array('planuid' =>$planUid,'schoolid'=>$school_id,'bj_id'=>$class_id));
        }
        $detail = '';
        foreach ($activityItem as $key => $value) {
            $detail .= $value."\\n";
        }
        $item = pdo_fetch("SELECT id FROM " . tablename('wx_school_zjhdetail') . " where schoolid = '{$school_id}' And curactiveid = '{$ActivityId}' And week = '{$week}' And planuid = '{$planUid}' ");
        $ActiveTypeId = getRandString(8).'-'.getRandString(4).'-'.getRandString(4).'-'.getRandString(4).'-'.getRandString(12);

        $temp = array(
            'weid' => 1,
            'schoolid' =>$school_id,
            'detailuid' => !empty($detailId) ? $detailId: $ActiveTypeId,
            'curactiveid' => $ActivityId,
            'curactivename' => $ActiveTypeName,
            'week' => $week,
            'activedesc'=>$detail,
            'planuid' =>$planUid
        );
        if (!empty($item)){
            pdo_update('wx_school_zjhdetail',$temp , array('id' => $item['id']));
        }else{
            pdo_insert('wx_school_zjhdetail', $temp);
        }
        $result = array('week'=>$week,'detail'=>$activityItem,'ActivityId'=>$ActivityId);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 获取文章周计划详情
     * @param $planUid
     * @param $class_id
     * @param $week
     * @return array
     */
    public function getActivityItemDetail($planUid,$class_id,$week){
        $item = $this->getActivityItem($planUid,$class_id);
        foreach ($item as $key=>$value){
            foreach ($value as $k=>$val){
                $item[$key][$k]['detail'] = pdo_fetchcolumn("SELECT activedesc FROM " . tablename('wx_school_zjhdetail') . " where curactiveid = '{$val['ActiveTypeId']}' And week = '{$week}' And planuid = '{$planUid}' ");
            }
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$item);
    }
    /**
     * 保存周计划
     * @param $planUid 班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
     * @param $start 开始时间
     * @param $end 结束时间
     * @return array
     * @throws ReflectionException
     */
    public function saveWeekly($planUid,$start,$end){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $plan = pdo_fetch("SELECT bj_id,start,end FROM " . tablename('wx_school_zjh') . " where planuid = '{$planUid}' ");
        if(empty($plan)){
            return array('status'=>10003,'msg'=>'没有找到该条周计划');
        }
        if($plan['bj_id'] != -1){//学生的周计划
            //删除学生的周计划的权限
            if(!$this->getRole($teacher_id,2000902,$school_id,2)){
                return array('status'=>10005,'msg'=>'您无权编辑学生的周计划');
            }
        }else{
            //删除老师的周计划的权限
            if(!$this->getRole($teacher_id,2000912,$school_id,2)){
                return array('status'=>10005,'msg'=>'您无权编辑老师的周计划');
            }
        }
        $check = pdo_fetch("SELECT * FROM " . tablename('wx_school_zjh') . " where schoolid = '{$school_id}' And bj_id = '{$plan['bj_id']}' And type = 1 And start < '{$start}' And end > '{$end}'");
        if($check){
            return array('status'=>10006,'msg'=>'本时间范围内已有周计划');
        }
        $updateData = array(
            'weid' => 1,
            'schoolid' =>$school_id,
            'bj_id' =>$plan['bj_id'],
            'start' => $start,
            'end' => $end,
            'type' => 1,
            'is_on' => 2,
            'createtime' => time(),
            'tid' => $teacher_id
        );
        $result = pdo_update('wx_school_zjh', $updateData, array('planuid' =>$planUid));
        if($result){
            $msg = '保存周计划成功!';
            //只要老师有积分活动和任务
            $point_model =parent::model('point');
            $point = $point_model::pointsBonus($user['school_id'],$user['id'],'sczjh');
            $point += $point_model::pointsTask($user['school_id'],$user['id'],'sczjh');
            if($point != 0){
                $msg = '保存周计划成功！积分+'.$point;
            }
            return array('status'=>10001,'msg'=>$msg);
        }else{
            return array('status'=>10007,'msg'=>'保存失败!!!');
        }
    }
    /**
     * 删除周计划
     * @param $planUid 班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
     * @return array
     * @throws ReflectionException
     */
    public function deleteWeekly($planUid){
        $user = $this->get_user_info('teacher');
        $teacher_id = $user['teacher_id'];//老师的id
        $school_id = $user['school_id'];//学校的id
        $plan = pdo_fetch("SELECT bj_id FROM " . tablename('wx_school_zjh') . " where planuid = '{$planUid}' ");
        if(empty($plan)){
            return array('status'=>10003,'msg'=>'没有找到该条周计划');
        }
        if($plan['bj_id'] != -1){//学生的周计划
            //删除学生的周计划的权限
            if(!$this->getRole($teacher_id,2000903,$school_id,2)){
                return array('status'=>10005,'msg'=>'您无权删除学生的周计划');
            }
        }else{
            //删除老师的周计划的权限
            if(!$this->getRole($teacher_id,2000913,$school_id,2)){
                return array('status'=>10005,'msg'=>'您无权删除老师的周计划');
            }
        }
        pdo_delete('wx_school_zjh', array('planuid' =>$planUid));
        pdo_delete('wx_school_zjhset', array('planuid' =>$planUid));
        pdo_delete('wx_school_zjhdetail', array('planuid' =>$planUid));
        return array('status'=>10001,'msg'=>'SUCCESS');
    }
}