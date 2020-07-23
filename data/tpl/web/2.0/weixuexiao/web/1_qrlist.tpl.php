<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/web/css/magnific-popup.css">
<style>
.viewBox .picBox .img {
    width: 95%;
    height: 161px;
	left: 7px;
    background: #fff;;
    overflow: hidden;
    position: relative;
}
.viewBox {
    width: 190px;
    height: 202px;
    border: 1px solid #e6ebf0;
    float: left;
    padding: 5px 10px;
}
</style>
<?php  if($operation == 'display') { ?>
<div class="main">
	<div class="panel panel-default">
        <div class="table-responsive panel-body" style="overflow: hidden;">
			<div id="queue-setting-index-body">
				<div class="viewList">
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<?php  if($item['overtime']) { ?>
					<div class="viewBox">
						<div class="nameAndTime">
							<span class="name"><?php  echo $item['s_name'];?></span> 
							<span name="publishdate" class="time"><?php  echo $item['bjname'];?></span>
						</div>
						<div class="gallery">
							<div class="picBox">
								<table name="imgTable" width="100%" border="1" bordercolor="white">
									<tr>
										<td>
											<div class="img">
												<a target="_blank" class="gallery-link" title="">
													<img style="width: 100%;" src="<?php  echo $item['img_qr'];?>">
												</a>
											</div>
										</td>
									</tr>
								</table>				
							</div>	
						</div>
					</div>
					<?php  } ?>
				<?php  } } ?>	
				</div>
			</div>	
		</div>
	</div>
</div>
<script>
alert("如连接了打印机按Ctrl+P,即可打印,选择缩放比例以达到满张打印效果");
</script>
<?php  } else if($operation == 'choose') { ?>
<div class="main">
	<div class="panel panel-default">
        <div class="table-responsive panel-body" style="overflow: hidden;">
			<div id="queue-setting-index-body">
				<div class="viewList">
				<?php  if(is_array($list1)) { foreach($list1 as $item) { ?>
					<?php  if($item['overtime']) { ?>
					<div class="viewBox">
						<div class="nameAndTime">
							<span class="name"><?php  echo $item['s_name'];?></span> 
							<span name="publishdate" class="time"><?php  echo $item['bjname'];?></span>
						</div>
						<div class="gallery">
							<div class="picBox">
								<table name="imgTable" width="100%" border="1" bordercolor="white">
									<tr>
										<td>
											<div class="img">
												<a target="_blank" class="gallery-link" title="">
													<img style="width: 100%;" src="<?php  echo $item['img_qr'];?>">
												</a>
											</div>
										</td>
									</tr>
								</table>				
							</div>	
						</div>
					</div>
					<?php  } ?>
				<?php  } } ?>	
				</div>
			</div>	
		</div>
	</div>
</div>
<script>
alert("如连接了打印机按Ctrl+P,即可打印,选择缩放比例以达到满张打印效果");
</script>
<?php  } ?>

