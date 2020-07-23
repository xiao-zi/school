<?php
/**
 * 微学校模块
 *
 * @author 微学校团队
 */

global $_GPC, $_W;

$weid              = $_W['uniacid'];
$action            = 'zdytest';
$this1             = 'no6';
$schoolid          = intval($_GPC['schoolid']);
$GLOBALS['frames'] = $this->getNaveMenu($_GPC['schoolid'], $action);
$logo              = pdo_fetch("SELECT logo,title FROM " . tablename($this->table_index) . " WHERE id = '{$schoolid}'");
$operation         = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$tid_global = $_W['tid'];
mload()->model('kc');
if($operation == 'display'){

    if($_GPC['out_putcode'] == 'out_putcode'){
        $year = $_GPC['SelectYear'] ? $_GPC['SelectYear'] : date('Y');
        $monthdata = GetDfl($weid,$schoolid,$year,1,0);
        $ii   = 0;
        $arr = [];
        $tit_array = [];
        $tit_array[0] = "月份";
        foreach($monthdata as $index => $row){
            $tit_array[$ii+1] = GetName($index);
            foreach($row as $k => $v){
                $arr[$k][0] = $k+1 ."月";
                $arr[$k][$ii+1] = $v;
            }
            $ii++;
        }
        $this->exportexcel($arr, $tit_array, $year.'每月课程情况详情');
        exit();
    }
    include $this->template('web/zdytest');
}elseif($operation == 'GetData'){
    $year = $_GPC['year'] ? $_GPC['year'] : date('Y');
    $monthdata = GetDfl($weid,$schoolid,$year,1,0);
    foreach($monthdata as $k => $v){
        $monthdata[$k]['name'] = GetName($k);
        $monthdata[$k]['type'] = 'line';
        $monthdata[$k]['data'] = $v;
    }

    $quarterdata = GetDfl($weid,$schoolid,$year,2,0);
    foreach($quarterdata as $k => $v){
        $quarterdata[$k]['name'] = GetName($k);
        $quarterdata[$k]['type'] = 'line';
        $quarterdata[$k]['data'] = $v;
    }
    
    $halfyeardata = GetDfl($weid,$schoolid,$year,3,0);
    foreach($halfyeardata as $k => $v){
        $halfyeardata[$k]['name'] = GetName($k);
        $halfyeardata[$k]['type'] = 'bar';
        $halfyeardata[$k]['data'] = $v;
    }

    $yeardata = GetDfl($weid,$schoolid,$year,4,0);
    foreach($yeardata as $k => $v){
        $yeardata[$k]['name'] = GetName($k);
        $yeardata[$k]['type'] = 'bar';
        $yeardata[$k]['data'] = $v;
    }
    

    $return_data = array(
        'return_data_a' => array(
            'xAxis_data' => array('一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'),
            'series' => $monthdata,
        ),
        'return_data_b' => array(
            'xAxis_data' => array('一季度','二季度','三季度','四季度'),
            'series' => $quarterdata,
        ),
        'return_data_c' => array(
            'xAxis_data' => array('上半年','下半年'),
            'boundaryGap' => true,
            'series' => $halfyeardata,
        ),
        'return_data_d' => array(
            'xAxis_data' => array('全年'),
            'boundaryGap' => true,
            'series' => $yeardata,
        ),
    );
   
    die(json_encode($return_data));
}

function GetName($v){
    if($v == 0){
        $name = '到访率';
    }elseif($v == 1){
        $name = '成单率';
    }elseif($v == 2){
        $name = '续班率';
    }elseif($v == 3){
        $name = '消课率';
    }elseif($v == 4){
        $name = '满班率';
    }
    return $name;
}
?>