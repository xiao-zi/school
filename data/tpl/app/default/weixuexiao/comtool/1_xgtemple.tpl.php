<?php defined('IN_IA') or exit('Access Denied');?><style>
.form-order>.form-line {
    margin-bottom: 5px;
}
</style>
	<div class="mask"></div>
	<div class="component-dialog dialog-order">
		<div class="component-dialog-title">续购课程</div>
		<div class="component-dialog-body">
			<form class="form-order" novalidate="novalidate">
				<div class="form-line">
					<div class="input-wrapper" style="border:none;">
						<span>课程名称:</span>
						<span style="font-weight:bold;"><?php  echo $item['name'];?></span>
					</div>
				</div>
				<div class="form-line">
					<div class="input-wrapper" style="border:none;">
						<span>续购价格:</span>
						<span style="font-weight:bold;color:#0ec78b">￥<?php  echo $item['RePrice'];?></span><span>/课时</span>
					</div>
				</div>
				<div class="form-line">
					<div class="input-wrapper" style="border:none;">
						<span>最低限购:</span>
						<span style="font-weight:bold;color:#ff0200"><?php  echo $item['ReNum'];?></span><span> 课时</span>
					</div>
				</div>
				<div class="form-line">
					<span style="padding:.8em;width:15%">购买课时:</span>
					<div class="gw_num">
						<em class="jian">-</em>
						<input type="number" min="<?php  echo $item['ReNum'];?>" max="{$item['AllNum'] - $ygks['ksnum']}" class="num1" id="NumOfKsxg" name="NumOfKsxg" value="<?php  echo $item['ReNum'];?>"/>
						<em class="jia">+</em>
					</div>
				</div>
				<?php  if($item['Point2Cost'] !=0 && $school['Is_point']==1) { ?>
				<div class="form-line" >
					<div class="input-wrapper" style="border:none;">
						<span> 我的积分:</span>
						<span><span style="font-weight:bold;color:#ff0200"><?php  echo $student['points'];?></span>积分</span>
					</div>
				</div>				
				<div class="form-line" >
					<div class="input-wrapper" style="border:none;">
						<span>抵用比例:</span>
						<?php  if($item['Point2Cost'] !=0) { ?>
						<span><span style="font-weight:bold;color:#ff0200"><?php  echo $item['Point2Cost'];?></span>积分/1元</span>
						<?php  } else { ?>
						<span id="StuPoint">不可抵用</span>
						<?php  } ?>
					</div>
				</div>
				<div class="form-line" >
					<div class="input-wrapper" style="border:none;">
						<span>是否抵用</span>
						<input style="width: 18%;margin: -8px;" id="is_p2c" class="weui_switch" type="checkbox" value="0"/>
						<input id="is_p2c_value" type="hidden" value="0">
					</div>
				</div>
				
				<div class="form-line is_show" style="display: none">
					<div class="input-wrapper" style="border:none;">
						<span>最低抵用:</span>
						<?php  if($item['MinPoint'] !=0) { ?>
						<span><span style="font-weight:bold;color:#ff0200"><?php  echo $item['MinPoint'];?></span>积分</span>
						<?php  } else { ?>
						<span>无限制</span>
						<?php  } ?>
					</div>
				</div>
				<div class="form-line is_show" style="display: none">
					<div class="input-wrapper" style="border:none;">
						<span>最高抵用:</span>
						<?php  if($item['MaxPoint'] !=0) { ?>
						<span><span style="font-weight:bold;color:#ff0200"><?php  echo $item['MaxPoint'];?></span>积分</span>
						<?php  } else { ?>
						<span>无限制</span>
						<?php  } ?>
					</div>
				</div>
				<div class="form-line is_show" style="display: none">
					<div class="input-wrapper" style="border:none;">
						<span>抵用积分:</span>
						<input type="number" placeholder="请输入抵用积分" id="PointNum" name="PointNum"  required="">
					</div>
				</div>
				<?php  } ?>
				<div class="form-line">
					<div class="input-wrapper" style="border:none;"></div>
				</div>
				<input type="hidden" name="sid" id="jfdy_sid" value="0">
				<input type="hidden" name="id" id="jfdy_id" value="0">
				<input type="hidden" name="spoint" id="jfdy_spoint" value="0">
				
				<input type="hidden" name="object_number" value="751895459">
				<input type="hidden" name="content_type" value="yunying.org_account">
				<div class="component-dialog-footer" style="display: flex;">
					<a type="button" class="btn-default btn" style="margin-left: 8%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;" onclick="closed()" >取消</a>
					<button type="button" class="btn-primary btn"  style="width:30%;margin-left: 18%;" data-opttype="yes" onclick="ksxg_ajax()">确定</button>
				</div>
			</form>
		</div>
		<div class="component-dialog-footer"></div>
	</div>
	<script>
	function ksxg_ajax(){
		var ksxgnum = $("#NumOfKsxg").val();
		var ReNum =<?php  echo $item['ReNum'];?>;
		var id = $("#userid").val();
		var RePrice =<?php  echo $item['RePrice'];?>;
		if(Number(<?php  echo $allnum;?>) - Number(<?php  echo $ygks['ksnum'];?>) >= ReNum ){
			if(Number(ksxgnum) < Number(ReNum) ){
				alert("抱歉，续购课时不得低于最低限制");
				$("#NumOfKsxg").val(ReNum);
				return;
			}
		}

		var count = $("#PointNum").val();
		var is_point = $("#is_p2c_value").val();
		var spoint =<?php  echo $stup;?>; 
		if (is_point != 0){
			//if(count> spoint){
			//	jTips("您的积分不足");
			//	return;
			//}
			if (count<<?php  echo $item['MinPoint'];?>){
				jTips("抵用积分不得低于最低抵用");
				return;
			}
			<?php  if(!empty($item['MaxPoint'])) { ?>
			if (count><?php  echo $item['MaxPoint'];?>){
				jTips("抵用积分不得高于最高抵用");
				return;
			}
			<?php  } ?>
		}
		
		$.ajax({
			url: "<?php  echo $this->createMobileUrl('payajax', array('op' => 'xgks'), true)?>",
			type: "post",
			dataType: "json",
			data: {
				weid: "<?php  echo $item['weid'];?>",
				schoolid:"<?php  echo $item['schoolid'];?>",
				ksxgnum:ksxgnum,
				reprice:RePrice,
				openid : "<?php  echo $_W['openid'];?>",
				kcid: "<?php  echo $item['id'];?>",
				sid:"<?php  echo $_GPC['sid'];?>",
				uid:"<?php  echo $_W['member']['uid'];?>",
				userid:"<?php  echo $_GPC['userid'];?>",
				is_point:is_point,
				point:count
			},
			success: function (data) {
				jTips(data.msg);
				if(data.result ==true){
					var url  = "<?php  echo $this->createMobileUrl('order', array('schoolid' => $item['schoolid'],'user' => $_GPC['userid'] ), true)?>";
					window.location.href = url;
				}
			}
		});
            $('html,body').removeClass('ovfHiden');
	};	
	</script>
	<script type="text/javascript">
	
	$("#is_p2c").bind("change", function () {
			if($("#is_p2c").prop('checked')){
				$("#is_p2c_value").val(1);
				$(".is_show").show();
			}else{
				$("#is_p2c_value").val(0);
				$(".is_show").hide();
			}
		});
	//加的效果
	$(".jia").click(function(){
		var n=$(this).prev().val();
		var num=Number(n)+1;
		if(num==0){ return;}
		if(num> Number(Number(<?php  echo $item['AllNum'];?>)-Number(<?php  echo $ygks['ksnum'];?>)))
		{
			return;
		}
		$(this).prev().val(num);
	});
	//实时监听数量
	$(".num1").bind('input propertychange', function() {
			var count = $(this).val();
		if(count >= Number(Number(<?php  echo $item['AllNum'];?>)-Number(<?php  echo $ygks['ksnum'];?>)))
		{
			$(this).val(Number(Number(<?php  echo $item['AllNum'];?>)-Number(<?php  echo $ygks['ksnum'];?>)));
		}
	});
	//减的效果
	$(".jian").click(function(){
		var n=$(this).next().val();
		var num=parseInt(n)-1;
		if(num==0){ return}
		else if(num < Number(<?php  echo $item['ReNum'];?>) && (Number(<?php  echo $item['AllNum'];?>) - Number(<?php  echo $ygks['ksnum'];?>) >= <?php  echo $item['ReNum'];?>)){
			alert("抱歉，续购课时不得低于最低限制");
			$(this).prev().val(n);
			return;
		}
		$(this).next().val(num);
	});
</script>