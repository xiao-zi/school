<?php defined('IN_IA') or exit('Access Denied');?><!--轮播内容-->
<div id="stutop" class="editor" style="display: none; padding-bottom: 0px; margin-top: 77px;" >
	<div class="ng-scope">
	<!--页面标题设置-->
		<div class="app-header-setting">
			<div class="arrow-left"></div>
			<div class="app-header-setting-inner">
				<div class="panel panel-default">
					<div class="panel-body form-horizontal">
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>轮播开关</label>
							<div class="col-xs-9">
								<input type="checkbox" name="status[]" <?php  if($kcstatus['status'] == 1) { ?>checked<?php  } ?>>
								<a  class="btn btn-default" id="banner" <?php  if($kcstatus['status'] != 1) { ?>style="display:none;"<?php  } ?>>+</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php  if(is_array($banner)) { foreach($banner as $row) { ?>
	<div id="iconeditor<?php  echo $row['id'];?>">
		<div class="ng-scope needhidden" style="margin-top: 10px;">
		<!--轮播内容-->
			<div class="app-header-setting">
				<div class="arrow-left"></div>
				<div class="app-header-setting-inner">
					<div class="panel panel-default">
						<div class="panel-body form-horizontal">
							<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
							<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="20" />
							<div class="form-group">
								<label class="col-xs-3 control-label"><span class="red">*</span>轮播图名称<span class="deleteImage1"  title="删除" onclick="del(this,<?php  echo $row['id'];?>,20)"></span></label>

								<div class="col-xs-8">
									<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="轮播图名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
								</div>
							</div>																			
							<div class="form-group ng-scope">
								<label class="control-label col-xs-3">链接地址</label>
								<div class="col-xs-9">
								<div class="ng-isolate-scope">
									<div class="dropdown link">
										<div class="input-group">
											<input type="text" value="<?php  echo $row['url'];?>" id ="url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">

											<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kclink', TEMPLATE_INCLUDEPATH)) : (include template('public/kclink', TEMPLATE_INCLUDEPATH));?>
										</div>
									</div>
								</div>
								</div>
							</div>										
							<div class="form-group this_here">
								<label class="control-label col-xs-3"><span class="red">*</span>图片</label>
								<div class="col-xs-9">
									<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
									<div class="input-group ">
										<input type="text" name="iconpics[<?php  echo $row['id'];?>]" id="iconpics<?php  echo $row['id'];?>" value="<?php  echo tomedia($row['icon'])?>" class="form-control" autocomplete="off" filename="" url="">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button" onclick="showImageDialoglb<?php  echo $row['id'];?>(this);">选择图片</button>
										</span>
									</div>
									<div class="input-group " style="margin-top:.5em;">
										<img id="imgsrc_this<?php  echo $row['id'];?>"  src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
										<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
									</div>
									<span class="help-block">推荐尺寸375*164左右,长方形图片</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	<?php  } } ?>
</div>
<script type="text/javascript">
require(['jquery', 'util', 'bootstrap.switch'], function($, u){
	$(':checkbox[name="status[]"]').bootstrapSwitch();
	$(':checkbox[name="status[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var status = this.checked ? 1 : 2;
		if(status == 1){
			$('#banner').show();
			$('.needhidden').show();
		}else{
			$('#banner').hide();
			$('.needhidden').hide();
		}
	});	
});	
function showImageDialog<?php  echo $stutop['id'];?>(elm, opts, options) {
	require(["util"], function(util){
		var btn = $(elm);
		var ipt = btn.parent().prev();
		var val = ipt.val();
		var img = ipt.parent().next().children();
		options = {'global':false,'class_extra':'','direct':true,'multiple':false};
		util.image(val, function(url){
			if(url.url){
				if(img.length > 0){
					img.get(0).src = url.url;
				}
				ipt.val(url.attachment);
				ipt.attr("filename",url.filename); 
				ipt.attr("url",url.url);
				$(".head").css("background","url("+url.url+")");
				$(".head").css("background-size","100% auto");
			}
			if(url.media_id){
				if(img.length > 0){
					img.get(0).src = "";
				}
				ipt.val(url.media_id);
				$(".head").css("background","url("+url.media_id+")");
				$(".head").css("background-size","100% auto");
			}
		}, null, options);
	});
}
</script>	
<!-- 精品课程开始 -->
<?php  if(is_array($jpkc)) { foreach($jpkc as $row) { ?>
<div id="iconeditor<?php  echo $row['id'];?>" class="editor editor11" style="top: 160px !important;">
	<div class="ng-scope">
	<!--页面标题设置-->
		<div class="app-header-setting">
			<div class="arrow-left"></div>
			<div class="app-header-setting-inner">
				<div class="panel panel-default">
					<div class="panel-body form-horizontal">
						<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
						<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="21" />								
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
							<div class="col-xs-9">
								<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>课程名称</label>
							<div class="col-xs-9">
								<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="课程名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
							</div>
						</div>									
						<div class="form-group ng-scope">
							<label class="control-label col-xs-3">链接地址</label>
							<div class="col-xs-9">
							<div class="ng-isolate-scope">
								<div class="dropdown link">
									<div class="input-group">
										<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
										<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kclink', TEMPLATE_INCLUDEPATH)) : (include template('public/kclink', TEMPLATE_INCLUDEPATH));?>
									</div>
								</div>
							</div>
							</div>
						</div>										
						<div class="form-group">
							<label class="control-label col-xs-3"><span class="red">*</span>图标</label>
							<div class="col-xs-9">
								<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
								<div class="input-group ">
									<input type="text" name="iconpics[<?php  echo $row['id'];?>]" id="iconpics<?php  echo $row['id'];?>" value="<?php  echo tomedia($row['icon'])?>" class="form-control" autocomplete="off" filename="" url="">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="showImageDialogmf<?php  echo $row['id'];?>(this);">选择图片</button>
									</span>
								</div>
								<div class="input-group " style="margin-top:.5em;">
									<img id="imgsrc_this<?php  echo $row['id'];?>" src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
									<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
								</div>
								<span class="help-block">推荐尺寸180*100左右,长方形图片</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>	
<?php  } } ?>
<!-- 精品课程结束 -->

