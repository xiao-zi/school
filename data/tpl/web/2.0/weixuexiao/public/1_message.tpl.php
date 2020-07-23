<?php defined('IN_IA') or exit('Access Denied');?><?php  define('IN_MESSAGE', true)?>
<?php  if(defined('IN_GW')) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('public/header-gw', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('public/footer-gw', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>

<?php  } ?>