<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">平台设置</a></li>
</ul>
<?php  if($_W['isfounder'] || $state == 'owner') { ?>
<?php  if($operation == 'display') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>
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
                <h3>二维码 列表</h3>
            </div>
            <div class="form-group">
                <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('manager', array('op' => 'display', 'storeid' => $storeid, 'type' => 'qrcode'))?>"><i class="fa fa-qrcode"></i> 二维码</a>
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('manager', array('op' => 'post'))?>">创建二维码</a>
                <div class="form-group inline-form" style="display: inline-block;">
                    <form accept-charset="UTF-8" action="./index.php" class="form-inline" id="diandanbao/table_search" method="get" role="form">
                        <div style="margin:0;padding:0;display:inline">
                        <input name="utf8" type="hidden" value="✓"></div>
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="weixuexiao" />
                        <input type="hidden" name="do" value="manager" />
                        <div class="form-group">
                            <label class="sr-only" for="q_name">名字(学校组名)</label>
                            <input class="form-control" id="keyword" name="keyword" placeholder="名字(学校组名)" type="search">
                        </div>
                        <input class="btn btn-sm btn-success" name="commit" type="submit" value="搜索">
                    </form>
                </div>
            </div>
			<div id="queue-setting-index-body">
				<div class="alert alert-success">
					将如下二维码分发给各个对应学校，扫描后自动将粉丝分组到该学校分组去，以便展现更加详细的个性内容及菜单
				</div>
				<div class="qr-code-table">
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<div class="qr-code-item">
							<div class="qr-code-op">
								<a data-rel="tooltip" href="<?php  echo $this->createWebUrl('manager', array('id' => $item['id'], 'op' => 'post'))?>" title="更新"><icon class="fa fa-edit"></icon></a>
								<a data-confirm="确定删除?" data-method="delete" data-rel="tooltip" href="<?php  echo $this->createWebUrl('manager', array('id' => $item['id'], 'op' => 'delete', 'gpid' => $item['gpid']))?>" onclick="return confirm('确认操作吗？');return false;" rel="nofollow" title="删除"><icon class="fa fa-trash-o"></icon></a>
							</div>
							<a href="#">
								<div class="qr-code-box">
									<div class="qr-code-item-image">
										<img alt="<?php  echo $item['name'];?>" src="<?php  echo tomedia($item['show_url'])?>" width="100%">
									</div>
									<div class="qr-code-item-info">
									  ID:<?php  echo $item['qrcid'];?>&nbsp;<?php  echo $item['name'];?>
									  <br>
									</div>
								</div>
								<div class="qr-code-item-footer">
									<span class="label label-warning">扫描: <?php  echo $item['subnum'];?>次</span>
									<br>
								   <?php  if(!empty($item['status'])) { ?><span class="label label-info">使用中</span><?php  } else { ?><span class="label label-danger">已过期</span><?php  } ?>
								    <?php  if(!empty($item['rid'])) { ?><span class="label label-success">个性关注回复</span><?php  } else { ?><span class="label label-danger">未设置</span><?php  } ?>
								</div>
							</a>
						</div>
					<?php  } } ?>
					<div class="space"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php  echo $pager;?>
        </div>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $_GPC['id'];?>" />
        <div class="panel panel-default">
		<?php  if($_W['isfounder']) { ?>
			<div class="alert alert-success">
                温馨提示:</br>
				更多平台化设置方法，请参看微教育商业用户群文件视频教程
            </div>
		<?php  } ?>	
            <div class="panel-heading">
                创建学校分组二维码
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">关联学校分组</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="group_id" autocomplete="off" class="form-control">
						<?php  if(is_array($fansgroup)) { foreach($fansgroup as $key => $value) { ?>
						<option value="<?php  echo $value['id'];?>" <?php  if($row['group_id'] == $value['group_id']) { ?> selected="selected" <?php  } ?>><?php  echo $value['name'];?></option>
						<?php  } } ?>
                        </select>
                    </div>
                </div>		
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">关联关键字:</label>
					<div class="col-sm-9 col-xs-12" style="position:relative">
						<div class="input-group">
							<input type="hidden" name="ruleid" class="form-control" id="ruleid" value="" />
							<input type="text" name="keyword" class="form-control" id="keywordinput" value="<?php  echo $keyword['content'];?>" placeholder="可根据关键字直接关联指定的回复规则" autocomplete="off" />
							<div class="input-group-btn">
								<span class="btn btn-primary" id="keyword_search"><i class="fa fa-search"></i> 搜索</span>
							</div>
						</div>
						<div id="keyword_menu" style="width:100%;position:absolute;top:35px;left:16px;display:none;z-index:10000">
							<ul class="dropdown-menu" style="display:block;width:91%;height:200px;overflow-y:scroll;"></ul>
						</div>
						<div class="help-block">请选择"图文消息"关联关键字。</div>
						<div class="help-block">发送图文消息仅支持关联已添加的图文关键字</div>
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
<?php  } ?>
<?php  } else { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			 抱歉：
		</div>
		<div class="panel-body">
		<div class="row-fluid">
			<div class="span8 control-group">
				【你没有权限查看本页面，请联系管理员进行操作】
			</div>
		</div>
		</div>
	</div>
<?php  } ?>
<script>
function select_keyword(clickid, menuid, inputid, ruleid){
	$(clickid).click(function(){
		var search_value = $(inputid).val();
		$('body').append('<div class="layer_bg"></div>');
		$('.layer_bg').height($(document).height());
		$('.layer_bg').css({width : '100%', position : 'absolute', top : '0', left : '0', 'z-index' : '0'});
		$.post("<?php  echo $this->createWebUrl('manager', array('op'=>'keyword'))?>", {'key_word' : search_value}, function(data){
			var data = $.parseJSON(data);
			var total = data.length;
			var html = '';
			if(total > 0) {
				for(var i = 0; i < total; i++) {
					html += '<li><a href="javascript:;" id="'+ data[i]['rid'] +'">' + data[i]['content'] + '</a></li>';
				}
			} else {
				html += '<li><a href="javascript:;" class="no-result">没有匹配到您输入的关键字</a></li>';
			}
			$(menuid + ' ul').html(html);
			$(menuid + ' ul li a[class!="no-result"]').click(function(){
				$('.layer_bg').remove();
				$(inputid).val($(this).html());
				$(ruleid).val($(this).attr('id'));
				$(menuid).hide();
			});
			$(menuid).show();
		});
		$('.layer_bg').click(function(){
			$(menuid).hide();
			$(this).remove();
		});

	});
	$(inputid).keydown(function(event){
		if(event.keyCode == 13){
			$(clickid).click();
			return false;
		}
	});
}
select_keyword('#keyword_search', '#keyword_menu', '#keywordinput', '#ruleid');
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>