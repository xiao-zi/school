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

        .pard3{
            padding: 0 3px;
    border-radius: 5px;
    color: white;
    font-size: 90%;
        }
        
	.form-control-excel { height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075); -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s; -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; }
	.schooltip { position: absolute; background-color: #eee; border: 1px solid #999; width: 350px; height: auto; -webkit-border-radius: 8px; font-family: "微软雅黑"; padding: 20px; z-index:2050;display: none }

    </style>
    <div class="panel panel-info">
        <div class="panel-heading">特别提醒学生</div>
        <div class="panel ">
            <div class="panel-heading">
                <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('kecheng', array('schoolid' => $schoolid))?>"><i class="fa fa-tasks"></i> 返回课程列表</a>
            </div>
        </div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site">
                <input type="hidden" name="a" value="entry">
                <input type="hidden" name="m" value="weixuexiao">
                <input type="hidden" name="do" value="remind"/>
                <input type="hidden" name="op" value="display"/>
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <input type="hidden" name="over_status" value="<?php  echo $_GPC['over_status'];?>"/>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label">状态</label>
                    <div class="col-sm-9 col-xs-9 col-md-9">
                        <div class="btn-group">
                            <a href="<?php  echo $this->createWebUrl('remind', array('over_status' => '-1', 'schoolid' => $schoolid,'kcid'=>$kcid))?>" class="btn <?php  if($over_status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
                            <a href="<?php  echo $this->createWebUrl('remind', array('over_status' => '1', 'schoolid' => $schoolid,'kcid'=>$kcid))?>" class="btn <?php  if($over_status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">课时不足</a>
                            <a href="<?php  echo $this->createWebUrl('remind', array('over_status' => '2', 'schoolid' => $schoolid,'kcid'=>$kcid))?>" class="btn <?php  if($over_status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">持续未到</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label" >请选择课程</label>
					<div class="col-sm-2 col-lg-2">
						<select style="margin-right:15px;" name="kcid" class="form-control">
							<?php  if(is_array($kcall)) { foreach($kcall as $row) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['kcid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
                </div>
                <div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">选择时间</label>
					<div class="col-sm-2 col-lg-2">
					<?php  if($nowtime) { ?><?php  echo tpl_form_field_date('createtime', date('Y-m-d', $nowtime));?><?php  } else { ?><?php  echo tpl_form_field_date('createtime', date('Y-m-d', TIMESTAMP))?><?php  } ?>
					<!-- <label class="col-xs-12 col-sm-3 col-md-12 control-label label label-primary">仅限持续未到使用</label> -->
					</div>
					<div class="col-sm-2 col-lg-2" style="margin-left:50px">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>	
					<div class="col-sm-2 col-lg-2">
						<button class="btn btn-success qx_2102" name="out_putcode" value="out_putcode"><i class="fa fa-download"></i>导出至EXECL</button>
					</div>
				</div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <table class="table table-hover">
                    <thead class="navbar-inner">
                        <tr>
                            <th style="width:15%">课程</th>
                            <th style="width:10%;">学生</th>
                            <th style="width:8%;">联系方式</th>
                            <th style="width:8%;">剩余课时</th>
                            <th style="width:8%;">上次签到时间</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            <?php  echo $item['kcname'];?>
                        </td>
                        <td>
                            <div><span class="show_yulan_img" style="border-radius: 5px;padding: 3px 5px;background-color: rgb(0, 159, 233);color:white"><?php  echo $item['s_name'];?></span> </div>
                            <div class="schooltip" style="padding:10px 10px;background-color:#1b1a1ab8;width:auto;max-width: 120px;color:white;">
                            <?php  if(is_array($item['userinfo'])) { foreach($item['userinfo'] as $item1) { ?>
                                <?php  echo $item1;?>
                            <?php  } } ?>
                            </div>
                        </td>
                        <td>
                            <?php  echo $item['mobile'];?>
                        </td>
                        <td>
                            <span class="label label-info"><?php  echo $item['restnum'];?>课时</span>
                        </td>
                        <td>
                           <?php  echo $item['nearkcsign'];?> 
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
                <?php  echo $pager;?>
            </form>
        </div>
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>
<script>
$(function(){
    var x = -190;
    var y = -60;
    $(".show_yulan_img").mouseover(function (e) {
        let NeedShow = $(this).parent().next();
        $(NeedShow).show();
        console.log(e.pageY);
        $(NeedShow).css({"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px"}).show("fast");
    }).mouseout(function (e) {
        let NeedShow = $(this).parent().next();
        $(NeedShow).hide();
    }).mousemove(function (e) {
        let NeedShow = $(this).parent().next();
        $(NeedShow).css({"top": (e.pageY + y) + "px","left": (e.pageX + x) + "px"});	
    });
})

</script>