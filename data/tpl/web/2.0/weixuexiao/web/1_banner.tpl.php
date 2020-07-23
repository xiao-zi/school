<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
 <?php  if($operation == 'post') { ?>   
<div class="main">
	<form action="" method="post" class="form-horizontal form"	enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-heading">	
				<div class="row-fluid">
					<div class="span8 control-group">
						<a class="btn btn-default" href="<?php  echo $this->createWebUrl('banner', array('schoolid' => $schoolid, 'op' => 'display' ))?>"><i class="fa fa-search"></i>幻灯片</a>
						<a class="btn <?php  if($operation == 'post') { ?>btn-primary <?php  } else { ?>btn-default"<?php  } ?> href="<?php  echo $this->createWebUrl('banner', array('schoolid' => $schoolid, 'op' => 'post' ))?>"><i class="fa fa-edit"></i>添加幻灯片</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="displayorder" class="form-control" value="<?php  echo $banner['displayorder'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>幻灯片标题</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="bannername" class="form-control" value="<?php  echo $banner['bannername'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片图片</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('thumb', $banner['thumb'])?>

					<div class="help-block">图片最大高度为600，每张图片宽高请设置为相同的宽高！！！</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>幻灯片链接</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="link" class="form-control" value="<?php  echo $banner['link'];?>" />
					</div>
				</div>
				 <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
					<div class="col-sm-9 col-xs-12">
						<label class='radio-inline'>
							<input type='radio' name='enabled' value=1' <?php  if($banner['enabled']==1) { ?>checked<?php  } ?> /> 是
						</label>
						<label class='radio-inline'>
							<input type='radio' name='enabled' value=0' <?php  if($banner['enabled']==0) { ?>checked<?php  } ?> /> 否
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
<?php  } else if($operation == 'display') { ?>
<div class="main">
		<div class="panel panel-default">
			<div class="panel-heading">	
				<div class="row-fluid">
					<div class="span8 control-group">
						<a class="btn qx_edit <?php  if($operation == 'post') { ?>btn-primary <?php  } else { ?>btn-default"<?php  } ?> href="<?php  echo $this->createWebUrl('banner', array('schoolid' => $schoolid, 'op' => 'post' ))?>"><i class="fa fa-edit"></i>添加幻灯片</a>
					</div>
				</div>
			</div>
			<form method="post" class="form-horizontal" id="formfans">
			<input type="hidden" name="op" value="del" />
			<div style="position:relative">
				<div class="panel-body table-responsive">
					<table class="table table-hover" style="position:relative">
					<thead class="navbar-inner">
						<tr>
							<th style="width:30px;">ID</th>
									<th>显示顺序</th>					
									<th>标题</th>
									<th>预览</th>
									<th>连接</th>
									<th>状态</th>
									<th>点击</th>
									<th class="qx_e_d">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($list)) { foreach($list as $banner) { ?>
							<tr>
								<td><?php  echo $banner['id'];?></td>
								<td><?php  echo $banner['displayorder'];?></td>
								<td><?php  echo $banner['bannername'];?></td>
								<td><img src="<?php  echo tomedia($banner['thumb'])?>" width="50"></td>
								<td><?php  echo $banner['link'];?></td>
								<td><?php  if($banner['enabled']) { ?>显示<?php  } else { ?>隐藏<?php  } ?></td>
								<td><?php  echo $banner['click'];?>次</td>
								<td class="qx_e_d" style="text-align:left;">
									<a href="<?php  echo $this->createWebUrl('banner', array('op' => 'post', 'id' => $banner['id'], 'schoolid' => $schoolid))?>" data-toggle="tooltip" data-placement="top"  class="btn btn-default btn-sm manage qx_edit"><i class="fa fa-edit"></i>修改</a>
									<a href="<?php  echo $this->createWebUrl('banner', array('op' => 'delete', 'id' => $banner['id'],'schoolid' => $schoolid))?>" data-toggle="tooltip" data-placement="top"  class="btn btn-default btn-sm manage qx_delete"><i class="fa fa-del"></i>删除</a> 
								</td>
							</tr>
						<?php  } } ?>
						
					</tbody>
					</table>
				</div>
			</div>
			</form>
			<?php  echo $pager;?>
		</div>
    </div>
    <script type="text/javascript">
	$(document).ready(function() {
		var e_d = 2 ;
		<?php  if(!(IsHasQx($tid_global,1000502,1,$schoolid))) { ?>
			$(".qx_edit").hide();
			e_d = e_d -1;
		<?php  } ?>
		<?php  if(!(IsHasQx($tid_global,1000503,1,$schoolid))) { ?>
			$(".qx_delete").hide();
			e_d = e_d -1;
		<?php  } ?>
		if(e_d == 0){
			$(".qx_e_d").hide();
		}
	});	
    </script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>