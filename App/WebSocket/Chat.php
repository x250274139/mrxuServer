<?php 
namespace App\WebSocket;


use EasySwoole\Core\Socket\Response;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\Task\TaskManager;
use Illuminate\Database\Capsule\Manager as DB;
use App\Model\Help;
use App\Model\Logic;

class Chat extends WebSocketController
{

    function actionNotFound(?string $actionName)
    {
        $clientData['actionName'] = $actionName;
        $clientData['client_info'] = 'action is not find';
        $this->response()->write(Help::error($clientData));
    }

    function link(){

    	$param = $this->request()->getArg('data');
    	$this->setUserFid($param['id']);
    	$this->response()->write(Help::success(['fid'=>$this->client()->getFd()]));
    }
    
    function getFriendList(){
    	$param = $this->request()->getArg('data');

    	$logic = new Logic();
    	$firend = $logic->customerFirend($param['customer_id']);

    	$clientData = [];
    	$clientData = array_merge($clientData,['firend'=>$firend]);
    	$clientData = array_merge($clientData,['say'=>'firend']);
    	$this->response()->write(Help::success($clientData));
    }

    function setUserFid($id){
    	return Help::setUserFid($id,$this->client()->getFd());
    }

    function getUserFid($id){
    	return Help::UserFindFid($id);
    }

    function delUserFid($id){
    	return Help::delUserFid($id);
    }
}