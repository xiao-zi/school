<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
<script>
require(['bootstrap'],function($){
	$('.btn,.tips').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script>
<div class="main">
<style>
.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}	
</style>
    <div class="panel panel-info">
        <div class="panel-heading">缴费订单列表</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="weixuexiao">
				<input type="hidden" name="do" value="payall"/>
				<input type="hidden" name="op" value="display"/>
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				<input type="hidden" name="is_pay" value="<?php  echo $_GPC['is_pay'];?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">支付状态</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="btn-group">
							<a href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'is_pay' => '-1', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_pay == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'is_pay' => '1', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_pay == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未支付</a>
							<a href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'is_pay' => '2', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_pay == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已支付</a>
							<a href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'is_pay' => '3', 'schoolid' => $schoolid))?>" class="btn <?php  if($is_pay == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已退费</a>
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按订单号搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="number" id="" type="text" value="<?php  echo $_GPC['number'];?>">
                    </div>						
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按真实订单号搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="uniontid" id="" type="text" value="<?php  echo $_GPC['uniontid'];?>">
                    </div>						
				</div>				
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按姓名搜索</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>						
				</div>				
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按订单类型</label>
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="type" class="form-control">
							<option value="">按付费类型搜索</option>
							<option value="1" <?php  if($_GPC['type'] == 1) { ?> selected="selected"<?php  } ?>>课程付费</option>
							<option value="3" <?php  if($_GPC['type'] == 3) { ?> selected="selected"<?php  } ?>>项目缴费</option>
							<option value="4" <?php  if($_GPC['type'] == 4) { ?> selected="selected"<?php  } ?>>报名付费</option>
							<option value="5" <?php  if($_GPC['type'] == 5) { ?> selected="selected"<?php  } ?>>考勤卡费</option>
							<option value="6" <?php  if($_GPC['type'] == 6) { ?> selected="selected"<?php  } ?>>商城订单</option>
							<option value="7" <?php  if($_GPC['type'] == 7) { ?> selected="selected"<?php  } ?>><?php  echo $school['videoname'];?></option>
							<option value="8" <?php  if($_GPC['type'] == 8) { ?> selected="selected"<?php  } ?>>余额充值</option>
							<?php  if(is_showap()) { ?>
							<option value="9" <?php  if($_GPC['type'] == 9) { ?> selected="selected"<?php  } ?>>充电桩充次</option>
							<?php  } ?>
						</select>	
					</div>					
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="obid" class="form-control">
							<option value="">按缴费项目搜索</option>
							<?php  if(is_array($allob)) { foreach($allob as $row) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['obid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
					<div class="col-sm-2 col-lg-2">
						<select name="vodid" class="form-control">
							<option value="">按视频名称搜索</option>
							<?php  if(is_array($allvod)) { foreach($allvod as $row) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['vodid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>	
					</div>					
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="paytype" class="form-control">
							<option value="">按支付类型搜索</option>
							<option value="1" <?php  if($_GPC['paytype'] == 1) { ?> selected="selected"<?php  } ?>>在线支付</option>
							<option value="2" <?php  if($_GPC['paytype'] == 2) { ?> selected="selected"<?php  } ?>>现金支付</option>
						</select>	
					</div>
					<div class="col-sm-2 col-lg-2">
						<select  name="kcid" class="form-control">
							<option value="">按课程名称搜索</option>
							<?php  if(is_array($allkc)) { foreach($allkc as $row) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['kcid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>	
					</div>
				</div>				
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">下单时间</label>
					<div class="col-sm-2 col-lg-2">
						<?php  echo tpl_form_field_daterange('createtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
					<div class="col-sm-2 col-lg-2" style="margin-left:50px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>	
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-success qx_2102" name="out_put" value="output"><i class="fa fa-download"></i>导出至EXECL</button>
					</div>
				</div>
			</form>
		</div>		
    </div>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
                    <th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th>
					<th style="width:3%">订单号 </th>
					<th style="width:2%">真实订单号 </th>
					<th style="width:8%">项目名</th>
					<th style="width:6%;">学生/老师</th>
					<th style="width:8%;">缴费人</th>
					<th style="width:15%;">付费时间</th>
                    <th style="width:5%;">金额</th>
					<th style="width:6%;">收款账户</th>
					<th style="width:5%;">支付状态</th>
					<th style="width:6%;">支付方式</th>
					<th style="width:6%;">支付类型</th>
					<th style="width:4%;">打印状态</th>
					<th class="qx_e_d" style="text-align:right; width:10%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
                    <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
					<td>
                       <?php  echo $item['id'];?>
                    </td>
					<td>
                       <?php  echo $item['uniontid'];?>
                    </td>					
					<td><?php  if($item['type'] == 8) { ?>余额充值</br>【<?php  echo $item['chongzhi'];?>】元 <?php  } else if($item['type'] == 9) { ?>充电桩充次</br>【<?php  echo $item['ksnum'];?>】次 <?php  } else if($item['type'] ==4) { ?>报名费<?php  } else if($item['type'] ==5) { ?>考勤卡费<?php  } else if($item['type'] ==6) { ?>商城订单<?php  } else if($item['type'] ==7) { ?><?php  echo $item['vodname'];?><?php  } else { ?><?php  echo $item['obname'];?><?php  echo $item['kcname'];?><?php  if($item['ksnum'] != 0 ) { ?></br>【含<?php  echo $item['ksnum'];?>课时】<?php  } ?><?php  } ?></td>	
					<td><span class="label label-danger"><?php  if($item['type'] !=4) { ?><?php  echo $item['s_name'];?><?php  } else { ?><?php  echo $item['signname'];?><?php  } ?></span></br><span class="label label-info"><?php  echo $item['bjname'];?></span></td>
					<td> 
						<?php  if(empty($item['realname']) &&  empty($item['mobile'])) { ?>
							<span class="label label-success">
							<?php  if($item['type'] == 4) { ?>
									<?php  if($item['signpard'] ==2) { ?>母亲<?php  } ?>
									<?php  if($item['signpard'] ==3) { ?>父亲<?php  } ?>
									<?php  if($item['signpard'] ==4) { ?>本人<?php  } ?>
							<?php  } ?>
							<?php  if($item['type'] == 6) { ?>
								<?php  if(!empty($item['t_name'])) { ?>
								本人: <?php  echo $item['t_name'];?>
								<?php  } else { ?>
									<?php  if(!empty($item['realname'])) { ?>
										<?php  if($item['pard'] ==2) { ?>母亲:<?php  } ?>
										<?php  if($item['pard'] ==3) { ?>父亲:<?php  } ?>
										<?php  if($item['pard'] ==4) { ?>本人:<?php  } ?>
										<?php  echo $item['realname'];?>
									<?php  } ?>
								<?php  } ?>
							<?php  } else { ?>
								<?php  if(!empty($item['realname'])) { ?>
									<?php  if($item['pard'] ==2) { ?>母亲:<?php  } ?>
									<?php  if($item['pard'] ==3) { ?>父亲:<?php  } ?>
									<?php  if($item['pard'] ==4) { ?>本人:<?php  } ?>
									<?php  echo $item['realname'];?>
								<?php  } ?>
							<?php  } ?>
							</span>
							<?php  if(!empty($item['mobile'])) { ?><?php  echo $item['mobile'];?><?php  } else { ?><?php  echo $item['signmob'];?><?php  } ?>
							<?php  if(!empty($item['t_phone'])) { ?> <?php  echo $item['t_phone'];?> <?php  } ?>
						<?php  } else { ?>
						<span class="label label-danger"><?php  echo $item['who'];?></span>
						<?php  } ?>
                    </td>
                    <td>
                        <?php  if(!empty($item['paytime'])) { ?><?php  echo date('Y年m月d日 H:i:s',$item['paytime'])?><?php  } ?>
                    </td>
                    <td>
                       ￥<?php  echo $item['cose'];?>
                    </td>
                    <td>
						<?php  if($item['pay_type'] == 'wxapp') { ?><span class="label label-danger">小程序</span></br></br><?php  } ?>
                       <?php  if($item['payweid']) { ?><span class="label label-success"><?php  echo $item['payweidname'];?></span><?php  } else { ?><span class="label label-success"><?php  echo $_W['account']['name'];?></span><?php  } ?>
                    </td>					
                    <td>
                       <?php  if($item['status'] == 1) { ?><span class="label label-warning">未支付</span><?php  } else if($item['status'] == 2) { ?><span class="label label-success"><i class="fa fa-cloud">已支付</i></span><?php  } else if($item['status'] == 3) { ?><span class="label label-danger">已退款</span></br><?php  if($item['refundid']) { ?><span class="label label-info">原路退回</span><?php  } ?><?php  } ?>
                    </td>
					<td><?php  if($item['pay_type']) { ?>
							<?php  if($item['pay_type'] == 'wechat') { ?>
								<span class="label label-success"><i class="fa fa-check-circle">&nbsp;微信支付</i></span>
							<?php  } else if($item['pay_type'] == 'alipay') { ?>
								<span class="label label-info"><i class="fa fa-alipay">&nbsp;支付宝</i></span>
							<?php  } else if($item['pay_type'] == 'baifubao') { ?>
								<span class="label label-warning"><i class="fa fa-money">&nbsp;百付宝</i></span>
							<?php  } else if($item['pay_type'] == 'unionpay') { ?>
								<span class="label label-success"><i class="fa fa-money">&nbsp;银联</i></span>	
							<?php  } else if($item['pay_type'] == 'cash') { ?>
								<span class="label label-success"><i class="fa fa-money">&nbsp;现金支付</i></span>
							<?php  } else if($item['pay_type'] == 'credit' || $item['pay_type'] == 'chongzhi'  ) { ?>
								<span class="label label-success"><i class="fa fa-money">&nbsp;余额支付</i></span>	
							<?php  } else if($item['pay_type'] == 'wxapp') { ?>
								<span class="label label-danger">&nbsp;小程序支付</i></span>								
							<?php  } else { ?>
								<span class="label label-warning">&nbsp;未支付</i></span>								
							<?php  } ?>
						<?php  } ?>
					</td>					
					<td><?php  if($item['paytype']) { ?>
							<?php  if($item['paytype'] == 1) { ?>
								<span class="label label-success"><i class="fa fa-check-circle">&nbsp;在线支付</i></span>
							<?php  } else if($item['paytype'] == 2) { ?>
								<span class="label label-warning"><i class="fa fa-money">&nbsp;现金支付</i></span>
							<?php  } else { ?>
								<span class="label label-warning">&nbsp;未支付</i></span>
							<?php  } ?>
						<?php  } ?>
					</td>
					<td><?php  if($item['print_nums']) { ?><?php  echo $item['print_nums'];?>次<?php  } else { ?>未打印<?php  } ?></td>
					<td class="qx_e_d"  style="text-align:right;">
						<a class="btn btn-default qx_03031" href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'op' => 'print', 'schoolid' => $schoolid))?>" onclick="return confirm('确认要打印本订单吗？');return false;" title="打印"><i class="fa fa-print"></i></a>
						<?php  if($item['status'] == 1) { ?>
						<a class="btn btn-default btn-sm  qx_2103" onclick="changePay(<?php  echo $item['id'];?>);" title="修改金额"><i class="fa fa-yen"></i></a>	
						<?php  } ?>
						
						<?php  if($item['ksnum'] == 0) { ?>
						<a class="btn btn-default btn-sm qx_2103" href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'op' => 'unpay', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认设为未付？');return false;" title="设置为未付"><i class="fa fa-money"></i></a>
						<?php  } ?>
						<?php  if(!($item['ksnum'] != 0 && ($item['type'] == 1 || $item['type'] == 9) && $item['status'] == 2 )  ) { ?>					
						<a class="btn btn-default btn-sm  qx_2103" href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'op' => 'pay', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认设为已付？');return false;" title="设置为已付"><i class="fa fa-money"></i></a>	
						<?php  } ?>	
						<?php  if(!($item['type'] == 9 || $item['type'] == 8) && $item['status'] != 3) { ?>
						<a class="btn btn-default btn-sm qx_2103" href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'op' => 'tuifei', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认退费？');return false;" title="退费"><i class="fa fa-reply"></i></a>
						<?php  } ?>
						<a class="btn btn-default btn-sm qx_2104" href="<?php  echo $this->createWebUrl('payall', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="button" class="btn btn-primary qx_2104" name="btndeleteall" value="批量删除" />
					<input type="button" class="btn btn-success qx_2103" name="btnpayall" value="批量付费" />
				</td>
			</tr>
		</table>
        <?php  echo $pager;?>
    </form>
        </div>
    </div>
</div>



<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:60px;z-index:2041 !important;">
	<div class="modal-dialog modal-lg" role="document" >		
		<div class="modal-content" >			
			<div class="modal-header" style="color: black;">					
				<h4 class="modal-title" id="ModalTitle">修改金额</h4>	
			</div>
			<div class="modal-body">
				 <form id="upsence_form" method="post" class="form-horizontal form" >
					<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单号</label>
								<div class="col-sm-9">
									<span style="margin-right:15px;border:unset"  id="orderid" class="form-control">
										订单号
									</span>
									<input type="hidden" style="margin-right:15px;" name="this_orderid" id="this_orderid" class="form-control">
								</div>
							</div>
							<div class="form-group">		
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单名称</label>
								<div class="col-sm-9">
									<span style="margin-right:15px;border:unset" id="ordername" class="form-control">
										订单名称
									</span>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生/老师</label>
								<div class="col-sm-9 col-xs-12">
									<span style="margin-right:15px;border:unset"  id="this_name" class="form-control">
										
									</span>

								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">原始金额</label>
								<div class="col-sm-2 col-xs-12">
									<span style="margin-right:15px;border:unset" id="oldcost" class="form-control">
										原始金额
									</span>
								</div>
								
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>修改金额</label>
								<div class="col-sm-2 col-xs-12">
									<input type="text" style="margin-right:15px;" name="change_cost" id="change_cost" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</form>		
			</div>				
			<div class="modal-footer">	
				<button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="submit2" onclick="sureChange()" >确认修改</button>
			</div>			
		</div>	
	</div>
</div>




<script type="text/javascript">
function changePay(id){
	$.post("<?php  echo $this->createWebUrl('payall',array('op'=>'getorderpayinfo','schoolid'=>$schoolid))?>",{orderid:id},function(data){
		if(data.status){
		console.log(data.order.id);
			$("#orderid").html(data.order.id);
			$("#this_orderid").val(data.order.id);
			$("#ordername").html(data.ordername);
			$("#oldcost").html(data.order.cose);
			$("#this_name").html(data.this_name);
		}
	},'json');
	$('#Modal1').modal('toggle'); 
}


function sureChange(){
	var this_orderid =$("#this_orderid").val();
	var newcost = $("#change_cost").val();
	$.post("<?php  echo $this->createWebUrl('payall',array('op'=>'changePay','schoolid'=>$schoolid))?>",{orderid:this_orderid,newcost:newcost},function(data){
		if(data.status){
			alert(data.msg);
			$("#close_modal").trigger('click');
			window.location.reload();
		}
	},'json');


}

//

$(function(){

	var e_d = 2 ;
	<?php  if((!(IsHasQx($tid_global,1002102,1,$schoolid)))) { ?>
		$(".qx_2102").hide();
		
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002103,1,$schoolid)))) { ?>
		$(".qx_2103").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1002104,1,$schoolid)))) { ?>
		$(".qx_2104").hide();
		e_d = e_d - 1 ;
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
            alert('请选择要删除的订单!');
            return false;
        }
        if(confirm("确认要删除选择的订单?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('payall', array('op' => 'deleteall','schoolid' => $schoolid))?>";
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

 	$("input[name=btnpayall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要操作的订单!');
            return false;
        }
        if(confirm("请选择要操作的订单?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('payall', array('op' => 'payallorder','schoolid' => $schoolid))?>";
            $.post(
                url,
                {idArr:id},
                function(data){
                    alert('成功修改支付状态!');
                    location.reload();
                },'json'
            );
        }
    });

});

 
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>