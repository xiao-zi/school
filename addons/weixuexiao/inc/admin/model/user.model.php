<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/7/29
 * Time: 17:03
 */
namespace admin\model;

use admin\model\model as model;
class user extends model{
    //参加密码加密方式
    private $PASSWORD_STR = 'fd2ecc96';
    //密码中替换规则
    private $PASSWORD_REPLACE = '/&((#(\d{3,5}|x[a-fA-F0-9]{4}));)/';
    //用户名的验证正则表达式 与微擎的验证方法保存统一
    private $REGULAR_USERNAME = '/^[\x{4e00}-\x{9fa5}a-z\d_\.]{3,30}$/iu';
    //密码的验证规则
    private $PASSWORD_VERIFICATION = '/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,30}/';
    //密码中指定的非法字符
    private $badStr = array("\0", '%00', '%3C', '%3E', '<?', '<%', '<?php', '{php', '{if', '{loop', '../');
    //设置密码非法字符替换的对象
    private $newStr = array('_', '_', '&lt;', '&gt;', '_', '_', '_', '_', '_', '_', '.._');
    //用户登录错误信息存储时间
    private $refused_login_limit = 10;
    //用户允许在限制时间中登录错误的次数
    private $refused_login_num = 3;
    //是否开启验证码 如果开启验证码需要使用redis
    private $verify_code = false;

    /**
     * 登录验证用户信息是否正确
     * @param $username
     * @param $password
     * @param string $verify
     * @return array
     */
    public function checkUserLoginInfo($username,$password,$verify = ''){
        $username = trim($username);
        //用户登录错误信息存储时间
        $refused_login_limit = $this->refused_login_limit;
        //用户允许在限制时间中登录错误的次数
        $refused_login_num = $this->refused_login_num;
        //删除之前用户登录错误信息
        pdo_delete('users_failed_login', array('lastupdate <' => TIMESTAMP - $refused_login_limit * 60));
        $failed = pdo_get('users_failed_login', array('username' => $username));
        if ($failed['count'] >= $refused_login_num) {
            return array('status'=>10002,'msg'=>"输入密码错误次数超过{$refused_login_num}次，请在{$refused_login_limit}分钟后再登录");
        }
        //是否开启验证码 如果开启验证码需要使用redis
        if($this->verify_code){
            if (empty($verify)) {
                return array('status'=>10002,'msg'=>'请输入验证码');
            }
        }
        if (empty($username)) {
            return array('status'=>10002,'msg'=>'请输入要登录的用户名');
        }
        if (empty($password)) {
            return array('status'=>10002,'msg'=>'请输入密码');
        }
        $member['username'] = $username;
        $member['password'] = $password;
        $member['type'] = USER_TYPE_COMMON;
        return array('status'=>10001,'msg'=>'SUCCESS','data'=>$member);
    }

