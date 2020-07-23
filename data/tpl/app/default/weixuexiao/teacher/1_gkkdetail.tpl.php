<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="HandheldFriendly" content="true" />
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/hb.js??v=1027"></script>
<link href="<?php echo OSSURL;?>public/mobile/css/j_alert.css?v=102720160929" rel="stylesheet" />
<link href="<?php echo OSSURL;?>public/mobile/css/new_yab1.css?v=102720161027" rel="stylesheet" />
<link href="<?php echo OSSURL;?>public/mobile/css/countCss.css?v=062220160928" rel="stylesheet" charset="gb2312" />
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/activityNotice.css?v=4.80120" />
<?php  echo register_jssdks();?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.8"></script>
<title><?php  echo $school['title'];?></title>
</head>
<body>
<div class="All">
	<div class="top" style="background: #12d0bc;">
		<div class="float_left top_head_img">
			<img src="<?php  if($gkkinfo['t_thumb']) { ?><?php  echo tomedia($gkkinfo['t_thumb'])?><?php  } else { ?><?php  echo tomedia($school['tpic'])?><?php  } ?>" height="45" width="45" class="teacherImgError"/>
		</div>
		<div class="float_left top_head_name" style="overflow: unset;">
			<?php  echo $gkkinfo['tname'];?><span>老师的公开课</span>
		</div>
	</div>
	<style>
	.main {margin: 10px 10px 2px 10px;box-shadow: 0px 0px 0px rgba(0,0,0,.3);padding: 0;border-radius: 10px;}
	.common_tips_bottom {height: 44px;line-height: 44px;font-size: 16px;color: #333333;}
	.common_blue_tag {color: white;background-color: #06c1ae;border-radius: 20px;float: right;margin-right: 10px;}
	.common_tips_bottom {padding: 0 10px;}
	.main img {margin: 0;}
	.imgItemDetails {margin-bottom: 5px;}
	.imgItemBox {margin: 15px 10px;padding-bottom: 15px;}
	.common_tips_bottom {padding: 0 10px 0 20px;}
	.main {padding-bottom: 10px;}
	.common_no_audit_status {background-color: inherit;}
	.tongzhi {position: relative}
	.tongzhiDetails {position: relative;padding: 10px;}
	.tongzhiTitleDetails {color: #333333;font-size: 14px;font-weight: bold;display: inline-block;padding-right: 50px;}
	.btnEditOtherBox {right: 10px;top: 20px;}
	.common_no_audit_status {margin-left: 0;display: inline-block;}
	</style>
	<div class="top_head_blank"></div>
    <div class="listcontent" style="margin-bottom:5px">
        <div class="main">
            <div class="tongzhiDetails">
               
				<div class="tongzhiTitleDetails" style="font-size: 18px;"><?php  echo $gkkinfo['name'];?></div>
			
				<?php  if(!($gkkinfo['is_pj']) && !empty($checkpj)) { ?>
				<div class="queryResult" onclick="checkpingjia(<?php  echo $gkkinfo['id'];?>);" style="top: 53%;"><img src="<?php echo OSSURL;?>public/mobile/img/headerLeftBg.png" class="img-responsive" >
			<span>查看评论</span>
			
		</div>
		<?php  } ?>
            </div>
            <div class="cutting"></div>
            <div class="notifyTopBox">
                <div class="notifyTopLeft">
                    <img src="<?php  if($gkkinfo['kmicon']) { ?><?php  echo tomedia($gkkinfo['kmicon'])?><?php  } else { ?><?php  echo tomedia($school['logo'])?><?php  } ?>" class="teacherImgError"/>
                </div>
                <div class="notifyTopRight">
                    <div class="notifyTopRightTopBox">
                        <span class="teacherInfo">科目：<?php  echo $gkkinfo['kmname'];?></span>
                       
                    </div>
                    <div class="notifyTopRightTopBox">
					
                        <span class="teacherInfo">授课年级/班级：<?php  echo $gkkinfo['nianji'];?>/<?php  echo $gkkinfo['banji'];?></span>
						
                    </div>					
                    <p class="notifyCreateTime">时间:<?php  echo date('Y-m-d H:i',$gkkinfo['starttime'])?> <span style="color:red"> 至 </span><?php  echo date('H:i',$gkkinfo['endtime'])?> </p>					
                </div>
            </div>
			<div class="imgItemBox" >
				<div class="imgItemDetails" style="width: 100%;">
					<span class="common_no_audit_status">公开课大纲:</span>
					
					<?php  echo htmlspecialchars_decode($gkkinfo['dagang'])?> 
				</div>
			</div>
        </div>
		<?php  if($gkkinfo['is_pj'] == 0) { ?>
		<?php  if($gkkinfo['tid'] != $it['tid']) { ?>
		<div class="F_div" onclick="gotopingjia(<?php  echo $gkkinfo['id'];?>);" style="top: 230px;z-index:10000">
        <div class="F_div_text" >评价</div>
		<?php  } ?>
		<?php  } ?>
    </div>
<script>  


function gotopingjia(id){
	e = window.event;
	e.stopPropagation();
	e.preventDefault();
	location.href = "<?php  echo $this->createMobileUrl('gkkpingjia', array('schoolid' => $schoolid,'op'=>'edite'), true)?>"+ '&gkkid=' + id + '&weid=' + <?php  echo $weid;?>;

}

function checkpingjia(id){
	e = window.event;
	e.stopPropagation();
	e.preventDefault();
	location.href = "<?php  echo $this->createMobileUrl('gkkpingjia', array('schoolid' => $schoolid,'op'=>'check','checktype'=>'myown'), true)?>"+ '&gkkid=' + id + '&weid=' + <?php  echo $weid;?>;

}

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
<?php  include $this->template('comad');?>

