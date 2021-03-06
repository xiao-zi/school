<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/kqtjCss.css?v=5.1"/>
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.9"></script>
<?php  include $this->template('port');?>
<style>
.component-panel {position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: 12;background: rgba(0,0,0,.7);}
.component-dialog {position: absolute;top: 30%;left: 50%;-webkit-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);background: #fff;padding: 10px;width: 80%;border-radius: 10px;}
.dialog-order>.component-dialog-title {text-align: center;}
.component-dialog-body {padding: 10px 0 12px;}
.component-dialog-title {font-size: 16px;font-weight: 200;}
.arrange-detail>ol {box-sizing: border-box;}
.form-order>.form-line {margin-bottom: 5px;}
.form-order>.form-line {margin-bottom: 12px;margin-top: 12px;}
.btnthis {height: 30px;background-color: #7bb52d;font: 16px "黑体";text-align: center;color: #fff;cursor: pointer;border-radius:10px}
.div_closd{margin-left:13%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;float:left;line-height:30px}
.div_sure{margin-right:13%; width:30%;float:right;line-height:30px}
.ovfHiden{overflow:hidden}
.startdate{width: 60%;margin: 3px 0px;height: 30px;line-height: 30px;border: 1px solid #e1e1e1;border-radius: 3px;font-size: 14px;background-attachment: fixed;text-align: center;padding: 0;margin: 0;outline-style: none;-webkit-tap-highlight-color: rgba(0,0,0,0);-webkit-appearance: none;}
</style>
</head>
<body id="kqtjbody">

	<div id="attendance" style="margin-left: 3px;float:unset;box-shadow:2px 2px 10px #c1c1c1;border-radius: 5px;width:98%">
		<div class="r1" style="width:30%">
			<div class="t">
				<div class="t1">请假人数</div>
				<div id="num1" style="font-size:18px"><?php  echo $allnum;?>人</div>
			</div>
		</div>
		<div class="l1" style="width:69%">
			<a id="showhistory">
				<div class="t">
					<div class="t3">创建日期范围</div>
					<div id="num3" style="font-size:16px"><?php  echo date('Y-m-d',$this_starttime)?> 至 <?php  echo date('Y-m-d',$this_endtime)?></div>
				</div>
			</a>
		</div>
	</div>
	<ul id="table-responsive" style="margin-top:unset">	
		<li class="thead">
			<ul>
				<li class="li1" style="width:25%">教师</li>
				<li class="li2" style="width:15%">汇总</li>
				<li class="li3" style="width:15%">病假</li>
				<li class="li4" style="width:15%">事假</li>
				<li class="li5" style="width:15%">公差</li>
				<li class="li5" style="width:15%">其他</li>
			</ul>
		</li>                                                                                                									
		<div class="tbody" id="allcontent">
			<?php  if(is_array($tealist_this)) { foreach($tealist_this as $key => $item) { ?>
				<?php  if($key%2 == 0) { ?>
				<li class="li" style="background-color: rgb(244, 244, 244);">
				<?php  } else { ?>
				<li class="li" style="background-color: white;">
				<?php  } ?>
					<ul>
						<li class="li1" style="width:25%"><?php  echo $item['tname'];?></li>
						<li class="li2" style="width:15%;line-height: 20px;"><?php  echo $item['allcount'];?></li>
						<li class="li3" style="width:15%;line-height: 20px;"><?php  echo $item['bingcount'];?></li>
						<li class="li4" style="width:15%;line-height: 20px;"><?php  echo $item['shicount'];?></li>
						<li class="li5" style="width:15%;line-height: 20px;"><?php  echo $item['chaicount'];?></li>
						<li class="li5" style="width:15%;line-height: 20px;"><?php  echo $item['qitacount'];?></li>
					</ul>		
				</li>
			<?php  } } ?>
		</div>
		<li class="tfoot"></li>
		<li class="overDiv" style="margin-bottom:60px"></li>
	</ul>
	<!--左边弹窗-->
	<div class="component-panel" id="date_range" style="display:none;">
		<div class="mask"></div>
		<div class="component-dialog dialog-order"  id="detail_range" style="box-sizing: border-box;display:none">
			<div class="component-dialog-title">时间范围</div>
			<div class="component-dialog-body">
				<form class="form-order" novalidate="novalidate">
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span style="padding: 8px;">开始日期:</span>
							<input type="date" name="startdate" id="startdate" class="startdate">
						</div>
					</div>

					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span style="padding: 8px;">结束日期:</span>
							<input type="date" name="enddate" id="enddate" class="startdate">
						</div>
					</div>

					<div class="form-line">
						<div class="input-wrapper" style="border:none;height:10px"></div>
					</div>

					<div class="component-dialog-footer">
						<div type="button" class="btn-default btnthis div_closd"  onclick="closed()" >取消</div>
						<div type="button" class="btn-primary btnthis div_sure"   data-opttype="yes" onclick="change_date_range()">确定</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;height:20px"></div>
					</div>
				</form>
			</div>
			<div class="component-dialog-footer"></div>
		</div>
	</div>
<script type="text/javascript">
function closed(){
	$('html,body').removeClass('ovfHiden');
	$("#detail_range").slideUp(100);
	$("#date_range").hide();
	
};

function change_date_range(){
	var start_date = $("#startdate").val();
	var end_date = $("#enddate").val();
	if(start_date != ' ' && start_date != null && end_date != ' ' && end_date != null){
		$.ajax({ 
			url: "<?php  echo $this->createMobileUrl('tqingjiaall', array('op' => 'scroll_add'), true)?>",
			type: "post",
			dataType: "json",
			data: {
				weid: <?php  echo $weid;?>,
				schoolid:<?php  echo $schoolid;?>,
				startdate:start_date,
				enddate:end_date,
			},
			success: function (data) {
				console.log(data);
				jTips(data.msg);
				if(data.status == 2){
					var this_html = '';
					for (var i=0;i<data.data.length;i++)
					{
						if(i%2 == 0){
							this_html +='<li class="li" style="background-color: rgb(244, 244, 244);">';
						}else{
							this_html +='<li class="li" style="background-color: white;">';
						}
						this_html +='<ul>'+
										'<li class="li1" style="width:25%">'+ data.data[i].tname + '</li>'+
										'<li class="li2" style="width:15%;line-height: 20px;">'+ data.data[i].allcount + '</li>'+
										'<li class="li2" style="width:15%;line-height: 20px;">'+ data.data[i].bingcount + '</li>'+
										'<li class="li2" style="width:15%;line-height: 20px;">'+ data.data[i].shicount + '</li>'+
										'<li class="li2" style="width:15%;line-height: 20px;">'+ data.data[i].chaicount + '</li>'+
										'<li class="li2" style="width:15%;line-height: 20px;">'+ data.data[i].qitacount + '</li>'+
									'</ul>'+		
									'</li>';
					}
					$("#allcontent").html(" ");
					$("#allcontent").html(this_html);
					$("#num1").html(data.allnum + "人");
					var start_date_this = $("#startdate").val();
					var end_date_this = $("#enddate").val();
					var time_html = start_date_this + '至' + end_date_this;
					$("#num3").html(time_html);
					closed();
				}else if(data.status == 3){
					$("#allcontent").html(" ");
					closed();
				}
	
			}
		});

	}else{
		alert("开始日期和结束日期不能为空！");
		return;
	}

};



setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		$("#table-responsive").css("margin-top","0px");
		document.title="职工考勤(当日)";
	}
}, 100);

        $(".choice_baby").on("click", function(e) {
            e.stopPropagation();
            $(".slide_left_menu_bg").addClass("show_menu_bg");
        });
        $(".slide_left_menu_bg").on("click", function() {
            $(this).removeClass("show_menu_bg");
        });
	$(function ($) {
		$("#showbjlist").on('click', function () {
            $('#selectList').show();
		});
		$("#showhistory").on('click', function () {
            $('#date_range').show();
			$("#detail_range").slideDown('fast');
		});			
		$("#bdax").on('click', function () {
			var time = $("#time").val();
			if (time == "" || time == undefined || time == null) {
            jTips('请选择日期！');
            return false;
			}
			location.href = "<?php  echo $this->createMobileUrl('jschecklog', array('schoolid' => $schoolid,'nj_id' => $nj_id), true)?>"+ '&time=' + time;	
		});		
	});
	function isSelect(bjid){
		jTips("数据加载中！···");
		location.href = "<?php  echo $this->createMobileUrl('jschecklog', array('schoolid' => $schoolid), true)?>"+ '&nj_id=' + bjid;
	}	
</script>	
<?php  include $this->template('newfooter');?>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>