<?php
/**
 * 微学校模块
 * @author 
 * @url 
 */ 
defined ( 'IN_IA' ) or exit ( 'Access Denied' );
require  'inc/func/core.php';
include 'model.php';
include_once 'inc/app/jwt/JWT.php';
include 'inc/app/function.php';
define('OSSURL', $_W['sitescheme'].getoauthurl().'/addons/weixuexiao/');
define('MODULE_URL_MAIN', $_W['sitescheme'].getoauthurl().'/addons/weixuexiao/');

class weixuexiaoModuleSite extends Core {

    public function doMobileTest (){
        include_once 'inc/app/test1.php';
    }
    //数据库修改
    public function doMobileAppMysql(){
        include IA_ROOT.'/addons/weixuexiao/inc/app/mysql.php';
    }
    /******************APP接口连接 start********************/
    /** 学校 start */
    /**学校搜索处理**/
    public function doMobileAppSchoolSearch(){
        include_once 'inc/app/school/schoolSearch.php';
    }
    /**学校列表**/
    public function doMobileAppSchoolList(){
        include_once 'inc/app/school/schoolList.php';
    }
    /**学校首页**/
    public function doMobileAppSchoolDetail(){
        include_once 'inc/app/school/detail.php';
    }
    /**学校文章**/
    public function doMobileAppSchoolArticle(){
        include_once 'inc/app/school/schoolArticle.php';
    }
    /**学校简介**/
    public function doMobileAppSchooljianjie(){
        include_once 'inc/app/school/jianjie.php';
    }
    /**招生简介**/
    public function doMobileAppSchoolRecruit(){
        include_once 'inc/app/school/recruit.php';
    }
    /**学校食谱**/
    public function doMobileAppSchoolCookbook(){
        include_once 'inc/app/school/cookbook.php';
    }
    /**教师风采**/
    public function doMobileAppSchoolTeachers(){
        include_once 'inc/app/school/teacher/teachers.php';
    }
    /**教师详情**/
    public function doMobileAppSchoolTeacherDetail(){
        include_once 'inc/app/school/teacher/detail.php';
    }
    /**学校年级和课程列表**/
    public function doMobileAppSchoolGrade(){
        include_once 'inc/app/school/course/grade.php';
    }
    /**课程详情**/
    public function doMobileAppCourseDetail(){
        include_once 'inc/app/school/course/detail.php';
    }
    /**绑定学生和教师身份**/
    public function doMobileAppbangding(){
        include_once 'inc/app/school/bangding.php';
    }
    /**报名页面**/
    public function doMobileAppSignUp(){
        include_once 'inc/app/school/signUp/signUp.php';
    }
    /**提交报名信息**/
    public function doMobileAppSignUpSubmit(){
        include_once 'inc/app/school/signUp/signUpAjax.php';
    }
    /**报名列表**/
    public function doMobileAppSignUpList(){
        include_once 'inc/app/school/signUp/signUpList.php';
    }
    /**一些提交数据的处理**/
    public function doMobileAppAjaxSub(){
        include_once 'inc/app/school/ajaxSub.php';
    }
    /**预约试听**/
    public function doMobileAppStudentAudition(){
        include_once 'inc/app/school/student/audition.php';
    }
    /**公共预约入口**/
    public function doMobileAppAppointment(){
        include_once 'inc/app/school/appointment.php';
    }
    /**课程新增学生**/
    public function doMobileAppStudentAdd(){
        include_once 'inc/app/school/student/addStudent.php';
    }
    /**新手引导**/
    public function doMobileAppGuide(){
        include_once 'inc/app/school/guide.php';
    }
    /**留言页面**/
    public function doMobileAppLeavingMessage(){
        include_once 'inc/app/school/leaving.php';
    }
    /**上传文件**/
    public function doMobileAppUpload(){
        include_once 'inc/app/school/common/upload.php';
    }
    /**添加或者修改收货人信息**/
    public function doMobileAppAddress(){
        include_once 'inc/app/school/address.php';
    }
    /**校园通知班级通知和作业的ajax请求**/
    public function doMobileAppQuestionAjax(){
        include_once 'inc/app/school/common/question_ajax.php';
    }
    /**相册的Ajax请求**/
    public function doMobileAppAlbumAjax(){
        include_once 'inc/app/school/common/album_ajax.php';
    }
    /**公共的ajax请求**/
    public function doMobileAppAjax(){
        include_once 'inc/app/school/common/ajax.php';
    }
    /**订单的ajax提交**/
    public function doMobileAppOrderAjax(){
        include_once 'inc/app/school/common/OrderAjax.php';
    }
    /**发布班级圈的处理接口**/
    public function doMobileAppCircleAjax(){
        include_once 'inc/app/school/common/CircleAjax.php';
    }
    /**学校的集体活动,家政,家教的ajax请求**/
    public function doMobileAppActivityAjax(){
        include_once 'inc/app/school/common/ActivityAjax.php';
    }
    /**成绩的ajax请求**/
    public function doMobileAppScoresAjax(){
        include_once 'inc/app/school/common/ScoresAjax.php';
    }
    /**通知的ajax请求**/
    public function doMobileAppNoticeAjax(){
        include_once 'inc/app/school/common/NoticeAjax.php';
    }
    /**请假的ajax请求**/
    public function doMobileAppLeaveAjax(){
        include_once 'inc/app/school/common/LeaveAjax.php';
    }
    /**教师任务的ajax请求**/
    public function doMobileAppTaskAjax(){
        include_once 'inc/app/school/common/TaskAjax.php';
    }
    /**校长信箱的ajax请求**/
    public function doMobileAppMailAjax(){
        include_once 'inc/app/school/common/MailAjax.php';
    }
    /**预约的ajax请求接口**/
    public function doMobileAppBookingAjax(){
        include_once 'inc/app/school/common/BookingAjax.php';
    }
    /**考勤的ajax请求接口**/
    public function doMobileAppAttendanceAjax(){
        include_once 'inc/app/school/common/AttendanceAjax.php';
    }
    /**公开课的ajax请求**/
    public function doMobileAppOpenClassAjax(){
        include_once 'inc/app/school/common/OpenClassAjax.php';
    }
    /**报名的ajax请求**/
    public function doMobileAppSignUpAjax(){
        include_once 'inc/app/school/common/SignUpAjax.php';
    }
    /**周计划的ajax请求**/
    public function doMobileAppWeeklyAjax(){
        include_once 'inc/app/school/common/WeeklyAjax.php';
    }
    /**成长手册的ajax请求**/
    public function doMobileAppGrowthAjax(){
        include_once 'inc/app/school/common/GrowthAjax.php';
    }
    /**商城的ajax请求**/
    public function doMobileAppGoodAjax(){
        include_once 'inc/app/school/common/GoodAjax.php';
    }
    /******************公开课start*************************/
    /**公开课添加评论页面**/
    public function doMobileAppOpenClassCreateComment(){
        include_once 'inc/app/school/openClass/create.php';
    }
    /**公开课展示评论页面**/
    public function doMobileAppOpenClassShowComment(){
        include_once 'inc/app/school/openClass/show.php';
    }
    /**用户评论过的公开课**/
    public function doMobileAppCommentOpenClassList(){
        include_once 'inc/app/school/openClass/list.php';
    }
    /******************end*************************/
    /** 学校 end */
    /****************学生操作 START*******************/

    /**学生的ajax提交操作**/
    public function doMobileAppStudentAjax(){
        include_once 'inc/app/school/student/ajaxSub.php';
    }
    /**学生的个人中心**/
    public function doMobileAppStudentCenter(){
        include_once 'inc/app/school/student/center.php';
    }
    /**学生的个人中心个人信息**/
    public function doMobileAppStudentInformation(){
        include_once 'inc/app/school/student/information.php';
    }
    /**学生的家庭成员**/
    public function doMobileAppStudentFamily(){
        include_once 'inc/app/school/student/family.php';
    }
    /**学生的个人信息**/
    public function doMobileAppStudentInfo(){
        include_once 'inc/app/school/student/info.php';
    }
    /**学生的详细信息**/
    public function doMobileAppStudentDetail(){
        include_once 'inc/app/school/student/detail.php';
    }
    /**学生的考勤详情页**/
    public function doMobileAppStudentAttendance(){
        include_once 'inc/app/school/student/more/attendance/attendance.php';
    }
    /**学生的签到页面**/
    public function doMobileAppStudentSign(){
        include_once 'inc/app/school/student/more/attendance/sign.php';
    }
    /**学生的签到列表页**/
    public function doMobileAppStudentSignList(){
        include_once 'inc/app/school/student/more/attendance/sign_list.php';
    }
    /**学生的请假页面**/
    public function doMobileAppStudentLeave(){
        include_once 'inc/app/school/student/more/attendance/leave.php';
    }
    /**学生的请假列表页面**/
    public function doMobileAppStudentLeaveList(){
        include_once 'inc/app/school/student/more/attendance/leave_list.php';
    }
    /**学生的卡片管理**/
    public function doMobileAppStudentCard(){
        include_once 'inc/app/school/student/more/attendance/card.php';
    }
    /**学生 周计划计划列表**/
    public function doMobileAppStudentWeeklyList(){
        include_once 'inc/app/school/student/more/weekly/list.php';
    }
    /**学生 周计划计划详情**/
    public function doMobileAppStudentWeeklyDetail(){
        include_once 'inc/app/school/student/more/weekly/detail.php';
    }
    /**学生的商品列表**/
    public function doMobileAppStudentGoodList(){
        include_once 'inc/app/school/student/more/good/list.php';
    }
    /**学生 商品详情**/
    public function doMobileAppStudentGoodDetail(){
        include_once 'inc/app/school/student/more/good/detail.php';
    }
    /**学生 下单页面**/
    public function doMobileAppStudentGoodPlaceOrder(){
        include_once 'inc/app/school/student/more/good/placeOrder.php';
    }
    /**学生 订单列表页面**/
    public function doMobileAppStudentGoodOrderList(){
        include_once 'inc/app/school/student/more/good/orderList.php';
    }
    /**学生 订单详情页面**/
    public function doMobileAppStudentGoodOrderDetail(){
        include_once 'inc/app/school/student/more/good/orderDetail.php';
    }
    /**学生的校园通知和班级通知列表**/
    public function doMobileAppStudentNoticeList(){
        include_once 'inc/app/school/student/more/notice/notice_list.php';
    }
    /**校园通知和班级通知详情页**/
    public function doMobileAppStudentNotice(){
        include_once 'inc/app/school/student/more/notice/notice.php';
    }
    /**学生的作业列表**/
    public function doMobileAppStudentTaskList(){
        include_once 'inc/app/school/student/more/notice/task_list.php';
    }
    /**学生的作业详情**/
    public function doMobileAppStudentTask(){
        include_once 'inc/app/school/student/more/notice/task.php';
    }
    /**学生的班级相册**/
    public function doMobileAppStudentClassAlbum(){
        include_once 'inc/app/school/student/more/album/classAlbum.php';
    }
    /**学生发布相册页面**/
    public function doMobileAppStudentPublishAlbum(){
        include_once 'inc/app/school/student/more/album/publishAlbum.php';
    }
    /**学生的相册详情**/
    public function doMobileAppStudentAlbumDetail(){
        include_once 'inc/app/school/student/more/album/albumDetail.php';
    }
    /**学生的授课老师**/
    public function doMobileAppStudentTeacher(){
        include_once 'inc/app/school/student/more/course/teachers.php';
    }
    /**学生的在读课程**/
    public function doMobileAppStudentCourse(){
        include_once 'inc/app/school/student/more/course/course.php';
    }
    /**学生评价课程的页面数据**/
    public function doMobileAppStudentAppraiseCourse(){
        include_once 'inc/app/school/student/more/course/appraise.php';
    }
    /**学生的课程详情**/
    public function doMobileAppStudentCourseDetail(){
        include_once 'inc/app/school/student/more/course/detail.php';
    }
    /**集体活动**/
    public function doMobileAppStudentGroupActivities(){
        include_once 'inc/app/school/student/more/activity/list.php';
    }
    /**活动详情**/
    public function doMobileAppStudentActivityDetail(){
        include_once 'inc/app/school/student/more/activity/detail.php';
    }
    /**学生报名参加活动的记录**/
    public function doMobileAppStudentSignRecord(){
        include_once 'inc/app/school/student/more/activity/record.php';
    }
    /**学生成绩查询页面**/
    public function doMobileAppStudentScores(){
        include_once 'inc/app/school/student/more/scores/scores.php';
    }
    /**学生的班级圈入口**/
    public function doMobileAppStudentClassCircle(){
        include_once 'inc/app/school/student/more/class/ClassCircle.php';
    }
    /**学生发布班级圈页面**/
    public function doMobileAppStudentPublishClassCircle(){
        include_once 'inc/app/school/student/more/class/PublishClassCircle.php';
    }
    /**学生端口的校长信箱**/
    public function doMobileAppStudentMailbox(){
        include_once 'inc/app/school/student/more/mail/Mailbox.php';
    }
    /**学生的通讯录**/
    public function doMobileAppStudentCallBook(){
        include_once 'inc/app/school/student/CallBook.php';
    }

