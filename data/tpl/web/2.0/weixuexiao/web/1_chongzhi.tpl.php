<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
 
<ul class="nav nav-tabs">
	<li class="qx_2202 <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'post', 'schoolid' => $schoolid))?>">添加套餐</a></li>
	<?php  if(IsHasQx($tid_global,1002201,1,$schoolid) ) { ?>
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'display', 'schoolid' => $schoolid))?>">套餐管理</a></li>
	<?php  } ?>
	<?php  if(IsHasQx($tid_global,1002211,1,$schoolid) ) { ?>
	<li <?php  if($operation == 'chongzhilog') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'chongzhilog', 'schoolid' => $schoolid))?>">充值记录</a></li>
	<?php  } ?>
	<?php  if(IsHasQx($tid_global,1002221,1,$schoolid) ) { ?>
	<li <?php  if($operation == 'cardchongzhi') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'cardchongzhi', 'schoolid' => $schoolid))?>">刷卡充值</a></li>
	<?php  } ?>
</ul>
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

<?php  if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />

         <div class="panel panel-default">
            <div class="panel-heading"> 充值套餐分类编辑</div>
            <div class="panel-body">
				<div id="custom-url">
				<?php  if(!empty($id)) { ?>
					<input type="hidden" name="old" value="111" />
					<div class="form-group">
						<label class="col-sm-2" style="width:5%">排序</label>
						<div class="col-sm-2 col-lg-2">
							<input type="text" name="ssort" placeholder="排序" class="form-control" value="<?php  echo $chongzhi['ssort'];?>" />
						</div>
						<label class="col-sm-2" style="width:10%"></label>
						<label class="col-sm-2" style="width:8%">应付金额</label>
						<div class="col-sm-2 col-lg-2" style="width:10%">
							<input type="text" name="should_pay" placeholder="应付金额" class="form-control" value="<?php  echo $chongzhi['cost'];?>" />
						</div>
						<label class="col-sm-2" style="width:10%"></label>
						<label class="col-sm-2" style="width:8%">增加余额</label>
						<div class="col-sm-2 col-lg-2" style="width:10%">
							<input type="text" name="addNum" placeholder="增加余额" class="form-control" value="<?php  echo $chongzhi['chongzhi'];?>" />
						</div>
					</div>
				<?php  } else { ?>
					<input type="hidden" name="new[]" value="111" />
					<div class="form-group">
						<label class="col-sm-2" style="width:5%">排序</label>
						<div class="col-sm-2 col-lg-2">
							<input type="text" name="ssort_new[]" placeholder="排序" class="form-control" value="" />
						</div>
						<label class="col-sm-2" style="width:10%"></label>
						<label class="col-sm-2" style="width:8%">应付金额</label>
						<div class="col-sm-2 col-lg-2" style="width:10%">
							<input type="text" name="should_pay_new[]" placeholder="应付金额" class="form-control" value="" />
						</div>
						<label class="col-sm-2" style="width:10%"></label>
						<label class="col-sm-2" style="width:8%">增加余额</label>
						<div class="col-sm-2 col-lg-2" style="width:10%">
							<input type="text" name="addNum_new[]" placeholder="增加余额" class="form-control" value="" />
						</div>
						
					</div>				
				<?php  } ?>	
                </div>	
				<div class="clearfix template"> 
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
						<div class="col-sm-9 col-xs-12">
							<a href="javascript:;" id="custom-url-add"><i class="fa fa-plus-circle"></i> 添加套餐</a>
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
<script>
	$('#custom-url-add').click(function(){
	var html =  '<div class="form-group">'+
				'<input type="hidden" name="new[]" value="111" />	'+
				'		<label class="col-sm-2" style="width:5%">排序</label>'+
				'		<div class="col-sm-2 col-lg-2">'+
				'			<input type="text" name="ssort_new[]" placeholder="排序" class="form-control" value="" />'+
				'		</div>'+
				'		<label class="col-sm-2" style="width:10%"></label>'+
				'		<label class="col-sm-2" style="width:8%">应付金额</label>'+
				'		<div class="col-sm-2 col-lg-2" style="width:10%">'+
				'			<input type="text" name="should_pay_new[]" placeholder="应付金额" class="form-control" value="" />'+
				'		</div>'+
				'		<label class="col-sm-2" style="width:10%"></label>'+
				'		<label class="col-sm-2" style="width:8%">增加余额</label>'+
				'		<div class="col-sm-2 col-lg-2" style="width:10%">'+
				'			<input type="text" name="addNum_new[]" placeholder="增加余额" class="form-control" value="" />'+
				'		</div>'+
				'	<div class="col-sm-1" style="margin-top:5px">'+
				'   	<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i></a>'+
				'	</div>'+
				'</div>';
			;
	$('#custom-url').append(html);
});
$(document).on('click', '.custom-url-del', function(){
	$(this).parent().parent().remove();
	return false;
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
					    <th style="width:100px;">排序</th>
                        <th>应付金额</th>
                        <th>增加余额</th>
                        <th class="qx_e_d" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['ssort'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['cost'];?>&nbsp;&nbsp;</div></td>
                        <td><div class="type-parent"><?php  echo $row['chongzhi'];?>&nbsp;&nbsp;</div></td>
                        <td class="qx_e_d" style="text-align:right;"><a class="btn btn-default btn-sm qx_2202" href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'post', 'id' => $row['id'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_2203" href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'delete', 'id' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除此套餐吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
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
<?php  } else if($operation == 'chongzhilog') { ?>
	<style>
		.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
	</style>
	<div class="main">
		<div class="panel panel-info">
			<div class="panel-heading">充值记录</div>
			<div class="panel-body">
				<form action="./index.php" method="post"  class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="weixuexiao" />
					<input type="hidden" name="do" value="chongzhi" />
					<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
					<input type="hidden" name="op" value="chongzhilog" />
					<?php  if(IsHasQx($tid_global,1002212,1,$schoolid) ) { ?>
					<div class="form-group" style="margin-left: 50px">
						<a class="btn btn-success qx_703" href="javascript:;" onclick="$('#upload_list').slideToggle();$('#download_list').slideUp();">批量充值</a>
					</div>
					<?php  } ?>


					<?php  if($_GPC['lrz'] == 'lrz' ) { ?>
					<div class="form-group" style="margin-left: 50px">
						<a class="btn btn-success qx_703" href="javascript:;" onclick="$('#upload_list1').slideToggle();">批量充值1</a>
					</div>
					<?php  } ?>
				   <div class="form-group">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按学生姓名</label>
						<div class="col-sm-2 col-lg-2">
							<input class="form-control" name="stuname" type="text" value="<?php  echo $_GPC['stuname'];?>">
						</div>	
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按类型</label>
						<div class="col-sm-2 col-lg-2">
								<select style="margin-right:15px;" name="add_cut_type" class="form-control">
									<option value="0">不限</option>
									<option value="1" <?php  if($_GPC['type'] == 1) { ?> selected="selected"<?php  } ?>>增加余额</option>
									<option value="-1" <?php  if($_GPC['type'] == -1) { ?> selected="selected"<?php  } ?>>减少余额</option>
									 
								</select>	
							</div>
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">操作时间</label>
						<div class="col-sm-2 col-lg-2">
							<?php  echo tpl_form_field_daterange('createtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
						</div>
						<div class="col-sm-2 col-lg-2" style="margin-left:55px">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>
					</div>
					
				</form>
				<!-- href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'testexcel', 'id' => $row['id'], 'schoolid' => $schoolid))?>" -->
				<div class="form-group" style="margin-left: 50px">
					<a class="btn btn-success" onclick="$('#download_list').slideToggle();$('#upload_list').slideUp();" >导出充值汇总</a>
				</div>



	 
			</div>
		</div> 

 





		
		
		<div class="panel panel-default file-container" style="display:none;" id="download_list">
				<div class="panel-body">
					<form   method="get" class="form-horizontal" role="form">
							<input type="hidden" name="c" value="site" />
							<input type="hidden" name="a" value="entry" />
							<input type="hidden" name="m" value="weixuexiao" />
							<input type="hidden" name="do" value="chongzhi" />
							 <input type="hidden" name="op" value="DownExcel" />
							<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
							<label class="col-xs-12 col-sm-3 col-md-1 control-label">选择时间段</label>
							<div class="col-sm-2 col-lg-2">
								<?php  echo tpl_form_field_daterange('down_time', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
							</div>

							<div class="col-sm-2 col-lg-2" style="margin-left:55px">
								<button class="btn btn-primary"><i class="fa fa-download"></i> 确认导出</button>
							</div>
							<div class="col-sm-2 col-lg-2" style="margin-left:55px">
									<button name="isDetail" value="isDetail" class="btn btn-primary"><i class="fa fa-download"></i> 导出详细充值记录</button>
								</div>
					</form>
				</div>
			</div>





			<div class="panel panel-default file-container" style="display:none;" id="upload_list1">
				<div class="panel-body">
					<form  id="form">
										
						<input name="viewfile1" id="viewfile1" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
						<a class="btn btn-primary"><label for="unload1" style="margin: 0px;padding: 0px;">上传...</label></a>
						<input type="file" class="pull-left btn-primary span3" name="file" id="unload1" style="display: none;"
							   onchange="document.getElementById('viewfile1').value=this.value;this.style.display='none';">
						  <a class="btn btn-primary" onclick="submits('input_chongzhi_linshi','form');">导入数据</a>
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
						<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'downloadexcel', 'schoolid' => $schoolid))?>">下载导入模板</a>
					</form>
				</div>
			</div>




		<div class="panel panel-default file-container" style="display:none;" id="upload_list">
			<div class="panel-body">
				<form  id="form">
					<a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i> 刷新</a>				
					<input name="viewfile" id="viewfile" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
					<a class="btn btn-primary"><label for="unload" style="margin: 0px;padding: 0px;">上传...</label></a>
					<input type="file" class="pull-left btn-primary span3" name="file" id="unload" style="display: none;"
						   onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';">
					  <a class="btn btn-primary" onclick="submits('input_chongzhi','form');">导入数据</a>
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
					<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('chongzhi', array('op' => 'downloadexcel', 'schoolid' => $schoolid))?>">下载导入模板</a>
				</form>
			</div>
		</div>
		<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/excel_input', TEMPLATE_INCLUDEPATH)) : (include template('public/excel_input', TEMPLATE_INCLUDEPATH));?>
		<div class="panel panel-default">
				<div class="table-responsive panel-body">
					<div style="font-size: 16px;margin: 10px;">
						当前页面汇总金额 <span style="color:blue;font-weight: bold"><i class="fa fa-yen"></i> <?php  echo $AllCountPage;?></span> ；
						当前搜索条件汇总金额 <span style="color:red;font-weight: bold"><i class="fa fa-yen"></i><?php  echo $AllCount;?></span>
					</div>  
				</div>
			<div class="table-responsive panel-body">
			<form action="" method="get" class="form-horizontal form" enctype="multipart/form-data">
			<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<?php  if($tid_global == 'founder' || $tid_global == 'owner') { ?>
						<th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th>
						<?php  } ?>
						<th style="width:10%">学生</th>
						<th style="width:10%;">班级</th>
						<th style="width:10%;">年级</th>
						<th style="width:10%;">金额</th>
						<th style="width:10%;">类型</th>
						<th style="width:10%;">操作时间</th>
						<th style="width:10%;">操作员</th>
						<?php  if($tid_global == 'founder' || $tid_global == 'owner') { ?>
						<th style="text-align:right; width:8%;">删除</th>
						<?php  } ?>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<?php  if($tid_global == 'founder' || $tid_global == 'owner') { ?>
						<td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
						<?php  } ?>
						<td style="text-align:"> <img style="width:50px;height:50px;border-radius:50%;" src="<?php  if(!empty($item['sicon'])) { ?><?php  echo tomedia($item['sicon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" width="50" style="border-radius: 3px;" /></br><?php  echo $item['s_name'];?></td>	
						
						<td style="text-align:">
						   <?php  echo $item['bj_name'];?>
						</td>
						<td style="text-align:">
						   <?php  echo $item['nj_name'];?>       
						</td>
						<td style="text-align:">
							<?php  if($item['cost'] < 0) { ?>
							<span class="label label-danger"><i class="fa fa-yen"></i><?php  echo $item['cost'];?></span>
							<?php  } else if($item['cost'] > 0) { ?>
							<span class="label label-primary"><i class="fa fa-yen"></i> <?php  echo $item['cost'];?></span>
							<?php  } ?>
						</td> 						
						<td style="text-align:">
							<?php  if($item['on_offline'] == 2) { ?>
							<span class="label label-info">线下充值</span>	
							<?php  } else { ?>
							<?php  if($item['cost'] < 0) { ?>
							<span class="label label-danger" style="padding:7px 10px">减少余额</span>
							<?php  } else { ?>
							<span class="label label-primary" style="padding:7px 10px">增加余额</span>
							<?php  } ?>
								 
							
							<?php  } ?>
							
						</td> 
 
						<td style="text-align:">
						 <?php  echo date("Y-m-d H:i:s",$item['createtime'])?>              
						</td>
						<td style="text-align:">
							<?php  if($item['on_offline'] == 2) { ?>
							<span class="label label-info">线下充值</span>	
							<?php  } else { ?>
							<span class="label label-primary"><?php  echo $item['cztname'];?></span>		 
								 
							
							<?php  } ?>
						</td>
						<?php  if($tid_global == 'founder' || $tid_global == 'owner') { ?>
						<td style="text-align:right;" >
							<a class="btn btn-default btn-sm " href="<?php  echo $this->createWebUrl('chongzhi', array('id' => $item['id'], 'op' => 'deletechongzhilog', 'schoolid' => $schoolid))?>" onclick="return confirm('该操作将删除学生该条充值记录,是否确认操作？');return false;" title="删除"><i class="fa fa-times"></i></a>
						</td>
						<?php  } ?>
					</tr>
					<?php  } } ?>
				</tbody>

				<?php  if($tid_global == 'founder' || $tid_global == 'owner') { ?>
				<tr>
					<td colspan="10">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="button" class="btn btn-primary" name="btndeleteall" value="批量删除" />
					</td>
				</tr>
				<?php  } ?>

			</table>
			<?php  echo $pager;?>
		</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(function(){
	
		var e_d = 2 ;
		<?php  if(!(IsHasQx($tid_global,1003902,1,$schoolid))) { ?>
			$(".qx_3902").hide();
		<?php  } ?>
		<?php  if(!(IsHasQx($tid_global,1003903,1,$schoolid))) { ?>
			$(".qx_3903").hide();
		<?php  } ?>
	
		
		$(".check_all").click(function(){
			var checked = $(this).get(0).checked;
			$("input[type=checkbox]").attr("checked",checked);
		});
	
		$("input[name=btndeleteall]").click(function(){
			var check = $("input[type=checkbox][class!=check_all]:checked");
			if(check.length < 1){
				alert('请选择要删除的充值记录!');
				return false;
			}
			if(confirm("确认要删除选择的充值记录?")){
				var id = new Array();
				check.each(function(i){
					id[i] = $(this).val();
				});
				var url = "<?php  echo $this->createWebUrl('chongzhi', array('op' => 'deleteallchongzhilog','schoolid' => $schoolid))?>";
				$.post(
					url,
					{idArr:id},
					function(data){
						if(data.result){
							alert(data.msg);
							location.reload();
						}else{
							alert(data.msg);
						}
					},'json'
				);
			}
		});
	
	});
	
	
	
		$(document).ready(function() {
			$("#xq").change(function() {
				var cityId = $("#xq option:selected").attr('value');
				var type = 1;
				changeGrade(cityId, type, function() {
				});
			});		
		});	
		function changeGrade(gradeId, type) {
			//alert(cityId);
			var schoolid = "<?php  echo $schoolid;?>";
			var classlevel = [];
			//获取班次
			$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getbjlist'))?>", {'gradeId': gradeId, 'schoolid': schoolid}, function(data) {
			
				data = JSON.parse(data);
				classlevel = data.bjlist;
				
				var htmls = '';
				htmls += '<select id="bj_id"><option value="">请选择班级</option>';		
				if (classlevel != '') {
					for (var i in classlevel) {
						htmls += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
					}
				}
				$('#bj').html(htmls);		
			});
	
		}
	</script>





