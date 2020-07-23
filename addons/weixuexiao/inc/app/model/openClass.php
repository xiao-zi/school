<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/8
 * Time: 17:44
 */
/**
 * 公开课模型
 */
include_once 'Basic.php';
class openClass extends Basic{
    /**
     * 给公开课添加评语
     * @param $content
     * @return array
     * @throws ReflectionException
     */
    public function createComment($content){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $commentArr = array_filter(explode('|',$content));
        foreach ($commentArr as $key=>$value){
            $insertData = array(
                'weid'=>1,
                'schoolid'=>$school_id,
                'title'=>$value,
                'ssort'=>$key+1,
            );
            pdo_insert('wx_school_gkkpjbz',$insertData);
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 修改公开课的评语
     * @param $id
     * @param $filed 字段
     * @param $content 内容
     * @return array
     * @throws ReflectionException
     */
    public function updateComment($id,$filed,$content){
        $this->get_user_info('teacher');//检查是否是老师,只有老师才能修改
        $result = pdo_update('wx_school_gkkpjbz',array($filed=>$content),array('id'=>$id));
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10003,'msg'=>'修改失败!!!');
        }
    }

    /**
     * 删除公开课评语
     * @param $id
     * @return array
     * @throws ReflectionException
     */
    public function deleteComment($id){
        $this->get_user_info('teacher');//检查是否是老师,只有老师才能修改
        $result = pdo_delete('wx_school_gkkpjbz',array('id'=>$id));
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10003,'msg'=>'删除失败!!!');
        }
    }

    /**
     * 创建公开课
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function createClass($data){
        $user = $this->get_user_info('teacher');
        $school_id = $user['school_id'];//学校的id
        $teacher_id = $user['teacher_id'];//老师的id
        $start = strtotime($data['date'].$data['start']);
        $end = strtotime($data['date'].$data['end']);
        if($start >= $end){
            return array('status'=>10003,'msg'=>'结束时间必须大于开始时间!');
        }
        $insertData = array(
            'weid' => 1,
            'schoolid' => $school_id,
            'name' => $data['title'],//标题
            'tid' => intval($data['tid']),//老师
            'xq_id'=>intval($data['grade']),//年级
            'bj_id'=>intval($data['class']),//班级
            'km_id'=>intval($data['course']),//科目
            'addr'=>$data['address'],//地址
            'starttime' => $start,//开始时间
            'endtime' => $end,//结束时间
            'is_pj' => $data['is_comment'],
            'bzid' => $data['comment'],
            'dagang' => $data['outline'],//大纲
            'createtime'=>time(),
            'createtid'=>$teacher_id,//创建老师的id
        );
        $result = pdo_insert('wx_school_gongkaike', $insertData);
        if($result){
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            return array('status'=>10004,'msg'=>'创建失败!!!');
        }
    }

    /**
     * 用户评价公开课
     * @param $data
     * @return array
     * @throws ReflectionException
     */
    public function addComment($data){
        $user = $this->get_user_info();
        $school_id = $user['school_id'];
        $user_id = $user['id'];
        if($user['type'] == 'teacher'){
            $torjz = 2;//来自老师
        }else{
            $torjz = 1;//来自家长
        }
        $class = pdo_fetch("SELECT id,name,tid,bzid FROM " . tablename('wx_school_gongkaike') . " where id ='{$data['id']}'");
        pdo_fetchall('set AUTOCOMMIT=0');//关闭自动提交，自此句执行以后，每个SQL语句或者语句块所在的事务都需要显示"commit"才能提交事务
        pdo_fetchall('START TRANSACTION');//启动一个新事务
        $insertData = array(  //存储文字评价 条件  老师id  评语 时间
            'weid'=> 1,
            'schoolid'=> $school_id,
            'gkkid'=> $data['id'],
            'tid'=> $class['tid'],
            'userid'=> $user_id,
            'content'=> trim($data['content']),
            'torjz' => $torjz,
            'type'=> 1,
            'createtime'=> time()
        );
        $result1 = pdo_insert('wx_school_gkkpj', $insertData);
        $result2 = true;
        if(!empty($data['parameter'])){
            $parameter = json_decode($data['parameter'],true);//
            foreach ($parameter as $key=>$value){
                $insertData1 = array(  //存储表现登记评价 条件  老师id  等级id及等级 时间
                    'weid'=> 1,
                    'schoolid'=> $school_id,
                    'gkkid'=> $data['id'],
                    'tid'=> $class['tid'],
                    'userid'=> $user_id,
                    'iconid'=> $key,
                    'iconlevel'=> $value,
                    'torjz' =>$torjz,
                    'type'=> 2,
                    'createtime'=> time()
                );
                $result2 = pdo_insert('wx_school_gkkpj', $insertData1);
                if(!$result2){
                    break;
                }
            }
        }
        if($result1 && $result2){
            pdo_fetchall('COMMIT');
            return array('status'=>10001,'msg'=>'SUCCESS');
        }else{
            pdo_fetchall('ROLLBACK');
            return array('status'=>10004,'msg'=>'创建失败!!!');
        }
    }
}