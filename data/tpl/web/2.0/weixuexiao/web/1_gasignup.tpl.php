<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="./resource/components/switch/bootstrap-switch.min.css?v=2018020415">
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
<div class="cLine">
    <div class="alert">
    <p><span class="bold">说明：</span>
  
    </p>
    </div>
</div>

<?php  if($operation == 'display') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		
         <div class="col-sm-2 col-lg-2">						
						<a class="btn btn-default " href="<?php  echo $this->createWebUrl('groupactivity', array('op' => 'display', 'schoolid' => $schoolid))?>" ><i class="fa fa-qrcode">&nbsp;&nbsp;返回集体活动列表</i></a>
                    </div>
                     <div class="col-sm-2 col-lg-2">						
						<a class="btn btn-success qx_1706" href="<?php  echo $this->createWebUrl('gasignup', array( 'op' => 'out_putcode', 'schoolid' => $schoolid,'gaid'=>$gaid,'weid'=>$weid))?>" ><i class="fa fa-qrcode">&nbsp;&nbsp;导出报名情况</i></a>
                    </div>	   
                
                   
               
            
	</div>
</div>

<div class="panel panel-default">
	<div class="table-responsive panel-body">
		<table class="table">
			<thead>
				<tr>
					
					<th>学生姓名</th>
					<th>所属班级</th>
					<th>家长姓名</th>
					<th>关系</th>
					<th >联系方式</th>
					<th >报名时间</th>
					
					<th class="qx_1704">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td>
						<?php  echo $item['sname'];?>
					</td>
					<td>
						<?php  echo $item['sbj'];?>
					</td>
					<td>
						
						<span class="label label-success"><?php  echo $item['username'];?></span>
						
					</td>
					<td>
						
						<span class="label label-danger"><?php  echo $item['pard'];?></span>
						
					</td>					
					<td>
						<span class="label label-info"><?php  echo $item['phone'];?></span>
					</td>
					<td>
						<span class="label label-info"><?php  echo date('Y-m-d h:i:s',$item['createtime'])?></span>
					</td>
										
					<td class="qx_1704">
						<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('gasignup', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<?php  echo $pager;?>
<?php  } ?>
<script type="text/javascript">
$(function(){
	<?php  if((!(IsHasQx($tid_global,1001704,1,$schoolid)))) { ?>
		$(".qx_1704").hide();
	<?php  } ?>

	<?php  if((!(IsHasQx($tid_global,1001706,1,$schoolid)))) { ?>
		$(".qx_1706").hide();
	<?php  } ?>
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>