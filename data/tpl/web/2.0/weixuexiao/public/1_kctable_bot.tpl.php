<?php defined('IN_IA') or exit('Access Denied');?><?php  if($is_online) { ?>
	<?php  if($menulist) { ?>
	<table class="table table-hover" style="border: 0.5px solid #dddddd73;">
		<thead class="navbar-inner" style="background:#dddddd47;">
			<tr>
				<th style="width:10%">章节 </th>
				<th style="width:15%;text-align: center;">课程名称</th>
				<th style="width:10%;text-align:center">试看</th>
				<th style="width:10%;text-align:center">老师</th>
				<th style="width:8%;">课程类型</th>
				<th style="width:8%;">学习人数</th>
				<th style="width:8%;">点击量</th>
				<th style="width:8%;">预览</th>
				<th style="width:5%;">排课</th>
				<th style="text-align:right; width:8%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($menulist)) { foreach($menulist as $item) { ?>
				<tr>
					<td></td>
					<td><h5 style="left: 4%;font-size: 15px;font-weight:bold;position: absolute;"><?php  echo $item['name'];?></h5></td>	
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="text-align:right;">
						<a class="btn btn-info btn-sm open_list" onclick="open_kslist(this,<?php  echo $item['id'];?>)"><i class="fa fa-angle-double-up">   收起</i></a>
					</td>
				</tr>
					<?php  if(is_array($item['list'])) { foreach($item['list'] as $row) { ?>
						<tr class="list_<?php  echo $item['id'];?>" style="background: rgba(25, 24, 24, 0.04);">
							<td></td>
							<td><?php  echo $row['name'];?></td>	
							<td><input <?php  if($row['is_try_see']==1) { ?>checked value="1"<?php  } else { ?>value="2"<?php  } ?> ks_id="<?php  echo $row['id'];?>" style="right:65px;" class="weui_switch anniu" type="checkbox"/></td>
							<td style="text-align:center"><img width="25" style="border-radius:50%" src="<?php  echo $row['thumb'];?>">  <?php  echo $row['tname'];?></td>
							<td><?php  echo $row['type'];?></td>
							<td><?php  echo $row['times'];?>人</td>
							<td><?php  echo $row['clicks'];?>次</td>
							<td><a class="btn btn-success btn-xs" onclick="preview_ks(<?php  echo $row['id'];?>)"><i class="fa fa-eye">  预览</i></a></td>
							<td><?php  echo $row['pkuser'];?></td>
							<td style="text-align:right;">
								<a class="btn btn-default btn-xs" onclick="edt_ks(<?php  echo $row['id'];?>,this);" title="编辑"><i class="fa fa-pencil"></i></a>
								<a class="btn btn-default btn-xs" onclick="del_ks(<?php  echo $row['id'];?>,this);" title="删除"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					<?php  } } ?>
			<?php  } } ?>
		</tbody>
	</table>
	<div class="modal fade" style="min-width: 600px!important;z-index: 1050 !important;" id="Modal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static">
		<div class="modal-dialog" style="left: 32%;top: 20%;">
			<div class="modal-content" style="border-radius: 20px;">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-title-kc" style="text-align:center;color:#333;font-size: 17px;">修改课时</h4>
				</div>
				<!--线上课程排课头部-->
				<div class="col-sm-9" style="margin-top:5px;">
					<div class="btn-group">
						<a class="btn btn-primarys ks_opt" optid="ksinfo">课时信息</a>
					</div>
				</div>
				<div class="modal-body form_paike_box" style="width: 100%;padding: 34px;">
					<form id="online_oneks">
						<div class="ks_bigbox">
							<div class="ks_box">
								<div class="form-group">
									<label class="col-sm-1 control-label">本节名称</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="name[]" id="name_one" value="" placeholder="15字以内" />
										<div class="help-block">请输入本节课名称</div>
									</div>
									<label class="col-sm-1 control-label">排序</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="ssort_one" name="ssort[]" value="" placeholder="数字" />
										<div class="help-block">越大越靠前</div>
									</div>
								</div>
								<div class="form-group">
									<?php  if($kcinfo['allow_menu'] == 1) { ?>
									<label class="col-sm-1 control-label">归属章节</label>
									<div class="col-sm-5">
										<select name="menuid[]" id="menulist_one" class="form-control allmenu_list">
											<?php  if($allmenu) { ?>
												<?php  if(is_array($allmenu)) { foreach($allmenu as $row) { ?>
													<option value="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></option>
												<?php  } } ?>	
											<?php  } else { ?>
												<option value="-1">默认章节</option>
											<?php  } ?>
										</select>
									</div>
									<?php  } ?>
								</div>
								<div class="form-group">
									<label class="col-sm-1 control-label">授课老师</label>
									<div class="col-sm-3">
										<select name="tid[]" id="tidlist_one" class="form-control">
											<?php  if(is_array($teachers)) { foreach($teachers as $row) { ?>
												<option value="<?php  echo $row['id'];?>" ><?php  echo $row['tname'];?></option>
											<?php  } } ?>
										</select>
										<div class="help-block">非必选</div>
									</div>
									<label class="col-sm-1 control-label">内容类型</label>
									<div class="col-sm-3">
										<select name="content_type[]" id="content_type_one" onchange="cont(this)" class="form-control">
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
								<div class="form-group" id="cont_neirong">

								</div>
							</div>
						</div>
						<input name="ksid[]" id="on_online_ksid" type="hidden" value=""/>
					</form>
				</div>
				<div class="modal-footer" style="border-radius: 6px;">
					<input type="submit" onclick="sub_for_online_ks()" class="btn btn-success" value="确认提交">
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" style="min-width: 500px!important;z-index: 1050 !important;" id="Modal13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static">
		<div class="modal-dialog" style="left: 32%;top: 5%;">
			<div class="modal-content" style="border-radius: 20px;">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-title-kc" style="text-align:center;color:#333;font-size: 17px;">预览课时内容</h4>
				</div>
				<div class="modal-body" style="width: 100%;padding: 34px;max-height: 819px;">
					<div class="ks_bigbox">
						<div class="preview-phone" id="preview_box">

						</div>
					</div>
				</div>
				<div class="modal-footer" style="border-radius: 6px;">
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	function sub_for_online_ks(){
		var form = new FormData(document.getElementById('online_oneks'));
		let kcid = "<?php  echo $kcid;?>"
		$.ajax({
			url: "<?php  echo $this->createWebUrl('kecheng', array('op' => 'add_newks','schoolid' => $schoolid))?>"+"&kcid="+kcid+"&pkmode=online",
			type: "post",
			data: form,
			processData: false,
			contentType: false,
			success: function(result) {
				var data = jQuery.parseJSON(result);
				alert(data.msg);
				if(data.result){
					$('#Modal12').modal('toggle');
					location.reload()
				}
			},
			error: function(e) {
				alert('访问网络失败');
				console.log(e)
			}
		});
	}
	function cont(elm){//选择内容类型
		let type = $(elm).val()
		let kcid = "<?php  echo $kcid;?>"
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

	function preview_ks(ksid){//预览课时内容
		$('#preview_box').empty()
		$('#Modal13').modal('toggle')
		let kcid = "<?php  echo $kcid;?>"
		$.ajax({
			url: "<?php  echo $this->createWebUrl('indexajax', array('op'=>'get_ks_conttemplet'))?>",
			type: "post",
			dataType: "html",
			data: {
				ksid:ksid,
				kcid:kcid,
				type:'preview'
			},
			success: function (data) {
				$('#preview_box').html(data);
			}		
		});	
	}
	function edt_ks(ksid,elm){//点击编辑课时弹框
		$('#Modal12').modal('toggle')
		$('#on_online_ksid').val(ksid)
		$('#cont_neirong').empty()
		$.ajax({
			url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'get_oneks','schoolid' => $schoolid))?>",
			type: "post",
			dataType: "json",
			data: {
				ksid:ksid
			},
			success: function (data) {
				if (data.result) {
					var ksinfo = data.ksinfo
					$('#name_one').val(ksinfo.name)
					$('#ssort_one').val(ksinfo.ssort)
					set_select_checked('tidlist_one', ksinfo.tid)
					set_select_checked('menulist_one', ksinfo.menu_id)
					set_select_checked('content_type_one', ksinfo.content_type)
					get_defcont(ksinfo.content_type,ksid)
				}
			}		
		});	
	}
	function get_defcont(type,ksid){//课时内容默认模板
		let kcid = "<?php  echo $kcid;?>"
		$.ajax({
			url: "<?php  echo $this->createWebUrl('indexajax', array('op'=>'get_ks_conttemplet'))?>",
			type: "post",
			dataType: "html",
			data: {
				type:type,
				kcid:kcid,
				ksid:ksid,
				schoolid:"<?php  echo $schoolid;?>"
			},
			success: function (data) {
				if (data) {
					$('#cont_neirong').html(data);
				}
			}		
		});
	}
	$('.anniu').click(function(){//纽扣按钮的逻辑处理
		var ksid = $(this).attr("ks_id")
		var thisval = $(this).prop('checked')?1:2;
		$(this).val(thisval)
		$.ajax({
			url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'change_trysee','schoolid' => $schoolid))?>",
			type: "post",
			dataType: "json",
			data: {
				ksid:ksid,
				trysee:thisval
			},
			success: function (data) {
				if (data.result) {
				}else{
					alert(data.msg)
				}
			}		
		});
	});
	function del_ks(ksid,elm){//删除课时
		if(confirm("是否确认删除")){
			$.ajax({
				url: "<?php  echo $this->createWebUrl('kcbiao', array('op'=>'del_oneks','schoolid' => $schoolid))?>",
				type: "post",
				dataType: "json",
				data: {
					ksid:ksid
				},
				success: function (data) {
					if (data.result) {
						$(elm).parent().parent().hide(200)
					}
					alert(data.msg)
				}		
			});
		}
	}
	function open_kslist(elm,menuid){
		if($(elm).hasClass("open_list")){
			$(elm).removeClass("open_list")
			$(elm).children().text("   展开")
			$(elm).children().removeClass("fa-angle-double-up")
			$(elm).children().addClass("fa-angle-double-down")
			$('.list_'+menuid).slideUp(300)
		}else{
			$(elm).addClass("open_list")
			$(elm).children().text("   收起")
			$(elm).children().addClass("fa-angle-double-up")
			$(elm).children().removeClass("fa-angle-double-down")
			$('.list_'+menuid).slideDown(300)
		}
	}
	</script>
	<?php  } else { ?>
	<div class="ant-empty ant-empty-normal" style="text-align:center;margin-top:3%;display:block">
		<div class="ant-empty-image">
			<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
		</div>
		<p class="ant-empty-description">没有排课记录</p>
	</div>
	<?php  } ?>
