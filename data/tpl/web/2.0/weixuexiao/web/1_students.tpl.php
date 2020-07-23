<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
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
.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
.max{width:100%;height:auto;}
.min{width:60px;height:auto;}
.hide{display:none}
.show{display:block}
</style>
    <div class="panel panel-info">
        <div class="panel-heading">学生管理</div>
        <div class="panel-body">
			<div class="form-group">
				<a class="btn btn-primary qx_702" href="<?php  echo $this->createWebUrl('students', array('op' => 'post', 'schoolid' => $schoolid))?>"><i class="fa fa-plus"></i> 添加学生</a>
				<a class="btn btn-success qx_703" href="javascript:;" onclick="$('.file-container').slideToggle();$('.file-container_bj').slideUp();">批量导入</a>
				<a class="btn btn-primary qx_702" href="<?php  echo $this->createWebUrl('students', array('op' => 'makecode', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认？');return false;">批量生成绑定码</a>
				<!-- <?php  if($_W['isfounder'] || $_W['role'] == 'owner') { ?><a class="btn btn-success" href="<?php  echo $this->createWebUrl('students', array('op' => 'deleteallstudents', 'schoolid' => $schoolid))?>" onclick="return confirm('您确定删除本校所有学生信息吗？此操作不可恢复，确认删除？');return false;">清空所有学生</a><?php  } ?> -->
				<a class="btn btn-primary qx_702" href="<?php  echo $this->createWebUrl('students', array('op' => 'fixavatar', 'schoolid' => $schoolid))?>" >修复头像</a>
				<!-- <?php  if($_W['isfounder']) { ?><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('students', array('op' => 'userinfo', 'schoolid' => $schoolid))?>" >整理用户</a><?php  } ?> -->
			</div>
            <div class="panel panel-default file-container" style="display:none;">
                <div class="panel-body">
                    <form id="form">
                        <input name="viewfile" id="viewfile" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
                        <a class="btn btn-primary"><label for="unload" style="margin: 0px;padding: 0px;">上传...</label></a>
                        <input type="file" class="pull-left btn-primary span3" name="file" id="unload" style="display: none;" onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';">
                        <a class="btn btn-primary" onclick="submits('input_stu','form');">导入数据</a>
        				<?php  if(keep_sk77()) { ?>
        				<a class="btn btn-info" href="../addons/weixuexiao/public/example/example_students_withsell.xls"><i class="fa fa-download"></i>下载导入模板</a>
        				<?php  } else { ?>
                        <a class="btn btn-info" href="../addons/weixuexiao/public/example/example_students.xls"><i class="fa fa-download"></i>下载导入模板</a>
        				<?php  } ?>
                    </form>
                </div>
        	</div>
        	
        	<div class="panel panel-default file-container_bj" style="display:none;">
                <div class="panel-body">
                    <form id="form_bj">
                        <input name="viewfile_bj" id="viewfile_bj" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
                        <a class="btn btn-primary"><label for="unload_bj" style="margin: 0px;padding: 0px;">上传...</label></a>
                        <input type="file" class="pull-left btn-primary span3" name="file1" id="unload_bj" style="display: none;" onchange="document.getElementById('viewfile_bj').value=this.value;this.style.display='none';">
                        <a class="btn btn-primary" onclick="submits('input_stu_bj','form_bj');">导入数据</a>
                        <button form="DefaultForm" name="out_BjExcel" value="out_BjExcel" class="btn btn-info" ><i class="fa fa-download"></i>下载学生班级信息</b>
                    </form>
                </div>
            </div>				
				
            <!-- 打印学生二维码 -->
             <div class="panel-info">
                <div class="panel-heading"  style="padding-bottom: 20px;">打印学生二维码</div>
                <div class="panel-body">
                 <form  action="./index.php" method="get" class="form-horizontal" target="_blank" id="qrFrom" role="form">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="weixuexiao" />
                    <input type="hidden" name="do" value="qrlist" />
    				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
    				<input type="hidden" name="op" value="choose" />
                    <div class="form-group">
    					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">选择班级</label>
                        <div class="col-sm-2 col-lg-2">
                            <select style="margin-right:15px;" name="bj_id_choose" id="bj_id_choose" class="form-control">
                                <option value="">请选择班级</option>
                                <?php  if(is_array($allbj)) { foreach($allbj as $row) { ?>
                                <option value="<?php  echo $row['sid'];?>" ><?php  echo $row['sname'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <div class="col-sm-2 col-lg-2" style="margin-left:1%">
                            <a style="color:#fff" class="btn btn-success qx_705" onclick="GetOut();">条件打印二维码</a>
                        </div>
    					<div class="col-sm-2 col-lg-2">
                             <a class="btn btn-success qx_705" target="_blank" href="<?php  echo $this->createWebUrl('qrlist', array('op' => 'display', 'schoolid' => $schoolid))?>">打印所有二维码</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            
            
            <div class="panel-info">
            <div class="panel-heading" style="margin-bottom: 20px;">学生筛选</div>
            <form action="./index.php" method="get" class="form-horizontal" role="form" id="DefaultForm">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="students" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">关键字</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>
					<?php  if($schooltype) { ?>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按课程</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="kc_id" id="kc_id" class="form-control">
                            <option value="">请选择课程搜索</option>
							<?php  if(is_array($allkclist)) { foreach($allkclist as $row) { ?>
							<option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['kc_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
							<?php  } } ?>
                        </select>
                    </div>
					<?php  } else { ?>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按<?php echo NJNAME;?></label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="nj_id" id="xq" class="form-control">
                            <option value="">请选择<?php echo NJNAME;?>搜索</option>
                            <?php  if(is_array($xueqi)) { foreach($xueqi as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['nj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按班级</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="bj_id" id="bj_select" class="form-control">
                            <option value="">请选择班级搜索</option>
                            <?php  if(is_array($allbj)) { foreach($allbj as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<?php  } ?>
				</div>
                <div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按绑定</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="bd_type" class="form-control">
                            <option value="">按绑定状态</option>
							<option value="1" <?php  if($_GPC['bd_type'] == 1) { ?> selected="selected"<?php  } ?>>已绑定</option>
							<option value="2" <?php  if($_GPC['bd_type'] == 2) { ?> selected="selected"<?php  } ?>>未绑定</option>
                        </select>
                    </div>
					<?php  if(!$schooltype) { ?>
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按类型</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="s_type" class="form-control">
							<option value="">按学生类型</option>
							<option value="1" <?php  if($_GPC['s_type'] == 1) { ?> selected="selected"<?php  } ?>>走读</option>
							<option value="2" <?php  if($_GPC['s_type'] == 2) { ?> selected="selected"<?php  } ?>>住校</option>
							<option value="3" <?php  if($_GPC['s_type'] == 3) { ?> selected="selected"<?php  } ?>>半通</option>
                        </select>
                    </div>
					<?php  } ?>
                    <div class="col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-success qx_704" name="out_putcode" value="out_putcode"><i class="fa fa-download"></i>导出绑定信息</button> 
					</div>
					<?php  if(is_showpf()) { ?>
					<div class="col-sm-2 col-lg-2">
						<a class="btn btn-success qx_703" href="javascript:;" onclick="$('.file-container_bj').slideToggle();$('.file-container').slideUp();">批量修改班级</a>
					</div>
				
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-success" name="excel_stuinfocard" value="excel_stuinfocard"><i class="fa fa-download"></i>导出学生详细信息</button>
					</div>
					<?php  } ?>
                </div>
            </form>
            </div>

        
			<div class="alert we7-page-alert">
				<?php  if(empty($_GPC['bj_id']) && empty($_GPC['bd_type']) && empty($_GPC['nj_id'])) { ?>
				<p><i class="wi wi-info-sign"></i> 本校学生人数:<strong class="text-danger"><?php  echo $totalsss;?>个</strong></p>
				<?php  } else { ?>
				<p><i class="wi wi-info-sign"></i> 检索到学生人数:<strong class="text-danger"><?php  echo $total;?>个</strong></p>
				<?php  } ?>
			</div>
        </div>
    </div>
	<script type="text/javascript">
	function GetOut(){
 		var bj_id = $("#bj_id_choose").val();
 		if(bj_id== null || !bj_id){
			alert("请选择班级");
			return;
 		}
		document.forms.qrFrom.submit();
	};
	$(document).ready(function() {
		$("#xq").change(function() {
			var cityId = $("#xq option:selected").attr('value');
			var type = 1;
			changeGrade(cityId, type, function() {
			});
		});
	});
	function changeGrade(gradeId, type) {
		//alert(cityId);
		var schoolid = "<?php  echo $schoolid;?>";
		var classlevel = [];
		//获取班次
		$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getbjlist'))?>", {'gradeId': gradeId, 'schoolid': schoolid}, function(data) {
			data = JSON.parse(data);



			classlevel = data.bjlist;
			var htmls = '';
			htmls += '<option value="">请选择班级</option>';
			if (classlevel != '') {
				for (var i in classlevel) {
					htmls += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
				}
			}
			$('#bj_select').next().remove();
			$('#bj_select').html(htmls);
			$('#bj_select').niceSelect()
		});
	}
	</script>


	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/excel_input', TEMPLATE_INCLUDEPATH)) : (include template('public/excel_input', TEMPLATE_INCLUDEPATH));?>
    <div class="panel panel-default">
		<?php  if($schooltype) { ?>
        <div class="panel-heading" style="font-size:13px">
			<div class="pull-left we7-form">
				<input id="credit1" type="radio" <?php  if($_GPC['status'] == -1) { ?>checked="checked"<?php  } ?> onclick="changetype(-1)">
				<label for="credit1">全部</label>
				<input id="credit2" type="radio" <?php  if($_GPC['status'] == 0) { ?>checked="checked"<?php  } ?> onclick="changetype(0)">
				<label for="credit2">正式学员</label>
				<input id="credit3" type="radio" <?php  if($_GPC['status'] == 1) { ?>checked="checked"<?php  } ?> onclick="changetype(1)">
				<label for="credit3">临时学员</label>
				<script>
					changetype = function(type) {
						url = "<?php  echo $this->createWebUrl('students',array('op'=>'display','schoolid'=>$schoolid))?>"+"&status="+type
						location.href = url;
					}
				</script>
			</div>
		</div>
		<?php  } ?>	
        <div class="table-responsive panel-body">
        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
                    <th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th>
					<th style="width:5%">学号</th>
					<th style="width:5%">姓名</th>
					<th style="width:5%;">详情</th>
                    <?php  if($logo['is_stuewcode'] ==1) { ?>
					<th style="width:8%;">二维码</th>
					<?php  } ?>
					<th style="width:13%;"><?php  if(!$schooltype) { ?>班级/<?php  } ?>家庭地址</th>
					<?php  if(!$schooltype) { ?>
						<?php  if(is_showap() ) { ?>
						<th style="width:13%;">宿舍/楼栋</th>
						<?php  } ?>
					<?php  } ?>
					<?php  if(keep_sk77()) { ?>
					<th style="width:8%;">所属经纪人</th>
					<?php  } ?>
					<th style="width:6%;"></br>本人</th>
                    <th style="width:6%;"></br>母亲</th>
					<th style="width:6%;"></br>父亲</th>
					<th style="width:6%;"></br>其他家长</th>
                    <th style="width:7%;">报名时间</th>
                    <?php  if($_W['schooltype']) { ?>
                 	<th style="width:10%;">报名课程</th>
                 	<?php  } ?>
                    <th class="qx_706" style="width:5%;">录入成绩</th>
					<th style="width:3%;">绑定码</th>
					<?php  if(is_showpf()) { ?>
					<th style="width:3%;">资料卡</th>
					<?php  } ?>
					<th class="qx_e_d" style="text-align:right; width:8%;">操作</th>
				</tr>
			</thead>
			<tbody>

				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<?php  if(!empty($_GPC['bj_id'])) { ?>
					<tr>
                    <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
					<td>
                        <?php  echo $item['numberid'];?>
                    </td>
					<td>
                        <img style="width:50px;height:50px;border-radius:50%;" src="<?php  if(!empty($item['icon'])) { ?><?php  echo tomedia($item['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" width="50" style="border-radius: 3px;" /></br></br><?php  echo $item['s_name'];?>
						</br>
						<?php  if($item['s_type'] == 1) { ?>
						<span class="label label-success">走读</span>
						<?php  } else if($item['s_type'] == 2) { ?>
						<span class="label label-primary">住校</span>
						<?php  } else if($item['s_type'] == 3) { ?>
						<span class="label label-info">半通</span>
						<?php  } ?>
                    </td>
					<td>
					<?php  if($item['sex'] == 1) { ?><span class="label label-success">男</span><?php  } else { ?><span class="label label-success">女</span><?php  } ?><?php  if($item['birthdate']) { ?></br>
					<span class="label label-danger"><?php  echo (date('Y',TIMESTAMP) - date('Y',$item['birthdate']))?>岁</span></br>
					<span class="label label-warning"><?php  echo date('Y-m-d',$item['birthdate'])?></span><?php  } ?>
					<?php  echo $item['mobile'];?>
					</td>
					<?php  if($logo['is_stuewcode'] ==1) { ?>
					<td id="ewcode<?php  echo $item['id'];?>">
					<?php  if($item['img_qr']) { ?>
						<?php  if($item['overtime'] && $item['qrcid'] == $item['id']) { ?>
							<img class="min" onclick="img(<?php  echo $item['id'];?>)" id="img<?php  echo $item['id'];?>" src="<?php  echo tomedia($item['img_qr'])?>"/>
							<br><span id="sub<?php  echo $item['id'];?>" class="label label-warning"><?php  echo $item['subnum'];?>次扫描</span>
							<br><span id="day<?php  echo $item['id'];?>" class="label label-info"><?php  echo $item['restday'];?>天后失效</span>
						<?php  } else { ?>
							<span class="label label-danger">已过期</span></br></br>
							<a class="btn btn-default btn-sm qx_702"  title="重新生成二维码" id="recreatqr<?php  echo $item['id'];?>" onclick="recreate_qr(<?php  echo $item['id'];?>,<?php  echo $item['qrcode_id'];?>);">生成</i></a>
						<?php  } ?>
					<?php  } else { ?>
						<a class="btn btn-default btn-sm qx_702"  title="生成二维码" id="creatqr<?php  echo $item['id'];?>" onclick="creatqr(<?php  echo $item['id'];?>);">生成</i></a>
					<?php  } ?>
                    </td>
					<?php  } ?>
                    <td>
	                    <?php  if(!empty($item['allbj'])) { ?>
	                    <?php  if(is_array($item['allbj'])) { foreach($item['allbj'] as $bjitem) { ?>
	                    
                        <?php  if(!empty($category[$bjitem['xq_id']])) { ?><?php  echo $category[$bjitem['xq_id']]['sname'];?><?php  } ?>丨<?php  if(!empty($category[$bjitem['bj_id']])) { ?><?php  echo $category[$bjitem['bj_id']]['sname'];?><?php  } ?></br>
						<?php  } } ?>
						<?php  } else { ?>
						 <?php  if(!empty($category[$item['xq_id']])) { ?><?php  echo $category[$item['xq_id']]['sname'];?><?php  } ?>丨<?php  if(!empty($category[$item['bj_id']])) { ?><?php  echo $category[$item['bj_id']]['sname'];?><?php  } ?></br>
						 <?php  } ?>
                        </br>
						<?php  echo $item['area_addr'];?>
                    </td>
					<?php  if(!$schooltype) { ?>
						<?php  if(is_showap()) { ?>
						<td>
							<?php  echo $item['roomname'];?></br>
							<?php  echo $item['apname'];?>
						</td>
						<?php  } ?>
					<?php  } ?>
					<?php  if(keep_sk77()) { ?>
						<td>
							<?php  echo $item['sellteaname'];?>
						</td>
					<?php  } ?>
					<td>
					<?php  if(!empty($item['oavatar']) || !empty($item['ouserid'])) { ?>
					
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['oavatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['onickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['own'], 'op' => 'own', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
					</td>
                    <td>
					<?php  if(!empty($item['mavatar']) || !empty($item['muserid'])) { ?>
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['mavatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['mnickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['mom'], 'op' => 'mom', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
				    </td>
                    <td>
					<?php  if(!empty($item['davatar']) || !empty($item['duserid'])) { ?>
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['davatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['dnickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['dad'], 'op' => 'dad', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
				    </td>
                    <td>
					<?php  if(!empty($item['otheravatar']) || !empty($item['otheruserid'])) { ?>
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['otheravatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['othernickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['other'], 'op' => 'other', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
				    </td>					
					<td><?php  echo date('Y-m-d',$item['seffectivetime'])?></td>  
					<?php  if($_W['schooltype']) { ?>		
					<td>
					<?php  if(is_array($item['bmkc'])) { foreach($item['bmkc'] as $row) { ?>
						<?php  echo $row;?></br>
					<?php  } } ?>
					</td>	
					<?php  } ?>						
                    <td class="qx_706"><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'op' => 'add', 'schoolid' => $schoolid))?>" title="录入成绩"><i class="fa fa-qrcode">&nbsp;&nbsp;录入成绩</i></a></td>

					<td><?php  echo $item['code'];?></td>
					<?php  if(is_showpf()) { ?>
					 <td class="qx_709"><a class="btn btn-default btn-sm" onclick="show_order(<?php  echo $item['id'];?>)" title="修改资料卡"><i class="fa fa-qrcode">&nbsp;&nbsp;修改资料卡</i></a></td>
					<?php  } ?>
					<td class="qx_e_d" style="text-align:right;">
						<a class="btn btn-default btn-sm qx_702" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'op' => 'post', 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_708" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				
				<?php  } else if((($item['keyid'] == 0 || $item['keyid'] == $item['id'])) ) { ?>
				<tr>
                    <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
					<td>
                        <?php  echo $item['numberid'];?>
                    </td>
					<td>
                        <img style="width:50px;height:50px;border-radius:50%;" src="<?php  if(!empty($item['icon'])) { ?><?php  echo tomedia($item['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" width="50" style="border-radius: 3px;" /></br></br><?php  echo $item['s_name'];?>
						<?php  if($item['s_type'] == 1) { ?>
						<span class="label label-success">走读</span>
						<?php  } else if($item['s_type'] == 2) { ?>
						<span class="label label-primary">住校</span>
						<?php  } else if($item['s_type'] == 3) { ?>
						<span class="label label-info">半通</span>
						<?php  } ?>
                    </td>	
					<td>
					<?php  if($item['sex'] == 1) { ?><span class="label label-success">男</span><?php  } else { ?><span class="label label-success">女</span><?php  } ?><?php  if($item['birthdate']) { ?></br>
					<span class="label label-danger"><?php  echo (date('Y',TIMESTAMP) - date('Y',$item['birthdate']))?>岁</span></br>
					<span class="label label-warning"><?php  echo date('Y-m-d',$item['birthdate'])?></span><?php  } ?>
					<?php  echo $item['mobile'];?>
					</td>
					<?php  if($logo['is_stuewcode'] ==1) { ?>
					<td id="ewcode<?php  echo $item['id'];?>">
					<?php  if($item['img_qr']) { ?>
						<?php  if($item['overtime'] && $item['qrcid'] == $item['id']) { ?>
							<img class="min" onclick="img(<?php  echo $item['id'];?>)" id="img<?php  echo $item['id'];?>" src="<?php  echo tomedia($item['img_qr'])?>"/>
							<br><span id="sub<?php  echo $item['id'];?>" class="label label-warning"><?php  echo $item['subnum'];?>次扫描</span>
							<br><span id="day<?php  echo $item['id'];?>" class="label label-info"><?php  echo $item['restday'];?>天后失效</span>
						<?php  } else { ?>
							<span class="label label-danger">已过期</span></br></br>
							<a class="btn btn-default btn-sm qx_702"  title="重新生成二维码" id="recreatqr{$item['id'],}" onclick="recreate_qr(<?php  echo $item['id'];?>,<?php  echo $item['qrcode_id'];?>);">重新生成</i></a>
						<?php  } ?>
					<?php  } else { ?>
						<a class="btn btn-default btn-sm qx_702"  title="生成二维码" id="creatqr<?php  echo $item['id'];?>" onclick="creatqr(<?php  echo $item['id'];?>);">生成</i></a>
					<?php  } ?>
                    </td>
					<?php  } ?>
                    <td>
					<?php  if(!$schooltype) { ?>
	                    <?php  if(!empty($item['allbj'])) { ?>
	                    <?php  if(is_array($item['allbj'])) { foreach($item['allbj'] as $bjitem) { ?>
	                    
                        <?php  if(!empty($category[$bjitem['xq_id']])) { ?><?php  echo $category[$bjitem['xq_id']]['sname'];?><?php  } ?>丨<?php  if(!empty($category[$bjitem['bj_id']])) { ?><?php  echo $category[$bjitem['bj_id']]['sname'];?><?php  } ?></br>
						<?php  } } ?>
						<?php  } else { ?>
						 <?php  if(!empty($category[$item['xq_id']])) { ?><?php  echo $category[$item['xq_id']]['sname'];?><?php  } ?>丨<?php  if(!empty($category[$item['bj_id']])) { ?><?php  echo $category[$item['bj_id']]['sname'];?><?php  } ?></br>
						 <?php  } ?>
                        </br>
					<?php  } ?>	
						<?php  echo $item['area_addr'];?>
                    </td>
					<?php  if(!$schooltype) { ?>
						<?php  if(is_showap()) { ?>
						<td>
							<?php  echo $item['roomname'];?></br>
							<?php  echo $item['apname'];?>
						</td>
						<?php  } ?>
					<?php  } ?>
					<?php  if(keep_sk77()) { ?>
					<td>
						<?php  echo $item['sellteaname'];?>
					</td>
					<?php  } ?>
                    <td>

					<?php  if(!empty($item['oavatar']) || !empty($item['ouserid'])) { ?>
					
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['oavatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['onickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['own'], 'op' => 'own', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
					</td>
                    <td>
					<?php  if(!empty($item['mavatar']) || !empty($item['muserid'])) { ?>
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['mavatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['mnickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['mom'], 'op' => 'mom', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
				    </td>
                    <td>
					<?php  if(!empty($item['davatar']) || !empty($item['duserid'])) { ?>
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['davatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['dnickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['dad'], 'op' => 'dad', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
				    </td>
                    <td>
					<?php  if(!empty($item['otheravatar']) || !empty($item['otheruserid'])) { ?>
                     <img style="width:50px;height:50px;border-radius:50%;" src="<?php  echo tomedia($item['otheravatar'])?>" width="50"  onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /></br><?php  echo $item['othernickname'];?></br>
					 <a class="btn btn-default btn-sm qx_707" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'openid' => $item['other'], 'op' => 'other', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认解绑？');return false;" title="解绑"><i class="fa fa-times"></i>&nbsp;解绑</a>
                    <?php  } ?>
				    </td>					
					<td><?php  echo date('Y-m-d',$item['seffectivetime'])?></td>  	
					<?php  if($_W['schooltype']) { ?>		
					<td>
					<?php  if(is_array($item['bmkc'])) { foreach($item['bmkc'] as $row) { ?>
						<?php  echo $row;?></br>
					<?php  } } ?>
					</td>	
					<?php  } ?>			
                    <td><a class="btn btn-default btn-sm qx_706" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'op' => 'add', 'schoolid' => $schoolid))?>" title="录入成绩"><i class="fa fa-qrcode">&nbsp;&nbsp;录入成绩</i></a></td>
					<td><?php  echo $item['code'];?></td>
					<?php  if(is_showpf()) { ?>
					<td class="qx_709"><a class="btn btn-default btn-sm" onclick="show_order(<?php  echo $item['id'];?>)" title="修改资料卡"><i class="fa fa-qrcode">&nbsp;&nbsp;修改资料卡</i></a></td>
					<?php  } ?>
					<td class="qx_e_d" style="text-align:right;">
						<a class="btn btn-default btn-sm qx_702" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'op' => 'post', 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_708" href="<?php  echo $this->createWebUrl('students', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } ?>
				<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <?php  if(!$schooltype) { ?>
					<div class="col-sm-2 col-lg-2" style="width:14%">
                        <select id="bj_ids" class="form-control">
                            <option value="0">选择班级</option>
                            <?php  if(is_array($allbj)) { foreach($allbj as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
					<?php  } ?>	
					<?php  if(!$schooltype) { ?><input type="button" class="btn btn-primary" name="change_bj" value="批量转移班级" /><?php  } ?>
					<?php  if($logo['is_stuewcode'] ==1) { ?><input type="button" class="btn btn-primary" name="add_qr" id="add_qr" value="批量生成二维码" /><?php  } ?>
                    <input type="button" class="btn btn-primary qx_708" name="btndeleteall" value="批量删除" />					
				</td>
			</tr>
		</table>
        <?php  echo $pager;?>
    </form>
        </div>
    </div>
</div>

<style>
.cardtr{line-height:30px}
.cardth{text-align:center}



</style>


<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form  id="stu_infocard_form" method="post" class="form-horizontal form" >
		<div class="modal-content"id="table_this">


		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
function img(id){
	$("#img"+id).toggleClass('min');
	$("#img"+id).toggleClass('max');
	$("#sub"+id).toggle();
	$("#day"+id).toggle();
}


		function change_infocard(sid) {
			var form = new FormData(document.getElementById("stu_infocard_form"));
			$.ajax({
				url: "<?php  echo $this->createWebUrl('students', array('op' => 'change_cardinfo', 'schoolid' => $schoolid))?>",
				type: "post",
				data: form,
				processData: false,
				contentType: false,
				success: function(result) {
				var obj = jQuery.parseJSON(result);
				console.log(obj);
					alert(obj.msg);
					if(obj.status == true){
						$("#close_modal").trigger('click');
					}

				},
				error: function(e) {
					alert('访问网络失败');
				}
			});
		}




function recreate_qr(id,qrid){
	var id = id;
	var qrid = qrid;
	$("#recreatqr"+id).hide();
	$.post("<?php  echo $this->createWebUrl('indexajax', array('op' => 'reget_user_qr'))?>",{id:id,qrid:qrid,schoolid:'<?php  echo $schoolid;?>'}, function(data){
		if(data.result){
			var html = '<img class="min" onclick="img('+ id+ ')" id="img'+ id+ '" src="'+data['qrimg']+'" width="60px">';	
			$("#ewcode"+id).empty();				
			$("#ewcode"+id).append(html);	
		}else{
			$("#recreatqr"+id).show();
			alert(data.msg);	
		}
	},'json');
}
function creatqr(id){
	 var id = id;
	 $("#creatqr"+id).hide();	
	$.post("<?php  echo $this->createWebUrl('indexajax', array('op' => 'get_user_qr'))?>",{id:id,schoolid:'<?php  echo $schoolid;?>'}, function(data){
		if(data.result){
			var html = '<img class="min" onclick="img('+ id+ ')" id="img'+ id+ '" src="'+data['qrimg']+'" width="60px">';	
			$("#ewcode"+id).empty();				
			$("#ewcode"+id).append(html);	
		}else{
			$("#creatqr"+id).show();
			alert(data.msg);	
		}
	},'json');	 
}

function show_order(id){
	$.post("<?php  echo $this->createWebUrl('students', array('op' => 'get_infocard'))?>",{id:id,schoolid:'<?php  echo $schoolid;?>'}, function(data){
	$('#table_this').html(data);
	},'html');
	$('#Modal1').modal('toggle');
}


$(function(){
	var e_d = 2 ;
	<?php  if(!(IsHasQx($tid_global,1000702,1,$schoolid))) { ?>
		$(".qx_702").hide();
		e_d = e_d -1;
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000703,1,$schoolid))) { ?>
		$(".qx_703").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000704,1,$schoolid))) { ?>
		$(".qx_704").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000705,1,$schoolid))) { ?>
		$(".qx_705").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000706,1,$schoolid))) { ?>
		$(".qx_706").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000707,1,$schoolid))) { ?>
		$(".qx_707").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000709,1,$schoolid))) { ?>
		$(".qx_709").hide();
	<?php  } ?>
	<?php  if(!(IsHasQx($tid_global,1000708,1,$schoolid))) { ?>
		$(".qx_708").hide();
		e_d = e_d -1;
	<?php  } ?>
	if(e_d == 0){
		$(".qx_e_d").hide();
	}
	
    $(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        $("input[type=checkbox]").attr("checked",checked);
    });
    $("input[name=add_bj]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择学生!');
            return false;
        }
		var bj_id = $("#bj_ids").val();
		if(bj_id == null || bj_id == 0 || bj_id == ""){
			alert('请选择要转移到的班级!');
			return false;
		}
        if(confirm("确认要选择的学生转班?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('students', array('op' => 'add_bj', 'schoolid' => $schoolid))?>";
            $.post(
                url,
                {idArr:id,bj_id:bj_id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json'
            );
        }
    });
    $("input[name=change_bj]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择学生!');
            return false;
        }
		var bj_id = $("#bj_ids").val();
		if(bj_id == null || bj_id == 0 || bj_id == ""){
			alert('请选择要转移到的班级!');
			return false;
		}
        if(confirm("确认要选择的学生转班?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('students', array('op' => 'change_bj', 'schoolid' => $schoolid))?>";
            $.post(
                url,
                {idArr:id,bj_id:bj_id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json'
            );
        }
    });
    $("input[name=btndeleteall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要删除的学生!');
            return false;
        }
        if(confirm("确认要删除选择的学生?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('students', array('op' => 'deleteall', 'schoolid' => $schoolid))?>";
            $.post(
                url,
                {idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json'
            );
        }
    });
    $("input[name=add_qr]").click(function(){
		$("#add_qr").hide();
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择学生!');
            return false;
        }
        if(confirm("二维码批量生成过程中，请勿执行任何操作，否则会失败？")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('students', array('op' => 'makeallqr', 'schoolid' => $schoolid))?>";
            $.post(
                url,
                {idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
						$("#add_qr").show();
                        alert(data.msg);
                    }
                },'json'
            );
        }
    });
});
</script>
<?php  } else if($operation == 'post') { ?>
<div class="panel panel-info">
   <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回</a></div>
</div>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />	
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑学生信息
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学生姓名</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="s_name" class="form-control" value="<?php  echo $item['s_name'];?>" />
                        </div>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">学号</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="numberid" class="form-control" value="<?php  echo $item['numberid'];?>" />
                        </div>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">绑定码</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="code" class="form-control" value="<?php  echo $item['code'];?>" />
                        </div>
                    </div>
                </div>					
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">头像</label>
                    <div class="col-sm-9">					 
                        <?php  echo tpl_form_field_image('icon', $item['icon'])?>		
                        <span class="help-block"></span>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">选择性别</label>
                    <div class="col-sm-9">
                        <label for="isshow1" class="radio-inline"><input type="radio" name="sex" value="1" id="isshow1" <?php  if(empty($item) || $item['sex'] == 1) { ?>checked="true"<?php  } ?> /> 男</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow2" class="radio-inline"><input type="radio" name="sex" value="0" id="isshow2"  <?php  if(!empty($item) && $item['sex'] == 0) { ?>checked="true"<?php  } ?> /> 女</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--修改开始-->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
                    <div class="col-sm-9">
                        <label class="radio-inline"><input type="radio" name="s_type" value="1" <?php  if(empty($item) || $item['s_type'] == 1) { ?>checked="true"<?php  } ?> /> 走读</label>
                        &nbsp;&nbsp;&nbsp;
                        <label class="radio-inline"><input type="radio" name="s_type" value="2" <?php  if(!empty($item) && $item['s_type'] == 2) { ?>checked="true"<?php  } ?> /> 住校</label>
						&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline"><input type="radio" name="s_type" value="3" <?php  if(!empty($item) && $item['s_type'] == 3) { ?>checked="true"<?php  } ?> /> 半通</label>
                        <span class="help-block"></span>
                    </div>
				</div>
				<?php  if(is_showap()) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生余额</label>
					<div class="col-sm-2 col-lg-2" id="sxname">
						<input type="text" name="stu_chongzhi" class="form-control" value="<?php  echo $item['chongzhi'];?>"/>
					</div>
				</div>
				<?php  } ?>
				<?php  if(keep_sk77()) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">所属经纪人</label>
					<div class="col-sm-2 col-lg-2" id="sxname">
						<select name="jsid" id="jsid" class="form-control select" style="display:none">

						</select>
						<input type="text" placeholder="所属教师" class="form-control sxword" value="<?php  if($item['sellteaname']) { ?><?php  echo $item['sellteaname'];?><?php  } ?>"/>
					</div>
					<div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -31px;">
						<span class="btn btn-default" id="search_tname"><i class="fa fa-search"></i></span>
					</div>
					<div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -4px;">
						<span class="btn btn-default" style="background-color: #30d1e8"  data-toggle="tooltip" data-placement="bottom" title="重新筛选" data-delay='{"show":"700", "hide":"0"}' id="clear_tname"><i class="fa fa-refresh"></i></span>
					</div>
				</div>
				<?php  } ?>
                <!--修改结束-->
                <div id="custom-url">     
                <?php  if(!empty($id)) { ?>
					<input type="hidden" name="old" value="111" />
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择<?php echo NJNAME;?></label>
						<div  class="col-sm-2 col-lg-2 ">
							<select class="form-control" style="margin-right:15px;" name="xueqi" id="xueqi"     autocomplete="off" class="form-control">
								<option value="0">请选择<?php echo NJNAME;?></option>
								<?php  if(is_array($xueqi)) { foreach($xueqi as $it) { ?>
								<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['xq_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<div  class="col-sm-2 col-lg-2 ">
							<select class="form-control" style="margin-right:15px;" name="bj" id="bj"    autocomplete="off" class="form-control">
								<option value="0">请选择班级</option>
								<?php  if(is_array($bj)) { foreach($bj as $it) { ?>
								<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
								<?php  } } ?>
							</select>
						</div>
					</div>	
					 <?php  if(is_array($item['all'])) { foreach($item['all'] as $key => $itemhere) { ?>
						<div class="form-group">
							<input type="hidden" name="before[]" value="111" />
							<input type="hidden" name="sid_before[]" value="<?php  echo $itemhere['sid'];?>">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择<?php echo NJNAME;?></label>
							<div class="col-sm-2 col-lg-2 ">
								<select class="form-control" style="margin-right:15px;" name="xueqi_before[]" id="xueqi<?php  echo $key;?><?php  echo $key;?>" divid="<?php  echo $key;?><?php  echo $key;?>" onchange="ChangeBj(this)" autocomplete="off" class="form-control">'+
									<option value="0">请选择<?php echo NJNAME;?></option>
									<?php  if(is_array($xueqi)) { foreach($xueqi as $it) { ?>
													<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $itemhere['xq_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
													<?php  } } ?>
								</select>
								</div>
								<div class="col-sm-2 col-lg-2">
									<select class="form-control" style="margin-right:15px;" name="bj_before[]" id="bj<?php  echo $key;?><?php  echo $key;?>" divid="<?php  echo $key;?><?php  echo $key;?>"    autocomplete="off" class="form-control">'+
								   <option value="0">请选择班级</option>
								   <?php  if(is_array($bj)) { foreach($bj as $it) { ?>
													<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $itemhere['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
													<?php  } } ?>
							   </select>
								</div>
							<div class="col-sm-1" style="margin-top:5px">
							<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i></a>
							</div>
						</div>
					  <?php  } } ?>              	
                <?php  } else { ?>
                	<input type="hidden" name="old" value="111" />
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择<?php echo NJNAME;?></label>
						<div  class="col-sm-2 col-lg-2">
							<select class="form-control" style="margin-right:15px;" name="xueqi" id="xueqi"     autocomplete="off" class="form-control">
								<option value="0">请选择<?php echo NJNAME;?></option>
								<?php  if(is_array($xueqi)) { foreach($xueqi as $it) { ?>
								<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['xq_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<div  class="col-sm-2 col-lg-2 "style="width:20%">
							<select class="form-control" style="margin-right:15px;" name="bj" id="bj"    autocomplete="off" class="form-control">
								<option value="0">请选择班级</option>
								<?php  if(is_array($bj)) { foreach($bj as $it) { ?>
								<option value="<?php  echo $it['sid'];?>" <?php  if($it['sid'] == $item['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
								<?php  } } ?>
							</select>
						</div>
					</div>	
				<?php  } ?>
				</div>	
				<!-- <div class="clearfix template">  -->
					<!-- <div class="form-group"> -->
						<!-- <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label> -->
						<!-- <div class="col-sm-9 col-xs-12"> -->
							<!-- <a href="javascript:;" id="custom-url-add"><i class="fa fa-plus-circle"></i> 添加班级</a> -->
						<!-- </div> -->
					<!-- </div>	 -->
				<!-- </div> -->
				<div class="form-group">
                   <label class="col-xs-12 col-sm-3 col-md-2 control-label">出生日期</label>
                   <div class="col-sm-9">
                 <?php  echo tpl_form_field_date('birthdate', date('Y-m-d', $item['birthdate']))?>				   
                   </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">固定电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="tel" class="form-control" value="<?php  echo $item['homephone'];?>" />
                    </div>
                </div>				
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号码</label>
                    <div class="col-sm-9">
                        <input type="text" name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">家庭地址</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="addr" value="<?php  echo $item['area_addr'];?>" />
                    </div>
                </div>
				<div class="form-group">
                   <label class="col-xs-12 col-sm-3 col-md-2 control-label">入学日期</label>
                   <div class="col-sm-9">
                 <?php  if(!empty($item['seffectivetime'])) { ?><?php  echo tpl_form_field_date('seffectivetime', date('Y-m-d', $item['seffectivetime']))?><?php  } else { ?><?php  echo tpl_form_field_date('seffectivetime', date('Y-m-d', TIMESTAMP))?><?php  } ?>				 
                   </div>
                </div>
				<div class="form-group">
                   <label class="col-xs-12 col-sm-3 col-md-2 control-label">结束日期</label>
                   <div class="col-sm-9">
                <?php  if(!empty($item['stheendtime'])) { ?><?php  echo tpl_form_field_date('stheendtime', date('Y-m-d', $item['stheendtime']))?><?php  } else { ?><?php  echo tpl_form_field_date('stheendtime', date('Y-m-d', TIMESTAMP))?><?php  } ?>					 
                   </div>
                </div>				
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注信息</label>
                    <div class="col-sm-9">
                        <textarea style="height:150px;" class="form-control richtext" name="note" cols="70"><?php  echo $item['note'];?></textarea>
                        <span class="help-block"></span>
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
<script type="text/javascript">

	$(document).on('click', '#clear_tname', function(){
		var t = $(this).parents().children();
		var want = t.find('input[class*=sxword]');
		var selectdiv = t.find('select[class*=select]');

		want.show();
		want.val('');
		selectdiv.hide();

	});


	$(document).on('click', '#search_tname', function(){
		var t = $(this).parents().children();
		var want = t.find('input[class*=sxword]');
		var selectdiv = t.find('select[class*=select]');

		var tname = want.val();
		console.log(tname);
		want.hide();
		selectdiv.show();

		var schoolid = "<?php  echo $schoolid;?>";
		var classlevel = [];
		html1 += '<select id="schoolid"><option value="">请选择经纪人</option>';
		if(tname != ''){
			$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'GetSellTea'))?>", {'tname': tname,schoolid:schoolid}, function(data) {
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
					<?php  if(is_array($allselltea)) { foreach($allselltea as $it) { ?>
			'					<option value="<?php  echo $it['id'];?>"><?php  echo $it['tname'];?></option>'+
			<?php  } } ?>
			'';
			selectdiv.html(html1);
		}
		});




	var divid = 0;
	$('#custom-url-add').click(function(){
		divid++;
	var html =  '<div class="form-group">'+
				'<input type="hidden" name="new[]" value="111" />	'+
				'		<label class="col-sm-2" style="width:8%">选择<?php echo NJNAME;?></label>'+
				'		<div class="col-sm-2 col-lg-2 "style="width:20%">'+
				'			<select class="form-control" style="margin-right:15px;" name="xueqi_new[]" id="xueqi'+divid+'" divid="'+divid+'" onchange="ChangeBj(this)" autocomplete="off" class="form-control">'+
                           ' <option value="0">请选择<?php echo NJNAME;?></option>'+
                            <?php  if(is_array($xueqi)) { foreach($xueqi as $it) { ?>
                           ' <option value="<?php  echo $it['sid'];?>" ><?php  echo $it['sname'];?></option>'+
                            <?php  } } ?>
                       ' </select>'+
				'		</div>'+
				'		<label class="col-sm-2" style="width:10%"></label>'+
				'		<label class="col-sm-2" style="width:8%">选择班级</label>'+
				'		<div class="col-sm-2 col-lg-2" style="width:20%">'+
				'			<select class="form-control" style="margin-right:15px;" name="bj_new[]" id="bj'+divid+'" divid="'+divid+'"    autocomplete="off" class="form-control">'+
                           ' <option value="0">请选择班级</option>'+
                      '  </select>'+
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

$(document).ready(function() {
	
	
	$("#xueqi").change(function() {
		var type = 1;
		var cityId = $("#xueqi option:selected").attr('value');
		changeGrade(cityId,type, function() {
		});
	});	
});

function ChangeBj(e){
		var GetDivId = $(e).attr("divid");
		var type = 1;
		var XQId = $("#xueqi"+GetDivId+" option:selected").val(); 
		changeBjOp(XQId,GetDivId, function() {
		});
	}

function changeBjOp(gradeId, GetDivId, __result) {
	
	//$('#njidid').val(gradeId);
	
	var schoolid = "<?php  echo $schoolid;?>";
	var classlevel = [];
	//获取班次
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getbjlist'))?>", {'gradeId': gradeId, 'schoolid': schoolid}, function(data) {
		data = JSON.parse(data);
		classlevel = data.bjlist;
		var html = '';
		html += '<option value="">请选择班级</option>';		
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
			}
		}
		$('#bj'+GetDivId).next().remove();
		$('#bj'+GetDivId).html(html);
		$('#bj'+GetDivId).niceSelect()
	});

}
	
function changeGrade(gradeId, type, __result) {
	
	//$('#njidid').val(gradeId);

    let schoolid = "<?php  echo $schoolid;?>";
    let classlevel = [];
    //获取班次
	$.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getbjlist'))?>", {'gradeId': gradeId, 'schoolid': schoolid}, function(data) {
	
		data = JSON.parse(data);
		classlevel = data.bjlist;

        let html = '';
        html += '<option value="">请选择班级</option>';
		if (classlevel != '') {
			for (var i in classlevel) {
				html += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
			}
		}
		$('#bj').next().remove();
		$('#bj').html(html);
		$('#bj').niceSelect()	
	});

}
</script>
<?php  } else if($operation == 'add') { ?>
<div class="panel panel-info">
   <div class="panel-heading"><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('students', array('op' => 'display', 'schoolid' => $schoolid))?>"><i class="fa fa-tasks"></i> 返回</a></div>
</div>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="sid" value="<?php  echo $it['id'];?>" />
		<input type="hidden" name="bj" value="<?php  echo $item['bj_id'];?>" />
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
		<div class="panel panel-default">
			<div class="panel-heading">
				录入成绩
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">学生姓名:</label>
					<div class="col-sm-9" style="color:red;">
					   <?php  echo $item['s_name'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">所在班级:</label>
					<div class="col-sm-9" style="color:red;">                       
						 <?php  if(!empty($category[$item['xq_id']])) { ?><?php  echo $category[$item['xq_id']]['sname'];?><?php  } ?>-<?php  if(!empty($category[$item['bj_id']])) { ?><?php  echo $category[$item['bj_id']]['sname'];?><?php  } ?>
					</div>
				</div>					
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择期号</label>
					<div class="col-sm-9">
						<select class="form-control" style="margin-right:15px;" name="qh"     autocomplete="off" class="form-control">
							<option value="0">请选择期号</option>
							<?php  if(is_array($qh)) { foreach($qh as $it) { ?>
							<option value="<?php  echo $it['sid'];?>" <?php  if($row['sid'] == $it['qh']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>					
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择科目</label>
					<div class="col-sm-9">
						<select class="form-control" style="margin-right:15px;" name="km"     autocomplete="off" class="form-control">
							<option value="0">请选择科目</option>
							<?php  if(is_array($km)) { foreach($km as $it) { ?>
							<option value="<?php  echo $it['sid'];?>" <?php  if($row['sid'] == $it['km']) { ?> selected="selected"<?php  } ?>><?php  echo $it['sname'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>					
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">考试分数</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="score" class="form-control" value="<?php  echo $item['my_score'];?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">点评</label>
					<div class="col-sm-9">                       
						<input type="text" name="info" class="form-control" value="<?php  echo $item['my_score'];?>" />
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
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>