    /****************学生操作 END*******************/
    /***************老师中心 START********************/
    public function doMobileAppTeacherCenter(){
        include_once 'inc/app/school/teacher/center.php';
    }
    /**老师的个人信息**/
    public function doMobileAppTeacherInfo(){
        include_once 'inc/app/school/teacher/info.php';
    }
    /**老师的考勤详情页**/
    public function doMobileAppTeacherAttendance(){
        include_once 'inc/app/school/teacher/more/attendance/attendance.php';
    }
    /**老师的考勤管理列表**/
    public function doMobileAppTeacherAttendanceManagement(){
        include_once 'inc/app/school/teacher/more/attendance/management.php';
    }
    /**老师的签到页面**/
    public function doMobileAppTeacherSign(){
        include_once 'inc/app/school/teacher/more/attendance/sign.php';
    }
    /**老师卡片管理页面**/
    public function doMobileAppTeacherCard(){
        include_once 'inc/app/school/teacher/more/attendance/cart.php';
    }
    /**老师  学生的考勤详情页**/
    public function doMobileAppTeacherStudentSignDetail(){
        include_once 'inc/app/school/teacher/more/attendance/student/detail.php';
    }
    /**老师  学生的考勤签到页**/
    public function doMobileAppTeacherStudentSignInfo(){
        include_once 'inc/app/school/teacher/more/attendance/student/info.php';
    }
    /**老师  查看学生的考勤记录**/
    public function doMobileAppTeacherStudentSignRecord(){
        include_once 'inc/app/school/teacher/more/attendance/student/record.php';
    }
    /**老师的学生管理**/
    public function doMobileAppTeacherStudentManagement(){
        include_once 'inc/app/school/teacher/more/student/StudentManagement.php';
    }
    /**学生的报名管理**/
    public function doMobileAppTeacherSignUpManagement(){
        include_once 'inc/app/school/teacher/more/student/signUp.php';
    }
    /**学生的报名详情页**/
    public function doMobileAppTeacherSignUpDetail(){
        include_once 'inc/app/school/teacher/more/student/signUpDetail.php';
    }
    /**老师的积分**/
    public function doMobileAppTeacherPoint(){
        include_once 'inc/app/school/teacher/more/point/point.php';
    }
    /**老师的积分任务完成列表页面 积分明细**/
    public function doMobileAppTeacherPointList(){
        include_once 'inc/app/school/teacher/more/point/pointList.php';
    }
    /**老师 商城列表**/
    public function doMobileAppTeacherGoodList(){
        include_once 'inc/app/school/teacher/more/good/list.php';
    }
    /**老师 商品详情**/
    public function doMobileAppTeacherGoodDetail(){
        include_once 'inc/app/school/teacher/more/good/detail.php';
    }
    /**老师 商品下单页面**/
    public function doMobileAppTeacherGoodPlaceOrder(){
        include_once 'inc/app/school/teacher/more/good/placeOrder.php';
    }
    /**老师 订单列表页面**/
    public function doMobileAppTeacherGoodOrderList(){
        include_once 'inc/app/school/teacher/more/good/orderList.php';
    }
    /**老师 订单列表页面**/
    public function doMobileAppTeacherGoodOrderDetail(){
        include_once 'inc/app/school/teacher/more/good/orderDetail.php';
    }
    /**教师的课程列表页面**/
    public function doMobileAppTeacherCourse(){
        include_once 'inc/app/school/teacher/more/course/course.php';
    }
    /**教师的课程详情页面**/
    public function doMobileAppTeacherCourseDetail(){
        include_once 'inc/app/school/teacher/more/course/detail.php';
    }
    /**教师管理课程学生签到**/
    public function doMobileAppTeacherAdminCourseSign(){
        include_once 'inc/app/school/teacher/more/course/courseAdminSign.php';
    }
    /**老师们的授课信息**/
    public function doMobileAppTeacherAdminTeaching(){
        include_once 'inc/app/school/teacher/more/course/adminTeaching.php';
    }
    /**班主任确认此年级课程的其他老师签到问题**/
    public function doMobileAppTeacherConfirmCourseSign(){
        include_once 'inc/app/school/teacher/more/course/course_confirm_sign.php';
    }
    /**教师的授课情况**/
    public function doMobileAppTeacherTeachingList(){
        include_once 'inc/app/school/teacher/more/course/teachingList.php';
    }
    /**创建公开课页面**/
    public function doMobileAppTeacherPublishOpenClass(){
        include_once 'inc/app/school/teacher/more/openClass/publish.php';
    }
    /**公开课列表**/
    public function doMobileAppTeacherOpenClassList(){
        include_once 'inc/app/school/teacher/more/openClass/list.php';
    }
    /**公开课详情**/
    public function doMobileAppTeacherOpenClassDetail(){
        include_once 'inc/app/school/teacher/more/openClass/detail.php';
    }
    /**被评论的公开课**/
    public function doMobileAppTeacherCommentOpenClassList(){
        include_once 'inc/app/school/teacher/more/openClass/listComment.php';
    }
    /**教师的留言设置**/
    public function doMobileAppTeacherLeavingMessage(){
        include_once 'inc/app/school/teacher/more/LeavingMessage.php';
    }
    /**老师发布动态**/
    public function doMobileAppTeacherReleaseNews(){
        include_once 'inc/app/school/teacher/ReleaseNews.php';
    }
    /**老师发布班级通知的页面**/
    public function doMobileAppTeacherPublishClassNotice(){
        include_once 'inc/app/school/teacher/more/notice/PublishClassNotice.php';
    }
    /**老师的班级通知列表页**/
    public function doMobileAppTeacherClassNoticeList(){
        include_once 'inc/app/school/teacher/more/notice/classNoticeList.php';
    }
    /**老师的班级通知详情页**/
    public function doMobileAppTeacherClassNoticeDetail(){
        include_once 'inc/app/school/teacher/more/notice/classNoticeDetail.php';
    }
    /**老师发布班级通知的页面**/
    public function doMobileAppTeacherPublishSchoolNotice(){
        include_once 'inc/app/school/teacher/more/notice/PublishSchoolNotice.php';
    }
    /**老师的校园通知列表页**/
    public function doMobileAppTeacherSchoolNoticeList(){
        include_once 'inc/app/school/teacher/more/notice/schoolNoticeList.php';
    }
    /**老师的校园通知详情页**/
    public function doMobileAppTeacherSchoolNoticeDetail(){
        include_once 'inc/app/school/teacher/more/notice/schoolNoticeDetail.php';
    }
    /**老师发布班级通知的页面**/
    public function doMobileAppTeacherPublishTaskNotice(){
        include_once 'inc/app/school/teacher/more/notice/PublishTaskNotice.php';
    }
    /**老师的作业列表页**/
    public function doMobileAppTeacherTaskNoticeList(){
        include_once 'inc/app/school/teacher/more/notice/taskNoticeList.php';
    }
    /**老师的作业详情页**/
    public function doMobileAppTeacherTaskNoticeDetail(){
        include_once 'inc/app/school/teacher/more/notice/taskNoticeDetail.php';
    }
    /**老师查看学生作业的回答情况**/
    public function doMobileAppTeacherTaskAnswer(){
        include_once 'inc/app/school/teacher/more/notice/taskAnswer.php';
    }
    /**通知的问题回答统计**/
    public function doMobileAppTeacherQuestionStatistics(){
        include_once 'inc/app/school/teacher/more/notice/QuestionStatistics.php';
    }
    /**获取单选和多选的回答详情**/
    public function doMobileAppTeacherChoiceQuestionDetail(){
        include_once 'inc/app/school/teacher/more/notice/ChoiceQuestionDetail.php';
    }
    /**通知的阅读记录**/
    public function doMobileAppTeacherNoticeRecord(){
        include_once 'inc/app/school/teacher/more/notice/NoticeRecord.php';
    }
    /**老师请假页面**/
    public function doMobileAppTeacherLeave(){
        include_once 'inc/app/school/teacher/more/leave/TeacherLeave.php';
    }
    /**老师请假列表**/
    public function doMobileAppTeacherLeaveList(){
        include_once 'inc/app/school/teacher/more/leave/TeacherLeaveList.php';
    }
    /**老师请假审核**/
    public function doMobileAppTeacherLeaveReview(){
        include_once 'inc/app/school/teacher/more/leave/leaveReview.php';
    }
    /**审核老师的请假列表**/
    public function doMobileAppTeacherReviewTeacherLeaveList(){
        include_once 'inc/app/school/teacher/more/leave/ReviewStudentLeaveList.php';
    }
    /**审核学生的请假列表**/
    public function doMobileAppTeacherReviewStudentLeaveList(){
        include_once 'inc/app/school/teacher/more/leave/ReviewStudentLeaveList.php';
    }
    /**老师的请假统计结果**/
    public function doMobileAppTeacherLeaveStatistics(){
        include_once 'inc/app/school/teacher/more/leave/TeacherLeaveStatistics.php';
    }
    /**班级的请假结果统计**/
    public function doMobileAppClassLeaveStatistics(){
        include_once 'inc/app/school/teacher/more/leave/ClassLeaveStatistics.php';
    }
    /**教师发布任务页面**/
    public function doMobileAppTeacherPublishTask(){
        include_once  'inc/app/school/teacher/more/task/publish.php';
    }
    /**教师任务列表**/
    public function doMobileAppTeacherTaskList(){
        include_once  'inc/app/school/teacher/more/task/list.php';
    }
    /**教师任务详情**/
    public function doMobileAppTeacherTaskDetail(){
        include_once  'inc/app/school/teacher/more/task/detail.php';
    }
    /**老师的班级相册**/
    public function doMobileAppTeacherClassAlbum(){
        include_once 'inc/app/school/teacher/more/album/classAlbum.php';
    }
    /**老师发布相册页面**/
    public function doMobileAppTeacherPublishAlbum(){
        include_once 'inc/app/school/teacher/more/album/publishAlbum.php';
    }
    /**老师的相册详情**/
    public function doMobileAppTeacherAlbumDetail(){
        include_once 'inc/app/school/teacher/more/album/albumDetail.php';
    }
    /**老师的班级圈入口**/
    public function doMobileAppTeacherClassCircle(){
        include_once 'inc/app/school/teacher/more/class/ClassCircle.php';
    }
    /**老师发布班级圈页面**/
    public function doMobileAppTeacherPublishClassCircle(){
        include_once 'inc/app/school/teacher/more/class/PublishClassCircle.php';
    }
    /**老师端口的校长信箱**/
    public function doMobileAppTeacherMailBox(){
        include_once 'inc/app/school/teacher/more/mail/MailBox.php';
    }
    /**老师端口的预约管理列表**/
    public function doMobileAppTeacherBookingList(){
        include_once 'inc/app/school/teacher/more/booking/list.php';
    }
    /**老师端口的预约管理详情**/
    public function doMobileAppTeacherBookingDetail(){
        include_once 'inc/app/school/teacher/more/booking/detail.php';
    }
    /**老师的通讯录**/
    public function doMobileAppTeacherCallBook(){
        include_once 'inc/app/school/teacher/CallBook.php';
    }
    /**老师发布编辑周计划**/
    public function doMobileAppTeacherPublishWeekly(){
        include_once 'inc/app/school/teacher/more/weekly/publish.php';
    }
    /**老师的周计划列表**/
    public function doMobileAppTeacherWeeklyPlanList(){
        include_once 'inc/app/school/teacher/more/weekly/list.php';
    }
    /**老师的周计划详情页**/
    public function doMobileAppTeacherWeeklyPlanDetail(){
        include_once 'inc/app/school/teacher/more/weekly/detail.php';
    }
    /**老师 创建成长手册**/
    public function doMobileAppTeacherCreateGrowth(){
        include_once 'inc/app/school/teacher/more/growth/create.php';
    }
    /**老师  成长手册列表**/
    public function doMobileAppTeacherGrowthList(){
        include_once 'inc/app/school/teacher/more/growth/list.php';
    }
    /**老师  成长手册学生列表**/
    public function doMobileAppTeacherGrowthStudentList(){
        include_once 'inc/app/school/teacher/more/growth/student.php';
    }
    /**老师  成长手册学生的点评**/
    public function doMobileAppTeacherGrowthStudentComment(){
        include_once 'inc/app/school/teacher/more/growth/studentComment.php';
    }
    /**老师  获取学校或者家里对学生的评价**/
    public function doMobileAppTeacherGetGrowthStudentComment(){
        include_once 'inc/app/school/teacher/more/growth/getStudentComment.php';
    }
    /**老师  成长手册的评语库管理**/
    public function doMobileAppTeacherGrowthCommentManagement(){
        include_once 'inc/app/school/teacher/more/growth/comment.php';
    }
    /**老师的ajax提交操作**/
    public function doMobileAppTeacherAjax(){
        include_once 'inc/app/school/teacher/ajaxSub.php';
    }
    /***************老师中心 END********************/
    /***************课程 START********************/

