<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($restlist)) { foreach($restlist as $item) { ?>
<div class="morelist branch-item ng-scope" time="<?php  echo $item['dist'];?>">
    <input id="showlan" type="hidden" value="<?php  echo $item['lng'];?>,<?php  echo $item['lat'];?>"/>
    <a class="branch-info " href="<?php  echo $this->createMobileUrl('detail', array('schoolid' => $item['id']), true)?>">
        <div class="branch-image">
            <img src="<?php  echo tomedia($item['logo']);?>">
        </div>
        <div class="delivery-info">
            <div class="first-line">
                <div class="name ng-binding"><?php  echo $item['title'];?></div>
                <?php  if($item['is_hot'] != 1) { ?>
                <div class="tag label-red ng-scope">招生中</div>
                <?php  } ?>
                <div class="tag label-green ng-scope"><?php  echo $item['leixing'];?></div>
                <div class="distance right ng-binding" id="shopspostion"></div>
            </div>
            <div class="second-line">
                <div class="comment-level red">
                    <div class="ng-isolate-scope">
                        <?php  for($i=0;$i < $item['level']; $i++){ ?>
                        <i class="fa fa-star-o ng-scope"></i>
                        <?php  }?>
                    </div>
                </div>
            </div>
            <div class="third-line">
                <div class="time ng-hide" ng-show="branch.delivery_times.length &gt; 0">
                    <i class="fa fa-clock-o"></i>
                    电话
                </div>
                <div class="fee ng-binding">
                    <span class="ng-binding ng-scope"><?php  echo $item['tel'];?></span>
                    <span class="spliter"></span>
                    <span class="ng-binding ng-scope"><?php  echo $item['city'];?><?php  echo $item['quyu'];?></span>
                    <span class="spliter"></span>
                </div>
                <div class="address ng-binding"><?php  echo $item['address'];?></div>
            </div>
        </div>
    </a>
</div>
<?php  } } ?>

