<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/4/28
 * Time: 9:40
 */

/**
 * 打印数据结构
 * @param $data 需要打印的数据
 */
function dump($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

/**
 * @param $name
 * @return bool
 */
function M($name){
    $file = IA_ROOT . '/addons/weixuexiao/inc/model/' . $name . '.php';
    if (file_exists($file)) {
        include $file;
        return new $name();
    } else {
        trigger_error('Invalid Model /addons/weixuexiao/inc/model/' . $name . '.php', E_USER_ERROR);
        return false;
    }
}
/**
 * 把二维数组的图片转成可用的图片
 * @param $data 二维数组
 * @param $k 键
 * @return mixed 返回新的额二维数组
 */
function getDataImg(&$data,$k){
    foreach ($data as $key=>$value){
        $data[$key][$k] = tomedia($value[$k]);
    }
    return $data;
}

/**
 * 获取学校食谱
 * @param $schoolid 学校id
 * @param $time 日期
 * @return mixed 返回日期的食谱 2020-04-29
 */
function getSchoolFood($schoolid,$time){
    $date = explode ('-', $time);
    $start = mktime(0,0,0,$date[1],$date[2],$date[0]);
    $end = $start + 86399;
    $condition = " AND begintime <= '{$start}' AND endtime >= '{$end}'";
    //根据时间和排序查找到一条食谱信息
    $cookbook = pdo_fetch("SELECT * FROM " . tablename('wx_school_cookbook') . " WHERE schoolid = '{$schoolid}' AND ishow = 1 $condition Order BY id,sort asc");
    if($cookbook){
        $week = date("w",$start);
        $key = $str = '';
        switch ($week){
            case 1:$key = 'monday';$str = 'mon_'; break;
            case 2:$key = 'tuesday';$str = 'tue_'; break;
            case 3:$key = 'wednesday';$str = 'wed_'; break;
            case 4:$key = 'thursday';$str = 'thu_'; break;
            case 5:$key = 'friday';$str = 'fri_'; break;
            case 6:$key = 'saturday';$str = 'sat_'; break;
            case 0:$key = 'sunday';$str = 'sun_'; break;
        }
        $cook = iunserializer($cookbook[$key]);
        $result = array(
            'status'=>'1001',
            'data'=>array(
                'zc'=>$cook[$str.'zc'],
                'zcpid'=>$cook[$str.'zc_pic'],
                'zjc'=>$cook[$str.'zjc'],
                'zjcpic'=>$cook[$str.'zjc_pic'],
                'wc'=>$cook[$str.'wc'],
                'wcpic'=>$cook[$str.'wc_pic'],
                'wjc'=>$cook[$str.'wjc'],
                'wjcpic'=>$cook[$str.'wjc_pic'],
                'wwc'=>$cook[$str.'wwc'],
                'wwcpic'=>$cook[$str.'wwc_pic'],
            )
        );
    }else{
        $result = array(
            'status'=>'1002',
            'data'=>array()
        );
    }
    return $result;
}

/**
 * 返回json格式的结果集
 * @param $data
 */
function json_encodeBack($data){
    echo json_encode($data);die();
}

/**
 * 通过状态码返回json格式的数据
 * @param $status
 * @param array $data
 * @throws ReflectionException
 */
function returnJsonBack($status,$data= array()){
    echo json_encode(array('status'=>$status,'msg'=>getAppConfig('status',$status),'data'=>$data));die();
}

/**
 * 对用户密码加密处理
 * @param $password
 * @return string
 * @throws ReflectionException
 */
function encryptionPassword($password){
    //该参数不可改变，一旦改变，用户密码全部失效
    $key = getAppConfig('config','PASSWORD_KEY');
    $newPassword = md5($password.$key);
    return $newPassword;
}

/**
 * 验证手机号是否正确
 * @param $phone
 * @return bool
 * @throws ReflectionException
 */
function check_phone($phone){
    return checkRegular($phone,'CHINA_PHONE');
}

/**
 * 验证密码是否符合规则
 * @param $password
 * @return bool
 * @throws ReflectionException
 */
function check_password($password){
    return checkRegular($password,'CHECK_PASSWORD');
}

/**
 * 使用JWT对用户信息加密生成TOKEN
 * @param $data
 * @return string
 * @throws ReflectionException
 */
function generateToken($data){
    $key = getAppConfig('config','JWT_KEY');
    $jwt = new \Firebase\JWT\JWT();
    $Token = $jwt::encode($data,$key);
    return $Token;
}

/**
 * 使用JWT对用户信息TOKEN解密
 * @param $Token
 * @return array
 * @throws ReflectionException
 */
function decryptToken($Token){
    $over = getAppConfig('config','TOKEN_OVER');
    $day = getAppConfig('config','TOKEN_OVER_DAY');
    $key = getAppConfig('config','JWT_KEY');
    $jwt = new \Firebase\JWT\JWT();
    //对Token解密处理
    try{
        $data = json_decode(json_encode(@$jwt::decode($Token,$key, array('HS256'))),true);
    }catch (Exception $e){
        return array('status'=>10002,'msg'=>'解密失败!');
    }

    if($over){
        $over_time = $data['user']['time']+$day*60*60*20;
        if(time() <= $over_time){
            return array('status'=>'10103','msg'=>getAppConfig('status',10103));
        }else{
            return check_user_info($data);
        }
    }else{
        return check_user_info($data);
    }
}

/**
 * 验证用户信息是否正确
 * @param $data
 * @return array
 */
function check_user_info($data){
    //验证Token的用户信息是否正确
    $user = pdo_fetch("SELECT * FROM " . tablename('app_school_user') . " where mobile = :mobile And id=:id ", array(':mobile' => $data['user']['phone'],':id' => $data['user']['id']));

    if(empty($user)){
        return array('status'=>10002,'msg'=>'非法请求！');
    }else{
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$data);
    }
}

