<?php defined('IN_IA') or exit('Access Denied');?><!--正文导航-->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta content="telephone=no" name="format-detection" /> 
<meta name="google-site-verification" content="DVVM1p1HEm8vE1wVOQ9UjcKP--pNAsg_pleTU5TkFaM">
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/new_yab1.css?v=1?v=1111" />
<?php  echo register_jssdks();?>
<?php  include $this->template('port');?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<style>
.count_inf dl a {padding-right: 10px;display: block;background: url(<?php echo OSSURL;?>public/mobile/img/arrow_right.png) no-repeat right center;background-size: 8px 12px;}
/********************课程详情*******************/
#wrap.count_inf{ padding:0px; background-color: #f6f6f6;}
.count_inf #main{-webkit-box-sizing:border-box; box-sizing:border-box;background-color:#fff; margin-top: 0;margin-bottom:0px;} 
.count_inf .count_tit{ background-color: #fff; border-top: 0;}
.count_inf #main > dt { padding: 5px 0px; font: 600 16px/30px "黑体"; border-bottom: 1px dashed #bec3cf; text-align: center; color: #333; width: 100%; }
.count_inf #main .teacher{ float:left;width:88px; text-align:center;margin-left: -40px;}
.count_inf #main .teacher > div{ border-radius:50%; height:55px; width:55px; background: no-repeat center top; background-size:cover; margin:auto;}
.count_inf #main .teacher > p{ color:#666; padding:0 10px 10px;}
.count_inf #main .count_inf{ min-height:87px; font:12px/18px "黑体"; padding:10px 0 0;}
.count_inf #main .count_inf label.rq{ float:left; color:#999; width:40px;}
.count_inf #main .count_inf label.rq> a{position:relative;float: right; color: #2f9ecf; margin-right: 5px;font-size: 14px;}
.count_inf #main .count_inf li > span{ display:block; margin-left:128px; margin-right:10px; height:36px; overflow:hidden;}
.count_inf #main > .phone{ display:block; color:#666; font:12px/44px "黑体"; text-decoration:none; text-indent:36px; background:url(<?php echo OSSURL;?>public/mobile/img/phone.png) no-repeat 20px center,#fff url(<?php echo OSSURL;?>public/mobile/img/arrow_right.png) no-repeat 95% center;background-size:11px,8px 12px;}
.count_inf dl{ background-color:#fff; margin-bottom: 10px;}
.count_inf dl > dt{ min-height: 30px; padding-right: 10px; border-bottom:1px dashed #bec3cf;border-top:1px dashed #bec3cf; background-color:#ededed; text-indent:10px; font:15px/30px "黑体"; color:#666;}
.count_inf dl a{ padding-right: 10px; display: block;background: url(<?php echo OSSURL;?>public/mobile/img/arrow_right.png) no-repeat right center; background-size: 8px 12px;}
.count_inf dl > div{ padding:10px; font-size:0;}
.count_inf dl > dd{ padding: 10px;  font-size: 14px;}
.count_inf .outline_link{ float: right; color: #2f9ecf; margin-top: 0px;margin-right: 5px;font-size: 14px;}
.pt_mid_box{ width: 100%; height: 40px; background-color: #fff; }
.pt_mid_boxs{ width: 100%; height: 40px; border-top: 1px dashed #ddd; background-color: #fff; }
.pt_mid_box:after{ content: ""; width: 8px; height: 12px; position: absolute; right: 7px; margin-top: 14px; background: url(<?php echo MODULE_URL;?>public/mobile/img/right_arrow.png) no-repeat; background-position: center center; background-size: 8px 12px; }
.left_title_pt{color: #444; float: left; font-size: 15px; line-height: 39px; font-weight: bold; margin-left: 20px; }
.left_title_pt:before { content: ''; position: absolute; z-index: 0; margin-top: 12px; left: 9px; width: 4px; height: 15px; background: #06c1ae; border-radius: 3px; }
.right_xz_pt{ float: right; margin-right: 23px; line-height: 39px; color: #656565; }
/**底部描述课时列表评论**/
.info { padding-bottom: 10px; } .info_h { padding-bottom: 50px; } .info_hh { padding-bottom: 100px; } .desc { width: 100%; padding-top: 13px; } .desc .desc_title { font-size: 14px; color: #344e5d; margin-top: 15px; } .desc div { overflow: hidden;padding: 10px;} .desc img { width: 100%; vertical-align: top; } .desc .desc_p { font-size: 13px; color: #6a7a89; line-height: 13px; margin-top: 5px; } 
.catalogList { margin-bottom: 10px; padding: 13px;background: #fff; } .section { height: 30px; line-height: 30px; font-size: 14px; background-color: #e6e8ea; color: #374F5E; padding: 0 20px; margin-top: 32px;    border-radius: 20px;} .block{ width: 100%;} .catalog { font-size: 13px; color: #374F5E; font-weight: 400; line-height: 24px; margin-top: 32px; height: 30px; background-color: rgba(241, 241, 241, 0.24); width: 100%;border-radius: 5px;}  .catalog.act { color: #4e92ff;background-color: rgba(153, 199, 253, 0.24);} .catalog i { width: 13px; height: 13px; background-size: cover; float: left; margin-top: 5px; } .catalog_1 i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_movie.png"); } .catalog_1.act i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_movie_cur.png"); } .catalog_2 i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_video.png"); } .catalog_2.act i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_video_cur.png"); } .catalog_3 i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_lesson.png"); } .catalog_3.act i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_lesson_cur.png"); } .catalog_4 i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_wengao.png"); } .catalog_4.act i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_wengao_cur.png"); } .catalog_5 i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_live@2x.png"); } .catalog_5.act i { background-image: url("<?php echo MODULE_URL;?>public/mobile/img/icon_live_pressed@2x.png"); } .catalog_index { margin: 0 10px; float: left; } .catalog_br { background-size: cover; background-image: url("<?php echo MODULE_URL;?>public/mobile/img/WechatIMG57.png"); float: right; width: 30px; height: 19px; margin-top:4px; margin-right:2px; }.catalog_br_unred { background-size: cover; background-image: url("<?php echo MODULE_URL;?>public/mobile/img/unredpng.png"); float: right; width: 30px; height: 19px; margin-top:4px; margin-right:2px; } .catalog_br_lock { width: 11px; height: 16px; background-size: cover; background-image: url("<?php echo MODULE_URL;?>public/mobile/img/lock_cur.png"); float: right; margin: 5px 5px 0 0; } .catalog_title { width: 250px; float: left; word-break: break-all; word-wrap: break-word; font-size: 14px; color: #374F5E; font-weight: 400; } .catalog_title text,.act .catalog_title text { color: #fff; display: inline-block; width: 30px; height: 17px; line-height: 17px; background: #4C91FF; border-radius: 2px; font-size: 12px; text-align: center; } .act .catalog_title { color: #4e92ff; } .comment .topss { font-size: 13px; color: #374F5E; border-bottom: 1px solid #EBEEF2; padding: 20px 0; } .comment { margin: 10px auto 0; padding: 15px; } .comment .topss i {width: 50px; height: 15px; display: block; float: right; font-size: 8px; color: #868383; line-height: 46px; text-align: center; margin-top: 4px;background: url("<?php echo MODULE_URL;?>public/mobile/img/comment.png") no-repeat center center / 15px 15px; } .default { padding-top: 55px; text-align: center; font-size: 12px; color: #b3c5dd; position: relative; } .default img { width: 280px; height: 280px; } .default div { width: 100%; text-align: center; position: absolute; left: 0; bottom: 15px; } .comment_lsit { padding-top: 20px; } .comment_item { padding-left: 50px; position: relative; min-height: 40px; margin: 0 0 40px; font-size: 12px; } .comment_item img { width: 40px; height: 40px; position: absolute; left: 0; top: 10px; border-radius: 40px; } .comment_item text { display: block; } .comment_item .n { color: #4C91FF; margin-bottom: 10px; } .comment_item .c { font-size: 13px; color: #374F5E; margin-bottom: 9px; } .comment_item .t { color: #91A0B2; } .comment_item .reply { background: #FAFBFC; padding: 12px; margin-top: 20px;border-radius: 7px;} .comment_tips { color: #AEC1D9; font-size: 11px; text-align: center; margin-bottom: 30px; } .comment_tips i { display: inline-block; margin: 0 20px; } .content{width:90%;margin:0 5%;color:#333333;line-height:30px;padding-bottom:20px;word-break:break-all;word-wrap:break-word;} .content p{margin:0 !important;} .content span{margin-bottom:10px;} .content img{max-width:100%;margin:5px 0;} .content .nodata{margin:0 auto;/* width:70%; */background:#eee;border:1px solid #aaa;padding:10px;border-radius:5px;} .content .nodata span{font-size:14px;color:#999;display:block;width:100%;margin:0;} .content .nodata a{font-size:14px;color:red;}.audio_div{width:100%;margin-top: 10px;display:none;} .play_video_box{width:100%;margin-top: 10px;display:none;} .conent_div{width:100%;margin-top: 10px;height: auto;display:none;} .ppt_box{width:100%;margin-top: 10px;height: auto;display:none;} .goto_wendang{text-align: center; margin-left: 33%;} .pointicon{ width: 15px; height: 15px; display: inline-block; background: url(<?php echo MODULE_URL;?>public/mobile/img/down_point.png) no-repeat center center / 15px 15px; margin: 8px -10px 0px 15px; float:right; } .up{ width: 15px; height: 15px; display: inline-block; background: url(<?php echo MODULE_URL;?>public/mobile/img/up_point.png) no-repeat center center / 15px 15px; margin: 8px -10px 0px 15px; float:right; } .conent_load{width: 15px; height: 19px; display: inline-block; background: url(<?php echo MODULE_URL;?>public/mobile/img/gh_xh_wating.gif) no-repeat center center / 15px 19px; margin-left: 10px;}.coments{width:100%;height: auto;} 
.press{ background-color: #6db9ef; width: 72%;margin-left: 11px; float: left; margin-top: 11px; position: relative; height: 19px; border-radius: 18px; line-height: 20px; font-size: 11px; color: #fff; font-weight: bold; overflow: hidden; }
.footer_press{background-color: #30c6e1;position: absolute;border-radius: 16px;text-align: center;}
</style>
</head>
<body>
    <div id="wrap" class="count_inf">
        <dl id="main">
            <dt class="count_tit"><?php  echo $kcinfo['name'];?></dt>
            <dd class="count_inf">
                <div class="teacher">
                    <div style=" background-image:url(<?php  if(!empty($teacher['thumb'])) { ?><?php  echo tomedia($teacher['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>)"></div>
                    <p><?php  echo $teacher['tname'];?></p>
                </div>
                <ul>
                    <li><label>日期：</label>
                    <?php  echo date('Y/m/d',$kcinfo['start'])?>-<?php  echo date('Y/m/d',$kcinfo['end'])?>
                    </li>
                    <?php  if($kmname['sname']) { ?><li><label>科目：</label><?php  echo $kmname['sname'];?></li><?php  } ?>
                    <?php  if($kcinfo['kc_type'] == 1) { ?>
						<li><label><?php  if($menunub>0) { ?><?php  echo $menunub;?>个章节 |</label> <?php  echo $number-1?>节课程<?php  } ?></li>
					<?php  } else { ?>
						<li><label>教室：</label><?php  echo $jsname['sname'];?></li>
					<?php  } ?>
                    <li><label>授课教师：</label><?php  echo $tname_array_end;?></li>
                    <?php  if($kcinfo['OldOrNew'] == 1 || $kcinfo['ReNum'] != 0) { ?>
                    <li><label>总课时/已购课时：</label><?php  echo $kcinfo['AllNum'];?>/<?php  if(!empty($ygks)) { ?><?php  echo $ygks['ksnum'];?><?php  } else { ?>0<?php  } ?>课时<a class="outline_link" onclick="showxgks()" id="xgks">续购</a></li>
                    <?php  } ?>
                </ul>
            </dd> 	
        </dl>
		<div class="pt_mid_boxs">
			<div class="left_title_pt">学习进度</div>
			<div class="press">
				<span style="width: <?php  echo $jdbili;?>%;" class="footer_press"><?php  echo $read;?>/<?php  echo $number-1?>课</span>
			</div>
		</div>
		<div class="pt_mid_box mb_marsk">
			<a href="<?php  echo $this->createMobileUrl('kcdg', array('id' => $kcinfo['id'],'schoolid' => $schoolid), true)?>" >
				<div class="left_title_pt">课程大纲</div>
				<div class="right_xz_pt">查看详情</div>
			</a>	
		</div>
		<?php  if($kcinfo['allow_pl'] == 1) { ?>
		<div class="pt_mid_box mb_marsk">
			<a href="<?php  echo $this->createMobileUrl('kcpingjia', array('schoolid' => $schoolid,'sid'=>$it['sid'],'kcid'=>$id), true)?>" >
				<div class="left_title_pt">课程评论</div>
				<div class="right_xz_pt">前去评论</div>
			</a>	
		</div>
		<?php  } ?>
		<div class="pt_mid_boxs">
			<div class="left_title_pt">课程安排</div>
		</div>
	</div>
	<div class="catalogList" style="display:block">
		<div style="margin-top: -34px;">
		<?php  if(is_array($menulist)) { foreach($menulist as $kcinfo) { ?>
			<div class="section"><?php  echo $kcinfo['name'];?><i class="up pointicon"></i></div>
			<div class="block">
			<?php  if(is_array($kcinfo['list'])) { foreach($kcinfo['list'] as $row) { ?>
				<?php  if($row['content_type'] == 0) { ?>
				<div class="catalog catalog_3 clearfix" onclick="show_notcie(<?php  echo $row['id'];?>,this)"><!--图文多媒体 -->
					<i></i>
					<span class="catalog_index"><?php  echo $row['number'];?></span>
					<div class="catalog_title"><?php  echo $row['name'];?></div>
					<?php  if($row['read']) { ?><span class="catalog_br_unred"></span><?php  } ?>
				</div>
				<div class="conent_div"></div>
				<?php  } ?>
				<?php  if($row['content_type'] == 1) { ?>
				<div class="catalog catalog_1 clearfix" onclick="show_video(<?php  echo $row['id'];?>,this)"><!--直播 -->
					<i></i>
					<span class="catalog_index"><?php  echo $row['number'];?></span>
					<div class="catalog_title"><text>直播</text><?php  echo $row['name'];?></div>
					<?php  if($row['read']) { ?><span class="catalog_br_unred"></span><?php  } ?>
				</div>
				<div class="play_video_box">
					<video style="position:relative;width:100%;height:auto;" controls="controls" x5-playsinline="true" webkit-playsinline="" playsinline="">
						<source src="<?php  echo tomedia($row['content'])?>" type="video/mp4">
					</video>
				</div>
				<?php  } ?>
				<?php  if($row['content_type'] == 2) { ?>
				<div class="catalog catalog_5 clearfix" onclick="show_video(<?php  echo $row['id'];?>,this)"><!--视频 -->
					<i></i>
					<span class="catalog_index"><?php  echo $row['number'];?></span>
					<div class="catalog_title"><?php  echo $row['name'];?></div>
					<?php  if($row['read']) { ?><span class="catalog_br_unred"></span><?php  } ?>
				</div>
				<div class="play_video_box">
					<video style="position:relative;width:100%;height:auto;" controls="controls" x5-playsinline="true" webkit-playsinline="" playsinline="">
						<source src="<?php  echo tomedia($row['content'])?>" type="video/mp4">
					</video>
				</div>
				<?php  } ?>
				<?php  if($row['content_type'] == 3) { ?>
				<div class="catalog catalog_2 clearfix" onclick="show_video(<?php  echo $row['id'];?>,this)"><!--录音 -->
					<i></i>
					<span class="catalog_index"><?php  echo $row['number'];?></span>
					<div class="catalog_title"><?php  echo $row['name'];?></div>
					<?php  if($row['read']) { ?><span class="catalog_br_unred"></span><?php  } ?>
				</div>
				<div class="audio_div">
					<audio style="width:100%" src="<?php  echo tomedia($row['content'])?>" controls>该浏览器不支持audio属性</audio>
				</div>
				<?php  } ?>
				<?php  if($row['content_type'] == 4) { ?>
				<div class="catalog catalog_3 clearfix" onclick="show_video(<?php  echo $row['id'];?>,this)"><!--纯图 -->
					<i></i>
					<span class="catalog_index"><?php  echo $row['number'];?></span>
					<div class="catalog_title"><?php  echo $row['name'];?></div>
					<?php  if($row['read']) { ?><span class="catalog_br_unred"></span><?php  } ?>
				</div>
				<div class="conent_div"><img style="width:100%" src="<?php  echo tomedia($row['content'])?>" /></div>
				<?php  } ?>
				<?php  if($row['content_type'] == 5) { ?>
				<div class="catalog catalog_4 clearfix" onclick="show_ppt(<?php  echo $row['id'];?>,this)"><!--PDF PPT -->
					<i></i>
					<span class="catalog_index"><?php  echo $row['number'];?></span>
					<div class="catalog_title"><?php  echo $row['name'];?></div>
					<?php  if($row['read']) { ?><span class="catalog_br_unred"></span><?php  } ?>
				</div>
				<div class="ppt_box">
					<a class="goto_wendang" href="<?php  echo tomedia($row['content'])?>">点击查看文档</a>
				</div>
				<?php  } ?>
			<?php  } } ?>	
			</div>
		<?php  } } ?>	
		</div>
	</div>
<script>
//开合章节
$(".section").on("click",function(){
	$(this).children(".pointicon").toggleClass("up");
	$(this).next().toggle(200);
});
//显示视频课时
function show_video(ksid,elm){
	add_ks_click(ksid,elm)
	$(".catalog").removeClass("act");
	$(elm).addClass("act");
	$(elm).next().toggle(200);
}
//显示图文课时
function show_notcie(ksid,elm){
	var num = $(elm).next().children().length;
	if(num == 0) {
		let loadcont = "<div class='conent_load'></div>"
		$(elm).children(".catalog_title").append(loadcont);//加载动画
		$.ajax({
			url: "<?php  echo $this->createMobileUrl('kcajax', array('op' => 'get_ks_conent'), true)?>",
			type: "post",
			dataType: "json",
			data: {
				ksid: ksid,
				schoolid: <?php  echo $schoolid;?>,
				weid:<?php  echo $weid;?>
			},
			success: function (data) {
				if(data.result){
					add_ks_click(ksid,elm)
					$(".catalog").removeClass("act");
					$(elm).addClass("act");
					$(elm).next().toggle(200);
					$(elm).next().html(data.conent);
					$(elm).children(".catalog_title").children(".conent_load").hide();
				}
			},
			error: function(){
				jTips("网络错误");
				$(elm).children(".catalog_title").children(".conent_load").hide();
			}
		});
	}else{
		$(".catalog").removeClass("act");
		$(elm).addClass("act");
		$(elm).next().toggle(200);
	}
	return;
}
//显示PPT
function show_ppt(ksid,elm){
	add_ks_click(ksid,elm)
	$(".catalog").removeClass("act");
	$(elm).addClass("act");
	$(elm).next().toggle(200);
}
//增加课时点击量
function add_ks_click(ksid,elm){
	$.ajax({
		url: "<?php  echo $this->createMobileUrl('kcajax', array('op' => 'add_ks_clik'), true)?>",
		type: "post",
		dataType: "json",
		data: {
			userid:"<?php  echo $it['id'];?>",
			sid:"<?php  echo $it['sid'];?>",
			kcid: "<?php  echo $id;?>",
			ksid: ksid,
			schoolid: <?php  echo $schoolid;?>,
			weid:<?php  echo $weid;?>
		},
		success: function (data) {
			if(data.result){
				$(elm).children(".catalog_br_unred").hide()
			}
		}
	});
}
WeixinJSHideAllNonBaseMenukcinfo();
/**微信隐藏工具条**/
function WeixinJSHideAllNonBaseMenukcinfo(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			wx.onMenuShareTimeline(sharedata);
		});
	}
}
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		document.title="课程详情";
	}
}, 100);
</script>
<?php  include $this->template('footer');?>	   
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>