    /**
     * 验证用户信息
     * @param $user
     * @return bool
     */
    public function user_single($user){
        if (empty($user)) {
            return false;
        }
        if (is_numeric($user)) {
            $user = array('uid' => $user);
        }
        if (!is_array($user)) {
            return false;
        }

        $where = ' WHERE 1 ';
        $params = array();
        if (!empty($user['uid'])) {
            $where .= ' AND u.`uid`=:uid';
            $params[':uid'] = intval($user['uid']);
        }
        if (!empty($user['username'])) {
            $where .= ' AND u.`username`=:username';
            $params[':username'] = $user['username'];

            $user_exists = $this->checkUser($user);
            $is_mobile = preg_match(REGULAR_MOBILE, $user['username']);
            if (!$user_exists && !empty($user['username']) && $is_mobile) {
                $sql = "select b.uid, u.username FROM " . tablename('users_bind') . " AS b LEFT JOIN " . tablename('users') . " AS u ON b.uid = u.uid WHERE b.bind_sign = :bind_sign";
                $bind_info = pdo_fetch($sql, array('bind_sign' => $user['username']));
                if (!is_array($bind_info) || empty($bind_info) || empty($bind_info['username'])) {
                    return false;
                }
                $params[':username'] = $bind_info['username'];
            }
        }
        if (!empty($user['email'])) {
            $where .= ' AND u.`email`=:email';
            $params[':email'] = $user['email'];
        }
        if (!empty($user['status'])) {
            $where .= " AND u.`status`=:status";
            $params[':status'] = intval($user['status']);
        }
        if (empty($params)) {
            return false;
        }
        $sql = 'SELECT u.*, p.avatar FROM ' . tablename('users') . ' AS u LEFT JOIN '. tablename('users_profile') . ' AS p ON u.uid = p.uid '. $where. ' LIMIT 1';

        $record = pdo_fetch($sql, $params);
        if (empty($record)) {
            return false;
        }
        if (!empty($user['password'])) {
            $password = $this->sha1Password($user['password'], $record['salt']);
            if ($password != $record['password']) {
                return false;
            }
        }
        $record['hash'] = md5($record['password'] . $record['salt']);

        unset($record['password'], $record['salt']);
        $founder_own_user_info = table('users_founder_own_users')->getFounderByUid($user['uid']);

        if (!empty($founder_own_user_info) && !empty($founder_own_user_info['founder_uid'])) {
            $vice_founder_info = pdo_getcolumn('users', array('uid' => $founder_own_user_info['founder_uid']), 'username');
            if (!empty($vice_founder_info)) {
                $record['vice_founder_name'] = $vice_founder_info;
            } else {
                pdo_delete('users_founder_own_users', array('founder_uid' => $founder_own_user_info['founder_uid'], 'uid' => $founder_own_user_info['uid']));
            }
        }
        if($record['type'] == ACCOUNT_OPERATE_CLERK) {
            $clerk = pdo_get('activity_clerks', array('uid' => $record['uid']));
            if(!empty($clerk)) {
                $record['name'] = $clerk['name'];
                $record['clerk_id'] = $clerk['id'];
                $record['store_id'] = $clerk['storeid'];
                $record['store_name'] = pdo_fetchcolumn('SELECT business_name FROM ' . tablename('activity_stores') . ' WHERE id = :id', array(':id' => $clerk['storeid']));
                $record['clerk_type'] = '3';
                $record['uniacid'] = $clerk['uniacid'];
            }
        } else {
            $record['name'] = $record['username'];
            $record['clerk_id'] = $user['uid'];
            $record['store_id'] = 0;
            $record['clerk_type'] = '2';
        }
        $third_info = pdo_getall('users_bind', array('uid' => $record['uid']), array(), 'third_type');
        if (!empty($third_info) && is_array($third_info)) {
            $record['qq_openid'] = $third_info[USER_REGISTER_TYPE_QQ]['bind_sign'];
            $record['wechat_openid'] = $third_info[USER_REGISTER_TYPE_WECHAT]['bind_sign'];
            $record['mobile'] = $third_info[USER_REGISTER_TYPE_MOBILE]['bind_sign'];
        }
        $record['notice_setting'] = iunserializer($record['notice_setting']);
        dump($record);
        return $record;
    }
    /**
     * @param $user
     * @return array
     */
    public function saveUser($user){
        //验证用户名,密码是否符合要求
        $checkResult = $this->checkUserInfo($user);
        if (!is_false($checkResult)) {
            return $checkResult;
        }
        if(!empty($user['endtime'])){
            $user['endtime'] = time()+60*60+$user['endtime'];
        }
        unset($user['vice_founder_name']);
        unset($user['repassword']);
        $result = $this->user_register($user, 'admin');
        return $result;
    }

    /**
     * 用户注册
     * @param $user
     * @param $source
     * @return int
     */
    function user_register($user, $source) {
        if (empty($user) || !is_array($user)) {
            return 0;
        }
        if (isset($user['uid'])) {
            unset($user['uid']);
        }
        $user['salt'] = random(8);
        $user['password'] = $this->sha1Password($user['password'], $user['salt']);
        $user['joinip'] = getIpAddress();
        $user['joindate'] = time();
        $user['lastip'] = getIpAddress();
        $user['lastvisit'] = time();
        if (empty($user['status'])) {
            $user['status'] = 2;
        }
        if (empty($user['type'])) {
            $user['type'] = USER_TYPE_COMMON;
        }
        $result = pdo_insert('users', $user);
        if ($result) {
            return array('status'=>10001,'msg'=>'SUCCESS','data'=>pdo_insertid());
        }else{
            return array('status'=>10002,'msg'=>'非常抱歉，此用户注册失败！');
        }

    }

