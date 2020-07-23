<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<div class="panel panel-info">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li <?php  if($_GPC['do']=='kecheng') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kecheng', array('op' => 'display', 'schoolid' => $schoolid))?>">课程系统</a></li>
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' || (IsHasQx($tid_global,1000921,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kcbiao') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display', 'schoolid' => $schoolid))?>">课时管理</a></li>
			<?php  } ?>
			<?php  if(($tid_global =='founder'|| $tid_global == 'owner' || (IsHasQx($tid_global,1000941,1,$schoolid))) ) { ?>
			<li <?php  if($_GPC['do']=='kcsign') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcsign', array('op' => 'display', 'schoolid' => $schoolid))?>">签到管理</a></li>
			<?php  } ?>
			<?php  if(((is_showgkk() && ((IsHasQx($tid_global,1000951,1,$schoolid)) || $tid_global =='founder'|| $tid_global == 'owner')) )) { ?>
			<li <?php  if($_GPC['do']=='gongkaike') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('gongkaike', array('op' => 'display', 'schoolid' => $schoolid))?>">公开课系统</a></li>
			<?php  } ?>
			<!-- 权限未做处理 -->
			<li <?php  if($_GPC['do']=='kcset') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcset', array('op' => 'display', 'schoolid' => $schoolid))?>">课程设置</a></li>
		</ul>	
	</div>
