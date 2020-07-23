<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($_GPC['do'] == 'city') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('city', array('op' => 'display'))?>">城市管理</a></li>
	<li <?php  if($_GPC['do'] == 'area') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('area', array('op' => 'display'))?>">区域管理</a></li>
</ul>
 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
<?php  if($operation == 'post') { ?>
<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('area', array('op' => 'display'))?>"><i class="fa fa-tasks"></i> 返回区域列表</a>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                区域编辑
            </div>
            <div class="panel-body">
                <?php  if(!empty($parent)) { ?>
                <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">所属城市</label>
					<div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="parentid" class="form-control">
                            <option value="0">请选择城市</option>
                            <?php  if(is_array($parent)) { foreach($parent as $it) { ?>
                                <option value="<?php  echo $it['id'];?>" <?php  if($it['id'] == $area['parentid']) { ?> selected="selected"<?php  } ?>><?php  echo $it['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="ssort" class="form-control" value="<?php  echo $area['ssort'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="catename" class="form-control" value="<?php  echo $area['name'];?>" />
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
        <div class="panel-body">
		    <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('area', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加区域</a>
            <a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i>刷新</a>
        </div>
    </div>
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th>归属城市</th>
						<th>区域名称</th>
                        <th style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($area)) { foreach($area as $row) { ?>
                    <tr>
						<td><div class="type-parent"><?php  echo $row['city'];?>&nbsp;&nbsp;</div></td>
                        <td><div class="type-parent"><?php  echo $row['name'];?>&nbsp;&nbsp;</div></td>
                        <td style="text-align:right;"><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('area', array('op' => 'post', 'id' => $row['id']))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('area', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php  } } ?>
                    <tr>
                        <td colspan="3">
                            <input name="submit" type="submit" class="btn btn-primary" value="批量更新排序">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>