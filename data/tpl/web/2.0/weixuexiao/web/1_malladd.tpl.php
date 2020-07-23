<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<ul class="nav nav-tabs">
    <li class="qx_2602 <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('malladd', array('op' => 'post', 'schoolid' => $schoolid))?>">新增商品</a></li>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('malladd', array('op' => 'display', 'schoolid' => $schoolid))?>">商品管理</a></li>
</ul>
 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
 <div class="cLine">
    <div class="alert">
    <p><span class="bold">使用方法：</span>    填写商品信息，,如 名称,缩略图,商品详情.... </br>   
   <strong><font color='red'>特别提醒:请谨慎操作!以免丢失数据!</font></strong></br></p>
    </div>
</div>
<?php  if($operation == 'display') { ?>
<div class="main">
   
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
					    <th style="width:100px;">序号</th>
                        <th>缩略图</th>
                    	<th>名称</th>
                    	<th>显示类型</th>
                    	<th>限购数量</th>
                    	<th>原价</th>
						<th>现价</th>
						<th>积分</th>
						<th>库存</th>
						<th>已售</th>
                        <th class="qx_e_d" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($allgoods)) { foreach($allgoods as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['sort'];?></div></td>
						<td><img src="<?php  echo tomedia($row['thumb'])?>" width="50"></td>
                        <td><div class="type-parent"><?php  echo $row['title'];?>&nbsp;</div></td>
                        <?php  if($row['showtype'] == 1) { ?>
                        <td><div class="type-parent"><span class="label label-danger">家长端</span></div></td>
                        <?php  } else if($row['showtype'] == 0) { ?>
                        <td><div class="type-parent"><span class="label label-info">教师端</span></div></td>
                        <?php  } else if($row['showtype'] == 2) { ?>
                        <td><div class="type-parent"><span class="label label-warning">两者都显示</span></div></td>
                        <?php  } ?>
                        <?php  if($row['xsxg'] != 0 ) { ?>
                        <td><div class="type-parent"><?php  echo $row['xsxg'];?></div></td>
                        <?php  } else if($row['xsxg'] == 0 ) { ?>
                        <td><div class="type-parent"><span class="label label-success">无限制</span></div></td>
                        <?php  } ?>
                        <td><div class="type-parent"><?php  echo $row['old_price'];?></div></td>
						<td><div class="type-parent"><?php  echo $row['new_price'];?></div></td>
						<td><span class="type-parent"><?php  echo $row['points'];?></span></td>
						<td><span class="type-parent"><?php  echo $row['tqty'];?></span></td>
						<td><span class="type-parent"><?php  echo $row['tsold'];?></span></td>
						
                        <td style="text-align:right;"><a class="btn btn-default btn-sm qx_2602" href="<?php  echo $this->createWebUrl('malladd', array('op' => 'post', 'goodsid' => $row['id'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_2603" href="<?php  echo $this->createWebUrl('malladd', array('op' => 'delete', 'goodsid' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除该商品？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<script>
$(function(){
	var e_d = 2 ;
	<?php  if((!(IsHasQx($tid_global,1002602,1,$schoolid)))) { ?>
		$(".qx_2602").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002603,1,$schoolid)))) { ?>
		$(".qx_2603").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
});
require(['jquery', 'util', 'bootstrap.switch'], function($, u){

	$(':checkbox[name="is_on[]"]').bootstrapSwitch();
	$(':checkbox[name="is_on[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_on = this.checked ? 1 : 2;
		var id = $(this).data('id');
		$.post("<?php  echo $this->createWebUrl('theclass', array('op' => 'change','schoolid' => $schoolid))?>", {is_on: is_on, id: id}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});
});
</script>
<?php  } else if($operation == 'post') { ?>
<div class="panel panel-info">
    <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回商品管理</a></div>
</div>
<div class="main">
	<form action="" method="post" class="form-horizontal form"	enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-body" >
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>商品名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="gtitle" class="form-control" value="<?php  echo $goods['title'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>排序:</label>
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="text" name="gsort" class="form-control" value="<?php  echo $goods['sort'];?>" />
                        </div>
				    </div>
			    </div>
			    <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>显示类型:</label>
                     <div class="col-sm-9 col-lg-2" >
						<select style="margin-right:15px;" id="showtype" name="showtype" class="form-control">
							<option value="1" <?php  if($goods['showtype'] == 1) { ?> selected="selected"<?php  } ?>>仅显示家长端</option>
							<option value="0" <?php  if($goods['showtype'] == 0) { ?> selected="selected"<?php  } ?>>仅显示教师端</option>
							<option value="2" <?php  if($goods['showtype'] == 2) { ?> selected="selected"<?php  } ?>>两者都显示</option>		
						</select>
					</div>
				</div>
				<div class="form-group" id="xsxgdiv"  style="display: none;">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">允许学生购买数量:</label>
                     <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
						<input type="text" name="xsxg" class="form-control" value="<?php  echo $goods['xsxg'];?>" />
						<div class="help-block">为零或不填则表示无限制 </div>
                        </div>
				    </div>
			    </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>商品缩略图</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_multi_image('gthumb', $imagearr)?>
						<div class="help-block">图片尺寸必须为400*400 </div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>商品描述</label>
					<div class="col-sm-9">
					   <?php  echo tpl_ueditor('gcontent', $goods['content']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>价格</label>
                   	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">原价:</label>
                    <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
							<input type="text" name="gold_price" class="form-control" value="<?php  echo $goods['old_price'];?>" />
                        </div>
				    </div>
                  	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">现价:</label>
                    <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
							<input type="text" name="gnew_price" class="form-control" value="<?php  echo $goods['new_price'];?>" />
						</div>
                    </div>
                    <label id="jflabel" class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">积分:</label>
                    <div  id="jfdiv" class="col-sm-2 col-lg-2" >
				        <div class="input-group">
							<input type="text" name="gpoint" class="form-control" value="<?php  echo $goods['points'];?>" />
						</div>
                    </div>
			    </div>	
			    <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                  	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">基础库存:</label>
                    <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
							<input type="text" name="gqty" class="form-control" value="<?php  echo $goods['qty'];?>" />
                        </div>
				    </div>
				    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">基础已售:</label>
                    <div class="col-sm-2 col-lg-2">
				        <div class="input-group">
							<input type="text" name="gsold" class="form-control" value="<?php  echo $goods['sold'];?>" />
                        </div>
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

<script type="text/javascript">
	<?php  if(!empty($goods['showtype'])) { ?>
	$(function(){
		if(<?php  echo $goods['showtype'];?> == 0 ){
			$("#xsxgdiv").hide();
		}else{
			$("#xsxgdiv").show();
		}
	})
	<?php  } ?>
	$("#showtype").change(function() {
		var selectType = $("#showtype option:selected").attr('value');
		if( selectType == 1 || selectType == 2){
			$("#xsxgdiv").show();
		}else{
			$("#xsxgdiv").hide();
		}
	});	
$(".check_all").click(function(){
	var checked = $(this).get(0).checked;
	$("input[type=checkbox]").attr("checked",checked);
});
</script>
<?php  } ?>