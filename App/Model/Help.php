<?php 
namespace App\Model;


use EasySwoole\Core\Socket\Response;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\Task\TaskManager;
use Illuminate\Database\Capsule\Manager as DB;
use EasySwoole\Core\Component\Di;

class Help extends WebSocketController
{

	public static function success($data=[]){
		$callData['data'] = $data;
		$callData['info'] = 'SUCCESS';
		$callData['state'] = 200;
		return json_encode($callData);
	}

	public static function error($data=[]){
		$callData['data'] = $data;
		$callData['info'] = 'ERROR';
		$callData['state'] = -100;
		return json_encode($callData);
	}

	//创建关联
	public static function setUserFid($user_id,$fid){

		return self::getRedis()->set('CHAT_'.$user_id, $fid);
	}

	//删除关联
	public static function delUserFid($user_id){
		return self::getRedis()->del('CHAT_'.$user_id);
	}

	//根据fd获取用户信息
	public static function UserFindFid($user_id){
		return self::getRedis()->get('CHAT_'.$user_id);
	}

    public static function getRedis()
    {
        return Di::getInstance()->get('REDIS')->handler();
    }
}