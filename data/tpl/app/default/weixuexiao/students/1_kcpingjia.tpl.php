<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true" />
<link rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/resetnew.css">
<?php  echo register_jssdks();?>
<?php  include $this->template('shoucecss');?>
<style type="text/css">
	.selectList {position: fixed;left: 0;right: 0;top: 0;bottom: 0;-webkit-box-sizing: border-box;box-sizing: border-box;background-color: rgba(0,0,0,.53);
text-align: center;z-index: 30;font-size: 20px;color: #fe6700;}
.selectList .single {position: absolute;left: 6%;right: 6%;top: 5%;padding: 0 20px;background-color: #fff;padding-bottom: 33px;padding-top: 10px;}
.selectList ul {width: 100%;height: auto;overflow: auto;}
.selectList ul li {height: 50px;line-height: 50px;border-bottom: 1px solid #e9e9e9;padding: 0 10px;}
.selectList ul li span.le {height: 50px;line-height: 50px;float: left;font-size: 16px;}
.selectList ul li span.ri {float: right;height: 50px;line-height: 50px;font-size: 16px;}

.header { width: 100%; height: 50px; line-height: 50px; position: fixed; z-index: 1000; top: 0; left: 0; box-shadow: 0 0 2px 0px rgba(0,0,0,0.3),0 0 6px 2px rgba(0,0,0,0.15); }
.header .l { width: 50px; height: 50px; line-height: 50px; color: white; position: absolute; left: 0; top: 0; } 
.header .m { width: 100%; height: 50px; line-height: 50px; text-align: center; color: white; font-size: 18px; } 
.header .r { width: 50px; height: 50px; line-height: 50px; position: absolute; right: 0; top: 0; } 
.mainColor { background: <?php  echo $school['headcolor'];?> !important; } 
.header .l a { font-size: 18px; color: white; display: block; width: 100%; height: 100%; text-align: center; }
.head_til img{width: 25px;height: 25px;display: inline-block;float: left;border-radius: 40px;}
body {background-color: #E7FAFF;}
.bottom_control_row .prev_btn1 {margin: 15px 5px 15px 35px;float: left;width: 100px;background-color: #e5457f;border-radius: 3px;line-height: 35px;height: 35px;text-align: center;}
.bottom_control_row .prev_btn1 a, .bottom_control_row .next_btn a {color: #fff;}
.bottom_control_row .prev_btn2 {margin: 15px 5px 15px 35px;float: left;width: 100px;background-color: #e5457f;border-radius: 3px;line-height: 35px;height: 35px;text-align: center;}
.bottom_control_row .prev_btn2 a, .bottom_control_row .next_btn a {color: #fff;}
</style>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>
<?php  include $this->template('port');?>
<title><?php  echo $school['title'];?></title>
</head>
<body>
<div class="All">
<div class="manual_main1">
    <div class="manual_visible_box">
        <div class="manual_main_box2">
        	<div class="head_til" style="border-bottom: unset;">
				<div id="wrap" class="count_inf" style="min-width:unset;">
			        <dl id="main">
			            <dt class="count_tit" style="color:#4896c5;text-align: unset;"><?php  echo $kcinfo['name'];?></dt>
			            <dd class="count_inf">
				            <?php  if(!empty($checktid)) { ?>
				            <div class="teacher" style="padding-bottom: 10px;">
			                    <div style=" background-image:url(<?php  if(!empty($teacher['thumb'])) { ?><?php  echo tomedia($teacher['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>)"></div>
			                    <p><?php  echo $teacher['tname'];?></p>
			                </div>
			                <?php  } else { ?>
			                <div class="teacher" style="padding-bottom: 10px;">
			                    <div style=" background-image:url(<?php  if(!empty($tname_array[$kcinfo['maintid']]['thumb'])) { ?><?php  echo tomedia($tname_array[$kcinfo['maintid']]['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>)"></div>
			                    <p><?php  echo $tname_array[$kcinfo['maintid']]['tname'];?></p>
			                </div>
			                <?php  } ?>
			                <ul>
			                    <li>
				                   	<label>日期：</label>
			                    	<?php  echo date('y/m/d',$kcinfo['start'])?>-<?php  echo date('y/m/d',$kcinfo['end'])?>
			                    </li>
			                    <li>
				                    <label>科目：</label>
				                    
				                    <?php  if(!empty($kcinfo['xq_id'])) { ?>
				                    <?php  echo $category[$kcinfo['bj_id']]['sname'];?>/<?php  echo $category[$kcinfo['km_id']]['sname'];?>
				                    <?php  } else { ?><?php  echo $category[$kcinfo['km_id']]['sname'];?>
				                    <?php  } ?>
			                    </li>
			                    <li>
				                    <label>教室：</label>
				                    <?php  echo $category[$kcinfo['adrr']]['sname'];?>
				                </li>
			                    <li>
				                    <label>主讲教师：</label>
				                    
				                    <?php  echo $tname_array[$kcinfo['maintid']]['tname'];?>
				                </li>
			                </ul>            
			                <div style="clear:both"></div>
			            </dd> 	
			        </dl>
				</div>
			</div>
			<?php  if(empty($check)) { ?>
			<ul class="manual_baby_situation_ul">
				<span style="font-size: 15px;">评分:&nbsp;</span>
				<?php  if(is_array($tname_array)) { foreach($tname_array as $row) { ?>
				<div>
					<span id="tname_<?php  echo $row['id'];?>" style="font-size: 15px;width:65px;display:inline-block;text-align: center;"><?php  echo $row['tname'];?>:</span>
					<a href="javascript:hs_click(1,<?php  echo $row['id'];?>)"><img style="width: 17px;padding-bottom: 6px;" src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png" id="star1_<?php  echo $row['id'];?>"/></a>
					<a href="javascript:hs_click(2,<?php  echo $row['id'];?>)"><img style="width: 17px;padding-bottom: 6px;" src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png" id="star2_<?php  echo $row['id'];?>"/></a>
					<a href="javascript:hs_click(3,<?php  echo $row['id'];?>)"><img style="width: 17px;padding-bottom: 6px;" src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png" id="star3_<?php  echo $row['id'];?>"/></a>
					<a href="javascript:hs_click(4,<?php  echo $row['id'];?>)"><img style="width: 17px;padding-bottom: 6px;" src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png" id="star4_<?php  echo $row['id'];?>"/></a>
					<a href="javascript:hs_click(5,<?php  echo $row['id'];?>)"><img style="width: 17px;padding-bottom: 6px;" src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png" id="star5_<?php  echo $row['id'];?>"/></a>
					<span id="message_<?php  echo $row['id'];?>" >&nbsp;未评分</span>
				</div>
				<?php  } } ?>
			</ul>
			<div class="parent_evaluation_box">
				<textarea placeholder="说一说你的评价,100字以内" id="eval_text"  maxlength="100" onkeydown="if(this.value.length>=40) {event.returnValue=false}" ></textarea>
				<div class="clear1"></div>
			</div>
			<?php  } else if(!empty($check)) { ?>
			<ul class="manual_baby_situation_ul">
				<span style="font-size: 15px;color:#6363d4;font-weight:bold">教师评分:&nbsp;</span>
				<?php  if(is_array($tname_array)) { foreach($tname_array as $row) { ?>
				<div>
					<span id="tname_<?php  echo $row['id'];?>" style="font-size: 15px;width:65px;display:inline-block;text-align: center;"><?php  echo $row['tname'];?>:</span>
					<a ><img style="width: 17px;padding-bottom: 6px;" 
					<?php  if($row['star'] >0) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png"
					<?php  } else if($row['star'] ==0 ) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png"
					<?php  } ?>
					/></a>
					<a ><img style="width: 17px;padding-bottom: 6px;" 
					<?php  if($row['star'] >1) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png"
					<?php  } else if($row['star'] <=1 ) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png"
					<?php  } ?>
					/></a>
					<a ><img style="width: 17px;padding-bottom: 6px;" 
					<?php  if($row['star'] >2) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png"
					<?php  } else if($row['star'] <=2 ) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png"
					<?php  } ?>
					/></a>
					<a ><img style="width: 17px;padding-bottom: 6px;" 
					<?php  if($row['star'] >3) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png"
					<?php  } else if($row['star'] <=3 ) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png"
					<?php  } ?>
					/></a>
					<a ><img style="width: 17px;padding-bottom: 6px;" 
					<?php  if($row['star'] >4) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png"
					<?php  } else if($row['star'] <=4 ) { ?>
					src="<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png"
					<?php  } ?>
					/></a>
					
					<span>
					<?php  if($row['star'] ==0) { ?>
					未评分
					<?php  } else if($row['star'] ==1) { ?>
					1分-很差
					<?php  } else if($row['star'] ==2) { ?>
					2分-比较差
					<?php  } else if($row['star'] ==3) { ?>
					3分-一般
					<?php  } else if($row['star'] ==4) { ?>
					4分-比较好
					<?php  } else if($row['star'] ==5) { ?>
					5分-很好
					<?php  } ?>
					</span>
				</div>
				<?php  } } ?>
				</ul>
				<div class="parent_evaluation_box">
					<span style="font-size: 15px;color:#6363d4;font-weight:bold">课程评价:</span></br>
					<span><?php  echo $check['content'];?></span>
				<!--<textarea placeholder="<?php  echo $check['content'];?>"  maxlength="100"  ></textarea>-->
				<div class="clear1"></div>
			</div>
			<?php  } ?>
            <div class="blank"></div>
            <div class="small_blank"></div>
        </div>
    </div>
	<?php  if(empty($check)) { ?>
    <div class="bottom_control_row">
        <div class="prev_btn" type="prev"><a href="javascript:tijiao();">提交</a></div>
    </div>	
    <?php  } ?>

