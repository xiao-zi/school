<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/8
 * Time: 13:25
 */
/**
 * 老师的班级圈
 */

appLoad()->model('circle');
$circle_model = new circle();
appLoad()->model('teacher');
$teacher_model = new teacher();
$user = $circle_model->get_all_user_info();

$app_user_id = $user['user']['id'];//app用户id
$user_id = $user['school']['id'];//绑定表的id
$teacher_id = $user['school']['teacher_id'];//老师的id
$school_id = $user['school']['school_id'];//学校的id

//当前学生的绑定信息
$user_info = pdo_fetch("SELECT id,tid,schoolid FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo,bjqstyle,Is_point,mallsetinfo,sh_teacherids FROM " . tablename('wx_school_index') . " where id = '{$school_id}' ");
//老师信息
$teacher = pdo_fetch("SELECT id,tname as name,mobile,thumb,point,status FROM " . tablename('wx_school_teachers') . " where  id= '{$teacher_id}'");
$teacher['thumb'] = empty($teacher['thumb'])? tomedia($school['tpic']):tomedia($teacher['thumb']);
if(empty($user_info) || empty($teacher) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//该老师上班的学校列表
$schoolList = $teacher_model->get_school($app_user_id);

//班级的id
$class_id = $_GET['class_id'];//查看那个班级的班级圈

//获取所有该老师负责的班级
$allClass = $teacher_model->getAllClass($teacher_id,$school_id);
//如果没有指定查看的班级,则在该老师负责的班级中随机抽一个班级
if(empty($class_id)){
    //随机在负责的班级中找中一个班级
    $class_id = $allClass[array_rand($allClass)]['sid'];
}

$classInfo = pdo_fetch("SELECT sname,parentid FROM " . tablename($this->table_classify) . " where sid = :sid ", array(':sid' =>$class_id));

//查看该班级的班主任是否是该老师
$headmaster = pdo_fetch("SELECT sid FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And tid = '{$teacher_id}' And type = 'theclass' And sid = '{$class_id}'");
//查看该年级主任是否是该老师
$gradeDirector = pdo_fetch("SELECT sid FROM " . tablename($this->table_classify) . " where schoolid = '{$school_id}' And tid = '{$teacher_id}'  And sid = '{$classInfo['parentid']}'");

//获取学生班级的班级圈设置
$class_result = $circle_model->get_class_info($class_id);
//学校设置
$setInfo = unserialize($school['mallsetinfo']);
//获取学校的阿里云配置
appLoad()->func('ali');
$aliyun = get_ali_config($school_id);
$appid = $aliyun['appid'];
$appkey = $aliyun['key'];

//校园模式班级圈的审核权限
$manger = false;
$condition = "";
if($school['bjqstyle'] == 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
    $condition .= " And ( bj_id1 = '{$class_id}' Or bj_id2 = '{$class_id}' Or bj_id3 = '{$class_id}' or is_all = '1' ) ";
}else{
    $powerTeacher = explode(',',$school['sh_teacherids']);
    if(in_array($teacher_id,$powerTeacher)){
        $manger = true;
    }
}

$data = array();
//班级圈列表
$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_bjq) . " where schoolid = '{$school_id}' And ((type = 0) Or ( type = 2 )) $condition ORDER BY createtime DESC LIMIT 0,10 ");

