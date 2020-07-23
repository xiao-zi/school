<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<!-- <script src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/js/jquery.easypiechart.js"></script> -->

<script src="<?php echo MODULE_URL;?>public/mobile/js/highcharts.js?v=0622"></script>
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
.pull-left{margin-right: 10% !important; width: 66px;height: 66px;text-align: center;line-height: 65px;}
.icon-rounded {color: #ffffff;border-radius: 50px; -webkit-border-radius: 50px; -moz-border-radius: 50px; -o-border-radius: 50px;-ms-border-radius: 50px;font-size: 25px;}
.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
.tooltip{width:100px}
</style>




<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">公开课评论统计 - <?php  if(!empty($teaname)) { ?><?php  echo $teaname;?>老师统计结果<?php  } ?></div>
        <div class="panel-body">
 <!--           <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="gkkpjtj" />
                <input type="hidden" name="op" value="gettongji_gkk" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
				
         
				 <div class="form-group">
					 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">公开课：</label>	
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="gkkid" class="form-control">
                            <option value="0">请选择公开课</option>
                            <?php  if(is_array($gkkall)) { foreach($gkkall as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['gkkid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>

					<div class="col-sm-2 col-lg-2">						
						<button class="btn btn-default "  ><i class="fa fa-qrcode">&nbsp;&nbsp;按公开课查看</i></button>
                    </div>			
                    	
				</div>	
            </form>-->
            <form action="./index.php" id="table_search" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="gkkpjtj" />
                <input type="hidden" name="op" value="gettongji_js" />
                <input type="hidden" name="out_excel" id="out_excel" value="No" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
                <input type="hidden"  name="bas_tid"  value="<?php  echo $tid;?> "/>
                <div class="form-group">


                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">教师：</label>


                    <div class="col-sm-2 col-lg-2" id="sxname">
                        <select name="tid" class="form-control select" style="display:none">

                        </select>
                        <input type="text" placeholder="主任或管理" class="form-control sxword" value="<?php  if($teaname) { ?><?php  echo $teaname;?><?php  } ?>"/>
                    </div>
                    <div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -31px;">
                        <span class="btn btn-default" id="search_tname"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="col-sm-2 col-lg-2" style="width: 45px;margin-left: -4px;">
                        <span class="btn btn-default" style="background-color: #30d1e8"  data-toggle="tooltip" data-placement="bottom" title="重新筛选" data-delay='{"show":"700", "hide":"0"}' id="clear_tname"><i class="fa fa-refresh"></i></span>
                    </div>

                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;padding-left: 20px;">创建时间</label>
                    <div class="col-sm-2 col-lg-2" style="width:auto">
                        <?php  echo tpl_form_field_daterange('createtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
                    </div>
					<div class="col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                    <div class="col-sm-2 col-lg-2">
                        <a class="btn btn-success " onclick="GetOut();" ><i class="fa fa-download">&nbsp;&nbsp;当前条件导出统计</i></a>
                    </div>
				</div>	
            </form>
            <div class="col-sm-2 col-lg-2">
                <a class="btn btn-default " href="<?php  echo $this->createWebUrl('gongkaike', array( 'op' => 'display', 'schoolid' => $schoolid))?>" ><i class="fa fa-mail-reply">&nbsp;&nbsp;返回</i></a>
            </div>
        </div>
    </div>
    <!--<div class="panel panel-default file-container" style="display:none;">
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <input type="hidden" name="leadExcel" value="true">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weixuexiao" />
                <input type="hidden" name="do" value="UploadExcel" />
                <input type="hidden" name="ac" value="kecheng" />
				<input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />

                <a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i> 刷新</a>
                <input name="viewfile" id="viewfile" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
                <a class="btn btn-primary"><label for="unload" style="margin: 0px;padding: 0px;">上传...</label></a>
                <input type="file" class="pull-left btn-primary span3" name="inputExcel" id="unload" style="display: none;"
                       onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';">
                <input type="submit" class="btn btn-primary" name="btnExcel" value="导入数据">
                <a class="btn btn-primary" href="../addons/weixuexiao/public/example/example_kecheng.xls">下载导入模板</a>
            </form>
        </div>
    </div>-->	
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
			<?php  if(!empty($backinfo)) { ?>
	        <?php  if(is_array($backinfo)) { foreach($backinfo as $key => $row) { ?>
               <section class="contentBox col-sm-6" style="width:25%;display: inline;">
                    <div class="contentinfo" style="display: inline;">
                        <div id="container<?php  echo $key;?>" style=" height: 400px"></div>
                    </div>
                </section>
                <script type="text/javascript">




                    $(function () {
                                var opp = {
                                chart: {

                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie',
                                },
                                colors: pageObj[6],
                                credits: {
                                    enabled: false // 禁用版权信息
                                },
                                //图列
                                legend: {
                                    enabled: true,
                                    symbolWidth:10,
                                    symbolHeight: 10,
                                    y: -50

                                },

                                title: {
                                    style: {
                                        color: '#333333',
                                        //fontWeight: 'bold',
                                        y: 100,
                                        fontSize: '16px',
                                        align: 'center'
                                    },
                                    y: 25,
                                    text:' <?php  echo $row['question_content'];?>',
                                    useHTML:true,
                                },
                                //提示框
                                tooltip: {
                                    enabled: true,
                                    animation: true,
                                    followPointer: true,

                                    hideDelay: 30,
                                    pointFormat: '{point.y}次:{point.percentage:.1f}%'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',

                                        //百分比
                                        dataLabels: {
                                            enabled: true,
                                            color: '#666666',
                                            //format: '{point.name}{point.percentage:.1f} %'
                                            format: '{point.name} ',
                                            style: {
                                                fontWeight: 'normal'
                                            }
                                        },
                                        //禁用图列点击事件
                                        point: {
                                            events: {

                                            }
                                        },
                                        showInLegend: true
                                    }
                                },
                                series: [
                                    {
                                        type: 'pie',
                                        name: '',
                                        data: [<?php  echo $row['question_data'];?>]
                                    }
                                ]
                    }
                        var chart = Highcharts.chart('container<?php  echo $key;?>', opp);

                    });
                </script>
            <?php  } } ?>
            <?php  } else { ?>
             <span> 暂无评价数据</span>
             <?php  } ?>
        </div>
    </div>
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
<script src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/js/jquery.flot.js?v=2.1.4"></script>
<script src="<?php  echo $_W['siteroot'];?>addons/weixuexiao/public/web/js/echarts-all.js?v=2.1.4"></script>	


<script type="text/javascript">
    function GetOut(){
        $("#out_excel").val("Yes");
        document.forms.table_search.submit();
        $("#out_excel").val("No");
    };

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
        html1 += '<select id="schoolid"><option value="">请选择老师</option>';
        if(tname != ''){
            $.post("<?php  echo $this->createWebUrl('indexajax',array('op'=>'getallteacher','weid'=>$weid))?>", {'tname': tname,schoolid:schoolid}, function(data) {
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


    var pageObj = [
		['#06c1ae'],
		['#06c1ae', '#ff9f22'],
		['#06c1ae', '#ff6665', '#ff9f22'],
		['#06c1ae', '#ff6665', '#33bd61', '#ff9f22'],
		['#06c1ae', '#ff6665', '#33bd61', '#ff9f22', '#ff7298'],
		['#06c1ae', '#ff6665', '#33bd61', '#ff9f22', '#ff7298', '#52b3ff'],
		['#06c1ae', '#ff6665', '#33bd61', '#ff9f22', '#ff7298', '#52b3ff', '#e4d354', '#8085e8', '#8d4653', '#91e8e1'],
	];
	var chartObj;
	
	function showPie(question_content, question_data, txtpageObj,indexobj) {
		chartObj = new Highcharts.Chart(
			{
				chart: {
					renderTo: "container"+indexobj,
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie',
				},
				colors: txtpageObj,
				credits: {
					enabled: false // 禁用版权信息
				},
				//图列
				legend: {
					enabled: true,
					symbolWidth:10,
					symbolHeight: 10,
					y: -50
				   
				},

				title: {
					style: {
						color: '#333333',
						//fontWeight: 'bold',
						y: 100,
						fontSize: '16px'
					},
					y: 25,
					text: question_content,
					useHTML:true,
				},
				//提示框
				tooltip: {
					enabled: false,
					pointFormat: '{series.name}:{point.percentage:.1f}%'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						events: {
							click: function (e) {
								//                            location.href = "www.baidu.com?a=1&b=1";
								  // window.open('123.aspx?type='+e.point.type+'&id='+e.point.tid);
								    console.log(e.point);
								location.href = "<?php  echo $this->createMobileUrl('questionnaire',array('schoolid'=>$schoolid,'leaveid'=>$leaveid))?>" +"&content=" + e.point.content + "&id=" + e.point.id + "&tmid=" + e.point.tmid;
							}
						},
						//百分比
						dataLabels: {
							enabled: true,
							color: '#666666',
							//format: '{point.name}:{point.percentage:.1f} %'
							format: '{point.percentage:.1f} %',
							style: {
								fontWeight: 'normal'
							}
						},
						//禁用图列点击事件
						point: {
							events: {
							
							}
						},
						showInLegend: true
					}
				},
				series: [
					{
						type: 'pie',
						name: '',
						data: question_data
					}
				]
			}
		);

		//var data = [{ 'name': 'demo', 'y': 22, 'content': 'hh', 'id': '111' }, { 'name': '1', 'y': 3, 'content': 'bb', 'id': '333' }, { 'name': '1', 'y': 66, 'content': 'aa', 'id': '222' }];
		chartObj.series[0].setData(question_data);
	}

//获取数据

</script>



<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>