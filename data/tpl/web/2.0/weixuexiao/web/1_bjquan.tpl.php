<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>public/web/css/main.css"/>
<script type="text/javascript" src="<?php echo MODULE_URL;?>public/web/js/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>public/web/css/magnific-popup.css">

<?php  if($operation == 'display') { ?>
<script>
require(['bootstrap'],function($){
	$('.btn,.tips').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script>

<div class="main">
    <style>
        .form-control-excel {
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>
    <div class="panel panel-info">
        <div class="panel-heading">班级圈管理</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="bjquan" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				 <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按班级</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="bj_id" class="form-control">
                            <option value="">请选择班级搜索</option>
                            <?php  if(is_array($bj)) { foreach($bj as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按审核</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="isopen" class="form-control">
                            <option value="-1" <?php  if($_GPC['isopen'] == -1) { ?> selected="selected"<?php  } ?>>已审核</option>
							<option value="1" <?php  if($_GPC['isopen'] == 1) { ?> selected="selected"<?php  } ?>>未审核</option>
                        </select>
                    </div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按类型</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="msgtype" class="form-control">
                            <option value="-1">选择消息类型</option>
                            <option value="1" <?php  if($_GPC['msgtype'] == 1) { ?> selected="selected"<?php  } ?>>图文</option>
							<option value="2" <?php  if($_GPC['msgtype'] == 2) { ?> selected="selected"<?php  } ?>>语音</option>
                            <option value="3" <?php  if($_GPC['msgtype'] == 3) { ?> selected="selected"<?php  } ?>>视频</option>
							<option value="4" <?php  if($_GPC['msgtype'] == 4) { ?> selected="selected"<?php  } ?>>分享</option>						
                        </select>
                    </div>					
                    <div class="col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>					
				</div>	
            </form>
        </div>
    </div>	
	<script src="<?php echo OSSURL;?>public/mobile/js/faceMap.js?v=5.61" type="text/javascript"></script>
	<div class="panel panel-default">
        <div class="table-responsive panel-body" style="overflow: hidden;">
			<div id="queue-setting-index-body">
				<div class="viewList">
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<div class="viewBox">
						<div class="nameAndTime">
							<span class="name"><?php  echo $item['shername'];?></span> 
							<?php  if($item['msgtype'] ==1) { ?><span style="background-color: #075fb5;border-radius: 5px; color: #f3eeee;font-size: blod;font-weight:bold;">图文</span><?php  } ?>
							<?php  if($item['msgtype'] ==2) { ?><span style="background-color: #41cac0;border-radius: 5px; color: #f3eeee;font-size: blod;font-weight:bold;">语音</span><?php  } ?>
							<?php  if($item['msgtype'] ==3) { ?><span style="background-color: #e64040;border-radius: 5px; color: #f3eeee;font-size: blod;font-weight:bold;">视频</span><?php  } ?>
							<?php  if($item['msgtype'] ==4) { ?><span style="background-color: #1ab394;border-radius: 5px; color: #f3eeee;font-size: blod;font-weight:bold;">分享</span><?php  } ?>
							<?php  if($item['msgtype'] ==5) { ?><span style="background-color: #b50707;border-radius: 5px; color: #f3eeee;font-size: blod;font-weight:bold;">多媒体</span><?php  } ?>
							<span name="publishdate" class="time"><?php  echo(date('Y-m-d H:i:s',$item['createtime']))?></span>
							<?php  if($item['isopen'] == 1) { ?>
							<a class="qx_1503" href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'shenhe', 'schoolid' => $schoolid, 'id' => $item['id']))?>" onclick="return confirm('确定审核通过本条消息吗？');return false;" title="审核"><span style="cursor:pointer;color:#428bca;">审核</span></a>	
							<?php  } ?>
						</div>
						<div class="content">
								<a class="lightgray" ><?php  echo $item['content'];?><?php  echo $item['linkdesc'];?><?php  if($item['link']) { ?><a href="<?php  echo $item['link'];?>"><?php  echo $item['linkdesc'];?></a><?php  } ?></a>	
						</div>
						<div class="gallery" style="margin:5px;">
								<div class="picBox">
									<table name="imgTable" width="100%" height="100%" border="1" bordercolor="white">
										<?php  if($item['msgtype'] ==3) { ?>
											<video id="video" style="position: relative; max-height: 300px;" controls="controls" webkit-playsinline playsinline>
												<source src="<?php  echo tomedia($item['video'])?>" type='video/mp4' />
											</video>										
										<?php  } ?>
										<?php  if($item['msgtype'] ==2) { ?>
										<div class="app-audio" style="undefinedanimation:undefined;box-sizing: border-box;">
											<div class="inner" style="text-align: left;position: relative;">
												<div id="audio-music-4" class="wx audioLeft clearfix">
													<img style="width: 40px;height: 40px;border-radius: 20px;display: inline-block;" alt="语音头像" class="audioLogo" width="40" height="40" src="<?php  if($item['avatar']) { ?><?php  echo tomedia($item['avatar'])?><?php  } else { ?><?php  echo tomedia($school['tpic'])?><?php  } ?>">
													<div class="js-audio-wx-<?php  echo $item['id'];?>" id="jp_jplayer_1" style="left: 50px;width: 160px;position: absolute;height: 36px;display: inline-block;background: url(<?php echo OSSURL;?>/public/mobile/img/sprite_for-web.png) 0 0 no-repeat;background-size: 150px 36px;cursor: pointer;">
													<img style="display:none;height: 20px;margin-left: 15px;margin-top: 8px;" src="./resource/images/app/player.gif" class="audioAnimation_<?php  echo $item['id'];?>">
													<span style="position: absolute;font-size: 14px;color: #999;left: 170px;bottom: 12px;" class="audio-time"><?php  echo $item['audiotime'];?>’</span>
														<audio id="jp_audio_1_<?php  echo $item['id'];?>" preload="none" src="<?php  echo tomedia($item['audio'])?>"></audio>
													</div>
												</div>
											</div>
										</div>
										<script>
										$(function () {
											//背景音乐播放
											var myaudio = document.getElementById("jp_audio_1_<?php  echo $item['id'];?>");
											$(".js-audio-wx-<?php  echo $item['id'];?>").on("click", function () {
												if ($(this).hasClass("on")) {
													$(".js-audio-wx-<?php  echo $item['id'];?>").removeClass("on");
													$(".audioAnimation_<?php  echo $item['id'];?>").hide();
													myaudio.pause();
												} else {
													$(".js-audio-wx-<?php  echo $item['id'];?>").addClass("on");
													$(".audioAnimation_<?php  echo $item['id'];?>").show();
													myaudio.play();
												}
											})
										});
										</script>										
										<?php  } ?>
										<?php  if($item['msgtype'] ==1) { ?>
											<?php  if(count($item['picurl']) == 1) { ?>
											<tr>
												<td>
													<div class="img">
														<a href="<?php  echo tomedia($item['picurl'][0]['picurl'])?>" target="_blank" class="gallery-link" title="">
															<img src="<?php  echo tomedia($item['picurl'][0]['picurl'])?>" alt="<?php  echo $row['order'];?> ">
														</a>
													</div>
												</td>
											</tr>
											<?php  } else if(count($item['picurl']) == 2 ) { ?>
											<tr style="height:0px;">
												<td>
													<div class="imgs" >
														<a href="<?php  echo tomedia($item['picurl'][0]['picurl'])?>" target="_blank" class="gallery-link" title="">
															<img  src="<?php  echo tomedia($item['picurl'][0]['picurl'])?>" alt="<?php  echo $row['order'];?> ">
														</a>
													</div>
												</td>
												<td>
													<div class="imgs" >
														<a href="<?php  echo tomedia($item['picurl'][1]['picurl'])?>" target="_blank" class="gallery-link" title="">
															<img  src="<?php  echo tomedia($item['picurl'][1]['picurl'])?>" alt="<?php  echo $row['order'];?> ">
														</a>
													</div>
												</td>
											</tr>
											<?php  } else if(count($item['picurl']) == 3 || count($item['picurl']) == 4  ) { ?>
											<?php  if(is_array($item['picurl'])) { foreach($item['picurl'] as $key => $row) { ?>
												<?php  if($key == 0 || $key == 2 ) { ?>
												<tr style="height:0px;">
												<?php  } ?>
													<?php  if(count($item['picurl']) == 3 && $key == 0 ) { ?>
													<td rowspan="2">
														<?php  } else { ?>
													<td>
													<?php  } ?>
														<div class="imgs" >
															<a href="<?php  echo tomedia($row['picurl'])?>" target="_blank" class="gallery-link" title="">
																<img  src="<?php  echo tomedia($row['picurl'])?>" alt="<?php  echo $row['order'];?> ">
															</a>
														</div>
													</td>
											<?php  } } ?>
											
											<?php  } else if(count($item['picurl']) == 5 ||  count($item['picurl']) == 6 ) { ?>
											<?php  if(is_array($item['picurl'])) { foreach($item['picurl'] as $key => $row) { ?>
												<?php  if($key == 0 || $key == 3 ) { ?>
												<tr style="height:0px;">
												<?php  } ?>
													<td >
														<div class="imgs" >
															<a href="<?php  echo tomedia($row['picurl'])?>" target="_blank" class="gallery-link" title="">
																<img  src="<?php  echo tomedia($row['picurl'])?>" alt="<?php  echo $row['order'];?> ">
															</a>
														</div>
													</td>
											<?php  } } ?>
											<?php  } else if(count($item['picurl']) >= 7 ||  count($item['picurl']) <= 9 ) { ?>
											<?php  if(is_array($item['picurl'])) { foreach($item['picurl'] as $key => $row) { ?>
												<?php  if($key == 0 || $key == 3 || $key == 6 ) { ?>
												<tr style="height:0px;">
													<?php  } ?>
													<td >
														<div class="imgs" >
															<a href="<?php  echo tomedia($row['picurl'])?>" target="_blank" class="gallery-link" title="">
																<img  src="<?php  echo tomedia($row['picurl'])?>" alt="<?php  echo $row['order'];?> ">
															</a>
														</div>
													</td>
											<?php  } } ?>
											<?php  } ?>	
										<?php  } ?>	
									</table>				
								</div>	
							<div class="likeAndDel" style="margin:5px;">
								<div class="l">							
									<img alt="" src="<?php echo MODULE_URL;?>public/web/recipe/liked.png" />
									<span><?php  echo pdo_fetchcolumn("select count(*) FROM ".tablename('wx_school_dianzan')." WHERE sherid = '".$item['sherid']."'")?></span>
									<span>评论（<?php  echo pdo_fetchcolumn("select count(*) FROM ".tablename('wx_school_bjq')." WHERE sherid = '".$item['sherid']."' And type = 1")?>）</span>
									<span>照片（<?php  echo pdo_fetchcolumn("select count(*) FROM ".tablename('wx_school_media')." WHERE sherid = '".$item['sherid']."' ")?>）</span>									
									<a class="qx_1502" href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'delete', 'schoolid' => $schoolid, 'id' => $item['id']))?>" onclick="return confirm('此操作不可恢复，并会删除所有与本图文有关的图片和回复数据，确认删除？');return false;" title="删除"><span style="cursor:pointer;color:#428bca;">删除</span></a>
									&nbsp;
								</div>						
								<div class="r">
									<a href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'post', 'schoolid' => $schoolid, 'id' => $item['id']))?>"><button type="button" class="btn btn-sm btn-info">查看详情</button></a>
								</div>						
							</div>
						</div>
					</div>
				<?php  } } ?>	
				</div>
			</div>	
		</div>
		&nbsp;<?php  echo $pager;?>
	</div>
