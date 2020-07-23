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
<link href="<?php echo OSSURL;?>public/mobile/css/wx_sdk.css" rel="stylesheet" />
<?php  include $this->template('bjqcss');?>
<style>
	.hederRightBox a {
		top:unset;
	}
	.img-responsive {
    display: block !important;
    width: 100% !important;
    height: auto !important;
}
	.add_video_btn {
    background: url(https://weimeizhanoss.oss-cn-shenzhen.aliyuncs.com/public/mobile/img/record_icon.png) no-repeat center;
    background-size: 26px;
    float: left;
    width: 30px;
    height: 45px;
    padding: 0 5px;
}
	.answerSpan
{
    font-size: 15px;
    margin-top: 10px;

}.topic_send_btn1 {position: absolute;right: 10px;width: 80px;height: 35px;line-height: 35px;background: #e5457f;font-size: 16px;border-radius: 5px;color: #fff;text-align: center;position: absolute;right: 10px;}
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
<?php  if(is_showgkk()) { ?>
<body>
<div id="titlebar" class="header mainColor">
	<div class="l">
		<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="<?php  echo $this->createMobileUrl('zuoye', array('schoolid' => $schoolid,'id'=>$noticeid), true)?>"></a>
	</div>
	<div class="m">
		<span style="font-size: 18px"><?php  echo $student['s_name'];?>的回答</span>
	</div>
	<div class="hederRightBox">
        <a href="javascript:;" class="choice_baby">
            <img src="<?php echo OSSURL;?>public/mobile/img/selectMean.png" class="img-responsive">
        </a>
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
	<?php  if(empty($teaPy_p)) { ?>
		<textarea name="txtAnswerOption" cols="3" rows="4" placeholder="请输入批阅" tag="<?php  echo $noticeid;?>" ></textarea>
	</div>

	<input type="hidden" name="noticeid" value="<?php  echo $noticeid;?>">
	<button type="button" id="btSubmit">提交</button>
	<?php  } else { ?>
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
					<?php  if(empty($teaPy)) { ?>
					<textarea name="txtAnswerOption" cols="3" rows="4" placeholder="请输入批阅" tag="<?php  echo $ZY_contents[$key]['qorder'];?>" ></textarea>
					<?php  } else { ?>
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
				<?php  if(empty($teaPy)) { ?>
				<button type="button" id="btSubmit">提交</button>
				<?php  } ?>
				<?php  } else { ?>
				<span style="color:red">该生暂未回答问题</span><br/>
				<?php  } ?>
	<?php  } ?>
	 <?php  if(!empty($answer['MyAnswer']) || !empty($testAA) ) { ?>
	<a href="<?php  echo $this->createMobileUrl('bjqfabu', array('schoolid' => $schoolid,'noticeid'=>$noticeid,'sid'=>$sid,'bj_id'=>$bj_id,'op'=> 'fxzy'), true)?>" class="btnBack">分享</a>
	<?php  } ?>
<div class="slide_left_menu_bg <?php  if(empty($_GPC['sid'])) { ?>show_menu_bg<?php  } ?>">
    <div class="slide_left_menu">
        <div class="slide_left_menu_til"><?php  echo $nowbj['sname'];?></div>
        <ul class="slide_left_menu_ul">
		<?php  if(is_array($allstud)) { foreach($allstud as $row) { ?>
			<li onclick="isSelect(<?php  echo $row['id'];?>);" <?php  if($sid == $row['id']) { ?>class="act"<?php  } ?>>
				<div class="user_img">
					<img src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>">
				</div>
				<div><?php  echo $row['s_name'];?><?php  if(CheckIsAsnwered($row['id'],$noticeid)) { ?><span style="color:red">(已答)</span><?php  } ?></div>
			</li>
		<?php  } } ?>
		</ul>
    </div>
</div>

<?php  include $this->template('comad');?>

<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<?php  include $this->template('port');?>
<script>
<?php  if(empty($_GPC['sid'])) { ?>
$(".choice_baby").on("click", function(e) {
	e.stopPropagation();
	$(".slide_left_menu_bg").addClass("show_menu_bg");
});
$(".slide_left_menu_bg").on("click", function() {
	$(this).removeClass("show_menu_bg");
});
<?php  } else { ?>
$(".choice_baby").on("click", function(e) {
	e.stopPropagation();
	$(".slide_left_menu_bg").addClass("show_menu_bg");
});
$(".slide_left_menu_bg").on("click", function() {
	$(this).removeClass("show_menu_bg");
});
<?php  } ?>
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


<?php  if(!empty($sid)) { ?>

	$("#btSubmit").click(function () {
		<?php  if(!empty($ZY_contents)) { ?>
		//电脑创建的作业
			btnSubmit_C();
		<?php  } else { ?>
		//手机创建的作业
			btnSubmit_P();
		<?php  } ?>

	});
	<?php  if(empty($ZY_contents)) { ?>
	//提交 _P
	function btnSubmit_P() {
		var zy_sid          = <?php  echo $sid;?>;
		var zy_tid          = <?php  echo $it['tid'];?>;
		var zy_weid         = <?php  echo $weid;?>;
		var zy_schoolid     = <?php  echo $schoolid;?>;
		var zy_noticeid     = <?php  echo $noticeid;?>;
		var txtQueAnswerId  = $(".content").find("[name=txtAnswerOption]").attr("tag");
		var txtAnserContent = $(".content").find('[name=txtAnswerOption]').val();

		var txtItemJson = "";

		if( txtAnserContent.indexOf('"') != -1 )
		{
		    txtAnserContent1 = txtAnserContent.replace(/"/g,"“");
		}else{
			txtAnserContent1 = txtAnserContent ;
		}
		if (txtAnserContent != "") {
                txtItemJson += "{\"noticeid\":\"" + zy_noticeid +  "\",\"huida\":\"" + txtAnserContent1 + "\"},";
		}
		if (txtItemJson != "") {
            txtItemJson = "[" + txtItemJson.substr(0, txtItemJson.length - 1) + "]";
        } else {
            jTips("还没填写任何内容！不能提交哦");
            return false;
        }
        alert(txtItemJson);
        jConfirm('提交批阅后不可修改，是否确认提交？', '确认对话框', function (r){
	        if(r){
		$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'tjpy_p'))?>",{"tid":zy_tid, "sid":zy_sid,"weid":zy_weid,"schoolid":zy_schoolid,"userid":<?php  echo $it['id'];?>, "txtQuestionnaireId": zy_noticeid, "txtItemJson": txtItemJson },function(data){
					// if(data.result){
					// 	jTips(data.info);
					// 	 location.reload();
					// }else{
					// 	jTips(data.info);
					// 	location.reload();
					// }
		},'json');}else{
			return false;
		}});
	};
	<?php  } else { ?>
    //提交 _C
	function btnSubmit_C() {
		var zy_sid      = <?php  echo $sid;?>;
		var zy_tid      = <?php  echo $it['tid'];?>;
		var zy_weid     = <?php  echo $weid;?>;
		var zy_schoolid = <?php  echo $schoolid;?>;
		var zy_noticeid = <?php  echo $noticeid;?>;

		var txtItemJson = "";
		var d = 0;
		$(".questionContent").find('.question').each(function () {
			d++;
			var txtQueId = $(this).attr("name");
			var txtQueType = $(this).attr("tag");
			//问答题
			if (txtQueType == "c") {
				var txtQueAnswerId = $(this).find("[name=txtAnswerOption]").attr("tag");
				var txtAnserContent = $(this).find('[name=txtAnswerOption]').val();

				if( txtAnserContent.indexOf('"') != -1 )
				{
				    txtAnserContent1 = txtAnserContent.replace(/"/g,"“");
				}else{
					txtAnserContent1 = txtAnserContent ;
				}
				//alert(txtAnserContent1);
				if (txtAnserContent != "") {
                        txtItemJson += "{\"tmid\":\"" + txtQueId + "\",\"type\":\"" + txtQueType + "\",\"huida\":\"" + txtAnserContent1 + "\"},";
				}
			}

		});
        if (txtItemJson != "") {
            txtItemJson = "[" + txtItemJson.substr(0, txtItemJson.length - 1) + "]";
        } else {
            jTips("还没填写任何内容！不能提交哦");
            return false;
        }
        //alert(txtItemJson);
		    jConfirm('提交批阅后不可修改，是否确认提交？', '确认对话框', function (r){
	        if(r){
		$.post("<?php  echo $this->createMobileUrl('indexajax',array('op'=>'tjpy_c'))?>",{"tid":zy_tid, "sid":zy_sid,"weid":zy_weid,"schoolid":zy_schoolid,"userid":<?php  echo $it['id'];?>, "txtQuestionnaireId": zy_noticeid, "txtItemJson": txtItemJson },function(data){
					// if(data.result){
					// 	jTips(data.info);
					// 	 location.reload();
					// }else{
					// 	jTips(data.info);
					// 	location.reload();
					// }
		},'json');}else{
			return false;
		}});
	};
	<?php  } ?>
	<?php  } ?>
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
<?php  } else { ?>
<body>
<div id="titlebar" class="header mainColor">
	<div class="l">
		<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
	</div>
	<div class="m">
		<span style="font-size: 18px"><?php  echo $student['s_name'];?>的回答</span>
	</div>
	<div class="hederRightBox">
        <a href="javascript:;" class="choice_baby">
            <img src="<?php echo OSSURL;?>public/mobile/img/selectMean.png" class="img-responsive">
        </a>
    </div>
</div>
<div id="titlebar_bg" class="_header"></div>
	<div class="headerTtitle">
		<h3 class="title"><?php  echo $leave['title'];?></h3>
	</div>
	<div class="publishInfo">
		<span class="source">回答：<?php  echo $student['s_name'];?></span>
		<span class="time"><?php  echo (date('m-d H:m',$answer['createtime']))?></span>
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
						<span id="Forstu" class="audioBar js-play .Forstu" style="display: block; margin: 5px 0;width: 185px; height: 42px;display: inline-block;left: 55px; top: 0; background: url(./resource/images/app/sprite_v5.png) 0 0 no-repeat;background-size: 400px 175px;cursor: pointer;">
							<img style="display:none" src="./resource/images/app/player.gif" class="audioAnimation" data-garbage="true">
							<i style="display: block;margin: 12px 15px;width: 13px;height: 17px;left: 21px;top: 12px;z-index: 2;background: url(./resource/images/app/sprite_v5.png) 0 0 no-repeat;background-size: 400px 175px;background-position: -180px -105px;" class="audioStatic"></i>
							<span style="" class="audioLoading" data-garbage="true"><i class="fa fa-spinner fa-pulse"></i></span>
						</span>
						<span style="position: absolute; font-size: 14px;color: #999;left: 250px;bottom: 5px;" class="audio-time"><?php  echo $answer['MyAnswer']['audiotime'];?>’</span>
						<div class="js-audio-wx" data-id="audio-music-4" id="jp_jplayer_1" style="width: 0px; height: 0px;">
							<img id="jp_poster_1" style="width: 0px; height: 0px; display: none;">
							<audio id="jp_audio_1" preload="none" src="<?php  echo tomedia($answer['MyAnswer']['audio'])?>"></audio>
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
	</div>
	<?php  if(!empty($remark)) { ?>
	<div class="content">
		<p style="color:blue">老师批阅：</p>
		<p id="neirong"><?php  echo htmlspecialchars_decode($remark['content'])?></p><br/>
		<?php  if($remark['video']) { ?>
			<video id="videocon" controls width="100%"  height="264" poster="<?php  echo tomedia($school['logo']);?>" webkit-playsinline playsinline>
				<source src="<?php  echo tomedia($remark['video'])?>" type='video/mp4' />
				<p class="vjs-no-js">你的浏览器不支持该视频</a></p>
			</video>
		<?php  } ?>
		<?php  if($remark['audio']) { ?>
			<div class="app-audio" style="undefinedanimation:undefined;box-sizing: border-box;">
				<div class="inner" style="text-align: left;position: relative;">
					<div id="audio-music-5" data-reload="false" class="wx audioLeft clearfix" data-src="<?php  echo tomedia($remark['audio'])?>">
						<img style="width: 40px;height: 40px;display: inline-block;" alt="语音头像" class="audioLogo" width="40" height="40" src="<?php  if($student['icon']) { ?><?php  echo tomedia($student['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>">
						<span id="forTea" class="audioBar js-play forTea" style="display: block; margin: 5px 0;width: 185px; height: 42px;display: inline-block;left: 55px; top: 0; background: url(./resource/images/app/sprite_v5.png) 0 0 no-repeat;background-size: 400px 175px;cursor: pointer;">
							<img style="display:none" src="./resource/images/app/player.gif" class="audioAnimation" data-garbage="true">
							<i style="display: block;margin: 12px 15px;width: 13px;height: 17px;left: 21px;top: 12px;z-index: 2;background: url(./resource/images/app/sprite_v5.png) 0 0 no-repeat;background-size: 400px 175px;background-position: -180px -105px;" class="audioStatic"></i>
							<span style="" class="audioLoading" data-garbage="true"><i class="fa fa-spinner fa-pulse"></i></span>
						</span>
						<span style="position: absolute; font-size: 14px;color: #999;left: 250px;bottom: 5px;" class="audio-time"><?php  echo $remark['audiotime'];?>’</span>
						<div class="js-audio-wx" data-id="audio-music-5" id="jp_jplayer_2" style="width: 0px; height: 0px;">
							<img id="jp_poster_2" style="width: 0px; height: 0px; display: none;">
							<audio id="jp_audio_2"  preload="none" src="<?php  echo tomedia($remark['audio'])?>"></audio>
						</div>
					</div>
				</div>
			</div>
		<?php  } ?>
	</div>
	<a href="<?php  echo $this->createMobileUrl('zuoye', array('schoolid' => $schoolid,'id'=>$noticeid), true)?>" class="btnBack">返回</a>
	<?php  } else { ?>
	<div class="feedback_box">
	<div class="blank"></div>
	<div class="feedback_content_box">
		<!-- 日志内容 -->
		<textarea class="feedback_content" id="feedback_content" maxlength="100000" placeholder="请输入文字"></textarea>
		<div class="clear1"></div>
		<!-- 视频列表 -->
		<ul class="media_list"></ul>
		<div class="clear1"></div>
		<!-- 音频列表 -->
		<ul class="video_list"></ul>
		<div class="clear1"></div>
		<!-- 图片列表 -->
		<ul class="pic_list" id="pic_list"></ul>
		<div class="clear1"></div>
	</div>
</div>

    <!-- 录音弹出框 -->

<div class="babysay_bg">
    <div class="say_time_box">
        <div class="say_time_level"></div>
    </div>
    <div class="babysay_box">
        <div class="say_btn1 record_btn"></div>

        <div class="say_tips1">点击话筒开始录音吧</div>
        <div class="say_tips2">时长不超过<span class="pink_f">60</span>秒</div>

    </div>
</div>
<!--收藏夹start  -->
<div class="select_type_bg">
    <div class="media_upload_tips" style="display: none; line-height: 20px; position: fixed; bottom: 180px; left: 0; width: 100%; box-sizing: border-box; padding: 10px; color: #eee; font-size: 12px; text-align: center;">温馨提醒：为了保证您上传视频的速度，使用安卓手机用户拍摄视频请先通过 录像里面的设置功能将 录像的分辨率调低。视频文件大小不宜超过3mb。</div>
    <div class="local_audio_btn"  style="bottom:61px;" >录音</div>

    <div class="local_img_btn">本地图片</div>
    <!-- <div class="web_img_btn" >从收藏夹选择图片</div> -->
    <div id="local_media_btn" class="local_media_btn">
        <div id="local_media_btn2" style="position: relative; width: 100%; text-align: center; height: 50px;">本地视频</div>
    </div>
    <!-- <div class="web_media_btn" >从收藏夹选择视频</div> -->
    <div class="select_type_cancel">取消</div>
</div>
<div class="video_bg">
    <div class="close_video_btn">关闭</div>
</div>
<!-- 收藏夹end -->
<div class="topic_bottom" style="position: static;">
<div class="add_video_btn"></div>
	<div class="topic_send_btn1" style="margin-top: 4px;">提交</div>
</div>
	<?php  } ?>

<div class="slide_left_menu_bg <?php  if(empty($_GPC['sid'])) { ?>show_menu_bg<?php  } ?>">
    <div class="slide_left_menu">
        <div class="slide_left_menu_til"><?php  echo $nowbj['sname'];?></div>
        <ul class="slide_left_menu_ul">
		<?php  if(is_array($allstud)) { foreach($allstud as $row) { ?>
			<li onclick="isSelect(<?php  echo $row['id'];?>);" <?php  if($sid == $row['id']) { ?>class="act"<?php  } ?>>
				<div class="user_img">
					<img src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>">
				</div>
				<div><?php  echo $row['s_name'];?><?php  if(CheckIsAsnwered($row['id'],$noticeid)) { ?><span style="color:red">(已答)</span><?php  } ?></div>
			</li>
		<?php  } } ?>
		</ul>
    </div>
</div>



<?php  include $this->template('comad');?>

<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<?php  include $this->template('port');?>
<script src="<?php echo MODULE_URL;?>public/mobile/js/idangerous.swiper.min.js?v=1717"></script>

<script src="<?php echo OSSURL;?>public/mobile/js/common.js?v=1717"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/faceMap.js?v=5.61" type="text/javascript"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/wxUpload_v0.3.js?v=1717"></script>

<script src="<?php echo MODULE_URL;?>public/mobile/js/uploaderh5V3.js?v=1717"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/favorite.js?v=1717"></script>
<script>

	$(function () {
		if (window.localStorage) {
			//@---获取下拉多选缓存值
			var diary_type = localStorage.getItem("yab_parent_diary_type");
			if (diary_type != "" && diary_type != null && diary_type != "null") {
				$("#feedback_item").find("option[value='" + diary_type + "']").attr("selected", true);
			}
			//@---获取私密缓存值
			var diary_personal = localStorage.getItem("yab_parent_diary_personal");
			if (diary_personal != "" && diary_personal != null && diary_personal != "null" && diary_personal == "Y") {
				$("#is_personal").prop("checked", true);
				$("#is_personal").attr("value", "1");
				$("#is_txt").attr("value","1");
				$(".answer_type").show();
			}
			// 获取标题文本缓存值
			var diary_title = localStorage.getItem("yab_parent_diary_title");
			if (diary_title != "" && diary_title != null && diary_title != "null") {
				$("#title").val(diary_title);
			}
			// 获取日志文本缓存值
			var diary_content = localStorage.getItem("yab_parent_diary_content");
			if (diary_content != "" && diary_content != null && diary_content != "null") {
				$("#feedback_content").val(diary_content);
			}
		}

		//@---保存输入文本内容
		$("#title").bind('input propertychange', function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_title", $("#title").val());
			}
		});
		$("#feedback_content").bind('input propertychange', function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_content", $("#feedback_content").val());
			}
		});
		$("#faceImg").on('click', '.faceBox_item', function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_content", $("#feedback_content").val());
			}
		});
		//@---保存私密内容
		$("#is_personal").on("change", function () {
			if(	$("#is_personal").is(':checked')){
				$(".answer_type").show();
				$("#is_txt").attr("value","1");
				$("#is_personal").attr("value","1");
				//console.log("checked");
			}else{
				$(".answer_type").hide();
				$("#is_personal").attr("value","0");

				$("#is_img").attr("value","0");
				$("#is_audio").attr("value","0");
				$("#is_video").attr("value","0");

				$("#is_img").removeAttr("checked");
				$("#is_audio").removeAttr("checked");
				$("#is_video").removeAttr("checked");

				$("#is_img").parent(".checkBoxOptionsIco").children("img").attr("src","<?php echo OSSURL;?>public/mobile/img/checkBoxNochecked_02.png");
				$("#is_audio").parent(".checkBoxOptionsIco").children("img").attr("src","<?php echo OSSURL;?>public/mobile/img/checkBoxNochecked_02.png");
				$("#is_video").parent(".checkBoxOptionsIco").children("img").attr("src","<?php echo OSSURL;?>public/mobile/img/checkBoxNochecked_02.png");
				//console.log("not checked");
			}
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_personal", $("#is_personal").prop('checked') ? "Y" :"N");
			}
		});









		//@---保存下拉多选内容
		$("#feedback_item").on("change", function () {
			if (window.localStorage) {
				localStorage.setItem("yab_parent_diary_type", $(this).val());
			}
		});


		//点击上传视频按钮
		$('.add_video_btn2').one('click', function () {
			run_video_init();
		});

		//点击隐藏录音框
		$(".babysay_bg").on("click", function (e) {
			$(this).hide();
		});

		//点击选择表情
		$("#feedback_content ,#feedback_content_til").on("touchstart", function (e) {
			e.stopPropagation();
			$(".faceBox").css("display", "none");
		});

		//删除已选视频
		$('.media_list').on('click', '.del_btn', function (e) {
			e.stopPropagation();
			$(this).closest('.vod_li').remove();
			$('.add_video_btn2').one('click', function () {
				run_video_init();
			});

		})

		var submit_wxsdkSendData = true;
		var choose_img_params = {
			choose_img_btn: ".local_img_btn",
			upload_btn: ".topic_send_btn1", //提交按钮
			img_showlist: ".pic_list", //图片显示的列表
			record_btn: ".record_btn",
			video_btn: ".video_btn",
			video_list: ".video_list",
			del_video_btn: "delete_voice_btn",
			img_max_length: 9,
			video_max_length: 1,
			upload_img_url: "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'donwimg'))?>",     //图片的url
			upload_video_url: "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'donwvioce'))?>",   //音频的url
			wxsdkcheckForm: function () {
				// 1.这里先做校验文本框不能为空




				var is_img   = $("#is_img").val();
				var is_audio = $("#is_audio").val();
				var is_video = $("#is_video").val();
				var is_personal = $("#is_personal").val();

				var diary_content = $.trim($("#feedback_content").val());



				<?php  $word = $this->GetSensitiveWord($weid) ?>
				// 2.敏感词检查
				var sensitive_words = "<?php  echo $word;?>";
				var filter = sensitive_words.split('|');
				for (var i = 0; i < filter.length; i++) {
					var filter_word = filter[i].trim();

					if (filter_word == "")
						continue;

					if (diary_content.indexOf(filter_word) > -1) {
						jAlert("请遵守国家法律法规，请勿发布暴力、谣言、色情等言论。正文内容含有非法词语：" + filter_word);

						return false;
					}
				}

				// 验证成功
				return true;
			},
			wxsdkSendData: function (imgServerid, videoServerid, videoTime, media_receiveid) {
				if (submit_wxsdkSendData) {
					submit_wxsdkSendData = false;
					// var content = iphone_emoji_filter($("#feedback_content").val());
					var url = "<?php  echo $this->createMobileUrl('dongtaiajax',array('op'=>'t_piyue'))?>";
					var type = $('#feedback_item').val();
					var isPersonal = $("#is_personal").prop('checked')?"Y":"N";

					var content = iphone_emoji_filter($("#feedback_content").val().replace(/(#)[0-9a-zA-Z\u4e00-\u9fa5]{0,255}(#)/g,'$1$2').replace(/[#]/g,""));
					  // var content = iphone_emoji_filter($("#feedback_content").val());

					var link_title = $("#link_title").attr("data-linktitle");
					var link_address = $("#link_address").attr("data-linkaddress");

					var receiveid = [];
					var receivetime = 0;

					$(".pic_list li").not(".sdk_img_li").each(function () {
						receiveid.push($(this).children("img").attr("receive_id"));
					});
					$(".video_list li").not(".sdk_voice_li").each(function () {
						receiveid.push($(this).children("audio").attr("receive_id"));
					});
					$(".media_list li").each(function () {
						receiveid.push($(this).children(".favorites_play_icon").attr("receive_id"));
						receivetime = $(this).children("audio").attr("receive_time");
					});
					var favourite_mediaid = '';
					if ($('.media_list li').not('.vod_li').length > 0) {
						favourite_mediaid = $('.media_list li').children(".favorites_play_icon").attr("receive_id");
					}
					var data = {
						weid:"<?php  echo $weid;?>",
						openid : "<?php  echo $openid;?>",
						schoolid : "<?php  echo $schoolid;?>",
						uid:"<?php  echo $userid;?>",
						tid:"<?php  echo $it['tid'];?>",
						tname:"<?php  echo $teacher['tname'];?>",
						sid: <?php  echo $sid;?>,
						zyid :<?php  echo $noticeid;?>,
						userid:'<?php  echo $it['id'];?>',
						contentCategory: type,
						content: content,
						photoUrls: imgServerid,
						audioServerid: videoServerid,
						audioTime: videoTime,
						receiveid: receiveid,
						receivetime: receivetime,
						videoMediaId: media_receiveid,
						favourVideoMediaId: favourite_mediaid,


					}
					//jAlert("zheli");
					ajax_upload(url, data, this);
				}
			}
		};
		$.wx_upload = $.extend($.wx_upload, choose_img_params);
		$.wx_upload.init();
		wx.ready(function () {
			wx.hideAllNonBaseMenuItem();
			wx.onVoicePlayEnd({
				complete: function (res) {
					$.wx_upload.wxsdkonVoicePlayEnd(res.localId);
				}
			});
			wx.onVoiceRecordEnd({
				success: function (res) {
					jTips("超过1分钟!");
					$.wx_upload.wxsdkonVoiceRecordEnd(res.localId);
				}
			});
		});
		wx.error(function (res) {
			console.log(res);
			jTips("签名校验失败!");
		});
	});


	function ajax_upload(url, data, self) {

		$.ajax({
			url: url,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (result) {
				//提交后 隐藏加载层
				self.hideLoadingMsg();
				jTips(result.msg, function () {
					if (result.status == 1) {
						//clear_page_session("parent_diary_baby");
						var bj_id = $("#bj_id").val();
						localStorage.removeItem("yab_parent_diary_type");//清除本地存储
						localStorage.removeItem("yab_parent_diary_title");
						localStorage.removeItem("yab_parent_diary_personal");
						localStorage.removeItem("yab_parent_diary_content");

						window.history.back();location.reload();
					} else {
						$.wx_upload.success_img_arr = [];
						$.wx_upload.fail_local_img_arr = [];
						$.wx_upload.fail_server_img_arr = [];
						$.wx_upload.success_video_arr = [];
						$.wx_upload.fail_local_video_arr = [];
						$.wx_upload.fail_server_video_arr = [];
					}
				});

			},
			error: function () {
				//提交后 隐藏加载层
				self.hideLoadingMsg();
				$.wx_upload.success_img_arr = [];
				$.wx_upload.fail_local_img_arr = [];
				$.wx_upload.fail_server_img_arr = [];
				$.wx_upload.success_video_arr = [];
				$.wx_upload.fail_local_video_arr = [];
				$.wx_upload.fail_server_video_arr = [];
				jTips("非常抱歉，出现了点小问题，可以尝试刷新重试！");
			},
		});
	};



	//上传视频
	var if_is_upload     = false;
	var upload_wait_time = 0;
	var video_is_init = false;


	function run_video_init() {
		var ErrorCode = qcVideo.get('ErrorCode');
		var Log       = qcVideo.get('Log');
		var JSON      = qcVideo.get('JSON');
		var util      = qcVideo.get('util');
		var Code      = qcVideo.get('Code');
		var Version   = qcVideo.get('Version');
   if (!qcVideo.uploader.supportBrowser()) {
                if (Version.IS_MOBILE) {
                    alert('非常抱歉，当前浏览器不支持上传视频，请升级微信版本');
                } else {
                    alert('非常抱歉，当前浏览器不支持上传视频，请升级浏览器或者下载最新的chrome浏览器');
                }
                return;
            }

	 qcVideo.uploader.init(
			// ================ qcVideo.uploader.init()参数 START ================
			//================ 1: 上传基础条件 START ================
			{
				web_upload_url: "https://vod2.qcloud.com/v3/index.php",
				upBtnId: "local_media_btn2", //上传按钮ID

				secretId: "<?php  echo $school['txid'];?>", // 云api secretId
				secretKey: "<?php  echo $school['txms'];?>",
				 //getSignature: function (argObj, callback) {
					//  var argStr = [];
     //                   for (var arg in argObj)
     //                       argStr.push(arg + "=" + encodeURIComponent(argObj[arg]));
     //                   argStr = argStr.join("&");
					//	var url = "<?php  echo $this->createMobileUrl('bjqajax',array('op'=>'getSignature','schoolid'=> $schoolid))?>" + "&f=" + encodeURIComponent(argObj.f) + "&ft=" + encodeURIComponent(argObj.ft) + "&fs=" + encodeURIComponent(argObj.fs);
     //                   $.ajax({
     //                       'dataType': 'json',
     //                       'url': url,
     //                       'success': function (data) {
     //                           callback(data.Signature);
     //                       }
     //                   });
     //               },
				after_sha_start_upload: false, //sha计算完成后，开始上传 (默认非立即上传)
				sha1js_path: MODULE_URL + "public/mobile/js/calculator_worker_sha1.js", //计算sha1的位置
				disable_multi_selection: true, //禁用文件多选 ，默认不禁用
				classId:null,
                    // mime_types, 默认是常用的视频和音频文件扩展名，如MP4, MKV, MP3等, video_only 默认为false，可允许音频文件上传
               // filters: { max_file_size: '200mb', video_only: true }, //filters: { max_file_size: '8gb', mime_types: [], video_only: true },
                forceH5Worker: true // 使用HTML5 webworker计算
			},
			{
			/**
			* 更新文件状态和进度 param args { id: 文件ID, size: 文件大小, name: 文件名称, status: 状态, percent: 进度,speed: 速度, errorCode: 错误码 }
			*/
			//================ onFileUpdate START ================
			 onFileUpdate: function (args) {
                        switch (args.code) {
                            case Code.UPLOAD_SHA:
                                $.wx_upload.showLoadingMsg();
                                if (args.percent) {
                                    $('#progress_text').text('视频载入' + args.percent + "%");
                                } else {
                                    $('#progress_text').text('载入视频中...');
                                }

                                break;
                            case Code.UPLOAD_WAIT:
                                if (!if_is_upload) {
                                    var _media_list = '<li class="vod_li"><div class="favorites_play_icon" ></div><img src="' + ROOT_URL + "public/mobile/img/wait_check_bg.png" + '"><div class="del_btn" vod_id="' + args.id + '"></div></li>';
                                    $(".media_list").html(_media_list);
                                    $.wx_upload.hideLoadingMsg();
                                } else {
                                    upload_wait_time++;
                                    if (upload_wait_time > 5) {
                                        qcVideo.uploader.stopUpload();
                                        $.wx_upload.fail_media_id = 1;
                                        $.wx_upload.showErrorMsg();
                                        $('#progress_text').text('请稍等...');
                                        upload_wait_time = 0;
                                    }

                                }

                                break;
                            case Code.WILL_UPLOAD:
                                $('#progress_text').text('开始上传视频...');
                                break;
                            case Code.UPLOAD_PROGRESS:
                                $.wx_upload.showLoadingMsg();
                                if (args.percent) {
                                    $('#progress_text').text('视频上传' + args.percent + "%");
                                }
                                break;
                            case Code.UPLOAD_DONE:
                                $('#progress_text').text('处理视频中...');
                                $.wx_upload.success_media_id = args.serverFileId;

                                if ($.wx_upload.fail_local_img_arr.length > 0 || $.wx_upload.fail_server_img_arr.length > 0 || $.wx_upload.fail_local_video_arr.length > 0 || $.wx_upload.fail_server_video_arr.length > 0) {
                                    $.wx_upload.showErrorMsg();
                                } else {
                                    $.wx_upload.wxsdkSendData($.wx_upload.success_img_arr, $.wx_upload.success_video_arr, $.wx_upload.video_time, args.serverFileId);
                                }
                                break;
                            case Code.UPLOAD_FAIL:
                                $.wx_upload.fail_media_id = 1;
                                $.wx_upload.showErrorMsg();
                                break
                        } // END SWITCH
                    },
                    //================ 2.2: onFileUpdate END ================

                    /**
                     * 文件状态发生变化
                     * (param) info  { done: 完成数量 , fail: 失败数量 , sha: 计算SHA或者等待计算SHA中的数量 , wait: 等待上传数量 , uploading: 上传中的数量 }
                    */
                    onFileStatus: function (info) {
                        if (info.fail >= 1) {
                            // $.wx_upload.hideLoadingMsg();
                            $.wx_upload.fail_media_id = 1;
                            $.wx_upload.showErrorMsg();
                        }
                        if (info.uploading >= 1) {
                            if_is_upload = true;
                        }

                    },

                    /**
                     *  上传时错误文件过滤提示
                     * (param) args {code:{-1: 文件类型异常, -2: 文件名异常, -3: 文件大小超出限制} , message: 错误原因 ， solution: 解决方法}
                    */
                    onFilterError: function (args) {
                        $.wx_upload.hideLoadingMsg();

                        if (args.code == Code.OVER_MAX_SIZE) {
                            jAlert("非常抱歉，文件大小超出限制，请上传200MB以下的文件！");
                        }
                        else {
                            jAlert('非常抱歉，该菜单选择的文件不是正确的视频格式，请到"本地视频"菜单选择视频文件，或使用收藏夹功能上传视频。');
                        }
                    }

                }
                //================ 2: 回调函数 END ================
            );
            //================ qcVideo.uploader.init()参数 END ================

        }
        //上传视频结束


</script>
<script>
<?php  if(empty($_GPC['sid'])) { ?>
$(".choice_baby").on("click", function(e) {
	e.stopPropagation();
	$(".slide_left_menu_bg").addClass("show_menu_bg");
});
$(".slide_left_menu_bg").on("click", function() {
	$(this).removeClass("show_menu_bg");
});
<?php  } else { ?>
$(".choice_baby").on("click", function(e) {
	e.stopPropagation();
	$(".slide_left_menu_bg").addClass("show_menu_bg");
});
$(".slide_left_menu_bg").on("click", function() {
	$(this).removeClass("show_menu_bg");
});
<?php  } ?>
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
	$("#Forstu").on("touchstart", function (e) {
		var myaudio = document.getElementById("jp_audio_1");
		e.stopPropagation();
		if ($(this).hasClass("on")) {
			myaudio.pause();
		} else {
			myaudio.play();
		}
	});

	$("#forTea").on("touchstart", function (e) {
		var myaudio1 = document.getElementById("jp_audio_2");
		e.stopPropagation();
		if ($(this).hasClass("on")) {
			myaudio1.pause();
		} else {
			myaudio1.play();
		}
	});
});
</script>
<?php  } ?>

</html>
