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
 * @grade 年级的id int get  没有默认全部年级
 */
$school_id = $_GET['school_id'];
$page = intval($_GET['page'])?intval($_GET['page']):1;
$limit = 10;//默认每页展示的数据
/***学校信息***/
$school = pdo_fetch("SELECT id,thumb,logo,title FROM " . tablename($this->table_index) . " where id= '{$school_id}'");

if (empty($school)) {
    $data = array('status'=>10002,'msg'=>'没有找到该学校，请联系管理员！');
}else{
    //查看该学校的班级和年级信息，根据弱查询搜索该学校的课程信息

    $bj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'theclass', ':schoolid' => $school_id,':is_over'=>"2"));
    $nj = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY CONVERT(sname USING gbk) ASC", array(':type' => 'semester', ':schoolid' => $school_id,':is_over'=>"2"));

    $bj_str = '0,'.implode(',',array_column($bj,'sid'));

    $nj_str = '0,'.implode(',',array_column($nj,'sid'));
    /**
     * 根据使用post提交的年级信息，判断他请求的数据
     */
    if(!$_GET['grade']){
        //获取学校所有的班级和课程表的信息
        /**
         * 年级信息
         */
        $grades = pdo_fetchall("SELECT sid,sname FROM " . tablename($this->table_classify) . " where schoolid = :schoolid And type = :type and is_over!=:is_over ORDER BY sid,ssort ASC", array(':type' => 'semester', ':schoolid' => $school_id,':is_over'=>"2"));

        $list = pdo_fetchall("SELECT id,OldOrNew,thumb,name,end,is_hot,minge,cose,Ctype FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}' AND is_show = 1 and FIND_IN_SET(bj_id,'{$bj_str}') and FIND_IN_SET(xq_id,'{$nj_str}')  ORDER BY ssort DESC LIMIT $limitStr");

        foreach($list as $key => $value)
        {
            $list[$key]['course_type'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$value['Ctype']}'");
        }
        $data = array(
            'status'=>10001,
            'msg'=>'SUCCESS',
            'data'=>array(
                'school'=>$school,//学校信息
                'grade'=>$grades,//年级信息
                'course'=>count($listAll),//课程的总和
                'list'=>$list//课程信息
            )
        );
    }else{
        //使用ajax请求数据
        $grade = $_GET['grade'];
        $limitStr = ($page-1)*$limit.','.$limit;
        switch ($grade){
            case -1: $grade_str = "";break;
            default: $grade_str = " And xq_id=".$grade;
        }
        $list = pdo_fetchall("SELECT id,OldOrNew,thumb,name,end,is_hot,minge,cose,Ctype FROM " . tablename($this->table_tcourse) . " WHERE schoolid = '{$school_id}' AND is_show = 1 and FIND_IN_SET(bj_id,'{$bj_str}') and FIND_IN_SET(xq_id,'{$nj_str}') ORDER BY ssort DESC LIMIT $limitStr");
        if(empty($list)){
            $data = array('status'=>10003,'msg'=>'我也是有底线的！！！');
        }else{
            foreach($list as $key => $value)
            {
                $list[$key]['course_type'] = pdo_fetchcolumn("SELECT sname FROM " . tablename($this->table_classify) . " where sid = '{$value['Ctype']}'");
            }
            $data = array(
                'status'=>10001,
                'msg'=>'SUCCESS',
                'data'=>$list
            );
        }
    }
}
json_encodeBack($data);

