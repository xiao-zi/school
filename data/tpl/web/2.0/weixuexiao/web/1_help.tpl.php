<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#">系统帮助</a></li>
</ul>
<style>
.system-menu-list .menu-open>.table-div-menu .toggle {border-top: 0px solid;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: unset;color: red;}
.system-menu-list .menu-open>.table-div-menu .toggle:before {content: "\f068";}
</style>
<?php  if($operation == 'display') { ?>
	<div class="panel we7-panel">
	    <div class="alert alert-success">
			<i class="fa fa-exclamation-triangle"></i> 本系统教程会随时更新，请留意版本变化及教程更新时间
		</div>
		<div class="input-group we7-margin-bottom" style="width:300px;left:20px">
			<input class="form-control" id="keyword" type="text" value="" placeholder="输入教程名称" style="width: 330px;">
			<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
		</div>
		<div class="panel-heading">		
			<div class="table-div table-div-menu">
				<div class="table-div__item order">分类</div>
				<div class="table-div__item name">标题</div>
				<div class="table-div__item order">最后更新</div>
				<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
				<div class="table-div__item order">作者</div>
				<div class="table-div__item order">点击</div>
				<?php  } ?>
				<div class="table-div__item action">操作</div>
			</div>
		</div>
		<div class="panel-body system-menu-list">
			<ul class="one">
			<?php  if($locahelp) { ?>
				<li class="menu-item">
					<div class="table-div table-div-menu">
						<div class="table-div__item order">本地教程</div>
						<div class="table-div__item name"></div>
						<div class="table-div__item order"><?php  echo $localastime;?></div>
						<div class="table-div__item order"></div>
						<div class="table-div__item order"></div>
						<div class="table-div__item action"><button class="fa fa-plus toggle"></button></div>
					</div>
					<?php  if(is_array($locahelp)) { foreach($locahelp as $row) { ?>
					<ul class="two">
						<li class="menu-item">
							<div class="table-div table-div-menu">
								<div class="table-div__item order"></div>
								<div class="table-div__item name"><a href="<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid,'op' => 'detail','id' => $row['id']), true)?>" target="_blank"><?php  echo $row['title'];?></a></div>
								<div class="table-div__item order"><?php  echo date('Y-m-d H:i',$row['lasttime'])?></div>
								<div class="table-div__item order"><?php  if($row['author']) { ?><?php  echo $row['author'];?><?php  } else { ?>管理员<?php  } ?></div>
								<div class="table-div__item order"></div>
								<div class="table-div__item action">
								<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
									<div class="link-group">
										<a href="<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid,'op' => 'post','id' => $row['id']), true)?>">编辑</a>
									</div>
								<?php  } ?>	
								</div>
							</div>
						</li>						
					</ul>
					<?php  } } ?>
				</li>
			<?php  } ?>
			<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
			<?php  if($mycoludhelp) { ?>
			<div class="alert alert-info">
				<i class="fa fa-exclamation-triangle"></i>以下部分限站长和公众号主管理员查看
			</div>				
				<li class="menu-item">
					<div class="table-div table-div-menu">
						<div class="table-div__item order">我发布的共享教程</div>
						<div class="table-div__item name"></div>
						<div class="table-div__item order"></div>
						<div class="table-div__item order"></div>
						<div class="table-div__item order"></div>
						<div class="table-div__item action"><button class="fa fa-plus toggle"></button></div>
					</div>
					<?php  if(is_array($mycoludhelp)) { foreach($mycoludhelp as $row) { ?>
					<ul class="two">
						<li class="menu-item">
							<div class="table-div table-div-menu">
								<div class="table-div__item order"></div>
								<div class="table-div__item name"><a href="<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid,'op' => 'detail','id' => $row['id'],'couldhelpid' => $row['could_id']), true)?>" target="_blank"><?php  echo $row['title'];?></a><?php  if($row['open'] ==1) { ?><span class="label label-info">待审核</span><?php  } ?><?php  if($row['open'] ==2) { ?><span class="label label-success">已通过</span><?php  } ?></div>
								<div class="table-div__item order"><?php  echo date('Y-m-d H:i',$row['lasttime'])?></div>
								<div class="table-div__item order"><?php  if($row['author']) { ?><?php  echo $row['author'];?><?php  } ?></div>
								<div class="table-div__item order"></div>
								<div class="table-div__item action">
									<div class="link-group">
										<a onclick="return confirm('此操作不可恢复，确认删除本教程？');return false;" href="<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid,'op' => 'delete','id' => $row['id']), true)?>">删除</a>
									</div>								
								</div>
							</div>
						</li>						
					</ul>
					<?php  } } ?>
				</li>
			<?php  } ?>
			<?php  } ?>	
			</ul>
		</div>		
	</div>
