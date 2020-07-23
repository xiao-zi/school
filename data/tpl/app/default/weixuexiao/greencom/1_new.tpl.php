<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/mobile/css/weixin.css">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mGrzxTeacher.css?v=4.8" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/pageContent.css?v=4.80120" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<?php  echo register_jssdks();?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.9"></script>
</head>
<body>
<div id="titlebar" class="header mainColor">
	<div class="l">
		<a class="backOff" style="background:url(<?php echo OSSURL;?>public/mobile/img/ic_arrow_left_48px_white.svg) no-repeat;background-size: 55% 55%;background-position: 50%;" href="javascript:history.go(-1);"></a>
	</div>
	<div class="m">
		<span style="font-size: 18px">文章详情</span>   
	</div>
</div>
<div id="titlebar_bg" class="_header"></div>
		<div class="title"><?php  echo $item['title'];?></div>
		
		<div class="publishInfo">
			<span class="source"><?php  if(!empty($item['author'])) { ?><?php  echo $item['author'];?><?php  } else { ?><?php  echo $school['title'];?><?php  } ?></span>
			<span class="time"><?php  echo date('Y-m-d', $item['createtime'])?></span>
			
		</div>
		<div class="content parent">
			<br/><?php  echo htmlspecialchars_decode($item['content'])?><br/>
			<?php  if(!empty($picarr['p1'])) { ?><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p1']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p2'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p2']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p3'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p3']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p4'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p4']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p5'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p5']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p6'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p6']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p7'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p7']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p8'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p8']);?>" alt="" /><a><?php  } ?>
			<?php  if(!empty($picarr['p9'])) { ?></br><a onclick="wxImageShow(this);" ><img src="<?php  echo tomedia($picarr['p9']);?>" alt="" /><a><?php  } ?>
		</div>
		<div class="commentBox">
			<div class="readAndPraise">
				<span class="commentBoxRead" style="float: left; color: #999999;margin-right: 10px;">阅读<?php  echo $item['click'];?></span>
			</div>
			<div class="commentBoxPraise">
				<a href="javascript:void(0);" onclick="praiseYezs(this,$item['id'])">
					<img class="m_r_5" alt src="<?php echo OSSURL;?>public/mobile/img/ico_unpraise.png" style="-webkit-touch-callout: none; -webkit-user-select: none;">
				</a>
			</div>
		</div>
	 <?php  include $this->template('comad');?>		
	 <?php  include $this->template('footer');?>	
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
<script>
setTimeout(function() {
	if(window.__wxjs_environment === 'miniprogram'){
		$("#titlebar").hide();
		$("#titlebar_bg").hide();
		document.title="文章详情";
	}
}, 100);
</script>
<script>  

wx.ready(function () {
	sharedata = {
		title: "<?php  echo $sharetitle;?>",
		desc: "<?php  echo $sharedesc;?>",
		link: "<?php  echo $links;?>",
		imgUrl: "<?php  echo $shareimgUrl;?>",
		success: function(){
			
		},
		cancel: function(){

		}
	};	
	wx.onMenuShareAppMessage(sharedata);
	wx.onMenuShareTimeline(sharedata);
});

$(function() {

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
var WeixinApi = (function () {
	
	return {
        ready           :wxJsBridgeReady,
        imagePreview    :imagePreview
    }; 
	
    "use strict";

    /**
     * 调起微信Native的图片播放组件。
     * 这里必须对参数进行强检测，如果参数不合法，直接会导致微信客户端crash
     *
     * @param {String} curSrc 当前播放的图片地址
     * @param {Array} srcList 图片地址列表
     */
    function imagePreview(curSrc,srcList) {
        if(!curSrc || !srcList || srcList.length == 0) {
            return;
        }
        WeixinJSBridge.invoke('imagePreview', {
            'current' : curSrc,
            'urls' : srcList
        });
    }
	
    /**
     * 当页面加载完毕后执行，使用方法：
     * WeixinApi.ready(function(Api){
     *     // 从这里只用Api即是WeixinApi
     * });
     * @param readyCallback
     */
    function wxJsBridgeReady(readyCallback) {
        if (readyCallback && typeof readyCallback == 'function') {
            var Api = this;
            var wxReadyFunc = function () {
                readyCallback(Api);
            };
            if (typeof window.WeixinJSBridge == "undefined"){
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', wxReadyFunc, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', wxReadyFunc);
                    document.attachEvent('onWeixinJSBridgeReady', wxReadyFunc);
                }
            }else{
                wxReadyFunc();
            }
        }
    }

    return {
        version         :"2.5",
        ready           :wxJsBridgeReady,
        imagePreview    :imagePreview
    };
})();
<?php 
if (!empty($_W['setting']['remote']['type'])) { 
	$urls = $_W['SITEROOT'].$_W['config']['upload']['attachdir'].'/'; 
	} else {
	$urls = $_W['attachurl'];  
	}
?>
var ALI_URL = "<?php  echo $urls;?>";
var ALI_URL_VIEDO = "<?php  echo $urls;?>";
function wxImageShow(node){
	var srcList = new Array();
	var watermark='';
	var imgs = $(node).closest('.parent').find("img");	
	var curSrc = $(node).find("img")[0]['src'].split("@");
	//alert(curSrc);
	var curImgIndex=0;
	for(i=0;i<imgs.length;i++){
		var imgsrc = imgs[i]['src'].split("@");
		if(imgsrc.length>1){
			if(imgsrc[1].split("watermark").length>1){
				srcList.push(imgsrc[0].replace(ALI_URL,ALI_URL_VIEDO)+'@watermark'+imgsrc[1].split("watermark")[1]);
				watermark = '@watermark'+imgsrc[1].split("watermark")[1];
			}else{
				srcList.push(imgsrc[0].replace(ALI_URL,ALI_URL_VIEDO));
			}
		}else{
			srcList.push(imgsrc[0]);
		}
		if(curSrc[0]==imgsrc[0]){
			curImgIndex=i;
		}
	}
	curSrc[0]=curSrc[0]+watermark;

	WeixinApi.imagePreview(curSrc[0].replace(ALI_URL,ALI_URL_VIEDO), srcList);
}
</script>
</html>