<!-- 中部推荐内容开始 -->
<?php  if(is_array($kccommend)) { foreach($kccommend as $row) { ?>
<div id="iconeditor<?php  echo $row['id'];?>" class="editor editor11" style="top: 600px !important;">
	<div class="ng-scope">
	<!--页面标题设置-->
		<div class="app-header-setting">
			<div class="arrow-left"></div>
			<div class="app-header-setting-inner">
				<div class="panel panel-default">
					<div class="panel-body form-horizontal">
						<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
						<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="22" />								
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
							<div class="col-xs-9">
								<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>课程名称</label>
							<div class="col-xs-9">
								<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="课程名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
							</div>
						</div>									
						<div class="form-group ng-scope">
							<label class="control-label col-xs-3">链接地址</label>
							<div class="col-xs-9">
							<div class="ng-isolate-scope">
								<div class="dropdown link">
									<div class="input-group">
										<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
										<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kclink', TEMPLATE_INCLUDEPATH)) : (include template('public/kclink', TEMPLATE_INCLUDEPATH));?>
									</div>
								</div>
							</div>
							</div>
						</div>										
						<div class="form-group">
							<label class="control-label col-xs-3"><span class="red">*</span>图标</label>
							<div class="col-xs-9">
								<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
								<div class="input-group ">
									<input type="text" name="iconpics[<?php  echo $row['id'];?>]" id="iconpics<?php  echo $row['id'];?>" value="<?php  echo tomedia($row['icon'])?>" class="form-control" autocomplete="off" filename="" url="">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="showImageDialogmf<?php  echo $row['id'];?>(this);">选择图片</button>
									</span>
								</div>
								<div class="input-group " style="margin-top:.5em;">
									<img id="imgsrc_this<?php  echo $row['id'];?>" src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
									<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
								</div>
								<span class="help-block">推荐尺寸150*213左右,长方形图片</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>	
<?php  } } ?>
<!-- 中部推荐内容结束 -->

<!-- 推荐团队开始 -->
<?php  if(is_array($kcteam)) { foreach($kcteam as $row) { ?>
<div id="iconeditor<?php  echo $row['id'];?>" class="editor editor11" style="top: 830px !important;">
	<div class="ng-scope">
	<!--页面标题设置-->
		<div class="app-header-setting">
			<div class="arrow-left"></div>
			<div class="app-header-setting-inner">
				<div class="panel panel-default">
					<div class="panel-body form-horizontal">
						<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
						<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="23" />								
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
							<div class="col-xs-9">
								<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>课程名称</label>
							<div class="col-xs-9">
								<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="课程名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
							</div>
						</div>									
						<div class="form-group ng-scope">
							<label class="control-label col-xs-3">链接地址</label>
							<div class="col-xs-9">
							<div class="ng-isolate-scope">
								<div class="dropdown link">
									<div class="input-group">
										<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
										<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/kclink', TEMPLATE_INCLUDEPATH)) : (include template('public/kclink', TEMPLATE_INCLUDEPATH));?>
									</div>
								</div>
							</div>
							</div>
						</div>										
						<div class="form-group">
							<label class="control-label col-xs-3"><span class="red">*</span>图标</label>
							<div class="col-xs-9">
								<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
								<div class="input-group ">
									<input type="text" name="iconpics[<?php  echo $row['id'];?>]" id="iconpics<?php  echo $row['id'];?>" value="<?php  echo tomedia($row['icon'])?>" class="form-control" autocomplete="off" filename="" url="">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="showImageDialogmf<?php  echo $row['id'];?>(this);">选择图片</button>
									</span>
								</div>
								<div class="input-group " style="margin-top:.5em;">
									<img id="imgsrc_this<?php  echo $row['id'];?>" src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
									<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
								</div>
								<span class="help-block">推荐尺寸180*100左右,长方形图片</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>	
<?php  } } ?>
<!-- 推荐团队结束 -->

