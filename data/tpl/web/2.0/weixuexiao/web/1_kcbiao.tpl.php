<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>

<style>
/*公共菊花转*/
.popover{left: 950px !important;z-index:100000 !important;}
.common_progress_bg{display: none;position: fixed;top: 0;left: 0;height: 100%;width: 100%;background: rgba(0, 0, 0, 0.6);z-index: 9998;}
.common_progress{position: fixed;top: 40%;background: #000;height: 80px;width: 160px;border-radius: 12px;line-height: 20px;text-align: center;padding-top: 15px;z-index: 9999;}
.common_progress > img{width: 27px;height: 27px;padding-top: 30px;}
.common_progress > .common_loading{width: 30px;height: 30px;display: inline-block;vertical-align: middle;background: url(<?php echo OSSURL;?>public/mobile/img/load.png) no-repeat;background-size: 30px;-webkit-animation: loading1 2s linear infinite;}
@-webkit-keyframes loading1{0%{-webkit-transform: rotate(0deg);}33%{-webkit-transform: rotate(120deg);}66%{-webkit-transform: rotate(240deg);}
100%{-webkit-transform: rotate(360deg);}}
.common_progress > span{margin: 0 0 0 8px;color: #fff;}

    .justshow{background-color: transparent !important;border: unset !important;}
</style>
<div class="panel panel-info">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' ||  (IsHasQx($tid_global,1000901,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kecheng') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kecheng', array('op' => 'display', 'schoolid' => $schoolid))?>">课程系统</a></li>
			<?php  } ?>
			
			<li <?php  if($_GPC['do']=='kcbiao') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display', 'schoolid' => $schoolid))?>">排课管理</a></li>
			
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' || (IsHasQx($tid_global,1000941,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kcsign') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcsign', array('op' => 'display', 'schoolid' => $schoolid))?>">签到管理</a></li>
			<?php  } ?>
			<?php  if((is_showgkk() && ((IsHasQx($tid_global,1000951,1,$schoolid)) || $tid_global =='founder'|| $tid_global == 'owner' ))) { ?>
			<li <?php  if($_GPC['do']=='gongkaike') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('gongkaike', array('op' => 'display', 'schoolid' => $schoolid))?>">公开课系统</a></li>
			<?php  } ?>
			<li <?php  if($_GPC['do']=='kcset') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcset', array('op' => 'display2', 'schoolid' => $schoolid))?>">列表模板</a></li>
		</ul>	
	</div>