    /**课程的ajax提交操作**/
    public function doMobileAppCourseAjax(){
        include_once 'inc/app/school/course/ajaxSub.php';
    }
    /**课程大纲**/
    public function doMobileAppCourseOutline(){
        include_once 'inc/app/school/course/outline.php';
    }
    /**课程学生列表**/
    public function doMobileAppCourseStudent(){
        include_once 'inc/app/school/course/student.php';
    }
    /**固定课程的课程安排详情**/
    public function doMobileAppCourseTimetable(){
        include_once 'inc/app/school/course/timetable.php';
    }
    /***************课程 END*******************/
    /**动态的ajax提交操作**/
    public function doMobileAppNewsAjax(){
        include_once 'inc/app/school/common/NewsAjax.php';
    }
    /******************聊天 START**********************/
    /**聊天的ajax请求**/
    public function doMobileAppChatAjax(){
        include_once 'inc/app/school/news/chatAjax.php';
    }
    /**聊天列表**/
    public function doMobileAppChat(){
        include_once 'inc/app/school/news/chatList.php';
    }
    /**聊天窗口**/
    public function doMobileAppChatWindow(){
        include_once 'inc/app/school/news/chatWindow.php';
    }
    /******************聊天 END**********************/
    /** 登陆注册 start**/
    /**用户注册**/
    public function doMobileAppRegister(){
        include_once 'inc/app/login/register.php';
    }
    /**用户登陆**/
    public function doMobileAppLogin(){
        include_once 'inc/app/login/login.php';
    }
    /** 登陆注册 end**/
    /******************APP接口连接 end********************/
	// 载入逻辑方法
	private function getLogic($_name, $type = "web", $auth = true) {
		global $_W, $_GPC;
		if ($type == 'web') {
            include_once 'inc/func/list.php';
			checkLogin ();  //检查登陆
			if($_GPC['schoolid']){
				get_language($_GPC['schoolid']);
				$language = $_W['lanconfig'][$_GPC['do']];
			}
			include_once 'inc/web/' . strtolower ( substr ( $_name, 5 ) ) . '.php';
		} else if ($type == 'mobile') {
			 if ($auth) {
				  include_once 'inc/func/isauth.php';
			 }
			get_language($_GPC['schoolid']);
			$language = $_W['lanconfig'][$_GPC['do']];
			include_once 'inc/mobile/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
		} else if ($type == 'func') {
			include_once 'inc/func/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
		}
	}

	//定义mobile common 接入方法
	private function getLogicmc($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		mload()->model('read');
		$unread = check_unread($_SESSION['user']);
		if ($type == 'mobile') {
			 if ($auth) {
				  include_once 'inc/func/isauth.php';
			  }
			session_start();
			get_language($_GPC['schoolid']);
			$language = $_W['lanconfig'][$_GPC['do']];
			include_once 'inc/mobile/common/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
			include_once $this->template('loading');	
		}
	}

	private function getLogicms($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		mload()->model('read');
		$unread = check_unread($_SESSION['user']);
		if ($type == 'mobile') {
			 if ($auth) {
				  include_once 'inc/func/isauth.php';
			  }
			session_start();
			get_language($_GPC['schoolid']);
			$language = $_W['lanconfig'][$_GPC['do']];
			include_once 'inc/mobile/student/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
			if($_name != 'doMobileSbjq' || $_name != 'doMobileSnoticelist' || $_name != 'doMobileSzjhlist' || !preg_match('/ajax/i', $name) || !preg_match('/list/i', $name) ){
				include_once $this->template('loading');
			}
		}
	}

    private function getLogicmt($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		if ($type == 'mobile') {
			if ($auth) {
				include_once 'inc/func/isauth.php';
			}
			get_language($_GPC['schoolid']);
			$language = $_W['lanconfig'][$_GPC['do']];
			include_once 'inc/mobile/teacher/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
			if($_name != 'doMobileBjq' || $_name != 'doMobileNoticelist' || $_name != 'doMobileZuoyelist' || !preg_match('/ajax/i', $name) ){
				include_once $this->template('loading');
			}
		}
	}
	
	private function getLogicheck($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		if ($type == 'mobile') {
			include_once 'inc/mobile/' . strtolower ( substr ( $_name, 8 ) ) . '.php';
		}
	}

	// 载入逻辑方法
	private function getNewManagerLogic($_name, $type = "web", $auth = false) {
		global $_W, $_GPC;
		if ($type == 'web') {
            include_once 'inc/func/newlist.php';
			checkLogin ();  //检查登陆
			include_once 'inc/web/' . strtolower ( substr ( $_name, 5 ) ) . '.php';
		}
	}

    public function doWebLoginctrl() {
        include_once 'inc/web/loginctrl.php';
    }
    public function doWebLanset() {
        include_once 'inc/web/lanset.php';
    }
    public function doWebUpgrade() {
        include_once 'inc/web/upgrade.php';
    }
	
	public function doWebIndexajax() {
		include_once 'inc/web/indexajax.php';
	}
	public function doWebExecl_input() {
		include_once 'inc/web/execl_input.php';
	}
    public function doWebFenzu() {
        include_once 'inc/web/fenzu.php';
    }

    public function doWebArea() {
        include_once 'inc/web/area.php';
    }	
	
    public function doWebType() {
        include_once 'inc/web/type.php';
    }	

    public function doWebManager() {
        include_once 'inc/web/manager.php';
    }

	public function doWebCity() {
		include_once 'inc/web/city.php';
	}

	public function doWebBanners() {
		include_once 'inc/web/banners.php';
	}

    public function doWebQuery() {
        include_once 'inc/web/query.php';
    }
    public function doWebManger_apps() {
        include_once 'inc/web/manger_apps.php';
    }	
    public function doWebBasic() {
        include_once 'inc/web/basic.php';
	}
	/*****************独立后台登陆单独页面入口 START*******************/
	public function doWebNewType() {
        $this->getNewManagerLogic ( __FUNCTION__, 'web' );
    }
	
