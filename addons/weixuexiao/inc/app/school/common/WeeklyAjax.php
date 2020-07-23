<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/14
 * Time: 16:40
 */
/**
 * 周计划
 */
$op = $_GET['op'];
$array = array (
    'weeklyUploadImage',//周计划上传图片
    'setActivityItem',//设置活动项
    'setActivityItemDetail',//设置活动项详情
    'getActivityItemDetail',//获取活动项详情
    'saveWeekly',//保存周计划
    'deleteWeekly',//删除周计划
);
//判断是否是有效操作
$operation = in_array($op,$array ) ? $op : 'default';
if ($operation == 'default') {
    json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
}

appLoad()->model('weekly');
$model = new weekly();
//周计划上传图片
if($operation == 'WeeklyUploadImage'){
    $planUid = $_POST['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)
    $image = $_FILES['image'];//周计划的图片
    $class_id = $_POST['class_id'];//班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
    if(empty($planUid) || empty($image) || empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->WeeklyUploadImage($class_id,$planUid,$image);
    json_encodeBack($result);
}

//设置活动项
if($operation == 'setActivityItem'){
    $planUid = $_POST['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)
    $class_id = $_POST['class_id'];//班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
    $start = $_POST['start'];
    $end = $_POST['end'];
    $activityItem = $_POST['activityItem'];
//    $planUid = 'I3ejxooY-cq0F-Q7iE-Rphy-a6bNwmvPq2rj';
//    $class_id = -1;
//    $start = '2020-07-14';
//    $end = '2020-07-20';
//    $activityItem = array(
//        Array(
//            'ActiveTypeName' => '晨间活动',
//            'ActiveTypeId' => 'morning_activity',
//            'ActiveTypeIcon' => 'AM',
//        ),
//        Array(
//            'ActiveTypeName' => '教学活动',
//            'ActiveTypeId' => 'teach_activity',
//            'ActiveTypeIcon' => 'AM',
//        ),
//        Array(
//            'ActiveTypeName' => '测试活动',
//            'ActiveTypeId' => '',
//            'ActiveTypeIcon' => 'AM',
//        ),
//        Array(
//            'ActiveTypeName' => '户外活动',
//            'ActiveTypeId' => 'out_activity',
//            'ActiveTypeIcon' => 'PM',
//        ),
//        Array(
//            'ActiveTypeName' => '游戏活动',
//            'ActiveTypeId' => 'game_activity',
//            'ActiveTypeIcon' => 'PM',
//        ),
//    );
    if(empty($planUid) || empty($activityItem) || empty($class_id)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
//    if(empty($end)){
//        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,请选择结束时间！'));
//    }
//    if(strtotime($start) >= strtotime($end)){
//        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,结束时间必须大于开始时间！'));
//    }
    $result = $model->setActivityItem($class_id,$planUid,$activityItem,strtotime($start),strtotime($end));

    json_encodeBack($result);
}
//设置活动项详情
if($operation == 'setActivityItemDetail'){
    $planUid = $_POST['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)
    $class_id = $_POST['class_id'];//班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
    $ActiveTypeName = $_POST['ActiveTypeName'];//活动项名称
    $ActiveTypeIcon = $_POST['ActiveTypeIcon'];//活动项类型,AM:上午,PM:下午
    $ActivityId = $_POST['ActivityId'];//设置项的字符串编码.用来识别活动项
    $detailId = $_POST['detailId'];//详情的字符串编码.用来识别活动项
    $week = $_POST['week'];//星期几 1-5
    $start = $_POST['start'];
    $end = $_POST['end'];
    $activityItemDetail = $_POST['activityItemDetail'];//活动详情

//    $planUid = 'I3ejxooY-cq0F-Q7iE-Rphy-a6bNwmvPq2rj';
//    $class_id = -1;
//    $week = 2;
//    $detailId = '';
//    $ActiveTypeName = '上午活动';
//    $ActiveTypeIcon = 'PM';
//    $ActivityId = 'nn2D9s';
//    $start = '2020-07-14';
//    $end = '2020-07-20';
//    $activityItem = array('晨间活动1','晨间活动2');
    if(empty($planUid) || empty($activityItem) || empty($class_id)|| empty($ActiveTypeName) || empty($ActivityId) || empty($week)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->setActivityItemDetail($class_id,$planUid,$week,$detailId,$activityItem,$ActiveTypeName,$ActivityId,strtotime($start),strtotime($end));

    json_encodeBack($result);
}
//获取活动项详情
if($operation == 'getActivityItemDetail'){
    $planUid = $_POST['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)
    $class_id = $_POST['class_id'];//班级的id，如果是班级周计划，则class_id是班级的sid,如果是老师的周计划，则class_id是-1
    $week = $_POST['week'];//星期几 1-5
//    $planUid = 'I3ejxooY-cq0F-Q7iE-Rphy-a6bNwmvPq2rj';
//    $class_id = -1;
//    $week = 2;
    if(empty($planUid)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,请传planUid！'));
    }
    if(empty($week)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,请选择日期！'));
    }
    $result = $model->getActivityItemDetail($planUid,$class_id,$week);
    json_encodeBack($result);
}
//保存周计划
if($operation == 'saveWeekly'){
    $planUid = $_POST['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)
    $start = $_POST['start'];
    $end = $_POST['end'];
    if(empty($planUid)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,请传planUid！'));
    }
    if(empty($start)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,请选择开始时间！'));
    }
    if(empty($end)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,请选择结束时间！'));
    }
    if(strtotime($start) >= strtotime($end)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作,结束时间必须大于开始时间！'));
    }
    $result = $model->saveWeekly($planUid,strtotime($start),strtotime($end));
    json_encodeBack($result);
}
//删除周计划
if($operation == 'deleteWeekly'){
    $planUid = $_POST['planUid'];//周计划的字符串编码,用来识别周计划(作用类似id)
//    $planUid = 'S�HXBfuU-RR5t-yGrk-WF3p-8gH�mi5w9UxK';
    if(empty($planUid)){
        json_encodeBack(array('status'=>10002,'msg'=>'非法操作！'));
    }
    $result = $model->deleteWeekly($planUid);
    json_encodeBack($result);
}