    /**
     * 用户密码加密处理
     * @param $password
     * @param $salt
     * @return string
     */
    function sha1Password($password, $salt){
        $password = "{$password}-{$salt}-{$this->PASSWORD_STR}";
        return sha1($password);
    }
    /**
     * 添加用户验证用户的字段
     * @param $user
     * @return array|bool
     */
    private function checkUserInfo($user){
        //验证用户名是否符合规则
        if (!preg_match($this->REGULAR_USERNAME, $user['username'])) {
            return array('status'=>10002,'msg'=>'必须输入用户名，格式为 3-30 位字符，可以包括汉字、字母（不区分大小写）、数字、下划线和句点。');
        }
        //验证用户名是否存在
        if ($this->checkUsername($user['username'])) {
            return array('status'=>10002,'msg'=>'非常抱歉，此用户名已经被注册，你需要更换注册名称！');
        }
        //验证密码长度
        if (istrlen($user['password']) < 8) {
            return array('status'=>10003,'msg'=>'必须输入密码，且密码长度不得低于8位。');
        } else {
            $check_pass = $this->passwordVerification($this->StrDeal($user['password']));
            if (!is_false($check_pass)) {
                return $check_pass;
            }
        }
        //验证验证密码和密码是否一致
        if (trim($user['password']) !== trim($user['repassword'])) {
            return array('status'=>10003,'msg'=>'两次密码不一致!');
        }
        return array('status'=>10001,'msg'=>'SUCCESS');
    }

    /**
     * 检查用户名是否正确
     * @param $username
     * @return bool
     */
    private function checkUsername($username){
        $sql = 'SELECT `password`,`salt` FROM ' . tablename('users') . " WHERE 1 AND `username`='{$username}' LIMIT 1";
        $record = pdo_fetch($sql);
        if (empty($record) || empty($record['password']) || empty($record['salt'])) {
            return false;
        }
        return true;
    }
    /**
     * 密码的验证
     * @param $password
     * @return array|bool
     */
    function passwordVerification($password) {
//        $setting = setting_load('register');
//        if (!$setting['register']['safe']) {
//            return array('status'=>10001,'msg'=>'SUCCESS');
//        }
        preg_match($this->PASSWORD_VERIFICATION, $password, $out);
        if (empty($out)) {
            return array('status'=>10002,'msg'=>'密码至少8-16个字符，至少1个大写字母，1个小写字母和1个数字，其他可以是任意字符');
        } else {
            return array('status'=>10001,'msg'=>'SUCCESS');
        }
    }

    /**
     * 字符串的处理
     * @param $value
     * @param string $default
     * @return mixed|null|string|string[]
     */
    public function StrDeal($value, $default = '') {
        $value = $this->replacePasswordBadStr($value);
        $value = preg_replace($this->PASSWORD_REPLACE, '&\\1', $value);
        if (empty($value) && $default != $value) {
            $value = $default;
        }
        return $value;
    }
    /**
     * 替换掉密码的指定非法字符
     * @param $string
     * @return mixed|string
     */
    private function replacePasswordBadStr($string) {
        if (empty($string)) {
            return '';
        }
        $badStr = $this->badStr;
        $newStr = $this->newStr;
        $string = str_replace($badStr, $newStr, $string);
        return $string;
    }

    /**
     * @param $user
     * @return bool
     */
    public function checkUser($user) {
        if (empty($user) || !is_array($user)) {
            return false;
        }
        $where = ' WHERE 1 ';
        $params = array();
        if (!empty($user['uid'])) {
            $where .= ' AND `uid`=:uid';
            $params[':uid'] = intval($user['uid']);
        }
        if (!empty($user['username'])) {
            $where .= ' AND `username`=:username';
            $params[':username'] = $user['username'];
        }
        if (!empty($user['status'])) {
            $where .= " AND `status`=:status";
            $params[':status'] = intval($user['status']);
        }
        if (empty($params)) {
            return false;
        }
        $sql = 'SELECT `password`,`salt` FROM ' . tablename('users') . "$where LIMIT 1";
        $record = pdo_fetch($sql, $params);
        if (empty($record) || empty($record['password']) || empty($record['salt'])) {
            return false;
        }
        if (!empty($user['password'])) {
            $password = $this->sha1Password($user['password'], $record['salt']);
            return $password == $record['password'];
        }
        return true;
    }
}