<!-- 名师开始 -->
<?php  if(is_array($kcteacher)) { foreach($kcteacher as $row) { ?>
<div id="iconeditor<?php  echo $row['id'];?>" class="editor editor11" style="top: 100px !important;">
	<div class="ng-scope">
	<!--页面标题设置-->
		<div class="app-header-setting">
			<div class="arrow-left"></div>
			<div class="app-header-setting-inner">
				<div class="panel panel-default">
					<div class="panel-body form-horizontal">
						<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
						<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="24" />								
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
							<div class="col-xs-9">
								<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>名师姓名</label>
							<div class="col-xs-9">
								<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="课程名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>老师描述</label>
							<div class="col-xs-9">
								<input type="text" id="mfbzs'<?php  echo $row['id'];?>'" name="mfbzs[<?php  echo $row['id'];?>]" onkeyup="SwapTxt2('<?php  echo $row['id'];?>')" placeholder="老师描述" value="<?php  echo $row['beizhu'];?>" class="form-control ng-pristine ng-untouched ng-valid">
							</div>	
						</div>						
						<div class="form-group ng-scope">
							<label class="control-label col-xs-3">链接地址</label>
							<div class="col-xs-9">
							<div class="ng-isolate-scope">
								<div class="dropdown link">
									<div class="input-group">
										<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
										<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/mslink', TEMPLATE_INCLUDEPATH)) : (include template('public/mslink', TEMPLATE_INCLUDEPATH));?>
									</div>
								</div>
							</div>
							</div>
						</div>										
						<div class="form-group">
							<label class="control-label col-xs-3"><span class="red">*</span>头像</label>
							<div class="col-xs-9">
								<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
								<div class="input-group ">
									<input type="text" name="iconpics[<?php  echo $row['id'];?>]" id="iconpics<?php  echo $row['id'];?>" value="<?php  echo tomedia($row['icon'])?>" class="form-control" autocomplete="off" filename="" url="">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="showImageDialogmf<?php  echo $row['id'];?>(this);">选择图片</button>
									</span>
								</div>
								<div class="input-group " style="margin-top:.5em;">
									<img id="imgsrc_this<?php  echo $row['id'];?>" src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
									<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
								</div>
								<span class="help-block">推荐尺寸45*45左右,长方形图片</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-xs-3"><span class="red">*</span>图标</label>
							<div class="col-xs-9">
								<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
								<div class="input-group ">
									<input type="text" name="iconpics_tow[<?php  echo $row['id'];?>]" id="iconpics_tow<?php  echo $row['id'];?>" value="<?php  echo tomedia($row['icon2'])?>" class="form-control" autocomplete="off" filename="" url="">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="showImageDialogmf<?php  echo $row['id'];?>(this);">选择图片</button>
									</span>
								</div>
								<div class="input-group " style="margin-top:.5em;">
									<img id="imgsrc_this<?php  echo $row['id'];?>" src="<?php  if($row['icon2']) { ?><?php  echo tomedia($row['icon2'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
									<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
								</div>
								<span class="help-block">推荐尺寸105*38左右,长方形图片</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>	
<?php  } } ?>
<!-- 名师结束 -->

<!-- 课程设置栏目开始 -->
<?php  if(is_array($kctitle)) { foreach($kctitle as $row) { ?>
<div id="iconeditor<?php  echo $row['id'];?>" class="editor editor11" style="top: -20px !important;">
	<div class="ng-scope">
	<!--页面标题设置-->
		<div class="app-header-setting">
			<div class="arrow-left"></div>
			<div class="app-header-setting-inner">
				<div class="panel panel-default">
					<div class="panel-body form-horizontal">
						<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
						<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="25" />	
						<div class="form-group">
							<label class="col-xs-3 control-label"><span class="red">*</span>标题</label>
							<div class="col-xs-9">
								<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="请输入标题" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>	
<?php  } } ?>
<!-- 课程设置栏目结束 -->

<script src="<?php echo MODULE_URL;?>public/web/js/diyjs.js" type="text/javascript"></script>