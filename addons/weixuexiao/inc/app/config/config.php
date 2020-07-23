<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/9
 * Time: 10:09
 */
/**
 * 作业的设置
 */
return array(
    'review_type'=>true,//老师的批阅,true:老师的批阅是针对于学生回答的每个问答问题进行批阅,false:老师的批阅是针对于学生对这个作业整个的批阅
    'student_appraise_course_type'=>true,//学生对课程的评价，评价内容是否包含后台设置的老师评价内容。true:是，false:否
    'leaving_message_day'=>0,//用户多久可以留言一次 0:不限制,其他代表天数,1:一天
    'groupReadTask'=>'http://school.test/app/index.php?i=1&c=entry&do=AppNoticeAjax&m=weixuexiao&op=groupReadTask',//群发阅读任务的异步url
);