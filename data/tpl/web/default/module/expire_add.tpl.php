<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb we7-breadcrumb">
    <a href="javascript:history.back()"><i class="wi wi-back-circle"></i> </a>
    <li><a href="javascript:history.back()">应用停用提醒 </a></li>
    <li>编辑</li>
</ol>
<?php  if($do == 'save_expire') { ?>
<form class="we7-form" action="<?php  echo url('module/expire/save_expire');?>" method="post">
<?php  } else { ?>
<form class="we7-form" action="<?php  echo url('module/expire/update_expire', array('id' => $id));?>" method="post">
<?php  } ?>
    <div class="form-group">
        <label class="control-label col-sm-2">提示名称</label>
        <div class="form-controls col-sm-8">
            <input type="text" name="title" value="<?php  echo $expire['title'];?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">提示内容</label>
        <div class="form-controls col-sm-8">
                <textarea class="form-control" name="notice" rows="4"><?php  echo $expire['notice'];?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2">
            <button class="btn btn-primary">确认保存</button>
        </div>
    </div>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>