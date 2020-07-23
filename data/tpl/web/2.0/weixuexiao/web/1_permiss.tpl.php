<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<div class="panel panel-info">
	<div class="panel-body">
	   <?php  echo $this -> set_tabbar($action1, $schoolid, $_W['role'], $_W['isfounder'], $_W['schooltype']);?>
	</div>
</div>
 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
<div class="cLine">
    <div class="alert">
		<p><span class="bold">使用方法：</span>    
		<strong><font color='red'>特别提醒: 当你删除该时段项的时候,该时段项下相关的所有数据都会被删除,请谨慎操作!以免丢失数据!</font></strong>
		</br>学校后台登录帐号在此处添加，请关联教师，如该教师为设置分组请先前往教师中心为该教师设置分组
		</p>
    </div>
</div>
<div class="cLine">
    <div class="alert">
		<div class="account">
			<div class="panel-body">
				<div class="clearfix">
					<div class="col-sm-4">
						<p>
							<strong>本校后台地址 :</strong>
							<a href="javascript:;" title="点击复制" id="short_url"><?php  echo $short_url;?></a>
							<span class="btn btn-default btn-sm" onclick="change()" title="切换">重新生成</span>
						</p>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<script>
	$('.account p a').each(function(){
		util.clip(this, $(this).text());
	});
