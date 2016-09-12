<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace yiizh\swoole\camera\commands;

use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * WebSocket Server
 *
 * 基于 Swoole
 *
 * @package yiizh\swoole\camera\commands
 */
class ServerController extends Controller
{
    /**
     * @var int 端口
     */
    public $port = 10181;

    public $server;

    /**
     * @var bool 守护进程化
     */
    public $daemonize = false;

    public function options($actionID)
    {
        $options = parent::options($actionID);
        if ($actionID == 'start') {
            $options = ArrayHelper::merge(
                $options,
                [
                    'daemonize'
                ]
            );
        }
        return $options;
    }

    public function optionAliases()
    {
        $aliases = parent::optionAliases();
        return ArrayHelper::merge($aliases, [
            'd' => 'daemonize'
        ]);
    }


    public function actionStart()
    {
        $server = new \swoole_websocket_server("0.0.0.0", $this->port);

        $server->set([
            'daemonize' => $this->daemonize
        ]);

        $server->on('open', [$this, 'onOpen']);
        $server->on('message', [$this, 'onMessage']);
        $server->on('close', [$this, 'onClose']);

        $this->server = $server;
        $server->start();
    }

    /**
     * @param \swoole_websocket_server $server
     * @param $req
     */
    public function onOpen($server, $req)
    {
        echo "connection open: " . $req->fd . PHP_EOL;
    }

    /**
     * @param \swoole_websocket_server $server
     * @param \swoole_websocket_frame $frame
     */
    public function onMessage($server, $frame)
    {
        $connections = $server->connections;
        foreach ($connections as $connection) {
            $server->push($connection, Json::encode(['camera' => $frame->fd, 'data' => $frame->data]));
        }

    }

    /**
     * @param \swoole_websocket_server $server
     * @param int $fd
     */
    public function onClose($server, $fd)
    {
        echo "connection close: " . $fd;
    }
}