<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">平台设置</a></li>
</ul>
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
                <h3>学校分组 列表</h3>
            </div>
            <div class="form-group">
                <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('fenzu', array('op' => 'sync'))?>"><i class="fa fa-circle-o"></i> 同步微信</a>
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('fenzu', array('op' => 'post'))?>">创建新分组</a>
				<a class="btn btn-danger btn-sm" onclick="return confirm('此操作将仅删除本地分组数据，如需删除微信后台分组标签，请前往微信后台删除？');return false;" href="<?php  echo $this->createWebUrl('fenzu', array('op' => 'dellocal'))?>"><i class="fa fa-trash-o"></i>清空本地分组</a>
                <div class="form-group inline-form" style="display: inline-block;">
                    <form accept-charset="UTF-8" action="./index.php" class="form-inline" id="diandanbao/table_search" method="get" role="form">
                        <div style="margin:0;padding:0;display:inline">
                        <input name="utf8" type="hidden" value="✓"></div>
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="weixuexiao" />
                        <input type="hidden" name="do" value="fenzu" />
                        <input type="hidden" name="weid" value="<?php  echo $weid;?>" />
                        <div class="form-group">
                            <label class="sr-only" for="q_name">名称(分组名)</label>
                            <input class="form-control" id="keyword" name="keyword" placeholder="名称(分组名)" type="search">
                        </div>
                        <input class="btn btn-sm btn-success" name="commit" type="submit" value="搜索">
                    </form>
                </div>				
				<form action="" method="post" class="form-horizontal form" >
					<div class="table-responsive panel-body">
							<table class="table table-hover">
								<thead class="navbar-inner">
									<tr>
									    <th></th>
										<th>分组ID</th>
										<th style="width:300px;">所属学校</th>
										<th>分组名称</th>
										<th>粉丝数量</th>
										<th>创建时间</th>
										<th>二维码状态</th>
										<th style="text-align:right;">编辑/删除</th>
									</tr>
								</thead>
								<tbody id="level-list">
								<?php  if(is_array($fenzulist)) { foreach($fenzulist as $item) { ?>
									<tr>
									    <td>
										<img src="<?php  if(strstr($schoolinfo[$item['schoolid']]['logo'], 'http') || strstr($schoolinfo[$item['schoolid']]['logo'], './source/modules/')) { ?><?php  echo $schoolinfo[$item['schoolid']]['logo'];?><?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $schoolinfo[$item['schoolid']]['logo'];?><?php  } ?>" onerror="this.src='./resource/images/nopic.jpg';" width="45px;" style="border-radius: 3px;">
										</td>
										<td>
										<?php  if($item['group_id'] == 0) { ?><span class="label label-danger">系统分组</span>
										<?php  } else if($item['group_id'] == 1) { ?><span class="label label-danger">系统分组</span>
										<?php  } else if($item['group_id'] == 2) { ?><span class="label label-danger">系统分组</span>
										<?php  } else { ?><span class="label label-info"><?php  echo $item['group_id'];?></span>
										<?php  } ?>
										</td>
										<td><?php  echo $schoolinfo[$item['schoolid']]['title'];?></td>
										<td><?php  echo $item['name'];?></td>
										<td><?php  echo $item['count'];?></td>
										<td><?php  echo (date('Y-m-d h:m',$item['createtime']))?></td>
										<td><?php  if($item['group_id'] < 4) { ?><?php  } else { ?><?php  if($item['type'] == 0) { ?><span class="label label-danger"><i class="fa fa-times-circle">未生成</span><?php  } else { ?><span class="label label-success"><i class="fa fa-check-circle">已生成</i></span><?php  } ?><?php  } ?><?php  if($item['is_zhu'] ==1) { ?>&nbsp;<span class="label label-warning">主分组</span><?php  } ?></td>
										<td style="text-align:right;"><?php  if($item['group_id'] < 4) { ?><?php  } else { ?><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('fenzu', array('op' => 'post', 'id' => $item['id']))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('fenzu', array('op' => 'delete', 'group_id' => $item['group_id']))?>" onclick="return confirm('确认删除此分组吗？');return false;" title="删除"><i class="fa fa-times"></i></a><?php  } ?></td>
									</tr>
								<?php  } } ?>
								</tbody>
							</table>
							<?php  echo $pager;?>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="weid" value="<?php  echo $weid;?>" />
        <input type="hidden" name="id" value="<?php  echo $_GPC['id'];?>" />
		<input type="hidden" name="group_id" value="<?php  echo $reply['group_id'];?>" />
        <div class="panel panel-default">
		<?php  if($_W['isfounder']) { ?>
		    <div class="alert alert-success">
                温馨提示:</br>
				更多平台化设置方法，请参看微教育商业用户群文件视频教程
            </div>	
		<?php  } ?>	
            <div class="panel-heading">
                创建学校分组
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分组名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" value="<?php  echo $reply['name'];?>"  placeholder=""/>
                        <span class="help-block">例如：雅思教育、市一中</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">关联学校</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="schoolid" autocomplete="off" class="form-control">
                            <?php  if(is_array($schoollist)) { foreach($schoollist as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $reply['schoolid'] || $row['id'] == $schoolid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否主分组</label>
					<div class="col-sm-9 col-xs-12">
						<label class='radio-inline'>
							<input type='radio' name='is_zhu' value="1" <?php  if($reply['is_zhu']==1) { ?>checked<?php  } ?> /> 是
						</label>
						<label class='radio-inline'>
							<input type='radio' name='is_zhu' value="2" <?php  if($reply['is_zhu']==2 || !$reply) { ?>checked<?php  } ?> /> 否
						</label>
						<div class="help-block">每个学校只能设置一个，主分组创建的二维码将显示至学校管理首页右上角</div>
					</div>
				</div>				
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分组描述</label>
                    <div class="col-sm-9">
                        <input type="text" name="group_desc" class="form-control" value="<?php  echo $reply['group_desc'];?>"  placeholder=""/>
                        <span class="help-block">选填</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="order" class="form-control" value="<?php  echo $reply['order'];?>" />
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>