<div class="clear"></div>
</div>
<div class="selectList" id="selectList" style="z-index:100000;display:<?php  if(empty($userid)) { ?> block<?php  } else { ?>none<?php  } ?>;">
		<div class="single" style="z-index:100000;border-radius: 5%;">
			<ul>
				<span style="color:#444;">切换学生</span>
			<?php  if(is_array($alluser)) { foreach($alluser as $row) { ?>
				<li onclick="isSelect1(<?php  echo $row['id'];?>);"><span class="le"><?php  if($row['type'] == 1) { ?><?php  echo $row['bjname'];?> <?php  } else { ?>老师<?php  } ?></span><span class="ri"><?php  if($row['type'] == 1) { ?><?php  echo $row['s_name'];?><?php  } else { ?><?php  echo $row['tname'];?><?php  } ?></span></li>
			<?php  } } ?>	
			</ul>
		</div>
	</div>	
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>
<script type="text/javascript">
	var check = new Object();
function hs_click(param,ord){
	check[ord] = param;//记录当前打分
	out(ord);//设置星星数
}

function out(ord){
	if(check[ord] == 1){//打分是1，设置第一颗星星亮，其他星星暗，其他情况以此类推
		$("#star1_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star2_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star3_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star4_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star5_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#message_"+ord).html("1分-很差");
	}else if(check[ord] == 2){
		$("#star1_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star2_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star3_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star4_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star5_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#message_"+ord).html("2分-比较差");
	}else if(check[ord] == 3){
		$("#star1_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star2_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star3_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star4_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star5_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#message_"+ord).html("3分-一般");
	}else if(check[ord] == 4){
		$("#star1_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star2_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star3_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star4_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star5_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#message_"+ord).html("4分-比较好");
	}else if(check[ord] == 5){
		$("#star1_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star2_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star3_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star4_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#star5_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_red.png");
		$("#message_"+ord).html("5分-很好");
	}else if(check[ord] == 0){
		$("#star1_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star2_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star3_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star4_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#star5_"+ord).attr("src","<?php echo MODULE_URL;?>public/mobile/img/star_pingjia_gray.png");
		$("#message_"+ord).html("0分");
	}
}


