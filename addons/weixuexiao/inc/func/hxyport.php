<?php

    $op = $_GPC['op'] ? $_GPC['op'] : 'default' ;

    if($op == 'default'){
        $result['error_code'] = 500;
        $result['error_msg'] = "无效请求";
        die(json_encode($result));
    }

    if($op == 'testport'){
        $GetData = json_encode($_GPC);
        $txtname = 'hxyport'.time().'.txt';
        $txtpath_name = IA_ROOT . '/attachment/down/' . $txtname;
       // var_dump($GetData);
        $file = fopen($txtpath_name, "w");
        fwrite($file, $GetData);
        fclose($file);
        $result['error_code'] = 00;
        $result['error_msg'] = "测试成功";
        die(json_encode($result));
    }

    if($op == 'newuser'){

        $data = $_GPC; //$data 根据实际情况改动
        $optype = $data['optype'];
        if($optype == 1){ //新增用户

        }elseif($optype == 2){ //修改用户

        }elseif($optype == 3){ //删除用户 

        }

    }
 