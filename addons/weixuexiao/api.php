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
    /** 学校 start */
    /**学校搜索处理**/
    public function SchoolSearch(){
        include_once 'inc/app/school/schoolSearch.php';
    }
    /**学校列表**/
    public function SchoolList(){
        include_once 'inc/app/school/schoolList.php';
    }
    /**学校首页**/
    public function SchoolDetail(){
        include_once 'inc/app/school/detail.php';
    }
    /**学校文章**/
    public function SchoolArticle(){
        include_once 'inc/app/school/schoolArticle.php';
    }
    /**学校简介**/
    public function Schooljianjie(){
        include_once 'inc/app/school/jianjie.php';
    }
    /**招生简介**/
    public function SchoolRecruit(){
        include_once 'inc/app/school/recruit.php';
    }
    /**学校食谱**/
    public function SchoolCookbook(){
        include_once 'inc/app/school/cookbook.php';
    }
    /**教师风采**/
    public function SchoolTeachers(){
        include_once 'inc/app/school/teacher/teachers.php';
    }
    /**教师详情**/
    public function SchoolTeacherDetail(){
        include_once 'inc/app/school/teacher/detail.php';
    }
    /**学校年级和课程列表**/
    public function SchoolGrade(){
        include_once 'inc/app/school/course/grade.php';
    }
    /**课程详情**/
    public function CourseDetail(){
        include_once 'inc/app/school/course/detail.php';
    }
    /**绑定学生和教师身份**/
    public function bangding(){
        include_once 'inc/app/school/bangding.php';
    }
    /**一些提交数据的处理**/
    public function AjaxSub(){
        include_once 'inc/app/school/ajaxSub.php';
    }
    /**学生报名页面**/
    public function SignUp(){
        include_once 'inc/app/school/student/signup.php';
    }
    /**提交学生报名信息**/
    public function SignUpAjax(){
        include_once 'inc/app/school/student/signupajax.php';
    }
    /**学生的报名列表**/
    public function signuplist(){
        include_once 'inc/app/school/student/signuplist.php';
    }
    /**预约试听**/
    public function StudentAudition(){
        include_once 'inc/app/school/student/audition.php';
    }
    /**公共预约入口**/
    public function Appointment(){
        include_once 'inc/app/school/appointment.php';
    }
    /**课程新增学生**/
    public function StudentAdd(){
        include_once 'inc/app/school/student/addStudent.php';
    }

    /**学生的班级圈入口**/
    public function StudentClassCircle(){
        include_once 'inc/app/school/class/StudentClassCircle.php';
    }
    /**学生发布班级圈页面**/
    public function StudentPublishClassCircle(){
        include_once 'inc/app/school/class/StudentPublishClassCircle.php';
    }
    /**发布班级圈的处理接口**/
    public function PublishClassCircle(){
        include_once 'inc/app/school/class/PublishClassCircle.php';
    }
    /**新手引导**/
    public function Guide(){
        include_once 'inc/app/school/guide.php';
    }
    /** 学校 end */
    /****************学生操作 START*******************/
    public function Upload(){
        include_once 'inc/app/school/upload.php';
    }
    /****************学生操作 END*******************/
    /***************老师中心 START********************/
    public function TeacherCenter(){
        include_once 'inc/app/school/teacher/center.php';
    }
    /**老师的个人信息**/
    public function TeacherInfo(){
        include_once 'inc/app/school/teacher/info.php';
    }
    /**老师的考勤详情页**/
    public function TeacherAttendance(){
        include_once 'inc/app/school/teacher/attendance.php';
    }
    /**老师的签到页面**/
    public function TeacherSign(){
        include_once 'inc/app/school/teacher/sign.php';
    }
    /**老师请假页面**/
    public function TeacherLeave(){
        include_once 'inc/app/school/teacher/leave.php';
    }
    /**老师的ajax提交操作**/
    public function TeacherAjax(){
        include_once 'inc/app/school/teacher/ajaxSub.php';
    }
    /***************老师中心 END********************/
    /** 登陆注册 start**/
    /**用户注册**/
    public function Register(){
        include_once 'inc/app/login/register.php';
    }
    /**用户登陆**/
    public function Login(){
        include_once 'inc/app/login/login.php';
    }
    /** 登陆注册 end**/
}