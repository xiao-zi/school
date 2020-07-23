<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html style="font-size: 50px;">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link href="<?php echo OSSURL;?>public/mobile/css/collection_address.css?v=0622" rel="stylesheet">
    <link href="<?php echo OSSURL;?>public/mobile/css/reset.css?v=0622" rel="stylesheet">
    <meta name="HandheldFriendly" content="true">
    <script src="https://hm.baidu.com/hm.js?e6c44a88bd78113bfe161250284d9863"></script><script>
	    var _hmt = _hmt || [];
	    (function () {
	        var hm = document.createElement("script");
	        hm.src = "https://hm.baidu.com/hm.js?e6c44a88bd78113bfe161250284d9863";
	        var s = document.getElementsByTagName("script")[0];
	        s.parentNode.insertBefore(hm, s);
	    })();
	</script>

	<script type="text/javascript">
	    // *** 防止广告劫持 Start ***
	    var global_old_write = document.write;

	    document.write = function (string) {
	        // 允许youanbao, 百度地图     --条件可再优化
	        if (string.indexOf('youanbao') > -1 || string.indexOf('api.map.baidu.com') > -1) {
	            //alert(script);
	            // 调用原始接口
	            global_old_write.apply(document, arguments);
	        }
	        else
	            return false;
	    }
	    // *** 防止广告劫持 End ***
	</script>

	<script src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.10.2.min.js?v=0622"></script>

    <script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/hb.js?v=0622"></script>
    <link href="<?php echo OSSURL;?>public/mobile/css/j_alert.css?v=062220161108" rel="stylesheet">
    <link href="<?php echo OSSURL;?>public/mobile/css/new_yab.css?v=062220161108" rel="stylesheet">
    <title>填写个人信息</title>
</head>

