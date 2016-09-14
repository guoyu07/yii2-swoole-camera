<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace yiizh\swoole\camera;

use yii\base\Event;
use yii\base\Object;

class Events extends Object
{
    /**
     * @param Event $event
     */
    public static function onTopNavBarInit($event)
    {
        $mangeBar = $event->sender;
        $mangeBar->addItem([
            'label' => 'Yii2 Swoole Camera',
            'url' => ['/yii2-swoole-camera']
        ], 'demo');
    }
}