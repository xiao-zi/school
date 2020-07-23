<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<ul class="nav nav-tabs">
	
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('shoucelist', array('op' => 'display', 'schoolid' => $schoolid))?>"><?php  echo $logo['shoucename'];?></a></li>
    <?php  if((IsHasQx($tid_global,1001111,1,$schoolid))) { ?>
	<li <?php  if($_GPC['do'] == 'shouceset') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('shouceset', array('op' => 'display', 'schoolid' => $schoolid))?>">评价分类</a></li>
	<li <?php  if($_GPC['do'] == 'shouceset' && $operation =='pylist') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('shouceset', array('op' => 'pylist', 'schoolid' => $schoolid))?>">评语库</a></li>
	<?php  } ?>
</ul>
 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
<div class="cLine">
    <div class="alert">
    <p><span class="bold">使用方法：</span>请先设置评价分类和评语库</br>   
   <strong><font color='red'>特别提醒: 当你删除该项的时候,该项下相关的所有数据都会被删除,请谨慎操作!以免丢失数据!</font></strong></br>
   <strong><font style="color:#641DBF;">素材请查看群文件，（评语系统素材）!</font></strong>
    </p>
    </div>
</div>
<?php  if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="shoucelist" />
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <div class="form-group">
                    <label class="col-sm-1 control-label">关键字</label>
                    <div class="col-sm-2">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>
					<label class="col-sm-1 control-label">按班级</label>
                    <div class="col-sm-2">
                        <select style="margin-right:15px;" name="bj_id" class="form-control">
                            <option value="0">请选择班级搜索</option>
                            <?php  if(is_array($allbj)) { foreach($allbj as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<label class="col-sm-1 control-label">按期号</label>   
                    <div class="col-sm-2">
                        <select style="margin-right:15px;" name="xq_id" class="form-control">
                            <option value="0">请选择期号搜索</option>
                            <?php  if(is_array($allxq)) { foreach($allxq as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['xq_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>	            
                </div>   
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
					    <th style="width:100px;">序号</th>
						<th>所属学期</th>
						<th>所属班级</th>
                        <th>名称</th>
						<th>评价规则</th>
						<th>代表时间</th>
						<th>创建老师</th>
						<th>发送状况</th>
                        <th class="qx_1102" style="text-align:right;">删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['id'];?></div></td>
						<td><div class="type-parent"><?php  echo $row['xueqi'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['banji'];?>&nbsp;&nbsp;</div></td>
						<td><div class="type-parent"><?php  echo $row['title'];?></div></td>
					    <td>
							<img style="width:50px;height:50px;border-radius:50%;" src="<?php  if(!empty($row['gzicon'])) { ?><?php  echo tomedia($row['gzicon'])?><?php  } ?>" width="50"  style="border-radius: 3px;" /></br></br><?php  echo $row['gzname'];?>
					    </td>
						<td><span class="label label-success"><?php  echo date('Y年m月d日',$row['starttime'])?>&nbsp;至&nbsp;<?php  echo date('Y年m月d日',$row['endtime'])?></span></td>
						<td><div class="type-parent"><?php  echo $row['tname'];?></div></td>
						<td><div class="type-parent"><?php  if($row['sendtype'] ==1) { ?>未发送<?php  } ?><?php  if($row['sendtype'] ==2) { ?>部分发送<?php  } ?><?php  if($row['sendtype'] ==3) { ?>全部发送<?php  } ?></div></td>
                        <td  class="qx_1102"  style="text-align:right;"><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('shoucelist', array('op' => 'delete', 'id' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php  } } ?>
                    <!--tr>
                        <td colspan="3">
                            <input name="submit" type="submit" class="btn btn-primary" value="批量更新排序">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </td>
                    </tr-->
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } ?>
<script type="text/javascript">
<?php  if((!(IsHasQx($tid_global,1001102,1,$schoolid)))) { ?>
	$(function(){
		$(".qx_1102").hide();
	});
<?php  } ?>
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>