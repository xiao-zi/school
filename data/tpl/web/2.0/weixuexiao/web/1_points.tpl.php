<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />

 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
 
<?php  if($operation == 'display') { ?>
 <ul class="nav nav-tabs">
    <li class="qx_2801 <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('points', array('op' => 'post', 'schoolid' => $schoolid))?>">积分详情</a></li>
    <li class="qx_2811 <?php  if($operation == 'display') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('points', array('op' => 'display', 'schoolid' => $schoolid))?>">积分规则</a></li>
</ul>
<style>
/*公共菊花转*/
.popover{left: 950px !important;z-index:100000 !important;}
.common_progress_bg{display: none;position: fixed;top: 0;left: 0;height: 100%;width: 100%;background: rgba(0, 0, 0, 0.6);z-index: 9998;}
.common_progress{position: fixed;top: 40%;background: #000;height: 80px;width: 160px;border-radius: 12px;line-height: 20px;text-align: center;padding-top: 30px;z-index: 9999;}
.common_progress > img{width: 27px;height: 27px;padding-top: 30px;}
.common_progress > .common_loading{width: 30px;height: 30px;display: inline-block;vertical-align: middle;background: url(<?php echo OSSURL;?>public/mobile/img/load.png) no-repeat;background-size: 30px;-webkit-animation: loading1 2s linear infinite;}
@-webkit-keyframes loading1{0%{-webkit-transform: rotate(0deg);}33%{-webkit-transform: rotate(120deg);}66%{-webkit-transform: rotate(240deg);}
100%{-webkit-transform: rotate(360deg);}}
.common_progress > span{margin: 0 0 0 8px;color: #fff;}
</style>
<script src="<?php echo OSSURL;?>public/mobile/js/common.js?v=1717"></script>




<div class="main">
	<div class="cLine">
    	<div class="alert">
    		<p><span class="bold">使用方法：</span> 设置积分动作，每日操作次数以及每次增加积分 </br>   
   			<strong><font color='red'>特别提醒:请谨慎操作!以免丢失数据!!</font></strong></br></p>
    	</div>
	</div>
   	<div class="form-group">
		<a style="margin-left:40px;" class="btn btn-primary qx_2812" href="<?php  echo $this->createWebUrl('points', array('op' => 'posta', 'schoolid' => $schoolid))?>"><i class="fa fa-plus"></i> 添加规则</a>
	</div>
	
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
					    <th style="width:100px;">序号</th>
                        <th>规则名称</th>
                        <th>类型</th>
                    	<th>状态</th>
                    	<th>关联动作</th>
                    	<th>每日次数</th>
						<th>增加积分</th>
                        <th class="qx_e_d_11" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($allact)) { foreach($allact as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['id'];?></div></td>
						<td><?php  echo $row['name'];?></td>
						<td><?php  if($row['type'] == 1 ) { ?><span class="label label-success">积分规则</span><?php  } else if($row['type'] == 2 ) { ?><span class="label label-danger">积分任务</span><?php  } ?></td>
                        <td><input type="checkbox" value="<?php  echo $row['is_on'];?>" name="is_on[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['is_on'] == 1) { ?>checked<?php  } ?>></td>
                        <td><?php  if($row['op'] == 'bjtz') { ?> 班级通知 <?php  } else if($row['op'] == 'xyqf') { ?> 校园群发 <?php  } else if($row['op'] == 'fbzy') { ?> 发布作业 <?php  } else if($row['op'] == 'fbbjq') { ?> 发布班级圈 <?php  } else if($row['op'] == 'scxc') { ?> 上传相册 <?php  } else if($row['op'] == 'hf') { ?> 回复 <?php  } else if($row['op'] == 'dz') { ?> 点赞 <?php  } else if($row['op'] == 'shbjq') { ?> 审核班级圈 <?php  } else if($row['op'] == 'bjzx') { ?> 设置班级之星 <?php  } else if($row['op'] == 'shzgqj') { ?> 审核职工请假  <?php  } else if($row['op'] == 'shxsqj') { ?> 审核学生请假 <?php  } else if($row['op'] == 'bqxs') { ?> 补签学生<?php  } else if($row['op'] == 'qdqr') { ?> 签到确认<?php  } else if($row['op'] == 'sczjh') { ?>上传周计划 <?php  } else if($row['op'] == 'xspy') { ?>学生评语 <?php  } else if($row['op'] == 'yjfx') { ?>一键放学 <?php  } ?></td>
                        <td><div class="type-parent"><?php  echo $row['dailytime'];?></div></td>
						<td><div class="type-parent"><?php  echo $row['adpoint'];?></div></td>
                        <td class="qx_e_d_11" style="text-align:right;"><a data-toggle="tooltip" data-placement="top" title="编辑" onclick="show_order(<?php  echo $item['id'];?>);" class="btn btn-default btn-sm qx_2812" href="<?php  echo $this->createWebUrl('points', array('op' => 'posta', 'actid' => $row['id'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_2813" href="<?php  echo $this->createWebUrl('points', array('op' => 'delete', 'actid' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除该动作？');return false;" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
            <?php  echo $pager;?>
        </form>
    </div>
    
</div>

<script>
require(['jquery', 'util', 'bootstrap.switch'], function($, u){
	

	$(':checkbox[name="is_on[]"]').bootstrapSwitch();
	$(':checkbox[name="is_on[]"]').on('switchChange.bootstrapSwitch', function(e, state){

		var is_on = this.checked ? 1 : 2;
		
		var id = $(this).data('id');
		
		$.post("<?php  echo $this->createWebUrl('points', array('op' => 'change', 'schoolid' => $schoolid))?>", {is_on: is_on, id: id}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});
});
</script>
<?php  } else if($operation == 'posta') { ?>
<div class="panel panel-info">
    <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回积分管理</a></div>
</div>
<div class="main">
	<form action="" method="post" class="form-horizontal form"	enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-body" >
				<?php  if(empty($actid)) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>选择动作</label>
					<div class="col-sm-9 col-lg-2" style="width: 30%">
						<select style="margin-right:15px;" name="chooseOP" class="form-control">
								<option value="0">选择动作</option>
								
									<option value="bjtz" <?php  if($act['op'] == 'bjtz') { ?> selected="selected"<?php  } ?>>班级通知</option>
									<option value="xyqf"  <?php  if($act['op'] == 'xyqf') { ?> selected="selected"<?php  } ?>>校园群发</option>
									<option value="fbzy"  <?php  if($act['op'] == 'fbzy') { ?> selected="selected"<?php  } ?>>发布作业</option>
									<option value="fbbjq" <?php  if($act['op'] == 'fbbjq') { ?> selected="selected"<?php  } ?>>发布班级圈</option>
									<option value="scxc" <?php  if($act['op'] == 'scxc') { ?> selected="selected"<?php  } ?>>上传相册</option>
									<option value="hf" <?php  if($act['op'] == 'hf') { ?> selected="selected"<?php  } ?>>回复</option>
									<option value="dz" <?php  if($act['op'] == 'dz') { ?> selected="selected"<?php  } ?>>点赞</option>
									<option value="shbjq" <?php  if($act['op'] == 'shbjq') { ?> selected="selected"<?php  } ?>>审核班级圈</option>
									<option value="bjzx" <?php  if($act['op'] == 'bjzx') { ?> selected="selected"<?php  } ?>>设置班级之星</option>
									<option value="shzgqj" <?php  if($act['op'] == 'shzgqj') { ?> selected="selected"<?php  } ?>>审核职工请假</option>
									<option value="shxsqj" <?php  if($act['op'] == 'shxsqj') { ?> selected="selected"<?php  } ?>>审核学生请假</option>
									<option value="bqxs" <?php  if($act['op'] == 'bqxs') { ?> selected="selected"<?php  } ?>>补签学生</option>
									<option value="qdqr" <?php  if($act['op'] == 'qdqr') { ?> selected="selected"<?php  } ?>>签到确认</option>
									<option value="sczjh" <?php  if($act['op'] == 'sczjh') { ?> selected="selected"<?php  } ?>>上传周计划</option>
									<option value="xspy" <?php  if($act['op'] == 'xspy') { ?> selected="selected"<?php  } ?>>学生评语</option>
									<option value="yjfx" <?php  if($act['op'] == 'yjfx') { ?> selected="selected"<?php  } ?>>一键放学</option>			
								
							</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>选择类型</label>
					<div class="col-sm-9 col-lg-2" style="width: 30%">
						<select style="margin-right:15px;" name="chooseType" class="form-control">
								<option value="0">选择类型</option>
								
									<option value="1" >积分规则</option>
									<option value="2"  >积分任务</option>
											
								
							</select>
					</div>
				</div>
				<?php  } else if(!empty($actid)) { ?>
<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>当前动作:</label>
					 <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="hidden" name="chooseOP" class="form-control" value="<?php  echo $act['op'];?>" />
						<input type="text" name="showOP" class="form-control" value="<?php  if($act['op'] == 'bjtz') { ?> 班级通知 <?php  } else if($act['op'] == 'xyqf') { ?> 校园群发 <?php  } else if($act['op'] == 'fbzy') { ?> 发布作业 <?php  } else if($act['op'] == 'fbbjq') { ?> 发布班级圈 <?php  } else if($act['op'] == 'scxc') { ?> 上传相册 <?php  } else if($act['op'] == 'hf') { ?> 回复 <?php  } else if($act['op'] == 'dz') { ?> 点赞 <?php  } else if($act['op'] == 'shbjq') { ?> 审核班级圈 <?php  } else if($act['op'] == 'bjzx') { ?> 设置班级之星 <?php  } else if($act['op'] == 'shzgqj') { ?> 审核职工请假  <?php  } else if($act['op'] == 'shxsqj') { ?> 审核学生请假 <?php  } else if($act['op'] == 'bqxs') { ?> 补签学生<?php  } else if($act['op'] == 'qdqr') { ?> 签到确认<?php  } else if($act['op'] == 'sczjh') { ?>上传周计划 <?php  } else if($act['op'] == 'xspy') { ?>学生评语 <?php  } else if($act['op'] == 'yjfx') { ?>一键放学 <?php  } ?>" disabled>
						 
                        </div>
                       
				     </div>
                  
                  
				     </div>
				     <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>动作类型:</label>
					 <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="hidden" name="chooseOP" class="form-control" value="<?php  echo $act['op'];?>" />
						<input type="text" name="showType" class="form-control" value="<?php  if($act['type'] == '1') { ?> 积分规则 <?php  } else if($act['type'] == '2') { ?> 积分任务  <?php  } ?>" disabled>
						 
                        </div>
                       
				     </div>
                  
                  
				     </div>
				<?php  } ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>规则名称:</label>
                  
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="text" name="opname" class="form-control" maxlength="6" value="<?php  echo $act['name'];?>"  required="请填写规则名称" oninvalid="setCustomValidity('规则名称不能为空')" title="请填写规则名称" oninput="setCustomValidity('')"  />
						<span>最多可输入6个中英字符或数字</span>
                        </div>
                        
				     </div>
				     </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>次数:</label>
                  
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="number" name="dailytime" class="form-control" value="<?php  echo $act['dailytime'];?>"  required required oninvalid="setCustomValidity('每日次数不能为空')" title="请输入每日次数" oninput="setCustomValidity('')"/>
						<span>规则类对应每日次数，任务类则为总次数</span>
                        </div>
				     </div>
				     </div>
				     <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>增加积分:</label>
                  
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="number" name="adpoints" class="form-control" value="<?php  echo $act['adpoint'];?>" required required oninvalid="setCustomValidity('增加积分不能为空')"  title="请输入增加积分" oninput="setCustomValidity('')"/>
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
$(".check_all").click(function(){
	var checked = $(this).get(0).checked;
	$("input[type=checkbox]").attr("checked",checked);
});
</script>
<?php  } else if($operation == 'post') { ?>
<ul class="nav nav-tabs">
 	<li class="qx_2801 <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('points', array('op' => 'post', 'schoolid' => $schoolid))?>">积分详情</a></li>
    <li class="qx_2811 <?php  if($operation == 'display') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('points', array('op' => 'display', 'schoolid' => $schoolid))?>">积分规则</a></li>
</ul>
<div class="main">
	<div class="panel panel-info">
        <div class="panel-heading">积分记录</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="weixuexiao">
				<input type="hidden" name="do" value="points"/>
				<input type="hidden" name="op" value="post"/>
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按教师姓名搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>						
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按规则名称搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="receive" id="" type="text" value="<?php  echo $_GPC['receive'];?>">
                    </div>						
				</div>					
							
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">操作时间</label>
					<div class="col-sm-2 col-lg-2">
						<?php  echo tpl_form_field_daterange('optime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
					<div class="col-sm-2 col-lg-2" style="margin-left:50px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>	

				</div>
			</form>
		</div>		
    </div>
<div class="panel panel-default">
<form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
	                     <th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th>
					    <th style="width:100px;">序号</th>
                        <th>规则名称</th>
                        <th>规则类型</th>
                        <th>任务进度</th>
                    	<th>教师名称</th>
						<th>增加积分</th>
                        <th >操作时间</th>
                        <th class="qx_2802" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($allact)) { foreach($allact as $row) { ?>
                    <tr>
	                    <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $row['id'];?>"></td>
					    <td><div class="type-parent"><?php  echo $row['id'];?></div></td>
						<td><?php  echo $row['name'];?></td>
						<td><?php  if($row['type'] == 1 ) { ?><span class="label label-success">积分规则</span><?php  } else if($row['type'] == 2) { ?><span class="label label-danger">积分任务</span> <?php  } ?></td>
						<td><?php  if($row['type'] == 1 ) { ?> -- <?php  } else if($row['type'] == 2) { ?> <?php  if($row['mcount'] < $row['max']) { ?> <?php  echo $row['mcount'];?>/<?php  echo $row['max'];?><?php  } else if($row['mcount'] == $row['max'] ) { ?> 已完成 <?php  } ?> <?php  } ?></td>
                        <td><?php  echo $row['tname'];?></td>
						<td><div class="type-parent"><?php  echo $row['adpoint'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['time'];?></div></td>
                        <td class="qx_2802" style="text-align:right;">
	<a class="btn btn-default btn-sm " href="<?php  echo $this->createWebUrl('points', array('op' => 'deletere', 'actid' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除该记录？');return false;" title="删除"><i class="fa fa-times"></i></a>
</td>
                    </tr>
                    
                    <?php  } } ?>
                    </tbody>
                    <tr>
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="button" class="btn btn-primary" name="btndeleteall" value="批量删除" />
					<!--<input type="button" class="btn btn-success" name="btnsendall" value="批量发货" />
					<input type="button" class="btn btn-success" name="btnfinishall" value="批量完成" />-->
				</td>
			</tr>
                </table>
            </div>
        </form>
          </div>
    <?php  echo $pager;?>
</div>
<script type="text/javascript">
$(function(){
	
 	$(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        $("input[type=checkbox]").attr("checked",checked);
    });

    $("input[name=btndeleteall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要删除的记录!');
            return false;
        }
        if(confirm("确认要删除选择的记录?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('points', array('op' => 'deleteall', 'schoolid' => $schoolid))?>";
				$.post(
					url,
					{idArr:id},
					function(data){
						if(data.result){
							alert(data.msg);
							location.reload();
						}else{
							alert(data.msg);
						}
					},'json'
				);
        }
    });

});


</script>
<?php  } ?>
<script type="text/javascript">
	$(function(){
	var e_d_11 = 2 ;
	<?php  if((!(IsHasQx($tid_global,1002812,1,$schoolid)))) { ?>
		$(".qx_2812").hide();
		e_d_11 = e_d_11 - 1 ;
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002813,1,$schoolid)))) { ?>
		$(".qx_2813").hide();
		e_d_11 = e_d_11 - 1 ;
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002801,1,$schoolid)))) { ?>
		$(".qx_2801").hide();
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002811,1,$schoolid)))) { ?>
		$(".qx_2811").hide();
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002802,1,$schoolid)))) { ?>
		$(".qx_2802").hide();
	<?php  } ?>
	if(e_d_11 == 0){
		$(".qx_e_d_11").hide();
	}
});
</script>