<?php defined('IN_IA') or exit('Access Denied');?>

<div class="modal-content" >
    <div class="modal-header" style="color: black;">
        <h4 class="modal-title" id="ModalTitle1">设置考勤推送对象</h4>
    </div>
    <div class="modal-body" id="detail_checksend">
        <form id="upsence_form" method="post" class="form-horizontal form" >
            <input type="hidden" name="schoolid" value="<?php  echo $schoolid;?>" />
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">班级名称</label>
                        <div class="col-sm-9">
                            <span class="form-control" id="bj_name_show_check"  style="border:unset"><?php  echo $bjinfo['sname'];?> </span>
                            <input type="hidden" name="bj_id" id="this_bjid_checksend" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">考勤推送对象</label>
                        <div class="col-sm-9 col-xs-6">
                            <div class="input-group text-info">
                                <label  class="checkbox-inline" ><input id="checksend_stu" type="checkbox" class="check_bj"  name="checkarr[]" value="students" style="margin-top: 3px;" <?php  if(in_array('students',$checksendset)) { ?> checked="true"<?php  } ?>>学生本人</label>
                                <label  class="checkbox-inline" ><input id="checksend_pare" type="checkbox" class="check_bj"  name="checkarr[]" value="parents" style="margin-top: 3px;" <?php  if(in_array('parents',$checksendset)) { ?> checked="true"<?php  } ?>>学生家长</label>
                                <label  class="checkbox-inline" ><input id="checksend_ht" type="checkbox" class="check_bj"  name="checkarr[]" value="head_teacher" style="margin-top: 3px;" <?php  if(in_array('head_teacher',$checksendset)) { ?> checked="true"<?php  } ?>>班主任</label>
                                <label  class="checkbox-inline" ><input id="checksend_rt" type="checkbox" class="check_bj"  name="checkarr[]" value="rest_teacher" style="margin-top: 3px;" <?php  if(in_array('rest_teacher',$checksendset)) { ?> checked="true"<?php  } ?>>授课老师</label>

                            </div>
                            <div class="help-block">如不设置或全部取消勾选，则为采用学校默认设置</div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" id="close_modal1" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="submit1" onclick="savechecksend(<?php  echo $bjid;?>)" >确认设置</button>
    </div>
</div>