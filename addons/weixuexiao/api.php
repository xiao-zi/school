<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/14
 * Time: 9:29
 */

/**
 * 微学校api模块
 * @author
 * @url
 */
defined ( 'IN_IA' ) or exit ( 'Access Denied' );
require  'inc/func/core.php';
include 'model.php';
include_once 'inc/app/jwt/JWT.php';
include 'inc/app/function.php';

class api extends Core{
    public function Test (){
        include_once 'inc/app/test1.php';
    }
    //数据库修改
    public function AppMysql(){
        include IA_ROOT.'/addons/weixuexiao/inc/app/mysql.php';
    }
    /******************APP接口连接 start********************/
    /** 学校 start */
    /**学校搜索处理**/
    public function AppSchoolSearch(){
        include_once 'inc/app/school/schoolSearch.php';
    }
    /**学校列表**/
    public function AppSchoolList(){
        include_once 'inc/app/school/schoolList.php';
    }
    /**学校首页**/
    public function AppSchoolDetail(){
        include_once 'inc/app/school/detail.php';
    }
    /**学校文章**/
    public function AppSchoolArticle(){
        include_once 'inc/app/school/schoolArticle.php';
    }
    /**学校简介**/
    public function AppSchooljianjie(){
        include_once 'inc/app/school/jianjie.php';
    }
    /**招生简介**/
    public function AppSchoolRecruit(){
        include_once 'inc/app/school/recruit.php';
    }
    /**学校食谱**/
    public function AppSchoolCookbook(){
        include_once 'inc/app/school/cookbook.php';
    }
    /**教师风采**/
    public function AppSchoolTeachers(){
        include_once 'inc/app/school/teacher/teachers.php';
    }
    /**教师详情**/
    public function AppSchoolTeacherDetail(){
        include_once 'inc/app/school/teacher/detail.php';
    }
    /**学校年级和课程列表**/
    public function AppSchoolGrade(){
        include_once 'inc/app/school/course/grade.php';
    }
    /**课程详情**/
    public function AppCourseDetail(){
        include_once 'inc/app/school/course/detail.php';
    }
    /**绑定学生和教师身份**/
    public function Appbangding(){
        include_once 'inc/app/school/bangding.php';
    }
    /**报名页面**/
    public function AppSignUp(){
        include_once 'inc/app/school/signUp/signUp.php';
    }
    /**提交报名信息**/
    public function AppSignUpSubmit(){
        include_once 'inc/app/school/signUp/signUpAjax.php';
    }
    /**报名列表**/
    public function AppSignUpList(){
        include_once 'inc/app/school/signUp/signUpList.php';
    }
    /**一些提交数据的处理**/
    public function AppAjaxSub(){
        include_once 'inc/app/school/ajaxSub.php';
    }
    /**预约试听**/
    public function AppStudentAudition(){
        include_once 'inc/app/school/student/audition.php';
    }
    /**公共预约入口**/
    public function AppAppointment(){
        include_once 'inc/app/school/appointment.php';
    }
    /**课程新增学生**/
    public function AppStudentAdd(){
        include_once 'inc/app/school/student/addStudent.php';
    }
    /**新手引导**/
    public function AppGuide(){
        include_once 'inc/app/school/guide.php';
    }
    /**留言页面**/
    public function AppLeavingMessage(){
        include_once 'inc/app/school/leaving.php';
    }
    /**上传文件**/
    public function AppUpload(){
        include_once 'inc/app/school/common/upload.php';
    }
    /**添加或者修改收货人信息**/
    public function AppAddress(){
        include_once 'inc/app/school/address.php';
    }
    /**校园通知班级通知和作业的ajax请求**/
    public function AppQuestionAjax(){
        include_once 'inc/app/school/common/question_ajax.php';
    }
    /**相册的Ajax请求**/
    public function AppAlbumAjax(){
        include_once 'inc/app/school/common/album_ajax.php';
    }
    /**公共的ajax请求**/
    public function AppAjax(){
        include_once 'inc/app/school/common/ajax.php';
    }
    /**订单的ajax提交**/
    public function AppOrderAjax(){
        include_once 'inc/app/school/common/OrderAjax.php';
    }
    /**发布班级圈的处理接口**/
    public function AppCircleAjax(){
        include_once 'inc/app/school/common/CircleAjax.php';
    }
    /**学校的集体活动,家政,家教的ajax请求**/
    public function AppActivityAjax(){
        include_once 'inc/app/school/common/ActivityAjax.php';
    }
    /**成绩的ajax请求**/
    public function AppScoresAjax(){
        include_once 'inc/app/school/common/ScoresAjax.php';
    }
    /**通知的ajax请求**/
    public function AppNoticeAjax(){
        include_once 'inc/app/school/common/NoticeAjax.php';
    }
    /**请假的ajax请求**/
    public function AppLeaveAjax(){
        include_once 'inc/app/school/common/LeaveAjax.php';
    }
    /**教师任务的ajax请求**/
    public function AppTaskAjax(){
        include_once 'inc/app/school/common/TaskAjax.php';
    }
    /**校长信箱的ajax请求**/
    public function AppMailAjax(){
        include_once 'inc/app/school/common/MailAjax.php';
    }
    /**预约的ajax请求接口**/
    public function AppBookingAjax(){
        include_once 'inc/app/school/common/BookingAjax.php';
    }
    /**考勤的ajax请求接口**/
    public function AppAttendanceAjax(){
        include_once 'inc/app/school/common/AttendanceAjax.php';
    }
    /**公开课的ajax请求**/
    public function AppOpenClassAjax(){
        include_once 'inc/app/school/common/OpenClassAjax.php';
    }
    /**报名的ajax请求**/
    public function AppSignUpAjax(){
        include_once 'inc/app/school/common/SignUpAjax.php';
    }
    /**周计划的ajax请求**/
    public function AppWeeklyAjax(){
        include_once 'inc/app/school/common/WeeklyAjax.php';
    }
    /**成长手册的ajax请求**/
    public function AppGrowthAjax(){
        include_once 'inc/app/school/common/GrowthAjax.php';
    }
    /**商城的ajax请求**/
    public function AppGoodAjax(){
        include_once 'inc/app/school/common/GoodAjax.php';
    }
    /******************公开课start*************************/
    /**公开课添加评论页面**/
    public function AppOpenClassCreateComment(){
        include_once 'inc/app/school/openClass/create.php';
    }
    /**公开课展示评论页面**/
    public function AppOpenClassShowComment(){
        include_once 'inc/app/school/openClass/show.php';
    }
    /**用户评论过的公开课**/
    public function AppCommentOpenClassList(){
        include_once 'inc/app/school/openClass/list.php';
    }
    /******************end*************************/
    /** 学校 end */
    /****************学生操作 START*******************/

