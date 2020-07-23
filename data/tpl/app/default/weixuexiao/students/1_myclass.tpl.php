<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true" />
<link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/new_yab1.css?v=1?v=1111" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/newCourseDetail.css">
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<?php  echo register_jssdks();?>
<style type="text/css">
body {background: #FFF;}
.ovfHiden{overflow:hidden}
.component-panel {position: fixed;}
.header { width: 100%; height: 50px; line-height: 50px; position: fixed; z-index: 1000; top: 0; left: 0; box-shadow: 0 0 2px 0px rgba(0,0,0,0.3),0 0 6px 2px rgba(0,0,0,0.15); } .header .l { width: 50px; height: 50px; line-height: 50px; color: white; position: absolute; left: 0; top: 0; } .header .m { width: 100%; height: 50px; line-height: 50px; text-align: center; color: white; font-size: 18px; } .header .r { width: 50px; height: 50px; line-height: 50px; position: absolute; right: 0; top: 0; } .mainColor { background: #06c1ae !important; } .header .l a { font-size: 18px; color: white; display: block; width: 100%; height: 100%; text-align: center; }
.add_link_box{width:100%;position: absolute;left:0;top:60px;bottom:0;z-index: 9999;background-color:rgba(0,0,0,0.5);display: none}
.add_link_info_wrap{padding:0 10px;margin:0 auto;display: -webkit-box;-webkit-box-orient:vertical;-webkit-box-pack: center;-webkit-box-align: center;height:100%;}
.my_add_link_inner{width: 100%;height:190px;background-color: #fff;border-radius: 10px;padding: 10px 0;}
.my_add_link_inner h3{text-align: center;color:#666;}
.add_link_wrap{height:35px;line-height: 35px;overflow: hidden;padding: 10px; }
.my_link_title {width: 80px;float: left;color: #666666;}
.my_add_link_txt{height:35px;line-height: 35px;box-sizing: border-box;width:70%;outline: none;border:1px solid #dcdcdc;border-radius: 3px;float:left;}
.add_link_btn_wrap{padding: 10px;overflow:hidden;}
.add_link_btn_sure {float: left;width: 40%;height: 35px;line-height: 35px;background: #06c1ae;font-size: 16px;border-radius: 20px;color: #fff;border: none;padding: 0;margin: 0 5%;outline: none;}
#add_link_btn_cancel {background: #ffb24e;}
.link_title {text-align: center;color: #333333;font-size: 16px;margin-top: 2px;}
.main {margin: 10px 10px;background: #FFF;padding: 0;border-radius: 10px;padding-bottom: 10px;box-shadow: 0 1px 9px #dcdcdc;}
.main_text a {cursor: pointer !important;text-decoration: underline !important;color: #0094ff;}
.main img {margin-top: 0px;}
.common_no_audit_status {background-color: initial;}
.baby_diary_img_list {margin-left: 5px;margin-top: 5px;padding-bottom: 10px;}
.baby_diary_img_listOther {margin-left: 0;margin-top: 10px;padding-left: 12px;}
.baby_diary_img_list li {width: 32.5%;height: 70px;overflow: hidden;box-sizing: border-box;padding: 2px;float: left;margin: 0;}
.notifyImgItem {width: 30.5% !important;position: relative;}
.btn_closeImg {position: absolute;width: 10px;top: 0;right: 4px;}
.F_div {right: 30px;bottom:75px}
.F_divs {left: 30px;bottom:75px;width: 60px;height: 60px;background: #ff6665;box-shadow: 1px 1px 2px 0px #909090;border-radius: 50px;position: fixed;}
.baby_diary_img_listOther {padding-left: 10px;border-bottom: 1px solid #f0f0f2;}
#notifyContent {padding: 10px;background-color: white;border: 1px solid #f0f0f2;}
.main_text p, .main_text a {display: inline-block;}
.main, .linkDataUrl {cursor: pointer !important;}
.linkDataUrl {text-decoration: underline !important;}
.pv-img {position: relative;}
.imgDesc {position: absolute;right: 15px;height: 20px;line-height: 20px;font-size: 16px;color: white;text-align: right;z-index: 99;}
p img {margin: 10px 0 !important;} 
.slide_left_menu_bg.show_menu_bg {display: block;-webkit-animation-name: fadeIn;animation-name: fadeIn;-webkit-animation-duration: 600ms;animation-duration: 600ms;-webkit-animation-fill-mode: both;/* animation-fill-mode: both; */}
.slide_left_menu_bg_other.show_menu_bg {display: block;-webkit-animation-name: fadeIn;animation-name: fadeIn;-webkit-animation-duration: 600ms;animation-duration: 600ms;-webkit-animation-fill-mode: both;/* animation-fill-mode: both; */}
.slide_left_menu_bg {width: 100%;z-index: 998;background: rgba(0, 0, 0, 0.5);position: fixed;min-height: 100%;top: 0;left: 0;zoom: 1;overflow: hidden;display: none;height: 100%;z-index: 1000;overflow-y: scroll;}
.slide_left_menu_bg_other {width: 100%;z-index: 998;background: rgba(0, 0, 0, 0.5);position: fixed;min-height: 100%;top: 0;left: 0;zoom: 1;overflow: hidden;display: none;height: 100%;
z-index: 1000;overflow-y: scroll;display: none;}
.slide_left_menu {width: 50%!important;right: 0;background-color: #fff;z-index: 999;min-height: 100%;position: absolute;}
.slide_left_menu_ul_other {width: 100%;border: 1px solid #ccc;border-left: none;border-right: none;box-sizing: border-box;padding: 0 10px;}
.slide_left_menu_ul_other li {height: 50px;line-height: 50px;border-bottom: 1px solid #ccc;font-size: 16px;width: 100%;box-sizing: border-box;padding: 0 10px 0 10px;overflow: hidden;
position: relative;}
.slide_left_menu_ul_other li.act {background: url(<?php echo OSSURL;?>public/mobile/img/be_choose_icon.png) right center no-repeat;background-size: 16px;background-origin: content-box;-moz-background-origin: content-box;-webkit-background-origin: content-box;}
.slide_left_menu_ul li.act {background: url(<?php echo OSSURL;?>public/mobile/img/be_choose_icon_02.png) right center no-repeat;background-size: 16px;background-origin: content-box;-moz-background-origin: content-box;-webkit-background-origin: content-box;}
.slide_left_menu_ul_other li:last-of-type {border-bottom: none;}
.slide_left_menu_ul_other li .user_img {width: 50px;height: 50px;position: absolute;left: -5px;top: 0;box-sizing: border-box;padding: 10px;}
.slide_left_menu_ul_other li .user_img img {width: 100%;height: 100%;border-radius: 50%;}
.slide_left_menu_ul_other li .change_user {width: 40px;height: 100%;position: absolute;right: 0;top: 0;background: url(<?php echo OSSURL;?>public/mobile/img/be_choose_icon.png) center no-repeat;background-size: 30px;}
.slide_left_menu_til {height: 40px;line-height: 40px;box-sizing: border-box;padding: 0 40px 0 15px;position: relative;font-size: 16px;}
.slide_left_menu_ul {width: 100%;border: 1px solid #ccc;border-left: none;border-right: none;box-sizing: border-box;padding: 0 10px;}
.slide_left_menu_ul li {height: 50px;line-height: 50px;/*border-bottom: 1px solid #ccc;*/font-size: 16px;width: 100%;box-sizing: border-box;padding: 0 10px 0 50px;overflow: hidden;
position: relative;}
.hederRightBox {width: 21px;height: 100%;display: inline-block;position: absolute;right: 20px;}
.hederRightBox a {width: 100%;height: 21px;display: inline-block;position: absolute;top: 50%;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);}
.audit_statusNew, .audit_statusPass, .audit_statusus, .audit_statusPassReject {width: 50px;height: 20px;position: absolute;top: 0;right: 0;font-size: 11px;display: -webkit-box;display: -moz-box;
display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;
-webkit-box-pack: center;-moz-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center;justify-content: center;border-top-right-radius: 10px;border-bottom-left-radius: 10px;}
.audit_statusPass {background-color: #cccccc;color: #333333;}
.audit_statusNew {background-color: #d446b7;color: white;}
.audit_statusus {background-color: #46a0d4;color: white;}
.wexintip {height: 20px;width: 20px;background: url(<?php echo OSSURL;?>public/mobile/img/weixinicon.png) right center no-repeat;align-items: center;background-size: 16px;}
.boytip {height: 20px;width: 20px;background: url(<?php echo OSSURL;?>public/mobile/img/boy_icon.png) right center no-repeat;align-items: center;background-size: 16px;}
.girltip {height: 20px;width: 20px;background: url(<?php echo OSSURL;?>public/mobile/img/girl_icon.png) right center no-repeat;align-items: center;background-size: 16px;}
.pard2 {height: 20px;background: #ff9f22;color: white;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size: 11px;margin-left: 5px;padding: 0 4px;border-radius: 5px;}
.pard3 {height: 20px;background: #16d3e6;color: white;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size: 11px;margin-left: 5px;padding: 0 4px;border-radius: 5px;}
.pard4 {height: 20px;background: #31a914;color: white;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size: 11px;margin-left: 5px;padding: 0 4px;border-radius: 5px;}
.pard5 {height: 20px;background: #da7f1f;color: white;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size: 11px;margin-left: 5px;padding: 0 4px;border-radius: 5px;}
.pard6 {height: 20px;background: #f52270;color: white;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size: 11px;margin-left: 5px;padding: 0 4px;border-radius: 5px;}
.pard7 {height: 20px;background: #f32336;color: white;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-align: center;-moz-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;font-size: 11px;margin-left: 5px;padding: 0 4px;border-radius: 5px;}
.erwei {width: 15.5px;height: 15px;position: absolute;top: 90%;right: 35px;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);}
.btnEditBox {top: 90%;right: 61px;}
.btnDeleteBox {top: 90%;}
.btnDeleteBox>img {top: 22px;}
.erwei>img {position: absolute;top: 0;left: 0;right: 0;bottom: 0;width: 15px;}
#attendance {width: 94%;border-radius: 3%;height: 80px;margin-left: 3%;float: left;background: white;}
#attendance .r1, .m1, .l1 {float: left;height: 70px;width: 30%;margin-top: 5px;}
#attendance div {text-align: center;}
.t div.t1, div.t2, div.t3 {width: 100%;height: 34px;line-height: 40px;}
#num1, #num2, #num3 {font-size: 22px;}
#num1 {color: #14C682;}
#attendance .m1 {border-width: 1px;	width: 35%;}
#attendance .r1, .m1, .l1 {float: left;height: 70px;margin-top: 5px;}
.t .t3 {color: #14C682;}
.user_name {text-align: left;color: #666;font-size: 14px;width: 100%;}
.btn {height: 44px;display: block;background-color: #7bb52d;font: 20px "黑体";text-align: center;color: #fff;cursor: pointer;}
.user_name > input {    display: block;width: 100%;border-radius: 3px;height: 34px;padding: 0 10px;margin-bottom: 10px;border: 1px solid #e4dede;/* -webkit-box-sizing: border-box; */box-sizing: border-box;}
.user_name > select {display: block;width: 100%;height: 34px;border-radius: 3px;padding: 0 10px;margin-bottom: 10px;border: 1px solid #ccc;-webkit-box-sizing: border-box;
box-sizing: border-box;text-align: left;color: #666;font-size: 14px;}
.close_pupop_c {width: 200px; margin: 0 auto;}
.close_pupop_button {width: 90px;height: 30px;border-radius: 5px;line-height: 30px;font-size: 16px;text-align: center;}
.close_pupop_button_1 {background: #e74580;color: #fff;}
.close_pupop_button_2 {background: #56c454;color: #fff;margin-left: 20px;}
.user_name > input {    display: block;width: 100%;border-radius: 3px;height: 34px;padding: 0 10px;margin-bottom: 10px;border: 1px solid #e4dede;/* -webkit-box-sizing: border-box; */box-sizing: border-box;}
.user_name > select {display: block;width: 100%;height: 34px;border-radius: 3px;padding: 0 10px;margin-bottom: 10px;border: 1px solid #ccc;-webkit-box-sizing: border-box;
box-sizing: border-box;text-align: left;color: #666;font-size: 14px;}
.head_buy1 {position: relative;height: 100px;}
.head_buy1 .head_img1{height: 100px;text-align: center;}
.head_buy1 .head_img1>img{height: 100px;}
.famiyls {width: 100%;text-align: left;color: #666;display: inline-flex;border-bottom:1px solid #e9e9e9;margin-top: 20px;}
.left{width: 50%;float: left;display: flex;}
.left_img>img{height: 36px; margin-top: -16px;border-radius: 50%;}
.left_pard{text-align: center;}
.left_name{line-height: 36px;padding: 5px;}
.right{width: 50%;float: right;}
.right>span{line-height: 43px; margin-left: 10px;float: left;}
.weui_switch {font-size: 14px;-webkit-appearance: none;-moz-appearance: none;appearance: none;position: relative;width: 48px;height: 28px;border: 1px solid #DFDFDF;outline: 0;border-radius: 16px;box-sizing: border-box;background: #DFDFDF;vertical-align: middle;float: right;top: 8px;right: 12px;}
.weui_switch:before {content: " ";position: absolute;top: 0;left: 0;width: 46px;height: 26px;border-radius: 15px;background-color: #FDFDFD;-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.weui_switch:after {content: " ";position: absolute;top: 0;left: 0;width: 26px;height: 26px;border-radius: 15px;background-color: #FFFFFF;box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.manual_student_list_search {padding: 10px;box-sizing: border-box;width: 98%;margin-top: 62px;margin-bottom: 8px;left: 5px;height: 42px;border: 1px solid #d4d4d4;position: relative;background-color: #fff;border-radius: 6px;}
.manual_student_list_search .search_text {border: none;height: 22px;line-height: 22px;font-size: 14px;box-sizing: border-box;width: 100%;padding-right: 30px;}
.manual_student_list_search .search_btn {width: 22px;height: 22px;background: url(<?php echo OSSURL;?>public/mobile/img/B_gou.png) no-repeat center;background-size: 22px;position: absolute;right: 10px;
top: 10px;}
.btnQDBox {top: 81%;width: 28px;height: 28px;background-color: #ef841a;border-radius: 50%;font-size: 16px;color: #fff;text-align: center;position: absolute;right: 73px;font-weight: bold;line-height: 28px;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-box-shadow: 2px 2px 5px #333333;-webkit-box-shadow: 2px 2px 5px #333333;box-shadow: 2px 2px 5px #716e6e;}
.btnXGBox {top: 81%;width: 40px;height: 28px;background-color: #0db15c;border-radius: 13%;font-size: 16px;color: #fff;text-align: center;position: absolute;right: 12px;font-weight: bold;line-height: 28px;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-box-shadow: 2px 2px 5px #333333;-webkit-box-shadow: 2px 2px 5px #333333;box-shadow: 2px 2px 5px #716e6e;}
.qdbtn{top: 50%;color: #fff;border-radius: 3px;right: 2px;text-align: center;width: 32%;margin-left: 87px;background-color: #19d2bf;height: 25px;position: relative;padding-top: 10p;line-height: 25px;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-box-shadow: 2px 2px 5px #333333;-webkit-box-shadow: 2px 2px 5px #333333;box-shadow: 1px 1px 1px #716e6e;}
.qdbtnre{ margin-top: 8px; margin-left: 95px;}
.qdbtnre>img{width: 30px;}
.gw_num{padding-right:.8em;margin-right: 10%;float: right;border: 1px solid #dbdbdb;width: 51%;line-height: 26px;overflow: hidden;display:inline}
.gw_num em{display: block;height: 26px;width: 26px;float: left;color: #7A7979;border-right: 1px solid #dbdbdb;text-align: center;cursor: pointer;}
.gw_num .num1{display: block;float: left;text-align: center;width: 52px;height:26px;font-style: normal;font-size: 14px;line-height: 26px;border: 0;}
.gw_num em.jia{float: right;border-right: 0;border-left: 1px solid #dbdbdb;}
.class_footer { position: relative; height: 26px; margin-top: 10px; line-height: 26px; text-align: right; display: -moz-box; display: -ms-flexbox; border-top: 1px solid #f0f0f2; -webkit-box-align: center; -moz-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center; }
.class_footer button { border: 1px solid #f0f0f2; border-radius: 3px; background: none; font-size: 13px; padding: 3px 11px; margin-top: 4px;margin-right: 10px;border-radius: 5px;position: relative; }
.qd{background: #ef841a;color:#fff}
.icon-task { background-image: url(<?php echo OSSURL;?>public/mobile/img/add_baby2.png); background-size: 15px; }
.icon-pj { background-image: url('data:image/png;base64,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'); background-size: 15px; }
.class_footer .icon { width: 15px; height: 15px; display: block; float: left; margin-right: 4px; margin-top: 2px; background-size: 13px; background-repeat: no-repeat; }
.red_div{ margin-left: 6px; display: flex; position: relative; font-size: 14px; color: #aba5a5; }
.red_div .red{ height: 7px; width: 7px; margin-top: 34%; margin-right: 5px; border-radius: 50%; background: red; position: relative; }
</style>
<?php  include $this->template('port');?>
<title><?php  echo $school['title'];?></title>
</head>
<body>
<div class="All">       
	<div class="listContent">
		<div id="shousuo"></div>
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<li class="main" time="<?php  echo $row['kcid'];?>" id="<?php  echo $row['kcid'];?>" style="display: block;">
			<div class="tongzhi">
				<?php  if($row['is_try'] == 1) { ?><div class="pard6">试听课</div><?php  } else { ?><div class="pard3">正式课</div><?php  } ?>
				<span class="tongzhiTitle"><?php  echo $row['name'];?></span>
				<?php  if($row['kc_type'] == 1) { ?><div class="red_div"><i class="red"></i>online</div><?php  } ?>
				<?php  if(keep_sk77()) { ?>
				<?php  if($item['kcstatus'] == 0) { ?>
				<?php  } else if($item['kcstatus'] == 1) { ?>
				<span class="pard3"  style="background: #1968bf;">结业</span>
				<?php  } else if($item['kcstatus'] == 2) { ?>
				<span class="pard3"  style="background: #bf9823;">欠费</span>
				<?php  } else if($item['kcstatus'] == 3) { ?>
				<span class="pard3"  style="background: #bf2434;">退费</span>
				<?php  } ?>
				<?php  if($row['isOver'] == 'near') { ?>
				<span class="pard2">即将过期</span>
				<?php  } else if($row['isOver'] == 'over') { ?>
				<span class="JobLeaderBox">已过期</span>
				<?php  } ?>
				<?php  } ?>
				<?php  if($row['type'] == 1) { ?><div class="audit_statusus">未开始</div><?php  } ?>
				<?php  if($row['type'] == 2) { ?><div class="audit_statusPass">已结课</div><?php  } ?>
				<?php  if($row['type'] == 3) { ?><div class="audit_statusNew">授课中</div><?php  } ?>
			</div>			
			<div class="cutting"></div>
			<div class="notifyTopBox" style="height: auto;">
				<div class="notifyTopLeft">
				<?php  if($row['kc_type'] == 1) { ?>
					<img src="<?php  echo $row['kcicon'];?>" class="teacherImgError" />
				<?php  } else { ?>
					<img src="<?php  if($row['kmicon']) { ?><?php  echo $row['kmicon'];?><?php  } else { ?><?php  echo $row['kcicon'];?><?php  } ?>" class="teacherImgError" />
				<?php  } ?>	
				</div>
				<div class="notifyTopRight">
					<div class="notifyTopRightTopBox">
						<?php  if($row['kmname']) { ?><span class="teacherInfo"><?php  echo $row['kmname'];?></span><?php  } ?>
						<?php  if($row['kc_type'] == 0) { ?>
							<?php  if($row['kctype'] ==0) { ?><div class="pard3">固定课表</div><?php  } ?>
							<?php  if($row['kctype'] ==1) { ?><div class="pard4">自由签到</div><?php  } ?>
							<?php  if($row['today']) { ?>
								<div class="pard2">今日有课</div>
								<?php  if(!$row['todayqd']) { ?>
									<div class="JobLeaderBox">未签到</div>
								<?php  } ?>							
							<?php  } ?>
							<?php  if($row['todayqd']) { ?>
								<div class="pard5">今日已签</div>
							<?php  } ?>
						<?php  } else { ?>
							<?php  if($row['hssnewks']) { ?><div class="pard7">有新课程</div><?php  } ?>
						<?php  } ?>
					</div>
					<p class="notifyCreateTime">主讲:&nbsp;<?php  echo $row['zjanme'];?></p>
					<?php  if($row['kc_type'] == 0) { ?>
					<p class="notifyCreateTime">教室:&nbsp;<?php  echo $row['jsname'];?></p>
					<p class="notifyCreateTime"><?php  if($row['kctype'] ==0) { ?>今日:&nbsp;<span style="color:red;font-weight:bold;"><?php  if($row['todays']) { ?><?php  echo $row['todays'];?><?php  } else { ?>无<?php  } ?></span>课&nbsp;&nbsp; 剩余:&nbsp;<span style="color:red;font-weight:bold;"><?php  echo $row['restks'];?></span><?php  } else { ?>剩余:&nbsp;<span style="color:red;font-weight:bold;"><?php  echo $row['restks'];?></span><?php  } ?>课</p>
					<?php  } else { ?>
						<p class="notifyCreateTime"><?php  echo $row['menumuber'];?>个章节&nbsp;|&nbsp;<?php  echo $row['ksmuber'];?>节课程</p>
					<?php  } ?>
				</div>
			</div>
			<div class="class_footer">
			<?php  if($row['allow_pl'] == 1 && empty($row['check'])) { ?><button onclick="gotopingjia(<?php  echo $row['kcid'];?>);"><i class="icon icon-pj"></i>评价</button><?php  } ?>
			<?php  if($row['allow_pl'] == 1 && !empty($row['check'])) { ?><button onclick="gotopingjia(<?php  echo $row['kcid'];?>);return false;">已评价</button><?php  } ?>
			<?php  if($row['type'] == 3) { ?>
				<?php  if($row['kctype'] ==1 || $row['ReNum'] != 0) { ?>
				<button class="qd" style="background: #0db15c;"  onclick="showxgks(<?php  echo $row['kcid'];?>);return false;">续购</button>
				<?php  } ?>
				<button class="qd" style="background: #f5be22;" onclick="qd_list(<?php  echo $row['kcid'];?>);return false;"><i class="icon icon-task"></i>签到</button>
			<?php  } ?>	
			</div>
		</li>
		<?php  } } ?>
	</div>
<div class="clear"></div>
<div class="clear"></div>
<div class="clear"></div>	
<div class="popUpBox" style="display: none">
	<div class="trackMatte"></div>
	<div class="popContentBox">
		<input type="hidden" id="kcid" value="" />
		<div class="poptitle" id="sname">今日课程签到情况</div>
		<div class="sectionContBox">
			<div id="family">
			</div>
			<div class="btnBox">
				<div class="btnPass" id="lkqd" onclick="lkqd();" style="display:none;">立刻签到</div>
				<div class="btnCancel">关闭</div>
			</div>
		</div>
	</div>
</div>
<!-- 续购课程-->
<div class="component-panel" id="yyst" style="display:none;">
</div>
</div>		
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script type="text/javascript">
$('.btnCancel').click(function() {
	$('.popUpBox').hide();
	$('html,body').removeClass('popNoscroll');
});
function closed(){
	$("#yyst").hide();
    $('html,body').removeClass('ovfHiden');
};

function gotopingjia(kcid){
	e = window.event;
	e.stopPropagation();
	e.preventDefault();
	location.href = "<?php  echo $this->createMobileUrl('kcpingjia', array('schoolid' => $schoolid,'sid'=>$it['sid']), true)?>"+ '&kcid=' + kcid;	
}
function showxgks(kcid){
	e = window.event;
	e.stopPropagation();
	e.preventDefault();
	$("#yyst").empty();
	$.ajax({
		url: "<?php  echo $this->createMobileUrl('kcajax',array('op'=>'getxgtemplte'))?>",
		data: {kcid:kcid,sid:"<?php  echo $it['sid'];?>",schoolid:"<?php  echo $schoolid;?>",userid:"<?php  echo $it['id'];?>"},	
		dataType: 'html',
		type: "post",
		success: function (datas) {
			if ($.trim(datas)) {
				$('#yyst').append(datas);
				$("#yyst").show();
               $('html,body').addClass('ovfHiden');
               // $('body,html').animate({scrollTop:0},1);

            } else {
				jTips('获取数据失败');
			}
		}
	});	
};
function lkqd() {
	jConfirm('老师确认后会扣除您的课时，确认签到吗？', '', function(r) {
		if (r) {
			var kcid = $("#kcid").val();
			$.ajax({
				url: "<?php  echo $this->createMobileUrl('kcajax',array('op'=>'skcsign'))?>",
				data: {kcid:kcid,schoolid:"<?php  echo $schoolid;?>",weid:"<?php  echo $weid;?>",sid:"<?php  echo $it['sid'];?>"},	
				dataType: 'json',
				type: "post",
				success: function (data) {
					jTips(data.msg, function () {
						if(data.result){
							var mydate = new Date();
							var hour = mydate.getHours(); 
							var minu = mydate.getMinutes();
							htmls = "<div class='famiyls'><div class='left'><div class='left_name'>时间"+hour+":"+minu+"</div></div><div class='right'><span>等待老师确认</span><div class='qdbtnre'></div></div></div>";
							$("#family").prepend(htmls);
							$("#nolist").hide();
						}
						return true;
					});
				}
			});
		}
	});
}

function qd(ksid) {
	jConfirm('老师确认才会生效，确认签到吗？', '', function(r) {
		if (r) {
			var kcid = $("#kcid").val();
			$.ajax({
				url: "<?php  echo $this->createMobileUrl('kcajax',array('op'=>'skcsign'))?>",
				data: {kcid:kcid,ksid:ksid,schoolid:"<?php  echo $schoolid;?>",weid:"<?php  echo $weid;?>",sid:"<?php  echo $it['sid'];?>"},	
				dataType: 'json',
				type: "post",
				success: function (data) {
					jTips(data.msg, function () {
						if(data.result){
							$("#qdbtn"+ksid).hide();
							$("#qd_word"+ksid).html("等待老师确认");
						}
						return true;
					});
				}
			});
		}
	});
}
function del_sign(signid) {
	jConfirm('确认删除本次记录，确认吗？', '', function(r) {
		if (r) {
			$.ajax({
				url: "<?php  echo $this->createMobileUrl('kcajax',array('op'=>'delsign_one'))?>",
				data: {signid:signid,schoolid:"<?php  echo $schoolid;?>",weid:"<?php  echo $weid;?>",sid:"<?php  echo $it['sid'];?>"},	
				dataType: 'json',
				type: "post",
				success: function (data) {
					jTips(data.msg, function () {
						if(data.result){
							$("#sinlist"+signid).hide();
						}
						return true;
					});
				}
			});
		}
	});
}

function qd_list(kcid) {
	e = window.event;
	e.stopPropagation();
	e.preventDefault();
	$('.popUpBox').show();
	$('#lkqd').hide();
	$("#family").empty();
	$("#kcid").val(kcid);
	$.ajax({
		url: "<?php  echo $this->createMobileUrl('kcajax', array('op' => 'get_kslist'), true)?>",
		type: 'POST',
		dataType: 'json',
		data: {
			kcid: kcid,
			sid: "<?php  echo $it['sid'];?>",
			schoolid:"<?php  echo $schoolid;?>"
		},
		success: function(data) {
			if (data.result) {
				var kslist = data.kslist;
				var OldOrNew = data.OldOrNew;
				if(OldOrNew == 1){
					$('#lkqd').show();
				}
				var htmls = "";
				if (kslist.length > 0) {
					for (var i = 0; i < kslist.length; i++) {
						var ksid = kslist[i].id;
						var sdname = kslist[i].sdname;
						var qdtime = kslist[i].qdtime;
						var isqd = kslist[i].isqd;
						var teacher = kslist[i].teacher;
						var avatar = "<?php echo OSSURL;?>public/mobile/img/B_gou.png";
						if(OldOrNew == 0){
							var isqr= kslist[i].isqr;
							if(isqd){
								if(isqr){
									htmls += "<div class='famiyls'><div class='left'><div class='left_name'>"+sdname+"</div></div><div class='right'><span>老师已确认</span><div class='qdbtnre'><img src="+avatar+"></div></div></div>";
								}else{
									htmls += "<div class='famiyls'><div class='left'><div class='left_name'>"+sdname+"</div></div><div class='right'><span>等待老师确认</span><div class='qdbtnre'></div></div></div>";
								}
							}else{
								htmls += "<div class='famiyls' id="+ksid+"><div class='left'><div class='left_name'>"+sdname+"</div></div><div class='right'><span id='qd_word"+ksid+"'>未签到</span><div class='qdbtn' id='qdbtn"+ksid+"' onclick='qd(" + ksid + ");'>签到</div></div></div>";
							}
						}
						if(OldOrNew == 1){
							var isqr= kslist[i].isqr;
							var singid= kslist[i].id;
							if(isqr){
								htmls += "<div class='famiyls'><div class='left'><div class='left_name'>"+sdname+"</div></div><div class='right'><span>老师已确认</span><div class='qdbtnre'><img src="+avatar+"></div></div></div>";
							}else{
								htmls += "<div class='famiyls' id='sinlist"+singid+"'><div class='left'><div class='left_name'>"+sdname+"</div></div><div class='right'><span>等待老师确认</span><div class='qdbtnre'></div></div><div class='btnDeleteBox' onclick='del_sign("+singid+");return false;' style='position: relative;'><img src='<?php echo OSSURL;?>public/mobile/img/btn_delete_01.png' class='img-responsive'></div></div>";
							}	
						}
					}	
				}else{
					htmls += "<div class='famiyls' id='nolist'><div class='left'><div class='left_name'>今日未签到或无课</div></div><div class='right'><span></span><div class='qdbtnre'></div></div></div>";
				}
				$("#family").append(htmls);
			}else{
				jTips(data.msg);
			}
		}
	});
}
$(function () {
	$('body').on('click',  '.main', function(e) {
		if (!$(e.target).parent().is('.notifyImgItem')) {
			var kcid = $(this).attr('id');
			location.href = "<?php  echo $this->createMobileUrl('mykcinfo', array('schoolid' => $schoolid), true)?>"+ '&id=' + kcid;
		} 
	});
});
</script>
<?php  include $this->template('comtool/hidenwxshare');?>
<?php  include $this->template('footer');?> 