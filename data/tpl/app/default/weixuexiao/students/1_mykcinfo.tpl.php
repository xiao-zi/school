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
<link rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/resetnew.css">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/newCourseDetail.css">
<?php  echo register_jssdks();?>
<?php  include $this->template('port');?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.1.min.js?v=4.9"></script>
<title>课程详情</title>
<style>
.weui_switch {font-size: 14px;-webkit-appearance: none;-moz-appearance: none;appearance: none;position: relative;width: 48px !important;height: 28px;border: 1px solid #DFDFDF;outline: 0;border-radius: 16px;box-sizing: border-box;background: #DFDFDF;vertical-align: middle;}
.weui_switch:before {content: " ";position: absolute;top: 0;left: 0;width: 46px;height: 26px;border-radius: 15px;background-color: #FDFDFD;-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.weui_switch:after {content: " ";position: absolute;top: 0;left: 0;width: 26px;height: 26px;border-radius: 15px;background-color: #FFFFFF;box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.weui_switch:checked {border-color: #06c1ae;background-color: #06c1ae;}
.weui_switch:checked:before {-webkit-transform: scale(0);transform: scale(0);}
.weui_switch:checked:after {-webkit-transform: translateX(20px);transform: translateX(20px);}
.form-order>.form-line {margin-bottom: 0.5rem !important;}
body > a:first-child,body > a:first-child img{ width: 0px !important; height: 0px !important; overflow: hidden; position: absolute}
body{padding-bottom: 0 !important;}
.gw_num{padding-right:.8em;margin-right: 10%;float: right;border: 1px solid #dbdbdb;width: 51%;line-height: 26px;overflow: hidden;display:inline}
.gw_num em{display: block;height: 26px;width: 26px;float: left;color: #7A7979;border-right: 1px solid #dbdbdb;text-align: center;cursor: pointer;}
.gw_num .num1{display: block;float: left;text-align: center;width: 52px;height:26px;font-style: normal;font-size: 14px;line-height: 26px;border: 0;}
.gw_num em.jia{float: right;border-right: 0;border-left: 1px solid #dbdbdb;}
.count_inf dl a {padding-right: 10px;display: block;background: url(<?php echo OSSURL;?>public/mobile/img/arrow_right.png) no-repeat right center;background-size: 8px 12px;}
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
					<?php  if($kcinfo['isSign'] == 1 ) { ?>
                    <a class="outline_link" onclick="startsign()" id="kcsign">签到</a>
					<?php  } ?>
                    </li>
                    <?php  if($kmname['sname']) { ?><li><label>科目：</label><?php  echo $kmname['sname'];?></li><?php  } ?>
                    <?php  if($kcinfo['kc_type'] == 1) { ?>
						<li><label><?php  echo $menumuber;?>章节 |</label> <?php  echo $ksmuber;?>节课程</li>
					<?php  } else { ?>
						<li><label>教室：</label><?php  echo $jsname['sname'];?></li>
					<?php  } ?>
                    <li><label>授课教师：</label><?php  echo $tname_array_end;?></li>
                    <?php  if($kcinfo['OldOrNew'] == 1 || $kcinfo['ReNum'] != 0) { ?>
                    <li><label>总课时/已购课时：</label><?php  echo $kcinfo['AllNum'];?>/<?php  if(!empty($ygks)) { ?><?php  echo $ygks['ksnum'];?><?php  } else { ?>0<?php  } ?>课时<a class="outline_link" onclick="showxgks()" id="xgks">续购</a></li>
                    <?php  } ?>
                </ul>
                <div style="clear:both"></div>
            </dd>
        </dl>
		<?php  if($schooltype) { ?>
		<?php  if($share != 0) { ?>
		<dl class="count_outline">
            <dt><a href="<?php  echo $this->createMobileUrl('mysharedetail', array('id' => $it['id'],'schoolid' => $schoolid,'kcid'=>$kcinfo['id']), true)?>" >已成功邀请<span class="outline_link" style="float:unset;margin-right:3px;margin-left:3px;" ><?php  echo $share;?></span>人 <span class="outline_link" >查看更多</span></a></dt>
        </dl>
		<?php  } else { ?>

		<?php  } ?>
		<?php  } ?>
        <dl class="count_outline">
            <dt><a href="<?php  echo $this->createMobileUrl('kcdg', array('id' => $kcinfo['id'],'schoolid' => $schoolid), true)?>" >课程大纲 <span class="outline_link" id="syllabus">查看详情</span></a></dt>
        </dl>
	</div>
	<?php  if($kcinfo['OldOrNew'] == 0 && $kcinfo['isSign'] == 1) { ?>
	<div id="wrap" class="user_inf">
         <a class="help" href="javascript:void(0)"><span style="background-color:#9cd0c8;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未签到&nbsp;<span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>签到未确认&nbsp;<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>已签到&nbsp;<span style="background-color:#999;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未开始</a>
    </div>
    	<div id="wrap" class="count_inf">
        <dl class="counts">
            <dt>学习记录</dt>
            <div>
			<?php  if(is_array($list)) { foreach($list as $kcinfo1) { ?>
               <?php  if($kcinfo1['date'] > TIMESTAMP) { ?>
               <dd>
               <?php  } else { ?>
                	<?php  if($kcinfo1['checksign'] ==1) { ?>
                    <dd class="click1" onclick="touch(<?php  echo $kcinfo1['id'];?>)" >
                	<?php  } else if($kcinfo1['checksign'] ==2) { ?>
                    <dd class="click" onclick="touch(<?php  echo $kcinfo1['id'];?>)" >
                	<?php  } else { ?>
                    <dd class="click" style="background-color: #9cd0c8;" onclick="touch(<?php  echo $kcinfo1['id'];?>)" >
                   <?php  } ?>
               <?php  } ?>
               第<span><?php  echo $kcinfo1['nub'];?></span>课<br/><?php  echo date('m月d',$kcinfo1['date'])?>
               </dd>
			<?php  } } ?>
            	<div style="clear:both"></div>
            </div>
        </dl>
    </div>
    <?php  } else if($kcinfo['OldOrNew'] == 0 && $kcinfo['isSign'] ==0) { ?>
    <div id="wrap" class="user_inf">
        <a class="help" href="javascript:void(0)"><span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>有内容&nbsp;<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>已授课&nbsp;<span style="background-color:#999;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未开始</a>
    </div>
   	<div id="wrap" class="count_inf">
        <dl class="counts">
            <dt>学习记录</dt>
            <div>
			<?php  if(is_array($list)) { foreach($list as $kcinfo1) { ?>
                      <dd<?php  if($kcinfo1['isxiangqing'] == 1) { ?><?php  if($kcinfo1['date'] > TIMESTAMP) { ?><?php  } else { ?> class="click1" onclick="touch(<?php  echo $kcinfo1['id'];?>)"<?php  } ?><?php  } else { ?><?php  if($kcinfo1['date'] > TIMESTAMP) { ?><?php  } else { ?> class="click" onclick="touch(<?php  echo $kcinfo1['id'];?>)"<?php  } ?><?php  } ?>>第<span><?php  echo $kcinfo1['nub'];?></span>课<br/><?php  echo date('m月d',$kcinfo1['date'])?></br><?php  if(!empty($category[$kcinfo1['sd_id']])) { ?><?php  echo $category[$kcinfo1['sd_id']]['sname'];?><?php  } ?></dd>
			<?php  } } ?>
                      <div style="clear:both"></div>
            </div>
        </dl>
    </div>
	<?php  } else if($kcinfo['OldOrNew'] ==1 && $kcinfo['isSign'] == 1) { ?>
	<div id="wrap" class="count_inf">
        <dl class="counts">
            <dt>学习记录</dt>
            <div>
			<?php  if(is_array($signlist)) { foreach($signlist as $key => $kcinfo1) { ?>
			<li style="font-size: 13px">第<span style="color:red;font-weight:bold"><?php  echo $key+1?></span>次 <?php  if($kcinfo1['status'] ==1) { ?><span style="color:blue">【未确认】</span><?php  } else { ?><span style="color:green">【已确认】</span><?php  } ?></li>
			<li style="font-size: 13px">签到时间：<?php  echo date("Y年m月d日",$kcinfo1['createtime'])?></li>
			<?php  } } ?>
            	<div style="clear:both"></div>
            </div>
        </dl>
    </div>
    <?php  } ?>
   <!-- 续购课程-->
	<div class="component-panel" id="yyst" style="display:none;">
		<div class="mask"></div>
		<div class="component-dialog dialog-order">
			<div class="component-dialog-title">续购课程</div>
			<div class="component-dialog-body">
				<form class="form-order" novalidate="novalidate">
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span>续购价格:</span>
							<span style="font-weight:bold;color:#0ec78b">￥<?php  echo $kcinfo['RePrice'];?></span><span>/课时</span>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span>最低限购:</span>
							<span style="font-weight:bold;color:#ff0200"><?php  echo $kcinfo['ReNum'];?></span><span> 课时</span>
						</div>
					</div>
					<div class="form-line">
						<span style="padding:.8em;width:15%">购买课时:</span>
						<div class="gw_num">
							<em class="jian">-</em>
							<input type="number" min="<?php  echo $kcinfo['ReNum'];?>" max="{$kcinfo['AllNum'] - $ygks['ksnum']}" class="num1" id="NumOfKsxg" name="NumOfKsxg" value="<?php  echo $kcinfo['ReNum'];?>"/>
							<em class="jia">+</em>
						</div>
					</div>
					<?php  if($kcinfo['Point2Cost']!=0 && $school['Is_point']==1) { ?>
					<div class="form-line" >
					<div class="input-wrapper" style="border:none;">
						<span> 我的积分:</span>
						<span><span style="font-weight:bold;color:#ff0200"><?php  echo $student['points'];?></span>积分</span>
					</div>
				</div>
					<div class="form-line" >
						<div class="input-wrapper" style="border:none;">
							<span>抵用比例:</span>
							<?php  if($kcinfo['Point2Cost'] !=0) { ?>
							<span><span style="font-weight:bold;color:#ff0200"><?php  echo $kcinfo['Point2Cost'];?></span>积分/1元</span>
							<?php  } else { ?>
							<span id="StuPoint">不可抵用</span>
							<?php  } ?>
						</div>
					</div>
					<div class="form-line" >
						<div class="input-wrapper" style="border:none;">
						   	<span>是否抵用</span>
        					<input id="is_p2c" class="weui_switch" type="checkbox" value="0"/>
        					<input id="is_p2c_value" type="hidden" value="0">
						</div>
					</div>

					<div class="form-line is_show" style="display: none">
						<div class="input-wrapper" style="border:none;">
							<span>最低抵用:</span>
							<?php  if($kcinfo['MinPoint'] !=0) { ?>
							<span><span style="font-weight:bold;color:#ff0200"><?php  echo $kcinfo['MinPoint'];?></span>积分</span>
							<?php  } else { ?>
							<span>无限制</span>
							<?php  } ?>
						</div>
					</div>
					<div class="form-line is_show" style="display: none">
						<div class="input-wrapper" style="border:none;">
							<span>最高抵用:</span>
							<?php  if($kcinfo['MaxPoint'] !=0) { ?>
							<span><span style="font-weight:bold;color:#ff0200"><?php  echo $kcinfo['MaxPoint'];?></span>积分</span>
							<?php  } else { ?>
							<span>无限制</span>
							<?php  } ?>
						</div>
					</div>
					<div class="form-line is_show" style="display: none">
						<div class="input-wrapper" style="border:none;">
							<span>抵用积分:</span>
							<input type="number" placeholder="请输入抵用积分" id="PointNum" name="PointNum" min="<?php  echo $kcinfo['MinPoint'];?>" max="<?php  echo $kcinfo['MaxPoint'];?>" required="">
						</div>
					</div>
					<?php  } ?>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;"></div>
					</div>
					<input type="hidden" name="sid" id="jfdy_sid" value="0">
					<input type="hidden" name="id" id="jfdy_id" value="0">
					<input type="hidden" name="spoint" id="jfdy_spoint" value="0">

					<input type="hidden" name="object_number" value="751895459">
					<input type="hidden" name="content_type" value="yunying.org_account">
					<div class="component-dialog-footer">
						<a type="button" class="btn-default btn" style="margin-left: 4%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;" onclick="closed()" >取消</a>
						<button type="button" class="btn-primary btn"  style="width:30%;margin-left: 18%;" data-opttype="yes" onclick="ksxg_ajax()">确定</button>
					</div>
				</form>
			</div>
			<div class="component-dialog-footer"></div>
		</div>
	</div>
	<input id="userid" name="userid" type="hidden" value="<?php  echo $it['id'];?>">
	<input id="ReNum" name="ReNum" type="hidden" value="<?php  echo $kcinfo['ReNum'];?>">
	<input id="RePrice" name="RePrice" type="hidden" value="<?php  echo $kcinfo['RePrice'];?>">

	<!--确认签到-->
	<div class="component-panel" id="qdqr" style="display:none;">
		<div class="mask"></div>
		<div class="component-dialog dialog-order">
			<div class="component-dialog-title">确认签到</div>
			<div class="component-dialog-body">
				<form class="form-order" novalidate="novalidate">
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span>课程:</span>
							<span style="font-weight:bold"><?php  echo $kcinfo['name'];?></span>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<?php  if($kcinfo['OldOrNew']==0) { ?>
							<span>课时:</span>
							<span>第<span style="font-weight:bold;color:#ff0200"><?php  echo $nubmer;?></span>课</span>
							<?php  } else { ?>
							<span>日期:</span>
							<span style="font-weight:bold;color:#ff0200"><?php  echo date("Y年m月d日",time())?></span>课
							<?php  } ?>
						</div>
					</div>
					<input type="hidden" name="object_number" value="751895459">
					<input type="hidden" name="content_type" value="yunying.org_account">
					<div class="component-dialog-footer">
						<a type="button" class="btn-default btn" style="margin-left: 8%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;" onclick="closed_qd()" >取消</a>
						<button type="button" class="btn-primary btn"  style="width:30%;margin-left: 18%;" data-opttype="yes" onclick="qd_ajax()">确定</button>
					</div>
				</form>
			</div>
			<div class="component-dialog-footer"></div>
		</div>
	</div>

<script type="text/javascript">

	$("#is_p2c").bind("change", function () {
			if($("#is_p2c").prop('checked')){
				$("#is_p2c_value").val(1);
				$(".is_show").show();
			}else{
				$("#is_p2c_value").val(0);
				$(".is_show").hide();
			}
		});
	//加的效果
	$(".jia").click(function(){
		var n=$(this).prev().val();
		var num=Number(n)+1;
		if(num==0){ return;}
		if(num> Number(Number(<?php  echo $kcinfo['AllNum'];?>)-Number(<?php  echo $ygks['ksnum'];?>)))
		{
			return;
		}
		$(this).prev().val(num);
	});
	//实时监听数量
	$(".num1").bind('input propertychange', function() {
			var count = $(this).val();
		if(count >= Number(Number(<?php  echo $kcinfo['AllNum'];?>)-Number(<?php  echo $ygks['ksnum'];?>)))
		{
			$(this).val(Number(Number(<?php  echo $kcinfo['AllNum'];?>)-Number(<?php  echo $ygks['ksnum'];?>)));
		}
	});
	//减的效果
	$(".jian").click(function(){
		var n=$(this).next().val();
		var num=parseInt(n)-1;
		if(num==0){ return}
		else if(num < Number(<?php  echo $kcinfo['ReNum'];?>) && (Number(<?php  echo $kcinfo['AllNum'];?>) - Number(<?php  echo $ygks['ksnum'];?>) >= <?php  echo $kcinfo['ReNum'];?>)){
			alert("抱歉，续购课时不得低于最低限制");
			$(this).prev().val(n);
			return;
		}
		$(this).next().val(num);
	});
</script>
<script>
function touch(kcinfoid) {
	var id = kcinfoid;
	window.location.href = "<?php  echo $this->createMobileurl('mykcdetial', array('schoolid' => $schoolid), true)?>" + '&id=' + id;
}
	function closed_qd(){
		$("#qdqr").hide();
	};
	function closed(){
		$("#yyst").hide();
	};
	function showxgks(){
		$("#yyst").show();
	};

	var OldOrNew = <?php  echo $kcinfo['OldOrNew'];?>;
	function startsign(){
		var s_isSign = <?php  echo $kcinfo['isSign'];?>;
		<?php  if(!empty($hasSign)) { ?>
			alert("已经签到了");
		<?php  } else { ?>
			if(OldOrNew == 1){
				//直接签到
				$("#qdqr").show();
			}else if(OldOrNew == 0){
				<?php  if(!empty($isHaveKs)) { ?>
					//有课时
					var sign_timeRange = <?php  echo $kcinfo['signTime'];?> * 60 ;
					if(sign_timeRange != 0){
						var STset = Number(<?php  echo $isHaveKs['date'];?>) - Number(sign_timeRange);
						var NowTime = <?php  echo time()?>;
						if (NowTime>STset){
							//可以签到
							$("#qdqr").show();
						}
					}else if(sign_timeRange == 0){
						//直接签到
						$("#qdqr").show();
				}
				<?php  } else { ?>
					//无课时
					alert("今天没有排课哦");
				<?php  } ?>
			}
		<?php  } ?>
	}

	function qd_ajax(){
		if(OldOrNew == 1){
			var data={
				weid: <?php  echo $weid;?>,
				schoolid:<?php  echo $schoolid;?>,
				OldOrNew :1,
				kcid: <?php  echo $id;?>,
				sid:<?php  echo $it['sid'];?>,
				//signtime:<?php  echo time()?>,
				status:1
			};
			kcqd_ajax_end(data);
		}else if(OldOrNew == 0){
			<?php  if(!empty($isHaveKs)) { ?>
				//有课时
				var data={
					weid: <?php  echo $weid;?>,
					schoolid:<?php  echo $schoolid;?>,
					OldOrNew :0,
					kcid: <?php  echo $id;?>,
					ksid:<?php  echo $isHaveKs['id'];?>,
					sid:<?php  echo $it['sid'];?>,
					//signtime:<?php  echo time()?>,
					status:1
				};
				var sign_timeRange = <?php  echo $kcinfo['signTime'];?> * 60 ;
				if(sign_timeRange != 0){
					var STset = Number(<?php  echo $isHaveKs['date'];?>) - Number(sign_timeRange);
					var NowTime = <?php  echo time()?>;
					if (NowTime>STset){
						//可以签到
						kcqd_ajax_end(data);
					}else{
						alert("未到签到时间");
					}
				}else if(sign_timeRange == 0){
					//直接签到
					kcqd_ajax_end(data);
			}
			<?php  } else { ?>
				//无课时
				alert("该课程今日无课时");
			<?php  } ?>
		}
	}

	function kcqd_ajax_end(datas){
		$.ajax({
				url: "<?php  echo $this->createMobileUrl('kcajax', array('op' => 'skcsign'), true)?>",
				type: "post",
				dataType: "json",
				data: datas,
				success: function (data_s) {
					jTips(data_s.msg);
					location.reload();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert(textStatus);
				}
			});
	}

	function ksxg_ajax(){
		var ksxgnum = $("#NumOfKsxg").val();
		var ReNum = $("#ReNum").val();
		var id = $("#userid").val();
		var RePrice = $("#RePrice").val();
		if(Number(<?php  echo $allnum;?>) - Number(<?php  echo $ygks['ksnum'];?>) >= ReNum ){
			if(Number(ksxgnum) < Number(ReNum) ){
				alert("抱歉，续购课时不得低于最低限制");
				$("#NumOfKsxg").val(ReNum);
				return;
			}
		}

		var count = $("#PointNum").val();
		var is_point = $("#is_p2c_value").val();
		var spoint =<?php  echo $stup;?>;
		if (is_point != 0){
			//if(count> spoint){
			//	jTips("您的积分不足");
			//	return;
			//}
			if (count<<?php  echo $kcinfo['MinPoint'];?>){
				jTips("抵用积分不得低于最低抵用");
				return;
			}
			<?php  if(!empty($kcinfo['MaxPoint'])) { ?>
			if (count><?php  echo $kcinfo['MaxPoint'];?>){
				jTips("抵用积分不得高于最高抵用");
				return;
			}
			<?php  } ?>
		}
		$.ajax({
			url: "<?php  echo $this->createMobileUrl('payajax', array('op' => 'xgks'), true)?>",
			type: "post",
			dataType: "json",
			data: {
				weid: <?php  echo $weid;?>,
				schoolid:<?php  echo $schoolid;?>,
				ksxgnum:ksxgnum,
				reprice:RePrice,
				openid : "<?php  echo $openid;?>",
				kcid: <?php  echo $id;?>,
				sid:<?php  echo $it['sid'];?>,
				uid:<?php  echo $_W['member']['uid'];?>,
				userid:id,
				is_point:is_point,
				point:count
			},
			success: function (data) {
				jTips(data.msg);
				if(data.result ==true){
					var url  = "<?php  echo $this->createMobileUrl('order', array('schoolid' => $schoolid), true)?>"+"&user="+id;
					window.location.href = url;
				}
			}
		});
	};


WeixinJSHideAllNonBaseMenukcinfo();
/**微信隐藏工具条**/
function WeixinJSHideAllNonBaseMenukcinfo(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
		//alert("<?php  echo $sharetitle;?>");
		<?php  if($schooltype) { ?>
			sharedata = {
				title: "<?php  echo $sharetitle;?>",
				desc: "<?php  echo $sharedesc;?>",
				link: "<?php  echo $links;?>",
				imgUrl: "<?php  echo $shareimgUrl;?>",
				success: function(){

				},
				cancel: function(){
				}
			};

			wx.onMenuShareAppMessage(sharedata);
			wx.onMenuShareTimeline(sharedata);
			<?php  } ?>
			//wx.hideAllNonBaseMenukcinfo();
		});
	}
}

	setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="课程详情";
	}
}, 100);
</script>
<?php  include $this->template('footer');?>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>