</div>
<script src="<?php echo MODULE_URL;?>public/web/js/webuploader.js"></script>
<script src="<?php echo MODULE_URL;?>public/web/js/wlzyList.js"></script>
<script type="text/javascript">
$(function(){
	<?php  if((!(IsHasQx($tid_global,1001502,1,$schoolid)))) { ?>
		$(".qx_1502").hide();
	<?php  } ?>
	<?php  if((!(IsHasQx($tid_global,1001503,1,$schoolid)))) { ?>
		$(".qx_1503").hide();
	<?php  } ?>
});
</script>
<script>
icon_replace($(".lightgray"));
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
</script>
<?php  } else if($operation == 'post') { ?>
<div class="panel panel-info">
	<div class="panel-heading"><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'display', 'schoolid' => $schoolid))?>"><i class="fa fa-tasks"></i>返回图文列表</a></div>
</div>
<div class="main">
	<div class="panel panel-default">
        <div class="table-responsive panel-body">
			<div id="queue-setting-index-body">
				<div class="panel panel-default">
					<div class="panel-heading">图文详情</div>
				</div>
				<div class="uploadList">
					<div class="" style="border-bottom: 1px solid #dbe1e8;">
						<div class="">
							<label class="control-label" style="float: left;width: 25%;"><?php  echo $item['shername'];?></label>
							<p class="form-control-static">
								<span><?php  if($item['isopen'] == 1 ) { ?>未审核<?php  } else { ?>已公开<?php  } ?></span>
								<?php  if($item['isopen'] == 1 ) { ?><span><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'shenhe', 'schoolid' => $schoolid, 'id' => $row['id']))?>" onclick="return confirm('确定审核通过本条消息吗？');return false;">审核</a></span><?php  } ?>
								<span class="time" style="float: right;"><?php  echo(date('Y-m-d H:i:s',$item['createtime']))?></span>
							</p>
							<span class="help-block">内容：<span style="color:red"><?php  echo $item['content'];?></span></span>							
							<span class="help-block">发送到<span style="color:red">&nbsp;<?php  echo $bj1['sname'];?>&nbsp;<?php  echo $bj2['sname'];?>&nbsp;<?php  echo $bj3['sname'];?></span></span>							
						</div>
					</div>
				</div>
				<div class="" style="">
					<div style="margin:10px 0"></div>
					<div class="photoList" style="width:100%;margin:10px 0;">
						<div id="addPhotoBox1" name="addPhotoBox">
						    <div class="gallery" data-toggle="lightbox-gallery">
								<?php  if(is_array($list1)) { foreach($list1 as $row) { ?>
									<div class="photoBox">								
										<div class="img">
												<div class="gallery-image">
													<a href="<?php  echo tomedia($row['picurl'])?>" target="_blank" class="gallery-link">
														<img src="<?php  echo tomedia($row['picurl'])?>" alt="image" style="width:100%;">
													</a>
												</div>
										</div>	
									</div>
								<?php  } } ?>
			                </div>
			            </div>
					</div>
					<div style="margin:10px">
						<img alt="" src="<?php echo MODULE_URL;?>public/web/recipe/liked.png" />
						<span style="margin:10px;"><?php  echo pdo_fetchcolumn("select count(*) FROM ".tablename('wx_school_dianzan')." WHERE sherid = '".$_GPC['id']."'")?></span>
					</div>
				</div>
				<div class="" style="border-bottom: 1px solid #dbe1e8;">
					<div class="row">
					   <div class="col-sm-6 col-xs-5"></div>
					   <div class="col-sm-6 col-xs-7"></div>
					</div>
					<table id="wlzy-datatable" class="table table-vcenter table-condensed table-bordered">
						<thead>
							<tr role="row">
							    <th class="sorting_disabled text-center" tabindex="0" rowspan="1" colspan="1" style="width:200px;">回复人</th>
								<th class="sorting_disabled text-center" tabindex="0" rowspan="1" colspan="1" style="width:600px;">内容</th>
								<th class="sorting_disabled text-center" tabindex="0" rowspan="1" colspan="1" style="width:200px;">回复时间</th>
								<th class="sorting_disabled text-center" tabindex="0" rowspan="1" colspan="1" style="width:200px;">管理</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php  if(is_array($list2)) { foreach($list2 as $row) { ?>
							<tr class="odd">
								<td class="text-center"><a><?php  echo $row['shername'];?></a></td>
								<td class="text-center"><a><?php  echo $row['content'];?></a></td>
								<td class="text-center"><a><?php  echo(date('Y-m-d H:i:s',$row['createtime']))?></a></td>
								<td class="text-center">
								<a href="<?php  echo $this->createWebUrl('bjquan', array('op' => 'delete', 'schoolid' => $schoolid, 'id' => $row['id']))?>" onclick="return confirm('确定审核通过本条消息吗？');return false;">删除</a>
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
<?php  } ?>
<script type="text/javascript">
		$(document).ready(function() {
$('.gallery-link').magnificPopup({type:'image',gallery:{enabled:true}});
		}); 
	</script>
	
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>