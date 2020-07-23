<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/18
 * Time: 10:53
 */
include_once 'Basic.php';
class point extends Basic {
    /**
     * 老师的积分奖励（积分规则）
     * @param $school_id
     * @param $user_id
     * @param $type
     * @return int
     */
    public static function pointsBonus($school_id,$user_id,$type){
        $point = 0;
        //查看该积分活动是否启用
        $act = pdo_fetch("SELECT * FROM ".tablename('wx_school_points')." WHERE schoolid ='{$school_id}' And op = '{$type}' And type='1' and is_on = 1 ");
        if(!empty($act)){
            $teacher = pdo_fetch("SELECT * FROM ".tablename('wx_school_user')." WHERE id ='{$user_id}'");
            $tid = $teacher['tid'];
            $today = strtotime(date("Y-m-d",time()));
            $tomorrow = $today + 3600*24;
            //检查今天是否做过此类积分奖励活动
            $check = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('wx_school_pointsrecord')." WHERE tid = '{$tid}' And schoolid ='{$school_id}' And type='1' And pid = '{$act['id']}' And createtime <= '{$tomorrow}' And createtime >= '{$today}'");
            if($check < $act['dailytime']){
                if(!empty($tid)) {
                    $old = pdo_fetch("SELECT point FROM ".tablename('wx_school_teachers')." WHERE id = '{$tid}'  ");
                    $old_point = intval($old['point']);//之前的积分
                    $add_point = intval($act['adpoint']);//需要添加的积分
                    $new_point = $old_point + $add_point;//添加之后的积分
                    pdo_update('wx_school_teachers',array('point' => $new_point ), array('id' => $tid));
                    $pointtemp = array(
                        'weid' => 1,
                        'schoolid' => $school_id,
                        'tid' => $tid,
                        'pid' => $act['id'],
                        'type' => 1,
                        'createtime' => time()
                    );
                    pdo_insert('wx_school_pointsrecord',$pointtemp);
                    $point = $add_point;
                }
            }
        }
        return $point;
    }

    /**
     * 老师的积分奖励（积分任务）
     * @param $school_id
     * @param $user_id
     * @param $type
     * @return int
     */
    public static function pointsTask($school_id,$user_id,$type){
        //查看该积分活动是否启用
        $act = pdo_fetch("SELECT * FROM ".tablename('wx_school_points')." WHERE schoolid ='{$school_id}' And op = '{$type}' And type='2' and is_on = 1 ");
        $point = 0;
        if(!empty($act)){
            $teacher = pdo_fetch("SELECT * FROM ".tablename('wx_school_user')." WHERE id ='{$user_id}'");
            $tid = $teacher['tid'];
            $check = pdo_fetch("SELECT mcount,id FROM ".tablename('wx_school_pointsrecord')." WHERE tid = '{$tid}' And schoolid ='{$school_id}' And type='2' And pid = '{$act['id']}' ");
            if(!empty($tid)){
                if(!empty($check)){
                    $old_count = intval($check['mcount']);
                    $max_count = intval($act['dailytime']);
                    //没有完成此积分任务
                    if($old_count < $max_count)
                    {
                        $temp_count = $old_count + 1 ;
                        //积分任务到达完成
                        if($temp_count == $max_count){
                            $old = pdo_fetch("SELECT point FROM ".tablename('wx_school_teachers')." WHERE schoolid ='{$school_id}' And id = '{$tid}'  ");
                            $old_point = intval($old['point']);//之前的积分
                            $add_point = intval($act['adpoint']);//需要添加的积分
                            $new_point = $old_point + $add_point;//添加之后的积分
                            pdo_update('wx_school_teachers',array('point' => $new_point ), array('id' => $tid));
                            pdo_update('wx_school_pointsrecord',array('mcount' => $temp_count, 'createtime' => time() ), array('id' => $check['id']));
                            $point = $add_point;
                        }else{
                            pdo_update('wx_school_pointsrecord',array('mcount' => $temp_count, 'createtime' => time()), array('id' => $check['id']));
                        }
                    }
                }else{
                    $pointtemp = array(
                        'weid' => 1,
                        'schoolid' => $school_id,
                        'tid' => $tid,
                        'pid' => $act['id'],
                        'type' => 2,
                        'mcount' => 1,
                        'createtime' => time()
                    );
                    pdo_insert('wx_school_pointsrecord',$pointtemp);
                    //积分任务只需执行一次即可活动积分奖励
                    if($act['dailytime'] == 1 ){
                        $old = pdo_fetch("SELECT point FROM ".tablename('wx_school_teachers')." WHERE schoolid ='{$school_id}' And id = '{$tid}'  ");
                        $old_point = intval($old['point']);//之前的积分
                        $add_point = intval($act['adpoint']);//需要添加的积分
                        $new_point = $old_point + $add_point;//添加之后的积分
                        pdo_update('wx_school_teachers',array('point' => $new_point ), array('id' => $tid));
                        $point = $add_point;
                    }
                }
            }
        }
        return $point;
    }
}