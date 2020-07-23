<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($_GPC['do'] == 'basic' || $_GPC['do'] == '') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('basic')?>">基本设置</a></li>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'refund')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('refund')?>">退款设置</a></li><?php  } ?>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'sms')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sms')?>">短信配置</a></li><?php  } ?>
    <?php  if($_W['isfounder']) { ?><li <?php  if(($_GPC['do'] == 'upgrade')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('upgrade')?>">在线升级</a></li><?php  } ?>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'help')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('help')?>" target="_blank">帮助教程</a></li><?php  } ?>
</ul>
<style>
     .item_box img{
         width: 100%;
         height: 100%;
     }
</style>
<?php  if($_W['isfounder'] || $state == 'owner') { ?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('refund', array('op' => 'display1'))?>">分配权限</a></li>
    <li <?php  if($operation == 'display2' || $operation == 'display2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('refund', array('op' => 'display2'))?>">配置证书</a></li>
</ul>
<?php  } ?>
<?php  if($operation == 'display1') { ?>
<div class="main">
    <div class="panel panel-default" style="width:50%">
		<div class="alert alert-info">
			<p><i class="wi wi-info-sign"></i>此处设置是否允许下列学校使用退款功能,同时需要给各个公众号（支付项目要用到借用的公众号）配置退款证书</p>
		</div>
		<div class="table-responsive panel-body">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>学校</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody id="level-list">
				<?php  if(is_array($schoolist)) { foreach($schoolist as $row) { ?>
				<tr>
					<td>
						<img src="<?php  echo tomedia($row['logo'])?>" onerror="this.src='./resource/images/nopic.jpg';" width="60px;" style="border-radius: 3px;">
						<br/><?php  echo $row['title'];?></a>
					</td>
					<td><input type="checkbox" value="<?php  echo $row['refund'];?>" name="is_on[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['refund'] == 1) { ?>checked<?php  } ?>></td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
    </div>
    <?php  echo $pager;?>
</div>
<script>
require(['jquery', 'util', 'bootstrap.switch'], function($, u){
	$(':checkbox[name="is_on[]"]').bootstrapSwitch();
	$(':checkbox[name="is_on[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_on = this.checked ? 1 : 0;
		var id = $(this).data('id');
		$.post("<?php  echo $this->createWebUrl('refund', array('op' => 'change','schoolid' => $schoolid))?>", {is_on: is_on, id: id}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});
});
</script>
<?php  } else if($operation == 'display2') { ?>
<div class="main">
    <div class="panel panel-default" style="width:50%">
		<div class="alert alert-info">
			<p><i class="wi wi-info-sign"></i>此处设置当前接入所有公众号的退款配置证书，注意，这里只需要设置本公众号下学校可以用到借用支付的公众号配置证书，如所有支付不使用借用支付，只需要设置本公众的退款证书即可</p>
			证书:<br/>
			使用微信退款功能需要上传双向证书。<br/>
			证书下载方式:<br>
			微信商户平台(pay.weixin.qq.com)-->账户中心-->账户设置-->API安全-->证书下载。<br>
			我们仅用到apiclient_cert.pem 和 apiclient_key.pem这两个证书<br>
		</div>
		<div class="table-responsive panel-body">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>公众号</th>
					<th>证书</th>
					<th style="text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody id="level-list">
				<?php  if(is_array($datas)) { foreach($datas as $item) { ?>
				<tr>
					<td><div class="type-parent"><?php  echo $item['name'];?></div><span class="label label-success"><?php  if($item['is_wxapp']) { ?>小程序<?php  } ?></span></td>
					<td><div class="type-parent"><?php  if($item['certs']) { ?><span class="label label-info">已配置</span><?php  } else { ?>未配置<?php  } ?></div></td>
					<td style="text-align:right;">
					<a onclick="xiugai(<?php  echo $item['acid'];?>)">修改</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
    </div>
    <?php  echo $pager;?>
	<div class="modal fade"  id="jsauth_acid" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<form id="form21" action="<?php  echo $this->createWebUrl('refund', array('op' => 'upcert'))?>" method="post" class="we7-form form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">apiclient_cert</label>
						<div class="col-sm-8">
							<input type="hidden" name="acid" id="acid" value="">
							<input type="file" name="cert" value="">
						</div>
					</div>
				</div>
				<div class="modal-body">	
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">apiclient_key</label>
						<div class="col-sm-8">
							<input type="file" name="key" value="">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="上传" />
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
function xiugai(acid){
	$("#acid").val(acid);
	$("#jsauth_acid").modal();
}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>