function tijiao(){
	var pingjia = $("#eval_text").val();
	
	if(pingjia == '' || pingjia == null){
		jTips("请输入评价内容");
		return;
	}
    $.ajax({
		url: "<?php  echo $this->createMobileUrl('AppCourseAjax', array('schoolid' => $schoolid,'op' => 'student_comment_course'), true)?>",
		data: { pingjia: pingjia, check: check, sid: "<?php  echo $it['sid'];?>", userid: "<?php  echo $it['id'];?>", weid: "<?php  echo $weid;?>",kcid:"<?php  echo $kcid;?>"},
		type: "post",
		dataType:"json",
		success: function (data) {
			if (data.result) {
				jTips(data.msg);
				// location.reload();
			}else{
				jTips(data.msg);
			}		
		}
	});
}
	$(".choice_baby").on("click", function() {
		
		$("#selectList").show();
	});
//	function isSelect1(userid){
//	location.href = "<?php  echo $this->createMobileUrl('gkkpingjia')?>"+ '&userid=' + userid + '&schoolid=' + <?php  echo $schoolid;?> + '&op=edite&gkkid=' + <?php  echo $gkkid;?>  ;
//	location.href = reload();
//}
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="评价课程";
	}
}, 100);

</script>
<script>
$(".manual_baby_situation_ul").on("click", ".li_block_2 div", function () {
	$(this).addClass("on").siblings("div").removeClass("on");
})

