<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
<style>
.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
.right-content .we7-page-alert {margin-left:0px!important;margin-right:0px!important;}	
</style>
<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
<div class="panel we7-panel">
	<div class="panel-body we7-padding">
		<form action="./index.php" method="get" class="we7-form" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="weixuexiao" />
			<input type="hidden" name="do" value="school" />
			<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
			<div class="form-group">
				<label class="col-sm-2 control-label">关键字</label>
				<div class="col-sm-2 col-lg-2" style="margin-left:-80px">
					<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
				</div>
			</div>
			<div class="form-group">
			<?php  if($city) { ?>
				<label class="col-sm-2 control-label">按城市</label>
				<div class="col-sm-2 col-lg-2" style="margin-left:-80px">
					<select style="margin-right:15px;" name="city" id="city" class="form-control">
						<option value="0">按城市</option>
						<?php  if(is_array($city)) { foreach($city as $row) { ?>
						<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['city']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			<?php  } ?>
				<div class="col-sm-2 col-lg-2">
					<select style="margin-right:15px;" name="areaid" id="areaid" class="form-control">
						<option value="0">按区域</option>
						<?php  if(is_array($area)) { foreach($area as $row) { ?>
						<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['areaid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
						<?php  } } ?>
					</select>
				</div>					
				<div class="col-sm-2 col-lg-2">
					<select style="margin-right:15px;" name="typeid" class="form-control">
						<option value="0">按类型</option>
						<?php  if(is_array($schooltype)) { foreach($schooltype as $row) { ?>
						<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['typeid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
						<?php  } } ?>
					</select>
				</div>
				<div class="pull-right col-sm-5">
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					<?php  if($set['school_max'] == 0 || $set['school_max'] > $allxx || $_W['isfounder']) { ?>
					<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('school', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加学校</a>
					<?php  } ?>
					<?php  if($_W['isfounder']) { ?><a class="btn btn-primary" href="javascript::;" data-toggle="tooltip" data-placement="top" onclick="xxxz();"><i class="fa fa-anchor"></i> 学校限制</a><?php  } ?>
				</div>					
			</div>
		</form>		
	</div>	
	<div class="alert we7-page-alert">
		<p><i class="wi wi-info-sign"></i> 当前接入学校总数:<strong class="text-danger"><?php  echo $allxx;?>个</strong>。共绑定微信用户:<strong class="text-danger"><?php  echo $allbd;?>人</strong>。昨日绑定:<strong class="text-danger"><?php  echo $zrbd;?>人</strong>。今日绑定:<strong class="text-danger"><?php  echo $jrbd;?>人</strong>。</p>
		<p><i class="wi wi-info-sign"></i> 当前学生总数:<strong class="text-danger"><?php  echo $allxs;?>人</strong>。当前教师总数:<strong class="text-danger"><?php  echo $allls;?>人</strong>。当前考勤记录:<strong class="text-danger"><?php  echo $allkq;?>次</strong>。昨日考勤:<strong class="text-danger"><?php  echo $zrkq;?>次</strong>。今日考勤:<strong class="text-danger"><?php  echo $jrkq;?>次</strong>。</p>
	</div>	
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#city").change(function() {
		var type = 1;
		var cityId = $("#city option:selected").attr('value');
		changeGrade(cityId,type, function() {
		});
	});	
});	
function changeGrade(cityId, type, __result) {	
	var weid = "<?php  echo $weid;?>";
	var classlevel = [];
	//获取班次
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getquyulist'))?>", {'gradeId': cityId, 'weid': weid}, function(data) {
	
		data = JSON.parse(data);
		classlevel = data.bjlist;
		
		var html = '';	
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].id + '">' + classlevel[i].name + '</option>';
			}
		}
		$('#areaid').html(html);	
	});
}
</script>	
<?php  } ?>
<div class="panel panel-default">
	<div class="table-responsive panel-body">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th style="width:4%;">顺序</th>
					<th style="width:10%;">名称</th>
					<th style="width:6%;">区域</th>
					<th style="width:7%;">地址</th>
					<th style="width:7%;">学校数据</th>
					<th style="width:5%;">学校类型</th>
					<th style="width:5%;">状态</th>
					<th style="width:15%;text-align: right;">管理/编辑/删除</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($schoollist)) { foreach($schoollist as $item) { ?>
				<tr>
					<td><input type="text" class="form-control" name="ssort[<?php  echo $item['id'];?>]" value="<?php  echo $item['ssort'];?>"></td>
					<td><a href="<?php  echo $this->createWebUrl('start', array('id' => $item['id'], 'schoolid' =>  $item['id']))?>" title="管理">
						<img src="<?php  echo tomedia($item['logo'])?>" onerror="this.src='./resource/images/nopic.jpg';" width="60px;" style="border-radius: 3px;">
						<br/><?php  echo $item['title'];?></a>
					</td>
					<td><?php  echo $item['city'];?></br><?php  echo $item['qujian'];?></td>
					<td>
					   <?php  echo $item['address'];?>
					   </br>
					   <?php  echo $item['tel'];?>
					</td>
					<td class="row-first row-hover" style="  word-wrap: break-word;"><a class="btn btn-default" href="javascript::;"  data-toggle="tooltip" data-placement="top" title="学校数据" onclick="sj('<?php  echo $item['id'];?>', '<?php  echo $item['xsrs'];?>人', '<?php  echo $item['jsrs'];?>人','<?php  echo $item['kcsm'];?>个','<?php  echo $item['ybrs'];?>人');">学校数据</a></td>					
					<td>
					   <?php  echo $item['leixing'];?>
					</td>						
					<td style="width:60px;">
						<?php  if($item['is_show']==1) { ?>
						<span class="label" style="background:#56af45;">显示</span>
						<?php  } else { ?>
						<span class="label" style="background:#f00;">隐藏</span>
						<?php  } ?>
						</br>
						</br>
						<?php  if($item['is_cost']==1) { ?>
						<span class="label" style="background:#56af45;">启用收费</span>
						<?php  } ?>						
					</td>
					<td style="max-width:60px;text-align: right;">
						<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('school', array('id' => $item['id'], 'schoolid' =>  $item['id'], 'op' => 'post'))?>" title="编辑"><i class="fa fa-pencil"></i></a>
						<a href="javascript::;"  data-toggle="tooltip" data-placement="top" onclick="copytip('<?php  echo $item['id'];?>');" class="btn btn-default btn-sm" title="复制学校" data-toggle="tooltip" data-placement="top" >复制</a>
						<?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?>
						<a class="btn btn-default btn-sm" onclick="return confirm('确认删除吗？');return false;" href="<?php  echo $this->createWebUrl('school', array('id' => $item['id'], 'schoolid' =>  $item['id'], 'op' => 'delete'))?>" title="删除"><i class="fa fa-times"></i></a>
						<?php  } ?>
						<a href="<?php  echo $this->createWebUrl('start', array('id' => $item['id'], 'schoolid' =>  $item['id']))?>" class="btn btn-default btn-sm" title="管理学校" data-toggle="tooltip" data-placement="top"><i class="fa fa-cog fa-spin"> </i> 管理</a>							
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="7">
						<input name="submit" type="submit" class="btn btn-primary" value="批量修改排序">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
				</tfoot>
			</table>
		</form>
		<?php  echo $pager;?>
	</div>
</div>
<input type="hidden" id="sid" value="">
<div class="modal fade" style="min-width: 583px!important;" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header">
				<h4 class="modal-title" style="text-align:center;color:#333;font-size: 17px;">选择复制内容</h4>
			</div>
			<div class="modal-body" style="width: 100%;">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">项目</label>
					<div class="col-sm-9 col-xs-6">
						<div class="input-group text-info" style="width: 50%;float: left;">
							<label for="beasic" class="checkbox-inline">
								<input id="beasic" class="cehckd" type="checkbox" dataname="beasic" disabled checked value="beasic"/>基础设置
							</label></br>
							<label for="template" class="checkbox-inline">
								<input id="template" class="cehckd" type="checkbox" dataname="template" value="template"/>前端模版
							</label></br>
						</div>
						<div class="input-group text-info" style="width: 50%;float: left;">
							<label for="classfiy" class="checkbox-inline">
								<input id="classfiy" class="cehckd" type="checkbox" dataname="classfiy" value="classfiy"/>分类设置(年级、班级等)
							</label></br>
							<label for="banner" class="checkbox-inline">
								<input id="banner" class="cehckd" type="checkbox" dataname="banner" value="banner"/>幻灯片
							</label></br>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="border-radius: 6px;">
				<input type="submit" onclick="tijiao()" class="btn btn-success" value="确定选择">
				<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="weid" value="<?php  echo $weid;?>">
<div class="modal fade" style="min-width: 583px!important;" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header">
				<h4 class="modal-title" style="text-align:center;color:#333;font-size: 17px;">本公众号限制添加学校数量</h4>
			</div>
			<div class="modal-body" style="width: 100%;">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">数量</label>
					<div class="col-sm-9 col-xs-6">
						<div class="input-group" style="width: 50%;float: left;">
							<input class="form-control" id="xznumbers" type="text" value="<?php  if($set['school_max']) { ?><?php  echo $set['school_max'];?><?php  } else { ?><?php  echo $set['school_max'];?><?php  } ?>"/>
						</div>
						<div class="help-block">0则不限</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="border-radius: 6px;">
				<input type="submit" onclick="xztj()" class="btn btn-success" value="确定">
				<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script>
function xxxz(){
	$('#Modal3').modal('toggle');
}
function xztj(){
	var weid = $('#weid').val();
	var xznumbers = $('#xznumbers').val();
	$.ajax({
		url: "<?php  echo $this->createWebUrl('school', array('op'=>'xznub'))?>",
		type: "post",
		dataType: "json",
		data: {
			weid: weid,
			xznumbers:xznumbers
		},
		success: function (data) {
			if (data.result) {
				$('#xznumbers').val(xznumbers);
				alert(data.msg);
			}else{
				alert(data.msg);
			}
		}		
	});
	$('#Modal3').modal('toggle');
}
function copytip(id){
	$('#Modal2').modal('toggle');
	$('#sid').val(id);
}

function tijiao(){
	var all_select_id = '';
	$(".cehckd").each(function(i, dom) {
		if($(this).is(':checked')){
			all_select_id += $(this).val() + ',';
		}
	});
	var all_select_id = all_select_id;
	var sid = $('#sid').val();
	//获取班次
	window.open("<?php  echo $this->createWebUrl('school',array('op'=>'copy'))?>"+'&sid='+sid+'&options='+all_select_id);  
	$('#Modal2').modal('toggle');
}
</script>
<?php  if($_W['isfounder'] && getoauthurl() != 'b.yuntuijia.com') { ?>
	<div class="panel panel-default">
		<div class="panel-heading">给开发者建议或留言</div>
		<div class="panel-body">
		<div class="row-fluid">
			<div class="span8 control-group">
				【本部分仅创始人可见，不必担心客户或其他管理员能看到】有何建议或BUG请直接提交  联系开发者QQ:<a href="tencent://message/?uin=332035136&Site=qq&Menu=yes">332035136</a> 工作日时间（周一 - 周六 13：00 - 21：00）请直接Q我!其他时间勿扰。
			</div>
		</div>
		</div>
	</div>
<?php  } ?>
<input type="hidden" name="rid" id="stylerid" value="" />
<style>
	.template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:190px;margin:0 20px 20px 0; overflow:hidden;}
	.template .title{margin:5px auto;line-height:2em;}
	.template .title a{text-decoration:none;}
	.template .item img{width:178px;height:270px; cursor:pointer;}
	.template .active.item-style img, .template .item-style:hover img{width:178px;height:270px;border:3px #009cd6 solid;padding:1px; }
	.template .title .fa{display:none}
	.template .active .fa.fa-check{display:inline-block;position:absolute;bottom:33px;right:6px;color:#FFF;background:#009CD6;padding:5px;font-size:14px;border-radius:0 0 6px 0;}
	.template .fa.fa-times{cursor:pointer;display:inline-block;position:absolute;top:10px;right:6px;color:#D9534F;background:#ffffff;padding:5px;font-size:14px;text-decoration:none;}
	.template .fa.fa-times:hover{color:red;}
	.template .item-bg{width:100%; height:342px; background:#000; position:absolute; z-index:1; opacity:0.5; margin:-5px 0 0 -5px;}
	.template .item-build-div1{position:absolute; z-index:2; margin:-5px 10px 0 5px; width:168px;}
	.template .item-build-div2{text-align:center; line-height:30px; padding-top:150px;}
	@media screen and (min-width:992px){#ListStyle{width:890px; margin:100px auto;}}
</style>
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">学校数据</h4>
			</div>
			<style>.modal-body {width: 50%;float: left;  border-bottom: 1px solid #F1F3F5;border-right: 1px solid #F1F3F5;}</style>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-5 control-label">学生人数</label>
					<div class="col-sm-3 col-xs-5">
						<a  href="javascript::;"  target="_blank" class="label label-success user_ysh"></a>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-5 control-label">教师人数</label>
					<div class="col-sm-3 col-xs-5">
						<a  href="javascript::;"  target="_blank" class="label label-success user_wsh"></a>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-5 control-label">课程总数</label>
					<div class="col-sm-3 col-xs-5">
						<a href="javascript::;" target="_blank" class="label label-success user_tprc"></a>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-5 control-label">绑定人数</label>
					<div class="col-sm-3 col-xs-5">
						<span class="label label-success user_cyrs"></span>	
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!--<input type="submit" name="tijiao" id="tijiao" class="btn btn-success" value="开始上传">-->
				<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">				
function sj(schoolid,user_ysh,user_wsh,user_tprc,user_cyrs){
	 $('#Modal1').modal('toggle');
	 $('.user_ysh').text(user_ysh);
	 $('.user_wsh').text(user_wsh);
	 $('.user_tprc').text(user_tprc);
	 $('.user_cyrs').text(user_cyrs);
}
</script>
<?php  } else if($operation == 'post') { ?>
<link rel="stylesheet" type="text/css" href="../addons/weixuexiao/public/web/css/clockpicker.css" media="all">
<script type="text/javascript" src="../addons/weixuexiao/public/web/js/clockpicker.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/weixuexiao/public/web/css/standalone.css" media="all">
<link rel="stylesheet" type="text/css" href="../addons/weixuexiao/public/web/css/uploadify_t.css?v=4" media="all" />
<style>
    .item_box img{
        width: 100%;
        height: 100%;
    }
</style>
<script>
    $(function(){
        $('.clockpicker').clockpicker();
    })
</script>
<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('school', array('op' => 'display'))?>"><i class="fa fa-tasks"></i> 返回学校列表</a>
<div class="main">
    <form action="" method="post" onsubmit="return check();" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                基本信息
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学校名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="<?php  echo $reply['title'];?>" id="title" class="form-control" />
                    </div>
                </div>				
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">Logo</label>
                    <div class="col-sm-9">
                        <?php  echo tpl_form_field_image('logo', $reply['logo'])?>
						<div class="help-block">如果使用优米考勤机必须为PNG格式图片否则设备上无法显示</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学校类型</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type" id="type">
                            <option value="0">请选择</option>
                            <?php  if(is_array($schooltype)) { foreach($schooltype as $item) { ?>
                            <option value="<?php  echo $item['id'];?>" <?php  if($reply['typeid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
				<?php  if($city) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属城市</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="cityid" id="city">
                            <option value="0">请选择</option>
                            <?php  if(is_array($city)) { foreach($city as $item) { ?>
                            <option value="<?php  echo $item['id'];?>" <?php  if($reply['cityid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['name'];?></option>
                            <?php  } } ?>
							<input type="hidden" name='cityids[]' id='cityid' value='' >
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属区域</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="area" id="area">
							<?php  if($reply['areaid']) { ?>
							<option value="<?php  echo $reply['areaid'];?>" selected><?php  echo $quyu['name'];?></option>						
							<?php  } ?>
                        </select>
                    </div>
                </div>
				<?php  } else { ?>	
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属区域</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="area" id="area">
                            <option value="0">请选择</option>
                            <?php  if(is_array($area)) { foreach($area as $item) { ?>
                            <option value="<?php  echo $item['id'];?>" <?php  if($reply['areaid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
				<?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">本校独立账户归属<?php  if($_W['isfounder']) { ?>系统<?php  } ?>用户组</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="wqgroupid" id="wqgroupid">
                            <option value="0">请选择</option>
							<?php  if(is_array($groups)) { foreach($groups as $row) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $reply['wqgroupid']) { ?>selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>							
                        </select>
                    </div>
                </div>								
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">启用学校</label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" name="is_show" value="1" <?php  if($reply['is_show']==1 || empty($reply)) { ?>checked<?php  } ?>>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_show" value="0" <?php  if(isset($reply['is_show']) && empty($reply['is_show'])) { ?>checked<?php  } ?>>否
                        </label>
						<div class="help-block">如不启用，手机端学校列表里则不显示本校</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否满员</label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" name="is_hot" value="1" <?php  if($reply['is_hot']==1 || empty($reply)) { ?>checked<?php  } ?>>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_hot" value="0" <?php  if(isset($reply['is_hot']) && empty($reply['is_hot'])) { ?>checked<?php  } ?>>否
                        </label>
                        <div class="help-block">本校招生是否满员</div>
                    </div>
                </div>							
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="ssort" value="<?php  echo $reply['ssort'];?>" id="ssort" class="form-control" />
                    </div>
                </div>
			</div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#city").change(function() {
		var type = 2;
		var cityId = $("#city option:selected").attr('value');
		changeGrade(cityId,type, function() {
		});	
		
	});	
});	
function changeGrade(gradeId, type, __result) {
	
	//$('#njidid').val(gradeId);
	
	var weid = "<?php  echo $weid;?>";
	var classlevel = [];
	//获取班次
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getquyulist'))?>", {'gradeId': gradeId, 'weid': weid}, function(data) {
	
		data = JSON.parse(data);
		classlevel = data.bjlist;
		
		var html = '';
		html += '<select id="bj_id"><option value="">请选择区域</option>';
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].id + '">' + classlevel[i].name + '</option>';
			}
		}
		
		$('#area').html(html);
	});

}
</script>
<script type="text/javascript">
	var category = <?php  echo json_encode($children)?>;
	$('#credit1').click(function(){
		$('#credit-status1').show();
	});
	$('#credit0').click(function(){
		$('#credit-status1').hide();
	});
	$('#credit3').click(function(){
		$('#credit-status2').show();
	});
	$('#credit2').click(function(){
		$('#credit-status2').hide();
	});	
</script>
<script language='javascript'>
    require(['jquery', 'util'], function ($, u) {
        $(function () {
            u.editor($('.richtext')[0]);
        });
    });
</script>
<script type="text/javascript">
    function check() {
        if($.trim($('#title').val()) == '') {
            message('没有输入学校名称.', '', 'error');
            return false;
        }
        return true;
    }
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