<body class="auto_height" id="auto_height" style="">
<div class="All" style="height: 100%;">
	<section>
	    <form id="frmAddress" action="<?php  echo $this->createMobileUrl('getorder',array('schoolid' => $schoolid,'id' => $userid['id']), true)?>" method="POST">
	      
	        <!--商品信息-->
	        <div class="phone_number" style="font-weight:900">商品信息</div>
	        <div class="name">
		        <input value="<?php  echo $good['id'];?>" id="GoodId" name="GoodId"  type="text" hidden>
	            <label class="titleDescribe" for="username" style="width:70px !important">商品名：</label>
	            <span><?php  echo $good['title'];?></span>
	        </div>
	        <!--分类-->
	        <?php  if($type) { ?>
	        <div class="phone_number" style="height:auto">
		        <table  style="width: 100%;" frame=void >
					<tr>
					    <td valign="top" style="width:70px;line-height: 30px;">分类：</td>
					    <td style="text-align:left;line-height: 30px;">
						    <?php  if(is_array($type)) { foreach($type as $k => $v) { ?>
								<?php  echo $k;?>.<?php  echo $v;?>&nbsp;&nbsp;
					        <?php  } } ?> 
					        </br><span style="color:red; font-size:12px">(随机发货，如有需要请在备注里说明编号)</span>
					    </td>
					 </tr>
				</table>
	        </div>
	        <?php  } ?>
           <div class="phone_number">
	          	<label class="titleDescribe" for="phone_number"style="width:70px !important">价格:</label>
	           	<?php  echo $good['points'];?>积分+<?php  echo $good['new_price'];?>元
	        </div>
	        <?php  if($op != 'showorder') { ?>
	        <!--购物数量-->
	        <style type="text/css" media="screen" id="test">
	        	.gw_num{
		        	border: 1px solid #dbdbdb;
		        	width: 110px;
		        	line-height: 26px;
		        	overflow: hidden;
		        	}
		        	
				.gw_num em{
					display: block;
					height: 26px;
					width: 26px;
					float: left;
					color: #7A7979;
					border-right: 1px solid #dbdbdb;
					text-align: center;
					cursor: pointer;
					}
				.gw_num .num1{
					display: block;
					float: left;
					text-align: center;
					width: 52px;
					height:26px;
					font-style: normal;
					font-size: 14px;
					line-height: 26px;
					border: 0;
					}
				.gw_num em.jia{
					float: right;
					border-right: 0;
					border-left: 1px solid #dbdbdb;
					}
	        </style>
	        <div class="phone_number">
				<label class="titleDescribe" for="phone_number"style="width:70px !important">购买数量:</label>
	        	<div class="gw_num">
					<em class="jian">-</em>
					<input type="number" min="1" max="<?php  echo $good['tqty'];?>" class="num1" id="NumOfGood" name="NumOfGood" value="1"/>
					<em class="jia">+</em>
				</div>
				<span style="margin:  0  0 0 20px;">(库存：<?php  echo $good['tqty'];?>件) </span>
	       </div>
	       
<script type="text/javascript">
	$(document).ready(function(){
		//加的效果
		$(".jia").click(function(){
			var n=$(this).prev().val();
			var num=Number(n)+1;
			if(num==0){ return;}
			if(num> <?php  echo $good['tqty'];?>)
			{
				return;
			}
			var CountPoint = Number(<?php  echo $good['points'];?>) * Number(num);
			if(CountPoint > Number(<?php  echo $Teacher['point'];?>))
			{
				alert("抱歉，您的积分不足以购买更多该商品");
				$(this).prev().val(n);
				return;
			}
			$(this).prev().val(num);
		});

		//实时监听数量
		$(".num1").bind('input propertychange', function() {
  			var count = $(this).val();
			if(count >= <?php  echo $good['tqty'];?>)
			{
				$(this).val(<?php  echo $good['tqty'];?>);
			}
			
			var CountPoint = Number(<?php  echo $good['points'];?>) * Number(count);
			var max = Number(<?php  echo $Teacher['point'];?>) /  Number(<?php  echo $good['points'];?>);
			if(CountPoint > Number(<?php  echo $Teacher['point'];?>))
			{
				alert("抱歉，您的积分不足以购买更多该商品");

				$(this).val(parseInt(max));
			}
});
		
		//减的效果
		$(".jian").click(function(){
			var n=$(this).next().val();
			var num=parseInt(n)-1;
			if(num==0){ return}
			$(this).next().val(num);
		});
	})
</script>
<?php  } else { ?>
			<div class="phone_number">
				<label class="titleDescribe" for="phone_number"style="width:70px !important">购买数量:</label>
	        	<div class="gw_num">
					<?php  echo $morder['count'];?>
				</div>
				
	       </div>

<?php  } ?>
		          <!--备注-->
	        <div class="name" style="height:auto;">
		         <table style="width: 100%;" frame=void >
					<tr>
					    <td valign="top" style="width:70px;">备注:</td>
					      <?php  if($op != 'showorder') { ?>
					    <td style="text-align:left">
						  
						    <textarea maxlength="100" cols="30" rows="7" style="width:100%;margin: 20px 0 0 0;"  name="mark"  id="mark" placeholder="备注(最多输入100字)"></textarea>
						  
						  
					    </td>
					      <?php  } else { ?>
					      <td style="text-align:left">
						      <?php  if(!empty($morder['beizhu'])) { ?>
						    <?php  echo $morder['beizhu'];?>
						    <?php  } else { ?>
						    无备注
						    <?php  } ?>
						     </td>
					      <?php  } ?>
					 </tr>
				</table>
	        </div>
 <div class="phone_number" ></div>
			<!--收货人信息-->
	        <div class="phone_number" style="font-weight:900">收货人信息  
	        <?php  if($op != 'showorder') { ?>
		        <a  style="margin: 0 0 0 20px;width:40%;color:#af3636 !important;background: none !important;font-weight:400"  href="<?php  echo $this->createMobileUrl('setaddress',array('schoolid' => $schoolid,'addressid' => $MyAddress['id']), true)?>">修改收货人信息</a>
		        <?php  } ?>
	        </div>
		 <input value="<?php  echo $MyAddress['id'];?>"  name="MyAddressId" id="MyAddressId" type="text" hidden>
	        <div class="name">
	            <label class="titleDescribe" for="username" style="width:70px !important">姓名：</label>
              	<?php  if($op != 'showorder') { ?>
	            <span><?php  echo $MyAddress['name'];?></span>
	            <?php  } else { ?>
             	<span><?php  echo $morder['tname'];?></span>
              	<?php  } ?>
	             <input value="<?php  echo $MyAddress['name'];?>"  id="MyAddressName" name="MyAddressName"  type="text" hidden>
	        </div>
	        <div class="phone_number">
	            <label class="titleDescribe" for="phone_number" style="width:70px !important">联系电话:</label>
	            <?php  if($op != 'showorder') { ?>
	            <span><?php  echo $MyAddress['phone'];?></span>
	            <?php  } else { ?>
             	<span><?php  echo $morder['tphone'];?></span>
              	<?php  } ?>
	           
	            <input value="<?php  echo $MyAddress['phone'];?>"  id="MyAddressPhone" name="MyAddressPhone"  type="text" hidden>
	        </div>
			 <div class="name" style="height:auto">
				  <table style="width: 100%;" frame=void >
					<tr>
					    <td valign="top" style="width:70px;line-height: 30px;">地址：</td>
					    <?php  if($op != 'showorder') { ?>
					    <td style="text-align:left;line-height: 30px;">
						   <?php  echo $AddressToShow;?>
						   <input value="<?php  echo $AddressToShow;?>"  id="MyAddressToShow" name="MyAddressToShow"  type="text" hidden>
					    </td>
					    <?php  } else { ?>
					      <td style="text-align:left;line-height: 30px;">
						   <?php  echo $morder['taddress'];?>
						   <?php  } ?>
					    </td>
					    
					 </tr>
				</table>
	         </div>
	          
	    </form>
	    <?php  if($op != 'showorder') { ?>
	    <a style="margin-top: 30px;"  href="javascript:submit()">确定</a>
	    <?php  } else { ?>
	     <a style="margin-top: 30px;"  href="javascript:history.back();">返回</a>
	     <?php  } ?>
	</section>
