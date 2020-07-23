<?php defined('IN_IA') or exit('Access Denied');?>
				<div id="stutop" class="editor" style="display: none;" >
					<div class="ng-scope">
					<!--页面标题设置-->
						<div class="app-header-setting">
							<div class="arrow-left"></div>
							<div class="app-header-setting-inner">
								<div class="panel panel-default">
									<div class="panel-body form-horizontal">
										<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="3" />
										<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
										<div class="form-group">
											<label class="col-xs-12 col-sm-3 col-md-2 control-label">顶部背景类型</label>
											<div class="col-sm-9" style="font-size: 14px;">
												<label class="radio-inline">
													<input type="radio" style="-webkit-appearance:radio;margin-top: 2px;" name="topType" value="1" <?php  if($stutop['status'] == 1 || $stutop['status'] == 0 ) { ?>checked="checked"<?php  } ?> >纯色
												</label>
												<label class="radio-inline">
													<input type="radio" style="-webkit-appearance:radio;margin-top: 2px;" name="topType" value="2" <?php  if($stutop['status'] == 2) { ?>checked="checked"<?php  } ?>  >图片
												</label>
												
											</div>	
										</div>
										<div class="form-group" id="pureColor"  <?php  if($stutop['status'] == 2) { ?>style="display: none;"<?php  } ?>>
											<label class="col-xs-12 col-sm-3 col-md-2 control-label">顶部颜色</label>
											<div class="col-sm-8">			
												<script type="text/javascript">
													$(function(){
														$(".colorpicker").each(function(){
															var elm = this;
															util.colorpicker(elm, function(color){
																$(elm).parent().prev().prev().val(color.toHexString());
																$(elm).parent().prev().css("background-color", color.toHexString());
																var topColor = $('input[name="topColor"]').val();
																$(".head").css("background",topColor);
															});
														});
														$(".colorclean").click(function(){
															$(this).parent().prev().prev().val("");
															$(this).parent().prev().css("background-color", "#FFF");
															var topColor = $('input[name="topColor"]').val();
															$(".head").css("background",topColor);
														});
													});
												</script>
												<div class="row row-fix">
													<div class="col-xs-8 col-sm-8" >
														<div class="input-group">
															<input class="form-control" type="text" name="topColor" placeholder="请选择颜色" value="<?php  if($stutop['color']) { ?><?php  echo $stutop['color'];?><?php  } else { ?>#1071b7<?php  } ?>">
															<span class="input-group-addon" style="width:35px;border-left:none;background-color:<?php  if($stutop['color']) { ?><?php  echo $stutop['color'];?><?php  } else { ?>#1071b7<?php  } ?>"></span>
															<span class="input-group-btn">
																<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
																<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
															</span>
														</div>
													</div>
												</div>
												 
											</div>
										</div>
										<div class="form-group" id="topImage" <?php  if($stutop['status'] == 1 || $stutop['status'] == 0 ) { ?>style="display: none;"<?php  } ?>>
											 <!--'top_image', $stutop['icon']-->
								            <label class="col-xs-12 col-sm-3 col-md-2 control-label">顶部图片</label>
						                    <div class="col-xs-9">
												<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/imgeschoses', TEMPLATE_INCLUDEPATH)) : (include template('public/imgeschoses', TEMPLATE_INCLUDEPATH));?>
												<div class="input-group ">
													<input type="text" name="top_image" id="iconpics<?php  echo $stutop['id'];?>" value="<?php  echo tomedia($stutop['icon'])?>" class="form-control" autocomplete="off" filename="" url="">
													<span class="input-group-btn">
														<button class="btn btn-default" type="button" onclick="showImageDialog<?php  echo $stutop['id'];?>(this);">选择图片</button>
													</span>
												</div>
												<div class="input-group " style="margin-top:.5em;">
													<img src="<?php  if($stutop['icon']) { ?><?php  echo tomedia($stutop['icon'])?><?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
													<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
												</div>
												<span class="help-block">推荐尺寸420*170左右,长方形图标</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>		
				</div>
				<script type="text/javascript">
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
				<!-- 顶部按钮 -->
				<?php  if(is_array($icons1)) { foreach($icons1 as $row) { ?>
				<div id="iconeditor<?php  echo $row['id'];?>" class="editor" style="top: 200px !important;">
					<div class="ng-scope">
					<!--页面标题设置-->
						<div class="app-header-setting">
							<div class="arrow-left"></div>
							<div class="app-header-setting-inner">
								<div class="panel panel-default">
									<div class="panel-body form-horizontal">
										<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="3" />
										<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
											<div class="col-xs-9">
												<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>按钮名称</label>
											<div class="col-xs-9">
												<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt(<?php  echo $row['id'];?>)" placeholder="按钮名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
											</div>
										</div>
										<div class="form-group ng-scope">
											<label class="control-label col-xs-3">链接地址</label>
											<div class="col-xs-9">
											<div class="ng-isolate-scope">
												<div class="dropdown link">
													<div class="input-group">
														<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
														<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/linkchose', TEMPLATE_INCLUDEPATH)) : (include template('public/linkchose', TEMPLATE_INCLUDEPATH));?>
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
														<button class="btn btn-default" type="button" onclick="showImageDialog<?php  echo $row['id'];?>(this);">选择图片</button>
													</span>
												</div>
												<div class="input-group " style="margin-top:.5em;">
													<img src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
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
	            <!-- 魔方开始 -->
				<?php  if(is_array($icons2)) { foreach($icons2 as $row) { ?>
				<div id="iconeditor<?php  echo $row['id'];?>" class="editor editor11" style="top: 300px !important;">
					<div class="ng-scope">
					<!--页面标题设置-->
						<div class="app-header-setting">
							<div class="arrow-left"></div>
							<div class="app-header-setting-inner">
								<div class="panel panel-default">
									<div class="panel-body form-horizontal">
										<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
										<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="4" />								
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
											<div class="col-xs-9">
												<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>按钮名称</label>
											<div class="col-xs-9">
												<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="按钮名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-3 control-label">按钮颜色</label>
											<div class="col-xs-9">
												<div class="input-group">
													<div class="ng-isolate-scope">
														<div class="input-group">
															<input type="text" name="bzcolor[<?php  echo $row['id'];?>]" value="<?php  echo $row['color'];?>" class="form-control ng-pristine ng-valid ng-touched">
															<span class="input-group-addon" style="width: 35px; border-left: none; background-color: <?php  echo $row['color'];?>;"></span>
															<span class="input-group-btn">
															<button class="btn btn-default colorpicker<?php  echo $row['id'];?>" type="button">选择颜色 
																<i class="fa fa-caret-down"></i>
															</button>
															<button class="btn btn-default colorclean" type="button">
																<span><i class="fa fa-remove"></i></span>
															</button>
															</span>
														</div>
													</div>
												</div>
												<script type="text/javascript">
													require(["jquery", "util"], function($, util){
														$(function(){
															$(".colorpicker<?php  echo $row['id'];?>").each(function(){
																var elm = this;
																util.colorpicker(elm, function(color){
																	$(elm).parent().prev().prev().val(color.toHexString());
																	$(elm).parent().prev().css("background-color", color.toHexString());
																	$("#iconname<?php  echo $row['id'];?>").css("color",color.toHexString());
																});
															});
															$(".colorclean").click(function(){
																$(this).parent().prev().prev().val("");
																$(this).parent().prev().css("background-color", "#FFF");
																$("#iconname<?php  echo $row['id'];?>").css("color", "#FFF");
															});
														});
													});
												</script>
											</div>
										</div>										
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>按钮描述</label>
											<div class="col-xs-9">
												<input type="text" id="mfbzs<?php  echo $row['id'];?>" name="mfbzs[<?php  echo $row['id'];?>]" onkeyup="SwapTxt2(<?php  echo $row['id'];?>)" placeholder="按钮描述" value="<?php  echo $row['beizhu'];?>" class="form-control ng-pristine ng-untouched ng-valid">
											</div>
										</div>										
										<div class="form-group ng-scope">
											<label class="control-label col-xs-3">链接地址</label>
											<div class="col-xs-9">
											<div class="ng-isolate-scope">
												<div class="dropdown link">
													<div class="input-group">
														<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
														<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/linkchose', TEMPLATE_INCLUDEPATH)) : (include template('public/linkchose', TEMPLATE_INCLUDEPATH));?>
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
													<img src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
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
	            <!-- 列表开始 -->
				<?php  if(is_array($icons3)) { foreach($icons3 as $row) { ?>
				<div id="iconeditor<?php  echo $row['id'];?>" class="editor" style="top: 500px !important;">
					<div class="ng-scope">
					<!--页面标题设置-->
						<div class="app-header-setting">
							<div class="arrow-left"></div>
							<div class="app-header-setting-inner">
								<div class="panel panel-default">
									<div class="panel-body form-horizontal">
										<input type="hidden" name="type[<?php  echo $row['id'];?>]" value="1" />
										<input type="hidden" name="place[<?php  echo $row['id'];?>]" value="5" />								
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>显示状态</label>
											<div class="col-xs-9">
												<input type="checkbox" value="<?php  echo $row['status'];?>" name="status[]" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-3 control-label"><span class="red">*</span>按钮名称</label>
											<div class="col-xs-9">
												<input type="text" id="btnname<?php  echo $row['id'];?>" name="btnname[<?php  echo $row['id'];?>]" onkeyup="SwapTxt1(<?php  echo $row['id'];?>)" placeholder="按钮名称" value="<?php  echo $row['name'];?>" class="form-control ng-pristine ng-untouched ng-valid">
											</div>
										</div>																			
										<div class="form-group ng-scope">
											<label class="control-label col-xs-3">链接地址</label>
											<div class="col-xs-9">
											<div class="ng-isolate-scope">
												<div class="dropdown link">
													<div class="input-group">
														<input type="text" value="<?php  echo $row['url'];?>" id = "url<?php  echo $row['id'];?>" name="url[<?php  echo $row['id'];?>]" class="form-control" autocomplete="off">
														<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/linkchose', TEMPLATE_INCLUDEPATH)) : (include template('public/linkchose', TEMPLATE_INCLUDEPATH));?>
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
														<button class="btn btn-default" type="button" onclick="showImageDialoglb<?php  echo $row['id'];?>(this);">选择图片</button>
													</span>
												</div>
												<div class="input-group " style="margin-top:.5em;">
													<img src="<?php  if($row['icon']) { ?><?php  echo tomedia($row['icon'])?><?php  } else { ?>./resource/images/nopic.jpg<?php  } ?>" onerror="" class="img-responsive img-thumbnail" width="150">
													<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
												</div>
												<span class="help-block">推荐尺寸25*25左右,正方形透明底图标</span>
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