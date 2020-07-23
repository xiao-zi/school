<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">平台设置</a></li>
</ul>
<style>
/**按钮点击特效**/
.mb_marsk:hover{ -webkit-mask:-webkit-linear-gradient(rgba(0, 0, 0, 0.53),rgba(0, 0, 0, 0.53),rgba(0, 0, 0, 0.53),rgba(0, 0, 0, 0.53))}
.qr_code_table{ width: 100%; min-height: 120px; float: left; }
.qr-code-table-name{}
.apps_item{ margin: 15px; width: 15%; height: 100px; float: left; border-radius: 6px; border: 1px solid #eceaea; }
.apps_box{ width: 100%; height: 100px; margin: 8px; }
.apps_item_image{ width: 22%; float: left; }
.apps_item_image img{border: 1px solid #eceaea;border-radius: 50%;}
.apps_item_info{ width: 70%; float: left; margin-left: 7px; }
.apps_item_name{ font-weight: bold; width: 100%; }
.yaz{position: absolute;width: 17px;height: 17px;margin-left: 5px;background: url(<?php echo MODULE_URL;?>public/mobile/img/ico_no_1.png) no-repeat; background-position: center center; background-size: 17px 17px;}
.app_info{font-size: 11px;color: #9c9393;max-height: 33px;overflow: hidden;}
.apps_infos{ float: right; font-weight: 100; font-size: 11px; color: #2515f7; }
.btnlist{width: 100%;}
.install_btn{ max-width: 64%; padding: 4px; text-align: center; height: 26px; margin: 8px; font-size: 12px; line-height: 17px; border-radius: 5px; background: #de3d52; color: #fff; float: right; margin-top: 5px; }
.use_btn{cursor:pointer;max-width: 64%; padding: 4px; text-align: center; height: 26px; margin: 8px; font-size: 12px; line-height: 17px; border-radius: 5px; background: #3dcede; color: #fff; float: right; margin-top: 5px; }
.school_box{ width:75px; height:100px; margin:20px; float: left;position: relative;}
.school_icon{ width:100%; }
.school_icon img{ width: 100%; border-radius:50% }
.school_title{width:100%;text-align:center}
.icon_marsk{ position: absolute; top: 0px; width: 75px; height: 75px; border-radius: 50%; z-index: 5; background-color: rgba(0,0,0,.5); text-align: center;display:none}
.gou{ font-family: we7icon!important; display: inline-block; speak: none; font-style: normal; font-weight: 400; font-variant: normal; text-transform: none; color: #fff; font-size: 23px; position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%,-50%); -moz-transform: translate(-50%,-50%); transform: translate(-50%,-50%); line-height: 1; -webkit-font-smoothing: antialiased; }
</style>
<?php  if($operation == 'display') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
			<?php  if($_W['isfounder']) { ?>
				<div class="alert alert-success">
					温馨提示:</br>
					此处设置后，仅仅对关联学校生效
				</div>
			<?php  } ?>
            <div class="row" style="margin-left: 15px;">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/ctrl_nave', TEMPLATE_INCLUDEPATH)) : (include template('public/ctrl_nave', TEMPLATE_INCLUDEPATH));?>
            </div>
            <div class="header">
                <h3>应用列表</h3>
            </div>
			<div id="queue-setting-index-body">
				<div class="alert alert-success">
					建议：当给学校开启相关应用权限后，不要再次关闭学校使用该应用权限，如：您之前给学校开过团购功能，那么关闭后，学校已经创建的团购功能仍然能正常使用，但是学校无法创新新的团购课程
				</div>
				<div class="qr_code_table">
					<div class="qr_code_table_name">培训类</div>
					<div class="apps_item">
						<div class="apps_box">
							<div class="apps_item_image">
								<img src="<?php echo OSSURL;?>public/mobile/img/tuiguangapp.png" width="100%"/>
							</div>
							<div class="apps_item_info">
								<div class="apps_item_name">推广员<span class="yaz" data-toggle="tooltip" data-placement="top" data-original-title="必装优质应用"></span><?php  if(!check_apps('tuiguang')) { ?><a href="https://s.w7.cc/module-17291.html" target="_blank" class="apps_infos" data-toggle="tooltip" data-placement="top" data-original-title="查看详情">详情</a><?php  } ?></div>
								<div class="app_info ">推广员管理，学员跟踪，推广任务管理，推广绩效管理，数据统计</div>
								<div class="btnlist tuiguang"></div>
							</div>
						</div>
					</div>
					<div class="apps_item">
						<div class="apps_box">
							<div class="apps_item_image">
								<img src="<?php echo OSSURL;?>public/mobile/img/tuanapp.png" width="100%"/>
							</div>
							<div class="apps_item_info">
								<div class="apps_item_name">课程团购<span class="yaz" data-toggle="tooltip" data-placement="top" data-original-title="必装优质应用"></span><?php  if(!check_apps('tuan')) { ?><a href="https://s.w7.cc/module-17291.html" target="_blank" class="apps_infos" data-toggle="tooltip" data-placement="top" data-original-title="查看详情">详情</a><?php  } ?></div>
								<div class="app_info">支持团购海报，课程团购，团长优惠，团购统计，虚拟拼团</div>
								<div class="btnlist tuan"></div>
							</div>
						</div>
					</div>
					<div class="apps_item">
						<div class="apps_box">
							<div class="apps_item_image">
								<img src="<?php echo OSSURL;?>public/mobile/img/zhuliapp.png" width="100%"/>
							</div>
							<div class="apps_item_info">
								<div class="apps_item_name">课程助力<span class="yaz" data-toggle="tooltip" data-placement="top" data-original-title="必装优质应用"></span><?php  if(!check_apps('zhuli')) { ?><a href="https://s.w7.cc/module-17291.html" target="_blank" class="apps_infos" data-toggle="tooltip" data-placement="top" data-original-title="查看详情">详情</a><?php  } ?></div>
								<div class="app_info">支持助力海报，助力优惠，助力统计，虚拟助力</div>
								<div class="btnlist zhuli"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="qr_code_table">
					<div class="qr-code-table-name">通用类</div>
					<div class="apps_item">
						<div class="apps_box">
							<div class="apps_item_image">
								<img src="<?php echo OSSURL;?>public/mobile/img/bigdataapp.png" width="100%"/>
							</div>
							<div class="apps_item_info">
								<div class="apps_item_name">大数据<span class="yaz" data-toggle="tooltip" data-placement="top" data-original-title="必装优质应用"></span><?php  if(!$bigdata) { ?><a href="https://s.w7.cc/module-18710.html" target="_blank" class="apps_infos" data-toggle="tooltip" data-placement="top" data-original-title="查看详情">详情</a><?php  } ?></div>
								<div class="app_info">支持校园数据实时汇总显示，考勤统计，人数统计，财务统计，互动统计</div>
								<div class="btnlist bigdatapp">
								<?php  if($bigdata) { ?>
									<div class="use_btn mb_marsk" onclick="bus_app('bigdata')">部署应用</div>
								<?php  } else { ?>
									<a class="install_btn mb_marsk">立即安装</a>
								<?php  } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
        </div>
    </div>
	<div class="uploader-modal modal fade keyword ng-scope ng-isolate-scope in" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog modal-lg ng-scope">
			<div class="modal-content">
				<div class="modal-header">
					<div class="alert alert-success">
						温馨提示：一旦授权给学校，学校已经使用此应用功能后，切勿轻易取消
					</div>
				</div>
				<input type="hidden" id="now_app" value=""/>
				<div class="modal-body material-content clearfix">
					<div class="material-head">
						<div class="form-horizontal clearfix form-inline ng-pristine ng-valid">
							<div class="input-group pull-left" style="display: inline-flex;">
								<input type="text" id="keyword" class="form-control ng-pristine ng-valid ng-empty ng-touched" placeholder="搜索学校名" style="">
								<select id ="schooltype">
									<option value="">按学校类型</option>
								<?php  if(is_array($schooltype)) { foreach($schooltype as $row) { ?>
									<option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
								<?php  } } ?>	
								</select>
								<select id ="schoolare" style="margin-left:10px">
									<option value="">按学校区域</option>
								<?php  if(is_array($area)) { foreach($area as $row) { ?>
									<option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
								<?php  } } ?>	
								</select>
								<span class="input-group-btn"><button type="button" onclick="get_list()" class="btn btn-default"><i class="wi wi-search"></i></button></span>
							</div>
							<div class="pull-right" id="pull-right"></div>
						</div>
					</div>
					<div class="material-body" style="overflow-y: scroll;">
						<div class="row" id="schoollist">

						</div>
					</div>
				</div>
				<div class="modal-footer" style="border-radius: 6px;">
					<input type="submit" onclick="tijiao()" class="btn btn-success" value="确认部署">
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
require(['bootstrap'],function($){
	$('.btn,.tips').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
function bus_app(app){
	$('#now_app').val(app);
	$('#Modal').modal('toggle');
	$('#schooltype').val();
	$('#schoolare').val();
	$('#keyword').val();
	get_list();
}

function get_list(){
	var app = $('#now_app').val();
	var typeid = $('#schooltype').val();
	var areaid = $('#schoolare').val();
	var keyword = $('#keyword').val();
	$.ajax({
		url: "<?php  echo $this->createWebUrl('manger_apps', array('op'=>'get_schoolist'))?>",
		type: "post",
		dataType: "json",
		data: {
			app:app,
			areaid:areaid,
			typeid:typeid,
			keyword:keyword
		},
		success: function (data) {
			if (data.result) {
				$('#schoollist').empty();
				var list = data.list
				var html = '';
				for (var i in list) {
					if(list[i].app){
						html += '<div class="school_box checked mb_marsk" schoolid="'+list[i].id+'" onclick="click_this(this)"><div class="school_icon"><img src="'+list[i].logo+'"/></div><div class="school_title"><span>'+list[i].title+'</span></div><div class="icon_marsk" style="display:block"><span class="gou wi-right"></span></div></div>';
					}else{
						html += '<div class="school_box mb_marsk" schoolid="'+list[i].id+'" onclick="click_this(this)"><div class="school_icon"><img src="'+list[i].logo+'"/></div><div class="school_title"><span>'+list[i].title+'</span></div><div class="icon_marsk" style="display:none"><span class="gou wi-right"></span></div></div>';
					}
				}
				$('#schoollist').html(html);
				var schoolist = [];
				$(".school_box").each(function(index) {
					if($(this).hasClass("checked")){
						let schoolid = $(this).attr("schoolid")
						schoolist.push(schoolid)
					}
				});
				$('#pull-right').html("此应用已部署到<span style='font-size:20px;color:red;font-weight:bold'>"+schoolist.length+"</span>个学校")
			}
		}		
	});
}

function click_this(e){
	$(e).toggleClass("mb_marsk");
	$(e).children(".icon_marsk").toggle();
	if($(e).hasClass("checked")){
		$(e).removeClass("checked")
	}else{
		$(e).addClass("checked")
	}
}

function tijiao(){
	var app = $('#now_app').val();
	var schoolist = [];
	$(".school_box").each(function(index) {
		if($(this).hasClass("checked")){
			let schoolid = $(this).attr("schoolid")
			schoolist.push(schoolid)
		}
	});
	if(schoolist.length < 1){
		alert('请勾选要部署的学校');
	}
	$.ajax({
		url: "<?php  echo $this->createWebUrl('manger_apps', array('op'=>'set_to_school'))?>",
		type: "post",
		dataType: "json",
		data: {
			app:app,
			schoolist:schoolist
		},
		success: function (data) {
			if (data.result) {
				alert(data.msg);
				$('#Modal').modal('toggle');
			}
		}		
	});
}
get_sllooolit()
function get_sllooolit(){
	$.ajax({
		url: "<?php  echo $this->createWebUrl('manger_apps', array('op'=>'get_schoolists'))?>",
		type: "post",
		dataType: "json",
		data: {
			weid:"<?php  echo $weid;?>",
		},
		success: function (data) {
			if (data.result) {
				$(".zhuli").empty()
				$(".tuan").empty()
				$(".tuiguang").empty()
				$(".zhuli").append(data.data.zhuli)
				$(".tuan").append(data.data.tuan)
				$(".tuiguang").append(data.data.tuiguang)
			}
		}		
	});
}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>