<?php  } else { ?>
	<?php  if($Data) { ?>
	<div id="NowTimeLine" style="border-top: black dotted 1px;position: relative; margin: 0 auto;width:90%;z-index: 10; ">
		<div style="position: absolute;left: -8px;top: -9px;width: 0;height: 0;border-top: 8px solid transparent;border-bottom: 8px solid transparent;border-left: 8px solid red;"></div>
	</div>
	<div id="Tess">
		<div  class="cd-schedule loading">
			<div class="timeline">
				<ul>
					<li><span>06:00</span></li>
					<li><span>06:30</span></li>
					<li><span>07:00</span></li>
					<li><span>07:30</span></li>
					<li><span>08:00</span></li>
					<li><span>08:30</span></li>
					<li><span>09:00</span></li>
					<li><span>09:30</span></li>
					<li><span>10:00</span></li>
					<li><span>10:30</span></li>
					<li><span>11:00</span></li>
					<li><span>11:30</span></li>
					<li><span>12:00</span></li>
					<li><span>12:30</span></li>
					<li><span>13:00</span></li>
					<li><span>13:30</span></li>
					<li><span>14:00</span></li>
					<li><span>14:30</span></li>
					<li><span>15:00</span></li>
					<li><span>15:30</span></li>
					<li><span>16:00</span></li>
					<li><span>16:30</span></li>
					<li><span>17:00</span></li>
					<li><span>17:30</span></li>
					<li><span>18:00</span></li>
					<li><span>18:30</span></li>
					<li><span>19:00</span></li>
					<li><span>19:30</span></li>
					<li><span>20:00</span></li>
					<li><span>20:30</span></li>
					<li><span>21:00</span></li>
					<li><span>21:30</span></li>
					<li><span>22:00</span></li>
					<li><span>22:30</span></li>
					<li><span>23:00</span></li>
					<li><span>23:30</span></li>
					<li><span>00:00</span></li>
					
				</ul>
			</div>
			<!-- .timeline -->
			<div class="events">
				<ul>
					<?php  if(is_array($Data)) { foreach($Data as $event) { ?>
					<li class="events-group" style="position: relative;z-index:<?php  echo $event['index'];?>">
						<div class="top-info">
							<span <?php  if($NowDate == $event['date'] ) { ?> style="color:orange;font-weight: bold;font-size:110% " <?php  } ?> ><?php  echo $event['title'];?>(<?php  echo $event['date'];?>)</span>
						</div>
						<ul>
							<?php  if(is_array($event['data'])) { foreach($event['data'] as $row_event) { ?>
							<div style="display:flex;flex-direction:row"  class="single-event-div" data-start="<?php  echo $row_event['start_time'];?>" data-end="<?php  echo $row_event['end_time'];?>" >
								<?php  if(is_array($row_event['data'])) { foreach($row_event['data'] as $key => $event_data) { ?>
								<?php 
									$count_this = count($row_event['data']);
									if($count_this > 1){
										$event_co_key = $key % 4 + 1 ;
										$Mut_type = 1;
									}else{
										$event_co_key = $Ord_key % 4 + 1;
										$Mut_type = 0;
									} 
									$Ord_key++;
								?>
								<li class="single-event"  data-event="event-<?php  echo $event_co_key;?>"  style="background-color:<?php  echo $event_data['color'];?>" data-MutiType='<?php  echo $Mut_type;?>' style="width:100%" >
									<div class="show-detail" style="display:none;">
										<ul>
											<li><?php  echo $event_data['kcnames'];?>(<?php  echo $event_data['ksname'];?>)</li>
											<li class="one-line-text">(排课模式：<?php  echo $event_data['type'];?>)</li>
											<li><span class="icon iconfont fa fa-clock-o"></span><?php  echo $row_event['start_time'];?>-<?php  echo $row_event['end_time'];?></li>
											<li><span class="icon iconfont fa fa-user"></span><?php  echo $event_data['tname'];?></li>
											<li><span class="icon iconfont fa fa-graduation-cap"></span><?php  echo $event_data['adrr'];?></li>
											<li><span class="icon iconfont fa fa-check-square-o"></span><div class="process"><div class="process-outer"><div class="process-inner process-inner-blue" style="width: <?php  echo $event_data['signbili'];?>%;max-width: 100%;"></div></div><span><?php  echo $event_data['signstu'];?>/<?php  echo $event_data['bmstu'];?></span></div></li>
										</ul>
										<div class="arrow"></div>
									</div>
									<a href="#0" class="contet">
										<span class="event-name"><?php  echo $event_data['kcname'];?>(<?php  echo $event_data['ksname'];?>)</span>
										<span class="event-date fa fa-clock-o" <?php  if($Mut_type) { ?> style="display:none"<?php  } ?> > <?php  echo $row_event['start_time'];?> - <?php  echo $row_event['end_time'];?></span>
										<span class="event-date fa fa-flask" <?php  if($Mut_type) { ?>style='display:none'<?php  } ?> > <?php  echo $event_data['adrr'];?></span>
										<span class="event-date fa fa-lemon-o" <?php  if($Mut_type) { ?>style='display:none'<?php  } ?> > <?php  echo $event_data['type'];?></span>
									</a>
									<div class="control" style="width: 100%;display:none">
										<div class="edit-class" onclick="tiaoke(<?php  echo $event_data['id'];?>)">
											<?php  if($event_data['timeend']>TIMESTAMP || ($event_data['signstu'] == 0 && $event_data['leavetu'] == 0 && $signtid == 0)) { ?>调课<?php  } else { ?>详情<?php  } ?>
										</div>
										<div class="take-name"  onclick="dianming(<?php  echo $event_data['id'];?>)">点名</div>
									</div>
								</li>
								<?php  } } ?>
							</div>
							<?php  } } ?> 
						</ul>
					</li>
					<?php  } } ?>
				</ul>
			</div>
			<div class="cover-layer"></div>
		</div>
	</div>	
	<script>
	$('.control').mousemove(function(e){
		let x = 10;
		let y = -50;
		let scolltop = $(window).scrollTop()
		$(this).parent().children(".show-detail").css({	"top": (e.pageY + y - scolltop) + "px","left": (e.pageX + x) + "px","opacity": 6,"z-index": 9999,"display": "block"}).show("fast");
	});
	$('.control').mouseout(function(){
		$(this).parent().children(".show-detail").hide();
	});
	
	jQuery(document).ready(function($) {
		//控制主体高度
		$(".cd-schedule .events .events-group > ul").css("height",($(".timeline>ul > li").length - 1) * 50 +'px')
		//UnKnown
		var transitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';
		var transitionsSupported = ($('.csstransitions').length > 0);
		//if browser does not support transitions - use a different event to trigger them
		if (!transitionsSupported) transitionEnd = 'noTransition';
		//should add a loding while the events are organized 
		function SchedulePlan(element) {
			this.element = element;
			this.timeline = this.element.find('.timeline'); 
			this.timelineItems = this.timeline.find('li');
			this.timelineItemsNumber = this.timelineItems.length;
			this.timelineStart = getScheduleTimestamp(this.timelineItems.eq(0).text());
			//获取两个时间标签之间的差值 （半个小时）
			this.timelineUnitDuration = getScheduleTimestamp(this.timelineItems.eq(1).text()) - getScheduleTimestamp(this.timelineItems.eq(0).text());
			this.eventsWrapper = this.element.find('.events'); //课程表主体
			this.eventsGroup = this.eventsWrapper.find('.events-group'); 
			this.singleEvents = this.eventsGroup.find('.single-event-div'); //盒子主体 一个盒子就是一个课时，内可存在多个课程安排
			this.NowTimeLine = this.element.find("#NowTimeLine");
			this.eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight(); 
			//点击弹窗
			this.modal = this.element.find('.event-modal');
			this.modalHeader = this.modal.find('.header');
			this.modalHeaderBg = this.modal.find('.header-bg');
			this.modalBody = this.modal.find('.body');
			this.modalBodyBg = this.modal.find('.body-bg');
			this.modalMaxWidth = 800;
			this.modalMaxHeight = 510;
			this.animating = false;
			this.initSchedule();
		}
		SchedulePlan.prototype.initSchedule = function() {
			this.scheduleReset(); 
			this.initEvents();
		};
		
		//初始化 Unknown
		SchedulePlan.prototype.scheduleReset = function() {
			var mq = this.mq();
			if (mq == 'desktop' && !this.element.hasClass('js-full')) {
				//in this case you are on a desktop version (first load or resize from mobile)
				this.eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight();
				this.element.addClass('js-full');
				this.placeEvents();
				this.element.hasClass('modal-is-open') && this.checkEventModal();
			} else if (mq == 'mobile' && this.element.hasClass('js-full')) {
				//in this case you are on a mobile version (first load or resize from desktop)
				this.element.removeClass('js-full loading');
				this.eventsGroup.children('ul').add(this.singleEvents).removeAttr('style');
				this.eventsWrapper.children('.grid-line').remove();
				this.element.hasClass('modal-is-open') && this.checkEventModal();
			} else if (mq == 'desktop' && this.element.hasClass('modal-is-open')) {
				//on a mobile version with modal open - need to resize/move modal window
					this.checkEventModal('desktop');
					this.element.removeClass('loading');
			} else {
				this.element.removeClass('loading');
			}
		};
		// 初始化 注册点击事件
		SchedulePlan.prototype.initEvents = function() {
			var self = this;
			this.singleEvents.each(function() {
				//create the .event-date element for each event
			 /*    var durationLabel = '<span class="event-date">' + $(this).data('start') + ' - ' + $(this).data('end') + '</span>';
				//给每个event 增加时间显示
				$(this).children().children('a').prepend($(durationLabel)); */
	//点击单个 event 事件
				//detect click on the event and open the modal
				$(this).children().on('click', 'a', function(event) {
					event.preventDefault();
					let planid = $(this).attr('data-planid');
				//TODO:
				
				   // if (!self.animating) self.openModal($(this));
				});
			});
			//close modal window
			this.modal.on('click', '.close', function(event) {
				event.preventDefault();
				if (!self.animating) self.closeModal(self.eventsGroup.find('.selected-event'));
			});
			this.element.on('click', '.cover-layer', function(event) {
				if (!self.animating && self.element.hasClass('modal-is-open')) self.closeModal(self.eventsGroup.find('.selected-event'));
			});
		};
		SchedulePlan.prototype.NowTimeLine = function(){
			var self = this;
			var eventTop = self.eventSlotHeight * (start - self.timelineStart) / self.timelineUnitDuration;
			$(this).animate({
					top: (eventTop - 1 ) + 'px',
					height: (eventHeight + 1) + 'px'
				},150); 
		}
		// 定义每个盒子高度
		SchedulePlan.prototype.placeEvents = function() {
			var self = this;
			let NowTimeLine = getScheduleTimestamp('<?php  echo $NowTimeLine;?>');
			let TimeLineTop = self.eventSlotHeight * (NowTimeLine - self.timelineStart) / self.timelineUnitDuration;
			let TopInfoHeight = $(".top-info")[0].offsetHeight
			$("#NowTimeLine").animate({
				top: (TimeLineTop + TopInfoHeight + 10 ) + 'px',
			},1000) //滑动时间
			this.singleEvents.each(function() {
				//place each event in the grid -> need to set top position and height
				var start = getScheduleTimestamp($(this).attr('data-start')),
					duration = getScheduleTimestamp($(this).attr('data-end')) - start;
				var eventTop = self.eventSlotHeight * (start - self.timelineStart) / self.timelineUnitDuration,
					eventHeight = self.eventSlotHeight * duration / self.timelineUnitDuration;
				//盒子高度
				$(this).css({
					top: (eventTop - 2 ) + 'px',
					height: (eventHeight + 1) + 'px'
				});
				//获取盒子内event数量，控制event宽度
				let divWidth = $(this)[0].offsetWidth;
				let LiWidth = divWidth / $(this).children().eq(1).length
				$(this).children().eq(1).css({
					height: (eventHeight + 1) + 'px',
					width:LiWidth
				})
				//event hover 事件 悬浮宽度填满，移走恢复
				$(this).children().each(function(){
					let MutiType = $(this).attr("data-MutiType");
					$(this).mouseover(function(e){
						$(this).parent().children().stop();
						$(this).siblings().animate({
							width:0
						},150)
						if(MutiType == 1){
							$(this).children().find("span.event-date").css("display",'block')
						}
						$(this).animate({
							width:divWidth
						},150)
						//var x = 10;
						//var y = -500;
						//$(this).children().eq(0).css({	"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px","opacity": 4,"z-index": 500,"display": "block"}).show("fast");
						$(this).children().eq(2).css("display",'block')
						$(this).children().eq(2).css("opacity",1)
					}).mouseleave(function(){
						$(this).find(".event-date").animate({
							display:'none'
						})
						$(this).parent().children().stop();
						$(this).animate({
							width:LiWidth
						},150)
						$(this).siblings().animate({
							width:LiWidth
						},150)
						if(MutiType == 1){
							$(this).children().find("span.event-date").css("display",'none')
						}
						//$(this).children().eq(0).hide();
						$(this).children().eq(2).css("display",'none')
						$(this).children().eq(2).css("opacity",0)
					})
				});
			});
			this.element.removeClass('loading');
		};
		//弹出框
		SchedulePlan.prototype.openModal = function(event) {
			var self = this;
			var mq = self.mq();
			this.animating = true;
			//update event name and time
			this.modalHeader.find('.event-name').text(event.find('.event-name').text());
			this.modalHeader.find('.event-date').text(event.find('.event-date').text());
			this.modal.attr('data-event', event.parent().attr('data-event'));
			//update event content
			this.modalBody.find('.event-info').load(event.parent().attr('data-content') + '.html .event-info > *', function(data) {
				//once the event content has been loaded
				self.element.addClass('content-loaded');
			});
			this.element.addClass('modal-is-open');
			setTimeout(function() {
				//fixes a flash when an event is selected - desktop version only
				event.parent('li').addClass('selected-event');
			}, 10);
			if (mq == 'mobile') {
				self.modal.one(transitionEnd, function() {
					self.modal.off(transitionEnd);
					self.animating = false;
				});
			} else {
				var eventTop = event.offset().top - $(window).scrollTop(),
					eventLeft = event.offset().left,
					eventHeight = event.innerHeight(),
					eventWidth = event.innerWidth();
				var windowWidth = $(window).width(),
					windowHeight = $(window).height();
				var modalWidth = (windowWidth * .8 > self.modalMaxWidth) ? self.modalMaxWidth : windowWidth * .8,
					modalHeight = (windowHeight * .8 > self.modalMaxHeight) ? self.modalMaxHeight : windowHeight * .8;
				var modalTranslateX = parseInt((windowWidth - modalWidth) / 2 - eventLeft),
					modalTranslateY = parseInt((windowHeight - modalHeight) / 2 - eventTop);
				var HeaderBgScaleY = modalHeight / eventHeight,
					BodyBgScaleX = (modalWidth - eventWidth);
				//change modal height/width and translate it
				self.modal.css({
					top: eventTop + 'px',
					left: eventLeft + 'px',
					height: modalHeight + 'px',
					width: modalWidth + 'px',
				});
				transformElement(self.modal, 'translateY(' + modalTranslateY + 'px) translateX(' + modalTranslateX + 'px)');
				//set modalHeader width
				self.modalHeader.css({
					width: eventWidth + 'px',
				});
				//set modalBody left margin
				self.modalBody.css({
					marginLeft: eventWidth + 'px',
				});
				//change modalBodyBg height/width ans scale it
				self.modalBodyBg.css({
					height: eventHeight + 'px',
					width: '1px',
				});
				transformElement(self.modalBodyBg, 'scaleY(' + HeaderBgScaleY + ') scaleX(' + BodyBgScaleX + ')');
				//change modal modalHeaderBg height/width and scale it
				self.modalHeaderBg.css({
					height: eventHeight + 'px',
					width: eventWidth + 'px',
				});
				transformElement(self.modalHeaderBg, 'scaleY(' + HeaderBgScaleY + ')');
				self.modalHeaderBg.one(transitionEnd, function() {
					//wait for the  end of the modalHeaderBg transformation and show the modal content
					self.modalHeaderBg.off(transitionEnd);
					self.animating = false;
					self.element.addClass('animation-completed');
				});
			}
			//if browser do not support transitions -> no need to wait for the end of it
			if (!transitionsSupported) self.modal.add(self.modalHeaderBg).trigger(transitionEnd);
		};
		SchedulePlan.prototype.closeModal = function(event) {
			var self = this;
			var mq = self.mq();
			this.animating = true;
			if (mq == 'mobile') {
				this.element.removeClass('modal-is-open');
				this.modal.one(transitionEnd, function() {
					self.modal.off(transitionEnd);
					self.animating = false;
					self.element.removeClass('content-loaded');
					event.removeClass('selected-event');
				});
			} else {
				var eventTop = event.offset().top - $(window).scrollTop(),
					eventLeft = event.offset().left,
					eventHeight = event.innerHeight(),
					eventWidth = event.innerWidth();
				var modalTop = Number(self.modal.css('top').replace('px', '')),
					modalLeft = Number(self.modal.css('left').replace('px', ''));
				var modalTranslateX = eventLeft - modalLeft,
					modalTranslateY = eventTop - modalTop;
				self.element.removeClass('animation-completed modal-is-open');
				//change modal width/height and translate it
				this.modal.css({
					width: eventWidth + 'px',
					height: eventHeight + 'px'
				});
				transformElement(self.modal, 'translateX(' + modalTranslateX + 'px) translateY(' + modalTranslateY + 'px)');
				//scale down modalBodyBg element
				transformElement(self.modalBodyBg, 'scaleX(0) scaleY(1)');
				//scale down modalHeaderBg element
				transformElement(self.modalHeaderBg, 'scaleY(1)');
				this.modalHeaderBg.one(transitionEnd, function() {
					//wait for the  end of the modalHeaderBg transformation and reset modal style
					self.modalHeaderBg.off(transitionEnd);
					self.modal.addClass('no-transition');
					setTimeout(function() {
						self.modal.add(self.modalHeader).add(self.modalBody).add(self.modalHeaderBg).add(self.modalBodyBg).attr('style', '');
					}, 10);
					setTimeout(function() {
						self.modal.removeClass('no-transition');
					}, 20);
					self.animating = false;
					self.element.removeClass('content-loaded');
					event.removeClass('selected-event');
				});
			}
			//browser do not support transitions -> no need to wait for the end of it
			if (!transitionsSupported) self.modal.add(self.modalHeaderBg).trigger(transitionEnd);
		}
		SchedulePlan.prototype.mq = function() {
			//get MQ value ('desktop' or 'mobile') 
			var self = this;
			return window.getComputedStyle(this.element.get(0), '::before').getPropertyValue('content').replace(/["']/g, '');
		};
		SchedulePlan.prototype.checkEventModal = function(device) {
			this.animating = true;
			var self = this;
			var mq = this.mq();
			if (mq == 'mobile') {
				//reset modal style on mobile
				self.modal.add(self.modalHeader).add(self.modalHeaderBg).add(self.modalBody).add(self.modalBodyBg).attr('style', '');
				self.modal.removeClass('no-transition');
				self.animating = false;
			} else if (mq == 'desktop' && self.element.hasClass('modal-is-open')) {
				self.modal.addClass('no-transition');
				self.element.addClass('animation-completed');
				var event = self.eventsGroup.find('.selected-event');
				var eventTop = event.offset().top - $(window).scrollTop(),
					eventLeft = event.offset().left,
					eventHeight = event.innerHeight(),
					eventWidth = event.innerWidth();
				var windowWidth = $(window).width(),
					windowHeight = $(window).height();
				var modalWidth = (windowWidth * .8 > self.modalMaxWidth) ? self.modalMaxWidth : windowWidth * .8,
					modalHeight = (windowHeight * .8 > self.modalMaxHeight) ? self.modalMaxHeight : windowHeight * .8;
				var HeaderBgScaleY = modalHeight / eventHeight,
					BodyBgScaleX = (modalWidth - eventWidth);
				setTimeout(function() {
					self.modal.css({
						width: modalWidth + 'px',
						height: modalHeight + 'px',
						top: (windowHeight / 2 - modalHeight / 2) + 'px',
						left: (windowWidth / 2 - modalWidth / 2) + 'px',
					});
					transformElement(self.modal, 'translateY(0) translateX(0)');
					//change modal modalBodyBg height/width
					self.modalBodyBg.css({
						height: modalHeight + 'px',
						width: '1px',
					});
					transformElement(self.modalBodyBg, 'scaleX(' + BodyBgScaleX + ')');
					//set modalHeader width
					self.modalHeader.css({
						width: eventWidth + 'px',
					});
					//set modalBody left margin
					self.modalBody.css({
						marginLeft: eventWidth + 'px',
					});
					//change modal modalHeaderBg height/width and scale it
					self.modalHeaderBg.css({
						height: eventHeight + 'px',
						width: eventWidth + 'px',
					});
					transformElement(self.modalHeaderBg, 'scaleY(' + HeaderBgScaleY + ')');
				}, 10);
				setTimeout(function() {
					self.modal.removeClass('no-transition');
					self.animating = false;
				}, 20);
			}
		};
		var schedules = $('.cd-schedule');
		var objSchedulesPlan = [],
			windowResize = false;
		if (schedules.length > 0) {
			schedules.each(function() {
				//create SchedulePlan objects
				objSchedulesPlan.push(new SchedulePlan($(this)));
			});
		}
		$(window).on('resize', function() {
			if (!windowResize) {
				windowResize = true;
				(!window.requestAnimationFrame) ? setTimeout(checkResize): window.requestAnimationFrame(checkResize);
			}
		});
		$(window).keyup(function(event) {
			if (event.keyCode == 27) {
				objSchedulesPlan.forEach(function(element) {
					element.closeModal(element.eventsGroup.find('.selected-event'));
				});
			}
		});
		function checkResize() {
			objSchedulesPlan.forEach(function(element) {
				element.scheduleReset();
			});
			windowResize = false;
		}
		function getScheduleTimestamp(time) {
		   // 转换日期格式
			time = time.replace(/ /g, '');
			var timeArray = time.split(':');
			var timeStamp = parseInt(timeArray[0]) * 60 + parseInt(timeArray[1]);
			return timeStamp;
		}
		function transformElement(element, value) {
			element.css({
				'-moz-transform': value,
				'-webkit-transform': value,
				'-ms-transform': value,
				'-o-transform': value,
				'transform': value
			});
		}
	});
	</script>
	<?php  } else { ?>
	<div class="ant-empty ant-empty-normal" style="text-align:center;margin-top:3%;display:block">
		<div class="ant-empty-image">
			<img alt="暂无数据" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNDEiIHZpZXdCb3g9IjAgMCA2NCA0MSIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxKSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgIDxlbGxpcHNlIGZpbGw9IiNGNUY1RjUiIGN4PSIzMiIgY3k9IjMzIiByeD0iMzIiIHJ5PSI3Ii8+CiAgICA8ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0Q5RDlEOSI+CiAgICAgIDxwYXRoIGQ9Ik01NSAxMi43Nkw0NC44NTQgMS4yNThDNDQuMzY3LjQ3NCA0My42NTYgMCA0Mi45MDcgMEgyMS4wOTNjLS43NDkgMC0xLjQ2LjQ3NC0xLjk0NyAxLjI1N0w5IDEyLjc2MVYyMmg0NnYtOS4yNHoiLz4KICAgICAgPHBhdGggZD0iTTQxLjYxMyAxNS45MzFjMC0xLjYwNS45OTQtMi45MyAyLjIyNy0yLjkzMUg1NXYxOC4xMzdDNTUgMzMuMjYgNTMuNjggMzUgNTIuMDUgMzVoLTQwLjFDMTAuMzIgMzUgOSAzMy4yNTkgOSAzMS4xMzdWMTNoMTEuMTZjMS4yMzMgMCAyLjIyNyAxLjMyMyAyLjIyNyAyLjkyOHYuMDIyYzAgMS42MDUgMS4wMDUgMi45MDEgMi4yMzcgMi45MDFoMTQuNzUyYzEuMjMyIDAgMi4yMzctMS4zMDggMi4yMzctMi45MTN2LS4wMDd6IiBmaWxsPSIjRkFGQUZBIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K"/>
		</div>
		<p class="ant-empty-description">没有排课记录</p>
	</div>
	<?php  } ?>
<?php  } ?>