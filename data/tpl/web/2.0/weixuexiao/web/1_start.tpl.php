<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<!-- <script src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/js/jquery.easypiechart.js"></script> -->
<?php  if($operation == 'display') { ?>
<style>
.pull-left{margin-right: 10% !important; width: 66px;height: 66px;text-align: center;line-height: 65px;}
.icon-rounded {color: #ffffff;border-radius: 50px; -webkit-border-radius: 50px; -moz-border-radius: 50px; -o-border-radius: 50px;-ms-border-radius: 50px;font-size: 25px;}
.text-succ{
	color:#11c8cb;
}
.text-dang{
	color:#f45021;
}
.text-infoo{
	color:#fb8327;
}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('mobile/face', TEMPLATE_INCLUDEPATH)) : (include template('mobile/face', TEMPLATE_INCLUDEPATH));?>
<style>
.modal-body {width: 50%;float: left;  border-bottom: 1px solid #F1F3F5;border-right: 1px solid #F1F3F5;}
.form=group { position: relative;padding: 0}.form-group img{width:129px;width:129px;} .form-group .mask .wi-right:before {content: "\e6c1";}
.form-group .mask{position: absolute;font-family: we7icon!important;top: 29px;left: 28%;width: 129px;height: 129px;border-radius: 50%;background: rgba(0,0,0,.5);color: #fff;
line-height: 129px;text-align: center;display: none;}
 </style>
<div class="modal fade" style="min-width: 583px!important;" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"></div>
<input type="hidden" id="nowms" value="">
<input type="hidden" id="changemsurl" value="<?php  echo $rlsrll;?>">
<div class="clearfix">
	<div class="row">
		<?php  if($schooltype) { ?>
		<div class="col-sm-3" style="width: 20%;">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>排课数</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-language icon-rounded" style="background-color: #9358ac;"></i>
					<h1 class="no-margins" id="todayKc"><?php  echo $todayKc;?>节</h1>
					<div class="stat-percent font-bold text-success"><?php  if($todayKc !=0 & $allKc !=0) { ?><?php  echo sprintf('%.2f', ($todayKc/$allKc)*100);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占总排课</small>
				</div>
			</div>
		</div>
		 <div class="col-sm-3" style="width: 20%;">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>签到人数</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-check icon-rounded" style="background-color: #1eb11e;"></i>
					<h1 class="no-margins" id="todaySign"><?php  echo $todaySign;?>人</h1>
					<div class="stat-percent font-bold text-success"><?php  if($todaySign !=0 & $allSign !=0) { ?><?php  echo sprintf('%.2f',( $todaySign/$allSign)*100);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占总签到</small>
				</div>
			</div>
		</div>
		<div class="col-sm-3" style="width: 20%;">
			<div class="ibox float-e-margins">
			   <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>购买课程人数</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-users icon-rounded" style="background-color:#0ebdab;"></i>
					<h1 class="no-margins" id="todayBuy"><?php  echo $todayBuy;?>人</h1>
					<div class="stat-percent font-bold text-info"><?php  if($todayBuy !=0 & $allBuy !=0) { ?><?php  echo sprintf('%.2f', ($todayBuy/$allBuy)*100);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占购买课程</small>
				</div>
			</div>
		</div>
		<div class="col-sm-3" style="width: 20%;">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>新增学生</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-user icon-rounded" style="background-color:#ef553a;"></i>
					<h1 class="no-margins" id="todayStu"><?php  echo $todayStu;?>人</h1>
					<div class="stat-percent font-bold text-navy"><?php  if($todayStu !=0 & $allstu_lee !=0) { ?><?php  echo sprintf('%.2f', ($todayStu/$allstu_lee)*100);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占总人数</small>
				</div>
			</div>
		</div>
	   <?php  if($logo['is_cost'] == 1 || $_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
		<div class="col-sm-3" style="width: 20%;">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>总收入额</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-rmb icon-rounded" style="background-color:#00aced;"></i>
					<h1 class="no-margins"><?php  if(!empty($cose)) { ?><?php  echo $cose;?><?php  } else { ?>0<?php  } ?>元</h1>
					<div class="stat-percent font-bold text-danger"><?php  if(!empty($cose)) { ?><?php  echo sprintf('%.2f', $cose/$ddzj);?>%<?php  } else { ?>0.00%<?php  } ?><i class="fa fa-bolt"></i>
					</div>
					<small>占总收入</small>
				</div>
			</div>
		</div>
		<?php  } ?>	
		<?php  } else { ?>
		<div class="col-sm-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>报名数</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-users icon-rounded" style="background-color: #9358ac;"></i>
					<h1 class="no-margins" id="baom"><?php  echo $baom;?>人</h1>
					<div class="stat-percent font-bold text-success"><?php  if($baom !=0 & $bm !=0) { ?><?php  echo sprintf('%.2f', $baom/$bm);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占总报名</small>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="ibox float-e-margins">
			   <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>班级圈消息</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-weixin icon-rounded" style="background-color:#1eb11e;"></i>
					<h1 class="no-margins" id="bjqz"><?php  echo $bjqz;?>条</h1>
					<div class="stat-percent font-bold text-info"><?php  if($bjqz !=0 & $bjq !=0) { ?><?php  echo sprintf('%.2f', $bjqz/$bjq);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占总消息</small>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>考勤总计</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-thumbs-up icon-rounded" style="background-color:#ef553a;"></i>
					<h1 class="no-margins" id="checklog"><?php  echo $checklog;?>次</h1>
					<div class="stat-percent font-bold text-navy"><?php  if($checklog !=0 & $kq !=0) { ?><?php  echo sprintf('%.2f', $checklog/$kq);?><?php  } else { ?>0.00<?php  } ?>%<i class="fa fa-bolt"></i>
					</div>
					<small>占总考勤</small>
				</div>
			</div>
		</div>
		<?php  if($logo['is_cost'] == 1 || $_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
		<div class="col-sm-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<span class="label label-primary pull-right">今天</span>
					<h5>总收入额</h5>
				</div>
				<div class="ibox-content">
					<i class="pull-left fa fa-rmb icon-rounded" style="background-color:#00aced;"></i>
					<h1 class="no-margins"><?php  if(!empty($cose)) { ?><?php  echo $cose;?><?php  } else { ?>0<?php  } ?>元</h1>
					<div class="stat-percent font-bold text-danger"><?php  if(!empty($cose)) { ?><?php  echo sprintf('%.2f', $cose/$ddzj);?>%<?php  } else { ?>0.00%<?php  } ?><i class="fa fa-bolt"></i>
					</div>
					<small>占总收入</small>
				</div>
			</div>
		</div>
		<?php  } ?>
		<?php  } ?>
	</div>	
<style>
.span_8 {text-align: center;padding-left: 15px;}
@media (min-width: 992px)
.col-md-4 {width: 33.33333333%;}		
.activity_box {background: #fff;min-height: 392px;box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);}
.scrollbar {height: 392px;background: #fff;overflow-y: scroll;padding: 2em 1em;}
.activity-row {margin-bottom: 2em;}
.activity-row, .activity-row1 {text-align: left;}
.graphs {padding: 2em 1em;background: #f2f4f8;font-family: 'Roboto', sans-serif;}
.col-md-4{position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
</style>
<script src="<?php echo OSSURL;?>public/mobile/js/faceMap.js?v=5.61" type="text/javascript"></script>
<div class="row" style="margin-bottom: 15px;">
	<div class="col-md-4 span_8">
		<div class="activity_box">
			<div class="panel-heading">
                    <h4 class="panel-title">班级圈消息</h4>
            </div>
			<div class="scrollbar" id="style-2">
			<?php  if(is_array($lastbjq)) { foreach($lastbjq as $item) { ?>
				<div class="activity-row">
					<div class="col-xs-1"><i class="fa fa-comment text-info"></i> </div>
					<div class="col-xs-3 activity-img" style="width:auto;"><img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['avatar'])?>" class="img-responsive" alt=""></div>
					<div class="col-xs-8 activity-desc">
						<h5>
							<a href="#"><?php  echo $item['shername'];?></a>&nbsp;&nbsp;<?php  echo $item['bjname'];?><a href="#"><?php  if($item['isopen'] == 1) { ?>*未审核*<?php  } ?></a>
							<?php  if($item['msgtype'] == 1) { ?><span class="label label-success pull-right">图文</span><?php  } ?>
							<?php  if($item['msgtype'] == 2) { ?><span class="label label-warning pull-right">语音</span><?php  } ?>
							<?php  if($item['msgtype'] == 3) { ?><span class="label label-danger pull-right">视频</span><?php  } ?>	
							<?php  if($item['msgtype'] == 4) { ?><span class="label label-info pull-right">分享</span><?php  } ?>	
							<?php  if($item['msgtype'] == 5) { ?><span class="label label-primary pull-right">多媒体</span><?php  } ?>		
						</h5>
						<p class="neirong"><?php  echo $item['content'];?></p>
						<h6><?php  echo $item['time'];?>前</h6>
					</div>
					<div class="clearfix"></div>
				</div>
			<?php  } } ?>	
			<a href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'display', 'schoolid' => $schoolid))?>">点击查看更多</a>
			</div>
		</div>
	</div>
	<div class="col-md-4 span_8">
		<div class="activity_box">
			<div class="panel-heading">
                    <h4 class="panel-title">校园动态</h4>
            </div>		
			<div class="scrollbar" id="style-2">
			<?php  if(is_array($lasttz)) { foreach($lasttz as $item) { ?>
				<div class="activity-row1">
					 <div class="col-xs-1"><?php  if($item['ismobile'] == 1) { ?><i class="fa fa-desktop text-info icon_12"><?php  } else { ?><i class="fa fa-weixin text-info icon_12"><?php  } ?></i></div>
					 <div class="col-xs-3 activity-img" style="width:auto;"><img style="width:50px;height:50px;border-radius:50%;" src="<?php  if($item['thumb']) { ?><?php  echo tomedia($item['thumb'])?><?php  } else { ?><?php  echo tomedia($logo['tpic'])?><?php  } ?>" class="img-responsive" alt="">
					 </div>
					 <div class="col-xs-8 activity-desc">
						<h5>
							<a href="#"><?php  echo $item['tname'];?></a> <a href="#"><?php  echo $item['bjname'];?></a>
							<?php  if($item['type'] == 2) { ?><span class="label label-danger pull-right">校园通知</span><?php  } ?>
							<?php  if($item['type'] == 1) { ?><span class="label label-info pull-right">班级通知</span><?php  } ?>
							<?php  if($item['type'] == 3) { ?><span class="label label-primary pull-right">作业通知</span><?php  } ?>
						</h5>
						<p><?php  echo $item['title'];?></p>
						<h6><?php  echo $item['time'];?>前</h6>
					 </div>
					 <div class="clearfix"> </div>
				 </div>
			<?php  } } ?>	
			<a href="<?php  echo $this->createWebUrl('notice', array('op' => 'display', 'schoolid' => $schoolid))?>">点击查看更多</a>
			</div>
		</div>
	</div>
	<?php  if($schooltype) { ?>
	<div class="col-md-4 span_8">
		<div class="activity_box">
			<div class="panel-heading">
                    <h4 class="panel-title">消课记录</h4>
            </div>		
			<div class="scrollbar" id="style-2">
			<?php  if(is_array($lastxk)) { foreach($lastxk as $item) { ?>
				<div class="activity-row1">
					 <div class="col-xs-1"> <i class="fa fa-comment text-info"></i></div>
					 <div class="col-xs-3 activity-img" style="width:auto;">
					 <img style="width:50px;height:50px;border-radius:50%;" src="<?php  if($item['sicon']) { ?><?php  echo tomedia($item['sicon'])?><?php  } else { ?><?php  echo tomedia($logo['spic'])?><?php  } ?>" class="img-responsive" alt="">
					 </div>
					 <div class="col-xs-8 activity-desc">
						<h5>
							<a href="#"><span class="label label-success">学生</span><?php  echo $item['s_name'];?></a> 
							<span class="label label-info"><?php  echo $item['kcname'];?></span> 
						</h5>
						 
						<h6><?php  echo $item['time'];?>前</h6>
					 </div>
					 <div class="clearfix"> </div>
				 </div>
			<?php  } } ?>
			<a href="<?php  echo $this->createWebUrl('checklog', array('op' => 'display', 'schoolid' => $schoolid))?>">点击查看更多</a>
			</div>
		</div>
	</div>
	<?php  } else { ?>
	<div class="col-md-4 span_8">
		<div class="activity_box">
			<div class="panel-heading">
                    <h4 class="panel-title">考勤记录</h4>
            </div>		
			<div class="scrollbar" id="style-2">
			<?php  if(is_array($lastkq)) { foreach($lastkq as $item) { ?>
				<div class="activity-row1">
					 <div class="col-xs-1"><?php  if($item['checktype'] == 1) { ?><i class="fa fa-credit-card text-info icon_12"><?php  } else { ?><i class="fa fa-weixin text-info icon_12"><?php  } ?></i></div>
					 <div class="col-xs-3 activity-img" style="width:auto;">
					 <img style="width:50px;height:50px;border-radius:50%;" src="<?php  if(!empty($item['sid'])) { ?><?php  if($item['sicon']) { ?><?php  echo tomedia($item['sicon'])?><?php  } else { ?><?php  echo tomedia($logo['spic'])?><?php  } ?>
					 <?php  } else { ?><?php  if($item['thumb']) { ?><?php  echo tomedia($item['thumb'])?><?php  } else { ?><?php  echo tomedia($logo['tpic'])?><?php  } ?><?php  } ?>" class="img-responsive" alt="">
					 </div>
					 <div class="col-xs-8 activity-desc">
						<h5>
							<a href="#"><?php  if(!empty($item['sid'])) { ?><span class="label label-success">学生</span><?php  echo $item['s_name'];?><?php  } else { ?><span class="label label-info">老师</span><?php  echo $item['tname'];?><?php  } ?></a> <a href="#"><?php  echo $item['bj_name'];?></a>
							<?php  if($item['type'] =='进校') { ?><span class="label label-success"><?php  echo $item['type'];?></span><?php  } else { ?><span class="label label-info"><?php  echo $item['type'];?></span><?php  } ?>
							<?php  if($item['isconfirm'] == 2) { ?><span class="label label-danger">待老师确认</span><?php  } ?>
						</h5>
						<p><?php  echo $item['title'];?></p>
						<h6><?php  echo $item['time'];?>前</h6>
					 </div>
					 <div class="clearfix"> </div>
				 </div>
			<?php  } } ?>
			<a href="<?php  echo $this->createWebUrl('checklog', array('op' => 'display', 'schoolid' => $schoolid))?>">点击查看更多</a>
			</div>
		</div>
	</div>	
	<?php  } ?>
</div>	

	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
					<h4>
						<span><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime);?>至<?php  echo date('Y-m-d', $endtime)?><?php  } ?>数据统计 </span>
					</h4>
					<div class="ibox-content" style="padding-bottom:0px!important;">
						<form action="./index.php" method="get" class="form-horizontal" role="form" id="list">
							<input type="hidden" name="c" value="site">
							<input type="hidden" name="a" value="entry">
							<input type="hidden" name="m" value="weixuexiao">
							<input type="hidden" name="do" value="start"/>
							<input type="hidden" name="op" value="display"/>
							<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>"/>
							<div class="form-group clearfix">
								<label class="col-xs-12 col-sm-2 col-md-1 control-label">时间范围</label>
								<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
									<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
									<input class="btn btn-sm btn-info" name="commit" type="submit" value="查询">
								</div>	
							</div>
						</form>
					</div>					
				</div>
				<div class="account-stat" style="background-color: #ffffff;border-color: #e7eaec;border-style: solid solid none;border-width: 1px 0px;">
					<div class="account-stat-btn">
						<?php  if($logo['is_cost'] == 1 || $_W['isfounder'] || $_W['role'] == 'vice_founder') { ?><div class="col-12" style="width:8%">已付总额<span style="font-size: 24px;color: #FF8000;" id="cose1"><?php  echo $cose1;?></span></div><?php  } ?>
						<div class="col-12" style="width:8%">报名数<span style="font-size: 24px;color: #FF8000;" id="baomzj"><?php  echo $baomzj;?>人</span></div>
						<?php  if(!$_W['schooltype']) { ?>
						<div class="col-12" style="width:8%">考勤数<span style="font-size: 24px;color: #FF8000;" id="checklogzj"><?php  echo $checklogzj;?>次</span></div>
						<?php  } else { ?>
						<div class="col-12" style="width:8%">消课数<span style="font-size: 24px;color: #FF8000;" id="checklogzj"><?php  echo $checklogzj;?>次</span></div>
						<?php  } ?>
						<div class="col-12" style="width:8%">班级圈<span style="font-size: 24px;color: #FF8000;" id="bjqzj"><?php  echo $bjqzj;?>条</span></div>	
						<div class="col-12" style="width:8%">照片数<span style="font-size: 24px;color: #FF8000;" id="xczj"><?php  echo $xczj;?>张</span></div>
						<div class="col-12" style="width:8%">已绑教师<span style="font-size: 24px;color: #FF8000;" id="ybjs"><?php  echo $ybjs;?>人</span></div>
						<div class="col-12" style="width:8%">已绑学生及家长<span style="font-size: 24px;color: #FF8000;" id="ybxs"><?php  echo $ybxs;?>人</span></div>
						<div class="col-12" style="width:8%">教师人数<span style="font-size: 24px;color: #FF8000;" id="jszj"><?php  echo $jszj;?>人</span></div>
						<div class="col-12" style="width:8%">未过期学生人数<span style="font-size: 24px;color: #FF8000;" id="xszj"><?php  echo $xszj;?>人</span></div>
						<div class="col-12" style="width:8%">已过期学生人数<span style="font-size: 24px;color: #FF8000;" id="xszjGuoqi"><?php  echo $xszjGuoqi;?>人</span></div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<?php  if(GetSchoolType($schoolid,$weid)) { ?>
			<div class="panel panel-default">
				<div class="chart-title  ng-binding" style="padding: 4px 10px;"><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d', $endtime)?><?php  } else { ?>今日<?php  } ?>各课程情况
					<div class="fr classNameColor" style="float: right;">
						<div class="col-sm-2 col-lg-2">
							<select style="width: 147px;" id="ctype_id" class="form-control">
							<?php  if(is_array($njchecklog)) { foreach($njchecklog as $row) { ?>
								<option value="<?php  echo $row['sid'];?>"><?php  echo $row['sname'];?></option>
							<?php  } } ?>	
							</select>
						</div>
						<div class="col-sm-2 col-lg-2" style="float:left;left:120px">
							<select style="width: 147px;" id="kc_id" class="form-control">
							
								<option value="0">请选择课程</option>
							
							</select>
						</div>
					</div>
				</div>
				<div class="panel-body text-center" style="padding: 1px;min-height: 357px;">
					<div class="echarts" id="echarts-pie-chart-c"></div>
				</div>
			</div>
		<?php  } else { ?>
			<div class="panel panel-default">
				<div class="chart-title  ng-binding" style="padding: 4px 10px;"><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d', $endtime)?><?php  } else { ?>今日<?php  } ?>各班考勤情况
					<div class="fr classNameColor" style="float: right;">
						<div class="col-sm-2 col-lg-2">
							<select style="width: 147px;" id="xq_id" class="form-control">
							<?php  if(is_array($njchecklog)) { foreach($njchecklog as $row) { ?>
								<option value="<?php  echo $row['sid'];?>"><?php  echo $row['sname'];?></option>
							<?php  } } ?>	
							</select>
						</div>
					</div>
				</div>
				<div class="panel-body text-center" style="padding: 1px;min-height: 357px;">
					<div class="echarts" id="echarts-pie-chart-c"></div>
				</div>
			</div>
		<?php  } ?>
		</div>
		<?php  if(GetSchoolType($schoolid,$weid)) { ?>
		<div class="col-md-6">
			<div class="panel panel-default" style="position: relative;">
				<div class="chart-title ng-binding" style="padding: 4px 10px;"><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d', $endtime)?><?php  } else { ?>今日<?php  } ?>各课程类型签到情况</div>
				<div style="min-height: 357px;">
					<!-- ngIf: charts.gradeAttendance.loading -->
					<div class="slimScrollDiv" style="position: relative; width: auto; height: 338px;">
						<div style="overflow-y: scroll;width: auto; height: 335px;">
							<table class="table table-hover table-condensed table-layout-fixed   mb5 clear_bold">
								<thead>
									<tr>
										<th>类别</th>
										<th>课时总数</th>
										<th>应签人次</th>
										<th>已签人次</th>
										<th>请假人次</th>
										<th>缺签人次</th>
										<th>已签率</th>
										<th>请假率</th>
										<th>缺签率</th>
									</tr>
								</thead>
								<tbody>
									<?php  if(is_array($njchecklog)) { foreach($njchecklog as $row) { ?>
									<tr ng-repeat="post in charts.gradeAttendance.chartData" class="ng-scope">
										<td>
											<div class="text-ellipsis ng-binding"><?php  echo $row['sname'];?></div>
										</td>
										<td class="ng-binding"><?php  echo $row['ksnum'];?></td>
										<td class="ng-binding"><?php  echo $row['NeedSignNum'];?></td>
										<td class="ng-binding"><?php  echo $row['DoSignNum'];?></td>
										<td class="ng-binding"><?php  echo $row['QingJiaNum'];?></td>
										<td class="ng-binding"><?php  echo $row['NotSignNum'];?></td>
									
										<td>
											<div class="text-succ"><?php  if($row['NeedSignNum'] !=0) { ?><?php  echo round($row['DoSignNum']/$row['NeedSignNum']*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<td>
											<div class="text-dang"><?php  if($row['NeedSignNum'] !=0) { ?><?php  echo round($row['QingJiaNum']/$row['NeedSignNum']*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<td>
											<div class="text-dang"><?php  if($row['NeedSignNum'] !=0) { ?><?php  echo round($row['NotSignNum']/($row['NeedSignNum'])*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										
									</tr>
									<?php  } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php  } else { ?>
		<div class="col-md-6">
			<div class="panel panel-default" style="position: relative;">
				<div class="chart-title ng-binding" style="padding: 4px 10px;"><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d', $endtime)?><?php  } else { ?>今日<?php  } ?>各年级出勤情况</div>
				<div style="min-height: 357px;">
					<!-- ngIf: charts.gradeAttendance.loading -->
					<div class="slimScrollDiv" style="position: relative; width: auto; height: 338px;">
						<div style="overflow-y: scroll;width: auto; height: 335px;">
							<table class="table table-hover table-condensed table-layout-fixed   mb5 clear_bold">
								<thead>
									<tr>
										<th>类别</th>
										<th>年级人数</th>
										<?php  if(!empty($_GPC['addtime'])) { ?><th>出勤人次</th><?php  } else { ?><th>出勤人数</th><?php  } ?>
										<?php  if(!empty($_GPC['addtime'])) { ?><th>请假人次</th><?php  } else { ?><th>请假人数</th><?php  } ?>
										<?php  if(!empty($_GPC['addtime'])) { ?><th>缺勤人次</th><?php  } else { ?><th>缺勤人数</th><?php  } ?>
										<th>出勤率</th>
										<th>请假率</th>
										<th>缺勤率</th>
									</tr>
								</thead>
								<tbody>
									<?php  if(is_array($njchecklog)) { foreach($njchecklog as $row) { ?>
									<tr ng-repeat="post in charts.gradeAttendance.chartData" class="ng-scope">
										<td>
											<div class="text-ellipsis ng-binding"><?php  echo $row['sname'];?></div>
										</td>
										<td class="ng-binding"><?php  echo $row['njzrs'];?></td>
										<td class="ng-binding"><?php  echo $row['njcqzs'];?></td>
										<td class="ng-binding"><?php  echo $row['njqjrs'];?></td>
										<td class="ng-binding"><?php  echo $row['qqzrs'];?></td>
										<?php  if(!empty($_GPC['addtime'])) { ?>
										<td>
											<div class="text-succ"><?php  if($row['njzrs'] !=0) { ?><?php  echo round($row['njcqzs']/($row['njzrs']*$day_num)*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<td>
											<div class="text-dang"><?php  if($row['njzrs'] !=0) { ?><?php  echo round($row['njqjrs']/$row['njzrs']*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<td>
											<div class="text-dang"><?php  if($row['njzrs'] !=0) { ?><?php  echo round($row['qqzrs']/($row['njzrs']*$day_num)*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<?php  } else { ?>
										<td>
											<div class="text-succ"><?php  if($row['njzrs'] !=0) { ?><?php  echo round($row['njcqzs']/$row['njzrs']*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<td>
											<div class="text-dang"><?php  if($row['njzrs'] !=0) { ?><?php  echo round($row['njqjrs']/$row['njzrs']*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<td>
											<div class="text-dang"><?php  if($row['njzrs'] !=0) { ?><?php  echo round($row['qqzrs']/($row['njzrs'])*100,2);?><?php  } else { ?>0.00<?php  } ?>%</div>
										</td>
										<?php  } ?>
									</tr>
									<?php  } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php  } ?>
	</div>
	<div class="clearfix">
		<div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                        <h5><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d', $endtime)?><?php  } ?>交互功能使用率</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="echarts" id="echarts-pie-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                        <h5><?php  if(!empty($_GPC['addtime'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d', $endtime)?><?php  } ?>支付方式比例图</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="echarts" id="echarts-pie-chart-a"></div>
                    </div>
                </div>
            </div>
      </div>
	</div>
	<?php  if($logo['is_cost'] == 1 || $_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
	<form class="form-horizontal" action="" method="post" onkeydown="if(event.keyCode == 13) return false;">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered table-text-center">
						<thead class="navbar-inner">
							<tr>
								<th width="300">时间</th>
								<th>营业额</th>
								<th>订单数</th>
								<th>在线支付</th>
								<th>现金支付</th>
								<th>查看详情</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($return)) { foreach($return as $k => $dca) { ?>
							<tr>
								<th><?php  echo $k;?></th>
								<td><?php  echo sprintf('%.2f', $dca['cose']);?> 元</td>
								<td><?php  echo intval($dca['count']);?> 单</td>
								<td><?php  echo sprintf('%.2f', $dca['1']);?> 元</td>
								<td><?php  echo sprintf('%.2f', $dca['2']);?> 元</td>
								<td>
									<a href="<?php  echo $this->createWebUrl('payall', array('op' => 'display', 'schoolid' => $schoolid));?>" class="btn btn-success" target="_blank">详情</a>
								</td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
	<?php  } ?>
</div>
<script src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/js/jquery.flot.js?v=2.1.4"></script>
<script src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/js/echarts-all.js?v=2.1.4"></script>	
<script type="text/javascript">
<?php  if($schooltypes) { ?>loadmoal();<?php  } ?>
function loadmoal(){
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'checkverstypeforhtml','schoolid'=>$schoolid))?>",function(data){
		if(data.result){
			$("#Modal1").html(data.log);
		}else{
			//alert(data.msg);
		}
	},'json');
}
<?php  if($nowdatatype) { ?>
	$('#Modal1').modal('toggle');
<?php  } ?>
function glms(){
	$("#glmsmask").show();
	$("#pxmsmask").hide();
	$("#nowms").val(2);
}
function pxms(){
	$("#pxmsmask").show();
	$("#glmsmask").hide();
	$("#nowms").val(1)
}
function showmsmodel(){
	$('#Modal1').modal('toggle');
	$('#canlbtn').show();
}
function tijiao(){
	var nowms = $("#nowms").val();
	if(!nowms || nowms == null || nowms == ''){
		alert('请选择本校模式,温馨提示:幼儿园或早教机构请选择公立模式');
	}else{
		$.post($("#changemsurl").val(),{nowms: nowms,wxnam:"<?php  echo $_W['uniaccount']['name'];?>",site:"<?php  echo $_W['siteroot'];?>",weid:"<?php  echo $weid;?>"},function(data){
			if(data.result){
				//alert(data.msg);
			}else{
				//alert(data.msg);
			}
			location.reload();
		},'json');
	}
}
icon_replace($(".neirong"));
function icon_replace(content_box) {
    var face_map_url = "<?php echo OSSURL;?>public/mobile/img/face/";
    $(content_box).each(function () {
        //替换表情
        if (typeof ($(this).html()) != 'undefined') {
            var desc = $(this).html().replace(/\[([^\]]+)\]/g, function (a, b) {
                return "<img class='face_icon' style='width: 20px;' src='" + face_map_url + objMap[b] + ".gif'>";
            });
            $(this).html(desc);
        }
    })
}
<?php  if($schooltype) { ?>
	move('todayStu','<?php  echo $todayStu;?>','人');
	move('todayBuy','<?php  echo $todayBuy;?>','人');
	move('todaySign','<?php  echo $todaySign;?>','人');
	move('todayKc','<?php  echo $todayKc;?>','节');
<?php  } else { ?>
	move('baom','<?php  echo $baom;?>','人');
	move('bjqz','<?php  echo $bjqz;?>','条');
	move('checklog','<?php  echo $checklog;?>','次');
<?php  } ?>
<?php  if($logo['is_cost'] == 1 || $_W['isfounder'] || $_W['role'] == 'owner' || $_W['role'] == 'vice_founder') { ?>
move('cose1','<?php  echo $cose1;?>','元');
<?php  } ?>
move('baomzj','<?php  echo $baomzj;?>','人');
move('checklogzj','<?php  echo $checklogzj;?>','次');
move('bjqzj','<?php  echo $bjqzj;?>','条');
move('xczj','<?php  echo $xczj;?>','张');
move('ybjs','<?php  echo $ybjs;?>','人');
move('ybxs','<?php  echo $ybxs;?>','人');
move('jszj','<?php  echo $jszj;?>','人');
move('xszj','<?php  echo $xszj;?>','人');
move('xszjGuoqi','<?php  echo $xszjGuoqi;?>','人');
function move(div,nub,dw){
var oSpan=document.getElementById(div);
var d=nub;//跳动到最后的数字
var s= parseInt(oSpan.innerHTML);//起始起始值 一般是 0 或其他
var time=1000;  //所用时间 1000毫秒（ 在1秒内 数值增加到d）;
var outTime=0;  //所消耗的时间
var interTime=30;
var timer = setInterval(function(){
    outTime+=interTime;
    if(outTime < time){
        oSpan.innerHTML= parseInt(d/time*outTime)+dw;
    }else{
        oSpan.innerHTML=d+dw;
    }
    },interTime);
}
$(function () {
	var templates = {
		c: {
			title: {
				text: '',
				subtext: ''
			},
			series: [{
				name: '各种支付方式收入下单比例',
				data: []
			}]
		},
		b: {
			title: {
				text: '交互功能使用率',
				subtext: '单位：次'
			},
			series: [{
				name: '交互功能使用率',
				data: []
			}]
		},
		a: {
			title: {
				text: '各种支付方式收入比例',
				subtext: '单位：笔'
			},
			series: [{
				name: '各种支付方式收入下单比例',
				data: []
			}]
		}
	};
	//第一
   // var pieChart = echarts.init(document.getElementById("echarts-pie-chart"));
    var pieoption = {
        title : {
            text: '',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} 次 ({d}%)"
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['班级圈','在线报名','通知公告','打卡考勤','在线留言','相册','在线请假']
        },
        calculable : true,
        series : [
            {
                name:'交互功能',
                type:'pie',
                radius : '60%',
                center: ['50%', '60%'],
                data:[]
            }
        ]
    };
   	// pieChart.setOption(pieoption);
   	// $(window).resize(pieChart.resize);
	var GetChartData = function(type) {
		$('#echarts-pie-chart').html('');
		var schoolid = "<?php  echo $schoolid;?>";
		var url = "<?php  echo $this->createWebUrl('start');?>&op=" + type + "&schoolid=" + schoolid;
		var params = {
			'start': $('#list input[name="addtime[start]"]').val(),
			'end': $('#list input[name="addtime[end]"]').val(),
			'addtime' : '<?php  echo $_GPC['addtime'];?>'
		};
		$.post(url, params, function(data){
			var data = $.parseJSON(data);
			var ds = $.extend(true, {}, pieoption, templates[type]);
			ds.series[0].data = data.message.message;
			var pieChart = echarts.init($('#echarts-pie-chart')[0]);
			pieChart.setOption(ds);
			$(window).resize(pieChart.resize);
		});
	}
	GetChartData('b');
	//第二
	//var pieChart_a = echarts.init(document.getElementById("echarts-pie-chart-a"));	
    var pieoption_a = {
		title : {
			text: '',
			x:'center'
		},
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} 笔 ({d}%)"
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['银联支付','支付宝支付','百付宝支付','微信支付','现金支付','余额支付']
        },
        calculable : true,
        series : [
            {
                name:'支付方式',
                type:'pie',
                radius : '60%',
                center: ['50%', '60%'],
                data:[]
            }
        ]
    };
   	// pieChart_a.setOption(pieoption_a);
   	// $(window).resize(pieChart_a.resize);
	var GetChartData = function(type) {
		$('#echarts-pie-chart-a').html('');
		var schoolid = "<?php  echo $schoolid;?>";
		var url = "<?php  echo $this->createWebUrl('start');?>&op=" + type + "&schoolid=" + schoolid;
		var params = {
			'start': $('#list input[name="addtime[start]"]').val(),
			'end': $('#list input[name="addtime[end]"]').val()
		};
		$.post(url, params, function(data){
			var data = $.parseJSON(data);
			var ds = $.extend(true, {}, pieoption_a, templates[type]);
			ds.series[0].data = data.message.message;
			var myChart = echarts.init($('#echarts-pie-chart-a')[0]);
			myChart.setOption(ds);
			$(window).resize(myChart.resize);
		});
	}
	GetChartData('a');
});

$(document).ready(function() {
	<?php  if(GetSchoolType($schoolid,$weid)) { ?>
		$("#ctype_id").change(function() {
			changeKecheng();
			
		});
		$("#kc_id").change(function() {
			var kc_id = $("#kc_id option:selected").attr('value');
			var type = 1;
			addbarKc(kc_id, type, function() {
			});
		});
		changeKecheng();
	<?php  } else { ?>
		$("#xq_id").change(function() {
			var njid = $("#xq_id option:selected").attr('value');
			var type = 1;
			addbar(njid, type, function() {
			});
		});
	<?php  } ?>	
	
});

function changeKecheng() {
	//alert(cityId);
	var schoolid = "<?php  echo $schoolid;?>";
	var classlevel = [];
	//获取班次
	var ctypeId = $('#ctype_id').val();
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getkclist'))?>", {'ctypeId': ctypeId, 'schoolid': schoolid}, function(data) {
	
		data = JSON.parse(data);
		classlevel = data.kclist;
		
		var htmls = '';
		if (classlevel != '') {
			for (var i in classlevel) {
				htmls += '<option value="' + classlevel[i].id + '">' + classlevel[i].name + '</option>';
			}
		}
		$('#kc_id').html(htmls);	
			addbarKc();		
	});
}

//按照课程进行统计
function addbarKc(njid) {
	//第三
		var templates = {
		c: {
		 
		}
	};
    var pieoption_c = {
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.series.name+"</br>"+c.value+"节";}else if(c.series.typess==6){return c.series.name+"</br>"+c.value+"元";}else{return c.series.name+"</br>"+c.value+"人次";}}
		},
		legend: {
			data:['课时安排/节','签到人次','请假人次','缺勤人次','新增报名人数','新增收入/元']
		},

        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : []
			},
			{
				type : 'category',
				axisLine: {show:false},
				axisTick: {show:false},
				axisLabel: {show:false},
				splitArea: {show:false},
				splitLine: {show:false},
				data : []
			}
		],
		yAxis: [{
			type: 'value',
			scale: true,
			name: '单位:课时（人次）',
			min: 0,
			},{
			type: 'value',
			scale: true,
			name: '单位:元',
			}],
		series : [
			{
				name:'课时安排/节',
				type:'bar',
				typess:1,
				itemStyle: {normal: {color:'rgba(65, 202, 192)', label:{show:true,formatter:function(c){return "课时安排:\n"+c.value+"节";}}}},
				data:[]
			},
			{
				name:'签到人次',
				type:'bar',
				typess:2,
				itemStyle: {normal: {color:'rgba(75, 207, 202)', label:{show:true,formatter:function(c){return "签到:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'请假人次',
				type:'bar',
				typess:3,
				itemStyle: {normal: {color:'rgba(85, 212, 212)', label:{show:true,formatter:function(c){return "请假:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'缺勤人次',
				type:'bar',
				typess:4,
				itemStyle: {normal: {color:'rgba(95, 217, 222)', label:{show:true,formatter:function(c){return "缺勤:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'新增报名人数',
				type:'bar',
				typess:5,
				itemStyle: {normal: {color:'rgba(105, 222, 232)', label:{show:true,formatter:function(c){return "新增报名:\n"+c.value+"人";}}}},
				data:[]
			},
		
			{
				name:'新增收入/元',
				type:'bar',
				typess:6,
				 yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 130, 0)', label:{show:true,formatter:function(c){return "新增收入:\n"+c.value+"元";}}}},
				data:[]
			},
			
		]
    };
   	// pieChart_a.setOption(pieoption_a);
   	// $(window).resize(pieChart_a.resize);
	var GetChartData = function(type) {
		$('#echarts-pie-chart-c').html('');
		var schoolid = "<?php  echo $schoolid;?>";
		var kcid = $('#kc_id').val();
		var url = "<?php  echo $this->createWebUrl('start');?>&op=" + type + "&schoolid=" + schoolid;
		var params = {
			'kcid': kcid,
			'start': $('#list input[name="addtime[start]"]').val(),
			'end': $('#list input[name="addtime[end]"]').val(),
			'addtime':'<?php  echo $_GPC['addtime'];?>'
		};
		$.post(url, params, function(data){
			var data = $.parseJSON(data);
			console.log(data);
			var ds = $.extend(true, {}, pieoption_c, templates[type]);
			ds.xAxis[0].data = data.allthisbj;
			
			
			ds.series[0].data = data.ksnum;
			ds.series[1].data = data.dosign;
			ds.series[2].data = data.qingjia;
			ds.series[3].data = data.notsign;
			ds.series[4].data = data.newPay;
			ds.series[5].data = data.newcose;
			
			console.log(ds);
			var myChart = echarts.init($('#echarts-pie-chart-c')[0]);
			myChart.setOption(ds);
			$(window).resize(myChart.resize);
		});
	}
	GetChartData('d');
}
	
function addbar(njid) {
	//第三
	var templates = {
		c: {
			
		}
	};
    var pieoption_c = {
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"人";}else if(c.series.typess==2){return c.name+"</br>"+c.value+"%";}}
		},
		legend: {
			data:['出勤人数/次','出勤比例']
		},
		toolbox: {
			show : true,
			feature : {
				magicType : {show: true, type: ['line', 'bar']},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : []
			},
			{
				type : 'category',
				axisLine: {show:false},
				axisTick: {show:false},
				axisLabel: {show:false},
				splitArea: {show:false},
				splitLine: {show:false},
				data : []
			}
		],
		yAxis: [{
			type: 'value',
			scale: true,
			name: '单位:人',
			min: 0,
			},{
			type: 'value',
			scale: true,
            min: 0,
			max: 100,
			name: '单位:%',
			}],
		series : [
			{
				name:'出勤人数/次',
				type:'bar',
				typess:1,

				itemStyle: {normal: {color:'rgba(65, 202, 192)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'出勤比例',
				type:'bar',
				typess:2,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(119, 230,0)', label:{show:true,formatter:function(c){return c.value+"%";}}}},
				data:[]
			},
		]
    };
   	// pieChart_a.setOption(pieoption_a);
   	// $(window).resize(pieChart_a.resize);
	var GetChartData = function(type) {
		$('#echarts-pie-chart-c').html('');
		var schoolid = "<?php  echo $schoolid;?>";
		var url = "<?php  echo $this->createWebUrl('start');?>&op=" + type + "&schoolid=" + schoolid;
		var params = {
			'njid': njid,
			'start': $('#list input[name="addtime[start]"]').val(),
			'end': $('#list input[name="addtime[end]"]').val(),
			'addtime':'<?php  echo $_GPC['addtime'];?>'
		};
		$.post(url, params, function(data){
			var data = $.parseJSON(data);
			console.log(data);
			var ds = $.extend(true, {}, pieoption_c, templates[type]);
			ds.xAxis[0].data = data.allthisbj;
			ds.xAxis[1].data = data.allthisbj;
			ds.series[0].data = data.bjcqzs;
			ds.series[1].data = data.bjkqbl;
			console.log(ds);
			var myChart = echarts.init($('#echarts-pie-chart-c')[0]);
			myChart.setOption(ds);
			$(window).resize(myChart.resize);
		});
	}
	GetChartData('c');
}

<?php  if(GetSchoolType($schoolid,$weid)) { ?>
addbarKc();
<?php  } else { ?>
addbar();
<?php  } ?>
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>