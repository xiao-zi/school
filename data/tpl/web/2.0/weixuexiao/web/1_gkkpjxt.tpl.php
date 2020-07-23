<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
<div class="panel panel-info">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' ||  (IsHasQx($tid_global,1000901,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kecheng') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kecheng', array('op' => 'display', 'schoolid' => $schoolid))?>">课程系统</a></li>
			<?php  } ?>
			<?php  if(($tid_global =='founder' || $tid_global == 'owner' || (IsHasQx($tid_global,1000921,1,$schoolid)))) { ?>
			<li <?php  if($_GPC['do']=='kcbiao') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display', 'schoolid' => $schoolid))?>">课时管理</a></li>
			<?php  } ?>
			<?php  if(($tid_global =='founder'|| $tid_global == 'owner' || (IsHasQx($tid_global,1000941,1,$schoolid))) ) { ?>
			<li <?php  if($_GPC['do']=='kcsign') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('kcsign', array('op' => 'display', 'schoolid' => $schoolid))?>">签到管理</a></li>
			<?php  } ?>
			<li class="active"><a href="<?php  echo $this->createWebUrl('gongkaike', array('op' => 'display', 'schoolid' => $schoolid))?>">公开课系统</a></li>
		</ul>	
	</div>
</div>
 <style>
.cLine {overflow: hidden; padding: 5px 0;color:#000000;}
.alert {padding: 8px 35px 0 10px;text-shadow: none;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);background-color: #f9edbe;border: 1px solid #f0c36d;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;color: #333333;margin-top: 5px;}
.alert p {margin: 0 0 10px;display: block;}
.alert .bold{font-weight:bold;}
 </style>


<?php  if($operation == 'setiocn') { ?>
<div class="panel panel-info">
   <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i>返回评价标准列表</a></div>
</div>

<div class="alert">
   
   <strong><font color="red">特别提醒: 超过三个等级以上的等级描述文字请在两个字以内，否则前端会溢出</font></strong>
    </p>
    </div>
<style>
.template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:150px;margin:0 20px 20px 0; overflow:hidden;}
.template .title{margin:5px auto;line-height:2em;}
.template .title a{text-decoration:none;}
.template .item img{width:100px;height:100px; cursor:pointer;}
.template .active.item-style img, .template .item-style:hover img{width:100px;height:100px;border:3px #009cd6 solid;padding:1px; }
.template .title .fa{display:none}
.template .active .fa.fa-check{display:inline-block;position:absolute;bottom:33px;right:6px;color:#FFF;background:#009CD6;padding:5px;font-size:14px;border-radius:0 0 6px 0;}
.template .fa.fa-times{cursor:pointer;display:inline-block;position:absolute;top:10px;right:6px;color:#D9534F;background:#ffffff;padding:5px;font-size:14px;text-decoration:none;}
.template .fa.fa-times:hover{color:red;}
.template .item-bg{width:100%; height:342px; background:#000; position:absolute; z-index:1; opacity:0.5; margin:-5px 0 0 -5px;}
.template .item-build-div1{position:absolute; z-index:2; margin:-5px 10px 0 5px; width:168px;}
.template .item-build-div2{text-align:center; line-height:30px; padding-top:150px;}
</style>
<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
	<div class="panel-heading">设置评价规则</div>
    <div class="clearfix template">        
		<div class="panel panel-default">  
			<div id="custom-url">
			<?php  if($item) { ?>
				<?php  if(is_array($item)) { foreach($item as $row) { ?>
				<div class="panel-body items" style="width:90%">
					<input type="hidden" name="thisid[]" value="<?php  echo $row['id'];?>" />
					<input type="hidden" name="old[]" value="11111" />
					<div class="item item-style" style="width:auto;">规则
						<div class="input-group">
							<span class="input-group-addon">标题</span>
							<input type="text" class="form-control" name="custom_title[]" value="<?php  echo $row['title'];?>">
						</div>
						<div class="input-group">
							<span class="input-group-addon">排序</span>
							<input type="text" class="form-control"  style="width:10%" name="custom_ssort[]" value="<?php  echo $row['ssort'];?>">
						</div>						
					</div>					
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级1</div>
									 <?php  echo tpl_form_field_image('custom_icon1[]',$row['icon1'])?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title1[]" placeholder="请输入等级文字描述，两个字最佳，否则前端会溢出"><?php  echo $row['icon1title'];?></textarea>
							 </div>
							<span class="fa fa-check"></span>  
					  </div>
					</div> 					
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级2</div>
									 <?php  echo tpl_form_field_image('custom_icon2[]',$row['icon2'])?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title2[]" placeholder="请输入等级文字描述"><?php  echo $row['icon2title'];?></textarea>
							 </div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级3</div>
									 <?php  echo tpl_form_field_image('custom_icon3[]',$row['icon3'])?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title3[]" placeholder="请输入等级文字描述"><?php  echo $row['icon3title'];?></textarea>
							 </div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>    
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级4</div>
									 <?php  echo tpl_form_field_image('custom_icon4[]',$row['icon4'])?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title4[]" placeholder="请输入等级文字描述"><?php  echo $row['icon4title'];?></textarea>
							 </div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级5</div>
									 <?php  echo tpl_form_field_image('custom_icon5[]',$row['icon5'])?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title5[]" placeholder="请输入等级文字描述"><?php  echo $row['icon5title'];?></textarea>
							 </div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>
					<div class="col-sm-1" style="margin-top:5px">
						<a  data-id = "<?php  echo $row['id'];?>" class="custom-url-del"><i class="fa fa-times-circle"></i> </a>
					</div>
			    </div>
				<?php  } } ?>	
			<?php  } else { ?>
				<div class="panel-body items" style="width:90%">
					<input type="hidden" name="c" value="site" />
					<div class="item item-style" style="width:auto;">规则
						<div class="input-group">
							<span class="input-group-addon">标题</span>
							<input type="text" class="form-control" name="custom_title-new[]" value="<?php  echo $url['title'];?>">
						</div>
						<div class="input-group">
							<span class="input-group-addon">排序</span>
							<input type="text" class="form-control"  style="width:10%" name="custom_ssort-new[]" value="<?php  echo $url['title'];?>">
						</div>						
					</div>					
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级1</div>
									 <?php  echo tpl_form_field_image('custom_icon1-new[]')?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title1-new[]" placeholder="请输入等级文字描述"></textarea>
							 </div>
							<span class="fa fa-check"></span>  
					  </div>
					</div> 					
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级2</div>
									 <?php  echo tpl_form_field_image('custom_icon2-new[]')?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title2-new[]" placeholder="请输入等级文字描述"></textarea></div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级3</div>
									 <?php  echo tpl_form_field_image('custom_icon3-new[]')?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title3-new[]" placeholder="请输入等级文字描述"></textarea></div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>    
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级4</div>
									 <?php  echo tpl_form_field_image('custom_icon4-new[]')?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title4-new[]" placeholder="请输入等级文字描述"></textarea></div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>
					<div class="item item-style">
					  <div class="title">
							 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级5</div>
									 <?php  echo tpl_form_field_image('custom_icon5-new[]')?>
							 <div style="overflow:hidden; height:48px;margin-top:2px;">
							   <textarea style="width:178px;" name="custom_title5-new[]" placeholder="请输入等级文字描述"></textarea></div>
							<span class="fa fa-check"></span>  
					  </div>
					</div>
					<div class="col-sm-1" style="margin-top:5px">
						<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i> </a>
					</div>				
			    </div>
			<?php  } ?>
			</div>
		</div>
	</div>	
	<div class="panel panel-default">  
		<div class="clearfix template"> 
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<a href="javascript:;" id="custom-url-add"><i class="fa fa-plus-circle"></i> 添加规则</a>
				</div>
			</div>	
		</div>	
	</div>
	<div class="form-group col-sm-12">
		<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
	</div>
</form>	
<script>
		$('#custom-url-add').click(function(){
			var html =  '<div class="panel-body">'+
						'	<input type="hidden" name="new[]" value="2222" />'+
						'	<div class="item item-style" style="width:auto;">规则'+
						'		<div class="input-group">'+
						'			<span class="input-group-addon">标题</span>'+
						'			<input type="text" class="form-control" name="custom_title-new[]" value="">'+
						'		</div>'+
						'		<div class="input-group">'+
						'			<span class="input-group-addon">排序</span>'+
						'			<input type="text" class="form-control" style="width:10%" name="custom_ssort-new[]" value="">'+
						'		</div>'+						
						'	</div>'+
						'	<div class="item item-style">'+
						'		<div class="title">'+
						'			 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级1</div>'+	 
						'				<div class="input-group ">'+
						'					<input type="text" name="custom_icon1-new[]" value="" class="form-control" autocomplete="off">'+
						'					<span class="input-group-btn">'+
						'						<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>'+
						'					</span>'+
						'				</div>'+
						'				<div class="input-group " style="margin-top:.5em;">'+
						'					<img src="./resource/images/nopic.jpg" ; this.title="图片未找到" class="img-responsive img-thumbnail"  width="150" />'+
						'					<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>'+
						'				</div>'+
						'				<div style="overflow:hidden; height:48px;margin-top:2px;">'+
						'					<textarea style="width:178px;" name="custom_title1-new[]" placeholder="请输入等级文字描述"></textarea>'+
						'				</div>'+
						'			<span class="fa fa-check"></span>'+
						'		</div>'+
						'	</div>'+						
						'	<div class="item item-style">'+
						'		<div class="title">'+
						'			 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级2</div>'+	 
						'				<div class="input-group ">'+
						'					<input type="text" name="custom_icon2-new[]" value="" class="form-control" autocomplete="off">'+
						'					<span class="input-group-btn">'+
						'						<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>'+
						'					</span>'+
						'				</div>'+
						'				<div class="input-group " style="margin-top:.5em;">'+
						'					<img src="./resource/images/nopic.jpg" ; this.title="图片未找到" class="img-responsive img-thumbnail"  width="150" />'+
						'					<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>'+
						'				</div>'+
						'				<div style="overflow:hidden; height:48px;margin-top:2px;">'+
						'					<textarea style="width:178px;" name="custom_title2-new[]" placeholder="请输入等级文字描述"></textarea>'+
						'				</div>'+
						'			<span class="fa fa-check"></span>'+
						'		</div>'+
						'	</div>'+
						'	<div class="item item-style">'+
						'		<div class="title">'+
						'			 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级3</div>'+	 
						'				<div class="input-group ">'+
						'					<input type="text" name="custom_icon3-new[]" value="" class="form-control" autocomplete="off">'+
						'					<span class="input-group-btn">'+
						'						<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>'+
						'					</span>'+
						'				</div>'+
						'				<div class="input-group " style="margin-top:.5em;">'+
						'					<img src="./resource/images/nopic.jpg" ; this.title="图片未找到" class="img-responsive img-thumbnail"  width="150" />'+
						'					<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>'+
						'				</div>'+
						'				<div style="overflow:hidden; height:48px;margin-top:2px;">'+
						'					<textarea style="width:178px;" name="custom_title3-new[]" placeholder="请输入等级文字描述"></textarea>'+
						'				</div>'+
						'			<span class="fa fa-check"></span>'+
						'		</div>'+
						'	</div>'+
						'	<div class="item item-style">'+
						'		<div class="title">'+
						'			 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级4</div>'+	 
						'				<div class="input-group ">'+
						'					<input type="text" name="custom_icon4-new[]" value="" class="form-control" autocomplete="off">'+
						'					<span class="input-group-btn">'+
						'						<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>'+
						'					</span>'+
						'				</div>'+
						'				<div class="input-group " style="margin-top:.5em;">'+
						'					<img src="./resource/images/nopic.jpg" ; this.title="图片未找到" class="img-responsive img-thumbnail"  width="150" />'+
						'					<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>'+
						'				</div>'+
						'				<div style="overflow:hidden; height:48px;margin-top:2px;">'+
						'					<textarea style="width:178px;" name="custom_title4-new[]" placeholder="请输入等级文字描述"></textarea>'+
						'				</div>'+
						'			<span class="fa fa-check"></span>'+
						'		</div>'+
						'	</div>'+
						'	<div class="item item-style">'+
						'		<div class="title">'+
						'			 <div style="overflow:hidden; height:28px;text-align:center;color:red;font-size:18px;">等级5</div>'+	 
						'				<div class="input-group ">'+
						'					<input type="text" name="custom_icon5-new[]" value="" class="form-control" autocomplete="off">'+
						'					<span class="input-group-btn">'+
						'						<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>'+
						'					</span>'+
						'				</div>'+
						'				<div class="input-group " style="margin-top:.5em;">'+
						'					<img src="./resource/images/nopic.jpg" ; this.title="图片未找到" class="img-responsive img-thumbnail"  width="150" />'+
						'					<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>'+
						'				</div>'+
						'				<div style="overflow:hidden; height:48px;margin-top:2px;">'+
						'					<textarea style="width:178px;" name="custom_title5-new[]" placeholder="请输入等级文字描述"></textarea>'+
						'				</div>'+
						'			<span class="fa fa-check"></span>'+
						'		</div>'+
						'	</div>'+
						'	<div class="col-sm-1" style="margin-top:5px">'+
						'   	<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i></a>'+
						'	</div>'+					
						'</div>';
					;
					
		
			$('#custom-url').append(html);
		});
		$(document).on('click', '.remind-reply-del, .comment-reply-del, .times-del, .custom-url-del', function(){
			var delid = $(this).attr("data-id");
			var is_con = 0 ;
			//alert(delid);
			if(delid)
			{
				del(delid);
			}
			
			return false;
		});
		function del(id) {
			var id = id;
			var truthBeTold = window.confirm('确认要删除已保存的评价规则吗 ?'); 
			var url = "<?php  echo $this->createWebUrl('gkkpjxt',array('op'=>'delitemiconset','schoolid' => $schoolid))?>";
			var submitData = {
					id:id,
					schoolid:"<?php  echo $schoolid;?>",
			};
			if (truthBeTold) {
				$.post(url, submitData, function(data) {
					if (data.result) {
						util.message('删除成功', '', 'success');
						is_con = 1 ;
						location.reload();
					}
				},'json');
			}
		}		
</script>
<?php  } else if($operation == 'display') { ?>
<div class="panel panel-info">
   <div class="panel-heading"><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('gongkaike',array('op'=>'display','schoolid'=> $schoolid))?>"><i class="fa fa-tasks"></i>返回公开课列表</a></div>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i>刷新</a>
			<a style="margin-left:40px;" class="btn btn-primary" href="<?php  echo $this->createWebUrl('gkkpjxt', array('op' => 'post', 'schoolid' => $schoolid))?>"><i class="fa fa-plus"></i>新增评价标准</a>
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
					     <th style="width:100px;">ID</th>
                        <th>名称</th>
                        <th >设置规则</th>
                        <th style="width:100px;">编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody id="level-list">
                    <?php  if(is_array($sclist)) { foreach($sclist as $row) { ?>
                    <tr>
					    <td><div class="type-parent"><?php  echo $row['ssort'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['id'];?></div></td>
                        <td><div class="type-parent"><?php  echo $row['title'];?></div></td>
                        <td><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('gkkpjxt', array('bzid' => $row['id'], 'op' => 'setiocn', 'schoolid' => $schoolid))?>" title="设置规则"><i class="fa fa-qrcode">&nbsp;&nbsp;设置规则</i></a></td>
                        <td style="text-align:right;"><a class="btn btn-default btn-sm " href="<?php  echo $this->createWebUrl('gkkpjxt', array('op' => 'post', 'id' => $row['id'], 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_958" href="<?php  echo $this->createWebUrl('gkkpjxt', array('op' => 'delete', 'id' => $row['id'], 'schoolid' => $schoolid))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php  } } ?>
                    <!--tr>
                        <td colspan="3">
                            <input name="submit" type="submit" class="btn btn-primary" value="批量更新排序">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </td>
                    </tr-->
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<script type="text/javascript">
	$(function(){
		<?php  if(!(IsHasQx($tid_global,1000958,1,$schoolid))) { ?>
			$(".qx_958").hide();
		<?php  } ?>
	});
	
</script>
<?php  } else if($operation == 'post') { ?>
<div class="panel panel-info">
   <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i>返回评价标准列表</a></div>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <!-- <input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" /> -->
        <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />		
        <div class="panel panel-default">
            <div class="panel-heading">
                创建评价标准
            </div>
            <div class="panel-body">                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
					<div class="input-group">
                        <input type="text" name="ssort" class="form-control" value="<?php  echo $item['ssort'];?>" />
                    </div>
					</div>
                </div>			
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">标准名称</label>
                    <div class="col-sm-9">
					<div class="input-group">
                        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" />
						<span class="help-block">建议4-8字</span>
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
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>