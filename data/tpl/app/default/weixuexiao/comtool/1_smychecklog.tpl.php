<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list1)) { foreach($list1 as $item1) { ?>
<li class="CheckLog" time="<?php  echo $item1['location'];?>">
    <div class="thhead" style="width:30%;font-size: 12px"><?php  echo $item1['logtype'];?></div>
    <div class="thhead" style="width:50%;font-size: 12px"><?php  echo date("Y-m-d",$item1['createtime'])?></div>
    <div class="thhead" style="width:20%;font-size: 12px">
        <span class="CheckMoreBtn" onclick="ChaKanXiangQing(<?php  echo $item1['id'];?>)">查看详情</span>
    </div>
</li>
<?php  } } ?>