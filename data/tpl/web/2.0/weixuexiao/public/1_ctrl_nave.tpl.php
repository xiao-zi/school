<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-pills" role="tablist">
	<li <?php  if(($_GPC['do'] == 'fenzu')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('fenzu', array('op' => 'display'))?>">分组管理</a>
	</li>	
	<li <?php  if(($_GPC['do'] == 'manager')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('manager', array('op' => 'display'))?>">二维码</a>
	</li>
	<li <?php  if(($_GPC['do'] == 'banners')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('banners', array('op' => 'display'))?>">平台幻灯片</a>
	</li>	
	<li <?php  if(($_GPC['do'] == 'comad')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('comad', array('op' => 'display'))?>">贴片广告</a>
	</li>
	<li <?php  if(($_GPC['do'] == 'guid')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('guid', array('op' => 'display'))?>">新手引导</a>
	</li>
	<li <?php  if(($_GPC['do'] == 'comload')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('comload', array('op' => 'display'))?>">公共加载</a>
	</li>
	<?php  if($_W['isfounder']) { ?>
	<li <?php  if(($_GPC['do'] == 'loginctrl')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('loginctrl', array('op' => 'display'))?>">独立后台</a>
	</li>
	<?php  } ?>
	<li <?php  if(($_GPC['do'] == 'binding')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('binding', array('op' => 'display'))?>">统一入口</a>
	</li>
	<li <?php  if(($_GPC['do'] == 'sensitive')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('sensitive', array('op' => 'display'))?>">敏感词</a>
	</li>
	<li <?php  if(($_GPC['do'] == 'lanset')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('lanset', array('op' => 'display'))?>">语言包</a>
	</li>
	<li <?php  if(($_GPC['do'] == 'manger_apps')) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('manger_apps', array('op' => 'display'))?>">应用管理</a>
	</li>
</ul>