    /**学生的ajax提交操作**/
    public function AppStudentAjax(){
        include_once 'inc/app/school/student/ajaxSub.php';
    }
    /**学生的个人中心**/
    public function AppStudentCenter(){
        include_once 'inc/app/school/student/center.php';
    }
    /**学生的个人中心个人信息**/
    public function AppStudentInformation(){
        include_once 'inc/app/school/student/information.php';
    }
    /**学生的家庭成员**/
    public function AppStudentFamily(){
        include_once 'inc/app/school/student/family.php';
    }
    /**学生的个人信息**/
    public function AppStudentInfo(){
        include_once 'inc/app/school/student/info.php';
    }
    /**学生的详细信息**/
    public function AppStudentDetail(){
        include_once 'inc/app/school/student/detail.php';
    }
    /**学生的考勤详情页**/
    public function AppStudentAttendance(){
        include_once 'inc/app/school/student/more/attendance/attendance.php';
    }
    /**学生的签到页面**/
    public function AppStudentSign(){
        include_once 'inc/app/school/student/more/attendance/sign.php';
    }
    /**学生的签到列表页**/
    public function AppStudentSignList(){
        include_once 'inc/app/school/student/more/attendance/sign_list.php';
    }
    /**学生的请假页面**/
    public function AppStudentLeave(){
        include_once 'inc/app/school/student/more/attendance/leave.php';
    }
    /**学生的请假列表页面**/
    public function AppStudentLeaveList(){
        include_once 'inc/app/school/student/more/attendance/leave_list.php';
    }
    /**学生的卡片管理**/
    public function AppStudentCard(){
        include_once 'inc/app/school/student/more/attendance/card.php';
    }
    /**学生 周计划计划列表**/
    public function AppStudentWeeklyList(){
        include_once 'inc/app/school/student/more/weekly/list.php';
    }
    /**学生 周计划计划详情**/
    public function AppStudentWeeklyDetail(){
        include_once 'inc/app/school/student/more/weekly/detail.php';
    }
    /**学生的商品列表**/
    public function AppStudentGoodList(){
        include_once 'inc/app/school/student/more/good/list.php';
    }
    /**学生 商品详情**/
    public function AppStudentGoodDetail(){
        include_once 'inc/app/school/student/more/good/detail.php';
    }
    /**学生 下单页面**/
    public function AppStudentGoodPlaceOrder(){
        include_once 'inc/app/school/student/more/good/placeOrder.php';
    }
    /**学生 订单列表页面**/
    public function AppStudentGoodOrderList(){
        include_once 'inc/app/school/student/more/good/orderList.php';
    }
    /**学生 订单详情页面**/
    public function AppStudentGoodOrderDetail(){
        include_once 'inc/app/school/student/more/good/orderDetail.php';
    }
    /**学生的校园通知和班级通知列表**/
    public function AppStudentNoticeList(){
        include_once 'inc/app/school/student/more/notice/notice_list.php';
    }
    /**校园通知和班级通知详情页**/
    public function AppStudentNotice(){
        include_once 'inc/app/school/student/more/notice/notice.php';
    }
    /**学生的作业列表**/
    public function AppStudentTaskList(){
        include_once 'inc/app/school/student/more/notice/task_list.php';
    }
    /**学生的作业详情**/
    public function AppStudentTask(){
        include_once 'inc/app/school/student/more/notice/task.php';
    }
    /**学生的班级相册**/
    public function AppStudentClassAlbum(){
        include_once 'inc/app/school/student/more/album/classAlbum.php';
    }
    /**学生发布相册页面**/
    public function AppStudentPublishAlbum(){
        include_once 'inc/app/school/student/more/album/publishAlbum.php';
    }
    /**学生的相册详情**/
    public function AppStudentAlbumDetail(){
        include_once 'inc/app/school/student/more/album/albumDetail.php';
    }
    /**学生的授课老师**/
    public function AppStudentTeacher(){
        include_once 'inc/app/school/student/more/course/teachers.php';
    }
    /**学生的在读课程**/
    public function AppStudentCourse(){
        include_once 'inc/app/school/student/more/course/course.php';
    }
    /**学生评价课程的页面数据**/
    public function AppStudentAppraiseCourse(){
        include_once 'inc/app/school/student/more/course/appraise.php';
    }
    /**学生的课程详情**/
    public function AppStudentCourseDetail(){
        include_once 'inc/app/school/student/more/course/detail.php';
    }
    /**集体活动**/
    public function AppStudentGroupActivities(){
        include_once 'inc/app/school/student/more/activity/list.php';
    }
    /**活动详情**/
    public function AppStudentActivityDetail(){
        include_once 'inc/app/school/student/more/activity/detail.php';
    }
    /**学生报名参加活动的记录**/
    public function AppStudentSignRecord(){
        include_once 'inc/app/school/student/more/activity/record.php';
    }
    /**学生成绩查询页面**/
    public function AppStudentScores(){
        include_once 'inc/app/school/student/more/scores/scores.php';
    }
    /**学生的班级圈入口**/
    public function AppStudentClassCircle(){
        include_once 'inc/app/school/student/more/class/ClassCircle.php';
    }
    /**学生发布班级圈页面**/
    public function AppStudentPublishClassCircle(){
        include_once 'inc/app/school/student/more/class/PublishClassCircle.php';
    }
    /**学生端口的校长信箱**/
    public function AppStudentMailbox(){
        include_once 'inc/app/school/student/more/mail/Mailbox.php';
    }
    /**学生的通讯录**/
    public function AppStudentCallBook(){
        include_once 'inc/app/school/student/CallBook.php';
    }