foreach ($list as $key => $row) {
    $data[$key]['id'] = $row['id'];
    //获取app用户信息
    $member = $circle_model->get_app_user_info($row['user_id']);
    $data[$key]['thumb'] = tomedia($member['thumb']);//app用户的头像
    $data[$key]['name'] = $row['shername'];//分享人的名称
    $data[$key]['content'] = EmoticonLibrary($row['content']);//分享的内容
    $data[$key]['msgtype'] = $row['msgtype'];//1：图文，2：语音，3：视频，4：分享，5：多媒体 7:班级通知
    $data[$key]['isopen'] = $row['isopen'];//1：未审核，0：已审核
    $data[$key]['linkdesc'] = $row['linkdesc'];//链接内容
    $data[$key]['link'] = $row['link'];//链接地址
    $data[$key]['audio'] = $row['audio'];//语音
    $data[$key]['is_private'] = $row['is_private'];//是否允许评论 N:允许,Y:不允许
    //是不是我发布的
    $data[$key]['is_mine'] = false;
    if($row['user_id'] == $app_user_id){
        $data[$key]['is_mine'] = true;
    }
    $data[$key]['power1'] = 0;//审核权限
    $data[$key]['power2'] = 0;//删除权限
    if($headmaster || $gradeDirector || $teacher['status'] == 2 || $manger){
        $data[$key]['power1'] = 1;//审核权限
    }
    if($headmaster || $gradeDirector || $teacher['status'] == 2 || $row['user_id'] == $app_user_id){
        $data[$key]['power2'] = 1;//删除权限
    }

    $data[$key]['publish_time'] = $row['createtime'];
    $data[$key]['time'] = get_time_str($row['createtime']);
    //判断自己是否点赞过
    $data[$key]['isLike'] = false;
    $isLike = pdo_fetch("SELECT id FROM " . tablename($this->table_dianzan) . " where schoolid = '{$school_id}' And sherid = '{$row['id']}' And user_id = '{$app_user_id}'");
    if($isLike){
        $data[$key]['isLike'] = true;
    }

    //是否开通了视频阿里云上传视频功能
    $data[$key]['video'] = $row['video'];
    $data[$key]['videoCoverURL'] = $row['videoimg'];
    if($aliyun['result'] && $row['ali_vod_id']){
        if(empty($row['video'])){
            $GetAliVideoUrl = GetAliVideoUrl($appid,$appkey,trim($row['ali_vod_id']));
            $video = $GetAliVideoUrl['PlayURL'];
            $data[$key]['video'] = $video;
            pdo_update($this->table_bjq,array('video'=>$video),array('id'=>$row['id']));
        }
        if(empty($row['videoimg'])){
            $GetAliVideoCover = GetAliVideoCover($appid,$appkey,trim($row['ali_vod_id']));
            $videoimg = $GetAliVideoCover['CoverURL'];
            $data[$key]['videoCoverURL'] = $videoimg;
            pdo_update($this->table_bjq,array('videoimg'=>$videoimg),array('id'=>$row['id']));
        }
    }
    //班级圈的图片
    $pic_arr = pdo_fetchall("SELECT picurl FROM " . tablename($this->table_media) . " WHERE schoolid = '{$school_id}' AND sherid = '{$row['sherid']}'  ORDER BY id ASC" );
    $data[$key]['pic_arr'] = array_column($pic_arr,'picurl');
    //班级圈的点赞
    $like = pdo_fetchall("SELECT id,zname,createtime,userid,user_id FROM " . tablename($this->table_dianzan) . " WHERE schoolid = '{$school_id}' AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC" );
    $data[$key]['like'] = $like;
    //班级圈的评论
    $comment = pdo_fetchall("SELECT shername,hftoname,content,user_id FROM " . tablename($this->table_bjq) . " WHERE schoolid = '{$school_id}' AND type=1 AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC " );
    foreach ($comment as $k=>$v){
        //是不是我发布的
        $comment[$k]['is_mine'] = false;
        if($v['user_id'] == $app_user_id){
            $comment[$k]['is_mine'] = true;
        }
        $comment[$k]['content'] = EmoticonLibrary($v['content']);//分享的内容
        if($headmaster || $gradeDirector || $teacher['status'] == 2 || $row['user_id'] == $app_user_id){
            $comment[$k]['power'] = 1;//删除权限
        }
    }
    $data[$key]['comment'] = $comment;
}
$result = array(
    'teacher_id'=>$teacher_id,//老师的id
    'name'=>$teacher['name'],//老师的名字
    'thumb'=>$teacher['thumb'],//老师头像
    'status'=>$teacher['status'],//老师身份 1:老师 2:校长
    'title'=>$school['title'],//学校的标题
    'school_id'=>$school_id,//学校的id
    'class_name'=>$classInfo['sname'],//班级的标题
    'class_id'=>$class_id,//班级的id
    'bjqtype'=>$school['bjqstyle'] == 'new'?1:2,//new ：班级圈 其他：校园动态
    'Is_point'=>$school['Is_point'],//学校是否使用积分
    'point'=>$teacher['point'],//老师的积分
    'isShow'=>$setInfo['isShow'],//是否展示老师积分和赚取积分
    'headmaster'=>$headmaster?1:0,//是不是班主任
    'class_result'=>$class_result,//班级圈设置
    'schoolList'=>$schoolList,//绑定该老师的学校
    'allClass'=>$allClass,//老师负责的班级列表
    'data'=>$data
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
