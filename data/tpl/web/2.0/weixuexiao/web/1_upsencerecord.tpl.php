<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />

 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
 <div class="panel panel-info">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li <?php  if($_GPC['do']=='uploadsence') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('uploadsence', array('op' => 'display', 'schoolid' => $schoolid))?>">场景管理</a></li>
			<li <?php  if($_GPC['do']=='upsencerecord') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('upsencerecord', array('op' => 'display', 'schoolid' => $schoolid))?>">教师上传记录</a></li>
		</ul>
	</div>
</div>
<?php  if($operation == 'display') { ?>

<style>

</style>





<div class="main">
	 <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
			<form style="padding-top: 20px;" action="./index.php" method="get" class="form-horizontal"  id="qrFrom" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="upsencerecord" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				
				<div class="form-group clearfix">
					<?php  if($is_admin == true ||  $is_qx == true) { ?>
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label">按教师姓名</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="search_tname" id="" type="text" value="<?php  echo $_GPC['search_tname'];?>">
                    </div>	
					<?php  } ?>
					<?php  if($is_admin == true || ($is_admin == false && $is_qx == false)) { ?>
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按权限部门搜索</label>
                    <div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" id="search_fzid" name="search_fzid" class="form-control">
						<option value="0" >选择部门</option>
						<?php  if(is_array($jsfzlist)) { foreach($jsfzlist as $row_fz) { ?>
							<option value="<?php  echo $row_fz['sid'];?>" <?php  if($_GPC['search_fzid'] == $row_fz['sid']) { ?> selected="selected"<?php  } ?>><?php  echo $row_fz['sname'];?></option>
						<?php  } } ?>
						</select>
                    </div>
					<?php  } ?>					
				</div>
				<?php  if($is_admin == true || ($is_admin == false && $is_qx == false)) { ?>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按场景搜索</label>
                    <div class="col-sm-3">
                        <select style="margin-right:15px;" id="search_senceid" name="search_senceid" class="form-control">
						<option value="0" >选择场景</option>
						<?php  if(is_array($sencelist)) { foreach($sencelist as $row_se) { ?>
							<option value="<?php  echo $row_se['id'];?>" <?php  if($_GPC['search_senceid'] == $row_se['id']) { ?> selected="selected"<?php  } ?>><?php  echo $row_se['name'];?> - 【<?php  echo date("m月d日",$row_se['sencetime'])?>】</option>
						<?php  } } ?>
						</select>
                    </div>	
				</div>
				<?php  } else if($is_admin == false && $is_qx == true) { ?>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按场景搜索</label>
                    <div class="col-sm-3">
                        <select style="margin-right:15px;" id="search_senceid" name="search_senceid" class="form-control">
						<option value="0" >选择场景</option>
						<?php  if(is_array($allsencelist)) { foreach($allsencelist as $row_se) { ?>
							<option value="<?php  echo $row_se['id'];?>" <?php  if($_GPC['search_senceid'] == $row_se['id']) { ?> selected="selected"<?php  } ?>><?php  echo $row_se['name'];?> - 【<?php  echo date("m月d日",$row_se['sencetime'])?>】</option>
						<?php  } } ?>
						</select>
                    </div>	
				</div>
				<?php  } ?>			
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">按上传时间搜索</label>
					<div class="col-sm-2 col-lg-2">
						<?php  echo tpl_form_field_daterange('uptime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
					<div class="col-sm-2 col-lg-2" style="margin-left:50px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
					<div class="form-group qx_3812">
						<a style="margin-left:40px;" class="btn btn-primary " onclick="uploadsence();"><i class="fa fa-plus"></i> 上传资料</a>
					</div>
				</div>
            </form>
           
		</div>
	</div>
   	
	
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
					    <th style="width:5%">序号</th>
                        <th>场景</th>
                        <th style="width:10%">教师</th>
                    	<th style="width:10%">上传时间</th>
                    	<th style="width:12%">上传内容</th>
                    	<th style="width:8%">权限部门</th>
						<th class="qx_3813" style="width:8%">下载内容</th>
                        <th class="qx_3814" style="text-align:right;width:10%">删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($sencefilelist)) { foreach($sencefilelist as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['id'];?></div></td>
						<td><?php  echo $row['sencename'];?></td>
						<td><span class="label label-info"><?php  echo $row['tname'];?></span></td>
                        <td><span class="label label-success"><?php  echo date("Y-m-d H:i:s",$row['createtime'])?></span></td>
                        <td>
						<?php  if(!empty($row['up_word'])) { ?>
						<span class="label label-info">文字</span>
						<?php  } ?>
						<?php  if(!empty($row['up_imgs']) && $row['up_imgs'] != 'null') { ?>
						<span class="label label-success">图片</span>
						<?php  } ?>
						<?php  if(!empty($row['up_audio'])) { ?>
						<span class="label label-warning">语音</span>
						<?php  } ?>
						<?php  if(!empty($row['up_video'])) { ?>
						<span class="label label-primary">视频</span>
						<?php  } ?>
						</td>
                        <td><div class="type-parent"><?php  echo $row['fzname'];?></div></td>
						<td class="qx_3813"><div class="type-parent"><a class="btn btn-default btn-sm" onclick="down_file(<?php  echo $row['id'];?>)" title="下载内容"><i class="fa fa-qrcode">&nbsp;&nbsp;下载内容</i></a></div></td>
                        <td class="qx_3814" style="text-align:right;"><a class="btn btn-default btn-sm qx_2813" href="<?php  echo $this->createWebUrl('upscencerecord', array('op' => 'delete', 'actid' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除该条记录？');return false;" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
            <?php  echo $pager;?>
        </form>
    </div>
    
</div>

 <form action="" id="down_form" method="post" class="form-horizontal form"  style="display:none">
	<input type="hidden" name="tid_down" id="tid_down" value="0" />
	<input type="hidden" name="c" value="site" />
	<input type="hidden" name="a" value="entry" />
	<input type="hidden" name="m" value="weixuexiao" />
	<input type="hidden" name="do" value="upsencerecord" />
	<input type="hidden" name="op" value="down_file" />
	<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
</form>
		
		
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:60px;z-index:2041 !important;">
	<div class="modal-dialog modal-lg" role="document" >		
		<div class="modal-content" >			
			<div class="modal-header" style="color: black;">					
				<h4 class="modal-title" id="ModalTitle">上传资料</h4>	
			</div>
			<div class="modal-body">
				 <form id="upsence_form" method="post" class="form-horizontal form" >
					<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />	
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
							<?php  if(($tid_global !='founder' && $tid_global !='owner' && $tid_global !='vice_founder')) { ?>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>老师</label>
								<div class="col-sm-9">
									<span class="form-control"  style="border:unset"><?php  echo $this_teacher['tname'];?> </span>
									<input type="hidden" name="up_tid" class="form-control" value="<?php  echo $this_teacher['id'];?>" />
								</div>
							<?php  } else { ?>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>选择老师</label>
								<div class="col-sm-9">
									<select style="margin-right:15px;" name="up_tid" id="up_tid" class="form-control">
										<option value="0" >选择老师</option>
										<?php  if(is_array($teachers)) { foreach($teachers as $row_t) { ?>
										<option value="<?php  echo $row_t['id'];?>" ><?php  echo $row_t['tname'];?></option>
										<?php  } } ?>
									</select>
								</div>
								<?php  } ?>
							</div>
							<div class="form-group">
							<input type="hidden" name="this_tid" value="<?php  echo $tid_global;?>">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>选择场景</label>
								<div class="col-sm-9">
									<select style="margin-right:15px;" name="up_senceid" id="up_senceid" class="form-control">
										<option value="0" >选择场景</option>
										<?php  if(is_array($sencelist)) { foreach($sencelist as $row_s) { ?>
										<option value="<?php  echo $row_s['id'];?>" ><?php  echo $row_s['name'];?> 【<?php  echo date("m月d日",$row_s['sencetime'])?>】</option>
										<?php  } } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">文字内容</label>
								<div class="col-sm-9">
									<textarea rows="4" class="form-control" cols="" style="padding:unset;resize: none;" id="up_word"  name="up_word"  placeholder="文字内容"></textarea>
									<div class="help-block">文字内容</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>图片内容</label>
								<div class="col-sm-9 col-xs-12">
									<?php  echo tpl_form_field_multi_image('up_imgs')?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>语音内容</label>
								<div class="col-sm-9 col-xs-12">
									<?php  echo tpl_form_field_audio('up_audio')?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>视频内容</label>
								<div class="col-sm-9 col-xs-12">
									<?php  echo tpl_form_field_video('up_video')?>
								</div>
							</div>
						</div>
					</div>
				</form>		
			</div>				
			<div class="modal-footer">	
				<button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="submit2" onclick="upsence()" >确认上传</button>
			</div>			
		</div>	
	</div>
</div>
<script type="text/javascript">

function uploadsence(){
	$('#Modal1').modal('toggle'); 
}

function upsence() {
    let form = new FormData(document.getElementById("upsence_form"));
    $.ajax({
		url: "<?php  echo $this->createWebUrl('upsencerecord', array('op' => 'upsence_form', 'schoolid' => $schoolid))?>",
		type: "post",
		data: form,
		processData: false,
		contentType: false, 
		success: function(result) {
            let obj = jQuery.parseJSON(result);
            console.log(obj);
			alert(obj.msg);
			if(obj.status = true){
				$("#close_modal").trigger('click');
				window.location.reload();
			}
		},
		error: function(e) {
			alert('访问网络失败');
		}
	});
}


function down_file(id){
	$("#tid_down").val(id);
	$("#down_form").submit();

}

</script>

<?php  } ?>
<script type="text/javascript">
	$(function(){
        let e_d_11 = 2;
        <?php  if((!(IsHasQx($tid_global,1003812,1,$schoolid)))) { ?>
            $(".qx_3812").hide();
        <?php  } ?>
        <?php  if((!(IsHasQx($tid_global,1003813,1,$schoolid)))) { ?>
            $(".qx_3813").hide();
        <?php  } ?>
        <?php  if((!(IsHasQx($tid_global,1003814,1,$schoolid)))) { ?>
            $(".qx_3814").hide();
        <?php  } ?>

    });
</script>