/**
 * 获取自己配置的一些信息
 * @param $static 静态数组
 * @param bool $key 键值
 * @return mixed
 * @throws ReflectionException
 */
function getAppConfig($static,$key = false){
    include_once 'appConfig.php';
    $class = new ReflectionClass('AppConfig');
    $data= $class->getStaticProperties();
    if($key){
        $result = $data[$static][$key];
    }else{
        $result = $data[$static];
    }
    return $result;
}

/**
 * 验证正则是否符合规则
 * @param $value 验证的字段
 * @param $regular 配置的正则表达式的key
 * @return bool
 * @throws ReflectionException
 */
function checkRegular($value,$regular){
    if (preg_match(getAppConfig('config',$regular), $value)) {
        return true;
    } else {
        return false;
    }
}

/**
 * app 短信验证码发送
 * @param $mobile
 * @param $school_id
 * @throws ReflectionException
 */
function send_mobile_code($mobile,$school_id){
    mload()->model('sms');
    $weid = 0;//公众号默认为0
    $mobile = trim($mobile);
    $school_id = intval($school_id);
    $sms_config = getAppConfig('sms');
    $resttime = empty($sms_config['MOBILE_CODE_OVER_TIME']) ? 1800 : intval($sms_config['MOBILE_CODE_OVER_TIME']);
    pdo_query('DELETE FROM ' . tablename('uni_verifycode') . ' WHERE `createtime`<' . (TIMESTAMP - $resttime));
    $pars = array(
        ':receiver'=>$mobile,
        ':uniacid'=>$weid
    );
    $row = pdo_fetch('SELECT * FROM ' . tablename('uni_verifycode') . ' WHERE `receiver`=:receiver AND `uniacid`=:uniacid', $pars);
    $record = array();
    if(!empty($row)) {
        if($row['total'] >= 5) {
            $data ['result'] = false;
            $data ['msg'] = '发送失败,请联系管理员';
        }
        $code = $row['verifycode'];
        $record['total'] = $row['total'] + 1;
    } else {
        $code = random(6, true);
        $record['uniacid'] = $weid;
        $record['receiver'] = $mobile;
        $record['verifycode'] = $code;
        $record['total'] = 1;
        $record['createtime'] = TIMESTAMP;
    }
    if(!empty($row)) {
        pdo_update('uni_verifycode', $record, array('id' => $row['id']));
    } else {
        pdo_insert('uni_verifycode', $record);
    }
    $content = array(
        'code' => $code
    );
    $result = sms_send($mobile, $content, $sms_config['KeyId'], $sms_config['KeySecret'], 'code', $weid, $school_id);
    if($result['Code'] == 'OK') {
        $data ['result'] = true;
        $data ['msg'] = '验证码发送成功, 请注意查收';
    }else{
        $data ['result'] = false;
        if($sms_config['is_show'] == 1){
            $data ['msg'] = "发送失败,原因".$result['Message'];
        }else{
            $data ['msg'] = "发送失败,请联系管理员";
        }
    }
    json_encodeBack($data);
}

/**
 * 验证短信验证码
 * @param $mobile
 * @param $code
 * @return array
 * @throws ReflectionException
 */
function check_mobile_code($mobile, $code){
    $mobile_code = pdo_fetch("SELECT createtime FROM ".tablename('uni_verifycode')." WHERE receiver = :receiver And verifycode = :verifycode ", array(':receiver' => $mobile, ':verifycode' => $code));
    if(!empty($mobile_code)){
        $result = array('status'=>10104,'msg'=>'请输入短信验证码');
    }else{
        $time = TIMESTAMP - $mobile_code['createtime'];
        if(getAppConfig('sms','MOBILE_CODE_OVER_TIME') > $time){
            $result = array('status'=>10105,'msg'=>'短信验证码超时');
        }else{
            $result = array('status'=>10001,'msg'=>'SUCCESS');
        }
    }
    return $result;
}

