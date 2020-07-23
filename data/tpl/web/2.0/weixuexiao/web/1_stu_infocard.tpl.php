<?php defined('IN_IA') or exit('Access Denied');?>	
	<div class="modal-header" style="color: black;">					
				<h4 class="modal-title" id="ModalTitle">学生资料卡</h4>	
				<input type="hidden" name="stuId" value="<?php  echo $student['id'];?>">
			</div>
			<table  class="modal-body" border="1" style="table-layout:fixed;width:90%;margin-left:5%;">
				<tr class="cardtr">
					<th class="cardth">姓名</th>
					<td colspan="2"><input type="text" name="StuName_card"class="form-control" style="border:unset" value="<?php  echo $student['s_name'];?>"> </td>
					<th class="cardth">性别</th>
					<td>
						<select style="border:unset" name="Sex_card" id="sex_card" class="form-control">
							<option value="1" <?php  if($student['sex'] == 1) { ?> selected="selected"<?php  } ?>>男</option>
							<option value="0" <?php  if($student['sex'] == 0) { ?> selected="selected"<?php  } ?>>女</option>
						</select>
					</td>
					<th class="cardth">学号</th>
					<td colspan="2"><input type="text" name="NumberId_card"class="form-control" style="border:unset" value="<?php  echo $student['numberid'];?>"> </td>
					<td rowspan="7" colspan="4"><img style="width:100%;padding: 10px" src="<?php  if(!empty($student['icon'])) { ?><?php  echo tomedia($student['icon'])?><?php  } else { ?><?php  echo tomedia($school['spic'])?><?php  } ?>" width="50" style="border-radius: 3px;" /></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth" colspan="2">身份证号码</th>
					<td colspan="3"><input type="text" name="IDcard_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['IDcard'];?>"></td>
					<th class="cardth">民族</th>
					<td colspan="2">
						<input type="text" name="Nation_card"class="form-control" style="border:unset" value="<?php  echo $cardinfo['Nation'];?>">
					</td>
				</tr>
				<tr class="cardtr">
					<th class="cardth" colspan="2">出生日期</th>
					<td colspan="2">
						<?php  echo tpl_form_field_date('Birthdate_card', date('Y-m-d', $student['birthdate']))?>	
					</td>
					<th class="cardth" colspan="2">入学日期</th>
					<td colspan="2">
						<?php  echo tpl_form_field_date('Seffectivetime_card', date('Y-m-d', $student['seffectivetime']))?>	
					</td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">家庭住址</th>
					<td colspan="7"><input type="text" name="HomeAddress_card"class="form-control" style="border:unset" value="<?php  echo $student['area_addr'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">现住址</th>
					<td colspan="7"><input type="text" name="NowAddress_card"class="form-control" style="border:unset" value="<?php  echo $cardinfo['NowAddress'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth" colspan="2">是否留守儿童</th>
					<td colspan="2">
						<select style="border:unset" name="HomeChild_card" id="HomeChild_card" class="form-control">
							<option value="1" <?php  if($cardinfo['HomeChild'] == 1) { ?> selected="selected"<?php  } ?>>是</option>
							<option value="0" <?php  if($cardinfo['HomeChild'] == 0) { ?> selected="selected"<?php  } ?>>否</option>
						</select>
					</td>
					<th class="cardth" colspan="2">是否单亲家庭</th>
					<td colspan="2">
						<select style="border:unset" name="SingleFamily_card" id="SingleFamily_card" class="form-control">
							<option value="1" <?php  if($cardinfo['SingleFamily'] == 1) { ?> selected="selected"<?php  } ?>>是</option>
							<option value="0" <?php  if($cardinfo['SingleFamily'] == 0) { ?> selected="selected"<?php  } ?>>否</option>
						</select>
					</td>
				</tr>
				<tr  class="cardtr">
					<th class="cardth" colspan="2">是否托管</th>
					<td colspan="2">
						<select style="border:unset" name="IsKeep_card" id="IsKeep_card" class="form-control">
							<option value="1" <?php  if($cardinfo['IsKeep'] == 1) { ?> selected="selected"<?php  } ?>>是</option>
							<option value="0" <?php  if($cardinfo['IsKeep'] == 0) { ?> selected="selected"<?php  } ?>>否</option>
						</select>
					</td>
					<th class="cardth" colspan="2">午托/周托</th>
					<td colspan="2">
						<select style="border:unset" name="DayOrWeek_card" id="DayOrWeek_card" class="form-control">
							<option value="0" <?php  if($cardinfo['DayOrWeek'] == 0) { ?> selected="selected"<?php  } ?>>不托管</option>
							<option value="1" <?php  if($cardinfo['DayOrWeek'] == 1) { ?> selected="selected"<?php  } ?>>午托</option>
							<option value="2" <?php  if($cardinfo['DayOrWeek'] == 2) { ?> selected="selected"<?php  } ?>>周托</option>
						</select>
					</td>
				</tr>
				<tr class="cardtr">
					<th class="cardth" rowspan="9">家</br>庭</br>成</br>员</br>基</br>本</br>情</br>况</th>
					<th class="cardth">称谓</th>
					<th class="cardth">学历</th>
					<th class="cardth">职业</th>
					<th class="cardth" colspan="2">爱好</th>
					<th class="cardth" colspan="6">工作单位</th>
				</tr>
				<tr class="cardtr">
					<th class="cardth">父亲</th>
					<td ><input type="text" name="Fxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Fxueli'];?>"></td>
					<td ><input type="text" name="Fwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Fwork'];?>"></td>
					<td colspan="2"><input type="text" name="Fhobby_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Fhobby'];?>"></td>
					<td colspan="6"><input type="text" name="FWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['FWorkPlace'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">母亲</td>
					<td ><input type="text" name="Mxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Mxueli'];?>"></td>
					<td ><input type="text" name="Mwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Mwork'];?>"></td>
					<td colspan="2"><input type="text" name="Mhobby_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Mhobby'];?>"></td>
					<td colspan="6"><input type="text" name="MWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['MWorkPlace'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">爷爷</th>
					<td ><input type="text" name="GrandFxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandFxueli'];?>"></td>
					<td ><input type="text" name="GrandFwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandFwork'];?>"></td>
					<td colspan="2"><input type="text" name="GrandFhobby_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandFhobby'];?>"></td>
					<td colspan="6"><input type="text" name="GrandFWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandFWorkPlace'];?>"></td>

				</tr>
				<tr class="cardtr">
					<th class="cardth">奶奶</th>
					<td ><input type="text" name="GrandMxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandMxueli'];?>"></td>
					<td ><input type="text" name="GrandMwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandMwork'];?>"></td>
					<td colspan="2"><input type="text" name="GrandMhobby_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandMhobby'];?>"></td>
					<td colspan="6"><input type="text" name="GrandMWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['GrandMWorkPlace'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">外公</th>
					<td ><input type="text" name="WGrandFxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandFxueli'];?>"></td>
					<td ><input type="text" name="WGrandFwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandFwork'];?>"></td>
					<td colspan="2"><input type="text" name="WGrandFhobby_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandFhobby'];?>"></td>
					<td colspan="6"><input type="text" name="WGrandFWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandFWorkPlace'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">外婆</th>
					<td ><input type="text" name="WGrandMxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandMxueli'];?>"></td>
					<td ><input type="text" name="WGrandMwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandMwork'];?>"></td>
					<td colspan="2"><input type="text" name="WGrandMhobby_card"  class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandMhobby'];?>"></td>
					<td colspan="6"><input type="text" name="WGrandMWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['WGrandMWorkPlace'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth">其他</th>
					<td ><input type="text" name="Otherxueli_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Otherxueli'];?>"></td>
					<td ><input type="text" name="Otherwork_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Otherwork'];?>"></td>
					<td colspan="2"><input type="text" name="Otherhobby_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['Otherhobby'];?>"></td>
					<td colspan="6"><input type="text" name="OtherWorkPlace_card" class="form-control" style="border:unset" value="<?php  echo $cardinfo['OtherWorkPlace'];?>"></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth"  colspan="2">主监护人</th>
					<td colspan="9">
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="1" style="float: none;"  <?php  if(in_array('1',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>父亲</label>
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="2" style="float: none;" <?php  if(in_array('2',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>母亲</label>
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="3" style="float: none;" <?php  if(in_array('3',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>爷爷</label>
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="4" style="float: none;" <?php  if(in_array('4',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>奶奶</label>
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="5" style="float: none;" <?php  if(in_array('5',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>外公</label>
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="6" style="float: none;" <?php  if(in_array('6',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>外婆</label>
						<label  class="checkbox-inline" style="width:9%;margin-left: 10px"><input  type="checkbox" name="MainWatcharr[]"  value="7" style="float: none;" <?php  if(in_array('7',$MainWatcharr)) { ?> checked="checked" <?php  } ?>>其他</label>
					</td>
				</tr>
				<tr class="cardtr">
					<th class="cardth"  colspan="2">孩子爱好</th>
					<td colspan="10"><textarea style="resize: none;border:unset" class="form-control richtext" name="Childhobby_card" rows="2"><?php  echo $cardinfo['Childhobby'];?></textarea></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth"  colspan="2">对孩子的期望</th>
					<td colspan="10"><textarea style="resize: none;border:unset" class="form-control richtext" name="ChildWord_card" rows="2"><?php  echo $cardinfo['ChildWord'];?></textarea></td>
				</tr>
				<tr class="cardtr">
					<th class="cardth"  colspan="2">对学校的期望</th>
					<td colspan="10"><textarea style="resize: none;border:unset"  class="form-control richtext" name="SchoolWord_card" rows="2"><?php  echo $cardinfo['SchoolWord'];?></textarea></td>
				</tr>	
			</table>
			<div class="modal-footer">	
				<button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="submit1" onclick="change_infocard(<?php  echo $student['id'];?>)" >确认修改</button>
			</div>		