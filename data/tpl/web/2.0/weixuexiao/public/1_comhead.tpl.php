<?php defined('IN_IA') or exit('Access Denied');?><style>
.col-sm-1 {padding:10px}
.require{color: red}
.bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-primary, .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-primary {color: #fff;background: #a0053b;}
.btn-primary {color: #fcfafa;background-color: #41cac0;border-color: #ffffff;}
.list-group .list-group-item.active {background-color: #41cac0;border-color: #f3f0f2;}
.nav-tabs >li:hover{color: #ff8534;background-color:initial}
.nav-tabs > li >a:hover{color: #ff8534;background-color:initial}
.nav-tabs>li.active>a{background-color: initial;}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {color: #ff8534;background-color: initial;}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus { color: #ff8534; cursor: default; border: 0px solid #ddd;}
.nav-tabs > li.active{border-bottom: 2.5px solid #ff8534;}
.btn-primarys{color: #fc9c6b;background-color: #fff;border-color: #fc9c6b;}
.btn-defaults{background-color: #fff;border-color: #ddd;color: #797979;}
.btn-defaults:hover{color: #fc9c6b;}
.panel-info > .panel-heading {color: #333;background-color: #d9edf7;border-color: #bce8f1;}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {z-index: 2;color: #fff;cursor: default;background-color: #41cac0;border-color: #41cac0;}
.daterangepicker .ranges li.active, .daterangepicker .ranges li:hover {background: #41cac0;border: 1px solid #41cac0;color: #fff;}
.daterangepicker td.active, .daterangepicker td.active:hover {background-color: #d9534f;border-color: #ffffff;color: #fff;}
.input-group-addon {padding: 6px 12px;font-size: 14px;font-weight: 400;line-height: 1;color: #555;text-align: center;background-color: #f9f5f3;border: 1px solid #ccc;border-radius: 4px;}
.form-control-excel {height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
.ibox {clear: both;margin-bottom: 25px;margin-top: 0;padding: 0;box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);}
.ibox-title {-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background-color: #ffffff;border-color: #e7eaec;-webkit-border-image: none;-o-border-image: none;border-image: none;border-width: 4px 0px 0;color: inherit;margin-bottom: 0;padding: 14px 15px 7px;min-height: 48px;}
.ibox-content {clear: both;background-color: #ffffff;color: inherit;padding: 15px 20px 20px 20px;border-color: #e7eaec;-webkit-border-image: none;-o-border-image: none;border-image: none;border-style: solid solid none;border-width: 1px 0px;}	
.text-info {color: #23c6c8;}
.font-bold {font-weight: 600;}
.stat-percent {float: right;}
.slide_li::before { content: ""; position: absolute; top: 0; left: 100%; width: 0; height: 100%; border-bottom: 3px solid #ff8534; transition: 0.1s all linear; }
.slide_li.act::before { width: 25%; top: 0; left: 0; margin-left:38%; transition-delay: 0.1s; border-bottom-color: #ff8534; }
.slide_li.act ~ .slide_li::before { left: 0; color:#ff8534}
.act >a{color:#ff8534 !important}
</style>
<?php  if(IMS_VERSION >=0.99) { ?>
<?php  if($_GPC['do'] == 'banners' || $_GPC['do'] == 'comad' || $_GPC['do'] == 'comload' || $_GPC['do'] == 'guid' || $_GPC['do'] == 'basic' || $_GPC['do'] == 'fenzu' || $_GPC['do'] == 'manager' || $_GPC['do'] == 'loginctrl' || $_GPC['do'] == 'sms' || $_GPC['do'] == 'upgrade' || $_GPC['do'] == 'binding' || $_GPC['do'] == 'school' || $_GPC['do'] == 'refund') { ?>
<?php  } else { ?>
<style>
<?php  if($_GPC['do'] != 'manger_apps') { ?>
.we7-modal-dialog, .modal-dialog {min-width: 720px!important;position: absolute;left: 30%;top: 10%;}
<?php  } ?>
</style>
<?php  } ?>
<?php  } ?>