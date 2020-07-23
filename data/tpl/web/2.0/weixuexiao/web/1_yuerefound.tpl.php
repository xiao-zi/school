<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
 
<ul class="nav nav-tabs">
    <?php  if(IsHasQx($tid_global,1004401,1,$schoolid) ) { ?>
    <li class="qx_2202 <?php  if($operation == 'display') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('yuerefound', array('op' => 'display', 'schoolid' => $schoolid))?>">退款记录</a></li>
    <?php  } ?>
    <?php  if(IsHasQx($tid_global,1004402,1,$schoolid) ) { ?>
    <li <?php  if($operation == 'cardrefound') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('yuerefound', array('op' => 'cardrefound', 'schoolid' => $schoolid))?>">刷卡退款</a></li>
    <?php  } ?>
</ul>
 <style>
.cLine { overflow: hidden; padding: 5px 0; color:#000000; }
.alert { padding: 8px 35px 0 10px; text-shadow: none; -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); background-color: #f9edbe; border: 1px solid #f0c36d; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; color: #333333; margin-top: 5px; }
.alert p { margin: 0 0 10px; display: block; }
.alert .bold{ font-weight:bold; }
 </style>

<?php  if($operation == 'display') { ?>
	<style>
		.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
	</style>
	<div class="main">
		<div class="panel panel-info">
			<div class="panel-heading">退费记录</div>
			<div class="panel-body">
				<form action="./index.php" method="post"  class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site" />
					<input type="hidden" name="a" value="entry" />
					<input type="hidden" name="m" value="weixuexiao" />
					<input type="hidden" name="do" value="chongzhi" />
					<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
					<input type="hidden" name="op" value="chongzhilog" />
				   <div class="form-group">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按学生姓名</label>
						<div class="col-sm-2 col-lg-2">
							<input class="form-control" name="stuname" type="text" value="<?php  echo $_GPC['stuname'];?>">
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
						<td  > <img style="width:50px;height:50px;border-radius:50%;" src="<?php  if(!empty($item['sicon'])) { ?><?php  echo tomedia($item['sicon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" width="50" style="border-radius: 3px;" /></br><?php  echo $item['s_name'];?></td>	
						
						<td  >
						   <?php  echo $item['bj_name'];?>
						</td>
						<td >
						   <?php  echo $item['nj_name'];?>       
						</td>
						<td  >
							<?php  if($item['cost'] < 0) { ?>
							<span class="label label-danger"><i class="fa fa-yen"></i><?php  echo $item['cost'];?></span>
							<?php  } else if($item['cost'] > 0) { ?>
							<span class="label label-primary"><i class="fa fa-yen"></i> <?php  echo $item['cost'];?></span>
							<?php  } ?>
						</td> 						

 
						<td  >
						 <?php  echo date("Y-m-d H:i:s",$item['createtime'])?>              
						</td>
						<td  >
							<span class="label label-primary"><?php  echo $item['cztname'];?></span>		   
						</td>


						<?php  if($tid_global == 'founder' || $tid_global == 'owner') { ?>
						<td style="text-align:right;" >
							<a class="btn btn-default btn-sm " href="<?php  echo $this->createWebUrl('yuerefound', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('该操作将删除学生该条退款记录,是否确认操作？');return false;" title="删除"><i class="fa fa-times"></i></a>
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
	
 
	
		
		$(".check_all").click(function(){
			var checked = $(this).get(0).checked;
			$("input[type=checkbox]").attr("checked",checked);
		});
	
		$("input[name=btndeleteall]").click(function(){
			var check = $("input[type=checkbox][class!=check_all]:checked");
			if(check.length < 1){
				alert('请选择要删除的退费记录!');
				return false;
			}
			if(confirm("确认要删除选择的退费记录?")){
				var id = new Array();
				check.each(function(i){
					id[i] = $(this).val();
				});
				var url = "<?php  echo $this->createWebUrl('yuerefound', array('op' => 'deleteall','schoolid' => $schoolid))?>";
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
<?php  } else if($operation == 'cardrefound') { ?>

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
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; }
        input[type="number"]{ -moz-appearance: textfield; }
        .form-control-excel { height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075); -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s; -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; }
    </style>
    <div class="panel panel-info">
        <div class="panel-heading">刷卡退费</div>
        <div class="panel-body">
            <div  class="form-horizontal original" >
                <form action="javascript:getdetail()"  method="get" class="form-horizontal" role="form">
                	
                
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
			
			$.post("<?php  echo $this->createWebUrl('yuerefound',array('op'=>'card_bot','schoolid'=>$schoolid))?>", {'stuCard': text }, function(data1) {	
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