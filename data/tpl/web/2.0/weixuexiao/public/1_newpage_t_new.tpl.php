<?php defined('IN_IA') or exit('Access Denied');?><link type="text/css" rel="stylesheet" href="<?php echo OSSURL;?>public/mobile/css/mGrzxTeacher.css?v=4.80915" />
<link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/mobile/css/new_yab.css" />
<!-- <link rel="stylesheet" type="text/css" href="<?php echo OSSURL;?>public/web/css/demo-grid.css" />   -->
<!-- <script type="text/javascript" src="../addons/weixuexiao/public/web/js/drag.js"></script> -->
<style>



.item { width: 100px; height: 100px; }


.card { position: absolute; left: 0; top: 0; right: 0; bottom: 0; text-align: center; font-size: 24px; font-weight: 300; background-color: rgba(255,255,255,0.9); color:black; border-radius: 4px; -webkit-transition: all 0.2s ease-out; -moz-transition: all 0.2s ease-out; -ms-transition: all 0.2s ease-out; -o-transition: all 0.2s ease-out; transition: all 0.2s ease-out; }
.item.red .card { color: #f94a7a; }

.card-id { position: absolute; left: 7px; top: 0; height: 30px; line-height: 30px; text-align: left; font-size: 16px; font-weight: 400; }
.card-remove { position: absolute; right: 0; top: -10px; width: 30px; height: 30px; line-height: 30px; text-align: center; font-size: 20px; font-weight: 400; cursor: pointer; -moz-transform: scale(0); -webkit-transform: scale(0); -o-transform: scale(0); -ms-transform: scale(0); transform: scale(0); -webkit-transition: all 0.15s ease-out; -moz-transition: all 0.15s ease-out; -ms-transition: all 0.15s ease-out; -o-transition: all 0.15s ease-out; transition: all 0.15s ease-out; }
.card-remove_top {color:#f94a7a ;position: absolute; right: 0; top: 0px; width: 30px; height: 30px; line-height: 30px; text-align: center; font-size: 20px; font-weight: 400; cursor: pointer; -moz-transform: scale(0); -webkit-transform: scale(0); -o-transform: scale(0); -ms-transform: scale(0); transform: scale(0); -webkit-transition: all 0.15s ease-out; -moz-transition: all 0.15s ease-out; -ms-transition: all 0.15s ease-out; -o-transition: all 0.15s ease-out; transition: all 0.15s ease-out; }
.card:hover > .card-remove { -moz-transform: scale(1); -webkit-transform: scale(1); }
.TopLine-card:hover > .card-remove_top{ -moz-transform: scale(1); -webkit-transform: scale(1); }
    .header { width: 100%; height: 50px; position: fixed; z-index: 1000; top: 0; left: 0; } 
    .header .l { width: 50px; height: 50px; line-height: 50px; color: white; position: absolute; left: 0; top: 0; } 
    .header .m { width: 100%; height: 50px; line-height: 50px; text-align: center; color: white; font-size: 18px; } 
    .header .r { width: 50px; height: 50px; line-height: 50px; position: absolute; right: 0; top: 0; } 
	
	 .header .l a { font-size: 18px; color: white; display: block; width: 100%; height: 100%; text-align: center; }
	 .grid { position: relative; }
.item { display: block; position: absolute; }
.item.muuri-dragging, .item.muuri-releasing { z-index: 2; }
.item.muuri-hidden { z-index: 0; }
.item-content { position: relative; width: 100%; height: 100%; }

#bg_star{width: 60px;float: left;margin-top: 15px;height: 16px;background: url("<?php echo MODULE_URL;?>public/mobile/img/star_show_gray_blank.png");}
#over_star{height:16px;background:url("<?php echo MODULE_URL;?>public/mobile/img/star_show_gray_full.png") no-repeat;}
.Tjiebang{color: #17b056;height: 26px;margin-top: 2px;padding:0 3px;border-radius: 5px;color:rgb(137,144,111);background-color: rgb(250,220,86);width:32px;line-height: 25px;text-align: center ;font-size: 12px;float: left;}
.BjInfoDiv{color:white;height: 26px;line-height: 26px;padding-left:40px;width:calc(100% - 180px);float: left;}
.MyInfo{height: 26px;margin-top: 2px;padding:0 3px;border-radius: 15px;background-color: #ceb750;width:70px;float: right;}
.Kc_Bjlist_span{overflow: hidden;white-space: nowrap;text-overflow:ellipsis;display:block;width:calc(100% - 40px);float: left;height: 26px}
.ProgressDiv{width:100%;height: 40px;border-radius: 20px;background-color: white;display: flex;flex-direction: row;justify-content: space-between}
.ProgressDiv_parent{width:100%;height: 85px;}
.ProgressTitle{height: 40px;line-height: 40px;padding:0 10px;width:60px;color:gray}
.Progress{flex:1;position: relative;border-radius: 10px;overflow: hidden;height: 20px;margin-top: 10px;background-color: rgb(34, 47, 63);}
.Progress>div{width:100%;height: 20px;border-radius:10px;}
.Progress_detail{height: 40px;line-height: 40px;padding:0 10px;width:120px;color:gray;text-align: center}
.tSign{width: 40px; height: 40px;border-radius: 50%; position: absolute; right: 10px; top: 50%; margin-top: -10px;background-color: aqua}
.tSign>div{height: 20px;line-height: 20px;margin-top: 10px;width:40px;text-align: center}

.TripleIconDiv{width:94.99%;height: 90px;margin:5px 2.555%;display:flex;flex-direction: row;justify-content: space-between ;border-radius: 20px ;overflow: hidden;background-color: white;box-shadow: 0px 0px 8px 0px #7d7d7d;}
.linkDiv .linkBox { width: 33%; float: left; text-align: center; background: #fff; padding-top: 15px; padding-bottom: 10px; margin-left: 0.3%; margin-bottom: 2px; border-radius: unset }
.font_icon {
    width: 15px;
    margin-top: 6px !important;
    margin-left: 7px;
    margin-right: 2px;
}
.stuServer {
    width: 100%;
    padding: 10px 0;
    overflow: hidden;
    border-bottom: 1px solid #e7e7eb;
    position: relative;
}
</style>
</head>
<body>	
    <div class="stuBanner">
		<div class="stuBannerBg">
		</div>
	</div>
	<div class="stuBox" style="background-color: rgb(234,128,41);padding:0">
		<div class="stuInfo" style="border-bottom: unset">
			<input type="hidden" id="bigImage" name="bigImage"/>
			<div class="stuHeader" onclick="uploadImg(this);" style="border:2px solid transparent">
				<img alt="头像" src="<?php  echo tomedia($logo['tpic'])?>" />	 
			</div>
			<div class="stuInfoCenter" style="width:calc(100% - 160px)">
				<div class="stuName">
					<label class="m_r_10" style="color:white" >老师名称</label>
					
					<div id="bg_star" ><!--这里是背景，也就是灰色的星星-->
						<div id="over_star" style="width:30px"></div><!--这里是遮罩，设置宽度以达到评分的效果-->
					</div>
					<label style="font-size:15px;font-weight: normal;color:white">&nbsp;<?php  echo $teacher['star'];?>分</label>
				
				</div>
				<div class="stuCampusAndBjname" style="border-bottom:1px solid white;width:60%">
					<span class="campus" style="color:white">老师称谓</span>
				</div>
			</div>
			<div class="tSign">
				<div>打卡</div>
			</div>
		</div>				
		<div class="stuServer" style="height: 30px;padding:0px 0px;border-bottom: unset">
			<div id="jiebang1" class="Tjiebang">解绑</div>
			<div class="BjInfoDiv">
				<?php  if($_W['schooltype']) { ?>			
				<span style="display:block;width:40px;float: left;">课程</span>
				<span class="Kc_Bjlist_span">授课课程</span>
				<!-- <div onclick="gotokecheng();" class="unbound">查看</div> -->
				<?php  } else { ?>
				<span style="display:block;width:40px;float: left;">班级</span>
				<span class="Kc_Bjlist_span">
					授课班级
				</span>		
				<?php  } ?>	
			</div>
			<div  class="MyInfo" style="height: 26px">
				<img class="font_icon" src="<?php echo MODULE_URL;?>public/mobile/img/change_image.png"></img><div  style="line-height: 26px; float: right; margin-right: 4px;color:white;" >切换</div>
			</div>
		</div>
	</div>
		<div class="grid-demo" >
		
        <div class="controls cf" style="display: none;">
            <div class="control search">
                <div class="control-icon">
                    <i class="material-icons"></i>
                </div>
                <input class="control-field search-field form-control "
                       type="text" name="search" placeholder="Search...">
            </div>
            <div class="control filter">
                <div class="control-icon">
                    <i class="material-icons"></i>
                </div>
                <div class="select-arrow">
                    <i class="material-icons"></i>
                </div>
                <select class="control-field filter-field form-control">
                    <option value="" selected="">All</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
            </div>
            <div class="control sort">
                <div class="control-icon">
                    <i class="material-icons"></i>
                </div>
                <div class="select-arrow">
                    <i class="material-icons"></i>
                </div>
                <select class="control-field sort-field form-control">
                    <option value="order" selected="">Drag</option>
                    <option value="title">Title (drag disabled)</option>
                    <option value="color">Color (drag disabled)</option>
                </select>
            </div>
            <div class="control layout">
                <div class="control-icon">
                    <i class="material-icons"></i>
                </div>
                <div class="select-arrow">
                    <i class="material-icons"></i>
                </div>
                <select class="control-field layout-field form-control">
                    <option value="left-top" selected="">Left Top</option>
                    <option value="left-top-fillgaps">Left Top (fill gaps)</option>
                    <option value="right-top">Right Top</option>
                    <option value="right-top-fillgaps">Right Top (fill gaps)</option>
                    <option value="left-bottom">Left Bottom</option>
                    <option value="left-bottom-fillgaps">Left Bottom (fill gaps)</option>
                    <option value="right-bottom">Right Bottom</option>
                    <option value="right-bottom-fillgaps">Right Bottom (fill gaps)</option>
                </select>
            </div>
        </div>
		   <div class="grid-footer" style="display:none">
            <button class="add-more-items btn btn-primary">
                <i class="material-icons"></i>Add more items
            </button>
        </div>
     
        <div class="TripleIconDiv" id="TopIconDiv">
   

            <div  id="TopIconLo_1"  style="height:90px;width:30vw;position: relative;">
                <?php  if(!empty($TopIconFTea['0'])) { ?>
                <div id="TiconD<?php  echo $TopIconFTea[0]['id'];?>" data-setid="<?php  echo $TopIconFTea[0]['id'];?>" class="linkBox TopLine-card HasDataCard" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;text-align: center;">
                        <img alt="" src="<?php  echo $TopIconFTea[0]['icon'];?>" style="width:40px;">
                    </div>
                    <span class="linkName" data-inp-id="<?php  echo $TopIconFTea[0]['id'];?>"  style="    color: #999; padding-top: 10px; font-size: 14px;text-align: center"><?php  echo $TopIconFTea[0]['name'];?></span>	
                    <input type="hidden" class="card-id" name="TopIconId[1]" value="<?php  echo $TopIconFTea[0]['id'];?>" style="height:auto;display:none">
                    <input type="hidden" class="card-id" name="TopIconIdorder[1]" value="1" style="height:auto;display:none">
                    
                    <div class="card-remove_top"><i class="material-icons fa fa-bars"  onclick="showMoFang(<?php  echo $TopIconFTea[0]['id'];?>,this)"></i></div>
                </div> 
                <?php  } else { ?>
                <div class="linkBox TopLine-card" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;    text-align: center;">
                        <img alt="" src="./resource/images/nopic.jpg" style="width:40px;height: 40px">
                    </div>			
                    <span class="linkName" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center">未设置</span>	
                </div>  
                <?php  } ?>
            </div>
            <div  id="TopIconLo_2" style="height:90px;width:30vw;position: relative;">
                <?php  if(!empty($TopIconFTea['1'])) { ?>
                <div id="TiconD<?php  echo $TopIconFTea[1]['id'];?>" data-setid="<?php  echo $TopIconFTea[1]['id'];?>" class="linkBox TopLine-card HasDataCard" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;text-align: center;">
                        <img alt="" src="<?php  echo $TopIconFTea[1]['icon'];?>" style="width:40px;">
                    </div>
                    <span class="linkName" data-inp-id="<?php  echo $TopIconFTea[1]['id'];?>" style="    color: #999; padding-top: 10px; font-size: 14px;text-align: center"><?php  echo $TopIconFTea[1]['name'];?></span>	
                    <input type="hidden" class="card-id" name="TopIconId[2]" value="<?php  echo $TopIconFTea[1]['id'];?>" style="height:auto;display:none">
                    <input type="hidden" class="card-id" name="TopIconIdorder[2]" value="2" style="height:auto;display:none">
                    <div class="card-remove_top"><i class="material-icons fa fa-bars"  onclick="showMoFang(<?php  echo $TopIconFTea[1]['id'];?>,this)"></i></div>
                </div> 
                <?php  } else { ?>
                <div class="linkBox TopLine-card" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;    text-align: center;">
                        <img alt="" src="./resource/images/nopic.jpg" style="width:40px;height: 40px">
                    </div>			
                    <span class="linkName" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center">未设置</span>	
                </div>  
                <?php  } ?>       
            </div>
            <div  id="TopIconLo_3" style="height:90px;width:30vw;position: relative;">
                <?php  if(!empty($TopIconFTea['2'])) { ?>
                <div id="TiconD<?php  echo $TopIconFTea[2]['id'];?>" data-setid="<?php  echo $TopIconFTea[2]['id'];?>" class="linkBox TopLine-card HasDataCard" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;text-align: center;">
                        <img alt="" src="<?php  echo $TopIconFTea[2]['icon'];?>" style="width:40px;">
                    </div>
                    <span class="linkName" data-inp-id="<?php  echo $TopIconFTea[2]['id'];?>" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center"><?php  echo $TopIconFTea[2]['name'];?></span>	
                    <input type="hidden" class="card-id" name="TopIconId[3]" value="<?php  echo $TopIconFTea[2]['id'];?>" style="height:auto;display:none">
                    <input type="hidden" class="card-id" name="TopIconIdorder[3]" value="3" style="height:auto;display:none">
                    <div class="card-remove_top"><i class="material-icons fa fa-bars"  onclick="showMoFang(<?php  echo $TopIconFTea[2]['id'];?>,this)"></i></div>
                </div> 
                <?php  } else { ?>
                <div class="linkBox TopLine-card" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;    text-align: center;">
                        <img alt="" src="./resource/images/nopic.jpg" style="width:40px;height: 40px">
                    </div>			
                    <span class="linkName" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center">未设置</span>	
                </div>  
                <?php  } ?>      
            </div>
            <!-- <div  id="TopIconLo_4" style="height:90px;width:30vw;position: relative;">
                <?php  if(!empty($TopIconFTea['3'])) { ?>
                <div id="TiconD<?php  echo $TopIconFTea[3]['id'];?>" data-setid="<?php  echo $TopIconFTea[3]['id'];?>" class="linkBox TopLine-card HasDataCard" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;text-align: center;">
                        <img alt="" src="<?php  echo $TopIconFTea[3]['icon'];?>" style="width:40px;">
                    </div>
                    <span class="linkName" style="    color: #999; padding-top: 10px; font-size: 14px;text-align: center"><?php  echo $TopIconFTea[3]['name'];?></span>	
                    <input type="hidden" class="card-id" name="TopIconId[4]" value="<?php  echo $TopIconFTea[3]['id'];?>" style="height:auto;display:none">
                    <input type="hidden" class="card-id" name="TopIconIdorder[4]" value="4" style="height:auto;display:none">
                    <div class="card-remove_top"><i class="material-icons fa fa-bars"  onclick="showMoFang(<?php  echo $TopIconFTea[3]['id'];?>,this)"></i></div>
                </div> 
                <?php  } else { ?>
                <div class="linkBox TopLine-card" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                    <div class="linkImg" style="height: 45px;    text-align: center;">
                        <img alt="" src="./resource/images/nopic.jpg" style="width:40px;height: 40px">
                    </div>			
                    <span class="linkName" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center">未设置</span>	
                </div>  
                <?php  } ?>         
            </div> -->
        </div>
        <div class="linkDiv grid" id="linkDiv" style="margin-left: 1%; margin-right: 1%;;margin-top:10px;">
            <?php  if(is_array($iconsF)) { foreach($iconsF as $key => $row) { ?>
            <?php 
           
            $is_top  = 0 ;
            if(in_array($row['id'],$TeaArray)){
                $is_top = 1;
            }
            
            ?>	
			  <div class="item  w1 red muuri-item muuri-item-shown linkBox"
                 data-id="<?php  echo $row['ssort'];?>" id="TeaIconLocation_<?php  echo $row['id'];?>" is_top="<?php  echo $is_top;?>" data-color="red" data-title="mk"
                 style="left: 0px; top: 0px;
                    transform: translateX(240px) translateY(0px); display: block;
                    touch-action: none; user-select: none;
                    -webkit-user-drag: none;
                    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                <div class="item-content " style="opacity: 1; transform: scale(1);">
                    <div class="card " style="height:auto">
                      
						<div class="linkImg"> 
						  <input type="hidden" class="card-id" name="ssortId[<?php  echo $row['id'];?>]" value="<?php  echo $row['ssort'];?>" style="height:auto;display:none">
						<img id="iconpic<?php  echo $row['id'];?>" alt="" src="<?php  echo tomedia($row['icon'])?>" style="width:35px;">
					</div>			
					<span class="linkName" data-inp-id="<?php  echo $row['id'];?>" ><?php  echo $row['name'];?></span>	 
						
                        <div class="card-remove"><i class="material-icons fa fa-bars"  onclick="showMoFang(<?php  echo $row['id'];?>,this)"></i></div>
                    </div>
                </div>
            </div>
			<?php  } } ?>	
		</div>
		</div>
    
        <script type="text/javascript">

			$(document).ready(function() {
				$(".editor").hide();
				var aaaa = document.getElementsByClassName('linkDiv')[0];
				 var body = document.body;
				console.log(aaaa);
		
			});

            //进入icon编辑状态
			function showMoFang(Pla,e){
                let StopEvent = window.event;
                StopEvent.stopPropagation();
                StopEvent.preventDefault();
                let ThisIcon = $(e).offset().top;
                let Check = $('#TopIconDiv').find(`#TiconD${Pla}`).length;
                if(Check != 0){
                    $("#iconeditor"+Pla).find(".RemoveFromTop").show();
                    $("#iconeditor"+Pla).find(".SetTopLo").hide();
                }else{
                    $("#iconeditor"+Pla).find(".RemoveFromTop").hide();
                    $("#iconeditor"+Pla).find(".SetTopLo").show();
                }
				$(".editor").hide();
                $("#iconeditor"+Pla).css("top",`${ThisIcon - 440}px`);
				$("#iconeditor"+Pla).show();
            }
            

            //设置为顶部
            function SetToTopLo(lo,id){
                let Target = $(`#TopIconLo_${lo}`),
                    sourse = $(`#iconeditor${id}`),
                    ImgUrlToShow = $(sourse).find(".img-thumbnail").attr("src"),
                    ImgUrlToData = $(`#iconpics${id}`).val(),
                    iconName = $(`#btnname_${id}`).val();
                   
                   
                let Thtml = `
                    <div id="TiconD${id}" data-setid="${id}" class="linkBox TopLine-card HasDataCard" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                        <div class="linkImg" style="height: 45px;text-align: center;">
                            <img alt="" src="${ImgUrlToShow}" style="width:40px;">
                        </div>
                        <span class="linkName" style="    color: #999; padding-top: 10px; font-size: 14px;text-align: center">${iconName}</span>	
                        <input type="hidden" class="card-id" name="TopIconId[${lo}]" value="${id}" style="height:auto;display:none">
                        <input type="hidden" class="card-id" name="TopIconIdorder[${lo}]" value="${lo}" style="height:auto;display:none">
                      
                        <div class="card-remove_top"><i class="material-icons fa fa-bars"  onclick="showMoFang(${id},this)"></i></div>
                    </div>`;

                let BackHtml = `
                    <div class="linkBox TopLine-card" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                        <div class="linkImg" style="height: 45px;    text-align: center;">
                            <img alt="" src="./resource/images/nopic.jpg" style="width:40px;height: 40px">
                        </div>			
                        <span class="linkName" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center">未设置</span>	
                    </div>  
                `;
                let Check = $('#TopIconDiv').find(`#TiconD${id}`).length;
                let CheckOld = $(Target).find(".HasDataCard").attr('data-setid');
                console.log(CheckOld);
                
                    if(Check != 0 ){
                        $('#TopIconDiv').find(`#TiconD${id}`).parent().html(BackHtml);
                    }
                Target.html(Thtml);
                removeItem(`#TeaIconLocation_${id}`);
                if(CheckOld != undefined ){
                    showItem(`#TeaIconLocation_${CheckOld}`)
                }
                $("#iconeditor"+id).hide();
            }

        //从顶部移除
        function RemoveFromTop(id){
            let BackHtml = `
                    <div class="linkBox TopLine-card" style="width:100%;padding: 16px 0 10px 0;text-align: center ">
                        <div class="linkImg" style="height: 45px;    text-align: center;">
                            <img alt="" src="./resource/images/nopic.jpg" style="width:40px;height: 40px">
                        </div>			
                        <span class="linkName" style="color: #999; padding-top: 10px; font-size: 14px;text-align: center">未设置</span>	
                    </div>`;
            showItem(`#TeaIconLocation_${id}`)
            $('#TopIconDiv').find(`#TiconD${id}`).parent().html(BackHtml);
            $("#iconeditor"+id).hide();
        }

 
		</script>