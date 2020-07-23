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
    </style>
    <div class="panel panel-info">
        <div class="panel-heading">评分管理</div>
        <div class="panel-body">
            <form action="./index.php" method="get"  class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="bjscore" />
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <div class="form-group ">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按<?php echo NJNAME;?></label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="nj_id" id="xq" class="form-control">
                            <option value="">请选择<?php echo NJNAME;?>搜索</option>
                            <?php  if(is_array($nj)) { foreach($nj as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['nj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">按班级</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="bj_id" id="bj" class="form-control">
                            <option value="">请选择班级搜索</option>
                            <?php  if(is_array($bj)) { foreach($bj as $row) { ?>
                            <option value="<?php  echo $row['sid'];?>" <?php  if($row['sid'] == $_GPC['bj_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">按评分时间</label>
                    <div class="col-sm-2 col-lg-2">
                        <?php  echo tpl_form_field_daterange('scoretime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
                    </div>
                    <div class="col-sm-2 col-lg-2" style="margin-left:55px">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                    <div class="col-sm-2 col-lg-2">
                        <a class="btn btn-success qx_4105" onclick="$('#download_list').slideToggle();$('#upload_list').slideUp();"  ><i class="fa fa-download">&nbsp;&nbsp;导出评分</i></a>
                    </div>
                    <div class="col-sm-2 col-lg-2">
                        <a class="btn btn-success qx_4104" href="javascript:;" onclick="$('#upload_list').slideToggle();$('#download_list').slideUp();"><i class="fa fa-upload">&nbsp;&nbsp;批量导入评分</i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default file-container" style="display:none;" id="download_list">
        <div class="panel-body">
            <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="leadExcel" value="true">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="bjscore" />
                <input type="hidden" name="op" value="out_list" />
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <input type="hidden" name="fromtid" value="<?php  echo $tid_global;?>" />
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">选择导出时间</label>
                <div class="col-sm-2 col-lg-2" >
                    <?php  echo tpl_form_field_date('out_scoretime',0);?>
                </div>
                <div class="col-sm-2 col-lg-2" style="margin-left:55px">
                    <button class="btn btn-primary" >导出</button>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default file-container" style="display:none;" id="upload_list">
        <div class="panel-body">
            <form id="form">
                <input type="hidden" id="fromtid" value="<?php  echo $tid_global;?>">
                <input name="viewfile" id="viewfile" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
                <a class="btn btn-warning"><label for="unload" style="margin: 0px;padding: 0px;">上传...</label></a>
                <input type="file" class="pull-left btn-primary span3" name="file" id="unload" style="display: none;"
                       onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';">
                <a class="btn btn-danger" onclick="submits('input_bjpf','form');">导入数据</a>
                <a class="btn btn-info" href="../addons/weixuexiao/public/example/example_bjscore.xls"><i class="fa fa-download"></i>下载导入模板</a>
            </form>
        </div>
    </div>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/excel_input', TEMPLATE_INCLUDEPATH)) : (include template('public/excel_input', TEMPLATE_INCLUDEPATH));?>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <form action="" method="get" class="form-horizontal form" enctype="multipart/form-data">
                <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <table class="table table-hover">
                    <thead class="navbar-inner">
                        <tr>
                            <th class='with-checkbox' style="width: 3%;"><input type="checkbox" class="check_all" /></th>
                            <th style="width:8%;">班级</th>
                            <th style="width:8%;">年级</th>
                            <th style="width:8%;text-align: center">得分</th>
                            <th style="width:8%;">评分时间</th>
                            <th style="width:7%;text-align: center">周总分</th>
                            <th style="width:7%;text-align: center">周排名</th>
                            <th style="width:8%;text-align: center">月总分</th>
                            <th style="width:6%;text-align: center">月排名</th>
                            <th style="width:8%;text-align: center">学期总分</th>
                            <th style="width:8%;text-align: center">学期排名</th>
                            <th style="width:8%;text-align: center">所属学期</th>
                            <th class="qx_e_d" style="text-align:right; width:8%;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                        <tr>
                            <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
                            <td>
                                <?php  echo $item['bj_name'];?>
                            </td>
                            <td>
                                <?php  echo $item['nj_name'];?>
                            </td>
                            <td style="color:#f00;text-align: center"><?php  echo $item['score'];?>&nbsp;分</td>
                            <td>
                                <span class="label label-info"><?php  echo date("Y-m-d",$item['scoretime'])?></span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-info"><?php  echo $item['week_score'];?>  </span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-info"><?php  echo $item['week_rank'];?>  </span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-info"><?php  echo $item['month_score'];?>  </span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-info"><?php  echo $item['month_rank'];?>  </span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-info"><?php  echo $item['xueqi_score'];?>  </span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-info"><?php  echo $item['xueqi_rank'];?>  </span>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-success"><?php  echo $item['score_xueqi_name'];?> </span>
                            </td>
                            <td class="qx_e_d" style="text-align:right;">
                                <a class="btn btn-default btn-sm qx_4102" href="<?php  echo $this->createWebUrl('bjscore', array('id' => $item['id'], 'op' => 'post', 'schoolid' => $schoolid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm qx_4103" href="<?php  echo $this->createWebUrl('bjscore', array('id' => $item['id'], 'op' => 'delete', 'schoolid' => $schoolid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php  } } ?>
                    </tbody>
                    <tr>
                        <td colspan="10">
                            <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                            <input type="button" class="btn btn-primary" name="btndeleteall" value="批量删除" />
                        </td>
                    </tr>
                </table>
                <?php  echo $pager;?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var e_d = 2 ;
        <?php  if(!(IsHasQx($tid_global,1004102,1,$schoolid))) { ?>
        $(".qx_4102").hide();
        e_d = e_d -1;
        <?php  } ?>
        <?php  if(!(IsHasQx($tid_global,1004103,1,$schoolid))) { ?>
        $(".qx_4103").hide();
        e_d = e_d -1;
        <?php  } ?>
        <?php  if(!(IsHasQx($tid_global,1004104,1,$schoolid))) { ?>
        $(".qx_4104").hide();
        <?php  } ?>

        <?php  if(!(IsHasQx($tid_global,1004105,1,$schoolid))) { ?>
        $(".qx_4105").hide();
        <?php  } ?>
        if(e_d == 0){
            $(".qx_e_d").hide();
        }

        $(".check_all").click(function(){
            var checked = $(this).get(0).checked;
            $("input[type=checkbox]").attr("checked",checked);
        });
        $("input[name=btndeleteall]").click(function(){
            var check = $("input[type=checkbox][class!=check_all]:checked");
            if(check.length < 1){
                alert('请选择要删除的评分!');
                return false;
            }
            if(confirm("确认要删除选择的评分?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                var url = "<?php  echo $this->createWebUrl('studentscore', array('op' => 'deleteall','schoolid' => $schoolid))?>";
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
    });

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
            htmls += '<select id="bj_id"><option value="">请选择班级</option>';
            if (classlevel != '') {
                for (var i in classlevel) {
                    htmls += '<option value="' + classlevel[i].sid + '">' + classlevel[i].sname + '</option>';
                }
            }
            $('#bj').html(htmls);
        });
    }
</script>
<?php  } else if($operation == 'post') { ?>
<div class="panel panel-info">
    <div class="panel-heading"><a class="btn btn-primary" onclick="javascript :history.back(-1);"><i class="fa fa-tasks"></i> 返回</a></div>
</div>
<div class="main">
    <form action="" method="post"  class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                修改评分
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">班级:</label>
                    <div class="col-sm-9" >
                        <span class="form-control" style="color:red;border:unset"><?php  echo $bj_name['sname'];?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">年级:</label>
                    <div class="col-sm-9" >
                        <span class="form-control" style="color:red;border:unset"><?php  echo $nj_name['sname'];?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">评分时间:</label>
                    <div class="col-sm-2" style="color:red;">
                        <span class="form-control" style="color:red;border:unset"> <?php  echo date("Y-m-d",$item['scoretime'])?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分数</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="score" class="form-control" value="<?php  echo $item['score'];?>" />
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