</script>
<?php  if($_GPC['reference'] != 'solution') { ?>
<ul class="nav nav-tabs">
    <li <?php  if($_GPC['do'] == 'permiss') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('permiss', array('schoolid' => $schoolid))?>">本校可用帐号列表</a></li>
    <li <?php  if($_GPC['do'] == 'creates') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('creates', array('op' => 'display', 'schoolid' => $schoolid))?>">添加帐号</a></li>
</ul>
<?php  } ?>
<div class="clearfix">
	<h5 class="page-header">设置校园登录账户
		<?php  if(is_TestFz()) { ?>
		<button class="btn btn-info" onclick="ShowAddModal()"><i class="fa fa-plus"></i>添加独立账户</button>
		<?php  } ?>
	</h5>
	<div class="alert alert-info">
		<i class="fa fa-exclamation-circle"></i> 此页面仅限学校管理员查看和使用
	</div>
	<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:80px;">用户ID</th>
					<th style="width:150px;">用户名</th>
					<th style="width:150px;">教师</th>
					<th style="width:150px;">教师分组</th>
					<th style="width:200px;">角色</th>
					<th style="text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php  if(is_array($member)) { foreach($member as $row) { ?>
				<tr>
					<td><?php  echo $row['uid'];?></td>
					<td><?php  echo $row['username'];?></td>
					<td><?php  echo $row['tname'];?></td>
					<td><span class="label label-info"><?php  echo $row['fzname'];?></span></td>
					<td>
						<?php  if(in_array($member[$row['uid']]['uid'], $founders)) { ?>
						<span class="label label-warning">创始人</span>
						<?php  } else if($permission[$row['uid']]['role'] == 'owner') { ?>
						<span class="label label-warning">主管理员</span>
						<?php  } else { ?>
						<label for="radio_<?php  echo $row['uid'];?>_1" class="radio-inline" style="padding-top:0; float:left; width:70px;"><input type="radio" name="role[<?php  echo $row['uid'];?>]" targetid="<?php  echo $row['uid'];?>" id="radio_<?php  echo $row['uid'];?>_1" value="clerk" <?php  if(empty($permission[$row['uid']]['role']) || $permission[$row['uid']]['role'] == 'clerk') { ?> checked<?php  } ?> /> 操作员</label>
						<label for="radio_<?php  echo $row['uid'];?>_2" class="radio-inline" style="padding-top:0; float:left; width:70px;"><input type="radio" name="role[<?php  echo $row['uid'];?>]" targetid="<?php  echo $row['uid'];?>" id="radio_<?php  echo $row['uid'];?>_2" value="manager" <?php  if($permission[$row['uid']]['role'] == 'manager') { ?> checked<?php  } ?> /> 学校管理</label>
						<?php  } ?>
					</td>
					<td style="text-align:right;">
						<?php  if(in_array($member[$row['uid']]['uid'], $founders)) { ?>
						创始人拥有系统最高权限
						<?php  } else if($row['role'] == 'owner') { ?>
						主管理员拥有公众号的所有权限，并且公众号的权限（模块、模板）根据主管理员来获取
						<?php  } else { ?>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'manager') { ?><a href="<?php  echo $this->createWebUrl('creates', array('uid' => $row['uid'], 'schoolid' => $schoolid, 'uniacid' =>$weid))?>">编辑用户</a>&nbsp;&nbsp;
						<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('permiss', array('uid' => $row['uid'], 'op' => 'revo', 'schoolid' => $schoolid, 'uniacid' =>$weid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
						<?php  } ?>
					</td>					
				</tr>
			<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>

<div class="modal fade" style="min-width: 583px!important;" id="ModalAddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content" style="border-radius: 20px;">
				<div class="modal-header">
					<h4 class="modal-title" style="text-align:center;color:#333;font-size: 17px;">选择独立后台登陆账户</h4>
				</div>
				<div class="modal-body" style="width: 100%;">
					<div class="form-group">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">选择账户</label>
						<?php  if(is_array($member)) { foreach($member as $uni) { ?>
						<?php  $is = $this->uniarr($uniarr,$uni['uid']);?>
							<input type="checkbox" name="uidarr" value="<?php  echo $uni['uid'];?>" <?php  if(($is)) { ?>checked="checked"<?php  } ?>> <?php  echo $uni['username'];?>
						<?php  } } ?>
					</div>
				</div>
				<div class="modal-footer" style="border-radius: 6px;">
					<input type="submit" onclick="tijiao()" class="btn btn-success" value="确定选择">
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
    /**
	 * 重新生成链接
     */
	function change(){
		var schoolid = <?php  echo $schoolid;?>;
        $.get("<?php  echo $this->createWebUrl('permiss', array('op'=> 'change','schoolid' => $schoolid));?>", function(data){
            JsonData = JSON.parse(data)
            util.message(JsonData.msg, '', 'success');
			$("#short_url").text(JsonData.short_url);
        });
	}

var seletedUserIds = <?php  echo json_encode($uids);?>;
require(['biz', 'bootstrap'], function(biz){
	$(function(){
		$('#add-user').click(function(){
			$('#user-modal').modal('show');

			$('#form1').submit(function(){
				var username = $.trim($('#form1 :text[name="username"]').val());
				if(!username) {
					util.message('没有输入用户名.', '', 'error');
					return false;
				}
				$.post("<?php  echo url('account/permission/user', array('uniacid' => $uniacid))?>", {'username':username}, function(data){
					if(data != 'success') {
						util.message(data, '', 'error');
					} else {
						util.message('添加账号操作员成功', "<?php  echo url('account/permission/', array('uniacid' => $uniacid))?>", 'success');
					}
				});
				return false;
			});
		});

		$('#btn-add').click(function(){
			biz.user.browser(seletedUserIds, function(us){
				$.post('<?php  echo url('account/permission', array('uniacid' => $uniacid, 'reference' => $_GPC['reference']));?>', {'do': 'auth', uid: us}, function(dat){
					if(dat == 'success') {
						location.reload();
					} else {
						alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
					}
				});
			},{mode:'invisible'});
		});

		$('#btn-revo').click(function(){
			$chks = $(':checkbox.member:checked');
			if($chks.length >0){
				if(!confirm('确认删除当前选择的用户?')){
					return;
				}
				var ids = [];
				$chks.each(function(){
					ids.push(this.value);
				});
				$.post('<?php  echo url('account/permission', array('uniacid' => $uniacid));?>',{'do':'revos', 'ids': ids},function(dat){
					if(dat == 'success') {
						location.reload();
					} else {
						alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
					}
				});
			}
		});

		$("input[name^='role[']").click(function(){
			$.post("<?php  echo $this->createWebUrl('permiss', array('op'=> 'role','uniacid' => $uniacid,'schoolid' => $schoolid));?>", {'uid' : $(this).attr('targetid'), 'role' : $(this).val()}, function(dat){
				if(dat != 'success') {
					u.message('设置管理员角色失败', "<?php  echo url('account/permission', array('uniacid' => $uniacid))?>", 'error');
				}
			});
		});
	});
});
</script>

<script>

	function ShowAddModal(){
		$('#ModalAddUser').modal('toggle');
	}

	function tijiao(){
		var uidarr = '';
		$.each($("input[name='uidarr']:checked"),function(){
			uidarr += $(this).val()+',';
		});
		$.ajax({
            url: "<?php  echo $this->createWebUrl('permiss', array('op'=>'AddUid'))?>",
            type: "post",
            dataType: "json",
            data: {
                uidarr: uidarr,
                schoolid:`<?php  echo $schoolid;?>`
            },
            success: function (data) {
				alert(data.msg);
				window.location.reload()
            }
        });
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>
