<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/29
 * Time: 16:34
 */
/**
 * 给出学校和学校年级信息
 * @schoolid 学校的id int get 没有返回错误状态码1002
 * @page 页数  int get 没有默认第一页
 * @grade 年级的id int post  没有默认全部年级
 */
$schoolid = $_GET['schoolid'];
$page = intval($_GET['page'])?intval($_GET['page']):1;
$limit = 10;//默认每页展示的数据
/***学校信息***/
$school = pdo_fetch("SELECT id,thumb,logo,title FROM " . tablename($this->table_index) . " where id= :id", array( ':id' => $schoolid));

if (empty($school)) {
    $data = array('status'=>'10101','msg'=>getAppConfig('status',10101));
}else{
    //查看该学校的班级和年级信息，根据弱查询搜索该学校的课程信息
    $bj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'theclass', ':schoolid' => $schoolid,':is_over'=>"2"));
    $nj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'semester', ':schoolid' => $schoolid,':is_over'=>"2"));
    $bj_str_temp = '0,';
    foreach($bj as $key_b=>$value_b){
        $bj_str_temp .=$value_b['sid'].",";
    }
    $bj_str = trim($bj_str_temp,",");
    $nj_str_temp = '0,';
    foreach($nj as $key_n=>$value_n){
        $nj_str_temp .=$value_n['sid'].",";
    }
    $nj_str = trim($nj_str_temp,",");
    /**
     * 根据使用post提交的年级信息，判断他请求的数据
     */
    if(!$_POST['grade']){
        //获取学校所有的班级和课程表的信息
        /**
         * 年级信息
         */
        $grades = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY sid,ssort ASC", array(':type' => 'semester', ':schoolid' => $schoolid,':is_over'=>"2"));

        $listAll = pdo_fetchall("SELECT id,OldOrNew,thumb,name,end,is_hot,minge,cose,Ctype FROM " . tablename($this->table_tcourse) . " WHERE schoolid =:schoolid AND is_show = :is_show and FIND_IN_SET(bj_id,:bj_str) and FIND_IN_SET(xq_id,:nj_str)  ORDER BY ssort DESC", array(':schoolid' => $schoolid, ':is_show' => 1,':bj_str'=>$bj_str,':nj_str'=>$nj_str));

        $list = array_slice($listAll,0,$limit);//从所有的课程中截取前10个
        foreach($list as $key => $value)
        {
            $course_type = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid=:sid", array(':sid' => $value['Ctype']));
            $list[$key]['course_type'] =$course_type['sname'];
        }
        $data = array(
            'status'=>'1001',
            'msg'=>getAppConfig('status',10001),
            'data'=>array(
                'school'=>$school,//学校信息
                'grade'=>$grades,//年级信息
                'course'=>count($listAll),//课程的总和
                'list'=>$list//课程信息
            )
        );
    }else{
        //使用ajax请求数据
        $grade = $_POST['grade'];
        $limitStr = ($page-1)*$limit.','.$page*$limit;
        switch ($grade){
            case -1: $grade_str = "";break;
            default: $grade_str = " And xq_id=".$grade;
        }
        $list = pdo_fetchall("SELECT id,OldOrNew,thumb,name,end,is_hot,minge,cose,Ctype FROM " . tablename($this->table_tcourse) . " WHERE schoolid =:schoolid AND is_show = :is_show $grade_str and FIND_IN_SET(bj_id,:bj_str) and FIND_IN_SET(xq_id,:nj_str)  ORDER BY ssort DESC LIMIT $limitStr", array(':schoolid' => $schoolid, ':is_show' => 1,':bj_str'=>$bj_str,':nj_str'=>$nj_str));
        if(empty($list)){
            $data = array('status'=>'1003','msg'=>'已经没有信息了！！！');
        }else{
            foreach($list as $key => $value)
            {
                $course_type = pdo_fetch("SELECT sname FROM " . tablename($this->table_classify) . " where sid=:sid", array(':sid' => $value['Ctype']));
                $list[$key]['course_type'] =$course_type['sname'];
            }
            $data = array(
                'status'=>'1001',
                'msg'=>getAppConfig('status',10001),
                'data'=>$list
            );
        }
    }
}
json_encodeBack($data);