/**
 * 上传图片
 * @param $img
 * @return string
 */
function upload_img($img){
    load()->func('communication');
    load()->func('file');
    $token = $this->getAccessToken2();
    $url = 'https://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$img;
    $pic_data = ihttp_request($url);
    $path = "images/weixuexiao/img/";
    $picurl = $path.random(30) .".jpg";
    file_write($picurl,$pic_data['content']);
    if (!empty($_W['setting']['remote']['type'])) {
        $remotestatus = file_remote_upload($picurl);
        if (is_error($remotestatus)) {
            message('远程附件上传失败，请检查配置并重新上传');
        }
    }
    return $picurl;
}

/**
 * 获取用户角色
 * @param $part
 * @param $type
 * @return string
 */
function getRelationship($part,$type = false){
    switch ($part){
        case 2:$str = '母亲';break;
        case 3:$str = '父亲';break;
        case 4:
            if($type){
                $str = '';break;
            }else{
                $str = '本人';break;
            }
        case 5:$str = '家长';break;
        default : $str ='';
    }
    return $str;
}

/**
 * 匹配敏感词
 * @param $content
 * @return bool
 */
function sensitiveWord($content){
    //获取敏感词
    $wordArr = getConfig('Sensitive');
    foreach ($wordArr as $key=>$value){
        if(empty($value)){
            continue;
        }
        if(strpos($content, trim(trim($value), ',')) !== false){//找到之后跳出循环
            return $value;
        }
    }
    return false;
}

/**
 * 引入自定义的类和方法
 * @return load
 */
function appLoad(){
    include_once 'load.php';
    static $load;
    if (empty($load)) {
        $load = new load();
    }
    return $load;
}

/**
 * 根据二维数组的键去重
 * @param $arr
 * @param $key
 * @return mixed
 */
function array_unqiue_key(&$arr,$key){
    $tmp_arr = array();
    foreach($arr as $k => $v)
    {
        if(in_array($v[$key], $tmp_arr))   //搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
        {
            unset($arr[$k]); //销毁一个变量  如果$tmp_arr中已存在相同的值就删除该值
        }
        else {
            $tmp_arr[$k] = $v[$key];  //将不同的值放在该数组中保存
        }
    }
    return $arr;
}

/**
 * 根据地区获取该地区的经纬度
 * @param $address
 * @return array
 */
function get_Latitude_longitude($address){
    $url='http://api.map.baidu.com/geocoder/v2/?address='.$address.'&output=json&ak=Bsr5iefxHEwQD8iCFTx3GwWOem0ZoSBk';
    $result=file_get_contents($url);
    if($result)
    {
        $arr= explode(',"lat":', substr($result, 40,36));
        return $arr;
    }
}

/**
 * 根据经度纬度计算距离
 * @param $lat1
 * @param $lng1
 * @param $lat2
 * @param $lng2
 * @return float|int
 */
function distance($lat1, $lng1, $lat2, $lng2){

    $earthRadius = 6367000; //approximate radius of earth in meters
    $lat1 = ($lat1 * pi() ) / 180;
    $lng1 = ($lng1 * pi() ) / 180;
    $lat2 = ($lat2 * pi() ) / 180;
    $lng2 = ($lng2 * pi() ) / 180;
    $calcLongitude = $lng2 - $lng1;
    $calcLatitude = $lat2 - $lat1;
    $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
    $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
    $calculatedDistance = $earthRadius * $stepTwo;
    return round($calculatedDistance);
}

/**
 * 获取配置文件的配置
 * @param $config
 * @param bool $key
 * @return bool|mixed
 */
function getConfig($config,$key = false){
    $file = IA_ROOT . '/addons/weixuexiao/inc/app/config/' . $config . '.php';
    if (file_exists($file)) {
        $data = include($file);
        if($key){
            return $data[$key];
        }else{
            return $data;
        }
    } else {
        trigger_error('Invalid Model /addons/weixuexiao/inc/app/config/' . $config . '.php', E_USER_ERROR);
        return false;
    }
}

/**
 * 把二维数组的指定的key的值作为键，并返回新数组
 * @param $arr
 * @param $key
 * @return array
 */
function set_array_key($arr,$key){
    $new_arr = array();
    foreach ($arr as $key_a=>$value){
        $new_arr[$value[$key]]=$value;
    }
    return $new_arr;
}

/**
 * 获取时间戳的星期
 * @param $time
 * @return string
 */
