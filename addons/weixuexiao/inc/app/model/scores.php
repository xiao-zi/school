<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/19
 * Time: 10:16
 */
/**
 * 成绩查询模型
 */
include_once 'Basic.php';
class scores extends Basic{
    /**
     * 获取学校的展示列表
     * @return array
     */
    public function getSchoolList(){
        //学校信息
        $school = pdo_fetchall("SELECT id,title,logo FROM " . tablename('wx_school_index') . " where is_show = 1");
        if(empty($school)){
            return array('status'=>10003,'msg'=>'没有找到学校的信息！');
        }
        getDataImg($school,'logo');
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$school);
    }
    /**
     * 查询学生成绩
     * @param $name
     * @param $mobile
     * @param $school_id
     * @return array
     */
    public function queryStudentScores($name,$mobile,$school_id){
        //查询该学生是否存在
        $student = pdo_fetch("SELECT id FROM " . tablename('wx_school_students') . " where schoolid = '{$school_id}' And s_name = '{$name}' And mobile = '{$mobile}'");
        if(empty($student)){
            return array('status'=>10003,'msg'=>'没有找到该学生的信息！');
        }
        $result = $this->getStudentInfo($student['id']);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }
    /**
     * 根据学生的id获取该学生参加的考试信息
     * @param $student_id
     * @return array
     */
    public function getStudentInfo($student_id){
        //获取学生的考试的基本信息
        $student = pdo_fetch("SELECT id,xq_id,bj_id,s_name,icon,schoolid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        //学校信息
        $school = pdo_fetch("SELECT title,spic FROM " . tablename('wx_school_index') . " where id = '{$student['schoolid']}'");
        //年级信息
        $grade = pdo_fetch("SELECT sname,sid FROM " . tablename('wx_school_classify') . " where sid = '{$student['xq_id']}'");
        //班级信息
        $class = pdo_fetch("SELECT sname,sid FROM " . tablename('wx_school_classify') . " where sid = '{$student['bj_id']}'");
        //根据班级获取该班级参加的考试
        $mineExam = $this->get_exam($student['bj_id'],$student['schoolid']);
        //获取成绩单中该学生总共录入成绩的次数
        $count = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('wx_school_score') . " where schoolid = '{$student['schoolid']}'  And sid = '{$student_id}'");
        $result = array(
            'title'=>$school['title'],
            'student_id'=>$student_id,
            'name'=>$student['s_name'],
            'thumb'=>empty($student['icon'])?tomedia($school['spic']):tomedia($student['icon']),
            'count'=>$count,
            'grade'=>$grade,
            'class'=>$class,
            'exam'=>$mineExam,
        );
        return $result;
    }

    /**
     * 根据班级获取该班级参加的考试
     * @param $class_id
     * @param $school_id
     * @return array
     */
    function get_exam($class_id,$school_id){
        //获取学校所有的考生
        $allExam = pdo_fetchall("SELECT sid,sname,qh_bjlist,qhtype FROM " . tablename('wx_school_classify') . " where schoolid = '{$school_id}' And type = 'score' ORDER BY sid DESC");
        $result = array();
        foreach($allExam as $key => $value){
            if($value['qhtype'] == 1){//全校统考
                $result[] = array(
                    'id'=>$value['sid'],//考试的sid
                    'name'=>$value['sname'],//考试的标题
                    'type'=>$value['qhtype'],//考试的类型 1:全校统考, 2:指定班级考试
                );
            }else{//指定班级考试
                $classArr = explode(',', $value['qh_bjlist']);
                if (in_array($class_id,$classArr)) {
                    $result[] = array(
                        'id'=>$value['sid'],//考试的sid
                        'name'=>$value['sname'],//考试的标题
                        'type'=>$value['qhtype'],//考试的类型 1:全校统考, 2:指定班级考试
                    );
                }
            }
        }
        return $result;
    }

    /**
     * 获取学生各个科目的成绩及总成绩
     * @param $student_id
     * @param $exam_id
     * @param $class_id
     * @param $school_id
     * @return array
     */
    public function getStudentExamScores($student_id,$exam_id,$class_id,$school_id){
        //获取学生的考试的基本信息
        $student = pdo_fetch("SELECT id,xq_id,bj_id,schoolid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        $list = pdo_fetchall("SELECT km_id,my_score FROM " . tablename('wx_school_score') . " where  schoolid = '{$school_id}' And qh_id = '{$exam_id}' And sid = '{$student_id}' and bj_id = '{$class_id}' group by km_id");
        $data = array();
        $sum = 0;
        foreach ($list as $key=>$value)
        {
            $subject = pdo_fetch("SELECT sname,sid FROM " . tablename('wx_school_classify') . " where sid = '{$value['km_id']}'");
            $data[$key]['id'] = $value['km_id'];//科目的sid
            $data[$key]['subject'] = $subject['sname'];//科目的标题
            $data[$key]['score'] = $value['my_score'];//科目的成绩
            $count_before = pdo_fetchall(" select my_score  FROM " . tablename('wx_school_score') . "  where bj_id = '{$class_id}' and qh_id = '{$exam_id}' AND schoolid = '{$school_id}'  group by sid HAVING my_score>'{$value['my_score']}'");
            //班级排名
            $class_ranking = count($count_before)+1;
            $data[$key]['class_ranking'] = $class_ranking;
            $sum += floatval($value['my_score']);
        }
        //获取班级其他同学总成绩大于该学生的人
        $count_before_class = pdo_fetchall(" select SUM(my_score)  FROM " . tablename('wx_school_score') . "  where  bj_id = '{$student['bj_id']}' and qh_id = '{$exam_id}' AND schoolid = '{$student['schoolid']}'  group by sid HAVING SUM(my_score)>'{$sum}'");
        //班级排名
        $class_ranking = count($count_before_class)+1;
        //年级排名
        $count_before_grade = pdo_fetchall(" select SUM(my_score)  FROM " . tablename('wx_school_score') . "  where  xq_id = '{$student['xq_id']}' and qh_id = '{$exam_id}'   AND schoolid = '{$student['schoolid']}' group by sid  HAVING SUM(my_score)>'{$sum}'" );
        $grade_ranking = count($count_before_grade)+1;
        $subject = pdo_fetchcolumn("SELECT sname as name FROM " . tablename('wx_school_classify') . " where sid = '{$exam_id}'");
        $result = array('subject'=>$subject,'sum'=>$sum,'class_ranking'=>$class_ranking,'grade_ranking'=>$grade_ranking,'data'=>$data);
        return $result;
    }

    /**
     * 获取学生某一科在所有考试中信息
     * @param $student_id
     * @param $subject_id
     * @param $class_id
     * @param $school_id
     * @return array
     */
    public function getStudentSubjectScores($student_id,$subject_id,$class_id,$school_id){
        //获取学生的考试的基本信息
        $student = pdo_fetch("SELECT id,xq_id,bj_id,schoolid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        $list = pdo_fetchall("SELECT id,qh_id,my_score FROM " . tablename('wx_school_score') . " where  schoolid = '{$school_id}' And km_id = '{$subject_id}' And sid = '{$student_id}' and bj_id = '{$class_id}' group by qh_id");
        $data = array();
        foreach ($list as $key=>$value)
        {
            $subject = pdo_fetch("SELECT sname,sid FROM " . tablename('wx_school_classify') . " where sid = '{$value['qh_id']}'");
            $data[$key]['id'] = $value['qh_id'];//考试sid
            $data[$key]['subject'] = $subject['sname'];//考试的标题
            $data[$key]['score'] = $value['my_score'];//科目的成绩
            //班级排名
            $count_before = pdo_fetchall(" select my_score  FROM " . tablename('wx_school_score') . "  where bj_id = '{$class_id}' and km_id = '{$subject_id}' AND schoolid = '{$school_id}'  group by sid HAVING my_score>'{$value['my_score']}'");
            $class_ranking = count($count_before)+1;
            $data[$key]['class_ranking'] = $class_ranking;
            //年级排名
            $count_before_grade = pdo_fetchall(" select my_score  FROM " . tablename('wx_school_score') . "  where xq_id = '{$student['xq_id']}' and km_id = '{$subject_id}' AND schoolid = '{$school_id}'  group by sid HAVING my_score>'{$value['my_score']}'");
            $grade_ranking = count($count_before_grade)+1;
            $data[$key]['grade_ranking'] = $grade_ranking;
        }
        $subject = pdo_fetch("SELECT sid as id,sname as name FROM " . tablename('wx_school_classify') . " where sid = '{$subject_id}'");
        $result = array('subject'=>$subject,'data'=>$data);
        return $result;
    }
    

    /**
     * 获取学生所有考试成绩总览
     * @param $student_id 学生的id
     * @return array
     */
    public function getStudentScoresOverview($student_id){
        //获取学生的考试的基本信息
        $student = pdo_fetch("SELECT id,bj_id,schoolid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        //根据班级获取该班级参加的考试
        $mineExam = $this->get_exam($student['bj_id'],$student['schoolid']);

        foreach($mineExam as $key =>$value){
            $mineExam[$key]['data'] = $this->getStudentExamScores($student_id,$value['id'],$student['bj_id'],$student['schoolid']);
        }
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$mineExam);
    }

    /**
     * 获取学生的某一次的考试成绩总览
     * @param $student_id 学生的id
     * @param $exam_id 考试的id
     * @return array
     */
    public function getStudentExamScoresOverview($student_id,$exam_id){
        //获取学生的考试的基本信息
        $student = pdo_fetch("SELECT id,xq_id,bj_id,schoolid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        $result = $this->getStudentExamScores($student_id,$exam_id,$student['bj_id'],$student['schoolid']);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }

    /**
     * 获取学生所有考试成绩总览
     * @param $student_id
     * @param $subject_id
     * @return array
     */
    public function getStudentSubjectScoresOverview($student_id,$subject_id){
        //获取学生的考试的基本信息
        $student = pdo_fetch("SELECT id,xq_id,bj_id,schoolid FROM " . tablename('wx_school_students') . " where id = '{$student_id}'");
        $result = $this->getStudentSubjectScores($student_id,$subject_id,$student['bj_id'],$student['schoolid']);
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$result);
    }
}