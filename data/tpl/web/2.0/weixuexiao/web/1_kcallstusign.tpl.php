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
	       <div class="panel-heading"><a class="btn btn-primary" href="<?php  echo $this->createWebUrl('kcbiao', array('op' => 'display', 'schoolid' => $schoolid))?>"><i class="fa fa-tasks"></i> 返回课时列表</a></div>
       
			
    </div>
     <div class="panel-heading">课时签到<?php  if(!empty($kecheng['name'])) { ?><span style="color:red;font-size:20px;font-weight:bold;">---<?php  echo $kecheng['name'];?>第<?php  echo $keshi['nub'];?>课时</span><?php  } ?></div>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					 <th class='with-checkbox' style="width: 10px;"><input type="checkbox" class="check_all" /></th>
					<th >学生</th>
					<th>是否签到</th>
					<th>签到时间</th>
					<th>是否确认</th>
					<th>确认老师</th>
					<th>剩余课时</th>
					<th class="qx_942" style="text-align:right; width:50px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['sid'];?>"></td>
					<td><?php  echo $item['s_name'];?></td>
				
					<td>
                        <?php  if(!empty($item['check'])) { ?>
                        <?php  if($item['status'] == 1 || $item['status'] == 2) { ?>
                        <span class="label label-success">已签到</span>
                        <?php  } else if($item['status'] == 3) { ?>
 						<span class="label label-primary">已请假</span>
                        <?php  } ?>
                        <?php  } else { ?>
                        <span class="label label-danger">未签到</span><?php  } ?>
                    </td>
                    <td>
                        <?php  if(!empty($item['signtime'])) { ?>
	                        <?php  if($item['status'] == 2) { ?>
	                        <span class="label label-success">
							<?php  } else if($item['status'] == 3) { ?>
							<span class="label label-primary">
							<?php  } ?>
	                    	<?php  echo date('Y年m月d日 H:i:s',$item['signtime'])?></span>
                        <?php  } else { ?><span class="label label-danger">未签到</span><?php  } ?>
                    </td>
                    <td>
	                    <?php  if(!empty($item['check'])) { ?>
                        <?php  if($item['status'] == 2 || $item['status'] == 3) { ?>
                        <span class="label label-warning">已确认</span>
                        <?php  } else { ?>
                        <span class="label label-default">未确认</span><?php  } ?>
                        <?php  } else if(empty($item['check'])) { ?>
                        <span class="label label-danger">未签到</span>
                        <?php  } ?>
                    </td>
                    <td>
                       <?php  if(!empty($item['check'])) { ?>
                        <?php  if(!empty($item['qrtea'])) { ?><span class="label label-warning"><?php  echo $item['qrtea'];?></span><?php  } else { ?><span class="label label-danger">无</span><?php  } ?>
                        <?php  } else if(empty($item['check'])) { ?>
                        <span class="label label-danger">未签到</span>
                        <?php  } ?>
                    </td>
                     <td>
                        <?php  if(!empty($item['buycourse'])) { ?> <span class="label label-info"><?php  echo $item['restnum'];?>课时</span><?php  } else { ?>无<?php  } ?>
                    </td>
					<td class="qx_942" style="text-align:right;">
					 	<?php  if($item['status'] != 2) { ?>
                        <a class="btn btn-default btn-sm qx_942"
                           href="<?php  echo $this->createWebUrl('kcallstusign', array('id' => $item['id'],'sid'=>$item['sid'],'kcid'=>$kcid1,'ksid'=>$ksid1, 'op' => 'sign', 'checkid' =>$item['check'],'schoolid' => $schoolid))?>"
                            onclick="return confirm('是否确认修改状态为已签到？');return false;"
                           title="已签到"><i class="fa fa-check-square"></i>
                        </a>
                        <?php  } ?>
                        <?php  if(!empty($item['status'])) { ?>
                        <a class="btn btn-default btn-sm qx_942"
                           href="<?php  echo $this->createWebUrl('kcallstusign', array('id' => $item['id'], 'sid'=>$item['sid'],'checkid' =>$item['check'],'kcid'=>$kcid1,'ksid'=>$ksid1, 'op' => 'unsign', 'schoolid' => $schoolid))?>"
                            onclick="return confirm('是否确认修改状态为未签到？');return false;"
                           title="未签到"><i class="fa fa-circle-o"></i>
                        </a>
                        <?php  } ?>
                        <?php  if($item['status'] != 3) { ?>
                        <a class="btn btn-default btn-sm qx_942"
                           href="<?php  echo $this->createWebUrl('kcallstusign', array('id' => $item['id'], 'sid'=>$item['sid'],'checkid' =>$item['check'],'kcid'=>$kcid1,'ksid'=>$ksid1,'op' => 'leave', 'schoolid' => $schoolid))?>"
                            onclick="return confirm('是否确认修改状态为已请假？');return false;"
                           title="已请假"><i class="fa fa-smile-o"></i>
                        </a>
                        <?php  } ?>
                      
					</td>			
					
				</tr>
				<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                    <input type="button" class="btn btn-primary qx_942" name="btnsignall" value="批量已签到" />
                     <input type="button" class="btn btn-primary qx_942" name="btnunsignall" value="批量未签到" />
                      <input type="button" class="btn btn-primary qx_942" name="btnleaveall" value="批量已请假" />
				</td>
			</tr>
		</table>
        <?php  echo $pager;?>
    </form>
        </div>
    </div>
</div>
<script type="text/javascript">
<!--
	var category = <?php  echo json_encode($children)?>;
//-->
$(function(){
		var e_r_d = 3 ;
	<?php  if(!(IsHasQx($tid_global,1000942,1,$schoolid))) { ?>
		$(".qx_942").hide();
	<?php  } ?>

	var checked = 0 ;
    $(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        console.log(checked);
        	$("input[type=checkbox]").attr("checked",checked);
       
    });

    $("input[name=btnsignall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要操作的学生!');
            return false;
        }
        if(confirm("确认要签到选择的学生?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('kcallstusign', array('kcid'=>$kcid1,'ksid'=>$ksid1,'op' => 'signall','schoolid' => $schoolid))?>";
            $.post(url,{idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');
        }
    });
    $("input[name=btnunsignall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要操作的学生!');
            return false;
        }
        if(confirm("确认批量未签到?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('kcallstusign', array('kcid'=>$kcid1,'ksid'=>$ksid1,'op' => 'unsignall','schoolid' => $schoolid))?>";
            $.post(url,{idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');
        }
    });

    $("input[name=btnleaveall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要操作的学生!');
            return false;
        }
        if(confirm("确认批量请假?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('kcallstusign', array('kcid'=>$kcid1,'ksid'=>$ksid1, 'op' => 'leaveall','schoolid' => $schoolid))?>";
            $.post(url,{idArr:id},
                function(data){
                    if(data.result){
					    alert(data.msg);
					    //console.log(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                },'json');
        }
    });

});
</script>
<script type="text/javascript">
    <!--
    var category = <?php  echo json_encode($children)?>;
    //-->
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>