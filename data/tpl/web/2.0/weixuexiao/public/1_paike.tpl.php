<?php defined('IN_IA') or exit('Access Denied');?><style>
.popover {z-index: 2051;}
.week-select-wrap { border: 1px solid #e8e8e8; border-radius: 4px; overflow: hidden; height: 32px; font-size: 0; display: inline-block }
.week-select-wrap .item { display: inline-block; -webkit-box-sizing: border-box; box-sizing: border-box; width: 30px; height: 30px; line-height: 30px; text-align: center; font-size: 14px; color: #333; border-left: 1px solid #e8e8e8; cursor: pointer }
.week-select-wrap .item:first-child { border-left: 0 }
.week-select-wrap .item.active { color: #fff; background: #fc9c6b }
.time-box { border: 1px solid #e8e8e8; height: 288px;}
.time-box li { padding: 0 20px; border-bottom: 1px solid #e8e8e8; line-height: 40px; height: 40px; position: relative; }
.time-box  li:first-child span { color: #ff8534;cursor: pointer; }
.opt_box{float:right;color: #ff8534;}
.opt_box .fa{font-size:15px;font-weight: 1;cursor: pointer}
.opt_box .fa:first-child{margin-right:15px}
.left_timebox{width: 30%; float: left;}
.left_timeboxbig{width: 70%; float: left;}
.add_new_time{cursor:pointer;}
.new_timesave{margin-top: 5px;height: 26px;}
.left_timeboxs{width: 20%; float: left;}
.input-group #daynumber{font-size: 20px;font-weight: blod;color: red;}
.clear{clear: both;}
.box{width: 100%;height: 100%;}
.head{width: 100%;height:30px;cursor: pointer;}
.head .prev,.head .next{width: 20%;text-align: center;float: left;line-height: 13px;font-size:13px;}
.head .tomon{width: 30%;float: left;text-align: center;line-height: 13px;font-size:13px;}
.head .now{width: 20%;float: left;text-align: center;line-height: 13px;font-size: 13px;}
.date ol{width: 100%;height: 30px;background: #dcdbdb;padding: 0;}
.date ol li{display:block;float: left;width: 14.2857%;text-align: center;font-size: 13px;color: #444;border: none;padding: 0;line-height: 30px;height: 30px;}
.date ul{width: 100%;display: flex;flex-direction: row;flex-wrap: wrap;}
.date ul li{ display: block; width: 10.16%; height: 28px; border-radius: 5px;text-align: center; font-size: 14px; background: #fff; position: relative; margin: 6px; }
.date ul li:hover{cursor:pointer;color: #fff;background: #cac4c4;}
.date ul li i{ font-size: 6px; position: absolute; right: 0; bottom: 3px; display: block; height: 3px; line-height: 15px; width: 125%; text-align: center; color: #de4208; }
.date ul li span{display: block;width: 100%;height: 100%;line-height: 28px;text-align: center;}
.date ul .no_date{color: #cac4c4;line-height:28px}
.date ul .no_date:hover{cursor:pointer;color: #cac4c4;background: #fff;}
.date ul .act_wk{color: #e35925;}
.date ul .act_date{background: #fc9c6b;color: #fff;}
.date ul .act_today{border:1px solid #ff6600;}
.date ul .act_ds{background: ##b8bdc1;color: #fff;}
.ks_box{border: 1px solid #e8e5e5;border-radius: 20px;padding-top: 22px;padding-left: 22px;margin-top: 15px;position: relative; }
.ks_box:first-child{margin-top: 0px;}
.del_this_box{ position: absolute; color: red; right: 5px; top: 5px; }
</style>
<script type="text/javascript" src="<?php echo OSSURL;?>public/web/js/mobile_date.js"></script>
<div class="modal-header">
	<h4 class="modal-title" id="modal-title-kc" style="text-align:center;color:#333;font-size: 17px;"><?php  echo $kcinfo['name'];?>-<?php  if($kcinfo['kc_type'] == 1) { ?>线上课程<?php  } else { ?>线下课程<?php  } ?></h4>
</div>
<!--线上课程排课头部-->
<div class="col-sm-9" style="margin-top:5px;">
	<div class="btn-group">
	<?php  if($kcinfo['kc_type'] == 0) { ?>
		<a class="btn btn-primarys guize" optid="guize">规则排课</a>
		<a class="btn btn-defaults guize" optid="rili" style="margin-left: 0px;">日历排课</a>
	<?php  } else { ?>	
		<a class="btn btn-defaults guize" optid="online">在线课程</a>
	<?php  } ?>	
	</div>
	<div class="alert" style="padding:1px;float: right;margin-bottom: 1px">已排课<span class="bold" style="font-size:20px;font-weight:blod;color:red"><?php  echo $allks;?></span>节</div>
</div>
<div class="modal-body form_paike_box" style="width: 100%;overflow-y: scroll;padding: 34px;height: 600px;">
	<!--线下课程排课-->
	<?php  if($kcinfo['kc_type'] == 0) { ?>
	<form id="guize">
		<div class="form-group">
			<label class="col-sm-2 control-label"><span class="require">*</span>时间范围</label>
			<div class="input-group clocknews">
				<div class="input-group" style="margin-left: 12px;">
					<?php  echo tpl_form_field_date('start', date('Y-m-d',TIMESTAMP))?>
				</div>
				<span class="input-group-addon">至</span>
				<div class="input-group">
					<?php  echo tpl_form_field_date('end', date('Y-m-d',TIMESTAMP))?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">重复模式</label>
			<div class="col-sm-3">
				<select name="re_type" class="form-control">
					<option value="1">每周重复</option>
					<option value="2">隔周重复</option>
				</select>
			</div>
			<label class="col-sm-2 control-label">授课教室</label>
			<div class="col-sm-3">
				<select style="margin-right:15px;" name="adrr" id="adrr" class="form-control">
					<option value="">请选择教室</option>
					<?php  if(is_array($addr)) { foreach($addr as $row) { ?>
					<option value="<?php  echo $row['sid'];?>" <?php  if($kcinfo['adrr'] == $row['sid']) { ?>selected<?php  } ?>><?php  echo $row['sname'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">周几上课</label>
			<div class="col-sm-6">
				<div class="week-select-wrap">
					<span weidid="1" class="item active">一</span>
					<span weidid="2" class="item">二</span>
					<span weidid="3" class="item">三</span>
					<span weidid="4" class="item">四</span>
					<span weidid="5" class="item">五</span>
					<span weidid="6" class="item">六</span>
					<span weidid="7" class="item">日</span>
				</div>
				<div class="help-block">可多选</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">上课时段</label>
			<div class="col-sm-3">
				<select name="sd_id" class="form-control all_sd">
						<option value="0">选择时段</option>
					<?php  if(is_array($sd)) { foreach($sd as $it) { ?>
						<option value="<?php  echo $it['sid'];?>"><?php  echo $it['sname'];?></option>
					<?php  } } ?>
				</select>
			</div>
			<label class="col-sm-2 control-label pzsd" onclick="pzsd()" style="color:#fc9c6b;cursor:pointer;">配置上课时间</label>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">授课老师</label>
			<div class="col-sm-3">
				<select name="tid" class="form-control">
					<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
						<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
					<?php  } } ?>
				</select>
			</div>
			<label class="col-sm-2 control-label">消耗课时</label>
			<div class="col-sm-3">
				<div class="input-group">
					<input type="number" class="form-control" name="costnum" value="1" />
					<span class="input-group-addon">节</span>
				</div>
				<div class="help-block">每次签到扣几节</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">上课内容</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="conment" placeholder="输入课时内容,500字以内"></textarea>
				<div class="help-block">如需使用富文本,请在排课后编辑需要使用的课时即可</div>
			</div>
		</div>
	</form>
	<form id="rili" style="display:none">
		<div class="form-group">
			<label class="col-sm-2 control-label">上课日历</label>
			<div class="col-sm-3">
				<div class="input-group">已选<span id="daynumber">0</span>天</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-6">
				<div class="box">
					<section class="date">
						<div class="head">
							<div class="prev">上一月</div>
							<div class="tomon"><span class="year"></span>年 <span class="month"></span>月</div>
							<div class="tomon">今天</div>
							<div class="next">下一月</div>
						</div>
						<ol><li>日</li><li>一</li><li>二</li><li>三</li><li>四</li><li>五</li><li>六</li></ol>
						<ul>
							
						</ul>
					</section>
				</div>
				<div class="help-block">可多选</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">上课时段</label>
			<div class="col-sm-3">
				<select name="rl_sd_id" class="form-control all_sd">
						<option value="0">选择时段</option>
					<?php  if(is_array($sd)) { foreach($sd as $it) { ?>
						<option value="<?php  echo $it['sid'];?>"><?php  echo $it['sname'];?></option>
					<?php  } } ?>
				</select>
			</div>
			<label class="col-sm-2 control-label pzsd" onclick="pzsd()" style="color:#fc9c6b;cursor:pointer;">配置上课时间</label>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">授课教室</label>
			<div class="col-sm-3">
				<select style="margin-right:15px;" name="rl_adrr" id="adrr" class="form-control">
					<option value="">请选择教室</option>
					<?php  if(is_array($addr)) { foreach($addr as $row) { ?>
					<option value="<?php  echo $row['sid'];?>"><?php  echo $row['sname'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">授课老师</label>
			<div class="col-sm-3">
				<select name="rl_tid" class="form-control">
					<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
						<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
					<?php  } } ?>
				</select>
			</div>
			<label class="col-sm-2 control-label">消耗课时</label>
			<div class="col-sm-3">
				<div class="input-group">
					<input type="number" class="form-control" name="rl_costnum" value="1" />
					<span class="input-group-addon">节</span>
				</div>
				<div class="help-block">每次签到扣几节</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">上课内容</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="rl_conment" placeholder="输入课时内容,500字以内"></textarea>
				<div class="help-block">如需使用富文本,请在排课后编辑需要使用的课时即可</div>
			</div>
		</div>
	</form>
	<?php  } ?>
	<!--线上课程排课-->
	<?php  if($kcinfo['kc_type'] == 1) { ?>
	<form id="online">
		<div class="ks_bigbox">
			<div class="ks_box">
				<div class="form-group">
					<label class="col-sm-1 control-label">名称</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name[]" value="" placeholder="15字以内" />
						<div class="help-block">请输入本节课名称</div>
					</div>
					<label class="col-sm-1 control-label">排序</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" name="ssort[]" value="" placeholder="数字" />
						<div class="help-block">越大越靠前</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">试看</label>
					<div class="col-sm-1" style="padding:0px;margin-left: 25px;">
						<div class="input-group">
							<input name="is_try" class="weui_switchs" onclick="weui_switchs(this)" type="checkbox">
							<span class="input-group-addon">禁止</span>
							<input name="is_try_see[]" type="hidden" value="2">
						</div>
						<div class="help-block" style="width:190px">设置未购用户是否能观看本节内容</div>
					</div>
					<?php  if($kcinfo['allow_menu'] == 1) { ?>
					<label class="col-sm-1 control-label" style="margin-left: 83px;">章节</label>
					<div class="col-sm-4">
						<select name="menuid[]" class="form-control allmenu_list">
							<?php  if($allmenu) { ?>
								<?php  if(is_array($allmenu)) { foreach($allmenu as $row) { ?>
									<option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
								<?php  } } ?>	
							<?php  } else { ?>
								<option value="-1">默认章节</option>
							<?php  } ?>
						</select>
					</div>
					<label class="col-sm-2 control-label pzzj" onclick="pzzj()" style="color:#fc9c6b;cursor:pointer;">配置章节</label>
					<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">老师</label>
					<div class="col-sm-3">
						<select name="tid[]" class="form-control">
							<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
								<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
							<?php  } } ?>
						</select>
					</div>
					<label class="col-sm-1 control-label">内容</label>
					<div class="col-sm-3">
						<select name="content_type[]" onchange="cont(this)" class="form-control">
							<option value="-1">选择类型</option>
							<option value="0">富文本</option>
							<option value="1">直播</option>
							<option value="2">视频</option>
							<option value="3">语音</option>
							<option value="4">纯图</option>
							<option value="5">文档/文件</option>
						</select>
					</div>
				</div>
				<div class="form-group">
				
				</div>			
			</div>
		</div>	
		<div class="clearfix template" style="margin-top:20px"> 
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<a href="javascript:;" id="add_new_ks"><i class="fa fa-plus-circle"></i> 添加课时</a>
				</div>
			</div>	
		</div>
	</form>
	<script>
	$('.guize_rili').hide()
	$('.online_btn').show()
	</script>
	<?php  } ?>
	<input type="hidden" id="pk_mode" value="<?php  if($kcinfo['kc_type'] == 0) { ?>guize<?php  } ?><?php  if($kcinfo['kc_type'] == 1) { ?>online<?php  } ?>"/>
</div>
<script type="text/javascript">
function sub_ks_online(){
	var kc_type = $('#kc_type').val()
	var pkmode = $('#pk_mode').val()
	var only_onekc = $('#only_onekc').val()
	var form = new FormData(document.getElementById(pkmode));
	var kcid = $('#addks_nowkcid').val()
	$.ajax({
		url: "<?php  echo $this->createWebUrl('kecheng', array('op' => 'add_newks','schoolid' => $schoolid))?>"+"&kcid="+kcid+"&pkmode="+pkmode,
		type: "post",
		data: form,
		processData: false,
		contentType: false,
		success: function(result) {
			var data = jQuery.parseJSON(result);
			alert(data.msg);
			if(data.result){
				$('#addks_nowkcid').val(0)
				$('#pk_ones').empty();
				$('#Modal7').modal('toggle');
				$('.guize_rili').hide()
				$('.online_btn').hide()
				if(only_onekc){
					if(kc_type == 0){
						search_kslist()
					}else{
						search_kslist_online()
					}
				}else{
					get_new_coment(data.kcid,data.type)
				}
			}
		},
		error: function(e) {
			alert('访问网络失败');
			console.log(e)
		}
	});
}
function cont(elm){
	let type = $(elm).val()
	let kcid = $('#addks_nowkcid').val()
	let tb = $(elm).parent().parent().next();
	tb.empty()
	$.ajax({
		url: "<?php  echo $this->createWebUrl('indexajax', array('op'=>'get_ks_conttemplet'))?>",
		type: "post",
		dataType: "html",
		data: {
			type:type,
			kcid:kcid,
			schoolid:"<?php  echo $schoolid;?>"
		},
		success: function (data) {
			if (data) {
				tb.html(data);
			}
		}		
	});
}
$('#add_new_ks').click(function(){
	let kcid = $('#addks_nowkcid').val()
	let tb = $('.ks_bigbox');
	$.ajax({
		url: "<?php  echo $this->createWebUrl('indexajax', array('op'=>'get_ks_conttemplet'))?>",
		type: "post",
		dataType: "html",
		data: {
			type:'newbox',
			kcid:kcid,
			schoolid:"<?php  echo $schoolid;?>"
		},
		success: function (data) {
			if (data) {
				tb.append(data);
			}
		}		
	});
})
function del_this_box(elm){
	$(elm).parent().remove()
}
function weui_switchs(elm){
	var name = $(elm).attr("name")
	if(name == 'is_try'){
		var thisval = $(elm).prop('checked')?1:2;
		var word = $(elm).prop('checked')?"允许":"禁止";
	}
	$(elm).next().next().val(thisval)
	$(elm).next().text(word);
}
$('.btn-group .guize').click(function(){
	var opt = $(this).attr("optid")
	$(this).parent().children('.guize').removeClass("btn-primarys");
	$(this).parent().children('.guize').removeClass("btn-defaults");
	$(this).addClass("btn-primarys")
	$(".form_paike_box").children().slideUp(200)
	$("#"+opt).slideDown(200)
	if(opt == 'guize'){
		$('#pk_mode').val('guize')
	}
	if(opt == 'rili'){
		$('#pk_mode').val('rili')
	}
	if(opt == 'online'){
		$('#pk_mode').val('online')
	}
});
$('.week-select-wrap .item').click(function() {
	if($(this).hasClass('active')){
		$(this).removeClass('active')
	}else{
		$(this).addClass('active')
	}
});
</script>