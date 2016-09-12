<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

return [
    'id' => 'yii2-swoole-camera',
    'namespace' => 'yiizh\swoole\camera',
    'class' => 'yiizh\swoole\camera\Module',
    'isCoreModule' => true,
    'commands' => [
        'server' => 'yiizh\swoole\camera\commands\ServerController'
    ]
];