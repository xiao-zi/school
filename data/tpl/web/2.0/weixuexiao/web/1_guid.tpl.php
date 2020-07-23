<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">平台设置</a></li>
</ul>
<?php  if($operation == 'post') { ?>   
<div class="main">
	<form action="" method="post" class="form-horizontal form"	enctype="multipart/form-data">
		<div class="panel panel-default">
		<?php  if($_W['isfounder']) { ?>
		    <div class="alert alert-success">
                温馨提示:</br>
				更多平台化设置方法，请参看微教育商业用户群文件视频教程
            </div>	
		<?php  } ?>		
			<div class="panel-heading">	
				<div class="row-fluid">
					<div class="span8 control-group">
						<a class="btn btn-default" href="<?php  echo $this->createWebUrl('guid', array('op' => 'display' ))?>"><i class="fa fa-search"></i>返回列表</a>
						<a class="btn <?php  if($operation == 'post') { ?>btn-primary <?php  } else { ?>btn-default"<?php  } ?> href="<?php  echo $this->createWebUrl('guid', array('op' => 'post' ))?>"><i class="fa fa-edit"></i>新增新手引导</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>标题</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="bannername" class="form-control" value="<?php  echo $banner['bannername'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">引导图片</label>
					<input type="hidden" name="old_thumb" value="<?php  echo $banner['thumb'];?>" />
					<div class="col-sm-9 col-xs-12">
						<?php  if($banner['thumb']) { ?><?php  echo tpl_form_field_multi_image('thumb', $imgsss)?><?php  } else { ?><?php  echo tpl_form_field_multi_image('thumb',$banner['thumb'])?><?php  } ?>
					<div class="help-block">可上传多张图片,推荐图片尺寸为750*1206</div>
					<div class="help-block" style="color:red">最多9张图</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">显示时间</label>
                   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">开始时间:</label>
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<?php  if($banner['begintime']) { ?><?php  echo tpl_form_field_date('begintime', date('Y-m-d', $banner['begintime']))?><?php  } else { ?><?php  echo tpl_form_field_date('begintime', date('Y-m-d', TIMESTAMP))?><?php  } ?>
                        </div>
				     </div>
                   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">结束时间:</label>
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<?php  if($banner['endtime']) { ?><?php  echo tpl_form_field_date('endtime', date('Y-m-d', $banner['endtime']))?><?php  } else { ?><?php  echo tpl_form_field_date('endtime', date('Y-m-d', TIMESTAMP+500000))?><?php  } ?>
                        </div>
				     </div>					 
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2  control-label text-danger">选择学校</label>
					<div class="col-sm-9 col-xs-6">
						<div class="input-group text-info">
							<label class="checkbox-inline"><input type="checkbox" class="check_all" />全选</label>
							<?php  if(is_array($school)) { foreach($school as $uni) { ?>
							<?php  $is = $this->uniarr($uniarr,$uni['id']);?>
									<label for="uni_<?php  echo $uni['id'];?>" class="checkbox-inline"><input id="uni_<?php  echo $uni['id'];?>" type="checkbox" name="arr[]" value="<?php  echo $uni['id'];?>"<?php  if(($is)) { ?>checked="checked"<?php  } ?>> <?php  echo $uni['title'];?></label>
							<?php  } } ?>
						</div>
						<div class="help-block">选择要将此幻灯片展示的学校,可多选</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">针对人群</label>
					<div class="col-sm-9 col-xs-12">
						<label class='radio-inline'>
							<input type='radio' name='place' value=1 <?php  if($banner['place']==1 || empty($banner['place'])) { ?>checked<?php  } ?> /> 学生
						</label>
						<label class='radio-inline'>
							<input type='radio' name='place' value=2 <?php  if($banner['place']==2) { ?>checked<?php  } ?> /> 老师
						</label>
					</div>
				</div>				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
					<div class="col-sm-9 col-xs-12">
						<label class='radio-inline'>
							<input type='radio' name='enabled' value=1 <?php  if($banner['enabled']==1) { ?>checked<?php  } ?> /> 是
						</label>
						<label class='radio-inline'>
							<input type='radio' name='enabled' value=0 <?php  if($banner['enabled']==0) { ?>checked<?php  } ?> /> 否
						</label>
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
<?php  } else if($operation == 'display') { ?>
<div class="main">
	<div class="panel panel-default">
		<div class="panel-body">
		<?php  if($_W['isfounder']) { ?>
		    <div class="alert alert-success">
                温馨提示:</br>
				更多平台化设置方法，请参看微教育商业用户群文件视频教程
            </div>	
		<?php  } ?>	
            <div class="row" style="margin-left: 15px;">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/ctrl_nave', TEMPLATE_INCLUDEPATH)) : (include template('public/ctrl_nave', TEMPLATE_INCLUDEPATH));?>
            </div>
            <div class="header">
                <h3>新手引导 列表</h3>
            </div>			
			<div class="panel-heading">	
				<div class="row-fluid">
					<div class="span8 control-group">
						<a class="btn <?php  if($operation == 'post') { ?>btn-primary <?php  } else { ?>btn-default"<?php  } ?> href="<?php  echo $this->createWebUrl('guid', array('op' => 'post' ))?>"><i class="fa fa-edit"></i>新增新手引导</a>
					</div>
				</div>
			</div>
				<div style="position:relative">
					<div class="panel-body table-responsive">
						<table class="table table-hover" style="position:relative">
						<thead class="navbar-inner">
							<tr>
								<th>ID</th>				
								<th>标题</th>
								<th>针对人群</th>
								<th>状态</th>
								<th>显示时间</th>
								<th >操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($list)) { foreach($list as $banner) { ?>
								<tr>
									<td><?php  echo $banner['id'];?></td>
									<td><?php  echo $banner['bannername'];?></td>
									<td><?php  if($banner['place'] ==1) { ?>学生<?php  } else { ?>老师<?php  } ?></td>
									<td><?php  if($banner['enabled']) { ?>显示<?php  } else { ?>隐藏<?php  } ?></td>
									<td><?php  echo date('Y-m-d',$banner['begintime'])?>至<?php  echo date('Y-m-d',$banner['endtime'])?></td>
									<td style="text-align:left;">
										<a href="<?php  echo $this->createWebUrl('guid', array('op' => 'post', 'id' => $banner['id']))?>" data-toggle="tooltip" data-placement="top"  class="btn btn-default btn-sm manage"><i class="fa fa-edit"></i>修改</a>
										<a href="<?php  echo $this->createWebUrl('guid', array('op' => 'delete', 'id' => $banner['id']))?>" data-toggle="tooltip" data-placement="top"  class="btn btn-default btn-sm manage"><i class="fa fa-del"></i>删除</a> 
									</td>
								</tr>
							<?php  } } ?>
							
						</tbody>
						</table>
					</div>
				</div>
			<?php  echo $pager;?>
		</div>
    </div>
</div>	
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>