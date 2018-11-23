<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use \EasySwoole\Core\AbstractInterface\EventInterface;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use \EasySwoole\Core\Swoole\EventHelper;
use Illuminate\Database\Capsule\Manager as DB;

// 引入Di
use \EasySwoole\Core\Component\Di;
// 引入上文Redis连接
use \App\Utility\Redis;

Class EasySwooleEvent implements EventInterface {

    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
        // 初始化数据库
        $dbConf = Config::getInstance()->getConf('database');
        $capsule = new DB;
        // 创建链接
        $capsule->addConnection($dbConf);
        // 设置全局静态可访问
        $capsule->setAsGlobal(); 
        // 启动Eloquent
        $capsule->bootEloquent();
    }

    public static function mainServerCreate(ServerManager $server,EventRegister $register): void
    {
        // TODO: Implement mainServerCreate() method.
        EventHelper::registerDefaultOnMessage($register,\App\Parser::class);
        // 注册Redis 从Config中读取Redis配置
        Di::getInstance()->set('REDIS', new Redis(Config::getInstance()->getConf('REDIS')));
    }

    public static function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public static function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}