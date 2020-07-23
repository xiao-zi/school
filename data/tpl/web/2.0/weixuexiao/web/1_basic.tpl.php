<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">通知配置</a></li>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'refund')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('refund')?>">退款设置</a></li><?php  } ?>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?>	<li <?php  if(($_GPC['do'] == 'sms')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('sms')?>">短信配置</a></li><?php  } ?>
    <?php  if($_W['isfounder']) { ?><li <?php  if(($_GPC['do'] == 'upgrade')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('upgrade')?>">在线升级</a></li><?php  } ?>
	<?php  if($_W['isfounder'] || $state == 'owner') { ?><li <?php  if(($_GPC['do'] == 'help')) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('help')?>" target="_blank">帮助教程</a></li><?php  } ?>
</ul>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                模版消息通知 
				<span style="color:red">当前行业：</span>
				<span class="label label-info"><?php  echo $first_class;?> -<?php  echo $second_class;?></span>,
				<span class="label label-info"><?php  echo $first_class1;?> -<?php  echo $second_class1;?></span>
				<?php  if($second_class1 != '院校' && $second_class != '培训') { ?><span class="btn btn-success" onclick="settemp(this)"><i class="fa fa-edit"></i>一键重设</span><?php  } ?>
            </div>
			<?php  if($_W['isfounder'] || $state == 'owner') { ?>	
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">消息通知</label>
                    <div class="col-sm-9">
                        <label for="isshow1" class="radio-inline"><input type="radio" name="istplnotice" value="1" 通知="isshow1" <?php  if($setting['istplnotice'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow2" class="radio-inline"><input type="radio" name="istplnotice" value="0" 通知="isshow2"  <?php  if(empty($setting) || $setting['istplnotice'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block">不填写短信配置则不发送短信</span>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">验证码设置</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="code_time" placeholder="输入绑定验证码有效期" value="<?php  echo $bd_set['code_time'];?>" class="form-control"/>以秒单位计算
							<div class="help-block">请尽量设置超过5分钟</div>
						</div>
                    </div>					
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bd_singname" value="<?php  echo $bd_set['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bd_code" value="<?php  echo $bd_set['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 验证码 ${code} </div>
						</div>
                    </div>					
                </div>				
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学生请假申请通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xsqingjia" value="<?php  if(!empty($xsqingjia['xsqingjia'])) { ?><?php  echo $xsqingjia['xsqingjia'];?><?php  } else { ?><?php  echo $setting['xsqingjia'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$xsqingjia['xsqingjia']) { ?><span class="label label-info" onclick="addtemp('xsqingjia',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">学生请假申请</span>”编号为TM00190的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xsqingjia_singname" value="<?php  echo $xsqingjia['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xsqingjia_code" value="<?php  echo $xsqingjia['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} 发布时间 ${time} (老师收)</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学生请假审核通知</label>
                     <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xsqjsh" value="<?php  if(!empty($xsqjsh['xsqjsh'])) { ?><?php  echo $xsqjsh['xsqjsh'];?><?php  } else { ?><?php  echo $setting['xsqjsh'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$xsqjsh['xsqjsh']) { ?><span class="label label-info" onclick="addtemp('xsqjsh',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">请假审核通知</span>”编号为OPENTM200864357的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xsqjsh_singname" value="<?php  echo $xsqjsh['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xsqjsh_code" value="<?php  echo $xsqjsh['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} （如：小明妈妈）状态 ${type} （状态= 同意or不同意）(家长或学生收)</div>
						</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">教员请假申请提醒通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jsqingjia" value="<?php  if(!empty($jsqingjia['jsqingjia'])) { ?><?php  echo $jsqingjia['jsqingjia'];?><?php  } else { ?><?php  echo $setting['jsqingjia'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$jsqingjia['jsqingjia']) { ?><span class="label label-info" onclick="addtemp('jsqingjia',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">请假审核提醒</span>”编号为OPENTM203328559的模板
							</div>
						</div>	
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jsqingjia_singname" value="<?php  echo $jsqingjia['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jsqingjia_code" value="<?php  echo $jsqingjia['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 请假教师姓名 ${name} 请假时间 ${time} (校长或年级主任收)</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">教员请假审核结果通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jsqjsh" value="<?php  if(!empty($jsqjsh['jsqjsh'])) { ?><?php  echo $jsqjsh['jsqjsh'];?><?php  } else { ?><?php  echo $setting['jsqjsh'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$jsqjsh['jsqjsh']) { ?><span class="label label-info" onclick="addtemp('jsqjsh',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">请假审批结果通知</span>”编号为OPENTM207256255的模板
							</div>
						</div>	
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jsqjsh_singname" value="<?php  echo $jsqjsh['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jsqjsh_code" value="<?php  echo $jsqjsh['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 请假教师姓名 ${name} 状态 ${type} （状态 = 同意 or 不同意）（请假人本人收）</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学校通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xxtongzhi" value="<?php  if(!empty($xxtongzhi['xxtongzhi'])) { ?><?php  echo $xxtongzhi['xxtongzhi'];?><?php  } else { ?><?php  echo $setting['xxtongzhi'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$xxtongzhi['xxtongzhi']) { ?><span class="label label-info" onclick="addtemp('xxtongzhi',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">学校通知</span>”编号为OPENTM204845041的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xxtongzhi_singname" value="<?php  echo $xxtongzhi['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="xxtongzhi_code" value="<?php  echo $xxtongzhi['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 接收者姓名（如 张起灵老师或小明妈妈） ${name} 发布时间 ${time}</div>
						</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">放学和班级通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjtz" value="<?php  if(!empty($bjtz['bjtz'])) { ?><?php  echo $bjtz['bjtz'];?><?php  } else { ?><?php  echo $setting['bjtz'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$bjtz['bjtz']) { ?><span class="label label-info" onclick="addtemp('bjtz',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">班级通知</span>”编号为OPENTM204533457的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjtz_singname" value="<?php  echo $bjtz['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjtz_code" value="<?php  echo $bjtz['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 接收者姓名（如：小明妈妈） ${name} 发布时间 ${time}  通知类型${type}  （通知类型=放学通知or班级通知）</div>
						</div>
                    </div>					
                </div>				
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">家长留言通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="liuyan" value="<?php  if(!empty($liuyan['liuyan'])) { ?><?php  echo $liuyan['liuyan'];?><?php  } else { ?><?php  echo $setting['liuyan'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$liuyan['liuyan']) { ?><span class="label label-info" onclick="addtemp('liuyan',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">意见发聩通知</span>”编号为OPENTM412814927的模板
							</div>
						</div>
						<div class="help-block">家长留言/通讯录私聊共用</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="liuyan_singname" value="<?php  echo $liuyan['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="liuyan_code" value="<?php  echo $liuyan['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 发送者姓名 ${name}（如：小明妈妈） 留言时间 ${time}（老师或学生家长收 姓名=发送人的姓名）</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">教师回复家长留言通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="liuyanhf" value="<?php  if(!empty($liuyanhf['liuyanhf'])) { ?><?php  echo $liuyanhf['liuyanhf'];?><?php  } else { ?><?php  echo $setting['liuyanhf'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$liuyanhf['liuyanhf']) { ?><span class="label label-info" onclick="addtemp('liuyanhf',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">意见发聩通知</span>”编号为OPENTM412814927的模板
							</div>
						</div>
						<div class="help-block">此方法现在仅用于对话班主任，班主任回复学校调用了</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="liuyanhf_singname" value="<?php  echo $liuyanhf['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="liuyanhf_code" value="<?php  echo $liuyanhf['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} 回复时间 ${time}（家长或学生收）</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">作业提醒通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="zuoye" value="<?php  if(!empty($zuoye['zuoye'])) { ?><?php  echo $zuoye['zuoye'];?><?php  } else { ?><?php  echo $setting['zuoye'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$zuoye['zuoye']) { ?><span class="label label-info" onclick="addtemp('zuoye',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">作业消息提醒</span>”编号为OPENTM207873178的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="zuoye_singname" value="<?php  echo $zuoye['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="zuoye_code" value="<?php  echo $zuoye['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 老师姓名 ${name} 发布时间 ${time} （如：老师姓名= 【语文】-张起灵）</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈审核结果通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjqshjg" value="<?php  if(!empty($bjqshjg['bjqshjg'])) { ?><?php  echo $bjqshjg['bjqshjg'];?><?php  } else { ?><?php  echo $setting['bjqshjg'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$bjqshjg['bjqshjg']) { ?><span class="label label-info" onclick="addtemp('bjqshjg',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">审核结果通知</span>”编号为OPENTM400501478的模板
							</div>
						</div>
						<div class="help-block" style="color:red;font-weight:bold;">此模版与报名审核/微信签到审核结果共用</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjqshjg_singname" value="<?php  echo $bjqshjg['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjqshjg_code" value="<?php  echo $bjqshjg['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 接收者姓名 ${name} 类型 ${type} 状态 ${result}(家长或学生收 类型=班级圈内容审核or报名申请 状态=通过 or 未通过)</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈审核提醒通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjqshtz" value="<?php  if(!empty($bjqshtz['bjqshtz'])) { ?><?php  echo $bjqshtz['bjqshtz'];?><?php  } else { ?><?php  echo $setting['bjqshtz'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$bjqshtz['bjqshtz']) { ?><span class="label label-info" onclick="addtemp('bjqshtz',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">审核提醒</span>”编号为OPENTM400047769的模板
							</div>
						</div>
						<div class="help-block" style="color:red;font-weight:bold;">此模版与报名审核/微信签到提醒共用</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjqshtz_singname" value="<?php  echo $bjqshtz['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="bjqshtz_code" value="<?php  echo $bjqshtz['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 发送者姓名 ${name} 时间 ${time} 类型${type}(老师收 类型=班级圈内容审核or报名申请审核or微信签到审核)</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">到校离校提醒</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jxlxtx" value="<?php  if(!empty($jxlxtx['jxlxtx'])) { ?><?php  echo $jxlxtx['jxlxtx'];?><?php  } else { ?><?php  echo $setting['jxlxtx'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$jxlxtx['jxlxtx']) { ?><span class="label label-info" onclick="addtemp('jxlxtx',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">到校离校提醒</span>”编号为TM00188的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jxlxtx_singname" value="<?php  echo $jxlxtx['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jxlxtx_code" value="<?php  echo $jxlxtx['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} 进出时间 ${time} 进出状态 ${type} （状态=进校 or 离校）</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">缴费结果通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jfjgtz" value="<?php  if(!empty($jfjgtz['jfjgtz'])) { ?><?php  echo $jfjgtz['jfjgtz'];?><?php  } else { ?><?php  echo $setting['jfjgtz'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$jfjgtz['jfjgtz']) { ?><span class="label label-info" onclick="addtemp('jfjgtz',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－院校</span>，搜索“<span style="color:red;">校园缴费结果通知</span>”编号为OPENTM401619319的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jfjgtz_singname" value="<?php  echo $jfjgtz['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="jfjgtz_code" value="<?php  echo $jfjgtz['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} 支付时间 ${time} 状态 ${type} （状态=成功 or 失败）</div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">签到成功及剩余课时通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="sykstx" value="<?php  if(!empty($sykstx['sykstx'])) { ?><?php  echo $sykstx['sykstx'];?><?php  } else { ?><?php  echo $setting['sykstx'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$sykstx['sykstx']) { ?><span class="label label-info" onclick="addtemp('sykstx',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">课程签到通知</span>”编号为OPENTM405457608的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="sykstx_singname" value="<?php  echo $sykstx['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="sykstx_code" value="<?php  echo $sykstx['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} 签到时间 ${time} </div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">课程预约通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="kcyytx" value="<?php  if(!empty($kcyytx['kcyytx'])) { ?><?php  echo $kcyytx['kcyytx'];?><?php  } else { ?><?php  echo $setting['kcyytx'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$kcyytx['kcyytx']) { ?><span class="label label-info" onclick="addtemp('kcyytx',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">课程预约通知</span>”编号为OPENTM400233342的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="kcyytx_singname" value="<?php  echo $kcyytx['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="kcyytx_code" value="<?php  echo $kcyytx['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生姓名 ${name} 预约时间 ${time} </div>
						</div>
                    </div>					
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">课程签到成功提醒家长</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="kcqdtx" value="<?php  if(!empty($kcqdtx['kcqdtx'])) { ?><?php  echo $kcqdtx['kcqdtx'];?><?php  } else { ?><?php  echo $setting['kcqdtx'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$kcqdtx['kcqdtx']) { ?><span class="label label-info" onclick="addtemp('kcqdtx',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">课程签到提醒</span>”编号为OPENTM406123046的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="kcqdtx_singname" value="<?php  echo $kcqdtx['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="kcqdtx_code" value="<?php  echo $kcqdtx['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 学生/老师姓名 ${name} 签到时间 ${time} </div>
						</div>
                    </div>					
                </div>	
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">上课提醒</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="sktxls" value="<?php  if(!empty($sktxls['sktxls'])) { ?><?php  echo $sktxls['sktxls'];?><?php  } else { ?><?php  echo $setting['sktxls'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$sktxls['sktxls']) { ?><span class="label label-info" onclick="addtemp('sktxls',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">上课提醒通知</span>”编号为OPENTM206931431的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="sktxls_singname" value="<?php  echo $sktxls['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="sktxls_code" value="<?php  echo $sktxls['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 姓名 ${name} 签到时间 ${time} </div>
						</div>
                    </div>					
                </div>
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">团购通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="pttz" value="<?php  if(!empty($pttz_set['pttz'])) { ?><?php  echo $pttz_set['pttz'];?><?php  } else { ?><?php  echo $setting['pttz'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$pttz_set['pttz']) { ?><span class="label label-info" onclick="addtemp('pttz',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">团购结果通知</span>”编号为OPENTM411478656的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="pttz_singname" value="<?php  echo $pttz_set['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="pttz_code" value="<?php  echo $pttz_set['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 姓名 ${name} 签到时间 ${time} </div>
						</div>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">助力通知</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="zltz" value="<?php  if(!empty($zltz_set['zltz'])) { ?><?php  echo $zltz_set['zltz'];?><?php  } else { ?><?php  echo $setting['zltz'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$zltz_set['zltz']) { ?><span class="label label-info" onclick="addtemp('zltz',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">报名结果通知</span>”编号为OPENTM414103384的模板
							</div>
						</div>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="zltz_singname" value="<?php  echo $zltz_set['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
                    </div>	
                    <label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
                    <div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="zltz_code" value="<?php  echo $zltz_set['sms_Code'];?>" class="form-control"/>
							<div class="help-block">变量 姓名 ${name} 签到时间 ${time} </div>
						</div>
                    </div>					
                </div>
				<?php  if(vis()) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">访客预约提醒</label>
					<div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="fkyytx" value="<?php  if(!empty($fkyytx['fkyytx'])) { ?><?php  echo $fkyytx['fkyytx'];?><?php  } else { ?><?php  echo $setting['fkyytx'];?><?php  } ?>" class="form-control"/>
							<?php  if(!$fkyytx['fkyytx']) { ?><span class="label label-info" onclick="addtemp('fkyytx',this)"><i class="fa fa-edit"></i>点击获取</span><?php  } ?>
							<div class="help-block">
								在模板库选择<span style="color:red;">教育－培训</span>，搜索“<span style="color:red;">访客审核通知</span>”编号为OPENTM417523705的模板
							</div>
						</div>
					</div>
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">短信签名</label>
					<div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="fkyytx_singname" value="<?php  echo $fkyytx['sms_SignName'];?>" class="form-control"/>
							<div class="help-block">阿里云短信服务里创建的签名</div>
						</div>
					</div>
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">短信模版</label>
					<div class="col-sm-2 col-lg-2">
						<div class="input-group">
							<input type="text" name="fkyytx_code" value="<?php  echo $fkyytx['sms_Code'];?>" class="form-control"/>
							<div class="help-block"></div>
						</div>
					</div>
				</div>
				<?php  } ?>

            </div>
        </div>
		<script>
			function addtemp(template,node){
				var url = "<?php  echo $this->createWebUrl('indexajax', array('op' => 'addTemplate','weid' => $weid))?>";
				$.post(
					url,
					{template:template},
					function(data){
						if(data.result){
							$("input[name="+template+"]").val(data.template_id);
							$(node).hide();
						}else{
							alert(data.msg);
						}
					},'json'
				);
			}
			function settemp(node){
				var url = "<?php  echo $this->createWebUrl('indexajax', array('op' => 'settemhy','weid' => $weid))?>";
				$.post(
					url,
					{weid:'<?php  echo $weid;?>'},
					function(data){
						if(data.result){
							$(node).hide();
							alert(data.msg);
							location.reload();
						}else{
							alert(data.msg);
						}
						
					},'json'
				);
			}
			function checkver(){
				var url = "<?php  echo $this->createWebUrl('indexajax', array('op' => 'checkver','weid' => $weid))?>";
				$.post(
					url,
					{weid:'<?php  echo $weid;?>'},
					function(data){
						if(data.result){
							location = data.url;
						}						
					},'json'
				);
			}
		</script>
		<?php  if($_W['isfounder'] && getoauthurl() != 'b.yuntuijia.com') { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				给开发者建议或留言
			</div>
			<div class="panel-body">
			<div class="row-fluid">
				<div class="span8 control-group">
					【本部分仅创始人可见，不必担心客户或其他管理员能看到】有何建议或BUG请直接提交  联系开发者QQ:<a href="tencent://message/?uin=332035136&Site=qq&Menu=yes">332035136</a> 工作日时间（周一 - 周日 12：00 - 24：00）请直接Q我!其他时间勿扰。
					<span class="btn btn-success" onclick="checkver()"><i class="fa fa-edit"></i>重新升级</span>
				</div>
				
			</div>
			</div>
		</div>	
		<?php  } ?>
		<?php  } else { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
			     抱歉：
			</div>
			<div class="panel-body">
			<div class="row-fluid">
				<div class="span8 control-group">
					【你没有权限查看本页面，请联系管理员进行操作】
				</div>
			</div>
			</div>
		</div>
        <?php  } ?>
        <?php  if($_W['isfounder'] || $state == 'owner') { ?>		
        <div class="form-group col-sm-12">
            <input type="hidden" name="id" value="<?php  echo $setting['id'];?>" />
            <input type="submit" name="submit" value="提交保存" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
		<?php  } ?>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>