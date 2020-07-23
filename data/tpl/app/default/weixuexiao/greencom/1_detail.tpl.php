<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $title;?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/weixin.css">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/wxIndexnew.css?v=4.920329" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.920120" />
<?php  echo register_jssdks();?>
<script src="<?php echo MODULE_URL;?>public/mobile/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/swipe.js"></script>
<script src="<?php echo OSSURL;?>public/mobile/js/banner.js"></script>
</head>
<body>
<style type="text/css">
	.course-freq {
		display: block;
	    margin-bottom: 6px;
	    margin-top:6px;
	    font-size: 14px;
	    padding: 0;
	    color: #666666;
	    box-sizing: border-box;
	    -webkit-tap-highlight-color: transparent;
	}

	.kcinfo{
		width:auto;
		height:auto;
	    background: #06c1ae;
	    color: #fff;
	    text-decoration: none;
	    position: absolute;
	    right: 1px;
	    padding: 4px 7px;
	    border-radius:3px;
	}
.line1 {  
   display: inline-block;  
   width: 20%;  
   border-top: 1px solid #ccc ;  
}  
.box_swipe {overflow: hidden;position: relative;}
.box_swipe ul {overflow: hidden;position: relative;}
.box_swipe ul > li {float:left;width:100%;position: relative;}
.box_swipe ul > li a{color:#FFF;text-decoration:none;}
.box_swipe ul > li .title{position: absolute;bottom:6px;display: block;width: 70%;height:20px;padding:0 10px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;z-index:11;font-size: 16px;line-height: 20px;}
.box_swipe>ol{height:20px;position: relative;z-index:10;margin-top:-25px;text-align:right;padding-right:15px;background-color:rgba(0,0,0,0.3);}
.box_swipe>ol>li{display:inline-block;margin-bottom:1px;width:8px;height:8px;background-color:#757575;border-radius: 8px;}
.box_swipe>ol>li.on{background-color:#ffffff;}
.topannounce {background:#000;color: #fff;background-size: 100%;z-index: 11;}	 
#speaker {width: 100%;height: 30px;line-height: 30px;position: fixed;z-index: 12;background-color: #06c1ae;opacity: 0.95; overflow: hidden;box-shadow: 0px 0px 2px #222;-webkit-box-shadow: 0px 0px 2px #222;}
#s-word {font-size: 16px;width: 82%;height: 30px;left: 20px;}
#s-word a {color:#fff;text-decoration: none;  margin-right: 60px;}
</style>
<?php  if(!empty($school['gonggao'])) { ?> 	
	<div id="topannounce" class="topannounce">
		<div id="speaker">
			<span id="s-word">
				<marquee behavior="scroll" scrollamount="4" direction="left" width="100%">
					<a>
						<?php  echo $school['gonggao'];?>       
					</a>
				</marquee>
			</span>
		</div>		
	</div>	
	<script type="text/javascript">
        $('#s-fork').click(function(){
            $('#topannounce').hide();
        });
	</script>	
<?php  } ?>
<div class="all">
<?php  if(!empty($banners)) { ?>
<div class="showPic">
    <div id="banner_box" class="box_swipe" style="  max-width: 640px;  margin: 0 auto;  margin-bottom: 0px;">
		<ul id="bheight">
		  <?php  if(is_array($barr)) { foreach($barr as $mid => $banner) { ?>
			<li>
				<a href="<?php  if(empty($banner['link'])) { ?>#<?php  } else { ?><?php  echo $banner['link'];?><?php  } ?>" onclick="addclick(<?php  echo $banner['id'];?>);"><img src="<?php  echo toimage($banner['thumb'])?>" alt="<?php  echo $banner['bannername'];?>"  width='100%' style="max-height:600px;" />
				</a>
				<span class="title" style="color:#fff;"><?php  echo $banner['bannername'];?></span>
			</li>
		  <?php  } } ?>
		</ul>
        <ol>
        <?php  if(is_array($barr)) { foreach($barr as $slideNum => $banner) { ?>
            <li<?php  if($slideNum == 0) { ?> class="on"<?php  } ?>></li>
        <?php  } } ?>
        </ol>
    </div>
</div>
 <?php  } ?>
<div class="btnList" style="border-bottom:none;">
	<ul>
		<li style="float: center; display: block; align: 25%;">
		<?php  if(is_array($icon1)) { foreach($icon1 as $item) { ?>
			<div class="btnDiv">
				<a href="<?php  echo $item['url'];?>">
					<div class="ico">
						<img alt src="<?php  echo tomedia($item['icon'])?>" style="-webkit-touch-callout: none; -webkit-user-select: none;">	
					</div>
					<span><?php  echo $item['name'];?></span>
				</a>
			</div>
		<?php  } } ?>	
		</li>
	</ul>
</div>
<?php  if(!empty($icon2)) { ?>
<div class="btnList" style="border-bottom:none;">
	<ul>
		<li style="float: center; display: block; align: 25%;">
		<?php  if(is_array($icon2)) { foreach($icon2 as $item) { ?>
			<div class="btnDiv">
				<a href="<?php  echo $item['url'];?>">
					<div class="ico">
						<img alt src="<?php  echo tomedia($item['icon'])?>" style="-webkit-touch-callout: none; -webkit-user-select: none;">	
					</div>
					<span><?php  echo $item['name'];?></span>
				</a>
			</div>
		<?php  } } ?>	
		</li>
	</ul>
</div>
<?php  } ?>

<?php  if($list_tuijian) { ?>
<div class="line"></div>
 <div class="newsList" style="border-bottom: unset;">
	 
		<div class="title" style="line-height:27px;font-size:15px;vertical-align: middle;text-align: center;">
			<span class="line1" style="vertical-align: 10%;"></span>  
			<span style="white-space:pre;">  </span>
			<span style=""><?php  echo $language['detail_star_kc'];?></span>
			<span style="white-space:pre;">  </span><span class="line1" style="vertical-align: 10%;"></span>  
			</div>
		
	
	</div>
 <?php  if(is_array($list_tuijian)) { foreach($list_tuijian as $banner) { ?>

<div class="showPic" style="padding:7px;border-bottom:1px solid #f9f5f5;">
	

    <div id="banner_box" class="box_swipe" style="  max-width: 640px;  margin: 0 auto;  margin-bottom: 0px;">
		<ul id="bheight">
		 
			<li style="height: 160px;">
				<a href="<?php  echo $this->createMobileUrl('kcinfo', array('schoolid' => $schoolid, 'id' => $banner['id']), true)?>" ><img src="<?php  if(!empty($banner['bigimg'])) { ?><?php  echo tomedia($banner['bigimg']);?><?php  } else { ?><?php  echo tomedia($school['logo'])?><?php  } ?>" alt="<?php  echo $banner['bannername'];?>"  width='100%'  />
				</a>
				<span class="title" style="color:#fff;padding: unset; height: 25px;font-size: 15px;"><?php  echo $banner['name'];?></span>
				<span class="title" style="color: #fbff4c;width: 100%;float: right;text-align: right;padding-left:190px;padding-right: 25px; height: 25px;font-size: 15px;">
					<?php  if($banner['OldOrNew'] == 1) { ?>
							￥<?php  echo $banner['cose'];?>/首购
						<?php  } else { ?>
							￥<?php  echo $banner['cose'];?>
						<?php  } ?></span>
			</li>
		 
		</ul>
        <ol style="background-color: rgba(14, 14, 14, 0.65);height: 30px;margin-top: -35px;">
        </ol>
    </div>
</div>

 <?php  } } ?>
 <?php  } ?>
<div class="line"></div>
<?php  if($list_jpk) { ?>
<div class="newsList">
	<div class="top">
		<div class="title"><?php  echo $language['detail_jp_kc'];?></div>
		<div class="more">
			<a href="<?php  echo $this->createMobileUrl('kc', array( 'schoolid' => $schoolid), true)?>">更多</a>			
		</div>
	
	</div>
	<ul>
	<?php  if(is_array($list_jpk)) { foreach($list_jpk as $itemjpk) { ?>
		<a href="<?php  echo $this->createMobileUrl('kcinfo', array('schoolid' => $schoolid, 'id' => $itemjpk['id']), true)?>">
			<li style="height:90px">
				<div class="img" style="margin-top: 5px;">
					<img alt src="<?php  if(!empty($itemjpk['thumb'])) { ?><?php  echo tomedia($itemjpk['thumb']);?><?php  } else { ?><?php  echo tomedia($school['logo'])?><?php  } ?>" style="border-radius: 5px;top: 0px; left: 0px; height: 100%; width: 100%; -webkit-touch-callout: none; -webkit-user-select: none;">
				</div>
				<div class="content" style="margin-top: 5px;margin-bottom: 5px;">
					<div class="t"><?php  echo $itemjpk['name'];?></div>
					<p class="course-freq">
						<?php  if($itemjpk['minge'] != 0) { ?>
							<?php  echo $itemjpk['minge'];?>人班 &nbsp;&nbsp;&nbsp;&nbsp;
						<?php  } else { ?>
							无人数限制
						<?php  } ?>
					</p>
					<p class="course-freq" style="color:#06c1ae">
						
						<?php  if($itemjpk['OldOrNew'] == 1) { ?>
							￥<?php  echo $itemjpk['cose'];?>/首购
						<?php  } else { ?>
							￥<?php  echo $itemjpk['cose'];?>
						<?php  } ?>
						<span class="kcinfo" href="<?php  echo $this->createMobileUrl('kcinfo', array('id' => $rowO['id'],'schoolid' =>$schoolid), true)?>">查看详情</span>
					</p>
					

				</div>
			</li>
		</a>
	<?php  } } ?>		
	</ul>
</div>
<div class="line"></div>
<?php  } ?>
<?php  if($list1) { ?>
<div class="newsList">
	<div class="top">
		<div class="title"><?php  echo $language['detail_new_xygg'];?></div>
		<div class="more">
			<a href="<?php  echo $this->createMobileUrl('newslist', array('op' => 'article', 'schoolid' => $schoolid), true)?>">更多</a>			
		</div>
	</div>
	<ul>
	<?php  if(is_array($list1)) { foreach($list1 as $item1) { ?>
		<a href="<?php  echo $this->createMobileUrl('new', array('schoolid' => $schoolid, 'id' => $item1['id']), true)?>">
			<li>
				<div class="img">
					<img alt src="<?php  echo tomedia($item1['thumb']);?>" style="border-radius: 5px;top: 0px; left: 0px; height: 100%; width: 100%; -webkit-touch-callout: none; -webkit-user-select: none;">
				</div>
				<div class="content">
					<div class="t"><?php  echo $item1['title'];?></div>
					<div class="b main_text"  style="text-overflow:ellipsis;white-space:nowrap;overflow:hidden;width:200px;"><?php  echo $item1['description'];?></div>
					<div class="time"><?php  echo date('m-d', $item1['createtime'])?></div>
				</div>
			</li>
		</a>
	<?php  } } ?>	
	</ul>
</div>
<div class="line"></div>
<?php  } ?>
<?php  if($list2) { ?>
<div class="newsList">
	<div class="top">
		<div class="title"><?php  echo $language['detail_new_xyxw'];?></div>
		<div class="more">
			<a href="<?php  echo $this->createMobileUrl('newslist', array('op' => 'news', 'schoolid' => $schoolid), true)?>">更多</a>	
		</div>
	</div>
	<ul>
	<?php  if(is_array($list2)) { foreach($list2 as $item1) { ?>
		<a href="<?php  echo $this->createMobileUrl('new', array('schoolid' => $schoolid, 'id' => $item1['id']), true)?>">
			<li>
				<div class="img">
					<img alt src="<?php  echo tomedia($item1['thumb']);?>" style="border-radius: 5px;top: 0px; left: 0px; height: 100%; width: 100%; -webkit-touch-callout: none; -webkit-user-select: none;">
				</div>
				<div class="content">
					<div class="t"><?php  echo $item1['title'];?></div>
					<div class="b main_text"  style="text-overflow:ellipsis;white-space:nowrap;overflow:hidden;width:200px;"><?php  echo $item1['description'];?></div>
					<div class="time"><?php  echo date('m-d', $item1['createtime'])?></div>
				</div>
			</li>
		</a>
	<?php  } } ?>			
	</ul>
</div>
<div class="line"></div>
<?php  } ?>

<?php  if($list3) { ?>
<div class="newsList">
	<div class="top">
		<div class="title"><?php  echo $language['detail_new_jmwx'];?></div>
		<div class="more">
			<a href="<?php  echo $this->createMobileUrl('newslist', array('op' => 'wenzhang', 'schoolid' => $schoolid), true)?>">更多</a>			
		</div>
	</div>
	<ul>
	<?php  if(is_array($list3)) { foreach($list3 as $item1) { ?>
		<a href="<?php  echo $this->createMobileUrl('new', array('schoolid' => $schoolid, 'id' => $item1['id']), true)?>">
			<li>
				<div class="img">
					<img alt src="<?php  echo tomedia($item1['thumb']);?>" style="border-radius: 5px;top: 0px; left: 0px; height: 100%; width: 100%; -webkit-touch-callout: none; -webkit-user-select: none;">
				</div>
				<div class="content">
					<div class="t"><?php  echo $item1['title'];?></div>
					<div class="b main_text"  style="text-overflow:ellipsis;white-space:nowrap;overflow:hidden;width:200px;"><?php  echo $item1['description'];?></div>
					<div class="time"><?php  echo date('m-d', $item1['createtime'])?></div>
				</div>
			</li>
		</a>
	<?php  } } ?>		
	</ul>
</div>
<?php  } ?>
<div class="line" style="padding-bottom:65px;text-align: center;line-height: 60px;font-size: 13px;color: #908f8f;"><?php  echo $school['copyright'];?></div>
</div>
   <?php  include $this->template('footer');?> 
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<script type="text/javascript">
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#speaker").css("background-color","#333");
	}
}, 100);
function addclick(id){
	$.ajax({
		url: "<?php  echo $this->createMobileUrl('indexajax', array('op' => 'addclick','schoolid' => $schoolid), true)?>",
		type: "post",
		data: {
			id: id
		},
		success: function (data) {

		}
	});
}

function strConvertHtml() {
	$('.main_text').each(function (index, obj) {

		var contentStr = $(this).text();

		if (checkHtml(contentStr)) {

			contentStr = contentStr.replace('<br>', '<br/>').Trim();
			contentStr = contentStr.replace('/\n/g', '<br/>').Trim();

			$(this).html(contentStr);

		} else {
			var tempStr = $(this).html();

			$(this).html(tempStr);
		}
	});

}
function checkHtml(htmlStr) {
	var reg = /<[^>]+>/g;
	return reg.test(htmlStr);
}

wx.ready(function () {
	sharedata = {
		title: '<?php  echo $school['title'];?>',
		desc: '<?php  echo $school['info'];?>',
		link: '<?php  echo $links;?>',
		imgUrl: '<?php  echo tomedia($school['logo'])?>',
		success: function(){
			
		},
		cancel: function(){
			
		}
	};
	sharedata1 = {
		title: '<?php  echo $school['info'];?>',
		desc: '<?php  echo $school['title'];?>',
		link: '<?php  echo $links;?>',
		imgUrl: '<?php  echo tomedia($school['logo'])?>',
		success: function(){
			
		},
		cancel: function(){
			
		}
	};	
	wx.onMenuShareAppMessage(sharedata);
	wx.onMenuShareTimeline(sharedata1);
});
$(function() {
	strConvertHtml();
	WeixinJSShowShareMenu();

    WeixinJSShowProfileMenuAndShare();
		
});

function WeixinJSShowShareMenu(){
	if (typeof wx != "undefined"){
		wx.ready(function () {
			wx.showMenuItems({
			    menuList: ['menuItem:share:appMessage','menuItem:share:timeline'] // 要显示的菜单项，所有menu项见附录3
			});
		});
	}
}	


function WeixinJSShowProfileMenuAndShare(){
	
	if (typeof wx != "undefined"){
		wx.ready(function () {
			wx.showMenuItems({
			    menuList: ['menuItem:share:appMessage','menuItem:share:timeline','menuItem:profile','menuItem:addContact','menuItem:favorite'] // 要显示的菜单项，所有menu项见附录3
			});
		});
	}
}
</script>	
</html>