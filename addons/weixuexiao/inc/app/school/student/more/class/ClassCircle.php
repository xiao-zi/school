<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/8
 * Time: 13:25
 */
/**
 * 学生的班级圈
 */

appLoad()->model('circle');
$circle_model = new circle();
$user = $circle_model->get_user_info('student');
$user_id = $user['id'];//绑定表的信息
$app_user = $circle_model->Resolve_user_information()['data'];

$app_user_id = $app_user['id'];//app的用户id

//当前学生的绑定信息
$user_info = pdo_fetch("SELECT id,sid,schoolid,pard FROM " . tablename($this->table_user) . " where id = '{$user_id}' ");
//学生信息
$student = pdo_fetch("SELECT id,s_name,bj_id,icon,xq_id,points FROM " . tablename('wx_school_students') . " where  id= '{$user['student_id']}'");
//学校信息
$school = pdo_fetch("SELECT title,spic,tpic,logo,bjqstyle,Is_point FROM " . tablename('wx_school_index') . " where id = '{$user['school_id']}' ");
if(empty($user_info) || empty($student) || empty($school)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求！'));
}
//身份
$relation = getRelationship($user_info['pard']);
//获取学生班级的班级圈设置
$class_result = $circle_model->get_class_info($student['bj_id']);

$school_id = $_GET['school_id'];//这个学校的id用来查看用户是否是查看指定学校的班级圈

//查看app用户绑定的所有的学生
$binding_user = $circle_model->get_all_student($app_user['id'],$school_id);

//获取学校的阿里云配置
appLoad()->func('ali');
$aliyun = get_ali_config($user['school_id']);
$appid = $aliyun['appid'];
$appkey = $aliyun['key'];

$condition = "";
if($school['bjqstyle'] == 'new'){//这里是班级圈展示的是校园所有的班级圈还是指定班级的班级圈
    $condition .= " And ( bj_id1 = '{$student['bj_id']}' Or bj_id2 = '{$student['bj_id']}' Or bj_id3 = '{$student['bj_id']}' or is_all = '1' ) ";
}

$data = array();
//班级圈列表
$list = pdo_fetchall("SELECT * FROM " . tablename($this->table_bjq) . " where schoolid = '{$user['school_id']}' And type = 0 And (isopen = 0 Or user_id = '{$app_user_id}') $condition ORDER BY createtime DESC LIMIT 0,10 ");

foreach ($list as $key => $row) {
    $data[$key]['id'] = $row['id'];
    //获取app用户信息
    $member = $circle_model->get_app_user_info($row['user_id']);
    $data[$key]['thumb'] = tomedia($member['thumb']);//app用户的头像
    $data[$key]['name'] = $row['shername'];//分享人的名称
    $data[$key]['content'] = EmoticonLibrary($row['content']);//分享的内容
    $data[$key]['msgtype'] = $row['msgtype'];//1：图文，2：语音，3：视频，4：分享，5：多媒体
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
    $data[$key]['publish_time'] = $row['createtime'];
    $data[$key]['time'] = get_time_str($row['createtime']);
    //判断自己是否点赞过
    $data[$key]['isLike'] = false;
    $isLike = pdo_fetch("SELECT id FROM " . tablename($this->table_dianzan) . " where schoolid = '{$user['school_id']}' And sherid = '{$row['id']}' And user_id = '{$app_user_id}'");
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
    $pic_arr = pdo_fetchall("SELECT picurl FROM " . tablename($this->table_media) . " WHERE schoolid = '{$user['school_id']}' AND sherid = '{$row['sherid']}'  ORDER BY id ASC" );
    $data[$key]['pic_arr'] = array_column($pic_arr,'picurl');
    //班级圈的点赞
    $like = pdo_fetchall("SELECT id,zname,createtime,userid,user_id FROM " . tablename($this->table_dianzan) . " WHERE schoolid = '{$user['school_id']}' AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC" );
    $data[$key]['like'] = $like;
    //班级圈的评论
    $comment = pdo_fetchall("SELECT shername,hftoname,content,user_id FROM " . tablename($this->table_bjq) . " WHERE schoolid = '{$user['school_id']}' AND type=1 AND sherid = '{$row['sherid']}'  ORDER BY createtime ASC " );
    foreach ($comment as $k=>$v){
        //是不是我发布的
        $comment[$k]['is_mine'] = false;
        if($v['user_id'] == $app_user_id){
            $comment[$k]['is_mine'] = true;
        }
        $comment[$k]['content'] = EmoticonLibrary($v['content']);//分享的内容
    }
    $data[$key]['comment'] = $comment;
}
$result = array(
    'name'=>$student['s_name'],//学生的名字
    'thumb'=>empty($student['icon'])?tomedia($school['spic']):tomedia($student['icon']),//学生头像
    'relation'=>$relation,//身份角色
    'bjqtype'=>$school['bjqstyle'] == 'new'?1:2,//new ：班级圈 其他：校园动态
    'Is_point'=>$school['Is_point'],//学校是否使用积分
    'points'=>$student['points'],//学生的积分
    'class_result'=>$class_result,//学生的班级圈设置
    'binding_user'=>$binding_user,//绑定学生的列表
    'data'=>$data
);
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));
