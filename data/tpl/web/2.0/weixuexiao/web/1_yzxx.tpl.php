<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="./resource/components/switch/bootstrap-switch.min.css">
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />

 <style>
	 .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-primary, .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-primary {color: #fff;background: #a0053b;}

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

<?php  } else if($operation == 'display') { ?>

<div class="cLine">
    <div class="alert">
    <p><span class="bold">说明：</span>
  
    </p>
    </div>
</div>
<div class="panel panel-default">
	<div class="table-responsive panel-body">
		<table class="table">
			<thead>
				<tr>
					<!-- <th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th> -->
					<th style="width: 8%;">发送人</th>
					<th style="width: 8%;">接收人</th>
					<th style="width: 38%;">留言</th>		
					<th class="qx_1902" style="width: 38%;">回复</th>				 
					<th class="qx_e_d" style="text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<!-- <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td> -->
					<td>
						<?php  echo $item['sname'];?>
					</td>
					<td>
						<?php  echo $item['tname'];?>
					</td>
					<td>
						<?php  echo $item['beizhu'];?>
					</td>
					<td  class="qx_1902">
						<?php  if(empty($item['huifu'])) { ?>
						<textarea name="huifu"  id="huifu" style="resize: none;width: 100%;"></textarea>
						<?php  } else { ?>
								<?php  echo $item['huifu'];?>
						<?php  } ?>
					</td>										
					<td class="qx_e_d" style="text-align:right;">
						<?php  if(empty($item['huifu'])) { ?>
						<a class="btn btn-default btn-sm qx_1902"  onclick="huifu(<?php  echo $item['id'];?>)" title="回复"><i class="fa fa-pencil"></i></a>
						<?php  } ?>
						<a class="btn btn-default btn-sm qx_1903" href="<?php  echo $this->createWebUrl('yzxx', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除录？');return false;" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	var e_d = 2 ;
	<?php  if((!(IsHasQx($tid_global,1001902,1,$schoolid)))) { ?>
		$(".qx_1902").hide();
		e_d = e_d -1 ;
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1001903,1,$schoolid)))) { ?>
		$(".qx_1903").hide();
		e_d = e_d -1 ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
});
	function huifu(id){
		var huifu = $("#huifu").val();
		
			$.ajax({
				url: "<?php  echo $this->createWebUrl('indexajax', array('op' => 'huifu_mail'), true)?>",
				type: "post",
				dataType: "json",
				data: {
					id:id,
					huifu:huifu,
					schoolid:<?php  echo $schoolid;?>,
					weid:<?php  echo $weid;?>
				},
				success: function (data) {
					alert(data.msg);
					//console.log(data.msg);
					if(data.result == true){
						window.location.reload();
					}
				}
			});
	}
</script>
<?php  echo $pager;?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>