</div>
<?php  if($operation == 'display2') { ?>
<link href="<?php echo MODULE_URL;?>public/web/css/app.css" rel="stylesheet">
<style>
.deleteImage {background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px;display: inline;float: ;right:-8px;height: 20px;position: absolute;width: 20px;z-index: 4;top: 0px;} .deleteImages {background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px;display: inline;float: ;right:0px;height: 20px;position: absolute;width: 20px;z-index: 4;top: 0px;} .item:hover {cursor:pointer; overflow:hidden;background-color: #e0e6e6;color:#e0e6e6;box-sizing: border-box;} .mofang:hover {background-color: #e0e6e6 !important;color:#e0e6e6 !important;} .parent_weekPlan:hover {background-color: #e0e6e6 !important;color:#e0e6e6;} .item:not([selected]) .deleteImage{display:none!important;} .item:not([pinned]):hover .deleteImage{display:inherit!important;} .mofang:not([selected]) .deleteImages{display:none!important;} .mofang:not([pinned]):hover .deleteImages{display:inherit!important;} .mofang_two:not([selected]) .deleteImages_two{display:none!important;} .mofang_two:not([pinned]):hover .deleteImages_two{display:inherit!important;} .mofang_three:not([selected]) .deleteImages_three{display:none!important;} .mofang_three:not([pinned]):hover .deleteImages_three{display:inherit!important;} .mofang_four:not([selected]) .deleteImages_four{display:none!important;} .mofang_four:not([pinned]):hover .deleteImages_four{display:inherit!important;} .mofang_ms:not([selected]) .deleteImage_ms{display:none!important;} .mofang_ms:not([pinned]):hover .deleteImage_ms{display:inherit!important;} .app .app-preview .app-header{height:70px; background:url('../web/resource/images/app/iphone_head.png') center center no-repeat;} .op_boxs{ width: 100%; margin-top: 60px; padding-left: 13px; padding-right: 13px;display: inline-flex; text-align: center; height: 35px; } .op_boxs .opt_btn{ list-style: none; width: 33.33%; line-height: 34px; } .op_boxs .acts{color: #09a52c;border-bottom: 3px solid #09a52c;font-weight: bold;font-size: 15px;} .new_search_boxs{ width: 100%; display: inline-flex; } .new_search_option_boxs { background: url(<?php echo OSSURL;?>public/mobile/img/new_search_icon2.png) no-repeat left;background-size: 13px 13px;background-position-x: 8px;padding-left: 25px; margin-top: 6px;float: left; width: 100%; display: block;  margin-bottom: 10px; height: 32px; box-sizing: border-box; padding: 10px 10px 10px 26px; background-color: #f3f1f1; border: 1px solid #f3f1f1; position: relative; margin-left: 10px; margin-right: 10px; padding-top: 10px; border-radius: 15px; } .sou_btn{ width: 12%; height: 25px; line-height: 25px; background-color: #afdbf5; text-align: center; margin-top: 9px; border-radius: 7px; }.onclick{width: 80%;} .deleteImage1 {    background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px; display: inline; margin-top: -14px; margin-left: 434px; height: 20px; position: absolute; width: 20px; z-index: 4; top: 0px;} .deleteImages_two {    background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px; display: inline; margin-left: 150px; height: 20px; position: absolute; width: 20px; z-index: 4; top: 0px;} .deleteImages_three {    background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px; display: inline; margin-left: 233px; height: 20px; position: absolute; width: 20px; z-index: 4; top: 0px;} .deleteImages_four {    background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px; display: inline; margin-left: 233px; margin-top: 105px; height: 20px; position: absolute; width: 20px; z-index: 4; top: 0px;} .deleteImage_ms {    background: url(<?php echo OSSURL;?>public/mobile/img/deleteImage.png); background-size: 20px; display: inline; margin-left: 115px; height: 20px; position: absolute; width: 20px; z-index: 4; margin-top: -15px;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/parent_index.css">
<div class="cLine">
    <div class="alert">
    <p><span class="bold">提醒：</span>某些功能自定义名称在这里选中后前端将以此页面为准，后端菜单为自定义命名，如实时画面系统等</br>   
   <strong><font color='red'>特别提醒: 当你在前端学生家长个人中心启用自定义模板的时候才能使用本自定模板!</font></strong></br>
   <strong><font style="color:#641DBF;">本页涉及到的教育菜单链接需要实现开启相应功能后才可使用，否则仅仅这里设置后无效，例如考勤功能等</font></strong>
    </p>
    </div>
</div>
<div class="main">
	
<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">		
	<div class="app clearfix">
		<div class="app-preview">
			<div class="app-header">
				<div class="op_boxs">
					<?php  if(is_array($kctitle)) { foreach($kctitle as $index => $row) { ?>
					<li class="opt_btn <?php  if($index == 0) { ?>acts <?php  } ?>" onclick="top_change(<?php  echo $index;?>,this)"><?php  echo $row['name'];?><i class="material-icons fa fa-bars hover_show"  onclick="shouweditor(<?php  echo $row['id'];?>)" style="float:right; margin-top: 10px; display:none;"></i>
					</li>
					<?php  } } ?>
				</div>
				
			</div>
			<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kcpage', TEMPLATE_INCLUDEPATH)) : (include template('public/kcpage', TEMPLATE_INCLUDEPATH));?>
			<div class="app-region">
				<div class="arrow-top"></div>
				<div class="panel panel-default">
					<div class="panel-body">
						<h4 style="min-height:10px;padding-top: 5px;" class="text-center">新增组件</h4>
						<ul class="app-add-filed clearfix" style="padding-top: 5px;">
							<li class="ng-scope"><a id="kctitle" style="min-width:70px;" class="btn btn-primary ng-binding">课程标题</a></li>
							<li class="ng-scope"><a id="jpkc" style="min-width:70px;" class="btn btn-primary ng-binding">精品课程</a></li>
							<li class="ng-scope"><a id="kccommend" style="min-width:70px;" class="btn btn-primary ng-binding">课程推荐</a></li>
							<li class="ng-scope"><a id="kcteam" style="min-width:70px;" class="btn btn-primary ng-binding">推荐团购</a></li>
							<li class="ng-scope"><a id="teacher" style="min-width:70px;" class="btn btn-primary ng-binding">名师</a></li>
						</ul>
					</div>
				</div>
			</div>				
		</div>
		<div class="app-side">
			<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kcchose', TEMPLATE_INCLUDEPATH)) : (include template('public/kcchose', TEMPLATE_INCLUDEPATH));?>
		</div>
		<div class="shop-preview col-xs-12 col-sm-9 col-lg-10">
			<div class="text-center alert alert-warning"  style="padding: 25px;height:60px;margin-bottom: 10px;border: 1px solid transparent;    border-radius: 4px;">
				<input style="top: -10px;" type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				<input type="hidden" name="weid" value="<?php  echo $weid;?>" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
function deleteclass(elm,id,type) {
	if(type == 20){
		$(elm).parent().remove();
		$("#iconeditor"+id).remove();			
	}
	
	if(type == 21){
		$(elm).parent().parent().parent().parent().remove();
		$("#iconeditor"+id).remove();			
	}
	if(type == 22){
		$(elm).parent().remove();
		$("#iconeditor"+id).remove();			
	}
	if(type == 23){
		$(elm).parent().parent().parent().parent().remove();
		$("#iconeditor"+id).remove();			
	}
	if(type == 24){
		$(elm).parent().parent().remove();
		$("#iconeditor"+id).remove();			
	}
}
function del(elm,id,type) {
	var id = id;
	var truthBeTold = window.confirm('确认要删除已保存的数据吗 ?'); 
	var url = "<?php  echo $this->createWebUrl('kcset',array('op'=>'delclass','schoolid' => $schoolid))?>";
	var submitData = {
			id:id,
	};
	if (truthBeTold) {
		$.post(url, submitData, function(data) {
			if (data.result) {
				if(type == 20){
					$(elm).parent().remove();
					$("#iconeditor"+id).remove();			
				}
				if(type == 21){
					$(elm).parent().parent().parent().parent().remove();
					$("#iconeditor"+id).remove();			
				}
				if(type == 22){
					$(elm).parent().remove();
					$("#iconeditor"+id).remove();			
				}
				if(type == 23){
					$(elm).parent().parent().parent().parent().remove();
					$("#iconeditor"+id).remove();			
				}
				if(type == 24){
					$(elm).parent().parent().remove();
					$("#iconeditor"+id).remove();			
				}
			}else{
			   alert(data.msg);
			}
		},'json');
	}
}
$(document).on('click', '.delmf', function(){
	$(this).parent().remove();
	return false;
});
var imgruls = "<?php echo MODULE_URL;?>public/mobile/img/";
</script> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/teacher', TEMPLATE_INCLUDEPATH)) : (include template('public/teacher', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/bannerlist', TEMPLATE_INCLUDEPATH)) : (include template('public/bannerlist', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/jpkc', TEMPLATE_INCLUDEPATH)) : (include template('public/jpkc', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kcteam', TEMPLATE_INCLUDEPATH)) : (include template('public/kcteam', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kctitle', TEMPLATE_INCLUDEPATH)) : (include template('public/kctitle', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kccommend', TEMPLATE_INCLUDEPATH)) : (include template('public/kccommend', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript"> 		
//处理临时增加的右侧显示
$(document).ready(function() {
	$('#teacher').hide ();//进入默认隐藏名师
	$(".editor").hide();
	
});
function shouweditor(id) {
	$(".editor").hide();
	$("#iconeditor"+id).show();
}
		
require(['jquery', 'util', 'bootstrap.switch'], function($, u){
	$(':checkbox[name="status[]"]').bootstrapSwitch();
	$(':checkbox[name="status[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var status = this.checked ? 1 : 2;
		var id = $(this).attr('data-id');
		$.post("<?php  echo $this->createWebUrl('kcset', array('op' => 'change','schoolid' => $schoolid))?>", {id: id,status: status}, function(resp){
			setTimeout(function(){
			}, 500)
		});
	});	
});		
</script>
<script type="text/javascript"> 
function SwapTxt(btn)  {
	  if(btn){
		  var txt = document.getElementById("btnname"+btn).value;
		  document.getElementById("iconname"+btn).innerHTML=txt;
		  document.getElementById("btnname"+btn).value=txt;
	  }
}
function SwapTxt1(btn)  {
	  if(btn){
		  var txt = document.getElementById("btnname"+btn).value;
		  document.getElementById("iconname"+btn).innerHTML=txt;
		  document.getElementById("btnname"+btn).value=txt;
	  }
}
function SwapTxt2(btn)  {
	  if(btn){
		  var txt = document.getElementById("mfbzs"+btn).value;
		  document.getElementById("mfbz"+btn).innerHTML=txt;
		  document.getElementById("mfbzs"+btn).value=txt;
	  }
}
function SwapTxt3(btn)  {
	  if(btn){
		  var txt = document.getElementById("lbnames"+btn).value;
		  document.getElementById("lbname"+btn).innerHTML=txt;
		  document.getElementById("lbnames"+btn).value=txt;
	  }
}
function top_change(type,elm){
		$(".opt_btn").removeClass("acts");
		$(elm).addClass("acts");
		if(type==0){
			$('.tuijian').show (200);
			$('.teacher').hide(200);
			$('#jpkc').show();//显示精品课程
			$('#kcteam').show();//显示推荐团购
			$('#kccommend').show();//显示推荐课程
			$('#teacher').hide();//隐藏名师
		}
		if(type==1){
			$('.tuijian').hide(200);
			$('.teacher').hide(200);
			$('#teacher').hide();//隐藏名师
			$('#jpkc').hide();//隐藏精品课程
			$('#kcteam').hide();//隐藏推荐团购
			$('#kccommend').hide();//隐藏推荐课程
		}
		if(type==2){
			$('#teacher').show();//显示名师
			$('#jpkc').hide();//隐藏精品课程
			$('#kccommend').hide();//隐藏推荐课程
			$('#kcteam').hide();//隐藏推荐团购
			$('.tuijian').hide(200);
			$('.teacher').show(200);
		}
	}
	<!-- 头部标题移入移出 -->
	$(".opt_btn").mouseover(function (){
			let need_show_hover = $(this).find(".hover_show");
			$(need_show_hover).show();
        }).mouseout(function (){
			let need_show_hover = $(this).find(".hover_show");
			$(need_show_hover).hide();
        }); 
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/link', TEMPLATE_INCLUDEPATH)) : (include template('public/link', TEMPLATE_INCLUDEPATH));?>	
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common', TEMPLATE_INCLUDEPATH)) : (include template('web/common', TEMPLATE_INCLUDEPATH));?>