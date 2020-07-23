<?php defined('IN_IA') or exit('Access Denied');?>					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr id="kc_<?php  echo $item['id'];?>">
						<td class="with-checkbox">
							<input type="checkbox" name="check" value="<?php  echo $item['id'];?>">
							<span style="text-align:center;color:red;font-size:15px;font-weight:blod;">ID:<?php  echo $item['id'];?></span>
							<input type="text" class="form-control" name="ssort[<?php  echo $item['id'];?>]" value="<?php  echo $item['ssort'];?>">
						</td>
						<td>
							<a href="<?php  echo $this->createWebUrl('kecheng', array('id' => $item['id'], 'op' => 'kc_info', 'schoolid' => $schoolid))?>" target="_blank">
								<img src="<?php  echo tomedia($item['thumb'])?>" width="50"/>
							</a>
							<?php  if($item['sale_type'] ==1) { ?><span class="tuan_tips">团</span><?php  } ?>
							<?php  if($item['sale_type'] ==2) { ?><span class="zl_tips">助</span><?php  } ?>
							</br>
							<a href="<?php  echo $this->createWebUrl('kecheng', array('id' => $item['id'], 'op' => 'kc_info', 'schoolid' => $schoolid))?>" target="_blank">
								<?php  echo $item['name'];?>
							</a>
							</br>
							<?php  if($item['is_try']==1) { ?><span class="label label-warning">试听课</span><?php  } else { ?><span class="label label-primary">正式课</span><?php  } ?>
						</td>
						<td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal">
							<?php  if(is_array($item['tname'])) { foreach($item['tname'] as $v) { ?> 
								<?php  if($v['tid'] == $item['maintid']) { ?>
									<?php  echo $v['tname'];?>&nbsp;&nbsp;<span class="label label-danger" style="background-color: #8a6461;">主讲</span>
								<?php  } else { ?>
									<?php  echo $v['tname'];?>
								<?php  } ?>
								</br> 
							<?php  } } ?>
						</td>
						<td style="overflow:visible; word-break:break-all; text-overflow:auto;white-space:normal">
							<div>
								<?php  if($item['is_hot']==1) { ?>
								<span class="label label-warning" style="padding: 2px 2px;"><i class="fa fa-star"></i></span>精品课
								<?php  } ?>
								</br>
								<?php  echo date('Y-m-d',$item['start'])?> <span class="label label-info">至</span><?php  echo date('Y-m-d',$item['end'])?>
								<?php  if($item['isSign'] && $item['OldOrNew'] == 0 ) { ?>
								</br><span class="label label-inverse">开课前<?php  echo $item['signTime'];?>分钟签到</span>
								<?php  } ?>
							</div>                    
						</td>
						<td>
							<?php  if($item['OldOrNew'] == 0) { ?>
							<span class="label label-success">固定课表</span>
							<?php  } else if($item['OldOrNew'] == 1) { ?>
							<span class="label label-info"><i class="fa fa-codepen">&nbsp;&nbsp;自由课时</i></span>
							<?php  } ?>
							<p></p>
							<span class="label label-danger"><?php  echo $item['njname'];?></span>
						</td>
						<td>
							<?php  echo $item['kmname'];?>
							</br>
							<?php  echo $item['adrrname'];?>
						</td>
						<td style="overflow:visible; word-break:break-all; text-overflow:visible;white-space:normal">
							<?php  if($item['OldOrNew'] == 1 ) { ?>
							&nbsp;&nbsp;<span class="label label-warning" style="font-weight:bold;">首购￥<?php  echo $item['cose'];?></span>
							</br>
							【包含<?php  echo $item['FirstNum'];?>课时】
							</br>
							&nbsp;&nbsp;<span class="label label-danger" style="font-weight:bold;">续购￥<?php  echo $item['RePrice'];?></span>
							</br>
							【<?php  echo $item['ReNum'];?>课时起续】
							<?php  } else { ?>
								<?php  if(empty($item['FirstNum'])) { ?>
								&nbsp;<span class="label label-warning" style="font-weight:bold;">￥<?php  echo $item['cose'];?></span>
								<?php  } else if(!empty($item['FirstNum'])) { ?>
								&nbsp;&nbsp;<span class="label label-warning" style="font-weight:bold;">首购￥<?php  echo $item['cose'];?></span>
								</br>
								【包含<?php  echo $item['FirstNum'];?>课时】
								</br>
								&nbsp;&nbsp;<span class="label label-danger" style="font-weight:bold;">续购￥<?php  echo $item['RePrice'];?></span>
								</br>
								【<?php  echo $item['ReNum'];?>课时起续】
								<?php  } ?>
							<?php  } ?>
							</td>	
						<td>
							<?php  echo $item['bili'];?>%
							<?php  if($item['start']>TIMESTAMP) { ?><span class="label label-warning">未开始</span><?php  } ?>
							<?php  if($item['start']<TIMESTAMP && $item['end']>TIMESTAMP) { ?><span class="label label-info">进行中</span><?php  } ?>
							<?php  if($item['end']<TIMESTAMP) { ?><span class="label label-default">已结束</span><?php  } ?>
							<span style="float:right;margin-right:77px;"><?php  echo $item['yib'];?>/<?php  echo $item['minge'];?>人</span>
							<div class="antd-pro-pages-list-basic-list-style-listContentItem">
								<div class="ant-progress ant-progress-line ant-progress-status-<?php  echo $item['mission'];?> ant-progress-show-info ant-progress-default" style="width: 180px;">
									<div>
										<div class="ant-progress-outer">
											<div class="ant-progress-inner">
												<div class="ant-progress-bg" style="width:<?php  echo $item['bili'];?>%;height:9px;border-radius:100px;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</td>
						<td style="overflow:visible; word-break:break-all; text-overflow:visible;white-space:normal">
							<span class="label label-primary">预设:</span><?php  echo $item['AllNum'];?>个课时
							</br></br>
						<?php  if($item['start']>TIMESTAMP) { ?><span class="label label-default">未开始</span><?php  } ?>
						<?php  if($item['start']<TIMESTAMP && $item['end']>TIMESTAMP) { ?><span class="label label-info">授课中</span><?php  } ?>
						<?php  if($item['end']<TIMESTAMP) { ?><span class="label label-danger">结束</span><?php  } ?></br></br>
						<?php  if($item['is_show'] == 1) { ?><span class="label label-success">显示</span><?php  } else { ?><span class="label label-danger">不显示</span><?php  } ?>
						</td>
						<td class="qx_t_c">
							<?php  if($item['end']>TIMESTAMP) { ?>
								<?php  if($item['OldOrNew'] == 0 ) { ?>
								<a class="btn btn-info btn-sm qx_922" data-toggle="tooltip" data-placement="top" onclick="quick_pk(<?php  echo $item['id'];?>,this);" title="一键排课">+&nbsp;一键排课</a>
								<?php  } else if($item['OldOrNew'] == 1) { ?><p></p>
								<span class="label label-info"><i class="fa fa-codepen">&nbsp;&nbsp;自由课时</i></span>
								<?php  } ?>
							<?php  } else if($item['end']<TIMESTAMP) { ?>
								<span class="label label-default">已结课</i></span>
								<p></p>
								<a class="btn btn-default btn-sm qx_911" href="<?php  echo $this->createWebUrl('kcpingjiashow', array('kcid' => $item['id'],  'schoolid' => $schoolid))?>" title="查看评论">
									<i class="fa fa-qrcode">&nbsp;&nbsp;查看评论</i>
								</a>
							<?php  } ?>
						</td>					
						<td class="qx_e_d" style="text-align:right;color:#fff">
							<a class="btn btn-warning btn-sm qx_902" style="padding: 3px 6px;" target="_blank" href="<?php  echo $this->createWebUrl('kecheng', array('id' => $item['id'], 'op' => 'kc_info', 'schoolid' => $schoolid))?>" title="管理课程">
								<i class="fa fa-cog fa-spin" style="font-size: 22px;"></i>
							</a>
							<a class="btn btn-default btn-sm qx_902" onclick="add_new(<?php  echo $item['id'];?>,this)" title="编辑"><i class="fa fa-pencil"></i></a>
							&nbsp;&nbsp;
							<a class="btn btn-default btn-sm qx_904" onclick="delete_kc(<?php  echo $item['id'];?>,this)" title="删除"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					<?php  } } ?>