</div>
<?php  if($operation == 'display') { ?>
<?php  if($mode == 'list') { ?>
<div class="main">
    <style> .form-control-excel { height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075); -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s; -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; } </style>
    <div class="panel panel-info">
	     <?php  if($_GPC['fromKe'] != 'fromKe') { ?>
        <div class="panel-heading">排课管理</div>
        <?php  } else if($_GPC['fromKe'] == 'fromKe') { ?>
 		<div class="panel-heading">排课管理 - <span style="color:red">【<?php  echo $_GPC['kcName'];?>】</span></div>
 		<div class="panel">
  			<div class="panel-heading">
	  			<a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回</a>
  			</div>
		</div>
        <?php  } ?>
        <div class="panel-body">
			<a class="btn btn-info btn-sm" style="float:right" href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display','mode' => 'table', 'schoolid' => $schoolid))?>"> 日历模式</a>
	        <?php  if($_GPC['fromKe'] != 'fromKe') { ?>
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="kcbiao" />
				<input type="hidden" name="mode" value="list" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
			
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按状态</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="is_start" class="form-control">
                            <option value="-1">不限</option>
                            <option value="1" <?php  if($is_start == 1) { ?> selected="selected"<?php  } ?>>未上课</option>
                         	<option value="2" <?php  if($is_start == 2) { ?> selected="selected"<?php  } ?>>已上课</option>
                        </select>
                    </div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按时段</label>	
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="sd_id" class="form-control">
                            <option value="0">请选择时段搜索</option>
                            <?php  if(is_array($sd)) { foreach($sd as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['sd_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按教室</label>	
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="js_id" class="form-control">
                            <option value="0">请选择时段搜索</option>
                            <?php  if(is_array($js)) { foreach($js as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['js_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                   										
				</div>
				 <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按课程名称</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="kc_id" class="form-control">
                            <option value="0">请选择课程名称</option>
                            <?php  if(is_array($allkc)) { foreach($allkc as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['kc_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按科目</label>	
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="km_id" class="form-control">
                            <option value="0">请选择科目搜索</option>
                            <?php  if(is_array($km)) { foreach($km as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['km_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按教师名称</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="tname" id="" type="text" value="<?php  echo $_GPC['tname'];?>">
                    </div>						
                    <!--<div class="col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						<a class="btn btn-success" href="javascript:;" onclick="$('.file-container').slideToggle()">批量导入课表</a>
                    </div>	-->				
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">授课时间</label>
					<div class="col-sm-2 col-lg-2">
						<?php  echo tpl_form_field_daterange('kstime', array('start' =>date('Y-m-d' ,time() - 86400*600), 'end' => date('Y-m-d')));?>
					</div>
					<div class="col-sm-2 col-lg-2" style="margin-left:50px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						<a class="btn btn-success qx_923" href="javascript:;" onclick="$('.file-container').slideToggle()">批量导入课表</a>
					</div>	
				</div>	
            </form>
            <?php  } ?>
        </div>
    </div>
    <div class="panel panel-default file-container" style="display:none;">
        <div class="panel-body">
            <form id="form">
				<input type="hidden" id="fromtid" value="<?php  echo $tid_global;?>">
                <input name="viewfile" id="viewfile" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
                <a class="btn btn-warning"><label for="unload" style="margin: 0px;padding: 0px;">上传...</label></a>
                <input type="file" class="pull-left btn-primary span3" name="file" id="unload" style="display: none;"
                       onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';">
                <a class="btn btn-danger" onclick="submits('input_ks','form');">导入数据</a>
				<a class="btn btn-info" href="../addons/weixuexiao/public/example/example_kcbiao.xls"><i class="fa fa-download"></i>下载导入模板</a>
            </form>
        </div>
    </div>
	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/excel_input', TEMPLATE_INCLUDEPATH)) : (include template('public/excel_input', TEMPLATE_INCLUDEPATH));?>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
        <table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
                    <th class='with-checkbox' style="width: 2%;"><input type="checkbox" class="check_all" /></th>
					<th style="width:6%">授课教师</th>
					<th style="width:11%;">课程名称</th>
					<th style="width:5%;">排课方式</th>		
					<th style="width:8%;">授课星期</th>
					<th style="width:10%;">课节或时段</th>						
					<th style="width:8%;">授课教室</th>
                    <?php  if($_GPC['kc_id']) { ?><th style="width:6%;">第几课<?php  echo $index;?></th><?php  } ?>
                    <?php  if(Keep_sk77()) { ?>
                    <th style="width:6%;">消耗课时</th>
                    <?php  } ?>
                    <th style="width:6%;">状态</th>
                    <th style="width:8%;"> 教师签到 </th>
                    <th style="width:8%;"> 学生签到 </th>						
					<th class="qx_e_r_d" style="text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
                    <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
					<td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal"><?php  echo $item['tname'];?></td>
					<td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal">
						<div> <?php  echo $item['kcname'];?></br> <span class="label label-info"><?php  echo date('Y年m月d日 H:i',$item['date'])?></span> </div> 
					</td>
					<td><?php  if($item['re_type'] ==1) { ?>每周固定<?php  } ?><?php  if($item['re_type'] ==2) { ?>隔周固定<?php  } ?><?php  if($item['re_type'] ==3) { ?>日历排课<?php  } ?><?php  if($item['re_type'] ==0) { ?>手动导入<?php  } ?></td>
                    <td><?php  echo $item['week'];?></td>
                    <td> <?php  if(!empty($category[$item['sd_id']])) { ?><?php  echo $category[$item['sd_id']]['sname'];?><?php  } ?></td>
                    <td> <?php  if(!empty($category[$item['addr_id']])) { ?><?php  echo $category[$item['addr_id']]['sname'];?><?php  } ?></td>
					 <?php  if($_GPC['kc_id']) { ?><td>第<span class="label label-warning"><?php  echo $item['index'];?></span>课</td><?php  } ?>
                    <?php  if(keep_sk77()) { ?>
                    <td><span class="label label-success"><?php  echo $item['costnum'];?></span></td>
                    <?php  } ?>
                    <td style="overflow:visible; word-break:break-all; text-overflow:visible;white-space:normal">
                    <?php  if($item['date']>TIMESTAMP) { ?><span class="label label-default">未上课</span><?php  } ?>
                    <?php  if($item['date']<TIMESTAMP) { ?><span class="label label-warning">已上课</span><?php  } ?>
					<?php  if(!empty($item['isxiangqing'])) { ?></br><span class="label label-success"><i class="fa fa-check-circle">有详细内容</i></span><?php  } ?>
                    </td>
                 	<td> 
						<?php  if(!empty($item['teaSign'])) { ?>
                     	<span class="label label-info"><?php  echo $item['teaSign'];?></span>
                     	<?php  } else { ?>
                     	<span class="label label-default">未签到</span>
                     	<?php  } ?>
                 	</td>
                    <td>
						<span class="label label-success">已签：<?php  echo $item['signstu'];?>人</span>
						</br>
						<span class="label label-primary">请假：<?php  echo $item['leavetu'];?>人</span>
						
	                    <a class="btn btn-default btn-sm qx_941" href="<?php  echo $this->createWebUrl('kcallstusign', array('ksid' => $item['id'],'kcid' => $item['kcid'], 'schoolid' => $schoolid,'fromKc'=>'fromKc'))?>" title="查看详情"><i class="fa fa-tasks">&nbsp;&nbsp;查看详情</i></a>
	                    </br>
						<span class="label label-danger">未签：<?php  echo $item['unsign'];?>人</span></td>

					<td class="qx_e_r_d" style="text-align:right;">
                        <a class="btn btn-default btn-sm qx_922"
                           href="<?php  echo $this->createWebUrl('kcbiao', array('id' => $item['id'], 'op' => 'post', 'schoolid' => $schoolid))?>"
                           title="编辑"><i class="fa fa-pencil"></i>
                        </a>
                        <?php  if($item['is_remind'] ==0) { ?>
                        <a id="tx_<?php  echo $item['id'];?>" class="btn btn-default btn-sm qx_924"
                          onclick="txsk(<?php  echo $item['id'];?>)"
                           title="提醒授课"><i class="fa fa-bell"></i>
                        </a>
                        <?php  } ?>
                        <a class="btn btn-default btn-sm qx_925" href="<?php  echo $this->createWebUrl('kcbiao', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>"
                           onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除">
                            <i class="fa fa-times"></i>
                        </a>
					</td>
				</tr>

				<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="3">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="button" class="btn btn-primary qx_925" name="btndeleteall" value="批量删除" />
				</td>
				<td colspan="3">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="button" class="btn btn-primary qx_924" name="remindall" value="批量提醒" />
				</td>
			</tr>
		</table>
        <?php  echo $pager;?>
        </div>
    </div>
</div>

<script type="text/javascript">
<!--
	var category = <?php  echo json_encode($children)?>;
//-->
//----------全局菊花转----------
$("body").append('<div id="common_progress" class="common_progress_bg" style=""><div class="common_progress"><div class="common_loading"></div><br><span>正在载入...</span></div></div>');

function ajax_start_loading(text) {
    $("#common_progress").css("display", "block");
    $("body").css("position", "fixed");
    $(".common_progress").css("margin-left", $(window).width() / 2 - 80);
    if (text) {
        $("#common_progress span").text(text);
    }
}
// 关闭菊花转
function ajax_stop_loading() {
    $("#common_progress").hide();
    $("body").css("position", "static");
}
function txsk(id){
	ajax_start_loading("正在执行中...");

	$.ajax({
				url: "<?php  echo $this->createWebUrl('kcbiao', array('op' => 'remind'), true)?>",
				type: "post",
				dataType: "json",
				data: {
					id: id,
					schoolid: <?php  echo $schoolid;?>,
					weid:<?php  echo $weid;?>
				},
				success: function (data) {
				ajax_stop_loading() 
					 if(data.result){
					    alert(data.msg);
                       var a_id = "tx_"+id;
						$("#"+a_id).hide();
                    }else{
                        alert(data.msg);
                    }
					
				}
			});
	
}

$(function(){
	var e_r_d = 3 ;
	<?php  if(!(IsHasQx($tid_global,1000922,1,$schoolid))) { ?>
		$(".qx_922").hide();
		e_r_d = e_r_d -1  ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000923,1,$schoolid))) { ?>
		$(".qx_923").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000924,1,$schoolid))) { ?>
		$(".qx_924").hide();
		e_r_d = e_r_d -1  ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000925,1,$schoolid))) { ?>
		$(".qx_925").hide();
		e_r_d = e_r_d -1  ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000941,1,$schoolid))) { ?>
		$(".qx_941").hide();
	<?php  } ?>
	if(e_r_d == 0){
		$(".qx_e_r_d").hide();
	}
	
    $(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        $("input[type=checkbox]").attr("checked",checked);
    });

    $("input[name=btndeleteall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要删除的课程!');
            return false;
        }
        if(confirm("确认要删除选择的课程?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('kcbiao', array('op' => 'deleteall', 'schoolid' => $schoolid))?>";
            $.post(url,{idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');
        }
    });

     $("input[name=remindall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要提醒的课程!');
            return false;
        }
        if(confirm("确认要提醒选择的课程?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('kcbiao', array('op' => 'remindall', 'schoolid' => $schoolid))?>";
            $.post(url,{idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');
        }
    });

});
</script>
<?php  } ?>
<?php  if($mode == 'table') { ?>
<style>
.sub-module-info{width:100%}
.form-control-excel { height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075); -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s; -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; }
/**按钮点击特效**/
.mb_marsk:hover{ -webkit-mask:-webkit-gradient(linear, left top, right bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)))}
.qr_code_table{ width: 100%; min-height: 120px; float: left; }
.qr-code-table-name{}
.apps_item{ margin: 15px; width: 30%; height: 100px; float: left; border-radius: 6px; border: 1px solid #eceaea; }
.apps_box{ width: 100%; height: 100px; margin: 8px; }
.apps_item_image{ width: 22%; float: left; }
.apps_item_image img{border: 1px solid #eceaea;border-radius: 50%;}
.apps_item_info{ width: 70%; float: left; margin-left: 7px; }
.apps_item_name{ font-weight: bold; width: 100%; }
.yaz{position: absolute;width: 17px;height: 17px;margin-left: 5px;background: url(<?php echo MODULE_URL;?>public/mobile/img/ico_no_1.png) no-repeat; background-position: center center; background-size: 17px 17px;}
.app_info{font-size: 11px;color: #9c9393;max-height: 33px;overflow: hidden;}
.apps_infos{ float: right; font-weight: 100; font-size: 10px; color: #2515f7; }
.btnlist{width: 100%;}
.install_btn{ max-width: 64%; padding: 4px; text-align: center; height: 26px; margin: 8px; font-size: 12px; line-height: 17px; border-radius: 5px; background: #de3d52; color: #fff; float: right; margin-top: 5px; }
.use_btn{cursor:pointer;max-width: 64%; padding: 4px; text-align: center; height: 26px; margin: 8px; font-size: 12px; line-height: 17px; border-radius: 5px; background: #3dcede; color: #fff; float: right; margin-top: 5px; }
.school_box{ width:75px; height:100px; margin:20px; float: left;position: relative;}
.school_icon{ width:100%; }
.school_icon img{ width: 100%; border-radius:50% }
.school_title{width:100%;text-align:center}
.icon_marsk{ position: absolute;margin-top: -125px; width: 14%; height: 75px; z-index: 5; background-color: rgba(0,0,0,.5); text-align: center; display: none; }
.gou{ font-family: we7icon!important; display: inline-block; speak: none; font-style: normal; font-weight: 400; font-variant: normal; text-transform: none; color: #fff; font-size: 23px; position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%,-50%); -moz-transform: translate(-50%,-50%); transform: translate(-50%,-50%); line-height: 1; -webkit-font-smoothing: antialiased; }
.modal-backdrop { z-index: 1040 !important; }
.modal-backdrop ~.modal-backdrop{ z-index: 1055 !important; }
.radio-inline, .checkbox-inline{margin-bottom: -9px;}
.radio-inline+.radio-inline, .checkbox-inline+.checkbox-inline{margin-top: 9px;padding-left:1px}
#tooltip{ position: absolute; background-color: #eee; border: 1px solid #999; width: 350px; height: auto; -webkit-border-radius: 8px; font-family: "微软雅黑"; padding: 20px; z-index:2050 }
.radio-custom input[type=radio] { position: absolute; margin-left: 0px; margin-top: 0; margin-bottom: 0; }
.radio-custom input[type=radio] { width: 20px; height: 20px; opacity: 0; z-index: 1; }
.radio-custom label { min-height: 22px; line-height:22px; margin-bottom: 0; font-weight: 300; cursor: pointer; }
.radio-custom label { display: inline-block; vertical-align: middle; position: relative; padding-left: 30px; }
.radio-custom label::before { content: ""; display: inline-block; position: absolute; width: 20px; height: 20px; left: 0; margin-left: 0px; border: 1px solid #e4eaec; border-radius: 50%; background-color: #fff; -webkit-transition: border .3s ease-in-out 0s,color .3s ease-in-out 0s; -o-transition: border .3s ease-in-out 0s,color .3s ease-in-out 0s; transition: border .3s ease-in-out 0s,color .3s ease-in-out 0s; }
.radio-custom input[type=radio]:checked+label::before { border-color: #e4eaec; border-width: 10px; }
.radio-primary input[type=radio]:checked+label::before { border-color: #fc9c6b; }
.radio-custom label::after { display: inline-block; position: absolute; content: " "; width: 6px; height: 6px; left: 7px; top: 7px; margin-left: 0px; border: 2px solid #76838f; border-radius: 50%; background-color: transparent; -webkit-transform: scale(0,0); -ms-transform: scale(0,0); -o-transform: scale(0,0); transform: scale(0,0); transition-transform: .1s cubic-bezier(.8,-.33,.2,1.33); }
.radio-custom input[type=radio]:checked+label::after { -webkit-transform: scale(1,1); -ms-transform: scale(1,1); -o-transform: scale(1,1); transform: scale(1,1); }
.radio-primary input[type=radio]:checked+label::after { border-color: #fff; }
.weui_switchs:checked {border-color: #30c6e1;background-color: #30c6e1;}
.weui_switchs:checked:before {-webkit-transform: scale(0);transform: scale(0);}
.weui_switchs:checked:after {-webkit-transform: translateX(20px);transform: translateX(20px);}
.weui_switchs {font-size: 14px;-webkit-appearance: none;-moz-appearance: none;appearance: none;position: relative;width: 48px;height: 28px;border: 1px solid #DFDFDF;outline: 0;border-radius: 16px;box-sizing: border-box;background: #DFDFDF;vertical-align: middle;float: right;right: 12px;}
.weui_switchs:before {content: " ";position: absolute;top: 0;left: 0;width: 46px;height: 26px;border-radius: 15px;background-color: #FDFDFD;-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.weui_switchs:after {content: " ";position: absolute;top: 0;left: 0;width: 26px;height: 26px;border-radius: 15px;background-color: #FFFFFF;box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.weui_switch:checked {border-color: #30c6e1;background-color: #30c6e1;}
.weui_switch:checked:before {-webkit-transform: scale(0);transform: scale(0);}
.weui_switch:checked:after {-webkit-transform: translateX(20px);transform: translateX(20px);}
.weui_switch {font-size: 14px;-webkit-appearance: none;-moz-appearance: none;appearance: none;position: relative;width: 48px;height: 28px;border: 1px solid #DFDFDF;outline: 0;border-radius: 16px;box-sizing: border-box;background: #DFDFDF;vertical-align: middle;float: right;right: 12px;}
.weui_switch:before {content: " ";position: absolute;top: 0;left: 0;width: 46px;height: 26px;border-radius: 15px;background-color: #FDFDFD;-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.weui_switch:after {content: " ";position: absolute;top: 0;left: 0;width: 26px;height: 26px;border-radius: 15px;background-color: #FFFFFF;box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);-webkit-transition: -webkit-transform .3s;transition: transform .3s;}
.style_mb{ width: 15%; height: 104px; float: left; margin: 5px; margin-top: 25px;text-align: center; }
.style_mb img{ width: 100%; }
.style_mb .mb_name{ font-size: 10px; color: #615e5e; }
.tips_bubbling { position: absolute; width: 32px;z-index: 1;height: 20px; text-align: center;  background: linear-gradient(to top right, #8622e0, red); top: -9px; right: -8px; border-bottom-right-radius: 10px; border-top-left-radius: 10px; color: #fff; -moz-box-shadow: 2px 2px 5px #333333; -webkit-box-shadow: 2px 2px 5px #333333; box-shadow: 2px 2px 9px #e89898; }
.tuan_tips { position: relative; z-index: 1; font-size: 15px; padding: 3px; text-align: center; background: linear-gradient(to top right, #dc1c36, red); right: -8px; border-radius: 7px; color: #fff; -moz-box-shadow: 2px 2px 5px #333333; -webkit-box-shadow: 2px 2px 5px #333333; box-shadow: 2px 2px 9px #e89898; } 
.zl_tips { position: relative; z-index: 1; font-size: 15px; padding: 3px; text-align: center; background: linear-gradient(to top right, #3ea4e0, #42a4d6); right: -8px; border-radius: 7px; color: #fff; -moz-box-shadow: 2px 2px 5px #333333; -webkit-box-shadow: 2px 2px 5px #333333; box-shadow: 2px 2px 9px #a8d1e6; } 
/**进度条仿ANT start**/
.ant-progress { box-sizing:border-box; margin:0; padding:0; color:rgba(0,0,0,.65); font-size:14px; font-variant:tabular-nums; line-height:1.5; list-style:none; font-feature-settings:"tnum"; display:inline-block } .ant-progress-line { position:relative; width:100%; font-size:14px } .ant-progress-small.ant-progress-line,.ant-progress-small.ant-progress-line .ant-progress-text .anticon { font-size:12px } .ant-progress-outer { display:inline-block; width:100%; margin-right:0; padding-right:0 } .ant-progress-show-info .ant-progress-outer { margin-right:calc(-2em - 8px); padding-right:calc(2em + 8px) } .ant-progress-inner { position:relative; display:inline-block; width:100%; vertical-align:middle; background-color:#d2d0d0; border-radius:100px } .ant-progress-circle-trail { stroke:#f5f5f5 } .ant-progress-circle-path { animation:ant-progress-appear .3s; stroke:#1890ff } .ant-progress-bg,.ant-progress-success-bg { position:relative; background-color:#1890ff; transition:all .4s cubic-bezier(.08,.82,.17,1) 0s } .ant-progress-success-bg { position:absolute; top:0; left:0; background-color:#52c41a } .ant-progress-text { display:inline-block; width:2em; margin-left:8px; color:rgba(0,0,0,.45); font-size:1em; line-height:1; white-space:nowrap; text-align:left; vertical-align:middle; word-break:normal } .ant-progress-text .anticon { font-size:14px } .ant-progress-status-active .ant-progress-bg:before { position:absolute; top:0; right:0; bottom:0; left:0; background:#fff; border-radius:10px; opacity:0; animation:ant-progress-active 2.4s cubic-bezier(.23,1,.32,1) infinite; content:"" } .ant-progress-status-exception .ant-progress-bg { background-color:#f5222d } .ant-progress-status-exception .ant-progress-text { color:#f5222d } .ant-progress-status-exception .ant-progress-circle-path { stroke:#f5222d } .ant-progress-status-success .ant-progress-bg { background-color:#52c41a } .ant-progress-status-success .ant-progress-text { color:#52c41a } .ant-progress-status-success .ant-progress-circle-path { stroke:#52c41a } .ant-progress-circle .ant-progress-inner { position:relative; line-height:1; background-color:transparent } .ant-progress-circle .ant-progress-text { position:absolute; top:50%; left:50%; width:100%; margin:0; padding:0; color:rgba(0,0,0,.65); line-height:1; white-space:normal; text-align:center; transform:translate(-50%,-50%) } .ant-progress-circle .ant-progress-text .anticon { font-size:1.16666667em } .ant-progress-circle.ant-progress-status-exception .ant-progress-text { color:#f5222d } .ant-progress-circle.ant-progress-status-success .ant-progress-text { color:#52c41a } @keyframes ant-progress-active { 0% { width:0; opacity:.1 } 20% { width:0; opacity:.5 } to { width:100%; opacity:0 } }
/**进度条仿ANT  end**/

.sign_header{border-radius: 50%;margin-top: -3px;margin-right: 5px;width:20px}
.ks_type_btn:hover{color: orange}
.ks_type_act{color: orange;border: 1px solid orange;}
.xhks_stu{color:orange;font-weight:bold;}
.rekou{font-size: 14px;color: #41cac0;margin-top: -2px;margin-left: 15px;}
/**模拟手机框**/
.preview-phone{ width: 373px; height: 760px; background: #fff; left: 20%; padding: 44px 15px 80px; border-radius: 44px; -webkit-box-shadow: 0 2px 30px 0 rgba(170,187,219,.6); box-shadow: 0 2px 30px 0 rgba(170,187,219,.6); position: relative; } .telephone { position: absolute; left: 50%; -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); transform: translateX(-50%); } .telephone { width: 74px; height: 5px; background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#f5f6f7),to(#e3e4e5)); background: -webkit-linear-gradient(top,#f5f6f7,#e3e4e5); background: -o-linear-gradient(top,#f5f6f7 0,#e3e4e5 100%); background: linear-gradient(180deg,#f5f6f7,#e3e4e5); border-radius: 3px; top: 23px; } .preview-phone .document-title { height: 35px; width: 100%; line-height: 35px; background: -webkit-gradient(linear,left bottom,left top,color-stop(0,#2c2d31),to(#101013)); background: -webkit-linear-gradient(bottom,#2c2d31,#101013); background: -o-linear-gradient(bottom,#2c2d31 0,#101013 100%); background: linear-gradient(1turn,#2c2d31,#101013); text-align: center; color: #fff; font-weight: 700; } .preview-phone .phone-stage { width: 100%; height: 601px; background: #fff; overflow: auto; position: relative; border: 1px solid #e8e8e8; border-top: none; } .home-btn { width: 50px; height: 50px; background: #ecedee; border-radius: 50%; bottom: 21px; } .home-btn, .telephone { position: absolute; left: 50%; -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); transform: translateX(-50%); } .create-iframe { width: 100%; height: 100%; }
/**模拟手机框end**/
comment_lsit { padding-top: 20px; } .comment_item { padding-left: 50px; position: relative; min-height: 40px; margin: 0 0 40px; font-size: 12px; } .comment_item img { width: 40px; height: 40px; position: absolute; left: 0; top: 10px; border-radius: 40px; } .comment_item text { display: block; } .comment_item .n { color: #4C91FF; margin-bottom: 10px; } .comment_item .c { font-size: 13px; color: #374F5E; margin-bottom: 9px; } .comment_item .t { color: #91A0B2; } .comment_item .reply { background: #FAFBFC; padding: 12px; margin-top: 20px;border-radius: 7px;} .comment_tips { color: #AEC1D9; font-size: 11px; text-align: center; margin-bottom: 30px; } .comment_tips i { display: inline-block; margin: 0 20px; } .content{width:90%;margin:0 5%;color:#333333;line-height:30px;padding-bottom:20px;word-break:break-all;word-wrap:break-word;} .content p{margin:0 !important;} .content span{margin-bottom:10px;} .content img{max-width:100%;margin:5px 0;} .content .nodata{margin:0 auto;/* width:70%; */background:#eee;border:1px solid #aaa;padding:10px;border-radius:5px;} .content .nodata span{font-size:14px;color:#999;display:block;width:100%;margin:0;} .content .nodata a{font-size:14px;color:red;}.audio_div{width:100%;margin-top: 10px;display:none;} .play_video_box{width:100%;margin-top: 10px;display:none;} .conent_div{width:100%;margin-top: 10px;height: auto;display:none;} .ppt_box{width:100%;margin-top: 10px;height: auto;display:none;} .goto_wendang{text-align: center; margin-left: 33%;} .pointicon{ width: 15px; height: 15px; display: inline-block; background: url(<?php echo MODULE_URL;?>public/mobile/img/down_point.png) no-repeat center center / 15px 15px; margin: 8px -10px 0px 15px; float:right; } .up{ width: 15px; height: 15px; display: inline-block; background: url(<?php echo MODULE_URL;?>public/mobile/img/up_point.png) no-repeat center center / 15px 15px; margin: 8px -10px 0px 15px; float:right; } .conent_load{text-align:center;width: 20px; height: 24px; display: inline-block; background: url(<?php echo MODULE_URL;?>public/mobile/img/gh_xh_wating.gif) no-repeat center center / 15px 19px; margin-left: 50%; margin-top: 15px;}.coments{width:100%;height: auto;} 
</style>
<div class="main">
<link href="<?php echo OSSURL;?>public/web/css/rili.css" rel="stylesheet">
	<div class="panel panel-default">
		<!--课程搜索框-->
		<div class="panel-body" id="kcbiao_search_box">
			<div class="col-sm-12 col-lg-12">
				<div class="form-group">
					<!--线下课程搜索框-->
					<div id="ks_search_offline">
						<label class="col-sm-1 control-label">按老师</label>
						<div class="col-sm-2">
							<select id="tid" class="form-control">
								<option value="0">选择老师</option>
								<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
								<option value="<?php  echo $row['id'];?>"><?php  echo $row['tname'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<label class="col-sm-1 control-label">按教室</label>
						<div class="col-sm-2">
							<select id="addr" class="form-control">
								<option value="0">选择教室</option>
								<?php  if(is_array($alladdr)) { foreach($alladdr as $row) { ?>
								<option value="<?php  echo $row['sid'];?>"><?php  echo $row['sname'];?><?php  if($kcinfo['adrr'] == $row['sid']) { ?>-主教室<?php  } ?></option>
								<?php  } } ?>
							</select>
						</div>
						<div class="col-sm-2 col-lg-2">
							<div class="btn btn-default" onclick="search_kslist('search')"><i class="fa fa-search"></i> 搜索</div>
						</div>
						<div>
							<button type="button" class="btn btn-success btn-sm" onclick="ShowDmData('prev');"><上周</button>
							<button type="button" class="btn btn-info btn-sm" onclick="ShowDmData('now');">本周</button>
							<button type="button" class="btn btn-success btn-sm" onclick="ShowDmData('next');">下周></button></button>
							<a class="btn btn-info btn-sm" style="float:right" href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display','mode' => 'list', 'schoolid' => $schoolid))?>">列表模式</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--课程课表框-->
		<div class="table-responsive panel-body" id="kc_list" style=""></div>
	</div>
</div>
<!--调课modal10-->
<div class="modal fade" style="min-width: 600px!important;z-index: 1050 !important;" id="Modal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static">
	<div class="modal-dialog" style="left: 32%;top: 20%;">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-title-kc" style="text-align:center;color:#333;font-size: 17px;">修改课时</h4>
			</div>
			<!--线上课程排课头部-->
			<div class="col-sm-9" style="margin-top:5px;">
				<div class="btn-group">
					<a class="btn btn-primarys ks_opt" optid="ksinfo">课时信息</a>
				</div>
				<div class="alert" style="padding:1px;float: right;margin-bottom: 1px">已签到<span class="bold" id="yjqdrs" style="font-size:20px;font-weight:blod;color:red"></span>人</div>
			</div>
			<div class="modal-body form_paike_boxs" style="width: 100%;padding: 34px;">
				<form id="ksinfo">
					<div class="form-group">
						<label class="col-sm-2 control-label"><span class="require">*</span>上课日期</label>
						<div class="input-group clocknews">
							<input type="text" style="display:none" class="form-control" id="disa_date" disabled name="date1" value="" />
							<div class="input-group" style="margin-left: 12px;" id="tk_date_box">
								<?php  echo tpl_form_field_date('date', date('Y-m-d',TIMESTAMP))?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">上课时段</label>
						<div class="col-sm-4">
							<select name="sd_id" id="edit_sd_box" class="form-control all_sd">
									<option value="0">选择时段</option>
								<?php  if(is_array($sd)) { foreach($sd as $it) { ?>
									<option value="<?php  echo $it['sid'];?>"><?php  echo $it['sname'];?></option>
								<?php  } } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">授课教室</label>
						<div class="col-sm-4">
							<select style="margin-right:15px;" name="addr_id" id="edit_adrr_box" class="form-control">
								<option value="">请选择教室</option>
								<?php  if(is_array($alladdr)) { foreach($alladdr as $row) { ?>
								<option value="<?php  echo $row['sid'];?>"><?php  echo $row['sname'];?><?php  if($kcinfo['adrr'] == $row['sid']) { ?>-主教室<?php  } ?></option>
								<?php  } } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">授课老师</label>
						<div class="col-sm-3">
							<select name="tid" id="edit_tid_box" class="form-control">
								<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
									<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
								<?php  } } ?>
							</select>
							<div class="help-block" style="color:red"></div>
						</div>
						<label class="col-sm-2 control-label">消耗课时</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="number" class="form-control" id="tk_costnum" name="costnum" value="" />
								<span class="input-group-addon">节</span>
							</div>
							<div class="help-block">每次签到扣几节</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">上课内容</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="content" placeholder="输入课时内容,500字以内"></textarea>
							<div class="help-block">如需使用富文本,请在排课后编辑需要使用的课时即可</div>
						</div>
					</div>
					<div class="cLine"> 
						<div class="alert">
							<p><span class="bold">提示：</span>一旦老师签到本课时后,不可修改本课授课老师,或学生签到后不可修改日期</p>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" style="border-radius: 6px;">
				<input type="submit" onclick="sub_for_ks()" class="btn btn-success" value="确认提交">
				<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
			</div>
			<input id="tk_now_ksid" type="hidden" value=""/>
		</div>
	</div>
</div>
<!--点名modal11-->
<div class="uploader-modal modal fade keyword ng-scope ng-isolate-scope in" style="z-index:1050 !important;" id="Modal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg ng-scope" style="top:30%;">
		<div class="modal-content">
			<div class="modal-header" style="color: black;text-align:left">					
				<h4 class="modal-title">课时点名</h4>	
			</div>
			<div class="modal-body material-content clearfix">
				<form id="ksdmbox">
					<div class="form-group" style="margin-top:10px">
						<label class="col-sm-1 control-label">上课日期</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="text" class="form-control" disabled name="ksdate" value="" />
							</div>
						</div>
						<label class="col-sm-1 control-label">签课老师</label>
						<div class="col-sm-2">
							<select name="tid" id="ks_tid_box" class="form-control">
								<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
									<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
								<?php  } } ?>
							</select>
							<div class="help-block" style="color:red"></div>
						</div>
						<label class="col-sm-1 control-label">消耗课时</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control" name="ks_costnum" value="" oninput="onInput(this)"/>
								<span class="input-group-addon">课时</span>
							</div>
							<div class="help-block" style="color:red"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">通知老师:</label>
						<div class="col-sm-3">
							<label class="radio-inline">
								<div class="radio-custom radio-primary">
									<input type="radio" name="pev_tea" value="1" checked />
									<label></label>通知
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio-custom radio-primary">
									<input type="radio" name="pev_tea" value="0" >
									<label></label>不通知
								</div>
							</label>
							<div class="help-block">通知选中的老师本节已签</div>
						</div>
						<label class="col-sm-1 control-label">通知学生:</label>
						<div class="col-sm-3">
							<label class="radio-inline">
								<div class="radio-custom radio-primary">
									<input type="radio" name="pev_stu" value="1" checked />
									<label></label>通知
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio-custom radio-primary">
									<input type="radio" name="pev_stu" value="0"/>
									<label></label>不通知
								</div>
							</label>
							<div class="help-block">点名成功的通知学生剩余课时</div>
						</div>
					</div>
					<div class="form-group">
						<p style="margin-left:20px"><span class="bold">提示：</span>请假、缺课、待确认3种状态都不会扣除学生课时</p>
						<div class="table-responsive panel-body" id="ks_stu_boxlist" style="max-height:300px;overflow-y: scroll;">
							<table class="table table-hover">
								<thead class="navbar-inner">
									<tr>
										<th style="width:10%;">学生</th>
										<th style="width:8%;">手机</th>
										<th style="width:10%;">总购课时</th>
										<th style="width:15%;">剩余课时</th>
										<th style="width:15%;">到课状态</th>
										<th style="width:8%;">扣课时</th>
									</tr>
								</thead>
								<tbody id="stu_detil_box">

								</tbody>
							</table>
							<div class="ant-empty ant-empty-normal" style="text-align:center;display:none">
								<div class="ant-empty-image">
									<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
								</div>
								<p class="ant-empty-description">暂无学生报名本课</p>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer" style="border-radius: 6px;">
				<a class="btn btn-primary" style="color: #fff;" onclick="sub_ksdm();">完成点名</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
			</div>
			<input id="dm_now_ksid" type="hidden" value=""/>
		</div>
	</div>
</div>
<input type="hidden" id="dtweek" value="<?php  echo $nowweek;?>">
<script>
var loadcont = "<div class='conent_load'></div>";
search_kslist()
function search_kslist(type,nowweek){
	$('#kc_list').append(loadcont);//加载动画
	if(type == 'search'){
		var tid = $('#tid').val()
		var addr = $('#addr').val()
		var week = nowweek
	}else{
		var tid = 0
		var addr = 0
		var week = 0
	}
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'ks_list','schoolid' => $schoolid))?>",
		type: "post",
		dataType: "html",
		data: {
			kcid:"<?php  echo $kcid;?>",
			dtweek:week,
			sk_tid:tid,
			js_id:addr
		},
		success: function (data) {
			if (data) {
				$('#kc_list').empty()
				$('#kc_list').html(data)
			}
		}		
	});
}
function onInput(elm){
	var costnum = $(elm).val()
	if(costnum <= 0){
		alert('消课数量不可低于1')
		$(elm).val(1)
		return false
	}else{
		$('.stu_ks').text(costnum)
		$('.stu_ks_hide').val(costnum)
	}
}
function tiaoke(ksid){//调课弹框
	$('#tk_now_ksid').val(ksid)
	$('#Modal10').modal('toggle')
	$('#edit_tid_box').removeAttr("disabled")
	$('#edit_tid_box').next().text('')
	$('#disa_date').hide()
	$('#tk_date_box').show()
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'get_oneks','schoolid' => $schoolid))?>",
		type: "post",
		dataType: "json",
		data: {
			ksid:ksid
		},
		success: function (data) {
			if (data.result) {
				var ksinfo = data.ksinfo
				var EditeKsBox = $('#ksinfo')
				EditeKsBox.children().find("input[name='date']").val(ksinfo.riqi)
				EditeKsBox.children().find("input[name='costnum']").val(ksinfo.costnum)
				EditeKsBox.children().find("input[name='content']").text(ksinfo.content)
				$('#yjqdrs').text(data.signstu)
				set_select_checked('edit_sd_box', ksinfo.sd_id)
				set_select_checked('edit_adrr_box', ksinfo.addr_id)
				set_select_checked('edit_tid_box', ksinfo.tid)
				var teasign = data.teasign
				if(teasign){
					var checktea = data.checktea
					set_select_checked('edit_tid_box', checktea.tid)
					$('#edit_tid_box').attr("disabled","disabled");
					$('#edit_tid_box').css("background-color","#eee;")
					$('#edit_tid_box').next().text('老师已签,不可更改')
				}
				if(data.signstu >0){
					$('#disa_date').show()
					$('#disa_date').val(ksinfo.riqi)
					$('#tk_date_box').hide()
				}
			}else{
				alert(data.msg)
				location.reload()
			}
		}		
	});
}
function sub_for_ks(){//提交调课信息
	var ksid = $('#tk_now_ksid').val()
	var form = new FormData(document.getElementById('ksinfo'))
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kcbiao', array('op' => 'kb_tiaoke','schoolid' => $schoolid))?>"+"&ksid="+ksid,
		type: "post",
		data: form,
		processData: false,
		contentType: false,
		success: function(result) {
			var data = jQuery.parseJSON(result);
			alert(data.msg);
			if(data.result){
				$('#Modal10').modal('toggle');
				search_kslist()
			}
		},
		error: function(e) {
			alert('访问网络失败');
			console.log(e)
		}
	});
}
function sub_ksdm(){//提交点名信息
	var ksid = $('#dm_now_ksid').val()
	var form = new FormData(document.getElementById('ksdmbox'))
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kcbiao', array('op' => 'kb_dianm','schoolid' => $schoolid))?>"+"&ksid="+ksid,
		type: "post",
		data: form,
		processData: false,
		contentType: false,
		success: function(result) {
			var data = jQuery.parseJSON(result);
			alert(data.msg);
			if(data.result){
				$('#Modal11').modal('toggle');
			}
		},
		error: function(e) {
			alert('访问网络失败');
			console.log(e)
		}
	});
}
function dianming(ksid){//点名弹框
	$('#dm_now_ksid').val(ksid)
	$('#stu_detil_box').empty()
	$('#ks_tid_box').next().text('')
	$('#ks_tid_box').removeAttr("disabled");
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'get_oneks_stulist','schoolid' => $schoolid))?>",
		type: "post",
		dataType: "json",
		data: {
			ksid:ksid
		},
		success: function (data) {
			if (data.result) {
				var ksinf = data.ksinfo
				$("input[name='ksdate']").val(ksinf.riqi)
				$("input[name='ks_costnum']").val(ksinf.costnum)
				set_select_checked('ks_tid_box', ksinf.tid)
				//$('#yjqdrs').text(ksinfo.signstu)
				var queke = data.queke //缺课人数
				var teasign = data.teasign //老师是否已签 布尔型
				var signstu = data.signstu //学生签到人数
				var allsigntea = data.allsigntea //老师已签列表
				var allsignstu = data.allsignstu //学生情况列表
				var html = '';
				if(allsignstu.length > 0){
					for (var i = 0; i < allsignstu.length; i++) {
						var dkbtn = 'primary';
						var dqbtn = 'default';
						var qjbtn = 'default';
						var qkbtn = 'default';
						var dkinput = 2;
						var icons = 'times';
						var kkcolor = '';
						var ksword = '未扣';
						var defksmub = ksinf.costnum
						var ks_hassign = allsignstu[i].ks_hassign //处理有操作的学生
						if(ks_hassign == 1){
							var checkstusign = allsignstu[i].checkstusign //签到学生的本节签到数据
							if(checkstusign.status == 1){ //待确认
								var dkbtn = 'default';
								var dqbtn = 'primary';
								var qjbtn = 'default';
								var qkbtn = 'default';
								var dkinput = 1;
							}
							if(checkstusign.status == 2){//到课
								var dkbtn = 'primary';
								var dqbtn = 'default';
								var qjbtn = 'default';
								var qkbtn = 'default';
								var dkinput = 2;
								var icons = 'check';
								var ksword = '已扣';
								var kkcolor = 'red';
								var defksmub = checkstusign.costnum //签到的显示真实已扣数量
							}
							if(checkstusign.status == 3){//请假
								var dkbtn = 'default';
								var dqbtn = 'default';
								var qjbtn = 'primary';
								var qkbtn = 'default';
								var dkinput = 3;
							}
							if(checkstusign.status == 0){//缺课
								var dkbtn = 'default';
								var dqbtn = 'default';
								var qjbtn = 'default';
								var qkbtn = 'primary';
								var dkinput = 0;
							}
						}
						html +=	'<tr id="stu_'+allsignstu[i].sid+'">'+ //处理无任何操作的报名学生
								'	<input type="hidden" name="sid[]" value="'+allsignstu[i].sid+'" />'+
								'	<input type="hidden" name="s_name[]" value="'+allsignstu[i].s_name+'" />'+
								'	<td><img class="sign_header" src="'+allsignstu[i].icon+'">'+allsignstu[i].s_name+'</td>'+
								'	<td>'+allsignstu[i].mobile+'</td>'+
								'	<td>'+allsignstu[i].buycourse+'课时</td>'+
								'	<td>'+allsignstu[i].restnum+'课时</td>'+
								'	<td>'+
								'		<button type="button" data-toggle="tooltip" data-placement="top" title="标记为到课" onclick="ks_type_btn(this,2)" class="btn btn-'+dkbtn+' btn-xs ks_type_btn">到课</button>'+
								'		<button type="button" data-toggle="tooltip" data-placement="top" title="标记为缺课" onclick="ks_type_btn(this,1)" class="btn btn-'+dqbtn+' btn-xs ks_type_btn">待确认</button>'+
								'		<button type="button" data-toggle="tooltip" data-placement="top" title="标记为请假" onclick="ks_type_btn(this,3)" class="btn btn-'+qjbtn+' btn-xs ks_type_btn">请假</button>'+
								'		<button type="button" data-toggle="tooltip" data-placement="top" title="标记为缺课" onclick="ks_type_btn(this,0)" class="btn btn-'+qkbtn+' btn-xs ks_type_btn">缺课</button>'+
								'	</td>'+	
								'	<input type="hidden" name="status[]" value="'+dkinput+'" />'+
								'	<td class="xhks_stu stu_ks">'+defksmub+'<span class="fa fa-'+icons+' rekou" style="font-size:13px;color:'+kkcolor+'">'+ksword+'</span></td>'+
								'	<input class="stu_ks_hide" type="hidden" name="costnum[]" value="'+defksmub+'" />'+
								'</tr>';
								
					}
					$('#stu_detil_box').html(html)
					$('.ant-empty').hide()
				}else{
					$('.ant-empty').show()
				}
				if(teasign){
					var checktea = data.checktea //签到的老师
					set_select_checked('ks_tid_box', checktea.tid)
					$('#ks_tid_box').attr("disabled","disabled")
					$('#ks_tid_box').css("background-color","#eee;")
					$('#ks_tid_box').next().text('老师已签,不可更改')
				}
			}else{
				alert(data.msg)
				location.reload()
			}
		}		
	});
	$('#Modal11').modal('toggle');
}
function ks_type_btn(elm,status){
	$(elm).parent().children('.btn-primary').removeClass("btn-primary");
	$(elm).addClass("btn-primary");
	$(elm).parent().next().val(status)
}
$('.btn-group .ks_opt').click(function(){
	var opt = $(this).attr("optid")
	$(this).parent().children('.ks_opt').removeClass("btn-primarys");
	$(this).parent().children('.ks_opt').removeClass("btn-defaults");
	$(this).addClass("btn-primarys")
	if(opt == 'ksinfo'){
		$("#ksinfo").slideDown(200)
		$("#xyinfo").slideUp(200)
	}
	if(opt == 'xyinfo'){
		$("#ksinfo").slideUp(200)
		$("#xyinfo").slideDown(200)
	}
});
$('.up_saleboxs').click(function(){
	if($(this).hasClass("fa-minus-circle")){
		$(this).removeClass("fa-minus-circle")
		$(this).addClass("fa-plus-circle")
		$(this).parent().next().slideUp(200)
	}else{
		$(this).addClass("fa-minus-circle")
		$(this).removeClass("fa-plus-circle")
		$(this).parent().next().slideDown(200)
	}
});
function ShowDmData(type){
	var dtweek = $('#dtweek').val()
	if(type == 'prev'){
		var nowweek =  Number(dtweek) -1;
		$('#dtweek').val(nowweek)
	}else if(type == 'next'){
		var nowweek = Number(dtweek) +1;
		$('#dtweek').val(nowweek)
	}else{
		var nowweek = Number('<?php  echo $nowweek;?>');
		$('#dtweek').val(nowweek)
	}
	search_kslist('search',nowweek)
}
function set_select_checked(selectId, checkValue){  
    var select = document.getElementById(selectId);  

    for (var i = 0; i < select.options.length; i++){  
        if (select.options[i].value == checkValue){  
            select.options[i].selected = true;  
            break;  
        }  
    }  
}
clockpicker()
function clockpicker(){
	require(["clockpicker"], function($){
		$(function(){
			$(".clockpicker").clockpicker({
				autoclose: true
			});
		});
	});
}
</script>
<?php  } ?>
<?php  } else if($operation == 'post') { ?>
<link rel="stylesheet" type="text/css" href="../addons/weixuexiao/public/web/css/clockpicker.css" media="all">
<script type="text/javascript" src="../addons/weixuexiao/public/web/js/clockpicker.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/weixuexiao/public/web/css/standalone.css" media="all">
<link rel="stylesheet" type="text/css" href="../addons/weixuexiao/public/web/css/uploadify_t.css?v=4" media="all" />
<div class="panel panel-info">
   <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回</a></div>
</div>
<div class="main">
<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="tid" value="<?php  echo $item['tid'];?>" />
		<input type="hidden" name="kcid" value="<?php  echo $item['kcid'];?>" />
		<input type="hidden" name="bj_id" value="<?php  echo $item['bj_id'];?>" />
		<input type="hidden" name="km_id" value="<?php  echo $item['km_id'];?>" />
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                修改课程
            </div>
            <div class="panel-body">
			    <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">课程名称：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control justshow"  value=" <?php  echo $kc['name'];?>" disabled />
						<div class="help-block"><?php  if($item['re_type'] ==1) { ?>每周固定<?php  } ?><?php  if($item['re_type'] ==2) { ?>隔周固定<?php  } ?><?php  if($item['re_type'] ==3) { ?>日历排课<?php  } ?><?php  if($item['re_type'] ==0) { ?>手动导入<?php  } ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">教师姓名:</label>
                  <div class="col-sm-2 col-lg-2">
	                     <select style="margin-right:15px;" name="sktid" class="form-control">
                            <option value="0">请选择授课教师</option>
                            <?php  if(is_array($allteacher)) { foreach($allteacher as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($item['tid'] == $row['id']) { ?>selected="selected"<?php  } ?> ><?php  echo $row['tname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>

                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">授课地址：</label>
                     <div class="col-sm-2 col-lg-2">
	                     <select style="margin-right:15px;" name="addr_id" class="form-control">
                            <option value="0">请选择授课教室</option>
                            <?php  if(is_array($addr)) { foreach($addr as $rowa) { ?>
                            <option value="<?php  echo $rowa['sid'];?>" <?php  if($item['addr_id'] == $rowa['sid']) { ?> selected="selected"<?php  } ?> ><?php  echo $rowa['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>				
                </div>
                <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">选择时段:</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="sd" class="form-control">
                            <option value="<?php  echo $item['sd_id'];?>"><?php  if(!empty($category[$item['sd_id']])) { ?><?php  echo $category[$item['sd_id']]['sname'];?><?php  } ?></option>
                            <?php  if(is_array($sd)) { foreach($sd as $it) { ?>
                            <option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['sd_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
				</div>	
				<div class="form-group">
                   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">本节日期:</label>
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
				     <?php  echo tpl_form_field_date('date',date('Y-m-d H:i',$item['date']))?>	
                        </div>
				     </div>
                    <?php  if(keep_sk77()) { ?>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">消耗课时:</label>
                    <div class="col-sm-2 col-lg-2">
                        <input type="number" class="form-control" name="costnum" value="<?php  echo $item['costnum'];?>" />
                        <div class="help-block">扣除课时数，0或留空则取默认值1</div>
                    </div>
                    <?php  } ?>
                </div>
				<?php  if($item['rulsetid'] && ($item['re_type'] == 1 || $item['re_type'] == 2 || $item['re_type'] == 3) ) { ?>
				<div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">批量修改:</label>
					<div class="col-sm-6 col-lg-6">
						<label class="radio-inline">
							<input type="radio" name="piliang" value="1" >是
						</label>
						<label class="radio-inline">
							<input type="radio" name="piliang" value="0" checked>否
						</label>
						<div class="help-block">是否批量修改同期同时排课的其他课时，注意除日期外他设置跟随本次修改变动</div>
					</div>
                </div>
				<?php  } ?>
				<div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">显示详情</label>
                    <div class="col-sm-6 col-lg-6">
						<label class="radio-inline">
                            <input type="radio" name="isxiangqing" value="1" <?php  if($item['isxiangqing']==1 || empty($item)) { ?>checked<?php  } ?> id="credit1">是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="isxiangqing" value="0" <?php  if(isset($item['isxiangqing']) && empty($item['isxiangqing'])) { ?>checked<?php  } ?> id="credit0">否
                        </label>
                        <div class="help-block">切换是否在前端显示详情</div>
					</div>	
                </div>				
				<div id="credit-status1" <?php  if($item['isxiangqing'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">本节详情</label>
                    <div class="col-sm-8 col-xs-12">
                       <?php  echo tpl_ueditor('content', $item['content']);?>
                    </div>
                </div>	
				</div>					
             </div>											   
		</div>	
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script type="text/javascript">
	var category = <?php  echo json_encode($children)?>;
	$('#credit1').click(function(){
		$('#credit-status1').show();
	});
	$('#credit0').click(function(){
		$('#credit-status1').hide();
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>