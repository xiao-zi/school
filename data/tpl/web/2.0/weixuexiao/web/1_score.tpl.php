<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
    <div class="panel panel-info">
        <div class="panel-body">
           <?php  echo $this -> set_tabbar($action1, $schoolid, $_W['role'], $_W['isfounder'], $_W['schooltype']);?>
        </div>
    </div>
<ul class="nav nav-tabs">
    <li class="qx_edit <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('score', array('op' => 'post', 'schoolid' => $schoolid))?>">添加<?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?></a></li>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('score', array('op' => 'display', 'schoolid' => $schoolid))?>"><?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>管理</a></li>
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
<div class="cLine">
    <div class="alert">
    <p><span class="bold">使用方法：</span>
   填写<?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>,如 一诊,第一次月考,第二次月考....<br/>
   <strong><font color='red'>特别提醒: 当你删除该<?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>项的时候,该<?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>项下相关的所有数据都会被删除,请谨慎操作!以免丢失数据!</font></strong>
    </p>
    </div>
</div>
<?php  if($operation == 'post') { ?>
<style>
.subject_check{margin-top: 5px !important}
.checkbox-inline{width:100px;margin-left: 10px;}
</style>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" />
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>分类编辑编辑
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="ssort" class="form-control" value="<?php  echo $score['ssort'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span><?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="catename" class="form-control" value="<?php  echo $score['sname'];?>" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"> <span style="color:red">*</span> <?php  if(is_TestFz()) { ?>考试<?php  } else { ?>期号<?php  } ?>类型</label>
                    <div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="scoretype" id="scoretype" class="form-control">
							<option value="score" <?php  if($score['type'] == 'score') { ?> selected="selected"<?php  } ?>><?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?></option>
							<option value="xq_score" <?php  if($score['type'] == 'xq_score') { ?> selected="selected"<?php  } ?>>学期<?php  if(is_TestFz()) { ?>考试<?php  } else { ?>期号<?php  } ?></option>
						</select>
                    </div>
                </div>				
				<div class="form-group xq_score_type" <?php  if($score['type'] == 'xq_score') { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">起止日期</label>
						<div class="col-sm-9 col-xs-9 col-md-4">
							<div class="input-group clockpicker" style="margin-bottom: 15px">
								<?php  echo tpl_form_field_date('start', $score['sd_start'])?>
								<span class="input-group-addon" style="padding-left:10px">至</span>
								<?php  echo tpl_form_field_date('end', $score['sd_end'])?>
							</div>
						</div>
					</div>
				<div class="form-group score_type" <?php  if((empty($score['type']) || $score['type'] == 'score')  ) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?> >
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
                    <div class="col-sm-9">
                        <label for="isshow3" class="radio-inline"><input type="radio" name="qhtype" value="2" id="isshow3" <?php  if(!empty($score) && $score['qhtype'] == 2) { ?>checked="checked"<?php  } ?> /> 指定班级</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow4" class="radio-inline"><input type="radio" name="qhtype" value="1" id="isshow4"  <?php  if(empty($score['qhtype']) || $score['qhtype'] == 1) { ?>checked="checked"<?php  } ?> /> 全校可用</label>
                        <span class="help-block">指定班级或者设定为全校用</span>
                    </div>
                </div>
				<div id="credit-status1" class="score_type1" <?php  if($score['qhtype'] == 2) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择班级</label>
						<div class="col-sm-9 col-xs-6">
							<div class="input-group text-info">
								<label class="checkbox-inline"><input type="checkbox" class="check_all" id="check_all" />全选</label></br>
								<?php  if(is_array($banji)) { foreach($banji as $uni) { ?>
								<?php  $is = $this->uniarr($uniarr,$uni['sid']);?>
										<label for="uni_<?php  echo $uni['sid'];?>" class="checkbox-inline">
										<input id="uni_<?php  echo $uni['sid'];?>" type="checkbox" class="check_bj"  name="arr[]" value="<?php  echo $uni['sid'];?>"<?php  if(($is)) { ?>checked="checked"<?php  } ?>> <?php  echo $uni['sname'];?>
										</label>
								<?php  } } ?>
							</div>
							<div class="help-block">选择要应用到的班级</div>
						</div>
					</div>
				</div>
				

				<?php  if(is_showpf()) { ?>
				<div class="form-group score_type" <?php  if((empty($score['type']) || $score['type'] == 'score')  ) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?> >
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否考察</label>
                    <div class="col-sm-9">
                        <label  class="radio-inline"><input type="radio" name="is_review" value="1" id="is_review_Yes" <?php  if(!empty($score) && $score['is_review'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label  class="radio-inline"><input type="radio" name="is_review" value="0" id="is_review_No"  <?php  if(empty($score['qhtype']) || $score['is_review'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block">是否启用统计考察</span>
                    </div>
                </div>

				
				<div class="form-group review_div " <?php  if($score['is_review'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"> <span style="color:red">*</span> 考察比例</label>
                    <div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="review_p"  class="form-control">
							<option value="80" <?php  if($this_addinfo['review_per'] == '80') { ?> selected="selected"<?php  } ?>>80%</option>
							<option value="85" <?php  if($this_addinfo['review_per'] == '85') { ?> selected="selected"<?php  } ?>>85%</option>
							<option value="90" <?php  if($this_addinfo['review_per'] == '90') { ?> selected="selected"<?php  } ?>>90%</option>
							<option value="95" <?php  if($this_addinfo['review_per'] == '95') { ?> selected="selected"<?php  } ?>>95%</option>
							<option value="100" <?php  if(($this_addinfo['review_per'] == '100' || empty($this_addinfo['review_per']))) { ?> selected="selected"<?php  } ?>>100%</option>
							
						</select>
                    </div>
                </div>
					
				<div class=" review_div" <?php  if($score['is_review'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择考察科目</label>
						<div class="col-sm-9 col-xs-6">
							<div class="input-group text-info">
								<label class="checkbox-inline"><input type="checkbox" class="check_all" style="margin-top: 5px" id="chack_allsubject" />全选</label></br>
								<?php  if(is_array($subject)) { foreach($subject as $uni) { ?>
								
								<label for="uni_<?php  echo $uni['sid'];?>" class="checkbox-inline ">
								<input id="uni_<?php  echo $uni['sid'];?>" type="checkbox" class="subject_check" name="sub_arr[]" value="<?php  echo $uni['sid'];?>" <?php  if((in_array( $uni['sid'],$this_subjectarr))) { ?>checked="checked"<?php  } ?> > <?php  echo $uni['sname'];?>
								</label>
								<?php  } } ?>
							</div>
							<div class="help-block">选择要考察的科目</div>
						</div>
					</div>
				</div>
				<?php  } ?>
				
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
	
	
	$("#scoretype").change(function(){
        var type = $(this).val();
		if(type == 'score'){
			$(".score_type").show();
			$(".xq_score_type").hide();
		}else if(type == 'xq_score'){
			$(".score_type").hide(); 
			$("#isshow4").prop("checked",true); 
			$("#isshow3").prop("checked",false); 
			$("#is_review_No").prop("checked",true); 
			$("#is_review_Yes").prop("checked",false); 
			$(".score_type1").hide(); 
			$(".review_div").hide();
			$(".xq_score_type").show();
		}
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
                        <th><?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?>名称</th>
						<th style="width:10%;"><?php  if(is_TestFz()) { ?>考试<?php  } else { ?>期号<?php  } ?>类型</th>
						<th style="width:14%;text-align:center">备注</th>
                        <th class="qx_e_d" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($score)) { foreach($score as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['sid'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['sname'];?>&nbsp;&nbsp;</div></td>
						<?php  if($row['type'] == 'score') { ?>
						<td><div class="type-parent"><span class="label label-success"><?php  if(is_TestFz()) { ?>考试<?php  } else { ?>成绩期号<?php  } ?></span></div></td>
						<td style="text-align:center">
							<div class="type-parent">
							<?php  if($row['qhtype'] == 1) { ?>
								<span class="label label-primary">全校可用</span>
							<?php  } else { ?>
								<span class="label label-info">指定班级</span>
							<?php  } ?>
							</div>
						</td>
						<?php  } else if($row['type'] == 'xq_score' ) { ?>
						<td><div class="type-parent"><span class="label label-info">学期<?php  if(is_TestFz()) { ?>考试<?php  } else { ?>期号<?php  } ?></span></div></td>
						<td  style="text-align:center">
							<div class="type-parent">
								<span class="label label-info"><?php  echo date("Y-m-d",$row['sd_start'])?></span> 至 
								<span class="label label-info"><?php  echo date("Y-m-d",$row['sd_end'])?></span>
							</div>
						</td>
						<?php  } ?>
						
                        <td style="text-align:right;" class="qx_e_d"><a class="btn btn-default btn-sm qx_edit" href="<?php  echo $this->createWebUrl('score', array('op' => 'post', 'sid' => $row['sid'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_delete" href="<?php  echo $this->createWebUrl('score', array('op' => 'delete', 'sid' => $row['sid'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
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
<script type="text/javascript">
$(document).ready(function() {
	var e_d = 2 ;
	<?php  if(!(IsHasQx($tid_global,1000232,1,$schoolid))) { ?>
		$(".qx_edit").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000233,1,$schoolid))) { ?>
		$(".qx_delete").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
});	
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>