//$(".prev_btn").on("click", function () {
//	var comment = iphone_emoji_filter($.trim($("#eval_text").val()));
//	var performance = "";
//	$(".manual_baby_situation_ul li").each(function () {
//		performance += $(this).find(".li_block_2").attr("record_uid") + "_" + $(this).find(".li_block_2 .on").attr("icon_index")+",";
//	});
//	var type = $(this).attr("type");
//	$.ajax({
//		url: "<?php  echo $this->createMobileUrl('gkkpingjia', array('schoolid' => $schoolid,'gkkid'=>$gkkid,'op' => 'savedata'), true)?>",
//		data: { comment: comment, performance: performance, sid: "<?php  echo $it['sid'];?>", scid: "<?php  echo $scid;?>", setid: "<?php  echo $setid;?>" , tid: "<?php  echo $it['tid'];?>", userid: "<?php  echo $userid;?>", weid: "<?php  echo $weid;?>"},
//		type: "post",
//		dataType:"json",
//		success: function (data) {
//			jTips(data.info, function () {
//				if (data.status == 1) {
//					window.location.href = "<?php  echo $this->createMobileUrl('gkkpjshare', array('schoolid' => $schoolid,'op' => 'check','userid' => $userid,'gkkid'=>$gkkid,'fenxiang'=>'fenxiang'), true)?>";
//				}
//			});		
//		}
//	});
//});
$(".prev_btn1").on("click", function () {
	var comment = iphone_emoji_filter($.trim($("#eval_text").val()));
	var performance = "";
	$(".manual_baby_situation_ul li").each(function () {
		performance += $(this).find(".li_block_2").attr("record_uid") + "_" + $(this).find(".li_block_2 .on").attr("icon_index")+",";
	});
	var type = $(this).attr("type");
	$.ajax({
		url: "<?php  echo $this->createMobileUrl('scforxs', array('schoolid' => $schoolid,'op' => 'updata'), true)?>",
		data: { comment: comment, performance: performance, sid: "<?php  echo $it['sid'];?>", scid: "<?php  echo $scid;?>", setid: "<?php  echo $setid;?>" , tid: "<?php  echo $it['tid'];?>", userid: "<?php  echo $it['id'];?>", weid: "<?php  echo $weid;?>"},
		type: "post",
		dataType:"json",
		success: function (data) {
			jTips(data.info, function () {
				if (data.status == 1) {
					window.location.href = "<?php  echo $this->createMobileUrl('sclistforxs', array('schoolid' => $schoolid,'userid' => $it['id']), true)?>";
				}
			});		
		}
	});
});
</script>