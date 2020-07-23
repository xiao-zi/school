<?php defined('IN_IA') or exit('Access Denied');?><?php  if($type == 'newbox') { ?>
	<div class="ks_box">
		<div class="del_this_box" onclick="del_this_box(this)"><i class="fa fa-times-circle"></i></div>
		<div class="form-group">
			<label class="col-sm-1 control-label">名称</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="name[]" value="" placeholder="15字以内" />
				<div class="help-block">请输入本节课名称</div>
			</div>
			<label class="col-sm-1 control-label">排序</label>
			<div class="col-sm-2">
				<input type="number" class="form-control" name="ssort[]" value="" placeholder="数字" />
				<div class="help-block">越大越靠前</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-1 control-label">试看</label>
			<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
				<div class="input-group">
					<input name="is_try" class="weui_switchs" onclick="weui_switchs(this)" type="checkbox">
					<span class="input-group-addon">禁止</span>
					<input name="is_try_see[]" type="hidden" value="2">
				</div>
				<div class="help-block" style="width:190px">设置未购用户是否能观看本节内容</div>
			</div>
			<?php  if($kcinfo['allow_menu'] == 1) { ?>
			<label class="col-sm-1 control-label" style="margin-left: 83px;">章节</label>
			<div class="col-sm-4">
				<select name="menuid[]" class="form-control allmenu_list">
					<?php  if($allmenu) { ?>
						<?php  if(is_array($allmenu)) { foreach($allmenu as $row) { ?>
							<option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
						<?php  } } ?>	
					<?php  } else { ?>
						<option value="-1">默认章节</option>
					<?php  } ?>
				</select>
			</div>
			<?php  } ?>
		</div>
		<div class="form-group">
			<label class="col-sm-1 control-label">老师</label>
			<div class="col-sm-3">
				<select name="tid[]" class="form-control">
					<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
						<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
					<?php  } } ?>
				</select>
			</div>
			<label class="col-sm-1 control-label">内容</label>
			<div class="col-sm-3">
				<select name="content_type[]" onchange="cont(this)" class="form-control">
					<option value="-1">选择类型</option>
					<option value="0">富文本</option>
					<option value="1">直播</option>
					<option value="2">视频</option>
					<option value="3">语音</option>
					<option value="4">纯图</option>
					<option value="5">文档/文件</option>
				</select>
			</div>
		</div>
		<div class="form-group">
		
		</div>			
	</div>
<?php  } else if($type == 'preview') { ?>
	<div class="telephone"></div>
	<div class="document-title"><?php  echo $ksinfo['name'];?></div>
	<div class="phone-stage">
	<?php  if($ksinfo['content_type'] == 0) { ?>
		<?php  echo htmlspecialchars_decode($ksinfo['content'])?>
	<?php  } ?>
	<?php  if($ksinfo['content_type'] == 1) { ?>
		<video id="video" controls="controls" poster="" x5-playsinline="true" webkit-playsinline="true" playsinline="true">
			<source src="<?php  echo tomedia($ksinfo['content'])?>" type='video/mp4' />
		</video>
	<?php  } ?>
	<?php  if($ksinfo['content_type'] == 2) { ?>
		<video id="video" controls="controls" poster="" x5-playsinline="true" webkit-playsinline="true" playsinline="true">
			<source src="<?php  echo tomedia($ksinfo['content'])?>" type='video/mp4' />
		</video>
	<?php  } ?>
	<?php  if($ksinfo['content_type'] == 3) { ?>
		<video id="video" controls="controls" poster="" x5-playsinline="true" webkit-playsinline="true" playsinline="true">
			<source src="<?php  echo tomedia($ksinfo['content'])?>" type='video/mp4' />
		</video>
	<?php  } ?>
	<?php  if($ksinfo['content_type'] == 4) { ?>
		<img width="100%" src="<?php  echo tomedia($ksinfo['content'])?>"/>
	<?php  } ?>
	<?php  if($ksinfo['content_type'] == 5) { ?>
		<iframe src="<?php  echo tomedia($ksinfo['content'])?>" frameborder="0" class="create-iframe"></iframe>
	<?php  } ?>
	</div>
	<div class="home-btn"></div>
<?php  } else { ?>
	<?php  if($type == 0) { ?>
		<label class="col-sm-1 control-label">上课内容</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="conment[]" placeholder="请在其他编辑器里复制html代码到此处即可"><?php  echo $ksinfo['content'];?></textarea>
			<div class="help-block">此处只支持html代码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.135editor.com/" target="_bank">创建图文</div>
		</div>
	<?php  } ?>
	<?php  if($type == 1) { ?>
		<label class="col-sm-1 control-label">直播地址</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="conment[]" value="<?php  echo tomedia($ksinfo['content'])?>" />
			<div class="help-block">请输入.m3u8直播推流地址</div>
		</div>
	<?php  } ?>
	<?php  if($type == 2) { ?>
		<label class="col-sm-1 control-label">视频地址</label>
		<div class="col-sm-9">
			<?php  echo tpl_form_field_video('conment[]', $ksinfo['content']);?>
		</div>
	<?php  } ?>
	<?php  if($type == 3) { ?>
		<label class="col-sm-1 control-label">语音文件</label>
		<div class="col-sm-9">
			<?php  echo tpl_form_field_audio('conment[]', $ksinfo['content']);?>
		</div>
	<?php  } ?>
	<?php  if($type == 4) { ?>
		<label class="col-sm-1 control-label">图片文件</label>
		<div class="col-sm-9">
			<?php  echo tpl_form_field_image('conment[]', $ksinfo['content']);?>
		</div>
	<?php  } ?>
	<?php  if($type == 5) { ?>
		<label class="col-sm-1 control-label">文档文件</label>
		<div class="col-sm-9">
			<?php  echo tpl_form_field_video('conment[]', $ksinfo['content']);?>
			<div class="help-block">仅支持一个ppt、pdf、wrod、execl格式,注意：请在系统站点设置附件设置视频格式设置加上ppt,pptx,docx,doc,xls,xlsx,pdf<a></a></div>
		</div>
	<?php  } ?>	
<?php  } ?>