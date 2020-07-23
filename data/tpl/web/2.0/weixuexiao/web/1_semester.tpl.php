<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<div class="panel panel-info">
	<div class="panel-body">
	   <?php  echo $this -> set_tabbar($action1, $schoolid, $_W['role'], $_W['isfounder'], $_W['schooltype']);?>
	</div>
</div>
<ul class="nav nav-tabs">
    <li class="qx_edit <?php  if($operation == 'post') { ?>active<?php  } ?>"><a href="<?php  echo $this->createWebUrl('semester', array('op' => 'post', 'schoolid' => $schoolid))?>"><i class="fa fa-plus"></i>添加</a></li>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('semester', array('op' => 'display', 'schoolid' => $schoolid))?>"><i class="fa fa-cog"></i> <?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?></a></li>
</ul>
 <style>
.cLine {overflow: hidden;padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>
<div class="cLine">
    <div class="alert">
    <p><span class="bold">使用方法：</span>
   <?php  if($schooltype) { ?>
   填写课程分类,如 小升初，爵士舞，初升高....<br/>
   <strong><font color='red'>特别提醒: 当你删除该项的时候,该项下相关的所有数据都会被删除,请谨慎操作!以免丢失数据!</font></strong> 
   <?php  } else { ?>
   填写年级管理,如 小班，中班，大班，一年级管理,二年级管理,初一，初二，高一，高二，大一，大二....<br/>
   <strong><font color='red'>特别提醒: 当你删除该年级管理项的时候,该{年级管理项下相关的所有数据都会被删除,请谨慎操作!以免丢失数据!</font></strong>
   <?php  } ?>
    </p>
    </div>
</div>
<?php  if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading"><?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>编辑</div>
            <div class="panel-body">
				<div id="custom-url">
				<?php  if($semester) { ?>
					<input type="hidden" name="old" value="111" />
					<div class="form-group">
						<label class="col-sm-2" style="width:5%">排序</label>
						<div class="col-sm-2 col-lg-2">
							<input type="text" name="ssort" placeholder="排序" class="form-control" value="<?php  echo $semester['ssort'];?>" />
						</div>
						<div class="col-sm-2 col-lg-2">
							<input type="text" name="catename" placeholder="<?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>名称" class="form-control" value="<?php  echo $semester['sname'];?>" />
						</div>
						<div class="col-sm-2 col-lg-2" id="sxname">
							<select name="tid" class="form-control select" style="display:none">

							</select>
							<input type="text" placeholder="主任或管理" class="form-control sxword" value="<?php  if($tname) { ?><?php  echo $tname['tname'];?><?php  } ?>"/>
						</div>
						<div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -31px;">	
							<span class="btn btn-default"><i class="fa fa-search"></i></span>
						</div>						
					</div>
				<?php  } else { ?>
					<input type="hidden" name="new[]" value="111" />
					<div class="form-group">
						<label class="col-sm-2" style="width:5%">排序</label>
						<div class="col-sm-2 col-lg-2">
							<input type="text" name="ssort_new[]" placeholder="排序" class="form-control" value="<?php  echo $semester['ssort'];?>" />
						</div>
						<div class="col-sm-2 col-lg-2">
							<input type="text" name="catename_new[]" placeholder="<?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>名称" class="form-control" value="<?php  echo $semester['sname'];?>" />
						</div>
						<div class="col-sm-2 col-lg-2" id="sxname">
							<select name="tid_new[]" class="form-control select" style="display:none">

							</select>
							<input type="text" placeholder="主任或管理" class="form-control sxword" value="<?php  if($tname) { ?><?php  echo $tname['tname'];?><?php  } ?>"/>
						</div>
						<div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -31px;">	
							<span class="btn btn-default"><i class="fa fa-search"></i></span>
						</div>						
					</div>				
				<?php  } ?>	
                </div>	
				<div class="clearfix template"> 
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
						<div class="col-sm-9 col-xs-12">
							<a href="javascript:;" id="custom-url-add"><i class="fa fa-plus-circle"></i> 添加<?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?></a>
						</div>
					</div>	
				</div>				
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script>
$('#custom-url-add').click(function(){
	var html =  '<div class="form-group">'+
				'<input type="hidden" name="new[]" value="111" />	'+
				'		<label class="col-sm-2" style="width:5%">排序</label>'+
				'		<div class="col-sm-2 col-lg-2">'+
				'			<input type="text" name="ssort_new[]" placeholder="排序" class="form-control" value="" />'+
				'		</div>'+
				'		<div class="col-sm-2 col-lg-2">'+
				'			<input type="text" name="catename_new[]" placeholder="<?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>名称" class="form-control" value="" />'+
				'		</div>'+
				'		<div class="col-sm-2 col-lg-2" id="sxname">'+
				'			<select name="tid_new[]" class="form-control select" style="display:none">'+
				'			</select>'+
				'			<input type="text" placeholder="班主任或管理" class="form-control sxword" value="<?php  if($tname) { ?><?php  echo $tname['tname'];?><?php  } ?>"/>'+
				'		</div>'+
				'		<div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -31px;">'+
				'			<span class="btn btn-default"><i class="fa fa-search"></i></span>'+
				'		</div>'+
				'	<div class="col-sm-1" style="margin-top:5px">'+
				'   	<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i></a>'+
				'	</div>'+
				'</div>';
			;
	$('#custom-url').append(html);
});
$(document).on('click', '.custom-url-del', function(){
	$(this).parent().parent().remove();
	return false;
});	
$(document).on('click', '.btn-default', function(){
	var t = $(this).parent().parent().children();
	var want = t.find('input[class*=sxword]');
	var selectdiv = t.find('select[class*=select]');
	
	var tname = want.val();
	want.hide();
	selectdiv.show();
	
	var schoolid = "<?php  echo $schoolid;?>";
	var classlevel = [];
	html1 += '<select id="schoolid"><option value="">请选择老师</option>';
	if(tname != ''){
		$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getallteacher'))?>", {'tname': tname,schoolid:schoolid}, function(data) {
				data = JSON.parse(data);
			if(data.result == true){	
				classlevel = data.teachcers;		
				var html = '';
				if (classlevel != '') {
					for (var i in classlevel) {
						html += '<option value="' + classlevel[i].id + '">' + classlevel[i].tname + '</option>';
					}
				}
				selectdiv.html(html);
			}else{
				selectdiv.hide();
				want.show();
				alert(data.msg);
			}
		});	
	}else{
		var html1 = ''+
								<?php  if(is_array($allls)) { foreach($allls as $it) { ?>
				'					<option value="<?php  echo $it['id'];?>"><?php  echo $it['tname'];?></option>'+
								<?php  } } ?>
				'';
		selectdiv.html(html1);
	}
});	
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i>刷新</a>
        </div>
    </div>
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
					    <th style="width:100px;">序号</th>
                        <th><?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>名称</th>
						<th><?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>主任(或管理员)</th>
						<th>本<?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>人数</th>
						<th>本<?php  if($schooltype) { ?>课程分类<?php  } else { ?>年级管理<?php  } ?>下属班级数</th>
						<th class="qx_00214">是否毕业</th>
                        <th class="qx_e_d" style="text-align:right;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($semester)) { foreach($semester as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['ssort'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['sname'];?>&nbsp;&nbsp;</div></td>
						<td><div class="type-parent"><?php  echo $row['tname'];?>&nbsp;&nbsp;</div></td>
						<td><span class="label label-info"><?php  echo $row['renshu'];?>人</span></td>
						<td><span class="label label-info"><?php  echo $row['bjsm'];?>个</span></td>
						<td class="qx_00214"><input type="checkbox" value="<?php  echo $row['is_over'];?>" name="is_over[]" data-id="<?php  echo $row['sid'];?>" <?php  if($row['is_over'] == 2) { ?>checked<?php  } ?>></td>
                        <td style="text-align:right;" class="qx_e_d"><a class="btn btn-default btn-sm qx_edit" href="<?php  echo $this->createWebUrl('semester', array('op' => 'post', 'sid' => $row['sid'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_delete" href="<?php  echo $this->createWebUrl('semester', array('op' => 'delete', 'sid' => $row['sid'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var e_d = 2 ;
	<?php  if(!(IsHasQx($tid_global,1000212,1,$schoolid))) { ?>
		$(".qx_edit").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000214,1,$schoolid))) { ?>
		$(".qx_00214").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000213,1,$schoolid))) { ?>
		$(".qx_delete").hide();
		e_d = e_d - 1 ;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
});	
require(['jquery', 'util', 'bootstrap.switch'], function($, u){
	<?php  if((IsHasQx($tid_global,1000214,1,$schoolid))) { ?>
	
	
	$(':checkbox[name="is_over[]"]').bootstrapSwitch();
	$(':checkbox[name="is_over[]"]').on('switchChange.bootstrapSwitch', function(e, state){
		var is_over = this.checked ? 2 : 1;
		var id = $(this).data('id');
		$.post("<?php  echo $this->createWebUrl('semester', array('op' => 'change_over','schoolid' => $schoolid))?>", {is_over: is_over, id: id}, function(resp){
			setTimeout(function(){
				//location.reload();
			}, 500)
		});
	});
	<?php  } ?>
});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>