<script>
$('.toggle').click(function () {
	console.log($(this).parent().parent().parent().toggleClass('menu-open'))
})
function toggle(fenleiid){
	$("#menuid"+fenleiid).toggleClass('menu-open');
}
$('.input-group-btn').click(function () {
	var search_text = $.trim($("#keyword").val());
	if (search_text == '') {
		$(".system-menu-list .two").show();
	} else {
		$(".system-menu-list .two").each(function () {
			if ($(this).find(".name").text().indexOf(search_text) != -1) {
				$(this).show();
			} else {
				$(this).hide();
			}
		})
	}
})	
$(function(){
   $.ajax({
	  url: "<?php  $this->createWebUrl('help')?>",
	  data:{op:'check',schoolid:"<?php  echo $schoolid;?>"},
	  type:'post',
	  dataType:'json',
	  success:function(ret){
			var alertHtml = "";
			if(ret.result == 0){
				var dt = eval(ret.m);
				//$('.system-menu-list').find(".one").children().remove();
				var Html = "";
				for (var i = 0; i < dt.length; i++) {
					var fenleiid = dt[i].id;
					var fenlei = dt[i].fenlei;
					var lasttime = dt[i].lasttime;
					var hasnew = dt[i].hasnew;
					var help = dt[i].help;
					alertHtml += "<li id=\"menuid"+fenleiid+"\" class=\"menu-item\">";
					alertHtml += "<div class=\"table-div table-div-menu\">";
					if(hasnew == 2){
						alertHtml += "<div class=\"table-div__item order\">"+fenlei+"<span class=\"label label-info\">有更新</span></div>";
					}else{
						alertHtml += "<div class=\"table-div__item order\">"+fenlei+"</div>";
					}					
					alertHtml += "<div class=\"table-div__item name\"></div>";
					alertHtml += "<div class=\"table-div__item order\">"+lasttime+"</div>";
					<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
					alertHtml += "<div class=\"table-div__item order\"></div>";
					alertHtml += "<div class=\"table-div__item order\"></div>";
					<?php  } ?>
					
					if(help.length>0){
						alertHtml += "<div class=\"table-div__item action\"><button onclick=\"toggle("+fenleiid+")\" class=\"fa fa-plus toggle\"></button></div>";
					}else{
						alertHtml += "<div class=\"table-div__item action\"></div>";
					}
					alertHtml += "</div>";
					alertHtml += "<ul class=\"two\">";
					for (var s = 0; s < help.length; s++) {
						var isnew = help[s].hasnew;
						alertHtml += "<li class=\"menu-item\">";
						alertHtml += "<div class=\"table-div table-div-menu\">";
						alertHtml += "<div class=\"table-div__item order\"></div>";
						if(isnew == 2){
							alertHtml += "<div class=\"table-div__item name\"><a onclick=\"jumpdetail("+help[s].id+")\">"+help[s].title+"<span class=\"label label-danger\">有更新</span></a></div>";
						}else{
							alertHtml += "<div class=\"table-div__item name\"><a onclick=\"jumpdetail("+help[s].id+")\">"+help[s].title+"</a></div>";
						}						
						alertHtml += "<div class=\"table-div__item order\">"+help[s].time+"</div>";				
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						alertHtml += "<div class=\"table-div__item order\">"+help[s].writer+"</div>";
						alertHtml += "<div class=\"table-div__item order\">"+help[s].hot+"次</div>";
						<?php  } ?>
						alertHtml += "<div class=\"table-div__item action\"></div>";
						alertHtml += "</div>";
						alertHtml += "</li>	";					
					}
					alertHtml += "</ul>";
					alertHtml += "</li>";	
				}
				Html += "<div class=\"we7-padding-bottom clearfix\">";
				Html += "<div class=\"pull-right\">";
				Html += "<a onclick=\"post()\" class=\"btn btn-primary we7-padding-horizontal\">+创建教程</a>";
				Html += "</div>";
				Html += "</div>";
				$('.system-menu-list').find(".one").prepend(alertHtml);	
				<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
					$('.we7-panel').prepend(Html);
				<?php  } ?>	
			}else{
		  	    alertHtml += "<div class=\"alert alert-danger\">";
				alertHtml += "<i class=\"fa fa-exclamation-triangle\"></i> "+ret.m+"";
				alertHtml += "</div>";
				$('.system-menu-list').find(".one").append(alertHtml);
			}
	  }
  })
});
function jumpdetail(helpid){
	window.open("<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid,'op' => 'detail'), true)?>"+"&helpid="+helpid);
}
function post(){
	window.open("<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid,'op' => 'post'), true)?>");
}
</script>
<?php  } else if($operation == 'post') { ?>
<div class="clearfix">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
	<div class="panel panel-default">
		<div class="panel-heading">添加教程</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">排序</label>
				<div class="col-sm-2 col-lg-2">
					<input type="text" class="form-control" placeholder="" name="displayorder" value="<?php  echo $item['displayorder'];?>">
					<span class="help-block">值越大则越靠前(排序本地有效,共享不生效)</span>
				</div>
			</div>
			<?php  if($item['is_share'] == 2 || empty($item)) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">共享</label>
				<div class="col-sm-9 col-xs-12">
					<label class="radio-inline">
						<input type="radio" value="1" class="printer-type" name="is_share" <?php  if($item['is_share'] == '1' || empty($item['is_share'])) { ?>checked<?php  } ?> id="credit1"> 共享
					</label>
					<label class="radio-inline">
						<input type="radio" value="2" class="printer-type" name="is_share" <?php  if($item['is_share'] == '2') { ?>checked<?php  } ?> id="credit2"> 不共享
					</label>
					<div class="help-block" style="color:red">鼓励大家共享教程,官方会帮大家对提交的共享教程优化修正</div>
				</div>
			</div>
			<?php  } else { ?>
				<input type="hidden" name="is_share" value="1" />
			<?php  } ?>
			<div id="credit-status0" <?php  if($item['is_share'] == 1 || empty($item['is_share'])) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">类型</label>
					<div class="col-sm-2 col-lg-4">
						<select style="margin-right:15px;" name="type" class="form-control">
						</select>
						<div class="help-block">请您认真选择教程类型,如果教程不属于上述任何类别,请联系客服</div>
					</div>
				</div>
			</div>
			<div id="credit-status1" <?php  if($item['is_share'] == 2) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">类型</label>
					<div class="col-sm-2 col-lg-4">
						<select style="margin-right:15px;" class="form-control">
							<option selected="selected">本地教程</option>
						</select>
						<div class="help-block">不共享创建之教程保存在本地，统一归类至“本地教程”类，PS：鼓励大家共享教程</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">标题</label>
				<div class="col-sm-2 col-lg-5">
					<input type="text" class="form-control" placeholder="" name="title" value="<?php  echo $item['title'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">作者</label>
				<div class="col-sm-2 col-lg-5">
					<input type="text" class="form-control" name="author" value="<?php  echo $item['author'];?>">
					<span class="help-block">如共享：留空显示站点授权QQ昵称<br>如不共享：留空显示 作者：管理员,且不显示点击量<br>独立后台账户无法看到作者和点击量</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">内容</label>
				<div class="col-sm-8 col-xs-12">
					<?php  echo tpl_ueditor('content', $content);?>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
		<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid), true)?>">返回列表</a>
	</div>
