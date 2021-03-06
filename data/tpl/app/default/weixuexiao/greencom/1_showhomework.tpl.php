<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mGrzxTeacher.css?v=4.8" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/pageContent.css?v=4.80120" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/activityNotice.css?v=4.80120" />
<style>
	.answerSpan
{
    font-size: 15px;
    margin-top: 10px;
	
}
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
.slide_left_menu_ul li {height: 50px;line-height: 50px;font-size: 16px;width: 100%;box-sizing: border-box;padding: 0 10px 0 50px;overflow: hidden;position: relative;}
.slide_left_menu_ul li .user_img {width: 50px;height: 50px;position: absolute;left: -5px;top: 0;box-sizing: border-box;padding: 10px;}
.slide_left_menu_ul li .user_img img {width: 100%;height: 100%;border-radius: 50%;}
.hederRightBox {    margin-top: -25px;width: 21px;height: 100%;display: inline-block;position: absolute;right: 20px;}
.hederRightBox a {width: 100%;height: 21px;display: inline-block;position: absolute;transform: translateY(-50%);-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);}
.btnBack {position: fixed;right: 10px;bottom: 95px;width: 55px;height: 55px;background-color: rgba(255, 159, 34, 1) !important;text-align: center;line-height: 50px;border-radius: 50% 50%;color: white !important;font-size: 16px;}
</style>
<?php  echo register_jssdks();?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>
</head>
<body>
<div id="titlebar" class="header mainColor">
	<div class="l">
		<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
	</div>
	<div class="m">
		<span style="font-size: 18px"><?php  echo $student['s_name'];?>的回答</span>   
	</div>
	
