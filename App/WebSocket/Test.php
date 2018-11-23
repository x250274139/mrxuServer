<?php 
namespace App\WebSocket;


use EasySwoole\Core\Socket\Response;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\Task\TaskManager;
use Illuminate\Database\Capsule\Manager as DB;
use App\Model\Help;

class Test extends WebSocketController
{
    function actionNotFound(?string $actionName)
    {
        $clientData['actionName'] = $actionName;
        $clientData['client_info'] = 'action is not find';
        $this->response()->write(Help::error($clientData));
    }

    function hello()
    {
        $version = DB::select('select version();');
        $this->response()->write($version);
        // $this->response()->write('call hello with arg:'.$this->request()->getArg('content'));
    }

    public function who(){
        $this->response()->write('your fd is '.$this->client()->getFd());
    }

    function delay()
    {
        $this->response()->write('this is delay action');
        $client = $this->client();
        //测试异步推送
        TaskManager::async(function ()use($client){
            sleep(1);
            Response::response($client,'this is async task res'.time());
        });
    }
}