</div>


<script src="<?php echo OSSURL;?>public/mobile/js/j_alert.js?v=062220160929"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/common.js?v=0622"></script><div id="common_progress" class="common_progress_bg"><div class="common_progress"><div class="common_loading"></div><br><span>正在载入...</span></div></div>
<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

<?php  if($op != 'showorder') { ?>
<script>
    function submit() {
        if ($(".num1").val() == "") {
            jTips("请选择购买数量");
            return;
        }
        if(<?php  echo $MyAddress;?> == " "){
	        jTips("收货人信息不能为空，请编辑收货人信息");
	        return;
        }
        if($("#MyAddressPhone").val() == " "){
	        jTips("收货人电话不能为空，请修改收货人信息");
	         return;
        }
         if($("#MyAddressName").val() == " "){
	        jTips("收货人不能为空，请修改收货人信息");
	         return;
        }
         if($("#MyAddressToShow").val() == " "){
	        jTips("收货人地址不能为空，请编辑收货人信息");
	        return;
        }
       
	//弃用form提交，改用ajax提交
      //  $("#frmAddress").submit();
		  var GoodId = $("#GoodId").val();
		  var GoodPoint = <?php  echo $good['points'];?>;
		  var GoodPrice = <?php  echo $good['new_price'];?>;
		  var NumOfGood = $("#NumOfGood").val();
		  var AddId = $("#MyAddressId").val();
		  var beizhu = $("#mark").val();
		  
            $.post("<?php  echo $this->createMobileUrl('payajax',array('op'=>'mallorder'))?>",{"GoodId":GoodId, "GoodPoint":GoodPoint,"GoodPrice":GoodPrice, "NumOfGood":NumOfGood, "AddId":AddId,"schoolid":<?php  echo $schoolid;?>,"weid":<?php  echo $weid;?>,"beizhu":beizhu,"tid":<?php  echo $it['tid'];?>,"userid":<?php  echo $it['id'];?>,'uid':<?php  echo $it['uid'];?>},function(data){
					if(data.result){
						jTips(data.info);
						
						window.location.href = " <?php  echo $this->createMobileUrl('getorder',array('tid'=>$tid,'userid'=>$it['id'],'schoolid'=>$schoolid,'weid'=>$weid))?>";
					}else{
						jTips(data.info);
						//window.history.back();  
					}
		},'json');
      
    }
    

    
</script>
<?php  } ?>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>