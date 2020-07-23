<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $school['title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/kqtjCss.css?v=5.1"/>
<link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/greenStyle.css?v=4.80120" />
<link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/new_yab1.css?v=1?v=1111" />
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/jquery-1.11.3.min.js?v=4.9"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/mobile/js/vue.min.js"></script>
<script type="text/javascript" src="<?php echo OSSURL;?>public/mobile/js/jquery.reveal.js"></script>
<?php  include $this->template('port');?>
<style>

.arrange-detail>ol {box-sizing: border-box;}
.form-order>.form-line {margin-bottom: 5px;}
.form-order>.form-line {margin-bottom: 12px;margin-top: 12px;}
.btnthis {height: 30px;background-color: #7bb52d;font: 16px "黑体";text-align: center;color: #fff;cursor: pointer;border-radius:10px}
.div_closd{margin-left:13%; width:30%;color: #fff;background-color: #f1ad31;border-color: #f1ad31;float:left;line-height:30px}
.div_sure{margin-right:13%; width:30%;float:right;line-height:30px}
.ovfHiden{overflow:hidden}
.startdate{width: 60%;margin: 3px 0px;height: 30px;line-height: 30px;border: 1px solid #e1e1e1;border-radius: 3px;font-size: 14px;background-attachment: fixed;text-align: center;padding: 0;margin: 0;outline-style: none;-webkit-tap-highlight-color: rgba(0,0,0,0);-webkit-appearance: none;}
.trhead{height:30px}
.thhead{background:white;float:left;height:40px;line-height:40px;text-align:center;font-size:16px;}
.td_mutirow{background:white;border-bottom:1px solid #EDEEF0;border-right:1px solid #EDEEF0;}
.tdsinglerow{background:white;height:30px;line-height:30px;border-bottom:1px solid #EDEEF0;}
.SelectInRange{text-align:center;text-align-last:center;width:90%;margin:8px;height:30px;border-radius: 3px;}


.reveal-modal-bg {position: fixed;height: 100%;width: 100%;background: rgba(0,0,0,0.25);z-index: 105;display: none;top: 0;left: 0; }
.reveal-modal {top:50px !important;visibility: hidden; background: #fff ;position: fixed;z-index: 101;padding: 25px 18px 38px;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px; -moz-box-shadow: 0 0 10px rgba(0,0,0,.4);-webkit-box-shadow: 0 0 10px rgba(0,0,0,.4);-box-shadow: 0 0 10px rgba(0,0,0,.4);}
.Select-event{display: inline-block;height: 32px;border:1px solid #D7d7d7;font-size: 12px;line-height: 32px;width:72px;border-radius:4px;margin-right:8px;text-align:center}
.CheckTypes{width:25%;margin-right: 5%;}
.EVENT-SELECT{background-color: rgba(38, 123, 255, 0.2);border-color:#0885ff !important }
.CheckObj{padding:1px 3px;border-radius: 5px;font-size: 12px}
#attendance{margin-left: 3px;box-shadow:2px 2px 10px #c1c1c1;border-radius: 5px;width:98%;height:100px;padding-top:10px;float: unset}
.CheckLog{width:100%;height: 40px;border-top: 1px solid #e6e6e6;background-color: white}
.CheckMoreBtn{border:1px solid #1b90d4;border-radius: 5px;padding:1px 3px}
</style>
</head>
<body id="kqtjbody">
	<div id="attendance">
		<div @click="ChangeCondition()">
			<div style="width:100%;font-size:16px;height: 30px;line-height:30px;float: left;"> 
				<span style="float:left" >查看项目：</span> 
				<span style="display:block;float:left"> 
					<span v-if="DoneData.InSch 	== true" class="CheckObj" style="border:1px solid #2091d6;color:#2091d6">进校</span> 
					<span v-if="DoneData.OutSch == true" class="CheckObj" style="border:1px solid #62bdf5;color:#62bdf5">离校</span> 
					<span v-if="DoneData.ErrorSch == true" class="CheckObj" style="border:1px solid #62bdf5;color:#62bdf5">异常进出校</span> 
					<span v-if="DoneData.InAp 	== true" class="CheckObj" style="border:1px solid #20c4d6;color:#20c4d6">归寝</span> 
					<span v-if="DoneData.OutAp 	== true" class="CheckObj" style="border:1px solid #369da2;color:#369da2">离寝</span> 
			</span> 
			</div>
			<div style="float: left;width:100%;font-size:16px;height: 30px;line-height:30px"> 
				<span style="float:left" >时间范围：</span> 
				<span style="float:left"> {{DoneData.StartDate}} 至 {{DoneData.EndDate}} </span> 
			</div>
			<div style="float: left;width:100%;font-size:14px;height: 40px;line-height:40px;"> 
				<span  style="font-size: 12px;color:gray;float: right;padding-right: 10px">点击更改筛选条件</span>
			</div> 
		</div>

		<div class="component-dialog dialog-order reveal-modal" id="zixunkefu" style="z-index: 109;left:5vw;width:calc(90vw - 36px)" >
			<div class="component-dialog dialog-order"  id="detail_range" style="box-sizing: border-box;">
				<div class="component-dialog-title" style="margin-bottom: 10px">筛选条件</div>
				<div class="component-dialog-body">
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span style="padding: 8px;float: left;color:gray">时间范围</span></br>
							<div style="width:100%;padding-top:7px;position: relative;height: 40px" >
									<span class="Select-event" style="position: absolute; top: 13px; left: 0px;width:45%" >{{StartDate}}</span>
									<span  class="Select-event" style="position: absolute; top: 13px; left: 0px;opacity: 0;width:45%" >
										<input type="date"  style="width:calc(100% - 8px);border:unset;height: 100%;margin-left: 4px;z-index: 14"  v-model="StartDate"/>      
									</span>
									<span style="position: absolute; top: 20px; left: 45%;width:10%">-</span>
									<span  class="Select-event" style="position: absolute; top: 13px; left: 55%;width:45%" >{{EndDate}}</span>
									<span  class="Select-event"  style="position: absolute; top: 13px; left: 55%;opacity: 0;width:45%"  >
										<input type="date" style="width:calc(100% - 8px);border:unset;height: 100%;margin-left: 4px;z-index: 14" v-model="EndDate" />      
									</span>
								</div>
						</div>
					</div>
					<div class="form-line">
						<div class="input-wrapper" style="border:none;">
							<span style="padding: 8px;padding-bottom: 0px;float: left;color:gray">选择项目</span></br>
							<div style="width:100%;padding-top:7px;position: relative;height: 40px;text-align: left;display: flex;flex-direction: row;">
								<span class="Select-event CheckTypes" :class="InSch == true ? 'EVENT-SELECT' : '' "  @click="ChangeType('InSch')" >进校</span>
								<span class="Select-event CheckTypes" :class="OutSch == true ? 'EVENT-SELECT' : '' " @click="ChangeType('OutSch')">离校</span>
								<span class="Select-event CheckTypes" style="width:35%" :class=" ErrorSch == true ? 'EVENT-SELECT' : '' " @click="ChangeType('ErrorSch')">异常进出校</span>
							</div>
							<div style="width:100%;padding-top:7px;position: relative;height: 40px;text-align: left;display: flex;flex-direction: row;">
								<span class="Select-event CheckTypes" :class="InAp == true ? 'EVENT-SELECT' : '' "   @click="ChangeType('InAp')">归寝</span>
								<span class="Select-event CheckTypes" :class="OutAp == true ? 'EVENT-SELECT' : '' "  @click="ChangeType('OutAp')">离寝</span>
							</div>
						</div>
					</div>
					<div class="component-dialog-footer" style="margin-top: 20px">
						<div type="button" class="btn-default btnthis div_closd"  onclick="closed()" >取消</div>
						<div type="button" class="btn-primary btnthis div_sure"   data-opttype="yes" @click="ChangeDone()">确定</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main_detail"  style="margin-left: 3px;float:unset;margin-left: 1%;width:98%;background-color: white;border-radius: 8px 8px 0px 0px;overflow: hidden;">
		<div class="trhead" style="width:calc(100% - 1px);height: 40px;">
			<div class="thhead" style="width:30%;border-radius: 0px 5px 0px 0px;">状态</div>
			<div class="thhead" style="width:50%">时间</div>
			<div class="thhead" style="width:20%;border-radius: 0px 5px 0px 0px;"></div>
		</div>
		<div id="table_info" style="font-size: 12px">
			<?php  if(is_array($list)) { foreach($list as $key_l => $item) { ?>
			<li class="CheckLog" time="<?php  echo $key_l;?>">
				<div class="thhead" style="width:30%;font-size: 12px"><?php  echo $item['logtype'];?></div>
				<div class="thhead" style="width:50%;font-size: 12px"><?php  echo date("Y-m-d",$item['createtime'])?></div>
				<div class="thhead" style="width:20%;font-size: 12px">
					<span class="CheckMoreBtn" onclick="ChaKanXiangQing(<?php  echo $item['id'];?>)">查看详情</span>
				</div>
			</li>
			<?php  } } ?>
		</div>
	</div>



	<div class="component-dialog dialog-order reveal-modal" id="ChaKanXiangQing" style="z-index: 109;left:5vw;width:calc(90vw - 36px)" >
			<div class="component-dialog dialog-order"  id="detail_range" style="box-sizing: border-box;">
				<div class="component-dialog-title" style="margin-bottom: 10px">考勤记录详情</div>
				<div class="component-dialog-body">
					<div> 学生姓名：{{StuName}}</div>
					<div> 刷卡时间：{{CheckTime}}</div>
					<div> 刷卡关系：{{Pard}}</div>
					<div> 刷卡状态：{{Status}}</div>
					<div> 设备名称：{{MacName}}</div>
				</div>
			</div>
		</div>

	<!--左边弹窗-->
	<div class="component-panel" id="date_range" style="display:none;">
		<div class="mask"></div>
	</div>
    <script src="<?php echo OSSURL;?>public/mobile/js/scroll.muti.common.js?v=1717"></script>
    <script language="javascript">



$("body").append('<div id="common_progress" class="common_progress_bg" style=""><div class="common_progress"><div class="common_loading"></div><br><span>正在载入...</span></div></div>');

function ajax_start_loading(text) {
    $("#common_progress").css("display", "block");
    $("body").css("position", "fixed");
    $(".common_progress").css("margin-left", $(window).width() / 2 - 80);
    if (text) {
        $("#common_progress span").text(text);
    }
}
// 关闭菊花转
function ajax_stop_loading() {
    $("#common_progress").hide();
    $("body").css("position", "static");
}


var scroll_load_obj = null;



//重名函数 后面的覆盖前面的，这个地方对scroll_fun 重新定义了下
function scroll_fun() {
    // var bottom = $(".has_show_over");
    var winHeight = window.innerHeight || document.documentElement.clientHeight,
        scrollTop = document.body.scrollTop || document.documentElement.scrollTop,
        documentHeight = $(document).height();
    //将当前的浏览器滚动的高度存在浏览器缓存变量scroll_top
    // sessionStorage.setItem('scroll_top' + scroll_load_obj.page_name, scrollTop);
    //判断是否滚到差不多浏览器底部
    if (parseInt(winHeight) + parseInt(scrollTop) + 5 > parseInt(documentHeight)) {
        var self = scroll_load_obj;
        $(window).off("scroll", scroll_fun);
        //console.log(self.ajax_switch);
        if (self.ajax_switch) {
            //这里做ajax
            self.ajax_switch = false;  //把ajax锁关了防止不断ajax
            var datanumb = $(self.ul_box).children('li').length;
            if(datanumb >= 1){
                $('.has_show_over').show();
                $('.has_show_over').animate({height:"45px"});
                $(".jzz").removeClass('jzz_over');
                $('.jzz_text').text('加载中');
                console.log("!!!");
            }
            var search_type='';
            var search_content='';
            if($('#search_input').length>0){
                typesearch_content = $.trim($('#search_input').val());
                $('.type_item.checked').each(function () {
                    if (search_type != '') {
                        search_type += ',' + $(this).attr('type');
                    } else {
                        search_type += $(this).attr('type');
                    }
                })
            }
            if (index_type_item != '') {
                search_type = index_type_item;
            }

            var GetLiData = {};
            for(let item of self.param){
                //$(self.ul_box).children('li').eq($(self.ul_box).children('li').length-1)
                //GetLiData[item] = $(param.li_item).eq($(param.li_item).length-1).attr(`${item}`) || -1 ;
                GetLiData[item] = $(self.ul_box).children(`${self.li_item}`).eq($(self.ul_box).children(`${self.li_item}`).length-1).attr(`${item}`) || -1 ;
				console.log($(self.ul_box))
            }
         
            var post_data = { 
                limit: $(self.ul_box).children('li').eq($(self.ul_box).children('li').length-1).attr('time'),
                noticeytpe: $("#noticeytpe").val(),
                LiData : GetLiData,
                limit_org:self.limit_org,
                content: search_content,
                //这个地方将一些其他参数加上去
                StartDate: TopVue.DoneData.StartDate,
                EndDate  : TopVue.DoneData.EndDate,
                InSch    : TopVue.DoneData.InSch,
                OutSch   : TopVue.DoneData.OutSch,
                InAp     : TopVue.DoneData.InAp,
                OutAp    : TopVue.DoneData.OutAp,
				ErrorSch : TopVue.DoneData.ErrorSch,
            };
            $('.has_show_over').show();
            $.ajax({
                type: 'POST',
                url: self.ajax_url,
                data: post_data,
                dataType: "html",
                success: function (data) {
                    //载入更多内容
                    if ($.trim(data)) {
                        $(self.ul_box).append(data);
                        // sessionStorage.setItem('cache_html' + self.page_name, $(self.ul_box).html());
                        //self.limit = $(self.ul_box).children('li').eq($(self.ul_box).children('li').length-1).attr('time');
                        // sessionStorage.setItem('limit' + self.page_name, self.limit);
                        if (typeof (self.after_ajax) != 'undefined') {
                            self.after_ajax();
                        }
                        $(window).on("scroll", scroll_fun);
                        self.ajax_switch = true;
                    } else {
                        $('.has_show_over').show();
                        console.log("show");
                        $('.jzz_text').text('数据已加载完毕');
                        $(".jzz").addClass('jzz_over');
                        $(window).off("scroll", scroll_fun);
                        $('.has_show_over').animate({height:"0"});

                    }
                },
                error: function () {
                    jTips('加载失败！');
                    $(window).on("scroll", scroll_fun);
                    self.ajax_switch = true;
                }
            }) //ajax结束
        }
    }
}

var TopVue = new Vue({
	el: '#attendance' ,
	data: function () {
		return{
			InSch    : true,
			OutSch   : true,
			InAp     : true,
			OutAp    : true,
			ErrorSch : true,
			StartDate: '<?php  echo date("Y-m-d",$starttime)?>',
			EndDate  : '<?php  echo date("Y-m-d",$endtime)?>',
			DoneData : {
				InSch    : true,
				OutSch   : true,
				InAp     : true,
				OutAp    : true,
				ErrorSch : true,
				StartDate: '<?php  echo date("Y-m-d",$starttime)?>',
				EndDate  : '<?php  echo date("Y-m-d",$endtime)?>',
			}
		}
	},
	methods:{
		ChangeCondition:function(){
			this.InSch     = this.DoneData.InSch
			this.OutSch    = this.DoneData.OutSch
			this.InAp      = this.DoneData.InAp
			this.OutAp     = this.DoneData.OutAp
			this.DoneData.ErrorSch     = this.ErrorSch
			this.StartDate = this.DoneData.StartDate
			this.EndDate   = this.DoneData.EndDate
			$('#zixunkefu').reveal();
		},
		ChangeType:function(e){
			TopVue[e] = !TopVue[e]
		},
		ChangeDone:function(){
			ajax_start_loading("获取数据中");
			$('#zixunkefu').trigger('reveal:close');
			this.DoneData.InSch     = this.InSch
			this.DoneData.OutSch    = this.OutSch
			this.DoneData.InAp      = this.InAp
			this.DoneData.OutAp     = this.OutAp
			this.DoneData.ErrorSch     = this.ErrorSch
			this.DoneData.StartDate = this.StartDate
			this.DoneData.EndDate   = this.EndDate;
			let self = this;
			$.ajax({
				url: "<?php  echo $this->createMobileUrl('smychecklog', array('schoolid' => $schoolid,'op'=>'More_Data' ), true)?>",
				data : self.DoneData,	
				dataType: 'html',
				type: "post",
				success: function (data) {
					$("#table_info").html(data);
					scroll_load_obj.ajax_switch = true;
					$(window).on("scroll", scroll_fun);
					ajax_stop_loading();
				}
			});	
		}
	}
})

var DetailVue = new Vue({
	el:"#ChaKanXiangQing",
	data:function(){
		return{
			StuName:'',
			MacName:'',
			CheckTime:'',
			Status : '',
			Pard:'',
		}
	}
})



function ChaKanXiangQing(id){
		let self = DetailVue;
		
		$.ajax({
			url: "<?php  echo $this->createMobileUrl('smychecklog', array('schoolid' => $schoolid,'op'=>'GetDetail' ), true)?>",
			data : {
				id :id
			},	
			dataType: 'json',
			type: "post",
			success: function (data) {
				self.StuName = data.data.StuName;
				self.MacName = data.data.MacName;
				self.CheckTime = data.data.CheckTime;
				self.Status = data.data.Status;
				self.Pard = data.data.pard;
			}
		});	
		$("#ChaKanXiangQing").reveal();
	}
 
	


function closed(){
	$('#zixunkefu').trigger('reveal:close');
	
};
 

new Scroll_load({
        "limit"      : "0",
        "ajax_switch": true,
        "ul_box"     : "#table_info",
        "li_item"    : ".CheckLog",
        "param"      : ["time"],
        "ajax_url"   : "<?php  echo $this->createMobileUrl('smychecklog', array('schoolid' => $schoolid,'op'=>'More_Data' ), true)?>",
        "page_name"  : "teacher_notify",
        "after_ajax": function () {
        }
    }).load_init();
 
 
 
	$(function ($) {
	 
				
		$("#bdax").on('click', function () {
			var time = $("#time").val();
			if (time == "" || time == undefined || time == null) {
            jTips('请选择日期！');
            return false;
			}
			location.href = "<?php  echo $this->createMobileUrl('jschecklog', array('schoolid' => $schoolid,'nj_id' => $nj_id), true)?>"+ '&time=' + time;	
		});		
	});
	function isSelect(bjid){
		jTips("数据加载中！···");
		location.href = "<?php  echo $this->createMobileUrl('jschecklog', array('schoolid' => $schoolid), true)?>"+ '&nj_id=' + bjid;
	}	
</script>	
<?php  include $this->template('newfooter');?>
<script>;</script><script type="text/javascript" src="http://school.test/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weixuexiao"></script></body>
</html>