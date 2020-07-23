<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-info">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' ||  (IsHasQx($tid_global,1000901,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kecheng') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kecheng', array('op' => 'display', 'schoolid' => $schoolid))?>">课程系统</a></li>
			<?php  } ?>
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' || (IsHasQx($tid_global,1000921,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kcbiao') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display', 'schoolid' => $schoolid))?>">课时管理</a></li>
			<?php  } ?>
			<li <?php  if($_GPC['do']=='kcsign') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcsign', array('op' => 'display', 'schoolid' => $schoolid))?>">签到管理</a></li>
			<?php  if((is_showgkk() && ((IsHasQx($tid_global,1000951,1,$schoolid)) || $tid_global =='founder'|| $tid_global == 'owner' ))) { ?>
			<li <?php  if($_GPC['do']=='gongkaike') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('gongkaike', array('op' => 'display', 'schoolid' => $schoolid))?>">公开课系统</a></li>
			<?php  } ?>
		</ul>	
	</div>
</div>
<?php  if($operation == 'display') { ?>
<div class="main">
    <style> .form-control-excel { height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075); -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s; -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; } </style>
    <div class="panel panel-info">
        <div class="panel-heading">签到管理</div>
        <div class="panel-body">
            <form action="./index.php" id="kcsignForm" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="kcsign" />
                <input type="hidden" name="TorS" value="<?php  echo $TorS;?>" />
				<input type="hidden" id="out_excel" name="out_excel" value="No" />
                <input type="hidden" name="is_confirm" value="<?php  echo $is_confirm;?>" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">教师/学生</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'], 'TorS' => '-1', 'is_confirm' => $is_confirm,'schoolid' => $schoolid))?>" class="btn <?php  if($TorS == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'], 'TorS' => '1','is_confirm' => $is_confirm,'schoolid' => $schoolid))?>" class="btn <?php  if($TorS == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">教师</a>
							<a href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'], 'TorS' => '2','is_confirm' => $is_confirm, 'schoolid' => $schoolid))?>" class="btn <?php  if($TorS == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">学生</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">确认状态</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'],'TorS'=>$TorS, 'is_confirm' => '-1', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_confirm == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'],'TorS'=>$TorS, 'is_confirm' => '1', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_confirm == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已确认</a>
							<a href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'],'TorS'=>$TorS, 'is_confirm' => '2', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_confirm == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未确认</a>
						</div>
					</div>
				</div>
				<div class="form-group">
				
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按课程名称</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="kcname" id="" type="text" value="<?php  echo $_GPC['kcname'];?>">
                    </div>
                    <?php  if($TorS !=2) { ?>
                  	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按教师名称</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="tname" id="" type="text" value="<?php  echo $_GPC['tname'];?>">
                    </div>
                    <?php  } ?>
                    <?php  if($TorS !=1) { ?>
                  	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按学生名称</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="sname" id="" type="text" value="<?php  echo $_GPC['sname'];?>">
                    </div>
                    <?php  } ?>											
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">签到时间</label>
					<div class="col-sm-2 col-lg-2">
						<?php  echo tpl_form_field_daterange('createtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
					<div class="col-sm-2 col-lg-2" style="margin-left:50px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>	
					<div class="col-sm-2 col-lg-2">						
						<a class="btn btn-success qx_943" onclick="GetOut();" ><i class="fa fa-qrcode">&nbsp;&nbsp;当前条件导出签到</i></a>
                    </div>
				</div>	
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
        <table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
                   <!-- <th class='with-checkbox' style="width: 10px;"><input type="checkbox" class="check_all" /></th>-->
					<th style="width:10px">签到人</th>
					<th style="width:50px;">签到课程</th>	
					<th style="width:20px;">签到课时</th>
					<th style="width:20px;">签到时间</th>
                    <th style="width:20px;">状态</th>						
					<th class="qx_e_d" style="text-align:right; width:50px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>

				<tr>
                    <!--<td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>-->
					<td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal">
					<?php  if($item['TorS'] == "S") { ?>
					<span class="label label-info">学生</span>
					<?php  } else if($item['TorS'] == "T") { ?>
					<span class="label label-success">老师</span>
					<?php  } ?>
					<?php  echo $item['username'];?>
					</td>
					<td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal"><?php  echo $item['kcname'];?></td>
                    <td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal"><?php  echo $item['ksname'];?></td>
					<td><?php  echo date("Y年m月d日 H时i分",$item['createtime'])?></td>

                    <td style="overflow:visible; word-break:break-all; text-overflow:visible;white-space:normal">
                    <?php  if($item['status'] == 1) { ?><span class="label label-default">未确认</span>
                    <?php  } else if($item['status'] ==2) { ?><span class="label label-warning">已确认</span>
                    <?php  } else if($item['status'] ==3) { ?><span class="label label-primary">已请假</span>
                    <?php  } ?>
                    </td>

					<td class="qx_e_d" style="text-align:right;">
						 <?php  if($item['status'] == 1) { ?>
                        <a class="btn btn-default btn-sm qx_942"
                           href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'], 'op' => 'queren', 'schoolid' => $schoolid))?>"
                            onclick="return confirm('是否确认签到？');return false;"
                           title="确认签到"><i class="fa fa-check"></i>
                        </a>
                        <?php  } ?>
						<?php  if(Keep_sk77() && $item['TorS'] == "S") { ?>
						<a class="btn btn-default btn-sm qx_942"
						   href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'], 'op' => 'post', 'schoolid' => $schoolid))?>"

						   title="修改课时"><i class="fa fa-pencil"></i>
						</a>

						<?php  } ?>
                        <a class="btn btn-default btn-sm qx_944" href="<?php  echo $this->createWebUrl('kcsign', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>"
                           onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除">
                            <i class="fa fa-times"></i>
                        </a>
					</td>
				</tr>

				<?php  } } ?>
			</tbody>
			<!--<tr>
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="button" class="btn btn-primary" name="btndeleteall" value="批量删除" />
				</td>
			</tr>-->
		</table>
        <?php  echo $pager;?>
        </div>
    </div>
