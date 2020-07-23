<?php defined('IN_IA') or exit('Access Denied');?><script type="text/javascript" src="./resource/js/require.js"></script>
<style>
	.SetTopLo{border:1px solid #41cac0;padding:2px 10px;border-radius: 10px}
	.RemoveFromTop{border:1px solid #41cac0;padding:2px 10px;border-radius: 10px}
</style>
<?php  if(is_array($iconsF)) { foreach($iconsF as $key => $row) { ?>	
<div id="iconeditor<?php  echo $row['id'];?>" class="editor" style="top: 500px !important;">
		<div class="ng-scope">
		<!--页面标题设置-->
			<div class="app-header-setting">
				<div class="arrow-left"></div>
				<div class="app-header-setting-inner">
					<div class="panel panel-default">
						<div class="panel-body form-horizontal">
							<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="13" />
							<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
							<?php  if(is_TestFz()) { ?>
							
							<div class="form-group">
								<label class="col-xs-3 control-label"><span class="red">*</span>调整至顶部 </label>
								<label class="col-xs-3 control-label" style="margin-left: 10px;width:60%;text-align: left">
									<span class="SetTopLo" onclick="SetToTopLo(1,<?php  echo $row['id'];?>)">1号位</span>
									<span class="SetTopLo" onclick="SetToTopLo(2,<?php  echo $row['id'];?>)">2号位</span>
									<span class="SetTopLo" onclick="SetToTopLo(3,<?php  echo $row['id'];?>)">3号位</span>
									<?php  if($_GPC['is_master'] == 'is_master') { ?>
									<span class="SetTopLo" onclick="SetToTopLo(4,<?php  echo $row['id'];?>)">4号位</span>
									<?php  } ?>
									<span style="display:none" class="RemoveFromTop" onclick="RemoveFromTop(<?php  echo $row['id'];?>)">从顶部移除</span>
								 
								</label>
							</div>
							<?php  } ?>
							
							<div class="form-group">
								<label class="col-xs-3 control-label"><span class="red">*</span>按钮名称</label>
								<div class="col-xs-9">
									<input type="text" placeholder="<?php  echo $row['name'];?>" id="btnname_<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
								</div>
							</div>	

							<div class="form-group">
								<label class="control-label col-xs-3"><span class="red">*</span>图标</label>
								<div class="col-xs-9">
									<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
									<div class="input-group ">
										<input type="text" name="iconpics[<?php  echo $row['id'];?>]" id="iconpics<?php  echo $row['id'];?>" value="<?php  if($row['icon']) { ?><?php  echo $row['icon'];?><?php  } else { ?><?php echo OSSURL;?>public/mobile/img/link_msg.png<?php  } ?>" class="form-control" autocomplete="off" filename="" url="">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button" onclick="showImageDialogT(this,<?php  echo $row['id'];?>);">选择图片</button>
										</span>
									</div>
									<div class="input-group " style="margin-top:.5em;">
										<img src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?><?php echo OSSURL;?>public/mobile/img/link_msg.png<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
										<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
									</div>
									<span class="help-block">推荐尺寸45*45左右,正方形图标</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
<?php  } } ?>


	<script src="<?php echo MODULE_URL;?>public/web/js/diyjs.js" type="text/javascript"></script>