function get_time_week($time){
    $week = date('w',$time);
    switch ($week){
        case 0:$str = '星期日';break;
        case 1:$str = '星期一';break;
        case 2:$str = '星期二';break;
        case 3:$str = '星期三';break;
        case 4:$str = '星期四';break;
        case 5:$str = '星期五';break;
        case 6:$str = '星期六';break;
        default :$str = '星期日';break;
    }
    return $str;
}

/**
 * 获取文件绝对路径
 * @param $file
 * @return string
 */
function get_file_address(&$file){
    $file = ATTACHMENT_ROOT.$file;
}


/**
 * 根据二维数组的键从新排序
 * @param $array
 * @param $keys
 * @param string $type
 * @return array
 */
function array_key_sorts($array,$keys,$type='asc'){
    $key_value = $new_array = array();
    foreach ($array as $k=>$v){
        $key_value[$k] = $v[$keys];
    }
    if($type == 'asc'){
        asort($key_value);
    }else{
        arsort($key_value);
    }
    reset($key_value);
    foreach ($key_value as $k=>$v){
        $new_array[$k] = $array[$k];
    }
    return $new_array;
}
/**
 * 获取距今已经有多长时间
 * @param $time
 * @return string
 */
function get_time_str($time){
    $value = TIMESTAMP - $time;
    if ($value < 0) {
        return '';
    } elseif ($value >= 0 && $value < 59) {
        return $value + 1 . "秒";
    } elseif ($value >= 60 && $value < 3600) {
        $min = intval($value / 60);
        return $min . " 分钟";
    } elseif ($value >= 3600 && $value < 86400) {
        $h = intval($value / 3600);
        return $h . " 小时";
    } elseif ($value >= 86400 && $value < 86400 * 30) {
        $d = intval($value / 86400);
        return intval($d) . " 天";
    } elseif ($value >= 86400 * 30 && $value < 86400 * 30 * 12) {
        $mon = intval($value / (86400 * 30));
        return $mon . " 月";
    } else {
        $y = intval($value / (86400 * 30 * 12));
        return $y . " 年";
    }
}

/**
 * 计算字符串长度（无论是不是中文）
 * @param null $string
 * @return int
 */
function utf8_strlen($string = null) {
    // 将字符串分解为单元
    preg_match_all("/./us", $string, $match);
    // 返回单元个数
    return count($match[0]);
}

/**
 * 获取数组中,一组数据
 * @param $array 数组
 * @param $value 值
 * @param bool $key 是否指定值
 * @return mixed
 */
function getArrayValue($array,$value,$key=false){
    if($key == false){
        return $array[$value];
    }else{
        foreach ($array as $k=>$val){
            if($val[$key] == $value){
                return $array[$k];
            }
        }
    }
}

/**
 * 生成随机字符串
 * @param $len
 * @param null $chars
 * @return string
 */
function getRandString($len, $chars=null){
    if (is_null($chars)){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }
    mt_srand(10000000*(double)microtime());
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        $str .= $chars[mt_rand(0, $lc)];
    }
    return $str;
}
/**
 * 表情库
 * @param $content
 * @return null|string|string[]
 */
function EmoticonLibrary($content){
    $content = preg_replace_callback("/\[([^\]]+)\]/",function($out){
        $library = getConfig("EmoticonLibrary");
        $face_map_url = OSSURL."public/mobile/img/face/";
        return "<img class='face_icon' style='width: 20px;' src='" .$face_map_url.$library[$out[1]] . ".gif'>";
    },$content);
    return $content;
}
/**
 * 删除文件
 * @param $pic
 * @return array
 */
function delpic($pic){
    if($pic){
        $url = strlen('http://'.$_SERVER['HTTP_HOST'].'/');
        $ifurl = strpos($pic,'uploads');
        if($ifurl>10){
            if(file_exists(substr($pic, $url))){
                $res = unlink(substr($pic, $url));
                if($res){
                    $return = array('success'=>1,'errors'=>'删除图片或文件成功');
                }else{
                    $return = array('success'=>0,'errors'=>'操作失误导致图片或文件无法删除');
                }
            }else{
                $return = array('success'=>404,'errors'=>'无法找到文件或者已经删除');
            }
        }else{
            if(file_exists($pic)){
                $res = unlink($pic);
                if($res){
                    $return = array('success'=>1,'errors'=>'删除图片成功');
                }else{
                    $return = array('success'=>0,'errors'=>'操作失误导致图片或文件无法删除');
                }
            }else{
                $return = array('success'=>404,'errors'=>'无法找到文件或者已经删除');
            }
        }
    }else{
        $return = array('success'=>404,'errors'=>'请传送正确图片或文件地址');
    }
    return $return;
}