</div>
<script type="text/javascript">
function GetOut(){
	$("#out_excel").val("Yes");
	document.forms.kcsignForm.submit();
	$("#out_excel").val("No");
};
	
	
var category = <?php  echo json_encode($children)?>;

$(function(){
	var e_d = 2 ;
	<?php  if(!(IsHasQx($tid_global,1000942,1,$schoolid))) { ?>
		$(".qx_942").hide();
		e_d = e_d -1  ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000943,1,$schoolid))) { ?>
		$(".qx_943").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000944,1,$schoolid))) { ?>
		$(".qx_944").hide();
		e_d = e_d -1  ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
    $(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        $("input[type=checkbox]").attr("checked",checked);
    });

    $("input[name=btndeleteall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要删除的课程!');
            return false;
        }
        if(confirm("确认要删除选择的课程?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('kcbiao', array('op' => 'deleteall', 'schoolid' => $schoolid))?>";
            $.post(url,{idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');
        }
    });

});
</script>
<?php  } else if($operation = 'post') { ?>
<div class="panel panel-info">
	<div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回</a></div>
</div>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $id;?>" />
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
		<div class="panel panel-default">
			<div class="panel-heading">
				修改签到信息
			</div>
			<div class="panel-body">
				<?php  if(!empty($SignDetail['sid']) || empty($SignDetail['tid'])) { ?>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生姓名:</label>
					<div class="col-sm-2 col-lg-2" style="color:red;">
						<input type="text" class="form-control" value="<?php  echo $student['s_name'];?>" disabled>
					</div>
				</div>

				<?php  } else if(empty($SignDetail['sid']) || !empty($SignDetail['tid'])) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">教师姓名:</label>
					<div class="col-sm-2 col-lg-2" style="color:red;">
						<input type="text" class="form-control" value="<?php  echo $teacher['tname'];?>" disabled>
					</div>
				</div>
				<?php  } ?>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">签到课程</label>
					<div class="col-sm-3 col-lg-3">
						<select class="form-control" name="signkc" id="signkc">
							<?php  if(is_array($kclist)) { foreach($kclist as $row) { ?>
							<option value="<?php  echo $row['id'];?>"  <?php  if($SignDetail['kcid'] == $row['id']) { ?> selected<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>

				<div class="form-group" id="ksDiv" style="<?php  if($SignDetail['type']  == 1) { ?>display:none<?php  } ?>">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">签到课时</label>
					<div class="col-sm-3 col-lg-3">
						<select class="form-control" name="signks" id="signKs">
							<?php  if(is_array($kslist)) { foreach($kslist as $row) { ?>
							<option value="<?php  echo $row['id'];?>"  <?php  if($SignDetail['ksid'] == $row['id']) { ?> selected<?php  } ?>>第<?php  echo $row['nub'];?>课</option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">签到时间</label>
					<div class="col-sm-9">
						<div class="input-group">
							<?php  echo tpl_form_field_date('signtime', date('Y-m-d H:i:s', $SignDetail['createtime']),true)?>
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
	$('#credit1').click(function(){
		$('#credit-status1').show();
		$('#credit-status2').hide();
		$("#credit1").attr("checked","checked" );
		$("#credit2").removeAttr("checked");
	});
	$('#credit2').click(function(){
		$('#credit-status2').show();
		$('#credit-status1').hide();
		$("#credit2").attr("checked","checked" );
		$("#credit1").removeAttr("checked");
	});


	$("#signkc").change(function () {
		console.log($(this).val())
 		let kcid = $(this).val()

		$.post("<?php  echo $this->createWebUrl('kcsign',array('op'=>'GetKsDetail','schoolid'=>$schoolid))?>", {'kcid': kcid}, function(data) {
			data = JSON.parse(data);
			classlevel = data.data;

			if(data.datatype == 0){
				var htmls = '';
				htmls += '<option value="">请选择课时</option>';
				if (classlevel != '') {
					for (var i in classlevel) {
						htmls += `<option value="${classlevel[i].id}">第${classlevel[i].nub}课</option>`;
					}
				}
				$('#signKs').html(htmls);
				$("#ksDiv").show();
			}else{
				$("#ksDiv").hide();
			}
		});

	})


</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>