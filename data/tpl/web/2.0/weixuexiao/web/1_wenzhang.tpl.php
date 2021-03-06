<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
    <div class="panel panel-info">
        <div class="panel-body">
           <?php  echo $this -> set_tabbar2($action1, $schoolid);?>
        </div>
    </div>
 <style>
.cLine {
    overflow: hidden;
    padding: 5px 0;
  color:#000000;
}
.alert {
padding: 8px 35px 0 10px;
text-shadow: none;
-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #f9edbe;
border: 1px solid #f0c36d;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
color: #333333;
margin-top: 5px;
}
.alert p {
margin: 0 0 10px;
display: block;
}
.alert .bold{
font-weight:bold;
}
 </style>
<div class="cLine">
    <div class="alert">
    <p><span class="bold">说明：</span>
   此处的公告会出现在首页端，校长端发送公告并不会出现在这里，也不会出现在前端，此处的公告仅仅面向社会<br/>
   <strong><font color='red'>特别提醒: 此处公告可设置顺序显示或是否显示</font></strong>
    </p>
    </div>
</div>
<?php  if($operation == 'post') { ?>
<div class="panel panel-info">
    <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回文章列表</a></div>
</div>
<div class="clearfix">
	<div id="Layer2" style="display:none; background-color: gray;opacity:0.1;position:absolute; width:100%; height:100%; z-index:9999; padding-bottom: 20px; filter:Alpha(opacity=30)" >
	</div>
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
	<div class="panel panel-default">
		<div class="panel-heading">文章管理</div>
		<div class="panel-body">
				
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">排序</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" placeholder="" name="displayorder" value="<?php  echo $item1['displayorder'];?>">
						<span class="help-block">文章的显示顺序，越大则越靠前</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">标题</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" placeholder="" name="title" value="<?php  echo $item1['title'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">文章作者</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="author" value="<?php  echo $item1['author'];?>">
						<span class="help-block">留空显示本校名称</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">缩略图</label>
					<div class="col-sm-8 col-xs-12">
						<?php  echo tpl_form_field_image('thumb', $item1['thumb'])?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label>
						图片建议尺寸：90像素 * 70像素
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分享描述</label>
					<div class="col-sm-8 col-xs-12">
						<textarea class="form-control" name="description" rows="5"><?php  echo $item1['description'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">内容</label>
					<div class="col-sm-8 col-xs-12">
						<?php  echo tpl_ueditor('content', $item1['content']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">阅读次数</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" name="click" value="<?php  echo $item1['click'];?>" class="form-control"/>
						<div class="help-block">默认为0。您可以设置一个初始值,阅读次数会在该初始值上增加。</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">点赞数</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" name="dianzan" value="<?php  echo $item1['dianzan'];?>" class="form-control"/>
						<div class="help-block">默认为0。您可以设置一个初始值,点赞数会在该初始值上增加。</div>
					</div>
				</div>				
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
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
<?php  } else if($operation == 'display') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
            <div class="form-group">
                <a class="btn btn-primary btn-sm qx_1422" href="<?php  echo $this->createWebUrl('wenzhang', array('op' => 'post', 'schoolid' => $schoolid))?>">添加文章</a>
                <div class="form-group inline-form" style="display: inline-block;">
                    <form accept-charset="UTF-8" action="./index.php" class="form-inline" id="diandanbao/table_search" method="get" role="form">
                        <div style="margin:0;padding:0;display:inline">
                        <input name="utf8" type="hidden" value="✓"></div>
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="weixuexiao" />
                        <input type="hidden" name="do" value="wenzhang" />
						<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                        <div class="form-group">
                            <label class="sr-only" for="q_name">标题(标题关键字)</label>
                            <input class="form-control" id="keyword" name="keyword" placeholder="标题(标题关键字)" type="search">
                        </div>
                        <input class="btn btn-sm btn-success" name="commit" type="submit" value="搜索">
                    </form>
                </div>
            </div>
	</div>
</div>

<div class="panel panel-default">
	<div class="table-responsive panel-body">
		<table class="table">
			<thead>
				<tr>
					<th style="width:50px">排序</th>
					<th>标题</th>
					<th style="width:80px;">点击量</th>
					<th style="width:80px;">点赞</th>
					<th style="width:80px;">缩略图</th>
					<th style="width:180px;">发布时间</th>
					<th style="width:180px;">作者</th>
					<th style="width:200px; text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><span><?php  echo $item['displayorder'];?></span></td>
					<td>
						<span class="label label-info"><i class="fa fa-list-alt"></i></span>&nbsp;<?php  echo $item['title'];?>
					</td>
					<td>
						<span class="label label-success"><i class="fa fa-rss">&nbsp;<?php  echo $item['click'];?></i></span>
					</td>
					<td>
						<span class="label label-danger"><i class="fa fa-gittip">&nbsp;<?php  echo $item['dianzan'];?></i></span>
					</td>					
					<td>
						<?php  if(!empty($item['thumb'])) { ?><span class="label label-success">有</span><?php  } else { ?>
						<span class="label label-danger">无</span><?php  } ?>
					</td>					
					<td>
						<span class="label label-success"><?php  echo date('Y-m-d H:m:s',$item['createtime'])?></span>
					</td>
					<td>
						<?php  if(empty($item['author'])) { ?><span class="label label-success"><i class="fa fa-wechat"></i></span>&nbsp;无<?php  } else { ?>&nbsp;
						<span class="label label-success"><i class="fa fa-wechat"></i></span><span class="label label-danger"><?php  echo $item['author'];?></span><?php  } ?>
					</td>					
					<td style="text-align:right; position:relative;">
						<a class="bj" id="qx_bj_ck" href="<?php  echo $this->createWebUrl('wenzhang', array('op' => 'post', 'id' => $item['id'], 'schoolid' => $schoolid))?>" title="编辑">编辑</a>&nbsp;-&nbsp;
						<a class="qx_1423" class="qx_1423" onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('wenzhang', array('op' => 'delete', 'id' => $item['id'], 'schoolid' => $schoolid))?>" title="删除">删除</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<?php  echo $pager;?>
<?php  } ?>
<script type="text/javascript">
$(function(){
	<?php  if(!(IsHasQx($tid_global,1001422,1,$schoolid))) { ?>
		$(".qx_1422").hide();
		$(".bj").attr("title","查看");
		$(".bj").html("查看");
		$("#Layer2").show();
		$("input[name=submit]").hide();
		
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1001423,1,$schoolid))) { ?>
		$(".qx_1423").hide();
	<?php  } ?>



	
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>