</div>
<div id="titlebar_bg" class="_header"></div>
	<header class="headerTtitle">
		<h3 class="title"><?php  echo $leave['title'];?></h3>
	</header>
	<div class="publishInfo">
		<span class="source">回答：<?php  echo $student['s_name'];?></span>
		<?php  if(!empty($answer['createtime'])) { ?>
		<span class="time"><?php  echo (date('m-d H:m',$answer['createtime']))?></span>
		<?php  } else { ?>
		<span class="time"><?php  echo  (date('m-d H:m',$testAA['createtime']))?></span>
		<?php  } ?>
		<span class="read"></span>	
	</div>
	<?php  if(empty($ZY_contents)) { ?>
	<?php  if(!empty($leave['anstype'])) { ?>
		<div class="publishInfo">
			<span class="source">包含内容：</span>
			<?php  if($anstype['is_txt'] == 1 ) { ?><span class="text_btn">文字</span><?php  } ?>
			<?php  if($anstype['is_img'] == 1 ) { ?><span class="pic_btn">图片</span><?php  } ?>
			<?php  if($anstype['is_audio'] == 1 ) { ?><span class="voice_btn">语音</span><?php  } ?>
			<?php  if($anstype['is_video'] == 1 ) { ?><span class="video_btn">视频</span><?php  } ?>
		</div>
	<?php  } ?>
	<div class="content">
		<p style="color:blue">该生回答：</p>
		<p id="neirong"><?php  echo htmlspecialchars_decode($answer['MyAnswer']['text'])?></p><br/>
		<?php  if(empty($answer['MyAnswer'])) { ?>
		<span style="color:red">该生暂未回答问题</span><br/>
		<?php  } ?>
		<?php  if($answer['MyAnswer']['video']) { ?>
			<video id="videocon" controls width="100%"  height="264" poster="<?php  echo tomedia($school['logo']);?>" webkit-playsinline playsinline>
				<source src="<?php  echo tomedia($answer['MyAnswer']['video'])?>" type='video/mp4' />
				<p class="vjs-no-js">你的浏览器不支持该视频</a></p>
			</video>
		<?php  } ?>
		<?php  if($answer['MyAnswer']['audio']) { ?>
			<div class="app-audio" style="undefinedanimation:undefined;box-sizing: border-box;">
				<div class="inner" style="text-align: left;position: relative;">
					<div id="audio-music-4" data-reload="false" class="wx audioLeft clearfix" data-src="<?php  echo tomedia($answer['MyAnswer']['audio'])?>">
						<img style="width: 40px;height: 40px;display: inline-block;" alt="语音头像" class="audioLogo" width="40" height="40" src="<?php  if($student['icon']) { ?><?php  echo tomedia($student['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>">
						<span class="audioBar js-play" style="display: block; margin: 5px 0;width: 185px; height: 42px;display: inline-block;left: 55px; top: 0; background: url(./resource/images/app/sprite_v5.png) 0 0 no-repeat;background-size: 400px 175px;cursor: pointer;">
							<img style="display:none" src="./resource/images/app/player.gif" class="audioAnimation" data-garbage="true">
							<i style="display: block;margin: 12px 15px;width: 13px;height: 17px;left: 21px;top: 12px;z-index: 2;background: url(./resource/images/app/sprite_v5.png) 0 0 no-repeat;background-size: 400px 175px;background-position: -180px -105px;" class="audioStatic"></i>
							<span style="" class="audioLoading" data-garbage="true"><i class="fa fa-spinner fa-pulse"></i></span>
						</span>
						<span style="position: absolute; font-size: 14px;color: #999;left: 250px;bottom: 5px;" class="audio-time"><?php  echo $answer['MyAnswer']['audiotime'];?>’</span>
						<div class="js-audio-wx" data-id="audio-music-4" id="jp_jplayer_1" style="width: 0px; height: 0px;">
							<img id="jp_poster_1" style="width: 0px; height: 0px; display: none;">
							<audio id="jp_audio_1" autoplay="autoplay" preload="none" src="<?php  echo tomedia($answer['MyAnswer']['audio'])?>"></audio>
						</div>
					</div>
				</div>
			</div>				
		<?php  } ?>			
		<?php  if(!empty($answer['MyAnswer']['picarr']['p1'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p1']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p2'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p2']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p3'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p3']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p4'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p4']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p5'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p5']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p6'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p6']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p7'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p7']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p8'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p8']);?>" alt="" /><?php  } ?>
		<?php  if(!empty($answer['MyAnswer']['picarr']['p9'])) { ?><br/><img src="<?php  echo tomedia($answer['MyAnswer']['picarr']['p9']);?>" alt="" /><?php  } ?>
	<?php  if(!empty($answer['MyAnswer'])) { ?>
	<?php  if(!empty($teaPy_p)) { ?>
	<span class="answerSpan " style="color:blue">&nbsp;<?php  echo $teaPy_p['tname'];?>老师的批阅：</span></br><span class="answerSpan " style="color:#D2691E">&nbsp;<?php  echo $teaPy_p['content'];?></span>
	<?php  } ?>
	<?php  } ?>
	<!--电脑端发布的单选多选式作业-->
	<?php  } else if(!empty($ZY_contents)) { ?>
	<?php  if(!empty($testAA)) { ?>
	
<div class="questionContent">
	
			<div class="questionBox">
				 <p style="color:blue">该生答题情况：</p>
					  	
				<?php  if(is_array($ZY_contents)) { foreach($ZY_contents as $key => $row) { ?>
				 
					<!--单选题-->
					 <?php  if($ZY_contents[$key]['type'] == '1') { ?>
					 
					 <div class="question" name="<?php  echo $ZY_contents[$key]['qorder'];?>" tag="a"><b> <?php  echo $ZY_contents[$key]['qorder'];?>.&nbsp<?php  echo $ZY_contents[$key]['title'];?></b>
					 <?php  if(is_array($ZY_contents[$key]['content'])) { foreach($ZY_contents[$key]['content'] as $keys => $rows) { ?>
				
						 <?php  if($testAA[$ZY_contents[$key]['qorder']] == $keys ) { ?>
						 	 <p class="answerOption"><span class="radioOptionsIco" readonly>
						  <img src="<?php echo OSSURL;?>public/mobile/img/radioChecked_01.png" alt="图片无法显示" class="img-unresponsive" readonly>
							  <?php  } else { ?>
							   <p class="answerOption"><span class="radioOptionsIco">
                                        <img src="<?php echo OSSURL;?>public/mobile/img/radioNochecked_02.png" alt="图片无法显示" class="img-responsive">
	                                        <?php  } ?>
                                        <input type="radio" name="answerOption_<?php  echo $ZY_contents[$key]['qorder'];?>" tag="<?php  echo $keys;?>">
                                    </span>
<?php  echo $ZY_contents[$key]['content'][$keys]['title'];?> <?php  if(((!empty($testAA))&&($ZY_contents[$key]['content'][$keys]['is_answer'] == "Yes"))) { ?><span style="color:red;">  【正确答案】</span><?php  } ?>
                                    
                                    </p>
					<?php  } } ?>
					</div>
					<!--多选题-->
					<?php  } else if($ZY_contents[$key]['type'] == '2') { ?>
					<div class="question" name="<?php  echo $ZY_contents[$key]['qorder'];?>" tag="b">
						<b> <?php  echo $ZY_contents[$key]['qorder'];?>.&nbsp<?php  echo $ZY_contents[$key]['title'];?></b>
					 <?php  if(is_array($ZY_contents[$key]['content'])) { foreach($ZY_contents[$key]['content'] as $keys => $rows) { ?>


 <p class="answerOption">
					<span class="checkBoxOptionsIco">
						
	<?php  if(in_array($keys, $testAA[$ZY_contents[$key]['qorder']]) ) { ?>
					 <img src="<?php echo OSSURL;?>public/mobile/img/checkBoxChecked_01.png" alt="图片无法显示" class="img-responsive">
				<?php  } else { ?>
									<img src="<?php echo OSSURL;?>public/mobile/img/checkBoxNochecked_02.png" alt="图片无法显示" class="img-responsive">	<?php  } ?>
										
									<input type="checkbox" name="answerOption_<?php  echo $ZY_contents[$key]['qorder'];?>" tag="<?php  echo $keys;?>">
								</span>
<?php  echo $ZY_contents[$key]['content'][$keys]['title'];?><?php  if(((!empty($testAA))&&($ZY_contents[$key]['content'][$keys]['is_answer'] == "Yes"))) { ?><span style="color:red;">  【正确答案】</span><?php  } ?>

				</p>
				
				<?php  } } ?>
				</div>
				<!--问答题-->
					<?php  } else if($ZY_contents[$key]['type'] == '3') { ?>
					<div class="question" name="<?php  echo $ZY_contents[$key]['qorder'];?>" tag="c">
						 <b><?php  echo $ZY_contents[$key]['qorder'];?>.&nbsp<?php  echo $ZY_contents[$key]['title'];?></b>
					<p class="answerOption">
					
					<span style="font-size:15px;color:blue">&nbsp; 该生回答：</span>
					<?php  if(!empty($testAA[$ZY_contents[$key]['qorder']]) ) { ?>
					<span class="answerSpan "><?php  echo $testAA[$ZY_contents[$key]['qorder']];?></span>
					<?php  } else { ?>
					<span class="answerSpan " style="color:orange">该生未回答</span>
					<?php  } ?>
					</br>
					<span style="font-size:15px;color:red">【答题要点】</span><span style="font-size:15px;color:green"><?php  echo $ZY_contents[$key]['content'];?></span></br>
					<?php  if(!empty($testAA[$ZY_contents[$key]['qorder']]) ) { ?>
					<?php  if(!empty($teaPy)) { ?>
					<span class="answerSpan " style="color:blue">&nbsp;<?php  echo $teaPy['tname'];?>老师的批阅：</span></br><span class="answerSpan " style="color:#D2691E">&nbsp;<?php  echo $teaPy[$ZY_contents[$key]['qorder']];?></span>
					<?php  } ?>
					<?php  } ?>
							
					</p>
					</div>
					<?php  } ?>
					
					 
					 <?php  } } ?>
					 <?php  if(empty($testAA)) { ?>
					
					 <?php  } ?>
				</div>
				</div>
				<?php  } else { ?>
				<span style="color:red">该生暂未回答问题</span><br/>
				<?php  } ?>
	<?php  } ?>

<?php  include $this->template('comad');?>

<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<?php  include $this->template('port');?>
<script>

function isSelect(sid){
	jTips("数据加载中！···");
	location.href = "<?php  echo $this->createMobileUrl('rehomework', array('schoolid' => $schoolid,'noticeid'=>$noticeid,'bj_id'=>$bj_id), true)?>"+ '&sid=' + sid;
}
WeixinJSHideAllNonBaseMenuItem();
/**微信隐藏工具条**/
function WeixinJSHideAllNonBaseMenuItem(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			
			wx.hideAllNonBaseMenuItem();
		});
	}
}


$(function () {
	//背景音乐播放
	var myaudio = document.getElementById("jp_audio_1");
	//myaudio.play();
	$(".audioBar").on("touchstart", function (e) {
		e.stopPropagation();
		if ($(this).hasClass("on")) {
			myaudio.pause();
		} else {
			myaudio.play();
		}
	});
});	
</script>
<?php  include $this->template('newfooter');?> 
</html>