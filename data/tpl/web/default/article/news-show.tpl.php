<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="notice-show ">
	<?php  if($do == 'list') { ?>
	<ul class="we7-page-tab">
		<li >
			<a href="<?php  echo url('article/notice-show/list');?>" >全部</a>
		</li>
		<li>
			<a href="<?php  echo url('article/news-show/list');?>" >新闻</a>
		</li>
		<li >
			<a href="<?php  echo url('article/notice-show/list');?>" >公告</a>
		</li>
	</ul>
	<div class="search-box we7-margin-bottom">
		<select name="" class="we7-margin-right">
			<option data-url="<?php  echo url('article/news-show/list');?>" >全部新闻</option>
			<?php  if(is_array($categroys)) { foreach($categroys as $key => $categroy) { ?>
				<?php  if($key) { ?>
				<option data-url="<?php  echo url('article/news-show/list', array('cateid' => $categroy['id']));?>" <?php  if($cateid == $categroy['id']) { ?> selected<?php  } ?>><?php  echo $categroy['title'];?></option>
				<?php  } ?>
			<?php  } } ?>
		</select>
	</div>
	<table class="tbale we7-table">
		<tr >
			<th>名称</th>
			<th>类型</th>
			<th>发布时间</th>
		</tr>
		<?php  if(!empty($data)) { ?>
		<?php  if(is_array($data)) { foreach($data as $da) { ?>
		<tr>
			<td>
				<a href="<?php  echo url('article/news-show/detail', array('id' => $da['id']));?>" target="_blank" class="text-over" style="<?php  if(!empty($da['style'])) { ?><?php  if(!empty($da['style']['color'])) { ?>color: <?php  echo $da['style']['color']?>;<?php  } ?><?php  if(!empty($da['style']['bold'])) { ?>font-weight:bold;<?php  } ?><?php  } ?>"><?php  echo $da['title'];?></a>
			</td>
			<td>新闻</td>
			<td><?php  echo date('Y-m-d', $da['createtime']);?></td>
		</tr>
		<?php  } } ?>
		<?php  } else { ?>
		<tr>
			<td colspan="3">
				<div class="we7-empty-block">暂无数据</div>
			</td>
		</tr>
		<?php  } ?>
	</table>
	<div class="pull-right">
		<?php  echo $pager;?>
	</div>
	<?php  } ?>
	<?php  if($do == 'detail') { ?>
	<div class="article-page">
		<ol class="breadcrumb we7-breadcrumb container">
			<a href="<?php  echo url('article/news-show/list');?>"><i class="wi wi-back-circle"></i></a>
			<li class="active"><a href="<?php  echo url('article/news-show/list');?>">新闻列表</a></li>
			<li class="active"><?php  echo $news['title'];?></li>
		</ol>
		<div class="container">
			<div class="article-box">
				<h2 class="title">
					<?php  echo $news['title'];?>
				</h2>
				<div class="info">
					<span>作者：<?php  echo $news['author'];?></span>
					<span>来源：<?php  echo $news['source'];?></span>
					<span>时间：<?php  echo date('Y-m-d H:i', $news['createtime']);?></span>
					<span>阅读：<?php  echo $news['click'];?>次</span>
				</div>
				<div class="article">
					<?php  echo html_entity_decode($news['content'], ENT_QUOTES)?>
				</div>
			</div>
		</div>
	</div>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