<?php  } else if($operation == 'cardchongzhi') { ?>

<script>
	require(['bootstrap'],function($){
		$('.btn,.tips').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
	</script>
	<div class="main" id="whole">
		<style>
		input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	}
	input[type="number"]{
	  -moz-appearance: textfield;
	}
			.form-control-excel {
				height: 34px;
				padding: 6px 12px;
				font-size: 14px;
				line-height: 1.42857143;
				color: #555;
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
				-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
				transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			}
		</style>
		<div class="panel panel-info">
			<div class="panel-heading">刷卡充值</div>
			<div class="panel-body">
				<div  class="form-horizontal original" >
				 <form action="javascript:getdetail()"  method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="weixuexiao" />
					<input type="hidden" name="do" value="cardchongzhi" />
					 <input type="hidden" name="op" value="card_bot" />
					<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
					
					<div class="form-group ">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">刷卡识别</label>
						<div class="col-sm-2 col-lg-2">
							<input class="form-control" name="stuCard" id="stuCard" autofocus="autofocus" type="number" >
						</div>
						<div class="col-sm-2 col-lg-2 newRecord" style="width:8%;display:none" >						
							<a class="btn btn-primary qx_602" onclick="recard();"  ><i class="fa fa-repeat"></i> 重新刷卡</a>
						</div>	
		
										
					</div>
				</form>	
	
				</div>
				
			</div>
		</div>
		 <div id="detail"></div> 
	   
	</div>
	 
	<script type="text/javascript">

	
	function recard(){
		$("#stuCard").val("");
		$("#stuCard").removeAttr("readonly");
		$("#stuCard").focus();
		$(".newRecord").hide();
		$('#detail').html('');
		$("#StuName").text("");
	 }

	
	function getdetail(){
		var text = $("#stuCard").val();
		$('#detail').html('');
		 $("#StuName").text(text);
		if(text != null && text != ''){
			$(".newRecord").show();
			
			$.post("<?php  echo $this->createWebUrl('chongzhi',array('op'=>'card_bot','schoolid'=>$schoolid))?>", {'stuCard': text }, function(data1) {	
				console.log(data1);
				$('#detail').html(data1);
			});
		}
	}
	$("#stuCard").blur(function () {  //当输入框失去焦点时执行的方法
		var text_auto = $('#stuCard').val();	 
		if(text_auto == null || text_auto == ''){
				$("#stuCard").focus();   
		}else{
			$("#stuCard").attr("readonly","readonly");
		}
	});
	 
	
	 
	
	</script>



<?php  } ?>
<script type="text/javascript">
$(function(){
	var e_d = 2 ;
	<?php  if((!(IsHasQx($tid_global,1002202,1,$schoolid)))) { ?>
		$(".qx_2202").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002203,1,$schoolid)))) { ?>
		$(".qx_2203").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>