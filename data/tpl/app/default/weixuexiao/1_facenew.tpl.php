<?php defined('IN_IA') or exit('Access Denied');?><script src="<?php echo OSSURL;?>public/mobile/js/faceMap.js?v=5.61" type="text/javascript"></script>
<style>
.jp-jplayer {background-color: #000000;}
.jp-jplayer audio, .jp-jplayer {width: 0px;height: 0px;}
.discussBg {background: none repeat scroll 0 0 black;bottom: 0;display: none;left: 0; opacity: 0.3; position: fixed; right: 0;top: 0;z-index: 1000;}
.discussText {background-color: #fff;border-radius: 3px; display: none;left: 0;position: fixed;top: 0;width: 100%;z-index: 1001;}
.discussText .discussSend {background-color: #fafafa;border-bottom: 1px solid #e9e9e9;border-top: 1px solid #e9e9e9; float: left; height: 50px;width: 100%;}
.discussText button {border: medium none;border-radius: 3px;cursor: pointer;float: right;margin: 10px;width: 60px;}
.discussText button.s {background: none repeat scroll 0 0 #67a60f; color: white; height: 30px;line-height: 30px;}
.discussText button.c {background: none repeat scroll 0 0 #f8f8f8;border: 1px solid #e9e9e9;color: #2f2f2f;height: 30px;line-height: 28px;}
.discussText textarea {border: medium none;float: left;font-size: 16px;height: 120px;margin: 5px 1%;overflow: hidden;resize: none; width: 98%;}
.dialog_showFace{float: left; margin: 10px;}
/* FaceBox */
.faceBox { padding: 10px 0 0 0; display: none; width: 100%; overflow: hidden; overflow:auto; zoom:1; background-color: #fff; border-top:1px solid #ddd;}
.faceBox_tabBar { margin: 0; height: 32px; list-style: none; background: #eeeeee; overflow:auto; zoom:1;}
.faceBox_tabBar li { float: left; margin-left: 20px; }
.faceBox_tabBar li a { display: block; padding: 8px 14px; font-size: 13px; text-decoration: none; color: #979797; background: #eeeeee; }
.faceBox.faceBox_fixed{ position:fixed; padding-bottom: 0px;bottom: 50px; left:0; z-index:1000;}
.faceBox_main { margin: 0; padding:0; height: 191px; width: 100%; position: relative; overflow: hidden; -webkit-user-select: none; }
.faceBox_main > ul { float: left; margin: 0; list-style: none; display: block; width: 400%; text-align: left; overflow:auto; zoom:1;}
.faceBox_main > ul > li { float: left; margin:0; width:300px; box-sizing: border-box; padding: 1px; }
.faceBox_delItem { float: left; width: 14%; text-align: center; padding: 10px 0; }
.faceBox_delItem img { width:50%; }
.faceBox_item { float: left; width:14%; text-align: center; line-height: 25px; padding:0px; background: #ffffff; }
.faceBox_item img { width: 50%; height:auto;}
.number { text-align: center; z-index: 9999; margin: -50px auto; height: 30px; float: left; }
.number ul { margin: 0 auto; z-index: 999; display: block; list-style: none; padding: 12px 0 0 0; overflow:auto; zoom:1; text-align: center;}
.number li { display: block; list-style: none; text-indent: -999em; width: 8px; height: 8px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; background: #ddd;overflow: hidden; margin-right: 6px; opacity: 0.7; display: inline-block; float:none; }
.number li.active { background: #888; }
.number li:last-child { margin: 0 7px 0 0; }
/* End of FaceBox */
</style>
<div id="jquery_jplayer_hd" class="jp-jplayer"></div>
<div id="discussBg" class="discussBg"></div>
<div id="discussText" class="discussText">
<div id="emojiBox" class="emojiBox"></div>
</div>
<div class="faceBox faceBox_fixed" style="display:none">
	<div class="faceBox_main">
		<ul id="faceImg">
		</ul>
	</div>
	<div class="number">
		<ul id="faceNum">
			<li class="active">1</li>
			<li>2</li>
			<li>3</li>
			<li>4</li>
		</ul>
	</div>
</div>
<script>
var face_img_base_url = "<?php echo OSSURL;?>";

function showfeca() {
    var dialog = $(".dialog_bg_1");
    var faceBox = $(".faceBox");
    var GLOBAL_NAME;
	createFaceSet(face_img_base_url+"public/mobile/img/face/", objMap, $("#content"));
	if(faceBox.css("display")=="block"){
		faceBox.css("display", "none");
	}else{
		faceBox.css("display", "block");
	}
    var win_width=$(window).width();

    makeFaceBox("faceImg", "faceNum", 4, win_width);

}

var isExist = false;    
function createFaceSet(baseUrl, objMap, input) {
    if (!isExist) {
        var node = $("#faceImg");
        var objLength = 0;
        $.each(objMap, function (name, value) {
            if ((objLength % 20) == 0) {
                node.find("li:last").append("<div class='faceBox_delItem'><img src='"+ face_img_base_url +"public/mobile/img/face/del.gif'></div>");
                node.append("<li></li>");
            }
            var domStr = '<div class="faceBox_item">' +
                '<img src="' + baseUrl + value + '.gif" alt="' + name + '" title="' + name + '" />' +
                '</div>';
            node.find("li:last").append(domStr);
            objLength++;
        })
        $("#faceImg li").css("width",$(window).width()+"px");
        $(".faceBox_item").css("width",(($("body").width()-2)/7)+"px");
        $(".faceBox_item").css("height",$(".faceBox_item").css("width"));
       $("#faceNum").css("width",$(window).width()+"px");

        node.find("li:last").append("<div class='faceBox_delItem'><img src='"+ face_img_base_url +"public/mobile/img/face/del.gif'></div>");
        isExist = true;
        $("#faceImg").find(".faceBox_item").each(function () {
            $(this).bind('click', function () {
                var str = input.val() + '[' + $(this).find('img').attr('title') + ']';
                input.val(str);
            });
        });
        $(".faceBox_delItem").on("click", function () {
            var inputVal = input.val();
            if (inputVal.charAt(inputVal.length - 1) === "]") {
                var temp = inputVal.lastIndexOf("[");
                input.val(inputVal.substr(0, temp));
            }
        });
    }
}

function makeFaceBox(faceListId, numListId, pageSum, listWidth) {
    var startPageX;                    
    var isTouch = false;
    var beforeContainerMarginLeft;     
    var afterContainerMarginLeft;       
    var currentPage = 1;               
    var container = $("#" + faceListId);
    var pageNumber = $("#" + numListId);
    document.getElementById(faceListId).addEventListener("touchstart", function (e) {
        isTouch = true;
        beforeContainerMarginLeft = parseInt(container.css("marginLeft"));
        startPageX = e.touches[0].pageX;
    });
    document.getElementById(faceListId).addEventListener("touchmove", function (e) {
        if (isTouch) {
            e.preventDefault();
            container.css("marginLeft", beforeContainerMarginLeft + e.touches[0].pageX - startPageX);
        }
    });
    document.getElementById(faceListId).addEventListener("touchend", function () {
        if (isTouch) {
            afterContainerMarginLeft = parseInt(container.css("marginLeft"));
            if (afterContainerMarginLeft > 1) {
                container.animate({marginLeft: 0}, 200);
            } else {
                if (Math.abs(beforeContainerMarginLeft - afterContainerMarginLeft) > 50) {
                    if (afterContainerMarginLeft > beforeContainerMarginLeft) {
                        container.animate({marginLeft: beforeContainerMarginLeft + listWidth}, 200);
                        currentPage--;
                        pageNumber.find("li").removeClass("active");
                        pageNumber.find("li").eq(currentPage - 1).addClass("active");
                    } else {
                        if (afterContainerMarginLeft < -listWidth * (pageSum - 1)) {
                            container.animate({marginLeft: beforeContainerMarginLeft}, 200);
                        } else {
                            container.animate({marginLeft: beforeContainerMarginLeft - listWidth}, 200);
                            currentPage++;
                            pageNumber.find("li").removeClass("active");
                            pageNumber.find("li").eq(currentPage - 1).addClass("active");
                        }
                    }
                } else {
                    container.animate({marginLeft: beforeContainerMarginLeft}, 200);
                }
            }
            isTouch = false;
        }
    });
}
</script>