    /****************学生操作 END*******************/
    /***************老师中心 START********************/
    public function AppTeacherCenter(){
        include_once 'inc/app/school/teacher/center.php';
    }
    /**老师的个人信息**/
    public function AppTeacherInfo(){
        include_once 'inc/app/school/teacher/info.php';
    }
    /**老师的考勤详情页**/
    public function AppTeacherAttendance(){
        include_once 'inc/app/school/teacher/more/attendance/attendance.php';
    }
    /**老师的考勤管理列表**/
    public function AppTeacherAttendanceManagement(){
        include_once 'inc/app/school/teacher/more/attendance/management.php';
    }
    /**老师的签到页面**/
    public function AppTeacherSign(){
        include_once 'inc/app/school/teacher/more/attendance/sign.php';
    }
    /**老师卡片管理页面**/
    public function AppTeacherCard(){
        include_once 'inc/app/school/teacher/more/attendance/cart.php';
    }
    /**老师  学生的考勤详情页**/
    public function AppTeacherStudentSignDetail(){
        include_once 'inc/app/school/teacher/more/attendance/student/detail.php';
    }
    /**老师  学生的考勤签到页**/
    public function AppTeacherStudentSignInfo(){
        include_once 'inc/app/school/teacher/more/attendance/student/info.php';
    }
    /**老师  查看学生的考勤记录**/
    public function AppTeacherStudentSignRecord(){
        include_once 'inc/app/school/teacher/more/attendance/student/record.php';
    }
    /**老师的学生管理**/
    public function AppTeacherStudentManagement(){
        include_once 'inc/app/school/teacher/more/student/StudentManagement.php';
    }
    /**学生的报名管理**/
    public function AppTeacherSignUpManagement(){
        include_once 'inc/app/school/teacher/more/student/signUp.php';
    }
    /**学生的报名详情页**/
    public function AppTeacherSignUpDetail(){
        include_once 'inc/app/school/teacher/more/student/signUpDetail.php';
    }
    /**老师的积分**/
    public function AppTeacherPoint(){
        include_once 'inc/app/school/teacher/more/point/point.php';
    }
    /**老师的积分任务完成列表页面 积分明细**/
    public function AppTeacherPointList(){
        include_once 'inc/app/school/teacher/more/point/pointList.php';
    }
    /**老师 商城列表**/
    public function AppTeacherGoodList(){
        include_once 'inc/app/school/teacher/more/good/list.php';
    }
    /**老师 商品详情**/
    public function AppTeacherGoodDetail(){
        include_once 'inc/app/school/teacher/more/good/detail.php';
    }
    /**老师 商品下单页面**/
    public function AppTeacherGoodPlaceOrder(){
        include_once 'inc/app/school/teacher/more/good/placeOrder.php';
    }
    /**老师 订单列表页面**/
    public function AppTeacherGoodOrderList(){
        include_once 'inc/app/school/teacher/more/good/orderList.php';
    }
    /**老师 订单列表页面**/
    public function AppTeacherGoodOrderDetail(){
        include_once 'inc/app/school/teacher/more/good/orderDetail.php';
    }
    /**教师的课程列表页面**/
    public function AppTeacherCourse(){
        include_once 'inc/app/school/teacher/more/course/course.php';
    }
    /**教师的课程详情页面**/
    public function AppTeacherCourseDetail(){
        include_once 'inc/app/school/teacher/more/course/detail.php';
    }
    /**教师管理课程学生签到**/
    public function AppTeacherAdminCourseSign(){
        include_once 'inc/app/school/teacher/more/course/courseAdminSign.php';
    }
    /**老师们的授课信息**/
    public function AppTeacherAdminTeaching(){
        include_once 'inc/app/school/teacher/more/course/adminTeaching.php';
    }
    /**班主任确认此年级课程的其他老师签到问题**/
    public function AppTeacherConfirmCourseSign(){
        include_once 'inc/app/school/teacher/more/course/course_confirm_sign.php';
    }
    /**教师的授课情况**/
    public function AppTeacherTeachingList(){
        include_once 'inc/app/school/teacher/more/course/teachingList.php';
    }
    /**创建公开课页面**/
    public function AppTeacherPublishOpenClass(){
        include_once 'inc/app/school/teacher/more/openClass/publish.php';
    }
    /**公开课列表**/
    public function AppTeacherOpenClassList(){
        include_once 'inc/app/school/teacher/more/openClass/list.php';
    }
    /**公开课详情**/
    public function AppTeacherOpenClassDetail(){
        include_once 'inc/app/school/teacher/more/openClass/detail.php';
    }
    /**被评论的公开课**/
    public function AppTeacherCommentOpenClassList(){
        include_once 'inc/app/school/teacher/more/openClass/listComment.php';
    }
    /**教师的留言设置**/
    public function AppTeacherLeavingMessage(){
        include_once 'inc/app/school/teacher/more/LeavingMessage.php';
    }
    /**老师发布动态**/
    public function AppTeacherReleaseNews(){
        include_once 'inc/app/school/teacher/ReleaseNews.php';
    }
    /**老师发布班级通知的页面**/
    public function AppTeacherPublishClassNotice(){
        include_once 'inc/app/school/teacher/more/notice/PublishClassNotice.php';
    }
    /**老师的班级通知列表页**/
    public function AppTeacherClassNoticeList(){
        include_once 'inc/app/school/teacher/more/notice/classNoticeList.php';
    }
    /**老师的班级通知详情页**/
    public function AppTeacherClassNoticeDetail(){
        include_once 'inc/app/school/teacher/more/notice/classNoticeDetail.php';
    }
    /**老师发布班级通知的页面**/
    public function AppTeacherPublishSchoolNotice(){
        include_once 'inc/app/school/teacher/more/notice/PublishSchoolNotice.php';
    }
    /**老师的校园通知列表页**/
    public function AppTeacherSchoolNoticeList(){
        include_once 'inc/app/school/teacher/more/notice/schoolNoticeList.php';
    }
    /**老师的校园通知详情页**/
    public function AppTeacherSchoolNoticeDetail(){
        include_once 'inc/app/school/teacher/more/notice/schoolNoticeDetail.php';
    }
    /**老师发布班级通知的页面**/
    public function AppTeacherPublishTaskNotice(){
        include_once 'inc/app/school/teacher/more/notice/PublishTaskNotice.php';
    }
    /**老师的作业列表页**/
    public function AppTeacherTaskNoticeList(){
        include_once 'inc/app/school/teacher/more/notice/taskNoticeList.php';
    }
    /**老师的作业详情页**/
    public function AppTeacherTaskNoticeDetail(){
        include_once 'inc/app/school/teacher/more/notice/taskNoticeDetail.php';
    }
    /**老师查看学生作业的回答情况**/
    public function AppTeacherTaskAnswer(){
        include_once 'inc/app/school/teacher/more/notice/taskAnswer.php';
    }
    /**通知的问题回答统计**/
    public function AppTeacherQuestionStatistics(){
        include_once 'inc/app/school/teacher/more/notice/QuestionStatistics.php';
    }
    /**获取单选和多选的回答详情**/
    public function AppTeacherChoiceQuestionDetail(){
        include_once 'inc/app/school/teacher/more/notice/ChoiceQuestionDetail.php';
    }
    /**通知的阅读记录**/
    public function AppTeacherNoticeRecord(){
        include_once 'inc/app/school/teacher/more/notice/NoticeRecord.php';
    }
    /**老师请假页面**/
    public function AppTeacherLeave(){
        include_once 'inc/app/school/teacher/more/leave/TeacherLeave.php';
    }
    /**老师请假列表**/
    public function AppTeacherLeaveList(){
        include_once 'inc/app/school/teacher/more/leave/TeacherLeaveList.php';
    }
    /**老师请假审核**/
    public function AppTeacherLeaveReview(){
        include_once 'inc/app/school/teacher/more/leave/leaveReview.php';
    }
    /**审核老师的请假列表**/
    public function AppTeacherReviewTeacherLeaveList(){
        include_once 'inc/app/school/teacher/more/leave/ReviewStudentLeaveList.php';
    }
    /**审核学生的请假列表**/
    public function AppTeacherReviewStudentLeaveList(){
        include_once 'inc/app/school/teacher/more/leave/ReviewStudentLeaveList.php';
    }
    /**老师的请假统计结果**/
    public function AppTeacherLeaveStatistics(){
        include_once 'inc/app/school/teacher/more/leave/TeacherLeaveStatistics.php';
    }
    /**班级的请假结果统计**/
    public function AppClassLeaveStatistics(){
        include_once 'inc/app/school/teacher/more/leave/ClassLeaveStatistics.php';
    }
    /**教师发布任务页面**/
    public function AppTeacherPublishTask(){
        include_once  'inc/app/school/teacher/more/task/publish.php';
    }
    /**教师任务列表**/
    public function AppTeacherTaskList(){
        include_once  'inc/app/school/teacher/more/task/list.php';
    }
    /**教师任务详情**/
    public function AppTeacherTaskDetail(){
        include_once  'inc/app/school/teacher/more/task/detail.php';
    }
    /**老师的班级相册**/
    public function AppTeacherClassAlbum(){
        include_once 'inc/app/school/teacher/more/album/classAlbum.php';
    }
    /**老师发布相册页面**/
    public function AppTeacherPublishAlbum(){
        include_once 'inc/app/school/teacher/more/album/publishAlbum.php';
    }
    /**老师的相册详情**/
    public function AppTeacherAlbumDetail(){
        include_once 'inc/app/school/teacher/more/album/albumDetail.php';
    }
    /**老师的班级圈入口**/
    public function AppTeacherClassCircle(){
        include_once 'inc/app/school/teacher/more/class/ClassCircle.php';
    }
    /**老师发布班级圈页面**/
    public function AppTeacherPublishClassCircle(){
        include_once 'inc/app/school/teacher/more/class/PublishClassCircle.php';
    }
    /**老师端口的校长信箱**/
    public function AppTeacherMailBox(){
        include_once 'inc/app/school/teacher/more/mail/MailBox.php';
    }
    /**老师端口的预约管理列表**/
    public function AppTeacherBookingList(){
        include_once 'inc/app/school/teacher/more/booking/list.php';
    }
    /**老师端口的预约管理详情**/
    public function AppTeacherBookingDetail(){
        include_once 'inc/app/school/teacher/more/booking/detail.php';
    }
    /**老师的通讯录**/
    public function AppTeacherCallBook(){
        include_once 'inc/app/school/teacher/CallBook.php';
    }
    /**老师发布编辑周计划**/
    public function AppTeacherPublishWeekly(){
        include_once 'inc/app/school/teacher/more/weekly/publish.php';
    }
    /**老师的周计划列表**/
    public function AppTeacherWeeklyPlanList(){
        include_once 'inc/app/school/teacher/more/weekly/list.php';
    }
    /**老师的周计划详情页**/
    public function AppTeacherWeeklyPlanDetail(){
        include_once 'inc/app/school/teacher/more/weekly/detail.php';
    }
    /**老师 创建成长手册**/
    public function AppTeacherCreateGrowth(){
        include_once 'inc/app/school/teacher/more/growth/create.php';
    }
    /**老师  成长手册列表**/
    public function AppTeacherGrowthList(){
        include_once 'inc/app/school/teacher/more/growth/list.php';
    }
    /**老师  成长手册学生列表**/
    public function AppTeacherGrowthStudentList(){
        include_once 'inc/app/school/teacher/more/growth/student.php';
    }
    /**老师  成长手册学生的点评**/
    public function AppTeacherGrowthStudentComment(){
        include_once 'inc/app/school/teacher/more/growth/studentComment.php';
    }
    /**老师  获取学校或者家里对学生的评价**/
    public function AppTeacherGetGrowthStudentComment(){
        include_once 'inc/app/school/teacher/more/growth/getStudentComment.php';
    }
    /**老师  成长手册的评语库管理**/
    public function AppTeacherGrowthCommentManagement(){
        include_once 'inc/app/school/teacher/more/growth/comment.php';
    }
    /**老师的ajax提交操作**/
    public function AppTeacherAjax(){
        include_once 'inc/app/school/teacher/ajaxSub.php';
    }
    /***************老师中心 END********************/
    /***************课程 START********************/

