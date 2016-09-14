<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use frontend\widgets\ManageBar;
use frontend\widgets\TopNavBar;
use yiizh\swoole\camera\Events;

return [
    'id' => 'yii2-swoole-camera',
    'namespace' => 'yiizh\swoole\camera',
    'class' => 'yiizh\swoole\camera\Module',
    'isCoreModule' => true,
    'commands' => [
        'server' => 'yiizh\swoole\camera\commands\ServerController'
    ],
    'events' => [
        ['class' => TopNavBar::className(), 'event' => TopNavBar::EVENT_INIT, 'callback' => ['yiizh\swoole\camera\Events', 'onTopNavBarInit']]
    ]
];