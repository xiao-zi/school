<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
    <div class="panel panel-info">
        <div class="panel-body">
			<ul class="nav nav-tabs">

				<?php  if((IsHasQx($tid_global,1003801,1,$schoolid))) { ?>
				<li <?php  if($_GPC['do']=='uploadsence') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('uploadsence', array('op' => 'display', 'schoolid' => $schoolid))?>">场景管理</a></li>
				<?php  } ?>
				<?php  if((IsHasQx($tid_global,1003811,1,$schoolid))) { ?>
				<li <?php  if($_GPC['do']=='upsencerecord') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('upsencerecord', array('op' => 'display', 'schoolid' => $schoolid))?>">教师上传记录</a></li>
				<?php  } ?>
			</ul>
        </div>
    </div>
<ul class="nav nav-tabs">
	<?php  if((IsHasQx($tid_global,1003802,1,$schoolid))) { ?>
    <li class="qx_edit <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('uploadsence', array('op' => 'post', 'schoolid' => $schoolid))?>">添加场景</a></li>
	<?php  } ?>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('uploadsence', array('op' => 'display', 'schoolid' => $schoolid))?>">上传场景管理</a></li>
</ul>
 <style>
.cLine { overflow: hidden;padding: 5px 0;color:#000000;}
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

<?php  if($operation == 'post') { ?>

<style>
.subject_check{margin-top: 5px !important}
.checkbox-inline{width:100px;margin-left: 10px;}
</style>
<div class="cLine">
    <div class="alert">
    <p><span class="bold">使用方法：</span>
	填写场景名称,仅权限部门和管理员可查看教师上传内容....<br/>

    </p>
    </div>
</div>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
        <div class="panel panel-default">
            <div class="panel-heading">
                资料上传场景编辑
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>场景名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="sence_name" class="form-control" value="<?php  echo $senceinfo['name'];?>" />
                    </div>
                </div>
	
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"> <span style="color:red">*</span> 权限部门</label>
                    <div class="col-sm-2 col-lg-2">
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<select style="margin-right:15px;" name="sence_fzid" id="sence_fzid" class="form-control">
							<option value="0" >选择部门</option>
							<?php  if(is_array($jsfzlist)) { foreach($jsfzlist as $row_jsfz) { ?>
							<option value="<?php  echo $row_jsfz['sid'];?>" <?php  if($senceinfo['qxfzid'] == $row_jsfz['sid']) { ?> selected="selected"<?php  } ?>><?php  echo $row_jsfz['sname'];?></option>
							<?php  } } ?>
						</select>
						<?php  } else { ?>
							<?php  if(!empty($id)) { ?>
							<span class="form-control"  style="border:unset"><?php  echo $this_fz_post['sname'];?> </span>
							<input type="text" name="sence_fzid" class="form-control" value="<?php  echo $this_fz_post['sid'];?>" />
							<?php  } else { ?>
							<span class="form-control"  style="border:unset"><?php  echo $this_fz['sname'];?> </span>
							<input type="text" name="sence_fzid" class="form-control" value="<?php  echo $this_fz['sid'];?>" />
							<?php  } ?>
						<?php  } ?>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"> <span style="color:red">*</span> 场景日期</label>
                    <div class="col-sm-2 col-lg-2">
						<?php echo tpl_form_field_date('sence_date', date('Y-m-d', $senceinfo['sencetime']?$senceinfo['sencetime']:TIMESTAMP))?>
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
    $("#check_all").click(function(){
		if($(this).is(':checked')){
			$(".check_bj").prop("checked",true);
		}else{
			$(".check_bj").prop("checked",false);
		}
	});
    
	$(".check_bj").click(function(){
		var allChecked = true;
		$(".check_bj").each(function(){
			if($(this).prop("checked") == false){
				allChecked = false;
			};
		});
		if(allChecked){
			$("#check_all").prop("checked",true);
		}else{
			$("#check_all").prop("checked",false);
		}
	}); 
	
    $("#chack_allsubject").click(function(){
		if($(this).is(':checked')){
			$(".subject_check").prop("checked",true);
		}else{
			$(".subject_check").prop("checked",false);
		}
	});

	$(".subject_check").click(function(){
		var allChecked = true;
		$(".subject_check").each(function(){
			if($(this).prop("checked") == false){
				allChecked = false;
			};
		});
		if(allChecked){
			$("#chack_allsubject").prop("checked",true);
		}else{
			$("#chack_allsubject").prop("checked",false);
		}
	}); 
	   
	$("input[name=is_review]").click(function(){
	//alert($(this).val());
		if($(this).val() == 1){
			$(".review_div").show();
		}else{
			$(".review_div").hide();
			$(".subject_check").prop("checked",false);
			$("#chack_allsubject").prop("checked",false);
		}
	});
	   
	   
	$('#isshow3').click(function(){
		$('#credit-status1').show();
	});
	$('#isshow4').click(function(){
		$('#credit-status1').hide();
		$(".check_bj").prop("checked",false);
		 $("#check_all").prop("checked",false);
	});
	
	


	
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i>刷新</a>
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
                        <th>场景名称</th>
						<th style="width:10%;">权限部门</th>
						<th style="width:14%;text-align:center">场景时间</th>
                        <th class="qx_e_d" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
						<?php  if(is_array($sencelist)) { foreach($sencelist as $row) { ?>
						<tr>
							<td><div class="type-parent"><?php  echo $row['id'];?></div></td>
							<td><div class="type-parent"><?php  echo $row['name'];?>&nbsp;&nbsp;</div></td>
							<td><div class="type-parent"><span class="label label-success"><?php  echo $row['fzname'];?></span></div></td>
							<td style="text-align:center">
								<div class="type-parent">
									<span class="label label-info">
									<?php  echo date("Y-m-d",$row['sencetime'])?>
									</span>
								</div>
							</td>

							
							<td style="text-align:right;" class="qx_e_d"><a class="btn btn-default btn-sm qx_3802" href="<?php  echo $this->createWebUrl('uploadsence', array('op' => 'post', 'id' => $row['id'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_3803" href="<?php  echo $this->createWebUrl('uploadsence', array('op' => 'delete', 'id' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
						</tr>
						<?php  } } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var e_d = 2 ;
	<?php  if(!(IsHasQx($tid_global,1003802,1,$schoolid))) { ?>
		$(".qx_3802").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1003803,1,$schoolid))) { ?>
		$(".qx_3803").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
});	
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>