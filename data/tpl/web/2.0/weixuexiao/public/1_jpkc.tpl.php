<?php defined('IN_IA') or exit('Access Denied');?><script type="text/javascript"> 
var jpkcid = <?php  echo $lastid['id'];?>;
var jpkcids = jpkcid + 21;
var jpkcpic = 0;
	$('#jpkc').click(function(){
		jpkcpic++;
		jpkcids++;
		//alert ("iconpic"+divid);
		var htmls =	'<div class="mofang" id="mofang'+jpkcids+'" onclick="shouweditor('+jpkcids+')" >'+
						'<div class="childrenBox">'+
							'<div class="imageC">'+
								'<div class="cutImgOutBox">'+
									'<img class="cImg" src="<?php echo OSSURL;?>public/mobile/img/banner18QQ65.png">'+
									'<span class="deleteImages"  title="删除" onclick="deleteclass(this,'+jpkcids+',21)"></span>'+
								'</div>'+
							'</div>'+
							'<div class="kc_name">'+
								'<p class="kc_name_content">精品课程</p>'+
							'</div>'+
							'<div class="fans_box">'+
								'<span class="zhuliclass">'+
									'<img class="zlheader" src="<?php echo OSSURL;?>public/mobile/img/falls4.jpg">'+
									'<img class="zlheader" src="<?php echo OSSURL;?>public/mobile/img/falls4.jpg">'+
									'<img class="zlheader" src="<?php echo OSSURL;?>public/mobile/img/falls4.jpg">'+
									'<img class="zlheader" src="<?php echo OSSURL;?>public/mobile/img/falls4.jpg">'+
									'<img class="zlheader" src="<?php echo OSSURL;?>public/mobile/img/falls4.jpg">'+
								'</span>'+
								'<p class="fans_text_title">6865人学过</p>'+
							'</div>'+
							'<div class="pay">'+
								'<p class="pay_cose">￥149.00</p>'+
							'</div>'+
						'</div>'+
					'</div>';
		$('.parent_option').append(htmls);
		var imgurlss = "url"+jpkcids;
		var imgurls = "'"+imgurlss+"'";
		var htmls1ss = '<div id="iconeditor'+jpkcids+'" class="editor needhidden" style="top: 80px;">'+
					'	<div class="ng-scope">'+
					'		<div class="app-header-setting">'+
					'			<div class="app-header-setting-inner">'+
					'				<div class="panel panel-default">'+
					'					<div class="panel-body form-horizontal">'+
					'						<input type="hidden" name="type['+jpkcids+']" value="2" />'+
					'						<input type="hidden" name="place['+jpkcids+']" value="21" />'+
					'						<div class="form-group">'+
					'							<label class="col-xs-3 control-label"><span class="red">*</span>课程名称['+jpkcpic+']</label>'+
					'							<div class="col-xs-9">'+
					'								<input type="text" id="btnname'+jpkcids+'" name="btnname['+jpkcids+']" onkeyup="SwapTxt1('+jpkcids+')" placeholder="请输入课程名称" value=" " class="form-control ng-pristine ng-untouched ng-valid input_this">'+
					'							</div>'+
					'						</div>'+
					'						<div class="form-group ng-scope">'+
					'							<label class="control-label col-xs-3">链接地址</label>'+
					'							<div class="col-xs-9">'+
					'							<div class="ng-isolate-scope">'+
					'								<div class="dropdown link">'+
					'									<div class="input-group">'+
					'										<input type="text" value="" id = "url'+jpkcids+'" name="url['+jpkcids+']" class="form-control" autocomplete="off">'+
					'												<span class="input-group-btn">'+
					'													<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">选择链接 <span class="caret"></span></button>'+
					'													<ul class="dropdown-menu">'+
					'														<li><a href="javascript:" data-type="jiaoyu" onclick="showJiaoyuDialog('+imgurls+',2);">微教育菜单</a></li>'+
					'														<li><a href="javascript:" data-type="system" onclick="showLinkDialog(this);">系统菜单</a></li>'+
					'														<li><a href="javascript:" data-type="page" onclick="pageLinkDialog(this);">微页面</a></li>'+
					'														<li><a href="javascript:" data-type="article" onclick="articleLinkDialog(this)">文章及分类</a></li>'+
					'														<li><a href="javascript:" data-type="tcourse" onclick="tcourseLinkDialog(this)">课程</a></li>'+
					'													</ul>'+
					'												</span>	'+
					'									</div>'+
					'								</div>'+
					'							</div>'+
					'							</div>'+
					'						</div>'+
					'						<div class="form-group">'+
					'							<label class="control-label col-xs-3"><span class="red">*</span>图片</label>'+
					'							<div class="col-xs-9">'+
					'								<div class="input-group ">'+
					'									<input type="text" name="iconpics['+jpkcids+']" id="iconpics'+jpkcids+'" class="form-control" autocomplete="off" filename="" url="">'+
					'									<span class="input-group-btn">'+
					'										<button class="btn btn-default" type="button" data_id="mofang'+jpkcids+'" onclick="showImageDialogmfs(this);">选择图片</button>'+
					'									</span>'+
					'								</div>'+
					'								<div class="input-group " style="margin-top:.5em;">'+
					'									<img id="imgsrc_this'+jpkcids+'" src="./resource/images/nopic.jpg" onerror="" class="img-responsive img-thumbnail" width="150">'+
					'									<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>'+
					'								</div>'+
					'								<span class="help-block">推荐尺寸172*103左右,长方形图标</span>'+
					'							</div>'+
					'						</div>'+
					'					</div>'+
					'				</div>'+
					'			</div>'+
					'		</div>'+
					'	</div>'+
					'	</div>';	
				;
		$('.app-side').append(htmls1ss);			
	});
</script> 