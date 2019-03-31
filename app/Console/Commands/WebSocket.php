<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\UTCDateTime;

class WebSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:chat {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start | stop | reload';

    public $websocket;
    const PORT = 9501;
    const CHAT_KEY = 'INFOSYS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        switch ($action){
            case 'start':
                $this->start();
                break;
            default:
                $this->info('error:The argument input was wrong');
        }
    }

    private function start()
    {
        $this->info('==WebSocket try to start==');
        $this->websocket = new \swoole_websocket_server('0.0.0.0',self::PORT);

        $this->websocket->on('start',function ($websocket){
            $this->onStart($websocket);
        });
        $this->websocket->on('open',function ($websocket, $request){
            $this->onOpen($websocket, $request);
        });
        $this->websocket->on('message',function ($websocket, $frame){
            $this->onMessage($websocket, $frame);
        });
        $this->websocket->on('close',function ($websocket, $fd){
            $this->onClose($websocket, $fd);
        });
        $this->websocket->start();
    }

    private function onStart($websocket)
    {
        $this->info('==start websocket successfully==');
    }

    /**
     * 握手成功
     *
     * 用户id绑定fd
     * $request->get['user_id']
     * $request->fd
     */
    private function onOpen($websocket, $request)
    {
        $userId = $request->get['user_id'];
        $chatId = $request->fd;

        if (\Redis::hexists(self::CHAT_KEY, $userId)){
            \Redis::hdel(self::CHAT_KEY, $userId);
            $this->info("reconnect|Client:{$userId}->ChatID:{$chatId}");
        }else{
            $this->info("connect|Client:{$userId}->ChatID:{$chatId}");
        }
            \Redis::hset(self::CHAT_KEY, $userId, $chatId);
    }

    /**
     * Message响应
     *
     * 转发实时消息
     * Object $message
     */
    private function onMessage($websocket, $frame)
    {
        $message = json_decode($frame->data);
        $from_id = $message->from_id;
        $to_id = $message->to_id;
        $msg = $message->message;

        /**
         * 聊天信息存Mongodb expire:30min
         *
         * index: from_id && to_id
        **/
        $data = ['from_id' => $from_id, 'to_id' => $to_id,
            'create_time' => new UTCDateTime() , 'data' => $msg];
        DB::connection('mongodb')->collection('infosys')
            ->insert($data);

        $target_fd = \Redis::hget(self::CHAT_KEY, $to_id);
        $websocket->push($target_fd, $msg);
    }

    /**
     * Client退出反馈
     *
     * $fd
     * $websocket
     */
    private function onClose($websocket, $fd)
    {
        $this->info("disconnect|ChatID:{$fd}");
    }


}
