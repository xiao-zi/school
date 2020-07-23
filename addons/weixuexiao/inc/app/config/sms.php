<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/14
 * Time: 15:48
 */
/**
 * 短信通知配置
 */
return array(
    //教员请假申请提醒通知
    'teacher_leave_apply'=>array(
        'type'=>'jsqingjia',//教员请假
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //教员请假审核结果通知
    'teacher_leave_review'=>array(
        'type'=>'jsqjsh',//教员请假
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //学校通知
    'school_message'=>array(
        'type'=>'xxtongzhi',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //上课提醒 课程签到后上课提醒通知
    'remind_course'=>array(
        'type'=>'kcqdtx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //上课提醒 课程签到后上课提醒通知
    'confirm_teacher_course_sign'=>array(
        'type'=>'kcqdtx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //自由课程学生签到成功通知
    'notice_student_sign_success_1'=>array(
        'type'=>'sykstx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //固定课程学生签到成功通知
    'notice_student_sign_success_0'=>array(
        'type'=>'kcqdtx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //自由课程学生签到成功通知
    'notice_student_leave_success_1'=>array(
        'type'=>'sykstx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //固定课程学生签到成功通知
    'notice_student_leave_success_0'=>array(
        'type'=>'kcqdtx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //留言消息通知
    'message_notification'=>array(
        'type'=>'liuyan',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //学生签到需要确认 通知老师确认
    'student_sign_need_confirm'=>array(
        'type'=>'bjqshtz',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //学生请假 通知老师确认
    'student_leave_need_confirm'=>array(
        'type'=>'xsqingjia',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //学生课程签到通知老师确认
    'student_sign_course_need_confirm'=>array(
        'type'=>'sktxls',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //客户留言 通知老师查看
    'send_mail_notice_teacher'=>array(
        'type'=>'liuyan',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //学生发布班级圈通知老师审核
    'noticeTeacherReviewClassCircle'=>array(
        'type'=>'bjqshtz',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //学生发布班级圈通知老师审核
    'noticePublisherExamineSuccess'=>array(
        'type'=>'bjqshjg',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //通知阅读任务
    'noticeReadTask'=>array(
        'type'=>'xxtongzhi',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //老师处理学生的请假请求，通知学生结果
    'teacherExamineStudentLeaveNoticeStudent'=>array(
        'type'=>'xsqjsh',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //老师处理教员的请假请求，通知教员结果
    'teacherExamineTeacherLeaveNoticeTeacher'=>array(
        'type'=>'jsqjsh',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //教师任务操作通知
    'editStatusNoticeTeacher'=>array(
        'type'=>'xxtongzhi',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //老师发布一条任务给接收者通知
    'createTaskNoticeTeacher'=>array(
        'type'=>'xxtongzhi',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //老师回复校长信箱给学生发送通知
    'teacherReplyMailNoticeStudent'=>array(
        'type'=>'liuyan',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //班主任一键放学,通知学生家长
    'leaveSchoolNoticeStudent'=>array(
        'type'=>'liuyan',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //预约信箱通知负责预约老师
    'appointmentNoticeTeacher'=>array(
        'type'=>'kcyytx',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //报名审核结果通知
    'SignUpResultNoticeStudent'=>array(
        'type'=>'bjqshjg',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //老师确认学生签到(进校,离校)
    'confirmStudentSignNoticeStudent'=>array(
        'type'=>'bjqshjg',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
    //老师替学生签到,通知学生(进校,离校)
    'replaceStudentSignNoticeStudent'=>array(
        'type'=>'bjqshjg',//学校通知
        'name'=>'2112',//签名
        'code'=>'2112',//模板
    ),
);