<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">平台设置</a></li>
</ul>
<?php  if($operation == 'display') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
		<?php  if($_W['isfounder']) { ?>
		    <div class="alert alert-success">
                温馨提示:</br>
				此处设置后，本平台所有公众号独立后台都使用此设置
            </div>
		<?php  } ?>	
            <div class="row" style="margin-left: 15px;">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/ctrl_nave', TEMPLATE_INCLUDEPATH)) : (include template('public/ctrl_nave', TEMPLATE_INCLUDEPATH));?>
            </div>
			<div style="margin-top:20px"></div>
			
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
				<input type="hidden" name="weid" value="<?php  echo $weid;?>" />
				<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
				<div class="panel panel-default">
					<div class="panel-heading">敏感词设置</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">敏感词库:</label>
							<div class="col-sm-2 col-lg-2" style="width:auto;">
								<textarea  placeholder="输入敏感词库" name="sensitive_word" style="margin: 0px -0.34375px 0px 0px; width: 619px; height: 143px;resize:none;position: relative;" value="<?php  echo $word;?>"><?php  echo $word;?></textarea>
								<div class="help-block">PS:敏感词库格式如下：“敏感词|敏感词|敏感词|”，如为空则采用默认敏感词库</div>
		</div>
							
						</div>
						
											
					</div>
				</div>
				<div class="form-group col-sm-12">
					<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</form>
        </div>
    </div>
</div>
	
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>