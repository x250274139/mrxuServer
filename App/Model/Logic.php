<?php 
namespace App\Model;


use EasySwoole\Core\Socket\Response;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\Task\TaskManager;
use Illuminate\Database\Capsule\Manager as DB;
use App\Model\Redis;
use App\Model\Help;

class Logic extends WebSocketController
{
	//获取用户信息
	public function getUser($user_id){
		$user = DB::table('app_user')->where('user_id',$user_id)->first();
		return $user;
	}

	//根据用户客服id查找好友
	public function customerFirend($customer_id){
		$firendList = Db::table('user_chat')
			->where('customer_id',$customer_id)
			->get();

		return $firendList;
	}
}
