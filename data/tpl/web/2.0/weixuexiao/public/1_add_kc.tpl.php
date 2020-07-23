<?php defined('IN_IA') or exit('Access Denied');?><input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<div class="material-head" style="border-bottom: 0px solid #e7e7eb;">
	<ul class="nav nav-tabs addkc_opt">
		<li class="baaic slide_li act" optid="baaic"><a>基本设置</a></li>
		<li class="singup slide_li" optid="singup"><a>报名设置</a></li>
		<li class="mobile slide_li" optid="mobile"><a>前端设置</a></li>
		<li class="teacher slide_li" optid="teacher"><a>授课设置</a></li>
		<li class="sale slide_li" optid="sale"><a>营销设置</a><span class="tips_bubbling">new</span></li>
		<li class="tuiguang slide_li" optid="tuiguang"><a>推广员设置</a><span class="tips_bubbling">new</span></li>
		<li class="menu slide_li" optid="menu" <?php  if($item['kc_type']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>><a>章节管理</a></li>
		<?php  if($school['is_printer'] ==1) { ?><li class="prints slide_li" optid="prints"><a>打印设置</a></li><?php  } ?>
	</ul>
</div>
<div class="material-body" style="overflow-y: scroll;padding: 34px;height: 600px;">
	<div class="row lists_kc">
		<!--基本设置-->
		<div class="tab-pane" id="baaic">
			<div class="form-group">
				<label class="col-sm-1 control-label"><span class="require">*</span>课程名称</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="name" placeholder="最长40个字，建议简短明了" value="<?php  echo $item['name'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label"><span class="require">*</span>开始时间:</label>
				<div class="col-sm-2">
					<div class="input-group">
					<?php  if($item['start']) { ?>
					 <?php  echo tpl_form_field_date('start', date('Y-m-d', $item['start']))?>
					 <?php  } else { ?>
					<?php  echo tpl_form_field_date('start', date('Y-m-d',TIMESTAMP))?>
					<?php  } ?>
					</div>
				</div>
				<label class="col-sm-1 control-label"><span class="require">*</span>结束时间:</label>
				<div class="col-sm-2">
					<div class="input-group">
					<?php  if($item['end']) { ?>
						<?php  echo tpl_form_field_date('end', date('Y-m-d', $item['end']))?>
					<?php  } else { ?>
						<?php  echo tpl_form_field_date('end', date('Y-m-d',TIMESTAMP+7*86400))?>
					<?php  } ?>
					</div>
				</div>
				<div class="help-block">设置本课程时间总跨度</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">选择分类:</label>
				<div class="col-sm-2">
					<select name="xq" id="select_nj" class="form-control">
						<option value="0">请选择分类</option>
						<?php  if(is_array($xueqi)) { foreach($xueqi as $it) { ?>
						<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['xq_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
						<?php  } } ?>
					</select>
				</div>
				<label class="col-sm-1 control-label">选择科目:</label>
				<div class="col-sm-2">
					<select name="km" class="form-control">
						<option value="0">请选择科目</option>
						<?php  if(is_array($km)) { foreach($km as $it) { ?>
						<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['km_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<?php  if($tuiguang || $tuan || $zhuli) { ?>
			<div class="form-group">
				<label class="col-sm-1 control-label"><span class="require">*</span>课程类型:</label>
				<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
					<div class="input-group">
						<input <?php  if($item['kc_type']==1) { ?>checked value="1"<?php  } else { ?>value="0"<?php  } ?> <?php  if($item) { ?>disabled<?php  } ?> id="kc_type" name="kc_type" class="weui_switch" type="checkbox"/>
						<span class="input-group-addon" id="kc_type_word"><?php  if($item['kc_type']==1) { ?>线上<?php  } else { ?>线下<?php  } ?></span>
					</div>
					<div class="help-block" style="width:190px">设置后不可修改</div>
				</div>
				<?php  if($tuiguang) { ?>
				<div id="st_btn_box" <?php  if($item['kc_type']==1) { ?>style="display:none"<?php  } else { ?>style="display:block"<?php  } ?>>
					<label class="col-sm-1 control-label">试听课程:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($item['is_try']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> <?php  if($item) { ?>disabled<?php  } ?> id="is_try" name="is_try" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="is_try_word"><?php  if($item['is_try']==1) { ?>是<?php  } else { ?>否<?php  } ?></span>
						</div>
						<div class="help-block" style="width:220px">是否为线下试听课,设置后不可修改</div>
					</div>
				</div>
				<?php  } ?>
			</div>
			<?php  } ?>
			<div id="offline_div" <?php  if($item['kc_type']==1) { ?>style="display:none"<?php  } else { ?>style="display:block"<?php  } ?>>
				<div class="form-group">
					<label class="col-sm-1 control-label">课表模式:</label>
					<div class="col-sm-2">
						<select style="margin-right:15px;" name="OldOrNew" id="OldOrNew" class="form-control" <?php  if($item) { ?> disabled<?php  } ?>> 
							<option value="" <?php  if(!$item['OldOrNew']) { ?> selected="selected"<?php  } ?>>选择课表模式</option>
							<option value="0" selected="selected">固定课表课程</option>
							<!-- <option value="1" <?php  if($item['OldOrNew'] == 1) { ?> selected="selected"<?php  } ?>>自由签到课程</option> -->
						</select>
						<div class="help-block">设置后不可修改</div>
					</div>
					<label class="col-sm-1 control-label">授课教室:</label>
					<div class="col-sm-2">
						<select style="margin-right:15px;" name="adrr" id="adrr" class="form-control">
							<option value="">请选择教室</option>
							<?php  if(is_array($addr)) { foreach($addr as $row) { ?>
							<option value="<?php  echo $row['sid'];?>" <?php  if($item['adrr'] == $row['sid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">是否签到:</label>
					<div class="col-sm-3">
						<label class="radio-inline">
							<div class="radio-custom radio-primary">
								<input type="radio" name="is_sign" value="1" id="sign_y" <?php  if($item['isSign']==1 ) { ?>checked<?php  } ?>  <?php  if($item) { ?> disabled<?php  } ?>>
								<label></label>签到
							</div>
						</label>
						<label class="radio-inline">
							<div class="radio-custom radio-primary">
								<input type="radio" name="is_sign" value="0" id="sign_n" <?php  if((isset($item['isSign']) && empty($item['isSign']) || empty($item))) { ?>checked<?php  } ?> <?php  if($item) { ?> disabled<?php  } ?>>
								<label></label>不签
							</div>
						</label>
						<div class="help-block">设置后不可修改</div>
					</div>
				</div>
				<div id="tqqdfw" <?php  if($item['isSign'] == 1 && $item['OldOrNew'] == 0 ) { ?>  style="display: block;" <?php  } else { ?>  style="display:none;" <?php  } ?>>
					<div class="form-group">
						<label class="col-sm-1 control-label">提前签到范围:</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control" name="signTime" value="<?php  echo $item['signTime'];?>" />
								<span class="input-group-addon">分钟</span>
							</div>
							<div class="help-block">开课前多少分钟可以签到，为空则不限制</div>
						</div>
						<label class="col-sm-1 control-label">刷卡时效:</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control" name="rechecktime" value="<?php  echo $item['rechecktime'];?>" />
								<span class="input-group-addon">分钟</span>
							</div>
							<div class="help-block">可刷卡时段内重复刷卡只算一次刷卡,可不设</div>
						</div>
						<label class="col-sm-1 control-label">教师确认:</label>
						<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
							<div class="input-group">
								<input <?php  if($item['tea_sign_confirm']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> id="tea_sign_confirm" name="tea_sign_confirm" class="weui_switch" type="checkbox"/>
								<span class="input-group-addon" id="is_try_word"><?php  if($item['tea_sign_confirm']==1) { ?>是<?php  } else { ?>否<?php  } ?></span>
							</div>
							<div class="help-block" style="width:220px">设置老师签到课程是否需要管理确认</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">上课提醒:</label>
					<div class="col-sm-3">
						<label class="radio-inline">
							<div class="radio-custom radio-primary" >
								<input type="radio" name="is_tx" value="1" <?php  if($item['is_tx']==1 ) { ?>checked<?php  } ?>  id="sign_y2">
								<label></label>开启
							</div>
						</label>
						<label class="radio-inline">
							<div class="radio-custom radio-primary" >
								<input type="radio" name="is_tx" value="2" <?php  if(empty($item['is_tx']) || $item['is_tx']==2) { ?>checked<?php  } ?> id="sign_n2">
								<label></label>关闭
							</div>
						</label>
						<div class="help-block">设置每课开始前是否模板消息提醒学生和老师</div>
					</div>
					<div id="tqtxsj" <?php  if($item['is_tx'] == 1 && $item['OldOrNew'] == 0 ) { ?>  style="display: block;" <?php  } else { ?>style="display:none;" <?php  } ?>>
						<label class="col-sm-1 control-label">提前提醒时间:</label>
						<div class="col-sm-3">
							<div class="input-group">		
								<input type="number" class="form-control" name="txtime" value="<?php  echo $item['txtime'];?>" />
								<span class="input-group-addon">分钟</span>
							</div>
							<div class="help-block">已经排课的每节课开始提醒时间</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">大纲/介绍</label>
					<div class="col-sm-9">
						<div class="help-block">如富文本编辑器未加载，请刷新本页重试</div>
						<?php  echo tpl_ueditor('dagang', $item['dagang']);?>
					</div>
				</div>
			</div>
		</div>
		<!--报名设置-->
		<div class="tab-pane" id="singup" style="display:none">
			<div class="form-group">	
				<label class="col-sm-1 control-label"><span class="require">*</span>报名费用:</label>
				<div class="col-sm-2">
					 <div class="input-group">
						<span class="input-group-addon">￥</span>
						<input type="text" class="form-control" name="cose" value="<?php  echo $item['cose'];?>" />
					 </div>
					 <div class="help-block">输入课程所需费用</div>
				</div>
				<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
				<label class="col-sm-1 control-label">收款账户:</label>
				<div class="col-sm-2">
					 <div class="input-group">
						<select class="form-control" name="payweid" id="payweid">
							<option value="0">请选择收款账户</option>
							<?php  if(is_array($payweid)) { foreach($payweid as $row) { ?>
							<option value="<?php  echo $row['uniacid'];?>" <?php  if($item['payweid']==$row['uniacid']) { ?>selected<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>
						<div class="help-block">不设置则付费至当前公众号</div>
					 </div>
				</div>
				<?php  } else { ?>
					 <input type="hidden" name="payweid" value="{$item['payweid']?$item['payweid']:$_W['uniacid']}" />
				<?php  } ?>
				<div id="sgks_box" <?php  if($item['kc_type']==1) { ?>style="display:none"<?php  } else { ?>style="display:block"<?php  } ?>>
					<label class="col-sm-1 control-label">首购课时:</label>
					<div class="col-sm-2">
						 <div class="input-group">					
							<input type="text" class="form-control" name="FirstNum" value="<?php  echo $item['FirstNum'];?>" required="required" oninvalid="setCustomValidity('首购课时不能为空！！');" oninput="setCustomValidity('');" />
							<span class="input-group-addon">节</span>
						 </div>
						 <div class="help-block">首购含有课时数</div>
					</div>
				</div>
			</div>	
			<div class="form-group">		
				<label class="col-sm-1 control-label">人数限制:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="minge" value="<?php  echo $item['minge'];?>" />
						<span class="input-group-addon">人</span>
					 </div>
					 <div class="help-block">输入课程限报人数</div>
				</div>
				<label class="col-sm-1 control-label">已报人数:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="yibao" placeholder="虚拟已报人数" value="<?php  echo $item['yibao'];?>" />
						<span class="input-group-addon">人</span>
					 </div>
					 <div class="help-block">虚拟报名人数不会影响真实报名</div>
				</div>					
			</div>
			<div class="form-group" id="NewType" <?php  if($item['kc_type']==1) { ?>style="display:none"<?php  } else { ?>style="display:block"<?php  } ?>>
				<label class="col-sm-1 control-label">续购单价:</label>
				<div class="col-sm-2">
					 <div class="input-group">
						<span class="input-group-addon">￥</span>
						<input type="text" class="form-control" name="RePrice" value="<?php  echo $item['RePrice'];?>" />
					 </div>
					 <div class="help-block">每个课时单价</div>
				</div>
				<label class="col-sm-1 control-label">最低续购:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="ReNum" value="<?php  echo $item['ReNum'];?>" />
						<span class="input-group-addon">节</span>
					 </div>
					 <div class="help-block">续购课时最低多少</div>
				</div>
				<label class="col-sm-1 control-label">总课时:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="AllNum" value="<?php  echo $item['AllNum'];?>" required="required" oninvalid="setCustomValidity('总课时不能为空！！');" oninput="setCustomValidity('');" />
						<span class="input-group-addon">节</span>
					 </div>
					 <div class="help-block">预设总课时节数</div>
				</div>
			</div>
			<?php  if($school['Is_point']==1) { ?>
			<div class="form-group">	
				<label class="col-sm-1 control-label">积分抵用:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="Point2Cost" value="<?php  echo $item['Point2Cost'];?>" />
						<div class="help-block">多少积分抵用1元,0则不启用</div>
					 </div>
				</div>	
				<label class="col-sm-1 control-label">积分最低使用:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="MinPoint" value="<?php  echo $item['MinPoint'];?>" />
						<div class="help-block">最低使用多少积分，为零则不限制</div>
					 </div>
				</div>
				<label class="col-sm-1 control-label">积分最高使用:</label>
				<div class="col-sm-2">
					 <div class="input-group">					
						<input type="text" class="form-control" name="MaxPoint" value="<?php  echo $item['MaxPoint'];?>" />
						<div class="help-block">最高使用多少积分，为零则不限制</div>
					 </div>
				</div>					
			</div>
			<?php  } ?>
			<?php  if(keep_sk77()) { ?>
			<div class="form-group" >
				<label class="col-sm-1 control-label">过期天数:</label>
				<div class="col-sm-3">
					<div class="input-group">
						<input type="text" class="form-control" name="OverTimeDay" value="<?php  echo $item['overtimeday'];?>" />
						<span class="input-group-addon">天</span>
					</div>
					<div class="help-block">购买/续购后多久过期,0则永不过期</div>
				</div>
			</div>
			<?php  } ?>
		</div>
		<!--前端设置-->
		<div class="tab-pane" id="mobile" style="display:none">
			<div class="form-group">
				<label class="col-sm-1 control-label">课程评论:</label>
				<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
					<div class="input-group">
						<input <?php  if($item['allow_pl']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> id="allow_pl"  name="allow_pl" class="weui_switch" type="checkbox"/>
						<span class="input-group-addon" id="allow_pl_word"><?php  if($item['allow_pl']==1) { ?>开启<?php  } else { ?>停用<?php  } ?></span>
					</div>
				</div>
				<label class="col-sm-1 control-label">&nbsp;前端显示:</label>
				<div class="col-sm-3">
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_show" value="1" <?php  if($item['is_show']==1 || empty($item['is_show'])) { ?>checked<?php  } ?>>
							<label></label>是
						</div>
					</label>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_show" value="2" <?php  if($item['is_show']==2) { ?>checked<?php  } ?>>
							<label></label>否
						</div>
					</label>
					<div class="help-block">手机前端是否显示:默认显示</div>
				</div>
				<label class="col-sm-1 control-label">&nbsp;报名弹幕:</label>
				<div class="col-sm-3">
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_dm" value="1" <?php  if($item['is_dm']==1 || empty($item['is_dm'])) { ?>checked<?php  } ?>>
							<label></label>是
						</div>
					</label>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_dm" value="2" <?php  if($item['is_dm']==2) { ?>checked<?php  } ?>>
							<label></label>否
						</div>
					</label>
					<div class="help-block">是否显示报名弹幕,需报名大于5人生效</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">&nbsp;精品课程:</label>
				<div class="col-sm-3">
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_hot" value="1" <?php  if($item['is_hot']==1 || empty($item)) { ?>checked<?php  } ?>>
							<label></label>是
						</div>
					</label>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_hot" value="0" <?php  if($item['is_hot']==0) { ?>checked<?php  } ?>>
							<label></label>否
						</div>
					</label>
					<div class="help-block">精品课程显示在首页，和课程详情页</div>
				</div>
				<label class="col-sm-1 control-label">&nbsp;课程小图:</label>
				<div class="col-sm-4">                    
					  <?php  echo tpl_form_field_images('kcthumb', $item['thumb'])?>
					<div class="help-block">推荐尺寸70*70 </div>
				</div>
			</div>				
			<div class="form-group">
				<label class="col-sm-1 control-label">&nbsp;首页推荐:</label>
				<div class="col-sm-3">
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_tuijian" value="1" <?php  if($item['is_tuijian']==1 || empty($item)) { ?>checked<?php  } ?>>
							<label></label>是
						</div>
					</label>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="is_tuijian" value="0" <?php  if($item['is_tuijian']==0) { ?>checked<?php  } ?>>
							<label></label>否
						</div>
					</label>
					<div class="help-block">推荐课程在首页以大图形式展示</div>
				</div>
				<label class="col-sm-1 control-label">&nbsp;课程大图:</label>
				<div class="col-sm-4">                    
					<?php  echo tpl_form_field_images('bigimg', $item['bigimg'])?>
					<div class="help-block">此图显示首页推荐课程列表和课程详情页面，推荐宽高比4:3 </div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">&nbsp;前端排序:</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="ssort" placeholder="请输入数值" value="<?php  echo $item['ssort'];?>" />
					<div class="help-block">数值越大前端显示越靠前</div>
				</div>
			</div>
		</div>
		<!--授课设置-->
		<div class="tab-pane" id="teacher" style="display:none">
			<div class="form-group">
				<label class="col-sm-1 control-label">&nbsp;授课老师:</label>
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 20px;"  ></label>
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="text-align:left;width:80%;max-width: unset" id = "stu_div" >
					<?php  if($thisTealist) { ?>
					<?php  if(is_array($thisTealist)) { foreach($thisTealist as $row) { ?>
					<span class="stuname" style="border:1px solid #e8e8e8; padding:3px 3px;white-space: nowrap;" onclick="del_stu(<?php  echo $row['id'];?>)" id="span_<?php  echo $row['id'];?>"> <?php  echo $row['tname'];?><input class="tidArr" tname="<?php  echo $row['tname'];?>" type = "hidden" name="tidarr[]" value = "<?php  echo $row['id'];?>"><i class="fa fa-times" style="font-size:13px"></i></span>
					<?php  } } ?>
					<?php  } else { ?>
					请选择授课老师，最多五个
					<?php  } ?>
				</label>
			</div>
			<div class="form-group" id="upload_list">
				<label class="col-sm-1 control-label">&nbsp;</label>
				<div class="col-sm-2 col-lg-2" style="width: 20%">
					<select style="margin-right:15px;" name="select_fz" id="select_fz" class="form-control">
						<option value=" ">请选择教师分组</option>
						<option value="0">未分组</option>
						<?php  if(is_array($fz)) { foreach($fz as $it) { ?>
						<option value="<?php  echo $it['sid'];?>"><?php  echo $it['sname'];?></option>
						<?php  } } ?>
					</select>
				</div>
				<label onclick="hideTeaList(this)" id="hideTlist" class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;display: none"  ><i class="fa fa-caret-up"></i>  收起</label>
			</div>
			<div class="form-group" id="teaDIv">
			   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;"></label>
				<div class="col-sm-9 col-xs-6">
					<div class="input-group text-info" id="teacherList">

					</div>
					<div class="help-block">选择授课老师，最多五个</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">&nbsp;主讲老师:</label>
				<div class="col-sm-3">
					<select style="margin-right:15px;" name="maintid" id="maintid" class="form-control">
						 <option value="0"  >请选择主讲老师</option>
						<?php  if(is_array($teachers)) { foreach($teachers as $row_z) { ?>
						 <?php  $is_z = $this->uniarr($uniarr,$row_z['id']);?>
						 <?php  if(($is_z)) { ?>
						<option value="<?php  echo $row_z['id'];?>" <?php  if($item['maintid'] == $row_z['id']) { ?>selected="selected"<?php  } ?> ><?php  echo $row_z['tname'];?></option>
						<?php  } ?>
						<?php  } } ?>
					</select>
				</div>
				<label class="col-sm-1 control-label">预约负责老师:</label>
				<div class="col-sm-3">
					<select style="margin-right:15px;" name="yytid" id="yytid" class="form-control">
						 <option value="0"  >请选择预约负责老师</option>
						<?php  if(is_array($teachers)) { foreach($teachers as $row_yy) { ?>
						<option value="<?php  echo $row_yy['id'];?>" <?php  if($item['yytid'] == $row_yy['id']) { ?>selected="selected"<?php  } ?> ><?php  echo $row_yy['tname'];?></option>
						<?php  } } ?>
					</select>
					<div class="help-block">负责该课程预约的老师</div>
				</div>
			</div>
		</div>	
		<!--打印设置-->
		<div class="tab-pane" id="prints" style="display:none">
			<?php  if($school['is_printer'] ==1) { ?>
			<div class="form-group">
				<label class="col-sm-1 control-label">打印订单:</label>
				<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
					<div class="input-group">
						<input <?php  if($item['is_print']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> id="is_print"  name="is_print" class="weui_switch" type="checkbox"/>
						<span class="input-group-addon" id="print_word"><?php  if($item['is_print']==1) { ?>启用<?php  } else { ?>停用<?php  } ?></span>
					</div>
				</div>
			</div>
			<div id="print_set" <?php  if($item['is_print'] == 1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-sm-1 control-label">销课小票:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($item['is_print_xk']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> id="is_print_xk"  name="is_print_xk" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="print_xk_word"><?php  if($item['is_print_xk']==1) { ?>打印<?php  } else { ?>停用<?php  } ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">打印机</label>
					<div class="col-sm-9">
						<div class="input-group text-info">
							<?php  if(is_array($printers)) { foreach($printers as $uni) { ?>
							<?php  $is = $this->uniarr($nowprints,$uni['id']);?>
									<label for="uni_<?php  echo $uni['id'];?>" class="checkbox-inline"><input id="uni_<?php  echo $uni['id'];?>" type="checkbox" name="printarr[]" value="<?php  echo $uni['id'];?>"<?php  if(($is)) { ?>checked="checked"<?php  } ?>> <?php  echo $uni['name'];?>（<?php  echo $printer_name[$uni['type']]['text'];?>）</label>
							<?php  } } ?>
						</div>
						<div class="help-block">选择本课程小票打印设备</div>
					</div>
				</div>	
			</div>
			<?php  } ?>
		</div>
		<!--营销设置-->
		<div class="tab-pane" id="sale" style="display:none">
			<?php  if($tuan || $zhuli) { ?>
			<div class="form-group">
				<label class="col-sm-1 control-label">营销模式:</label>
				<div class="col-sm-5">
				<?php  if($tuan) { ?>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="sale_type" id="opt_tuan" value="1" <?php  if($item['sale_type']==2) { ?>disabled<?php  } ?> <?php  if($item['sale_type']==1) { ?>checked<?php  } ?>>
							<label></label>团购
						</div>
					</label>
				<?php  } ?>	
				<?php  if($zhuli) { ?>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="sale_type" id="opt_zhuli" value="2" <?php  if($item['sale_type']==1) { ?>disabled<?php  } ?> <?php  if($item['sale_type']==2) { ?>checked<?php  } ?>>
							<label></label>助力
						</div>
					</label>
				<?php  } ?>
					<label class="radio-inline">
						<div class="radio-custom radio-primary">
							<input type="radio" name="sale_type" id="opt_close" value="0" <?php  if($item['sale_type']==0 || empty($item['sale_type'])) { ?>checked<?php  } ?>>
							<label></label>关闭
						</div>
					</label>
					<div class="help-block">选择一种营销模式，支持一种，选择后不可修改</div>
				</div>
			</div>
			<!--团购模式-->
			<div id="tuan_set_box" <?php  if($item['sale_type']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-sm-1 control-label">参团优惠:</label>
					<div class="col-sm-2">
						<div class="input-group">
							<span class="input-group-addon">￥</span>
							<input type="text" class="form-control" name="tuan_price" value="<?php  echo $saleset['price'];?>" />
						</div>
						<div class="help-block old_prcie">原价减去此优惠,需小于原价</div>
					</div>
					<label class="col-sm-1 control-label">团长优惠:</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="text" class="form-control" name="tuan_tzyh" value="<?php  echo $saleset['tuanz_price'];?>" />
							<span class="input-group-addon">元</span>
						</div>
						<div class="help-block">不设置则无</div>
					</div>
					<label class="col-sm-1 control-label">成团人数:</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="text" class="form-control" name="tuan_number" value="<?php  echo $saleset['suc_munber'];?>" />
							<span class="input-group-addon">人</span>
						</div>
						<div class="help-block">最少2人</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label"><span class="require">*</span>活动截止</label>
					<div class="col-sm-2">
						<div class="input-group">
						<?php  if($saleset['endtime']) { ?>
							<?php  echo tpl_form_field_date('tuan_endtime', date('Y-m-d H:i', $saleset['endtime']),true)?>
						<?php  } else { ?>
							<?php  echo tpl_form_field_date('tuan_endtime', date('Y-m-d H:i',TIMESTAMP+7*86400),true)?>
						<?php  } ?>
						</div>
						<div class="help-block">过期后不可参加活动</div>
					</div>
					<label class="col-sm-1 control-label">队伍过期:</label>
					<div class="col-sm-5">
						<label class="radio-inline">
							<div class="radio-custom radio-primary">
								<input type="radio" name="tuan_over_set" id="kc_over" value="1" <?php  if($saleset['overtimeset']==1 || !$saleset) { ?>checked<?php  } ?>>
								<label></label>按活动截止时间
							</div>
						</label>
						<label class="radio-inline">
							<div class="radio-custom radio-primary">
								<input type="radio" name="tuan_over_set" id="zd_over" value="2" <?php  if($saleset['overtimeset']==2) { ?>checked<?php  } ?>>
								<label></label>按自定结束时间
							</div>
						</label>
						<div class="help-block">设置发起一个团购的过期时间,如自定义请设置小时数</div>
					</div>
					<div id="over_time_box" <?php  if($saleset['overtimeset']==2) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
						<label class="col-sm-1 control-label">过期小时:</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="text" class="form-control" name="tuan_over_time" value="<?php  echo $saleset['overtime'];?>" />
								<span class="input-group-addon">小时</span>
							</div>
							<div class="help-block" style="width: 208px;">开团后自动过期时间</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">失败续开:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($saleset['allow_again']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="fail_tuan" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="fail_tuan_word"><?php  if($saleset['allow_again']==1) { ?>允许<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">失败再次开团</div>
					</div>
					<label class="col-sm-1 control-label">虚拟团购:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($saleset['allow_help']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="tuan_xn" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="tuan_xn_word"><?php  if($saleset['allow_help']==1) { ?>允许<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">推广员虚拟帮团</div>
					</div>
					<label class="col-sm-1 control-label">推广海报:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($saleset['use_pop']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="use_pop_tuan" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon"><?php  if($saleset['use_pop']==1) { ?>启用<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">是否启用推广海报</div>
					</div>
				</div>
				<div class="form-group" id="tuan_pop_box" <?php  if($saleset['use_pop']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
					<label class="col-sm-1 control-label">选择海报风格:</label>
					<div class="col-sm-5" style="overflow-y: scroll; height: 148px;margin-top: -22px;">                    
						<div class="style_mb tuan_op_mb" mbid="1">
							<img class="style_mb_img <?php  if($saleset['pop_id'] == 1) { ?>checked<?php  } ?>" src="<?php echo OSSURL;?>public/web/images/pop1.png"/>
							<span class="mb_name">全图风格</span>
							<div class="icon_marsk" <?php  if($saleset['pop_id'] == 1) { ?>style="display:block"<?php  } ?>><span class="gou wi-right"></span></div>
						</div>
						<div class="style_mb tuan_op_mb" mbid="2">
							<img class="style_mb_img <?php  if($saleset['pop_id'] == 2) { ?>checked<?php  } ?>" src="<?php echo OSSURL;?>public/web/images/pop2.png"/>
							<span class="mb_name">上下风格</span>
							<div class="icon_marsk" <?php  if($saleset['pop_id'] == 2) { ?>style="display:block"<?php  } ?>><span class="gou wi-right"></span></div>
						</div>
						<input type="hidden" id="tuan_mb_id" name="tuan_mb_id" value="<?php  echo $saleset['pop_id'];?>" />
					</div>
					<label class="col-sm-1 control-label">海报底图:</label>
					<div class="col-sm-4">                    
						<?php  echo tpl_form_field_images('tuan_bg', $saleset['pop_img'])?>
						<div class="help-block"></div>
					</div>	
				</div>
				<!-- <div class="form-group"> -->
					<!-- <label class="col-sm-1 control-label">海报标题:</label> -->
					<!-- <div class="col-sm-8"> -->
						<!-- <input class="form-control" name="tuan_share_title" placeholder="例：'xx'我为好课代言" value="<?php  echo $saleset['share_title'];?>"/> -->
						<!-- <div class="help-block">显示在海报上的标题</div> -->
					<!-- </div> -->
				<!-- </div> -->
				<div class="form-group">
					<label class="col-sm-1 control-label">分享文案:</label>
					<div class="col-sm-5">
						<textarea class="form-control" name="tuan_wenan" placeholder="例：3天速成英语口语，旅游交流无忧，突破交流障碍，出国旅行吃穿住玩，搭车，飞机，签证，路人交流用语"><?php  echo $saleset['share_word'];?></textarea>
						<div class="help-block">输入分享文案，方便用户复制转发,50字以内</div>
					</div>
					<label class="col-sm-1 control-label">拼团规则:</label>
					<div class="col-sm-5">
						<textarea class="form-control" name="tuan_guize" placeholder="例：每人仅限拼团一次，不可重复参加，不可以多次申请，平团成功后不可退款，本规则解释权贵本平台所有"><?php  echo $saleset['rule_word'];?></textarea>
						<div class="help-block">输入拼团规则方便用户查看,80字以内</div>
					</div>
				</div>
			</div>
			<!--助力模式-->
			<div id="zhuli_set_box" <?php  if($item['sale_type']==2) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-sm-1 control-label">助力优惠:</label>
					<div class="col-sm-2">
						<div class="input-group">
							<span class="input-group-addon">￥</span>
							<input type="text" class="form-control" name="zhuli_price" value="<?php  echo $saleset['price'];?>" />
						</div>
						<div class="help-block old_prcie">原价减去此优惠的支付价格,需小于原价</div>
					</div>
					<label class="col-sm-1 control-label">邀请人数:</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="text" class="form-control" name="zhuli_number" value="<?php  echo $saleset['suc_munber'];?>" />
							<span class="input-group-addon">人</span>
						</div>
						<div class="help-block">最少2人</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label"><span class="require">*</span>活动截止</label>
					<div class="col-sm-2">
						<div class="input-group">
						<?php  if($saleset['endtime']) { ?>
							<?php  echo tpl_form_field_date('zhuli_endtime', date('Y-m-d H:i', $saleset['endtime']),true)?>
						<?php  } else { ?>
							<?php  echo tpl_form_field_date('zhuli_endtime', date('Y-m-d H:i',TIMESTAMP+7*86400),true)?>
						<?php  } ?>
						</div>
						<div class="help-block">过期后不可参加活动</div>
					</div>
					<label class="col-sm-1 control-label">队伍过期:</label>
					<div class="col-sm-5">
						<label class="radio-inline">
							<div class="radio-custom radio-primary">
								<input type="radio" name="zhuli_over_set" id="kc_zhuli_over" value="1" <?php  if($saleset['overtimeset']==1 || !$saleset) { ?>checked<?php  } ?>>
								<label></label>按活动截止时间
							</div>
						</label>
						<label class="radio-inline">
							<div class="radio-custom radio-primary">
								<input type="radio" name="zhuli_over_set" id="zd_zhuli_over" value="2" <?php  if($saleset['overtimeset']==2) { ?>checked<?php  } ?>>
								<label></label>按自定结束时间
							</div>
						</label>
						<div class="help-block">设置发起一个助力活动的过期时间,如自定义请设置小时数</div>
					</div>
					<div id="over_zhuli_time_box" <?php  if($saleset['overtimeset']==2) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
						<label class="col-sm-1 control-label">过期小时:</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="text" class="form-control" name="zhuli_over_time" value="<?php  echo $saleset['overtime'];?>" />
								<span class="input-group-addon">小时</span>
							</div>
							<div class="help-block" style="width: 208px;">开始助力后自动过期时间</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">失败续开:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($saleset['allow_again']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="fail_zhuli" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="fail_zhuli_word"><?php  if($saleset['allow_again']==1) { ?>允许<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">助力失败后是否允许再次开组</div>
					</div>
					<label class="col-sm-1 control-label">虚拟助力:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($saleset['allow_help']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="zhuli_xn" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="zhuli_xn_word"><?php  if($saleset['allow_help']==1) { ?>允许<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">推广员虚拟帮组</div>
					</div>
					<label class="col-sm-1 control-label">推广海报:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($saleset['use_pop']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="use_pop_zl" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon"><?php  if($saleset['use_pop']==1) { ?>启用<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">是否启用推广海报</div>
					</div>
				</div>
				<div class="form-group" id="zl_pop_box" <?php  if($saleset['use_pop']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
					<label class="col-sm-1 control-label">选择海报风格:</label>
					<div class="col-sm-5" style="overflow-y: scroll; height: 148px;margin-top: -22px;">                    
						<div class="style_mb zhuli_op_mb" mbid="1">
							<img class="style_mb_img <?php  if($saleset['pop_id'] == 1) { ?>checked<?php  } ?>" src="<?php echo OSSURL;?>public/web/images/pop1.png"/>
							<span class="mb_name">全图风格</span>
							<div class="icon_marsk" <?php  if($saleset['pop_id'] == 1) { ?>style="display:block"<?php  } ?>><span class="gou wi-right"></span></div>
						</div>
						<div class="style_mb zhuli_op_mb" mbid="2">
							<img class="style_mb_img <?php  if($saleset['pop_id'] == 2) { ?>checked<?php  } ?>" src="<?php echo OSSURL;?>public/web/images/pop2.png"/>
							<span class="mb_name">上下风格</span>
							<div class="icon_marsk" <?php  if($saleset['pop_id'] == 2) { ?>style="display:block"<?php  } ?>><span class="gou wi-right"></span></div>
						</div>
						<input type="hidden" id="zhuli_mb_id" name="zhuli_mb_id" value="<?php  echo $saleset['pop_id'];?>" />
					</div>
					<label class="col-sm-1 control-label">海报底图:</label>
					<div class="col-sm-3">                    
						<?php  echo tpl_form_field_images('zhuli_bg', $saleset['pop_img'])?>
						<div class="help-block"></div>
					</div>	
				</div>
				<!-- <div class="form-group"> -->
					<!-- <label class="col-sm-1 control-label">海报标题:</label> -->
					<!-- <div class="col-sm-8"> -->
						<!-- <input class="form-control" name="zhuli_share_title" placeholder="例：对知识渴求永无止境，助我一臂之力吧" value="<?php  echo $saleset['share_title'];?>"/> -->
						<!-- <div class="help-block">输入分享链接海报标题</div> -->
					<!-- </div> -->
				<!-- </div> -->
				<div class="form-group">
					<label class="col-sm-1 control-label">分享文案:</label>
					<div class="col-sm-5">
						<textarea class="form-control" name="zhuli_wenan" placeholder="例：3天速成英语口语，旅游交流无忧，突破交流障碍，出国旅行吃穿住玩，搭车，飞机，签证，路人交流用语"><?php  echo $saleset['share_word'];?></textarea>
						<div class="help-block">输入分享文案，方便用户复制转发,50字以内</div>
					</div>
					<label class="col-sm-1 control-label">助力规则:</label>
					<div class="col-sm-5">
						<textarea class="form-control" name="zhuli_guize" placeholder="例：每人仅限助力一次，不可重复参加，不可以多次申请，助力成功后不可退款，本规则解释权贵本平台所有"><?php  echo $saleset['rule_word'];?></textarea>
						<div class="help-block">输入助力规则方便用户查看,80字以内</div>
					</div>
				</div>
			</div>
			<?php  } ?>
			<?php  if(!$tuan) { ?>
			<div class="apps_item">
				<div class="apps_box">
					<div class="apps_item_image mb_marsk">
						<img src="<?php echo OSSURL;?>public/mobile/img/tuanapp.png" width="100%"/>
					</div>
					<div class="apps_item_info">
						<div class="apps_item_name">
							课程团购
							<span class="yaz"></span>
							<a class="apps_infos" style="color: red;">未安装</a>
						</div>
						<div class="app_info">支持团购海报，课程团购，团长优惠，团购统计，虚拟拼团</div>
						<div class="btnlist tuan"><a class="apps_infos" style="color: red;">联系管理员安装</a></div>
					</div>
				</div>
			</div>
			<?php  } ?>
			<?php  if(!$zhuli) { ?>
			<div class="apps_item">
				<div class="apps_box">
					<div class="apps_item_image mb_marsk">
						<img src="<?php echo OSSURL;?>public/mobile/img/zhuliapp.png" width="100%"/>
					</div>
					<div class="apps_item_info">
						<div class="apps_item_name">
							课程助力
							<span class="yaz"></span>
							<a class="apps_infos" style="color: red;">未安装</a>
						</div>
						<div class="app_info">支持助力海报，助力优惠，助力统计，虚拟助力</div>
						<div class="btnlist tuan"><a class="apps_infos" style="color: red;">联系管理员安装</a></div>
					</div>
				</div>
			</div>
			<?php  } ?>
		</div>
		<!--推广员设置-->
		<div class="tab-pane" id="tuiguang" style="display:none">
			<?php  if($tuiguang) { ?>
			<div class="form-group">
				<label class="col-sm-1 control-label">启用推广:</label>
				<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
					<div class="input-group">
						<input <?php  if($item['allow_tuiguang']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?>  name="allow_tuiguang" class="weui_switch" type="checkbox"/>
						<span class="input-group-addon" id="allow_tuiguang_word"><?php  if($item['allow_tuiguang']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
					</div>
					<div class="help-block" style="width: 190px;">是否启用推广功能</div>
				</div>
				<div id="pt_fans_tg" <?php  if($item['allow_tuiguang']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
					<label class="col-sm-1 control-label" style="margin-left: 25px;">普通用户参与:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($tgset['allow_normal']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="allow_normal" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon" id="allow_fans_tg_word"><?php  if($tgset['allow_normal']==1) { ?>允许<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">普通用户可以生成海报并推广,且课程前端会显示排名</div>
					</div>
				</div>
			</div>
			<div id="tuiguang_box" <?php  if($item['allow_tuiguang']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-sm-1 control-label">显示排名:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($tgset['show_ranking']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="show_ranking" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon"><?php  if($tgset['show_ranking']==1) { ?>启用<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">推广员端显示推广排名</div>
					</div>
					<label class="col-sm-1 control-label">任务要求:</label>
					<div class="col-sm-2">
						 <div class="input-group">
							<input type="text" class="form-control" name="tg_number" value="<?php  echo $tgset['tg_number'];?>" />
							<span class="input-group-addon">人</span>
						 </div>
						 <div class="help-block" style="width: 190px;">设置每人需要完成邀请的人数</div>
					</div>
				</div>
				<!-- <div class="form-group"> -->
					<!-- <label class="col-sm-1 control-label">销售提成:</label> -->
					<!-- <div class="col-sm-1" style="padding:0px;margin-left: 25px;"> -->
						<!-- <div class="input-group"> -->
							<!-- <input <?php  if($tgset['is_royalty']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="is_royalty" class="weui_switch" type="checkbox"/> -->
							<!-- <span class="input-group-addon"><?php  if($tgset['is_royalty']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span> -->
						<!-- </div> -->
						<!-- <div class="help-block" style="width: 190px;">启用后,会在推广员端显示和计算提成数据</div> -->
					<!-- </div> -->
					<!-- <div id="tc_type_box" <?php  if($tgset['is_royalty']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>> -->
						<!-- <label class="col-sm-1 control-label">提成方式:</label> -->
						<!-- <div class="col-sm-2"> -->
							<!-- <select name="need_done" class="form-control"> -->
								<!-- <option value="1">需要完成任务</option> -->
								<!-- <option value="2">无需完成任务</option> -->
							<!-- </select> -->
							<!-- <div class="help-block">选择一种提成计算方式</div> -->
						<!-- </div> -->
					<!-- </div> -->
				<!-- </div> -->
				<!-- <div class="form-group" id="sale_tc_box" <?php  if($tgset['is_royalty']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>> -->
					<!-- <label class="col-sm-1 control-label">销售提成:</label> -->
					<!-- <div class="col-sm-3"> -->
						 <!-- <div class="input-group"> -->
							<!-- <input type="text" class="form-control" name="royalty" value="<?php  echo $tgset['royalty'];?>" /> -->
							<!-- <span class="input-group-addon">元/人</span> -->
						 <!-- </div> -->
						 <!-- <div class="help-block">每报名成功本课1人销售提成</div> -->
					<!-- </div> -->
					<!-- <label class="col-sm-1 control-label">续购课时:</label> -->
					<!-- <div class="col-sm-3"> -->
						 <!-- <div class="input-group"> -->
							<!-- <input type="text" class="form-control" name="xg_royalty" value="<?php  echo $tgset['xg_royalty'];?>" /> -->
							<!-- <span class="input-group-addon">元/人/节</span> -->
						 <!-- </div> -->
						 <!-- <div class="help-block">学员转正后续购课时提成,不设则不启用</div> -->
					<!-- </div> -->
				<!-- </div> -->
				<div class="form-group">
					<label class="col-sm-1 control-label">选择推广员:</label>
					<div class="col-sm-8">
						<div class="row row-fix">
							<div class="col-xs-8 col-sm-8" style="width: 800px;">
								<div class="input-group">
									<input id="sh_teacherids" name="sh_teacherids" type="hidden" value="<?php  echo $sh_teaid;?>"/>
									<input class="form-control" id="sh_teachers" type="text" value="<?php  echo $sh_tealist;?>"/>
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" onclick="xxxz();">选择</button>
									</span>
								</div>
							</div>
						</div>
						<span class="help-block">请选择本课推广员，可多选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">推广海报:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input <?php  if($tgset['use_pop']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="use_pop_tg" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon"><?php  if($tgset['use_pop']==1) { ?>启用<?php  } else { ?>禁止<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">是否启用推广海报</div>
					</div>
					<label class="col-sm-1 control-label">前端报名:</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 35px;">
						<div class="input-group">
							<input <?php  if($tgset['mobile_sign']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> name="mobile_sign" class="weui_switch" type="checkbox"/>
							<span class="input-group-addon"><?php  if($tgset['mobile_sign']==1) { ?>是<?php  } else { ?>否<?php  } ?></span>
						</div>
						<div class="help-block" style="width: 190px;">设置直接在前端报名的学员是否需要跟进</div>
					</div>
					<div id="mobile_sign_fp" <?php  if($tgset['mobile_sign']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
						<label class="col-sm-1 control-label">分配方式:</label>
						<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
							<div class="input-group">
								<input <?php  if($tgset['mobile_sign_fp']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?>  name="mobile_sign_fp" class="weui_switch" type="checkbox"/>
								<span class="input-group-addon"><?php  if($tgset['mobile_sign_fp']==1) { ?>顺序<?php  } else { ?>随机<?php  } ?></span>
							</div>
							<div class="help-block" style="width: 300px;">自主前端报名学员分配给推广员跟进,注意:一旦分配给推广员如设置了提成将会学员消费将会计入该推广员</div>
						</div>
					</div>
				</div>
				<div id="tg_pop_box" <?php  if($tgset['use_pop']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
					<!-- <div class="form-group"> -->
						<!-- <label class="col-sm-1 control-label">海报标题:</label> -->
						<!-- <div class="col-sm-8"> -->
							<!-- <input class="form-control" name="tuiguang_share_title" placeholder="例：好课不等人，开课就差您。" value="<?php  echo $tgset['share_title'];?>"/> -->
							<!-- <div class="help-block">输入分享链接海报标题，30字内</div> -->
						<!-- </div> -->
					<!-- </div> -->
					<div class="form-group">
						<label class="col-sm-1 control-label">推广海报风格:</label>
						<div class="col-sm-5" style="overflow-y: scroll; height: 148px;margin-top: -22px;">                    
							<div class="style_mb tuiguang_op_mb" mbid="1">
								<img class="style_mb_img <?php  if($tgset['pop_id'] == 1) { ?>checked<?php  } ?>" src="<?php echo OSSURL;?>public/web/images/pop1.png"/>
								<span class="mb_name">全图风格</span>
								<div class="icon_marsk" <?php  if($tgset['pop_id'] == 1) { ?>style="display:block"<?php  } ?>><span class="gou wi-right"></span></div>
							</div>
							<div class="style_mb tuiguang_op_mb" mbid="2">
								<img class="style_mb_img <?php  if($tgset['pop_id'] == 2) { ?>checked<?php  } ?>" src="<?php echo OSSURL;?>public/web/images/pop2.png"/>
								<span class="mb_name">上下风格</span>
								<div class="icon_marsk" <?php  if($tgset['pop_id'] == 2) { ?>style="display:block"<?php  } ?>><span class="gou wi-right"></span></div>
							</div>
							<input type="hidden" id="tuiguang_mb_id" name="tuiguang_mb_id" value="<?php  echo $tgset['pop_id'];?>" />
						</div>
						<label class="col-sm-1 control-label">海报底图:</label>
						<div class="col-sm-3">                    
							<?php  echo tpl_form_field_images('tuiguang_bg', $tgset['pop_img'])?>
							<div class="help-block"></div>
						</div>
						<div class="col-sm-5">
							<textarea class="form-control" name="tuiguang_wenan" placeholder="例：3天速成英语口语，旅游交流无忧，突破交流障碍，出国旅行吃穿住玩，搭车，飞机，签证，路人交流用语"><?php  echo $tgset['share_word'];?></textarea>
							<div class="help-block">输入推广文案，方便推广员复制转发,50字以内</div>
						</div>
					</div>	
				</div>
			</div>
			<?php  } ?>
			<?php  if(!$tuiguang) { ?>
			<div class="apps_item">
				<div class="apps_box">
					<div class="apps_item_image mb_marsk">
						<img src="<?php echo OSSURL;?>public/mobile/img/tuiguangapp.png" width="100%"/>
					</div>
					<div class="apps_item_info">
						<div class="apps_item_name">
							推广员系统
							<span class="yaz"></span>
							<a class="apps_infos" style="color: red;">未安装</a>
						</div>
						<div class="app_info">推广员管理，学员跟踪，推广任务管理，推广绩效管理，数据统计</div>
						<div class="btnlist tuan"><a class="apps_infos" style="color: red;">联系管理员安装</a></div>
					</div>
				</div>
			</div>
			<?php  } ?>
		</div>
		<!--章节设置-->
		<div class="tab-pane" id="menu" style="display:none">
			<div class="form-group">
				<label class="col-sm-1 control-label">启用章节:</label>
				<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
					<div class="input-group">
						<input <?php  if($item['allow_menu']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> id="allow_menu"  name="allow_menu" class="weui_switch" type="checkbox"/>
						<span class="input-group-addon" id="allow_menu_word"><?php  if($item['allow_menu']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
					</div>
					<div class="help-block" style="width: 400px;">是否启用章节功能,不启用则课时归类到"课程安排"类别</div>
				</div>
			</div>	
			<div id="menu_box" <?php  if($item['allow_menu']==1) { ?>style="display:block"<?php  } else { ?>style="display:none"<?php  } ?>>
				<div id="menu_box_list">
				<?php  if($menu_list) { ?>
				<?php  if(is_array($menu_list)) { foreach($menu_list as $row) { ?>
					<div class="form-group">
						<label class="col-sm-1 control-label">章节:</label>
						<a href="javascript:;" class="custom-url-del delteclassicon" data-id="<?php  echo $row['id'];?>"><i class="fa fa-times-circle"></i></a>
						<div class="col-sm-5">
							<input type="hidden" name="meunid[]" value="<?php  echo $row['id'];?>"/>
							<input type="text" class="form-control" name="menu_name[]" placeholder="如:第一章:开发创新思维能力" value="<?php  echo $row['name'];?>" />
						</div>
					</div>
				<?php  } } ?>
				<?php  } else { ?>
					<div class="form-group">
						<label class="col-sm-1 control-label">章节:</label>
						<a href="javascript:;" class="custom-url-del delteclassicon" data-id=""><i class="fa fa-times-circle"></i></a>
						<div class="col-sm-5">
							<input type="hidden" name="meunid[]" value=""/>
							<input type="text" class="form-control" name="menu_name[]" placeholder="如:第一章:开发创新思维能力" value="" />
						</div>
					</div>
				<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<a id="custom-url-add"><i class="fa fa-plus-circle"></i>添加章节</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$('#sign_y2').click(function(){
	$('#tqtxsj').show(100)
});
$('#sign_n2').click(function(){
	$('#tqtxsj').hide(100)
});
$('#sign_y').click(function(){
	$('#tqqdfw').show(100)
});
$('#sign_n').click(function(){
	$('#tqqdfw').hide(100)
});
$('#opt_tuan').click(function(){//销售模式切换
	$('#tuan_set_box').slideDown(150)
	$('#zhuli_set_box').slideUp(100)
});
$('#opt_zhuli').click(function(){
	$('#tuan_set_box').slideUp(150)
	$('#zhuli_set_box').slideDown(100)
});
$('#opt_close').click(function(){
	$('#tuan_set_box').slideUp(100)
	$('#zhuli_set_box').slideUp(100)
});
$('#zd_over').click(function(){
	$('#over_time_box').show()
});
$('#kc_over').click(function(){
	$('#over_time_box').hide()
});
$('#zd_zhuli_over').click(function(){
	$('#over_zhuli_time_box').show()
});
$('#kc_zhuli_over').click(function(){
	$('#over_zhuli_time_box').hide()
});
$('.tuan_op_mb').click(function(e){//勾选团购海报 
	$('.icon_marsk').hide()	
	$('.style_mb_img').removeClass('checked')
	$(this).find('.style_mb_img').addClass('checked')
	$(this).find('.icon_marsk').show()
	$("#tuan_mb_id").val($(this).attr('mbid'))
});
$('.zhuli_op_mb').click(function(e){//勾选助力海报
	$('.icon_marsk').hide()	
	$('.style_mb_img').removeClass('checked')
	$(this).find('.style_mb_img').addClass('checked')
	$(this).find('.icon_marsk').show()
	$("#zhuli_mb_id").val($(this).attr('mbid'))
});
$('.tuiguang_op_mb').click(function(e){//勾选推广海报
	$('.icon_marsk').hide()	
	$('.style_mb_img').removeClass('checked')
	$(this).find('.style_mb_img').addClass('checked')
	$(this).find('.icon_marsk').show()
	$("#tuiguang_mb_id").val($(this).attr('mbid'))
});	
$('.weui_switch').click(function(){//纽扣按钮的逻辑处理
	var name = $(this).attr("name")
	if(name == 'allow_tuiguang'){//启用推广员
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
		if(thisval == 1){
			$('#tuiguang_box').slideDown(100)
			$('#pt_fans_tg').show()
		}
		if(thisval == 2){
			$('#tuiguang_box').slideUp(100)
			$('#pt_fans_tg').hide()
		} 
	}else if(name == 'mobile_sign'){//前端报名跟进
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"是":"否";
		if(thisval == 1){
			$('#mobile_sign_fp').show(100)
		}
		if(thisval == 2){
			$('#mobile_sign_fp').hide(100)
		}	
	}else if(name == 'allow_menu'){//是否允许章节
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
		if(thisval == 1){
			$('#menu_box').slideDown(100)
		}
		if(thisval == 2){
			$('#menu_box').slideUp(100)
		}
	}else if(name == 'is_royalty'){//切换是否提成
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
		if(thisval == 1){
			$('#sale_tc_box').slideDown(100)
			$('#tc_type_box').show(100)
		}
		if(thisval == 2){
			$('#sale_tc_box').slideUp(100)
			$('#tc_type_box').hide()
		}
	}else if(name == 'kc_type'){//切换是否线上线下
		var thisval = $(this).prop('checked')?1:0;
		var word = $(this).prop('checked')?"线上":"线下";
		if(thisval == 1){
			$('#offline_div').slideUp(100)
			$('.menu').show(100)
			$('#st_btn_box').hide()
			$('#sgks_box').hide()
			$('#NewType').hide()
		}
		if(thisval == 0){
			$('#offline_div').slideDown(100)
			$('#sgks_box').show()
			$('#NewType').show()
			$('#st_btn_box').show(100)
			$('.menu').hide(100)
		}
	}else if(name == 'use_pop_tuan'){//是否启用团购海报
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
		if(thisval == 1){
			$('#tuan_pop_box').show(100)
		}
		if(thisval == 2){
			$('#tuan_pop_box').hide(100)
		}
	}else if(name == 'use_pop_zl'){//是否启用助理海报
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
		if(thisval == 1){
			$('#zl_pop_box').show(100)
		}
		if(thisval == 2){
			$('#zl_pop_box').hide(100)
		}
	}else if(name == 'use_pop_tg'){//是否启用推广海报
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
		if(thisval == 1){
			$('#tg_pop_box').show(100)
		}
		if(thisval == 2){
			$('#tg_pop_box').hide(100)
		}
	}else if(name == 'is_print'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"停用";
		if(thisval == 1){
			$('#print_set').slideDown(100);
		}
		if(thisval == 2){
			$('#print_set').slideUp(100);
		}
	}else if(name == 'mobile_sign_fp'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"顺序":"随机";	
	}else if(name == 'is_try'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"是":"否";	
	}else if(name == 'allow_normal'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"允许":"禁止";
	}else if(name == 'is_print_xk'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"停用";
	}else if(name == 'allow_pl'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"停用";
	}else if(name == 'fail_tuan'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
	}else if(name == 'tuan_xn'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
	}else if(name == 'fail_zhuli'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
	}else if(name == 'zhuli_xn'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁用";
	}else if(name == 'tea_sign_confirm'){
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"是":"否";
	}else{
		var thisval = $(this).prop('checked')?1:2;
		var word = $(this).prop('checked')?"启用":"禁止";
	}
	$(this).val(thisval)
	$(this).next().text(word);
});
$('.addkc_opt li').click(function(){
	var opt = $(this).attr("optid")
	$(this).parent().children('li').removeClass("act");
	$(this).addClass("act")
	$(".lists_kc").children().slideUp(200)
	$("#"+opt).slideDown(200)
});
$('#select_fz').change(function(){
	var schoolid = "<?php  echo $schoolid;?>";
	var fzId = $("#select_fz option:selected").attr('value');
	if(fzId != null && fzId !=' '){
		$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'GetTeachersByFz','schoolid'=>$schoolid))?>", {'fz_id':fzId}, function(data) {

			console.log(data)
			var html   = '';
			if (data != '') {
				for (var i in data) {
					var is_checked = '';
					if($("#span_"+data[i].id).length > 0 ){
						is_checked = 'checked';
					}
					html += '<label  class="checkbox-inline" style="width:10%;margin-left: 10px"><input type="checkbox"  onclick="check_count(this)" id="Check_'+data[i].id+'" value="'+data[i].id+'" tname="'+data[i].tname+'" style="float: none;" >'+data[i].tname+'</label>';
				}
			}
			$('#teacherList').html(html);
			$('#teaDIv').slideDown();
			$("#hideTlist").html('<i class="fa fa-caret-up"></i>  收起');
			$("#hideTlist").show();
			sildeType = 1;
		},'json');

	}
});
var sildeType = 1 ;
var countSelectedT = <?php  echo $countSelectedTea;?> ;
function  hideTeaList(e) {
	console.log(sildeType)
	$('#teaDIv').slideToggle();
	sildeType = sildeType == 1 ? 0 : 1;
	if(sildeType == 1){
	 	$(e).html('<i class="fa fa-caret-up"></i>  收起');
	}else if(sildeType == 0){
		$(e).html('<i class="fa fa-caret-down"></i>  展开');
	}
}

function check_count(th){
	let value_th = $(th).val();
	let tName = $(th).attr(`tname`);

	if($(th).is(':checked') == false){
		del_stu(value_th)
	}else if($(th).is(':checked') == true){
		console.log(countSelectedT)

		if(countSelectedT < 5){
			console.log(countSelectedT)

			countSelectedT = countSelectedT + 1 ;
			let addhtml = '<span class="stuname" style="border: 1px solid #e8e8e8; padding:3px 3px;white-space: nowrap;" onclick="del_stu('+value_th+')" id="span_'+value_th+'">'+tName+'<input class="tidArr" type = "hidden" name="tidarr[]" value = "'+value_th+'" tname="'+tName+'"><i class="fa fa-times" style="font-size: 13px;"></i></span>';
			if(countSelectedT == 1){
				$('#stu_div').html(addhtml);
			}else{
				$('#stu_div').append(addhtml);
			}
		}else{
			console.log(countSelectedT)
			th.checked = false;
			alert("对不起，一个课程最多只能指定五个授课老师");
			return;
		}
	}
	let html = ' <option value="0" >请选择主讲老师</option> ';
	$("input.tidArr").each(function(){
		console.log("YES");
		var tid_j = $(this).attr("value");
		var tname_j = $(this).attr("tname");
		var choosetid = 0 ;
		<?php  if(!empty($item['maintid'])) { ?>
		choosetid = <?php  echo $item['maintid'];?>;
		<?php  } else if(empty($item['maintid']) && !empty($item['tid'])) { ?>
		choosetid = <?php  echo $item['tid'];?>;
		<?php  } ?>
		
		
			if(choosetid == tid_j){
				html +=' <option value="'+ tid_j +'"  selected=\"selected\">'+ tname_j +'</option>';
			} else {
				html +=' <option value="'+ tid_j +'">'+ tname_j +'</option>';
			}
		});
	$("#maintid").html(html);
}


function del_stu(id){
	countSelectedT --;

	$("#span_"+id).remove();
	$("#Check_"+id).prop('checked',false);
	$("#checkbox_"+id).attr("checked",false);
	var text11 = $("#stu_div").text();
	var span_length = $("#stu_div span").length;
	console.log(countSelectedT);
	if(span_length == 0 ){
		var endhtml = "请选择授课老师";
		$("#stu_div").html(endhtml);
	}
	let html = ' <option value="0" >请选择主讲老师</option> ';
	$("input.tidArr").each(function(){
		console.log("YES");
		var tid_j = $(this).attr("value");
		var tname_j = $(this).attr("tname");
		var choosetid = 0 ;
		<?php  if(!empty($item['maintid'])) { ?>
		choosetid = <?php  echo $item['maintid'];?>;
		<?php  } else if(empty($item['maintid']) && !empty($item['tid'])) { ?>
		choosetid = <?php  echo $item['tid'];?>;
		<?php  } ?>
			if(choosetid == tid_j){
				html +=' <option value="'+ tid_j +'"  selected=\"selected\">'+ tname_j +'</option>';
			} else {
				html +=' <option value="'+ tid_j +'">'+ tname_j +'</option>';
			}
		});
	$("#maintid").html(html);
}
$('#custom-url-add').click(function(){
	var html =  '<div class="form-group">'+
				'	<label class="col-sm-1 control-label">章节:</label>'+
				'	<a href="javascript:;" class="custom-url-del delteclassicon" onclick="del_zj(this)" data-id=""><i class="fa fa-times-circle"></i></a>'+
				'	<div class="col-sm-5">'+
				'		<input type="hidden" name="meunid[]" value=""/>'+
				'		<input type="text" class="form-control" name="menu_name[]" placeholder="如:第一章:开发创新思维能力" value="" />'+
				'	</div>'+
				'</div>';
	$('#menu_box_list').append(html)	
});
$('.custom-url-del').click(function(){
	let dataid = $(this).attr("data-id");
	if(dataid > 0){
		if(confirm("此章节已创建,确定删除?")){
			$.ajax({
				url: "<?php  echo $this->createWebUrl('kecheng', array('op' => 'del_menu', 'schoolid' => $schoolid))?>"+"&menuid="+dataid,
				type: "POST",
				dataType: "json",
				success: function (res) {
					if(res.result){

					}
					alert(res.msg);
				},
				error: function(e) {
					alert('访问网络失败');
				}
			});
		$(this).parent().remove();
		}
	}
});
function del_zj(elm){
	$(elm).parent().remove();
}
$(function () {
	var url = "<?php  echo $_W['attachurl'];?>"
	var x = 100;
	var y = -200;
	$(".show_yulan_img").mouseover(function (e) {
	var imgsrc = $(this).parent().parent().children().eq(0).val();
	if(imgsrc.indexOf("http") > 0 ) {
		var img = imgsrc
	}else{
		var img = url+imgsrc
	}
	var tooltip = "<div id='tooltip'><img src='" + img + "' width='300' height='auto' /></div>";
	if(imgsrc){
		$("body").append(tooltip);
	}
	$("#tooltip").css({	"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px"}).show("fast");
	}).mouseout(function (e) {$("#tooltip").remove();}).mousemove(function (e) {$("#tooltip").css({	"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px"});	});
})
$(function () {
	var x = 100;
	var y = -200;
	$(".style_mb_img").mouseover(function (e) {
	var imgsrc = $(this).attr('src');
	var img = imgsrc
	var tooltip = "<div id='tooltip'><img src='" + img + "' width='300' height='auto' /></div>";
	if(imgsrc){
		$("body").append(tooltip);
	}
	$("#tooltip").css({	"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px"}).show("fast");
	}).mouseout(function (e) {$("#tooltip").remove();}).mousemove(function (e) {$("#tooltip").css({	"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px"});	});
})
$(function(){
	$(".edui-default").css('z-index','2050')
})
</script>