    /**课程的ajax提交操作**/
    public function AppCourseAjax(){
        include_once 'inc/app/school/course/ajaxSub.php';
    }
    /**课程大纲**/
    public function AppCourseOutline(){
        include_once 'inc/app/school/course/outline.php';
    }
    /**课程学生列表**/
    public function AppCourseStudent(){
        include_once 'inc/app/school/course/student.php';
    }
    /**固定课程的课程安排详情**/
    public function AppCourseTimetable(){
        include_once 'inc/app/school/course/timetable.php';
    }
    /***************课程 END*******************/
    /**动态的ajax提交操作**/
    public function AppNewsAjax(){
        include_once 'inc/app/school/common/NewsAjax.php';
    }
    /******************聊天 START**********************/
    /**聊天的ajax请求**/
    public function AppChatAjax(){
        include_once 'inc/app/school/news/chatAjax.php';
    }
    /**聊天列表**/
    public function AppChat(){
        include_once 'inc/app/school/news/chatList.php';
    }
    /**聊天窗口**/
    public function AppChatWindow(){
        include_once 'inc/app/school/news/chatWindow.php';
    }
    /******************聊天 END**********************/
    /** 登陆注册 start**/
    /**用户注册**/
    public function AppRegister(){
        include_once 'inc/app/login/register.php';
    }
    /**用户登陆**/
    public function AppLogin(){
        include_once 'inc/app/login/login.php';
    }
    /** 登陆注册 end**/
    /******************APP接口连接 end********************/
}