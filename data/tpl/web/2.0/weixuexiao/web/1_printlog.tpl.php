<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-info">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li <?php  if($_GPC['do']=='printlog') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printlog', array('op' => 'display', 'schoolid' => $schoolid))?>">打印记录</a></li>
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' || (IsHasQx($tid_global,1003011,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='printer') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'display', 'schoolid' => $schoolid))?>">打印机</a></li>
			<?php  } ?>
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' || (IsHasQx($tid_global,1003021,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['op']=='printer') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'printset', 'schoolid' => $schoolid))?>">打印设置</a></li>
			<?php  } ?>
		</ul>	
	</div>
</div>
<?php  if($operation == 'display') { ?>
	<div class="clearfix">
		<div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="weixuexiao">
					<input type="hidden" name="do" value="printlog">
					<input type="hidden" name="op" value="display">
					<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
					<div class="form-group">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">订单id</label>
						<div class="col-sm-2 col-lg-2">
							<input type="text" value="<?php  echo $oid;?>" class="form-control" name="oid">
						</div>
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">设备品牌</label>
						<div class="col-sm-2 col-lg-2">
							<select style="margin-right:15px;" name="type" class="form-control">
								<option value="" <?php  if(!$_GPC['type']) { ?> selected="selected"<?php  } ?>>请选择</option>
								<?php  if(is_array($types)) { foreach($types as $index => $row) { ?>
								<option value="<?php  echo $index;?>" <?php  if($_GPC['type'] == $index) { ?> selected="selected"<?php  } ?>><?php  echo $row['text'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">设备名称</label>
						<div class="col-sm-2 col-lg-2">
							<select style="margin-right:15px;" name="pid" class="form-control">
								<option value="">请选择</option>
								<?php  if(is_array($printers)) { foreach($printers as $row) { ?>
								<option value="<?php  echo $row['id'];?>" <?php  if($_GPC['pid'] == $row['id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
								<?php  } } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">下单时间</label>
						<div class="col-sm-2 col-lg-2">
							<?php  echo tpl_form_field_daterange('createtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
						</div>
						<div class="col-sm-2 col-lg-2" style="margin-left:50px">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>	
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th>
							<th>订单id</th>
							<th>打印机品牌</th>
							<th>打印状态</th>
							<th>打印反馈</th>
							<th>打印时间</th>
							<th class="qx_03002">删除</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($list)) { foreach($list as $da) { ?>
							<tr>
								<td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $da['id'];?>"></td>
								<td><a title="查看订单" href="<?php  echo $this->createWebUrl('payall', array('op' => 'display', 'number' => $da['oid'] , 'schoolid' => $schoolid));?>"><?php  echo $da['oid'];?></a></td>
								<td>
									<span class="<?php  echo $types[$da['printer_type']]['css'];?>"><?php  echo $types[$da['printer_type']]['text'];?></span>
								</td>
								<td>
									<?php  if($da['status'] == 2) { ?>
										<span class="label label-success">已执行</span>
									<?php  } else { ?>
										<span class="label label-danger">异常</span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($da['status_cn'] == 2) { ?>
										<span class="label label-success">已打印</span>
									<?php  } else if($da['status_cn'] == 1) { ?>
										<span class="label label-danger">异常</span>
									<?php  } else { ?>
										<span class="label label-info"><?php  echo $da['status_cn'];?></span>
									<?php  } ?>
								</td>
								<td><?php  echo date('Y-m-d H:i:s', $da['createtime']);?></td>
								<td class="qx_03002">
									<a href="<?php  echo $this->createWebUrl('printer', array('op' => 'delete', 'id' => $da['id'], 'schoolid' => $schoolid));?>" class="btn btn-default btn-sm" onclick="if(!confirm('确定删除吗')) return false;" title="删除" data-toggle="tooltip" data-placement="top" ><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php  echo $pager;?>
	</div>
<?php  } ?>
<script>
$(function(){
	<?php  if(!(IsHasQx($tid_global,1003002,1,$schoolid))) { ?>
		$(".qx_03002").hide();
	<?php  } ?>
});
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>