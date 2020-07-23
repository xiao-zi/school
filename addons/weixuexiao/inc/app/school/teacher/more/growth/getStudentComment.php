<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/17
 * Time: 15:47
 */
/**
 * 查看学生的成长点评
 * type :1 学校 type:2 家里
 */
$id = $_GET['id'];//成长手册的id
$student_id = $_GET['student_id'];//学生的id
$type = $_GET['type'] == 'school' ? 'school':'family';//默认是学校的

appLoad()->model('growth');
$model = new growth();
$user = $model->get_user_info('teacher');
$user_id = $user['id'];//绑定表的id
$teacher_id = $user['teacher_id'];//老师的id
$school_id = $user['school_id'];//学校的id
//学校设置学生的默认图片
$thumb = pdo_fetchcolumn("select spic from " .tablename('wx_school_index') ." where id = '{$school_id}' ");
$teacherThumb = pdo_fetchcolumn("select tpic from " .tablename('wx_school_index') ." where id = '{$school_id}' ");
if(empty($id) || empty($student_id)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}
$data = pdo_fetch("select * from " .tablename('wx_school_shouce')." where id = '{$id}'");
if(empty($data)){
    json_encodeBack(array('status'=>10002,'msg'=>'非法请求'));
}

if($type == 'school'){
    $comment_id = $data['setid'];//评论规则的id
    $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_scicon) . " where schoolid = '{$school_id}' And setid = '{$comment_id}' And type = 1  ORDER BY ssort ASC");
    $iconArr = array();
    foreach ($list as $key=>$value){
        $iconArr[$key]['id'] = $value['id'];
        $iconArr[$key]['title'] = $value['title'];
        $iconArr[$key]['icon'] = array(
            array(
                'level'=>1,
                'title'=>$value['icon1title'],
                'icon'=>tomedia($value['icon1'])
            ),
            array(
                'level'=>2,
                'title'=>$value['icon2title'],
                'icon'=>tomedia($value['icon2'])
            ),
            array(
                'level'=>3,
                'title'=>$value['icon3title'],
                'icon'=>tomedia($value['icon3'])
            ),
            array(
                'level'=>4,
                'title'=>$value['icon4title'],
                'icon'=>tomedia($value['icon4'])
            ),
            array(
                'level'=>5,
                'title'=>$value['icon5title'],
                'icon'=>tomedia($value['icon5'])
            ),
        );
    }
    $student = pdo_fetch("select id,s_name as name,icon as thumb from " .tablename('wx_school_students')." where id = '{$student_id}'");
    $student['thumb'] = empty($student['thumb']) ? tomedia($thumb):tomedia($student['thumb']);
    //判断当前有没有老师参与到点评环节
    $isHaveWord = pdo_fetch("SELECT id FROM " . tablename('wx_school_scforxs') . " where  sid = '{$student_id}' And scid = '{$id}' And tid != 0  And type = 1 And fromto = 1");
    if(empty($isHaveWord)){
        json_encodeBack(array('status'=>10003,'msg'=>'目前没有老师对该学生进行点评','data'=>$student));
    }

    $comment = pdo_fetchall("SELECT tid,tword FROM " . tablename('wx_school_scforxs') . " where  sid = '{$student_id}' And scid = '{$id}' And type = 1 And fromto = 1");
    $allTeacherIdArr = array_column($comment,'tid');
    $hasComment = false;
    if(in_array($teacher_id,$allTeacherIdArr)){
        $hasComment = true;
    }
    foreach ($comment as $key=>$value){
        $teacher = pdo_fetch("select id,tname as name,thumb from " .tablename('wx_school_teachers')." where id = '{$value['tid']}'");
        $comment[$key]['teacher'] = $teacher['name'];
        $comment[$key]['thumb'] = empty($comment[$key]['teacher']['thumb']) ? tomedia($teacherThumb):tomedia($comment[$key]['teacher']['thumb']);
        //获取老师对学生的评价等级
        $iconComment = pdo_fetchall("SELECT iconsetid as iconId,iconlevel as level FROM " . tablename ('wx_school_scforxs') . " where schoolid = '{$school_id}' And scid = '{$id}' And sid = '{$student['id']}' And tid = '{$value['tid']}' And type = 2 and fromto = 1 ");
        $teacherIconArr = $iconArr;
        if(!empty($iconComment)){
            foreach ($iconComment as $k=>$val){
                foreach ($teacherIconArr as $ik=>$iv){
                    if($val['iconId'] == $iv['id']){
                        foreach ($iv['icon'] as $ik1 =>$iv1){
                            if($val['level'] == $iv1['level']){
                                $teacherIconArr[$ik]['icon'][$ik1]['check'] = true;
                            }
                        }
                    }
                }
            }
        }
        $comment[$key]['show'] = $teacherIconArr;
    }
    $student['comment'] = $comment;
    $result = array(
        'hasComment'=>$hasComment,//判断该老师有没有对该学生进行过点评
        'data'=>$student,//其中包括,学生信息,点评老师和点评信息
    );
}else{
    $comment_id = $data['setid'];//评论规则的id
    //获取家长的评论规则
    $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_scicon) . " where schoolid = '{$school_id}' And setid = '{$comment_id}' And type = 2  ORDER BY ssort ASC");
    $iconArr = array();
    foreach ($list as $key=>$value){
        $iconArr[$key]['id'] = $value['id'];
        $iconArr[$key]['title'] = $value['title'];
        $iconArr[$key]['icon'] = array(
            array(
                'level'=>1,
                'title'=>$value['icon1title'],
                'icon'=>tomedia($value['icon1'])
            ),
            array(
                'level'=>2,
                'title'=>$value['icon2title'],
                'icon'=>tomedia($value['icon2'])
            ),
            array(
                'level'=>3,
                'title'=>$value['icon3title'],
                'icon'=>tomedia($value['icon3'])
            ),
            array(
                'level'=>4,
                'title'=>$value['icon4title'],
                'icon'=>tomedia($value['icon4'])
            ),
            array(
                'level'=>5,
                'title'=>$value['icon5title'],
                'icon'=>tomedia($value['icon5'])
            ),
        );
    }
    $student = pdo_fetch("select id,s_name as name,icon as thumb from " .tablename('wx_school_students')." where id = '{$student_id}'");
    $student['thumb'] = empty($student['thumb']) ? tomedia($thumb):tomedia($student['thumb']);
    //判断当前有没有家人参与到点评环节
    $isHaveWord = pdo_fetch("SELECT id FROM " . tablename('wx_school_scforxs') . " where  sid = '{$student_id}' And scid = '{$id}' And userid != 0  And type = 1 And fromto = 2");
    if(empty($isHaveWord)){
        json_encodeBack(array('status'=>10004,'msg'=>'目前没有家人对该学生进行点评','data'=>$student));
    }
    $comment = pdo_fetchall("SELECT userid,jzword FROM " . tablename('wx_school_scforxs') . " where  sid = '{$student_id}' And scid = '{$id}' And type = 1 And fromto = 2");
    foreach ($comment as $key=>$value){
        $family = pdo_fetch("select id,pard,userid,realname from " .tablename('wx_school_user')." where id = '{$value['userid']}'");
        $comment[$key]['name'] = $family['realname'];
        $comment[$key]['relation'] = getRelationship($family['pard'],true);
        //app用户信息
        $userInfo = pdo_fetch("select id,thumb from ".tablename('app_school_user')." where id = '{$family['userid']}'");
        $comment[$key]['thumb'] = empty($userInfo['thumb']) ? tomedia($teacherThumb):tomedia($userInfo['thumb']);
        //获取家人对学生的评价等级
        $iconComment = pdo_fetchall("SELECT iconsetid as iconId,iconlevel as level FROM " . tablename ('wx_school_scforxs') . " where schoolid = '{$school_id}' And scid = '{$id}' And sid = '{$student['id']}' And userid = '{$value['userid']}' And type = 2 and fromto = 2 ");
        $teacherIconArr = $iconArr;
        if(!empty($iconComment)){
            foreach ($iconComment as $k=>$val){
                foreach ($teacherIconArr as $ik=>$iv){
                    if($val['iconId'] == $iv['id']){
                        foreach ($iv['icon'] as $ik1 =>$iv1){
                            if($val['level'] == $iv1['level']){
                                $teacherIconArr[$ik]['icon'][$ik1]['check'] = true;
                            }
                        }
                    }
                }
            }
        }
        $comment[$key]['show'] = $teacherIconArr;
    }
    $student['comment'] = $comment;
    $result = array(
        'data'=>$student,//其中包括,学生信息,点评老师和点评信息
    );
}
json_encodeBack(array('status'=>10001,'msg'=>'SUCCESS','data'=>$result));