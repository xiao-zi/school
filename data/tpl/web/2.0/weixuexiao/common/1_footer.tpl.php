<?php defined('IN_IA') or exit('Access Denied');?></div>
<div class="clearfix"></div>
<div class="container-fluid footer text-center" role="footer">	
	<div class="friend-link">
		<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?>
			<a href="http://www.w7.cc">微信开发</a>
			<a href="http://s.w7.cc">微信应用</a>
			<a href="http://bbs.w7.cc">微擎论坛</a>
			<a href="http://s.w7.cc">小程序开发</a>
		<?php  } else { ?>
			<?php  echo $_W['setting']['copyright']['footerright'];?>
		<?php  } ?>
	</div>
	<div class="copyright"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.w7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2018 <a href="http://www.w7.cc">www.w7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></div>
	
	<div>
		<?php  if(!empty($_W['setting']['copyright']['icp'])) { ?>
		备案号：<a href="http://beian.miit.gov.cn/" target="_blank"><?php  echo $_W['setting']['copyright']['icp'];?></a>
		<?php  } ?>
		<?php  if(!empty($_W['setting']['copyright']['policeicp']['policeicp_location']) && !empty($_W['setting']['copyright']['policeicp']['policeicp_code'])) { ?>
			<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php  echo $_W['setting']['copyright']['policeicp']['policeicp_code']?>">
                &nbsp;&nbsp;<img src="./resource/images/icon-police.png" >
				<?php  echo $_W['setting']['copyright']['policeicp']['policeicp_location']?> <?php  echo $_W['setting']['copyright']['policeicp']['policeicp_code']?>号
			</a>
		<?php  } ?>
	</div>
</div>
</div>

</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer-base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-base', TEMPLATE_INCLUDEPATH));?>
<script>
	require(['driver'], function(Driver) {
		var driver = new Driver(
			{
				className: 'scoped-class menu-driver',
				animate: true,
				opacity: 0.75,
				padding: 0,
				allowClose: true,
				overlayClickNext: false,
				doneBtnText: '我已知晓',
				closeBtnText: '&nbsp;',
				nextBtnText: '下一步',
				prevBtnText: '上一步',
				showButtons: true,
				keyboardControl: true,
				onHighlightStarted: function(Element) {
					$('.skin-2__left').css('position', 'absolute');
					$('body').css('overflow', 'hidden')
					var style = document.createElement('style');
					style.type = 'text/css';
					style.id = 'js-menu-driver-id';
					style.innerHTML='#driver-highlighted-element-stage {max-width:'+ ($('.skin-2__left--small').length ? 60 : 180)  +'px;left: 10px !important;}.main-nav li.driver-highlighted-element.active,.main-nav li.driver-highlighted-element:hover {background: unset;}';
					document.getElementsByTagName('head').item(0).appendChild(style);
				},
				onReset: function(Element) {
					$('.skin-2__left').css('position', '');
					$('body').css('overflow', '');
					$('#js-menu-driver-id').remove();
					window.localStorage.setItem('js-displayed-driver', 1);
				},
			}
		);

		// Define the steps for introduction
		driver.defineSteps([
		{
			element: '.js-w7-menu-platform',
			popover: {
				className: 'first-step-popover-class',
				title: '平台入口',
				description: '之前平台的公众号/小程序等都归入平台入口',
				position: 'right'
			}
		},
		{
			element: '.js-w7-menu-module',
			popover: {
				title: '应用入口',
				description: '之前平台的公众号/小程序等应用都归入应用入口',
				position: 'right'
			}
		},
		]);
		// Start the introduction
		if(!window.localStorage.getItem('js-displayed-driver') && $('.main-nav')) {
			driver.start();
			$(document).on('click', 'a', function(e) {
				if ($(this).parent().hasClass('driver-highlighted-element')) {
					e.preventDefault();
				}
			})
		}
	})
</script>
</body>
</html>