	public function doWebNewSchool() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewArea() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewCity() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewManager() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewFenzu() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewBanners() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewComad() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}
	public function doWebNewGuid() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewComload() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewLoginctrl() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewBinding() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewSensitive() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNewLanset() {
		$this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNew_Manger_apps() {
        $this->getNewManagerLogic ( __FUNCTION__, 'web' );
	}
	/*****************独立后台登陆单独页面入口 END*******************/

    public function doWebRefund() {
        include_once 'inc/web/refund.php';
    }
	
    public function doWebGuid() {
        include_once 'inc/web/guid.php';
    }	
	
	public function doWebComad() {
		include_once 'inc/web/comad.php';
	}
	
	public function doWebSms() {
		include_once 'inc/web/sms.php';
	}

	public function doWebBinding() {
		include_once 'inc/web/binding.php';
	}
	public function doWebSensitive() {
		include_once 'inc/web/sensitive.php';
	}	

	public function doWebComload() {
		include_once 'inc/web/comload.php';
	}	
	
	public function doMobileCheckjl() {
		global $_GPC, $_W;		  
		include_once 'inc/mac/checkjl.php';
	}


	
	public function doMobileCheckxz() {
		global $_GPC, $_W;
		include_once 'inc/mac/checkxz.php';
	}
	
	public function doMobileChecktask() {
		global $_GPC, $_W;
		include_once 'inc/func/task.php';
	}
	public function doMobileApcheckdaily() {
		global $_GPC, $_W;
		include_once 'inc/func/apcheckdaily.php';
	}
	public function doMobileHxyport() {
		global $_GPC, $_W;
		include_once 'inc/func/hxyport.php';
	}

	public function doMobileCheckym() {
		global $_GPC, $_W;
		include_once 'inc/mac/checkym.php';
	}
	
	public function doMobileCheckabb() {
		global $_GPC, $_W;
		include_once 'inc/mac/checkabb.php';
	}

	public function doMobileCheckhx() {
		global $_GPC, $_W;
		include_once 'inc/mac/checkhx.php';
	}	
	
	public function doMobileCheckwn() {
		global $_GPC, $_W;
		include_once 'inc/mac/checkwn.php';
	}

    public function doMobileCheckwt() {
        global $_GPC, $_W;
        include_once 'inc/mac/checkwt.php';
    }

    public function doMobileCheckzb() {
        global $_GPC, $_W;
        include_once 'inc/mac/checkzb.php';
    }
	public function doMobileCash() {
		global $_GPC, $_W;
		include_once 'inc/func/cash.php';
	}
	public function doMobileOpenid() {
		global $_GPC, $_W;
		include_once 'inc/func/openid.php';
	}
	public function doMobileCommon_newpay() {
        include_once 'inc/mobile/common_newpay.php';
    }
    public function doMobileScplforxs() {
		global $_GPC, $_W;
		include_once 'inc/func/isauth.php';
		include_once 'inc/mobile/student/scplforxs.php';		
	}	
	// ====================== 讯贞新增 =====================
	public function doWebXz_device() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebRemote() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}	
	
 	public function doMobileXz_device() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}	
		
	// ====================== Web =====================
    public function doWebHelp() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
	// 学校管理
	public function doWebSchool() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
    public function doWebQrlist() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }	
	
	public function doWebPoints() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebMalladd() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebMallorder() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebTemplate() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebPermiss() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebCreates() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}	
	
	// 分类管理
	public function doWebSchoolset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	// 分类管理
	public function doWebSemester() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 教师管理
	public function doWebAssess() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 教师评分
	public function doWebGrade() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 学生管理
	public function doWebStudents() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 成绩查询
	public function doWebChengji() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebRemind() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

    // 课程安排
	public function doWebKecheng() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 课表安排
	public function doWebKcbiao() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

    // 公立课表
    public function doWebTimetable () {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

	// 课程预约
	public function doWebSubscribe() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 食谱安排
	public function doWebCookBook() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	// 首页导航
	public function doWebNave() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	//班级管理
	public function doWebTheclass() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	//成绩管理
	public function doWebScore() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	//评分项目
	public function doWebPfxm() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	//余额/国家补助消费记录
	public function doWebYuecostlog() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

 

	//科目管理
	public function doWebSubject() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

    //时段管理
	public function doWebTimeframe() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	//星期管理
	public function doWebWeek() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	//教师分组
	public function doWebJsfz() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	//访问事由
	public function doWebVisireason() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	//Lee作业写入
	public function doWebWjxr() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
		//Lee作业编辑
	public function doWebZybj() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
    //排课设置
    public function doWebCourseSort () {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

	public function doWebBanner() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebApps() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
    public function doWebCook() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
    //forSUTELIST
    public function doWebBaoming() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    public function doWebArticle() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    public function doWebNews() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    public function doWebWenzhang() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

    public function doWebBjquan() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

	public function doWebCost() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebTestforlee() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebPayall() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebPhotos() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebNotice() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebSignup() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebCheck() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebChecklog() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebCardlist() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebstart() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebShoucelist() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebShouceset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebAllcamera() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

	public function doWebGongkaike() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	// 课程设置
	public function doWebKcset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebGkkpjxt() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebGkkpjtj() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebShowgkkpj() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebShowpjdetail() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebGroupactivity() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebZdytest() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebGasignup() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebHouseorder() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebHorecord() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebCoursetype() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebKcyy() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebKcsign() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebEditaddr() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
    public function doWebYzxx() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
    public function doWebKcpingjiashow() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }	
    public function doWebChongzhi() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
	public function doWebMimax() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebSendmsg_muti() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebKcallstusign() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebCheckdateset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebCheckdatedetail() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebChecktimeset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebApartmentset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebAproomset() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebApcheck() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebBooksborrow() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	public function doWebBooksrecord() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebApcheckall() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebPrinter() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebPrintlog() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebTeascore() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebTscoreobject() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebStudentscore() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}

    public function doWebBjscore() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }
	
	public function doWebBuzhu() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebReview() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebUploadsence() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebUpsencerecord() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebNewapcheckall() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}
	
	
	#访客功能
	public function doWebVisitors() {
		$this->getLogic ( __FUNCTION__, 'web' );
	}



    public function doWebStuovertime() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }


    public function doWebSendmsgbyall() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

	//公物管理
	public function doWebAssetsmanager() {
        $this->getLogic ( __FUNCTION__, 'web' );
	}
	
	//公物领用
	public function doWebAssetsuselog() {
        $this->getLogic ( __FUNCTION__, 'web' );
	}
	
	//公物维修
	public function doWebAssetsfixlog() {
        $this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebRoomreservelog() {
        $this->getLogic ( __FUNCTION__, 'web' );
	}
	
	public function doWebYuerefound() {
        $this->getLogic ( __FUNCTION__, 'web' );
    }

	// ====================== FUNC =====================
	public function doMobileAuth() {

		$this->getLogic ( __FUNCTION__, 'func' );
	}
    // ====================== HOOK=====================
	public function doMobileHookcom() {
		global $_W, $_GPC;
		include_once 'inc/func/isauth.php';
		get_language($_GPC['schoolid']);
		$usertype = 'common';
		include $this->template('hook');
	}
	public function doMobileHookstu() {
		global $_W, $_GPC;
		include_once 'inc/func/isauth.php';
		get_language($_GPC['schoolid']);
		$usertype = 'student';
		include $this->template('hook');
	}
	public function doMobileHooktea() {
		global $_W, $_GPC;
		include_once 'inc/func/isauth.php';
		get_language($_GPC['schoolid']);
		$usertype = 'teacher';
		include $this->template('hook');
	}
	public function doWebHook() {
		global $_W, $_GPC;
		include_once 'inc/func/list.php';
		include $this->template('hook');
	}
	
	// ====================== HOOKVIS=====================
    public function doMobileHookviscom() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'common';
        include $this->template('hookvis');
    }
    public function doMobileHookvistea() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'teacher';
        include $this->template('hookvis');
    }


    // ====================== HOOKBIGDATA=====================
    public function doMobileHookbigdatacom() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'common';
        include $this->template('hookbigdata');
    }
    public function doMobileHookbigdatatea() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'teacher';
        include $this->template('hookbigdata');
    }


    public function doMobileHookbigdatastu() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'student';
        include $this->template('hookbigdata');
    }

    public function doWebHookbigdata() {
        global $_W, $_GPC;
        include_once 'inc/func/list.php';
        include $this->template('hookbigdata');
	}
	


    // ====================== HOOKASSETS=====================
    public function doMobileHookassetscom() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'common';
        include $this->template('hookassets');
    }
    public function doMobileHookassetstea() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'teacher';
        include $this->template('hookassets');
    }


    public function doMobileHookassetsstu() {
        global $_W, $_GPC;
        include_once 'inc/func/isauth.php';
        get_language($_GPC['schoolid']);
        $usertype = 'student';
        include $this->template('hookassets');
    }

    public function doWebHookassets() {
        global $_W, $_GPC;
        include_once 'inc/func/list.php';
        include $this->template('web/hookassets');
    }

	
    // ====================== Mobile=====================
 	// 公共部分	
	public function doMobileQkbinding() { //快速绑定入口
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}
	
	public function doMobileBinding() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}	

	public function doMobileComajax() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}
	
	public function doMobileIndexajax() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}
	
	public function doMobileTecherajax() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}	

	public function doMobileBjqajax() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}

    public function doMobileDongtaiajax() {
		$this->getLogic ( __FUNCTION__, 'mobile' );
	}

	public function doMobileWapindex() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}

	public function doMobilePayajax() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileBdajax() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileBangding() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileNewbding() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileXsqj() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}
	public function doMobilekcajax() {
		$this->getLogic ( __FUNCTION__, 'mobile', true );
	}
	
	

	// ====================== Mobile Common=====================
	public function doMobileGuid() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileShowhomework() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileCooklist() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileCook() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileDetail() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileJianjie() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileKc() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileKcinfo() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileKcdg() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileZhaosheng() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileNewslist() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileNew() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileTeachers() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileTcinfo() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSignup() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileSignupjc() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSignuplist() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	#添加访客
	public function doMobileVisitors() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	#访客记录
	public function doMobileVisitorslist() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	#访客结果返回
	public function doMobileVisitorsjc() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileGoodstemp() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}

	
	public function doMobileHorder() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileHodetail() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileNewcoursedetail() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileYystcom() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileYzxx() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	
	
	public function doMobileMimax() {
		$this->getLogicmc ( __FUNCTION__, 'mobile', true );
	}
	// ====================== Mobile Student=====================
	public function doMobileSzjhlist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileAssteach() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileChecklogDetail() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}	
	
	public function doMobileSchoolbus() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileWxsign() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}	
	
	public function doMobileCalendar() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}	
	
	public function doMobileSzjh() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileGopay() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileTimetable() {
        $this->getLogicms ( __FUNCTION__, 'mobile', true );
    }

	public function doMobileVideo() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileSxcfb() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileChaxun() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileChengji() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileUser() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileMyShareList() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileMyfamily() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}	
	
    public function doMobileUseredit() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileMysaleinfo() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileMyinfo() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileJiaoliu() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileMytecher() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileMyclass() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSnoticelist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSnotice() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSzuoye() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSzuoyelist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSbjqfabu() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSbjq() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileOrder() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileMykcinfo() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileMykcdetial() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileObinfo() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSxc() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSxclist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileCheckcard() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileChecklog() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileCallbook() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSlylist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSduihua() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}	

    public function doMobileScforxs() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileSclistforxs() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileLeavelist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileAllcamera() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileCamera() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSgoodslist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSgoodsdetail() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSgetorder() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSeditorder() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSmallpay() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSgkkpjjl() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSignrecord() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileGalist() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileGadetail() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileShrecord() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSsetaddress() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSyzxx() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileKcpingjia() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileChongzhi() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileMysharedetail() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSmyscore() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileYuecostlog() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileStuinfocard() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSmychecklog() {
		$this->getLogicms ( __FUNCTION__, 'mobile', true );
	}

	// ====================== Mobile Teacher =====================
	//for master
    public function doMobileTallcamera() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTcamera() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileClasschecklog() { //与狼共舞
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobilePaystat() { //与狼共舞
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileMallpay() { //与狼共舞
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileStulist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileRehomework() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileGetorder() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileEditorder() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
	public function doMobileGoodslist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileNopoint() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	 public function doMobileGoodsdetail() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileSetaddress() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileShangcheng() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
    public function doMobileQuestionnaire() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileQuestatistics() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTcalendar() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileWxsignforteacher() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileLeavelistforteacher() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileCheckcardforteacher() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
    public function doMobileTlylist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileSign() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
    public function doMobileSignlist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
    public function doMobileTduihua() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
    public function doMobileTmssage() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTmcomet() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileSmssage() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileSmcomet() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileMnotice() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileMnoticelist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileMfabu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileQingjia() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileZfabu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileBjqfabu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileMyschool() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileBjq() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileZuoye() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileZuoyelist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileFabu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileNoticelist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileNotice() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTjiaoliulist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTjiaoliu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileXclist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileXc() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileXcfb() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileBmlist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileBm() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTchecklog() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
    public function doMobileJschecklog() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTongxunlu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTzjhlist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTzjh() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTzjhadd() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileShoucelist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileShoucepl() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileShouce() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileShoucepy() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileShouceadd() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileShoucepygl() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileShoucepyglad() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
	
    public function doMobileRecod() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobilePointdetail() { 
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobilePointrule() { 
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileGkklist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileGkkdetail() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
	public function doMobileGkkadd() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileGkkpjjl() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	
	public function doMobileTqzkh() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}	

	public function doMobileTKpi() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileTGrade() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	//**************2018.2.26(Lee)**************
	public function doMobileCreatetodo() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileTodolist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	//**************2018.4.1(Lee)**************
	public function doMobileCyylist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileCyydetail() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTmycourse() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTmykcinfo() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	//学生补签课程
	public function doMobileTxsbqkc() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTqrjsqd() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTkcsignall() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTkcsigndetail() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTkcsignks() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	public function doMobileTyzxx() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	public function doMobileTkcstu() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTmyscore() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTscoreall() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTstuscore() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}


	
	public function doMobileMyinfodetail() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTstuapinfo() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTsturoominfo() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTqingjiaall() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileChengjireview() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTsencerecord() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTuploadsence() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
	public function doMobileTcreatesence() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
    public function doMobileTeatimetable() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
    }

	public function doMobileTremind() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}
	
    public function doMobileGkkpingjia() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
    }

    public function doMobileGkkpjshare() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
    }

    public function doMobileChengjidetail() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
    }
	#预约信息
	public function doMobileTvisitors() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

    public function doMobileTchecklogdetail() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
    }
    public function doMobileTbjscore() {
        $this->getLogicmt ( __FUNCTION__, 'mobile', true );
    }
	//查看学生的所有考勤记录
	public function doMobileTallstuchecklog() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	//公物借用列表
	public function doMobileAssetstake() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	//公物借用列表
	public function doMobileAssetslist() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

	//寝室未按时归寝统计
	public function doMobileOntimeap() {
		$this->getLogicmt ( __FUNCTION__, 'mobile', true );
	}

    public function set_tabbar($action, $schoolid, $role, $isfounder) {




		$logo = pdo_fetch("SELECT is_openht FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
		$actions_titles = $this->actions_titles;		
		if ($isfounder || $role == 'owner' ){
			$actions_titles = $this->actions_titles11;
			if(keep_sk77()){
                $actions_titles['theclass'] = '项目管理';
			}
			if(is_TestFz()){
                $actions_titles['score'] = '考试管理';
                $actions_titles['pfxm'] = '评分项目';
			}
			if(is_showpf()){
				$actions_titles['tscoreobject'] = '评分项目';
			}
            if(vis()){
                $arr_insert = array(
                    'visireason' => '访客事由',
                );
                $actions_titles['visireason']= '访客事由';
            }
		}

		if ($role == 'manager' && $logo['is_openht'] == 1){
			$actions_titles = $this->actions_titles22;		
		}
		
        $html = '<ul class="nav nav-tabs">';
        foreach ($actions_titles as $key => $value) {
            $url = $this->createWebUrl($key, array('op' => 'display', 'schoolid' => $schoolid));
            $html .= '<li class="' . ($key == $action ? 'active' : '') . '"><a href="' . $url . '">' . $value . '</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }
	
    public $actions_titles = array();
    public $actions_titles22 = array();
    public $actions_titles2 = array( );
    function __construct(){
        session_start();
	    global $_W, $_GPC;
	    
	    $tid = $_W['tid']?$_W['tid']:$_W['role'];
        if(empty($tid) || ($tid != 'founder' && $tid !='owner' )){
            $tid = $_SESSION['tid'];
        }
        $schoolid = $_GPC['schoolid'];
	   if(!empty($tid) && !empty($_GPC['schoolid'])){
		    $schoolid = $_GPC['schoolid'];
			if(IsHasQx($tid,1000211,1,$schoolid)){
				$this->actions_titles['semester'] = NJNAMEGL;
				$this->actions_titles22['semester'] = NJNAMEGL;
			}
			if(IsHasQx($tid,1000221,1,$schoolid)){
			    if(keep_sk77()){
                    $this->actions_titles['theclass'] = '项目管理';
                    $this->actions_titles22['theclass'] = '项目管理';
                }else{
                    $this->actions_titles['theclass'] = '班级管理';
                    $this->actions_titles22['theclass'] = '班级管理';
                }

			}

			if(IsHasQx($tid,1000231,1,$schoolid)){
				$this->actions_titles['score'] = '期号管理';
				$this->actions_titles22['score'] = '期号管理';
			}
			if(IsHasQx($tid,1000241,1,$schoolid)){
				$this->actions_titles['coursetype'] ='课程类型';
				$this->actions_titles22['coursetype'] ='课程类型';
			}
			if(IsHasQx($tid,1000251,1,$schoolid)){
				$this->actions_titles['editaddr'] = '教室管理';
				$this->actions_titles22['editaddr'] = '教室管理';
			}
			if(IsHasQx($tid,1000261,1,$schoolid)){
				$this->actions_titles['subject'] = '科目管理';
				$this->actions_titles22['subject'] = '科目管理';
			}
			if(IsHasQx($tid,1000271,1,$schoolid)){
				$this->actions_titles['timeframe'] = '时段管理';
				$this->actions_titles22['timeframe'] = '时段管理';
			}
			if(vis()){
               if(IsHasQx($tid,1004101,1,$schoolid)){
                   $this->actions_titles['visireason'] = '访客事由';
                   $this->actions_titles22['visireason'] = '访客事由';
               }
			}
			if(IsHasQx($tid,1000281,1,$schoolid)){
				$this->actions_titles['week'] = '星期管理';
				$this->actions_titles22['week'] = '星期管理';
			}
			if(is_showpf()){
				if(IsHasQx($tid,1000291,1,$schoolid)){
					$this->actions_titles['tscoreobject'] = '评分项目';
					$this->actions_titles22['tscoreobject'] = '评分项目';
				}	
			}
			$this->actions_titles22['jsfz'] = '教师分组';
			$this->actions_titles22['permiss'] = '帐号管理';
			
			if(IsHasQx($tid,1001401,1,$schoolid)){
				$this->actions_titles2['article'] = '校园公告';
			}
			if(IsHasQx($tid,1001411,1,$schoolid)){
				$this->actions_titles2['news'] = '校园新闻';
			} 
			if(IsHasQx($tid,1001421,1,$schoolid)){
				$this->actions_titles2['wenzhang'] = '精选文章';
			}
	 	}
	}
	
    public $actions_titles11 = array(
	    'semester'   => NJNAMEGL,
	    'theclass'   => '班级管理',
	    'score'      => '期号管理',
	    'coursetype' => '课程类型',
	    'editaddr'   => '教室管理',
	    'subject'    => '科目管理',
	    'timeframe'  => '时段管理',
	    'week'       => '星期管理',
	    'jsfz'       => '教师分组',
	    'permiss'    => '帐号管理',
	    'template'   => '模板管理',
    );


    public function set_tabbar2($action, $schoolid) {
	    
        $actions_titles2 = $this->actions_titles2;
        $html = '<ul class="nav nav-tabs">';
        foreach ($actions_titles2 as $key => $value) {
            $url = $this->createWebUrl($key, array('op' => 'display', 'schoolid' => $schoolid));
            $html .= '<li class="' . ($key == $action ? 'active' : '') . '"><a href="' . $url . '">' . $value . '</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function showMessageAjax($msg, $code = 0){
        $result['code'] = $code;
        $result['msg'] = $msg;
        message($result, '', 'ajax');
    }

    protected function exportexcel($data = array(), $title = array(), $filename = 'report') {
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=" . $filename . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
        //导出xls 开始
        if (!empty($title)) {
            foreach ($title as $k => $v) {
                $title[$k] = iconv("UTF-8", "GBK", $v);
            }
            $title = implode("\t", $title);
            echo "$title\n";
        }
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                foreach ($val as $ck => $cv) {
                    $data[$key][$ck] = iconv("UTF-8", "GBK", $cv);
                }
                $data[$key] = implode("\t", $data[$key]);

            }
            echo implode("\n", $data);
        }
    }
	public function weixin_fans_group($url, $data) {
		global $_W, $_GPC;
		$weid = $_W['uniacid'];
		load()->classs('weixin.account');
		$access_token = WeAccount::token();
		$url = sprintf($url, $access_token);
		load()->func('communication');
		$response = ihttp_request($url, $data);
		if (is_error($response)) {
			return error(-1, "访问公众平台接口失败, 错误: {$response['message']}");
		}
		$result = @json_decode($response['content'], true);
		if (empty($result)) {
		} elseif (!empty($result['errcode'])) {
			if($result['errcode'] == 45157){
				message("标签名非法，请注意不能和其他标签重名");
			}
			if($result['errcode'] == 45158){
				message("标签名长度超过30个字节");
			}
			if($result['errcode'] == 45056){
				message("创建的标签数过多，请注意不能超过100个,如有特殊需求，请向微信团队申请");
			}			
			if($result['errcode'] == -1){
				message("微信服务器繁忙，请稍后再试");
			}			
		}
		return $result;
	}

	public function createImageUrlCenter($qr_file,$schoolid) {
		global $_W, $_GPC;
		$param = pdo_fetch("select * from " . tablename($this->table_qrset) . " where id = :id", array(':id' => 1));
		$school = pdo_fetch("select logo,title from " . tablename($this->table_index) . " where id = :id ", array(':id' => $schoolid));
		load()->func('file');
		mkdirs('../attachment/images/');
		$target_file = "../attachment/images/". time() . random(16) . ".jpg";

		if (!empty($school['logo'])) {
			$src_file = tomedia($school['logo']);
		} else {
			message('抱歉，'.$school['title'].'没有设置LOGO,请先到学校管理编辑上传学校的LOGO');
		}
		$this->resizeImage($this->imagecreate($qr_file), intval($param['logoqrwidth']), intval($param['logoqrheight']), $target_file);
		list($qrWidth, $qrHeight) = getimagesize($target_file);
		$centerleft = ($qrWidth - intval($param['logowidth'])) / 2;
		$centertop = ($qrHeight - intval($param['logoheight'])) / 2;
		$this->mergeImage($target_file, $src_file, $target_file, array('left' => $centerleft, 'top' => $centertop, 'width' => $param['logowidth'], 'height' => $param['logoheight']));
		return $target_file;
	}
	
	public function createImageUrlCenterForUser($qr_file,$sid,$tid,$schoolid) {
		global $_W, $_GPC;
		$param = pdo_fetch("select * from " . tablename($this->table_qrset) . " where id = :id", array(':id' => 1));
		if($tid == 0){
			$student = pdo_fetch("select icon from " . tablename($this->table_students) . " where id = :id ", array(':id' => $sid));
			if(!$student['icon']){
				$school = pdo_fetch("select spic,logo from " . tablename($this->table_index) . " where id = :id ", array(':id' => $schoolid));
				$src_file = tomedia($school['spic']);
				if($sid == 9999999999){
					$src_file = tomedia($school['logo']);
				}				
			}else{
				$src_file = tomedia($student['icon']);
			}
		}
		if($sid == 0){
			$techer = pdo_fetch("select thumb from " . tablename($this->table_teachers) . " where id = :id ", array(':id' => $tid));
			if(!$techer['thumb']){
				$school = pdo_fetch("select tpic from " . tablename($this->table_index) . " where id = :id ", array(':id' => $schoolid));
				$src_file = tomedia($school['tpic']);
			}else{
				$src_file = tomedia($techer['thumb']);
			}
		}		
		load()->func('file');
		mkdirs('../attachment/images/weixuexiao/');
		$target_file = "../attachment/images/weixuexiao/". time() . random(16) . ".jpg";
		$this->resizeImage($this->imagecreate($qr_file), intval($param['logoqrwidth']), intval($param['logoqrheight']), $target_file);
		list($qrWidth, $qrHeight) = getimagesize($target_file);
		$centerleft = ($qrWidth - intval($param['logowidth'])) / 2;
		$centertop = ($qrHeight - intval($param['logoheight'])) / 2;
		$this->mergeImage($target_file, $src_file, $target_file, array('left' => $centerleft, 'top' => $centertop, 'width' => $param['logowidth'], 'height' => $param['logoheight']));
		return $target_file;
	}	

	private function mergeImage($bg, $qr, $out, $param) {

		global $_W, $_GPC;
		load()->func('file');
		list($bgWidth, $bgHeight) = getimagesize($bg);
		list($qrWidth, $qrHeight) = getimagesize($qr);
		$bgImg = $this->imagecreate($bg);
		$qrImg = $this->imagecreate($qr);
		imagecopyresized($bgImg, $qrImg, $param['left'], $param['top'], 0, 0, $param['width'], $param['height'], $qrWidth, $qrHeight);
		ob_start();
		imagejpeg($bgImg, NULL, 100);
		$contents = ob_get_contents();
		ob_end_clean();
		imagedestroy($bgImg);
		imagedestroy($qrImg);

		file_write($out, $contents);

		//$fh = fopen($out, "w+");
		//fwrite($fh, $contents);
		//fclose($fh);
	}

	function resizeImage($im, $maxwidth, $maxheight, $path)	{
		$pic_width = imagesx($im);
		$pic_height = imagesy($im);
		if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
			if ($maxwidth && $pic_width > $maxwidth) {
				$widthratio = $maxwidth / $pic_width;
				$resizewidth_tag = true;
			}
			if ($maxheight && $pic_height > $maxheight) {
				$heightratio = $maxheight / $pic_height;
				$resizeheight_tag = true;
			}
			if ($resizewidth_tag && $resizeheight_tag) {
				if ($widthratio < $heightratio) $ratio = $widthratio; else $ratio = $heightratio;
			}
			if ($resizewidth_tag && !$resizeheight_tag) $ratio = $widthratio;
			if ($resizeheight_tag && !$resizewidth_tag) $ratio = $heightratio;
			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;
			if (function_exists('imagecopyresampled')) {
				$newim = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
			} else {
				$newim = imagecreate($newwidth, $newheight);
				imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
			}
			imagejpeg($newim, $path);
			imagedestroy($newim);
		} else {
			imagejpeg($im, $path);
		}
	}

	private function imagecreate($bg) {
		$bgImg = @imagecreatefromjpeg($bg);
		if (FALSE == $bgImg) {
			$bgImg = @imagecreatefrompng($bg);
		}
		if (FALSE == $bgImg) {
			$bgImg = @imagecreatefromgif($bg);
		}
		return $bgImg;
	}
	
	public function doMobilePay() {
		global $_W, $_GPC;
        checkauth();
		$schoolid = intval($_GPC['schoolid']);
		$openid = $_W['openid'];
		$cose = $_GPC ['cose'];
		$wxpayid = intval($_GPC ['wxpay']);
        //构造支付请求中的参数
        $params = array(
            'tid' => $wxpayid,      //充值模块中的订单号，此号码用于业务模块中区分订单，交易的识别码
            'ordersn' => time(),  //收银台中显示的订单号
            'title' => '在线缴费',          //收银台中显示的标题
            'fee' => $cose,
            //'user' => $_W['member']['uid'],     //付款用户, 付款的用户名(选填项)
        );
        //调用pay方法
        include $this->template('students/pay');
	}
    /**
     * 支付后触发这个方法
     * @param $params
     */
	public function payResult($params) {
		global $_W, $_GPC;
		$orderid = $params['tid'];
        $wxpay = pdo_fetch("SELECT * FROM " . tablename($this->table_wxpay) . " WHERE id = '{$orderid}'");
		if ($params['result'] == 'success' && $params['from'] == 'notify') {
			$log = pdo_fetch("SELECT tag FROM " . tablename('core_paylog') . " where tid = :tid ", array(':tid' => $orderid));
			$tag = iunserializer($log['tag']);
			$uniontid = $tag['transaction_id'];
			pdo_update($this->table_wxpay, array('status' => 2), array('id' => $orderid));
			pdo_update($this->table_order, array('status' => 2, 'uniontid' => $uniontid, 'paytime' => time(), 'paytype' => 1, 'pay_type' => $params['type']), array('id' => $wxpay['od1']));
			$order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " where id = :id ", array(':id' => $wxpay['od1']));
			$cose = $order['cose'];
			if ($params['fee'] != $cose) {
				exit('支付失败');
			}
			//商城订单
			if(!empty($order['morderid']) && $order['type'] == 6 ){
				$mallinfo = pdo_fetch("SELECT mallsetinfo FROM " . tablename($this->table_index) . " WHERE :schoolid = id AND weid=:weid ", array(':schoolid' => $order['schoolid'],':weid'=>$order['weid'] ));
				$mallinfoDE = iunserializer($mallinfo['mallsetinfo']);
				$auto = $mallinfoDE['isAuto'];
				if($auto == 1  ){
					pdo_update($this->table_mallorder, array('status' => 3), array('id' => $order['morderid']));
				}else{
					pdo_update($this->table_mallorder, array('status' => 2), array('id' => $order['morderid']));
				}
				$teaid = pdo_fetch("SELECT * FROM " . tablename($this->table_mallorder) . " where id = :id ", array(':id' => $order['morderid']));
				//教师订单
				if(!empty($teaid['tid']) && empty($teaid['sid'])){
					$teacher = pdo_fetch("SELECT point FROM " . tablename($this->table_teachers) . " where id = :id ", array(':id' => $teaid['tid']));
					if($teacher['point'] == $teaid['allpoint']){
						$new_point = 0 ;
					}else{
						$new_point = intval($teacher['point']) - intval($teaid['allpoint']);
					}
					pdo_update($this->table_teachers, array('point' => $new_point ), array('id' => $teaid['tid']));
				//学生订单
				}elseif(empty($teaid['tid'] ) && !empty($teaid['sid'])){
					$JFinfo =  pdo_fetch("SELECT Is_point,Cost2Point FROM " . tablename($this->table_index) . " WHERE :schoolid = id AND weid=:weid ", array(':schoolid' => $order['schoolid'],':weid'=>$order['weid'] ));
					if($JFinfo['Is_point'] ==1){
						$students = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " where id = :id ", array(':id' => $teaid['sid']));
						$money = $order['cose'];
						$Cost2Point = $JFinfo['Cost2Point'];
						$addpoint = intval($money * $Cost2Point);
						if($students['points'] == $teaid['allpoint']){
							$new_point = 0 + $addpoint;
						}else{
							$new_point = intval($students['points']) - intval($teaid['allpoint']) + $addpoint;
						}
						pdo_update($this->table_students, array('points' => $new_point ), array('id' => $teaid['sid']));
					}
				}
			}

			//课程订单
			if($order['type'] == 1){
				//新增学生
				mload()->model('kc');
				$shareset_t = pdo_fetch("SELECT shareset FROM " . tablename($this->table_index) . " WHERE :schoolid = id AND weid=:weid ", array(':schoolid' => $order['schoolid'],':weid'=>$order['weid'] ));
				$shareset = unserialize($shareset_t['shareset']);
				if($order['tempsid'] != 0){
					$tempstu = pdo_fetch("SELECT * FROM " . tablename($this->table_tempstudent) . " where :id = id", array(':id' => $order['tempsid']));
					$randStr = str_shuffle('123456789');
       				$rand = substr($randStr,0,6);	
       				$nj_id = pdo_fetch("SELECT parentid FROM " . tablename($this->table_classify) . " where :id = id", array(':id' => $tempstu['bj_id']));
					$tempstudata = array(
						'schoolid' => $tempstu['schoolid'],
						'bj_id'=> $tempstu['bj_id'],
						'xq_id' => $nj_id['parentid'],
						'sex' => $tempstu['sex'],
						'createdate'=> time(),
						'seffectivetime' => time(),
						'code' => $rand,
						's_name' => $tempstu['sname'],
						'mobile'=> $tempstu['mobile'],
						'area_addr'=> $tempstu['adde'],
						'weid' => $tempstu['weid'],
					);
					pdo_insert($this->table_students,$tempstudata);
					$sid = pdo_insertid();
					pdo_update($this->table_students,array('keyid'=> $sid),array('id'=>$sid));
					$tempuinfo = array(
						'name' => '',
						'mobile'=> $tempstu['mobile']
					);
					$uinfo = serialize($tempuinfo);
					$userinsert = array(
						'sid' => $sid,
						'weid' => $tempstu['weid'],
						'schoolid' => $tempstu['schoolid'],
						'uid' => $tempstu['uid'],
						'openid' => $tempstu['openid'],
						'pard' => $tempstu['pard'],
						'userinfo' => $uinfo
					);
					pdo_insert($this->table_user,$userinsert);
					$userid_tostu = pdo_insertid();
					$into_stu = array();
					if($tempstu['pard'] == 2){
						$into_stu['mom'] = $tempstu['openid'];
						$into_stu['muserid'] = $userid_tostu;
						$into_stu['muid'] = $tempstu['uid']; 
					}
					if($tempstu['pard'] == 3){
						$into_stu['dad'] = $tempstu['openid'];
						$into_stu['duserid'] = $userid_tostu;
						$into_stu['duid'] = $tempstu['uid']; 
					}
					if($tempstu['pard'] == 4){
						$into_stu['own'] = $tempstu['openid'];
						$into_stu['ouserid'] = $userid_tostu;
						$into_stu['ouid'] = $tempstu['uid']; 
					}
					if($tempstu['pard'] == 5){
						$into_stu['other'] = $tempstu['openid'];
						$into_stu['otheruserid'] = $userid_tostu;
						$into_stu['otheruid'] = $tempstu['uid']; 
					}
					pdo_update($this->table_students,$into_stu,array('id'=>$sid));
					$into_order = array(
						'userid' => $userid_tostu,
						'sid' => $sid
					);
					pdo_update($this->table_order,$into_order,array('id'=>$order['id']));
					$order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " where id = :id ", array(':id' =>$order['id']));
				}
				//课时购买/续购
				$kcinfo =  pdo_fetch("SELECT overtimeday,FirstNum,kc_type FROM " . tablename($this->table_tcourse) . " where :id = id", array(':id' => $order['kcid']));
				if($order['ksnum'] >= 1 || $kcinfo['kc_type'] == 1){
					if($order['team_id'] >= 1){//队伍订单，处理满员情况写入课时购买表内
						$team = pdo_fetch("SELECT id,masterid FROM " . GetTableName('sale_team') . " where :id = id ", array(':id' => $order['team_id']));
						if(!empty($team)){
							$teamisfull = CheckTemIsFull($team['id']);
							if($teamisfull){
								SetTeamStuCour($order['kcid'],$team['masterid'],$order['ksnum'],$order['sale_type']);
							}
						}
					}else{
						$userinfo = pdo_fetch("SELECT sid,openid FROM " . tablename($this->table_user) . " where :id = id", array(':id' => $order['userid']));
						$ygks = pdo_fetch("SELECT ksnum,id FROM " . tablename($this->table_coursebuy) . " where kcid=:kcid AND :sid = sid", array(':kcid' => $order['kcid'],':sid'=>$userinfo['sid']));
						$overday = $kcinfo['overtimeday'];
						$overtime = 0;
						if($overday != 0 ){
							$overtime = strtotime(date("Y-m-d",time())) + 86399 + 86400*$overday;
						}
						if(!empty($ygks)){
							$newksnum = $ygks['ksnum'] + $order['ksnum'];
							$data_coursebuy = array(
								'ksnum'      => $newksnum,
								'overtime'  => $overtime
							);
							pdo_update($this->table_coursebuy,$data_coursebuy,array('id' => $ygks['id']));
						}else{
							$data_coursebuy = array(
								'weid'       => $order['weid'],
								'schoolid'   => $order['schoolid'],
								'userid'     => $order['userid'],
								'orderid'    => $order['id'],
								'sid'        => $userinfo['sid'],
								'kcid'       => $order['kcid'],
								'ksnum'      => $kcinfo['FirstNum'],
								'overtime'  => $overtime,
								'createtime' => time()
							);
							pdo_insert($this->table_coursebuy,$data_coursebuy);
						}
						SetFansSale($order['kcid'],$order['userid'],0);
						if($kcinfo['kc_type'] == 1){
							pdo_update(GetTableName('user',false), array('status' => 0), array('id' => $order['userid']));
							pdo_update(GetTableName('students',false), array('status' => 0), array('id' => $order['sid']));
							if($order['superior_tid'] >0){
								SetFansInfoByKc($order['kcid'],$userinfo['openid'],$order['userid'],$order['superior_tid'],$masteropenid,$masteruserid,1);
							}
						}
					}
				}
				$JFinfo=  pdo_fetch("SELECT Is_point,Cost2Point FROM " . tablename($this->table_index) . " WHERE :id = id ", array(':id' => $order['schoolid']));
				$student = pdo_fetch("SELECT points FROM " . tablename($this->table_students) . " where :id = id", array(':id' => $order['sid']));
				if($JFinfo['Is_point'] ==1){//课程购买赠送积分
					$money = $order['cose'];
					$Cost2Point = $JFinfo['Cost2Point'];
					$addpoint = $money * $Cost2Point;
					$costpoint = $order['spoint'];
					$oldpoint = $student['points'];
					$newpoint = $oldpoint - $costpoint + $addpoint;
				}else{
					$costpoint = $order['spoint'];
					$oldpoint = $student['points'];
					$newpoint = $oldpoint - $costpoint;
				}
				pdo_update($this->table_students, array('points' => $newpoint ), array('id' => $order['sid']));
				//分享增加积分、余额、课程课时
				if($shareset['is_share'] != 0 ){
				 	if($order['shareuserid'] != 0){
						$sharesid = pdo_fetch("SELECT sid FROM " . tablename($this->table_user) . " where :id = id", array(':id' => $order['shareuserid']));
				 		$student_share = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " where :id = id", array(':id' => $sharesid['sid']));
						$temp_student = array();
						//给分享源用户新增积分、余额、课时
						if($shareset['is_share'] == 1){
							//新增积分
							$AddJF = $shareset['addJF'];
							$oldJF = $student_share['points'];
							$newJF = $AddJF + $oldJF;
							//$temp_student['points'] = $newJF;
							pdo_update($this->table_students, array('points' => $newJF ), array('id' => $sharesid['sid']));
						}elseif($shareset['is_share'] == 2){
							//新增余额
							$AddYE = $shareset['addYE'];
							$oldYE = $student_share['chongzhi'];
							$newYE = $AddYE + $oldYE;
							//$temp_student['chongzhi'] = $newYE;
							pdo_update($this->table_students, array('chongzhi' => $newYE ), array('id' => $sharesid['sid']));
						}elseif($shareset['is_share'] == 3){
							//新增课时
							$AddKC = $order['kcid'];
							$AddKS = $shareset['addKS'];
							$kcinfo_share =  pdo_fetch("SELECT * FROM " . tablename($this->table_tcourse) . " where :id = id", array(':id' => $AddKC));
							$coursebuy =  pdo_fetch("SELECT ksnum,id FROM " . tablename($this->table_coursebuy) . " where kcid=:kcid AND :sid = sid", array(':kcid' => $AddKC,':sid'=>$sharesid['sid']));
							if(!empty($coursebuy)){
								$newksnum = $coursebuy['ksnum'] + $AddKS;
								if($newksnum > $kcinfo_share['AllNum']){
									$newksnum = $kcinfo_share['AllNum'];
								}
								pdo_update($this->table_coursebuy, array('ksnum' => $newksnum ), array('id' => $coursebuy['id']));
							}
						} 
					}
				}
				if(!empty($order['team_id'])){//处理订单归属队伍 (团购订单需在此处理)
					$team = pdo_fetch("SELECT * FROM " . GetTableName('sale_team') . " where :id = id ", array(':id' => $order['team_id']));
					if(!empty($team)){
						pdo_update(GetTableName('sale_team',false), array('is_sale' => 1), array('id' => $team['id']));
						pdo_update(GetTableName('sale_team',false), array('is_sale' => 1), array('kcid' => $team['kcid'],'userid' => $team['userid']));
						$teamisfull = CheckTemIsFull($team['id']);
						if($teamisfull){
							SetTeamStuStatus($team['masterid'],$order['sale_type']);
						}
					}
					$thisuser = pdo_fetch("SELECT openid FROM " . GetTableName('user') . " where :id = id ", array(':id' => $order['userid']));
					if($order['sale_type'] == 1){
						$this->sendMobilePttz($order['team_id'],$thisuser['openid']);
					}
					if($order['sale_type'] == 2){
						$this->sendMobileZltz($order['team_id'],$thisuser['openid']);
					}
				}
				if($order['new_stu'] == 1){//处理新增学生 直接购买的用户解锁
					pdo_update(GetTableName('user',false), array('status' => 0), array('id' => $order['userid']));
					pdo_update(GetTableName('students',false), array('status' => 0), array('id' => $order['sid']));
				}
				$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 5){//考勤卡续费
				$school = pdo_fetch("SELECT cardset FROM " . tablename($this->table_index) . " WHERE id = :id ", array(':id' => $wxpay['schoolid']));
				$chard = pdo_fetch("SELECT severend FROM " . tablename($this->table_idcard) . " WHERE id = :id ", array(':id' => $order['bdcardid']));
				$card = unserialize($school['cardset']);
					if($card['cardtime'] == 1){
						$severend = $card['endtime1'] * 86400 + $chard['severend'];
					}else{
						$severend = $card['endtime2'];
					}				
				pdo_update($this->table_idcard, array('severend' => $severend), array('id' => $order['bdcardid']));
				$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 8){//充值订单
				$sid = $order['sid'];
				$students = pdo_fetch("SELECT chongzhi FROM " . tablename($this->table_students) . " where :id = id", array(':id' =>$sid));
				$taocan = pdo_fetch("SELECT chongzhi FROM " . tablename($this->table_chongzhi) . " where :id = id", array(':id' =>$order['taocanid']));
				$new = $students['chongzhi'] + $taocan['chongzhi'];
				pdo_update($this->table_students,array('chongzhi'=>$new),array('id'=>$sid));
				$data_chongzhilog = array(
					'schoolid' 	=> $order['schoolid'],
					'weid'	   	=> $order['weid'],
					'sid'	   	=> $order['sid'],
					'yue_type' 	=> 2,
					'cost_type' => 1,
					'cost'	   	=> $taocan['chongzhi'],
					'costtime' 	=> $order['paytime'],
					'orderid'  	=> $order['id'], 
					'on_offline' => 1,
					'createtime' => time()
				);
				pdo_insert($this->table_yuecostlog,$data_chongzhilog);
				$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 9){//充电桩充值
				$sid = $order['sid'];
				$students = pdo_fetch("SELECT chargenum FROM " . tablename($this->table_students) . " where :id = id", array(':id' =>$sid));
				$new = $students['chargenum'] + $order['ksnum'];
				pdo_update($this->table_students,array('chargenum'=>$new),array('id'=>$sid));
				$chargelog = array(
					'schoolid' 	=> $order['schoolid'],
					'weid'	   	=> $order['weid'],
					'sid'	   	=> $order['sid'],
					'yue_type' 	=> 3,
					'cost_type' => 1,
					'cost'	   	=> $order['ksnum'],
					'costtime' 	=> $order['paytime'],
					'orderid'  	=> $order['id'],
					'on_offline' => 1,
					'createtime' => time()
				); 
				pdo_insert($this->table_yuecostlog,$chargelog);
				$send = $this->sendMobileJfjgtz($order['id']);
			}else if($order['type'] == 4){//报名付费
				$sign = pdo_fetch("SELECT name,nj_id FROM " . tablename($this->table_signup) . " where :id = id", array(':id' => $order['signid']));
				$njinfo = pdo_fetch("SELECT tid FROM " . tablename($this->table_classify) . " WHERE :sid = sid ", array(':sid' => $sign['nj_id']));
				$njzr = pdo_fetch("SELECT openid FROM " . tablename($this->table_teachers) . " WHERE :id = id ", array(':id' => $njinfo['tid']));
				if(!empty($njzr)){
					$this->sendMobileBmshtz($order['signid'], $order['schoolid'], $order['weid'], $njzr['openid'], $sign['name']);
				}			
			}else{
				$send = $this->sendMobileJfjgtz($order['id']);
			}
			mload()->model('print');
			order_print($order['id']);	
			if($params['chongzhi'] == 'chongzhi'){
				$data_yuelog = array(
					'schoolid' 	=> $order['schoolid'],
					'weid'	   	=> $order['weid'],
					'sid'	   	=> $order['sid'],
					'yue_type' 	=> 2,
					'cost_type' => 2,
					'cost'	   	=> $order['cose'],
					'costtime' 	=> $order['paytime'],
					'orderid'  	=> $order['id'],
					'on_offline' => 1,
					'createtime' => time()
				);
				pdo_insert($this->table_yuecostlog,$data_yuelog);
				$params['from'] = 'return';
			}
		}
		if (empty($params['result']) || $params['result'] != 'success') {
			 pdo_update($this->table_wxpay, array('status' => 1), array('id' => $orderid));
			 pdo_update($this->table_order, array('status' => 1), array('id' => $wxpay['od1']));
			 $order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " where id = :id ", array(':id' => $wxpay['od1']));
			 if(!empty($order['morderid']) && $order['type'] == 6 ){
				pdo_update($this->table_mallorder, array('status' => 1), array('id' => $order['morderid']));
			}
			 
		}
		if ($params['from'] == 'return' && empty($params['returnurl'])) {
			 $order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " where id = :id ", array(':id' => $wxpay['od1']));	
			 $teaid = pdo_fetch("SELECT * FROM " . tablename($this->table_mallorder) . " where id = :id ", array(':id' => $order['morderid']));
			if($order['type'] == 4){	
				$url = $_W['siteroot'] . 'app/index.php?i=' . $wxpay['weid'] . '&c=entry&schoolid=' . $wxpay['schoolid'] . '&id=' . $order['signid'] . '&do=signupjc&m=weixuexiao';
			}else if($order['type'] == 5){		
				$url = $_W['siteroot'] . 'app/index.php?i=' . $wxpay['weid'] . '&c=entry&schoolid=' . $wxpay['schoolid'] . '&do=user&m=weixuexiao';
			}else if($order['type'] == 7){		
				$url = $_W['siteroot'] . 'app/index.php?i=' . $wxpay['weid'] . '&c=entry&schoolid=' . $wxpay['schoolid'] . '&do=user&m=weixuexiao';
			}else if($order['type'] == 6){	
				if(!empty($teaid['tid']) && empty($teaid['sid'])){
					$url = $_W['siteroot'] . 'app/index.php?i=' . $wxpay['weid'] . '&c=entry&schoolid=' . $wxpay['schoolid'] . '&do=getorder&m=weixuexiao';
				}else{
					$url = $_W['siteroot'] . 'app/index.php?i=' . $wxpay['weid'] . '&c=entry&schoolid=' . $wxpay['schoolid'] . '&do=sgetorder&userid='.$teaid['userid'].'&op=yes_g&m=weixuexiao';
				}
			}
			else{
				$url = $_W['siteroot'] . 'app/index.php?i=' . $wxpay['weid'] . '&c=entry&schoolid=' . $wxpay['schoolid'] . '&do=user&m=weixuexiao';
			}
			if ($params['result'] == 'success') {
				message('支付成功！', $url, 'success');
			} else {
				message('支付失败！', $url);
			}
		}
	}

	public function uniarr($uniarr, $id) {
		foreach ($uniarr as $key => $value) {
			if ($id == $value) {
				return true;
			}
		}
		return false;
	}

	public function checkpay($schoolid, $sid, $userid, $uid) {
		global $_W, $_GPC;

		$student = pdo_fetch("SELECT * FROM " . tablename($this->table_students) . " WHERE :weid = weid And :schoolid = schoolid And :id = id", array(':weid' => $_W['uniacid'], ':schoolid' => $schoolid, ':id' => $sid));
		$cost = pdo_fetchall("SELECT * FROM " . tablename($this->table_cost) . " where weid = :weid And schoolid = :schoolid And is_on = :is_on ", array(':weid' => $_W['uniacid'], ':schoolid' => $schoolid, ':is_on' => 1));

		foreach ($cost as $key => $value) {
			$bjarr = explode(',',$value['bj_id']);
			$is = $this->uniarr($bjarr, $student['bj_id']);
			//print_r($bjarr);
			if ($is) {
				//$bjstatus = true;
				$orderst = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " where weid = :weid And schoolid = :schoolid And obid = :obid And costid = :costid And sid = :sid And type = :type ", array(
							':weid' => $_W['uniacid'],
							':schoolid' => $schoolid,
							':costid' => $value['id'],
							':obid' => $value['about'],
							':sid' => $sid,
							':type' => 3
							));
				if (empty($orderst)) {
					$orderid = "{$uid}{$sid}";
						$date = array(
							'weid' =>  $_W['uniacid'],
							'schoolid' => $schoolid,
							'sid' => $sid,
							'userid' => $userid,
							'type' => 3,
							'status' => 1,
							'obid' => $value ['about'],
							'costid' => $value ['id'],
							'uid' => $uid,
							'cose' => $value['cost'],
							'payweid' => $value['payweid'],
							'orderid' => $orderid,
							'createtime' => time(),
						);
					pdo_insert($this->table_order, $date);
				}
			}
		}
	}

	public function checkobjiect($schoolid, $sid, $obid) {
		global $_W, $_GPC;
		$order = pdo_fetchall("SELECT costid,paytime,status FROM " . tablename($this->table_order) . " where weid = :weid And schoolid = :schoolid And sid = :sid And type = :type And obid = :obid ORDER BY id DESC LIMIT 0,1", array(
				':weid' => $_W['uniacid'],
				':schoolid' => $schoolid,
				':sid' => $sid,
				':obid' => $obid,
				':type' => 3,
				));
		foreach ($order as $key => $value) {
			$cost = pdo_fetch("SELECT * FROM " . tablename($this->table_cost) . " where weid = :weid And schoolid = :schoolid And is_on = :is_on  And id = :id", array(
					':weid' => $_W['uniacid'],
					':schoolid' => $schoolid,
					':id' => $value['costid'],
					':is_on' => 1
					));
			if (!empty($cost)){
				if ($value['status'] == 2) {
					if ($cost['is_time'] == 1){
						if($cost['endtime'] < TIMESTAMP){
							$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('obinfo', array('id' => $value['costid'], 'schoolid' => $schoolid, 'type' => 1));
							header("location:$stopurl");
						}else if($cost['starttime'] > TIMESTAMP){
							$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('obinfo', array('id' => $value['costid'], 'schoolid' => $schoolid, 'type' => 2));
							header("location:$stopurl");
						}
					}else{
						$time = $cost['dataline'] * 86400;
						$times = $time + $value['paytime'];
						$rest = $times - TIMESTAMP;
						$restday = $rest/86400;
						if ($restday < 0){
							$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('obinfo', array('id' => $value['costid'], 'schoolid' => $schoolid, 'type' => 1));
							header("location:$stopurl");
						}
					}
				}else{
					$stopurl = $_W['siteroot'] .'app/'.$this->createMobileUrl('obinfo', array('id' => $value['costid'], 'schoolid' => $schoolid, 'type' => 1));
					header("location:$stopurl");
				}
			}
		}
	}
	
	public function imessage($msg, $redirect = '', $type = '', $tip = '', $btn_text = '确定') {
			global $_W;
			if ($redirect == 'refresh') {
				$redirect = $_W['script_name'] . '?' . $_SERVER['QUERY_STRING'];
				var_dump( $redirect);
			} elseif (!empty($redirect) && !strexists($redirect, 'http://')) {
				$urls = parse_url($redirect);
				$redirect = $_W['siteroot'] . 'web/index.php?' . $urls['query'];
			}
			if ($redirect == '') {
				$type = in_array($type, array('success', 'error', 'info', 'ajax')) ? $type : 'info';
			} else {
				$type = in_array($type, array('success', 'error', 'info', 'ajax')) ? $type : 'success';
			}
			$label = $type;
			if($type == 'error') {
				$label = 'danger';
			}
			if($type == 'ajax' || $type == 'sql') {
				$label = 'warning';
			}			
			include $this->template('public/message', TEMPLATE_INCLUDEPATH);
			die;
	}
	
	public function GetSensitiveWord ($weid){
		$word = pdo_fetch("SELECT sensitive_word FROM " . tablename('wx_school_set') . " WHERE weid = {$weid}");
		return $word['sensitive_word'];
	}
	
	public function getAccessToken2() { 
		global $_GPC, $_W;
		load()->func('communication');
		load()->classs('weixin.account');		
		$account_api = WeAccount::create();
		$token = $account_api->getAccessToken();
		return $token;
	}
	public function getAccessToken3($weid) {//返回原来TOKEN
		global $_GPC, $_W;
		load()->func('communication');
		load()->classs('weixin.account');
		$jsauth = pdo_fetch("SELECT * FROM " . tablename('account_wechats') . " WHERE uniacid = '{$weid}'");
		$uniacccount = WeAccount::create($jsauth['acid']);
		$token = $uniacccount->getAccessToken();
		return $token;
	}
	//重定义的paymethod
	public function doMobilePaymethodredefined() {
		global $_W, $_GPC;
		$params = array(
			'fee' => floatval($_GPC['fee']),
			'tid' => $_GPC['tid'],
			'module' => $_GPC['module'],
		);
		if (empty($params['tid']) || empty($params['fee']) || empty($params['module'])) {
			message(error(1, '支付参数不完整'));
		}
		if($params['fee'] <= 0) {
			$notify_params = array(
				'form' => 'return',
				'result' => 'success',
				'type' => '',
				'tid' => $params['tid'],
			);
			$site = WeUtility::createModuleSite($params['module']);
			$method = 'payResult';
			if (method_exists($site, $method)) {
				$site->$method($notify_params);
				message(error(-1, '支付成功'));
			}
		}
		
		$log = pdo_get('core_paylog', array('uniacid' => $_GPC['payweid'], 'module' => $params['module'], 'tid' => $params['tid']));
		if (empty($log)) {
			$log = array(
				'uniacid' => $_GPC['payweid'],
				'acid' => $_W['acid'],
				'openid' => $_W['member']['uid'],
				'module' => $params['module'],
				'tid' => $params['tid'],
				'fee' => $params['fee'],
				'card_fee' => $params['fee'],
				'status' => '0',
				'is_usecard' => '0',
			);
			pdo_insert('core_paylog', $log);
		}
		if($log['status'] == '1') {
			message(error(1, '订单已经支付'));
		}
		$setting = uni_setting($_W['uniacid'], array('payment', 'creditbehaviors'));
		if(!is_array($setting['payment'])) {
			message(error(1, '暂无有效支付方式'));
		}
		$pay = $setting['payment'];
		if (empty($_W['member']['uid'])) {
			$pay['credit']['switch'] = false;
		}
		if (!empty($pay['credit']['switch'])) {
			$credtis = mc_credit_fetch($_W['member']['uid']);
		}
		
		include $this->template('pay');
	}


	private function doMobilePayWechatReDefined($paylog = array()) {
		global $_W;
		load()->model('payment');
		
		pdo_update('core_paylog', array(
			'openid' => $_W['openid'], 
			'tag' => iserializer(array('acid' => $_W['acid'], 'uid' => $_W['member']['uid']))
		), array('plid' => $paylog['plid']));
		
		$_W['uniacid'] = $paylog['uniacid'];
		
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$wechat_payment = $setting['payment']['wechat'];
		
		$account = pdo_get('account_wechats', array('acid' => $wechat_payment['account']), array('key', 'secret'));
		
		$wechat_payment['appid'] = $account['key'];
		$wechat_payment['secret'] = $account['secret'];
		
		$params = array(
			'tid' => $paylog['tid'],
			'fee' => $paylog['card_fee'],
			'user' => $paylog['openid'],
			'title' => urldecode($paylog['title']),
			'uniontid' => $paylog['uniontid'],
		);
		if (intval($wechat_payment['switch']) == PAYMENT_WECHAT_TYPE_SERVICE || intval($wechat_payment['switch']) == PAYMENT_WECHAT_TYPE_BORROW) {
			if (!empty($_W['openid'])) {
				$params['sub_user'] = $_W['openid'];
				$wechat_payment_params = wechat_proxy_build($params, $wechat_payment);
			} else {
				$params['tid'] = $paylog['plid'];
								$params['title'] = urlencode($params['title']);
				$sl = base64_encode(json_encode($params));
				$auth = sha1($sl . $paylog['uniacid'] . $_W['config']['setting']['authkey']);
				
				$callback = urlencode($_W['siteroot'] . "payment/wechat/pay.php?i={$_W['uniacid']}&auth={$auth}&ps={$sl}");
				$proxy_pay_account = payment_proxy_pay_account();
				if (!is_error($proxy_pay_account)) {
					$forward = $proxy_pay_account->getOauthCodeUrl($callback, 'we7sid-'.$_W['session_id']);
					message(error(2, $forward), $forward, 'ajax');
					exit;
				}
			}
		} else {
			unset($wechat_payment['sub_mch_id']);
			$wechat_payment_params = wechat_build($params, $wechat_payment);
		}
		if (is_error($wechat_payment_params)) {
			message($wechat_payment_params, '', 'ajax', true);
		} else {
			message(error(0, $wechat_payment_params), '', 'ajax', true);
		}
	}

	private function doMobilePayAlipayReDefined($paylog = array()) {
		global $_W;
		load()->model('payment');
		load()->func('communication');
		$_W['uniacid'] = $paylog['uniacid'];
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$params = array(
			'tid' => $paylog['tid'],
			'fee' => $paylog['card_fee'],
			'user' => $paylog['openid'],
			'title' => urldecode($paylog['title']),
			'uniontid' => $paylog['uniontid'],
		);
		$alipay_payment_params = alipay_build($params, $setting['payment']['alipay']);
		if($alipay_payment_params['url']) {
			message(error(0, $alipay_payment_params['url']), '', 'ajax', true);
			exit();
		}
	}


	//重定义的pay
	public function doMobilePayredefined() {
		global $_W, $_GPC;
		$moduels = uni_modules();
		$params = $_POST;
		
		if(empty($params) || !array_key_exists($params['module'], $moduels)) {
			message(error(1, '模块不存在'), '', 'ajax', true);
		}
		
		$setting = uni_setting($_W['uniacid'], 'payment');
		$dos = array();
		if(!empty($setting['payment']['credit']['pay_switch'])) {
			$dos[] = 'credit';
		}
		if(!empty($setting['payment']['alipay']['pay_switch'])) {
			$dos[] = 'alipay';
		}
		if(!empty($setting['payment']['wechat']['pay_switch'])) {
			$dos[] = 'wechat';
		}
		if(!empty($setting['payment']['delivery']['pay_switch'])) {
			$dos[] = 'delivery';
		}
		if(!empty($setting['payment']['unionpay']['pay_switch'])) {
			$dos[] = 'unionpay';
		}
		if(!empty($setting['payment']['baifubao']['pay_switch'])) {
			$dos[] = 'baifubao';
		}
		$type = in_array($params['method'], $dos) ? $params['method'] : '';
		if(empty($type)) {
			message(error(1, '暂无有效支付方式,请联系商家'), '', 'ajax', true);
		}
		$moduleid = pdo_getcolumn('modules', array('name' => $params['module']), 'mid');
		$moduleid = empty($moduleid) ? '000000' : sprintf("%06d", $moduleid);
		$uniontid = date('YmdHis').$moduleid.random(8,1);
		
		$paylog = pdo_get('core_paylog', array('uniacid' => $_GPC['payweid'], 'module' => $params['module'], 'tid' => $params['tid']));
		if (empty($paylog)) {
			$paylog = array(
				'uniacid' => $_GPC['payweid'],
				'acid' => $_W['acid'],
				'openid' => $_W['member']['uid'],
				'module' => $params['module'],
				'tid' => $params['tid'],
				'uniontid' => $uniontid,
				'fee' => $params['fee'],
				'card_fee' => $params['fee'],
				'status' => '0',
				'is_usecard' => '0',
			);
			pdo_insert('core_paylog', $paylog);
			$paylog['plid'] = pdo_insertid();
		}
		if(!empty($paylog) && $paylog['status'] != '0') {
			message(error(1, '这个订单已经支付成功, 不需要重复支付.'), '', 'ajax', true);
		}
		if (!empty($paylog) && empty($paylog['uniontid'])) {
			pdo_update('core_paylog', array(
				'uniontid' => $uniontid,
			), array('plid' => $paylog['plid']));
		}
		$paylog['title'] = $params['title'];
		if (intval($_GPC['iswxapp'])) {
			message(error(2, $_W['siteroot']."app/index.php?i={$_W['uniacid']}&c=wxapp&a=home&do=go_paycenter&title={$params['title']}&plid={$paylog['plid']}"), '', 'ajax', true);
		}
		if ($params['method'] == 'wechat') {
			return $this->doMobilePayWechatReDefined($paylog);
		} elseif ($params['method'] == 'alipay') {
			return $this->doMobilePayAlipayReDefined($paylog);
		} else {
			$params['tid'] = $paylog['plid'];
			$sl = base64_encode(json_encode($params));
			$auth = sha1($sl . $_W['uniacid'] . $_W['config']['setting']['authkey']);
			message(error(0, $_W['siteroot'] . "/payment/{$type}/pay.php?i={$_W['uniacid']}&auth={$auth}&ps={$sl}"), '', 'ajax', true);
			exit();
		}
	}
}
if(getoauthurl() == 'edu.d3xf.com'){
	define('NJNAME', '机构');
	define('NJNAMEGL', '机构管理');
}else{
	define('NJNAME', '年级');
	define('NJNAMEGL', '年级管理');
}
