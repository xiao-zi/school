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
<?php  echo register_jssdks();?>
<?php  include $this->template('port');?>
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title><?php  echo $school['title'];?></title>
<link rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/resetnew.css">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/newCourseDetail.css">
<?php  echo register_jssdks();?>
<script src="<?php echo MODULE_URL;?>public/mobile/js/jquery.js"></script>
<style>
body > a:first-child,body > a:first-child img{ width: 0px !important; height: 0px !important; overflow: hidden; position: absolute}
body{padding-bottom: 0 !important;}
.selectks{display: block;width: 100%;height: 34px;border-radius: 3px;padding: 0 10px;margin-bottom: 10px;border: 1px solid #ccc;-webkit-box-sizing: border-box;box-sizing: border-box;text-align: left;color: #666;
font-size: 14px;}
.gw_num{padding-right:.8em;margin-right: 10%;float: right;border: 1px solid #dbdbdb;width: 51%;line-height: 26px;overflow: hidden;display:inline}
.gw_num em{display: block;height: 26px;width: 26px;float: left;color: #7A7979;border-right: 1px solid #dbdbdb;text-align: center;cursor: pointer;}
.gw_num .num1{display: block;float: left;text-align: center;width: 52px;height:26px;font-style: normal;font-size: 14px;line-height: 26px;border: 0;}
.gw_num em.jia{float: right;border-right: 0;border-left: 1px solid #dbdbdb;}
.count_inf dl a {padding-right: 10px;display: block;background: url(<?php echo OSSURL;?>public/mobile/img/arrow_right.png) no-repeat right center;background-size: 8px 12px;}
</style>
</head>
<body>
<div id="BlackBg" class="BlackBg"></div>
<div id="titlebar" class="header mainColor">
	<div class="l"><a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a></div>
	<div class="m"><a><span style="font-size: 18px">课程详情</span></a></div>
	<div id="headerMenu" class="r"></div>
</div>
<div class="top_head_blank" style="height:50px" id="titlebar_bg"></div>
    <div id="wrap" class="count_inf">
        <dl id="main">
            <dt class="count_tit"><?php  echo $item['name'];?></dt>
            <dd class="count_inf">
	            <?php  if(!empty($checktid)) { ?>
	            <div class="teacher">
                    <div style=" background-image:url(<?php  if(!empty($teacher['thumb'])) { ?><?php  echo tomedia($teacher['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>)"></div>
                    <p><?php  echo $teacher['tname'];?></p>
                </div>
                <?php  } else { ?>
                <div class="teacher">
                    <div style=" background-image:url(<?php  if(!empty($teacher_main['thumb'])) { ?><?php  echo tomedia($teacher_main['thumb']);?><?php  } else { ?><?php  echo tomedia($school['tpic']);?><?php  } ?>)"></div>
                    <p><?php  echo $teacher_main['tname'];?></p>
                </div>
                <?php  } ?>
                <ul>
                    <li><label>日期：</label>
                    <?php  echo date('Y/m/d',$item['start'])?>-<?php  echo date('Y/m/d',$item['end'])?>
					<?php  if($item['isSign'] == 1 || $_GPC['notOwner'] == 'notOwner' ) { ?>
						<a class="outline_link qx_01503" onclick="startsign()" id="kcsign">签到</a>
					<?php  } ?>
                    </li>
                    <li>
						<label>科目：</label>
						<?php  if(!empty($item['xq_id'])) { ?>
							<?php  echo $category[$item['xq_id']]['sname'];?>/<?php  echo $category[$item['bj_id']]['sname'];?>/<?php  echo $category[$item['km_id']]['sname'];?>
						<?php  } else { ?>
							<?php  echo $category[$item['km_id']]['sname'];?>
						<?php  } ?>
					</li>
                    <li><label>教室：</label><?php  echo $category[$item['adrr']]['sname'];?></li>
                    <li><label>授课教师：</label><?php  echo $tname_array_end;?></li>
                </ul>
                <div style="clear:both"></div>
            </dd>
        </dl>
        <dl class="count_outline">
            <dt><a href="<?php  echo $this->createMobileUrl('kcdg', array('id' => $item['id'],'schoolid' => $schoolid), true)?>" >课程大纲 <span class="outline_link" id="syllabus">查看详情</span></a></dt>
        </dl>
          <dl class="count_outline qx_01403">
            <dt><a href="<?php  echo $this->createMobileUrl('tkcstu', array('kcid' => $item['id'],'schoolid' => $schoolid), true)?>" >学生管理 <span class="outline_link " id="syllabus">查看详情</span></a></dt>
        </dl>
	</div>
	<!-- 有指定教师查看（带tid） start -->
	<?php  if(empty($checktid)) { ?>
		<!-- 固定课表  start-->
	    <?php  if($item['OldOrNew'] ==0) { ?>
			<!-- 主任身份 notOwner  start-->
		    <?php  if($_GPC['notOwner'] =='notOwner') { ?>
			<div id="wrap" class="user_inf">
		        <a class="help" href="javascript:void(0)">
					<span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>有内容&nbsp;
					<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>已授课程&nbsp;
					<span style="background-color:#999;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未开始
				</a>
		    </div>
			<div id="wrap" class="count_inf">
		        <dl class="counts">
		            <dt>授课记录</dt>
		            <div>
						<?php  if(is_array($list)) { foreach($list as $item1) { ?>
							<?php  if($item1['isxiangqing'] == 1) { ?>
								<?php  if($item1['date'] > $showTime) { ?>
								<dd>
								<?php  } else { ?>
								<dd class="click1" onclick="touch_check(<?php  echo $item1['id'];?>)">
								<?php  } ?>
							<?php  } else { ?>
								<?php  if($item1['date'] > $showTime) { ?>
								<dd>
								<?php  } else { ?>
								<dd class="click" onclick="touch_check(<?php  echo $item1['id'];?>)">
								<?php  } ?>
							<?php  } ?>
									第<span><?php  echo $item1['nub'];?></span>课
									<br/><?php  echo date('m月d',$item1['date'])?>
									</br><?php  if(!empty($category[$item1['sd_id']])) { ?><?php  echo $category[$item1['sd_id']]['sname'];?><?php  } ?>
								</dd>
						<?php  } } ?>
		          		<div style="clear:both"></div>
		            </div>
		        </dl>
		    </div>
			<!-- 主任身份 notOwner end-->
			<!-- 自己的身份 start-->
		    <?php  } else if(empty($_GPC['notOwner'])) { ?>
			<div id="wrap" class="user_inf">
		        <a class="help" href="javascript:void(0)">
					<span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>他人签到&nbsp;
					<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>自己签到&nbsp;
					<span style="background-color:#9cd0c8;">&nbsp;&nbsp;&nbsp;&nbsp;</span>无人签到&nbsp;
					<span style="background-color:#999;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未开始
				</a>
		    </div>
			<div id="wrap" class="count_inf">
		        <dl class="counts">
		            <dt>授课记录</dt>
		            <div>
						<?php  if(is_array($list)) { foreach($list as $item1) { ?>
				      	<?php  if($item1['date'] < $showTime) { ?>
				      		<?php  if($item1['checksign'] == 1) { ?>
					      	<dd class="click" onclick="touch(<?php  echo $item1['id'];?>)">
					      	<?php  } else if($item1['checksign'] == 2) { ?>
							<dd class="click1">
							<?php  } else if(empty($item1['checksign'])) { ?>
							<dd  class="click" style="background-color: #9cd0c8;" >
							<?php  } ?>
				      	 <?php  } else { ?>
							<dd>
				      	  <?php  } ?>
								第<span><?php  echo $item1['nub'];?></span>课<?php  echo $item1['id'];?><br/>
								<?php  echo date('m月d',$item1['date'])?></br>
								<?php  if(!empty($category[$item1['sd_id']])) { ?><?php  echo $category[$item1['sd_id']]['sname'];?><?php  } ?>
							</dd>
						<?php  } } ?>
		          		<div style="clear:both"></div>
		            </div>
		        </dl>
		    </div>
		    <?php  } ?>
			<!-- 自己身份 end -->
		<!-- 固定课表 end -->
		<!-- 自由选课 start -->
	    <?php  } else if($item['OldOrNew'] == 1 && $item['isSign'] == 1) { ?>
			<!-- 主任身份 notOwner  start-->
		    <?php  if($_GPC['notOwner'] =='notOwner') { ?>
		    <div id="wrap" class="count_inf">
		        <dl class="counts">
		            <dt>授课记录</dt>
		            <div>
						<?php  if(is_array($kslist)) { foreach($kslist as $key => $item1) { ?>
				      	<dd class="click" onclick="touch_New_check(<?php  echo $item1['createtime'];?>)">
			      	  	第<span><?php  echo $key+1?></span>课<br/>
						<?php  echo date('m月d日',$item1['createtime'])?></br>
						</dd>
						<?php  } } ?>
		          		<div style="clear:both"></div>
		            </div>
		        </dl>
		    </div>
			<!-- 主任身份 notOwner  end-->
			<!-- 自己身份 start -->
		   <?php  } else if(empty($_GPC['notOwner'])) { ?>
			<div id="wrap" class="user_inf">
		        <a class="help" href="javascript:void(0)">
					<span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>他人签到&nbsp;
					<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>自己签到
				</a>
		    </div>

		    <div id="wrap" class="count_inf">
		        <dl class="counts">
		            <dt>授课记录</dt>
		            <div>
						<?php  if(is_array($kslist)) { foreach($kslist as $key => $item1) { ?>
				      		<?php  if($item1['tid'] == $it['tid']) { ?>
					      	<dd class="click" onclick="touch_New(<?php  echo $item1['createtime'];?>)">
					      	<?php  } else if($item1['tid'] != $it['tid']) { ?>
							<dd class="click1" >
				      	  	<?php  } ?>
								第<span><?php  echo $key+1?></span>课<br/>
								<?php  echo date('m月d日',$item1['createtime'])?></br>
							</dd>
						<?php  } } ?>
		          		<div style="clear:both"></div>
		            </div>
		        </dl>
		    </div>
		    <?php  } ?>

	    <?php  } ?>
    <?php  } else if(!empty($checktid)) { ?>
		<?php  if($item['OldOrNew'] == 0 && $item['isSign'] == 0) { ?>
		<div id="wrap" class="user_inf">
	        <a class="help" href="javascript:void(0)"><span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>有内容&nbsp;<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>已授课程&nbsp;<span style="background-color:#999;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未开始</a>
	    </div>
		<div id="wrap" class="count_inf">
	        <dl class="counts">
	            <dt>授课记录</dt>
	            <div>
					<?php  if(is_array($list)) { foreach($list as $item1) { ?>
						<?php  if($item1['tid'] == $checktid) { ?>
				      	<dd onclick="touch_check(<?php  echo $item1['id'];?>)" <?php  if($item1['isxiangqing'] == 1) { ?><?php  if($item1['date'] > $showTime) { ?> <?php  } else { ?> class="click1"<?php  } ?><?php  } else { ?><?php  if($item1['date'] > $showTime) { ?><?php  } else { ?> class="click" <?php  } ?><?php  } ?>>第<span><?php  echo $item1['nub'];?></span>课<br/><?php  echo date('m月d',$item1['date'])?></br><?php  if(!empty($category[$item1['sd_id']])) { ?><?php  echo $category[$item1['sd_id']]['sname'];?><?php  } ?></dd>
				      	<?php  } ?>
					<?php  } } ?>
	          		<div style="clear:both"></div>
	            </div>
	        </dl>
	    </div>
	    <?php  } else if($item['OldOrNew'] ==0 && $item['isSign'] == 1) { ?>
	    	<div id="wrap" class="user_inf">
		        <a class="help" href="javascript:void(0)">
					<span style="background-color:#F0AD4E;">&nbsp;&nbsp;&nbsp;&nbsp;</span>他人签到&nbsp;
					<span style="background-color:#00b8ff;">&nbsp;&nbsp;&nbsp;&nbsp;</span>本人签到&nbsp;
					<span style="background-color:#9cd0c8;">&nbsp;&nbsp;&nbsp;&nbsp;</span>无人签到&nbsp;
					<span style="background-color:#999;">&nbsp;&nbsp;&nbsp;&nbsp;</span>未开始
				</a>
		    </div>
			<div id="wrap" class="count_inf">
		        <dl class="counts">
		            <dt>授课记录</dt>
		            <div>
						<?php  if(is_array($list)) { foreach($list as $item1) { ?>
				      	<?php  if($item1['date'] < $showTime) { ?>
				      		<?php  if($item1['checksign'] == 1) { ?>
					      	<dd class="click" onclick="touch_check(<?php  echo $item1['id'];?>)">
					      	<?php  } else if($item1['checksign'] == 2) { ?>
					      	<dd class="click1" onclick="touch_check(<?php  echo $item1['id'];?>)">
					      	<?php  } else if(empty($item1['checksign'])) { ?>
					      	<dd  class="click" style="background-color: #9cd0c8;" >
					      	<?php  } ?>
				      	<?php  } else { ?>
					      	<dd>
				      	<?php  } ?>
				      	第<span><?php  echo $item1['nub'];?></span>课<br/><?php  echo date('m月d',$item1['date'])?></br><?php  if(!empty($category[$item1['sd_id']])) { ?><?php  echo $category[$item1['sd_id']]['sname'];?><?php  } ?></dd>
						<?php  } } ?>
		          		<div style="clear:both"></div>
		            </div>
		        </dl>
		    </div>
	    <?php  } else if($item['OldOrNew'] == 1 && $item['isSign'] == 1) { ?>
		    <div id="wrap" class="count_inf">
		        <dl class="counts">
		            <dt>授课记录</dt>
		            <div>
						<?php  if(is_array($kslist)) { foreach($kslist as $key => $item1) { ?>
				      	<dd class="click" onclick="touch_New_check(<?php  echo $item1['createtime'];?>)" >
			      	  	第<span><?php  echo $key+1?></span>次<br/><?php  echo date('m月d日',$item1['createtime'])?></br></dd>
						<?php  } } ?>
		          		<div style="clear:both"></div>
		            </div>
		        </dl>
		    </div>
	    <?php  } ?>
    <?php  } ?>
	<input id="userid" name="userid" type="hidden" value="<?php  echo $it['id'];?>">
	<input id="ReNum" name="ReNum" type="hidden" value="<?php  echo $item['ReNum'];?>">
	<input id="RePrice" name="RePrice" type="hidden" value="<?php  echo $item['RePrice'];?>">
	<div class="component-panel" id="qdqr" style="display:none;">
		<div class="mask"></div>
		<div class="component-dialog dialog-order">
			<div class="component-dialog-title">确认签到</div>
			<div class="component-dialog-body">
				<form class="form-order" novalidate="novalidate">
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span>课程:</span>
							<span style="font-weight:bold"><?php  echo $item['name'];?></span>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<?php  if($item['OldOrNew']==0) { ?>
							<span>课时:</span>
							<span>第<span style="font-weight:bold;color:#ff0200"><?php  echo $isHaveKs['nub'];?></span>课</span>
							<?php  } else { ?>
							<span>日期:</span>
							<span style="font-weight:bold;color:#ff0200"><?php  echo date("Y年m月d日",time())?></span>课
							<?php  } ?>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">

							<?php  if(!empty($_GPC['notOwner'])) { ?>
							<span>老师:</span>
							<select style="margin-right:15px;" name="selectTid" id="selectTid" class="form-control selectks">
		                    	<option value="">请选择老师</option>
		                    	<?php  if(is_array($tid_tname)) { foreach($tid_tname as $item_t) { ?>
								<option value="<?php  echo $item_t['id'];?>"><?php  echo $item_t['tname'];?></option>
								<?php  } } ?>
		                    </select>
		                    <input type="hidden" id="is_dq" value="njzrdq">
		                    <?php  } else if(empty($_GPC['notOwner'])) { ?>
							<input type=hidden name="selectTid" id="selectTid" value="<?php  echo $it['tid'];?>" class="form-control">
							<input type="hidden" id="is_dq" value="self">
		                    <?php  } ?>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
						</div>
					</div>
					<input type="hidden" name="object_number" value="751895459">
					<input type="hidden" name="content_type" value="yunying.org_account">
					<div class="component-dialog-footer">
						<a type="button" class="btn-default btn" style="margin-left: 4%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;" onclick="closed()" >取消</a>
						<button type="button" class="btn-primary btn"  style="width:30%;margin-left: 18%;" data-opttype="yes" onclick="qd_ajax()">确定</button>
					</div>
				</form>
			</div>
			<div class="component-dialog-footer"></div>
		</div>
	</div>
	<div class="component-panel" id="xzks" style="display:none;">
		<div class="mask"></div>
		<div class="component-dialog dialog-order">
			<div class="component-dialog-title">签到</div>
			<div class="component-dialog-body">
				<form class="form-order" novalidate="novalidate">
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<?php  if(!empty($_GPC['notOwner'])) { ?>
							<select style="margin-right:15px;" name="selectTid_ks" id="selectTid_ks" class="form-control selectks">
		                    	<option value="">请选择老师</option>
		                    	<?php  if(is_array($tid_tname)) { foreach($tid_tname as $item_t) { ?>
								<option value="<?php  echo $item_t['id'];?>"><?php  echo $item_t['tname'];?></option>
								<?php  } } ?>
		                    </select>
		                    <input type="hidden" id="is_dq_ks" value="njzrdq">
		                    <?php  } else if(empty($_GPC['notOwner'])) { ?>
							<input type=hidden name="selectTid_ks" id="selectTid_ks" value="<?php  echo $it['tid'];?>" class="form-control">
								<input type="hidden" id="is_dq_ks" value="self">
		                    <?php  } ?>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<select style="margin-right:15px;" name="selectks" id="selectks" class="form-control selectks">
		                    	<option value="">请选择课时</option>
		                    	<?php  if(is_array($ableKs)) { foreach($ableKs as $itemks) { ?>
								<option value="<?php  echo $itemks['id'];?>"><?php  echo $itemks['sdname'];?> </option>
								<?php  } } ?>
		                    </select>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
						</div>
					</div>
					<input type="hidden" name="object_number" value="751895459">
					<input type="hidden" name="content_type" value="yunying.org_account">
					<div class="component-dialog-footer">
						<a type="button" class="btn-default btn" style="margin-left: 4%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;" onclick="closed_selectks()" >取消</a>
						<button type="button" class="btn-primary btn"  style="width:30%;margin-left: 18%;" data-opttype="yes" onclick="qd_ajax_ks()">确定</button>
					</div>
				</form>
			</div>
			<div class="component-dialog-footer"></div>
		</div>
	</div>
<script>
	$(function () {
		<?php  if($_GPC['notOwner'] != 'notOwner') { ?>
			<?php  if(!IsHasQx($tid_global,2001403,2,$schoolid) ) { ?>
				$(".qx_01403").hide();
			<?php  } ?>
		<?php  } ?>
		<?php  if($_GPC['notOwner'] == 'notOwner') { ?>
			<?php  if(!IsHasQx($tid_global,2001503,2,$schoolid) ) { ?>
				$(".qx_01503").hide();
			<?php  } ?>
			<?php  if(!IsHasQx($tid_global,2001504,2,$schoolid) ) { ?>
				$(".qx_01403").hide();
			<?php  } ?>
		<?php  } ?>
	});
	setTimeout(function() {
		if(window.__wxjs_environment === 'miniprogram'){
			$("#titlebar").hide();
			$("#titlebar_bg").hide();
			document.title="课程详情";
		}
	}, 100);

	function closed(){
		$("#qdqr").hide();
	};
	function closed_selectks(){
		$("#xzks").hide();
	}
	var OldOrNew = <?php  echo $item['OldOrNew'];?>;
	function startsign(){
		var s_isSign = <?php  echo $item['isSign'];?>;
		var OldOrNew = <?php  echo $item['OldOrNew'];?>;
		if(OldOrNew == 1){
			//直接签到
			$("#qdqr").show();
		}else if(OldOrNew == 0){
			<?php  if(!empty($ableKs)) { ?>
				//有课时
				$("#xzks").show();
			<?php  } else { ?>
				//无课时
				alert("该课程今日无课时");
			<?php  } ?>
		}
	}

	function qd_ajax(){
		var tid= $("#selectTid").val();
		var is_dq = $("#is_dq").val();

		if(tid==0 || tid==null){
			jTips("请选择老师");
			return;
		}
			var data={
				weid: <?php  echo $weid;?>,
				schoolid:<?php  echo $schoolid;?>,
				OldOrNew :1,
				kcid: <?php  echo $id;?>,
				tid:tid,
				is_dq:is_dq,
				status:1
			};
			kcqd_ajax_end(data);
	}


		function qd_ajax_ks(){
			var tid= $("#selectTid_ks").val();
			var is_dq = $("#is_dq_ks").val();

			<?php  if(!empty($ableKs)) { ?>
				//有课时
				var ksid = $("#selectks").val();
				var data={
					weid: <?php  echo $weid;?>,
					schoolid:<?php  echo $schoolid;?>,
					OldOrNew :0,
					kcid: <?php  echo $id;?>,
					ksid:ksid,
					tid:tid,
					is_dq:is_dq,
					status:1
				};
				//直接签到
				kcqd_ajax_end(data);
			<?php  } else { ?>
				//无课时
				alert("该课程今日无课时");
			<?php  } ?>

	}

	function kcqd_ajax_end(datas){
		$.ajax({
			url: "<?php  echo $this->createMobileUrl('kcajax', array('op' => 'tkcsign'), true)?>",
			type: "post",
			dataType: "json",
			data: datas,
			success: function (data_s) {
				console.log(data_s);
				jTips(data_s.msg);
				location.reload();
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert(textStatus);
			}
		});
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
function touch(itemid) {
	var id = itemid;
	<?php  if(IsHasQx($tid_global,2001404,2,$schoolid) ) { ?>
		window.location.href = "<?php  echo $this->createMobileurl('txsbqkc', array('schoolid' => $schoolid,'userid'=>$it['id'],'kcid'=>$item['id']), true)?>" + '&ksid=' + id;
	<?php  } ?>
}
function touch_New(time) {
	<?php  if(IsHasQx($tid_global,2001404,2,$schoolid) ) { ?>
		window.location.href = "<?php  echo $this->createMobileurl('txsbqkc', array('schoolid' => $schoolid,'userid'=>$it['id'],'kcid'=>$item['id']), true)?>" + '&time=' + time;
	<?php  } ?>
}
function touch_check(itemid) {
	var id = itemid;
	<?php  if(IsHasQx($tid_global,2001505,2,$schoolid) ) { ?>
		window.location.href = "<?php  echo $this->createMobileurl('txsbqkc', array('schoolid' => $schoolid,'userid'=>$it['id'],'kcid'=>$item['id'],'notOwner'=>'notOwner'), true)?>" + '&ksid=' + id;
	<?php  } ?>
}

function touch_New_check(time) {
	<?php  if(IsHasQx($tid_global,2001505,2,$schoolid) ) { ?>
		window.location.href = "<?php  echo $this->createMobileurl('txsbqkc', array('schoolid' => $schoolid,'userid'=>$it['id'],'kcid'=>$item['id'],'notOwner'=>'notOwner'), true)?>" + '&time=' + time;
	<?php  } ?>
}
</script>
	<?php  include $this->template('newfooter');?>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>