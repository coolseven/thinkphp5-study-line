<?php

namespace app\backend\controller;


use think\Db;

class System extends Common
{
    /**
     * 系统配置
     */
    public function config()
    {
        $open_auth = config('auth_config')['open_auth'];
        $this->assign('sub_title',"系统配置");
        $this->assign('open_auth',implode(',',$open_auth));
        return $this->fetch();
    }

    /**
     *
     * @return mixed
     */
    public function basicConfig()
    {
        $file = CONF_PATH . 'extra/webinfo.php';
        $config = array_merge(include $file, array_change_key_case($_POST, CASE_UPPER));
        // 以下将一个数组转换成一个字符串
        $str = "<?php\r\n return " . var_export($config, true) . ";\r\n?>";
        if (file_put_contents($file, $str)) {
            return $this->success('系统信息修改成功');
        }
        return $this->success('系统信息修改失败');
    }

    /**
     * 这里如果修改session的配置信息，应该是直接退出登录的
     */
    public function sessionConfig()
    {
        $file = CONF_PATH . 'extra/session.php';
        $config = array_merge(include $file, array_change_key_case($_POST, CASE_LOWER));
        // 以下将一个数组转换成一个字符串
        $str = "<?php\r\n return " . var_export($config, true) . ";\r\n?>";
        if (file_put_contents($file, $str)) {
            return $this->success('Session信息修改成功',"backend/login/login");
        }
        return $this->success('Session信息修改失败');
    }

    /**
     * @return mixed
     */
    public function emailConfig()
    {
        $file = CONF_PATH . 'extra/email.php';
        $config = array_merge(include $file, array_change_key_case($_POST, CASE_UPPER));
        // 以下将一个数组转换成一个字符串
        $str = "<?php\r\n return " . var_export($config, true) . ";\r\n?>";
        if (file_put_contents($file, $str)) {
            return $this->success('系统信息修改成功');
        }
        return $this->success('系统信息修改失败');
    }

    /**
     * @return mixed
     */
    public function wechatConfig()
    {
        $file = CONF_PATH . 'extra/wechat.php';
        $config = array_merge(include $file, array_change_key_case($_POST, CASE_UPPER));
        // 以下将一个数组转换成一个字符串
        $str = "<?php\r\n return " . var_export($config, true) . ";\r\n?>";
        if (file_put_contents($file, $str)) {
            return $this->success('系统信息修改成功');
        }
        return $this->success('系统信息修改失败');
    }

    /**
     * 权限配置
     * @return mixed
     */
    public function authConfig()
    {
        $file = CONF_PATH . 'extra/auth_config.php';
        halt($_POST);
        $config = array_merge(include $file, array_change_key_case($_POST, CASE_LOWER));
        // 以下将一个数组转换成一个字符串
        $str = "<?php\r\n return " . var_export($config, true) . ";\r\n?>";
        if (file_put_contents($file, $str)) {
            return $this->success('系统信息修改成功');
        }
        return $this->success('系统信息修改失败');
    }

    /**
     * @return mixed
     */
    public function payConfig()
    {
        $this->assign('sub_title',"支付配置");
        return $this->fetch();
    }

    /**
     * 系统Log
     * @return mixed
     */
    public function actionLog()
    {
        $logs = Db::name("logs")->order('id desc')->paginate(20);
        $this->assign('logs',$logs);
        $this->assign('sub_title',"日志文件");
        return $this->fetch();
    }
}