</form>
</div>
<script>
$(function(){
	   $.ajax({
		  url: "<?php  $this->createWebUrl('help')?>",
		  data:{op:'checktype',schoolid:"<?php  echo $schoolid;?>"},
		  type:'post',
		  dataType:'json',
		  success:function(ret){
				var alertHtml = "";
				if(ret.result == 0){
					var dt = eval(ret.m);
					$('#credit-status0').find(".form-control").children().remove();
					for (var i = 0; i < dt.length; i++) {
						var fenleiid = dt[i].id;
						var fenlei = dt[i].name;
						alertHtml += "<option value=\""+fenleiid+"\">"+fenlei+"</option>";
					}
					$('#credit-status0').find(".form-control").append(alertHtml);	
				}
		  }
	  })	
	$('#credit1').click(function(){
		$('#credit-status0').show();
		$('#credit-status1').hide();
	});
	$('#credit2').click(function(){
		$('#credit-status0').hide();
		$('#credit-status1').show();
	});		
});
</script>
<?php  } else if($operation == 'detail') { ?>
<style>
* {moz-user-select: -moz-none;-moz-user-select: none;-o-user-select: none;-khtml-user-select: none;-webkit-user-select: none;-ms-user-select: none;user-select: none;}
</style>
	<div class="we7-padding">
		<ol class="breadcrumb we7-breadcrumb">
			<a onclick="javascript :history.back(-1);"><i class="wi wi-back-circle"></i></a>
			<li class="active"><a href="<?php  echo $this->createWebUrl('help', array('schoolid' => $schoolid), true)?>">帮助列表</a></li>
			<li class="active"><?php  echo $item['title'];?></li>
		</ol>
		<div class="panel we7-panel news-detail">
			<div class="panel-heading" style=" height: 99px;">
				<h3 class="text-center"><?php  echo $item['title'];?></h3>
				<div class="small text-center">
					<span><?php  echo date('Y-m-d H:i', $item['createtime']);?></span>
					<span>阅读：<?php  echo $item['click'];?>次</span>
					<span>作者：<?php  echo $item['author'];?></span>
				</div>
			</div>
			<div class="panel-body we7-padding">
				<?php  echo html_entity_decode($item['content'], ENT_QUOTES)?>
			</div>
		</div>
	</div>
	
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>