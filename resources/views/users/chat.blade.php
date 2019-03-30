@extends('layouts.app')

@section('title','聊天')

@section('content')
    <div class="card">
        <h5 class="card-header">正在与{{$user->name}}聊天</h5>
        <div class="card-body">
            <div id="wsMain">
            </div>
            <label>请输入您要发送的信息：</label><input type="text" id="txtMsg">
            <input class="btn btn-primary" type="button" id="btnSend" value="发送">
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">

        var wsUrl = 'ws://127.0.0.1:9501?user_id={{\Illuminate\Support\Facades\Auth::id()}}';

        var ws;

        $(function () {
            initWebSocket();

            $('#btnSend').click(function () {
                sendMsg();
            });
        });

        //初始化webSocket
        function initWebSocket() {
            try {
                ws = new WebSocket(wsUrl);
                initEventHandle();
            } catch (ex) {
                outPutMsg('连接服务器失败');
                setTimeout('reConnect()', 5000);
            }
        }

        //webSocket回调事件
        function initEventHandle() {
            //连接监听
            ws.onopen = function (ev) {
                outPutMsg("连接服务器成功");
            };

        //消息监听
            ws.onmessage = function (ev) {
                outPutMsg('From server:' + ev.data);
            };

        //关闭监听
            ws.onclose = function (ev) {
                outPutMsg("服务器已关闭");
                //断线重连
                setTimeout('reConnect()', 5000);
            };
        }

        //断线重连
        function reConnect() {
            initWebSocket();
        }

        //发送消息
        function sendMsg() {
            var data = {'from_id':"{{\Illuminate\Support\Facades\Auth::id()}}",'to_id':"{{$user->id}}",'message':$('#txtMsg').val()};
            var msg = JSON.stringify(data);
            ws.send(msg); //发送消息

            outPutMsg('Me:' + msg);
        }

        //输出消息
        function outPutMsg(msg) {
            var $msg = '<span>' + msg + '</span><br/>';
            $('#wsMain').append($msg);
        }
    </script>
@endsection